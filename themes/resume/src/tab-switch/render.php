<?php
/**
 * Resume / CV switch.
 *
 * Each button writes its `view` into the `resume/tabs` Interactivity store
 * (defined in the resume/resume-section view module). resume/resume-section
 * entries read `activeView` to show or hide themselves.
 *
 * `aria-selected` / `tabindex` are set on hydration by the store bindings;
 * before that both tabs read as inactive for one frame (same as core/tabs).
 */

$options = resume_get_views();

if ( empty( $options ) ) {
	return;
}
?>
<div
	<?php echo get_block_wrapper_attributes( array( 'class' => 'resume-tab-switch', 'role' => 'tablist' ) ); ?>
	data-wp-interactive="resume/tabs"
	data-wp-on--keydown="actions.handleSwitchKeyDown"
>
	<?php foreach ( $options as $view => $label ) : ?>
		<button
			type="button"
			role="tab"
			class="resume-tab-switch__tab"
			data-view="<?php echo esc_attr( $view ); ?>"
			<?php echo wp_interactivity_data_wp_context( array( 'view' => $view ) ); ?>
			data-wp-on--click="actions.setView"
			data-wp-bind--aria-selected="state.isSelectedView"
			data-wp-bind--tabindex="state.selectedViewTabIndex"
		><?php echo esc_html( $label ); ?></button>
	<?php endforeach; ?>
</div>
