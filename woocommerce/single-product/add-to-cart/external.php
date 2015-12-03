<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_before_add_to_cart_button' );

echo beans_open_markup( 'woo_add_to_cart_external_wrap', 'p', array( 'class' => 'cart' ) );

	echo beans_open_markup( 'woo_add_to_cart_external_link', 'a', array(
		'href' => esc_url( $product_url ),
		'rel' => 'nofollow',
		'class' => 'single_add_to_cart_button button alt'
	 ) ) . esc_html( $button_text ) . beans_close_markup( 'woo_add_to_cart_external_link', 'a' );

echo beans_close_markup( 'woo_add_to_cart_external_wrap', 'p' );

do_action( 'woocommerce_after_add_to_cart_button' );
