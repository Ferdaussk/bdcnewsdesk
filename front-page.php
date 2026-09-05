<?php
/**
 * Homepage: hero, latest list, then a category-driven magazine grid.
 * Each block's source category is editable from
 * Appearance -> BDC News Desk -> Quick Customization.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$used_ids = array();

$hero_query = new WP_Query(
	array(
		'post_type'           => 'post',
		'posts_per_page'      => 5,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	)
);
?>

<div class="bdcnd-content-layout">
	<div class="bdcnd-main-col">

		<?php if ( $hero_query->have_posts() ) : ?>
			<div class="bdcnd-hero-flex">
				<?php
				$hero_query->the_post();
				$used_ids[] = get_the_ID();
				?>
				<div class="bdcnd-hero-main">
					<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-hero' ); ?></a>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					<p><?php bdcnd_excerpt( get_the_ID(), 22 ); ?></p>
				</div>
				<div class="bdcnd-hero-list">
					<?php
					while ( $hero_query->have_posts() ) :
						$hero_query->the_post();
						$used_ids[] = get_the_ID();
						?>
						<div class="bdcnd-mini-item">
							<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-mini' ); ?></a>
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php
		$list_query = new WP_Query(
			array(
				'post_type'           => 'post',
				'posts_per_page'      => 6,
				'post__not_in'        => $used_ids,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			)
		);
		if ( $list_query->have_posts() ) :
			?>
			<div class="bdcnd-list-grid">
				<?php
				while ( $list_query->have_posts() ) :
					$list_query->the_post();
					?>
					<div class="bdcnd-li-item">
						<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-thumb' ); ?></a>
						<div class="bdcnd-li-body">
							<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
							<p><?php bdcnd_excerpt( get_the_ID(), 14 ); ?></p>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
			<?php
			wp_reset_postdata();
		endif;
		?>

		<?php
		bdcnd_news_section(
			array(
				'key'     => 'bangladesh',
				'default' => 'bangladesh',
				'title'   => __( 'বাংলাদেশ', 'bdc-news-desk' ),
				'style'   => 'feature',
				'count'   => 5,
			)
		);

		bdcnd_news_section(
			array(
				'key'     => 'politics',
				'default' => 'politics',
				'title'   => __( 'রাজনীতি', 'bdc-news-desk' ),
				'style'   => 'textgrid',
				'count'   => 9,
			)
		);
		?>

		<div class="bdcnd-three-col">
			<?php
			bdcnd_news_section(
				array(
					'key'     => 'sports',
					'default' => 'sports',
					'title'   => __( 'খেলা', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'foreign',
					'default' => 'foreign',
					'title'   => __( 'বিদেশ', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'entertainment',
					'default' => 'entertainment',
					'title'   => __( 'বিনোদন', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			?>
		</div>

		<div class="bdcnd-two-col">
			<?php
			bdcnd_news_section(
				array(
					'key'     => 'media',
					'default' => 'media',
					'title'   => __( 'গণমাধ্যম', 'bdc-news-desk' ),
					'style'   => 'thumbgrid',
					'count'   => 6,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'jobs',
					'default' => 'jobs',
					'title'   => __( 'চাকরির খবর', 'bdc-news-desk' ),
					'style'   => 'joblist',
					'count'   => 4,
				)
			);
			?>
		</div>

		<div class="bdcnd-three-col">
			<?php
			bdcnd_news_section(
				array(
					'key'     => 'tech',
					'default' => 'tech',
					'title'   => __( 'বিজ্ঞান ও তথ্যপ্রযুক্তি', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'opinion',
					'default' => 'opinion',
					'title'   => __( 'মতামত', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 3,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'economy',
					'default' => 'economy',
					'title'   => __( 'অর্থনীতি', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			?>
		</div>

		<div class="bdcnd-three-col">
			<?php
			bdcnd_news_section(
				array(
					'key'     => 'education',
					'default' => 'education',
					'title'   => __( 'শিক্ষা', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 5,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'literature',
					'default' => 'literature',
					'title'   => __( 'সাহিত্য', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 2,
				)
			);
			bdcnd_news_section(
				array(
					'key'     => 'feature',
					'default' => 'feature',
					'title'   => __( 'ফিচার', 'bdc-news-desk' ),
					'style'   => 'columnbox',
					'count'   => 3,
				)
			);
			?>
		</div>

		<?php
		$gallery_term = bdcnd_section_term( 'gallery', 'gallery' );
		if ( $gallery_term ) :
			$gallery_query = bdcnd_section_query( $gallery_term->term_id, 1 );
			if ( $gallery_query->have_posts() ) :
				$gallery_query->the_post();
				?>
				<div class="bdcnd-two-col">
					<div class="bdcnd-gallery-box">
						<div class="bdcnd-sec-header"><span class="bdcnd-ico"></span> <?php esc_html_e( 'ফটো গ্যালারী', 'bdc-news-desk' ); ?></div>
						<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-feature' ); ?></a>
						<div class="bdcnd-gallery-cap"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
					</div>
					<div class="bdcnd-gallery-box">
						<div class="bdcnd-sec-header"><span class="bdcnd-ico"></span> <?php esc_html_e( 'ভিডিও গ্যালারী', 'bdc-news-desk' ); ?></div>
						<a class="bdcnd-video-box" href="<?php the_permalink(); ?>">
							<?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-feature' ); ?>
							<span class="bdcnd-video-play" aria-hidden="true">&#9658;</span>
						</a>
					</div>
				</div>
				<?php
				wp_reset_postdata();
			endif;
		endif;
		?>

	</div><!-- .bdcnd-main-col -->

	<?php get_template_part( 'template-parts/sidebar-home' ); ?>

</div><!-- .bdcnd-content-layout -->

<?php
get_footer();
