<?php
/**
 * Single product short description
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;

if ( ! $post->post_excerpt ) :

	return;

endif;

echo beans_open_markup( 'woo_single_short_description', 'div', array( 'itemprop' => 'description' ) );

	echo beans_open_markup( 'woo_single_short_description_text', 'p' );

		echo apply_filters( 'woo_single_short_description', $post->post_excerpt );

	echo beans_close_markup( 'woo_single_short_description_text', 'p' );

echo beans_close_markup( 'woo_single_short_description', 'div' );
