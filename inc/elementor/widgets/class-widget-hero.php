<?php
/**
 * Elementor widget: hero spotlight (big story + mini headline list).
 *
 * @package BDCNewsDesk
 */

namespace BDCNewsDesk\Elementor;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Hero Spotlight widget.
 */
class Widget_Hero extends Widget_Base {

	/**
	 * Widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'bdcnd-hero';
	}

	/**
	 * Widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'BDCND Hero Spotlight', 'bdc-news-desk' );
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
			'category',
			array(
				'label'   => __( 'Category', 'bdc-news-desk' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $this->category_options(),
				'default' => 0,
			)
		);

		$this->add_control(
			'mini_count',
			array(
				'label'   => __( 'Number of Side Headlines', 'bdc-news-desk' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 4,
				'min'     => 1,
				'max'     => 8,
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
			'posts_per_page'      => 1 + (int) $settings['mini_count'],
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
		<div class="bdcnd-hero-flex">
			<?php
			$query->the_post();
			?>
			<div class="bdcnd-hero-main">
				<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-hero' ); ?></a>
				<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
				<p><?php bdcnd_excerpt( get_the_ID(), 22 ); ?></p>
			</div>
			<div class="bdcnd-hero-list">
				<?php
				while ( $query->have_posts() ) :
					$query->the_post();
					?>
					<div class="bdcnd-mini-item">
						<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-mini' ); ?></a>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
}
