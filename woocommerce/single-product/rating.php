<?php
/**
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     2.3.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) :

	return;

endif;

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = $product->get_average_rating();

if ( $rating_count > 0 ) :

	echo beans_open_markup( 'woo_single_rating_wrap', 'div', array(
		'class' => 'woocommerce-product-rating',
		'itemprop' => 'aggregateRating',
		'itemscope' => '',
		'itemtype' => 'http://schema.org/AggregateRating'
	) );

		echo beans_open_markup( 'woo_single_rating_stars', 'div', array(
			'class' => 'star-rating',
			'title' => printf( __( 'Rated %s out of 5', 'woocommerce' ), $average )
		) );

			echo beans_open_markup( 'woo_single_rating_stars_item', 'span', array( 'style' => 'width:' . ( ( $average / 5 ) * 100 ) . '%' ) );

				echo beans_open_markup( 'woo_single_rating_stars_item_value', 'strong', array(
					'itemprop' => 'ratingValue',
					'class' => 'rating'
				) );

					echo esc_html( $average );

				echo beans_close_markup( 'woo_single_rating_stars_item_value', 'strong' );

				printf( __( 'out of %s5%s', 'woocommerce' ), '<span itemprop="bestRating">', '</span>' );

				printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'woocommerce' ), beans_open_markup( 'woo_single_rating_count', 'span', array(
					'itemprop' => 'ratingCount',
					'class' => 'rating'
				) ) . $rating_count . beans_close_markup( 'woo_single_rating_count', 'span' ) );

			echo beans_close_markup( 'woo_single_rating_stars_item', 'span' );

		echo beans_close_markup( 'woo_single_rating_stars', 'div' );

		if ( comments_open() ) :

			echo beans_open_markup( 'woo_single_rating_review_link', 'a', array(
				'href' => '#reviews',
				'class' => 'woocommerce-review-link uk-margin-small-left',
				'rel' => 'nofollow'
			) );

			(printf( _n( '%s customer review', '%s customer reviews', $review_count, 'woocommerce' ), beans_open_markup( 'woo_single_review_count', 'span', array(
				'itemprop' => 'reviewCount',
				'class' => 'review'
			) ) . $review_count . beans_close_markup( 'woo_single_review_count', 'span' ) ) );

			echo beans_close_markup( 'woo_single_rating_review_link', 'a' );

		endif;

	echo beans_close_markup( 'woo_single_rating_wrap', 'div' );

endif;
