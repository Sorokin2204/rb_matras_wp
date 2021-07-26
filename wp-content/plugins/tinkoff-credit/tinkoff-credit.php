<?php
/**
 * Plugin Name: Tinkoff Credit for WooCommerce
 * Plugin URI: https://skyweb.site/projects/tinkoff-credit-for-woocommerce/
 * Description: Кнопка "Купи в кредит" от Тинькофф Банк для WooCommerce.
 * Version: 1.2.0
 * Author: SkyWeb
 * Author URI: https://skyweb.site
 * Text Domain: tinkoff-credit
 * Domain Path: /languages
 *
 * Requires at least: 5.2
 * Requires PHP: 7.0
 *
 * WC requires at least: 4.0
 * WC tested up to: 4.4
 *
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

defined( 'ABSPATH' ) || exit;

// Check if required functions are exist
if ( ! function_exists( 'get_plugin_data' ) || ! function_exists( 'is_plugin_active' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
}

// Define a constant for assets version
define( 'TINKOFF_CREDIT_VERSION', get_plugin_data( __FILE__ )['Version'] );

// Register theme text domain
add_action( 'plugins_loaded', function () {
	load_plugin_textdomain( 'tinkoff-credit', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
} );

// Check if WooCommerce is active and include plugin settings and classes
if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
	require __DIR__ . '/includes/class-wc-settings.php';
	require __DIR__ . '/includes/class-main.php';
	require __DIR__ . '/includes/class-helpers.php';
	require __DIR__ . '/includes/class-form.php';
} else {
	if ( is_admin() ) {
		require __DIR__ . '/includes/class-wc-inactive.php';
	}

	return;
}