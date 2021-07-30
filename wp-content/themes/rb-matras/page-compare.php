<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>

<section class="compare">
    <div class="container compare__container">
        <div class="compare__inner inner">
            <h2 class="compare__title-h2 title-h2"><?php single_post_title(); ?></h2>
            <?php if (isset($_COOKIE['wordpress_list_compare'])) { ?>
            <div class="compare__grid-mask">
                <div class="compare__grid-mask-blur"></div>
                <div class="compare__grid">
                    <div class="compare__grid-prop">Товар:</div>
                    <div class="compare__grid-prop">
                        Состав: <span class="compare__info"></span>
                    </div>
                    <div class="compare__grid-prop">
                        Жесткость: <span class="compare__info"></span>
                    </div>
                    <div class="compare__grid-prop">Высота:</div>
                    <div class="compare__grid-prop">Класс:</div>
                    <div class="compare__grid-prop">
                        Зоны жесткости:
                        <span class="compare__info"></span>
                    </div>
                    <div class="compare__grid-prop">Чехол:</div>
                    <div class="compare__grid-prop">Наличие:</div>
                    <div class="compare__grid-prop">Стоимость:</div>
                    <?php $args_child = array(
                            'post_type' => 'product_variation',
                            'post_status' => 'publish',
                            'groupby' => 'post_parent',
                            'fields' => 'id=>parent',
                            'post_parent__in' => explode(',', $_COOKIE['wordpress_list_compare'])
                        );
                        $query_child = new WP_Query($args_child);

                        $parent_ids = wp_list_pluck($query_child->posts, 'post_parent');


                        if (!empty($parent_ids)) {
                            $args_parent = array(
                                'post_type' => 'product',
                                'post__in' => $parent_ids,
                                'posts_per_page' => 4,
                            );

                            $query_parent = new WP_Query($args_parent);
                            $count = 4;
                            while ($query_parent->have_posts()) : $query_parent->the_post() ?>

                    <?php
                                global $product;
                                $variation = get_variation_with_min_price($product) ?>
                    <div class="compare__grid-title"><?php echo  get_the_title() ?></div>
                    <div class="compare__grid-data">
                        <ul class="compare__grid-list list list">
                            <li class="list__item">Natural Foam 2,5см</li>
                            <li class="list__item">Войлок</li>
                            <li class="list__item">Независимые пружины (255 пр./м2)</li>
                            <li class="list__item">Кокос 3см (Н=21)</li>
                        </ul>
                    </div>
                    <div class="compare__grid-data"><?php the_field('filter_hardness') ?></div>
                    <div class="compare__grid-data"><?php echo $variation['dimensions']['width'] . ' см'  ?></div>
                    <div class="compare__grid-data"><?php the_field('filter_weight') ?></div>
                    <div class="compare__grid-data">5 зон</div>
                    <div class="compare__grid-data"><?php
                                                                ?></div>
                    <div class="compare__grid-data">Есть на складе</div>
                    <div class="compare__grid-price">
                        <span> <?php echo wc_price($variation['display_price']) ?></span>
                        <button class="compare__grid-btn-cart btn btn--hide-icon" data-path="modal-add-cart">
                            В корзину
                        </button>
                        <input type="hidden" name="product_id" value="<?php echo absint($product->get_id()) ?>" />
                        <a href="<?php echo home_url() . '/compare' ?>" class="compare__grid-btn-remove btn--hide-icon">
                            Удалить
                        </a>
                    </div>
                    <?php $count--;
                            endwhile;
                            while ($count != 0) { ?>
                    <div class="
              compare__grid-title
              compare__grid-title--empty
              compare__grid-cell--empty
            "></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-data compare__grid-cell--empty"></div>
                    <div class="compare__grid-price compare__grid-cell--empty"></div>
                    <?php
                                $count--;
                            }
                            wp_reset_query();
                        } else {
                            echo ('No Resault');
                        }
                        ?>
                </div>
            </div>

            <div class="compare__scroll">
                <div class="compare__scroll-progress-bar-container">
                    <div class="compare__scroll-progress-bar"></div>
                </div>
                <button class="
            compare__scroll-btn-left
            compare__scroll-btn
            compare__scroll-btn--disabled
          "></button>
                <button class="compare__scroll-btn-right compare__scroll-btn"></button>
                <?php } else { ?>
                <p>No resault</p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>



<div class="modals">
    <div class="modal-overlay">@@include('parts/modals/_add-cart.html/')</div>
</div>

<?php get_footer() ?>