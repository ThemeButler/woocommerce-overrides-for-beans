<?php
/**
 * The template for displaying product content in the products widget.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-widget-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo beans_open_markup( 'woo_product_widget_list_item', 'li' );

	echo beans_open_markup( 'woo_product_widget_list_item_link', 'a', array(
		'href' => esc_url( get_permalink( $product->id ) ),
		'title' => esc_attr( $product->get_title() )
	) );

		echo $product->get_image();

		echo beans_open_markup( 'woo_product_widget_list_item_title', 'span', array( 'class' => 'product-title' ) );

			echo $product->get_title();

		echo beans_close_markup( 'woo_product_widget_list_item_title', 'span' );

	echo beans_close_markup( 'woo_product_widget_list_item_link', 'a' );

	if ( ! empty( $show_rating ) ) echo $product->get_rating_html();

	echo $product->get_price_html();

echo beans_close_markup( 'woo_product_widget_list_item', 'li' );
