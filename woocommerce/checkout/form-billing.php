<?php
/**
 * Checkout billing information form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/** @global WC_Checkout $checkout */

?>


<?php echo beans_open_markup( 'woo_billing_fields', 'div', array( 'class' => 'woocommerce-billing-fields' ) ); ?>

	<?php if ( WC()->cart->ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<?php echo beans_open_markup( 'woo_billing_title', 'h3' ); ?>

			<?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_billing_title', 'h3' ); ?>

	<?php else : ?>

		<?php echo beans_open_markup( 'woo_billing_title', 'h3' ); ?>

			<?php _e( 'Billing Details', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_billing_title', 'h3' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->checkout_fields['billing'] as $key => $field ) : ?>

		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

	<?php endforeach; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->enable_signup ) : ?>

		<?php if ( $checkout->enable_guest_checkout ) : ?>

			<?php echo beans_open_markup( 'woo_billing_register_input_wrap', 'p', array( 'class' => 'form-row form-row-wide create-account' ) ); ?>

				<?php echo beans_selfclose_markup( 'woo_billing_register_input', 'input', array(
					'class' => 'input-checkbox',
					'id' => 'createaccount',
					'checked' => true === $checkout->get_value( 'createaccount' ) || true === apply_filters( 'woocommerce_create_account_default_checked', false ) ? 'checked' : null,
					'type' => 'checkbox',
					'name' => 'createaccount',
					'value' => 1 )
				); ?>

				<?php echo beans_open_markup( 'woo_billing_register_label', 'label', array(
					'for' => 'createaccount',
					'class' => 'checkbox'
				) ); ?>

					<?php _e( 'Create an account?', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_billing_register_label', 'label' ); ?>

			<?php echo beans_close_markup( 'woo_billing_register_input_wrap', 'p' ); ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( ! empty( $checkout->checkout_fields['account'] ) ) : ?>

			<?php echo beans_open_markup( 'woo_billing_register', 'div', array( 'class' => 'create-account' ) ); ?>

				<?php echo beans_open_markup( 'woo_billing_register_note', 'p' ); ?>

					<?php _e( 'Create an account by entering the information below. If you are a returning customer please login at the top of the page.', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_billing_register_note', 'p' ); ?>

				<?php foreach ( $checkout->checkout_fields['account'] as $key => $field ) : ?>

					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>

				<?php endforeach; ?>

				<?php echo beans_open_markup( 'woo_billing_register_clear', 'div', array( 'class' => 'clear' ) ); ?>

				<?php echo beans_close_markup( 'woo_billing_register_clear', 'div' ); ?>

			<?php echo beans_close_markup( 'woo_billing_register', 'div' ); ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>

	<?php endif; ?>

<?php echo beans_close_markup( 'woo_billing_fields', 'div' ); ?>
