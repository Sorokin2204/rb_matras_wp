<?php get_header() ?>

<?php if (is_tax('product_cat')) {
    $taxonomy = get_queried_object();
    $taxonomy_name = $taxonomy->name;
} else if (is_front_page()) {
    $taxonomy_name = 'Матрас';
} ?>

<?php if ($taxonomy_name == 'Матрас') { ?>
<div class="catalog-footer">
    <div class="catalog__overlay"></div>
    <section class="catalog"><?php get_template_part('template-parts/content-catalog'); ?></section>

    <?php
        get_footer(); ?>
</div>
<?php } else { ?>
<div class="catalog-footer">
    <div class="catalog__overlay"></div>
    <section class="catalog catalog--disable-filter">
        <?php get_template_part('template-parts/content-catalog'); ?>
    </section>
    <?php get_footer() ?>
</div>
<?php  } ?>