<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) :

	return;

endif;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon? ', 'woocommerce' ) . beans_open_markup( 'woo_cart_coupon_form_login_link', 'a', array(
	'href' => '#',
	'class' => 'showcoupon'
) ) . __( 'Click here to enter your code', 'woocommerce' ) . beans_close_markup( 'woo_cart_coupon_form_login_link', 'a' ) );

wc_print_notice( $info_message, 'notice' );

echo beans_open_markup( 'woo_checkout_coupon', 'form', array(
	'class' => 'checkout_coupon',
	'method' => 'post',
	'style' => 'display:none;'
) );

	echo beans_open_markup( 'woo_checkout_coupon_code', 'p', array( 'class' => 'form-row form-row-first' ) );

		echo beans_selfclose_markup( 'woo_checkout_coupon_code_input', 'input', array(
			'type' => 'text',
			'name' => 'coupon_code',
			'class' => 'input-text',
			'placeholder' => esc_attr_e( 'Coupon code', 'woocommerce' ),
			'id' => 'coupon_code',
			'value' => ''
		) );

	echo beans_close_markup( 'woo_checkout_coupon_code', 'p' );

	echo beans_open_markup( 'woo_checkout_coupon_apply', 'p', array( 'class' => 'form-row form-row-last' ) );

		echo beans_selfclose_markup( 'woo_checkout_coupon_apply_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'apply_coupon',
			'value' => esc_attr_e( 'Apply Coupon', 'woocommerce' )
		) );

	echo beans_close_markup( 'woo_checkout_coupon_apply', 'p' );

	echo beans_open_markup( 'woo_checkout_coupon_clear', 'div', array( 'class' => 'clear' ) );

	echo beans_close_markup( 'woo_checkout_coupon_clear', 'div' );

echo beans_close_markup( 'woo_checkout_coupon', 'form' );
