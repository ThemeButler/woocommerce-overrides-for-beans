<?php
/**
 * Customer new account email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_new_account_notice', 'p' ); ?>

	<?php printf( __( "Thanks for creating an account on %s. Your username is <strong>%s</strong>.", 'woocommerce' ), esc_html( $blogname ), esc_html( $user_login ) ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_new_account_notice', 'p' ); ?>

<?php if ( get_option( 'woocommerce_registration_generate_password' ) == 'yes' && $password_generated ) : ?>

	<?php echo beans_open_markup( 'woo_emails_customer_generated_password_notice', 'p' ); ?>

		<?php printf( __( "Your password has been automatically generated: <strong>%s</strong>", 'woocommerce' ), esc_html( $user_pass ) ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_generated_password_notice', 'p' ); ?>

<?php endif; ?>

<?php echo beans_open_markup( 'woo_emails_customer_account_link_notice', 'p' ); ?>

	<?php printf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), wc_get_page_permalink( 'myaccount' ) ); ?></p>

<?php echo beans_close_markup( 'woo_emails_customer_account_link_notice', 'p' ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
