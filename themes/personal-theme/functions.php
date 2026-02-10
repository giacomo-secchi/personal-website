<?php


require get_stylesheet_directory() . '/inc/setup-theme.php';
require get_stylesheet_directory() . '/inc/register-block-binding.php';
require get_stylesheet_directory() . '/inc/enqueue-assets.php';
require get_stylesheet_directory() . '/inc/block-filters.php';
require get_stylesheet_directory() . '/inc/register-blocks.php';

if ( class_exists( 'Jetpack' ) ) {
    require get_stylesheet_directory() . '/inc/class-portfolio-jetpack.php';
}
 

add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    
	if ( 
		! is_post_type_archive( 'jetpack-portfolio' ) 
        // || ( ! is_tax( 'jetpack-portfolio-type' ) )
	) {
		return;
	}

	// limit to 10 items per page.
	$query->set( 'posts_per_page', 10 );
 
	// Order by the 'project_year' meta field, treating it as a numeric value.
	$query->set( 'meta_key', 'project_year' );
	$query->set( 'orderby', 'meta_value_num' );
	$query->set( 'order', 'DESC' );

	// filter projects without year to the end of the list.
	$meta_query = array(
		'relation' => 'OR',
		array(
			'key'     => 'project_year',
			'compare' => 'NOT EXISTS',
			'type'    => 'NUMERIC',
		),
		array(
			'key'     => 'project_year',
			'compare' => 'EXISTS',
			'type'    => 'NUMERIC',
		),
	);

	$query->set( 'meta_query', $meta_query );
} );