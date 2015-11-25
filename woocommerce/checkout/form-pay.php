<?php
/**
 * Pay for order form
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates
 * @version  2.4.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php echo beans_open_markup( 'woo_checkout_pay_form', 'form', array( 'id' => 'order_review', 'method' => 'post' ) ); ?>

	<?php echo beans_open_markup( 'woo_checkout_pay_table', 'table', array( 'class' => 'shop_table' ) ); ?>

		<?php echo beans_open_markup( 'woo_checkout_pay_thead', 'thead' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_pay_thead_row', 'tr' ); ?>

				<?php echo beans_open_markup( 'woo_checkout_pay_thead_name', 'th', array( 'class' => 'product-name' ) ); ?>

					<?php _e( 'Product', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_checkout_pay_thead_name' ) ); ?>

				<?php echo beans_open_markup( 'woo_checkout_pay_thead_quantity', 'th', array( 'class' => 'product-quantity' ) ); ?>

					<?php _e( 'Qty', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_checkout_pay_thead_quantity' ) ); ?>

				<?php echo beans_open_markup( 'woo_checkout_pay_thead_total', 'th', array( 'class' => 'product-total' ) ); ?>

					<?php _e( 'Totals', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_checkout_pay_thead_total' ) ); ?>

			<?php echo beans_close_markup( 'woo_checkout_pay_thead_row', 'tr' ); ?>

		<?php echo beans_close_markup( 'woo_checkout_pay_thead', 'thead' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_pay_tbody', 'tbody' ); ?>

			<?php if ( sizeof( $order->get_items() ) > 0 ) : ?>

				<?php foreach ( $order->get_items() as $item ) : ?>

					<?php echo beans_open_markup( 'woo_checkout_pay_tbody_row', 'tr' ); ?>

						<?php echo beans_open_markup( 'woo_checkout_pay_tbody_name', 'td', array( 'class' => 'product-name' ) ); ?>

							<?php echo $item['name']; ?>

						<?php echo beans_close_markup( 'woo_checkout_pay_tbody_name', 'td' ); ?>

						<?php echo beans_open_markup( 'woo_checkout_pay_tbody_quantity', 'td', array( 'class' => 'product-quantity' ) ); ?>

							<?php echo $item['qty']; ?>

						<?php echo beans_close_markup( 'woo_checkout_pay_tbody_quantity', 'td' ); ?>

						<?php echo beans_open_markup( 'woo_checkout_pay_tbody_subtotal', 'td', array( 'class' => 'product-subtotal' ) ); ?>

							<?php echo $order->get_formatted_line_subtotal( $item ); ?>

						<?php echo beans_close_markup( 'woo_checkout_pay_tbody_subtotal', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_checkout_pay_tbody_row', 'tr' ); ?>

				<?php endforeach; ?>

			<?php endif; ?>

		<?php echo beans_close_markup( 'woo_checkout_pay_tbody', 'tbody' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_pay_tfoot', 'tfoot' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_pay_tfoot_row', 'tr' ); ?>

			<?php if ( $totals = $order->get_order_item_totals() ) foreach ( $totals as $total ) : ?>

				<?php echo beans_open_markup( 'woo_checkout_pay_total_label', 'th', array( 'scope' => 'row', 'colspan' => 2 ) ); ?>

					<?php echo $total['label']; ?>

				<?php echo beans_close_markup( 'woo_checkout_pay_total_label', 'th' ); ?>

				<?php echo beans_open_markup( 'woo_checkout_pay_total_value', 'td', array( 'class' => 'product-total' ) ); ?>

					<?php echo $total['value']; ?>

				<?php echo beans_close_markup( 'woo_checkout_pay_total_value', 'td' ) ); ?>

			<?php endforeach; ?>

			<?php echo beans_close_markup( 'woo_checkout_pay_tfoot_row', 'tr' ); ?>

		<?php echo beans_close_markup( 'woo_checkout_pay_tfoot', 'tfoot' ); ?>

	<?php echo beans_close_markup( 'woo_checkout_pay_table', 'table' ); ?>

	<?php echo beans_open_markup( 'woo_checkout_payment', 'div', array( 'id' => 'payment' ) ); ?>

		<?php if ( $order->needs_payment() ) : ?>

		<?php echo beans_open_markup( 'woo_checkout_payment_methods', 'ul', array( 'class' => 'payment_methods methods' ) ); ?>

			<?php if ( $available_gateways = WC()->payment_gateways->get_available_payment_gateways() ) :

					<?php
					// Chosen Method
					if ( sizeof( $available_gateways ) ) : ?>

						<?php current( $available_gateways )->set_current(); ?>

					<?php endif; ?>

					<?php foreach ( $available_gateways as $gateway ) : ?>

						<?php echo beans_open_markup( 'woo_checkout_payment_methods_gateway', 'li', array( 'class' => 'payment_method_' . $gateway->id ) ); ?>

							<?php echo beans_selfclose_markup( 'woo_checkout_payment_methods_gateway_input', 'input', array(
								'id' => 'payment_method_' . $gateway->id,
								'type' => 'radio',
								'class' => 'input-radio',
								'name' => 'payment_method',
								'value' => esc_attr( $gateway->id ),
								'checked' => checked( $gateway->chosen, true ),
								#TODO Double check
								'data-order_button_text' => esc_attr( $gateway->order_button_text )
								) ); ?>

							<?php echo beans_open_markup( 'woo_checkout_payment_methods_gateway_label', 'label', array( 'for' => 'payment_method_' . $gateway->id ) ); ?>

								<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>

							<?php echo beans_close_markup( 'woo_checkout_payment_methods_gateway_label', 'label' ); ?>

							<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>

								<?php echo beans_open_markup( 'woo_checkout_payment_method_fields', 'div', array( 'class' => 'payment_box payment_method_' . $gateway->id ) ); ?>

									<?php $gateway->payment_fields(); ?>

								<?php echo beans_close_markup( 'woo_checkout_payment_method_fields', 'div' ) ); ?>

							<?php endif; ?>

						<?php echo beans_close_markup( 'woo_checkout_payment_methods_gateway', 'li' ) ); ?>

					<?php endforeach; ?>

				<?php else : ?>

					<?php echo beans_open_markup( 'woo_checkout_no_payment_method_notice', 'p' ) . __( 'Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) . beans_close_markup( 'woo_checkout_no_payment_method_notice', 'p' );

				<?php endif; ?>

		<?php echo beans_close_markup( 'woo_checkout_payment_methods', 'ul' ) ); ?>

		<?php endif; ?>

		<?php echo beans_open_markup( 'woo_checkout_place_order', 'div', array( 'class' => 'form-row' ) ); ?>

			<?php wp_nonce_field( 'woocommerce-pay' ); ?>

			<?php $pay_order_button_text = apply_filters( 'woocommerce_pay_order_button_text', __( 'Pay for order', 'woocommerce' ) ); ?>

				<?php echo apply_filters( 'woocommerce_pay_order_button_html', beans_selfclose_markup( 'woo_pay_order_button_html', 'input', array(
					'type' => 'submit',
					'class' => 'button alt',
					'id' => 'place_order',
					'value' => esc_attr( $pay_order_button_text ),
					'data-value' => esc_attr( $pay_order_button_text )
					) ) ); ?>

			<input type="hidden" name="woocommerce_pay" value="1" />

		<?php echo beans_close_markup( 'woo_checkout_place_order', 'div' ) ); ?>

	<?php echo beans_close_markup( 'woo_checkout_payment', 'div' ) ); ?>

<?php echo beans_close_markup( 'woo_checkout_pay_form', 'form', array(
	'id' => 'order_review',
	'method' => 'post'
) ); ?>
