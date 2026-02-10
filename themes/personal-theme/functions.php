<?php


require get_stylesheet_directory() . '/inc/setup-theme.php';
require get_stylesheet_directory() . '/inc/register-block-binding.php';
require get_stylesheet_directory() . '/inc/enqueue-assets.php';
require get_stylesheet_directory() . '/inc/block-filters.php';
require get_stylesheet_directory() . '/inc/register-blocks.php';

if ( class_exists( 'Jetpack' ) ) {
    require get_stylesheet_directory() . '/inc/class-portfolio-jetpack.php';
}