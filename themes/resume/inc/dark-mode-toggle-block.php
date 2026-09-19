<?php


add_action('wp_enqueue_scripts', function () {
    // Frontend
    wp_enqueue_style(
        'resume-dark-mode',
        get_template_directory_uri() . '/build/css/dark-mode.css',
        array(),
        filemtime( get_template_directory() . '/build/css/dark-mode.css' )
    );
} );


add_action( 'after_setup_theme', function () {
    add_editor_style( 'build/css/dark-mode.css' );
} );