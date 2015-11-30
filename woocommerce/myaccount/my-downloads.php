<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $downloads = WC()->customer->get_downloadable_products() ) :

	do_action( 'woocommerce_before_available_downloads' );

	echo beans_open_markup( 'woo_my_downloads_title', 'h2' );

		echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available Downloads', 'woocommerce' ) );

	echo beans_close_markup( 'woo_my_downloads_title', 'h2' );

	echo beans_open_markup( 'woo_my_downloads_list', 'ul', array( 'class' => 'digital-downloads' ) );

		foreach ( $downloads as $download ) :

			echo beans_open_markup( 'woo_my_downloads_list_item', 'li' );

				do_action( 'woocommerce_available_download_start', $download );

				if ( is_numeric( $download['downloads_remaining'] ) )
					echo apply_filters( 'woocommerce_available_download_count', beans_open_markup( 'woo_my_downloads_list_count', 'span', array( 'class' => 'count' ) ) . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . beans_close_markup( 'woo_my_downloads_list_count', 'span' ) . ' ', $download );

				echo apply_filters( 'woocommerce_available_download_link', beans_open_markup( 'woo_my_downloads_list_link', 'a', array( 'href' => esc_url( $download['download_url'] ) ) ) . $download['download_name'] . beans_close_markup( 'woo_my_downloads_list_link', 'a' ), $download );

				do_action( 'woocommerce_available_download_end', $download );

			echo beans_close_markup( 'woo_my_downloads_list_item', 'li' );

		endforeach;

	echo beans_close_markup( 'woo_my_downloads_list', 'ul' );

	do_action( 'woocommerce_after_available_downloads' );

endif;
