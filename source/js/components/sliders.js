import Swiper from 'swiper';
import vars from "../_vars";
import { Pagination, Navigation } from 'swiper/modules';

const { aboutSlider, feedbacksSlider } = vars;

if ( aboutSlider ) {
  const swiper = new Swiper(aboutSlider, {
    modules: [Pagination, Navigation],
    spaceBetween: 20,
    observer: true,
    observeParents: true,
    loop: true,
    pagination: {
      el: ".about__slider-pagination",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      1025: {
        slidesPerView: 2,
      },
    },
  });
}



if (feedbacksSlider) {
  const swiper = new Swiper(feedbacksSlider, {
    modules: [Pagination, Navigation],
    spaceBetween: 20,
    observer: true,
    observeParents: true,
    loop: true,
    navigation: {
      nextEl: '.feedbacks__slider-next',
      prevEl: '.feedbacks__slider-prev',
    },
    pagination: {
      el: ".feedbacks__slider-pagination",
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: 1,
      },
      1025: {
        slidesPerView: 2,
      },
    },
  });
}










