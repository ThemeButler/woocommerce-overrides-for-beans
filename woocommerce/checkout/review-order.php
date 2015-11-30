<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_checkout_review_order_table', 'table', array( 'class' => 'shop_table woocommerce-checkout-review-order-table' ) );

	echo beans_open_markup( 'woo_checkout_review_order_thead', 'thead' );

		echo beans_open_markup( 'woo_checkout_review_order_thead_row', 'tr' );

			echo beans_open_markup( 'woo_checkout_review_order_thead_name', 'th', array( 'class' => 'product-name' ) );

				_e( 'Product', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_review_order_thead_name', 'th' );

			echo beans_open_markup( 'woo_checkout_review_order_thead_total', 'th', array( 'class' => 'product-total' ) );

				_e( 'Total', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_review_order_thead_total', 'th' );

		echo beans_close_markup( 'woo_checkout_review_order_thead_row', 'tr' );

	echo beans_close_markup( 'woo_checkout_review_order_thead', 'thead' );

	echo beans_open_markup( 'woo_checkout_review_order_tbody', 'tbody' );

	do_action( 'woocommerce_review_order_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

				echo beans_open_markup( 'woo_checkout_review_order_tbody_row', 'tr', array( 'class', esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) ) );

					echo beans_open_markup( 'woo_checkout_review_order_tbody_name', 'td', array( 'class' => 'product-name' ) );

						echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';

						echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' ' . beans_open_markup( 'woo_checkout_cart_item_quantity', 'strong', array( 'class' => 'product-quantity' ) ) . sprintf( '&times; %s', $cart_item['quantity'] ) . beans_close_markup( 'woo_checkout_cart_item_quantity', 'strong' ), $cart_item, $cart_item_key );

						echo WC()->cart->get_item_data( $cart_item );

					echo beans_close_markup( 'woo_checkout_review_order_tbody_name', 'td' );

					echo beans_open_markup( 'woo_checkout_review_order_tbody_total', 'td', array( 'class' => 'product-total' ) );

						echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

					echo beans_close_markup( 'woo_checkout_review_order_tbody_total', 'td' );

				echo beans_close_markup( 'woo_checkout_review_order_tbody_row', 'tr' );

				do_action( 'woocommerce_review_order_after_cart_contents' );

			echo beans_close_markup( 'woo_checkout_review_order_tbody', 'tbody' );

		endif;

	endforeach;

	echo beans_open_markup( 'woo_checkout_review_order_tfoot', 'tfoot' );

		echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal', 'tr', array( 'class' => 'cart-subtotal' ) );

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal_heading', 'th' );

				_e( 'Subtotal', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal_heading', 'th' );

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal_value', 'td' );

				wc_cart_totals_subtotal_html();

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal_value', 'td' );

		echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal', 'tr' );

		foreach ( WC()->cart->get_coupons() as $code => $coupon ) :

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon', 'tr', array( 'class' => 'cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) ) );

				echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon_label', 'th' );

					wc_cart_totals_coupon_label( $coupon );

				echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon_label', 'th' );

				echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon_value', 'td' );

					wc_cart_totals_coupon_html( $coupon );

				echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon_value', 'td' );

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon', 'tr' );

		endforeach;

		if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :

			do_action( 'woocommerce_review_order_before_shipping' );

			wc_cart_totals_shipping_html();

			do_action( 'woocommerce_review_order_after_shipping' );

		endif;

		foreach ( WC()->cart->get_fees() as $fee ) :

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee', 'tr', array( 'class' => 'fee' ) );

				echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee_label', 'th' );

					echo esc_html( $fee->name );

				echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee_label', 'th' );

				echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee_value', 'td' );

					wc_cart_totals_fee_html( $fee );

				echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee_value', 'td' );

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee', 'tr' );

		endforeach;

		if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) :

			if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) :

				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) :


					echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate', 'tr', array( 'class' => 'tax-rate tax-rate-' . sanitize_title( $code ) ) );

						echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate_label', 'th' );

							echo esc_html( $tax->label );

						echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate_label', 'th' );

						echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate_value', 'td' );

							echo wp_kses_post( $tax->formatted_amount );

						echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate_value', 'td' );

					echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate', 'tr' );

				endforeach;

			else :

				echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total', 'tr', array( 'class' => 'tax-total' ) );

					echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total_label', 'th' );

						echo esc_html( WC()->countries->tax_or_vat() );

					echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total_label', 'th' );

					echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total_value', 'td' );

						wc_cart_totals_taxes_total_html();

					echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total_value', 'td' );

				echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total', 'tr' );

			endif;

		endif;

		do_action( 'woocommerce_review_order_before_order_total' );

		echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total', 'tr', array( 'class' => 'order-total' ) );

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total_label', 'th' );

				_e( 'Total', 'woocommerce' );

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total_label', 'th' );

			echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total_value', 'td' );

				wc_cart_totals_order_total_html();

			echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total_value', 'td' );

		echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total', 'tr' );

		do_action( 'woocommerce_review_order_after_order_total' );

	echo beans_close_markup( 'woo_checkout_review_order_tfoot', 'tfoot' );

echo beans_close_markup( 'woo_checkout_review_order_table', 'table' );
