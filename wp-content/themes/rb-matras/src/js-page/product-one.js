/// PRODUCT SIMILAR SLIDER
var swiperProductSimilar = undefined;

///ADD CLASS TO SIMILAR PRODUCT
const listSimilarProduct = document.querySelectorAll('.product');
listSimilarProduct.forEach((similarProduct) => {
  similarProduct.classList.add('swiper-slide');
});
function initSwiperProductSimilar() {
  if (window.innerWidth > 769 && swiperProductSimilar == undefined) {
    document
      .querySelector('.product-similar__wrapper')
      .classList.remove('product-list');
    var swiperProductSimilar = new Swiper('.swiper-container-product-similar', {
      // autoHeight: true,
      navigation: {
        nextEl: '.swiper-button-next-product-similar',
        prevEl: '.swiper-button-prev-product-similar',
      },

      breakpoints: {
        769: {
          spaceBetween: 20,
          loop: true,
          slidesPerView: 3,
        },
        840: {
          spaceBetween: 20,
          slidesPerView: 4,
        },
        1174: { spaceBetween: 30, slidesPerView: 4 },
      },
    });
  } else if (window.innerWidth <= 769 && swiperProductSimilar != undefined) {
    swiperProductSimilar.destroy();
    swiperProductSimilar = undefined;
    document.querySelector('.swiper-wrapper').removeAttribute('style');
    document.querySelector('.swiper-container').removeAttribute('style');
  }
}


initSwiperProductSimilar();
window.addEventListener('resize', initSwiperProductSimilar);

///DISABLE SELECT
// const selectSize = document.getElementById('select_size');
// //const selectChehol = selectSize.nextSibling;

// const choices = document.querySelectorAll('.choices');
// choices[1].classList.add('is-disabled');
// choices[1].style.pointerEvents = 'none';
// selectSize.addEventListener('change', () => {
//   choices[1].classList.remove('is-disabled');
//   choices[1].style.pointerEvents = 'auto';
// });


const btnAddToCart = document.querySelector('.product-one__cart-btn');
const inputVariation = document.querySelector('.variation_id');

function checkIfVariationInCart() {
  inputVariation.getAttribute('value');
}


jQuery(function ($) {
  $('.product-one__favorites-btn').click(function () {
    changeStateProduct(
      $(this),
      'wordpress_list_favorite',
      'form.cart',
      'product-one__favorites-btn--active',
      countIconBtnFavorites,
    );
    });
     $('.product-one__compare-btn').click(function () {
       changeStateProduct(
         $(this),
         'wordpress_list_compare',
         'form.cart',
         'product-one__compare-btn--active',
         countIconBtnCompare,
       );
     });

     $('.product-similar__wrapper').on(
       'click',
       '.product__btn-icon-compare',
       function (event) {
         changeStateProduct(
           $(this),
           'wordpress_list_compare',
           '.product',
           'product__btn-icon-compare--active',
           countIconBtnCompare,
         );
       },
     );
     

     $('.product-similar__wrapper').on(
       'click',
       '.product__btn-icon-favorites',
       function (event) {
         changeStateProduct(
           $(this),
           'wordpress_list_favorite',
           '.product',
           'product__btn-icon-favorites--active',
           countIconBtnFavorites,
         );
       },
     );
});