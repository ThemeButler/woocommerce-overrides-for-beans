<?php
/**
 * Order tracking
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_status_text = sprintf( __( 'Order #%s which was made %s has the status &ldquo;%s&rdquo;', 'woocommerce' ), $order->get_order_number(), human_time_diff( strtotime( $order->order_date ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'woocommerce' ), wc_get_order_status_name( $order->get_status() ) );

if ( $order->has_status( 'completed' ) ) $order_status_text .= ' ' . __( 'and was completed', 'woocommerce' ) . ' ' . human_time_diff( strtotime( $order->completed_date ), current_time( 'timestamp' ) ) . __( ' ago', 'woocommerce' );

$order_status_text .= '.';

echo wpautop( esc_attr( apply_filters( 'woocommerce_order_tracking_status', $order_status_text, $order ) ) );

$notes = $order->get_customer_order_notes();

if ( $notes ) :

	echo beans_open_markup( 'woo_order_tracking_title', 'h2' );

		_e( 'Order Updates', 'woocommerce' );

	echo beans_close_markup( 'woo_order_tracking_title', 'h2' );

	echo beans_open_markup( 'woo_order_tracking_list', 'ol', array( 'class' => 'commentlist notes' ) );

		foreach ( $notes as $note ) :

			echo beans_open_markup( 'woo_order_tracking_list_item', 'li', array( 'class' => 'comment note' ) );

				echo beans_open_markup( 'woo_order_tracking_comment_container', 'div', array( 'class' => 'comment_container' ) );

					echo beans_open_markup( 'woo_order_tracking_comment_text', 'div', array( 'class' => 'comment-text' ) );

						echo beans_open_markup( 'woo_order_tracking_comment_meta', 'p', array( 'class' => 'meta' ) );

							echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) );

						echo beans_close_markup( 'woo_order_tracking_comment_meta', 'p' );

						echo beans_open_markup( 'woo_order_tracking_comment_description', 'div', array( 'class' => 'description' ) );

							echo wpautop( wptexturize( wp_kses_post( $note->comment_content ) ) );

						echo beans_close_markup( 'woo_order_tracking_comment_description', 'div' );

						echo beans_open_markup( 'woo_order_tracking_clear', 'div', array( 'class' => 'clear' ) );

						echo beans_close_markup( 'woo_order_tracking_clear', 'div' );

					echo beans_open_markup( 'woo_order_tracking_comment_text', 'div', array( 'class' => 'comment-text' ) );

					echo beans_open_markup( 'woo_order_tracking_clear', 'div', array( 'class' => 'clear' ) );

					echo beans_close_markup( 'woo_order_tracking_clear', 'div' );

				echo beans_open_markup( 'woo_order_tracking_comment_container', 'div', array( 'class' => 'comment_container' ) );

			echo beans_open_markup( 'woo_order_tracking_comment_list_item', 'li', array( 'class' => 'comment note' ) );

		endforeach;

	echo beans_close_markup( 'woo_order_tracking_comment_list', 'ol' );

endif;

do_action( 'woocommerce_view_order', $order->id );
