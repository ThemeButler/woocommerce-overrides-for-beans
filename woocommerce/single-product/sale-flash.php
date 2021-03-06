<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;

if ( $product->is_on_sale() ) :

	echo apply_filters( 'woocommerce_sale_flash', beans_open_markup( 'woo_sale_flash_badge', 'span', array('class' => 'onsale' ) ) . __( 'Sale!', 'woocommerce' ) . beans_close_markup( 'woo_sale_flash_badge', 'span' ), $post, $product );

endif;
