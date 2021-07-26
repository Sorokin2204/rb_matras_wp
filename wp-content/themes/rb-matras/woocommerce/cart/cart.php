<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>


    <?php do_action('woocommerce_before_cart_contents'); ?>

    <?php
    foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

        if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
    ?>


    <div class="ordering-product">
        <div class="ordering-product__img-box">
            <?php
                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image('full'), $cart_item, $cart_item_key); ?>
            <?php echo $thumbnail ?>
        </div>
        <div class="ordering-product__box">
            <?php
                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s" class="ordering-product__title">%s</a>', esc_url($product_permalink), $_product->get_title()), $cart_item, $cart_item_key)); ?>

            <select class="ordering-product__select" id="select_size" data-name-option="Размер: ">
                <option value="<?php echo $_product->get_attribute('pa_size') ?>"></option>

            </select>
            <select class="ordering-product__select" data-name-option="Чехол: ">
                <option value="<?php echo $_product->get_attribute('pa_case') ?>"></option>

            </select>
        </div>
        <div class="ordering-product__price-box">
            <span class="ordering-product__price-text">Стоимость</span>
            <div class="ordering-product__price"> <?php
                                                            echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                            ?></div>
        </div>
        <button class=" product-remove">
            <?php
                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                        'woocommerce_cart_item_remove_link',
                        sprintf(
                            '<a href="%s" class=" ordering-product__btn-remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"> <span>Удалить</span></a>',
                            esc_url(wc_get_cart_remove_url($cart_item_key)),
                            esc_html__('Remove this item', 'woocommerce'),
                            esc_attr($product_id),
                            esc_attr($_product->get_sku())
                        ),
                        $cart_item_key
                    );
                    ?>

        </button>
    </div>
    <?php
        }
    }
    ?>

    <?php do_action('woocommerce_cart_contents'); ?>
    <?php do_action('woocommerce_after_cart_contents'); ?>
    <?php do_action('woocommerce_after_cart_table'); ?>
</form>

<?php do_action('woocommerce_before_cart_collaterals'); ?>

<div class="cart-collaterals">
    <?php
    /**
     * Cart collaterals hook.
     *
     * @hooked woocommerce_cross_sell_display
     * @hooked woocommerce_cart_totals - 10
     */
    do_action('woocommerce_cart_collaterals');
    ?>
</div>

<?php do_action('woocommerce_after_cart'); ?>