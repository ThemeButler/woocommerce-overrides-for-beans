<?php
/**
 * Edit address form
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

get_currentuserinfo();

wc_print_notices();

if ( ! $load_address ) :

	wc_get_template( 'myaccount/my-address.php' );

else :

	echo beans_open_markup( 'woo_edit_address_form', 'form', array( 'method' => 'post' ) );

		echo beans_open_markup( 'woo_edit_address_title', 'h3' );

			echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title );

		echo beans_close_markup( 'woo_edit_address_title', 'h3' );

		do_action( "woocommerce_before_edit_address_form_{$load_address}" );

		foreach ( $address as $key => $field ) :

			woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] );

		endforeach;

		do_action( "woocommerce_after_edit_address_form_{$load_address}" );

		echo beans_open_markup( 'woo_edit_address_submit', 'p' );

			echo beans_selfclose_markup( 'woo_edit_address_submit_input', 'input', array(
				'type' => 'submit',
				'class' => 'button',
				'name' => 'save_address',
				'value' => __( 'Save Address', 'woocommerce' )
			) );

			wp_nonce_field( 'woocommerce-edit_address' );

			echo beans_selfclose_markup( 'woo_edit_address_hidden_input', 'input', array(
				'type' => 'hidden',
				'name' => 'action',
				'value' => 'edit_address'
			) );

		echo beans_close_markup( 'woo_edit_address_submit', 'p' );

	echo beans_close_markup( 'woo_edit_address_form', 'form' );

endif;
