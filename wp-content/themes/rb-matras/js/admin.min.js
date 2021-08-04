const queryString = window.location;
let type = ""
let nameInputSelector = '';
let acfContainerSelector = '';
if (
  (window.location.pathname.includes('edit-tags.php') &&
    window.location.search.includes('taxonomy=pa_filler'))
 ) {
     type ='new';
     nameInputSelector = '#tag-name';
     acfContainerSelector = '#acf-term-fields';
 }  else  if (
  (window.location.pathname.includes('term.php') &&
    window.location.search.includes('taxonomy=pa_filler'))
)  {type = 'edit'; 
 nameInputSelector = '#name';
 acfContainerSelector = '#edittag > table:nth-child(10)';}

if (type)
{
  const NameInput = document.querySelector(nameInputSelector);
  const acfContainer = document.querySelector(acfContainerSelector);
  const allAcfField = acfContainer.querySelectorAll('select,input');
 console.log(allAcfField);

  let stringName = '';
  var append = '';
  var prepended = '';
  allAcfField.forEach(function (acfInput) {
    acfInput.addEventListener('change', function () {
      stringName = '';
     
      allAcfField.forEach(function (input) {
        if (input.value) {
          append = '';
          prepended = '';
          if (input.classList.contains('acf-is-appended')) {
            append = input
              .closest('.acf-input')
              .querySelector('.acf-input-append').innerHTML;
          }
          if (input.classList.contains('acf-is-prepended')) {
            prepended = input
              .closest('.acf-input')
              .querySelector('.acf-input-prepend').innerHTML;
          }
          if (input.tagName == 'SELECT') {
            var value = input.options[input.selectedIndex].text;
          } else {
            var value = input.value;
          }

          if (!stringName) {
            stringName += prepended + value + append;
          } else if (input.id == 'acf-field_610461f17ccae') {
            prepended = ' (';
            append = ' пр./м2)';
            stringName += prepended + value + append;
          } else if (append == 'см' || prepended == '(H=') {
            stringName += ' ' + prepended + value + append;
          } else {
            stringName += ' + ' + prepended + value + append;
          }
        }
      });
      NameInput.value = stringName;
    });
  });
}

