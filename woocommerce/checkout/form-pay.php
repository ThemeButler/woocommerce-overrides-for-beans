<?php
/**
 * Pay for order form
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.4.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_checkout_pay_form', 'form', array( 'id' => 'order_review', 'method' => 'post' ) );

	echo beans_open_markup( 'woo_checkout_pay_table', 'table', array( 'class' => 'shop_table' ) );

		echo beans_open_markup( 'woo_checkout_pay_thead', 'thead' );

			echo beans_open_markup( 'woo_checkout_pay_thead_row', 'tr' );

				echo beans_open_markup( 'woo_checkout_pay_thead_name', 'th', array( 'class' => 'product-name' ) );

					_e( 'Product', 'woocommerce' );

				echo beans_close_markup( 'woo_checkout_pay_thead_name' ) );

				echo beans_open_markup( 'woo_checkout_pay_thead_quantity', 'th', array( 'class' => 'product-quantity' ) );

					_e( 'Qty', 'woocommerce' );

				echo beans_close_markup( 'woo_checkout_pay_thead_quantity' ) );

				echo beans_open_markup( 'woo_checkout_pay_thead_total', 'th', array( 'class' => 'product-total' ) );

					_e( 'Totals', 'woocommerce' );

				echo beans_close_markup( 'woo_checkout_pay_thead_total' ) );

			echo beans_close_markup( 'woo_checkout_pay_thead_row', 'tr' );

		echo beans_close_markup( 'woo_checkout_pay_thead', 'thead' );

		echo beans_open_markup( 'woo_checkout_pay_tbody', 'tbody' );

			if ( sizeof( $order->get_items() ) > 0 ) :

				foreach ( $order->get_items() as $item ) :

					echo beans_open_markup( 'woo_checkout_pay_tbody_row', 'tr' );

						echo beans_open_markup( 'woo_checkout_pay_tbody_name', 'td', array( 'class' => 'product-name' ) );

							echo $item['name'];

						echo beans_close_markup( 'woo_checkout_pay_tbody_name', 'td' );

						echo beans_open_markup( 'woo_checkout_pay_tbody_quantity', 'td', array( 'class' => 'product-quantity' ) );

							echo $item['qty'];

						echo beans_close_markup( 'woo_checkout_pay_tbody_quantity', 'td' );

						echo beans_open_markup( 'woo_checkout_pay_tbody_subtotal', 'td', array( 'class' => 'product-subtotal' ) );

							echo $order->get_formatted_line_subtotal( $item );

						echo beans_close_markup( 'woo_checkout_pay_tbody_subtotal', 'td' );

					echo beans_close_markup( 'woo_checkout_pay_tbody_row', 'tr' );

				endforeach;

			endif;

		echo beans_close_markup( 'woo_checkout_pay_tbody', 'tbody' );

		echo beans_open_markup( 'woo_checkout_pay_tfoot', 'tfoot' );

			echo beans_open_markup( 'woo_checkout_pay_tfoot_row', 'tr' );

			if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) :

				echo beans_open_markup( 'woo_checkout_pay_total_label', 'th', array( 'scope' => 'row', 'colspan' => 2 ) );

					echo $total['label'];

				echo beans_close_markup( 'woo_checkout_pay_total_label', 'th' );

				echo beans_open_markup( 'woo_checkout_pay_total_value', 'td', array( 'class' => 'product-total' ) );

					echo $total['value'];

				echo beans_close_markup( 'woo_checkout_pay_total_value', 'td' ) );

			endforeach;

			echo beans_close_markup( 'woo_checkout_pay_tfoot_row', 'tr' );

		echo beans_close_markup( 'woo_checkout_pay_tfoot', 'tfoot' );

	echo beans_close_markup( 'woo_checkout_pay_table', 'table' );

	echo beans_open_markup( 'woo_checkout_payment', 'div', array( 'id' => 'payment' ) );

		if ( $order->needs_payment() ) :

		echo beans_open_markup( 'woo_checkout_payment_methods', 'ul', array( 'class' => 'payment_methods methods' ) );

			if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) :

					// Chosen Method
					if ( sizeof( $available_gateways ) ) :

						current( $available_gateways )->set_current();

					endif;

					foreach ( $available_gateways as $gateway ) :

						echo beans_open_markup( 'woo_checkout_payment_methods_gateway', 'li', array( 'class' => 'payment_method_' . $gateway->id ) );

							echo beans_selfclose_markup( 'woo_checkout_payment_methods_gateway_input', 'input', array(
								'id' => 'payment_method_' . $gateway->id,
								'type' => 'radio',
								'class' => 'input-radio',
								'name' => 'payment_method',
								'value' => esc_attr( $gateway->id ),
								'checked' => checked( $gateway->chosen, true ),
								#TODO Double check
								'data-order_button_text' => esc_attr( $gateway->order_button_text )
								) );

							echo beans_open_markup( 'woo_checkout_payment_methods_gateway_label', 'label', array( 'for' => 'payment_method_' . $gateway->id ) );

								echo $gateway->get_title(); echo $gateway->get_icon();

							echo beans_close_markup( 'woo_checkout_payment_methods_gateway_label', 'label' );

							if ( $gateway->has_fields() || $gateway->get_description() ) :

								echo beans_open_markup( 'woo_checkout_payment_method_fields', 'div', array( 'class' => 'payment_box payment_method_' . $gateway->id ) );

									$gateway->payment_fields();

								echo beans_close_markup( 'woo_checkout_payment_method_fields', 'div' ) );

							endif;

						echo beans_close_markup( 'woo_checkout_payment_methods_gateway', 'li' ) );

					endforeach;

				else :

					echo beans_open_markup( 'woo_checkout_no_payment_method_notice', 'p' ) . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) . beans_close_markup( 'woo_checkout_no_payment_method_notice', 'p' );

				endif;

		echo beans_close_markup( 'woo_checkout_payment_methods', 'ul' ) );

		endif;

		echo beans_open_markup( 'woo_checkout_place_order', 'div', array( 'class' => 'form-row' ) );

			wp_nonce_field( 'woocommerce-pay' );

			$pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', __( 'Pay for order', 'woocommerce' ) );

				echo apply_filters( 'woocommerce_pay_order_button_html', beans_selfclose_markup( 'woo_pay_order_button_html', 'input', array(
					'type' => 'submit',
					'class' => 'button alt',
					'id' => 'place_order',
					'value' => esc_attr( $pay_order_button_text ),
					'data-value' => esc_attr( $pay_order_button_text )
					) ) );

			<input type="hidden" name="woocommerce_pay" value="1" />

		echo beans_close_markup( 'woo_checkout_place_order', 'div' ) );

	echo beans_close_markup( 'woo_checkout_payment', 'div' ) );

echo beans_close_markup( 'woo_checkout_pay_form', 'form', array(
	'id' => 'order_review',
	'method' => 'post'
) );
