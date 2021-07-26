<?php global $product;
var_dump($product->get_id()) ?>
<div class="modal modal-add-cart" data-target="modal-add-cart">
    <div class="modal__head">
        <h3 class="modal__title">Товар добавлен в корзину!</h3>
        <button class="modal__btn-close"></button>
    </div>
    <div class="modal-add-cart__content">
        <div class="modal-add-cart__product">
            <div class="modal-add-cart__product-content">
                <div class="modal-add-cart__product-img-box">
                    <img src="img/product_01.webp" alt="" class="modal-add-cart__product-img" />
                </div>
                <div class="modal-add-cart__product-box">
                    <span class="modal-add-cart__product-title"></span>
                    <ul class="modal-add-cart__product-list">
                        <!-- <li class="modal-add-cart__product-list-item">
              <span>Жёсткость:</span> Мягкая/Жесткая
            </li>
            <li class="modal-add-cart__product-list-item">
              <span>Вес:</span>
              до 100кг
            </li>
            <li class="modal-add-cart__product-list-item">
              <span> Зоны жесткости:</span>
              5 зон
            </li>
            <li class="modal-add-cart__product-list-item">
              <span>Размер:</span>
              140 х 200
            </li>
            <li class="modal-add-cart__product-list-item">
              <span>Чехол:</span>
              Х/б жаккард несъемный
            </li> -->
                    </ul>
                </div>
            </div>
            <span class="modal-add-cart__product-price"></span>
        </div>
        <div class="modal-add-cart__btn-box">
            <button class="modal-add-cart__btn-continue btn btn--outline" data-path-close="modal-add-cart">
                Продолжить покупки
            </button>
            <a href="<?php echo wc_get_checkout_url() ?>" class="modal-add-cart__btn-ordering btn">
                Оформить заказ
            </a>
        </div>
    </div>
</div>