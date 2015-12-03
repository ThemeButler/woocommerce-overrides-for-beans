<?php
/**
 * Checkout Payment Section
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! is_ajax() ) :

	do_action( 'woocommerce_review_order_before_payment' );

endif;

echo beans_open_markup( 'woo_checkout_payment_method_wrap', 'div', array(
	'id' => 'payment',
	'class' => 'woocommerce-checkout-payment'
) );

	if ( WC()->cart->needs_payment() ) :

	echo beans_open_markup( 'woo_checkout_payment_method_wrap_list', 'ul', array( 'class' => 'payment_methods methods' ) );

		if ( ! empty( $available_gateways ) ) :

			foreach ( $available_gateways as $gateway ) :

				wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );

			endforeach;

		else :

				if ( ! WC()->customer->get_country() ) :

					$no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'woocommerce' );

				else :

					$no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' );

				endif;

				echo beans_open_markup( 'woo_checkout_no_available_payment_methods_message', 'li' );

					echo apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message );

				echo beans_close_markup( 'woo_checkout_no_available_payment_methods_message', 'li' );

			endif;

			echo beans_close_markup( 'woo_checkout_payment_method_wrap_list', 'ul' );

	endif;

	echo beans_open_markup( 'woo_checkout_place_order_wrap', 'div', array( 'class' => 'form-row place-order' ) );

		echo '<noscript>';
			_e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' );
		 	echo '<br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="' . __( 'Update totals', 'woocommerce' ) . '" /></noscript>';

		wp_nonce_field( 'woocommerce-process_checkout' );

		do_action( 'woocommerce_review_order_before_submit' );

		echo apply_filters(
			'woocommerce_order_button_html',
			beans_selfclose_markup( 'woo_order_button_html', 'input', array(
				'type' => 'submit',
				'class' => 'button alt',
				'name' => 'woocommerce_checkout_place_order',
				'id' => 'place_order',
				'value' => esc_attr( $order_button_text ),
				'data-value' => esc_attr( $order_button_text )
			 ) )
		);

		if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) :

			echo beans_open_markup( 'woo_checkout_order_terms', 'p', array( 'class' => 'form-row terms' ) );

				echo beans_open_markup( 'woo_checkout_order_terms_label', 'label', array(
					'for' => 'terms',
					'class' => 'checkbox'
				) );

				printf( __( 'I&rsquo;ve read and accept the ' . beans_open_markup( 'woo_checkout_terms_link', 'a', array( 'href' => '%s', 'target' => '_blank' ) ) . 'terms &amp; conditions', 'woocommerce' )  . beans_close_markup( 'woo_checkout_terms_link', 'a' ), esc_url( wc_get_page_permalink( 'terms' ) ) );

				echo beans_close_markup( 'woo_checkout_order_terms_label', 'label' );

				echo beans_selfclose_markup( 'woo_checkout_order_terms_input', 'input', array(
					'type' => 'checkbox',
					'class' => 'input-checkbox',
					'name' => 'terms',
					'checked' => checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ),
					#Review
					'id' => 'terms'
				) );

			echo beans_close_markup( 'woo_checkout_order_terms', 'p' );

		endif;

		do_action( 'woocommerce_review_order_after_submit' );

	echo beans_close_markup( 'woo_checkout_place_order_wrap', 'div' );

echo beans_close_markup( 'woo_checkout_payment_method_wrap', 'div' );

if ( ! is_ajax() ) :

	do_action( 'woocommerce_review_order_after_payment' );

endif;
