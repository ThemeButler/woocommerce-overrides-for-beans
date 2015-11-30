<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) :

	return;

endif;

?>

<?php echo beans_open_markup( 'woo_login_form', 'form', array(
	'method' => 'post',
	'class' => 'login',
	'style' => $hidden ? 'display:none;' : null,
) ); ?>


	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<?php echo beans_open_markup( 'woo_login_username', 'p', array( 'class' => 'form-row form-row-first' ) ); ?>

		<?php echo beans_open_markup( 'woo_login_username_label', 'label', array( 'for' => 'username' ) ); ?>

			<?php _e( 'Username or email', 'woocommerce' ); ?>

			<?php echo beans_open_markup( 'woo_login_required_indicator', 'span', array( 'class' => 'required' ) ); ?>

			<?php echo beans_close_markup( 'woo_login_required_indicator', 'span' ); ?>

		<?php echo beans_close_markup( 'woo_login_username_label', 'label' ); ?>

		<?php echo beans_selfclose_markup( 'woo_login_username_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'username',
			'id' => 'username'
		) ); ?>

	<?php echo beans_close_markup( 'woo_login_username', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_login_password', 'p', array( 'class' => 'form-row' ) ); ?>

		<?php echo beans_open_markup( 'woo_login_password_label', 'label', array( 'for' => 'password' ) ); ?>

			<?php _e( 'Password', 'woocommerce' ); ?>

			<?php echo beans_open_markup( 'woo_login_required_indicator', 'span', array( 'class' => 'required' ) ); ?>

			<?php echo beans_close_markup( 'woo_login_required_indicator', 'span' ); ?>

		<?php echo beans_close_markup( 'woo_login_password_label', 'label' ); ?>

		<?php echo beans_selfclose_markup( 'woo_login_password_input', 'input', array(
			'type' => 'password',
			'class' => 'input-text',
			'name' => 'password',
			'id' => 'password'
		) ); ?>

	<?php echo beans_close_markup( 'woo_login_password', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_login_clear', 'div', array( 'class' => 'clear' ) ); ?>

	<?php echo beans_close_markup( 'woo_login_clear', 'div' ); ?>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<?php echo beans_open_markup( 'woo_login_submit', 'p', array( 'class' => 'form-row' ) ); ?>

		<?php wp_nonce_field( 'woocommerce-login' ); ?>

		<?php echo beans_selfclose_markup( 'woo_login_submit_hidden_input', 'input', array(
			'type' => 'hidden',
			'name' => 'redirect',
			'value' => esc_attr_e( 'Login', 'woocommerce' )
		) ); ?>

		<?php echo beans_selfclose_markup( 'woo_login_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'login',
			'value' => esc_url( $redirect )
		) ); ?>

		<?php echo beans_open_markup( 'woo_login_remember_label', 'label', array(
			'for' => 'rememberme',
			'class' => 'inline'
		) ); ?>

			<?php echo beans_selfclose_markup( 'woo_login_remember_input', 'input', array(
				'name' => 'rememberme',
				'type' => 'checkbox',
				'id' => 'rememberme',
				'value' => 'forever'
			) ); ?>

			<?php _e( 'Remember me', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_login_remember_label', 'label' ); ?>

	<?php echo beans_close_markup( 'woo_login_submit', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_login_lost_password', 'p', array( 'class' => 'lost_password' ) ); ?>

		<a href="<?php ; ?>"></a>

		<?php echo beans_open_markup( 'woo_login_lost_password_link', 'a', array( 'href' => esc_url( wp_lostpassword_url() ) ) ); ?>

		<?php _e( 'Lost your password?', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_login_lost_password_link', 'a' ); ?>

	<?php echo beans_close_markup( 'woo_login_lost_password', 'p' ); ?>

	<?php echo beans_open_markup( 'woo_login_clear', 'div', array( 'class' => 'clear' ) ); ?>

	<?php echo beans_close_markup( 'woo_login_clear', 'div' ); ?>

	<?php do_action( 'woocommerce_login_form_end' ); ?>

<?php echo beans_close_markup( 'woo_login_form', 'form' ); ?>
