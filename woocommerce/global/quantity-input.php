<?php
/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

echo beans_open_markup( 'woo_quantity_input_wrap', 'div', array( 'class' => 'quantity' ) );

    echo beans_selfclose_markup( 'woo_quantity_input', 'input', array(
        'type' => 'number',
        'step' => esc_attr( $step ),
        'min' => is_numeric( $min_value ) ? esc_attr( $min_value ) : null,
        'max' => is_numeric( $max_value ) ? esc_attr( $max_value ) : null,
        #TODO Double check
        'name' => esc_attr( $input_name ),
        'value' => esc_attr( $input_value ),
        'title' => esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ),
        'class' => 'input-text qty text',
        'size' => 4
     ) );

echo beans_close_markup( 'woo_quantity_input_wrap', 'div' );
