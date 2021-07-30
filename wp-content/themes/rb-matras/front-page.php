<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rb_matras
 */

get_header();
?>

<section class="banner">
    <div class="container-fluid">
        <div class="banner__inner">
            <div class="banner__container swiper-container swiper-container-banner">
                <div class="banner__wrapper swiper-wrapper">
                    <?php
                    // get the current taxonomy term
                    $tax_name = 'writer';
                    $discounts = get_terms('writer', array('hide_empty' => false, 'parent' => 0));
                    $all_count_discount = count($discounts);
                    $count_discount = 1;
                    for ($i = 0; $i < $all_count_discount; $i++) {
                        $discounts[$i]->sort_order = get_field('discount_order', $tax_name . '_' . $discounts[$i]->term_id);
                    }
                    usort($discounts, 'my_sort_terms_function');
                    function my_sort_terms_function($a, $b)
                    {
                        // this function expects that items to be sorted are objects and
                        // that the property to sort by is $object->sort_order
                        if (
                            $a->sort_order == $b->sort_order
                        ) {
                            return 0;
                        } elseif ($a->sort_order < $b->sort_order) {
                            return -1;
                        } else {
                            return 1;
                        }
                    }
                    foreach ($discounts as $key) {
                        $term_id = $tax_name . '_' . $key->term_id;
                    ?>
                        <div class="banner__item swiper-slide" style="background-image: url(<?php echo get_field('discount_img-home-desktop', $term_id) ?> )">
                            <div class="container grid">
                                <div class="banner__item-inner">
                                    <span class="banner__item-date"><?php echo '0' . $count_discount . ' / ' . '0' . $all_count_discount ?></span>
                                    <h1 class="banner__item-title">
                                        <?php echo str_replace(array('[', ']'), array('<span>', '</span>'), $key->name)  ?>

                                    </h1>
                                    <span class="banner__item-subtitle">
                                        <?php echo get_field('discount_subtitle', $term_id) ?></span>
                                    <a href="<?php echo get_term_link($key->slug, $tax_name) ?>" class="banner__item-btn btn btn-lg">Смотреть подробнее</a>
                                </div>
                            </div>
                        </div>

                        <?php $count_discount++; ?>
                        <!-- var_dump(get_term_link($key->slug, 'writer'));
                    var_dump(get_field('discount_subtitle', $term_id));
                    var_dump(get_field('discount_img-home-desktop', $term_id));
                    var_dump(get_field('discount_img-discount-desktop', $term_id));
                    var_dump(get_field('discount_img-discount-tablet', $term_id));
                    var_dump(get_field('discount_percent', $term_id)); -->
                    <?php  }  ?>

                    <!-- <div class="banner__item swiper-slide" style="background-image: url('img/banner_01.webp')">
                        <div class="container grid">
                            <div class="banner__item-inner">
                                <span class="banner__item-date">01 / 03</span>
                                <h1 class="banner__item-title">
                                    Скидка&nbsp;<span>20%</span> на&nbsp;матрасы серии Анданте
                                </h1>
                                <span class="banner__item-subtitle">Акция действует до 15 апреля</span>
                                <a href="discount.html" class="banner__item-btn btn btn-lg">Смотреть подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner__item swiper-slide" style="background-image: url('img/banner_02.webp')">
                        <div class="container grid">
                            <div class="banner__item-inner">
                                <span class="banner__item-date">02 / 03</span>
                                <h1 class="banner__item-title">
                                    Скидка&nbsp;<span>10%</span> на&nbsp; матрасы серии Крещендо
                                </h1>
                                <span class="banner__item-subtitle">Акция действует до 15 апреля</span>
                                <a href="discount.html" class="banner__item-btn btn btn-lg">Смотреть подробнее</a>
                            </div>
                        </div>
                    </div>
                    <div class="banner__item swiper-slide" style="background-image: url('img/banner_03.webp')">
                        <div class="container grid">
                            <div class="banner__item-inner">
                                <span class="banner__item-date">03 / 03</span>
                                <h1 class="banner__item-title">
                                    Скидка&nbsp;<span>30%</span> на&nbsp;матрасы серии Морендо
                                </h1>
                                <span class="banner__item-subtitle">Акция действует до 15 апреля</span>
                                <a href="discount.html" class="banner__item-btn btn btn-lg">Смотреть подробнее</a>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="swiper-pagination swiper-pagination-banner"></div>
            </div>
        </div>
    </div>
</section>

<div class="catalog-footer">
    <div class="catalog__overlay"></div>
    <section class="catalog"><?php get_template_part('template-parts/content-catalog'); ?></section>

    <?php
    get_footer(); ?>
</div>