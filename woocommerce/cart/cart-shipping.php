<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_cart_shipping_row', 'tr', array( 'class' => 'shipping' ) );

	echo beans_open_markup( 'woo_cart_shipping_heading', 'th' );


		if ( $show_package_details ) :

			printf( __( 'Shipping #%d', 'woocommerce' ), $index + 1 );

		else :

			_e( 'Shipping', 'woocommerce' );

		endif;

	echo beans_close_markup( 'woo_cart_shipping_heading', 'th' );

	echo beans_open_markup( 'woo_cart_shipping_data', 'td' );

		if ( ! empty( $available_methods ) ) :

			if ( 1 === count( $available_methods ) ) :

				$method = current( $available_methods );

				echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) );

				echo beans_selfclose_markup( 'woo_cart_shipping_method_hidden_input', 'input', array(
					'type' => 'hidden',
					'name' => 'shipping_method[' . $index . ']',
					'data-index' => $index,
					'id' => 'shipping_method_' . $index,
					'value' => esc_attr( $method->id ),
					'class' => 'shipping_method'
				) );

			elseif ( get_option( 'woocommerce_shipping_method_format' ) === 'select' ) :

				echo beans_open_markup( 'woo_cart_shipping_method', 'select', array(
					'name' => 'shipping_method[' . $index . ']',
					'data-index' => $index,
					'id' => 'shipping_method_' . $index,
					'class' => 'shipping_method'
				) );

					foreach ( $available_methods as $method ) :

						echo beans_open_markup( 'woo_cart_shipping_method_option', 'option', array(
							'value' => esc_attr( $method->id ),
							'selected' => selected( $method->id, $chosen_method )
							#TODO Double check
						) );

							echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) );

						echo beans_close_markup( 'woo_cart_shipping_method_option', 'option' );

					endforeach;

				echo beans_close_markup( 'woo_cart_shipping_method', 'select' );

			else :

				echo beans_open_markup( 'woo_cart_shipping_method_list', 'ul', array( 'id' => 'shipping_method' ) );

					foreach ( $available_methods as $method ) :

						echo beans_open_markup( 'woo_cart_shipping_method_list_item', 'li' );

							echo beans_selfclose_markup( 'woo_cart_shipping_method_radio_input', 'input', array(
								'type' => 'radio',
								'name' => 'shipping_method[' . $index . ']',
								'data-index' => $index,
								'id' => 'shipping_method_' . $index . '_' . sanitize_title( $method->id ),
								'value' => esc_attr( $method->id ),
								'class' => 'shipping_method',
								'checked' => checked( $method->id, $chosen_method )
								#TODO Double check
							) );

							echo beans_open_markup( 'woo_cart_shipping_method_radio_label', 'label', array( 'for' => 'shipping_method_' . $index . '_' . sanitize_title( $method->id ) ) );

							echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) );

							echo beans_close_markup( 'woo_cart_shipping_method_radio_label', 'label' );

						echo beans_close_markup( 'woo_cart_shipping_method_list_item', 'li' );

					endforeach;

				echo beans_close_markup( 'woo_cart_shipping_method_list', 'ul' );

			endif;

		elseif ( ( WC()->countries->get_states( WC()->customer->get_shipping_country() ) && ! WC()->customer->get_shipping_state() ) || ! WC()->customer->get_shipping_postcode() ) :

			if ( is_cart() && get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) :

				echo beans_open_markup( 'woo_cart_shipping_calculator_note', 'p' );

					_e( 'Please use the shipping calculator to see available shipping methods.', 'woocommerce' );

				echo beans_close_markup( 'woo_cart_shipping_calculator_note', 'p' );

			elseif ( is_cart() ) :

				echo beans_open_markup( 'woo_cart_address_note', 'p' );

					_e( 'Please continue to the checkout and enter your full address to see if there are any available shipping methods.', 'woocommerce' );

				echo beans_close_markup( 'woo_cart_address_note', 'p' );

			else :

				echo beans_open_markup( 'woo_cart_shipping_methods_note', 'p' );

					_e( 'Please fill in your details to see available shipping methods.', 'woocommerce' );

				echo beans_close_markup( 'woo_cart_shipping_methods_note', 'p' );

			endif;

		else :

			if ( is_cart() ) :

				echo apply_filters( 'woocommerce_cart_no_shipping_available_html',

					beans_open_markup( 'woo_cart_no_shipping_methods_note', 'p' ) . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . beans_close_markup( 'woo_cart_no_shipping_methods_note', 'p' )

				);

			else :

				echo apply_filters( 'woocommerce_no_shipping_available_html',

					beans_open_markup( 'woo_no_shipping_methods_note', 'p' ) . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . beans_close_markup( 'woo_no_shipping_methods_note', 'p' )

				);

			endif;

		endif;

		if ( $show_package_details ) :

				foreach ( $package['contents'] as $item_id => $values ) :

					if ( $values['data']->needs_shipping() ) :

						$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];

					endif;

				endforeach;

				echo beans_open_markup( 'woo_cart_shipping_contents', 'p', array( 'class' => 'woocommerce-shipping-contents' ) );

					echo beans_open_markup( 'woo_cart_shipping_contents_small', 'small' );

						echo __( 'Shipping', 'woocommerce' ) . ': ' . implode( ', ', $product_names );

					echo beans_close_markup( 'woo_cart_shipping_contents_small', 'small' );

				echo beans_close_markup( 'woo_cart_shipping_contents', 'p' );

		endif;

		if ( is_cart() ) :

			woocommerce_shipping_calculator();

		endif;

	echo beans_close_markup( 'woo_cart_shipping_data', 'td' );

echo beans_close_markup( 'woo_cart_shipping_row', 'tr' );
