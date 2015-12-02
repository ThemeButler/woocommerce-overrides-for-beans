<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) :

	return;

endif;

do_action( 'woocommerce_before_shipping_calculator' );

echo beans_open_markup( 'woo_shipping_calculator_form', 'form', array(
	'class' => 'woocommerce-shipping-calculator',
	'action' => esc_url( WC()->cart->get_cart_url() ),
	'method' => 'post'
) );

	echo beans_open_markup( 'woo_shipping_calculator_link_wrap', 'p' );

	echo beans_open_markup( 'woo_shipping_calculator_link', 'a', array(
		'href' => '#',
		'class' => 'shipping-calculator-button'
	) );

	_e( 'Calculate Shipping', 'woocommerce' );

	echo beans_open_markup( 'woo_shipping_calculator_link', 'a' );

	echo beans_close_markup( 'woo_shipping_calculator_link_wrap', 'p' );

	echo beans_open_markup( 'woo_shipping_calculator_section', 'section', array(
		'class' => 'shipping-calculator-form',
		'style' => 'display:none;'
	) );

		echo beans_close_markup( 'woo_shipping_calculator_country', 'p', array(
			'class' => 'form-row form-row-wide',
			'id' => 'calc_shipping_country_field'
		) );

			echo beans_close_markup( 'woo_shipping_calculator_country_select', 'select', array(
				'name' => 'calc_shipping_country',
				'id' => 'calc_shipping_country',
				'class' => 'country_to_state',
				'rel' => 'calc_shipping_state'
			) );

				echo beans_open_markup( 'woo_shipping_calculator_country_option_default', 'option', array( 'value' => '' ) );

					_e( 'Select a country&hellip;', 'woocommerce' );

				echo beans_close_markup( 'woo_shipping_calculator_country_option_default' );

				foreach( WC()->countries->get_shipping_countries() as $key => $value ) :

					echo beans_open_markup( 'woo_shipping_calculator_country_option_' . esc_attr( $key ), 'option', array(
						'value' => esc_attr( $key ),
						'selected' => selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false )
					) );

						echo esc_html( $value );

					echo beans_close_markup( 'woo_shipping_calculator_country_option_' . esc_attr( $key ), 'option' );

				endforeach;

			echo beans_close_markup( 'woo_shipping_calculator_country_select', 'select' );

		echo beans_close_markup( 'woo_shipping_calculator_country', 'p' );

		echo beans_open_markup( 'woo_shipping_calculator_state', 'p', array(
			'class' => 'form-row form-row-wide',
			'id' => 'calc_shipping_state_field'
		) );

				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );

				// Hidden Input
				if ( is_array( $states ) && empty( $states ) ) :

					echo beans_selfclose_markup( 'woo_shipping_calculator_state_hidden_input', 'input', array(
						'type' => 'hidden',
						'name' => 'calc_shipping_state',
						'id' => 'calc_shipping_state',
						'placeholder' => esc_attr_e( 'State / county', 'woocommerce' )
					) );


				// Dropdown Input
				elseif ( is_array( $states ) ) :

					echo beans_open_markup( 'woo_shipping_calculator_state_wrap', 'span' );

						echo beans_open_markup( 'woo_shipping_calculator_state_select', 'select', array(
							'name' => 'calc_shipping_state',
							'id' => 'calc_shipping_state',
							'placeholder' => esc_attr_e( 'State / county', 'woocommerce' )
						) );

							echo beans_open_markup( 'woo_shipping_calculator_state_option_default', 'option', array( 'value' => '' ) );

								_e( 'Select a state&hellip;', 'woocommerce' );

							echo beans_close_markup( 'woo_shipping_calculator_state_option_default', 'option' );

							foreach ( $states as $ckey => $cvalue ) :

								echo beans_open_markup( 'woo_shipping_calculator_state_option_' . esc_attr( $ckey ), 'option', array(
									'value' => esc_attr( $ckey ),
									'selected' => selected( $current_r, $ckey, false )
								) );

									__( esc_html( $cvalue ), 'woocommerce' );

								echo beans_close_markup( 'woo_shipping_calculator_state_option_' . esc_attr( $ckey ), 'option' );

							endforeach;

						echo beans_close_markup( 'woo_shipping_calculator_state_select', 'select' );

					echo beans_close_markup( 'woo_shipping_calculator_state_wrap', 'span' );

				// Standard Input

				else :

					echo beans_selfclose_markup( 'woo_shipping_calculator_state_input', 'input', array(
						'type' => 'text',
						'class' => 'input-text',
						'value' => esc_attr( $current_r ),
						'placeholder' => esc_attr_e( 'State / county', 'woocommerce' ),
						'name' => 'calc_shipping_state',
						'id' => 'calc_shipping_state'
					) );

		endif;

		echo beans_close_markup( 'woo_shipping_calculator_state', 'p' );

		if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) :

			echo beans_open_markup( 'woo_shipping_calculator_city', 'p', array(
				'class' => 'form-row form-row-wide',
				'id' => 'calc_shipping_city_field'
			) );

				echo beans_selfclose_markup( 'woo_shipping_calculator_city_input', 'input', array(
					'type' => 'text',
					'class' => 'input-text',
					'value' => esc_attr( WC()->customer->get_shipping_city() ),
					'placeholder' => esc_attr_e( 'City', 'woocommerce' ),
					'name' => 'calc_shipping_city',
					'id' => 'calc_shipping_city'
				) );

			echo beans_close_markup( 'woo_shipping_calculator_city', 'p' );

		endif;

		if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) :

			echo beans_open_markup( 'woo_shipping_calculator_postcode', 'p', array(
				'class' => 'form-row form-row-wide',
				'id' => 'calc_shipping_city_field'
			) );

				echo beans_selfclose_markup( 'woo_shipping_calculator_postcode_input', 'input', array(
					'type' => 'text',
					'class' => 'input-text',
					'value' => esc_attr( WC()->customer->get_shipping_postcode() ),
					'placeholder' => esc_attr_e( 'Postcode / Zip', 'woocommerce' ),
					'name' => 'calc_shipping_postcode',
					'id' => 'calc_shipping_postcode'
				) );

			echo beans_close_markup( 'woo_shipping_calculator_postcode', 'p' );

		endif;

		echo beans_open_markup( 'woo_shipping_calculator_button_wrap', 'p' );

			echo beans_open_markup( 'woo_shipping_calculator_submit_button', 'button', array(
				'type' => 'submit',
				'name' => 'calc_shipping',
				'value' => 1,
				'class' => 'button'
			) );

				_e( 'Update Totals', 'woocommerce' );

			echo beans_close_markup( 'woo_shipping_calculator_submit_button', 'button' );

		echo beans_close_markup( 'woo_shipping_calculator_button_wrap', 'p' );

		wp_nonce_field( 'woocommerce-cart' );

	echo beans_close_markup( 'woo_shipping_calculator_section', 'section' );

echo beans_open_markup( 'woo_shipping_calculator_form', 'form');

do_action( 'woocommerce_after_shipping_calculator' );
