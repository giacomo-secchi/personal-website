<?php
/**
 * Title: Grid of projects in three columns.
 * Slug: personal-website/projects-grid
 * Categories: posts
 * Block Types: core/query
 */
?>
<!-- wp:query {"queryId":0,"query":{"pages":0,"offset":0,"postType":"jetpack-portfolio","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-query alignwide">
	<!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"grid","columnCount":3}} -->
		<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->
		<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small","margin":{"top":"30px"}}}} -->
		<div class="wp-block-group" style="margin-top:30px">
			<!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->
			<!-- wp:group {"style":{"spacing":{"blockGap":"5px","margin":{"top":"10px"}}},"layout":{"type":"flex"},"fontSize":"x-small"} -->
			<div class="wp-block-group has-x-small-font-size" style="margin-top:10px">
				<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"small"} -->
				<p class="has-small-font-size" style="text-transform:uppercase"><strong>Client</strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"writepoetry_project_client"}}}},"style":{"spacing":{"margin":{"top":"0"}}},"textColor":"cyan-bluish-gray","fontSize":"small"} -->
				<p class="has-cyan-bluish-gray-color has-text-color has-small-font-size" style="margin-top:0"></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"small"} -->
				<p class="has-small-font-size" style="text-transform:uppercase"><strong>Year</strong></p>
				<!-- /wp:paragraph -->

				<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"writepoetry_project_year"}}}},"style":{"spacing":{"margin":{"top":"0"}}},"textColor":"cyan-bluish-gray","fontSize":"small"} -->
				<p class="has-cyan-bluish-gray-color has-text-color has-small-font-size" style="margin-top:0"></p>
				<!-- /wp:paragraph -->


				<!-- wp:post-terms {"term":"jetpack-portfolio-type"} /-->

				<!-- wp:post-terms {"term":"jetpack-portfolio-tag","prefix":"\u003cstrong\u003eActivities:\u003c/strong\u003e "} /-->
			</div>
			<!-- /wp:group -->
			<!-- wp:read-more {"content":"View Details","fontSize":"small"} /-->
		</div>
		<!-- /wp:group -->
	<!-- /wp:post-template -->
	<!-- wp:query-pagination -->
		<!-- wp:query-pagination-previous /-->
		<!-- wp:query-pagination-next /-->
	<!-- /wp:query-pagination -->
</div>
<!-- /wp:query -->

