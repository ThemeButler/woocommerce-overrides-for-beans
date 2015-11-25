<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_before_mini_cart' ); ?>

<?php echo beans_open_markup( 'woo_cart_mini_list', 'ul', array( 'class' => 'cart_list product_list_widget ' . $args['list_class'] ) ); ?>

	<?php if ( ! WC()->cart->is_empty() ) : ?>

		<?php

			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :

				$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) :

					$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );

					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

					?>

					<?php echo beans_open_markup( 'woo_cart_mini_list_item', 'li', array( 'class' => esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ) ) ); ?>

						<?php echo apply_filters( 'woocommerce_cart_item_remove_link',

						sprintf( beans_open_markup( 'woo_cart_mini_list_item_remove_link', 'a', array(
							'href' => '%s',
							'class' => 'remove',
							'title' => '%s',
							'data-product_id' => '%s',
							'data-product_sku' => '%s'
						) ) . '&times;' . beans_close_markup( 'woo_cart_mini_list_item_remove_link', 'a' ), esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ),
							esc_attr( $product_id ), esc_attr( $_product->get_sku() ) ), $cart_item_key ); ?>

						<?php if ( ! $_product->is_visible() ) : ?>

							<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>

						<?php else : ?>

							<?php echo beans_open_markup( 'woo_cart_item_link', 'a', array( 'href' => esc_url( $_product->get_permalink( $cart_item ) ) ) ); ?>

								<?php echo str_replace( array( 'http:', 'https:' ), '', $thumbnail ) . $product_name . '&nbsp;'; ?>

							<?php echo beans_close_markup( 'woo_cart_item_link', 'a' ); ?>

						<?php endif; ?>

						<?php echo WC()->cart->get_item_data( $cart_item ); ?>

						<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity',

						beans_open_markup( 'woo_cart_mini_list_item_quantity', 'span', array( 'class' => 'quantity' ) ) . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . beans_close_markup( 'woo_cart_mini_list_item_quantity', 'span' ) , $cart_item, $cart_item_key ); ?>

					<?php echo beans_close_markup( 'woo_cart_mini_list_item', 'li' ); ?>

					<?php

				endif;

			endforeach;

		?>

	<?php else : ?>

		<?php echo beans_open_markup( 'woo_cart_mini_list_item_empty', 'li', array( 'class' => 'empty' ); ?>

			<?php _e( 'No products in the cart.', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_cart_mini_list_item_empty', 'li' ); ?>

	<?php endif; ?>

<?php echo beans_close_markup( 'woo_cart_mini_list', 'ul' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>

	<?php echo beans_open_markup( 'woo_cart_total', 'p', array( 'class' => 'total' ) ); ?>

		<?php echo beans_open_markup( 'woo_cart_total_strong', 'strong' ); ?>

			<?php _e( 'Subtotal', 'woocommerce' ); ?>:

		<?php echo beans_close_markup( 'woo_cart_total_strong', 'strong' ); ?>

		<?php echo WC()->cart->get_cart_subtotal(); ?>

	<?php echo beans_close_markup( 'woo_cart_total', 'p' ); ?>

	<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

	<?php echo beans_open_markup( 'woo_cart_buttons', 'p', array( 'class' => 'buttons' ) ); ?>

		<?php echo beans_open_markup( 'woo_cart_buttons_view_cart', 'a', array(
			'href' => WC()->cart->get_cart_url(),
			'class' => 'button wc-forward'
		) ); ?>

			<?php _e( 'View Cart', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_cart_buttons_view_cart', 'a' ); ?>

		<?php echo beans_open_markup( 'woo_cart_buttons_checkout', 'a', array(
			'href' => WC()->cart->get_checkout_url(),
			'class' => 'button checkout wc-forward'
			) ); ?>

			<?php _e( 'Checkout', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_cart_buttons_checkout', 'a' ); ?>

	<?php echo beans_close_markup( 'woo_cart_buttons', 'p' ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
