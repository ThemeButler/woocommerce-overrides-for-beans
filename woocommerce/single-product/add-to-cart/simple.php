<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( ! $product->is_purchasable() ) :

	return;

endif;


// Availability
$availability = $product->get_availability();

$availability_html = empty( $availability['availability'] ) ? '' : beans_open_markup( 'woo_single_add_to_cart_grouped_availability', 'p', array( 'class' => 'stock' ) ) . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . beans_close_markup( 'woo_single_add_to_cart_grouped_availability', 'p' );

echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );

if ( $product->is_in_stock() ) :

	do_action( 'woocommerce_before_add_to_cart_form' );

	echo beans_open_markup( 'woo_single_cart_simple_form', 'form', array(
		'class' => 'cart',
		'method' => 'post',
		'enctype' => 'multipart/form-data'
	) );

	 	do_action( 'woocommerce_before_add_to_cart_button' );

	 	if ( ! $product->is_sold_individually() ) :

	 			woocommerce_quantity_input( array(

	 				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
	 				'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )

				) );

	 		endif;

			echo beans_selfclose_markup( 'woo_single_cart_simple_input_hidden', 'input', array(
				'type' => 'hidden',
				'name' => 'add-to-cart',
				'value' => esc_attr( $product->id )
			) );

		echo beans_open_markup( 'woo_single_cart_simple_button', 'button', array(
			'type' => 'submit',
			'class' => 'single_add_to_cart_button button alt'
		) );
		// Bug: Markup ID not getting added to output
		
			echo esc_html( $product->single_add_to_cart_text() );

		echo beans_close_markup( 'woo_single_cart_simple_button', 'button' );

		do_action( 'woocommerce_after_add_to_cart_button' );

	echo beans_close_markup( 'woo_single_cart_simple_form', 'form' );

	do_action( 'woocommerce_after_add_to_cart_form' );

endif;
