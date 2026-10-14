<?php
/**
 * Single post right rail: latest ("সর্বশেষ") posts list.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bdcnd-side-col">
	<div class="bdcnd-widget">
		<div class="bdcnd-widget-header"><?php esc_html_e( 'সর্বশেষ', 'bdc-news-desk' ); ?></div>
		<div class="bdcnd-widget-body">
			<?php
			$bdcnd_latest = new WP_Query(
				array(
					'post_type'           => 'post',
					'posts_per_page'      => 8,
					'post__not_in'        => array( get_the_ID() ),
					'ignore_sticky_posts' => true,
					'no_found_rows'       => true,
				)
			);
			if ( $bdcnd_latest->have_posts() ) :
				?>
				<ul class="bdcnd-stacked-list">
					<?php
					while ( $bdcnd_latest->have_posts() ) :
						$bdcnd_latest->the_post();
						?>
						<li>
							<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-medium' ); ?></a>
							<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php
				wp_reset_postdata();
			endif;
			?>
		</div>
	</div>
</div>
