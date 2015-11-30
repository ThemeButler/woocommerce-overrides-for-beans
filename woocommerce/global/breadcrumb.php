<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! empty( $breadcrumb ) ) :

	echo $wrap_before;

	foreach ( $breadcrumb as $key => $crumb ) :

		echo $before;

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) :

			echo beans_open_markup( 'woo_breadcrumbs_link', 'a', array(	'href' => esc_url( $crumb[1] ) ) );

				echo esc_html( $crumb[0] );

			echo beans_close_markup( 'woo_breadcrumbs_link', 'a' );

		else :

			echo esc_html( $crumb[0] );

		endif;

		echo $after;

		if ( sizeof( $breadcrumb ) !== $key + 1 ) :

			echo $delimiter;

		endif;

	endforeach;

	echo $wrap_after;

endif;
