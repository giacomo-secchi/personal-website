<?php
/**
 * Résumé views — the front-end tabs (CV / Resume / ...).
 *
 * Single source of truth, consumed by:
 *   - resume/tab-switch  (src/tab-switch/render.php) — renders the tab buttons
 *   - the "Resume Visibility" field (field_resume_visibility) — its checkbox choices
 *
 * Order matters: the first view is the default, shown when the URL has no
 * `?view=` parameter. `resume` is the condensed view that
 * `resume.giacomosecchi.com` 301-redirects to.
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
			'cv'     => __( 'CV', 'resume' ),
			'resume' => __( 'Resume', 'resume' ),
		)
	);
}

// Custom Advanced Custom Fields Plugin settings.
if ( class_exists( 'ACF' ) ) {
    // acf-json choices can't be dynamic, so keep them in sync at load time.
    // Harmless no-op when ACF is not active (the filter never fires).
    add_filter( 'acf/load_field/key=field_resume_visibility', function ( $field ) {
        $field['choices'] = resume_get_views();
        return $field;
    } );

    // Enable ACF shortcode support
    add_filter( 'acf/settings/enable_shortcode', '__return_true' );

    // Allow ACF shortcodes in FSE templates (blocked by default outside the_content)
    add_filter( 'acf/shortcode/allow_in_block_themes_outside_content', '__return_true' );
}