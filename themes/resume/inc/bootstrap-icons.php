<?php
/**
 * Bootstrap Icons for the core/icon block (WordPress 7.1+ Icons API).
 *
 * Requires WordPress 7.1+; older versions have neither the API nor the
 * core/icon block, so the guard below simply no-ops.
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

/**
 * Registered icons as editor choices: [{ value: '<collection>/<slug>', label }].
 *
 * Backs the "Section icon" ComboboxControl in resume/resume-section and resume/list-section.
 *
 * @param string|string[]|null $collections Optional. Collection slug(s) to include
 *                                           (e.g. 'bootstrap', or array( 'bootstrap', 'core' )).
 *                                           Default null: every registered collection.
 * @return array[]
 */
function resume_get_icon_choices( $collections = null ) {
	if ( ! class_exists( 'WP_Icons_Registry' ) ) {
		return array();
	}

	if ( null !== $collections ) {
		$collections = (array) $collections;
	}

	$choices = array();

	foreach ( WP_Icons_Registry::get_instance()->get_registered_icons() as $icon ) {
		if ( null !== $collections && ! in_array( $icon['collection'] ?? '', $collections, true ) ) {
			continue;
		}

		$choices[] = array(
			'value' => $icon['name'],
			'label' => $icon['label'],
		);
	}

	return $choices;
}

/**
 * Exposes resume_get_icon_choices() to the block editor as `window.resumeIconChoices`.
 *
 * Only these collections back the "Section icon" picker — add a slug to the
 * array below (once its collection is registered) to include it too.
 */
add_action(
	'enqueue_block_editor_assets',
	function () {
		$collections = array( 'bootstrap' );

		// wp-blocks is a dependency of every block editor script, so this runs first.
		wp_add_inline_script(
			'wp-blocks',
			'window.resumeIconChoices = ' . wp_json_encode( resume_get_icon_choices( $collections ) ) . ';',
			'before'
		);
	}
);

/**
 * `.resume-icon` styling: 1em size + a bit of trailing space before the text.
 *
 * Inlined onto the `global-styles` handle rather than a separate stylesheet —
 * it's two rules, and `global-styles` is the handle WP core itself uses for
 * small CSS fragments (Customizer "Additional CSS", duotone presets, block
 * style variations, …), always registered on `wp_enqueue_scripts` before
 * theme code runs.
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_add_inline_style(
			'global-styles',
			'.resume-icon{display:inline-flex;align-items:center;margin-inline-end:.5em}.resume-icon svg{width:1em;height:1em}'
		);
	}
);
