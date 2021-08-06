jQuery(function ($) {
  $productContainer = $('.catalog__product-list').length
    ? $('.catalog__product-list')
    : $('.discount__product-list');
     let fillerBtn = document.querySelector(
       '.product-one__tabs-btn[data-tabs-path="char"]',
     );
   ////MAIN AJAX FILTER
  $('#filter').submit(function () {
    var filter = $('#filter');
    $.ajax({
      url: misha_loadmore_params.ajaxurl,
      dataType: 'json', // this data type allows us to receive objects from the server
      data: filter.serialize(), // form data
      type: filter.attr('method'), // POST
      beforeSend: function (xhr) {
         $('.catalog__btn-more').css('display', 'none');
        
        var product_empty = `
        <div class="product product--empty">
  <div class="product__btn-icon-box">
    <div class="product__sale">0%</div>
    <button
      class="product__btn-icon-compare product__btn-icon-compare--active"
    ></button>
    <button
      class="product__btn-icon-favorites product__btn-icon-favorites--active"
    ></button>
  </div>

  <div class="product__img-box">
    <img src="img/product_01.webp" alt="" class="product__img" />
  </div>
  <a href="../product.html" class="product__title">Мазурка Кормфорт+</a>
  <ul class="product__list">
    <li class="product__list-item">0</li>
    <li class="product__list-item">0</li>

    <li class="product__list-item">0</li>
  </ul>
  <div class="product__box">
    <div class="product__price-box">
      <span class="product__sale-price">0 р.</span>
      <span class="product__price">0 р.</span>
    </div>

    <button class="product__btn-cart btn btn-sm" data-path="modal-add-cart">
      В корзину
    </button>
  </div>
</div>
        `;
        
        if ( $productContainer.html().length == 0) {
          for (var i = 0, l = 12; i < l; i++) {
             $productContainer.append(product_empty);
          }
        } else {
          $('.product').addClass('product--empty');
        }
      
      },
      success: function (data) {
       
        // when filter applied:
        // set the current page to 1
        misha_loadmore_params.current_page = 1;

        // set the new query parameters
        misha_loadmore_params.posts = data.posts;

        // set the new max page parameter
        misha_loadmore_params.max_page = data.max_page;

        //  filter.find('button').text('Apply filter'); // changing the button label back
         $productContainer.html(data.content); // insert data
       //  AddToFavorite();

        if (data.max_page < 2) {
          $('.catalog__btn-more').css('display', 'none');
        } else {
          $('.catalog__btn-more').css('display','block');
        }
      },
    });
    return false;
  });
//// AJAX LOAD MORE
  $('.catalog__btn-more').click(function () {
    $.ajax({
      url: misha_loadmore_params.ajaxurl, // AJAX handler
      data: {
        action: 'loadmore', // the parameter for admin-ajax.php
        query: misha_loadmore_params.posts, // loop parameters passed by wp_localize_script()
        page: misha_loadmore_params.current_page, // current page
      },
      type: 'POST',
      beforeSend: function (xhr) {
   $('.catalog__btn-more').css('display', 'none');
      },
      success: function (data) {
        if (data) {
           $productContainer.append(data); // insert new posts
          misha_loadmore_params.current_page++;
          if (
            misha_loadmore_params.current_page == misha_loadmore_params.max_page
          )
            $('.catalog__btn-more').hide(); // if last page, HIDE the button
        } else {
          $('.catalog__btn-more').hide(); // if no data, HIDE the button as well
        }
      },
    });
    return false;
  });

  var listProductSelect = document.querySelectorAll('.product-one__select');

  var listProductChoice = [];
  ////CHANGE VARIATION IN SINGLE PRODUCT
  $('form.variations_form').on('found_variation', function (event, variation) {
let filler_slug = variation["attributes"]["attribute_pa_filler"];
let filler_select = document.querySelector(
  `.all-filler option[value=${filler_slug}]`
);
if(filler_select) {
    fillerBtn.disabled = false;
  const filler_block = document.querySelector('.product-one__list');
let filler_value = filler_select.text;
filler_value = filler_value.split(' + ');
filler_block.innerHTML = '';
filler_value.forEach((el) => {
  let li = document.createElement('li');
  li.classList.add('list__item');
  li.innerHTML = el;
  filler_block.appendChild(li);
}); } else {
 
  fillerBtn.disabled = true;
fillerBtn.style.color = '#b9b9b9';
  
}
    if (listProductChoice.length == 0) {
      productSelectInit();
    } else {
      for (
        let indexSelect = 0;
        indexSelect < listProductSelect.length;
        indexSelect++
      ) {
        // const element = listProductSelect[index];
        let newOptions = [];
        listProductChoice[indexSelect].clearChoices();
        for (
          let indexOption = 0;
          indexOption < listProductSelect[indexSelect].options.length;
          indexOption++
        ) {
          
          newOptions.push({
            value: listProductSelect[indexSelect].options[indexOption].value,
            label: listProductSelect[indexSelect].options[indexOption].label,
          });
        }
        listProductChoice[indexSelect].setChoices(
          newOptions,
          'value',
          'label',
          false,
        );
      }
    }
  });
  ////CHOICES PRODUCT
  const productSelectInit = () => {
    listProductSelect.forEach((element) => {
      element.addEventListener('change', () => {
        console.log($('.variation_id').val());
      });

      let choice = new Choices(element, {
        searchEnabled: false,
      });
      choice.passedElement.element.addEventListener(
        'showDropdown',
        function () {
          listChoice = element.parentNode.nextSibling;
          listChoiceInner = listChoice.firstChild;
          listChoiceInner.style.maxHeight = 'none';
          listChoice.style.height = listChoiceInner.offsetHeight + 'px';
        },
      );
      listProductChoice.push(choice);
    });
  };

  $(document).on('click', '.product-one__cart-btn', function(e) {
    addToCart(e,$(this),'form.cart')
  });

  $(document).on('click', '.compare__grid-btn-cart', function (e) {
    addToCart(e, $(this), '.compare__grid-price');
  });

 $(document).on('click', '.product__btn-cart', function (e) {
   addToCart(e, $(this), '.product');
 });

  $(document).on('click', '.ordering-discount__btn-add', function (e) {
    addToCart(e, $(this), '.ordering-discount__list-item');
  });

function addToCart(e,btnObj,classNameParent) {
   e.preventDefault();

   var $thisbutton = btnObj,
     $form = $thisbutton.closest(classNameParent),
   id = $thisbutton.val(),
   product_qty = $form.find('input[name=quantity]').val() || 1,
   product_id = $form.find('input[name=product_id]').val() || id,
   variation_id = $form.find('input[name=variation_id]').val() || 0;

   var data = {
     action: 'woocommerce_ajax_add_to_cart',
     product_id: product_id,
     product_sku: '',
     quantity: product_qty,
     variation_id: variation_id,
   };

   $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

   $.ajax({
     type: 'post',
     url: wc_add_to_cart_params.ajax_url,
     data: data,
     beforeSend: function (response) {
       
     },
     complete: function (response) {
       $mini_cart_product = $(`input[name=cart_product_id][value=${product_id}]`).closest('.mini-cart__product');
         $input = console.log($mini_cart_product);
         $('.modal-add-cart__product-img').attr(
           'src',
           $mini_cart_product.find('.mini-cart__product-img').attr('src'),
         );
          $('.modal-add-cart__product-list').html('');
          $mini_cart_product.find('.mini-cart__product-list-item').each(function () {
            $('.modal-add-cart__product-list').append(`
            <li class="modal-add-cart__product-list-item">
             ${$(this).html()}
            </li>
            `);
            //console.log($(this).html());
          });
          $('.modal-add-cart__product-title').html(
            $mini_cart_product.find('.mini-cart__product-title').text(),
          );
          $('.modal-add-cart__product-price').html(
            $mini_cart_product.find('.mini-cart__product-price').text(),
          );
          if (!$thisbutton.hasClass('ordering-discount__btn-add')) {
     $thisbutton.addClass('product__btn-cart--in-cart');
     $thisbutton.html('В корзине');
          }
       
      
     },
     success: function (response) {
       if (response.error && response.product_url) {
         window.location = response.product_url;
         return;
       } else {
         $(document.body).trigger('added_to_cart', [
           response.fragments,
           response.cart_hash,
           $thisbutton,
         ]);
       }
     },
   });

   return false;
  }

var removedIdItem = 0;
$('.mini-cart').on('click', '.mini-cart__product-btn-remove', function (event) {
  removedIdItem = $(this)
    .closest('.mini-cart__product')
    .find('input[name=cart_product_id]')
    .attr('value');
  $('.mini-cart__product-btn-remove').css('pointer-events', 'none');
});

   $(document.body).on('removed_from_cart ', function () {   
     console.log("REMOVED");
     let $input = $(`input[name=product_id][value=${removedIdItem}]`);
     if ($input) {
       ////PRODUCT CARD
       if ($input.closest('.product')) {
         
 $input
   .closest('.product')
   .find('.product__btn-cart')
   .removeClass('product__btn-cart--in-cart added');
       }
       if($input.closest('form.cart')) {
         $input
           .closest('form.cart')
           .find('.product-one__cart-btn')
           .removeClass('product__btn-cart--in-cart');
       }
        
     }
   
   });




$(document.body).on('added_to_cart', function () {
  console.log('testing!');
});

 

$('#filter').submit();

var prv;
$('.sort-radio').click(function () {
  if (prv === this && this.checked) {
    $(this).prev().prop('checked', true);
    this.checked = false;
    prv = null;
  } else {
    prv = this;
  }
  $('#filter').submit();
});
  


  // // Ajax delete product in the cart
  // $(document).on('click', '.mini_cart_item a.remove', function (e) {
  //   e.preventDefault();

  //   var product_id = $(this).attr('data-product_id'),
  //     cart_item_key = $(this).attr('data-cart_item_key'),
  //     product_container = $(this).parents('.mini_cart_item');

  //   // Add loader
  //   product_container.block({
  //     message: null,
  //     overlayCSS: {
  //       cursor: 'none',
  //     },
  //   });

  //   $.ajax({
  //     type: 'POST',
  //     dataType: 'json',
  //     url: wc_add_to_cart_params.ajax_url,
  //     data: {
  //       action: 'product_remove',
  //       product_id: product_id,
  //       cart_item_key: cart_item_key,
  //     },
  //     success: function (response) {
  //       if (!response || response.error) return;

  //       var fragments = response.fragments;

  //       // Replace fragments
  //       if (fragments) {
  //         $.each(fragments, function (key, value) {
  //           $(key).replaceWith(value);
  //         });
  //       }
  //     },
  //   });
  // });
 
});

