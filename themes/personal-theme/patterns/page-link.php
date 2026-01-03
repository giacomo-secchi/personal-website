<?php
/**
 * Title: Sample link page.
 * Slug: frost/page-link
 * Categories: frost-page
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"margin":{"top":"0px"},"padding":{"left":"0px","top":"var:preset|spacing|large","right":"0px","bottom":"var:preset|spacing|large"}},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
<div class="wp-block-group alignfull" style="min-height:100vh;margin-top:0px;padding-top:var(--wp--preset--spacing--large);padding-right:0px;padding-bottom:var(--wp--preset--spacing--large);padding-left:0px">
	<!-- wp:group {"layout":{"type":"constrained","wideSize":"600px"}} -->
	<div class="wp-block-group">
		<!-- wp:image {"align":"center","width":120,"height":120,"sizeSlug":"full","linkDestination":"none","className":"is-style-rounded"} -->
		<figure class="wp-block-image aligncenter size-full is-resized is-style-rounded"><img src="<?php echo get_avatar_url( 'giacomosecchi@gmail.com', array( 'size' => 120 ) ); ?>" alt="<?php echo esc_attr__( 'Giacomo Secchi', 'personal-website' ); ?>" width="120" height="120"/></figure>
		<!-- /wp:image -->
		<!-- wp:heading {"textAlign":"center","level":1,"className":"wp-block-heading","fontSize":"x-large",
		 "metadata":{
			"bindings":{
				"content":{
					"source":"personal-website/user-full-name"
				}
			}
		}  
		} -->
		<h1 class="wp-block-heading has-text-align-center has-x-large-font-size"></h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0"}}},
			"metadata":{
				"bindings":{
					"content":{
						"source":"personal-website/job-position"
					}
				}
			}  
		} -->
		<p class="has-text-align-center" style="margin-top:0"></p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"0"}},"elements":{"link":{"color":{"text":"var:preset|color|dark-gray"}}}},"textColor":"dark-gray","fontSize":"x-small",
			"metadata":{
				"bindings":{
					"content":{
						"source":"personal-website/experience-text"
					}
				}
			} 
		} -->
		<p class="has-text-align-center has-dark-gray-color has-text-color has-link-color has-x-small-font-size" style="margin-top:0"></p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph {"align":"center",
		 "metadata":{
				"bindings":{
					"content":{
						"source":"personal-website/user-email"
					}
				}
			}
		} -->
		<p class="has-text-align-center"></p>
		<!-- /wp:paragraph -->
		<!-- wp:social-links {"iconColor":"contrast","iconColorValue":"#1a1b41","openInNewTab":true,"size":"has-normal-icon-size","align":"center","className":"has-icon-base-color is-style-logos-only","style":{"spacing":{"blockGap":"10px","margin":{"bottom":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
		<ul class="wp-block-social-links aligncenter has-normal-icon-size has-icon-color has-icon-base-color is-style-logos-only" style="margin-bottom:var(--wp--preset--spacing--medium)">
			<!-- wp:social-link {"url":"https://www.linkedin.com/in/giacomosecchi/","service":"linkedin"} /-->
			<!-- wp:social-link {"url":"https://github.com/giacomo-secchi","service":"github"} /-->
			<!-- wp:social-link {"url":"https://x.com/gsecchidev","service":"x"} /-->
			<!-- wp:social-link {"url":"https://www.instagram.com/jackilsaltatore/","service":"instagram"} /-->
			<!-- wp:social-link {"url":"https://profiles.wordpress.org/giacomosecchi/","service":"wordpress"} /-->
		</ul>
		<!-- /wp:social-links -->
		<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center","orientation":"horizontal"},"style":{"spacing":{"blockGap":"10px","margin":{"bottom":"var:preset|spacing|small"}}}} -->
		<div class="wp-block-buttons" style="margin-bottom:var(--wp--preset--spacing--small)">
			<!-- wp:button {"width":75} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-75"><a class="wp-block-button__link" href="<?php echo esc_url( home_url( 'portfolio/' ) ); ?>"><?php echo esc_html__( 'View My Portfolio', 'personal-website' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"width":75} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-75"><a class="wp-block-button__link" href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"><?php echo esc_html__( 'Read My Blog', 'frost' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"width":75} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-75"><a class="wp-block-button__link" href="https://resume.giacomosecchi.com/" target="_blank" rel="noreferrer noopener"><?php echo esc_html__( 'Get My Resume', 'personal-website' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"width":75} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-75"><a class="wp-block-button__link" href="https://write-poetry.com/" target="_blank" rel="noreferrer noopener"><?php echo esc_html__( 'Contribute to My WordPress Project', 'frost' ); ?></a></div>
			<!-- /wp:button -->
			<!-- wp:button {"width":75} -->
			<div class="wp-block-button has-custom-width wp-block-button__width-75"><a class="wp-block-button__link" href="<?php echo esc_url( home_url( 'contact-me/' ) ); ?>"><?php echo esc_html__( 'Get in Touch', 'personal-website' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
		<!-- wp:paragraph {"align":"center","fontSize":"small"} -->
		<p class="has-text-align-center has-small-font-size"><a href="https://wordpress.org/themes/frost/"><?php echo esc_html__( 'Made with Frost', 'frost' ); ?></a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
