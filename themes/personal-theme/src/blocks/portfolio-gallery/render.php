<?php
/**
 * Block Template: Dynamic Post Gallery
 *
 * @package personal-website
 */

$featured_id = get_post_thumbnail_id();
$gallery     = ( array ) get_field( 'additional_images' );

// Extract IDs from gallery.
$gallery_ids = array_map( function( $img ) {
    if ( empty( $img ) ) {
        return null;
    }
    if ( is_array( $img ) ) {
        return $img['ID'] ?? null;
    }
    return $img; 
}, $gallery );

 

// Merge Featured Image with Gallery IDs and clean the array
// array_filter rimuove i 'null' prodotti dalla funzione sopra
$images = array_unique( array_filter( array_merge( (array) $featured_id, $gallery_ids ) ) );

// Exit early if no images are found
if ( empty( $images ) ) {
    return;
}


// Build the inner blocks.
$inner_blocks_html = '';

foreach ( $images as $id ) {
    $img_id = intval( $id );
    $src = esc_url( wp_get_attachment_image_src( $id, 'square-large' )[0] );
    $alt = esc_attr( get_post_meta( $id, '_wp_attachment_image_alt', true ) );

    $inner_blocks_html .= <<<HTML
        <!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
        <figure class="wp-block-image size-full"><img src="{$src}" alt="{$alt}" class="wp-image-{$img_id}"/></figure>
        <!-- /wp:image -->
HTML;
}

/**
 * Wrap everything in the Gallery Block markup.
 * We include the required wrapper div to match the modern Block Editor output.
 */
$content = <<<HTML
    <!-- wp:gallery {"columns":0,"linkTo":"none","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}}} -->
    <figure class="wp-block-gallery has-nested-images columns-0 is-cropped">{$inner_blocks_html}</figure>
    <!-- /wp:gallery -->
HTML;

// Final Output: Process the block string through the WordPress block renderer.
echo do_blocks( $content );


 