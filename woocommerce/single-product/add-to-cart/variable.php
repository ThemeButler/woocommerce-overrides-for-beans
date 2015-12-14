<?php
/**
 * Variable product add to cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$attribute_keys = array_keys( $attributes );

do_action( 'woocommerce_before_add_to_cart_form' );

echo beans_open_markup( 'woo_single_add_to_cart_variable_form', 'form', array(
	'class' => 'variations_form cart',
	'method' => 'post',
	'enctype' => 'multipart/form-data',
	'data-product_id' => absint( $product->id ),
	'data-product_variations' => esc_attr( json_encode( $available_variations ) )
) );

	do_action( 'woocommerce_before_variations_form' );

	if ( empty( $available_variations ) && false !== $available_variations ) :

		echo beans_open_markup( 'woo_single_add_to_cart_variable_out_of_stock_message', 'p', array( 'class' => 'stock out-of-stock' ) );

			_e( 'This product is currently out of stock and unavailable.', 'woocommerce' );

		echo beans_close_markup( 'woo_single_add_to_cart_variable_out_of_stock_message', 'p' );

	else :

		echo beans_open_markup( 'woo_single_add_to_cart_variable_table', 'table', array(
			'class' => 'variations',
			'cellspacing' => 0
		) );

			echo beans_open_markup( 'woo_single_add_to_cart_variable_tbody', 'tbody' );

				foreach ( $attributes as $attribute_name => $options ) :

					echo beans_open_markup( 'woo_single_add_to_cart_variable_tr', 'tr' );

						echo beans_open_markup( 'woo_single_add_to_cart_variable_label_cell', 'td', array( 'class' => 'label' ) );

							echo beans_open_markup( 'woo_single_add_to_cart_variable_label', 'label', array( 'for' => sanitize_title( $attribute_name ) ) );

								echo wc_attribute_label( $attribute_name );

							echo beans_open_markup( 'woo_single_add_to_cart_variable_label', 'label' );

						echo beans_close_markup( 'woo_single_add_to_cart_variable_label_td', 'td' );

						echo beans_open_markup( 'woo_single_add_to_cart_variable_value_cell', 'td', array( 'class' => 'value' ) );

							$selected = isset( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) ? wc_clean( $_REQUEST[ 'attribute_' . sanitize_title( $attribute_name ) ] ) : $product->get_variation_default_attribute( $attribute_name );

							wc_dropdown_variation_attribute_options( array(
								'options' => $options,
								'attribute' => $attribute_name,
								'product' => $product,
								'selected' => $selected
							) );

							echo end( $attribute_keys ) === $attribute_name ? beans_open_markup( 'woo_single_add_to_cart_remove_variation_link', 'a', array(
								'class' => 'reset_variations',
								'href' => '#'
							) ) . __( 'Clear selection', 'woocommerce' ) . beans_close_markup( 'woo_single_add_to_cart_remove_variation_link', 'a' ) : '';


						echo beans_close_markup( 'woo_single_add_to_cart_variable_value_cell', 'td' );

					echo beans_close_markup( 'woo_single_add_to_cart_variable_tr', 'tr' );

		        endforeach;

			echo beans_close_markup( 'woo_single_add_to_cart_variable_tbody', 'tbody' );

		echo beans_close_markup( 'woo_single_add_to_cart_variable_table', 'table' );

		do_action( 'woocommerce_before_add_to_cart_button' );

		echo beans_open_markup( 'woo_single_add_to_cart_single_variation_wrap', 'div', array(
			'class' => 'single_variation_wrap',
			'style' => 'display:none;'
		) );

			/**
			 * woocommerce_before_single_variation Hook
			 */
			do_action( 'woocommerce_before_single_variation' );

			/**
			 * woocommerce_single_variation hook. Used to output the cart button and placeholder for variation data.
			 * @since 2.4.0
			 * @hooked woocommerce_single_variation - 10 Empty div for variation data.
			 * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
			 */
			do_action( 'woocommerce_single_variation' );

			/**
			 * woocommerce_after_single_variation Hook
			 */
			do_action( 'woocommerce_after_single_variation' );

		echo beans_close_markup( 'woo_single_add_to_cart_single_variation_wrap', 'div' );

		do_action( 'woocommerce_after_add_to_cart_button' );

	endif;

	do_action( 'woocommerce_after_variations_form' );

echo beans_close_markup( 'woo_single_add_to_cart_variable_form', 'form' );

do_action( 'woocommerce_after_add_to_cart_form' );
