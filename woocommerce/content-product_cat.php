<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) :

	$woocommerce_loop['loop'] = 0;

endif;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) :

	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

endif;

// Increase loop count
$woocommerce_loop['loop'] ++;

echo beans_open_markup( 'woo_product_category_list_item', 'li', array( 'class' => implode(' ', wc_product_cat_class( $classes ) ) ) );

	do_action( 'woocommerce_before_subcategory', $category );

	echo beans_open_markup( 'woo_product_category_link', 'a', array( 'href' => get_term_link( $category->slug, 'product_cat' ) ) );

			/**
			 * woocommerce_before_subcategory_title hook
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );

		echo beans_open_markup( 'woo_product_category_title', 'h3' );

				echo $category->name;

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', beans_open_markup( 'woo_subcategory_count_html', 'mark', array( 'class' => 'count' ) ) . ' (' . $category->count . ')' . beans_close_markup( 'woo_subcategory_count_html', 'mark' ), $category );

		echo beans_close_markup( 'woo_product_category_title', 'h3' );

			/**
			 * woocommerce_after_subcategory_title hook
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );

	echo beans_close_markup( 'woo_product_category_link', 'a' );

	do_action( 'woocommerce_after_subcategory', $category );

echo beans_close_markup( 'woo_product_category_list_item', 'li' );
