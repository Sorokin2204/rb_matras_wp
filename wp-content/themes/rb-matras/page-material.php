<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>
<section class="material">
    <div class="container">
        <div class="material__inner inner">
            <h2 class="material__title-h2 title-h2">Материалы</h2>
            <div class="material__content">
                <picture>
                    <source media="(max-width: 634px)" srcset="<?php the_field('material_img-full') ?> " />
                    <source media="(max-width: 1030px)" srcset="<?php the_field('material_img-tablet') ?>" />

                    <img src="<?php the_field('material_img-full') ?>" alt="" class="material__img" />
                </picture>

                <div class="material__box">
                    <p class="material__text">
                        <?php the_field('material_text') ?>
                    </p>
                    <?php $material = get_field('material_type') ?>
                    <ul class="material__accardion accardion">
                        <?php foreach ($material as $material_type) { ?>
                        <li class="material__accardion-item accardion__item">
                            <button class="material__accardion-head accardion__head" aria-expanded="false">
                                <?php echo $material_type['material_title'] ?>
                            </button>
                            <div class="material__accardion-content accardion__content" aria-hidden="true">
                                <?php $material_list = $material_type['material_list'] ?>
                                <ul class="accardion-list">
                                    <?php foreach ($material_list as $material_item) { ?>
                                    <li class="accardion-list__item">
                                        <?php if (!is_null($material_item['material_item-img'])) { ?>
                                        <img src="<?php echo $material_item['material_item-img'] ?>" alt=""
                                            class="accardion-list__img" />
                                        <?php } ?>

                                        <div class="accardion-list__content">
                                            <span
                                                class="accardion-list__title"><?php echo $material_item['material_item-title'] ?></span>
                                            <p class="accardion-list__text">
                                                <?php echo $material_item['material_item-text'] ?>
                                            </p>
                                        </div>
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