<?php

// general theme functions and hooks.
require get_stylesheet_directory() . '/inc/config.php';

// Icons for the core/icon block: collection registration, the "Section icon" editor picker, and .resume-icon styling.
require get_stylesheet_directory() . '/inc/icons.php';

// Custom TranslatePress language switcher.
if ( class_exists( 'TRP_Translate_Press' ) ) {
    require get_stylesheet_directory() . '/inc/language-switcher.php';
}

// Custom block styles and assets (CSS/JS) for the front end and editor.
require get_stylesheet_directory() . '/inc/load-assets.php';

// Person structured data (JSON-LD) built from Experience/Education CPTs, extends Yoast SEO's schema.
if ( defined( 'WPSEO_VERSION' ) ) {
    require get_stylesheet_directory() . '/inc/schema-jsonld.php';
}

// PDF generator.
require get_stylesheet_directory() . '/inc/pdf.php';
