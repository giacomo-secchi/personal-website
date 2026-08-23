<?php

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
