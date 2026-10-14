<?php
/**
 * Single post left rail: most-read ("জনপ্রিয়") list.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bdcnd-side-col">
	<div class="bdcnd-widget">
		<div class="bdcnd-widget-header"><?php esc_html_e( 'জনপ্রিয়', 'bdc-news-desk' ); ?></div>
		<div class="bdcnd-widget-body">
			<?php
			$bdcnd_popular = bdcnd_most_read_query( 8 );
			if ( $bdcnd_popular->have_posts() ) :
				?>
				<ul class="bdcnd-stacked-list">
					<?php
					while ( $bdcnd_popular->have_posts() ) :
						$bdcnd_popular->the_post();
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
