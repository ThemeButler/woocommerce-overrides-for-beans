<?php
/**
 * My Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) :

	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Addresses', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' => __( 'Billing Address', 'woocommerce' ),
		'shipping' => __( 'Shipping Address', 'woocommerce' )
	), $customer_id );

else :

	$page_title = apply_filters( 'woocommerce_my_account_my_address_title', __( 'My Address', 'woocommerce' ) );
	$get_addresses    = apply_filters( 'woocommerce_my_account_get_addresses', array(
		'billing' =>  __( 'Billing Address', 'woocommerce' )
	), $customer_id );

endif;

$col = 1;

echo beans_open_markup( 'woo_my_address_title', 'h2' );

	echo $page_title;

echo beans_close_markup( 'woo_my_address_title', 'h2' );

echo beans_open_markup( 'woo_my_address_description', 'p', array( 'class' => 'myaccount_address' ) );

	echo apply_filters( 'woocommerce_my_account_my_address_description', __( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) );

echo beans_close_markup( 'woo_my_address_description', 'p' );

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) :

	echo beans_open_markup( 'woo_my_address_col2_address', 'div', array( 'class' => 'col2-set addresses' ) );

endif;

foreach ( $get_addresses as $name => $title ) :

	$columns = ( ( $col = $col * -1 ) < 0 ) ? 1 : 2;

	echo beans_open_markup( 'woo_my_address_col' . $columns . '_address', 'div', array(
		'class' => 'col-' . $columns . ' address'
	) );

		echo beans_open_markup( 'woo_my_address_col' . $columns . '_header', 'header', array( 'class' => 'title' ) );

			echo beans_open_markup( 'woo_my_address_col' . $columns . '_title', 'h3' );

				echo $title;

			echo beans_close_markup( 'woo_my_address_col' . $columns . '_title', 'h3' );

			echo beans_open_markup( 'woo_my_address_col' . $columns . '_edit_link', 'a', array(
				'href' => wc_get_endpoint_url( 'edit-address', $name ),
				'class' => 'edit'
			) );

				_e( 'Edit', 'woocommerce' );

			echo beans_close_markup( 'woo_my_address_col' . $columns . '_edit_link', 'a' );

		echo beans_close_markup( 'woo_my_address_col' . $columns . '_header', 'header' );

		echo beans_open_markup( 'woo_my_address_col' . $columns . '_address_wrap', 'address' );

				$address = apply_filters( 'woocommerce_my_account_my_address_formatted_address', array(
					'first_name'  => get_user_meta( $customer_id, $name . '_first_name', true ),
					'last_name'   => get_user_meta( $customer_id, $name . '_last_name', true ),
					'company'     => get_user_meta( $customer_id, $name . '_company', true ),
					'address_1'   => get_user_meta( $customer_id, $name . '_address_1', true ),
					'address_2'   => get_user_meta( $customer_id, $name . '_address_2', true ),
					'city'        => get_user_meta( $customer_id, $name . '_city', true ),
					'state'       => get_user_meta( $customer_id, $name . '_state', true ),
					'postcode'    => get_user_meta( $customer_id, $name . '_postcode', true ),
					'country'     => get_user_meta( $customer_id, $name . '_country', true )
				), $customer_id, $name );

				$formatted_address = WC()->countries->get_formatted_address( $address );

				if ( ! $formatted_address ) :

					_e( 'You have not set up this type of address yet.', 'woocommerce' );

				else :

					echo $formatted_address;

				endif;

		echo beans_close_markup( 'woo_my_address_col' . $columns . '_address_wrap', 'address' );

	echo beans_close_markup( 'woo_my_address_col' . $columns . '_address', 'div' );

endforeach;

if ( ! wc_ship_to_billing_address_only() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) :

	echo beans_close_markup( 'woo_my_address_col2_address', 'div' );

endif;
