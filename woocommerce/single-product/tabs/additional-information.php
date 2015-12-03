<?php
/**
 * Additional Information tab
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );

if ( $heading ) :

	echo beans_open_markup( 'woo_product_single_tabs_info_title', 'h2' );

		echo $heading;

	echo beans_close_markup( 'woo_product_single_tabs_info_title', 'h2' );

endif;

$product->list_attributes();
