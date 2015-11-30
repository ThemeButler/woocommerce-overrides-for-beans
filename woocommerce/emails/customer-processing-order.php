<?php
/**
 * Customer processing order email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<?php echo beans_open_markup( 'woo_emails_customer_processing_notice', 'p' ); ?>

	<?php _e( "Your order has been received and is now being processed. Your order details are shown below for your reference:", 'woocommerce' ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_processing_notice', 'p' ); ?>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_processing_title', 'h2' ); ?>

	<?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_processing_title', 'h2' ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_processing_table', 'table', array(
	'class' => 'td',
	'cellspacing' => 0,
	'cellpadding' => 6,
	'style' => 'width: 100%; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;',
	'border' => 0
) );
?>

	<?php echo beans_open_markup( 'woo_emails_customer_processing_table_head', 'thead' ); ?>

		<?php echo beans_open_markup( 'woo_emails_customer_processing_table_heading_row', 'tr' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_processing_table_heading_product', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Product', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_processing_table_heading_product', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_processing_table_heading_quantity', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Quantity', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_processing_table_heading_quantity', 'th' ); ?>

			<?php echo beans_open_markup( 'woo_emails_customer_processing_table_heading_price', 'th', array(
				'class' => 'td',
				'scope' => 'col',
				'style' => 'text-align:left;'
			) ); ?>

				<?php _e( 'Price', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_emails_customer_processing_table_heading_price', 'th' ); ?>

		<?php echo beans_close_markup( 'woo_emails_customer_processing_table_heading_row', 'tr' ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_processing_table_head', 'thead' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_processing_table_body', 'tbody' ); ?>

		<?php echo $order->email_order_items_table( $order->is_download_permitted(), true, $order->has_status( 'processing' ) ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_processing_table_body', 'tbody' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_processing_table_foot', 'tfoot' ); ?>

		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?>

					<?php echo beans_open_markup( 'woo_emails_customer_processing_table_row', 'tr' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_processing_table_total_label', 'th', array(
							'class' => 'td',
							'scope' => 'row',
							'colspan' => 2,
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
							#TODO Double check
						) ); ?>

							<?php echo $total['label']; ?>

						<?php echo beans_open_markup( 'woo_emails_customer_processing_table_total_label', 'th' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_processing_total_value', 'td', array(
							'class' => 'td',
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
							#TODO Double check
						) ); ?>

							<?php echo $total['value']; ?>

						<?php echo beans_open_markup( 'woo_emails_customer_processing_table_total_value', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_emails_customer_processing_table_row', 'tr' ); ?>

					<?php
				}
			}
		?>

	<?php echo beans_close_markup( 'woo_emails_customer_processing_table_foot', 'tfoot' ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_processing_table', 'table' ); ?>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
