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
import { PanelBody, SelectControl, ComboboxControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
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
const ICON_OPTIONS = typeof window !== 'undefined' && Array.isArray( window.resumeBootstrapIcons )
	? window.resumeBootstrapIcons
	: [];

export default function Edit( { attributes, setAttributes } ) {
	const { postType, sectionIcon } = attributes;

	const postTypeOptions = useSelect( ( select ) => {
		const types = select( coreStore ).getPostTypes( { per_page: -1 } ) || [];
		return types
			.filter( ( type ) => type.viewable && type.slug !== 'attachment' )
			.map( ( type ) => ( { label: type.name, value: type.slug } ) );
	}, [] );

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings', 'resume-section' ) }>
					<SelectControl
						label={ __( 'Post type', 'resume-section' ) }
						value={ postType }
						options={ postTypeOptions }
						onChange={ ( newPostType ) => setAttributes( { postType: newPostType } ) }
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
