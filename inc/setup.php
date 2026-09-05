<?php
/**
 * Core theme setup: supports, menus, sidebars, image sizes.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup.
 */
function bdcnd_setup() {
	load_theme_textdomain( 'bdc-news-desk', BDCND_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'responsive-embeds' );

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 60,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	// Elementor compatibility flags.
	add_theme_support( 'align-wide' );

	set_post_thumbnail_size( 700, 400, true );
	add_image_size( 'bdcnd-hero', 700, 300, true );
	add_image_size( 'bdcnd-feature', 500, 300, true );
	add_image_size( 'bdcnd-medium', 300, 150, true );
	add_image_size( 'bdcnd-thumb', 200, 150, true );
	add_image_size( 'bdcnd-mini', 100, 80, true );
	add_image_size( 'bdcnd-list', 70, 50, true );

	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary Menu', 'bdc-news-desk' ),
			'footer'  => esc_html__( 'Footer Menu', 'bdc-news-desk' ),
		)
	);
}
add_action( 'after_setup_theme', 'bdcnd_setup' );

/**
 * Register widget areas.
 */
function bdcnd_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Homepage Sidebar', 'bdc-news-desk' ),
			'id'            => 'bdcnd-sidebar-home',
			'description'   => esc_html__( 'Widgets shown in the right-hand rail of the homepage.', 'bdc-news-desk' ),
			'before_widget' => '<div id="%1$s" class="bdcnd-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="bdcnd-widget-header">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Article Sidebar', 'bdc-news-desk' ),
			'id'            => 'bdcnd-sidebar-article',
			'description'   => esc_html__( 'Widgets shown next to single posts and archive pages.', 'bdc-news-desk' ),
			'before_widget' => '<div id="%1$s" class="bdcnd-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="bdcnd-widget-header">',
			'after_title'   => '</div>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets', 'bdc-news-desk' ),
			'id'            => 'bdcnd-footer',
			'description'   => esc_html__( 'Optional widgets shown above the footer bottom bar.', 'bdc-news-desk' ),
			'before_widget' => '<div id="%1$s" class="bdcnd-footer-widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="bdcnd-footer-widget-title">',
			'after_title'   => '</div>',
		)
	);
}
add_action( 'widgets_init', 'bdcnd_widgets_init' );

/**
 * Content width for embeds/oEmbeds.
 */
function bdcnd_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'bdcnd_content_width', 900 );
}
add_action( 'after_setup_theme', 'bdcnd_content_width', 0 );
