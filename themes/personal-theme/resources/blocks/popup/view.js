/**
 * Use this file for JavaScript code that you want to run in the front-end 
 * on posts/pages that contain this block.
 *
 * When this file is defined as the value of the `viewScript` property
 * in `block.json` it will be enqueued on the front end of the site.
 *
 * Example:
 *
 * ```js
 * {
 *   "viewScript": "file:./view.js"
 * }
 * ```
 *
 * If you're not making any changes to this file because your project doesn't need any 
 * JavaScript running in the front-end, then you should delete this file and remove 
 * the `viewScript` property from `block.json`. 
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-metadata/#view-script
 */
 
import { store, useEffect, getElement, getContext } from '@wordpress/interactivity';

store( 'popup', {
    state: {
        isPopupOpen: false,
        currentTitle: '',
        currentContent: ''
    },
    actions: {
        *openPopup( event) {
            event.preventDefault();
            const state = store( 'popup' ).state;
            const context = getContext();

  

            // Opzionale: blocca lo scroll del body
            document.body.style.overflow = 'hidden';
            // Popoliamo lo stato con i dati del contesto
            state.currentTitle = 'Caricamento...'; // O stringa vuota ''
            state.currentContent = '';
            state.isPopupOpen = true;

            try {
            
                // Carichiamo dinamicamente un modulo JS che gestisce le chiamate API
                // o semplicemente attendiamo il fetch dei dati
                const response = yield fetch(`/wp-json/wp/v2/jetpack-portfolio/${context.postId}`);

                if ( ! response.ok ) {
                    throw new Error('Errore');
                }

                const data = yield response.json();
 

                state.currentTitle = data.title.rendered;
                state.currentContent = data.content.rendered;
 
        
                
            } catch (error) {
                state.currentContent = 'Error loading project.';
            }
        },
        closePopup: () => {
            const state = store( 'popup' ).state;
            state.isPopupOpen = false;
            // Ripristina lo scroll
            document.body.style.overflow = '';
        },
    },
    callbacks: {
        // Logica che reagisce ai cambiamenti di stato
        handleKeyPress: ( event ) => {
            const state = store( 'popup' ).state;
            // Chiudi con il tasto ESC
            if ( state.isPopupOpen && event.key === 'Escape' ) {
                state.isPopupOpen = false;
            }
        },
        renderContent: () => {
             
            const { currentContent } = store( 'popup' ).state;
            const { ref } = getElement();

            
            // Se abbiamo contenuto e il riferimento all'elemento DOM
            if ( ref && currentContent ) {
                ref.innerHTML = currentContent;
            } else if ( ref && !currentContent ) {
                ref.innerHTML = ''; // Pulisce se il contenuto viene resettato
            }
        }
    }
});