<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$customer_orders = get_posts( apply_filters( 'woocommerce_my_account_my_orders_query', array(
	'numberposts' => $order_count,
	'meta_key'    => '_customer_user',
	'meta_value'  => get_current_user_id(),
	'post_type'   => wc_get_order_types( 'view-orders' ),
	'post_status' => array_keys( wc_get_order_statuses() )
) ) );

if ( $customer_orders ) :

	echo beans_open_markup( 'woo_my_orders_title', 'h2' );

		echo apply_filters( 'woocommerce_my_account_my_orders_title', __( 'Recent Orders', 'woocommerce' ) );

	echo beans_close_markup( 'woo_my_orders_title', 'h2' );

	echo beans_open_markup( 'woo_my_orders_table', 'table', array( 'class' => 'shop_table shop_table_responsive my_account_orders' ) );

		echo beans_open_markup( 'woo_my_orders_table_head', 'thead' );

			echo beans_open_markup( 'woo_my_orders_table_head_row', 'tr' );

				echo beans_open_markup( 'woo_my_orders_table_head_order_number', 'th', array( 'class' => 'order-number' ) );

					echo beans_open_markup( 'woo_my_orders_table_head_no_break', 'span', array( 'class' => 'nobr' ) );

						_e( 'Order', 'woocommerce' );

					echo beans_close_markup( 'woo_my_orders_table_head_no_break', 'span' );

				echo beans_close_markup( 'woo_my_orders_table_head_order_number', 'th' );

				echo beans_open_markup( 'woo_my_orders_table_head_order_date', 'th', array( 'class' => 'order-date' ) );

					echo beans_open_markup( 'woo_my_orders_table_head_no_break', 'span', array( 'class' => 'nobr' ) );

						_e( 'Date', 'woocommerce' );

					echo beans_close_markup( 'woo_my_orders_table_head_no_break', 'span' );

				echo beans_close_markup( 'woo_my_orders_table_head_order_date', 'th' );

				echo beans_open_markup( 'woo_my_orders_table_head_order_status', 'th', array( 'class' => 'order-status' ) );

					echo beans_open_markup( 'woo_my_orders_table_head_no_break', 'span', array( 'class' => 'nobr' ) );

						_e( 'Status', 'woocommerce' );

					echo beans_close_markup( 'woo_my_orders_table_head_no_break', 'span' );

				echo beans_close_markup( 'woo_my_orders_table_head_order_status', 'th' );

				echo beans_open_markup( 'woo_my_orders_table_head_order_total', 'th', array( 'class' => 'order-total' ) );

					echo beans_open_markup( 'woo_my_orders_table_head_no_break', 'span', array( 'class' => 'nobr' ) );

						_e( 'Total', 'woocommerce' );

					echo beans_close_markup( 'woo_my_orders_table_head_no_break', 'span' );

				echo beans_close_markup( 'woo_my_orders_table_head_order_total', 'th' );

				echo beans_open_markup( 'woo_my_orders_table_head_order_actions', 'th', array( 'class' => 'order-actions' ) );

					echo '&nbsp';

				echo beans_close_markup( 'woo_my_orders_table_head_order_actions', 'th' );

			echo beans_open_markup( 'woo_my_orders_table_head_row', 'tr' );

		echo beans_close_markup( 'woo_my_orders_table_head', 'thead' );

		echo beans_open_markup( 'woo_my_orders_table_body', 'tbody' );

			foreach ( $customer_orders as $customer_order ) :
				$order = wc_get_order( $customer_order );
				$order->populate( $customer_order );
				$item_count = $order->get_item_count();

				echo beans_open_markup( 'woo_my_orders_table_body_row', 'tr', array( 'class' => 'order' ) );

					echo beans_open_markup( 'woo_my_orders_table_body_order_number', 'td', array(
						'class' => 'order-number',
						'data-title' => esc_attr_e( 'Order Number', 'woocommerce' )
					) );

						echo beans_open_markup( 'woo_my_orders_table_body_order_number_link', 'a', array( 'href' => esc_url( $order->get_view_order_url() ) ) );

							echo _x( '#', 'hash before order number', 'woocommerce' ) . $order->get_order_number();

						echo beans_close_markup( 'woo_my_orders_table_body_order_number_link', 'a' );

					echo beans_close_markup( 'woo_my_orders_table_body_order_number', 'td' );

					echo beans_open_markup( 'woo_my_orders_table_body_order_date', 'td', array(
						'class' => 'order-date',
						'data-title' => esc_attr_e( 'Date', 'woocommerce' )
					) );

						echo beans_open_markup( 'woo_my_orders_table_body_order_date_title', 'time', array(
							'datetime' => date( 'Y-m-d', strtotime( $order->order_date ) ),
							'title' => esc_attr( strtotime( $order->order_date ) )
						) );

							echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );

						echo beans_close_markup( 'woo_my_orders_table_body_order_date_title', 'time' );

					echo beans_close_markup( 'woo_my_orders_table_body_order_date', 'td' );

					echo beans_open_markup( 'woo_my_orders_table_body_order_status', 'td', array(
						'class' => 'order-status',
						'data-title' => esc_attr_e( 'Status', 'woocommerce' ),
						'style' => 'text-align:left; white-space:nowrap;'
					) );

						echo wc_get_order_status_name( $order->get_status() );

					echo beans_close_markup( 'woo_my_orders_table_body_order_status', 'td' );

					echo beans_open_markup( 'woo_my_orders_table_body_order_total', 'td', array(
						'class' => 'order-total',
						'data-title' => esc_attr_e( 'Total', 'woocommerce' )
					) );

						echo sprintf( _n( '%s for %s item', '%s for %s items', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count );

					echo beans_close_markup( 'woo_my_orders_table_body_order_total', 'td' );

					echo beans_open_markup( 'woo_my_orders_table_body_order_actions', 'td', array( 'class' => 'order-actions' ) );

							$actions = array();

							if ( $order->needs_payment() ) :

								$actions['pay'] = array(
									'url'  => $order->get_checkout_payment_url(),
									'name' => __( 'Pay', 'woocommerce' )
								);

							endif;

							if ( in_array( $order->get_status(), apply_filters( 'woocommerce_valid_order_statuses_for_cancel', array( 'pending', 'failed' ), $order ) ) ) :

								$actions['cancel'] = array(
									'url'  => $order->get_cancel_order_url( wc_get_page_permalink( 'myaccount' ) ),
									'name' => __( 'Cancel', 'woocommerce' )
								);

							endif;

							$actions['view'] = array(
								'url'  => $order->get_view_order_url(),
								'name' => __( 'View', 'woocommerce' )
							);

							$actions = apply_filters( 'woocommerce_my_account_my_orders_actions', $actions, $order );

							if ( $actions ) :

								foreach ( $actions as $key => $action ) :

									echo beans_open_markup( 'woo_my_orders_table_body_order_number_link', 'a', array(
										'href' => esc_url( $action['url'] ),
										'class' => 'button ' . sanitize_html_class( $key ) ) ) . esc_html( $action['name'] ) . beans_close_markup( 'woo_my_orders_table_body_order_number_link', 'a' );

								endforeach;

							endif;

					echo beans_close_markup( 'woo_my_orders_table_body_order_actions', 'td' );

				echo beans_close_markup( 'woo_my_orders_table_body_row', 'tr' );

			endforeach;

		echo beans_close_markup( 'woo_my_orders_table_body', 'tbody' );

	echo beans_close_markup( 'woo_my_orders_table', 'table' );

endif;
