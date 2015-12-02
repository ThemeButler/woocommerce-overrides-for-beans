<?php
/**
 * Output a single payment method
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_checkout_payment_method_list_item', 'li', array( 'class' => 'payment_method_' . $gateway->id ) );

	echo beans_selfclose_markup( 'woo_checkout_payment_method_list_input', 'input', array(
		'id' => 'payment_method_' . $gateway->id,
		'type' => 'radio',
		'class' => 'input-radio',
		'name' => 'payment_method',
		'value' => esc_attr( $gateway->id ),
		'checked' => $gateway->chosen, true ? 'checked' : '',
		'data-order_button_text' => esc_attr( $gateway->order_button_text )
	) );

	echo beans_open_markup( 'woo_checkout_payment_method_list_label', 'label', array( 'for' => 'payment_method_' . $gateway->id ) );

		echo $gateway->get_title(); echo $gateway->get_icon();

	echo beans_close_markup( 'woo_checkout_payment_method_list_label', 'label' );

	if ( $gateway->has_fields() || $gateway->get_description() ) :

		echo beans_open_markup( 'woo_checkout_payment_method_list_fields', 'div', array(
			'class' => 'payment_box payment_method_' . $gateway->id,
			'style' => ! $gateway->chosen ? 'display:none;' : null
			#TODO Double check
		) );

			$gateway->payment_fields();

		echo beans_close_markup( 'woo_checkout_payment_method_list_fields', 'div' );

	endif;

echo beans_close_markup( 'woo_checkout_payment_method_list_item', 'li' );
