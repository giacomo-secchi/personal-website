/**
 * WordPress dependencies
 */
import { store, getContext, getElement, withSyncEvent } from '@wordpress/interactivity';

store( 'portfolioApp', {
    state: {
        currentCategoryId: 0,
        isLoading: false,
        get isCategoryActive() {
            const { catId } = getContext();
            return store( 'portfolioApp' ).state.currentCategoryId === catId;
        }
    },
    actions: {
        // The withSyncEvent() utility needs to be used because preventDefault() requires synchronous event access.
        updateFilter: withSyncEvent( function* ( event ) {
            event.preventDefault();

            const context = getContext();
            const state = store( 'portfolioApp' ).state;
            let targetUrl = event.target.href;

            state.isLoading = true;
 
            // if the clicked category is already active, reset the filter by setting the current category ID to 0 and navigating to the main portfolio URL.
            if (state.currentCategoryId === context.catId) {
                state.currentCategoryId = 0;
                targetUrl = context.portfolioUrl;

            } else {
                // Set the current category ID in the state, so it can be used by other components if needed.
                state.currentCategoryId = context.catId;
            }

            if ( ! targetUrl ) {
                return;
            }

            // We import the package dynamically to reduce the initial JS bundle size.
            // Async actions are defined as generators so the import() must be called with `yield`.
            const { actions } = yield import(
                '@wordpress/interactivity-router'
            );
            yield actions.navigate( targetUrl );

            // Once the navigation is complete, we can disable the loading state.
            state.isLoading = false;
        } ),
    }
});
