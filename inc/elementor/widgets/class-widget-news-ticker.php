<?php
/**
 * Elementor widget: scrolling breaking-news ticker.
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * News Ticker widget.
 */
class Widget_News_Ticker extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bdcnd-news-ticker';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'BDCND Breaking News Ticker', 'bdc-news-desk' );
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
			'label',
			array(
				'label'   => __( 'Ticker Label', 'bdc-news-desk' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'শিরোনাম :', 'bdc-news-desk' ),
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
			'count',
			array(
				'label'   => __( 'Number of Headlines', 'bdc-news-desk' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 1,
				'max'     => 15,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => (int) $settings['count'],
			'ignore_sticky_posts' => true,
			'no_found_rows'       => true,
		);
		if ( ! empty( $settings['category'] ) ) {
			$args['cat'] = (int) $settings['category'];
		}
		$query = new \WP_Query( $args );
		if ( ! $query->have_posts() ) {
			return;
		}
		?>
		<div class="bdcnd-ticker-bar">
			<div class="bdcnd-ticker-label"><?php echo esc_html( $settings['label'] ); ?></div>
			<div class="bdcnd-ticker-track">
				<div class="bdcnd-ticker-content">
					<?php
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
}
