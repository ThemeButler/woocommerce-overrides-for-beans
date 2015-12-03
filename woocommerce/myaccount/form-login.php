<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_customer_login_form' );

	if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :

		echo beans_open_markup( 'woo_customer_login', 'div', array(
			'class' => 'col2-set',
			'id' => 'customer_login'
		) );

			echo beans_open_markup( 'woo_customer_login_col1', 'div', array( 'class' => 'col-1' ) );

	endif;

		echo beans_open_markup( 'woo_customer_login_title', 'h2' );

			_e( 'Login', 'woocommerce' );

		echo beans_close_markup( 'woo_customer_login_title', 'h2' );

		echo beans_open_markup( 'woo_customer_login_form', 'form', array(
			'method' => 'post',
			'class' => 'login'
		) );

			do_action( 'woocommerce_login_form_start' );

			echo beans_open_markup( 'woo_customer_login_username', 'p', array( 'class' => 'form-row form-row-wide' ) );

				echo beans_open_markup( 'woo_customer_login_username_label', 'label', array( 'for' => 'username' ) );

					_e( 'Username or email address', 'woocommerce' );

					echo beans_open_markup( 'woo_account_edit_form_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_account_edit_form_required', 'span' );

				echo beans_close_markup( 'woo_customer_login_username_label', 'label' );

				echo beans_selfclose_markup( 'woo_customer_login_username_input', 'input', array(
					'type' => 'text',
					'class' => 'input-text',
					'name' => 'username',
					'id' => 'username',
					'value' => ! empty( $_POST['username'] ) ? esc_attr( $_POST['username'] ) : null
				) );

			echo beans_close_markup( 'woo_customer_login_username', 'p' );

			echo beans_open_markup( 'woo_customer_login_password', 'p', array( 'class' => 'form-row form-row-wide' ) );

				echo beans_open_markup( 'woo_customer_login_password_label', 'label', array( 'for' => 'username' ) );

					_e( 'Password', 'woocommerce' );

					echo beans_open_markup( 'woo_account_edit_form_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_account_edit_form_required', 'span' );

				echo beans_close_markup( 'woo_customer_login_password_label', 'label' );

				echo beans_selfclose_markup( 'woo_customer_login_password_input', 'input', array(
					'type' => 'password',
					'class' => 'input-text',
					'name' => 'password',
					'id' => 'password'
				) );

			echo beans_close_markup( 'woo_customer_login_password', 'p' );

			do_action( 'woocommerce_login_form' );

			echo beans_open_markup( 'woo_customer_login_submit', 'p', array( 'class' => 'form-row' ) );

				wp_nonce_field( 'woocommerce-login' );

				echo beans_selfclose_markup( 'woo_customer_login_submit_input', 'input', array(
					'type' => 'submit',
					'class' => 'button',
					'name' => 'login',
					'value' => __( 'Login', 'woocommerce' )
				) );
				echo ' ';
				echo beans_open_markup( 'woo_customer_login_submit_remember_label', 'label', array(
					'for' => 'rememberme',
					'class' => 'inline'
				) );

				echo beans_selfclose_markup( 'woo_customer_login_remember_input', 'input', array(
					'name' => 'rememberme',
					'type' => 'checkbox',
					'id' => 'rememberme',
					'value' => 'forever'
				) );

				_e( ' Remember me', 'woocommerce' );

				echo beans_close_markup( 'woo_customer_login_submit_remember_label', 'label' );

			echo beans_close_markup( 'woo_edit_address_submit', 'p' );


			echo beans_open_markup( 'woo_customer_login_lost_password', 'p', array( 'class' => 'lost_password' ) );

				echo beans_open_markup( 'woo_customer_login_lost_password_link', 'a', array( 'href' => esc_url( wp_lostpassword_url() ) ) );

					_e( 'Lost your password?', 'woocommerce' );

				echo beans_close_markup( 'woo_customer_login_lost_password_link', 'a' );

			echo beans_close_markup( 'woo_customer_login_lost_password', 'p' );

			do_action( 'woocommerce_login_form_end' );

		echo beans_close_markup( 'woo_customer_login_form', 'form' );

if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) :

	echo beans_close_markup( 'woo_customer_login_col1', 'div' );

	echo beans_open_markup( 'woo_customer_registration_col2', 'div', array( 'class' => 'col-2' ) );

		echo beans_open_markup( 'woo_customer_registration_title', 'h2' );

			_e( 'Register', 'woocommerce' );

		echo beans_close_markup( 'woo_customer_registration_title', 'h2' );

		echo beans_open_markup( 'woo_customer_registration_form', 'form', array(
			'method' => 'post',
			'class' => 'register'
		) );

			do_action( 'woocommerce_register_form_start' );

			if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) :

				echo beans_open_markup( 'woo_customer_registration_username', 'p', array( 'class' => 'form-row form-row-wide' ) );

					echo beans_open_markup( 'woo_customer_registration_username_label', 'label', array( 'for' => 'reg_username' ) );

						_e( 'Username', 'woocommerce' );

						echo beans_open_markup( 'woo_customer_registration_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_customer_registration_required', 'span' );

					echo beans_close_markup( 'woo_customer_registration_username_label', 'label' );

					echo beans_selfclose_markup( 'woo_customer_registration_username_input', 'input', array(
						'type' => 'text',
						'class' => 'input-text',
						'name' => 'username',
						'id' => 'reg_username',
						'value' => ! empty( $_POST['username'] ) ? esc_attr( $_POST['username'] ) : null
					) );

				echo beans_close_markup( 'woo_customer_registration_username', 'p' );

			endif;

			echo beans_open_markup( 'woo_customer_registration_email', 'p', array( 'class' => 'form-row form-row-wide' ) );

				echo beans_open_markup( 'woo_customer_registration_email_label', 'label', array( 'for' => 'reg_email' ) );

					_e( 'Email address', 'woocommerce' );

					echo beans_open_markup( 'woo_customer_registration_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_customer_registration_required', 'span' );

				echo beans_close_markup( 'woo_customer_registration_email_label', 'label' );

				echo beans_selfclose_markup( 'woo_customer_registration_email_input', 'input', array(
					'type' => 'text',
					'class' => 'input-text',
					'name' => 'email',
					'id' => 'reg_email',
					'value' => ! empty( $_POST['email'] ) ? esc_attr( $_POST['email'] ) : ''
				) );

			echo beans_close_markup( 'woo_customer_registration_email', 'p' );

			if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) :

				echo beans_open_markup( 'woo_customer_registration_password', 'p', array( 'class' => 'form-row form-row-wide' ) );

					echo beans_open_markup( 'woo_customer_registration_password_label', 'label', array( 'for' => 'reg_password' ) );

						_e( 'Password', 'woocommerce' );

						echo beans_open_markup( 'woo_customer_registration_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_customer_registration_required', 'span' );

					echo beans_close_markup( 'woo_customer_registration_password_label', 'label' );

					echo beans_selfclose_markup( 'woo_customer_registration_password_input', 'input', array( 'type' => 'password', 'class' => 'input-text', 'name' => 'password', 'id' => 'reg_password' ) );

				echo beans_close_markup( 'woo_customer_registration_password', 'p' );

			endif;

			echo '<!-- Spam Trap -->';
			echo beans_open_markup( 'woo_customer_registration_spam_trap', 'div', array(
				'style' => ( ( is_rtl() ) ? 'right' : 'left' ) . ': -999em; position: absolute'
			) );

				echo beans_open_markup( 'woo_customer_registration_spam_trap_label', 'label', array( 'for' => 'trap' ) );

					_e( 'Anti-spam', 'woocommerce' );

				echo beans_close_markup( 'woo_customer_registration_spam_trap_label', 'label' );

				echo beans_selfclose_markup( 'woo_customer_registration_spam_trap_input', 'input', array(
					'type' => 'text',
					'name' => 'email_2',
					'tabindex' => -1
				) );

			echo beans_close_markup( 'woo_customer_registration_spam_trap', 'div' );

			do_action( 'woocommerce_register_form' );

			do_action( 'register_form' );

			echo beans_open_markup( 'woo_customer_registration_submit', 'p', array( 'class' => 'form-row' ) );

				wp_nonce_field( 'woocommerce-register' );

				echo beans_selfclose_markup( 'woo_customer_registration_submit_input', 'input', array(
					'type' => 'submit',
					'class' => 'button',
					'name' => 'register',
					'value' => __( 'Register', 'woocommerce' )
				) );

			echo beans_close_markup( 'woo_customer_registration_submit', 'p' );

			do_action( 'woocommerce_register_form_end' );

		echo beans_close_markup( 'woo_customer_registration_form', 'form' );

	echo beans_close_markup( 'woo_customer_registration_col2', 'div' );

echo beans_close_markup( 'woo_customer_login', 'div' );

endif;

do_action( 'woocommerce_after_customer_login_form' );
