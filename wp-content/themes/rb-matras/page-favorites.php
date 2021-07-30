<?php get_header() ?>
<?php
if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('<div class="breadcrumbs"> <div class="container">', '</div></div>');
}
?>
<div class="catalog-footer">

    <div class="catalog__overlay"></div>
    <section class="catalog catalog--disable-filter catalog--disable-sort">
        <?php get_template_part('template-parts/content-catalog'); ?>
    </section>

    <?php get_footer() ?>
</div>