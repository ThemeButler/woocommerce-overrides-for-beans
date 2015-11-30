<?php
/**
 * Order Item Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) :

	return;

endif;

echo beans_open_markup( 'woo_order_details_row', 'tr', array( 'class' => esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ) ) );

	echo beans_open_markup( 'woo_order_details_product_name', 'td', array( 'class' => 'product-name' ) );

		$is_visible = $product && $product->is_visible();

			echo apply_filters( 'woocommerce_order_item_name', $is_visible ? sprintf( beans_open_markup( 'woo_order_details_product_name_link', 'a', array( 'href' => '%s' ) ) . '%s' . beans_close_markup( 'woo_order_details_product_name_link', 'a' ), get_permalink( $item['product_id'] ), $item['name'] ) : $item['name'], $item, $is_visible );

			echo apply_filters( 'woocommerce_order_item_quantity_html', ' ' . beans_open_markup( 'woo_order_details_product_quantity', 'strong', array( 'class' => 'product-quantity' ) ) . sprintf( '&times; %s', $item['qty'] ) . beans_close_markup( 'woo_order_details_product_quantity', 'strong' ), $item );

			do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

			$order->display_item_meta( $item );

			$order->display_item_downloads( $item );

			do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );

	echo beans_close_markup( 'woo_order_details_product_name', 'td' );

	echo beans_open_markup( 'woo_order_details_product_total', 'td', array( 'class' => 'product-total' ) );

		echo $order->get_formatted_line_subtotal( $item );

	echo beans_close_markup( 'woo_order_details_product_total', 'td' );

echo beans_close_markup( 'woo_order_details_row', 'tr' );

if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $product->id, '_purchase_note', true ) ) ) :

	echo beans_open_markup( 'woo_order_purchase_note', 'tr', array( 'class' => 'product-purchase-note' ) );

		echo beans_open_markup( 'woo_order_purchase_note_cell', 'td', array( 'colspan' => 3 ) );

			echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) );

		echo beans_close_markup( 'woo_order_purchase_note_cell', 'td' );

	echo beans_close_markup( 'woo_order_purchase_note', 'tr' );

endif;
