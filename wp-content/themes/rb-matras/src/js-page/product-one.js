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

// const ProductBtnFavorite = document.querySelector(
//   '.product-one__favorites-btn',
// );
// const ProductBtnCompare = document.querySelector(
//   '.product-one__compare-btn',
// );

// ProductBtnFavorite?.addEventListener('click', () => {
//   ProductBtnFavorite.classList.toggle(
//     'product__btn-icon-favorites--active',
//   );
// });

// ProductBtnCompare?.addEventListener('click', () => {
//   ProductBtnCompare.classList.toggle('product__btn-icon-compare--active');
// });

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

setCookieFavorite(
  '.product-one__favorites-btn',
  'form.cart',
  'wordpress_list_favorite',
);
setCookieFavorite(
  '.product-one__compare-btn',
  'form.cart',
  'wordpress_list_compare',
);




