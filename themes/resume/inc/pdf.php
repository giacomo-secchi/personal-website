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
 * DocRaptor fetches `document_url` itself, so this only works once the site is
 * reachable from the public internet (staging/production) — not on *.local.
 */



add_action( 'template_redirect', function () {
	if ( ! isset( $_GET['format'] ) || 'pdf' !== $_GET['format'] ) {
		return;
	}

	$api_key = defined( 'DOCRAPTOR_API_KEY' ) ? DOCRAPTOR_API_KEY : getenv( 'DOCRAPTOR_API_KEY' );

	if ( ! $api_key ) {
		wp_die( 'PDF generation is not configured.', 'DocRaptor', array( 'response' => 500 ) );
	}

	// Same page the visitor is on (view, language, …), minus our own trigger param.
	$source_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . remove_query_arg( 'format', $_SERVER['REQUEST_URI'] ) );
	$filename   = resume_pdf_filename();

	$force_fresh = ! empty( $_GET['fresh'] ) && current_user_can( 'manage_options' );

	// Keyed by view + language (both baked into $source_url), so CV/IT, Resume/EN, … each cache separately.
	$cache_file = path_join( wp_upload_dir()['basedir'], 'resume-pdf-cache/' . md5( $source_url ) . '.pdf' );

	if ( $force_fresh || ! file_exists( $cache_file ) || ( time() - filemtime( $cache_file ) ) > DAY_IN_SECONDS ) {
		$test_mode = defined( 'DOCRAPTOR_TEST_MODE' ) ? (bool) DOCRAPTOR_TEST_MODE : (bool) getenv( 'DOCRAPTOR_TEST_MODE' );
		$pdf       = resume_fetch_pdf_from_docraptor( $source_url, $filename, $api_key, $test_mode );

		if ( is_wp_error( $pdf ) ) {
			wp_die( esc_html( $pdf->get_error_message() ), 'DocRaptor', array( 'response' => 502 ) );
		}

		wp_mkdir_p( dirname( $cache_file ) );
		file_put_contents( $cache_file, $pdf );
	}

	nocache_headers();
	header( 'Content-Type: application/pdf' );
	header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
	header( 'Content-Length: ' . filesize( $cache_file ) );
	readfile( $cache_file );
	exit;
} );

 
// `cv` vs `resume`, matching src/resume-section/view.js's `?view=` + first-view default.
function resume_pdf_view() {
	$views     = array_keys( resume_get_views() );
	$requested = isset( $_GET['view'] ) ? sanitize_key( wp_unslash( $_GET['view'] ) ) : '';

	if ( $requested && in_array( $requested, $views, true ) ) {
		return $requested;
	}

	return $views[0] ?? 'cv';
}

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
	$view  = resume_pdf_view();
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
function resume_fetch_pdf_from_docraptor( $url, $filename, $api_key, $test_mode ) {
	$response = wp_remote_post(
		'https://api.docraptor.com/docs',
		array(
			'timeout' => 45,
			'headers' => array( 'Content-Type' => 'application/json' ),
			'body'    => wp_json_encode(
				array(
					'user_credentials' => $api_key,
					'doc'              => array(
						'test'           => $test_mode,
						'document_type'  => 'pdf',
						'document_url'   => $url,
						'name'           => $filename, // helps find the doc later in the DocRaptor dashboard
						'javascript'     => true,
						'prince_options' => array(
							// Reuses the @media print rules in src/resume-section/style.scss
							// and src/tab-switch/style.scss (hide nav/switch/button, collapse columns).
							'media' => 'print',
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
