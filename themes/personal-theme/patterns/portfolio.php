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


