<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


 
if (
    ! is_post_type_archive( 'jetpack-portfolio' ) &&
    ! is_tax( 'jetpack-portfolio-type' ) &&
    ! is_tax( 'jetpack-portfolio-tag' ) &&
    ! is_page( 'portfolio' )
) {
    return;
}

// Calculates years of experience based on the admin's 'start_year' meta field and prepares the experience text.
$user = get_personal_website_admin_user();
if ( $user ) {
    $since = (int) get_user_meta( $user->ID, 'start_year', true );
    if ( $since ) {
        $years = (int) date( 'Y' ) - $since;

        $template = get_user_meta(
            $user->ID,
            'portfolio_experience_text',
            true
        );

        $html = sprintf(
            '<p>%s</p>',
            esc_html( sprintf( $template, $years ) ) );
    }
}


 
$content = <<<HTML
    <!-- wp:categories {"taxonomy":"jetpack-portfolio-type","className":"is-style-comma-list","style":{"spacing":{"padding":{"left":"0"},"margin":{"bottom":"var:preset|spacing|medium"}}}} /-->
HTML;



// Process the block content to add attributes to the category links.
$terms = get_terms( array(
    'taxonomy' => 'jetpack-portfolio-type',
    'hide_empty' => false,
) );
   
$term_map = [];
foreach ( $terms as $term ) {
    $term_map[ get_term_link( $term ) ] = $term->term_id;
}
 
$processor = new WP_HTML_Tag_Processor( do_blocks( $content ) );

while ( $processor->next_tag( 'a' ) ) {
    $href = $processor->get_attribute( 'href' );
    if ( isset( $term_map[ $href ] ) ) {
        $id = $term_map[ $href ];
        $processor->set_attribute( 'data-wp-context', wp_json_encode( array( 'catId' => $id ) ) );
        $processor->set_attribute( 'data-wp-on--click', 'actions.updateFilter' );
        $processor->set_attribute( 'data-wp-class--current-cat', 'state.isCategoryActive' );
    }
}

$html .= $processor->get_updated_html();




$unique_id = wp_unique_id( 'p-' );
$current_cat_id = is_tax( 'jetpack-portfolio-type') ? get_queried_object_id() : 0;

// Populates the initial global state values.
wp_interactivity_state( 'portfolioApp', array(
    'isLoading'        => false,
    'currentCategoryId' => $current_cat_id
) );

$context = array(
	'id'     => $unique_id,
    'portfolioUrl' => get_post_type_archive_link( 'jetpack-portfolio' ),
);

$wrapper_attributes = get_block_wrapper_attributes( array(
    'data-wp-interactive' => 'portfolioApp',
) );
?>

<div <?php echo $wrapper_attributes; ?>
    <?php echo wp_interactivity_data_wp_context( $context ); ?> 
>
	<?php echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>

