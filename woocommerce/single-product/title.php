<?php
/**
 * Single Product title
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_single_title', 'h1', array(
	'itemprop' => 'name',
	'class' => 'product_title entry-title'
) );

	the_title();

echo beans_close_markup( 'woo_single_title', 'h1' );
