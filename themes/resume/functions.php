<?php

// Résumé views (front-end tabs) — shared by resume/tab-switch and the Resume Visibility field
require get_stylesheet_directory() . '/inc/resume-views.php';

// Bootstrap Icons collection for the core/icon block.
require get_stylesheet_directory() . '/inc/bootstrap-icons.php';

// Optional Bootstrap icon before each résumé section title.
require get_stylesheet_directory() . '/inc/section-icons.php';

// Custom Advanced Custom Fields Plugin settings
if ( class_exists( 'ACF' ) ) {
    require get_stylesheet_directory() . '/inc/acf.php';
}

// Custom TranslatePress language switcher
if ( class_exists( 'TRP_Translate_Press' ) ) {
    require get_stylesheet_directory() . '/inc/language-switcher.php';
}

// Custom Dark Mode Toggle Block
if ( function_exists( 'tabordarkmodetoggleblock_init' ) ) {
    require get_stylesheet_directory() . '/inc/dark-mode-toggle-block.php';
}

// Person structured data (JSON-LD) built from Experience/Education CPTs, extends Yoast SEO's schema
if ( defined( 'WPSEO_VERSION' ) ) {
    require get_stylesheet_directory() . '/inc/schema-jsonld.php';
}

add_action( 'init', function () {
    wp_register_block_types_from_metadata_collection( __DIR__ . '/build', __DIR__ . '/build/blocks-manifest.php' );
} );

