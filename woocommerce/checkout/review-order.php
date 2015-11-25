<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_checkout_review_order_table', 'table', array( 'class' => 'shop_table woocommerce-checkout-review-order-table' ) ); ?>

	<?php echo beans_open_markup( 'woo_checkout_review_order_thead', 'thead' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_review_order_thead_row', 'tr' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_thead_name', 'th', array( 'class' => 'product-name' ) ); ?>

				<?php _e( 'Product', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_thead_name', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_thead_total', 'th', array( 'class' => 'product-total' ) ); ?>

				<?php _e( 'Total', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_thead_total', 'th' ); ?>

		<?php echo beans_close_markup( 'woo_checkout_review_order_thead_row', 'tr' ); ?>

	<?php echo beans_close_markup( 'woo_checkout_review_order_thead', 'thead' ); ?>

	<?php echo beans_open_markup( 'woo_checkout_review_order_tbody', 'tbody' ); ?>

	<?php do_action( 'woocommerce_review_order_before_cart_contents' ); ?>

		<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) : ?>

			<?php $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key ); ?>

			<?php if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) : ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tbody_row', 'tr', array( 'class', esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) ) ); ?>

					<?php echo beans_open_markup( 'woo_checkout_review_order_tbody_name', 'td', array( 'class' => 'product-name' ) ); ?>

						<?php echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;'; ?>

						<?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', ' ' . beans_open_markup( 'woo_checkout_cart_item_quantity', 'strong', array( 'class' => 'product-quantity' ) ) . sprintf( '&times; %s', $cart_item['quantity'] ) . beans_close_markup( 'woo_checkout_cart_item_quantity', 'strong' ), $cart_item, $cart_item_key ); ?>

						<?php echo WC()->cart->get_item_data( $cart_item ); ?>

					<?php echo beans_close_markup( 'woo_checkout_review_order_tbody_name', 'td' ); ?>

					<?php echo beans_open_markup( 'woo_checkout_review_order_tbody_total', 'td', array( 'class' => 'product-total' ) ); ?>

						<?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>

					<?php echo beans_close_markup( 'woo_checkout_review_order_tbody_total', 'td' ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tbody_row', 'tr' ); ?>

				<?php do_action( 'woocommerce_review_order_after_cart_contents' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tbody', 'tbody' ); ?>

		<?php endif; ?>

	<?php endforeach; ?>

	<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot', 'tfoot' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal', 'tr', array( 'class' => 'cart-subtotal' ) ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal_heading', 'th' ); ?>

				<?php _e( 'Subtotal', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal_heading', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_subtotal_value', 'td' ); ?>

				<?php wc_cart_totals_subtotal_html(); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal_value', 'td' ); ?>

		<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_subtotal', 'tr' ); ?>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon', 'tr', array( 'class' => 'cart-discount coupon-' . esc_attr( sanitize_title( $code ) ) ) ); ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon_label', 'th' ); ?>

					<?php wc_cart_totals_coupon_label( $coupon ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon_label', 'th' ); ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_coupon_value', 'td' ); ?>

					<?php wc_cart_totals_coupon_html( $coupon ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon_value', 'td' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_coupon', 'tr' ); ?>

		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_review_order_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_review_order_after_shipping' ); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee', 'tr', array( 'class' => 'fee' ) ); ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee_label', 'th' ); ?>

					<?php echo esc_html( $fee->name ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee_label', 'th' ); ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_fee_value', 'td' ); ?>

					<?php wc_cart_totals_fee_html( $fee ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee_value', 'td' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_fee', 'tr' ); ?>

		<?php endforeach; ?>

		<?php if ( wc_tax_enabled() && WC()->cart->tax_display_cart === 'excl' ) : ?>

			<?php if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ) : ?>

				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>


					<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate', 'tr', array( 'class' => 'tax-rate tax-rate-' . sanitize_title( $code ) ) ); ?>

						<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate_label', 'th' ); ?>

							<?php echo esc_html( $tax->label ); ?>

						<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate_label', 'th' ); ?>

						<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_rate_value', 'td' ); ?>

							<?php echo wp_kses_post( $tax->formatted_amount ); ?>

						<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate_value', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_rate', 'tr' ); ?>

				<?php endforeach; ?>

			<?php else : ?>

				<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total', 'tr', array( 'class' => 'tax-total' ) ); ?>

					<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total_label', 'th' ); ?>

						<?php echo esc_html( WC()->countries->tax_or_vat() ); ?>

					<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total_label', 'th' ); ?>

					<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_tax_total_value', 'td' ); ?>

						<?php wc_cart_totals_taxes_total_html(); ?>

					<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total_value', 'td' ); ?>

				<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_tax_total', 'tr' ); ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total', 'tr', array( 'class' => 'order-total' ) ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total_label', 'th' ); ?>

				<?php _e( 'Total', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total_label', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_checkout_review_order_tfoot_order_total_value', 'td' ); ?>

				<?php wc_cart_totals_order_total_html(); ?>

			<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total_value', 'td' ); ?>

		<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot_order_total', 'tr' ); ?>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	<?php echo beans_close_markup( 'woo_checkout_review_order_tfoot', 'tfoot' ); ?>

<?php echo beans_close_markup( 'woo_checkout_review_order_table', 'table' ); ?>
