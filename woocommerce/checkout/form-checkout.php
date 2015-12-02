<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) :

	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );

	return;

endif;

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', WC()->cart->get_checkout_url() );

echo beans_open_markup( 'woo_checkout_form', 'form', array(
	'name' => 'checkout',
	'method' => 'post',
	'class' => 'checkout woocommerce-checkout',
	'action' => esc_url( $get_checkout_url ),
	'enctype' => 'multipart/form-data'
) );

	if ( sizeof( $checkout->checkout_fields ) > 0 ) :

		do_action( 'woocommerce_checkout_before_customer_details' );

		echo beans_open_markup( 'woo_checkout_customer_details', 'div', array(
			'class' => 'col2-set',
			'id' => 'customer_details'
		) );

			echo beans_open_markup( 'woo_checkout_billing', 'div', array( 'class' => 'col-1' ) );

				do_action( 'woocommerce_checkout_billing' );

			echo beans_close_markup( 'woo_checkout_billing', 'div' );

			echo beans_open_markup( 'woo_checkout_shipping', 'div', array( 'class' => 'col-2' ) );

				do_action( 'woocommerce_checkout_shipping' );

			echo beans_close_markup( 'woo_checkout_shipping', 'div' );

		echo beans_close_markup( 'woo_checkout_customer_details', 'div' );

		do_action( 'woocommerce_checkout_after_customer_details' );

		echo beans_open_markup( 'woo_checkout_review_title', 'h3', array( 'id' => 'order_review_heading' ) );

			_e( 'Your order', 'woocommerce' );

		echo beans_close_markup( 'woo_checkout_review_title', 'h3' );

	endif;

	do_action( 'woocommerce_checkout_before_order_review' );

	echo beans_open_markup( 'woo_checkout_review', 'div', array(
		'id' => 'order_review',
		'class' => 'woocommerce-checkout-review-order'
	) );

		do_action( 'woocommerce_checkout_order_review' );

	echo beans_close_markup( 'woo_checkout_review', 'div' );

	do_action( 'woocommerce_checkout_after_order_review' );

echo beans_close_markup( 'woo_checkout_form', 'form' );

do_action( 'woocommerce_after_checkout_form', $checkout );
