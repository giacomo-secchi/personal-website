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
		<!-- wp:heading {"textAlign":"center","style":{"typography":{"letterSpacing":"-1px"}},"className":"wp-block-heading","fontSize":"max-60"} -->
		<h2 class="wp-block-heading has-text-align-center has-max-60-font-size" id="text-on-left-image-on-right" style="letter-spacing:-1px"><?php echo esc_html__( 'Methodology', 'personal-website' ); ?></h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.5"}} -->
		<p class="has-text-align-center" style="line-height:1.5"><?php echo wp_kses( __( 'A strategic <strong>4-stage workflow</strong> designed to transform<br>complex ideas into <strong>digital solutions</strong>.', 'personal-website' ) , array( 'strong' => array(), 'br' => array() ) ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
	<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"0","left":"0"},"margin":{"top":"var:preset|spacing|medium"}}}} -->
	<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--medium)">
		<!-- wp:column {"width":"25%","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","right":"var:preset|spacing|small","bottom":"var:preset|spacing|small","left":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"white"} -->
		<div class="wp-block-column has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--small);flex-basis:25%">
			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1","fontStyle":"normal","fontWeight":"400"}},"fontSize":"max-60"} -->
			<p class="has-max-60-font-size" style="font-style:normal;font-weight:400;line-height:1">01</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}},"className":"wp-block-heading","fontSize":"small"} -->
			<h3 class="wp-block-heading has-small-font-size" style="text-transform:uppercase"><?php echo esc_html__( 'Discovery', 'frost' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
			<p class="has-small-font-size" style="line-height:1.5"><?php echo esc_html__( 'Identifying business goals and user needs to build a solid strategic foundation.', 'frost' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"fontSize":"small"} -->
			<p class="has-small-font-size"><a href="#features"><?php echo esc_html__( 'Learn More →', 'frost' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","right":"var:preset|spacing|small","bottom":"var:preset|spacing|small","left":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"primary","textColor":"base"} -->
		<div class="wp-block-column has-base-color has-primary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--small);flex-basis:25%">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"1"}},"fontSize":"max-60"} -->
			<p class="has-max-60-font-size" style="font-style:normal;font-weight:400;line-height:1">02</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}},"className":"wp-block-heading","textColor":"base","fontSize":"small"} -->
			<h3 class="wp-block-heading  has-base-color has-text-color has-small-font-size" style="text-transform:uppercase"><?php echo esc_html__( 'Design', 'frost' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
			<p class="has-small-font-size" style="line-height:1.5"><?php echo esc_html__( 'Creating intuitive interfaces and engaging user experiences through modern visual aesthetics.', 'personal-webiste' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"fontSize":"small"} -->
			<p class="has-link-color has-small-font-size"><a href="#"><?php echo esc_html__( 'Learn More →', 'frost' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","right":"var:preset|spacing|small","bottom":"var:preset|spacing|small","left":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"secondary","textColor":"base"} -->
		<div class="wp-block-column has-base-color has-secondary-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--small);flex-basis:25%">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"1"}},"textColor":"white","fontSize":"max-60"} -->
			<p class="has-white-color has-text-color has-max-60-font-size" style="font-style:normal;font-weight:400;line-height:1">03</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}},"className":"wp-block-heading","textColor":"contrast","fontSize":"small"} -->
			<h3 class="wp-block-heading has-contrast-color has-text-color has-small-font-size" style="text-transform:uppercase"><?php echo esc_html__( 'Development', 'frost' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"textColor":"contrast","fontSize":"small"} -->
			<p class="has-small-font-size has-contrast-color has-text-color" style="line-height:1.5"><?php echo esc_html__( 'Building scalable, high-performance solutions using clean code and the latest technologies.', 'personal-website' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}},"fontSize":"small"} -->
			<p class="has-link-color has-small-font-size"><a href="#"><?php echo esc_html__( 'Learn More →', 'frost' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
		<!-- wp:column {"width":"25%","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","right":"var:preset|spacing|small","bottom":"var:preset|spacing|small","left":"var:preset|spacing|small"},"blockGap":"var:preset|spacing|x-small"}},"backgroundColor":"contrast","textColor":"base"} -->
		<div class="wp-block-column has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--small);padding-right:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small);padding-left:var(--wp--preset--spacing--small);flex-basis:25%">
			<!-- wp:paragraph {"style":{"typography":{"fontStyle":"normal","fontWeight":"400","lineHeight":"1"}},"textColor":"tertiary","fontSize":"max-60"} -->
			<p class="has-tertiary-color has-text-color has-max-60-font-size" style="font-style:normal;font-weight:400;line-height:1">04</p>
			<!-- /wp:paragraph -->
			<!-- wp:heading {"level":3,"style":{"typography":{"textTransform":"uppercase"}},"className":"wp-block-heading","fontSize":"small"} -->
			<h3 class="wp-block-heading has-small-font-size" style="text-transform:uppercase"><?php echo esc_html__( 'Maintenance', 'personal-website' ); ?></h3>
			<!-- /wp:heading -->
			<!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"fontSize":"small"} -->
			<p class="has-small-font-size" style="line-height:1.5"><?php echo esc_html__( 'Ensuring long-term stability through continuous updates, security checks, and performance optimization.', 'personal-website' ); ?></p>
			<!-- /wp:paragraph -->
			<!-- wp:paragraph {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"fontSize":"small"} -->
			<p class="has-link-color has-small-font-size"><a href="#"><?php echo esc_html__( 'Learn More →', 'frost' ); ?></a></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large","right":"30px","left":"30px"},"margin":{"top":"0"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0;padding-top:var(--wp--preset--spacing--x-large);padding-right:30px;padding-bottom:var(--wp--preset--spacing--x-large);padding-left:30px">
	<!-- wp:group {"align":"center","style":{"spacing":{"blockGap":"10px"}},"layout":{"type":"default"}} -->
	<div class="wp-block-group has-text-align-center">
		<!-- wp:query-title {"type":"archive","textAlign":"center","style":{"typography":{"letterSpacing":"-1px"}},"level":2,"showPrefix":false,"fontSize":"max-60"} /-->
		<!-- wp:categories {"taxonomy":"jetpack-portfolio-type","className":"is-style-comma-list","style":{"spacing":{"padding":{"left":"0"},"margin":{"bottom":"var:preset|spacing|medium"}}}} /-->
	</div>
	<!-- /wp:group -->
	<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:pattern {"slug":"frost/portfolio"} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
