<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_cart_item_data', 'dl', array( 'class' => 'variation' ) );

	foreach ( $item_data as $data ) :

		echo beans_open_markup( 'woo_cart_item_data_term', 'dt', array( 'class' => 'variation-' . sanitize_html_class( $data['key'] ) ) );

			echo wp_kses_post( $data['key'] );

		echo beans_close_markup( 'woo_cart_item_data_term', 'dt' );

		echo beans_open_markup( 'woo_cart_item_data_definition', 'dd', array( 'class' => 'variation-' . sanitize_html_class( $data['key'] ) ) );

			echo wp_kses_post( wpautop( $data['display'] ) );

		echo beans_close_markup( 'woo_cart_item_data_definition', 'dd' );

	endforeach;

echo beans_close_markup( 'woo_cart_item_data', 'dl' );
