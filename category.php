<?php
/**
 * Category archive: breadcrumb, hero spotlight, text grid, then a
 * "read more" list for the rest, with recent/popular tabs in the sidebar.
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

		<?php bdcnd_breadcrumb(); ?>

		<?php if ( have_posts() ) : ?>

			<?php
			$bdcnd_ids = array();
			while ( have_posts() ) {
				the_post();
				$bdcnd_ids[] = get_the_ID();
			}
			$bdcnd_hero_ids = array_slice( $bdcnd_ids, 0, 5 );
			$bdcnd_grid_ids = array_slice( $bdcnd_ids, 5, 6 );
			$bdcnd_more_ids = array_slice( $bdcnd_ids, 11 );
			?>

			<?php if ( ! empty( $bdcnd_hero_ids ) ) : ?>
				<?php $bdcnd_main_id = array_shift( $bdcnd_hero_ids ); ?>
				<div class="bdcnd-hero-flex">
					<div class="bdcnd-hero-main">
						<a href="<?php echo esc_url( get_permalink( $bdcnd_main_id ) ); ?>"><?php bdcnd_the_thumb( $bdcnd_main_id, 'bdcnd-hero' ); ?></a>
						<h1><a href="<?php echo esc_url( get_permalink( $bdcnd_main_id ) ); ?>"><?php echo esc_html( get_the_title( $bdcnd_main_id ) ); ?></a></h1>
						<p><?php bdcnd_excerpt( $bdcnd_main_id, 22 ); ?></p>
					</div>
					<?php if ( ! empty( $bdcnd_hero_ids ) ) : ?>
						<div class="bdcnd-hero-list">
							<?php foreach ( $bdcnd_hero_ids as $bdcnd_id ) : ?>
								<div class="bdcnd-mini-item">
									<a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php bdcnd_the_thumb( $bdcnd_id, 'bdcnd-mini' ); ?></a>
									<h4><a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php echo esc_html( get_the_title( $bdcnd_id ) ); ?></a></h4>
								</div>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $bdcnd_grid_ids ) ) : ?>
				<div class="bdcnd-sec-box">
					<div class="bdcnd-text-grid">
						<?php foreach ( $bdcnd_grid_ids as $bdcnd_id ) : ?>
							<div class="bdcnd-ti-item">
								<a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php bdcnd_the_thumb( $bdcnd_id, 'bdcnd-list' ); ?></a>
								<h4><a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php echo esc_html( get_the_title( $bdcnd_id ) ); ?></a></h4>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $bdcnd_more_ids ) ) : ?>
				<div class="bdcnd-readmore-list">
					<?php foreach ( $bdcnd_more_ids as $bdcnd_id ) : ?>
						<div class="bdcnd-readmore-item">
							<a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php bdcnd_the_thumb( $bdcnd_id, 'bdcnd-mini' ); ?></a>
							<div class="bdcnd-readmore-body">
								<h4><a href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php echo esc_html( get_the_title( $bdcnd_id ) ); ?></a></h4>
								<a class="bdcnd-readmore-btn" href="<?php echo esc_url( get_permalink( $bdcnd_id ) ); ?>"><?php esc_html_e( 'বিস্তারিত', 'bdc-news-desk' ); ?></a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php bdcnd_pagination(); ?>

		<?php else : ?>
			<div class="bdcnd-sec-box"><p style="padding:16px;"><?php esc_html_e( 'কোনো সংবাদ পাওয়া যায়নি।', 'bdc-news-desk' ); ?></p></div>
		<?php endif; ?>

	</div>

	<?php get_template_part( 'template-parts/sidebar-category' ); ?>
</div>
<?php
get_footer();
