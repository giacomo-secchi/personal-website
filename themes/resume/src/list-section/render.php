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

$field_name   = $attributes['fieldName'];
$field_object = get_field_object( $field_name, 'option' );
$value        = get_field( $field_name, 'option' );

if ( ! $value ) {
	return;
}

$rows      = is_array( $value ) ? $value : array( array( $value ) );
$is_single = count( $rows ) === 1;

$render_item = function ( $row ) {
	$text   = reset( $row );
	$type   = $row['type'] ?? '';
	$detail = $row['detail'] ?? '';

	// A `type` subfield (Personal Informations) turns the value into the right link;
	// other list sections fall back to an explicit `website_url`.
	if ( 'email' === $type ) {
		$url = $text ? 'mailto:' . $text : '';
	} elseif ( 'phone' === $type ) {
		$url = $text ? 'tel:' . preg_replace( '/[^\d+]/', '', $text ) : '';
	} elseif ( 'url' === $type ) {
		$url = $text;
	} else {
		$url = $row['website_url'] ?? '';
	}
	?>
	<?php if ( $url ) : ?>
		<?php $is_external = (bool) preg_match( '#^https?://#i', $url ); ?>
		<a href="<?php echo esc_url( $url ); ?>"<?php echo $is_external ? ' target="_blank" rel="noreferrer noopener"' : ''; ?>><?php echo esc_html( $text ); ?></a>
	<?php else : ?>
		<?php echo esc_html( $text ); ?>
	<?php endif; ?>
	<?php if ( $detail ) : ?>
		— <?php echo esc_html( $detail ); ?>
	<?php endif; ?>
	<?php
};
?>
<dl <?php echo get_block_wrapper_attributes(); ?>>
	<dt><?php echo resume_render_section_icon( $attributes['sectionIcon'] ?? '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- trusted inline SVG. ?><?php echo esc_html( $field_object['label'] ?? '' ); ?></dt>

	<dd>
		<section id="<?php echo esc_attr( $field_name ); ?>">
			<?php if ( $is_single ) : ?>
				<?php $render_item( reset( $rows ) ); ?>
			<?php else : ?>
				<ul>
					<?php foreach ( $rows as $row ) : ?>
						<li><?php $render_item( $row ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</section>
	</dd>
</dl>
