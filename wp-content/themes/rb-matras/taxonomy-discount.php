<?php get_header() ?>
<section class="discount">
    <div class="container">
        <div class="discount__inner inner">
            <h2 class="discount__title-h2 title-h2">Акции</h2>
            <div class="discount__banner-inner">
                <div class="
            discount__banner-container
            swiper-container swiper-container-discount
          ">
                    <div class="
              discount__banner-wrapper
              swiper-wrapper swiper-wrapper-discount
            ">

                        <?php
                        // get the current taxonomy term
                        $tax_name = 'discount';
                        $discounts = get_terms('discount', array('hide_empty' => false, 'parent' => 0));
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



                            <div class="discount__banner-item swiper-slide swiper-slide-discount" id='<?php echo $key->slug ?>'>
                                <div class="discount__banner-content">
                                    <picture>
                                        <source srcset="<?php echo get_field('discount_img-discount-tablet', $term_id) ?>" media="(max-width: 769px)" />
                                        <img class="discount__banner-img" src="<?php echo get_field('discount_img-discount-desktop', $term_id) ?>" alt="" />
                                    </picture>
                                    <h1 class="discount__banner-title">
                                        <?php echo str_replace(array('[', ']'), array('<span>', '</span>'), $key->name)  ?>
                                    </h1>
                                    <span class="discount__banner-subtitle">
                                        <?php echo get_field('discount_subtitle', $term_id) ?></span>
                                </div>
                            </div>



                            <?php $count_discount++; ?>

                        <?php  }  ?>
                    </div>
                </div>
                <!-- <div class="swiper-button-prev swiper-button-prev-discount"></div>
        <div class="swiper-button-next swiper-button-next-discount"></div> -->
                <div class="category__box">
                    <!-- <div class="swiper-scrollbar"></div> -->
                    <div class="swiper-pagination swiper-pagination-category"></div>
                    <div class="category__btn-box">
                        <div class="swiper-button-prev swiper-button-prev-discount"></div>
                        <div class="swiper-button-next swiper-button-next-discount"></div>
                    </div>
                </div>
            </div>
            <form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter">
                <input type="hidden" name="action" value="myfilter">
                <input type="hidden" name="discount_term" value="">
                <input type="hidden" name="page" value="<?php if (is_front_page()) {
                                                            echo 'home';
                                                        } else if (is_page('favorites')) {
                                                            echo 'favorites';
                                                        } else if (is_tax('discount')) {
                                                            echo 'discount';
                                                        }
                                                        ?>">

            </form>
            <div class="discount__product-list product-list product-list--full"></div>

            <button class="catalog__btn-more btn btn-md btn--hide-icon">
                Показать еще
            </button>
        </div>
    </div>
</section>
<script>
    // document.querySelector('.BUTTON').addEventListener('click', function() {

    //     history.pushState(null, null, "?" + 'lofo');

    // })
</script>
<?php get_footer() ?>