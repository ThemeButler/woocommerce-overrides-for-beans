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

$has_row    = false;
$alt        = 1;
$attributes = $product->get_attributes();

ob_start();

beans_open_markup( 'woo_product_single_shop_attributes_table', 'table', array( 'class' => 'shop_attributes' ) );

	if ( $product->enable_dimensions_display() ) :

		if ( $product->has_weight() ) : $has_row = true;

			beans_open_markup( 'woo_product_single_shop_attributes_table_row_weight', 'tr', array( 'class' => 'shop_attributes' . ( ( $alt = $alt * -1 ) == 1 ) ? ' alt' ) );

				beans_open_markup( 'woo_product_single_shop_attributes_table_row_weight_heading', 'th' );

					_e( 'Weight', 'woocommerce' );

				beans_close_markup( 'woo_product_single_shop_attributes_table_row_weight_heading', 'th' );

				beans_open_markup( 'woo_product_single_shop_attributes_table_row_weight_heading', 'td', array( 'class' => 'product_weight' ) );

					echo $product->get_weight() . ' ' . esc_attr( get_option( 'woocommerce_weight_unit' ) );

				beans_close_markup( 'woo_product_single_shop_attributes_table_row_weight_heading', 'td' );

			beans_close_markup( 'woo_product_single_shop_attributes_table_row_weight', 'tr' );

		endif;

		if ( $product->has_dimensions() ) : $has_row = true;

			beans_open_markup( 'woo_product_single_shop_attributes_table_row_dimensions', 'tr', array( 'class' => ( ( $alt = $alt * -1 ) == 1 ) ? 'alt' ) );

				beans_open_markup( 'woo_product_single_shop_attributes_table_row_dimensions_heading', 'th' );

					_e( 'Dimensions', 'woocommerce' );

				beans_close_markup( 'woo_product_single_shop_attributes_table_row_dimensions_heading', 'th' );

				beans_open_markup( 'woo_product_single_shop_attributes_table_row_quantity_value', 'td', array( 'class' => 'product_dimensions' ) );

					echo $product->get_dimensions();

				beans_close_markup( 'woo_product_single_shop_attributes_table_row_quantity_value', 'td' );

			beans_close_markup( 'woo_product_single_shop_attributes_table_row_dimensions', 'tr' );

		endif;

	endif;

	foreach ( $attributes as $attribute ) :

		if ( empty( $attribute['is_visible'] ) || ( $attribute['is_taxonomy'] && ! taxonomy_exists( $attribute['name'] ) ) ) :

			continue;

		else :
			$has_row = true;

		endif;

		beans_open_markup( 'woo_product_single_shop_attributes_table_row_attributes', 'tr', array( 'class' => ( ( $alt = $alt * -1 ) == 1 ) ? 'alt' ) );

			beans_open_markup( 'woo_product_single_shop_attributes_table_row_attributes_heading', 'th' );

				echo wc_attribute_label( $attribute['name'] );

			beans_close_markup( 'woo_product_single_shop_attributes_table_row_attributes_heading', 'th' );

			beans_open_markup( 'woo_product_single_shop_attributes_table_row_attributes_value', 'td' );

				if ( $attribute['is_taxonomy'] ) :

					$values = wc_get_product_terms( $product->id, $attribute['name'], array( 'fields' => 'names' ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				else :

					// Convert pipes to commas and display values
					$values = array_map( 'trim', explode( WC_DELIMITER, $attribute['value'] ) );
					echo apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values );

				endif;

			beans_close_markup( 'woo_product_single_shop_attributes_table_row_attributes_value', 'td' );

		beans_close_markup( 'woo_product_single_shop_attributes_table_row_attributes', 'tr'

	endforeach;

beans_close_markup( 'woo_product_single_shop_attributes_table', 'table' );

if ( $has_row ) :

	echo ob_get_clean();

else :

	ob_end_clean();

endif;
