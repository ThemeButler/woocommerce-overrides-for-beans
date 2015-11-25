<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) :

	 	echo get_the_password_form();

		return;

	endif;

?>

<?php echo beans_open_markup( 'woo_product_single_wrap', 'div', array( 'itemscope' => '', 'itemtype' => woocommerce_get_product_schema(), 'id' => 'product-' . the_ID(), 'class' => implode(' ', post_class() ) ) ); ?>

<?php #TODO Double check ?>

	<?php
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );
	?>

	<?php echo beans_open_markup( 'woo_product_single_summary', 'div', array( 'class' => 'summary entry-summary' ) ); ?>

		<?php
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_rating - 10
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary' );
		?>

	<?php echo beans_close_markup( 'woo_product_single_summary', 'div' ); ?>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<?php echo beans_selfclose_markup( 'woo_product_single_meta_url', 'meta', array( 'itemprop' => 'url', 'content' => the_permalink() ) ); ?>

<?php echo beans_close_markup( 'woo_product_single_wrap', 'div' ); ?><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>
