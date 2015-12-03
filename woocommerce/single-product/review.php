<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

echo beans_open_markup( 'woo_single_review_item', 'li', array(
	'itemprop' => 'review',
	'itemscope' => '',
	'itemtype' => 'http://schema.org/Review',
	'id' => 'li-comment-' . comment_ID()
) );

	echo beans_open_markup( 'woo_single_review_item_comment_wrap', 'div', array(
		'id' => 'comment-' . comment_ID(),
		'class' => 'comment_container'
	) );

		echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '' );

		echo beans_open_markup( 'woo_single_review_item_comment_text', 'div', array( 'class' => 'comment-text' ) );

			if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) :

				echo beans_open_markup( 'woo_single_review_item_comment_rating_wrap', 'div', array(
					'itemprop' => 'reviewRating',
					'itemscope' => '',
					'itemtype' => 'http://schema.org/Rating',
					'class' => 'star-rating',
					'title' => sprintf( __( 'Rated %d out of 5', 'woocommerce' ), $rating )
				) );

					echo beans_open_markup( 'woo_single_review_item_comment_rating_indicator', 'span', array(
						'style' => 'width:' . ( $rating / 5 ) * 100 . '%'
						) );

						echo beans_open_markup( 'woo_single_review_item_comment_value', 'strong', array( 'itemprop' => 'ratingValue' ) );

							echo $rating;

						echo beans_close_markup( 'woo_single_review_item_comment_value', 'strong' );

						_e( 'out of 5', 'woocommerce' );

					echo beans_close_markup( 'woo_single_review_item_comment_rating_indicator', 'span' );

				echo beans_close_markup( 'woo_single_review_item_comment_rating_wrap', 'div' );

			endif;

			if ( $comment->comment_approved == '0' ) :

				echo beans_open_markup( 'woo_single_review_item_comment_meta', 'p', array( 'class' => 'meta' ) );

					echo beans_open_markup( 'woo_single_review_item_comment_meta_emphasis', 'em' );

						_e( 'Your comment is awaiting approval', 'woocommerce' );

						echo beans_close_markup( 'woo_single_review_item_comment_meta_emphasis', 'em' );

				echo beans_close_markup( 'woo_single_review_item_comment_meta', 'p' );

			else :

				echo beans_open_markup( 'woo_single_review_item_comment_meta_author', 'p', array( 'class' => 'meta' ) );

					echo beans_open_markup( 'woo_single_review_item_comment_meta_author_name', 'strong', array( 'itemprop' => 'author' ) );

						comment_author();

					echo beans_close_markup( 'woo_single_review_item_comment_meta_author_name', 'strong' );

						if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' ) :

							if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) ) :

								echo beans_open_markup( 'woo_single_review_item_comment_verified_badge', 'em', array( 'class' => 'verified' ) );

									echo '(' . __( 'verified owner', 'woocommerce' ) . ')';

								echo beans_close_markup( 'woo_single_review_item_comment_verified_badge', 'em' );

							endif;

						endif;

					echo '&ndash;' . beans_open_markup( 'woo_single_review_item_comment_verified_badge', 'time', array(
						'itemprop' => 'datePublished',
						'datetime' => get_comment_date( 'c' )
					) ) . get_comment_date( wc_date_format() ) . beans_close_markup( 'woo_single_review_item_comment_verified_badge', 'time' );

				echo beans_close_markup( 'woo_single_review_item_comment_meta_author', 'p' );

			endif;

			echo beans_open_markup( 'woo_single_review_item_description', 'div', array( 'itemprop' => 'description', 'class' => 'description' ) ) . comment_text() . beans_close_markup( 'woo_single_review_item_description', 'div' );

		echo beans_close_markup( 'woo_single_review_item_comment_text', 'div' );

	echo beans_close_markup( 'woo_single_review_item_comment_wrap', 'div' );
