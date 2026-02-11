<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


 
add_filter( 'render_block_core/categories', function( $block_content, $block ) {
    if (
        ! is_post_type_archive( 'jetpack-portfolio' ) &&
        ! is_tax( 'jetpack-portfolio-type' ) &&
        ! is_tax( 'jetpack-portfolio-tag' ) &&
        ! is_page( 'portfolio' )
    ) {
        
        return $block_content;
    }

    if (
        empty( $block['attrs']['taxonomy'] ) ||
        $block['attrs']['taxonomy'] !== 'jetpack-portfolio-type'
    ) {
        return $block_content;
    }

    $terms = get_terms( array(
        'taxonomy' => 'jetpack-portfolio-type',
        'hide_empty' => false,
    ) );

    $term_map = [];
    foreach ( $terms as $term ) {
        $term_map[ get_term_link( $term ) ] = $term->term_id;
    }

    $processor = new WP_HTML_Tag_Processor( $block_content );
    

    while ( $processor->next_tag( 'a' ) ) {
        $href = $processor->get_attribute( 'href' );

        if ( isset( $term_map[ $href ] ) ) {
            $id = $term_map[ $href ];
            $processor->set_attribute( 'data-wp-context', wp_json_encode( array( 'catId' => $id ) ) );
            $processor->set_attribute( 'data-wp-on--click', 'actions.updateFilter' );
            $processor->set_attribute( 'data-wp-class--is-active', 'state.isCategoryActive' );
        }
    }

    $block_content = $processor->get_updated_html();

 
    

    $user = get_personal_website_admin_user();
    if ( ! $user ) {
        return $block_content;
    }

    $since = (int) get_user_meta( $user->ID, 'start_year', true );
    if ( ! $since ) {
        return $block_content;
    }

    $years = (int) date( 'Y' ) - $since;

    $template = get_user_meta(
        $user->ID,
        'portfolio_experience_text',
        true
    );

    if ( empty( $template ) ) {
        return $block_content;
    }

    return sprintf(
        '<p>%s</p>%s',
        esc_html( sprintf( $template, $years ) ),
        $block_content
    );
}, 10, 2 );
				

$unique_id = wp_unique_id( 'p-' );	 

// Populates the initial global state values.
wp_interactivity_state( 'portfolioApp', array(
    'isLoading'        => false,
    'currentCategoryId' => 0,
) );

$context = array(
	'id'     => $unique_id,
    'portfolioUrl' => get_post_type_archive_link( 'jetpack-portfolio' ),
);
 
$content = <<<HTML
    <!-- wp:categories {"taxonomy":"jetpack-portfolio-type","className":"is-style-comma-list","style":{"spacing":{"padding":{"left":"0"},"margin":{"bottom":"var:preset|spacing|medium"}}}} /-->
HTML;
?>

<div 
    data-wp-interactive="portfolioApp"
    <?php echo wp_interactivity_data_wp_context( $context ); ?>
    <?php echo get_block_wrapper_attributes( array( 'class' => 'portfolio-filter' ) ); ?> 
>
	<?php echo do_blocks( $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>

