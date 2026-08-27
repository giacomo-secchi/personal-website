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
import { PanelBody, TextControl } from '@wordpress/components';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { fieldName } = attributes;

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
				</PanelBody>
			</InspectorControls>
			<p { ...useBlockProps() }>
				{ __( 'List Section – reads a repeater from the profile options page.', 'resume-section' ) }
			</p>
		</>
	);
}
