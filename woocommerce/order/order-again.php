<?php
/**
 * Order again button
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_order_again_wrap', 'p', array( 'class' = 'order-again' ) );

	echo beans_open_markup( 'woo_order_again_link', 'a', array(
		'href' = esc_url( wp_nonce_url( add_query_arg( 'order_again', $order->id ) , 'woocommerce-order_again' ) ),
		'class' => 'button'
	) );

		_e( 'Order Again', 'woocommerce' );

	echo beans_close_markup( 'woo_order_again_link', 'a' );

echo beans_close_markup( 'woo_order_again_wrap', 'p' );
