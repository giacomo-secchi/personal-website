<?php
/**
 * "Download printable version" — renders the résumé as a real PDF via DocRaptor
 * instead of relying on the browser's print dialog.
 *
 * Triggered by `?format=pdf` on the front end (see src/resume-section/view.js,
 * which appends it to the current URL — same view/language, no reload).
 *
 * Requires, outside the theme repo (wp-config.php or the hosting env):
 *   define( 'DOCRAPTOR_API_KEY', '...' );
 *   define( 'DOCRAPTOR_TEST_MODE', true ); // omit/false = live PDFs (uses paid credits); true = free watermarked test PDFs
 *
 * The page is rendered server-side and sent to DocRaptor as `document_content`,
 * so DocRaptor never requests the page itself (Cloudflare answers its datacenter
 * IPs with 403). It still downloads stylesheets, fonts and images from the
 * public site, so those must be reachable from the internet.
 */

function resume_is_pdf_request() {
	return isset( $_GET['format'] ) && 'pdf' === $_GET['format'];
}

// The admin bar is initialised before template_include, so it has to be disabled up front.
add_filter( 'show_admin_bar', function ( $show ) {
	return resume_is_pdf_request() ? false : $show;
} );

add_filter( 'template_include', function ( $template ) {
	if ( ! resume_is_pdf_request() ) {
		return $template;
	}

	$api_key = defined( 'DOCRAPTOR_API_KEY' ) ? DOCRAPTOR_API_KEY : getenv( 'DOCRAPTOR_API_KEY' );

	if ( ! $api_key ) {
		wp_die( 'PDF generation is not configured.', 'DocRaptor', array( 'response' => 500 ) );
	}

	// Same page the visitor is on (view, language, …), minus our own trigger param.
	$source_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . remove_query_arg( array( 'format', 'fresh' ), $_SERVER['REQUEST_URI'] ) );
	$filename   = resume_pdf_filename();

	$force_fresh = ! empty( $_GET['fresh'] ) && current_user_can( 'manage_options' );

	// Keyed by view + language (both baked into $source_url), so CV/IT, Resume/EN, … each cache separately.
	$cache_file = path_join( wp_upload_dir()['basedir'], 'resume-pdf-cache/' . md5( $source_url ) . '.pdf' );

	if ( $force_fresh || ! file_exists( $cache_file ) || ( time() - filemtime( $cache_file ) ) > DAY_IN_SECONDS ) {
		// Render as an anonymous visitor so no user-specific markup or nonces end up in the PDF.
		wp_set_current_user( 0 );

		ob_start();
		include $template;
		$html = ob_get_clean();

		$test_mode = defined( 'DOCRAPTOR_TEST_MODE' ) ? (bool) DOCRAPTOR_TEST_MODE : (bool) getenv( 'DOCRAPTOR_TEST_MODE' );
		$pdf       = resume_fetch_pdf_from_docraptor( $html, $source_url, $filename, $api_key, $test_mode );

		if ( is_wp_error( $pdf ) ) {
			wp_die( esc_html( $pdf->get_error_message() ), 'DocRaptor', array( 'response' => 500 ) );
		}

		wp_mkdir_p( dirname( $cache_file ) );
		file_put_contents( $cache_file, $pdf );
	}

	nocache_headers();
	header( 'Content-Type: application/pdf' );
	header( 'Content-Disposition: inline; filename="' . $filename . '"' );
	header( 'Content-Length: ' . filesize( $cache_file ) );
	readfile( $cache_file );
	exit;
}, PHP_INT_MAX );


// TranslatePress's current language, falling back to the site locale when TRP is off.
function resume_pdf_language() {
	global $TRP_LANGUAGE;

	if ( ! empty( $TRP_LANGUAGE ) ) {
		return $TRP_LANGUAGE;
	}

	return substr( get_locale(), 0, 2 );
}

// e.g. "giacomo-secchi-cv-it.pdf" / "giacomo-secchi-resume-en.pdf".
function resume_pdf_filename() {
	$view  = resume_get_active_view();
	$label = resume_get_views()[ $view ] ?? $view;
	$lang  = resume_pdf_language();

	$name = 'giacomo-secchi-' . sanitize_title( $label );
	if ( $lang ) {
		$name .= '-' . strtolower( $lang );
	}

	return $name . '.pdf';
}

/**
 * @return string|WP_Error Raw PDF bytes, or an error with DocRaptor's own message.
 */
function resume_fetch_pdf_from_docraptor( $html, $base_url, $filename, $api_key, $test_mode ) {
	$response = wp_remote_post(
		'https://api.docraptor.com/docs',
		array(
			'timeout' => 45,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode(
				array(
					'user_credentials' => $api_key,
					'doc'              => array(
						'test'             => $test_mode,
						'document_type'    => 'pdf',
						'pipeline'         => '10.1',
						'document_content' => $html,
						'name'             => $filename, // helps find the doc later in the DocRaptor dashboard
						'javascript'       => false,
						'prince_options'   => array(
							// Reuses the @media print rules in src/resume-section/style.scss
							// and src/tab-switch/style.scss (hide nav/switch/button, collapse columns).
							'media'   => 'print',
							'baseurl' => $base_url,
						),
					),
				)
			),
		)
	);

	if ( is_wp_error( $response ) ) {
		return $response;
	}

	$code = wp_remote_retrieve_response_code( $response );
	if ( 200 !== $code ) {
		// DocRaptor puts its error message in the response body.
		return new WP_Error( 'docraptor_error', 'DocRaptor returned HTTP ' . $code . ': ' . wp_remote_retrieve_body( $response ) );
	}

	return wp_remote_retrieve_body( $response );
}
