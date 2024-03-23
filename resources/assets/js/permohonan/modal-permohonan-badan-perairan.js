'use strict';

document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const form_individu = document.querySelector('#submit-badan-perairan-individu');
    const button_individu = form_individu.querySelector('#button-submit-individu');

    const form_bisnes = document.querySelector('#submit-badan-perairan-bisnes');
    const button_bisnes= form_bisnes.querySelector('#button-submit-bisnes');

    if (button_individu) {
      // get all data
      button_individu.addEventListener('click', event => {
          form_individu.onsubmit = () => true; // Changed 'form' to 'form_individu'
      });
    }

    if (button_bisnes) {
      // get all data
      button_bisnes.addEventListener('click', event => {
        form_bisnes.onsubmit = () => true; // Changed 'form' to 'form_individu'
      });
    }

  })();
});
