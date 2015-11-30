<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

 if ( ! $messages ) :

 	return;

 endif;

foreach ( $messages as $message ) :

	echo beans_open_markup( 'woo_message_wrap', 'div', array( 'class' => 'woocommerce-message' ) );

		echo wp_kses_post( $message );

	echo beans_close_markup( 'woo_message_wrap', 'div' );

endforeach;
