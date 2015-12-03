<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.14
 */

 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

echo beans_open_markup( 'woo_product_single_images_wrap', 'div', array( 'class' => 'images' ) );

	if ( has_post_thumbnail() ) :

		$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
		$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
		$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title'	=> $image_title,
			'alt'	=> $image_title
		) );

		$attachment_count = count( $product->get_gallery_attachment_ids() );

		if ( $attachment_count > 0 ) :

			$gallery = '[product-gallery]';

		else :

			$gallery = '';

		endif;

		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( beans_open_markup( 'woo_product_single_images_wrap_link', 'a', array(
			'href' => '%s',
			'itemprop' => 'image',
			'class' => 'woocommerce-main-image zoom',
			'title' => '%s',
			'data-rel' => 'prettyPhoto' . $gallery
		) ) . '%s' . beans_close_markup( 'woo_product_single_images_wrap_link', 'a' ), $image_link, $image_caption, $image ), $post->ID );

	else :

		echo apply_filters( 'woocommerce_single_product_image_html', sprintf( beans_selfclose_markup( 'woo_product_single_images_wrap_image', 'img', array(
			'src' => '%s',
			'alt' => '%s' ) ), wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

	endif;

	do_action( 'woocommerce_product_thumbnails' );

echo beans_close_markup( 'woo_product_single_images_wrap', 'div' );
