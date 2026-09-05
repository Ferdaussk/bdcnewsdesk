<?php
/**
 * Generic sidebar for single posts, pages, archives and search results.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bdcnd-side-col">
	<?php if ( is_active_sidebar( 'bdcnd-sidebar-article' ) ) : ?>
		<?php dynamic_sidebar( 'bdcnd-sidebar-article' ); ?>
	<?php else : ?>
		<?php bdcnd_sidebar_most_read( __( 'সর্বাধিক পঠিত', 'bdc-news-desk' ) ); ?>
		<div class="bdcnd-widget">
			<div class="bdcnd-widget-body">
				<div class="bdcnd-side-ad"><?php echo esc_html( get_theme_mod( 'bdcnd_ad_banner_text', __( 'আপনার প্রতিষ্ঠানের বিশ্বব্যাপী প্রচারের জন্য বিজ্ঞাপন দিন', 'bdc-news-desk' ) ) ); ?></div>
			</div>
		</div>
	<?php endif; ?>
</div>
