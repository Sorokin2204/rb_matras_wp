<?php get_header() ?>
<?php
if ( function_exists('yoast_breadcrumb') ) {
yoast_breadcrumb( '<div class="breadcrumbs"> <div class="container">','</div></div>' );
}
?>
<section class="contact">
    <div class="container">
        <div class="contact__inner inner">
            <h2 class="contact__title-h2 title-h2">Свяжитесь с нами</h2>
            <div class="contact__content">
                <div class="contact__map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d9008.966534244837!2d37.43338669625469!3d55.6326104177373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b55289d4fa639f%3A0xcaf392ca401cb288!2z0JHQuNC30L3QtdGBLdC_0LDRgNC6INCg0YPQvNGP0L3RhtC10LLQvg!5e0!3m2!1sru!2sby!4v1624518145978!5m2!1sru!2sby"
                        style="border: 0" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div class="contact__box">
                    <ul class="contact__list">
                        <li class="contact__item">
                            <div class="contact__item-title">Адрес</div>
                            <div class="contact__item-content">
                                <p class="contact__item-text">
                                    <?php echo the_field('widget_address', 'widget_general_widget-2') ?>
                                </p>
                            </div>
                        </li>
                        <li class="contact__item">
                            <div class="contact__item-title">График работы</div>
                            <div class="contact__item-content">
                                <div class="contact__item-worktime">
                                    <p><?php echo the_field('widget_work-time-weekdays', 'widget_general_widget-2') ?>
                                    </p>
                                    <p><?php echo the_field('widget_work-days-weekdays', 'widget_general_widget-2') ?>
                                    </p>
                                </div>
                                <div class="contact__item-worktime">
                                    <p><?php echo the_field('widget_work-time-weekend', 'widget_general_widget-2') ?>
                                    </p>
                                    <p><?php echo the_field('widget_work-days-weekend', 'widget_general_widget-2') ?>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="contact__item">
                            <div class="contact__item-title">Контакты</div>
                            <div class="contact__item-content">
                                <div class="contact__item-tel-box">
                                    <a href="tel:79636939881"
                                        class="contact__item-tel"><?php echo the_field('widget_phone', 'widget_general_widget-2') ?></a>
                                    <button class="contact__item-tel-link link">
                                        Заказать звонок
                                    </button>
                                </div>
                                <div class="contact__item-mail-box">
                                    <a href="mailto:<?php echo the_field('widget_email', 'widget_general_widget-2') ?>"
                                        class="contact__itme-mail"><?php echo the_field('widget_email', 'widget_general_widget-2') ?></a>
                                    <p class="contact__item-mail-text">по всем вопросам</p>
                                </div>
                            </div>
                        </li>
                        <li class="contact__item">
                            <div class="contact__item-title">Написать нам</div>
                            <div class="contact__item-content">
                                <form class="contact__item-form">
                                    <input class="contact__item-input input" type="text" name="contact_name"
                                        id="contact_name" placeholder="Ваше имя*" />
                                    <input class="contact__item-input input" type="email" name="contact_mail"
                                        id="contact_mail" placeholder="E-Mail*" />
                                    <textarea class="contact__item-textarea input" name="contact_message"
                                        id="contact_message" cols="3" rows="3"
                                        placeholder="Ваш вопрос или сообщение*"></textarea>
                                    <button class="contact__item-btn btn" data-path="modal-test-thanks">
                                        Отправить
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modals">
    <div class="modal-overlay"> <?php get_template_part( 'template-parts/content-test-thanks' ); ?></div>
</div>
<?php get_footer() ?>