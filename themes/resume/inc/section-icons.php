<?php
/**
 * Optional Bootstrap icon shown before a résumé section title.
 *
 * Both resume/resume-section and resume/list-section expose a `sectionIcon`
 * attribute (a `bootstrap/<slug>` id, matching the core/icon block's Icons API
 * collection registered in inc/bootstrap-icons.php). This file:
 *
 *   1. renders the chosen icon inline in the section <dt>, tinted with the
 *      theme's `contrast` colour preset;
 *   2. feeds the editor a `window.resumeBootstrapIcons` list so the block
 *      sidebar can offer a searchable dropdown of every available icon.
 *
 * @package resume
 */

/**
 * All Bootstrap icon slugs shipped in build/bootstrap-icons/, e.g. `briefcase-fill`.
 *
 * @return string[]
 */
function resume_bootstrap_icon_slugs() {
	static $slugs = null;

	if ( null === $slugs ) {
		$slugs = array();

		foreach ( glob( get_theme_file_path( 'build/bootstrap-icons' ) . '/*.svg' ) as $file ) {
			$slugs[] = basename( $file, '.svg' );
		}
	}

	return $slugs;
}

/**
 * Renders the section icon as inline SVG, coloured with the `contrast` preset.
 *
 * Accepts either a bare slug (`briefcase-fill`) or the core/icon id
 * (`bootstrap/briefcase-fill`). Returns an empty string when unset or unknown.
 *
 * @param string $icon Icon id or slug.
 * @return string
 */
function resume_render_section_icon( $icon ) {
	if ( ! is_string( $icon ) || '' === $icon ) {
		return '';
	}

	$slug = preg_replace( '/[^a-z0-9-]/', '', str_replace( 'bootstrap/', '', strtolower( $icon ) ) );

	if ( '' === $slug || ! in_array( $slug, resume_bootstrap_icon_slugs(), true ) ) {
		return '';
	}

	$file = get_theme_file_path( "build/bootstrap-icons/{$slug}.svg" );

	if ( ! is_readable( $file ) ) {
		return '';
	}

	// Bootstrap SVGs already use fill="currentColor", so tinting the wrapper is enough.
	return sprintf(
		'<span class="resume-section__icon" aria-hidden="true" style="color:var(--wp--preset--color--contrast)">%s</span>',
		file_get_contents( $file ) // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- local theme asset.
	);
}

/**
 * Exposes the icon list to the block editor as `window.resumeBootstrapIcons`
 * ({ value: 'bootstrap/<slug>', label: '<Slug>' }[]), for the section blocks'
 * ComboboxControl.
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		$options = array_map(
			function ( $slug ) {
				return array(
					'value' => "bootstrap/{$slug}",
					'label' => ucwords( str_replace( '-', ' ', $slug ) ),
				);
			},
			resume_bootstrap_icon_slugs()
		);

		// wp-blocks is a dependency of every block editor script, so this runs first.
		wp_add_inline_script(
			'wp-blocks',
			'window.resumeBootstrapIcons = ' . wp_json_encode( $options ) . ';',
			'before'
		);
	}
);
