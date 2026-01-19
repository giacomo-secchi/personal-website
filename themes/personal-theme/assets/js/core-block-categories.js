/******/ (() => { // webpackBootstrap
/*!***********************************************!*\
  !*** ./resources/js/core-block-categories.js ***!
  \***********************************************/
(() => {
  'use strict';

  const filterButtons = document.querySelectorAll('.wp-block-categories a');
  const portfolioItems = document.querySelectorAll('.wp-block-post');
  let currentActiveFilter = null;
  filterButtons.forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();
      const category = this.getAttribute('href').split('/').filter(Boolean).pop();

      // Se clicco sullo stesso filtro già attivo
      if (currentActiveFilter === category) {
        // Resetta mostrando tutto
        portfolioItems.forEach(item => item.classList.remove('is-hidden'));
        this.classList.remove('active');
        currentActiveFilter = null;
        return;
      }

      // Applica il nuovo filtro
      portfolioItems.forEach(item => {
        if (item.classList.contains(`jetpack-portfolio-type-${category}`)) {
          item.classList.remove('is-hidden');
        } else {
          item.classList.add('is-hidden');
        }
      });

      // Aggiorna lo stato attivo
      filterButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      currentActiveFilter = category;
    });
  });
})();
/******/ })()
;
//# sourceMappingURL=core-block-categories.js.map