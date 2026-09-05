<?php
/**
 * Appearance -> BDC News Desk admin dashboard.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the dashboard submenu page.
 */
function bdcnd_add_admin_menu() {
	add_theme_page(
		__( 'BDC News Desk', 'bdc-news-desk' ),
		__( 'BDC News Desk', 'bdc-news-desk' ),
		'manage_options',
		'bdc-news-desk',
		'bdcnd_render_admin_dashboard'
	);
}
add_action( 'admin_menu', 'bdcnd_add_admin_menu' );

/**
 * Whether the demo content has already been imported.
 *
 * @return bool
 */
function bdcnd_is_demo_content_imported() {
	return (bool) get_option( 'bdcnd_demo_content_imported' );
}

/**
 * Render the dashboard page.
 */
function bdcnd_render_admin_dashboard() {
	$theme            = wp_get_theme();
	$elementor_active = bdcnd_is_elementor_active();
	$has_logo         = has_custom_logo();
	$has_menu         = has_nav_menu( 'primary' );
	$post_count       = wp_count_posts()->publish;
	$demo_imported    = bdcnd_is_demo_content_imported();
	$show_on_front    = get_option( 'show_on_front' );
	?>
	<div class="wrap bdcnd-dash">
		<div class="bdcnd-dash-header">
			<div>
				<h1><?php esc_html_e( 'BDC News Desk', 'bdc-news-desk' ); ?></h1>
				<p><?php esc_html_e( 'A modern digital news portal theme. Manage setup, demo content and quick customization from one place.', 'bdc-news-desk' ); ?></p>
			</div>
		</div>

		<?php if ( isset( $_GET['bdcnd_status'] ) && 'imported' === $_GET['bdcnd_status'] ) : ?>
			<div class="notice notice-success is-dismissible"><p><?php esc_html_e( 'Demo content imported successfully.', 'bdc-news-desk' ); ?></p></div>
		<?php endif; ?>

		<div class="bdcnd-dash-grid">
			<div>
				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Setup Status', 'bdc-news-desk' ); ?></h2>
					<ul class="bdcnd-status-list">
						<li>
							<span class="bdcnd-status-dot is-ok"></span>
							<?php
							printf(
								/* translators: 1: theme name 2: theme version */
								esc_html__( 'Theme active: %1$s (v%2$s)', 'bdc-news-desk' ),
								esc_html( $theme->get( 'Name' ) ),
								esc_html( $theme->get( 'Version' ) )
							);
							?>
						</li>
						<li>
							<span class="bdcnd-status-dot <?php echo $elementor_active ? 'is-ok' : 'is-warn'; ?>"></span>
							<?php echo $elementor_active ? esc_html__( 'Elementor is active — branded widgets are available under the "BDC News Desk" category.', 'bdc-news-desk' ) : esc_html__( 'Elementor is not active. Install &amp; activate it to use the branded BDC News Desk widget library.', 'bdc-news-desk' ); ?>
						</li>
						<li>
							<span class="bdcnd-status-dot <?php echo $has_logo ? 'is-ok' : 'is-warn'; ?>"></span>
							<?php echo $has_logo ? esc_html__( 'Custom logo is set.', 'bdc-news-desk' ) : esc_html__( 'No custom logo set yet — a text fallback logo is shown.', 'bdc-news-desk' ); ?>
						</li>
						<li>
							<span class="bdcnd-status-dot <?php echo $has_menu ? 'is-ok' : 'is-warn'; ?>"></span>
							<?php echo $has_menu ? esc_html__( 'Primary navigation menu is assigned.', 'bdc-news-desk' ) : esc_html__( 'No menu assigned to the Primary Menu location yet.', 'bdc-news-desk' ); ?>
						</li>
						<li>
							<span class="bdcnd-status-dot is-ok"></span>
							<?php
							/* translators: %s: number of published posts */
							printf( esc_html__( 'Homepage source: template front-page.php, showing latest posts (%s published).', 'bdc-news-desk' ), esc_html( $post_count ) );
							?>
						</li>
						<li>
							<span class="bdcnd-status-dot <?php echo $demo_imported ? 'is-ok' : 'is-warn'; ?>"></span>
							<?php echo $demo_imported ? esc_html__( 'Demo content has been imported.', 'bdc-news-desk' ) : esc_html__( 'Demo content has not been imported yet.', 'bdc-news-desk' ); ?>
						</li>
					</ul>
				</div>

				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Demo Content', 'bdc-news-desk' ); ?></h2>
					<p><?php esc_html_e( 'Creates the demo categories, ~20 realistic fictional Bengali news articles, and assigns the sample navigation menu — so the homepage looks like the approved design immediately. Safe to run once; it will not duplicate content on a second run.', 'bdc-news-desk' ); ?></p>
					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
						<?php wp_nonce_field( 'bdcnd_import_demo_content', 'bdcnd_nonce' ); ?>
						<input type="hidden" name="action" value="bdcnd_import_demo_content">
						<button type="submit" class="button button-primary">
							<?php echo $demo_imported ? esc_html__( 'Re-run Demo Content Import', 'bdc-news-desk' ) : esc_html__( 'Import Demo Content', 'bdc-news-desk' ); ?>
						</button>
					</form>
					<p class="bdcnd-dash-note"><?php esc_html_e( 'Demo articles are clearly fictional and written specifically for this theme; they do not represent real events.', 'bdc-news-desk' ); ?></p>
				</div>

				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Quick Customization', 'bdc-news-desk' ); ?></h2>
					<div class="bdcnd-dash-actions">
						<a class="button" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>"><?php esc_html_e( 'Open Customizer', 'bdc-news-desk' ); ?></a>
						<a class="button" href="<?php echo esc_url( admin_url( 'nav-menus.php' ) ); ?>"><?php esc_html_e( 'Manage Menus', 'bdc-news-desk' ); ?></a>
						<a class="button" href="<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>"><?php esc_html_e( 'Manage Widgets', 'bdc-news-desk' ); ?></a>
						<a class="button" href="<?php echo esc_url( admin_url( 'options-general.php' ) ); ?>"><?php esc_html_e( 'Site Title &amp; Tagline', 'bdc-news-desk' ); ?></a>
						<a class="button" href="<?php echo esc_url( admin_url( 'options-reading.php' ) ); ?>"><?php esc_html_e( 'Reading Settings', 'bdc-news-desk' ); ?></a>
					</div>
				</div>
			</div>

			<div>
				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Homepage Section Categories', 'bdc-news-desk' ); ?></h2>
					<p><?php esc_html_e( 'Each homepage block pulls from a category slug below. Change these to remap a block to a different category without editing code.', 'bdc-news-desk' ); ?></p>
					<?php bdcnd_render_section_mapping_form(); ?>
				</div>

				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Documentation', 'bdc-news-desk' ); ?></h2>
					<p><?php esc_html_e( 'BDC News Desk ships with:', 'bdc-news-desk' ); ?></p>
					<ul class="bdcnd-status-list">
						<li><span class="bdcnd-status-dot is-ok"></span><?php esc_html_e( 'A full WordPress template set matching the approved homepage design.', 'bdc-news-desk' ); ?></li>
						<li><span class="bdcnd-status-dot is-ok"></span><?php esc_html_e( 'A branded Elementor widget library (category: "BDC News Desk").', 'bdc-news-desk' ); ?></li>
						<li><span class="bdcnd-status-dot is-ok"></span><?php esc_html_e( 'Bengali + English ready strings via the bdc-news-desk text domain.', 'bdc-news-desk' ); ?></li>
					</ul>
				</div>

				<div class="bdcnd-dash-card">
					<h2><?php esc_html_e( 'Support', 'bdc-news-desk' ); ?></h2>
					<p><?php esc_html_e( 'For theme support, contact your development team or the administrator listed in Settings.', 'bdc-news-desk' ); ?></p>
					<p><a href="mailto:<?php echo esc_attr( get_option( 'admin_email' ) ); ?>"><?php echo esc_html( get_option( 'admin_email' ) ); ?></a></p>
				</div>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Section-to-category mapping fields shown/saved on the dashboard.
 */
function bdcnd_section_mapping_fields() {
	return array(
		'bangladesh'    => array( __( 'বাংলাদেশ', 'bdc-news-desk' ), 'bangladesh' ),
		'probash'       => array( __( 'প্রবাস', 'bdc-news-desk' ), 'probash' ),
		'politics'      => array( __( 'রাজনীতি', 'bdc-news-desk' ), 'politics' ),
		'sports'        => array( __( 'খেলা', 'bdc-news-desk' ), 'sports' ),
		'foreign'       => array( __( 'বিদেশ', 'bdc-news-desk' ), 'foreign' ),
		'entertainment' => array( __( 'বিনোদন', 'bdc-news-desk' ), 'entertainment' ),
		'media'         => array( __( 'গণমাধ্যম', 'bdc-news-desk' ), 'media' ),
		'jobs'          => array( __( 'চাকরির খবর', 'bdc-news-desk' ), 'jobs' ),
		'tech'          => array( __( 'বিজ্ঞান ও তথ্যপ্রযুক্তি', 'bdc-news-desk' ), 'tech' ),
		'opinion'       => array( __( 'মতামত', 'bdc-news-desk' ), 'opinion' ),
		'economy'       => array( __( 'অর্থনীতি', 'bdc-news-desk' ), 'economy' ),
		'education'     => array( __( 'শিক্ষা', 'bdc-news-desk' ), 'education' ),
		'literature'    => array( __( 'সাহিত্য', 'bdc-news-desk' ), 'literature' ),
		'feature'       => array( __( 'ফিচার', 'bdc-news-desk' ), 'feature' ),
		'gallery'       => array( __( 'ফটো গ্যালারী', 'bdc-news-desk' ), 'gallery' ),
	);
}

/**
 * Output + handle the section-mapping settings form.
 */
function bdcnd_render_section_mapping_form() {
	if ( isset( $_POST['bdcnd_mapping_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['bdcnd_mapping_nonce'] ) ), 'bdcnd_save_mapping' ) && current_user_can( 'manage_options' ) ) {
		foreach ( bdcnd_section_mapping_fields() as $key => $field ) {
			$posted = isset( $_POST[ 'bdcnd_section_' . $key ] ) ? sanitize_title( wp_unslash( $_POST[ 'bdcnd_section_' . $key ] ) ) : $field[1];
			update_option( 'bdcnd_section_' . $key, $posted ? $posted : $field[1] );
		}
		echo '<div class="notice notice-success inline"><p>' . esc_html__( 'Section mapping saved.', 'bdc-news-desk' ) . '</p></div>';
	}
	?>
	<form method="post" action="">
		<?php wp_nonce_field( 'bdcnd_save_mapping', 'bdcnd_mapping_nonce' ); ?>
		<table class="form-table" role="presentation">
			<?php foreach ( bdcnd_section_mapping_fields() as $key => $field ) : ?>
				<tr>
					<th scope="row"><label for="bdcnd_section_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label></th>
					<td>
						<input type="text" id="bdcnd_section_<?php echo esc_attr( $key ); ?>" name="bdcnd_section_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( bdcnd_section_category_slug( $key, $field[1] ) ); ?>" class="regular-text">
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		<?php submit_button( __( 'Save Mapping', 'bdc-news-desk' ) ); ?>
	</form>
	<?php
}
