<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) :

	if ( $order->has_status( 'failed' ) ) :

		echo beans_open_markup( 'woo_order_declined_message', 'p' );

			_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' );

		echo beans_close_markup( 'woo_order_declined_message', 'p' );

		echo beans_open_markup( 'woo_order_try_again_message', 'p' );

				if ( is_user_logged_in() ) :

					_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );

				else :

					_e( 'Please attempt your purchase again.', 'woocommerce' );

				endif;

		echo beans_close_markup( 'woo_order_try_again_message', 'p' );

		echo beans_open_markup( 'woo_order_payment_link_container', 'p' );

			echo beans_open_markup( 'woo_order_payment_link', 'a', array(
				'href' => esc_url( $order->get_checkout_payment_url() ),
				'class' => 'button pay'
			) );

				_e( 'Pay', 'woocommerce' );

			echo beans_close_markup( 'woo_order_payment_link', 'a' );

			if ( is_user_logged_in() ) :

				echo beans_open_markup( 'woo_order_account_link', 'a', array(
					'href' => esc_url( wc_get_page_permalink( 'myaccount' ) ),
					'class' => 'button pay'
				) );

					_e( 'My Account', 'woocommerce' );

				echo beans_close_markup( 'woo_order_account_link', 'a' );

			endif;

		echo beans_close_markup( 'woo_order_payment_link_container', 'p' );

	else :

		echo beans_open_markup( 'woo_order_success_message', 'p' );

			echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order );

		echo beans_close_markup( 'woo_order_success_message', 'p' );

		echo beans_open_markup( 'woo_order_details_list', 'ul', array( 'class' => 'order_details' ) );

			echo beans_open_markup( 'woo_order_details_order_number', 'li', array( 'class' => 'order' ) );

				_e( 'Order Number:', 'woocommerce' );

				echo beans_open_markup( 'woo_order_details_order_number_value', 'strong' );

				echo $order->get_order_number();

				echo beans_close_markup( 'woo_order_details_order_number', 'strong' );

			echo beans_close_markup( 'woo_order_details_order_number', 'li' );

			echo beans_open_markup( 'woo_order_details_order_date', 'li', array( 'class' => 'date' ) );

				_e( 'Date:', 'woocommerce' );

				echo beans_open_markup( 'woo_order_details_order_date_value', 'strong' );

					echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) );

				echo beans_close_markup( 'woo_order_details_order_date_value', 'strong' );

			echo beans_close_markup( 'woo_order_details_order_date', 'li' );

			echo beans_open_markup( 'woo_order_details_order_total', 'li', array( 'class' => 'total' ) );

				_e( 'Total:', 'woocommerce' );

				echo beans_open_markup( 'woo_order_details_order_total_value', 'strong' );

					echo $order->get_formatted_order_total();

				echo beans_close_markup( 'woo_order_details_order_total_value', 'strong' );

			echo beans_close_markup( 'woo_order_details_order_total', 'li' );

			if ( $order->payment_method_title ) :

				echo beans_open_markup( 'woo_order_details_payment_method', 'li', array( 'class' => 'method' ) );

					_e( 'Payment Method:', 'woocommerce' );

					echo beans_open_markup( 'woo_order_details_payment_method_value', 'strong' );

						echo $order->payment_method_title;

					echo beans_close_markup( 'woo_order_details_payment_method_value', 'strong' );

				echo beans_close_markup( 'woo_order_details_payment_method', 'li' );

			endif;

		echo beans_close_markup( 'woo_order_details_list', 'ul' );

		echo beans_open_markup( 'woo_order_details_clear', 'div', array( 'class' => 'clear' ) );

		echo beans_close_markup( 'woo_order_details_clear', 'div' );

	endif;

	do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id );

	do_action( 'woocommerce_thankyou', $order->id );

else :

	echo beans_open_markup( 'woo_order_details_received_notice', 'p' ) . apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ) . beans_close_markup( 'woo_order_details_received_notice', 'p' );

endif;
