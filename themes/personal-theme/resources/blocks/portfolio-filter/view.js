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
            var targetUrl = event.target.href;


            const { actions } = yield import(
                '@wordpress/interactivity-router'
            );

             // --- INTEGRAZIONE LOGICA TOGGLE ---
            if (state.currentCategoryId === context.catId) {
                // Se clicco il tasto già attivo -> resetto a 0
                state.currentCategoryId = 0;
                targetUrl = context.portfolioUrl;

            } else {
                // Se clicco un tasto diverso -> imposto il nuovo ID
                state.currentCategoryId = context.catId;
            }

            if (targetUrl) {
                // Eseguiamo la navigazione client-side
                // WordPress scaricherà solo i pezzi di HTML che cambiano!
                yield actions.navigate(targetUrl);
                
                // Opzionale: aggiorna lo stato locale se ti serve per altre classi CSS
                // store('portfolioApp').state.currentUrl = targetUrl;
            }
        }
    }
});
