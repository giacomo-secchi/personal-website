<?php

/**
 * Block Rendering Customizations
 *
 * This file contains filters that intercept the output of Gutenberg blocks
 * to inject dynamic attributes, such as title-based IDs.
 *
 * @package personal-website
 */

/**
 * Adds a dynamic ID (based on the post title slug) to the Post Title block.
 *
 * It uses the 'render_block_core-post-title' specific filter and the 
 * WP_HTML_Tag_Processor class to ensure valid and secure HTML markup injection.
 *
 * @param string $block_content The rendered block HTML.
 * @param array  $block         The block attributes and metadata.
 * @return string               The modified HTML with the injected ID attribute.
 */
add_filter( 'render_block_core/post-title', function ( $block_content, $block ) {
    $slug_id = sanitize_title( get_the_title() );

    $processor = new WP_HTML_Tag_Processor( $block_content );

    if ( $processor->next_tag() ) {
        $processor->set_attribute( 'id', $slug_id );
    }

    return $processor->get_updated_html();
}, 10, 2 );