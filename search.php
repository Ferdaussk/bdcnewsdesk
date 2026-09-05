<?php
/**
 * Search results.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="bdcnd-content-layout">
	<div class="bdcnd-main-col">
		<div class="bdcnd-archive-header">
			<h1>
				<?php
				printf(
					/* translators: %s: search query */
					esc_html__( '"%s" এর অনুসন্ধান ফলাফল', 'bdc-news-desk' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>
		</div>
		<?php if ( have_posts() ) : ?>
			<div class="bdcnd-archive-list">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content-card' );
				endwhile;
				?>
			</div>
			<?php bdcnd_pagination(); ?>
		<?php else : ?>
			<div class="bdcnd-sec-box"><p style="padding:16px;"><?php esc_html_e( 'কোনো ফলাফল পাওয়া যায়নি। ভিন্ন শব্দ দিয়ে চেষ্টা করুন।', 'bdc-news-desk' ); ?></p></div>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
