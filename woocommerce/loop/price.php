<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

 if ( $price_html = $product->get_price_html() ) :

	echo beans_open_markup( 'woo_product_item_price', 'span', array( 'class' => 'price' ) );

		$price_html;

	echo beans_close_markup( 'woo_product_item_price', 'span' );

endif;
