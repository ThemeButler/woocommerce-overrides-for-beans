<?php
/**
 * Single Product Meta
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

$cat_count = sizeof( get_the_terms( $post->ID, 'product_cat' ) );

$tag_count = sizeof( get_the_terms( $post->ID, 'product_tag' ) );

echo beans_open_markup( 'woo_single_meta_wrap', 'div', array( 'class' => 'product_meta' ) );

	do_action( 'woocommerce_product_meta_start' );

	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) :

		echo beans_open_markup( 'woo_single_meta_sku_wrap', 'span', array( 'class' => 'sku_wrapper' ) );

			_e( 'SKU: ', 'woocommerce' );

			echo beans_open_markup( 'woo_single_meta_sku', 'span', array(
				'class' => 'sku',
				'itemprop' => 'sku'
			) );

				echo ( $sku = $product->get_sku() ) ? $sku : __( 'N/A', 'woocommerce' ) . ' ';

			echo beans_close_markup( 'woo_single_meta_sku', 'span' );

		echo beans_close_markup( 'woo_single_meta_sku_wrap', 'span' );

	endif;

	echo $product->get_categories( ', ', beans_open_markup( 'woo_single_meta_category', 'span', array( 'class' => 'posted_in' ) ) . _n( 'Category:', 'Categories:', $cat_count, 'woocommerce' ) . ' ', beans_close_markup( 'woo_single_meta_category', 'span' ) );
	echo ' ';
	echo $product->get_tags( ', ', beans_open_markup( 'woo_single_meta_tags', 'span', array( 'class' => 'tagged_as' ) ) . _n( 'Tag:', 'Tags:', $tag_count, 'woocommerce' ) . ' ', beans_close_markup( 'woo_single_meta_tags', 'span' ) );

	do_action( 'woocommerce_product_meta_end' );

echo beans_close_markup( 'woo_single_meta_wrap', 'div' );
