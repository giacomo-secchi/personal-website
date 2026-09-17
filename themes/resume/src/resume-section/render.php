<?php
/**
 * PHP file to use when rendering the block type on the server to show on the front end.
 *
 * The following variables are exposed to the file:
 *     $attributes (array): The block attributes.
 *     $content (string): The block default content.
 *     $block (WP_Block): The block instance.
 *
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */

$post_type        = $attributes['postType'];
$post_type_object = get_post_type_object( $post_type );

// Icon before the section title, tinted with the theme's `contrast` preset.
$section_icon = '';
if ( ! empty( $attributes['sectionIcon'] ) ) {
	$section_icon = do_blocks( '<!-- wp:icon ' . wp_json_encode( array(
		'icon'      => $attributes['sectionIcon'],
		'className' => 'resume-icon',
		'style'     => array( 'color' => array( 'text' => 'var:preset|color|contrast' ) ),
	) ) . ' /-->' );
}

// Newest first by Start Date; a non-zero menu_order (Page Attributes → Order) still pins.
$items = get_posts( array(
	'post_type'      => $post_type,
	'posts_per_page' => -1,
	'meta_key'       => 'start_date',
	'orderby'        => array( 'menu_order' => 'ASC', 'meta_value_num' => 'DESC' ),
) );

// start_date / end_date are date_picker fields (raw 'Ymd'). Each section shows the
// precision it needs: the day for talks/papers, the year for study, month + year otherwise.
$entry_date_formats = array(
	'event_presentation' => 'j F Y',
	'publication'        => 'j F Y',
	'education'          => 'Y',
);
$entry_date_format = isset( $entry_date_formats[ $post_type ] ) ? $entry_date_formats[ $post_type ] : 'F Y';

// For these an empty End Date means "still ongoing" ("— Present"); elsewhere a
// missing End Date is just a single date (talks, papers, one-off projects).
$present_label_types = array( 'experience', 'internship', 'education' );

$format_entry_date = static function ( $ymd ) use ( $entry_date_format ) {
	$date = $ymd ? DateTimeImmutable::createFromFormat( 'Ymd', $ymd ) : false;
	return $date ? $date->format( $entry_date_format ) : ''; // English month names, as before; TranslatePress localises the output.
};
?>
<dl <?php echo get_block_wrapper_attributes(); ?>>
	<dt><?php echo $section_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered by core/icon. ?><?php echo esc_html( $post_type_object->labels->name ); ?></dt>

	<dd>
		<section id="<?php echo esc_attr( $post_type ); ?>" data-wp-interactive="resume/tabs">
			<?php foreach ( $items as $item ) : ?>
				<?php
				$views = get_field( 'resume_visibility', $item->ID );
				if ( empty( $views ) ) {
					$views = array( 'resume', 'cv' );
				}

				$organization = get_field( 'company_name', $item );
				$summary      = has_excerpt( $item ) ? get_the_excerpt( $item ) : '';
				$start        = $format_entry_date( get_field( 'start_date', $item, false ) );
				$end          = $format_entry_date( get_field( 'end_date', $item, false ) );
				$address      = get_field( 'address', $item );
				$website_url  = get_field( 'website_url', $item );
				$description  = $item->post_content;

				if ( ! $start ) {
					$time_text = '';
				} elseif ( $end ) {
					$time_text = $start . ' — ' . $end;
				} elseif ( in_array( $post_type, $present_label_types, true ) ) {
					$time_text = $start . ' — Present';
				} else {
					$time_text = $start;
				}
				?>
				<div
					class="resume-entry"
					<?php echo wp_interactivity_data_wp_context( array( 'views' => array_values( $views ) ) ); ?>
					data-wp-bind--hidden="state.isEntryHidden"
				>
					<h3><?php echo esc_html( get_the_title( $item ) ); ?></h3>

					<?php if ( $organization ) : ?>
						<p class="resume-entry__org"><?php echo esc_html( $organization ); ?></p>
					<?php endif; ?>

					<?php if ( $summary ) : ?>
						<p class="resume-entry__summary"><?php echo esc_html( $summary ); ?></p>
					<?php endif; ?>

					<?php if ( $time_text ) : ?>
						<p class="resume-entry__time"><?php echo esc_html( $time_text ); ?></p>
					<?php endif; ?>

					<?php if ( $address ) : ?>
						<p class="resume-entry__address">
							<?php
							echo esc_html( implode( ', ', array_filter( array(
								$address['street_address'] ?? '',
								$address['address_locality'] ?? '',
								$address['address_region'] ?? '',
								$address['postal_code'] ?? '',
								$address['address_country'] ?? '',
							) ) ) );
							?>
						</p>
					<?php endif; ?>

					<?php if ( $description ) : ?>
						<div class="resume-entry__description">
							<?php echo apply_filters( 'the_content', $description ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php endif; ?>

					<?php if ( $website_url ) : ?>
						<p class="resume-entry__link">
							<a href="<?php echo esc_url( $website_url ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( preg_replace( '#^https?://#', '', untrailingslashit( $website_url ) ) ); ?></a>
						</p>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</section>
	</dd>
</dl>
