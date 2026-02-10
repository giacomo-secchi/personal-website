/**
 * WordPress dependencies
 */
import { store, getContext, getElement } from '@wordpress/interactivity';

store('portfolioApp', {
    state: {
        currentCategoryId: 0,
        isLoading: false,
        get isCategoryActive() {
            const { catId } = getContext();
            return store('portfolioApp').state.currentCategoryId === catId;
        }
    },
    actions: {
        *updateFilter(event) {
            event.preventDefault();

            const context = getContext();
            const state = store('portfolioApp').state;
            let targetUrl = event.target.href;
 
            if (state.currentCategoryId === context.catId) {
                // Se clicco il tasto già attivo -> resetto a 0
                state.currentCategoryId = 0;
                targetUrl = context.portfolioUrl;

            } else {
                // Se clicco un tasto diverso -> imposto il nuovo ID
                state.currentCategoryId = context.catId;
            }



            if (! targetUrl) {
                return;
            }

            // We import the package dynamically to reduce the initial JS bundle size.
            // Async actions are defined as generators so the import() must be called with `yield`.
            const { actions } = yield import(
                '@wordpress/interactivity-router'
            );

            yield actions.navigate( targetUrl );
        }
    }
});
