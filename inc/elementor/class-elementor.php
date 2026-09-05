<?php
/**
 * Elementor integration bootstrap: branded widget category + widget
 * registration. The theme works fully without Elementor installed;
 * this file only does anything once Elementor is active.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * True when Elementor is active.
 *
 * @return bool
 */
function bdcnd_is_elementor_active() {
	return did_action( 'elementor/loaded' );
}

/**
 * Register the "BDC News Desk" Elementor widget category.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
 */
function bdcnd_register_elementor_category( $elements_manager ) {
	$elements_manager->add_category(
		'bdc-news-desk',
		array(
			'title' => __( 'BDC News Desk', 'bdc-news-desk' ),
			'icon'  => 'eicon-newspaper',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'bdcnd_register_elementor_category' );

/**
 * Register branded widgets.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 */
function bdcnd_register_elementor_widgets( $widgets_manager ) {
	require_once __DIR__ . '/widgets/class-widget-base.php';
	require_once __DIR__ . '/widgets/class-widget-section-header.php';
	require_once __DIR__ . '/widgets/class-widget-news-ticker.php';
	require_once __DIR__ . '/widgets/class-widget-news-grid.php';
	require_once __DIR__ . '/widgets/class-widget-hero.php';
	require_once __DIR__ . '/widgets/class-widget-most-read.php';

	$widgets_manager->register( new \BDCNewsDesk\Elementor\Widget_Section_Header() );
	$widgets_manager->register( new \BDCNewsDesk\Elementor\Widget_News_Ticker() );
	$widgets_manager->register( new \BDCNewsDesk\Elementor\Widget_News_Grid() );
	$widgets_manager->register( new \BDCNewsDesk\Elementor\Widget_Hero() );
	$widgets_manager->register( new \BDCNewsDesk\Elementor\Widget_Most_Read() );
}
add_action( 'elementor/widgets/register', 'bdcnd_register_elementor_widgets' );
