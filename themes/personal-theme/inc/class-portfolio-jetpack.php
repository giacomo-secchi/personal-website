<?php
/**
 * Portfolio Website Child Class
 *
 * @since    0.1.0
 * @package  Portfolio
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

			// add_action( 'wp_head', function() {
			// 	if ( is_archive( 'jetpack-portfolio' ) ) {
			// 		add_filter( 'wp_body_open',  array( $this, 'popup_template' ), 10, 2 );
			// 	}
			// } );

			add_action( 'wp_enqueue_scripts',  function () {

				$asset_path = get_stylesheet_directory() . '/assets/js/core-block-categories.asset.php';

				if ( ! file_exists( $asset_path ) ) {
					return;
				}

				$asset_file = include $asset_path;

				wp_register_script(
					'categories-block-asset',
					get_stylesheet_directory_uri() . '/assets/js/core-block-categories.js',
					$asset_file['dependencies'],
					$asset_file['version'],
					true
				);

			} );


			add_filter( 'block_type_metadata', function ( $metadata ) {

				if ( ! isset( $metadata['name'] ) ) {
					return $metadata;
				}

				if ( 'core/categories' === $metadata['name'] ) {
					$metadata['viewScript'] = array_merge(
						( array ) ( $metadata['viewScript'] ?? array() ),
						array( 'categories-block-asset' )
					);
				}

				return $metadata;
			} );


			// add_filter( 'render_block_core/read-more', array( $this, 'modify_readmore_blocks' ), 10, 2 );

			// add_action( 'wp_ajax_get_project',  array( $this, 'get_project_data' ), 10, 2 );
			// add_action( 'wp_ajax_nopriv_get_project',  array( $this, 'get_project_data' ), 10, 2 );

			// add_filter( 'render_block_core/post-terms', array( $this, 'remove_taxonomy_links' ), 10, 2 );


			add_filter( 'render_block_core/categories', function( $content, $block ) {
				if (
					empty( $block['attrs']['taxonomy'] ) ||
					$block['attrs']['taxonomy'] !== 'jetpack-portfolio-type'
				) {
					return $content;
				}

				if (
					! is_post_type_archive( 'jetpack-portfolio' ) &&
					! is_tax( 'jetpack-portfolio-type' ) &&
					! is_tax( 'jetpack-portfolio-tag' ) &&
					! is_page( 'portfolio' )
				) {
					return $content;
				}

				$user = get_personal_website_admin_user();
				if ( ! $user ) {
					return $content;
				}

				$since = (int) get_user_meta( $user->ID, 'start_year', true );
				if ( ! $since ) {
					return $content;
				}

				$years = (int) date( 'Y' ) - $since;

				$template = get_user_meta(
					$user->ID,
					'portfolio_experience_text',
					true
				);

				if ( empty( $template ) ) {
					return $content;
				}

				return sprintf(
					'<p>%s</p>%s',
					esc_html( sprintf( $template, $years ) ),
					$content
				);

			}, 10, 2 );
		}




		function modify_readmore_blocks( $block_content, $block ) {
			if ( isset( $block['blockName'] ) && 'core/read-more' === $block['blockName'] ) {
				global $post;

				if ( $post && isset( $post->ID ) ) {
					// Add the custom class to the block content using the HTML API.
					$processor = new WP_HTML_Tag_Processor( $block_content );

					if ( $processor->next_tag( 'a' ) ) {
						$processor->set_attribute( 'data-project-id', $post->ID );

						return $processor->get_updated_html();
					}
				}
			}

			return $block_content;
		}


		public function remove_taxonomy_links( $block_content, $block ) {

			if ( isset( $block['attrs']['term'] ) && 'jetpack-portfolio-tag' === $block['attrs']['term'] ) {
				// Remove all tag links from the block content.
				$processor = new \WP_HTML_Tag_Processor( $block_content );

				while ( $processor->next_tag( 'a' ) ) {
					$processor->remove_attribute( 'href' );
					$processor->remove_attribute( 'rel' );
				}

        		$block_content = $processor->get_updated_html();

			}

			// Return the updated HTML content
			return $block_content;
		}




		/**
		 * Add a custom template to the footer.
		 *
		 * @since 0.1.0
		 */
		public function popup_template() {
			echo '
                <div class="popup d-none" aria-hidden="true" role="dialog">
                   	<button type="button" class="popup-close" data-dismiss="modal" aria-label="' . esc_html__( 'Close', 'portfolio' ) . '">
						<span aria-hidden="true">×</span>
					</button>
					<div class="popup-content" aria-labelledby="popup-title"></div>
                </div>';
		}

		function get_project_data() {
			check_ajax_referer( 'popup_nonce', 'nonce' );

			$project_id = intval( $_POST['project_id'] );
			$project = get_post( $project_id );

			if ( ! $project ) {
				wp_send_json_error( ['message' => 'Project not found'], 404 );
			}

			wp_send_json_success( [
				'title'   => get_the_title( $project ),
				'content' => apply_filters( 'the_content', $project->post_content )
			] );
		}
	}
endif;

return new Portfolio_Jetpack();
