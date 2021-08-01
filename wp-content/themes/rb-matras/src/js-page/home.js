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

jQuery(function ($) {
  heightrangeSlider.noUiSlider.on('set.one', 
resetFilterSlider  );

  pricerangeSlider.noUiSlider.on('set.one', 
resetFilterSlider );
  widthrangeSlider.noUiSlider.on('set.one', 
resetFilterSlider );

function resetFilterSlider(slider,obj) {
  if(Number.parseInt(slider[0]) != this.options.start[0] || Number.parseInt(slider[1]) != this.options.start[1]) {
    // console.log(Number.parseInt(slider[0]));
    // console.log(this.options.start[0]);
    // console.log(Number.parseInt(slider[1]));
    // console.log(this.options.start[1]);
    // console.log(
    //   Number.parseInt(slider[0]) != this.options.start[0] ||
    //     Number.parseInt(slider[1]) != this.options.start[1],
    // );
  let text = `${
    this.target
      .closest('.catalog__filter-item')
      .querySelector('.catalog__filter-head').textContent
  } : ${Number.parseInt(slider[0])} - ${Number.parseInt(slider[1])}`;

  
  if (
    $(`.catalog__reset-btn[data-filter-name=${this.target.id}]`).length == 0
  ) {
      if ($('.catalog__reset-list').children().length == 0) {
        $('.catalog__reset-list').append(
          `<button class="catalog__reset-all-btn" data-filter-name='all'>Сбросить</button>`,
        );
      }
    $('.catalog__reset-list').append(
      `<button class="catalog__reset-btn" data-filter-name='${this.target.id}'>${text}</button>`,
    );
    let resetBtn = $(`.catalog__reset-btn[data-filter-name=${this.target.id}]`);
    resetBtn.click(() => {
      resetBtn.addClass('catalog__reset-btn--remove');
      setTimeout(() => {
        resetBtn.css('display', 'none');
        resetBtn.remove();
       if ($('.catalog__reset-list').children().length == 1) {
         $('.catalog__reset-all-btn').remove();
       }
        this.reset();
       
      }, 300);
    });
  } else {
    $(`.catalog__reset-btn[data-filter-name=${this.target.id}]`).text(text);
   
  }
  console.log('NOT DEFAULT');
   $('#filter').submit();
  // console.log(slider);
  // console.log();
  }
  else { let resetBtn = $(`.catalog__reset-btn[data-filter-name=${this.target.id}]`);
    if (resetBtn.length != 0) {
      resetBtn.addClass('catalog__reset-btn--remove');
      setTimeout(() => {
        resetBtn.css('display', 'none');
        resetBtn.remove();
        if ($('.catalog__reset-list').children().length == 1) {
          $('.catalog__reset-all-btn').remove();
        }
        //this.reset();
       
      }, 300);
    }
    console.log('DEFAULT');
     $('#filter').submit();
  }

}

  $('.checkbox').change(function (qwer) {
  ;
   let text = $(this).closest('.label-checkbox').text();
   let nameFilter = $(this)
     .closest('.catalog__filter-item')
     .children('.catalog__filter-head').text();
 let name = this.name;
    // console.log($('.catalog__reset-list').length);
    if ($('.catalog__reset-list').children().length == 0) {
      $('.catalog__reset-list').append(
        `<button class="catalog__reset-all-btn" data-filter-name='all'>Сбросить</button>`,
      );
      $('')
    } 

    if ($(`.catalog__reset-btn[data-filter-name=${name}]`).length == 0) {
      $('.catalog__reset-list').append(
        `<button class="catalog__reset-btn" data-filter-name='${name}'>${nameFilter} - ${text}</button>`,
      );
      let resetBtn = $(`.catalog__reset-btn[data-filter-name=${name}]`);
      resetBtn.click(function () {
        resetBtn.addClass('catalog__reset-btn--remove');
        setTimeout(() => {
          resetBtn.css('display', 'none');
           resetBtn.remove();
        if ($('.catalog__reset-list').children().length == 1) {
          $('.catalog__reset-all-btn').remove();
        }
           $(`.checkbox[name=${name}]`).prop( "checked", false );    
              $('#filter').submit();
        }, 300);
       
      });
    } else {
      $(`.catalog__reset-btn[data-filter-name=${name}]`).remove();
      if ($('.catalog__reset-list').children().length == 1) {
        $('.catalog__reset-all-btn').remove();
      }
    }
      
 
    $('#filter').submit();
  });
});
