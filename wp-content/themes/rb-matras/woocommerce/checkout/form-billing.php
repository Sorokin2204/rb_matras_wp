<?php

/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>
<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
<div class="ordering-steps">
    <ul class="ordering-steps__list">
        <li class="ordering-steps__list-item">
            <h3 class="ordering-steps__title">1. Информация о покупателе</h3>
            <div class="ordering-steps__info">
                <?php
                $fields = $checkout->get_checkout_fields('billing');
                //var_dump($fields);
                foreach ($fields as $key => $field) {
                    //	var_dump($field);
                    if ($key == 'billing_first_name' || $key == 'billing_phone' || $key == 'billing_email') {
                ?>

                <div class="ordering-steps__info-name input-box">
                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                    <label for="<?php echo $key ?>" class="input-label"><?php echo $field['label'] ?></label>
                    <span>Обязательное поле</span>
                </div>

                <?php
                    }
                }
                ?>

                <!-- <div class="ordering-steps__info-name input-box">
					<input type="text" class="input" placeholder="Имя*" name="info-name" required />
					<label for="info-name" class="input-label">Имя*</label>
					<span>Обязательное поле</span>
				</div>
				<div class="ordering-steps__info-tel input-box">
					<input type="text" class="input" placeholder="Номер телефона*" name="info-tel" required />
					<label for="info-tel" class="input-label">Номер телефона*</label>
					<span>Обязательное поле</span>
				</div>
				<div class="ordering-steps__info-email input-box">
					<input type="email" class="input" placeholder="Имя*" name="info-email" required />
					<label for="info-email" class="input-label">Email</label>
					<span>Не корректное значение</span>
				</div> -->
            </div>
        </li>
        <li class="ordering-steps__list-item">
            <h3 class="ordering-steps__title">2. Доставка</h3>
            <div class="ordering-steps__delivery">

                <?php
                $fields = $checkout->get_checkout_fields('billing');
                //var_dump($fields);
                foreach ($fields as $key => $field) {
                    //	var_dump($key);
                    if ($key == 'billing_city' || $key == 'billing_address_1' || $key == 'billing_address_2' || $key == 'billing_address_3') {
                ?>

                <div class="ordering-steps__delivery-input input-box">
                    <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
                    <label for="<?php echo $key ?>" class="input-label"><?php echo $field['label'] ?></label>
                    <span>Обязательное поле</span>
                </div>

                <?php
                    }
                }
                ?>

                <!-- <div class="ordering-steps__delivery-input input-box">
					<input type="text" class="input city" placeholder="Город*" name="delivery-city" value="" onchange="this.setAttribute('value', this.value);" />
					<label for="delivery-city" class="input-label">Город</label>
				</div>
				<div class="ordering-steps__delivery-input input-box">
					<input type="text" class="input street" placeholder="Улица, микрорайон, жк и тд.*" name="delivery-street" value="" onchange="this.setAttribute('value', this.value);" />
					<label for="delivery-street" class="input-label">Улица, микрорайон, жк и тд.</label>
				</div>
				<div class="ordering-steps__delivery-input input-box">
					<input type="text" class="input house" placeholder="Дом, строение*" name="delivery-building" value="" onchange="this.setAttribute('value', this.value);" />
					<label for="delivery-building" class="input-label">Дом, строение</label>
				</div>
				<div class="ordering-steps__delivery-input input-box">
					<input type="text" class="input" placeholder="Квартира, офис" name="delivery-apartment" value="" onchange="this.setAttribute('value', this.value);" />
					<label for="delivery-apartment" class="input-label">Квартира, офис</label>
				</div> -->
            </div>
        </li>
        <li class="ordering-steps__list-item">
            <div class="ordering-steps__payment">
                <div class="ordering-steps__payment-type">
                    <h3 class="ordering-steps__title">3. Оплата</h3>
                    <div class="ordering-steps__payment-type-list">
                        <input type="radio" name="payment_radio" checked id="payment_cash" />
                        <label for="payment_cash">Наличными при доставке</label>
                        <input type="radio" name="payment_radio" id="payment_installment" disabled />
                        <label for="payment_installment">Рассрочка от Сбербанка</label>
                        <input type="radio" name="payment_radio" id="payment_online-pay" disabled />
                        <label for="payment_online-pay">Онлайн оплата</label>

                    </div>
                </div>
                <div class="ordering-steps__payment-comment">
                    <?php do_action('woocommerce_before_order_notes', $checkout); ?>

                    <?php if (apply_filters('woocommerce_enable_order_notes_field', 'yes' === get_option('woocommerce_enable_order_comments', 'yes'))) : ?>

                    <h3 class="ordering-steps__payment-comment-title">
                        Комментарий к заказу
                    </h3>




                    <div class="ordering-steps__payment-comment-textarea input-box">
                        <textarea class="input-text input" id='order_comments' name='order_comments'
                            placeholder="Комментарии к заказу (по желанию)" cols="30" rows="4" value=""
                            onchange="this.setAttribute('value', this.value);"></textarea>
                        <label for="order_comments" class="input-label">Комментарии к заказу (по желанию)</label>
                    </div>



                    <?php endif; ?>

                    <?php do_action('woocommerce_after_order_notes', $checkout); ?>
                </div>
            </div>
        </li>
    </ul>
</div>
<div class="ordering-footer">
    <div class="ordering-footer__promocode">
        <div class="input-box">
            <input type="text" class="input" placeholder="У меня есть промокод" name="delivery-apartment" value=""
                onchange="this.setAttribute('value', this.value);" />
            <label for="delivery-apartment" class="input-label">У меня есть промокод</label>
        </div>

        <!-- <input type="text" class="input" placeholder="У меня есть промокод" /> -->
        <button class="ordering-footer__btn-apply btn btn-md btn--hide-icon">
            Применить
        </button>
    </div>
    <div class="ordering-footer__total">
        <ul class="ordering-footer__total-list">
            <li class="ordering-footer__total-list-item">
                <span>Сумма заказа:</span><?php wc_cart_totals_order_total_html(); ?>
            </li>
            <!-- <li class="ordering-footer__total-list-item">
                <span>Доставка:</span>500 р.
            </li>
            <li class="ordering-footer__total-list-item">
                <span>Скидка:</span>0 р.
            </li> -->
            <li class="ordering-footer__total-list-item">
                <span>Итого:</span><?php wc_cart_totals_order_total_html(); ?>
            </li>
        </ul> <?php echo apply_filters('woocommerce_order_button_html', '<button type="submit" class="ordering-footer__btn btn" name="woocommerce_checkout_place_order" id="place_order" value="Оформить заказ" data-value="Оформить заказ">Оформить заказ</button>'); // @codingStandardsIgnoreLine 
                ?>

    </div>
</div>

<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>





<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
<div class="woocommerce-account-fields">
    <?php if (!$checkout->is_registration_required()) : ?>

    <p class="form-row form-row-wide create-account">
        <label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
            <input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount"
                <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?>
                type="checkbox" name="createaccount" value="1" />
            <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
        </label>
    </p>

    <?php endif; ?>

    <?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

    <?php if ($checkout->get_checkout_fields('account')) : ?>

    <div class="create-account">
        <?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
        <?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
        <?php endforeach; ?>
        <div class="clear"></div>
    </div>

    <?php endif; ?>

    <?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
</div>
<?php endif; ?>