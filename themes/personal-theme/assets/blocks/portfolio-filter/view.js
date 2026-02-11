import * as __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__ from "@wordpress/interactivity";
/******/ var __webpack_modules__ = ({

/***/ "@wordpress/interactivity"
/*!*******************************************!*\
  !*** external "@wordpress/interactivity" ***!
  \*******************************************/
(module) {

module.exports = __WEBPACK_EXTERNAL_MODULE__wordpress_interactivity_8e89b257__;

/***/ },

/***/ "@wordpress/interactivity-router"
/*!**************************************************!*\
  !*** external "@wordpress/interactivity-router" ***!
  \**************************************************/
(module) {

module.exports = import("@wordpress/interactivity-router");;

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
/*!***************************************************!*\
  !*** ./resources/blocks/portfolio-filter/view.js ***!
  \***************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/interactivity */ "@wordpress/interactivity");
/**
 * WordPress dependencies
 */

(0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('portfolioApp', {
  state: {
    currentCategoryId: 0,
    isLoading: false,
    get isCategoryActive() {
      const {
        catId
      } = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      return (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('portfolioApp').state.currentCategoryId === catId;
    }
  },
  actions: {
    // The withSyncEvent() utility needs to be used because preventDefault() requires synchronous event access.
    updateFilter: (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.withSyncEvent)(function* (event) {
      event.preventDefault();
      const context = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.getContext)();
      const state = (0,_wordpress_interactivity__WEBPACK_IMPORTED_MODULE_0__.store)('portfolioApp').state;
      let targetUrl = event.target.href;
      if (state.currentCategoryId === context.catId) {
        // if the clicked category is already active, reset the filter by setting the current category ID to 0 and navigating to the main portfolio URL.
        state.currentCategoryId = 0;
        targetUrl = context.portfolioUrl;
      } else {
        // Set the current category ID in the state, so it can be used by other components if needed.
        state.currentCategoryId = context.catId;
      }
      if (!targetUrl) {
        return;
      }

      // We import the package dynamically to reduce the initial JS bundle size.
      // Async actions are defined as generators so the import() must be called with `yield`.
      const {
        actions
      } = yield Promise.resolve(/*! import() */).then(__webpack_require__.bind(__webpack_require__, /*! @wordpress/interactivity-router */ "@wordpress/interactivity-router"));
      yield actions.navigate(targetUrl);
    })
  }
});
})();


//# sourceMappingURL=view.js.map