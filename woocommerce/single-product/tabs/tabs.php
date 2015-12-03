<?php
/**
 * Single Product tabs
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */

$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) :

	echo beans_open_markup( 'woo_product_single_tabs_wrap', 'div', array( 'class' => 'woocommerce-tabs wc-tabs-wrapper' ) );

		echo beans_open_markup( 'woo_product_single_tabs_wrap_list', 'ul', array( 'class' => 'tabs wc-tabs' ) );

			foreach ( $tabs as $key => $tab ) :

				echo beans_open_markup( 'woo_product_single_tabs_wrap_list_item', 'li', array( 'class' => esc_attr( $key ) . '_tab' ) );

					echo beans_open_markup( 'woo_product_single_tabs_wrap_list_item_link', 'a', array( 'href' => '#tab-' . esc_attr( $key ) ) );

						echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key );

					echo beans_close_markup( 'woo_product_single_tabs_wrap_list_item_link', 'a' );

				echo beans_close_markup( 'woo_product_single_tabs_wrap_list_item', 'li' );

			endforeach;

		echo beans_close_markup( 'woo_product_single_tabs_wrap_list', 'ul' );

		foreach ( $tabs as $key => $tab ) :

			echo beans_open_markup( 'woo_product_single_tabs_wrap_tab', 'div', array( 'class' => 'panel entry-content wc-tab', 'id' => 'tab-' . esc_attr( $key ) ) );

				call_user_func( $tab['callback'], $key, $tab );

			echo beans_close_markup( 'woo_product_single_tabs_wrap_tab', 'div' );

		endforeach;

	echo beans_close_markup( 'woo_product_single_tabs_wrap', 'div' );

endif;
