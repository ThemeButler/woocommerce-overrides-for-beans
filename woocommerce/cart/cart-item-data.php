<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_cart_item_data', 'dl', array( 'class' => 'variation' ) ); ?>

	<?php foreach ( $item_data as $data ) : ?>

		<?php echo beans_open_markup( 'woo_cart_item_data_term', 'dt', array( 'class' => 'variation-' . sanitize_html_class( $data['key'] ) ) ); ?>

			<?php echo wp_kses_post( $data['key'] ); ?>:

		<?php echo beans_close_markup( 'woo_cart_item_data_term', 'dt' ); ?>

		<?php echo beans_open_markup( 'woo_cart_item_data_definition', 'dd', array( 'class' => 'variation-' . sanitize_html_class( $data['key'] ) ) ); ?>

			<?php echo wp_kses_post( wpautop( $data['display'] ) ); ?>

		<?php echo beans_close_markup( 'woo_cart_item_data_definition', 'dd' ); ?>

	<?php endforeach; ?>

<?php echo beans_close_markup( 'woo_cart_item_data', 'dl' ); ?>
