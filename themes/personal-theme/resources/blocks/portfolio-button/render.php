<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$post_id = $block->context['postId'] ?? 0;
 

if ( ! $post_id ) {
    return '';
}
 
ob_start();
?>

 
<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a href="<?php the_permalink(); ?>" class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'View Project', 'frost' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons -->
				 

<?php 
 

$block_content = do_blocks( ob_get_clean() );

$processor = new WP_HTML_Tag_Processor( $block_content );

while ( $processor->next_tag( 'a' ) ) {
 
	if ( $post_id ) {
		$processor->set_attribute( 'data-wp-interactive', 'popup' );
		$processor->set_attribute( 'data-wp-context', wp_json_encode( array( 'postId' => (int) $post_id ) ) );
		$processor->set_attribute( 'data-wp-on--click', 'actions.openPopup' );
	}
 
}

echo $processor->get_updated_html(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
