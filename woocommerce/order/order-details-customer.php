<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_order_details_customer_header', 'header' );

	echo beans_open_markup( 'woo_order_details_customer_title', 'h2' );

		_e( 'Customer Details', 'woocommerce' );

	echo beans_close_markup( 'woo_order_details_customer_title', 'h2' );

echo beans_close_markup( 'woo_order_details_customer_header', 'header' );

echo beans_open_markup( 'woo_order_details_customer_details_table', 'table', array( 'class' => 'shop_table shop_table_responsive customer_details' ) );

	if ( $order->customer_note ) :

		echo beans_open_markup( 'woo_order_details_customer_note_row', 'tr' );

			echo beans_open_markup( 'woo_order_details_customer_note_label', 'th' );

				_e( 'Note:', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_customer_note_label', 'th' );

			echo beans_open_markup( 'woo_order_details_customer_note_value', 'td' );

				echo wptexturize( $order->customer_note );

			echo beans_close_markup( 'woo_order_details_customer_note_value', 'td' );

		echo beans_close_markup( 'woo_order_details_customer_note_row', 'tr' );

	endif;

	if ( $order->billing_email ) :

		echo beans_open_markup( 'woo_order_details_customer_email_row', 'tr' );

			echo beans_open_markup( 'woo_order_details_customer_email_label', 'th' );

				_e( 'Email:', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_customer_email_label', 'th' );

			echo beans_open_markup( 'woo_order_details_customer_email_value', 'td' );

				echo esc_html( $order->billing_email );

			echo beans_close_markup( 'woo_order_details_customer_email_value', 'td' );

		echo beans_close_markup( 'woo_order_details_customer_email_row', 'tr' );

	endif;

	if ( $order->billing_phone ) :

		echo beans_open_markup( 'woo_order_details_customer_phone_row', 'tr' );

			echo beans_open_markup( 'woo_order_details_customer_phone_label', 'th' );

				_e( 'Telephone:', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_customer_phone_label', 'th' );

			echo beans_open_markup( 'woo_order_details_customer_phone_value', 'td' );

				echo esc_html( $order->billing_phone );

			echo beans_close_markup( 'woo_order_details_customer_phone_value', 'td' );

		echo beans_close_markup( 'woo_order_details_customer_phone_row', 'tr' );

	endif;

	do_action( 'woocommerce_order_details_after_customer_details', $order );

echo beans_close_markup( 'woo_order_details_customer_details_table', 'table' );

if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) :

	echo beans_open_markup( 'woo_order_details_customer_billing_addresses_wrap', 'div', array( 'class' => 'col2-set addresses' ) );

		echo beans_open_markup( 'woo_order_details_customer_billing_addresses_col1', 'div', array( 'class' => 'col-1' ) );

endif;

echo beans_open_markup( 'woo_order_details_customer_billing_header', 'header', array( 'class' => 'title' ) );

	echo beans_open_markup( 'woo_order_details_customer_billing_title', 'h3' );

		_e( 'Billing Address', 'woocommerce' );

	echo beans_close_markup( 'woo_order_details_customer_billing_title', 'h3' );

echo beans_close_markup( 'woo_order_details_customer_billing_header', 'header' );

echo beans_open_markup( 'woo_order_details_customer_address', 'address' );

	echo ( $address = $order->get_formatted_billing_address() ) ? $address : __( 'N/A', 'woocommerce' );

echo beans_close_markup( 'woo_order_details_customer_address', 'address' );

if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() ) :

	echo beans_close_markup( 'woo_order_details_customer_billing_addresses_col1', 'div' );

	echo beans_open_markup( 'woo_order_details_customer_billing_addresses_col2', 'div', array( 'class' => 'col-2' ) );

		echo beans_open_markup( 'woo_order_details_customer_billing_addresses_col2_header', 'header', array( 'class' => 'title' ) );

			echo beans_open_markup( 'woo_order_details_customer_billing_addresses_col2_title', 'h3' );

				_e( 'Shipping Address', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_customer_billing_addresses_col2_title', 'h3' );

		echo beans_close_markup( 'woo_order_details_customer_billing_addresses_col2_header', 'header' );

		echo beans_open_markup( 'woo_order_details_customer_billing_addresses_col2_address', 'address' );

			echo ( $address = $order->get_formatted_shipping_address() ) ? $address : __( 'N/A', 'woocommerce' );

		echo beans_close_markup( 'woo_order_details_customer_billing_addresses_col2_address', 'address' );

	echo beans_close_markup( 'woo_order_details_customer_billing_addresses_col2', 'div' );

echo beans_open_markup( 'woo_order_details_customer_billing_addresses_wrap', 'div' );

endif;
