<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

echo beans_open_markup( 'woo_my_account_user', 'p', array( 'class' => 'myaccount_user' ) );

	printf(
		__( 'Hello ' . beans_open_markup( 'woo_my_account_user_name', 'strong' ) . '%1$s' . beans_close_markup( 'woo_my_account_user_name', 'strong' ) . ' (not %1$s? ' . beans_open_markup( 'woo_my_account_user_logout_link', 'a', array( 'href' => '%2$s' ) ) . 'Sign out' . beans_close_markup( 'woo_my_account_user_logout_link', 'a' ), 'woocommerce' ) . ' ',
		$current_user->display_name,
		wc_get_endpoint_url( 'customer-logout', '', wc_get_page_permalink( 'myaccount' ) )
	);

	printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and ' . beans_open_markup( 'woo_my_account_user_account_link', 'a', array( 'href' => '%s' ) ) . 'edit your password and account details' . beans_close_markup( 'woo_my_account_user_account_link', 'a' ), 'woocommerce' ),
		wc_customer_edit_account_url()
	);

echo beans_close_markup( 'woo_my_account_user', 'p' );

do_action( 'woocommerce_before_my_account' );

wc_get_template( 'myaccount/my-downloads.php' );

wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) );

wc_get_template( 'myaccount/my-address.php' );

do_action( 'woocommerce_after_my_account' );
