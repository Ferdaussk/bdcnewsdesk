<?php
/**
 * Shared base for BDC News Desk Elementor widgets.
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Common helpers for the branded widget set.
 */
abstract class Widget_Base extends \Elementor\Widget_Base {

	/**
	 * Widget category slug shared by every BDC News Desk widget.
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'bdc-news-desk' );
	}

	/**
	 * Widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-newspaper';
	}

	/**
	 * Keywords so the widget is easy to find in the Elementor panel search.
	 *
	 * @return array
	 */
	public function get_keywords() {
		return array( 'news', 'bdc', 'bdcnd', 'article', 'post' );
	}

	/**
	 * Category <select> options built from published categories.
	 *
	 * @return array term_id => name
	 */
	protected function category_options() {
		$options = array( 0 => __( 'সকল বিভাগ (All Categories)', 'bdc-news-desk' ) );
		$terms   = get_categories( array( 'hide_empty' => false ) );
		foreach ( $terms as $term ) {
			$options[ $term->term_id ] = $term->name;
		}
		return $options;
	}
}
