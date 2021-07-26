<?php

/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart'); ?>

<?php if (!WC()->cart->is_empty()) : ?>


<div class="mini-cart__inner">
    <div class="mini-cart__head">
        <h2 class="mini-cart__head-title title-h2">Корзина</h2>
        <button class="mini-cart__head-btn-close"></button>
    </div>

    <?php
		do_action('woocommerce_before_mini_cart_contents');

		foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
			$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
			$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
			if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
				$product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
				$thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
				$product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
				$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
		?>
    <div class="mini-cart__product">
        <div class="mini-cart__product-content">
            <div class="mini-cart__product-img-box">
                <img src="<?php echo get_the_post_thumbnail_url($product_id); ?>" alt=""
                    class="mini-cart__product-img" />
            </div>
            <div class="mini-cart__product-box">
                <span class="mini-cart__product-title"><?php echo $product_name ?></span>
                <ul class="mini-cart__product-list">
                    <li class="mini-cart__product-list-item">
                        <span>Жёсткость:</span> <?php echo get_field('filter_hardness', $product_id) ?>
                    </li>
                    <li class="mini-cart__product-list-item">
                        <span>Вес:</span>
                        <?php echo get_field('filter_weight', $product_id) ?>
                    </li>
                    <li class="mini-cart__product-list-item">
                        <span> Зоны жесткости:</span>

                    </li>
                    <li class="mini-cart__product-list-item">
                        <span>Размер:</span>
                        <?php echo $_product->get_attribute('pa_size') ?>
                    </li>
                    <li class="mini-cart__product-list-item">
                        <span>Чехол:</span>
                        <?php echo $_product->get_attribute('pa_case') ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mini-cart__product-price-box">
            <?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class=" remove_from_cart_button mini-cart__product-btn-remove" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">Удалить</a>',
								esc_url(wc_get_cart_remove_url($cart_item_key)),
								esc_attr__('Remove this item', 'woocommerce'),
								esc_attr($product_id),
								esc_attr($cart_item_key),
								esc_attr($_product->get_sku())
							),
							$cart_item_key
						);
						?>

            <!-- <button class="mini-cart__product-btn-remove">Удалить</button> -->
            <span class="mini-cart__product-price"><?php echo $product_price ?></span>
        </div>
        <input type="hidden" name="cart_product_id" value='<?php echo $product_id ?>'>
    </div>
    <?php }
		} ?>
    <div class="mini-cart__total">
        <span class="mini-cart__total-title">Итого:</span>
        <span class="mini-cart__total-price"><?php echo WC()->cart->get_cart_subtotal() ?></span>
        <button class="mini-cart__btn-continue">
            Продолжить покупки
        </button>
        <a href="<?php echo wc_get_checkout_url() ?>" class="mini-cart__btn-ordering btn btn--hide-icon">
            Оформить заказ
        </a>
    </div>
</div>


<?php else : ?>

<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>

<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>