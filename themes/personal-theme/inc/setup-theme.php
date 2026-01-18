<?php

add_action( 'after_setup_theme', function(){
    /**
     * Add support for Block Styles.
     */
    add_theme_support( 'wp-block-styles' );

    /**
     * Add support for editor styles.
     */
    add_theme_support( 'editor-styles' );

    /**
     * Enqueue editor styles.
     */
    add_editor_style( 'style.css' );

    /**
     * Add support for responsive embedded content.
     */
    add_theme_support( 'responsive-embeds' );

    /**
	 * Support for featured images.
	 */
    add_theme_support( 'post-thumbnails' );

    /**
	 * Jetpack Portfolio support.
	 */
    add_theme_support( 'jetpack-portfolio' );
} );
