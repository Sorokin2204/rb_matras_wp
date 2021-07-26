///CHOICES PRODUCT
//   const productSelectInit = () => {
//     const listProductSelect = document.querySelectorAll('.product-one__select');
// const listProductChoice = [];
//     listProductSelect.forEach((element) => {
//       element.addEventListener('change', () => {
//         console.log('CHANGE ');
//       });

//       let choice = new Choices(element, {
//         searchEnabled: false,
//       });
//       choice.passedElement.element.addEventListener(
//         'showDropdown',
//         function () {
//           listChoice = element.parentNode.nextSibling;
//           listChoiceInner = listChoice.firstChild;
//           listChoiceInner.style.maxHeight = 'none';
//           listChoice.style.height = listChoiceInner.offsetHeight + 'px';
//         },
//       );
//       listProductChoice.push(choice);
//     });
//   };

//   productSelectInit();



let overlay = document.querySelector('.catalog__overlay');

///CHOICES CATALOG
const sortSelectInit = () => {
  const elemets = document.querySelectorAll('.catalog__sort-select-mobile');
  elemets.forEach((element) => {
    let choice = new Choices(element, {
      searchEnabled: false,
    });
    choice.passedElement.element.addEventListener(
      'showDropdown',
      function (event) {
        listChoice = element.parentNode.nextSibling;
        listChoiceInner = listChoice.firstChild;
        listChoiceInner.style.maxHeight = 'none';
        listChoice.style.height = listChoiceInner.offsetHeight + 'px';
        const choiceDown = document.querySelector('.choices:last-of-type');
        if (window.innerWidth <= 634) {
          if (choiceDown.classList.contains('is-open')) {
            overlay.style.top = '200px';
          } else {
            overlay.style.top = '124px';
          }
        }

        overlay.classList.add('catalog__overlay--active');
      },
      false,
    );
    choice.passedElement.element.addEventListener(
      'hideDropdown',
      function (event) {
        const choices = document.querySelectorAll('.choices');
        let isAllClose = true;

        choices.forEach((choice) => {
          if (choice.classList.contains('is-open')) {
            isAllClose = false;
            if (window.innerWidth <= 634) {
              overlay.style.top = '124px';
            }
          }
        });
        if (isAllClose) {
          overlay.classList.remove('catalog__overlay--active');
        }
      },
      false,
    );
  });
};

sortSelectInit();
