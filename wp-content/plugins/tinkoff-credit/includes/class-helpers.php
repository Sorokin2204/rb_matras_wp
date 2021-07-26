<?php

defined( 'ABSPATH' ) || exit;

class Tninkoff_Credit_Helpers {
	// Validate checkbox option.
	public static function validate_checkbox_option( $option ) {
		if ( in_array( $option, array( 'yes', 'no' ), true ) ) {

			return $option;
		}

		return false;
	}

	// Convert settings string to array.
	public static function convert_settings_string_to_array( $string ) {
		$array = array_unique( explode( ',', $string ) );

		$array = array_filter( $array, function ( $value ) {
			return ! empty( (int) ( $value ) );
		} );

		$array = array_map( function ( $value ) {
			return absint( $value );
		}, $array );

		$array = array_values( $array );

		return $array;
	}

	// Get authorized user info.
	public static function get_auth_user_info() {
		$current_user  = wp_get_current_user();
		$user          = [];
		$user['email'] = $current_user->user_email ? sanitize_email( $current_user->user_email ) : '';
		$user['phone'] = get_user_meta( $current_user->ID, 'billing_phone', true ) ? wc_format_phone_number( get_user_meta( $current_user->ID, 'billing_phone', true ) ) : '';

		return $user;
	}

	// Check if a price has fraction.
	public static function is_fraction( $price ) {
		$fraction = $price - floor( $price );

		return $fraction ? true : false;
	}

	// Get options.
	public static function get_options() {
		$options                = [];
		$options['shopId']      = esc_attr( get_option( 'woocommerce_tinkoff_credit_shopId' ) );
		$options['showcaseId']  = esc_attr( get_option( 'woocommerce_tinkoff_credit_showcaseId' ) );
		$options['buttonName']  = get_option( 'woocommerce_tinkoff_credit_buttonName' ) ?
			esc_attr( get_option( 'woocommerce_tinkoff_credit_buttonName' ) ) : __( 'Buy in Credit', 'tinkoff-credit' );
		$options['onNewWindow'] = static::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_buttonOpenOnNewWindow' ) ) == 'yes' ?
			'_blank' : '_self';

		return $options;
	}

	// Setup promo button name.
	public static function promo_button_name( $month = false ) {
		$installmentButtonName   = get_option( 'woocommerce_tinkoff_credit_installmentButtonName' ) ?
			esc_attr( get_option( 'woocommerce_tinkoff_credit_installmentButtonName' ) ) : __( 'Installment', 'tinkoff-credit' );
		$installmentButtonMonths = static::validate_checkbox_option( get_option( 'woocommerce_tinkoff_credit_installmentButtonMonths' ) ) == 'yes'
			? ' ' . sprintf( _n( '%s month', '%s months', $month, 'tinkoff-credit' ), number_format_i18n( $month ) )
			: '';

		if ( $month ) {
			return $installmentButtonName . $installmentButtonMonths;
		} else {
			return $installmentButtonName;
		}
	}
}