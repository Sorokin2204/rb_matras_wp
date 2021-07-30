////SWIPER DISCOUNT
const queryString = window.location.search;

const urlParams = new URLSearchParams(queryString);

const page_type = urlParams.get('writer');

const list = document.querySelectorAll('.discount__banner-item');
const element = document.querySelector('#' + page_type);
const discout_term_input = document.querySelector('input[name=discount_term]');
console.log(discout_term_input);
discout_term_input.setAttribute('value', page_type);
const numberSlide = [].indexOf.call(list, element);
// [].indexOf.call(list, element);
//console.log());

// var slide = document
//   .getElementById(page_type)
//   .getAttribute('data-swiper-slide-index');

// console.log(slide);
//console.log(numberSlide);

const listProductSale = document.querySelectorAll('.product--sale');
const prevNavSwiperBtn = document.querySelector('.swiper-button-prev');
const nextNavSwiperBtn = document.querySelector('.swiper-button-next');
var swiperDiscount = new Swiper('.swiper-container-discount', {
  navigation: {
    nextEl: '.swiper-button-next-discount',
    prevEl: '.swiper-button-prev-discount',
  },

  pagination: {
    el: '.swiper-pagination-category',
    type: 'progressbar',
  },
  initialSlide: numberSlide,

  on: {
    slideChange: function (swiper) {
      let index_currentSlide = swiper.activeIndex,
        currentSlide = swiper.slides[index_currentSlide];
      discout_term_input.setAttribute('value', currentSlide.id);
      history.pushState(null, null, '?' + 'writer=' + currentSlide.id);
      jQuery(function ($) {
        $('#filter').submit();
      });
      listProductSale.forEach((sale) => {
        sale.classList.add('product--empty');
        this.allowSlideNext = 0;
        this.allowSlidePrev = 0;
        prevNavSwiperBtn.classList.add('swiper-button-disabled');
        nextNavSwiperBtn.classList.add('swiper-button-disabled');
      });

      setTimeout(() => {
        listProductSale.forEach((sale) => {
          sale.classList.remove('product--empty');
          this.allowSlideNext = 1;
          this.allowSlidePrev = 1;
          prevNavSwiperBtn.classList.remove('swiper-button-disabled');
          nextNavSwiperBtn.classList.remove('swiper-button-disabled');
        });
      }, 3000);
    },
  },

  loop: true,
});
