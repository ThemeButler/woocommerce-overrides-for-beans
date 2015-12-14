<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) :

	echo beans_open_markup( 'woo_single_related_wrap', 'div', array( 'class' => 'related products' ) );

		echo beans_open_markup( 'woo_single_related_title', 'h2' );

			_e( 'Related Products', 'woocommerce' );

		echo beans_close_markup( 'woo_single_related_title', 'h2' );

		woocommerce_product_loop_start();

			while ( $products->have_posts() ) : $products->the_post();

				wc_get_template_part( 'content', 'product' );

			endwhile; // end of the loop.

		woocommerce_product_loop_end();

	echo beans_close_markup( 'woo_single_related_wrap', 'div'

endif;

wp_reset_postdata();
