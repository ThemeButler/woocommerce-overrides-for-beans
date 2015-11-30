<?php
/**
 * Displayed when no products are found matching the current query.
 *
 * Override this template by copying it to yourtheme/woocommerce/loop/no-products-found.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_no_products', 'p', array( 'class' => 'woocommerce-info' ) );

	_e( 'No products were found matching your selection.', 'woocommerce' );

echo beans_close_markup( 'woo_no_products', 'p' );
