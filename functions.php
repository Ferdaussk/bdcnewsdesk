<?php
/**
 * BDC News Desk theme bootstrap.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BDCND_VERSION', '1.0.0' );
define( 'BDCND_DIR', get_template_directory() );
define( 'BDCND_URI', get_template_directory_uri() );

require BDCND_DIR . '/inc/setup.php';
require BDCND_DIR . '/inc/enqueue.php';
require BDCND_DIR . '/inc/template-tags.php';
require BDCND_DIR . '/inc/customizer.php';
require BDCND_DIR . '/inc/class-view-counter.php';
require BDCND_DIR . '/inc/elementor/class-elementor.php';

if ( is_admin() ) {
	require BDCND_DIR . '/inc/admin/class-admin-dashboard.php';
	require BDCND_DIR . '/inc/admin/class-demo-content.php';
}
