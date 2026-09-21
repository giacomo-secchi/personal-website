/**
 * `resume/tabs` — front-end state for the CV / Resume switch.
 *
 * Store lives here (not in resume/tab-switch) because resume/resume-section
 * is always present on pages that use the switch.
 *
 * Active view is deep-linkable via `?view=`, synced with `history.pushState()`
 * (no reload); a legacy `#cv` / `#resume` hash is honoured once and upgraded.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-interactivity/
 */
import { store, getContext } from '@wordpress/interactivity';

const VIEW_PARAM = 'view';

// Shown when the URL names no (valid) view. Must match the first entry of
// resume_get_views() in inc/resume-views.php.
const DEFAULT_VIEW = 'cv';

// View slugs actually rendered as tabs on this page, in DOM order.
function renderedViews() {
	return [ ...document.querySelectorAll( '.resume-tab-switch__tab' ) ].map(
		( tab ) => tab.dataset.view
	);
}

// `?view=` wins, then a legacy `#cv` / `#resume` hash, then the first rendered tab.
function resolveView() {
	const views = renderedViews();
	const fallback = views[ 0 ] || DEFAULT_VIEW;

	const requested = new URLSearchParams( window.location.search ).get( VIEW_PARAM );
	if ( requested && views.includes( requested ) ) {
		return requested;
	}

	const hash = window.location.hash.replace( '#', '' );
	if ( views.includes( hash ) ) {
		return hash;
	}

	return fallback;
}

// Keeps `?view=` in sync with the active view; default view keeps the URL clean
// (matches the canonical). Other query params and the hash are left untouched.
function syncUrl( view, method = 'push' ) {
	const url = new URL( window.location.href );

	if ( view === DEFAULT_VIEW ) {
		url.searchParams.delete( VIEW_PARAM );
	} else {
		url.searchParams.set( VIEW_PARAM, view );
	}

	const next = url.pathname + url.search + url.hash;
	if ( next === window.location.pathname + window.location.search + window.location.hash ) {
		return;
	}

	window.history[ method === 'replace' ? 'replaceState' : 'pushState' ]( { view }, '', next );
}

// Drops a legacy `#cv` / `#resume` hash once read; a non-view hash is left alone.
function stripLegacyHash() {
	if ( renderedViews().includes( window.location.hash.replace( '#', '' ) ) ) {
		window.history.replaceState(
			window.history.state,
			'',
			window.location.pathname + window.location.search
		);
	}
}

const { state } = store( 'resume/tabs', {
	state: {
		activeView: DEFAULT_VIEW,

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
			if ( view && view !== state.activeView ) {
				state.activeView = view;
				syncUrl( view );
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

			const nextView = tabs[ next ].dataset.view;
			if ( nextView && nextView !== state.activeView ) {
				state.activeView = nextView;
				syncUrl( nextView );
			}
			tabs[ next ].focus();
		},
	},
} );

// Non-block wiring done once: resolve initial view, normalise the address bar,
// sync with back / forward, and turn the print button into a real PDF download.
function init() {
	state.activeView = resolveView();

	stripLegacyHash();
	syncUrl( state.activeView, 'replace' );

	window.addEventListener( 'popstate', () => {
		state.activeView = resolveView();
	} );

	const printButton = document.getElementById( 'resume-print-button' );
	if ( printButton ) {
		printButton.addEventListener( 'click', ( event ) => {
			event.preventDefault();
			const url = new URL( window.location.href );
			url.searchParams.set( 'format', 'pdf' );
			window.location.assign( url.toString() );
		} );
	}
}

if ( document.readyState === 'loading' ) {
	document.addEventListener( 'DOMContentLoaded', init );
} else {
	init();
}
