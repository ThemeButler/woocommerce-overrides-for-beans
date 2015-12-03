<?php
/**
 * Grouped product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $post;

$parent_product_post = $post;

do_action( 'woocommerce_before_add_to_cart_form' );

echo beans_open_markup( 'woo_single_add_to_cart_grouped', 'form', array(
	'class' => 'cart',
	'method' => 'post',
	'enctype' => 'multipart/form-data'
) );

	echo beans_open_markup( 'woo_single_add_to_cart_grouped_table', 'table', array(
		'cellspacing' => 0,
		'class' => 'group_table'
	) );

		echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody', 'tbody' );

			foreach ( $grouped_products as $product_id ) :

					$product = wc_get_product( $product_id );

					if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) && ! $product->is_in_stock() ) :
						continue;
					endif;

					$post = $product->post;

					setup_postdata( $post );

					echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_row', 'tr' );

						echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_purchase', 'td' );

							if ( $product->is_sold_individually() || ! $product->is_purchasable() ) :

								woocommerce_template_loop_add_to_cart();

							else :

								$quantites_required = true;
									woocommerce_quantity_input( array(
										'input_name'  => 'quantity[' . $product_id . ']',
										'input_value' => ( isset( $_POST['quantity'][$product_id] ) ? wc_stock_amount( $_POST['quantity'][$product_id] ) : 0 ),
										'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
										'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
									) );

							endif;

						echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody_purchase', 'td' );

						echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_purchase', 'td', array( 'class', 'label' ) );

							echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_label', 'label', array( 'for', 'product-' . $product_id ) );

								echo $product->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', get_permalink(), $product_id ) ) . '">' . esc_html( get_the_title() ) . '</a>' : esc_html( get_the_title() );

							echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody_purchase', 'label' );

						echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody_label', 'td' );

						do_action ( 'woocommerce_grouped_product_list_before_price', $product );

						echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_price', 'td', array( 'class', 'price' ) );

								echo $product->get_price_html();

								if ( $availability = $product->get_availability() ) :

									$availability_html = empty( $availability['availability'] ) ? '' : beans_open_markup( 'woo_single_add_to_cart_grouped_availability', 'p', array( 'class', 'stock ' . esc_attr( $availability['class'] ) ) ) . esc_html( $availability['availability'] ) . beans_close_markup( 'woo_single_add_to_cart_grouped_availability', 'p' );

									echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );

								endif;

						echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_price', 'td' );

					echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody_row', 'tr' );

				endforeach;

				// Reset to parent grouped product
				$post = $parent_product_post;
				$product = wc_get_product( $parent_product_post->ID );
				setup_postdata( $parent_product_post );

		echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody', 'tbody' );

	echo beans_close_markup( 'woo_single_add_to_cart_grouped_table', 'table' );

	echo beans_selfclose_markup( 'woo_single_add_to_cart_grouped_input_hidden', 'input', array(
		'type' => 'hidden',
		'name' => 'add-to-cart',
		'value' => esc_attr( $product->id )
	) );

	if ( $quantites_required ) :

		do_action( 'woocommerce_before_add_to_cart_button' );

		echo beans_open_markup( 'woo_single_add_to_cart_grouped_tbody_submit_button', 'button', array(
			'type' => 'submit',
			'class' => 'single_add_to_cart_button button alt'
		) );

			echo $product->single_add_to_cart_text();

		echo beans_close_markup( 'woo_single_add_to_cart_grouped_tbody_submit_button', 'button' );

		do_action( 'woocommerce_after_add_to_cart_button' );

	endif;

echo beans_close_markup( 'woo_single_add_to_cart_grouped', 'form' );

do_action( 'woocommerce_after_add_to_cart_form' );
