<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** @global WC_Checkout $checkout */


echo beans_open_markup( 'woo_billing_fields', 'div', array( 'class' => 'woocommerce-billing-fields' ) );

	if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) :

		echo beans_open_markup( 'woo_billing_title', 'h3' );

			_e( 'Billing &amp; Shipping', 'woocommerce' );

		echo beans_close_markup( 'woo_billing_title', 'h3' );

	else :

		echo beans_open_markup( 'woo_billing_title', 'h3' );

			_e( 'Billing Details', 'woocommerce' );

		echo beans_close_markup( 'woo_billing_title', 'h3' );

	endif;

	do_action( 'woocommerce_before_checkout_billing_form', $checkout );

	foreach ( $checkout->checkout_fields['billing'] as $key => $field ) :

		woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

	endforeach;

	do_action('woocommerce_after_checkout_billing_form', $checkout );

	if ( ! is_user_logged_in() && $checkout->enable_signup ) :

		if ( $checkout->enable_guest_checkout ) :

			echo beans_open_markup( 'woo_billing_register_input_wrap', 'p', array( 'class' => 'form-row form-row-wide create-account' ) );

				echo beans_selfclose_markup( 'woo_billing_register_input', 'input', array(
					'class' => 'input-checkbox',
					'id' => 'createaccount',
					'checked' => true === $checkout->get_value( 'createaccount' ) || true === apply_filters( 'woocommerce_create_account_default_checked', false ) ? 'checked' : null,
					'type' => 'checkbox',
					'name' => 'createaccount',
					'value' => 1 )
				);

				echo beans_open_markup( 'woo_billing_register_label', 'label', array(
					'for' => 'createaccount',
					'class' => 'checkbox'
				) );

					_e( 'Create an account?', 'woocommerce' );

				echo beans_close_markup( 'woo_billing_register_label', 'label' );

			echo beans_close_markup( 'woo_billing_register_input_wrap', 'p' );

		endif;

		do_action( 'woocommerce_before_checkout_registration_form', $checkout );

		if ( ! empty( $checkout->checkout_fields['account'] ) ) :

			echo beans_open_markup( 'woo_billing_register', 'div', array( 'class' => 'create-account' ) );

				echo beans_open_markup( 'woo_billing_register_note', 'p' );

					_e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' );

				echo beans_close_markup( 'woo_billing_register_note', 'p' );

				foreach ( $checkout->checkout_fields['account'] as $key => $field ) :

					woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );

				endforeach;

				echo beans_open_markup( 'woo_billing_register_clear', 'div', array( 'class' => 'clear' ) );

				echo beans_close_markup( 'woo_billing_register_clear', 'div' );

			echo beans_close_markup( 'woo_billing_register', 'div' );

		endif;

		do_action( 'woocommerce_after_checkout_registration_form', $checkout );

	endif;

echo beans_close_markup( 'woo_billing_fields', 'div' );
