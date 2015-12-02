<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.3.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

do_action( 'woocommerce_before_cart' );

echo beans_open_markup( 'woo_cart_form', 'form', array(
	'action' => esc_url( WC()->cart->get_cart_url() ),
	'method' => 'post'
) );

do_action( 'woocommerce_before_cart_table' );

echo beans_open_markup( 'woo_cart_table', 'table', array(
	'class' => 'shop_table cart',
	'cellspacing' => 0
) );

	echo beans_open_markup( 'woo_cart_table_heading', 'thead' );

		echo beans_open_markup( 'woo_cart_table_heading_row', 'tr' );

			echo beans_open_markup( 'woo_cart_table_heading_remove', 'th', array( 'class' => 'product-remove' ) );

				echo '&nbsp';

			echo beans_close_markup( 'woo_cart_table_heading_remove', 'th' );

			echo beans_open_markup( 'woo_cart_table_heading_thumbnail', 'th', array( 'class' => 'product-thumbnail' ) );

				echo '&nbsp';

			echo beans_close_markup( 'woo_cart_table_heading_thumbnail', 'th' );

			echo beans_open_markup( 'woo_cart_table_heading_name', 'th', array( 'class' => 'product-name' ) );

				_e( 'Product', 'woocommerce' );

			echo beans_close_markup( 'woo_cart_table_heading_name', 'th' );

			echo beans_open_markup( 'woo_cart_table_heading_price', 'th', array( 'class' => 'product-price' ) );

				_e( 'Price', 'woocommerce' );

			echo beans_close_markup( 'woo_cart_table_heading_price', 'th' );

			echo beans_open_markup( 'woo_cart_table_heading_quantity', 'th', array( 'class' => 'product-quantity' ) );

				_e( 'Quantity', 'woocommerce' );

			echo beans_close_markup( 'woo_cart_table_heading_quantity', 'th' );

			echo beans_open_markup( 'woo_cart_table_heading_subtotal', 'th', array( 'class' => 'product-subtotal' ) );

				_e( 'Total', 'woocommerce' );

			echo beans_close_markup( 'woo_cart_table_heading_subtotal', 'th' );

		echo beans_close_markup( 'woo_cart_table_heading_row', 'tr' );

	echo beans_close_markup( 'woo_cart_form_thead', 'thead' );

	echo beans_open_markup( 'woo_cart_table_body', 'tbody' );

		do_action( 'woocommerce_before_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

				echo beans_open_markup( 'woo_cart_table_filters_row', 'tr', array(
					'class' => esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) )
					) );

					echo beans_open_markup( 'woo_cart_table_cell_remove', 'td', array( 'class' => 'product-remove' ) );

							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
								beans_open_markup( 'woo_cart_item_remove_link', 'a', array(
									'href' => '%s',
									'class' => 'remove',
									'title' => '%s',
									'data-product_id' => '%s',
									'data-product_sku' => '%s'
								) ) . '&times;' . beans_close_markup( 'woo_cart_item_remove_link', 'a' ),
								esc_url( WC()->cart->get_remove_url( $cart_item_key ) ),
								__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $_product->get_sku() )
							), $cart_item_key );

					echo beans_close_markup( 'woo_cart_table_cell_remove', 'td' );

					echo beans_open_markup( 'woo_cart_table_cell_thumbnail', 'td', array( 'class' => 'product-thumbnail' ) );

						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $_product->is_visible() ) :

							echo $thumbnail;

						else :

							printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );

						endif;

					echo beans_close_markup( 'woo_cart_table_cell_thumbnail', 'td' );

					echo beans_open_markup( 'woo_cart_table_cell_name', 'td', array( 'class' => 'product-name' ) );

						if ( ! $_product->is_visible() ) :

							echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';

						else :

							echo apply_filters( 'woocommerce_cart_item_name', sprintf( beans_open_markup( 'woo_cart_item_name_link', 'a', array( 'href' => '%s' ) ) . '%s ' . beans_close_markup( 'woo_cart_item_name_link', 'a' ), esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );

						endif;

						// Meta data
						echo WC()->cart->get_item_data( $cart_item );

						// Backorder notification
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) :

							echo beans_open_markup( 'woo_cart_backorder_notification', 'p', array( 'class' => 'backorder_notification' ) ) . esc_html__( 'Available on backorder', 'woocommerce' ) . beans_close_markup( 'woo_cart_backorder_notification', 'p' );

						endif;

					echo beans_close_markup( 'woo_cart_table_cell_name', 'td' );

					echo beans_open_markup( 'woo_cart_table_cell_price', 'td', array( 'class' => 'product-price' ) );

						echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					echo beans_close_markup( 'woo_cart_table_cell_price', 'td' );

					echo beans_open_markup( 'woo_cart_table_cell_quantity', 'td', array( 'class' => 'product-quantity' ) );

							if ( $_product->is_sold_individually() ) :

								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );

							else :

								$product_quantity = woocommerce_quantity_input( array(

									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );

							endif;

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );

					echo beans_close_markup( 'woo_cart_table_cell_quantity', 'td' );

					echo beans_open_markup( 'woo_cart_table_cell_subtotals', 'td', array( 'class' => 'product-subtotals' ) );

						echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );

					echo beans_close_markup( 'woo_cart_table_cell_subtotals', 'td' );

				echo beans_open_markup( 'woo_cart_table_filters_row', 'tr' );

			endif;

		endforeach;

		do_action( 'woocommerce_cart_contents' );

		echo beans_open_markup( 'woo_cart_contents_row', 'tr' );

		echo beans_open_markup( 'woo_cart_contents_actions', 'td', array(
			'colspan' => 6,
			'class' => 'actions'
		) );

				if ( WC()->cart->coupons_enabled() ) :

					echo beans_open_markup( 'woo_cart_contents_coupon', 'div', array( 'class' => 'coupon' ) );

						echo beans_open_markup( 'woo_cart_contents_coupon_label', 'label', array( 'for' => 'coupon_code' ) );

                            _e( 'Coupon', 'woocommerce' ) . ':';

						echo beans_close_markup( 'woo_cart_contents_coupon_label', 'label' );

						echo beans_selfclose_markup( 'woo_cart_contents_coupon_input', 'input', array(
							'type' => 'text',
							'name' => 'coupon_code',
							'class' => 'input-text',
							'id' => 'coupon_code',
							'value' => '',
							'placeholder' => __( 'Coupon code', 'woocommerce' )
						) );

						echo beans_selfclose_markup( 'woo_cart_contents_coupon_button', 'input', array(
							'type' => 'submit',
							'class' => 'button',
							'name' => 'apply_coupon',
							'value' => __( 'Apply Coupon', 'woocommerce' )
						) );

						do_action( 'woocommerce_cart_coupon' );

					echo beans_close_markup( 'woo_cart_contents_coupon', 'div' );

				endif;

				echo beans_selfclose_markup( 'woo_cart_contents_button', 'input', array(
					'type' => 'submit',
					'class' => 'button',
					'name' => 'update_cart',
					'value' => __( 'Update Cart', 'woocommerce' )
				) );

				do_action( 'woocommerce_cart_actions' );

				wp_nonce_field( 'woocommerce-cart' );

			echo beans_close_markup( 'woo_cart_contents_actions', 'td' );

		echo beans_close_markup( 'woo_cart_contents_row', 'tr' );

		do_action( 'woocommerce_after_cart_contents' );

	echo beans_open_markup( 'woo_cart_table_body', 'tbody' );

echo beans_close_markup( 'woo_cart_table', 'table' );

do_action( 'woocommerce_after_cart_table' );

echo beans_close_markup( 'woo_cart_form', 'form' );

echo beans_open_markup( 'woo_cart_contents_collaterals', 'div', array( 'class' => 'cart-collaterals' ) );

	do_action( 'woocommerce_cart_collaterals' );

echo beans_close_markup( 'woo_cart_contents_collaterals', 'div' );

do_action( 'woocommerce_after_cart' );
