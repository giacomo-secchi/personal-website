<?php
/**
 * Title: Sample about page.
 * Slug: frost/page-portfolio
 * Categories: frost-page
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","right":"30px","left":"30px"},"margin":{"top":"0"}}},"layout":{"type":"constrained","wideSize":"1200px"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px">
	<!-- wp:group {"layout":{"type":"constrained"}} -->
	<div class="wp-block-group">
		<!-- wp:query-title {"type":"archive","textAlign":"center","style":{"typography":{"letterSpacing":"-1px"}},"level":2,"showPrefix":false,"fontSize":"max-60"} /-->
		<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}},
		 "metadata":{
				"bindings":{
					"content":{
						"source":"personal-website/experience-text"
					}
				}
			}
		} -->
		<p class="has-text-align-center" style="line-height:1.5"><?php echo esc_html__( 'With its clean, minimal design and powerful feature set, Frost enables agencies to build stylish and sophisticated WordPress websites.', 'frost' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"bottom":"var:preset|spacing|x-large","right":"30px","left":"30px"},"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px">
	<!-- wp:group {"align":"wide","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"contrast","textColor":"base","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide has-base-color has-contrast-background-color has-text-color has-background has-link-color">
				<!-- wp:categories {"taxonomy":"jetpack-portfolio-type"} /-->

		<!-- wp:pattern {"slug":"personal-website/projects-grid"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->





