<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>
<section class="guarantee">
    <div class="container">
        <div class="guarantee__inner inner">
            <h2 class="guarantee__title-h2 title-h2">Гарантия</h2>
            <div class="guarantee__content">
                <picture>
                    <source media="(max-width: 634px)" srcset="<?php the_field('guarantee_img-moblie') ?> " />
                    <source media="(max-width: 1030px)" srcset="<?php the_field('guarantee_img-tablet') ?>" />

                    <img src="<?php the_field('guarantee_img-full') ?>" class="guarantee__img" />
                </picture>

                <div class="guarantee__box">
                    <p class="guarantee__text">
                        <?php the_field('guarantee_text') ?>
                    </p>
                    <span class="guarantee__box-title"><?php the_field('guarantee_bold-text') ?></span>
                    <?php $guarantee = get_field('guarantee_case');

                    ?>
                    <ul class="guarantee__accardion accardion">
                        <?php foreach ($guarantee as $guarantee_case) { ?>
                        <li class="guarantee__accardion-item accardion__item">
                            <button class="guarantee__accardion-head accardion__head" aria-expanded="false">
                                <?php echo $guarantee_case['guarantee_title'] ?>
                            </button>
                            <div class="guarantee__accardion-content accardion__content" aria-hidden="true">
                                <?php $guarantee_list = $guarantee_case['guarantee_list'] ?>
                                <ul class="guarantee__list list">
                                    <?php foreach ($guarantee_list as $guarantee_item) { ?>
                                    <li class="guarantee__item list__item">
                                        <?php echo $guarantee_item['guarantee_item'] ?>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>
                        </li>
                        <?php } ?>
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