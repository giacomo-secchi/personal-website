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

// Newest first, by the entry's real-world date (see inc/resume-entries.php).
$items = resume_get_section_entries( $post_type );
?>
<dl <?php echo get_block_wrapper_attributes(); ?>>
	<dt><?php echo resume_render_section_icon( $attributes['sectionIcon'] ?? '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?><?php echo esc_html( $post_type_object->labels->name ); ?></dt>

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
				$start        = get_field( 'start_date', $item ) ?: get_field( 'start_year', $item );
				$end          = get_field( 'end_date', $item ) ?: get_field( 'end_year', $item );
				$single_date  = get_field( 'event_date', $item );
				$address      = get_field( 'address', $item );
				$website_url  = get_field( 'website_url', $item );
				$description  = $item->post_content;

				if ( $start ) {
					$time_text = $start . ' — ' . ( $end ? $end : 'Present' );
				} elseif ( $single_date ) {
					$time_text = $single_date;
				} else {
					$time_text = '';
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
