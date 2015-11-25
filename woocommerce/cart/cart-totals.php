<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_cart_empty_notice', 'div', array(
    'class' => 'cart_totals' . WC()->customer->has_calculated_shipping() ? 'calculated_shipping' : ''
    #TODO: Double check
) ); ?>

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<?php echo beans_open_markup( 'woo_cart_totals_page_title', 'h2' ); ?>

		<?php _e( 'Cart Totals', 'woocommerce' ); ?>

	<?php echo beans_close_markup( 'woo_cart_totals_page_title', 'h2' ); ?>

	<?php echo beans_open_markup( 'woo_cart_totals_table', 'table', array( 'cellspacing' => 0 ) ); ?>

		<?php echo beans_open_markup( 'woo_cart_totals_table_row', 'tr', array( 'class' => 'cart-subtotal' ) ); ?>

		    <?php echo beans_open_markup( 'woo_cart_totals_table_heading', 'th' ); ?>

                <?php _e( 'Subtotal', 'woocommerce' ); ?>

            <?php echo beans_close_markup( 'woo_cart_totals_table_heading', 'th' ); ?>

            <?php echo beans_open_markup( 'woo_cart_totals_table_data', 'td' ); ?>

                <?php wc_cart_totals_subtotal_html(); ?>

            <?php echo beans_close_markup( 'woo_cart_totals_table_data', 'td' ); ?>

		<?php echo beans_close_markup( 'woo_cart_totals_table_row', 'tr' ); ?>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>

			<?php echo beans_open_markup( 'woo_cart_totals_table_coupon_row', 'tr', array( 'class' => 'cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) ) ); ?>

				<?php echo beans_open_markup( 'woo_cart_totals_table_coupon_heading', 'th' ); ?>

					<?php wc_cart_totals_coupon_label( $coupon ); ?>

				<?php echo beans_close_markup( 'woo_cart_totals_table_coupon_heading', 'th' ); ?>

				<?php echo beans_open_markup( 'woo_cart_totals_table_coupon_data', 'td' ); ?>

					<?php wc_cart_totals_coupon_html( $coupon ); ?>

				<?php echo beans_close_markup( 'woo_cart_totals_table_coupon_data', 'td' ); ?>

			<?php echo beans_close_markup( 'woo_cart_totals_table_coupon_row', 'tr' ); ?>

		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			         <?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() ) : ?>

			<?php echo beans_open_markup( 'woo_cart_totals_table_shipping_row', 'tr', array( 'class' => 'shipping' ) ); ?>

                <?php echo beans_open_markup( 'woo_cart_totals_table_shipping_heading', 'th' ); ?>

				    <?php _e( 'Shipping', 'woocommerce' ); ?>

			    <?php echo beans_close_markup( 'woo_cart_totals_table_shipping_heading', 'th' ); ?>

                <?php echo beans_open_markup( 'woo_cart_totals_table_shipping_data', 'td' ); ?>

                    <?php woocommerce_shipping_calculator(); ?>

                <?php echo beans_close_markup( 'woo_cart_totals_table_shipping_data', 'td' ); ?>

			<?php echo beans_close_markup( 'woo_cart_totals_table_shipping_row', 'tr' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>

			<?php echo beans_open_markup( 'woo_cart_totals_table_fee_row', 'tr', array( 'class' => 'fee' ) ); ?>

    			<?php echo beans_open_markup( 'woo_cart_totals_table_fee_heading', 'th' ); ?>

    				<?php echo esc_html( $fee->name ); ?>

    			<?php echo beans_close_markup( 'woo_cart_totals_table_fee_heading', 'th' ); ?>

    			<?php echo beans_open_markup( 'woo_cart_totals_table_fee_data', 'td' ); ?>

    				<?php wc_cart_totals_fee_html( $fee ); ?>

    			<?php echo beans_close_markup( 'woo_cart_totals_table_fee_data', 'td' ); ?>

			<?php echo beans_close_markup( 'woo_cart_totals_table_fee_row', 'tr' ); ?>

		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart == 'excl' ) : ?>

			<?php if ( get_option( 'woocommerce_tax_total_display' ) == 'itemized' ) : ?>

				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>

					<?php echo beans_open_markup( 'woo_cart_totals_table_tax_row', 'tr', array( 'class' => 'tax-rate tax-rate-' . sanitize_title( $code ) ) ); ?>

					<?php echo beans_open_markup( 'woo_cart_totals_table_tax_heading', 'th' ); ?>

						<?php echo esc_html( $tax->label ); ?>

					<?php echo beans_close_markup( 'woo_cart_totals_table_tax_heading', 'th' ); ?>

					<?php echo beans_open_markup( 'woo_cart_totals_table_tax_data', 'td' ); ?>

						<?php echo wp_kses_post( $tax->formatted_amount ); ?>

					<?php echo beans_close_markup( 'woo_cart_totals_table_tax_data', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_cart_totals_table_tax_row', 'tr' ); ?>

				<?php endforeach; ?>

			<?php else : ?>

				<?php echo beans_open_markup( 'woo_cart_totals_table_tax_totals_row', 'tr', array( 'class' => 'tax-total' ) ); ?>

				<?php echo beans_open_markup( 'woo_cart_totals_table_tax_totals_heading', 'th' ); ?>

					<?php echo esc_html( WC()->countries->tax_or_vat() ); ?>

				<?php echo beans_close_markup( 'woo_cart_totals_table_tax_totals_heading', 'th' ); ?>

				<?php echo beans_open_markup( 'woo_cart_totals_table_tax_totals_data', 'td' ); ?>

					<?php wc_cart_totals_taxes_total_html(); ?>

				<?php echo beans_close_markup( 'woo_cart_totals_table_tax_totals_data', 'td' ); ?>

				<?php echo beans_close_markup( 'woo_cart_totals_table_tax_totals_row', 'tr' ); ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<?php echo beans_open_markup( 'woo_cart_totals_table_order_total_row', 'tr', array( 'class' => 'order-total' ) ); ?>

    		<?php echo beans_open_markup( 'woo_cart_totals_table_order_total_heading', 'th' ); ?>

    			<?php _e( 'Total', 'woocommerce' ); ?>

    		<?php echo beans_close_markup( 'woo_cart_totals_table_order_total_heading', 'th' ); ?>

    		<?php echo beans_open_markup( 'woo_cart_totals_table_order_total_data', 'td' ); ?>

    			<?php wc_cart_totals_order_total_html(); ?>

    		<?php echo beans_close_markup( 'woo_cart_totals_table_order_total_data', 'td' ); ?>

		<?php echo beans_close_markup( 'woo_cart_totals_table_order_total_row', 'tr' ); ?>

		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	<?php echo beans_close_markup( 'woo_cart_totals_table', 'table' ); ?>

	<?php if ( WC()->cart->get_cart_tax() ) : ?>

		<?php echo beans_open_markup( 'woo_cart_shipping_notice', 'p', array( 'class' => 'wc-cart-shipping-notice' ) ); ?>

    		<?php echo beans_open_markup( 'woo_cart_shipping_notice_small', 'small' ); ?>

        		<?php

        			$estimated_text = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
        				? sprintf( ' ' . __( ' (taxes estimated for %s)', 'woocommerce' ), WC()->countries->estimated_for_prefix() . __( WC()->countries->countries[ WC()->countries->get_base_country() ], 'woocommerce' ) )
        				: '';

        			printf( __( 'Note: Shipping and taxes are estimated%s and will be updated during checkout based on your billing and shipping information.', 'woocommerce' ), $estimated_text );

        		?>

    		<?php echo beans_close_markup( 'woo_cart_shipping_notice_small', 'small' ); ?>

		<?php echo beans_close_markup( 'woo_cart_shipping_notice', 'p' ); ?>

	<?php endif; ?>

	<?php echo beans_open_markup( 'woo_cart_proceed_to_checkout', 'div' ); ?>

		<?php do_action( 'woocommerce_proceed_to_checkout' ); ?>

	<?php echo beans_close_markup( 'woo_cart_proceed_to_checkout', 'div' ); ?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

<?php echo beans_close_markup( 'woo_cart_empty_notice', 'div' ); ?>
