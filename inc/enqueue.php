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
 * Enqueue front-end assets.
 */
function bdcnd_enqueue_assets() {
	wp_enqueue_style(
		'bdcnd-fonts',
		'https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;500;600;700&family=Archivo+Black&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'bdcnd-tokens', BDCND_URI . '/assets/css/design-tokens.css', array(), BDCND_VERSION );
	wp_enqueue_style( 'bdcnd-main', BDCND_URI . '/assets/css/style-main.css', array( 'bdcnd-tokens' ), BDCND_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bdcnd-main', BDCND_URI . '/assets/js/main.js', array(), BDCND_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'bdcnd_enqueue_assets' );

/**
 * Enqueue Elementor editor-preview styles so widgets match the front end.
 *
 * @param string $css_file Path to Elementor's frontend stylesheet.
 */
function bdcnd_elementor_editor_assets() {
	wp_enqueue_style( 'bdcnd-tokens', BDCND_URI . '/assets/css/design-tokens.css', array(), BDCND_VERSION );
	wp_enqueue_style( 'bdcnd-main', BDCND_URI . '/assets/css/style-main.css', array( 'bdcnd-tokens' ), BDCND_VERSION );
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
	wp_enqueue_style( 'bdcnd-admin', BDCND_URI . '/assets/css/admin.css', array(), BDCND_VERSION );
}
add_action( 'admin_enqueue_scripts', 'bdcnd_admin_assets' );
