<?php
/**
 * Title: Header with site title, navigation.
 * Slug: frost/header-default
 * Categories: header
 * Block Types: core/template-part/header
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"30px","bottom":"30px","left":"30px","right":"30px"},"margin":{"top":"0px"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="margin-top:0px;padding-top:30px;padding-right:30px;padding-bottom:30px;padding-left:30px">
	<!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
	<div class="wp-block-group alignwide">
		<!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
		<div class="wp-block-group">
			<!-- wp:image {"width":40,"height":40,"sizeSlug":"full","linkDestination":"custom"} -->
			<figure class="wp-block-image size-full is-resized"><a href="/"><img src="<?php echo esc_url( get_stylesheet_directory_uri() ) . '/assets/images/giacomo-secchi-logo-inverted.svg'; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="40" height="40"/></a></figure>
			<!-- /wp:image -->
			<!-- wp:site-title /-->
		</div>
		<!-- /wp:group -->
		<?php
			$blog_page = get_page_by_path( 'blog' );
			$blog_id   = $blog_page ? $blog_page->ID : '';
			$blog_url  = get_permalink( $blog_id ) ?: home_url( '/blog/' );
		?>
		<!-- wp:navigation {"layout":{"type":"flex","setCascadingProperties":true,"ariaLabel":"<?php esc_attr_e( 'Main Menu', 'personal-website' ); ?>"} -->
			<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Blog', 'personal-website' ); ?>","type":"page","id":<?php echo $blog_id ?>,"url":"<?php echo esc_url( $blog_url ); ?>","kind":"post-type"} /-->
			<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Portfolio', 'personal-website' ); ?>","type":"portfolio","url":"<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>","kind":"post-type"} /-->
			<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Resume', 'personal-website' ); ?>","opensInNewTab":true,"url":"https://resume.giacomosecchi.com/","kind":"custom"} /-->
			<!-- wp:navigation-link {"label":"<?php esc_html_e( 'WritePoetry', 'personal-website' ); ?>","opensInNewTab":true,"url":"https://write-poetry.com/","kind":"custom"} /-->
			<!-- wp:navigation-link {"label":"<?php esc_html_e( 'Get in Touch', 'personal-website' ); ?>","type":"custom","url":"<?php echo esc_url( home_url( 'contact-me/' ) ); ?>","kind":"post-type","isTopLevelLink":true} /-->
		<!-- /wp:navigation -->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->



