import Swiper from 'swiper';
import vars from "../_vars";
import { Navigation, Pagination, EffectCards, Autoplay, EffectFade } from "swiper/modules";

document.addEventListener("DOMContentLoaded", function () {
  const { bannerSlider, categoriesSlider, singleSlider, worksSlider } = vars;

  if (bannerSlider) {
    const bannerSwiper = new Swiper(bannerSlider.querySelector(".swiper-container"), {
      modules: [Pagination, EffectFade, Autoplay],
      spaceBetween: 20,
      speed: 1200,
      slidesPerView: 1,
      watchOverflow: true,
      observer: true,
      observeParents: true,
      loop: true,
      effect: "fade",
      fadeEffect: {
        crossFade: true,
      },
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },

      pagination: {
        el: bannerSlider.querySelector(".swiper-pagination"),
        clickable: true,
      }
    });
  }

  if (categoriesSlider) {
    // Находим контейнер слайдера и кнопки управления
    const swiperContainer = categoriesSlider.querySelector(".swiper-container");
    const nextBtn = categoriesSlider.querySelector(".swiper-button.next");
    const prevBtn = categoriesSlider.querySelector(".swiper-button.prev");
  
    // Инициализируем Swiper
    const categoriesSwiper = new Swiper(swiperContainer, {
      modules: [Navigation, Pagination], // Подключаем модули, если используете модульную версию Swiper
      spaceBetween: 10,
      slidesPerView: 5,
      initialSlide: 2,
      watchSlidesProgress: true,
      watchOverflow: true,
      watchSlidesVisibility: true,
      slideVisibleClass: 'swiper-slide-visible',
      observer: true,
      observeParents: true,
      loop: true,
  
      navigation: {
        prevEl: prevBtn,
        nextEl: nextBtn,
      },
    });
  }
  

  if (worksSlider) {
    const swiperContainer = worksSlider.querySelector(".swiper-container");
    const nextBtn = worksSlider.querySelector(".swiper-button.next");
    const prevBtn = worksSlider.querySelector(".swiper-button.prev");

    const worksSwiper = new Swiper(swiperContainer, {
      modules: [Navigation, Autoplay],
      speed: 1200,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false,
      },
      spaceBetween: 6,
      slidesPerView: 3.25,
      // watchSlidesProgress: true,
      // watchOverflow: true,
      // watchSlidesVisibility: true,
      // slideVisibleClass: 'swiper-slide-visible',
      observer: true,
      observeParents: true,
      loop: true,
      navigation: {
        prevEl: prevBtn,
        nextEl: nextBtn,
      },
    });
  }

  if (singleSlider ) {
    const singleSwiper = new Swiper(singleSlider .querySelector(".swiper-container"), {
      watchOverflow: true,
      observer: true,
      observeParents: true,
      loop: true,
      breakpoints: {
        320:{
          slidesPerView: 1,
          spaceBetween: 5,
        },
        576:{
          slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
          spaceBetween: 10,
        },
        1025: {
          slidesPerView: 4,
          spaceBetween: 20,
        }
      },
    });
  }
});










