<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

echo beans_open_markup( 'woo_lost_password_form', 'form', array(
	'method' => 'post',
	'class' => 'lost_reset_password'
) );

	if( 'lost_password' == $args['form'] ) :

		echo beans_open_markup( 'woo_lost_password_message', 'p' );

			echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) );

		echo beans_close_markup( 'woo_lost_password_message', 'p' );

		echo beans_open_markup( 'woo_lost_password_user_login', 'p', array( 'class' => 'form-row form-row-first' ) );

			echo beans_open_markup( 'woo_lost_password_user_login_label', 'label', array( 'for' => 'user_login' ) );

				_e( 'Username or email', 'woocommerce' );

			echo beans_close_markup( 'woo_lost_password_user_login_label', 'label' );

			echo beans_selfclose_markup( 'woo_lost_password_user_login_input', 'input', array(
				'class' => 'input-text',
				'type' => 'text',
				'name' => 'user_login',
				'id' => 'user_login'
			) );

		echo beans_close_markup( 'woo_lost_password_user_login', 'p' );

	else :

		echo beans_open_markup( 'woo_reset_password_message', 'p' );

			echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'woocommerce') );

		echo beans_close_markup( 'woo_reset_password_message', 'p' );

		echo beans_open_markup( 'woo_lost_password_user_password1', 'p', array( 'class' => 'form-row form-row-first' ) );

			echo beans_open_markup( 'woo_lost_password_user_password1_label', 'label', array( 'for' => 'password_1' ) );

				_e( 'New password', 'woocommerce' );

			echo beans_close_markup( 'woo_lost_password_user_password1_label', 'label' );

			echo beans_selfclose_markup( 'woo_lost_password_user_password1_input', 'input', array(
				'type' => 'password',
				'class' => 'input-text',
				'name' => 'password_1',
				'id' => 'password_1'
			) );

		echo beans_close_markup( 'woo_lost_password_user_password1', 'p' );

		echo beans_open_markup( 'woo_lost_password_user_password2', 'p', array( 'class' => 'form-row form-row-last' ) );

			echo beans_open_markup( 'woo_lost_password_user_password2_label', 'label', array( 'for' => 'password_2' ) );

				_e( 'Re-enter new password', 'woocommerce' );

				echo beans_open_markup( 'woo_lost_password_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_lost_password_required', 'span' );

			echo beans_close_markup( 'woo_lost_password_user_password2_label', 'label' );

			echo beans_selfclose_markup( 'woo_lost_password_user_password2_input', 'input', array(
				'type' => 'password',
				'class' => 'input-text',
				'name' => 'password_2',
				'id' => 'password_2'
			) );

		echo beans_close_markup( 'woo_lost_password_user_password2', 'p' );

		echo beans_selfclose_markup( 'woo_lost_password_reset_key_input', 'input', array(
			'type' => 'hidden',
			'name' => 'reset_key',
			'value' => isset( $args['key'] ) ? $args['key'] : ''
		) );

		echo beans_selfclose_markup( 'woo_lost_password_reset_login_input', 'input', array(
			'type' => 'hidden',
			'name' => 'reset_login',
			'value' => isset( $args['login'] ) ? $args['login'] : ''
		) );

	endif;

	echo beans_open_markup( 'woo_lost_password_form_clear', 'div', array( 'class' => 'clear' ) ) . beans_close_markup( 'woo_lost_password_form_clear', 'div' );

	do_action( 'woocommerce_lostpassword_form' );

	echo beans_open_markup( 'woo_lost_password_submit', 'p', array( 'class' => 'form-row' ) );

		echo beans_selfclose_markup( 'woo_lost_password_submit_hidden_input', 'input', array(
			'type' => 'hidden',
			'name' => 'wc_reset_password',
			'value' => true
		) );

		echo beans_selfclose_markup( 'woo_lost_password_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'value' => 'lost_password' == $args['form'] ? __( 'Reset Password', 'woocommerce' ) : __( 'Save', 'woocommerce' )
		) );

	echo beans_close_markup( 'woo_lost_password_submit', 'p' );

	wp_nonce_field( $args['form'] );

echo beans_close_markup( 'woo_lost_password_form', 'form' );
