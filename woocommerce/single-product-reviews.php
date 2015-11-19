<?php
/**
 * Display single product reviews (comments)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.2
 */
global $product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! comments_open() ) :

	return;

endif;

?>
<?php echo beans_open_markup( 'woo_single_reviews_wrap', 'div', array( 'id' => 'reviews' ) ); ?>

	<?php echo beans_open_markup( 'woo_single_reviews_comments_wrap', 'div', array( 'id' => 'comments' ) ); ?>

		<?php echo beans_open_markup( 'woo_single_reviews_title', 'h2' ); ?>

			<?php if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) )

					printf( _n( '%s review for %s', '%s reviews for %s', $count, 'woocommerce' ), $count, get_the_title() );

				else :

					_e( 'Reviews', 'woocommerce' );

				endif; ?>

		<?php echo beans_close_markup( 'woo_single_reviews_title', 'h2' ); ?>

		<?php if ( have_comments() ) : ?>

			<?php echo beans_open_markup( 'woo_single_reviews_comment_list', 'ol', array( 'class' => 'commentlist' ) ); ?>

				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>

			<?php echo beans_close_markup( 'woo_single_reviews_comment_list', 'ol' ); ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>

				<?php echo beans_open_markup( 'woo_single_reviews_pagination', 'nav', array( 'class' => 'woocommerce-pagination' ) ); ?>

					<?php paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
						'prev_text' => '&larr;',
						'next_text' => '&rarr;',
						'type'      => 'list',
					) ) ); ?>

				<?php echo beans_close_markup( 'woo_single_reviews_pagination', 'nav' ); ?>

			<?php endif; ?>

		<?php else : ?>

			<?php echo beans_open_markup( 'woo_single_reviews_no_reviews', 'p', array( 'class' => 'woocommerce-noreviews' ) ); ?>

				<?php _e( 'There are no reviews yet.', 'woocommerce' ); ?>

			<?php echo beans_close_markup( 'woo_single_reviews_no_reviews', 'p' ); ?>

		<?php endif; ?>

	<?php echo beans_close_markup( 'woo_single_reviews_comments_wrap', 'div' ); ?>


	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<?php echo beans_open_markup( 'woo_single_reviews_form_wrap', 'div', array( 'id' => 'review_form_wrapper' ) ); ?>

			<?php echo beans_open_markup( 'woo_single_reviews_form', 'div', array( 'id' => 'review_form' ) ); ?>

				<?php $commenter = wp_get_current_commenter();
					#TODO Review
					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : __( 'Be the first to review', 'woocommerce' ) . ' &ldquo;' . get_the_title() . '&rdquo;',
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => beans_open_markup( 'woo_single_reviews_form_author', 'p', array( 'class' => 'comment-form-author' ) ) . beans_open_markup( 'woo_single_reviews_form_author_label', 'label', array( 'for' => 'author' ) ) . __( 'Name', 'woocommerce' ) . beans_open_markup( 'woo_single_reviews_form_required_indicator', 'span', array( 'class' => 'required' ) ) . ' * ' . beans_close_markup( 'woo_single_reviews_form_required_indicator', 'span' ) . beans_close_markup( 'woo_single_reviews_form_author_label', 'label' ) . ' '
							 . beans_selfclose_markup( 'woo_single_reviews_form_author_input', 'input', array(
							 		 'id' => 'author',
							 		 'name' => 'author',
									 'type' => 'text',
									 'value' => esc_attr( $commenter['comment_author'] ),
									 'size' => 30,
									 'aria-required' => true
							 	) ) . beans_close_markup( 'woo_single_reviews_form_author', 'p' ),
							'email' => beans_open_markup( 'woo_single_reviews_form_email', 'p', array( 'class' => 'comment-form-email' ) ) . beans_open_markup( 'woo_single_reviews_form_email_label', 'label', array( 'for' => 'email' ) ) . __( 'Email', 'woocommerce' ) . beans_open_markup( 'woo_single_reviews_form_required_indicator', 'span', array( 'class' => 'required' ) ) . ' * ' . beans_close_markup( 'woo_single_reviews_form_required_indicator', 'span' ) . beans_close_markup( 'woo_single_reviews_form_email_label', 'label' ) . ' '
							 . beans_selfclose_markup( 'woo_single_reviews_form_email_input', 'input', array(
							 		 'id' => 'email',
							 		 'name' => 'email',
									 'type' => 'text',
									 'value' => esc_attr( $commenter['comment_author_email'] ),
									 'size' => 30,
									 'aria-required' => true
							 	) ) . beans_close_markup( 'woo_single_reviews_form_email', 'p' ),
							'label_submit'  => __( 'Submit', 'woocommerce' ),
							'logged_in_as'  => '',
							'comment_field' => ''
					);

					if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) :

						$comment_form['must_log_in'] = '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'woocommerce' ), esc_url( $account_page_url ) ) . '</p>';

					endif;

					if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) :

						$comment_form['comment_field'] = beans_open_markup( 'woo_single_reviews_form_rating', 'p', array( 'class' => 'comment-form-rating' ) ) . beans_open_markup( 'woo_single_reviews_form_rating_label', 'label', array( 'for' => 'rating' ) ) . __( 'Your Rating', 'woocommerce' ) . beans_close_markup( 'woo_single_reviews_form_rating_label', 'label' ) . beans_open_markup( 'woo_single_reviews_form_rating_select', 'select', array(
							'name' => 'rating',
							'id' => 'rating' ) ) ?>
							<option value="">' . __( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . __( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . __( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . __( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . __( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . __( 'Very Poor', 'woocommerce' ) . '</option>
						<?php beans_close_markup( 'woo_single_reviews_form_rating_select', 'select') . beans_close_markup( 'woo_single_reviews_form_rating', 'p');

					endif;

					$comment_form['comment_field'] .= beans_open_markup( 'woo_single_reviews_form_comment', 'p', array( 'class' => 'comment-form-comment' ) ) . beans_open_markup( 'woo_single_reviews_form_comment_label', 'label', array( 'for' => 'comment' ) ) . __( 'Your Review', 'woocommerce' ) . beans_close_markup( 'woo_single_reviews_form_comment_label', 'label' ) . beans_open_markup( 'woo_single_reviews_form_rating_textarea', 'select', array(
						'id' => 'comment',
						'name' => 'comment',
						'cols' => 45,
						'rows' => 8,
						'aria-required' => true
					) ) . beans_close_markup( 'woo_single_reviews_form_rating_textarea', 'textarea') . beans_close_markup( 'woo_single_reviews_form_comment', 'p');

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) ); ?>

				<?php echo beans_close_markup( 'woo_single_reviews_form', 'div' ); ?>

			<?php echo beans_close_markup( 'woo_single_reviews_form_wrap', 'div' ); ?>

	<?php else : ?>

		<?php echo beans_open_markup( 'woo_single_reviews_verification_required', 'p', array( 'class' => 'woocommerce-verification-required' ) ); ?>

			<?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?>

		<?php echo beans_close_markup( 'woo_single_reviews_verification_required', 'p' ); ?>

	<?php endif; ?>

	<?php echo beans_open_markup( 'woo_single_reviews_clear', 'div', array( 'class' => 'clear' ) ); ?>

		<?php _e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?>

	<?php echo beans_close_markup( 'woo_single_reviews_clear', 'div' ); ?>

<?php echo beans_close_markup( 'woo_single_reviews_wrap', 'div' ); ?>
