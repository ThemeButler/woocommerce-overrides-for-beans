<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) :

	return;

endif;

echo beans_open_markup( 'woo_login_form', 'form', array(
	'method' => 'post',
	'class' => 'login',
	'style' => $hidden ? 'display:none;' : null,
) );

	do_action( 'woocommerce_login_form_start' );

	if ( $message ) echo wpautop( wptexturize( $message ) );

	echo beans_open_markup( 'woo_login_username', 'p', array( 'class' => 'form-row form-row-first' ) );

		echo beans_open_markup( 'woo_login_username_label', 'label', array( 'for' => 'username' ) );

			_e( 'Username or email', 'woocommerce' );

			echo beans_open_markup( 'woo_login_required_indicator', 'span', array( 'class' => 'required' ) );

			echo beans_close_markup( 'woo_login_required_indicator', 'span' );

		echo beans_close_markup( 'woo_login_username_label', 'label' );

		echo beans_selfclose_markup( 'woo_login_username_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'username',
			'id' => 'username'
		) );

	echo beans_close_markup( 'woo_login_username', 'p' );

	echo beans_open_markup( 'woo_login_password', 'p', array( 'class' => 'form-row' ) );

		echo beans_open_markup( 'woo_login_password_label', 'label', array( 'for' => 'password' ) );

			_e( 'Password', 'woocommerce' );

			echo beans_open_markup( 'woo_login_required_indicator', 'span', array( 'class' => 'required' ) );

			echo beans_close_markup( 'woo_login_required_indicator', 'span' );

		echo beans_close_markup( 'woo_login_password_label', 'label' );

		echo beans_selfclose_markup( 'woo_login_password_input', 'input', array(
			'type' => 'password',
			'class' => 'input-text',
			'name' => 'password',
			'id' => 'password'
		) );

	echo beans_close_markup( 'woo_login_password', 'p' );

	echo beans_open_markup( 'woo_login_clear', 'div', array( 'class' => 'clear' ) );

	echo beans_close_markup( 'woo_login_clear', 'div' );

	do_action( 'woocommerce_login_form' );

	echo beans_open_markup( 'woo_login_submit', 'p', array( 'class' => 'form-row' ) );

		wp_nonce_field( 'woocommerce-login' );

		echo beans_selfclose_markup( 'woo_login_submit_hidden_input', 'input', array(
			'type' => 'hidden',
			'name' => 'redirect',
			'value' => esc_attr_e( 'Login', 'woocommerce' )
		) );

		echo beans_selfclose_markup( 'woo_login_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'login',
			'value' => esc_url( $redirect )
		) );

		echo beans_open_markup( 'woo_login_remember_label', 'label', array(
			'for' => 'rememberme',
			'class' => 'inline'
		) );

			echo beans_selfclose_markup( 'woo_login_remember_input', 'input', array(
				'name' => 'rememberme',
				'type' => 'checkbox',
				'id' => 'rememberme',
				'value' => 'forever'
			) );

			_e( 'Remember me', 'woocommerce' );

		echo beans_close_markup( 'woo_login_remember_label', 'label' );

	echo beans_close_markup( 'woo_login_submit', 'p' );

	echo beans_open_markup( 'woo_login_lost_password', 'p', array( 'class' => 'lost_password' ) );

		echo beans_open_markup( 'woo_login_lost_password_link', 'a', array( 'href' => esc_url( wp_lostpassword_url() ) ) );

		_e( 'Lost your password?', 'woocommerce' );

		echo beans_close_markup( 'woo_login_lost_password_link', 'a' );

	echo beans_close_markup( 'woo_login_lost_password', 'p' );

	echo beans_open_markup( 'woo_login_clear', 'div', array( 'class' => 'clear' ) );

	echo beans_close_markup( 'woo_login_clear', 'div' );

	do_action( 'woocommerce_login_form_end' );

echo beans_close_markup( 'woo_login_form', 'form' );
