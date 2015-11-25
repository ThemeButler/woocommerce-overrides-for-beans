<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$crosssells = WC()->cart->get_cross_sells();

if ( sizeof( $crosssells ) == 0 ) return;

$meta_query = WC()->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );

if ( $products->have_posts() ) : ?>

	<?php echo beans_open_markup( 'woo_cart_cross_sells', 'div', array( 'class' => 'cross-sells' ) ); ?>

		<?php echo beans_open_markup( 'woo_cart_cross_sells_title', 'h2', array( 'class' => 'page-title' ) ); ?>

			<?php _e( 'You may be interested in&hellip;', 'woocommerce' ) ?>

		<?php echo beans_close_markup( 'woo_cart_cross_sells_title', 'h2' ); ?>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	<?php echo beans_close_markup( 'woo_cart_cross_sells', 'div' ); ?>

<?php endif;

wp_reset_query();
