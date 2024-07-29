import Swiper from 'swiper';
import { Navigation, Pagination } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';

const swiper = new Swiper('.master-advertisements-slider', {
  modules: [Navigation, Pagination],

  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },

  slidesPerView: 1,
  spaceBetween: 10,

  breakpoints: {
    '@0.75': {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    '@1.00': {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    '@1.50': {
      slidesPerView: 3,
      spaceBetween: 50,
    },
  },
});