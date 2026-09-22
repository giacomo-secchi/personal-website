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
	ob_start();
	$type    = $row['type'] ?? null;
	$detail  = $row['detail'] ?? '';
	$tooltip = '';

	// A `type` subfield (Personal Informations) turns the value into the right link, with
	// dedicated `email`/`url` fields and an optional `link_text` override and `tooltip`;
	// other list sections fall back to a generic first subfield plus an explicit `website_url`.
	if ( null !== $type ) {
		$override = $row['link_text'] ?? '';
		$tooltip  = $row['tooltip'] ?? '';

		if ( 'url' === $type ) {
			$url     = $row['url'] ?? '';
			$default = $url ? preg_replace( '#^https?://#i', '', rtrim( $url, '/' ) ) : '';
		} elseif ( 'email' === $type ) {
			$default = $row['email'] ?? '';
			$url     = $default ? 'mailto:' . $default : '';
		} elseif ( 'phone' === $type ) {
			$default = $row['info'] ?? '';
			$url     = $default ? 'tel:' . preg_replace( '/[^\d+]/', '', $default ) : '';
		} else {
			$default = $row['info'] ?? '';
			$url     = '';
		}

		$text = '' !== $override ? $override : $default;
	} else {
		$text = reset( $row );
		$url  = $row['website_url'] ?? '';
	}
	?>
	<?php if ( $url ) : ?>
		<?php $is_external = (bool) preg_match( '#^https?://#i', $url ); ?>
		<a href="<?php echo esc_url( $url ); ?>"<?php echo $tooltip ? ' title="' . esc_attr( $tooltip ) . '"' : ''; ?><?php echo $is_external ? ' target="_blank" rel="noreferrer noopener"' : ''; ?>><?php echo esc_html( $text ); ?></a>
	<?php else : ?>
		<?php echo esc_html( $text ); ?>
	<?php endif; ?>
	<?php if ( $detail ) : ?>
		: <?php echo esc_html( $detail ); ?>
	<?php endif; ?>
	<?php
	return ob_get_clean();
};

// Rendered through core/list + core/list-item (rather than plain <ul><li>) so the
// listing stays block-compliant and inherits the theme.json list styling/supports.
// `bulletStyle` (set per block instance, e.g. from patterns/hidden-home.php) applies the
// matching core/list-item style — see inc/block-styles.php — to every item in the list.
$list_markup = '';
if ( ! $is_single ) {
	$li_class = ! empty( $attributes['bulletStyle'] ) ? ' class="is-style-' . esc_attr( $attributes['bulletStyle'] ) . '"' : '';

	$items = '';
	foreach ( $rows as $row ) {
		$items .= '<!-- wp:list-item --><li' . $li_class . '>' . $render_item( $row ) . '</li><!-- /wp:list-item -->';
	}
	$list_markup = do_blocks( '<!-- wp:list --><ul class="wp-block-list">' . $items . '</ul><!-- /wp:list -->' );
}
?>
<dl <?php echo get_block_wrapper_attributes(); ?>>
	<dt class="resume-subtitle"><?php echo $section_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- rendered by core/icon. ?><?php echo esc_html( $field_object['label'] ?? '' ); ?></dt>

	<dd>
		<section id="<?php echo esc_attr( $field_name ); ?>">
			<?php if ( $is_single ) : ?>
				<?php echo $render_item( reset( $rows ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped field by field above. ?>
			<?php else : ?>
				<?php echo $list_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- built from do_blocks() + already-escaped item markup above. ?>
			<?php endif; ?>
		</section>
	</dd>
</dl>
