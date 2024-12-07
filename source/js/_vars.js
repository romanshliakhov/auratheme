export default {
  windowEl: window,
  documentEl: document,
  htmlEl: document.documentElement,
  bodyEl: document.body,
  activeMode: 'active-mode',
  activeClass: "active",
  header: document.querySelector('header'),
  footer: document.querySelector('footer'),

  // Mobile menu
  burger: document.querySelectorAll('.burger'),
  mobileMenu: document.querySelector('.header__menu'),
  overlay: document.querySelector('[data-overlay]'),
  
  // Sliders
  bannerSlider: document.querySelector('.banner-section__slider'),
  singleSlider: document.querySelector('.single-post__slider'),
  worksSlider: document.querySelector('.works-section__slider'),

  // Forms
  formWrappers: document.querySelectorAll( '.wpcf7' ),
  formSubmitBtn: document.querySelector('.wpcf7-submit'),
}





