<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rb_matras
 */

?>
<?php get_template_part('head'); ?>


<body <?php body_class(); ?>> <?php wp_body_open(); ?>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <div class="header__content">
                    <button class="header__menu-btn">
                        <div class="header__menu-btn-burger">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                        Меню
                    </button>
                    <a class="header__logo" href="<?php echo get_home_url() ?>"><img src="<?php echo get_custom_logo_uri() ?>" alt="" /></a>
                    <div class="header__info">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon/time.svg" alt="" class="header__info-img" />
                        <div class="header__info-box">
                            <span class="header__info-bold">
                                <?php echo the_field('widget_work-time-weekdays', 'widget_general_widget-2') ?></span>
                            <span class="header__info-text">
                                <?php echo the_field('widget_work-days-weekdays', 'widget_general_widget-2') ?></span>
                        </div>
                    </div>

                    <div class="header__info">
                        <div class="header__info-box">
                            <span class="header__info-bold"><?php echo the_field('widget_work-time-weekend', 'widget_general_widget-2') ?></span>
                            <span class="header__info-text"><?php echo the_field('widget_work-days-weekend', 'widget_general_widget-2') ?></span>
                        </div>
                    </div>

                    <div class="header__info">
                        <img src="<?php echo get_stylesheet_directory_uri() ?>/img/icon/call.svg" alt="" class="header__info-img" />
                        <div class="header__info-box">
                            <span class="header__info-bold">
                                <?php echo the_field('widget_phone', 'widget_general_widget-2') ?></span>
                            <a href="tel:+79636939881" class="header__info-link link">Заказать звонок</a>
                        </div>
                    </div>

                    <div class="header__box">

                        <button class="header__btn-icon">
                            <a href="<?php echo home_url() . '/compare' ?>" class="header__link-icon header__link-icon-compare">
                            </a>
                            <span class="header__count-icon"></span>
                        </button>
                        <button class="header__btn-icon">
                            <a href="<?php echo home_url() . '/favorites' ?>" class="header__link-icon header__link-icon-favorites"></a>
                            <span class="header__count-icon"></span>
                        </button>
                        <button class="header__btn-icon">
                            <a class="header__link-icon header__link-icon-cart"></a>
                            <span class="header__count-icon"></span>
                        </button>
                    </div>
                </div>
                <?php wp_nav_menu([
                    'theme_location' => 'menu-primary',
                    'container'       => 'nav',
                    'container_class' => 'header__nav nav',
                    'items_wrap'      => '<ul id="%1$s" class="nav__list">%3$s</ul>',
                    'link_class'   => 'nav__link'
                ]) ?>
                <!-- <nav class="header__nav nav">
                    <ul class="nav__list">
                        <li class="nav__item nav__item--submenu">
                            <button class="nav__btn">Каталог</button>
                            <ul class="list">
                                <li class="list__item">
                                    <a href="../catalog.html" class="nav__link">Матрасы</a>
                                </li>
                                <li class="list__item">
                                    <a href="../catalog-other.html" class="nav__link">Наматрасники и чехлы</a>
                                </li>
                                <li class="list__item">
                                    <a href="#" class="nav__link">Ортопедические подушки и одеяла</a>
                                </li>
                                <li class="list__item">
                                    <a href="#" class="nav__link">Ортопедические основания</a>
                                </li>
                                <li class="list__item">
                                    <a href="#" class="nav__link">Наполнители (материалы)</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav__item">
                            <a href="../discount.html" class="nav__link">Акции</a>
                        </li>
                        <li class="nav__item">
                            <a href="../delivery.html" class="nav__link">Доставка</a>
                        </li>
                        <li class="nav__item">
                            <a href="../guarantee.html" class="nav__link">Гарантия</a>
                        </li>
                        <li class="nav__item">
                            <a href="../about-us.html" class="nav__link">О компании</a>
                        </li>
                        <li class="nav__item">
                            <a href="../contact.html" class="nav__link">Контакты</a>
                        </li>

                        <li class="nav__item">
                            <a href="../test.html" class="nav__link">Тестировать</a>
                        </li>
                        <li class="nav__item">
                            <a href="../material.html" class="nav__link">Материалы</a>
                        </li>
                    </ul>
                </nav> -->

                <div class="mini-cart">
                    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>

                </div>
            </div>
        </div>
        <div class="overlay"></div>
        <!-- <nav class="header__nav--mobile nav--mobile">
            <div class="nav__box">
                <div class="nav__head">
                    <div class="nav__title">Меню</div>
                    <button class="nav__close-btn"></button>
                </div>
                <ul class="nav__list">
                    <li class="nav__item nav__item--submenu">
                        <button class="nav__btn" aria-expanded="false">Каталог</button>
                        <ul class="list" aria-hidden="true">
                            <li class="list__item">
                                <a href="../catalog.html" class="nav__link">Матрасы</a>
                            </li>
                            <li class="list__item">
                                <a href="../catalog-other.html" class="nav__link">Наматрасники и чехлы</a>
                            </li>
                            <li class="list__item">
                                <a href="#" class="nav__link">Ортопедические подушки и одеяла</a>
                            </li>
                            <li class="list__item">
                                <a href="#" class="nav__link">Ортопедические основания</a>
                            </li>
                            <li class="list__item">
                                <a href="#" class="nav__link">Наполнители (материалы)</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav__item">
                        <a href="../discount.html" class="nav__link">Акции</a>
                    </li>
                    <li class="nav__item">
                        <a href="../delivery.html" class="nav__link">Доставка</a>
                    </li>
                    <li class="nav__item">
                        <a href="../guarantee.html" class="nav__link">Гарантия</a>
                    </li>
                    <li class="nav__item">
                        <a href="../about-us.html" class="nav__link">О компании</a>
                    </li>
                    <li class="nav__item">
                        <a href="../contact.html" class="nav__link">Контакты</a>
                    </li>

                    <li class="nav__item">
                        <a href="../test.html" class="nav__link">Тестировать</a>
                    </li>
                    <li class="nav__item">
                        <a href="../material.html" class="nav__link">Материалы</a>
                    </li>
                </ul>
            </div>
        </nav> -->
    </header>