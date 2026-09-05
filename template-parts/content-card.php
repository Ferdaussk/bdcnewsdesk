<?php
/**
 * Post card used on index/archive/category/tag/search results.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bdcnd-li-item">
	<a href="<?php the_permalink(); ?>"><?php bdcnd_the_thumb( get_the_ID(), 'bdcnd-thumb' ); ?></a>
	<div class="bdcnd-li-body">
		<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		<p><?php bdcnd_excerpt( get_the_ID(), 20 ); ?></p>
	</div>
</div>
