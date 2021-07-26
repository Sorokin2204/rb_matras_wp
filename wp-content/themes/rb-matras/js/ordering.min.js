const orderingProductInit = () => {
  const elemets = document.querySelectorAll('.ordering-product__select');

  elemets.forEach((element) => {
    choice = new Choices(element, {
      searchEnabled: false,
    });
    choice.passedElement.element.addEventListener('showDropdown', function () {
      listChoice = element.parentNode.nextSibling;
      listChoiceInner = listChoice.firstChild;
      listChoiceInner.style.maxHeight = 'none';
      listChoice.style.height = listChoiceInner.offsetHeight + 'px';
    });
  });
};

const orderingDiscountInit = () => {
  const elemets = document.querySelectorAll('.ordering-discount__select');

  elemets.forEach((element) => {
    choice = new Choices(element, {
      searchEnabled: false,
    });

    choice.passedElement.element.addEventListener('showDropdown', function () {
      listChoice = element.parentNode.nextSibling;
      listChoiceInner = listChoice.firstChild;
      listChoiceInner.style.maxHeight = 'none';
      listChoice.style.height = listChoiceInner.offsetHeight + 'px';
    });
  });
};

orderingProductInit();
orderingDiscountInit();

const selects = document.querySelectorAll('select');
selects.forEach((select) => {
  if (select.hasAttribute('data-name-option')) {
    nameSelect = select.getAttribute('data-name-option');
    choiceSelect = select.nextSibling;
    choiceSelect.setAttribute('data-name-option', nameSelect);
  }
});

///DISABLE SELECT
const selectSize = document.getElementById('select_size');
//const selectChehol = selectSize.nextSibling;

const choices = document.querySelectorAll('.choices');
choices.forEach(function (choice) {
    choice.classList.add('is-disabled');
    choice.style.pointerEvents = 'none';
})
// choices[1].classList.add('is-disabled');
// choices[1].style.pointerEvents = 'none';
// selectSize.addEventListener('change', () => {
//   choices[1].classList.remove('is-disabled');
//   choices[1].style.pointerEvents = 'auto';
// });

document.querySelectorAll('.input').forEach(function (element) {
  element.addEventListener('blur', function () {
    // if input field passes validation remove the error class, else add it
      var cond = this.checkValidity();
    if(this.type == 'tel') {
        // console.log(this.value.includes('_'));
        
          cond = !this.value.includes('_')  && !this.value == ''; 
         
    }

    if (cond) {
      this.classList.remove('input-error');
      this.classList.add('input-not-error');
    } else {
      this.classList.add('input-error');
      this.classList.remove('input-not-error');
    }
  });
});

var telephone = document.querySelector('.telephone');

var im = new Inputmask('+7 (999) 999-99-99', { clearIncomplete: true });
im.mask(telephone);