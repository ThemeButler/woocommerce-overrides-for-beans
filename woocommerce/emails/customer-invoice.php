<?php
/**
 * Customer invoice email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<?php if ( $order->has_status( 'pending' ) ) : ?>

	<?php echo beans_open_markup( 'woo_emails_customer_invoice_notice', 'p' ); ?>

		<?php printf( __( 'An order has been created for you on %s. To pay for this order please use the following link: %s', 'woocommerce' ), get_bloginfo( 'name', 'display' ), '<a href="' . esc_url( $order->get_checkout_payment_url() ) . '">' . __( 'pay', 'woocommerce' ) . '</a>' ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_invoice_notice', 'p' ); ?>

<?php endif; ?>

<?php do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_invoice_title', 'h2' ); ?>

	<?php printf( __( 'Order #%s', 'woocommerce' ), $order->get_order_number() ); ?> (<?php printf( beans_open_markup( 'woo_emails_customer_invoice_time', 'time', array( 'datetime' => '%s' ) ) . '%s' . beans_close_markup( 'woo_emails_customer_invoice_time', 'time', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?>)

<?php echo beans_close_markup( 'woo_emails_customer_invoice_title', 'h2' ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_invoice_table', 'table', array(
	'class' => 'td',
	'cellspacing' => 0,
	'cellpadding' => 6,
	'style' => 'width: 100%; font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif;',
	'border' => 0
) );
?>

<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_head', 'thead' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_heading_row', 'tr' ); ?>

		<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_heading_product', 'th', array(
			'class' => 'td',
			'scope' => 'col',
			'style' => 'text-align:left;'
		) ); ?>

			<?php _e( 'Product', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_heading_product', 'th' ); ?>

		<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_heading_quantity', 'th', array(
			'class' => 'td',
			'scope' => 'col',
			'style' => 'text-align:left;'
		) ); ?>

			<?php _e( 'Quantity', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_heading_quantity', 'th' ); ?>

		<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_heading_price', 'th', array(
			'class' => 'td',
			'scope' => 'col',
			'style' => 'text-align:left;'
		) ); ?>

			<?php _e( 'Price', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_heading_price', 'th' ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_heading_row', 'tr' ); ?>

<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_head', 'thead' ); ?>

<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_body', 'tbody' ); ?>

		<?php
			switch ( $order->get_status() ) {
				case "completed" :
					echo $order->email_order_items_table( $order->is_download_permitted(), false, true );
				break;
				case "processing" :
					echo $order->email_order_items_table( $order->is_download_permitted(), true, true );
				break;
				default :
					echo $order->email_order_items_table( $order->is_download_permitted(), true, false );
				break;
			}
		?>

	<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_body', 'tbody' ); ?>

	<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_foot', 'tfoot' ); ?>

		<?php
			if ( $totals = $order->get_order_item_totals() ) {
				$i = 0;
				foreach ( $totals as $total ) {
					$i++;
					?>

					<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_row', 'tr' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_total_label', 'th', array(
							'class' => 'td',
							'scope' => 'row',
							'colspan' => 2,
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
							#TODO Double check
						) ); ?>

							<?php echo $total['label']; ?>

						<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_total_label', 'th' ); ?>

						<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_total_value', 'td', array(
							'class' => 'td',
							'style' => 'text-align: left;' . $i == 1 ? ' border-top-width: 4px;' : null
							#TODO Double check
						) ); ?>

							<?php echo $total['value']; ?>

						<?php echo beans_open_markup( 'woo_emails_customer_invoice_table_total_value', 'td' ); ?>

					<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_row', 'tr' ); ?>

					<?php
				}
			}
		?>

		<?php echo beans_close_markup( 'woo_emails_customer_invoice_table_foot', 'tfoot' ); ?>

	<?php echo beans_close_markup( 'woo_emails_customer_invoice_table', 'table' ); ?>

<?php do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text ); ?>

<?php do_action( 'woocommerce_email_footer' ); ?>
