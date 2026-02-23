import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity"
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
(module) {

module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ }

/******/ });
/************************************************************************/
/******/ // The module cache
/******/ var __webpack_module_cache__ = {};
/******/ 
/******/ // The require function
/******/ function __webpack_require__(moduleId) {
/******/ 	// Check if module is in cache
/******/ 	var cachedModule = __webpack_module_cache__[moduleId];
/******/ 	if (cachedModule !== undefined) {
/******/ 		return cachedModule.exports;
/******/ 	}
/******/ 	// Check if module exists (development only)
/******/ 	if (__webpack_modules__[moduleId] === undefined) {
/******/ 		var e = new Error("Cannot find module '" + moduleId + "'");
/******/ 		e.code = 'MODULE_NOT_FOUND';
/******/ 		throw e;
/******/ 	}
/******/ 	// Create a new module (and put it into the cache)
/******/ 	var module = __webpack_module_cache__[moduleId] = {
/******/ 		// no module.id needed
/******/ 		// no module.loaded needed
/******/ 		exports: {}
/******/ 	};
/******/ 
/******/ 	// Execute the module function
/******/ 	__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 
/******/ 	// Return the exports of the module
/******/ 	return module.exports;
/******/ }
/******/ 
/************************************************************************/
/******/ /* webpack/runtime/make namespace object */
/******/ (() => {
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = (exports) => {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/ })();
/******/ 
/************************************************************************/
var __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!******************************************!*\
  !*** ./resources/blocks/overlay/view.js ***!
  \******************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");
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


(0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('overlay', {
  state: {
    isPopupOpen: false,
    currentTitle: '',
    currentContent: ''
  },
  actions: {
    *openPopup(event) {
      event.preventDefault();
      const state = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('overlay').state;
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();

      // Opzionale: blocca lo scroll del body
      document.body.style.overflow = 'hidden';
      // Popoliamo lo stato con i dati del contesto
      state.currentTitle = 'Caricamento...'; // O stringa vuota ''
      state.currentContent = '';
      state.isPopupOpen = true;
    },
    closePopup: () => {
      const state = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('overlay').state;
      state.isPopupOpen = false;
      // Ripristina lo scroll
      document.body.style.overflow = '';
    }
  },
  callbacks: {
    // Logica che reagisce ai cambiamenti di stato
    handleKeyPress: event => {
      const state = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('popup').state;
      // Chiudi con il tasto ESC
      if (state.isPopupOpen && event.key === 'Escape') {
        state.isPopupOpen = false;
      }
    },
    renderContent: () => {
      const {
        currentContent
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('popup').state;
      const {
        ref
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getElement)();

      // Se abbiamo contenuto e il riferimento all'elemento DOM
      if (ref && currentContent) {
        ref.innerHTML = currentContent;
      } else if (ref && !currentContent) {
        ref.innerHTML = ''; // Pulisce se il contenuto viene resettato
      }
    }
  }
});
})();


//# sourceMappingURL=view.js.map