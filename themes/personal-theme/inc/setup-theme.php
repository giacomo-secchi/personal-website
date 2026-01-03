<?php

add_action( 'after_setup_theme', function(){

    /**
     * Add support for Block Styles.
     */
    add_theme_support( 'wp-block-styles' );



    /**
     * Add support for editor styles.
     */

    // 1. Necessario per caricare gli stili nell'editor
    add_theme_support( 'editor-styles' );


    /**
     * Enqueue editor styles.
     */
    // 2. Specifica quale file CSS caricare nell'editor (se ne usi uno)
    add_editor_style( 'style.css' );


    /**
     * Add support for responsive embedded content.
     */
    add_theme_support( 'responsive-embeds' );


    // 3. Supporto per le immagini in evidenza (sempre utile)
    add_theme_support( 'post-thumbnails' );
    
    // 4. Se vuoi mantenere il portfolio Jetpack (che stavamo provando prima)
    add_theme_support( 'jetpack-portfolio' );
} );