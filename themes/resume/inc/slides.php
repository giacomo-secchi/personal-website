<?php
/**
 * Static slide decks served at a top-level URL.
 *
 * Every `slides/<slug>/index.html` folder in the theme is served at `/<slug>/`.
 * A `<base href>` pointing at the folder's theme URL is injected so the deck's
 * relative assets are fetched as plain static files from the theme directory.
 */

add_action( 'parse_request', function ( $wp ) {
    $slug = trim( $wp->request, '/' );

    if ( ! preg_match( '/^[a-z0-9-]+$/', $slug ) ) {
        return;
    }

    $index = get_stylesheet_directory() . "/slides/{$slug}/index.html";

    if ( ! is_readable( $index ) ) {
        return;
    }

    $base = '<base href="' . esc_url( get_stylesheet_directory_uri() . "/slides/{$slug}/" ) . '">';
    $html = preg_replace( '/<head\b[^>]*>/i', '$0' . $base, file_get_contents( $index ), 1 );

    status_header( 200 );
    header( 'Content-Type: text/html; charset=utf-8' );
    echo $html;
    exit;
} );
