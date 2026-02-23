<?php
/**
 * Portfolio Website Child Class
 *
 * @since    0.1.0
 * @package  personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Portfolio_Jetpack' ) ) :

	/**
	 * The main Portfolio class
	 */
	class Portfolio_Jetpack {
		const CUSTOM_POST_TYPE       = 'jetpack-portfolio';
		const CUSTOM_TAXONOMY_TYPE   = 'jetpack-portfolio-type';
		const CUSTOM_TAXONOMY_TAG    = 'jetpack-portfolio-tag';


		/**
		 * Setup class.
		 *
		 * @since 0.1.0
		 */
		public function __construct() {

		


			add_action( 'pre_get_posts', function ( $query ) {
				if ( is_admin() || ! $query->is_main_query() ) {
					return;
				}
				
				if ( 
					! is_post_type_archive( self::CUSTOM_POST_TYPE ) 
					// || ( ! is_tax( self::CUSTOM_TAXONOMY_TYPE ) )
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
		}
	}
endif;

return new Portfolio_Jetpack();
