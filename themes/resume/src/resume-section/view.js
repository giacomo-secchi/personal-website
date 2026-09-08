/**
 * `resume/tabs` — front-end state for the Resume / CV switch.
 *
 * Writer:  resume/tab-switch buttons (data-wp-on--click / --keydown).
 * Readers: resume/resume-section entries (data-wp-bind--hidden), and the
 *          switch buttons themselves (aria-selected / tabindex).
 *
 * The store lives here because resume/resume-section is always present on the
 * page that uses the switch; resume/tab-switch carries no view module of its own.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-interactivity/
 */
import { store, getContext } from '@wordpress/interactivity';

const { state } = store( 'resume/tabs', {
	state: {
		activeView: 'resume',

		// --- read by resume/tab-switch buttons (each has context { view } ) ---
		get isSelectedView() {
			return getContext().view === state.activeView;
		},
		get selectedViewTabIndex() {
			return state.isSelectedView ? 0 : -1;
		},

		// --- read by resume/resume-section entries (context { views: [...] }) ---
		get isEntryHidden() {
			const { views } = getContext();
			if ( ! views || ! views.length ) {
				return false;
			}
			return ! views.includes( state.activeView );
		},
	},
	actions: {
		setView() {
			const { view } = getContext();
			if ( view ) {
				state.activeView = view;
			}
		},
		handleSwitchKeyDown( event ) {
			const moves = { ArrowLeft: -1, ArrowRight: 1, Home: 'first', End: 'last' };
			if ( ! ( event.key in moves ) ) {
				return;
			}
			event.preventDefault();

			const tabs = [
				...event.target
					.closest( '.resume-tab-switch' )
					.querySelectorAll( '.resume-tab-switch__tab' ),
			];
			const current = tabs.indexOf( event.target );
			const move = moves[ event.key ];

			let next;
			if ( move === 'first' ) {
				next = 0;
			} else if ( move === 'last' ) {
				next = tabs.length - 1;
			} else {
				next = ( current + move + tabs.length ) % tabs.length;
			}

			state.activeView = tabs[ next ].dataset.view;
			tabs[ next ].focus();
		},
	},
} );

/**
 * Non-block wiring done imperatively once: pick the initial view (deep-link hash
 * if it matches a rendered tab, otherwise the first tab), and turn the pattern's
 * print button into window.print().
 */
function init() {
	const views = [ ...document.querySelectorAll( '.resume-tab-switch__tab' ) ].map(
		( tab ) => tab.dataset.view
	);
	const hash = window.location.hash.replace( '#', '' );

	if ( views.includes( hash ) ) {
		state.activeView = hash;
	} else if ( views.length && ! views.includes( state.activeView ) ) {
		state.activeView = views[ 0 ];
	}

	const printButton = document.getElementById( 'resume-print-button' );
	if ( printButton ) {
		printButton.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			window.print();
		} );
	}
}

if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', init );
} else {
	init();
}
