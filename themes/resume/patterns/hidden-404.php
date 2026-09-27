<?php
/**
 * Title: 404
 * Slug: resume/hidden-404
 * Inserter: no
 *
 */

?>
<!-- wp:group {"style":{"shadow":"var:preset|shadow|small","spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|70","right":"var:preset|spacing|70"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--70);box-shadow:var(--wp--preset--shadow--small)">
	<!-- wp:group {"layout":{"type":"default"}} -->
	<div class="wp-block-group">
		<!-- wp:heading {"level":1} -->
		<h1 class="wp-block-heading">
			<?php echo esc_html_x( 'Page not found', '404 error message', 'resume' ); ?>
		</h1>
		<!-- /wp:heading -->
		<!-- wp:paragraph -->
		<p><?php echo esc_html_x( 'The page you are looking for doesn\'t exist, or it has been moved.', '404 error message', 'resume' ); ?></p>
		<!-- /wp:paragraph -->
		<!-- wp:buttons -->
		<div class="wp-block-buttons">
			<!-- wp:button -->
			<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__( 'Read the resume', 'resume' ); ?></a></div>
			<!-- /wp:button -->
		</div>
		<!-- /wp:buttons -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
