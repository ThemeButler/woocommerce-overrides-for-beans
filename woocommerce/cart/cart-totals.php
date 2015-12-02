<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_cart_totals_wrap', 'div', array(
    'class' => 'cart_totals ' . ( WC()->customer->has_calculated_shipping() ? ' calculated_shipping' : '' )
) );

	do_action( 'woocommerce_before_cart_totals' );

	echo beans_open_markup( 'woo_cart_totals_page_title', 'h2' );

		_e( 'Cart Totals', 'woocommerce' );

	echo beans_close_markup( 'woo_cart_totals_page_title', 'h2' );

	echo beans_open_markup( 'woo_cart_totals_table', 'table', array( 'cellspacing' => 0 ) );

		echo beans_open_markup( 'woo_cart_totals_table_row', 'tr', array( 'class' => 'cart-subtotal' ) );

		    echo beans_open_markup( 'woo_cart_totals_table_heading', 'th' );

                _e( 'Subtotal', 'woocommerce' );

            echo beans_close_markup( 'woo_cart_totals_table_heading', 'th' );

            echo beans_open_markup( 'woo_cart_totals_table_data', 'td' );

                wc_cart_totals_subtotal_html();

            echo beans_close_markup( 'woo_cart_totals_table_data', 'td' );

		echo beans_close_markup( 'woo_cart_totals_table_row', 'tr' );

		foreach ( WC()->cart->get_coupons() as $code => $coupon ) :

			echo beans_open_markup( 'woo_cart_totals_table_coupon_row', 'tr', array( 'class' => 'cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) ) );

				echo beans_open_markup( 'woo_cart_totals_table_coupon_heading', 'th' );

					wc_cart_totals_coupon_label( $coupon );

				echo beans_close_markup( 'woo_cart_totals_table_coupon_heading', 'th' );

				echo beans_open_markup( 'woo_cart_totals_table_coupon_data', 'td' );

					wc_cart_totals_coupon_html( $coupon );

				echo beans_close_markup( 'woo_cart_totals_table_coupon_data', 'td' );

			echo beans_close_markup( 'woo_cart_totals_table_coupon_row', 'tr' );

		endforeach;

		if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) :

			do_action( 'woocommerce_cart_totals_before_shipping' );

			         wc_cart_totals_shipping_html();

			do_action( 'woocommerce_cart_totals_after_shipping' );

		elseif ( WC()->cart->needs_shipping() ) :

			echo beans_open_markup( 'woo_cart_totals_table_shipping_row', 'tr', array( 'class' => 'shipping' ) );

                echo beans_open_markup( 'woo_cart_totals_table_shipping_heading', 'th' );

				    _e( 'Shipping', 'woocommerce' );

			    echo beans_close_markup( 'woo_cart_totals_table_shipping_heading', 'th' );

                echo beans_open_markup( 'woo_cart_totals_table_shipping_data', 'td' );

                    woocommerce_shipping_calculator();

                echo beans_close_markup( 'woo_cart_totals_table_shipping_data', 'td' );

			echo beans_close_markup( 'woo_cart_totals_table_shipping_row', 'tr' );

		endif;

		foreach ( WC()->cart->get_fees() as $fee ) :

			echo beans_open_markup( 'woo_cart_totals_table_fee_row', 'tr', array( 'class' => 'fee' ) );

    			echo beans_open_markup( 'woo_cart_totals_table_fee_heading', 'th' );

    				echo esc_html( $fee->name );

    			echo beans_close_markup( 'woo_cart_totals_table_fee_heading', 'th' );

    			echo beans_open_markup( 'woo_cart_totals_table_fee_data', 'td' );

    				wc_cart_totals_fee_html( $fee );

    			echo beans_close_markup( 'woo_cart_totals_table_fee_data', 'td' );

			echo beans_close_markup( 'woo_cart_totals_table_fee_row', 'tr' );

		endforeach;

		if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'excl' ) :

			if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) :

				foreach ( WC()->cart->get_tax_totals() as $code => $tax ) :

					echo beans_open_markup( 'woo_cart_totals_table_tax_row', 'tr', array( 'class' => 'tax-rate tax-rate-' . sanitize_title( $code ) ) );

					echo beans_open_markup( 'woo_cart_totals_table_tax_heading', 'th' );

						echo esc_html( $tax->label );

					echo beans_close_markup( 'woo_cart_totals_table_tax_heading', 'th' );

					echo beans_open_markup( 'woo_cart_totals_table_tax_data', 'td' );

						echo wp_kses_post( $tax->formatted_amount );

					echo beans_close_markup( 'woo_cart_totals_table_tax_data', 'td' );

					echo beans_close_markup( 'woo_cart_totals_table_tax_row', 'tr' );

				endforeach;

			else :

				echo beans_open_markup( 'woo_cart_totals_table_tax_totals_row', 'tr', array( 'class' => 'tax-total' ) );

				echo beans_open_markup( 'woo_cart_totals_table_tax_totals_heading', 'th' );

					echo esc_html( WC()->countries->tax_or_vat() );

				echo beans_close_markup( 'woo_cart_totals_table_tax_totals_heading', 'th' );

				echo beans_open_markup( 'woo_cart_totals_table_tax_totals_data', 'td' );

					wc_cart_totals_taxes_total_html();

				echo beans_close_markup( 'woo_cart_totals_table_tax_totals_data', 'td' );

				echo beans_close_markup( 'woo_cart_totals_table_tax_totals_row', 'tr' );

			endif;

		endif;

		do_action( 'woocommerce_cart_totals_before_order_total' );

		echo beans_open_markup( 'woo_cart_totals_table_order_total_row', 'tr', array( 'class' => 'order-total' ) );

    		echo beans_open_markup( 'woo_cart_totals_table_order_total_heading', 'th' );

    			_e( 'Total', 'woocommerce' );

    		echo beans_close_markup( 'woo_cart_totals_table_order_total_heading', 'th' );

    		echo beans_open_markup( 'woo_cart_totals_table_order_total_data', 'td' );

    			wc_cart_totals_order_total_html();

    		echo beans_close_markup( 'woo_cart_totals_table_order_total_data', 'td' );

		echo beans_close_markup( 'woo_cart_totals_table_order_total_row', 'tr' );

		do_action( 'woocommerce_cart_totals_after_order_total' );

	echo beans_close_markup( 'woo_cart_totals_table', 'table' );

	if ( WC()->cart->get_cart_tax() ) :

		echo beans_open_markup( 'woo_cart_shipping_notice', 'p', array( 'class' => 'wc-cart-shipping-notice' ) );

    		echo beans_open_markup( 'woo_cart_shipping_notice_small', 'small' );

        			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
        				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
        				: '';

        			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

    		echo beans_close_markup( 'woo_cart_shipping_notice_small', 'small' );

		echo beans_close_markup( 'woo_cart_shipping_notice', 'p' );

	endif;

	echo beans_open_markup( 'woo_cart_proceed_to_checkout', 'div', array( 'class' => 'wc-proceed-to-checkout' ) );

		do_action( 'woocommerce_proceed_to_checkout' );

	echo beans_close_markup( 'woo_cart_proceed_to_checkout', 'div' );

	do_action( 'woocommerce_after_cart_totals' );

echo beans_close_markup( 'woo_cart_totals_wrap', 'div' );
