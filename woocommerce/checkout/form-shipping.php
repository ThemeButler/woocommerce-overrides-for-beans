<?php
/**
 * Checkout shipping information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_checkout_shipping_fields', 'div', array( 'class' => 'woocommerce-shipping-fields' ) ); ?>

	<?php if ( WC()->cart->needs_shipping_address() === true ) : ?>

		<?php if ( empty( $_POST ) ) : ?>

			<?php $ship_to_different_address = get_option( 'woocommerce_ship_to_destination' ) === 'shipping' ? 1 : 0; ?>

			<?php $ship_to_different_address = apply_filters( 'woocommerce_ship_to_different_address_checked', $ship_to_different_address ); ?>

		<?php else : ?>

			<?php $ship_to_different_address = $checkout->get_value( 'ship_to_different_address' ); ?>

		<?php endif; ?>

		<?php echo beans_open_markup( 'woo_checkout_shipping_fields_title', 'h3', array( 'id' => 'ship-to-different-address' ) ); ?>

			<?php echo beans_open_markup( 'woo_checkout_shipping_different_address_label', 'label', array(
				'for' => 'ship-to-different-address-checkbox',
				'class' => 'checkbox'
			) ); ?>

				<?php _e( 'Ship to a different address?', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_shipping_different_address_label', 'label' ); ?>

			<?php echo beans_selfclose_markup( 'woo_checkout_shipping_different_address_input', 'input', array(
				'id' => 'ship-to-different-address-checkbox',
				'class' => 'input-checkbox',
				'checked' => checked( $ship_to_different_address, 1 ),
				#TODO Double check
				'type' => 'checkbox',
				'name' => 'ship_to_different_address',
				'value' => 1
			) ); ?>

		<?php echo beans_close_markup( 'woo_checkout_shipping_fields_title', 'h3' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_shipping_address_wrap', 'div', array( 'class' => 'shipping_address' ) ); ?>

			<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<?php foreach ( $checkout->checkout_fields['shipping'] as $key => $field ) : ?>

				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

			<?php endforeach; ?>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		<?php echo beans_close_markup( 'woo_checkout_shipping_address_wrap', 'div' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', get_option( 'woocommerce_enable_order_comments', 'yes' ) === 'yes' ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || WC()->cart->ship_to_billing_address_only() ) : ?>

			<?php echo beans_open_markup( 'woo_checkout_additional_info_title', 'h3' ); ?>

				<?php _e( 'Additional Information', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_additional_info_title', 'h3' ); ?>

		<?php endif; ?>

		<?php foreach ( $checkout->checkout_fields['order'] as $key => $field ) : ?>

			<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

		<?php endforeach; ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>

<?php echo beans_close_markup( 'woo_checkout_shipping_fields', 'div' ); ?>
