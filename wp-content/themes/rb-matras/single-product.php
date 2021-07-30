<?php

/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header('shop'); ?>

<?php while (have_posts()) : ?>
<?php the_post();
    global $product;
    $compare_in_cookie = isset($_COOKIE['wordpress_list_compare']) ? in_array($product->get_id(), explode(',', $_COOKIE['wordpress_list_compare'])) : false;
    $favorite_in_cookie =
        isset($_COOKIE['wordpress_list_favorite'])  ? in_array($product->get_id(), explode(',', $_COOKIE['wordpress_list_favorite'])) : false;
    ?>

<section class="product-one">
    <div class="container">
        <div class="product-one__inner">
            <div class="product-one__img-box">
                <img src="<?php echo get_the_post_thumbnail_url() ?>" alt="" class="product-one__img" />
            </div>
            <div class="product-one__content">
                <?php
                    wp_enqueue_script('wc-add-to-cart-variation');
                    $get_variations = count($product->get_children()) <= apply_filters('woocommerce_ajax_variation_threshold', 30, $product);
                    $available_variations = $get_variations ? $product->get_available_variations() : false;
                    $attributes = $product->get_variation_attributes();
                    $selected_attributes = $product->get_default_attributes();

                    $attribute_keys  = array_keys($attributes);
                    $variations_json = wp_json_encode($available_variations);
                    $variations_attr = function_exists('wc_esc_json') ? wc_esc_json($variations_json) : _wp_specialchars($variations_json, ENT_QUOTES, 'UTF-8', true); ?>
                <form class="variations_form cart"
                    action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>"
                    method="post" enctype='multipart/form-data'
                    data-product_id="<?php echo absint($product->get_id()); ?>"
                    data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. 
                                                                                                                                                                                                                                                                                                            ?>">


                    <div class="product-one__head">
                        <h2 class="product-one__title"><?php the_title() ?></h2>
                        <button type="button" class="product-one__btn-diff" data-path="modal-material">
                            В чем отличие?
                        </button>
                    </div>
                    <div class="product-one__text">

                        <?php echo wpautop($product->get_description()) ?>
                    </div>

                    <div class="product-one__tabs">
                        <ul class="product-one__tabs-list">
                            <li class="product-one__tabs-item">
                                <button type="button" class="product-one__tabs-btn product-one__tabs-btn--active"
                                    data-tabs-path="details">
                                    Детали и размеры
                                </button>
                            </li>
                            <li class="product-one__tabs-item">
                                <button type="button" class="product-one__tabs-btn" data-tabs-path="char">
                                    Характеристики
                                </button>
                            </li>
                            <li class="product-one__tabs-item">
                                <button type="button" class="product-one__tabs-btn" data-tabs-path="composition">
                                    Состав
                                </button>
                            </li>
                        </ul>

                        <div class="product-one__tabs-content product-one__tabs-content--active"
                            data-tabs-target="details">
                            <div class="product-one__tabs-content-inner">

                                <?php do_action('woocommerce_before_variations_form'); ?>

                                <?php if (empty($available_variations) && false !== $available_variations) : ?>
                                <p class="stock out-of-stock">
                                    <?php echo esc_html(apply_filters('woocommerce_out_of_stock_message', __('This product is currently out of stock and unavailable.', 'woocommerce'))); ?>
                                </p>
                                <?php else : ?>
                                <div class="variations">

                                    <?php foreach ($attributes as $attribute_name => $options) : ?>

                                    <!-- <td class="label"><label
                                                    for="<?php echo esc_attr(sanitize_title($attribute_name)); ?>"><?php echo wc_attribute_label($attribute_name); // WPCS: XSS ok. 
                                                                                                                    ?></label>
                                            </td> -->

                                    <?php
                                                wc_dropdown_variation_attribute_options(
                                                    array(
                                                        'options'   => $options,
                                                        'attribute' => $attribute_name,
                                                        'product'   => $product,
                                                        'selected' => $options[1],
                                                        'show_option_none' => ''
                                                    )
                                                );
                                                // echo end($attribute_keys) === $attribute_name ? wp_kses_post(apply_filters('woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__('Clear', 'woocommerce') . '</a>')) : '';

                                                ?>

                                    <?php endforeach; ?>

                                </div>


                                <?php endif; ?>

                                <?php do_action('woocommerce_after_variations_form'); ?>
                                <!-- 
                                <select name="select_size" id="select_size"
                                    class="product-one__select select select--disable">
                                    <option value="80х190"></option>
                                    <option value="90х190"></option>
                                    <option value="120х190"></option>
                                    <option value="140х190"></option>
                                    <option value="160х190"></option>
                                    <option value="180х190"></option>
                                    <option value="200х190"></option>
                                    <option value="80х195"></option>
                                    <option value="90х195"></option>
                                    <option value="120х195"></option>
                                    <option value="140х195"></option>
                                    <option value="160х195"></option>
                                    <option value="180х195"></option>
                                    <option value="200х195"></option>
                                    <option value="80х200"></option>
                                    <option value="90х200"></option>
                                    <option value="120х200"></option>
                                    <option value="140х200"></option>
                                    <option value="160х200"></option>
                                    <option value="180х200"></option>
                                    <option value="200х200"></option>
                                </select>

                                <select name="select_chehol" id="select_chehol" class="product-one__select select_size">
                                    <option value="Хлопковый жаккард, несъемный"></option>
                                    <option value="Трикотаж, несъемный"></option>
                                    <option value="Трикотаж, съемный"></option>
                                    <option value="Велюр брендовый, съемный"></option>
                                    <option value="Чехол"></option>
                                    <option value="Велюр брендовый, несъемный"></option>
                                </select> -->
                            </div>
                        </div>
                        <div class="product-one__tabs-content" data-tabs-target="char">
                            <div class="product-one__tabs-content-inner">
                                <ul class="product-one__list list">
                                    <li class="list__item">Natural Foam 2,5см</li>
                                    <li class="list__item">Войлок</li>
                                    <li class="list__item">Кокос 3см (Н=21)</li>
                                    <li class="list__item">
                                        Независимый пакетно – пружинный блок (255 пр./м2)
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-one__tabs-content" data-tabs-target="composition">
                            <div class="product-one__tabs-content-inner">
                                <ul class="product-one__list list">
                                    <li class="list__item">
                                        <span>Жёсткость:</span> Мягкая/Жесткая
                                        <button type="button">
                                            <span class="info">
                                                <div class="info-popup">
                                                    Жесткость матраса с первой и второй стороны
                                                </div>
                                            </span>
                                        </button>
                                    </li>
                                    <li class="list__item"><span>Вес:</span> до 100кг</li>
                                    <li class="list__item"><span>Зоны жесткости:</span> 5 зон</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="product-one__info"><?php do_action('woocommerce_single_variation'); ?>


                        <button type="button" data-graph-path="first"
                            class="product-one__test-btn btn btn-md btn--hide-icon btn--outline" data-path="modal-test">
                            Тест<span>ировать</span>
                        </button>
                        <button type="button"
                            class="product-one__favorites-btn <?php if ($favorite_in_cookie)  echo " product-one__favorites-btn--active" ?>"></button>
                        <button type="button"
                            class="product-one__compare-btn <?php if ($compare_in_cookie)  echo " product-one__compare-btn--active" ?>"></button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>


<?php endwhile; // end of the loop. 
?>

<?php $args = array(
    'post_type' => 'product',
    'orderby' => 'ASC',
    'post__in' => wc_get_related_products(get_the_ID(), 6)
);

$loop = new WP_Query($args); ?>



<section class="product-similar">
    <div class="container">
        <div class="product-similar__inner">
            <h2 class="product-similar__title-h2 title-h2">Похожие товары</h2>
            <div class="
          product-similar__container
          swiper-container swiper-container-product-similar
        ">


                <div class="product-similar__wrapper product-list swiper-wrapper">

                    <?php if ($loop->have_posts()) {
                        while ($loop->have_posts()) : $loop->the_post();

                            echo     get_product_html();

                        endwhile;
                        wp_reset_query();
                    } ?>
                </div>
            </div>
            <div class="swiper-button-next swiper-button-next-product-similar"></div>
            <div class="swiper-button-prev swiper-button-prev-product-similar"></div>
        </div>
    </div>
</section>

<!-- @@include('parts/_product.html') @@include('parts/_product.html')
                    @@include('parts/_product.html') @@include('parts/_product.html')
                    @@include('parts/_product.html') @@include('parts/_product.html') -->
<!-- <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div>
          <div class="product swiper-slide">
            <div class="product__btn-icon-box">
              <div class="product__sale">30%</div>
              <button class="product__btn-icon-compare"></button>
              <button class="product__btn-icon-favorites"></button>
            </div>

            <img src="img/product_01.webp" alt="" class="product__img" />
            <span class="product__title">Мазурка Кормфорт+</span>
            <ul class="product__list">
              <li class="product__list-item">
                <span> Жёсткость:</span> Мягкая/Жесткая
              </li>
              <li class="product__list-item"><span>Вес:</span> до 100кг</li>

              <li class="product__list-item">
                <span> Размеры:</span> от 80х200
              </li>
            </ul>
            <div class="product__box">
              <span class="product__price">14 960 р.</span>
              <button class="product__btn-cart btn btn-sm">В корзину</button>
            </div>
          </div> -->







<div class="modals">
    <div class="modal-overlay">
        <?php get_template_part('template-parts/modals/content-modal-add-cart'); ?>
        <?php get_template_part('template-parts/modals/content-modal-material'); ?>
        <?php get_template_part('template-parts/modals/content-modal-test-thanks'); ?>
        <?php get_template_part('template-parts/modals/content-modal-test'); ?>
    </div>
</div>

<?php
get_footer('shop');

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */