<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) :

	return;

endif;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->id ),
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) :

	echo beans_open_markup( 'woo_single_upsells_wrap', 'div', array( 'class' => 'upsells products' ) );

		echo beans_open_markup( 'woo_single_upsells_title', 'h2' );

			_e( 'You may also like&hellip;', 'woocommerce' );

		echo beans_close_markup( 'woo_single_upsells_title', 'h2' );

		woocommerce_product_loop_start();

			while ( $products->have_posts() ) : $products->the_post();

				wc_get_template_part( 'content', 'product' );

			endwhile; // end of the loop.

		woocommerce_product_loop_end();

	echo beans_close_markup( 'woo_single_upsells_wrap', 'div' );

endif;

wp_reset_postdata();
