<?php
/**
 * Elementor widget: branded navy section header bar.
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Section Header widget.
 */
class Widget_Section_Header extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bdcnd-section-header';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'BDCND Section Header', 'bdc-news-desk' );
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
				'label'   => __( 'Title', 'bdc-news-desk' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'বাংলাদেশ', 'bdc-news-desk' ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link (optional "see more")', 'bdc-news-desk' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'https://your-site.com/category/bangladesh/',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="bdcnd-sec-header">
			<span class="bdcnd-ico"></span>
			<?php echo esc_html( $settings['title'] ); ?>
			<?php if ( ! empty( $settings['link']['url'] ) ) : ?>
				<a href="<?php echo esc_url( $settings['link']['url'] ); ?>" style="margin-left:auto;font-size:11px;font-weight:400;">
					<?php esc_html_e( 'আরো..', 'bdc-news-desk' ); ?> &raquo;
				</a>
			<?php endif; ?>
		</div>
		<?php
	}
}
