/**
 *  Form Wizard
 */

'use strict';


$(function () {
  const select2 = $('.select2'),
    selectPicker = $('.selectpicker');

  // Bootstrap select
  if (selectPicker.length) {
    selectPicker.selectpicker();
  }

  // select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        placeholder: 'Select value',
        dropdownParent: $this.parent()
      });
    });
  }
});


(function () {
  const form = document.getElementById('form-pelepasan-efluen');
  const wizardModernVertical = document.querySelector('.wizard-modern-vertical'),
  wizardModernVerticalBtnNextList = [].slice.call(wizardModernVertical.querySelectorAll('.btn-next')),
  wizardModernVerticalBtnPrevList = [].slice.call(wizardModernVertical.querySelectorAll('.btn-prev')),
  wizardModernVerticalBtnSubmit = wizardModernVertical.querySelector('.btn-submit');
  if (typeof wizardModernVertical !== undefined && wizardModernVertical !== null) {
    const modernVerticalStepper = new Stepper(wizardModernVertical, {
      linear: false
    });
    if (wizardModernVerticalBtnNextList) {
      wizardModernVerticalBtnNextList.forEach(wizardModernVerticalBtnNext => {
        wizardModernVerticalBtnNext.addEventListener('click', event => {
          modernVerticalStepper.next();
        });
      });
    }
    if (wizardModernVerticalBtnPrevList) {
      wizardModernVerticalBtnPrevList.forEach(wizardModernVerticalBtnPrev => {
        wizardModernVerticalBtnPrev.addEventListener('click', event => {
          modernVerticalStepper.previous();
        });
      });
    }
    if (wizardModernVerticalBtnSubmit) {
      // get all data
        wizardModernVerticalBtnSubmit.addEventListener('click', event => {
          form.onsubmit = () => true;
      });
    }
  }
})();
