<?php
/**
 * Auth form grant access
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Auth
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_auth_page_header' ); ?>

<?php echo beans_open_markup( 'woo_auth_access_title', 'h1' ); ?>

	<?php printf( __( '%s would like to connect to your store' , 'woocommerce' ), esc_html( $app_name ) ); ?>

<?php echo beans_close_markup( 'woo_auth_access_title', 'h1' ); ?>

<?php wc_print_notices(); ?>

<?php echo beans_open_markup( 'woo_auth_access_notice', 'p' ); ?>

	<?php printf( __( 'This will give "%s" <strong>%s</strong> access which will allow it to:' , 'woocommerce' ), esc_html( $app_name ), esc_html( $scope ) ); ?>

<?php echo beans_close_markup( 'woo_auth_access_notice', 'p' ); ?>

<?php echo beans_open_markup( 'woo_auth_permissions_list', 'ul', array( 'class' => 'wc-auth-permissions' ) ); ?>

	<?php foreach ( $permissions as $permission ) : ?>

		<?php echo beans_open_markup( 'woo_auth_permissions_list_item', 'li' ); ?>

			<?php echo esc_html( $permission ); ?>

		<?php echo beans_close_markup( 'woo_auth_permissions_list_item', 'li' ); ?>

	<?php endforeach; ?>

<?php echo beans_close_markup( 'woo_auth_permissions_list', 'ul' ); ?>

<?php echo beans_open_markup( 'woo_auth_logged_in_as_wrap', 'div', array( 'class' => 'wc-auth-logged-in-as' ) ); ?>

	<?php echo get_avatar( $user->ID, 70 ); ?>

	<?php echo beans_open_markup( 'woo_auth_logged_in_as_p', 'p' ); ?>

		<?php printf( __( 'Logged in as %s', 'woocommerce' ), esc_html( $user->display_name ) ); ?>

		<?php echo beans_open_markup( 'woo_auth_logout_link', 'a', array(
			'href' => esc_url( $logout_url ),
			'class' => 'wc-auth-logout'
		) ); ?>

			<?php _e( 'Logout', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_auth_logout_link', 'a' ); ?>

	<?php echo beans_close_markup( 'woo_auth_logged_in_as_p', 'p' ); ?>

<?php echo beans_close_markup( 'woo_auth_logged_in_as_wrap', 'div' ); ?>

<?php echo beans_open_markup( 'woo_auth_actions_wrap', 'p', array( 'class' => 'wc-auth-actions' ) ); ?>

	<?php echo beans_open_markup( 'woo_auth_actions_approve_link', 'a', array(
		'href' => esc_url( $granted_url ),
		'class' => 'button button-primary wc-auth-approve'
	) ); ?>

		<?php _e( 'Approve', 'woocommerce' ); ?>

	<?php echo beans_close_markup( 'woo_auth_actions_approve_link', 'a' ); ?>

	<?php echo beans_open_markup( 'woo_auth_actions_deny_link', 'a', array(
		'href' => esc_url( $return_url ),
		'class' => 'button wc-auth-deny'
	) ); ?>

		<?php _e( 'Deny', 'woocommerce' ); ?>

	<?php echo beans_close_markup( 'woo_auth_actions_deny_link', 'a' ); ?>

<?php echo beans_close_markup( 'woo_auth_actions_wrap', 'p' ); ?>

<?php do_action( 'woocommerce_auth_page_footer' ); ?>
