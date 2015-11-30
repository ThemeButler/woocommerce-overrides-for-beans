<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

do_action( 'woocommerce_before_mini_cart' );

echo beans_open_markup( 'woo_cart_mini_list', 'ul', array( 'class' => 'cart_list product_list_widget ' . $args['list_class'] ) );

	if ( ! WC()->cart->is_empty() ) :

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );

					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					echo beans_open_markup( 'woo_cart_mini_list_item', 'li', array( 'class' => esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ) ) );

						echo apply_filters( 'woocommerce_cart_item_remove_link',

						sprintf( beans_open_markup( 'woo_cart_mini_list_item_remove_link', 'a', array(
							'href' => '%s',
							'class' => 'remove',
							'title' => '%s',
							'data-product_id' => '%s',
							'data-product_sku' => '%s'
						) ) . '&times;' . beans_close_markup( 'woo_cart_mini_list_item_remove_link', 'a' ), esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ), esc_attr( $_product->get_sku() ) ), $cart_item_key );

						if ( ! $_product->is_visible() ) :

							echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;';

						else :

							echo beans_open_markup( 'woo_cart_item_link', 'a', array( 'href' => esc_url( $_product->get_permalink( $cart_item ) ) ) );

								echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;';

							echo beans_close_markup( 'woo_cart_item_link', 'a' );

						endif;

						echo WC()->cart->get_item_data( $cart_item );

						echo apply_filters( 'woocommerce_widget_cart_item_quantity',

						beans_open_markup( 'woo_cart_mini_list_item_quantity', 'span', array( 'class' => 'quantity' ) ) . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . beans_close_markup( 'woo_cart_mini_list_item_quantity', 'span' ) , $cart_item, $cart_item_key );

					echo beans_close_markup( 'woo_cart_mini_list_item', 'li' );

				endif;

			endforeach;

	else :

		echo beans_open_markup( 'woo_cart_mini_list_item_empty', 'li', array( 'class' => 'empty' );

			_e( 'No products in the cart.', 'woocommerce' );

		echo beans_close_markup( 'woo_cart_mini_list_item_empty', 'li' );

	endif;

echo beans_close_markup( 'woo_cart_mini_list', 'ul' );

if ( ! WC()->cart->is_empty() ) :

	echo beans_open_markup( 'woo_cart_total', 'p', array( 'class' => 'total' ) );

		echo beans_open_markup( 'woo_cart_total_strong', 'strong' );

			_e( 'Subtotal', 'woocommerce' );:

		echo beans_close_markup( 'woo_cart_total_strong', 'strong' );

		echo WC()->cart->get_cart_subtotal();

	echo beans_close_markup( 'woo_cart_total', 'p' );

	do_action( 'woocommerce_widget_shopping_cart_before_buttons' );

	echo beans_open_markup( 'woo_cart_buttons', 'p', array( 'class' => 'buttons' ) );

		echo beans_open_markup( 'woo_cart_buttons_view_cart', 'a', array(
			'href' => WC()->cart->get_cart_url(),
			'class' => 'button wc-forward'
		) );

			_e( 'View Cart', 'woocommerce' );

		echo beans_close_markup( 'woo_cart_buttons_view_cart', 'a' );

		echo beans_open_markup( 'woo_cart_buttons_checkout', 'a', array(
			'href' => WC()->cart->get_checkout_url(),
			'class' => 'button checkout wc-forward'
			) );

			_e( 'Checkout', 'woocommerce' );

		echo beans_close_markup( 'woo_cart_buttons_checkout', 'a' );

	echo beans_close_markup( 'woo_cart_buttons', 'p' );

endif;

do_action( 'woocommerce_after_mini_cart' );
