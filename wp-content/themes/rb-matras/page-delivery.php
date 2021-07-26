<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>
<section class="delivery">
    <div class="container">
        <div class="delivery__inner inner">
            <h2 class="delivery__title-h2 title-h2">Доставка</h2>
            <div class="delivery__content">
                <?php $delivery =  get_field('delivary_timing') ?>
                <?php foreach ($delivery as $delivery_timing) { ?>
                    <div class="delivery__box">
                        <h3 class="delivery__list-title"><?php echo $delivery_timing['delivary_timing-title'] ?></h3>
                        <?php $delivery_list = $delivery_timing['delivary_timing-list'] ?>
                        <ul class="delivery__list list">
                            <?php foreach ($delivery_list as $delivery_item) { ?>
                                <li class="delivery__list-item list__item">
                                    <?php echo $delivery_item['delivary_timing-item'] ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

            </div>
            <?php get_template_part('template-parts/content-need-help'); ?>
        </div>
    </div>
</section>

<div class="modals">
    <div class="modal-overlay"> <?php get_template_part('template-parts/content-test-thanks'); ?></div>
</div>
<?php get_footer() ?>