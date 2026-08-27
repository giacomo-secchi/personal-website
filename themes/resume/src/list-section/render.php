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
	$url    = $row['website_url'] ?? '';
	$detail = $row['detail'] ?? '';
	?>
	<?php if ( $url ) : ?>
		<a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noreferrer noopener"><?php echo esc_html( $text ); ?></a>
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
	<dt><?php echo esc_html( $field_object['label'] ?? '' ); ?></dt>

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
