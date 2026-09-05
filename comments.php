<?php
/**
 * Comments template.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="bdcnd-comments-wrap">

	<?php if ( have_comments() ) : ?>
		<h2 class="bdcnd-comments-title">
			<?php
			printf(
				/* translators: %s: number of comments */
				esc_html( _n( '%s টি মন্তব্য', '%s টি মন্তব্য', get_comments_number(), 'bdc-news-desk' ) ),
				esc_html( bdcnd_bn_number( get_comments_number() ) )
			);
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
				)
			);
			?>
		</ol>
		<?php the_comments_pagination(); ?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="bdcnd-comments-closed"><?php esc_html_e( 'মন্তব্য বন্ধ রয়েছে।', 'bdc-news-desk' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'title_reply' => esc_html__( 'মন্তব্য করুন', 'bdc-news-desk' ),
			'label_submit' => esc_html__( 'মন্তব্য পাঠান', 'bdc-news-desk' ),
		)
	);
	?>
</div>
