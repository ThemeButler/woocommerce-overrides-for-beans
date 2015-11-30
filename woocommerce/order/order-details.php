<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order = wc_get_order( $order_id );

echo beans_open_markup( 'woo_order_details_title', 'h2' );

	_e( 'Order Details', 'woocommerce' );

echo beans_close_markup( 'woo_order_details_title', 'h2' );

echo beans_open_markup( 'woo_order_details_table', 'table', array( 'class' => 'shop_table order_details' ) );

	echo beans_open_markup( 'woo_order_details_thead', 'thead' );

		echo beans_open_markup( 'woo_order_details_thead_row', 'tr' );

			echo beans_open_markup( 'woo_order_details_thead_product_name', 'th', array( 'class' => 'product-name' ) );

				_e( 'Product', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_thead_product_name', 'th' );

			echo beans_open_markup( 'woo_order_details_thead_product_total', 'th', array( 'class' => 'product-total' ) );

				_e( 'Total', 'woocommerce' );

			echo beans_close_markup( 'woo_order_details_thead_product_total', 'th' );

		echo beans_close_markup( 'woo_order_details_thead_row', 'tr' );

	echo beans_close_markup( 'woo_order_details_thead', 'thead' );

	echo beans_open_markup( 'woo_order_details_tbody', 'tbody' );

		foreach( $order->get_items() as $item_id => $item ) :

				wc_get_template( 'order/order-details-item.php', array(
					'order'   => $order,
					'item_id' => $item_id,
					'item'    => $item,
					'product' => apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item )
				) );

			endforeach;

		do_action( 'woocommerce_order_items_table', $order );

	echo beans_close_markup( 'woo_order_details_tbody', 'tbody' );

	echo beans_open_markup( 'woo_order_details_tfoot', 'tfoot' );

		foreach ( $order->get_order_item_totals() as $key => $total ) :

				echo beans_open_markup( 'woo_order_details_tfoot_row', 'tr' );

					echo beans_open_markup( 'woo_order_details_tfoot_total_label', 'th', array( 'scope' => 'row' ) );

						echo $total['label'];

					echo beans_close_markup( 'woo_order_details_tfoot_total_label', 'th' );

					echo beans_open_markup( 'woo_order_details_tfoot_total_value', 'td' );

						echo $total['value'];

					echo beans_close_markup( 'woo_order_details_tfoot_total_value', 'td' );

				echo beans_close_markup( 'woo_order_details_tfoot_row', 'tr' );

		endforeach;

	echo beans_close_markup( 'woo_order_details_tfoot', 'tfoot' );

echo beans_close_markup( 'woo_order_details_table', 'table' );

do_action( 'woocommerce_order_details_after_order_table', $order );

wc_get_template( 'order/order-details-customer.php', array( 'order' =>  $order ) );
