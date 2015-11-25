<?php
/**
 * Checkout Payment Section
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php if ( ! is_ajax() ) : ?>

	<?php do_action( 'woocommerce_review_order_before_payment' ); ?>

<?php endif; ?>

<?php echo beans_open_markup( 'woo_checkout_payment_method_wrap', 'div', array(
	'id' => 'payment',
	'class' => 'woocommerce-checkout-payment'
) ); ?>

	<?php if ( WC()->cart->needs_payment() ) : ?>

	<?php echo beans_open_markup( 'woo_checkout_payment_method_wrap_list', 'ul', array( 'class' => 'payment_methods methods' ) ); ?>

		<?php if ( ! empty( $available_gateways ) ) : ?>

			<?php foreach ( $available_gateways as $gateway ) : ?>

				<?php wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) ); ?>

			<?php endforeach; ?>

		<?php else : ?>

				<?php if ( ! WC()->customer->get_country() ) : ?>

					<?php $no_gateways_message = __( 'Please fill in your details above to see available payment methods.', 'woocommerce' ); ?>

				<?php else : ?>

					<?php $no_gateways_message = __( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ); ?>

				<?php endif; ?>

				<?php echo beans_open_markup( 'woo_checkout_no_available_payment_methods_message', 'li' ); ?>

					<?php echo apply_filters( 'woocommerce_no_available_payment_methods_message', $no_gateways_message ); ?>

				<?php echo beans_close_markup( 'woo_checkout_no_available_payment_methods_message', 'li' ); ?>

			<?php endif; ?>

			<?php echo beans_close_markup( 'woo_checkout_payment_method_wrap_list', 'ul' ); ?>

	<?php endif; ?>

	<?php echo beans_open_markup( 'woo_checkout_place_order_wrap', 'div', array( 'class' => 'form-row place-order' ) ); ?>

		<noscript><?php _e( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'woocommerce' ); ?><br/><input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'woocommerce' ); ?>" /></noscript>

		<?php wp_nonce_field( 'woocommerce-process_checkout' ); ?>

		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

		<?php echo apply_filters( 'woocommerce_order_button_html', beans_selfclose_markup( 'woo_order_button_html', 'input', array( 'type' => 'submit', 'class' => 'button alt', 'name' => 'woocommerce_checkout_place_order', 'id' => 'place_order', 'value' => esc_attr( $order_button_text ), 'data-value' => esc_attr( $order_button_text ) ) ) ); ?>

		<?php if ( wc_get_page_id( 'terms' ) > 0 && apply_filters( 'woocommerce_checkout_show_terms', true ) ) : ?>

			<?php echo beans_open_markup( 'woo_checkout_order_terms', 'p', array( 'class' => 'form-row terms' ) ); ?>

				<?php echo beans_open_markup( 'woo_checkout_order_terms_label', 'label', array(
					'for' => 'terms',
					'class' => 'checkbox'
				) ); ?>

				<?php printf( __( 'I&rsquo;ve read and accept the ' . beans_open_markup( 'woo_checkout_terms_link', 'a', array( 'href' => '%s', 'target' => '_blank' ) ) . 'terms &amp; conditions', 'woocommerce' )  . beans_close_markup( 'woo_checkout_terms_link', 'a' ), esc_url( wc_get_page_permalink( 'terms' ) ) ); ?>

				<?php echo beans_close_markup( 'woo_checkout_order_terms_label', 'label' ); ?>

				<?php echo beans_selfclose_markup( 'woo_checkout_order_terms_input', 'input', array(
					'type' => 'checkbox',
					'class' => 'input-checkbox',
					'name' => 'terms',
					'checked' => checked( apply_filters( 'woocommerce_terms_is_checked_default', isset( $_POST['terms'] ) ), true ),
					#TODO Double check
					'id' => 'terms'
				) ); ?>

			<?php echo beans_close_markup( 'woo_checkout_order_terms', 'p' ); ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

	<?php echo beans_close_markup( 'woo_checkout_place_order_wrap', 'div' ); ?>

<?php echo beans_close_markup( 'woo_checkout_payment_method_wrap', 'div' ); ?>

<?php if ( ! is_ajax() ) : ?>

	<?php do_action( 'woocommerce_review_order_after_payment' ); ?>

<?php endif; ?>
