<?php
/**
 * Lightweight per-post view counter powering "Most Read" blocks.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Bump the view count once per page load on single posts.
 */
function bdcnd_track_post_view() {
	if ( ! is_singular( 'post' ) || is_admin() ) {
		return;
	}
	$post_id = get_queried_object_id();
	if ( ! $post_id ) {
		return;
	}
	$views = (int) get_post_meta( $post_id, '_bdcnd_views', true );
	update_post_meta( $post_id, '_bdcnd_views', $views + 1 );
}
add_action( 'wp_head', 'bdcnd_track_post_view' );

/**
 * Query the most-viewed posts.
 *
 * @param int $count    Number of posts.
 * @param int $term_id  Optional category restriction.
 * @return WP_Query
 */
function bdcnd_most_read_query( $count = 5, $term_id = 0 ) {
	$args = array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => $count,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
		'meta_key'            => '_bdcnd_views',
		'orderby'             => 'meta_value_num',
		'order'               => 'DESC',
	);
	if ( $term_id ) {
		$args['cat'] = $term_id;
	}
	return new WP_Query( $args );
}
