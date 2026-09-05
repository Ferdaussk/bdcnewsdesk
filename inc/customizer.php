<?php
/**
 * Customizer: small branding strings that editors change often.
 * The site title/tagline stay on Settings -> General, as required.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the "BDC News Desk" Customizer panel.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function bdcnd_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'bdcnd_options',
		array(
			'title'    => __( 'BDC News Desk Options', 'bdc-news-desk' ),
			'priority' => 30,
		)
	);

	$fields = array(
		'bdcnd_ticker_label'      => array(
			'label'   => __( 'Breaking News Ticker Label', 'bdc-news-desk' ),
			'default' => __( 'শিরোনাম :', 'bdc-news-desk' ),
			'type'    => 'text',
		),
		'bdcnd_ad_banner_text'    => array(
			'label'   => __( 'Top Ad Banner Text', 'bdc-news-desk' ),
			'default' => __( 'আপনার প্রতিষ্ঠানের বিশ্বব্যাপী প্রচারের জন্য বিজ্ঞাপন দিন', 'bdc-news-desk' ),
			'type'    => 'text',
		),
		'bdcnd_footer_editor'     => array(
			'label'   => __( 'Footer: Editor Name', 'bdc-news-desk' ),
			'default' => '',
			'type'    => 'text',
		),
		'bdcnd_footer_email'      => array(
			'label'   => __( 'Footer: Contact Email', 'bdc-news-desk' ),
			'default' => get_option( 'admin_email' ),
			'type'    => 'text',
		),
		'bdcnd_footer_rights'     => array(
			'label'   => __( 'Footer: Rights Notice', 'bdc-news-desk' ),
			'default' => __( 'এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার করা যাবে না।', 'bdc-news-desk' ),
			'type'    => 'text',
		),
		'bdcnd_facebook_url'      => array(
			'label'   => __( 'Facebook Page URL', 'bdc-news-desk' ),
			'default' => '',
			'type'    => 'url',
		),
	);

	foreach ( $fields as $id => $field ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $field['default'],
				'sanitize_callback' => 'url' === $field['type'] ? 'esc_url_raw' : 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $field['label'],
				'section' => 'bdcnd_options',
				'type'    => $field['type'],
			)
		);
	}

	$wp_customize->add_setting(
		'bdcnd_mobile_logo',
		array(
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'bdcnd_mobile_logo',
			array(
				'label'       => __( 'Mobile Logo (optional)', 'bdc-news-desk' ),
				'description' => __( 'Shown on small screens instead of the main logo. Leave empty to reuse the main logo.', 'bdc-news-desk' ),
				'section'     => 'bdcnd_options',
			)
		)
	);
}
add_action( 'customize_register', 'bdcnd_customize_register' );
