<?php
/**
 * Auth header
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<meta name="viewport" content="width=device-width" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex, nofollow" />
	<title><?php _e( 'Application Authentication Request', 'woocommerce' ); ?></title>
	<?php wp_admin_css( 'install', true ); ?>
	<link rel="stylesheet" href="<?php echo esc_url( str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/css/auth.css' ); ?>" type="text/css" />
</head>

<?php echo beans_open_markup( 'woo_auth_body', 'body', array( 'class' => 'wc-auth wp-core-ui' ) ); ?>

	<?php echo beans_open_markup( 'woo_auth_logo_heading', 'h1', array( 'id' => 'wc-logo' ) ); ?>

		<?php echo beans_selfclose_markup( 'woo_auth_logo_image', 'img', array( 'src' => WC()->plugin_url() . '/assets/images/woocommerce_logo.png', 'alt' => 'WooCommerce' ) ); ?>

	<?php echo beans_close_markup( 'woo_auth_content', 'h1' ); ?>

	<?php echo beans_open_markup( 'woo_auth_content', 'div', array( 'class' => 'wc-auth-content' ) ); ?>
