<?php
/**
 * Single post.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	$categories = get_the_category();
	?>
	<div class="bdcnd-content-layout">
		<div class="bdcnd-main-col">
			<article <?php post_class( 'bdcnd-article' ); ?>>
				<?php if ( ! empty( $categories ) ) : ?>
					<a class="bdcnd-article-category" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
				<?php endif; ?>

				<h1><?php the_title(); ?></h1>

				<div class="bdcnd-article-meta"><?php bdcnd_posted_on(); ?></div>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="bdcnd-article-thumb"><?php the_post_thumbnail( 'bdcnd-hero' ); ?></div>
				<?php endif; ?>

				<div class="bdcnd-article-content">
					<?php the_content(); ?>
				</div>

				<?php
				$tags = get_the_tags();
				if ( $tags ) :
					?>
					<div class="bdcnd-article-tags">
						<?php foreach ( $tags as $tag ) : ?>
							<a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>">#<?php echo esc_html( $tag->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</article>

			<?php
			if ( ! empty( $categories ) ) {
				$related = new WP_Query(
					array(
						'post_type'           => 'post',
						'posts_per_page'      => 4,
						'post__not_in'        => array( get_the_ID() ),
						'cat'                 => $categories[0]->term_id,
						'ignore_sticky_posts' => true,
						'no_found_rows'       => true,
					)
				);
				if ( $related->have_posts() ) :
					?>
					<div class="bdcnd-sec-header"><span class="bdcnd-ico"></span> <?php esc_html_e( 'সম্পর্কিত সংবাদ', 'bdc-news-desk' ); ?></div>
					<div class="bdcnd-sec-box">
						<div class="bdcnd-text-grid">
							<?php
							while ( $related->have_posts() ) :
								$related->the_post();
								?>
								<div class="bdcnd-ti-item">
									<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-list' ); ?></a>
									<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<?php
					wp_reset_postdata();
				endif;
			}
			?>

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
