export default {
  windowEl: window,
  documentEl: document,
  htmlEl: document.documentElement,
  bodyEl: document.body,
  activeMode: 'active-mode',
  activeClass: "active",
  header: document.querySelector('header'),
  footer: document.querySelector('footer'),
  overlay: document.querySelector('[data-overlay]'),

  // Mobile menu
  burger: document.querySelectorAll('.burger'),
  mobileMenu: document.querySelector('.header__menu'),
  
  // Sliders
  bannerSlider: document.querySelector('.banner-section__slider'),
  categoriesSlider: document.querySelector('.categories-section__slider'),
  singleSlider: document.querySelector('.single-post__slider'),
  worksSlider: document.querySelector('.works-section__slider'),

  // Forms
  formWrappers: document.querySelectorAll( '.wpcf7' ),
  formSubmitBtn: document.querySelector('.wpcf7-submit'),

  // Modal
  modals: [...document.querySelectorAll('[data-popup]')],
  modalsButton: [...document.querySelectorAll("[data-btn-modal]")],
}





