import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';

import './editor.scss';

/**
 * Static preview — the real interactivity (store binding, keyboard nav) is
 * added server-side in render.php and driven by the resume/tabs store.
 */
export default function Edit() {
	const blockProps = useBlockProps( {
		className: 'resume-tab-switch',
		role: 'tablist',
	} );

	return (
		<div { ...blockProps }>
			<button
				type="button"
				role="tab"
				className="resume-tab-switch__tab"
				aria-selected="true"
			>
				{ __( 'Resume', 'resume-section' ) }
			</button>
			<button
				type="button"
				role="tab"
				className="resume-tab-switch__tab"
				aria-selected="false"
			>
				{ __( 'CV', 'resume-section' ) }
			</button>
		</div>
	);
}
