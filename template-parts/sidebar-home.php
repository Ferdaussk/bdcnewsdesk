<?php
/**
 * Homepage sidebar rail. Uses widgets added to "Homepage Sidebar" if any
 * exist; otherwise falls back to a sensible default set of blocks so the
 * homepage looks complete immediately after theme activation.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bdcnd-side-col">

	<?php if ( is_active_sidebar( 'bdcnd-sidebar-home' ) ) : ?>

		<?php dynamic_sidebar( 'bdcnd-sidebar-home' ); ?>

	<?php else : ?>

		<?php $fb_url = get_theme_mod( 'bdcnd_facebook_url' ); ?>
		<div class="bdcnd-widget">
			<div class="bdcnd-widget-header"><?php esc_html_e( 'ফেসবুক পেজ', 'bdc-news-desk' ); ?></div>
			<div class="bdcnd-widget-body">
				<div class="bdcnd-fb-embed">
					<div class="bdcnd-fb-title"><?php bloginfo( 'name' ); ?></div>
					<div><?php bloginfo( 'description' ); ?></div>
					<?php if ( $fb_url ) : ?>
						<a class="bdcnd-fb-btn" href="<?php echo esc_url( $fb_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Like Page', 'bdc-news-desk' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="bdcnd-widget">
			<div class="bdcnd-widget-header"><?php esc_html_e( 'সাম্প্রতিক', 'bdc-news-desk' ); ?></div>
			<div class="bdcnd-widget-body">
				<?php
				$recent = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 6,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);
				if ( $recent->have_posts() ) :
					?>
					<ul class="bdcnd-recent-list">
						<?php
						while ( $recent->have_posts() ) :
							$recent->the_post();
							?>
							<li>
								<?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-list' ); ?>
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
							</li>
						<?php endwhile; ?>
					</ul>
					<?php
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>

		<?php bdcnd_sidebar_feature_block( 'probash', 'probash', __( 'প্রবাস', 'bdc-news-desk' ) ); ?>

		<?php bdcnd_sidebar_most_read( __( 'সর্বাধিক পঠিত', 'bdc-news-desk' ) ); ?>

		<div class="bdcnd-widget">
			<div class="bdcnd-widget-body">
				<div class="bdcnd-side-ad"><?php echo esc_html( get_theme_mod( 'bdcnd_ad_banner_text', __( 'আপনার প্রতিষ্ঠানের বিশ্বব্যাপী প্রচারের জন্য বিজ্ঞাপন দিন', 'bdc-news-desk' ) ) ); ?></div>
			</div>
		</div>

	<?php endif; ?>

</div>
