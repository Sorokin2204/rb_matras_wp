

const catalogOtherListProduct = document.querySelector(
  '.catalog__product-list',
);
const listFavoritesBtn = document.querySelectorAll(
  '.product__btn-icon-favorites',
);
listFavoritesBtn.forEach((btn) => {
  btn.classList.add('product__btn-icon-favorites--active');
});
const favoritesTitle = document.querySelector('.catalog__sort-title');
favoritesTitle.innerHTML = 'Избранное';
catalogOtherListProduct.classList.add('product-list--full');
