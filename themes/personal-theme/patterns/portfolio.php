<?php
/**
 * Title: Portfolio with heading, text, images.
 * Slug: frost/portfolio
 * Categories: featured
 */
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"jetpack-portfolio","order":"desc","orderBy":"meta_value_num","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[],"meta_query":{"queries":[{"id":"1068ab7a-c0fa-4f48-8074-1fc1035ea23c","meta_key":"project_year","meta_value":"","meta_compare":"NOT EXISTS","meta_type":"NUMERIC"},{"id":"3f382842-04b6-4d6a-9e72-e6f20f701d76","meta_key":"project_year","meta_value":"","meta_compare":"EXISTS","meta_type":"NUMERIC"}],"relation":"OR"}},"namespace":"advanced-query-loop"} -->
<div class="wp-block-query">

<!-- wp:post-template {"layout":{"type":"default"}} -->
<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide">
	<!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|medium","left":"var:preset|spacing|large"}}},"className":"is-style-columns-reverse"} -->
	<div class="wp-block-columns alignwide are-vertically-aligned-center is-style-columns-reverse">
		<!-- wp:column {"verticalAlignment":"center","width":""} -->
		<div class="wp-block-column is-vertically-aligned-center">
			<!-- wp:heading {"fontSize":"x-large","anchor":"sample-heading"} -->
			<h2 class="wp-block-heading has-x-large-font-size" id="sample-heading"><?php echo esc_html__( 'Build with Frost', 'frost' ); ?></h2>
			<!-- /wp:heading -->
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

			<!-- wp:gallery {"columns":0,"linkTo":"none","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|x-small","left":"var:preset|spacing|x-small"}}}} -->
			<figure class="wp-block-gallery has-nested-images columns-0 is-cropped">
				<!-- wp:personal-website/portfolio-gallery /-->
				<!-- wp:image {"sizeSlug":"full","linkDestination":"none"} -->
				<figure class="wp-block-image size-full"><img src="<?php echo esc_url( get_theme_file_uri() ) . '/assets/images/sample_800x800.jpg'; ?>" alt="<?php echo esc_attr__( 'Sample Image', 'frost' ); ?>"/></figure>
				<!-- /wp:image -->
			</figure>
			<!-- /wp:gallery -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- /wp:post-template -->

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->


