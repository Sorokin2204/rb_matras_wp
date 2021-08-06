//? DONT TOUCH
// var swiperProductSimilar = undefined;
// function initSwiperProductSimilar() {
//   if (window.innerWidth > 769 && swiperProductSimilar == undefined) {
//     document
//       .querySelector('.product-similar__wrapper')
//       .classList.remove('product-list');
//     var swiperProductSimilar = new Swiper('.swiper-container-product-similar', {
//       // autoHeight: true,
//       navigation: {
//         nextEl: '.swiper-button-next-product-similar',
//         prevEl: '.swiper-button-prev-product-similar',
//       },

//       breakpoints: {
//         320: {
//           spaceBetween: 20,
//           loop: true,
//           slidesPerView: 'auto',
//         },

//         1174: { spaceBetween: 30, slidesPerView: 4 },
//       },
//     });
//   } else if (window.innerWidth <= 769 && swiperProductSimilar != undefined) {
//     swiperProductSimilar.destroy();
//     swiperProductSimilar = undefined;
//     document.querySelector('.swiper-wrapper').removeAttribute('style');
//     document.querySelector('.swiper-container').removeAttribute('style');
//   }
// }

// initSwiperProductSimilar();
// window.addEventListener('resize', initSwiperProductSimilar);

//?.///////////////////////////////////////////////////////////////////

// const sort_checkbox = document.getElementById('sort_price');

// sort_checkbox.indeterminate = true;

// sort_checkbox.addEventListener('click', function (e) {
//   console.log(e.target.indeterminate);
//   if (e.checked == true) {
//     console.log('CHECK');
//   } else if (e.indeterminate == true) {
//     console.log('INDET');
//   } else {
//     console.log('DISABLE');
//   }
// });
//?.///////////////////////////////////////////////////////////////////
////COMMON
// const queryString = window.location.search;

// const urlParams = new URLSearchParams(queryString);

// const page_type = urlParams.get('writer');

// var slide = document
//   .getElementById(page_type)
//   .getAttribute('data-swiper-slide-index');
// //console.log(slide);
// console.log(slide);

// const list = document.querySelectorAll('.discount__banner-item');
// const element = document.querySelector('#' + page_type);

// // [].indexOf.call(list, element);
// console.log([].indexOf.call(list, element));
// // const listCheckBox = document.querySelectorAll('.checkbox');
//  const filterId = document.getElementById('filter');
// listCheckBox.forEach((element) => {
//   element.addEventListener('change', () => {
//     filterId.submit();
//   });
// });

///CREATE ACCARDION
function createAccardion(
  headAccardionclassName,
  parentContentAccardionclassName = null,
  contentAccardionclassName = null,
) {
  const accardion_items = document.querySelectorAll(headAccardionclassName);
  function toggleAccordionItem() {
    const itemToggle = this.getAttribute('aria-expanded');
    let itemContent = this.nextElementSibling;
    let content = this.nextElementSibling;
    if (
      parentContentAccardionclassName != null &&
      contentAccardionclassName != null
    ) {
      var parentContent = this.closest(parentContentAccardionclassName);
      var subAccardionContent = this.closest(contentAccardionclassName);
    }

    if (itemToggle == 'false') {
      this.setAttribute('aria-expanded', 'true');
      itemContent.setAttribute('aria-hidden', 'false');
      itemContent.style.maxHeight = content.scrollHeight + 'px';
      if (
        parentContentAccardionclassName != null &&
        contentAccardionclassName != null
      ) {
        parentContent.style.maxHeight =
          parentContent.scrollHeight + subAccardionContent.scrollHeight + 'px';
      }
    } else {
      this.setAttribute('aria-expanded', 'false');
      itemContent.setAttribute('aria-hidden', 'true');
      content.style.maxHeight = 0 + 'px';
    }
  }

  accardion_items.forEach((accardion_item) =>
    accardion_item.addEventListener('click', toggleAccordionItem),
  );
}

///CREATE TAB
function createTab(className) {
  document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelector(`.${className}__tabs`);
    const tabsBtn = document.querySelectorAll(`.${className}__tabs-btn`);
    const tabsContent = document.querySelectorAll(
      `.${className}__tabs-content`,
    );

    if (tabs) {
      tabs.addEventListener(`click`, (e) => {
        if (e.target.classList.contains(`${className}__tabs-btn`)) {
          const tabsPath = e.target.dataset.tabsPath;
          tabsBtn.forEach((el) => {
            el.classList.remove(`${className}__tabs-btn--active`);
          });
          document
            .querySelector(`[data-tabs-path="${tabsPath}"]`)
            .classList.add(`${className}__tabs-btn--active`);
          tabsHandler(tabsPath);
        }

        if (e.target.classList.contains(`${className}__tabs-arrow--prev`)) {
          let activeBtn = document.querySelector(
            `.${className}__tabs-btn--active`,
          );
          let activeParent = activeBtn.closest(`.${className}__tabs-item`);
          let previousParent = activeParent.previousElementSibling;

          if (previousParent) {
            let prevActive = previousParent.querySelector(
              `.${className}__tabs-btn`,
            );
            tabsBtn.forEach((el) => {
              el.classList.remove(`${className}__tabs-btn--active`);
            });
            prevActive.classList.add(`${className}__tabs-btn--active`);

            let path = prevActive.dataset.tabsPath;
            tabsHandler(path);
          }
        }

        if (e.target.classList.contains(`${className}__tabs-arrow--next`)) {
          let activeBtn = document.querySelector(
            `.${className}__tabs-btn--active`,
          );
          let activeParent = activeBtn.closest(`.${className}__tabs-item`);
          let nextParent = activeParent.nextElementSibling;

          if (nextParent) {
            let nextActive = nextParent.querySelector(
              `.${className}__tabs-btn`,
            );
            tabsBtn.forEach((el) => {
              el.classList.remove(`${className}__tabs-btn--active`);
            });
            nextActive.classList.add(`${className}__tabs-btn--active`);

            let path = nextActive.dataset.tabsPath;
            tabsHandler(path);
          }
        }
      });
    }
    const tabsHandler = (path) => {
      tabsContent.forEach((el) => {
        el.classList.remove(`${className}__tabs-content--active`);
      });
      document
        .querySelector(`[data-tabs-target="${path}"]`)
        .classList.add(`${className}__tabs-content--active`);
    };
  });
}

///CREATE MODAL
function createModal(
  parentClassName,
  parentActiveClassName,
  overlayClassName,
  overlayActiveClassName,
  openBtnClassName,
  openBtnActiveClassName,
  isEnableBodyScroll = false,
  listCloseBtnsClassName,
) {
  let menu = document.querySelector(`.${parentClassName}`);
  let menuOpenBtn = document.querySelector(`.${openBtnClassName}`);
  let overlay = document.querySelector(`.${overlayClassName}`);

  menuOpenBtn.addEventListener('click', () => {
    if (menu.classList.contains(parentActiveClassName)) {
      DisableMenu();
    } else {
      ActiveMenu();
    }
  });

  listCloseBtnsClassName.forEach((closeBtnClassName) => {
    let menuCloseBtn = document.querySelector(`.${closeBtnClassName}`);
    menuCloseBtn?.addEventListener('click', () => {
      DisableMenu();
    });
  });

  overlay.addEventListener('click', () => {
    DisableMenu();
    //DisableMiniCart(); ///CLOSE OTHER MODALS
  });

  function DisableMenu() {
    menu.classList.remove(parentActiveClassName);
    overlay.classList.remove(overlayActiveClassName);
    if (openBtnActiveClassName) {
      menuOpenBtn.classList.remove(openBtnActiveClassName);
    }

    if (!isEnableBodyScroll) {
      document.body.style.overflow = 'auto';
    }
  }

  function ActiveMenu() {
    menu.classList.add(parentActiveClassName);
    overlay.classList.add(overlayActiveClassName);
    if (openBtnActiveClassName) {
      menuOpenBtn.classList.add(openBtnActiveClassName);
    }

    if (!isEnableBodyScroll) {
      document.body.style.overflow = 'hidden';
    }
  }
}

function createFullModal() {
  ///CREATE FULL MODAL
  const btns = document.querySelectorAll('button');
  const modalOverlay = document.querySelector('.modal-overlay ');
  const modals = document.querySelectorAll('.modal');
  const btnsClose = document.querySelectorAll('.modal__btn-close');

  btns?.forEach((el) => {
    el.addEventListener('click', (e) => {
      let path = e.currentTarget.getAttribute('data-path');
      let pathClose = e.currentTarget.getAttribute('data-path-close');

      if (pathClose !== null) {
        document
          .querySelector(`[data-target="${pathClose}"]`)
          .classList.remove('modal--visible');
        modalOverlay?.classList.remove('modal-overlay--visible');
      }

      if (path !== null) {
        // modals.forEach((el) => {
        //   el.classList.remove('modal--visible');
        // });

        document
          .querySelector(`[data-target="${path}"]`)
          .classList.add('modal--visible');
        document.body.style.overflow = 'hidden';
        modalOverlay?.classList.add('modal-overlay--visible');
      }
    });
  });

  modalOverlay?.addEventListener('click', (e) => {
    if (e.target == modalOverlay) {
      modalOverlay?.classList.remove('modal-overlay--visible');
      modals?.forEach((el) => {
        el.classList.remove('modal--visible');
        document.body.style.overflow = 'auto';
      });
    }
  });

  btnsClose?.forEach((btnClose) => {
    btnClose.addEventListener('click', (e) => {
      modalOverlay.classList.remove('modal-overlay--visible');
      modals?.forEach((el) => {
        el.classList.remove('modal--visible');
        document.body.style.overflow = 'auto';
      });
    });
  });
}
function Header() {
  const emptyLinks  = document.querySelectorAll('.nav__link[href="#"]');
  const header = document.querySelector('.header');
  emptyLinks.forEach((emptyLink) => {
    var buttonEmptyLink = document.createElement('button');
    buttonEmptyLink.classList.add('nav__btn');
    buttonEmptyLink.innerHTML = emptyLink.innerHTML;
    if (emptyLink.closest('.nav--mobile')) {
      buttonEmptyLink.setAttribute('aria-expanded', 'false');
      const mobileList = document.querySelector(
        '.nav__item--submenu .list',
      );
    
        mobileList.setAttribute('aria-hidden', 'true');
      
    }
    emptyLink.parentNode.replaceChild(buttonEmptyLink, emptyLink);
  });
  

    if (window.innerWidth <= 1060) {
      createAccardion('.nav__btn');
      window.addEventListener('scroll', () => {
        if (window.scrollY >= 40) {
          header.style.boxShadow = '3px 3px 25px rgba(0, 0, 0, 0.05)';
        } else {
          header.style.boxShadow = 'none';
        }
      });
    } else {
      const navItems = document.querySelectorAll('.nav__item--submenu');
      if (navItems) {
        let overlay = document.querySelector('.overlay');

        navItems.forEach((navItem) => {
          let navBtn = navItem.querySelector('.nav__btn');
          let navList = navItem.querySelector('.list');

          overlay.addEventListener('click', () => {
            navBtn.classList.remove('nav__btn--active');
            navList.classList.remove('list--active');
            overlay.classList.remove('overlay--active');
          });
          navBtn.addEventListener('click', () => {
            navBtn.classList.toggle('nav__btn--active');
            navList.classList.toggle('list--active');
            overlay.classList.toggle('overlay--active');
          });
        });
      }
    }
  createModal(
    'nav--mobile',
    'nav--active',
    'overlay',
    'overlay--active',
    'header__menu-btn',
    'header__menu-btn--active',
    false,
    ['nav__close-btn'],
  );

  createModal(
    'mini-cart',
    'mini-cart--active',
    'overlay',
    'overlay--active',
    'header__link-icon-cart',
    'header__link-icon--active',
    false,
    ['mini-cart__head-btn-close', 'mini-cart__btn-continue'],
  );

  const nextSectionAfterHeader = header.nextElementSibling;

  window.addEventListener('resize', () => {
    addStyleToHeader();
  });
  addStyleToHeader();
  function addStyleToHeader() {
    if (window.innerWidth <= 1060) {
      headerHeight = header.offsetHeight;

      nextSectionAfterHeader.style.paddingTop = headerHeight + 'px';
    } else {
      nextSectionAfterHeader.style.paddingTop = 0 + 'px';
    }
  }

  // function setActiveNavLink() {
  //   let navBox;
  //   if (window.innerWidth <= 1060) {
  //     navBox = document.querySelector('.header__nav--mobile');
  //   } else {
  //     navBox = document.querySelector('.header__nav');
  //   }
  //   const listNavLink = navBox.querySelectorAll('.nav__link');
  //   listNavLink.forEach((navLink) => {
  //     navAttr = navLink.getAttribute('href').substring(2);
  //     if (navAttr == pathName) {
  //       navLink.classList.add('nav__link--active');
  //     }
  //   });
  // }

  // function setActiveIconLink() {
  //   const listNavIcon = document.querySelectorAll('.header__link-icon');
  //   listNavIcon.forEach((navIcon) => {
  //     navAttr = navIcon.getAttribute('href')?.substring(2);
  //     if (navAttr == pathName) {
  //       navIcon.classList.add('header__link-icon--active');
  //     }
  //   });
  // }
 // setActiveIconLink();
  //etActiveNavLink();
}

function Product() {
  const listProductBtnCart = document.querySelectorAll('.product__btn-cart');
  const countIconBtnCart = document.querySelector(
    '.header__link-icon-cart ~ .header__count-icon',
  );
  const modalTitleAddCart = document.querySelector(
    '.modal-add-cart .modal__title',
  );
  const modalLinkAddCart = document.querySelector(
    '.modal-add-cart .modal-add-cart__btn-ordering',
  );
  var countCart = 0;
  listProductBtnCart.forEach((productBtnCart) => {
    productBtnCart?.addEventListener('click', () => {
      if (!productBtnCart.classList.contains('product__btn-cart--in-cart')) {
        modalTitleAddCart.innerHTML = 'Товар добавлен в корзину';
        modalLinkAddCart.setAttribute('href', '../ordering.html');
        modalLinkAddCart.innerHTML = 'Оформить заказ';
        productBtnCart.classList.add('product__btn-cart--in-cart');
        countCart++;
        countIconBtnCart.innerHTML = countCart;
        setTimeout(() => {
          productBtnCart.removeAttribute('data-path');
        }, 200);
      } else {
        window.location = 'http://localhost:3000/ordering.html';
      }
    });
  });
  // const listCompareProductBtnCart = document.querySelectorAll(
  //   '.compare__grid-btn-cart ',
  // );
  // listCompareProductBtnCart.forEach((productBtnCart) => {
  //   productBtnCart?.addEventListener('click', () => {
  //     if (!productBtnCart.classList.contains('product__btn-cart--in-cart')) {
  //       productBtnCart.classList.add('product__btn-cart--in-cart');
  //       setTimeout(() => {
  //         productBtnCart.removeAttribute('data-path');
  //       }, 200);
  //     } else {
  //       window.location = 'http://localhost:3000/ordering.html';
  //     }
  //   });
  // });
 
  ///COMPARE
  // const listProductBtnCompare = document.querySelectorAll(
  //   '.product__btn-icon-compare',
  // );
  // const countIconBtnCompare = document.querySelector(
  //   '.header__link-icon-compare ~ .header__count-icon',
  // );
  // var countCompare = 0;
  // listProductBtnCompare.forEach((productBtnCompare) => {
  //   productBtnCompare?.addEventListener('click', () => {
  //     if (
  //       !productBtnCompare.classList.contains(
  //         'product__btn-icon-compare--active',
  //       )
  //     ) {
  //       modalTitleAddCart.innerHTML = 'Товар добавлен в сравнение';
  //       modalLinkAddCart.setAttribute('href', '../compare.html');
  //       modalLinkAddCart.innerHTML = 'Перейти в сравнение';
  //       countCompare++;
  //       countIconBtnCompare.innerHTML = countCompare;
  //       setTimeout(() => {
  //         productBtnCompare.removeAttribute('data-path');
  //       }, 200);
  //     } else {
  //       countCompare--;
  //       countIconBtnCompare.innerHTML = countCompare;
  //       setTimeout(() => {
  //         productBtnCompare.setAttribute('data-path', 'modal-add-cart');
  //       }, 200);
  //     }
  //     if (countCompare == 0) countIconBtnCompare.innerHTML = '';
  //     productBtnCompare.classList.toggle('product__btn-icon-compare--active');
  //   });
  // });
}
// function AddToFavorite() {
//   ///FAVORITES
//   const listProductBtnFavorite = document.querySelectorAll(
//     '.product__btn-icon-favorites',
//   );
//   const countIconBtnFavorites = document.querySelector(
//     '.header__link-icon-favorites ~ .header__count-icon',
//   );
//   var countFavorites = +countIconBtnFavorites.innerHTML;
//   listProductBtnFavorite.forEach((productBtnFavorite) => {
//     productBtnFavorite?.addEventListener('click', () => {
//       if (
//         !productBtnFavorite.classList.contains(
//           'product__btn-icon-favorites--active',
//         )
//       ) {
//         // modalTitleAddCart.innerHTML = 'Товар добавлен в избранное';
//         // modalLinkAddCart.setAttribute('href', '../favorites.html');
//         // modalLinkAddCart.innerHTML = 'Перейти в избранное';
//         countFavorites++;
//         countIconBtnFavorites.innerHTML = countFavorites;
//         // setTimeout(() => {
//         //   productBtnFavorite.removeAttribute('data-path');
//         // }, 200);
//       } else {
//         countFavorites--;
//         countIconBtnFavorites.innerHTML = countFavorites;
//         // setTimeout(() => {
//         //   productBtnFavorite.setAttribute('data-path', 'modal-add-cart');
//         // }, 200);
//       }
//       if (countFavorites == 0) countIconBtnFavorites.innerHTML = '';
//       productBtnFavorite.classList.toggle(
//         'product__btn-icon-favorites--active',
//       );
//     });
//   });
// }


createTab('product-one');
createTab('test');
createAccardion('.accardion__head');
createAccardion(
  '.sub-accardion__head',
  '.accardion .accardion__content',
  '.sub-accardion',
);
Product();
Header();
createFullModal();
////END COMMON


///SWITH CUSTOM SCRIPOT FOR CUSTOM PAGE

   var cookies = document.cookie.split(';');
   var ret = '';
   for (var i = 1; i <= cookies.length; i++) {
     ret += i + ' - ' + cookies[i - 1] + '\n';
   }

console.log(ret);
////////////////////////////////////COOKIE////////////////////////////////////
function setCookie(name, value, options = {}) {

  options = {
    path: '/',
    // при необходимости добавьте другие значения по умолчанию
    ...options
  };

  if (options.expires instanceof Date) {
    options.expires = options.expires.toUTCString();
  }

  let existCookie = getCookie(name); ///GET COOKIE
  if (existCookie) {
    /// CHECK EXIST COOKIE
    existCookie = existCookie.split(','); /// COOKIE ARRAY
    if (existCookie.indexOf(value) != -1) {
      /// IF COOKIE HAVE VALUE
      console.log(existCookie);
  existCookie =    existCookie.filter((e) => e != value); /// REMOVE THIS VALUE FROM COOKIE
    } else {
      existCookie.push(value);
    }
    existCookie = existCookie.join(','); /// COOKIE STRING
  }
  else { /// ELSE SET COOKIE 
  existCookie = value;
  }
  let updatedCookie =
    encodeURIComponent(name) + '=' + encodeURIComponent(existCookie);

  for (let optionKey in options) {
    updatedCookie += "; " + optionKey;
    let optionValue = options[optionKey];
    if (optionValue !== true) {
      updatedCookie += "=" + optionValue;
    }
  }

    document.cookie = updatedCookie;
}

function getProductId(btn, classParent) {
  return btn
    .closest(classParent)
    .find('input[name=product_id]')
    .attr('value');
}

function getCountFromCookie(name) { 
    let existCookie = getCookie(name); ///GET COOKIE
  if (existCookie) {
    /// CHECK EXIST COOKIE
    existCookie = existCookie.split(','); /// COOKIE ARRAY
    return existCookie.length;
  } else {
    return 0;
  }
 }

function getCookie(name) {
  let matches = document.cookie.match(
    new RegExp(
      '(?:^|; )' +
        name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') +
        '=([^;]*)',
    ),
  );
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

  function changeStateProduct(
    obj,
    nameCookie,
    nameContainer,
    nameActiveState = '',
    countTag,
  ) {
    let count = +countTag.innerHTML;
    setCookie(nameCookie, getProductId(obj, nameContainer), {
      'max-age': 3600,
    });
    if (!obj.hasClass(nameActiveState)) {
      // modalTitleAddCart.innerHTML = 'Товар добавлен в избранное';
      // modalLinkAddCart.setAttribute('href', '../favorites.html');
      // modalLinkAddCart.innerHTML = 'Перейти в избранное';
      count++;
      countTag.innerHTML = count;
      // setTimeout(() => {
      //   productBtnFavorite.removeAttribute('data-path');
      // }, 200);
    } else {
      count--;
      countTag.innerHTML = count;
      // setTimeout(() => {
      //   productBtnFavorite.setAttribute('data-path', 'modal-add-cart');
      // }, 200);
    }
    if (count == 0) countTag.innerHTML = '';
    obj.toggleClass(nameActiveState);
  }

  const countIconBtnFavorites = document.querySelector(
    '.header__link-icon-favorites ~ .header__count-icon',
  );
    const countIconBtnCompare = document.querySelector(
      '.header__link-icon-compare ~ .header__count-icon',
    );
jQuery(function ($) {
  $('.product-list').on(
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
    }
  );

  $('.product-list').on(
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

  $('.compare__grid-btn-remove ').click(function () {
    changeStateProduct(
      $(this),
      'wordpress_list_compare',
      '.compare__grid-price',
      '',
      countIconBtnCompare,
    );
  });

  ////////////////////////////////////DADATA////////////////////////////////////////////////

  token = 'cca83bc374dc49ffae9d0ac5361a1fdbd38a0ab9';
  type = 'ADDRESS';
  var $city = $('.city');
  var $street = $('.street');
  var $house = $('.house');
  // город и населенный пункт
  $city.suggestions({
    token: token,
    type: type,
    hint: false,
    bounds: 'city',
  });

  // улица
  $street.suggestions({
    token: token,
    type: type,
    hint: false,
    bounds: 'street',
    constraints: $city,
  });

  // дом
  $house.suggestions({
    token: token,
    type: type,
    hint: false,
    bounds: 'house',
    constraints: $street,
  });
});