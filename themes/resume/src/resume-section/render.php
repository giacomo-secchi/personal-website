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
	<dt class="resume-subtitle"><?php echo $section_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered by core/icon. ?><?php echo esc_html( $post_type_object->labels->name ); ?></dt>

	<dd>
		<section id="<?php echo esc_attr( $post_type ); ?>" data-wp-interactive="resume/tabs">
			<?php foreach ( $items as $item ) : ?>
				<?php
				$views = get_field( 'resume_visibility', $item->ID );
				if ( empty( $views ) ) {
					$views = array( 'resume', 'cv' );
				}

				// `company_name` is a Link field (name + optional URL) shared by every post
				// type (employer, school, client, event/publication venue...): the org line
				// renders as plain text when no URL is set, as a link when one is, and falls
				// back to the bare URL (protocol stripped) when only a URL was given.
				$organization = get_field( 'company_name', $item );
				$org_name     = $organization['title'] ?? '';
				$org_url      = $organization['url'] ?? '';
				$org_target   = $organization['target'] ?? '';
				$org_text     = $org_name ? $org_name : ( $org_url ? preg_replace( '#^https?://#', '', untrailingslashit( $org_url ) ) : '' );
				$summary      = has_excerpt( $item ) ? get_the_excerpt( $item ) : '';
				$start        = $format_entry_date( get_field( 'start_date', $item, false ) );
				$end          = $format_entry_date( get_field( 'end_date', $item, false ) );
				$address      = get_field( 'address', $item );
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
					<h3 class="resume-entry__title"><?php echo esc_html( get_the_title( $item ) ); ?></h3>

					<?php if ( $org_text ) : ?>
						<p class="resume-entry__org">
							<?php if ( $org_url ) : ?>
								<a href="<?php echo esc_url( $org_url ); ?>"<?php echo $org_target ? ' target="' . esc_attr( $org_target ) . '" rel="noreferrer noopener"' : ''; ?>><?php echo esc_html( $org_text ); ?></a>
							<?php else : ?>
								<?php echo esc_html( $org_text ); ?>
							<?php endif; ?>
						</p>
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
				</div>
			<?php endforeach; ?>
		</section>
	</dd>
</dl>
