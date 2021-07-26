<?php global $product; ?>
<div class="product">
    <div class="product__btn-icon-box">
        <div class="product__sale"></div>
        <button class="product__btn-icon-compare" data-path="modal-add-cart"></button>
        <button class="product__btn-icon-favorites" data-path="modal-add-cart"></button>
    </div>

    <div class="product__img-box">
        <img src="<?php get_the_post_thumbnail_url() ?>" alt="" class="product__img" />
    </div>
    <a href="<?php get_permalink() ?>" class="product__title"><?php get_the_title() ?></a>
    <ul class="product__list">
        <li class="product__list-item">
            <span> Жёсткость:</span> <?php get_field('filter_hardness') ?>
            <button>
                <span class="info">
                    <div class="info-popup">
                        Жесткость матраса с первой и второй стороны
                    </div>
                </span>
            </button>
        </li>
        <li class="product__list-item"><span>Вес:</span> <?php get_field('filter_weight') ?></li>

        <li class="product__list-item"><span> Размеры:</span> от 80х200</li>
    </ul>
    <div class="product__box">
        <span class="product__price"><?php wc_price($product->get_variation_regular_price('min')) ?></span>
        <button class="product__btn-cart btn btn-sm" data-path="modal-add-cart">
            В корзине
        </button>
    </div>
</div>