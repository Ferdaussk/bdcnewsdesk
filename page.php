<?php
/**
 * Static page.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	?>
	<div class="bdcnd-content-layout">
		<div class="bdcnd-main-col">
			<article <?php post_class( 'bdcnd-article' ); ?>>
				<h1><?php the_title(); ?></h1>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="bdcnd-article-thumb"><?php the_post_thumbnail( 'bdcnd-hero' ); ?></div>
				<?php endif; ?>

				<div class="bdcnd-article-content">
					<?php the_content(); ?>
				</div>
			</article>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<div class="bdcnd-comments">
					<?php comments_template(); ?>
				</div>
			<?php endif; ?>
		</div>

		<?php get_sidebar(); ?>
	</div>
	<?php
endwhile;

get_footer();
