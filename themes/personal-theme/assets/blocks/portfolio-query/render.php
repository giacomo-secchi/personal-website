<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

 
$content = <<<HTML
<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"jetpack-portfolio","order":"desc","orderBy":"meta_value_num","author":"","search":"","exclude":[],"sticky":"","inherit":true}} -->
<div class="wp-block-query">
	<!-- wp:post-template {"layout":{"type":"default"}} -->
		<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
		<div class="wp-block-group alignwide">
			<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}},"className":"is-style-columns-reverse"} -->
			<div class="wp-block-columns alignwide are-vertically-aligned-center is-style-columns-reverse">
				<!-- wp:column {"verticalAlignment":"center","width":""} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:post-title {"level":2,"fontSize":"x-large"} /-->
					<!-- wp:post-excerpt /-->
					<!-- wp:buttons -->
					<div class="wp-block-buttons"><!-- wp:button -->
					<div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View Project', 'frost' ); ?></a></div>
					<!-- /wp:button --></div>
					<!-- /wp:buttons -->
				</div>
				<!-- /wp:column -->
				<!-- wp:column {"verticalAlignment":"center","width":""} -->
				<div class="wp-block-column is-vertically-aligned-center">
					<!-- wp:personal-website/portfolio-gallery /-->
				</div>
				<!-- /wp:column -->
			</div>
			<!-- /wp:columns -->
		</div>
		<!-- /wp:group -->
		<!-- wp:separator {"backgroundColor":"base","className":"has-text-color has-background-color has-alpha-channel-opacity has-base-background-color has-background is-style-wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium"}}}} -->
		<hr class="wp-block-separator has-text-color has-base-color has-alpha-channel-opacity has-base-background-color has-background has-background-color is-style-wide" style="margin-top:var(--wp--preset--spacing--medium);margin-bottom:var(--wp--preset--spacing--medium)"/>
		<!-- /wp:separator -->
	<!-- /wp:post-template -->

	<!-- wp:query-pagination -->
		<!-- wp:query-pagination-previous /-->

		<!-- wp:query-pagination-numbers /-->

		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->
HTML; 



add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    
	if ( 
		! is_post_type_archive( 'jetpack-portfolio' ) || 
		( ! is_tax( 'jetpack-portfolio-type' ) )
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

?>

<div
	<?php echo get_block_wrapper_attributes( array( 
        'class'               => 'portfolio-query',
        'data-wp-interactive' => 'portfolioApp',
        'data-wp-context'     => wp_json_encode( array( 'isLoading' => false ) ),
        'data-wp-class--is-loading' => 'state.isLoading',
		'data-wp-router-region' => 'portfolio-query-results',
    ) ); ?>
>
	<?php echo do_blocks( $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>



