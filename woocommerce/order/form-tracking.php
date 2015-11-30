<?php
/**
 * Order tracking form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

echo beans_open_markup( 'woo_order_tracking_form', 'form', array(
	'action' => esc_url( get_permalink( $post->ID ) ),
	'method' => 'post',
	'class' => 'track_order'
) );

	echo beans_open_markup( 'woo_order_tracking_order_id_message', 'p' );

		_e( 'To track your order please enter your Order ID in the box below and press the "Track" button. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce' );

	echo beans_close_markup( 'woo_order_tracking_order_id_message', 'p' );

	echo beans_open_markup( 'woo_order_tracking_order_id_wrap', 'p', array( ' class' => 'form-row form-row-first' ) );

		echo beans_open_markup( 'woo_order_tracking_order_id_label', 'label', array( 'for' => 'orderid' ) );

			_e( 'Order ID', 'woocommerce' );

		echo beans_close_markup( 'woo_order_tracking_order_id_label', 'label' );

		echo beans_selfclose_markup( 'woo_order_tracking_order_id_input', 'input', array(
			'class' => 'input-text',
			'type' => 'text',
			'name' => 'orderid',
			'id' => 'orderid',
			'placeholder' => esc_attr_e( 'Found in your order confirmation email.', 'woocommerce' )
		) );

	echo beans_close_markup( 'woo_order_tracking_order_id_wrap', 'p' );

	echo beans_open_markup( 'woo_order_tracking_order_email_wrap', 'p', array( ' class' => 'form-row form-row-last' ) );

		echo beans_open_markup( 'woo_order_tracking_order_email_label', 'label', array( 'for' => 'order_email' ) );

			_e( 'Billing Email', 'woocommerce' );

		echo beans_close_markup( 'woo_order_tracking_order_email_label', 'label' );

		echo beans_selfclose_markup( 'woo_order_tracking_order_email_input', 'input', array(
			'class' => 'input-text',
			'type' => 'text',
			'name' => 'order_email',
			'id' => 'order_email',
			'placeholder' => esc_attr_e( 'Email you used during checkout.', 'woocommerce' )
		) );

	echo beans_close_markup( 'woo_order_tracking_order_email_wrap', 'p' ) );

	echo beans_open_markup( 'woo_order_tracking_clear', 'div', array( 'class' => 'clear' ) );

	echo beans_close_markup( 'woo_order_tracking_clear', 'div' );

	echo beans_open_markup( 'woo_order_tracking_order_submit_button_wrap', 'p', array( ' class' => 'form-row' ) );

		echo beans_selfclose_markup( 'woo_order_tracking_order_submit_button', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'track',
			'value' => esc_attr_e( 'Track', 'woocommerce' )
		) );

	echo beans_close_markup( 'woo_order_tracking_order_submit_button_wrap' );

	wp_nonce_field( 'woocommerce-order_tracking' );

echo beans_close_markup( 'woo_order_tracking_form', 'form' );
