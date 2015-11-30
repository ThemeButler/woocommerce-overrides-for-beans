<?php
/**
 * Auth form grant access
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_auth_page_header' );

echo beans_open_markup( 'woo_auth_access_title', 'h1' );

	printf( __( '%s would like to connect to your store' , 'woocommerce' ), esc_html( $app_name ) );

echo beans_close_markup( 'woo_auth_access_title', 'h1' );

wc_print_notices();

echo beans_open_markup( 'woo_auth_access_notice', 'p' );

	printf( __( 'This will give "%s" ' . beans_open_markup( 'woo_auth_access_notice_name', 'strong' ) . '%s' . beans_close_markup( 'woo_auth_access_notice_name', 'strong' ) . ' access which will allow it to:' , 'woocommerce' ), esc_html( $app_name ), esc_html( $scope ) );

echo beans_close_markup( 'woo_auth_access_notice', 'p' );

echo beans_open_markup( 'woo_auth_permissions_list', 'ul', array( 'class' => 'wc-auth-permissions' ) );

	foreach ( $permissions as $permission ) :

		echo beans_open_markup( 'woo_auth_permissions_list_item', 'li' );

			echo esc_html( $permission );

		echo beans_close_markup( 'woo_auth_permissions_list_item', 'li' );

	endforeach;

echo beans_close_markup( 'woo_auth_permissions_list', 'ul' );

echo beans_open_markup( 'woo_auth_logged_in_as_wrap', 'div', array( 'class' => 'wc-auth-logged-in-as' ) );

	echo get_avatar( $user->ID, 70 );

	echo beans_open_markup( 'woo_auth_logged_in_as_p', 'p' );

		printf( __( 'Logged in as %s', 'woocommerce' ), esc_html( $user->display_name ) );

		echo beans_open_markup( 'woo_auth_logout_link', 'a', array(
			'href' => esc_url( $logout_url ),
			'class' => 'wc-auth-logout'
		) );

			_e( 'Logout', 'woocommerce' );

		echo beans_close_markup( 'woo_auth_logout_link', 'a' );

	echo beans_close_markup( 'woo_auth_logged_in_as_p', 'p' );

echo beans_close_markup( 'woo_auth_logged_in_as_wrap', 'div' );

echo beans_open_markup( 'woo_auth_actions_wrap', 'p', array( 'class' => 'wc-auth-actions' ) );

	echo beans_open_markup( 'woo_auth_actions_approve_link', 'a', array(
		'href' => esc_url( $granted_url ),
		'class' => 'button button-primary wc-auth-approve'
	) );

		_e( 'Approve', 'woocommerce' );

	echo beans_close_markup( 'woo_auth_actions_approve_link', 'a' );

	echo beans_open_markup( 'woo_auth_actions_deny_link', 'a', array(
		'href' => esc_url( $return_url ),
		'class' => 'button wc-auth-deny'
	) );

		_e( 'Deny', 'woocommerce' );

	echo beans_close_markup( 'woo_auth_actions_deny_link', 'a' );

echo beans_close_markup( 'woo_auth_actions_wrap', 'p' );

do_action( 'woocommerce_auth_page_footer' );
