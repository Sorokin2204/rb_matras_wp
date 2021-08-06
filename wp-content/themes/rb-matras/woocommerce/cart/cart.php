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
            <?php if ($_product->get_attribute('pa_case')) { ?>
            <select class="ordering-product__select" data-name-option="Чехол: ">
                <option value="<?php echo $_product->get_attribute('pa_case') ?>"></option>

            </select>
            <?php } ?>

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
<div class="ordering-discount">
    <div class="ordering-discount__head">
        <h3 class="ordering-discount__head-title">
            Больше товаров - больше скидка!
        </h3>
        <p class="ordering-discount__head-text">
            За каждую единицу товара дополнительная скидка: за 2 - 2%; за 3 -
            3%; за 4 и более - 6%;
        </p>
    </div>

    <ul class="ordering-discount__list">
        <?php $args_discount = array(
            'post_type' => 'product',
            'posts_per_page' => 2,
            //  'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => 'pillows-and-blankets'
                )
            ),
        );
        $query_discount = new WP_Query($args_discount);
        //var_dump($query_discount);
        while ($query_discount->have_posts()) : $query_discount->the_post();
            global $product;
            $variation = get_variation_with_min_price($product); ?>
        <li class="ordering-discount__list-item">
            <div class="ordering-discount__img-box">
                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" class="ordering-discount__img" />
            </div>
            <div class="ordering-discount__content">
                <a href='<?php echo get_permalink() ?>' class="ordering-discount__title">
                    <?php echo get_the_title() ?>
                </a>
                <span class="ordering-discount__price"><?php echo wc_price($variation['display_price']) ?></span>
                <select class="ordering-discount__select" data-name-option="Размер: ">
                    <option value="<?php echo $variation['attributes']['attribute_pa_size'] ?>"></option>
                </select>
                <?php if (is_product_in_cart($product->get_id())) { ?>
                <button class="ordering-discount__btn-add btn btn-sm product__btn-cart--in-cart">
                    Добавлен
                </button>
                <?php } else { ?>
                <button class="ordering-discount__btn-add btn btn-sm">
                    Добавить
                </button>
                <?php } ?>

                <input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()) ?>" />
                <input type="hidden" name="quantity" value="1" />
                <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()) ?>" />
                <input type="hidden" name="variation_id" class="variation_id"
                    value="<?php echo  $variation['variation_id'] ?>" />

            </div>
        </li>
        <?php endwhile;
        wp_reset_query(); ?>
        <!-- 
        <li class="ordering-discount__list-item">
            <div class="ordering-discount__img-box">
                <img src="img/product_02.webp" alt="" class="ordering-discount__img" />
            </div>
            <div class="ordering-discount__content">
                <span class="ordering-discount__title">
                    Подушка ортопедическая "Лебяжий пух"
                </span>
                <span class="ordering-discount__price">1 684 р.</span>
                <select class="ordering-discount__select" data-name-option="Размер: ">
                    <option value="80х190"></option>
                    <option value="90х190"></option>
                    <option value="120х190"></option>
                    <option value="140х190"></option>
                    <option value="160х190"></option>
                    <option value="180х190"></option>
                </select>
                <button class="ordering-discount__btn-add btn btn-sm">
                    Добавить
                </button>
            </div>
        </li>
        <li class="ordering-discount__list-item">
            <div class="ordering-discount__img-box">
                <img src="img/product_02.webp" alt="" class="ordering-discount__img" />
            </div>
            <div class="ordering-discount__content">
                <span class="ordering-discount__title">
                    Подушка ортопедическая "Лебяжий пух"
                </span>
                <span class="ordering-discount__price">1 684 р.</span>
                <select class="ordering-discount__select" data-name-option="Размер: ">
                    <option value="80х190"></option>
                    <option value="90х190"></option>
                    <option value="120х190"></option>
                    <option value="140х190"></option>
                    <option value="160х190"></option>
                    <option value="180х190"></option>
                </select>
                <button class="ordering-discount__btn-add btn btn-sm">
                    Добавить
                </button>
            </div>
        </li> -->
    </ul>
</div>
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