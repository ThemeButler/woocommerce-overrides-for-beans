<?php
/**
 * Show options for ordering
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_orderby_form', 'form', array(
	'class' => 'woocommerce-ordering',
	'method' => 'get'
) );

	echo beans_open_markup( 'woo_orderby_select', 'select', array(
		'name' => 'orderby',
		'class' => 'orderby'
	) );

        foreach ( $catalog_orderby_options as $id => $name ) :

            echo beans_open_markup( 'woo_orderby_option', 'option', array(
				'value' => esc_attr( $id ),
				'selected' => selected( $orderby, $id ) ? 'selected' : null
				#TODO Double check
			 ) );

                echo esc_html( $name );

            echo beans_open_markup( 'woo_orderby_option', 'option' );

        endforeach;

    echo beans_open_markup( 'woo_orderby_select', 'select' );

    	// Keep query string vars intact
		foreach ( $_GET as $key => $val ) :

			if ( 'orderby' === $key || 'submit' === $key ) :

				continue;

			endif;

			if ( is_array( $val ) ) :

				foreach( $val as $innerVal ) :

					echo beans_selfclose_markup( 'woo_orderby_option_hidden', 'input', array(
						'type' => 'hidden',
						'name' => esc_attr( $key ) . '[]',
						'value' => esc_attr( $innerVal )
					 ) );

				endforeach;

			else :

				echo beans_selfclose_markup( 'woo_orderby_option_hidden', 'input', array(
					'type' => 'hidden',
					'name' => esc_attr( $key ),
					'value' => esc_attr( $val )
				 ) );

			endif;

		endforeach;

echo beans_close_markup( 'woo_orderby_form', 'form' );
