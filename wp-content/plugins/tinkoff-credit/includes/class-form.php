<?php

defined( 'ABSPATH' ) || exit;

class Tninkoff_Credit_Form {

	// Minimal order value
	const PRICE_MIN_LIMIT = 3000;

	/**
	 * Bootstraps the class and hooks required actions
	 */
	public static function init() {
		// Settings
		$buttonOnCartLocation     = get_option( 'woocommerce_tinkoff_credit_buttonOnCartLocation' ) ?
			esc_attr( get_option( 'woocommerce_tinkoff_credit_buttonOnCartLocation' ) ) : 'woocommerce_before_cart_collaterals';
		$buttonOnCheckoutLocation = get_option( 'woocommerce_tinkoff_credit_buttonOnCheckoutLocation' ) ?
			esc_attr( get_option( 'woocommerce_tinkoff_credit_buttonOnCheckoutLocation' ) ) : 'woocommerce_before_checkout_form';

		// Form integration
		add_action( 'woocommerce_after_add_to_cart_form', __CLASS__ . '::single_product' );
		add_action( 'woocommerce_after_shop_loop_item', __CLASS__ . '::catalog_pages', 15 );
		add_action( $buttonOnCartLocation, __CLASS__ . '::cart' );
		add_action( $buttonOnCheckoutLocation, __CLASS__ . '::checkout' );

		// Label integration
		add_action( 'woocommerce_before_shop_loop_item_title', __CLASS__ . '::catalog_pages_label', 10 );

		// AJAX coupon handler
		add_action( 'wp_ajax_tnkfcredit_when_coupon_apply', __CLASS__ . '::when_coupon_apply' );
		add_action( 'wp_ajax_nopriv_tnkfcredit_when_coupon_apply', __CLASS__ . '::when_coupon_apply' );
	}


	/**
	 * Main methods
	 */
	// Render Tinkoff Credit form on single product page
	public static function single_product() {
		$isShow = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_buttonOnProductPage' ) );

		static::single_product_and_catalog_forms( $isShow );
	}

	// Render Tinkoff Credit form on catalog pages
	public static function catalog_pages() {
		$isShow = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_buttonOnCatalogPage' ) );

		static::single_product_and_catalog_forms( $isShow );
	}

	// Render Tinkoff Credit forms on cart page
	public static function cart() {
		$isShow = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_buttonOnCart' ) );

		static::cart_and_checkout_forms( $isShow );
	}

	// Render Tinkoff Credit forms on checkout page
	public static function checkout() {
		$isShow = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_buttonOnCheckout' ) );

		static::cart_and_checkout_forms( $isShow );
	}


	// Render Tinkoff Credit forms for single product and catalog pages
	public static function single_product_and_catalog_forms( $isShow ) {
		global $product;
		$product_price = $product->get_price();

		// If 'show option' is active and is a variable product with any price or non-variable product with price higher than PRICE_MIN_LIMIT.
		// We always render the form for variable products.
		if ( $isShow == 'yes' ) {
			$promoCode        = esc_attr( get_option( 'woocommerce_tinkoff_credit_promoCode' ) );
			$installmentPlans = esc_attr( get_option( 'woocommerce_tinkoff_credit_installmentPlans' ) );
			$installmentsOnly = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_installmentsOnly' ) );

			// If current variation has price low than PRICE_MIN_LIMIT or doesn't have default attributes we hide the from.
			$variable_display = '';
			if ( $product_price < self::PRICE_MIN_LIMIT || ( $product->is_type( 'variable' ) && empty( $product->get_default_attributes() ) ) ) {
				$variable_display = ' style="display:none"';
			}

			echo '<div class="tinkoff_credit_wrapper"' . $variable_display . '>';

			if ( ! empty( $promoCode ) && ! empty( $installmentPlans ) ) {
				$months = Tninkoff_Credit_Helpers::convert_settings_string_to_array( $installmentPlans );

				// Display credit button
				if ( $installmentsOnly == 'no' ) {
					static::single_product_and_catalog( 'default' );
				}

				// Display promo buttons (installment)
				foreach ( $months as $month ) {
					$promoButtonName = Tninkoff_Credit_Helpers::promo_button_name( $month );
					$newPromoCode    = $promoCode . $month;

					static::single_product_and_catalog( $newPromoCode, $promoButtonName );
				}
				unset ( $promoCode );

			} elseif ( ! empty( $promoCode ) ) {
				$promoButtonName = Tninkoff_Credit_Helpers::promo_button_name();

				if ( $installmentsOnly == 'no' ) {
					static::single_product_and_catalog( 'default' );
				}

				static::single_product_and_catalog( $promoCode, $promoButtonName );

			} else {
				static::single_product_and_catalog( 'default' );
			}

			echo '</div>';
		}
	}

	// Render Tinkoff Credit forms for cart and checkout pages
	public static function cart_and_checkout_forms( $isShow ) {
		// Total cart price with discounts but without delivery
		$cart_total = WC()->cart->get_cart_contents_total();

		if ( $isShow == 'yes' && $cart_total >= self::PRICE_MIN_LIMIT ) {
			$promoCode        = esc_attr( get_option( 'woocommerce_tinkoff_credit_promoCode' ) );
			$installmentPlans = esc_attr( get_option( 'woocommerce_tinkoff_credit_installmentPlans' ) );
			$installmentsOnly = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_installmentsOnly' ) );

			echo '<div class="tinkoff_credit_wrapper">';

			if ( ! empty( $promoCode ) && ! empty( $installmentPlans ) ) {
				$months = Tninkoff_Credit_Helpers::convert_settings_string_to_array( $installmentPlans );

				// Display credit button
				if ( $installmentsOnly == 'no' ) {
					static::cart_and_checkout( 'default' );
				}

				// Display promo buttons (installment)
				foreach ( $months as $month ) {
					$promoButtonName = Tninkoff_Credit_Helpers::promo_button_name( $month );
					$newPromoCode    = $promoCode . $month;

					static::cart_and_checkout( $newPromoCode, $promoButtonName );
				}
				unset ( $promoCode );

			} elseif ( ! empty( $promoCode ) ) {
				$promoButtonName = Tninkoff_Credit_Helpers::promo_button_name();

				if ( $installmentsOnly == 'no' ) {
					static::cart_and_checkout( 'default' );
				}

				static::cart_and_checkout( $promoCode, $promoButtonName );

			} else {
				static::cart_and_checkout( 'default' );
			}

			echo '</div>';
		}
	}

	// Add labels on catalog pages
	public static function catalog_pages_label() {
		global $product;

		$product_price = $product->get_price();
		$isShow        = Tninkoff_Credit_Helpers::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_labelOnCatalogPage' ) );
		$text          = esc_html( get_option( 'woocommerce_tinkoff_credit_labelTextOnCatalogPage' ) );

		if ( $isShow == 'yes' && $product_price >= self::PRICE_MIN_LIMIT ) {
			echo '<span class="tinkoff_credit_label">' . $text . '</span>';
		}
	}

	// Coupon AJAX handler
	public static function when_coupon_apply() {
		check_ajax_referer( 'apply-coupon', 'security' );

		if ( ! empty( $_POST['coupon_code'] ) ) {
			WC()->cart->add_discount( wc_format_coupon_code( wp_unslash( $_POST['coupon_code'] ) ) ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			echo static::products_list();

			wp_die();
		}
	}


	/**
	 * Form render
	 */
	// Render form main fields
	public static function form_start( $options, $promoCode = false ) {
		if ( $options['shopId'] ) {
			$form
				  = '<form class="tinkoff_credit" action="https://loans.tinkoff.ru/api/partners/v1/lightweight/create" method="post">';
			$form .= '<input name="shopId" value="' . $options['shopId'] . '" type="hidden"/>';
			$form .= '<input name="showcaseId" value="' . $options['showcaseId'] . '" type="hidden"/>';

		} else {
			$form
				  = '<form class="tinkoff_credit" action="https://loans-qa.tcsbank.ru/api/partners/v1/lightweight/create" method="post">';
			$form .= '<input name="shopId" value="test_online" type="hidden"/>';
			$form .= '<input name="showcaseId" value="test_online" type="hidden"/>';
		}

		if ( empty( $promoCode ) ) {
			$form .= '<input name="promoCode" value="default" type="hidden"/>';
		} else {
			$form .= '<input name="promoCode" value="' . $promoCode . '" type="hidden"/>';
		}

		return $form;
	}

	// Render form user fields
	public static function form_end( $user, $options, $promoButtonName ) {
		$buttonName = $promoButtonName ? $promoButtonName : $options['buttonName'];

		$form = $user['email'] ? '<input name="customerEmail" value="' . $user['email'] . '" type="hidden"/>' : '';
		$form .= $user['phone'] ? '<input name="customerPhone" value="' . $user['phone'] . '" type="hidden"/>' : '';
		$form .= '<input type="submit" class="tinkoff_credit_submit" value="' . $buttonName . '" formtarget="' . $options['onNewWindow'] . '"/>';
		$form .= '</form>';

		return $form;
	}

	// Render products list on cart page
	public static function products_list() {
		$i               = 0;
		$form            = '';
		$cart_total      = 0;
		$cart_items      = WC()->cart->get_cart();
		$applied_coupons = WC()->cart->get_applied_coupons();

		foreach ( $cart_items as $cart_item ) {
			$cart_item_name     = $cart_item['data']->get_name();
			$cart_item_quantity = $cart_item['quantity'];

			// Determine the price of the product
			if ( $applied_coupons ) {
				// Get the first applied coupon code
				$first_applied_coupon = $applied_coupons[0];
				// Get a new instance of the WC_Coupon object
				$coupon = new WC_Coupon( $first_applied_coupon );

				$product_id       = $cart_item['product_id'];
				$product_quantity = $cart_item['quantity'];
				$line_total       = $cart_item['line_total'];
				$line_unit_price  = $line_total / $product_quantity;
				$product_object   = wc_get_product( $product_id );

				if ( $coupon->is_valid_for_product( $product_object ) ) {
					$cart_item_price = round( $line_unit_price, 2 );
				} else {
					$cart_item_price = $cart_item['data']->get_price();
				}
			} else {
				$cart_item_price = $cart_item['data']->get_price();
			}

			$cart_item_price = Tninkoff_Credit_Helpers::is_fraction( $cart_item_price ) ? $cart_item_price : $cart_item_price . '.00';
			$cart_total      += $cart_item_price * $cart_item_quantity;

			$form .= '<input name="itemName_' . $i . '" value="' . $cart_item_name . '" type="hidden"/>';
			$form .= '<input name="itemQuantity_' . $i . '" value="' . $cart_item_quantity . '" type="hidden"/>';
			$form .= '<input name="itemPrice_' . $i . '" value="' . $cart_item_price . '" type="hidden"/>';
			$i ++;
		}
		$form .= '<input name="sum" value="' . $cart_total . '" type="hidden">';

		return $form;
	}

	// Render Tinkoff Credit form on single product and catalog pages
	public static function single_product_and_catalog( $promoCode, $promoButtonName = false ) {
		global $product;
		$product_price = $product->get_price();
		$product_price = Tninkoff_Credit_Helpers::is_fraction( $product_price ) ? $product_price : $product_price . '.00';
		$user          = Tninkoff_Credit_Helpers::get_auth_user_info();
		$options       = Tninkoff_Credit_Helpers::get_options();

		// Create credit form (button)
		$form = '<div class="tinkoff_credit_form_wrapper">';
		$form .= static::form_start( $options, $promoCode );

		$form .= '<input name="sum" value="' . $product_price . '" type="hidden">';
		$form .= '<input name="itemName_0" value="' . $product->get_name() . '" type="hidden"/>';
		$form .= '<input name="itemQuantity_0" value="1" type="hidden"/>';
		$form .= '<input name="itemPrice_0" value="' . $product_price . '" type="hidden"/>';

		$form .= static::form_end( $user, $options, $promoButtonName );
		$form .= '</div>';

		echo $form;
	}

	// Render Tinkoff Credit form on cart and checkout pages
	public static function cart_and_checkout( $promoCode, $promoButtonName = false ) {
		$user    = Tninkoff_Credit_Helpers::get_auth_user_info();
		$options = Tninkoff_Credit_Helpers::get_options();

		// Create credit form (button)
		$form = '<div class="tinkoff_credit_form_wrapper">';
		$form .= static::form_start( $options, $promoCode );
		$form .= '<div id="tinkoff_products_list">';
		$form .= static::products_list();
		$form .= '</div>';

		$form .= static::form_end( $user, $options, $promoButtonName );
		$form .= '</div>';

		echo $form;
	}
}

Tninkoff_Credit_Form::init();