<div class="container">
    <div class="catalog__inner grid inner">
        <div class="catalog__reset">
            <div class="catalog__reset-list"></div>
            <!-- <button class="catalog__reset-all-btn">Сбросить</button>
                <button class="catalog__reset-btn">Стандарт класс</button>
                <button class="catalog__reset-btn">разносторонний</button>
                <button class="catalog__reset-btn">Стандарт класс</button>
                <button class="catalog__reset-btn">подростковые</button>
                <button class="catalog__reset-btn">жесткий</button>
                <button class="catalog__reset-btn">Стандарт класс</button>
                <button class="catalog__reset-btn">Бизнес класс</button>
                <button class="catalog__reset-btn">Стандарт класс</button>
                <button class="catalog__reset-btn">Беспружинный</button> -->
        </div>
        <div class="catalog__sort">
            <div class="catalog__sort-title">Матрасы</div>
            <div class="catalog__sort-box">
                <div class="sort-radio-box">
                    <input type="radio" name="sort_radio" checked class="sort-radio" id="sort_price" />
                    <label for="sort_price" class="label-sort-radio"> По цене </label>
                </div>
                <div class="sort-radio-box">
                    <input type="radio" name="sort_radio" class="sort-radio" id="sort_name" />
                    <label for="sort_name" class="label-sort-radio">По названию </label>
                </div>
                <div class="sort-radio-box">
                    <input type="radio" name="sort_radio" class="sort-radio" id="sort_population" />
                    <label for="sort_population" class="label-sort-radio">По популярности
                    </label>
                </div>
                <div class="sort-radio-box">
                    <input type="radio" name="sort_radio" class="sort-radio" id="sort_new" />
                    <label for="sort_new" class="label-sort-radio">По новизне </label>
                </div>
            </div>

            <div class="catalog__sort-box-mobile">
                <select class="catalog__sort-select-mobile">
                    <option value="По популярности"></option>
                    <option value="По цене"></option>
                    <option value="По названию"></option>
                </select>
                <select class="catalog__sort-select-mobile">
                    <option value="Быстрый фильтр"></option>
                    <option value="Эконом класс"></option>
                    <option value="Стандарт класс"></option>
                    <option value="Премиум класс"></option>
                    <option value="Беспружинные матрасы"></option>
                    <option value="Детские матрасы"></option>
                </select>
                <button class="catalog__sort-filter"></button>
            </div>
        </div>
        <aside class="catalog__filter">
            <div class="catalog__filter-header">
                <span class="catalog__filter-title">Фильтр</span>
                <button class="catalog__filter-btn-close"></button>
            </div>
            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">

                <?php if (is_page('favorites')) { ?>

                <?php } else { ?>
                    <div class="catalog__filter-list">
                        <div class="catalog__filter-item">
                            <div class="catalog__filter-head" aria-expanded="false">
                                Стоимость, руб
                            </div>
                            <div class="catalog__filter-content" aria-hidden="true">
                                <div class="catalog__filter-range-box">
                                    <div class="catalog__filter-range-input-box">
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="0" max="258313" placeholder="от" id="price-range-slider-input-0" name='price_min' /></label>
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="0" max="258313" placeholder="до" id="price-range-slider-input-1" name='price_max' /></label>
                                    </div>
                                    <div class="catalog__filter-range-slider-box">
                                        <div class="catalog__filter-range-slider" id="price-range-slider"></div>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-min
                      " id="price-range-slider-text-0"></span>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-max
                      " id="price-range-slider-text-1"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="catalog__filter-item">
                            <div class="catalog__filter-head" aria-expanded="false">
                                Ширина, см
                            </div>
                            <div class="catalog__filter-content" aria-hidden="true">
                                <div class="catalog__filter-range-box">
                                    <div class="catalog__filter-range-input-box">
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="60" max="200" placeholder="от" id="width-range-slider-input-0" name='width_min' /></label>
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="60" max="200" placeholder="до" id="width-range-slider-input-1" name='width_max' /></label>
                                    </div>
                                    <div class="catalog__filter-range-slider-box">
                                        <div class="catalog__filter-range-slider" id="width-range-slider"></div>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-min
                      " id="width-range-slider-text-0"></span>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-max
                      " id="width-range-slider-text-1"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="catalog__filter-item">
                            <div class="catalog__filter-head" aria-expanded="false">
                                Длина, см
                            </div>
                            <div class="catalog__filter-content" aria-hidden="true">
                                <div class="catalog__filter-range-box">
                                    <div class="catalog__filter-range-input-box">
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="120" max="200" placeholder="от" id="height-range-slider-input-0" name='height_min' /></label>
                                        <label class="label-range-input">
                                            <input type="number" class="range-input" min="120" max="200" placeholder="до" id="height-range-slider-input-1" name='height_max' /></label>
                                    </div>
                                    <div class="catalog__filter-range-slider-box">
                                        <div class="catalog__filter-range-slider" id="height-range-slider"></div>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-min
                      " id="height-range-slider-text-0"></span>
                                        <span class="
                        catalog__filter-range-slider-text
                        catalog__filter-range-slider-text-max
                      " id="height-range-slider-text-1"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php


                        // var_dump(get_field('filler_block-type', 'pa_filler' . '_' . $terms[0]->term_id));
                        // var_dump($terms) 
                        ?>

                        <?php
                        $fillers = get_fillers();
                        ?>
                        <?php foreach ($fillers as $filler) { ?>
                            <div class="catalog__filter-item">
                                <div class="catalog__filter-head" aria-expanded="false">
                                    <?php echo $filler['label'] ?>
                                </div>
                                <div class="catalog__filter-content" aria-hidden="true">
                                    <?php foreach ($filler['choices'] as $key => $value) { ?>
                                        <label class="label-checkbox"><input type="checkbox" class="checkbox" name='<?php echo $key ?>' value='<?php echo $key ?>' /><?php echo $value ?></label>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>


                        <?php $filters = get_filters() ?>
                        <?php foreach ($filters as $filter) { ?>
                            <div class="catalog__filter-item">
                                <div class="catalog__filter-head" aria-expanded="false">
                                    <?php echo $filter['label'] ?>
                                </div>
                                <div class="catalog__filter-content" aria-hidden="true">
                                    <?php foreach ($filter['choices'] as $key => $value) { ?>
                                        <label class="label-checkbox"><input type="checkbox" class="checkbox" name='<?php echo $key ?>' value='<?php echo $key ?>' /><?php echo $value ?></label>
                                    <?php } ?>

                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>


                <input type="hidden" name="action" value="myfilter">
                <input type="hidden" name="page" value="<?php if (is_front_page()) {
                                                            echo 'home';
                                                        } else if (is_page('favorites')) {
                                                            echo 'favorites';
                                                        }
                                                        ?>">

            </form>

            <div class="catalog__fast-filter">
                <span class="catalog__fast-filter-title">Быстрый фильтр</span>
                <div class="catalog__fast-filter-content">
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Эконом класс</label>
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Стандарт класс</label>
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Бизнес класс</label>
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Премиум класс</label>
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Беспружинные
                        матрасы</label>
                    <label class="label-checkbox"><input type="checkbox" class="checkbox" />Детские матрасы</label>
                </div>
            </div>
            <div class="catalog__filter-btn-box">
                <button class="catalog__filter-btn-apply btn btn--hide-icon">
                    Показать (200)
                </button>
                <button class="catalog__filter-btn-reset btn btn--disable btn--hide-icon">
                    Сбросить
                </button>
            </div>
        </aside>
        <div class="catalog__content">
            <div class="catalog__product-list product-list"></div>
            <button class="catalog__btn-more btn btn-md btn--hide-icon">
                Показать еще
            </button>
        </div>
    </div>
</div>




<?php
// $attr_taxonomy = 'pa_case'; // Product attribute
// $attribute_term_slugs = array('jersey-emovable'); // <== Need to be term SLUGs

// $args = array(
//     'post_type'       => 'product_variation',
//     'post_status'   => 'publish',
//     'posts_per_page' => 10,
//     'groupby'        => 'post_parent',
//     'fields'         => 'id=>parent',
//     'post_parent__in' => get_variation_parent_ids_from_term("Матрас", 'product_cat', 'name'), // Variations

//     'meta_query'      => array(
//         'relation'    => 'AND',
//         //         array(
//         //             'key'     => '_price',
//         //             'value'   => array(10000, 20000),
//         //             'compare' => 'BETWEEN',
//         //   'type' => 'NUMERIC'
//         //         ),
//         array(
//             'key'     => '_price',
//             'value'   => 0,
//             'compare' => '>',
//             'type' => 'NUMERIC'
//         ),

//         array(
//             'key'     => 'attribute_' . $attr_taxonomy, // Product variation attribute
//             'value'   => $attribute_term_slugs, // Term slugs only
//             'compare' => 'IN',
//         ),
//    array(
//             'key'     => '_width',
//             'value'   => "250",
//             'compare' => '=',
//             'type' => 'NUMERIC'
//         ),



//    ),
//  'tax_query' => array(

//     array(
//         'taxonomy' => 'product_cat',
//         'field' => 'slug',
//         'terms' => 'matras'
//     ),

// ),
//    );

// $loop_child = new WP_Query($args);
// var_dump($loop_child->posts);
// $parent_ids = wp_list_pluck($loop_child->posts, 'post_parent');
// var_dump($parent_ids);

// $args_new = array(
//     'post_type' => 'product', 'post_status'   => 'publish',
//     'post__in'  => $parent_ids,
//     'meta_query'      => array(
//         'relation'    => 'AND',
//   array(
//     'key'     => 'filter_hardness',
//     'value'   => 'hard',
//     'compare' => 'IN'
// ),


//     ),

// );

// $loop = new WP_Query($args_new);


//'post_parent__in' => get_variation_parent_ids_from_term( 'Матрас', 'product_cat', 'name' ), // Variations

//         'meta_query'      => array(
// 'relation'    => 'AND',
//         array(
//             'key'     => '_price',
//             'value'   => 0,
//             'compare' => '>'
//         ),
//           array(
//             'key'     => 'filter_hardness',
//             'value'   => 'мягкий',
//             'compare' => 'IN'
//         ),
// array( 
//     'key'     => 'attribute_'.$attr_taxonomy, // Product variation attribute
//     'value'   => $attribute_term_slugs, // Term slugs only
//     'compare' => 'IN',
// ),

//),


//   $args = array(
//         'post_type'       => 'product',
//         'posts_per_page' => 10,
//         'post_status'     => 'publish',

//     );

?>