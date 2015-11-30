<?php
/**
 * Add payment method form form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_account_add_payment_method_form', 'form', array(
	'id' => 'add_payment_method',
	'method' => 'post'
) );

	echo beans_open_markup( 'woo_account_add_payment_wrap', 'div', array( 'id' => 'payment' ) );

		echo beans_open_markup( 'woo_account_payment_methods_list', 'ul', array( 'class' => 'payment_methods methods' ) );

			if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) :

					// Chosen Method
					if ( sizeof( $available_gateways ) )
						current( $available_gateways )->set_current();

					foreach ( $available_gateways as $gateway ) :

						echo beans_open_markup( 'woo_account_payment_methods_list_item', 'li', array( 'class' => 'payment_method_' . $gateway->id ) );

							echo beans_selfclose_markup( 'woo_account_payment_methods_list_item_input', 'input', array(
								'id' => 'payment_method_' . $gateway->id,
								'type' => 'radio',
								'class' => 'input-radio',
								'name' => 'payment_method',
								'value' => esc_attr( $gateway->id,
								'checked' => checked( $gateway->chosen, true ) ? 'checked' : null ) );

							echo beans_open_markup( 'woo_account_payment_methods_list_item_label', 'label', array( 'for' => 'payment_method_' . $gateway->id ) );

								echo $gateway->get_title() . ' ' . $gateway->get_icon();

							echo v( 'woo_account_payment_methods_list_item_label', 'label' );

							if ( $gateway->has_fields() || $gateway->get_description() ) :

								echo beans_open_markup( 'woo_account_payment_methods_hidden', 'div', array(
									'class' => 'payment_box payment_method_' . $gateway->id,
									'style' => 'display:none;'
							 	) );

									$gateway->payment_fields();

								echo beans_close_markup( 'woo_account_payment_methods_hidden', 'div' );

							endif;

						echo beans_close_markup( 'woo_account_payment_methods_list_item', 'li' );

					endforeach;

				else :

					echo beans_open_markup( 'woo_account_payment_methods_empty_notice', 'p' );

						echo __( 'Sorry, it seems that there are no payment methods which support adding a new payment method. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );

					echo beans_close_markup( 'woo_account_payment_methods_empty_notice', 'p' );

				endif;

		echo beans_close_markup( 'woo_account_payment_methods_list', 'ul' );

		echo beans_open_markup( 'woo_account_payment_method_submit', 'div', array( 'class' => 'form-row' ) );

			wp_nonce_field( 'woocommerce-add-payment-method' );

			echo beans_selfclose_markup( 'woo_account_payment_method_submit_input', 'input', array(
				'type' => 'submit',
				'class' => 'button alt',
				'id' => 'place_order',
				'value' => esc_attr_e( 'Add Payment Method', 'woocommerce' )
			) );

			echo beans_selfclose_markup( 'woo_account_payment_method_hidden_input', 'input', array(
				'type' => 'hidden',
				'name' => 'woocommerce_add_payment_method',
				'value' => 1
			) );

		echo beans_close_markup( 'woo_account_payment_method_submit', 'div' );

	echo beans_close_markup( 'woo_account_add_payment_wrap', 'div' );

echo beans_close_markup( 'woo_account_add_payment_method_wrap', 'form' );
