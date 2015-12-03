<?php
/**
 * Description tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Product Description', 'woocommerce' ) ) );

if ( $heading ) :

	echo beans_open_markup( 'woo_product_single_tabs_description_title', 'h2' );

		echo $heading;

	echo beans_close_markup( 'woo_product_single_tabs_description_title', 'h2' );

endif;

the_content();
