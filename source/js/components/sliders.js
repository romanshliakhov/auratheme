import Swiper from 'swiper';
import vars from "../_vars";
import { Navigation, Pagination, EffectCards, Autoplay, EffectFade } from "swiper/modules";

document.addEventListener("DOMContentLoaded", function () {
  const { bannerSlider, singleSlider, worksSlider } = vars;

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

  if (worksSlider) {
    const worksSwiper = new Swiper(worksSlider.querySelector(".swiper-container"), {
      modules: [Autoplay],
      spaceBetween: 6,
      slidesPerView: 3.2,
      watchOverflow: true,
      observer: true,
      observeParents: true,
      loop: true,
    });
  }

  if (singleSlider ) {
    const singleSwiper = new Swiper(singleSlider .querySelector(".swiper-container"), {
      spaceBetween: 23,
      slidesPerView: 4,
      watchOverflow: true,
      observer: true,
      observeParents: true,
      loop: true,
    });
  }
});










