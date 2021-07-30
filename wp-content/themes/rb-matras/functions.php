<?php

/**
 * Rb matras functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Rb_matras
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.1');
}

if (!function_exists('rb_matras_setupp')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rb_matras_setupp()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Rb matras, use a find and replace
		 * to change 'rb-matras' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('rb-matras', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'rb_matras_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action('after_setup_theme', 'rb_matras_setupp');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function rb_matras_content_width()
{
	$GLOBALS['content_width'] = apply_filters('rb_matras_content_width', 640);
}
add_action('after_setup_theme', 'rb_matras_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Enqueue scripts and styles.
 */

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}


///THEME FUNCTIONS
require get_template_directory() . '/inc/general-widget.php';

function get_page_name()
{
	return str_replace("/", "", $_SERVER['REQUEST_URI']);
}
function rb_matras_scripts()
{
	global $wp_query;

	wp_enqueue_style('style-main', get_stylesheet_directory_uri() . '/css/style.min.css', array(), _S_VERSION);

	wp_enqueue_script('da_data', 'https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/js/jquery.suggestions.min.js', array('jquery'), time(), true);

	wp_enqueue_script('script-main', get_template_directory_uri() . '/js/script.min.js', array('jquery'), time(), true);


	wp_enqueue_script('misha_scripts', get_stylesheet_directory_uri() . '/js/myfilter.js', array('jquery'), time());


	if (is_product()) {
		wp_enqueue_script('script-product', get_template_directory_uri() . '/js/product-one.min.js', array(), _S_VERSION, true);
	}
	if (is_front_page()) {

		wp_enqueue_script('script-home', get_template_directory_uri() . '/js/home.min.js', array('jquery'), time(), true);
	}

	if (is_checkout()) {
		wp_enqueue_script('script-ordering', get_template_directory_uri() . '/js/ordering.min.js', array(), _S_VERSION, true);
	}

	if (is_page('compare')) {
		wp_enqueue_script('script-compare', get_template_directory_uri() . '/js/compare.min.js', array(), _S_VERSION, true);
	}
	if (is_page('favorites')) {
		wp_enqueue_script('script-favorites', get_template_directory_uri() . '/js/favorites.min.js', array(), _S_VERSION, true);
	}

	if (is_tax('writer')) {
		wp_enqueue_script('script-discount', get_template_directory_uri() . '/js/discount.min.js', array(), _S_VERSION, true);
	}


	// now the most interesting part
	// we have to pass parameters to myloadmore.js script but we can get the parameters values only in PHP
	// you can define variables directly in your HTML but I decided that the most proper way is wp_localize_script()


	wp_localize_script('misha_scripts', 'misha_loadmore_params', array(
		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
		'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
		'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
		'max_page' => $wp_query->max_num_pages
	));

	wp_enqueue_script('misha_scripts');
}
add_action('wp_enqueue_scripts', 'rb_matras_scripts');


function get_custom_logo_uri()
{
	return  wp_get_attachment_image_src(get_theme_mod('custom_logo'), 'full')[0];
}

add_action('widgets_init', 'wpb_load_widget');
function wpb_load_widget()
{
	register_widget('general_widget');
}

add_action('in_widget_form', 'spice_get_widget_id');
function spice_get_widget_id($widget_instance)
{

	if ($widget_instance->number == "__i__") {

		echo "<p><strong>Widget ID is</strong>: Pls save the widget first!</p>";
	} else {
		echo "<p><strong>Widget ID is: </strong>" . $widget_instance->id . "</p>";
	}
}


add_action('after_setup_theme', 'rb_matras_setup');

global $filters;
$filters = get_filters();
function rb_matras_setup()
{
	register_nav_menus(
		array(
			'menu-primary' => esc_html__('Главное меню', 'rb-matras'),
		)
	);
}

add_action('init', 'create_book_taxonomies');

// функция, создающая 2 новые таксономии "genres" и "writers" для постов типа "book"
function create_book_taxonomies()
{

	// Добавляем НЕ древовидную таксономию 'writer' (как метки)
	register_taxonomy('writer', 'product', array(
		'hierarchical'  => false,
		'labels'        => array(
			'name'                        => _x('Акции', 'taxonomy general name'),
			'singular_name'               => _x('Акция', 'taxonomy singular name'),
			'search_items'                =>  __('Искать акции'),
			'popular_items'               => __('Популярные акции'),
			'all_items'                   => __('Все акции'),
			'parent_item'                 => null,
			'parent_item_colon'           => null,
			'edit_item'                   => __('Изменить акции'),
			'update_item'                 => __('Обновить акции'),
			'add_new_item'                => __('Добавить новую акцию'),
			'new_item_name'               => __('Название новой акции'),
			'separate_items_with_commas'  => __('Разделять акции запятыми'),
			'add_or_remove_items'         => __('Добавить или удалить акцию'),
			'choose_from_most_used'       => __('Выберите из наиболее популярных акций'),
			'menu_name'                   => __('Акции'),
		),
		'show_ui'       => true,
		'query_var'     => true,
		'rewrite' =>  false,
		//'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
	));


	//wp_redirect( home_url('/?page_id=7') ); 	var_dump(get_taxonomy('writer'));
	//var_dump(get_term_link('discount-andante', 'writer'));
}

// Utility function to get the parent variable product IDs for a any term of a taxonomy
function get_variation_parent_ids_from_term($term, $taxonomy, $type)
{
	global $wpdb;

	return $wpdb->get_col("
        SELECT DISTINCT p.ID
        FROM {$wpdb->prefix}posts as p
        INNER JOIN {$wpdb->prefix}posts as p2 ON p2.post_parent = p.ID
        INNER JOIN {$wpdb->prefix}term_relationships as tr ON p.ID = tr.object_id
        INNER JOIN {$wpdb->prefix}term_taxonomy as tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
        INNER JOIN {$wpdb->prefix}terms as t ON tt.term_id = t.term_id
        WHERE p.post_type = 'product'
        AND p.post_status = 'publish'
        AND p2.post_status = 'publish'
        AND tt.taxonomy = '$taxonomy'
        AND t.$type = '$term'
    ");
}


add_filter('posts_groupby', 'custom_posts_groupby', 10, 2);
function custom_posts_groupby($groupby, $query)
{
	if ('post_parent' === $query->get('groupby')) {
		global $wpdb;
		return "$wpdb->posts.post_parent";
	}
	return $groupby;
}

function rb_matras_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'rb-matras'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'rb-matras'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'rb_matras_widgets_init');




// function misha_my_load_more_scripts()
// {

// 	global $wp_query;

// 	// In most cases it is already included on the page and this line can be removed
// 	wp_enqueue_script('jquery');

// 	// register our main script but do not enqueue it yet
// 	wp_register_script('my_loadmore', get_stylesheet_directory_uri() . '/js/myfilter.js', array('jquery'));

// 	wp_localize_script('my_loadmore', 'misha_loadmore_params', array(
// 		'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php', // WordPress AJAX
// 		'posts' => json_encode($wp_query->query_vars), // everything about your loop is here
// 		'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
// 		'max_page' => $wp_query->max_num_pages
// 	));


// 	wp_enqueue_script('my_loadmore');
// }

// add_action('wp_enqueue_scripts', 'misha_my_load_more_scripts');

function get_filters()
{

	$args = array(
		'post_type'      => 'product',
		'posts_per_page' => 1,
		'tax_query' => array(

			array(
				'taxonomy' => 'product_cat',
				'field' => 'slug',
				'terms' => 'matras'
			),

		),
	);
	$id_first_product = 0;
	$loop = new WP_Query($args);
	while ($loop->have_posts()) {
		$loop->the_post();
		//     global $product;
		//    $id_first_product = $product->get_id();
		//echo '<br /><a href="'.get_permalink().'">' . woocommerce_get_product_thumbnail().' '.get_the_title().'</a>';
	}
	return get_field_objects(get_the_ID());
	wp_reset_query();
}


add_action('wp_ajax_myfilter', 'misha_filter_function');
add_action('wp_ajax_nopriv_myfilter', 'misha_filter_function');
add_action('wp_ajax_gd_myfilter', 'misha_filter_function');


function is_product_in_cart($product_id)
{
	foreach (WC()->cart->get_cart() as $cart_item) {
		if ($product_id == $cart_item['product_id']) {
			return true;
		}
	}

	return false;
}


function get_variation_with_min_price($product)
{
	$atrr_arr_sort = $product->get_available_variations();
	usort($atrr_arr_sort, function ($a, $b) {
		return $a['dimensions']['width'] <=> $b['dimensions']['width'];
	});
	return $atrr_arr_sort[0];
}

function get_product_html()
{

	global $product;

	$variation = get_variation_with_min_price($product);

	$compare_in_cookie = isset($_COOKIE['wordpress_list_compare']) ? in_array($product->get_id(), explode(',', $_COOKIE['wordpress_list_compare'])) : false;
	$favorite_in_cookie =
		isset($_COOKIE['wordpress_list_favorite'])  ? in_array($product->get_id(), explode(',', $_COOKIE['wordpress_list_favorite'])) : false;



	return '
<div class="product ">
    <div class="product__btn-icon-box">
        <div class="product__sale"></div>
        <button class="product__btn-icon-compare ' . (($compare_in_cookie) ? "product__btn-icon-compare--active" : "") . '" data-path="modal-add-cart"></button>
        <button class="product__btn-icon-favorites ' . (($favorite_in_cookie) ? "product__btn-icon-favorites--active" : "") . '" data-path="modal-add-cart"></button>
    </div>

    <div class="product__img-box">
        <img src="' . get_the_post_thumbnail_url() . '" alt="" class="product__img" />
    </div>
    <a href="' . get_permalink() . '" class="product__title">' . get_the_title() . '</a>
    <ul class="product__list">
        <li class="product__list-item">
            <span> Жёсткость:</span> ' . get_field('filter_hardness') . '
            <button>
                <span class="info">
                    <div class="info-popup">
                        Жесткость матраса с первой и второй стороны
                    </div>
                </span>
            </button>
        </li>
        <li class="product__list-item"><span>Вес:</span> ' . get_field('filter_weight') . '</li>

        <li class="product__list-item"><span> Размеры: от </span>' . $variation['attributes']['attribute_pa_size']  . '</li>
    </ul>
    <div class="product__box">
        <span class="product__price">' . wc_price($variation['display_price']) . '</span>
     
		    <button type="submit" data-path="modal-add-cart"
        class="product__btn-cart btn btn-sm ' . (is_product_in_cart($product->get_id()) ? 'product__btn-cart--in-cart' : "") . '">' . esc_html($product->single_add_to_cart_text()) . '</button>
 <input type="hidden" name="add-to-cart" value="' .  absint($product->get_id()) . '" />
    <input type="hidden" name="product_id" value="' .  absint($product->get_id()) . '" />
    <input type="hidden" name="variation_id" class="variation_id" value="' .  $variation['variation_id'] . '" />


</div>
</div>
';
}







function misha_filter_function()
{
	// wp_redirect(home_url('/?page_id=7'));
	$filters = get_filters();

	$args_child = array(
		'post_type' => 'product_variation',
		'post_status' => 'publish',
		'groupby' => 'post_parent',
		'fields' => 'id=>parent',


	);


	if (isset($_COOKIE['wordpress_list_favorite']) && $_POST['page'] == 'favorites') {

		$args_child['post_parent__in'] = explode(',', $_COOKIE['wordpress_list_favorite']);
	} else if ($_POST['page'] == 'home') {
		$args_child['post_parent__in'] = 	get_variation_parent_ids_from_term("Матрас", 'product_cat', 'name');
	}



	if (isset($_POST['price_min']) && isset($_POST['price_max'])) {
		$args_child['meta_query'][] = array(
			'key' => '_price',
			'value' => array((int)$_POST['price_min'], (int)$_POST['price_max']),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);
	}
	if (isset($_POST['width_min']) && isset($_POST['width_max'])) {
		$args_child['meta_query'][] = array(
			'key' => '_width',
			'value' => array((int)$_POST['width_min'], (int)$_POST['width_max']),
			'compare' => 'BETWEEN',
			'type' => 'NUMERIC'
		);
	}



	//var_dump($args_child);
	$query_child = new WP_Query($args_child);

	$parent_ids = wp_list_pluck($query_child->posts, 'post_parent');


	// $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (!empty($parent_ids)) {
		$args_parent = array(
			'post_type' => 'product',
			'post__in' => $parent_ids,
			'posts_per_page' => 2,
			'paged' => 1,
		);

		foreach ($filters as $filter) {
			$values = array();
			foreach ($filter['choices'] as $key => $value) {
				if (isset($_POST[$key])) {
					array_push($values, $key);
				}
			}
			if (!empty($values)) {
				$args_parent['meta_query'][] = array(
					'key' => $filter['name'],
					'value' => $values,
					'compare' => 'IN'
				);
			}
		}

		if (isset($_POST['discount_term']) && $_POST['page'] == 'discount') {
			$args_parent['tax_query'][] = array(
				'taxonomy' => 'writer',
				'field' => 'slug',
				'terms' => $_POST['discount_term']
			);
		}
		$query_parent = new WP_Query($args_parent);
		ob_start(); // start buffering because we do not need to print the posts now
		while ($query_parent->have_posts()) : $query_parent->the_post();

			//var_dump($atrr_arr_sort);
			//var_dump($product->get_variation_regular_price('min'));
			echo get_product_html();
		//	print_r($filters);
		//var_dump(get_field('filter_weight'));
		// //var_dump( $loop->posts);
		// foreach ($product->get_available_variations() as $item) {
		// var_dump($item['dimensions']['width']);
		// var_dump($item['display_price']);


		// echo $item['attributes']['attribute_pa_case'] . $item['attributes']['attribute_pa_size'] . '<br>';
		// }
		// echo '<br><br><br>';
		endwhile;
		//print_r($query_parent->query_vars);
		//print_r(serialize($query_parent->query_vars));
		// $posts_per_page = 2;
		// $total_post_count = wp_count_posts();
		// $published_post_count = $total_post_count->publish;
		// $total_pages = ceil($published_post_count / $posts_per_page);

		//echo $total_pages;
		// echo $query_parent->max_num_pages;

		$content = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
		//var_dump($wp_query->max_num_pages);


		wp_reset_query();
	} else {
		ob_start();
		echo ('No Resault');
		$content = ob_get_contents(); // we pass the posts to variable
		ob_end_clean(); // clear the buffer
	}

	echo json_encode(array(
		'posts' => serialize($query_parent->query_vars),
		'max_page' => $query_parent->max_num_pages,
		'found_posts' => $query_parent->posts,
		'content' => $content
	));
	die();
}



add_action('wp_ajax_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'misha_loadmore_ajax_handler'); // wp_ajax_nopriv_{action}
add_action('wp_ajax_gd_loadmore', 'misha_loadmore_ajax_handler');
function misha_loadmore_ajax_handler()
{

	// prepare our arguments for the query
	//$args = json_decode(stripslashes($_POST['query']), true);
	//$args = $_POST['query'];
	$args = unserialize(stripslashes($_POST['query']));
	$args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
	$query_parent = new WP_Query($args);

	//print_r($args);
	if ($query_parent->have_posts()) {
		while ($query_parent->have_posts()) : $query_parent->the_post();

			echo get_product_html();

		endwhile;
		wp_reset_query();
	}

	die;

	// $args['post_status'] = 'publish';

	// // it is always better to use WP_Query but not here
	// query_posts($args);

	// if (have_posts()) :

	// // run the loop
	// while (have_posts()) : the_post();

	// get_template_part('template-parts/post/content', get_post_format());

	// endwhile;

	// endif;
	//echo $_POST['query'];
	// here we exit the script and even no wp_reset_query() required!
}



add_filter('woocommerce_dropdown_variation_attribute_options_args', static function ($args) {
	$args['class'] = 'product-one__select select';
	return $args;
}, 2);

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart()
{

	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if (
		$passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' ===
		$product_status
	) {

		do_action('woocommerce_ajax_added_to_cart', $product_id);

		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}

		WC_AJAX::get_refreshed_fragments();
	} else {

		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id)
		);

		echo wp_send_json($data);
	}

	wp_die();
}






////CHECK OUT FUNCTIONS////////////

add_filter('woocommerce_cart_item_thumbnail', 'filter_function_name_4873', 10, 3);
function filter_function_name_4873($product_image, $cart_item, $cart_item_key)
{
	// Get product
	$product = $cart_item['data'];

	// Get gallery image ids
	$attachment_id = $product->get_image_id();

	// NOT empty
	if (!empty($attachment_id)) {
		// First


		// New thumbnail
		$thumbnail = wp_get_attachment_image($attachment_id, 'full', false, ['class' => 'ordering-product__img', 'srcset' => ' ']);
	}

	return $thumbnail;
}

/**
 Remove all possible fields
 **/
add_filter('woocommerce_checkout_get_value', '__return_empty_string', 10);

function wc_remove_checkout_fields($fields)
{

	// Billing fields
	unset($fields['billing']['billing_company']);
	unset($fields['billing']['billing_country']);
	unset($fields['billing']['billing_state']);
	unset($fields['billing']['billing_last_name']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_phone']);
	unset($fields['shipping']['shipping_state']);
	unset($fields['shipping']['shipping_first_name']);
	unset($fields['shipping']['shipping_last_name']);
	unset($fields['shipping']['shipping_address_1']);
	unset($fields['shipping']['shipping_address_2']);
	unset($fields['shipping']['shipping_city']);
	unset($fields['shipping']['shipping_postcode']);

	//unset($fields['billing']['billing_email']);
	//unset($fields['billing']['billing_phone']);
	//unset($fields['billing']['billing_first_name']);
	//unset($fields['billing']['billing_address_1']);
	//unset($fields['billing']['billing_address_2']);
	//unset($fields['billing']['billing_city']);
	// Shipping fields

	$fields['billing']['billing_address_3'] = array(
		'label' => __('Квартира', 'woocommerce'), // Add custom field label
		'placeholder' => _x('Квартира', 'placeholder', 'woocommerce'), // Add custom field placeholder
		'required' => false, // if field is required or not
		'clear' => false, // add clear or not
		'type' => 'text', // add field type
		'class' => array('input'),  // add class name
		'priority' => 40,
	);

	$fields['billing']['billing_first_name']['class'] = array('input');
	$fields['billing']['billing_first_name']['label'] = 'Имя';
	$fields['billing']['billing_first_name']['placeholder'] = 'Имя';

	$fields['billing']['billing_phone']['class'] = array('input telephone');
	$fields['billing']['billing_phone']['label'] = 'Номер телефона';
	$fields['billing']['billing_phone']['placeholder'] = 'Номер телефона';

	$fields['billing']['billing_email']['class'] = array('input');
	$fields['billing']['billing_email']['label'] = 'Email';
	$fields['billing']['billing_email']['placeholder'] = 'Email';


	$fields['billing']['billing_city']['class'] = array('input city');
	$fields['billing']['billing_city']['label'] = 'Город';
	$fields['billing']['billing_city']['placeholder'] = 'Город';
	$fields['billing']['billing_city']['required'] = false;
	$fields['billing']['billing_city']['priority'] = 10;

	$fields['billing']['billing_address_1']['class'] = array('input street');
	$fields['billing']['billing_address_1']['label'] = 'Улица, микрорайон, жк и тд.';
	$fields['billing']['billing_address_1']['placeholder'] = 'Улица, микрорайон, жк и тд.';
	$fields['billing']['billing_address_1']['required'] = false;
	$fields['billing']['billing_address_1']['priority'] = 20;

	$fields['billing']['billing_address_2']['class'] = array('input house');
	$fields['billing']['billing_address_2']['label'] = 'Дом, строение';
	$fields['billing']['billing_address_2']['placeholder'] = 'Дом, строение';
	$fields['billing']['billing_address_2']['required'] = false;
	$fields['billing']['billing_address_2']['priority'] = 30;


	$fields['billing']['billing_email']['class'] = array('input');


	// Order fields
	//unset($fields['order']['order_comments']);

	return $fields;
}
add_filter('woocommerce_checkout_fields', 'wc_remove_checkout_fields');

function filter_woocommerce_form_field_text($field, $key, $args, $value)
{
	//var_dump($args['required']);
	$field = '<input type="' . esc_attr($args['type']) . '" class="input-text ' . esc_attr(implode(' ', $args['class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '"  value="' . esc_attr($value) . '" onchange="this.setAttribute(\'value\', this.value);"' . ($args["required"] ? "required" :  "") . '   />';

	//var_dump(htmlentities($field));
	// Do something
	return $field;
}
add_filter('woocommerce_form_field_text', 'filter_woocommerce_form_field_text', 10, 4);
add_filter('woocommerce_form_field_tel', 'filter_woocommerce_form_field_text', 10, 4);
add_filter('woocommerce_form_field_email', 'filter_woocommerce_form_field_text', 10, 4);
remove_action('woocommerce_checkout_order_review', 'woocommerce_order_review', 10);
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
add_action('woocommerce_after_checkout_form', 'woocommerce_checkout_coupon_form');

// Remove product in the cart using ajax
// function warp_ajax_product_remove()
// {
// 	// Get mini cart
// 	ob_start();

// 	foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
// 		if ($cart_item['product_id'] == $_POST['product_id'] && $cart_item_key == $_POST['cart_item_key']) {
// 			WC()->cart->remove_cart_item($cart_item_key);
// 		}
// 	}

// 	WC()->cart->calculate_totals();
// 	WC()->cart->maybe_set_cart_cookies();

// 	woocommerce_mini_cart();

// 	$mini_cart = ob_get_clean();

// 	// Fragments and mini cart are returned
// 	$data = array(
// 		'fragments' => apply_filters(
// 			'woocommerce_add_to_cart_fragments',
// 			array(
// 				'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
// 			)
// 		),
// 		'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
// 	);

// 	wp_send_json($data);

// 	die();
// }

// add_action('wp_ajax_product_remove', 'warp_ajax_product_remove');
// add_action('wp_ajax_nopriv_product_remove', 'warp_ajax_product_remove');