<?php
/**
 * 404 error page.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<div class="bdcnd-404">
	<h1>404</h1>
	<p><?php esc_html_e( 'দুঃখিত, আপনি যে পাতাটি খুঁজছেন তা পাওয়া যায়নি।', 'bdc-news-desk' ); ?></p>
	<form class="bdcnd-search-block" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="bdcnd-404-s"><?php esc_html_e( 'Search', 'bdc-news-desk' ); ?></label>
		<input type="text" id="bdcnd-404-s" name="s" placeholder="<?php esc_attr_e( 'লিখুন...', 'bdc-news-desk' ); ?>">
		<button type="submit"><?php esc_html_e( 'খুঁজুন', 'bdc-news-desk' ); ?></button>
	</form>
</div>
<?php
get_footer();
