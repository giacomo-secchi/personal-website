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

// Icon before the section title, tinted with the theme's `contrast` preset.
$section_icon = '';
if ( ! empty( $attributes['sectionIcon'] ) ) {
	$section_icon = do_blocks( '<!-- wp:icon ' . wp_json_encode( array(
		'icon'      => $attributes['sectionIcon'],
		'className' => 'resume-icon',
		'style'     => array( 'color' => array( 'text' => 'var:preset|color|contrast' ) ),
	) ) . ' /-->' );
}

$render_item = function ( $row ) {
	$type   = $row['type'] ?? null;
	$detail = $row['detail'] ?? '';

	// A `type` subfield (Personal Informations) turns the value into the right link, with a
	// dedicated `url` field for the Website URL case; other list sections fall back to a
	// generic first subfield plus an optional explicit `website_url`.
	if ( null !== $type ) {
		if ( 'url' === $type ) {
			$url  = $row['url'] ?? '';
			$text = $url ? preg_replace( '#^https?://#i', '', rtrim( $url, '/' ) ) : '';
		} elseif ( 'email' === $type ) {
			$text = $row['info'] ?? '';
			$url  = $text ? 'mailto:' . $text : '';
		} elseif ( 'phone' === $type ) {
			$text = $row['info'] ?? '';
			$url  = $text ? 'tel:' . preg_replace( '/[^\d+]/', '', $text ) : '';
		} else {
			$text = $row['info'] ?? '';
			$url  = '';
		}
	} else {
		$text = reset( $row );
		$url  = $row['website_url'] ?? '';
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
	<dt><?php echo $section_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered by core/icon. ?><?php echo esc_html( $field_object['label'] ?? '' ); ?></dt>

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
