<?php
/**
 * Proceed to checkout button
 *
 * Contains the markup for the proceed to checkout button on the cart
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_cart_checkout_link', 'a', array(
    'href' => esc_url( WC()->cart->get_checkout_url() ),
    'class' => 'checkout-button button alt wc-forward'
) );

    _e( 'Proceed to Checkout', 'woocommerce' );

echo beans_close_markup( 'woo_cart_checkout_link', 'a' );
