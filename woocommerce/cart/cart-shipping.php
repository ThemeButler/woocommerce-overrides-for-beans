<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_cart_shipping_row', 'tr', array( 'class' => 'shipping' ) ); ?>

	<?php echo beans_open_markup( 'woo_cart_shipping_heading', 'th' ); ?>

	<?php

		if ( $show_package_details ) :

			printf( __( 'Shipping #%d', 'woocommerce' ), $index + 1 );

		else :

			_e( 'Shipping', 'woocommerce' );
			
		endif;

	?>

	<?php echo beans_close_markup( 'woo_cart_shipping_heading', 'th' ); ?>

	<?php echo beans_open_markup( 'woo_cart_shipping_data', 'td' ); ?>

		<?php if ( ! empty( $available_methods ) ) : ?>

			<?php if ( 1 === count( $available_methods ) ) :

				$method = current( $available_methods );

				echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>

				<?php echo beans_selfclose_markup( 'woo_cart_shipping_method_hidden_input', 'input', array(
					'type' => 'hidden',
					'name' => 'shipping_method[' . $index . ']',
					'data-index' => $index,
					'id' => 'shipping_method_' . $index,
					'value' => esc_attr( $method->id ),
					'class' => 'shipping_method'
				) ); ?>

			<?php elseif ( get_option( 'woocommerce_shipping_method_format' ) === 'select' ) : ?>

				<?php echo beans_open_markup( 'woo_cart_shipping_method', 'select', array(
					'name' => 'shipping_method[' . $index . ']',
					'data-index' => $index,
					'id' => 'shipping_method_' . $index,
					'class' => 'shipping_method'
				) ); ?>

					<?php foreach ( $available_methods as $method ) : ?>

						<?php echo beans_open_markup( 'woo_cart_shipping_method_option', 'option', array(
							'value' => esc_attr( $method->id ),
							'selected' => selected( $method->id, $chosen_method )
							#TODO Double check
						) ); ?>

							<?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>

						<?php echo beans_close_markup( 'woo_cart_shipping_method_option', 'option' ); ?>

					<?php endforeach; ?>

				<?php echo beans_close_markup( 'woo_cart_shipping_method', 'select' ); ?>

			<?php else : ?>

				<?php echo beans_open_markup( 'woo_cart_shipping_method_list', 'ul', array( 'id' => 'shipping_method' ) ); ?>

					<?php foreach ( $available_methods as $method ) : ?>

						<?php echo beans_open_markup( 'woo_cart_shipping_method_list_item', 'li' ); ?>

							<?php echo beans_selfclose_markup( 'woo_cart_shipping_method_radio_input', 'input', array(
								'type' => 'radio',
								'name' => 'shipping_method[' . $index . ']',
								'data-index' => $index,
								'id' => 'shipping_method_' . $index . '_' . sanitize_title( $method->id ),
								'value' => esc_attr( $method->id ),
								'class' => 'shipping_method',
								'checked' => checked( $method->id, $chosen_method )
								#TODO Double check
							) ); ?>

							<?php echo beans_open_markup( 'woo_cart_shipping_method_radio_label', 'label', array( 'for' => 'shipping_method_' . $index . '_' . sanitize_title( $method->id ) ) ); ?>

							<?php echo wp_kses_post( wc_cart_totals_shipping_method_label( $method ) ); ?>

							<?php echo beans_close_markup( 'woo_cart_shipping_method_radio_label', 'label' ); ?>

						<?php echo beans_close_markup( 'woo_cart_shipping_method_list_item', 'li' ); ?>

					<?php endforeach; ?>

				<?php echo beans_close_markup( 'woo_cart_shipping_method_list', 'ul' ); ?>

			<?php endif; ?>

		<?php elseif ( ( WC()->countries->get_states( WC()->customer->get_shipping_country() ) && ! WC()->customer->get_shipping_state() ) || ! WC()->customer->get_shipping_postcode() ) : ?>

			<?php if ( is_cart() && get_option( 'woocommerce_enable_shipping_calc' ) === 'yes' ) : ?>

				<?php echo beans_open_markup( 'woo_cart_shipping_calculator_note', 'p' ); ?>

					<?php _e( 'Please use the shipping calculator to see available shipping methods.', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_cart_shipping_calculator_note', 'p' ); ?>

			<?php elseif ( is_cart() ) : ?>

				<?php echo beans_open_markup( 'woo_cart_address_note', 'p' ); ?>

					<?php _e( 'Please continue to the checkout and enter your full address to see if there are any available shipping methods.', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_cart_address_note', 'p' ); ?>

			<?php else : ?>

				<?php echo beans_open_markup( 'woo_cart_shipping_methods_note', 'p' ); ?>

					<?php _e( 'Please fill in your details to see available shipping methods.', 'woocommerce' ); ?>

				<?php echo beans_close_markup( 'woo_cart_shipping_methods_note', 'p' ); ?>

			<?php endif; ?>

		<?php else : ?>

			<?php if ( is_cart() ) : ?>

				<?php echo apply_filters( 'woocommerce_cart_no_shipping_available_html',

					beans_open_markup( 'woo_cart_no_shipping_methods_note', 'p' ) . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . beans_close_markup( 'woo_cart_no_shipping_methods_note', 'p' )

				); ?>

			<?php else : ?>

				<?php echo apply_filters( 'woocommerce_no_shipping_available_html',

					beans_open_markup( 'woo_no_shipping_methods_note', 'p' ) . __( 'There are no shipping methods available. Please double check your address, or contact us if you need any help.', 'woocommerce' ) . beans_close_markup( 'woo_no_shipping_methods_note', 'p' )

				); ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( $show_package_details ) : ?>

			<?php

				foreach ( $package['contents'] as $item_id => $values ) :

					if ( $values['data']->needs_shipping() ) :

						$product_names[] = $values['data']->get_title() . ' &times;' . $values['quantity'];

					endif;

				endforeach;

			?>
				<?php echo beans_open_markup( 'woo_cart_shipping_contents', 'p', array( 'class' => 'woocommerce-shipping-contents' ) ); ?>

					<?php echo beans_open_markup( 'woo_cart_shipping_contents_small', 'small' ); ?>

						<?php echo __( 'Shipping', 'woocommerce' ) . ': ' . implode( ', ', $product_names ); ?>

					<?php echo beans_close_markup( 'woo_cart_shipping_contents_small', 'small' ); ?>

				<?php echo beans_close_markup( 'woo_cart_shipping_contents', 'p' ); ?>

		<?php endif; ?>

		<?php if ( is_cart() ) : ?>

			<?php woocommerce_shipping_calculator(); ?>

		<?php endif; ?>

	<?php echo beans_close_markup( 'woo_cart_shipping_data', 'td' ); ?>

<?php echo beans_close_markup( 'woo_cart_shipping_row', 'tr' ); ?>
