<?php

defined( 'ABSPATH' ) || exit;

class Tinkoff_Credit_WC_Settings {

	/**
	 * Bootstraps the class and hooks required actions
	 */
	public static function init() {
		add_filter( 'woocommerce_settings_tabs_array', __CLASS__ . '::add_settings_tab', 50 );
		add_action( 'woocommerce_settings_tabs_tinkoff_credit_settings', __CLASS__ . '::settings_tab' );
		add_action( 'woocommerce_update_options_tinkoff_credit_settings', __CLASS__ . '::update_settings' );
	}

	/**
	 * Add a new settings tab to the WooCommerce settings tabs array.
	 *
	 * @param array $settings_tabs Array of WooCommerce setting tabs & their labels, excluding the Tinkoff Credit tab.
	 *
	 * @return array $settings_tabs Array of WooCommerce setting tabs & their labels, including the Tinkoff Credit tab.
	 */
	public static function add_settings_tab( $settings_tabs ) {
		$settings_tabs['tinkoff_credit_settings'] = __( 'Tinkoff Credit', 'tinkoff-credit' );

		return $settings_tabs;
	}

	/**
	 * Uses the WooCommerce admin fields API to output settings via the @see woocommerce_admin_fields() function.
	 *
	 * @uses woocommerce_admin_fields()
	 * @uses self::get_settings()
	 */
	public static function settings_tab() {
		woocommerce_admin_fields( self::get_settings() );
	}

	/**
	 * Uses the WooCommerce options API to save settings via the @see woocommerce_update_options() function.
	 *
	 * @uses woocommerce_update_options()
	 * @uses self::get_settings()
	 */
	public static function update_settings() {
		woocommerce_update_options( self::get_settings() );
	}

	/**
	 * Get all the settings for this plugin for @return array Array of settings for @see woocommerce_admin_fields() function.
	 *
	 * @see woocommerce_admin_fields() function.
	 *
	 */
	public static function get_settings() {
		$settings = array(
			// Tinkoff Credit API section.
			'api_section_title'        => array(
				'id'   => 'woocommerce_tinkoff_credit_api_section_title',
				'name' => __( 'API Settings', 'tinkoff-credit' ),
				'type' => 'title',
				'desc' => __( 'Unique identifiers of the store, issued by the Tinkoff Bank.', 'tinkoff-credit' ),
			),
			'shopId'                   => array(
				'id'       => 'woocommerce_tinkoff_credit_shopId',
				'name'     => __( 'Shop ID', 'tinkoff-credit' ),
				'desc_tip' => __( 'Unique identifier of the store, issued by the bank upon connection (save an empty field for setting test parameters).',
					'tinkoff-credit' ),
				'type'     => 'text',
			),
			'showcaseId'               => array(
				'id'       => 'woocommerce_tinkoff_credit_showcaseId',
				'name'     => __( 'Shop Case ID', 'tinkoff-credit' ),
				'desc_tip' => __( 'Storefront ID. Storefronts are various sites registered for one legal entity (if the Shop ID is not specified, this field is ignored).', 'tinkoff-credit' ),
				'type'     => 'text',
			),
			'promoCode'                => array(
				'id'       => 'woocommerce_tinkoff_credit_promoCode',
				'name'     => __( 'Promo Code', 'tinkoff-credit' ),
				'desc_tip' => __( 'For specials (if the Promo Code is not specified, the default value is \'default\').', 'tinkoff-credit' ),
				'desc'     => sprintf( esc_html__( 'For installment plans use promo code %s and fill in the next field.%s The first value (in the example the first 0) is responsible for the initial payment in percentage.', 'tinkoff-credit' ), 'installment_<b>0</b>_0_', '<br/>' ),
				'type'     => 'text',
			),
			'installmentPlans'         => array(
				'id'       => 'woocommerce_tinkoff_credit_installmentPlans',
				'name'     => __( 'Installment Plans', 'tinkoff-credit' ),
				'desc_tip' => __( 'If the Installment Plans are not specified, the Promo Code uses as is.', 'tinkoff-credit' ),
				'desc'     => __( 'Specify the installment dates, separated by commas without spaces, for example 4,6,12. This will create three installment buttons for 4, 6 and 12 months. Or leave it empty to create default installment for 6 months.', 'tinkoff-credit' ),
				'type'     => 'text',
			),
			'api_section_end'          => array(
				'id'   => 'woocommerce_tinkoff_credit_api_section_end',
				'type' => 'sectionend',
			),

			// Front settings section.
			'front_section_title'      => array(
				'id'   => 'woocommerce_tinkoff_credit_front_section_title',
				'name' => __( 'Customization', 'tinkoff-credit' ),
				'type' => 'title',
				'desc' => __( 'Buy in Credit button appearance settings.', 'tinkoff-credit' ),
			),
			'buttonName'               => array(
				'id'       => 'woocommerce_tinkoff_credit_buttonName',
				'name'     => __( 'Credit Button Name', 'tinkoff-credit' ),
				'desc_tip' => __( 'If you leave this field empty, the default name is \'Buy in Credit\'.', 'tinkoff-credit' ),
				'type'     => 'text',
			),
			'installmentButtonName'    => array(
				'id'       => 'woocommerce_tinkoff_credit_installmentButtonName',
				'name'     => __( 'Promo Code Button Name', 'tinkoff-credit' ),
				'desc_tip' => __( 'If you leave this field empty, the default name is \'Installment\'.', 'tinkoff-credit' ),
				'type'     => 'text',
			),
			'installmentButtonMonths'  => array(
				'id'      => 'woocommerce_tinkoff_credit_installmentButtonMonths',
				'title'   => __( 'Add months', 'tinkoff-credit' ),
				'desc'    => __( 'Add months to promo code button name?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			'installmentsOnly'         => array(
				'id'      => 'woocommerce_tinkoff_credit_installmentsOnly',
				'title'   => __( 'Only Installments', 'tinkoff-credit' ),
				'desc'    => __( 'Show only installment buttons?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'no',
			),
			'buttonOpenOnNewWindow'    => array(
				'id'      => 'woocommerce_tinkoff_credit_buttonOpenOnNewWindow',
				'title'   => __( 'Open On New Window', 'tinkoff-credit' ),
				'desc'    => __( 'Open loan processing on a new window (tab)?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			'front_section_end'        => array(
				'type' => 'sectionend',
				'id'   => 'woocommerce_tinkoff_credit_front_section_end',
			),

			// Output settings section.
			'display_section_title'    => array(
				'id'   => 'woocommerce_tinkoff_credit_output_section_title',
				'name' => __( 'Output', 'tinkoff-credit' ),
				'type' => 'title',
				'desc' => __( 'Buy in Credit button location settings.', 'tinkoff-credit' ),
			),
			'buttonOnProductPage'      => array(
				'id'      => 'woocommerce_tinkoff_credit_buttonOnProductPage',
				'title'   => __( 'Product Page', 'tinkoff-credit' ),
				'desc'    => __( 'Display button on single product page?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			'buttonOnCatalogPage'      => array(
				'id'            => 'woocommerce_tinkoff_credit_buttonOnCatalogPage',
				'title'         => __( 'Catalog Page', 'tinkoff-credit' ),
				'desc'          => __( 'Display button on catalog pages?', 'tinkoff-credit' ),
				'desc_tip'      => __( 'The pages are: shop, product category, product tag and search pages.', 'tinkoff-credit' ),
				'type'          => 'checkbox',
				'checkboxgroup' => 'start',
				'default'       => 'yes',
			),
			'labelOnCatalogPage'       => array(
				'id'            => 'woocommerce_tinkoff_credit_labelOnCatalogPage',
				'desc'          => __( 'Display label on catalog pages?', 'tinkoff-credit' ),
				'type'          => 'checkbox',
				'checkboxgroup' => 'end',
				'default'       => 'no',
			),
			'labelTextOnCatalogPage'   => array(
				'id'       => 'woocommerce_tinkoff_credit_labelTextOnCatalogPage',
				'desc'     => __( 'Text of the label.', 'tinkoff-credit' ),
				'desc_tip' => __( 'If you leave this field empty, the label is output without a text.', 'tinkoff-credit' ),
				'type'     => 'text',
				'default'  => __( 'Available on Credit', 'tinkoff-credit' ),
			),
			'buttonOnCart'             => array(
				'id'      => 'woocommerce_tinkoff_credit_buttonOnCart',
				'title'   => __( 'Cart Page', 'tinkoff-credit' ),
				'desc'    => __( 'Display button on cart page?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			'buttonOnCartLocation'     => array(
				'id'       => 'woocommerce_tinkoff_credit_buttonOnCartLocation',
				'title'    => __( 'Location on Cart Page', 'tinkoff-credit' ),
				'desc_tip' => __( 'Button location on the cart page', 'tinkoff-credit' ),
				'type'     => 'select',
				'default'  => 'woocommerce_before_cart_collaterals',
				'options'  => array(
					'woocommerce_before_cart'                    => __( 'Before the cart', 'tinkoff-credit' ),
					'woocommerce_before_cart_collaterals'        => __( 'After the table of goods', 'tinkoff-credit' ),
					'woocommerce_before_cart_totals'             => __( 'Before the cart totals title',
						'tinkoff-credit' ),
					'woocommerce_cart_totals_before_order_total' => __( 'Before the cart totals', 'tinkoff-credit' ),
					'woocommerce_proceed_to_checkout'            => __( 'Before the checkout button',
						'tinkoff-credit' ),
					'woocommerce_after_cart'                     => __( 'After the cart', 'tinkoff-credit' ),
				),
			),
			'buttonOnCheckout'         => array(
				'id'      => 'woocommerce_tinkoff_credit_buttonOnCheckout',
				'title'   => __( 'Checkout Page', 'tinkoff-credit' ),
				'desc'    => __( 'Display button on checkout page?', 'tinkoff-credit' ),
				'type'    => 'checkbox',
				'default' => 'yes',
			),
			'buttonOnCheckoutLocation' => array(
				'id'       => 'woocommerce_tinkoff_credit_buttonOnCheckoutLocation',
				'title'    => __( 'Location on Checkout Page', 'tinkoff-credit' ),
				'desc_tip' => __( 'Button location on the checkout page', 'tinkoff-credit' ),
				'type'     => 'select',
				'default'  => 'woocommerce_after_checkout_form',
				'options'  => array(
					'woocommerce_before_checkout_form' => __( 'Before the checkout', 'tinkoff-credit' ),
					'woocommerce_after_checkout_form'  => __( 'After the checkout', 'tinkoff-credit' ),
				),
			),
			'display_section_end'      => array(
				'type' => 'sectionend',
				'id'   => 'woocommerce_tinkoff_credit_output_section_end',
			),
		);

		return apply_filters( 'woocommerce_tinkoff_credit_settings', $settings );
	}
}

Tinkoff_Credit_WC_Settings::init();