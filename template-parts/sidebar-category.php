<?php
/**
 * Category archive sidebar: recent/popular tabs scoped to the current
 * category, plus the site-wide most-read list and ad banner.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdcnd_term_id = get_queried_object_id();
?>
<div class="bdcnd-side-col">

	<div class="bdcnd-widget">
		<div class="bdcnd-tab-row">
			<div class="bdcnd-tab bdcnd-active" data-tab="recent"><?php esc_html_e( 'সাম্প্রতিক', 'bdc-news-desk' ); ?></div>
			<div class="bdcnd-tab" data-tab="popular"><?php esc_html_e( 'জনপ্রিয়', 'bdc-news-desk' ); ?></div>
		</div>
		<div class="bdcnd-widget-body">
			<?php
			$bdcnd_recent = bdcnd_section_query( $bdcnd_term_id, 6 );
			if ( $bdcnd_recent->have_posts() ) :
				?>
				<ul class="bdcnd-recent-list" data-tab-panel="recent">
					<?php
					while ( $bdcnd_recent->have_posts() ) :
						$bdcnd_recent->the_post();
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

			$bdcnd_popular = bdcnd_most_read_query( 6, $bdcnd_term_id );
			if ( $bdcnd_popular->have_posts() ) :
				?>
				<ul class="bdcnd-recent-list" data-tab-panel="popular" hidden>
					<?php
					while ( $bdcnd_popular->have_posts() ) :
						$bdcnd_popular->the_post();
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

	<?php bdcnd_sidebar_most_read( __( 'সর্বাধিক পঠিত', 'bdc-news-desk' ) ); ?>

	<div class="bdcnd-widget">
		<div class="bdcnd-widget-body">
			<div class="bdcnd-side-ad"><?php echo esc_html( get_theme_mod( 'bdcnd_ad_banner_text', __( 'আপনার প্রতিষ্ঠানের বিশ্বব্যাপী প্রচারের জন্য বিজ্ঞাপন দিন', 'bdc-news-desk' ) ) ); ?></div>
		</div>
	</div>

</div>
