<?php
/**
 * Output a single payment method
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php echo beans_open_markup( 'woo_checkout_payment_method_list_item', 'li', array( 'class' => 'payment_method_' . $gateway->id ) ); ?>

	<?php echo beans_selfclose_markup( 'woo_checkout_payment_method_list_input', 'input', array(
		'id' => 'payment_method_' . $gateway->id,
		'type' => 'radio',
		'class' => 'input-radio',
		'name' => 'payment_method',
		'value' => esc_attr( $gateway->id ),
		'checked' => checked( $gateway->chosen, true ),
		#TODO Double check
		'data-order_button_text' => esc_attr( $gateway->order_button_text )
	) ); ?>

	<?php echo beans_open_markup( 'woo_checkout_payment_method_list_label', 'label', array( 'for' => 'payment_method_' . $gateway->id ) ); ?>

		<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>

	<?php echo beans_close_markup( 'woo_checkout_payment_method_list_label', 'label' ); ?>

	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>

		<?php echo beans_open_markup( 'woo_checkout_payment_method_list_fields', 'div', array(
			'class' => 'payment_box payment_method_' . $gateway->id,
			'style' => ! $gateway->chosen ? 'display:none;' : null
			#TODO Double check
		) ); ?>

			<?php $gateway->payment_fields(); ?>

		<?php echo beans_close_markup( 'woo_checkout_payment_method_list_fields', 'div' ); ?>

	<?php endif; ?>

<?php echo beans_close_markup( 'woo_checkout_payment_method_list_item', 'li' ); ?>
