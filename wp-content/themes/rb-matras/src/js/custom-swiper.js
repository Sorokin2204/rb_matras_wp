////SWIPER HOME BANNER
var swiperBanner = new Swiper('.swiper-container-banner', {
  pagination: {
    el: '.swiper-pagination-banner',
  },
  autoplay: { delay: 6000 },
  loop: true,
});
////SWIPER DISCOUNT
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

  on: {
    slideChange: function () {
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
////SWIPER CATEGORY
var swiperCategory = new Swiper('.swiper-container-category', {
  autoHeight: true, //enable auto height
  navigation: {
    nextEl: '.swiper-button-next-category',
    prevEl: '.swiper-button-prev-category',
  },
  pagination: {
    el: '.swiper-pagination-category',
    type: 'progressbar',
  },
  slidesPerView: 'auto',
  spaceBetween: 20,
  centeredSlides: false,
  breakpoints: {
    1174: { spaceBetween: 30 },
  },
});
