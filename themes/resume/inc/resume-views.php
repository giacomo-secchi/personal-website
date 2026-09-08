<?php
/**
 * Résumé views — the front-end tabs (Resume / CV / ...).
 *
 * Single source of truth, consumed by:
 *   - resume/tab-switch  (src/tab-switch/render.php) — renders the tab buttons
 *   - the "Resume Visibility" field (field_resume_visibility) — its checkbox choices
 *
 * Add a view from anywhere:
 *
 *     add_filter( 'resume_views', fn( $v ) => $v + array( 'portfolio' => __( 'Portfolio', 'resume' ) ) );
 */

/**
 * @return array<string,string> slug => label
 */
function resume_get_views() {
	return apply_filters(
		'resume_views',
		array(
			'resume' => __( 'Resume', 'resume' ),
			'cv'     => __( 'CV', 'resume' ),
		)
	);
}

// acf-json choices can't be dynamic, so keep them in sync at load time.
// Harmless no-op when ACF is not active (the filter never fires).
add_filter( 'acf/load_field/key=field_resume_visibility', function ( $field ) {
	$field['choices'] = resume_get_views();
	return $field;
} );
