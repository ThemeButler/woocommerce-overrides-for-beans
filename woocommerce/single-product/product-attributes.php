<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$has_row = false;
$alt = 1;
$attributes = $product->get_attributes();

ob_start();

echo beans_open_markup( 'woo_single_attributes_table', 'table', array( 'class' => 'shop_attributes' ) );

	if ( $product->enable_dimensions_display() ) :

		if ( $product->has_weight() ) : $has_row = true;

			echo beans_open_markup( 'woo_single_attributes_weight_row', 'tr', array(
				if ( ( $alt = $alt * -1 ) == 1 )
				'class' => 'alt'
			) );

				echo beans_open_markup( 'woo_single_attributes_weight_heading', 'th' );

					_e( 'Weight', 'woocommerce' )

				echo beans_close_markup( 'woo_single_attributes_weight_heading', 'th' );

				echo beans_open_markup( 'woo_single_attributes_weight_value', 'td', array( 'class' => 'product_height' ) );

					echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) );

				echo beans_close_markup( 'woo_single_attributes_weight_value', 'td' );

			echo beans_close_markup( 'woo_single_attributes_weight_row', 'tr' );

		endif;

		if ( $product->has_dimensions() ) : $has_row = true;

			echo beans_open_markup( 'woo_single_attributes_dimensions_row', 'tr', array(
				if ( ( $alt = $alt * -1 ) == 1 )
				'class' => 'alt'
			) );

				echo beans_open_markup( 'woo_single_attributes_dimensions_heading', 'th' );

					_e( 'Dimensions', 'woocommerce' )

				echo beans_close_markup( 'woo_single_attributes_dimensions_heading', 'th' );

				echo beans_open_markup( 'woo_single_attributes_dimensions_value', 'td', array( 'class' => 'product_dimensions' ) );

					echo $product->get_dimensions();

				echo beans_close_markup( 'woo_single_attributes_dimensions_value', 'td' );

			echo beans_close_markup( 'woo_single_attributes_weight_row', 'tr' );

		endif;

	endif;

	foreach ( $attributes as $attribute ) :

		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) :

			continue;

		else :

			$has_row = true;

		endif;

	echo beans_open_markup( 'woo_single_attributes_terms_row', 'tr', array(
		if ( ( $alt = $alt * -1 ) == 1 )
		'class' => 'alt'
	) );

		echo beans_open_markup( 'woo_single_attributes_terms_heading', 'th' );

			echo wc_attribute_label( $attribute['name'] );

		echo beans_close_markup( 'woo_single_attributes_terms_heading', 'th' );

		echo beans_open_markup( 'woo_single_attributes_terms_value', 'td', array( 'class' => 'product_dimensions' ) );

				if ( $attribute['is_taxonomy'] ) :

					$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				else :

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				endif;

		echo beans_close_markup( 'woo_single_attributes_terms_value', 'td' );

		echo beans_close_markup( 'woo_single_attributes_terms_row', 'tr' );

	endforeach;

echo beans_close_markup( 'woo_single_attributes_table', 'table' );

if ( $has_row ) :

	echo ob_get_clean();

else :

	ob_end_clean();

endif;
