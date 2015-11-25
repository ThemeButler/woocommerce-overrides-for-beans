<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) :

	return;

endif;

$info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'woocommerce' ) . '</a>' );

wc_print_notice( $info_message, 'notice' );

?>

<?php echo beans_open_markup( 'woo_checkout_coupon', 'form', array(
	'class' => 'checkout_coupon',
	'method' => 'post',
	'style' => 'display:none;'
) ); ?>

	<?php echo beans_open_markup( 'woo_checkout_coupon_code', 'p', array( 'class' => 'form-row form-row-first' ) ); ?>

		<?php echo beans_selfclose_markup( 'woo_checkout_coupon_code_input', 'input', array(
			'type' => 'text',
			'name' => 'coupon_code',
			'class' => 'input-text',
			'placeholder' => esc_attr_e( 'Coupon code', 'woocommerce' ),
			'id' => 'coupon_code',
			'value' => ''
		) ); ?>

	<?php echo beans_close_markup( 'woo_checkout_coupon_code', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_checkout_coupon_apply', 'p', array( 'class' => 'form-row form-row-last' ) ); ?>

		<?php echo beans_selfclose_markup( 'woo_checkout_coupon_apply_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'apply_coupon',
			'value' => esc_attr_e( 'Apply Coupon', 'woocommerce' )
		) ); ?>

	<?php echo beans_close_markup( 'woo_checkout_coupon_apply', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_checkout_coupon_clear', 'div', array( 'class' => 'clear' ) ); ?>

	<?php echo beans_close_markup( 'woo_checkout_coupon_clear', 'div' ); ?>

<?php echo beans_close_markup( 'woo_checkout_coupon', 'form' ); ?>
