////SWIPER HOME BANNER
var swiperBanner = new Swiper('.swiper-container-banner', {
  pagination: {
    el: '.swiper-pagination-banner',
  },
  autoplay: { delay: 6000 },
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
