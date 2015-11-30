<?php
/**
 * The template for product search form.
 *
 * Override this template by copying it to yourtheme/woocommerce/product-searchform.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_product_search_form', 'form', array(
	'role' => 'search',
	'method' => 'get',
	'class' => 'woocommerce-product-search',
	'action' => esc_url( home_url( '/' ) )
) );

	echo beans_open_markup( 'woo_product_search_label', 'label', array(
		'class' => 'screen-reader-text',
		'for' => 's'
	) );

		_e( 'Search for:', 'woocommerce' );

	echo beans_close_markup( 'woo_product_search_label', 'label' );

	echo beans_selfclose_markup( 'woo_product_search_input', 'input', array(
		'class' => 'search-field',
		'placeholder' => esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ),
		'value' => get_search_query(),
		'name' => 's', 'title' => esc_attr_x( 'Search for:', 'label', 'woocommerce' )
	) );

	 echo beans_selfclose_markup( 'woo_product_search_button', 'input', array(
		 'type' => 'submit',
		 'value' => esc_attr_x( 'Search', 'submit button', 'woocommerce' )
	) );

	 echo beans_selfclose_markup( 'woo_product_search_hidden_input', 'input', array(
		 'type' => 'hidden',
		 'name' => 'post_type',
		 'value' => 'product'
	 ) );

echo beans_close_markup( 'woo_product_search_form', 'form' );
