<?php
/**
 * Empty cart page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

?>

<?php echo beans_open_markup( 'woo_cart_empty_notice', 'p', array( 'class' => 'cart-empty' ) ); ?>

    <?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?>

<?php echo beans_close_markup( 'woo_product_item_link', 'p' ); ?>

<?php do_action( 'woocommerce_cart_is_empty' ); ?>

<?php echo beans_open_markup( 'woo_cart_back_to_shop', 'p', array( 'class' => 'return-to-shop' ) ); ?>

    <?php echo beans_open_markup( 'woo_cart_back_to_shop_link', 'a', array(
        'href' => esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ),
        'class' => 'button wc-backward'
    ) ); ?>

        <?php _e( 'Return To Shop', 'woocommerce' ) ?>

    <?php echo beans_open_markup( 'woo_cart_back_to_shop_link', 'a' ); ?>

<?php echo beans_close_markup( 'woo_cart_back_to_shop', 'p' ); ?>
