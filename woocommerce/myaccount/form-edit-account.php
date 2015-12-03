<?php
/**
 * Edit account form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.7
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

wc_print_notices();

echo beans_open_markup( 'woo_account_edit_form', 'form', array( 'action' => '', 'method' => 'post' ) );

	do_action( 'woocommerce_edit_account_form_start' );

	echo beans_open_markup( 'woo_account_edit_form_first', 'p', array( 'class' => 'form-row form-row-first' ) );

		echo beans_open_markup( 'woo_account_edit_form_first_label', 'label', array( 'for' => 'account_first_name' ) );

			_e( 'First name', 'woocommerce' );

			echo beans_open_markup( 'woo_account_edit_form_required', 'span', array( 'class' => 'required' ) ) . '*' . beans_close_markup( 'woo_account_edit_form_required', 'span' );

		echo beans_close_markup( 'woo_account_edit_form_first_label', 'label' );

		echo beans_selfclose_markup( 'woo_account_edit_form_first_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'account_first_name',
			'id' => 'account_first_name',
			'value' => esc_attr( $user->first_name )
		) );

	echo beans_close_markup( 'woo_account_edit_form_first', 'p' );

	echo beans_open_markup( 'woo_account_edit_form_last', 'p', array( 'class' => 'form-row form-row-last' ) );

		echo beans_open_markup( 'woo_account_edit_form_last_label', 'label', array( 'for' => 'account_last_name' ) );

			_e( 'Last name', 'woocommerce' );

			echo beans_open_markup( 'woo_account_edit_form_required', 'span', array( 'class' => 'required' ) ) . '*' . beans_close_markup( 'woo_account_edit_form_required', 'span' );

		echo beans_close_markup( 'woo_account_edit_form_last_label', 'label' );

		echo beans_selfclose_markup( 'woo_account_edit_form_last_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'account_last_name',
			'id' => 'account_last_name',
			'value' => esc_attr( $user->last_name )
		) );

	echo beans_close_markup( 'woo_account_edit_form_last', 'p' );

	echo beans_open_markup( 'woo_account_edit_form_clear', 'div', array( 'class' => 'clear' ) ) . beans_close_markup( 'woo_account_edit_form_clear', 'div' );

	echo beans_open_markup( 'woo_account_edit_form_email', 'p', array( 'class' => 'form-row form-row-wide' ) );

		echo beans_open_markup( 'woo_account_edit_form_email_label', 'label', array( 'for' => 'account_email' ) );

			_e( 'Email address', 'woocommerce' );

			echo beans_open_markup( 'woo_account_edit_form_required', 'span', array( 'class' => 'required' ) ) . beans_close_markup( 'woo_account_edit_form_required', 'span' );

		echo beans_close_markup( 'woo_account_edit_form_email_label', 'label' );

		echo beans_selfclose_markup( 'woo_account_edit_form_email_input', 'input', array(
			'type' => 'text',
			'class' => 'input-text',
			'name' => 'account_email',
			'id' => 'account_email',
			'value' => esc_attr( $user->user_email )
		) );

	echo beans_close_markup( 'woo_account_edit_form_email', 'p' );

	echo beans_open_markup( 'woo_account_edit_form_fieldset', 'fieldset' );

		echo beans_open_markup( 'woo_account_edit_form_legend', 'legend' );

			_e( 'Password Change', 'woocommerce' );

		echo beans_close_markup( 'woo_account_edit_form_legend', 'legend' );

		echo beans_open_markup( 'woo_account_edit_form_password', 'p', array( 'class' => 'form-row form-row-wide' ) );

			echo beans_open_markup( 'woo_account_edit_form_password_label', 'label', array( 'for' => 'password_current' ) );

				_e( 'Current Password (leave blank to leave unchanged)', 'woocommerce' );

			echo beans_close_markup( 'woo_account_edit_form_password_label', 'label' );

			echo beans_selfclose_markup( 'woo_account_edit_form_password_input', 'input', array(
				'type' => 'password',
				'class' => 'input-text',
				'name' => 'password_current',
				'id' => 'password_current'
			) );

		echo beans_close_markup( 'woo_account_edit_form_password', 'p' );

		echo beans_open_markup( 'woo_account_edit_form_password_1', 'p', array( 'class' => 'form-row form-row-wide' ) );

			echo beans_open_markup( 'woo_account_edit_form_password_1_label', 'label', array( 'for' => 'password_1' ) );

				_e( 'New Password (leave blank to leave unchanged)', 'woocommerce' );

			echo beans_close_markup( 'woo_account_edit_form_password_1_label', 'label' );

			echo beans_selfclose_markup( 'woo_account_edit_form_password_1_input', 'input', array(
				'type' => 'password',
				'class' => 'input-text',
				'name' => 'password_1',
				'id' => 'password_1'
			) );

		echo beans_close_markup( 'woo_account_edit_form_password_1', 'p' );

		echo beans_open_markup( 'woo_account_edit_form_password_2', 'p', array( 'class' => 'form-row form-row-wide' ) );

			echo beans_open_markup( 'woo_account_edit_form_password_2_label', 'label', array( 'for' => 'password_2' ) );

				_e( 'Confirm New Password (leave blank to leave unchanged)', 'woocommerce' );

			echo beans_close_markup( 'woo_account_edit_form_password_2_label', 'label' );

			echo beans_selfclose_markup( 'woo_account_edit_form_password_2_input', 'input', array(
				'type' => 'password',
				'class' => 'input-text',
				'name' => 'password_2',
				'id' => 'password_2'
			) );

		echo beans_close_markup( 'woo_account_edit_form_password_2', 'p' );

	echo beans_open_markup( 'woo_account_edit_form_fieldset', 'fieldset' );

	echo beans_open_markup( 'woo_account_edit_form_clear', 'div', array( 'class' => 'clear' ) ) . beans_close_markup( 'woo_account_edit_form_clear', 'div' );

	do_action( 'woocommerce_edit_account_form' );

	echo beans_open_markup( 'woo_account_edit_form_submit', 'p' );

		wp_nonce_field( 'save_account_details' );

		echo beans_selfclose_markup( 'woo_account_edit_form_submit_input', 'input', array(
			'type' => 'submit',
			'class' => 'button',
			'name' => 'save_account_details',
			'value' => __( 'Save changes', 'woocommerce' )
		) );

		echo beans_selfclose_markup( 'woo_account_edit_form_submit_hidden_input', 'input', array(
			'type' => 'hidden',
			'name' => 'action',
			'value' => 'save_account_details'
		) );

	echo beans_close_markup( 'woo_account_edit_form_submit', 'p' );

	do_action( 'woocommerce_edit_account_form_end' );

echo beans_close_markup( 'woo_account_edit_form', 'form' );
