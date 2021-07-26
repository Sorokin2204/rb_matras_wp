<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rb_matras
 */

?>



<footer class="footer">
    <div class="container">
        <div class="footer__inner">
            <div class="footer__col">
                <img src="<?php echo get_custom_logo_uri() ?>" alt="" class="footer__img" />
                <div class="footer__copy">
                    © 2002 - 2021 RBmatras.com <br />Все права защищены
                </div>
            </div>

            <div class="footer__col">
                <span class="footer__title">Покупателям</span>
                <ul class="footer__list">
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">О компании</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Оплата</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Доставка</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Гарантия</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Каталог</a>
                    </li>
                </ul>
            </div>

            <div class="footer__col">
                <span class="footer__title">Дополнительно</span>
                <ul class="footer__list">
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Партнерская программа</a>
                    </li>
                    <li class="footer__list-item">
                        <a href="#" class="footer__list-link">Акции</a>
                    </li>
                </ul>
            </div>

            <div class="footer__col">
                <div class="footer__info">
                    <div class="footer__info-head">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon/call.svg" alt=""
                            class="footer__info-img" />
                        <span class="footer__info-bold">Контакты</span>
                    </div>
                    <div class="footer__info-box">
                        <span class="footer__info-bold">
                            <?php echo the_field('widget_phone', 'widget_general_widget-2') ?></span>
                        <a href="tel:+79636939881" class="footer__info-link link">Заказать звонок</a>
                    </div>
                    <div class="footer__info-box">
                        <a href="mailto:<?php echo the_field('widget_email', 'widget_general_widget-2')  ?>"
                            class="footer__info-bold">
                            <?php echo the_field('widget_email', 'widget_general_widget-2') ?></a>
                        <span class="footer__info-text">по всем вопросам</span>
                    </div>
                </div>
            </div>

            <div class="footer__col">
                <div class="footer__info">
                    <div class="footer__info-head">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon/time.svg" alt=""
                            class="footer__info-img" />
                        <span class="footer__info-bold">График работы</span>
                    </div>
                    <div class="footer__info-box">
                        <span class="footer__info-bold">
                            <?php echo the_field('widget_work-time-weekdays', 'widget_general_widget-2') ?></span>
                        <span class="footer__info-text">
                            <?php echo the_field('widget_work-days-weekdays', 'widget_general_widget-2') ?></span>
                    </div>
                    <div class="footer__info-box">
                        <span class="footer__info-bold">
                            <?php echo the_field('widget_work-time-weekend', 'widget_general_widget-2') ?></span>
                        <span class="footer__info-text">
                            <?php echo the_field('widget_work-days-weekend', 'widget_general_widget-2') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>


</body>

</html>