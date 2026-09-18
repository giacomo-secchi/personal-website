/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, ComboboxControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';
import metadata from './block.json';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
const ICON_OPTIONS = typeof window !== 'undefined' && Array.isArray( window.resumeIconChoices )
	? window.resumeIconChoices
	: [];

export default function Edit( { attributes, setAttributes } ) {
	const { fieldName, sectionIcon } = attributes;

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'resume-section' ) }>
					<TextControl
						label={ __( 'Repeater field name', 'resume-section' ) }
						help={ __( 'ACF repeater field on the profile options page, e.g. "skills" or "languages".', 'resume-section' ) }
						value={ fieldName }
						onChange={ ( newFieldName ) => setAttributes( { fieldName: newFieldName } ) }
					/>
					<ComboboxControl
						label={ __( 'Section icon', 'resume-section' ) }
						help={ __( 'Bootstrap icon shown before the section title.', 'resume-section' ) }
						value={ sectionIcon }
						options={ ICON_OPTIONS }
						onChange={ ( newIcon ) => setAttributes( { sectionIcon: newIcon || '' } ) }
						allowReset
					/>
				</PanelBody>
			</InspectorControls>
			<div { ...useBlockProps() }>
				<ServerSideRender block={ metadata.name } attributes={ attributes } />
			</div>
		</>
	);
}
