<?php
/**
 * Customer refunded order email
 *
 * @author   WooThemes
 * @package  WooCommerce/Templates/Emails
 * @version  2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_refund_notice', 'p' ); ?>

	<?php

	if ( $partial_refund ) :

		printf( __( "Hi there. Your order on %s has been partially refunded.", 'woocommerce' ), get_option( 'blogname' ) );

	else :

		printf( __( "Hi there. Your order on %s has been refunded.", 'woocommerce' ), get_option( 'blogname' ) );

	endif;

	?>

<?php echo beans_close_markup( 'woo_emails_customer_refund_notice', 'p' ); ?>


<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_refund_title', 'h2' ); ?>

	<?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_refund_title', 'h2' ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_refund_table', 'table', array(
	'class' => 'td',
	'cellspacing' => 0,
	'cellpadding' => 6,
	'style' => 'width: 100%; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;',
	'border' => 0
) );
?>

	<?php echo beans_open_markup( 'woo_emails_customer_refund_table_head', 'thead' ); ?>

		<?php echo beans_open_markup( 'woo_emails_customer_refund_table_heading_row', 'tr' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_refund_table_heading_product', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Product', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_refund_table_heading_product', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_refund_table_heading_quantity', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Quantity', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_refund_table_heading_quantity', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_refund_table_heading_price', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Price', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_refund_table_heading_price', 'th' ); ?>

		<?php echo beans_close_markup( 'woo_emails_customer_refund_table_heading_row', 'tr' ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_refund_table_head', 'thead' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_refund_table_body', 'tbody' ); ?>

		<?php echo $order->email_order_items_table( true, false, true ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_refund_table_body', 'tbody' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot', 'tfoot' ); ?>

		<?php if ( $totals = $order->get_order_item_totals() ) :

				$i = 0;

				if ( $refund && $refund->get_refund_amount() > 0 ) : ?>

					<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_row', 'tr' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_label', 'th', array(
							'scope' => 'row',
							'colspan' => 2,
							'style' => 'text-align:left; border: 1px solid #eee;border-top-width: 4px;'
						) ); ?>

							<?php _e( 'Amount Refunded', 'woocommerce' ); ?>:

						<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_label', 'th' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_value', 'td', array(
							'style' => 'text-align:left; border: 1px solid #eee;border-top-width: 4px;'
						) ); ?>

							<?php echo $refund->get_formatted_refund_amount(); ?>

						<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_value', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_row', 'tr' ); ?>

					<?php
					$i++;

				endif;

				foreach ( $totals as $total ) :
					$i++;
					?>

					<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_totals_row', 'tr' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_totals_label', 'th', array(
							'class' => 'td',
							'scope' => 'row',
							'colspan' => 2,
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
						) ); ?>

							<?php echo $total['label']; ?>

						<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_totals_label', 'th' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_refund_table_foot_totals_value', 'td', array(
							'class' => 'td',
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
						) ); ?>

							<?php echo $total['value']; ?>

						<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_totals_value', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot_totals_row', 'tr' ); ?>

					<?php

				endforeach;

			endif;

		?>

	<?php echo beans_close_markup( 'woo_emails_customer_refund_table_foot', 'tfoot' ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_refund_table', 'table' ); ?>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
