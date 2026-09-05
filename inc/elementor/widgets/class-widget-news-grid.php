<?php
/**
 * Elementor widget: branded category news grid (reuses the same
 * renderer as the homepage template so front-end and editor stay in sync).
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Category News Grid widget.
 */
class Widget_News_Grid extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bdcnd-news-grid';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'BDCND Category News Grid', 'bdc-news-desk' );
	}

	/**
	 * Register controls.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array( 'label' => __( 'Content', 'bdc-news-desk' ) )
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Section Title', 'bdc-news-desk' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'বাংলাদেশ', 'bdc-news-desk' ),
			)
		);

		$this->add_control(
			'category',
			array(
				'label'   => __( 'Category', 'bdc-news-desk' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->category_options(),
				'default' => 0,
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Layout Style', 'bdc-news-desk' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'feature'   => __( 'Featured (main story + side list)', 'bdc-news-desk' ),
					'textgrid'  => __( 'Text Grid (3 columns, thumb + headline)', 'bdc-news-desk' ),
					'columnbox' => __( 'Column Box (image + bullet list)', 'bdc-news-desk' ),
					'thumbgrid' => __( 'Thumbnail Grid (6 cells)', 'bdc-news-desk' ),
					'joblist'   => __( 'List (small thumb + headline)', 'bdc-news-desk' ),
				),
				'default' => 'feature',
			)
		);

		$this->add_control(
			'count',
			array(
				'label'   => __( 'Number of Posts', 'bdc-news-desk' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 1,
				'max'     => 12,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$term_id = (int) $settings['category'];
		if ( ! $term_id ) {
			$term_id = (int) get_option( 'default_category' );
		}

		bdcnd_news_section(
			array(
				'term_id' => $term_id,
				'title'   => $settings['title'],
				'style'   => $settings['style'],
				'count'   => (int) $settings['count'],
			)
		);
	}
}
