<?php

defined( 'ABSPATH' ) || exit;

class Tninkoff_Credit_Main {

	/**
	 * Bootstraps the class and hooks required actions
	 */
	public static function init() {
		// Initial settings
		register_activation_hook( plugin_dir_path( __DIR__ ) . 'tinkoff-credit.php', array( __CLASS__, 'activation' ) );
		// Remove settings
		register_uninstall_hook( plugin_dir_path( __DIR__ ) . 'tinkoff-credit.php', array( __CLASS__, 'uninstall' ) );
		// Assets
		add_action( 'wp_enqueue_scripts', __CLASS__ . '::assets' );
		// Settings link
		add_filter( 'plugin_action_links_' . plugin_basename( plugin_dir_path( __DIR__ ) . 'tinkoff-credit.php' ), __CLASS__ . '::add_plugin_page_settings_link' );
	}

	// Add basic settings on first plugin activation
	public static function activation() {
		add_option( 'woocommerce_tinkoff_credit_installmentsOnly', 'no' );
		add_option( 'woocommerce_tinkoff_credit_installmentButtonMonths' );
		add_option( 'woocommerce_tinkoff_credit_buttonOpenOnNewWindow' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnProductPage' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnCatalogPage' );
		add_option( 'woocommerce_tinkoff_credit_labelOnCatalogPage', 'no' );
		add_option( 'woocommerce_tinkoff_credit_labelTextOnCatalogPage', 'Available on Credit' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnCart' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnCartLocation', 'woocommerce_before_cart_collaterals' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnCheckout' );
		add_option( 'woocommerce_tinkoff_credit_buttonOnCheckoutLocation', 'woocommerce_before_checkout_form' );
	}

	// Remove settings on the plugin uninstall
	public static function uninstall() {
		delete_option( 'woocommerce_tinkoff_credit_shopId' );
		delete_option( 'woocommerce_tinkoff_credit_showcaseId' );
		delete_option( 'woocommerce_tinkoff_credit_promoCode' );
		delete_option( 'woocommerce_tinkoff_credit_installmentPlans' );
		delete_option( 'woocommerce_tinkoff_credit_installmentsOnly' );
		delete_option( 'woocommerce_tinkoff_credit_buttonName' );
		delete_option( 'woocommerce_tinkoff_credit_installmentButtonName' );
		delete_option( 'woocommerce_tinkoff_credit_installmentButtonMonths' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOpenOnNewWindow' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnProductPage' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnCatalogPage' );
		delete_option( 'woocommerce_tinkoff_credit_labelOnCatalogPage' );
		delete_option( 'woocommerce_tinkoff_credit_labelTextOnCatalogPage' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnCart' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnCartLocation' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnCheckout' );
		delete_option( 'woocommerce_tinkoff_credit_buttonOnCheckoutLocation' );
	}

	// Enqueue assets on a single product page and cart page only
	public static function assets() {
		if ( is_product() || is_cart() ) {
			wp_enqueue_script( 'tinkoff-credit-scripts',
				plugins_url( 'assets/js/tinkoff-scripts.js', dirname( __FILE__ ) ),
				array( 'jquery', 'wc-add-to-cart-variation' ),
				TINKOFF_CREDIT_VERSION, true );
		}
	}

	// Add plugin page settings link
	public static function add_plugin_page_settings_link( $links ) {
		$links[] = '<a href="' .
		           admin_url( 'admin.php?page=wc-settings&tab=tinkoff_credit_settings' ) .
		           '">' . __( 'Settings', 'tinkoff-credit' ) . '</a>';

		return $links;
	}
}

Tninkoff_Credit_Main::init();