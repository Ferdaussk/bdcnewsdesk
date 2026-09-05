<?php
/**
 * Elementor widget: ranked "most read" list.
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Most Read widget.
 */
class Widget_Most_Read extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bdcnd-most-read';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'BDCND Most Read', 'bdc-news-desk' );
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
				'default' => __( 'সর্বাধিক পঠিত', 'bdc-news-desk' ),
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
				'label'   => __( 'Number of Posts', 'bdc-news-desk' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
				'min'     => 1,
				'max'     => 10,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$query    = bdcnd_most_read_query( (int) $settings['count'], (int) $settings['category'] );

		if ( ! $query->have_posts() ) {
			return;
		}
		?>
		<div class="bdcnd-widget">
			<div class="bdcnd-widget-header"><?php echo esc_html( $settings['title'] ); ?></div>
			<div class="bdcnd-widget-body">
				<ul class="bdcnd-rank-list">
					<?php
					$rank = 1;
					while ( $query->have_posts() ) :
						$query->the_post();
						?>
						<li>
							<div class="bdcnd-rank-num"><?php echo esc_html( bdcnd_bn_number( $rank ) ); ?></div>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</li>
						<?php
						++$rank;
					endwhile;
					?>
				</ul>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
}
