<?php
/**
 * Auth form login
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_auth_page_header' ); ?>

<?php echo beans_open_markup( 'woo_auth_form_heading', 'h1' ); ?>

	<?php printf( __( '%s would like to connect to your store' , 'woocommerce' ), esc_html( $app_name ) ); ?>

<?php echo beans_close_markup( 'woo_auth_form_heading', 'h1' ); ?>

<?php wc_print_notices(); ?>

<?php echo beans_open_markup( 'woo_auth_form_notice', 'p' ); ?>

	<?php printf( __( 'To connect to %1$s you need to be logged in. Log in to your store below, or %2$scancel and return to %1$s%3$s', 'woocommerce' ), wc_clean( $app_name ), '<a href="' . esc_url( $return_url ) . '">', '</a>' ); ?>

<?php echo beans_close_markup( 'woo_auth_form_notice', 'p' ); ?>

<?php echo beans_open_markup( 'woo_auth_form', 'form', array(
	'method' => 'post',
	'class' => 'wc-auth-login'
) ); ?>

	<?php echo beans_open_markup( 'woo_auth_form_username', 'p', array( 'class' => 'form-row form-row-wide' ) ); ?>

		<?php echo beans_open_markup( 'woo_auth_form_username_label', 'label', array( 'for' => 'username' ) ); ?>

			<?php _e( 'Username or email address', 'woocommerce' ); ?>

			<?php echo beans_open_markup( 'woo_auth_form_required', 'span', array( 'class' => 'required' ) ); ?>*<?php echo beans_close_markup( 'woo_auth_form_required', 'span' ); ?>

		<?php echo beans_close_markup( 'woo_auth_form_username_label', 'label' ); ?>

		<?php echo beans_selfclose_markup( 'woo_auth_form_username_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'username',
			'id' => 'username',
			'value' => ( ! empty( $_POST['username'] ) ) ? esc_attr( $_POST['username'] ) : ''
		) ); ?>

	<?php echo beans_close_markup( 'woo_auth_form_username', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_auth_form_password', 'p', array( 'class' => 'form-row form-row-wide' ) ); ?>

		<?php echo beans_open_markup( 'woo_auth_form_password_label', 'label', array( 'for' => 'username' ) ); ?>

			<?php _e( 'Password', 'woocommerce' ); ?>

			<?php echo beans_open_markup( 'woo_auth_form_required', 'span', array( 'class' => 'required' ) ); ?>*<?php echo beans_close_markup( 'woo_auth_form_required', 'span' ); ?>

		<?php echo beans_close_markup( 'woo_auth_form_username_label', 'label' ); ?>

		<?php echo beans_selfclose_markup( 'woo_auth_form_password_input', 'input', array(
			'class' => 'input-text',
			'type' => 'password',
			'name' => 'password',
			'id' => 'password'
		) ); ?>

	<?php echo beans_close_markup( 'woo_auth_form_password', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_auth_form_submit', 'p', array( 'class' => 'wc-auth-actions' ) ); ?>

		<?php wp_nonce_field( 'woocommerce-login' ); ?>

		<?php echo beans_selfclose_markup( 'woo_auth_form_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button button-large button-primary wc-auth-login-button',
			'name' => 'login',
			'value' => esc_attr_e( 'Login', 'woocommerce' )
		) ); ?>

		<?php echo beans_selfclose_markup( 'woo_auth_form_redirect_input', 'input', array(
			'type' => 'hidden',
			'name' => 'redirect',
			'value' => esc_url( $redirect_url )
		) ); ?>

	<?php echo beans_close_markup( 'woo_auth_form_submit', 'p' ); ?>

<?php echo beans_close_markup( 'woo_auth_form', 'form' ); ?>

<?php do_action( 'woocommerce_auth_page_footer' ); ?>
