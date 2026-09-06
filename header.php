<?php
/**
 * Header: skip link, top bar, primary nav, breaking-news ticker.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="https://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#bdcnd-content"><?php esc_html_e( 'Skip to content', 'bdc-news-desk' ); ?></a>

<div class="bdcnd-topbar">
	<div class="bdcnd-wrap bdcnd-topbar-inner">
		<div class="bdcnd-logo-cell">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bdcnd-logo-box" rel="home">
					<span class="bdcnd-star-cluster">
						<svg viewBox="0 0 60 70" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<defs>
								<linearGradient id="bdcnd-g1" x1="0" y1="1" x2="1" y2="0">
									<stop offset="0%" stop-color="#8a8a8a"/>
									<stop offset="100%" stop-color="#fff2b0"/>
								</linearGradient>
							</defs>
							<g fill="url(#bdcnd-g1)">
								<polygon points="10,66 12,60 14,66 20,66 15,70 17,76 10,72 3,76 5,70 0,66" transform="translate(0,-10) scale(0.5)"/>
								<polygon points="18,56 21,49 24,56 31,56 25,60 28,67 21,63 14,67 17,60 11,56" transform="translate(-2,-4) scale(0.62)"/>
								<polygon points="24,42 28,33 32,42 41,42 34,47 37,56 28,51 19,56 22,47 15,42" transform="translate(0,4) scale(0.72)"/>
								<polygon points="30,26 35,15 40,26 51,26 42,32 46,43 35,37 24,43 28,32 19,26" transform="translate(2,8) scale(0.85)"/>
								<polygon points="36,8 42,-6 48,8 62,8 51,15 56,29 42,21 28,29 33,15 22,8" transform="translate(3,14) scale(1)"/>
							</g>
						</svg>
					</span>
					<span class="bdcnd-logo-text"><?php bloginfo( 'name' ); ?></span>
				</a>
			<?php endif; ?>
			<div class="bdcnd-date-line"><?php echo esc_html( wp_date( get_option( 'date_format' ) . ', ' . get_option( 'time_format' ) ) ); ?></div>
		</div>

		<form class="bdcnd-search-block" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="bdcnd-s"><?php esc_html_e( 'Search', 'bdc-news-desk' ); ?></label>
			<input type="text" id="bdcnd-s" name="s" placeholder="<?php esc_attr_e( 'লিখুন...', 'bdc-news-desk' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>">
			<button type="submit"><?php esc_html_e( 'খুঁজুন', 'bdc-news-desk' ); ?></button>
		</form>

		<?php $ad_text = get_theme_mod( 'bdcnd_ad_banner_text', __( 'আপনার প্রতিষ্ঠানের বিশ্বব্যাপী প্রচারের জন্য বিজ্ঞাপন দিন', 'bdc-news-desk' ) ); ?>
		<?php if ( $ad_text ) : ?>
			<div class="bdcnd-ad-banner"><?php echo esc_html( $ad_text ); ?></div>
		<?php endif; ?>
	</div>
</div>

<div class="bdcnd-navbar">
	<div class="bdcnd-wrap bdcnd-navbar-inner">
		<button type="button" class="bdcnd-nav-toggle" aria-expanded="false" aria-controls="bdcnd-primary-menu">
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'bdc-news-desk' ); ?></span>&#9776;
		</button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_id'        => 'bdcnd-primary-menu',
				'fallback_cb'    => false,
			)
		);
		?>
	</div>
</div>

<div class="bdcnd-wrap">
	<?php
	$ticker_query = new WP_Query(
		array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 6,
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		)
	);
	if ( $ticker_query->have_posts() ) :
		?>
		<div class="bdcnd-ticker-bar">
			<div class="bdcnd-ticker-label"><?php echo esc_html( get_theme_mod( 'bdcnd_ticker_label', __( 'শিরোনাম :', 'bdc-news-desk' ) ) ); ?></div>
			<div class="bdcnd-ticker-track">
				<div class="bdcnd-ticker-content">
					<?php
					while ( $ticker_query->have_posts() ) :
						$ticker_query->the_post();
						?>
						<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	endif;
	?>
</div>

<div id="bdcnd-content" class="bdcnd-wrap">
