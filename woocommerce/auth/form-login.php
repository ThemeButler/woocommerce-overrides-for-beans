<?php
/**
 * Auth form login
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_auth_page_header' );

echo beans_open_markup( 'woo_auth_form_heading', 'h1' );

	printf( __( '%s would like to connect to your store' , 'woocommerce' ), esc_html( $app_name ) );

echo beans_close_markup( 'woo_auth_form_heading', 'h1' );

wc_print_notices();

echo beans_open_markup( 'woo_auth_form_notice', 'p' );

	printf( __( 'To connect to %1$s you need to be logged in. Log in to your store below, or %2$scancel and return to %1$s%3$s', 'woocommerce' ), wc_clean( $app_name ), beans_open_markup( 'woo_auth_form_notice_return_link', 'a', array( 'href' => esc_url( $return_url ) ) ), beans_close_markup( 'woo_auth_form_notice_return_link', 'a' ) );

echo beans_close_markup( 'woo_auth_form_notice', 'p' );

echo beans_open_markup( 'woo_auth_form', 'form', array(
	'method' => 'post',
	'class' => 'wc-auth-login'
) );

	echo beans_open_markup( 'woo_auth_form_username', 'p', array( 'class' => 'form-row form-row-wide' ) );

		echo beans_open_markup( 'woo_auth_form_username_label', 'label', array( 'for' => 'username' ) );

			_e( 'Username or email address', 'woocommerce' );

			echo beans_open_markup( 'woo_auth_form_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_auth_form_required', 'span' );

		echo beans_close_markup( 'woo_auth_form_username_label', 'label' );

		echo beans_selfclose_markup( 'woo_auth_form_username_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'username',
			'id' => 'username',
			'value' => ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''
		) );

	echo beans_close_markup( 'woo_auth_form_username', 'p' );

	echo beans_open_markup( 'woo_auth_form_password', 'p', array( 'class' => 'form-row form-row-wide' ) );

		echo beans_open_markup( 'woo_auth_form_password_label', 'label', array( 'for' => 'username' ) );

			_e( 'Password', 'woocommerce' );

			echo beans_open_markup( 'woo_auth_form_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_auth_form_required', 'span' );

		echo beans_close_markup( 'woo_auth_form_username_label', 'label' );

		echo beans_selfclose_markup( 'woo_auth_form_password_input', 'input', array(
			'class' => 'input-text',
			'type' => 'password',
			'name' => 'password',
			'id' => 'password'
		) );

	echo beans_close_markup( 'woo_auth_form_password', 'p' );

	echo beans_open_markup( 'woo_auth_form_submit', 'p', array( 'class' => 'wc-auth-actions' ) );

		wp_nonce_field( 'woocommerce-login' );

		echo beans_selfclose_markup( 'woo_auth_form_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button button-large button-primary wc-auth-login-button',
			'name' => 'login',
			'value' => esc_attr_e( 'Login', 'woocommerce' )
		) );

		echo beans_selfclose_markup( 'woo_auth_form_redirect_input', 'input', array(
			'type' => 'hidden',
			'name' => 'redirect',
			'value' => esc_url( $redirect_url )
		) );

	echo beans_close_markup( 'woo_auth_form_submit', 'p' );

echo beans_close_markup( 'woo_auth_form', 'form' );

do_action( 'woocommerce_auth_page_footer' );
