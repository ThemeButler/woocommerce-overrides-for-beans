<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page
 *
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

echo beans_open_markup( 'woo_view_order_notice', 'p', array( 'class' => 'order-info' ) );

	printf( __( 'Order #' . beans_open_markup( 'woo_view_order_notice_order_number', 'mark', array( 'class' => 'order-number' ) ) . '%s' . beans_close_markup( 'woo_view_order_notice_order_number', 'mark' ) . ' was placed on ' . beans_open_markup( 'woo_view_order_notice_order_date', 'mark', array( 'class' => 'order-date' ) ) . '%s' . beans_close_markup( 'woo_view_order_notice_order_date', 'mark' ) . ' and is currently ' . beans_open_markup( 'woo_view_order_notice_order_status', 'mark', array( 'class' => 'order-status' ) ) . '%s' . beans_close_markup( 'woo_view_order_notice_order_status', 'mark' ) . '.', 'woocommerce' ), $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), wc_get_order_status_name( $order->get_status() ) );

echo beans_close_markup( 'woo_view_order_notice', 'p' );

if ( $notes = $order->get_customer_order_notes() ) :

	echo beans_open_markup( 'woo_view_order_title', 'h2' );

		_e( 'Order Updates', 'woocommerce' );

	echo beans_close_markup( 'woo_view_order_title', 'h2' );

	echo beans_open_markup( 'woo_view_order_comment_list', 'ol', array( 'class' => 'commentlist notes' ) );

		foreach ( $notes as $note ) :

			echo beans_open_markup( 'woo_view_order_comment_list_item', 'li', array( 'class' => 'comment note' ) );

				echo beans_open_markup( 'woo_view_order_comment_container', 'div', array( 'class' => 'comment_container' ) );

					echo beans_open_markup( 'woo_view_order_comment_text', 'div', array( 'class' => 'comment-text' ) );

						echo beans_open_markup( 'woo_view_order_comment_meta', 'p', array( 'class' => 'meta' ) );

							echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) );

						echo beans_close_markup( 'woo_view_order_comment_meta', 'p' );

						echo beans_open_markup( 'woo_view_order_comment_description', 'div', array( 'class' => 'description' ) );

							echo wpautop( wptexturize( $note->comment_content ) );

						echo beans_close_markup( 'woo_view_order_comment_description', 'div' );

						echo beans_open_markup( 'woo_view_order_clear', 'div', array( 'class' => 'clear' ) );

						echo beans_close_markup( 'woo_view_order_clear', 'div' );

					echo beans_open_markup( 'woo_view_order_comment_text', 'div', array( 'class' => 'comment-text' ) );

					echo beans_open_markup( 'woo_view_order_clear', 'div', array( 'class' => 'clear' ) );

					echo beans_close_markup( 'woo_view_order_clear', 'div' );

				echo beans_open_markup( 'woo_view_order_comment_container', 'div', array( 'class' => 'comment_container' ) );

			echo beans_open_markup( 'woo_view_order_comment_list_item', 'li', array( 'class' => 'comment note' ) );

		endforeach;

	echo beans_close_markup( 'woo_view_order_comment_list', 'ol' );

endif;

do_action( 'woocommerce_view_order', $order_id );
