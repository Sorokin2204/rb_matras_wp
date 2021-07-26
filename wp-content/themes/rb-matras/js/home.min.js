let isEnableBodyScroll = true;
if (window.innerWidth <= 634) {
  isEnableBodyScroll = false;
}
createModal(
  'catalog__filter',
  'catalog__filter--active',
  'catalog__overlay',
  'catalog__overlay--active',
  'catalog__sort-filter',
  '',
  isEnableBodyScroll,
  [
    'catalog__filter-btn-close',
    'catalog__filter-btn-reset',
    'catalog__filter-btn-apply ',
  ],
);
createAccardion('.catalog__filter-head');

// const listResetBtn = document.querySelectorAll('.catalog__reset-btn');
// const reset = document.querySelector('.catalog__reset');
// const allResetBtn = document.querySelector('.catalog__reset-all-btn');

// listResetBtn.forEach((resetBtn) => {
//   resetBtn.addEventListener('click', () => {
//     resetBtn.classList.add('catalog__reset-btn--remove');
//     setTimeout(() => {
//       resetBtn.style.display = 'none';
//     }, 300);
//   });
// });
// allResetBtn.addEventListener('click', () => {
//   allResetBtn.classList.add('catalog__reset-btn--remove');
//   listResetBtn.forEach((resetBtn) => {
//     resetBtn.classList.add('catalog__reset-btn--remove');
//   });
//   setTimeout(() => {
//     reset.style.display = 'none';
//   }, 300);
// });


  heightrangeSlider.noUiSlider.on('set.one', function () {
    $('#filter').submit();
  });

  pricerangeSlider.noUiSlider.on('set.one', function () {
    $('#filter').submit();
  });
  widthrangeSlider.noUiSlider.on('set.one', function () {
    $('#filter').submit();
  });

  $('.checkbox').change(function () {
    $('#filter').submit();
  });