<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) :

	return;

endif;

echo beans_open_markup( 'woo_error_list', 'ul', array( 'class' => 'woocommerce-error' ) );

	foreach ( $messages as $message ) :

		echo beans_open_markup( 'woo_error_list_item', 'li' );

			echo wp_kses_post( $message );

		echo beans_close_markup( 'woo_error_list_item', 'li' );

	endforeach;

echo beans_open_markup( 'woo_error_list', 'ul', array( 'class' => 'woocommerce-error' ) );
