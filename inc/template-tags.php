<?php
/**
 * Reusable template helpers and the homepage section renderer.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fallback local image (no external image-hosting dependency).
 *
 * @return string
 */
function bdcnd_placeholder_image() {
	return BDCND_URI . '/assets/images/placeholder.svg';
}

/**
 * True only if a widget area has widgets the site owner actually chose to
 * put there. WordPress auto-assigns its classic Search/Recent Posts/Recent
 * Comments widgets to the first available sidebar on a fresh install
 * (before the theme's own template-driven fallback design ever gets a say),
 * which would otherwise permanently hide our branded default blocks behind
 * plain, unstyled core widgets. Ignore those specific defaults so the
 * homepage/article sidebars only switch to dynamic_sidebar() output once
 * someone has deliberately customized them.
 *
 * @param string $sidebar_id Registered sidebar id.
 * @return bool
 */
function bdcnd_sidebar_has_real_widgets( $sidebar_id ) {
	if ( ! is_active_sidebar( $sidebar_id ) ) {
		return false;
	}

	$sidebars_widgets = wp_get_sidebars_widgets();
	if ( empty( $sidebars_widgets[ $sidebar_id ] ) ) {
		return false;
	}

	$core_default_prefixes = array( 'search-', 'recent-posts-', 'recent-comments-', 'archives-', 'categories-', 'meta-', 'calendar-', 'tag_cloud-' );

	foreach ( $sidebars_widgets[ $sidebar_id ] as $widget_id ) {
		$is_core_default = false;
		foreach ( $core_default_prefixes as $prefix ) {
			if ( 0 === strpos( $widget_id, $prefix ) ) {
				$is_core_default = true;
				break;
			}
		}
		if ( ! $is_core_default ) {
			return true;
		}
	}

	return false;
}

/**
 * Print a post's featured image, or the local placeholder.
 *
 * @param int    $post_id   Post ID.
 * @param string $size      Registered image size.
 * @param array  $attrs     Extra <img> attributes.
 */
function bdcnd_the_thumb( $post_id, $size = 'bdcnd-thumb', $attrs = array() ) {
	if ( has_post_thumbnail( $post_id ) ) {
		echo get_the_post_thumbnail( $post_id, $size, $attrs );
		return;
	}
	$class = trim( 'bdcnd-placeholder-img ' . ( isset( $attrs['class'] ) ? $attrs['class'] : '' ) );
	printf(
		'<img src="%1$s" alt="%2$s" loading="lazy" class="%3$s">',
		esc_url( bdcnd_placeholder_image() ),
		esc_attr( get_the_title( $post_id ) ),
		esc_attr( $class )
	);
}

/**
 * Bengali-aware "posted on" line (falls back to WordPress date format).
 *
 * @param int $post_id Post ID.
 */
function bdcnd_posted_on( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	printf(
		'<span class="bdcnd-meta-date">%1$s</span> <span class="bdcnd-meta-sep">&middot;</span> <span class="bdcnd-meta-author">%2$s %3$s</span>',
		esc_html( get_the_date( '', $post_id ) ),
		esc_html__( 'By', 'bdc-news-desk' ),
		esc_html( get_the_author_meta( 'display_name', get_post_field( 'post_author', $post_id ) ) )
	);
}

/**
 * Trimmed excerpt with a themed "read more" link.
 *
 * @param int $post_id     Post ID.
 * @param int $word_count  Word limit.
 */
function bdcnd_excerpt( $post_id = null, $word_count = 18 ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$text    = get_the_excerpt( $post_id );
	$text    = wp_trim_words( $text, $word_count, '&hellip;' );
	printf(
		'%1$s <a href="%2$s" class="bdcnd-more-link">%3$s</a>',
		esc_html( $text ),
		esc_url( get_permalink( $post_id ) ),
		esc_html__( 'বিস্তারিত', 'bdc-news-desk' )
	);
}

/**
 * Resolve which category slug feeds a given homepage section.
 * Editable from Appearance -> BDC News Desk -> Quick Customization.
 *
 * @param string $key           Section key, e.g. 'bangladesh'.
 * @param string $default_slug  Fallback category slug.
 * @return string
 */
function bdcnd_section_category_slug( $key, $default_slug ) {
	return get_option( 'bdcnd_section_' . $key, $default_slug );
}

/**
 * Get the WP_Term for a homepage section, or false if it doesn't exist yet.
 *
 * @param string $key           Section key.
 * @param string $default_slug  Fallback category slug.
 * @return WP_Term|false
 */
function bdcnd_section_term( $key, $default_slug ) {
	$slug = bdcnd_section_category_slug( $key, $default_slug );
	$term = get_term_by( 'slug', $slug, 'category' );
	return $term instanceof WP_Term ? $term : false;
}

/**
 * Core query used by every homepage/Elementor news block.
 *
 * @param int $term_id  Category term ID.
 * @param int $count    Number of posts.
 * @param int $exclude  Post ID to exclude (e.g. already used as hero).
 * @return WP_Query
 */
function bdcnd_section_query( $term_id, $count, $exclude = 0 ) {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	);
	if ( $term_id ) {
		$args['cat'] = $term_id;
	}
	if ( $exclude ) {
		$args['post__not_in'] = array( $exclude );
	}
	return new WP_Query( $args );
}

/**
 * Section header bar shared by every homepage/archive block.
 *
 * @param string $title Section title.
 * @param string $link  Optional "see more" link.
 */
function bdcnd_section_header( $title, $link = '' ) {
	echo '<div class="bdcnd-sec-header"><span class="bdcnd-ico"></span> ' . esc_html( $title ) . '</div>';
}

/**
 * Render one homepage news block in a given visual style.
 *
 * Styles: 'feature' (big story + 4 side items), 'textgrid' (3-col thumb+headline),
 * 'columnbox' (image + bullet list), 'thumbgrid' (6-cell thumb grid).
 *
 * @param array $args {
 *   @type string $key      Section key used for the category mapping option.
 *   @type string $default  Default category slug.
 *   @type int    $term_id  Optional: use this category directly and skip the key lookup (used by the Elementor widget).
 *   @type string $title    Visible section title.
 *   @type string $style    One of feature|textgrid|columnbox|thumbgrid.
 *   @type int    $count    Number of posts to pull.
 * }
 */
function bdcnd_news_section( $args ) {
	$args = wp_parse_args(
		$args,
		array(
			'key'     => '',
			'default' => '',
			'term_id' => 0,
			'title'   => '',
			'style'   => 'feature',
			'count'   => 5,
		)
	);

	if ( $args['term_id'] ) {
		$term = get_term( $args['term_id'], 'category' );
		$term = ( $term instanceof WP_Term ) ? $term : false;
	} else {
		$term = bdcnd_section_term( $args['key'], $args['default'] );
	}
	if ( ! $term ) {
		return;
	}

	$query = bdcnd_section_query( $term->term_id, $args['count'] );
	if ( ! $query->have_posts() ) {
		return;
	}

	// The three-col "columnbox" style wraps header+image+list in its own
	// .bdcnd-col-box container instead of the shared .bdcnd-sec-box.
	if ( 'columnbox' === $args['style'] ) {
		echo '<div class="bdcnd-col-box">';
		bdcnd_section_header( $args['title'] );

		$query->the_post();
		$first_id = get_the_ID();
		bdcnd_the_thumb( $first_id, 'bdcnd-medium', array( 'class' => 'bdcnd-main-img' ) );
		echo '<div class="bdcnd-col-body"><h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3></div>';
		echo '<ul class="bdcnd-bullet-list">';
		while ( $query->have_posts() ) {
			$query->the_post();
			echo '<li><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></li>';
		}
		echo '</ul>';

		echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="bdcnd-see-more">' . esc_html__( 'আরো..', 'bdc-news-desk' ) . ' &raquo;</a>';
		echo '</div>';
		wp_reset_postdata();
		return;
	}

	bdcnd_section_header( $args['title'] );
	echo '<div class="bdcnd-sec-box">';

	switch ( $args['style'] ) {
		case 'textgrid':
			echo '<div class="bdcnd-text-grid">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="bdcnd-ti-item">';
				bdcnd_the_thumb( get_the_ID(), 'bdcnd-list' );
				echo '<h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';
				echo '</div>';
			}
			echo '</div>';
			break;

		case 'thumbgrid':
			echo '<div class="bdcnd-thumb-grid">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="bdcnd-thumb-cell">';
				bdcnd_the_thumb( get_the_ID(), 'bdcnd-medium' );
				echo '<h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';
				echo '</div>';
			}
			echo '</div>';
			break;

		case 'joblist':
			echo '<ul class="bdcnd-job-list">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<li>';
				bdcnd_the_thumb( get_the_ID(), 'bdcnd-mini' );
				echo '<h5><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h5>';
				echo '</li>';
			}
			echo '</ul>';
			break;

		case 'feature':
		default:
			echo '<div class="bdcnd-feat-grid">';
			$query->the_post();
			$main_id = get_the_ID();
			echo '<div class="bdcnd-feat-main">';
			bdcnd_the_thumb( $main_id, 'bdcnd-feature' );
			echo '<h3><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h3>';
			echo '<p>';
			bdcnd_excerpt( $main_id, 20 );
			echo '</p></div>';

			echo '<div class="bdcnd-feat-side">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<div class="bdcnd-li-item">';
				bdcnd_the_thumb( get_the_ID(), 'bdcnd-mini' );
				echo '<div class="bdcnd-li-body"><h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4>';
				echo '<p>';
				bdcnd_excerpt( get_the_ID(), 10 );
				echo '</p></div></div>';
			}
			echo '</div>';
			echo '</div>';
			break;
	}

	echo '<a href="' . esc_url( get_term_link( $term ) ) . '" class="bdcnd-see-more">' . esc_html__( 'আরো..', 'bdc-news-desk' ) . ' &raquo;</a>';
	echo '</div>';
	wp_reset_postdata();
}

/**
 * Sidebar "featured category" block (side-feature image + side-list),
 * used for spotlight widgets like the diaspora ("probash") section.
 *
 * @param string $key      Section key used for the category mapping option.
 * @param string $default  Default category slug.
 * @param string $title    Widget title.
 * @param int    $count    How many extra list items below the feature.
 */
function bdcnd_sidebar_feature_block( $key, $default, $title, $count = 3 ) {
	$term = bdcnd_section_term( $key, $default );
	if ( ! $term ) {
		return;
	}
	$query = bdcnd_section_query( $term->term_id, $count + 1 );
	if ( ! $query->have_posts() ) {
		return;
	}
	echo '<div class="bdcnd-widget"><div class="bdcnd-widget-header">' . esc_html( $title ) . '</div>';
	$query->the_post();
	echo '<div class="bdcnd-side-feature">';
	bdcnd_the_thumb( get_the_ID(), 'bdcnd-feature' );
	echo '<h4><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h4></div>';
	echo '<ul class="bdcnd-side-list">';
	while ( $query->have_posts() ) {
		$query->the_post();
		echo '<li>';
		bdcnd_the_thumb( get_the_ID(), 'bdcnd-list' );
		echo '<h5><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h5></li>';
	}
	echo '</ul></div>';
	wp_reset_postdata();
}

/**
 * Sidebar "most read" rank-list block.
 *
 * @param string $title  Widget title.
 * @param int    $count  Number of posts.
 */
function bdcnd_sidebar_most_read( $title, $count = 5 ) {
	$query = bdcnd_most_read_query( $count );
	if ( ! $query->have_posts() ) {
		return;
	}
	echo '<div class="bdcnd-widget"><div class="bdcnd-widget-header">' . esc_html( $title ) . '</div><div class="bdcnd-widget-body"><ul class="bdcnd-rank-list">';
	$rank = 1;
	while ( $query->have_posts() ) {
		$query->the_post();
		echo '<li><div class="bdcnd-rank-num">' . esc_html( bdcnd_bn_number( $rank ) ) . '</div><h5><a href="' . esc_url( get_permalink() ) . '">' . esc_html( get_the_title() ) . '</a></h5></li>';
		++$rank;
	}
	echo '</ul></div></div>';
	wp_reset_postdata();
}

/**
 * Convert ASCII digits to Bengali digits (for rank numbers, etc.).
 *
 * @param int|string $number Number to convert.
 * @return string
 */
function bdcnd_bn_number( $number ) {
	$western = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
	$bengali = array( '০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯' );
	if ( 0 !== strpos( get_locale(), 'bn' ) ) {
		return (string) $number;
	}
	return str_replace( $western, $bengali, (string) $number );
}

/**
 * Numeric pagination used on archive/search templates.
 */
function bdcnd_pagination() {
	$links = paginate_links(
		array(
			'prev_text' => esc_html__( '&laquo; আগে', 'bdc-news-desk' ),
			'next_text' => esc_html__( 'পরে &raquo;', 'bdc-news-desk' ),
		)
	);
	if ( $links ) {
		echo '<nav class="bdcnd-pagination">' . wp_kses_post( $links ) . '</nav>';
	}
}
