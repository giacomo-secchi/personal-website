<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_interactivity_state( 'popup', array(
    'isPopupOpen' => false,
	'currentTitle'   => '',
    'currentContent' => '',
) );

$wrapper_attributes = get_block_wrapper_attributes( array(
    'role'                => 'dialog',
    'aria-modal'          => 'true',
	'aria-labelledby'     => 'popup-main-title',
    'data-wp-interactive' => 'popup',
	'data-wp-bind--aria-hidden' => '!state.isPopupOpen',
	'data-wp-bind--hidden' => '!state.isPopupOpen',

) );
?>

<div <?php echo $wrapper_attributes; ?>>
	<button 
			type="button" 
			class="popup-close" 
			aria-label="<?php echo esc_html__( 'Chiudi popup', 'portfolio' ); ?>"
			data-wp-on--click="actions.closePopup"
		>
			<span aria-hidden="true">×</span>
	</button>

	<h2 id="popup-main-title" data-wp-text="state.currentTitle">
		<?php esc_html_e( 'Dettagli Progetto', 'portfolio' ); ?>
	</h2>
	<div data-wp-watch="callbacks.renderContent"></div>
</div>








