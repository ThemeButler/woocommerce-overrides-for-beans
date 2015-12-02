<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_checkout_shipping_fields', 'div', array( 'class' => 'woocommerce-shipping-fields' ) );

	if ( WC()->cart->needs_shipping_address() === true ) :

		if ( empty( $_POST ) ) :

			$ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0;

			$ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address );

		else :

			$ship_to_different_address = $checkout->get_value( 'ship_to_different_address' );

		endif;

		echo beans_open_markup( 'woo_checkout_shipping_fields_title', 'h3', array( 'id' => 'ship-to-different-address' ) );

			echo beans_open_markup( 'woo_checkout_shipping_different_address_label', 'label', array(
				'for' => 'ship-to-different-address-checkbox',
				'class' => 'checkbox'
			) );

				_e( 'Ship to a different address? ', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_shipping_different_address_label', 'label' );

			echo beans_selfclose_markup( 'woo_checkout_shipping_different_address_input', 'input', array(
				'id' => 'ship-to-different-address-checkbox',
				'class' => 'input-checkbox',
				'checked' => checked( $ship_to_different_address, 1 ),
				#TODO Double check
				'type' => 'checkbox',
				'name' => 'ship_to_different_address',
				'value' => 1
			) );

		echo beans_close_markup( 'woo_checkout_shipping_fields_title', 'h3' );

		echo beans_open_markup( 'woo_checkout_shipping_address_wrap', 'div', array( 'class' => 'shipping_address' ) );

			do_action( 'woocommerce_before_checkout_shipping_form', $checkout );

			foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) :

				woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

			endforeach;

			do_action( 'woocommerce_after_checkout_shipping_form', $checkout );

		echo beans_close_markup( 'woo_checkout_shipping_address_wrap', 'div' );

	endif;

	do_action( 'woocommerce_before_order_notes', $checkout );

	if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) :

		if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) :

			echo beans_open_markup( 'woo_checkout_additional_info_title', 'h3' );

				_e( 'Additional Information', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_additional_info_title', 'h3' );

		endif;

		foreach ( $checkout->checkout_fields['order'] as $key => $field ) :

			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

		endforeach;

	endif;

	do_action( 'woocommerce_after_order_notes', $checkout );

echo beans_close_markup( 'woo_checkout_shipping_fields', 'div' );
