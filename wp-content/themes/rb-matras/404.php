<?php get_template_part('head'); ?>

<body>
    <section class="not-found"
        style="background-image: url(<?php echo get_stylesheet_directory_uri() ?>/img/order-accepted_bg.webp)">
        <div class="not-found__inner">
            <img src="<?php echo get_custom_logo_uri() ?>" alt="" class="not-found__logo" />
            <img src="<?php echo get_stylesheet_directory_uri() ?>/img/404_img.webp" class="not-found__img" />
            <h2 class="not-found__title-h2 title-h2">
                Кажется, что-то пошло не так :(
            </h2>
            <div class="not-found__text">
                <p>К сожалению нужная страница не найдена.</p>
                <p>Мы обязательно решим эту проблему в скором времени.</p>
            </div>
            <a href="<?php echo get_home_url() ?>" class="not-found__btn-home btn btn-lg">
                На главную
            </a>
        </div>
    </section>
</body>

</html>