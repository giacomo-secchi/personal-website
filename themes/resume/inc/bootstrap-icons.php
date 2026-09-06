<?php
/**
 * Registers a "bootstrap" icon collection for the core/icon block.
 *
 * The icons are the Bootstrap Icons (MIT) SVGs, copied verbatim from the
 * `bootstrap-icons` npm package into build/bootstrap-icons/ by webpack.config.js
 * on `npm run build`. Once registered they show up as a "Bootstrap Icons" tab in
 * the core/icon block's Icon library, and render via
 * `<!-- wp:icon {"icon":"bootstrap/…"} /-->`.
 *
 * Requires WordPress 7.1+ (Icons API). Older versions have neither the API nor
 * the core/icon block, so the guard below simply no-ops.
 *
 * @package resume
 */

add_action(
	'init',
	function () {
		if ( ! function_exists( 'wp_register_icon_collection' ) ) {
			return; // WP < 7.1: no Icons API.
		}

		wp_register_icon_collection(
			'bootstrap',
			array(
				'label'       => __( 'Bootstrap Icons', 'resume' ),
				'description' => __( 'Official open source SVG icon library for Bootstrap.', 'resume' ),
			)
		);

		$icons_dir = get_theme_file_path( 'build/bootstrap-icons' );

		foreach ( glob( $icons_dir . '/*.svg' ) as $file ) {
			$slug = basename( $file, '.svg' );

			wp_register_icon(
				"bootstrap/$slug",
				array(
					'label'     => ucwords( str_replace( '-', ' ', $slug ) ),
					'file_path' => $file,
				)
			);
		}
	}
);
