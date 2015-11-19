<?php
/**
 * The template for displaying product content in the products widget.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-widget-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php global $product; ?>

<?php echo beans_open_markup( 'woo_content_product_widget_list_item', 'li' ); ?>

	<?php echo beans_open_markup( 'woo_content_product_widget_list_item_link', 'a', array(
		'href' => esc_url( get_permalink( $product->id ) ),
		'title' => esc_attr( $product->get_title() )
	) ); ?>

		<?php echo $product->get_image(); ?>

		<?php echo beans_open_markup( 'woo_content_product_widget_list_item_title', 'span', array( 'class' => 'product-title' ) ); ?>

			<?php echo $product->get_title(); ?>

		<?php echo beans_close_markup( 'woo_content_product_widget_list_item_title', 'span' ); ?>

	<?php echo beans_close_markup( 'woo_content_product_widget_list_item_link', 'a' ); ?>

	<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>

	<?php echo $product->get_price_html(); ?>

<?php echo beans_close_markup( 'woo_content_product_widget_list_item', 'li' ); ?>
