<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>
<section class="about-us">
    <div class="container">
        <div class="about-us__inner inner">
            <h2 class="about-us__title-h2 title-h2">О компании</h2>
            <div class="about-us__content">
                <div class="about-us__video">
                    <iframe src="<?php the_field('about-us_link-video') ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="about-us__box">
                    <div class="about-us__text">
                        <?php the_field('about-us_text') ?>
                        <!-- <p>
                            Компания «Record Bedding» – является производителем
                            высококачественных ортопедических матрасов, изготавливаемых на
                            оборудовании и по технологии компании «Record Bedding» – Бельгия.
                        </p>
                        <p>
                            Вся продукция компании «Record Bedding» сертифицирована и
                            соответствует высшим стандартам европейского качества. История
                            компании Record Bedding насчитывает десятки лет, и за годы её
                            существования продукция зарекомендовала себя по всему миру.
                        </p>

                        <p>
                            Продукция Record Bedding – это только качественные матрасы и
                            современные технологии производства. Доверьте свой сон профи,
                            которые знают массу способов сделать его комфортным и здоровым.
                        </p> -->
                    </div>
                    <?php $about_us_list = get_field('about-us_legal-info') ?>
                    <ul class="about-us__list">
                        <?php foreach ($about_us_list as $about_us_item) { ?>
                            <li class="about-us__item"><span><?php echo $about_us_item['about-us_prop'] ?></span>
                                <?php echo $about_us_item['about-us_value'] ?>
                            </li>
                        <?php } ?>
                        <!-- <li class="about-us__item"><span>ОГРН:</span> 1127746611871</li>
                        <li class="about-us__item"><span>ООО "Экстрасон"</span></li>
                        <li class="about-us__item">
                            <span>Фактический адрес: </span> Бизнес-Парк «РУМЯНЦЕВО», Киевское
                            шоссе 500м от МКАД, корпус «Г», подъезд 11, 7-й этаж, офис 717.
                        </li>
                        <li class="about-us__item">
                            <span>Юридический адрес:</span>117042, г.Москва, Чечеринский
                            пр-д., д. 120, пом. 1
                        </li> -->
                    </ul>
                </div>
            </div>
            <?php get_template_part('template-parts/content-need-help'); ?>
        </div>
    </div>
</section>

<div class="modals">
    <div class="modal-overlay"> <?php get_template_part('template-parts/content-test-thanks'); ?></div>
</div>
<?php get_footer() ?>