<?php
/**
 * Cart errors page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php wc_print_notices(); ?>

<?php echo beans_open_markup( 'woo_checkout_cart_error', 'p' ); ?>

	<?php _e( 'There are some issues with the items in your cart (shown above). Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ) ?>

<?php echo beans_close_markup( 'woo_checkout_cart_error', 'p' ); ?>

<?php do_action( 'woocommerce_cart_has_errors' ); ?>

<?php echo beans_open_markup( 'woo_checkout_back_to_cart', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_checkout_back_to_cart_link', 'a', array(
		'class' => 'button wc-backward',
		'href' => echo esc_url( wc_get_page_permalink( 'cart' ) )
	) ); ?>

		<?php _e( 'Return To Cart', 'woocommerce' ) ?>

	<?php echo beans_close_markup( 'woo_checkout_back_to_cart_link', 'a' ); ?>

<?php echo beans_close_markup( 'woo_checkout_back_to_cart', 'p' ); ?>
