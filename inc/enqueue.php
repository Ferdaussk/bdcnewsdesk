<?php
/**
 * Styles and scripts.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Cache-busting version string for a theme asset: the file's own last
 * modified time. Browsers (and the host's page cache) only treat a file as
 * "new" when its URL changes, so a static BDCND_VERSION would mean every
 * CSS/JS edit silently keeps serving the previously cached file. Falls back
 * to BDCND_VERSION if the file can't be found on disk (e.g. a remote URL).
 *
 * @param string $relative_path Path relative to the theme root, e.g. '/assets/css/style-main.css'.
 * @return string
 */
function bdcnd_asset_version( $relative_path ) {
	$file = BDCND_DIR . $relative_path;
	return file_exists( $file ) ? (string) filemtime( $file ) : BDCND_VERSION;
}

/**
 * Enqueue front-end assets.
 */
function bdcnd_enqueue_assets() {
	wp_enqueue_style(
		'bdcnd-fonts',
		'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&family=Archivo+Black&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'bdcnd-tokens', BDCND_URI . '/assets/css/design-tokens.css', array(), bdcnd_asset_version( '/assets/css/design-tokens.css' ) );
	wp_enqueue_style( 'bdcnd-main', BDCND_URI . '/assets/css/style-main.css', array( 'bdcnd-tokens' ), bdcnd_asset_version( '/assets/css/style-main.css' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bdcnd-main', BDCND_URI . '/assets/js/main.js', array(), bdcnd_asset_version( '/assets/js/main.js' ), true );
}
add_action( 'wp_enqueue_scripts', 'bdcnd_enqueue_assets' );

/**
 * Enqueue Elementor editor-preview styles so widgets match the front end.
 *
 * @param string $css_file Path to Elementor's frontend stylesheet.
 */
function bdcnd_elementor_editor_assets() {
	wp_enqueue_style( 'bdcnd-tokens', BDCND_URI . '/assets/css/design-tokens.css', array(), bdcnd_asset_version( '/assets/css/design-tokens.css' ) );
	wp_enqueue_style( 'bdcnd-main', BDCND_URI . '/assets/css/style-main.css', array( 'bdcnd-tokens' ), bdcnd_asset_version( '/assets/css/style-main.css' ) );
}
add_action( 'elementor/editor/after_enqueue_styles', 'bdcnd_elementor_editor_assets' );

/**
 * Admin dashboard page assets.
 *
 * @param string $hook Current admin page hook.
 */
function bdcnd_admin_assets( $hook ) {
	if ( 'appearance_page_bdc-news-desk' !== $hook ) {
		return;
	}
	wp_enqueue_style( 'bdcnd-admin', BDCND_URI . '/assets/css/admin.css', array(), bdcnd_asset_version( '/assets/css/admin.css' ) );
}
add_action( 'admin_enqueue_scripts', 'bdcnd_admin_assets' );
