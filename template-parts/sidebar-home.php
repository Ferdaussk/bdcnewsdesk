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

	<?php if ( bdcnd_sidebar_has_real_widgets( 'bdcnd-sidebar-home' ) ) : ?>

		<?php dynamic_sidebar( 'bdcnd-sidebar-home' ); ?>

	<?php else : ?>

		<div class="bdcnd-widget">
			<div class="bdcnd-widget-header"><?php esc_html_e( 'ফেসবুক পেজ', 'bdc-news-desk' ); ?></div>
			<div class="bdcnd-widget-header"><?php esc_html_e( 'আর্কাইভ', 'bdc-news-desk' ); ?></div>
			<form class="bdcnd-search-block bdcnd-sd-search-block" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label class="screen-reader-text" for="bdcnd-s"><?php esc_html_e( 'Search', 'bdc-news-desk' ); ?></label>
				<input type="text" id="bdcnd-s" name="s" placeholder="<?php esc_attr_e( 'লিখুন...', 'bdc-news-desk' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
				<button type="submit"><?php esc_html_e( 'খুঁজুন', 'bdc-news-desk' ); ?></button>
			</form>
		</div>

		<div class="bdcnd-widget">
			<div class="bdcnd-tab-row">
				<div class="bdcnd-tab bdcnd-active" data-tab="recent"><?php esc_html_e( 'সাম্প্রতিক', 'bdc-news-desk' ); ?></div>
				<div class="bdcnd-tab" data-tab="popular"><?php esc_html_e( 'জনপ্রিয়', 'bdc-news-desk' ); ?></div>
			</div>
			<div class="bdcnd-widget-body">
				<?php
				$recent = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 12,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);
				if ( $recent->have_posts() ) :
					?>
					<ul class="bdcnd-recent-list" data-tab-panel="recent">
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

				$popular = bdcnd_most_read_query( 12 );
				if ( $popular->have_posts() ) :
					?>
					<ul class="bdcnd-recent-list" data-tab-panel="popular" hidden>
						<?php
						while ( $popular->have_posts() ) :
							$popular->the_post();
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
