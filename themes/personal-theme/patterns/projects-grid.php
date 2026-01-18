<?php
/**
 * Title: Grid of projects in three columns.
 * Slug: personal-website/projects-grid
 * Categories: posts
 * Block Types: core/query
 */
?>

<!-- wp:query {"queryId":2,"query":{"perPage":10,"pages":0,"offset":0,"postType":"jetpack-portfolio","order":"desc","orderBy":"meta_value_num","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[],"meta_query":{"queries":[{"id":"1068ab7a-c0fa-4f48-8074-1fc1035ea23c","meta_key":"project_year","meta_value":"","meta_compare":"NOT EXISTS","meta_type":"NUMERIC"},{"id":"3f382842-04b6-4d6a-9e72-e6f20f701d76","meta_key":"project_year","meta_value":"","meta_compare":"EXISTS","meta_type":"NUMERIC"}],"relation":"OR"}},"namespace":"advanced-query-loop"} -->
<div class="wp-block-query"><!-- wp:post-template {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"grid","columnCount":3}} -->
<!-- wp:post-featured-image {"isLink":true,"aspectRatio":"16/9"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|x-small","margin":{"top":"30px"}}}} -->
<div class="wp-block-group" style="margin-top:30px"><!-- wp:post-title {"isLink":true,"fontSize":"large"} /-->

<!-- wp:group {"style":{"spacing":{"blockGap":"5px","margin":{"top":"10px"}}},"fontSize":"x-small","layout":{"type":"flex"}} -->
<div class="wp-block-group has-x-small-font-size" style="margin-top:10px"><!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"small"} -->
<p class="has-small-font-size" style="text-transform:uppercase"><strong>Client</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"core/post-meta","args":{"key":"writepoetry_project_client"}}}},"style":{"spacing":{"margin":{"top":"0"}}},"textColor":"cyan-bluish-gray","fontSize":"small"} -->
<p class="has-cyan-bluish-gray-color has-text-color has-small-font-size" style="margin-top:0"></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"style":{"typography":{"textTransform":"uppercase"}},"fontSize":"small"} -->
<p class="has-small-font-size" style="text-transform:uppercase"><strong>Year</strong></p>
<!-- /wp:paragraph -->

<!-- wp:paragraph {"metadata":{"bindings":{"content":{"source":"acf/field","args":{"key":"project_year"}}}},"style":{"spacing":{"margin":{"top":"0"}}},"textColor":"cyan-bluish-gray","fontSize":"small"} -->
<p class="has-cyan-bluish-gray-color has-text-color has-small-font-size" style="margin-top:0"></p>
<!-- /wp:paragraph -->

<!-- wp:post-terms {"term":"jetpack-portfolio-type"} /-->

<!-- wp:post-terms {"term":"jetpack-portfolio-tag","prefix":"\u003cstrong\u003eActivities:\u003c/strong\u003e "} /--></div>
<!-- /wp:group -->

<!-- wp:read-more {"content":"View Details","fontSize":"small"} /--></div>
<!-- /wp:group -->
<!-- /wp:post-template -->

<!-- wp:query-pagination -->
<!-- wp:query-pagination-previous /-->

<!-- wp:query-pagination-numbers /-->

<!-- wp:query-pagination-next /-->
<!-- /wp:query-pagination -->

<!-- wp:query-no-results -->
<!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
<p></p>
<!-- /wp:paragraph -->
<!-- /wp:query-no-results --></div>
<!-- /wp:query -->




