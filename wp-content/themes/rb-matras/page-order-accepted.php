<?php get_template_part('head'); ?>

<body>
    <section class="order-accepted"
        style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/img/order-accepted_bg.webp)">
        <div class="container">
            <div class="order-accepted__inner">
                <img src="<?php echo get_stylesheet_directory_uri() ?>/img/order-accepted_img.svg" alt=""
                    class="order-accepted__img" />
                <h2 class="order-accepted__title title-h2">
                    Ваш заказ принят
                </h2>
                <p class="order-accepted__text">
                    Наш менеджер свяжется с вами, чтобы уточнить детали
                </p>
                <a href="<?php echo get_home_url() ?>" class="order-accepted__btn-home btn btn-lg">
                    На главную
                </a>
            </div>
        </div>
    </section>
</body>

</html>