<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

echo beans_open_markup( 'woo_single_price_wrap', 'div', array(
    'itemprop' => 'offers',
    'itemscope' => '',
    'itemtype' => 'http://schema.org/Offer'
) );

	echo beans_open_markup( 'woo_single_price_p', 'p', array( 'class' => 'price' ) );

		echo $product->get_price_html();

	echo beans_close_markup( 'woo_single_price_p', 'p' );

    echo beans_selfclose_markup( 'woo_single_price_meta_price', 'meta', array(
        'itemprop' => 'price',
        'content' => esc_attr( $product->get_price() )
     ) );

    echo beans_selfclose_markup( 'woo_single_price_meta_currency', 'meta', array(
        'itemprop' => 'priceCurrency',
        'content' => esc_attr( get_woocommerce_currency() )
    ) );

    echo beans_selfclose_markup( 'woo_single_price_meta_link', 'link', array(
        'itemprop' => 'availability',
        'href' => 'http://schema.org/' . $product->is_in_stock() ? 'InStock' : 'OutOfStock'
    ) );

echo beans_close_markup( 'woo_single_price_wrap', 'div' );
