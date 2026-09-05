<?php
/**
 * Fallback template.
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
			<h1><?php esc_html_e( 'সর্বশেষ সংবাদ', 'bdc-news-desk' ); ?></h1>
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
			<div class="bdcnd-sec-box"><p style="padding:16px;"><?php esc_html_e( 'কোনো সংবাদ পাওয়া যায়নি।', 'bdc-news-desk' ); ?></p></div>
		<?php endif; ?>
	</div>

	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
