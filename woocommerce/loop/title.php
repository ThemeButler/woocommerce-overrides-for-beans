<?php
/**
 * Product loop title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_product_item_title', 'h3' );

	the_title();

echo beans_close_markup( 'woo_product_item_title', 'h3' );
