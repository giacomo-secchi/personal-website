<?php
/**
 * Portfolio Filter block render.
 *
 * @package personal-website
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_interactivity_state( 'overlay', array(

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


	<div 
        class="popup-overlay" 
        data-wp-on--click="actions.closePopup"
        aria-hidden="true"
    ></div>
	
	

