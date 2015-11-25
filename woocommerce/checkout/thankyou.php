<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<?php echo beans_open_markup( 'woo_order_declined_message', 'p' ); ?>

			<?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_order_declined_message', 'p' ); ?>

		<?php echo beans_open_markup( 'woo_order_try_again_message', 'p' ); ?>

			<?php

				if ( is_user_logged_in() ) :

					_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );

				else :

					_e( 'Please attempt your purchase again.', 'woocommerce' );

				endif;

			?>

		<?php echo beans_close_markup( 'woo_order_try_again_message', 'p' ); ?>

		<?php echo beans_open_markup( 'woo_order_payment_link_container', 'p' ); ?>

			<?php echo beans_open_markup( 'woo_order_payment_link', 'a', array(
				'href' => esc_url( $order->get_checkout_payment_url() ),
				'class' => 'button pay'
			) ); ?>

				<?php _e( 'Pay', 'woocommerce' ) ?>

			<?php echo beans_close_markup( 'woo_order_payment_link', 'a' ); ?>

			<?php if ( is_user_logged_in() ) : ?>

				<?php echo beans_open_markup( 'woo_order_account_link', 'a', array(
					'href' => esc_url( wc_get_page_permalink( 'myaccount' ) ),
					'class' => 'button pay'
				) ); ?>

					<?php _e( 'My Account', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_order_account_link', 'a' ); ?>

			<?php endif; ?>

		<?php echo beans_close_markup( 'woo_order_payment_link_container', 'p' ); ?>

	<?php else : ?>

		<?php echo beans_open_markup( 'woo_order_success_message', 'p' ); ?>

			<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?>

		<?php echo beans_close_markup( 'woo_order_success_message', 'p' ); ?>

		<?php echo beans_open_markup( 'woo_order_details_list', 'ul', array( 'class' => 'order_details' ) ); ?>

			<?php echo beans_open_markup( 'woo_order_details_order_number', 'li', array( 'class' => 'order' ) ); ?>

				<?php _e( 'Order Number:', 'woocommerce' ); ?>

				<?php echo beans_open_markup( 'woo_order_details_order_number_value', 'strong' ); ?>

				<?php echo $order->get_order_number(); ?>

				<?php echo beans_close_markup( 'woo_order_details_order_number', 'strong' ); ?>

			<?php echo beans_close_markup( 'woo_order_details_order_number', 'li' ); ?>

			<?php echo beans_open_markup( 'woo_order_details_order_date', 'li', array( 'class' => 'date' ) ); ?>

				<?php _e( 'Date:', 'woocommerce' ); ?>

				<?php echo beans_open_markup( 'woo_order_details_order_date_value', 'strong' ); ?>

					<?php date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?>

				<?php echo beans_close_markup( 'woo_order_details_order_date_value', 'strong' ); ?>

			<?php echo beans_close_markup( 'woo_order_details_order_date', 'li' ); ?>

			<?php echo beans_open_markup( 'woo_order_details_order_total', 'li', array( 'class' => 'total' ) ); ?>

				<?php _e( 'Total:', 'woocommerce' ); ?>

				<?php echo beans_open_markup( 'woo_order_details_order_total_value', 'strong' ); ?>

					<?php echo $order->get_formatted_order_total(); ?>

				<?php echo beans_close_markup( 'woo_order_details_order_total_value', 'strong' ); ?>

			<?php echo beans_close_markup( 'woo_order_details_order_total', 'li' ); ?>

			<?php if ( $order->payment_method_title ) : ?>

				<?php echo beans_open_markup( 'woo_order_details_payment_method', 'li', array( 'class' => 'method' ) ); ?>

					<?php _e( 'Payment Method:', 'woocommerce' ); ?>

					<?php echo beans_open_markup( 'woo_order_details_payment_method_value', 'strong' ); ?>

						<?php echo $order->payment_method_title; ?>

					<?php echo beans_close_markup( 'woo_order_details_payment_method_value', 'strong' ); ?>

				<?php echo beans_close_markup( 'woo_order_details_payment_method', 'li' ); ?>

			<?php endif; ?>

		<?php echo beans_close_markup( 'woo_order_details_list', 'ul' ); ?>

		<?php echo beans_open_markup( 'woo_order_details_clear', 'div', array( 'class' => 'clear' ) ); ?>

		<?php echo beans_close_markup( 'woo_order_details_clear', 'div' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>

	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

<?php endif; ?>
