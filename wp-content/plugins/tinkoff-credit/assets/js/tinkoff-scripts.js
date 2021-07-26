(function ($) {

    /**
     * Single page
     */
    var variations_form = $('.variations_form');

    // Change credit button quantity and sum when quantity on single product page is changed
    function change_credit_button_qty_and_sum() {
        var qty = $('.single-product .qty').val(),
            inputSum = $('input[name="sum"]'),
            inputQty = $('input[name="itemQuantity_0"]'),
            inputPrice = $('input[name="itemPrice_0"]'),
            resultSum = +qty * +inputPrice.val();

        inputQty.val(qty);
        inputSum.val(resultSum.toFixed(2));
    }

    /* Variable products */
    if (variations_form.length > 0) {
        // Variation is correct
        variations_form.on('show_variation', function (event, variation) {
            // Change product price
            $('input[name="itemPrice_0"]').val(variation.display_price);

            // Change quantity and sum
            change_credit_button_qty_and_sum();

            var inputSum = $('input[name="sum"]').val();

            // Show/hide buttons depending on the price or sum
            if (variation.display_price >= 3000 || +inputSum >= 3000) {
                $('.tinkoff_credit_wrapper').show();
            } else {
                $('.tinkoff_credit_wrapper').hide();
            }
        });

        // Variation is hidden
        variations_form.on('hide_variation', function () {
            // Hide buttons
            $('.tinkoff_credit_wrapper').hide();

            // Change product price and sum
            $('input[name="itemPrice_0"]').val(0);
            $('input[name="sum"]').val(0);

            // Change quantity and sum
            change_credit_button_qty_and_sum();
        });
    }

    /* Variable and simple products */
    // When change quantity
    $('.single-product .qty').on('input', function () {
        // Change quantity and sum
        change_credit_button_qty_and_sum();

        var inputSum = $('input[name="sum"]').val(),
            inputPrice = $('input[name="itemPrice_0"]').val();

        // Show/hide buttons depending on the price or sum
        if (+inputPrice >= 3000 || +inputSum >= 3000) {
            $('.tinkoff_credit_wrapper').show();
        } else {
            $('.tinkoff_credit_wrapper').hide();
        }
    });


    /**
     * Cart
     */
    // Change Tinkoff quantity and price when quantity on cart page is changed
    function changeQuantityOnCart() {
        var cart_items = $('.woocommerce-cart-form .cart_item');

        cart_items.each(function (i) {
            $(this).find('.qty').on('input', function () {

                var qty = $(this),
                    accordQtyInput = 'itemQuantity_' + i,
                    accordPriceInput = 'itemPrice_' + i,
                    inputSum = $('input[name="sum"]'),
                    inputQty = $('input[name="' + accordQtyInput + '"]'),
                    inputPrice = $('input[name="' + accordPriceInput + '"]'),
                    oldSum = +inputQty.val() * +inputPrice.val(),
                    newSum = +qty.val() * +inputPrice.val(),
                    difference = +newSum - +oldSum,
                    totalSum = +inputSum.val() + +difference;

                inputQty.val(qty.val());
                inputSum.val(totalSum.toFixed(2));
            });
        });
    }

    changeQuantityOnCart();

    // Change Tinkoff quantity and price on cart page when cart is updated
    $(document.body).on('updated_cart_totals', changeQuantityOnCart);


    /**
     * Coupon AJAX handler
     */
    // wc_cart_params is required to continue, ensure the object exists
    if (typeof wc_cart_params === 'undefined') {
        return false;
    }

    $('.coupon .button').click(function (e) {

        var data = {
            action: 'tnkfcredit_when_coupon_apply',
            coupon_code: $('#coupon_code').val(),
            security: wc_cart_params.apply_coupon_nonce
        };

        $.post(woocommerce_params.ajax_url, data, function (response) {
            if (response) {
                var tinkoff_products_list = $('#tinkoff_products_list');

                if (response != 0) {
                    tinkoff_products_list.empty();
                    tinkoff_products_list.html(response);
                }
            }
        });
    });
})(jQuery);