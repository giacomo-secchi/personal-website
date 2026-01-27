<?php

$featured_id = get_post_thumbnail_id();
$gallery = get_field( 'additional_images' );

$images = array();

if ( ! $featured_id ) {
	return '';
}

$images[] = $featured_id;


if ( $gallery ) {
    foreach ( $gallery as $img ) {
        $images[] = is_array($img) ? $img['ID'] : $img;
    }
}


if ( ! $images ) {
	return '';
}



foreach ( $images as $id ) {

	$src = wp_get_attachment_image_src($id, 'square-large')[0];
	$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );

    echo '<figure class="wp-block-image size-full">';
    echo '<img src="' . esc_url( $src ) . '" alt="' . esc_attr( $alt ) . '" />';
    echo '</figure>';
}

?>



