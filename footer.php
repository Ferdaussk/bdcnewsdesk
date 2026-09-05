<?php
/**
 * Footer: optional widget row, logo, editor meta, dynamic copyright.
 *
 * @package BDCNewsDesk
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</div><!-- #bdcnd-content -->

<div class="bdcnd-footer">
	<div class="bdcnd-wrap">

		<?php if ( bdcnd_sidebar_has_real_widgets( 'bdcnd-footer' ) ) : ?>
			<div class="bdcnd-footer-widgets">
				<?php dynamic_sidebar( 'bdcnd-footer' ); ?>
			</div>
		<?php endif; ?>

		<div class="bdcnd-footer-inner">
			<div class="bdcnd-footer-logo">
				<span class="bdcnd-logo-box">
					<span class="bdcnd-star-cluster">
						<svg viewBox="0 0 60 70" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<defs>
								<linearGradient id="bdcnd-g2" x1="0" y1="1" x2="1" y2="0">
									<stop offset="0%" stop-color="#8a8a8a"/>
									<stop offset="100%" stop-color="#fff2b0"/>
								</linearGradient>
							</defs>
							<g fill="url(#bdcnd-g2)">
								<polygon points="10,66 12,60 14,66 20,66 15,70 17,76 10,72 3,76 5,70 0,66" transform="translate(0,-10) scale(0.5)"/>
								<polygon points="18,56 21,49 24,56 31,56 25,60 28,67 21,63 14,67 17,60 11,56" transform="translate(-2,-4) scale(0.62)"/>
								<polygon points="24,42 28,33 32,42 41,42 34,47 37,56 28,51 19,56 22,47 15,42" transform="translate(0,4) scale(0.72)"/>
								<polygon points="30,26 35,15 40,26 51,26 42,32 46,43 35,37 24,43 28,32 19,26" transform="translate(2,8) scale(0.85)"/>
								<polygon points="36,8 42,-6 48,8 62,8 51,15 56,29 42,21 28,29 33,15 22,8" transform="translate(3,14) scale(1)"/>
							</g>
						</svg>
					</span>
					<span class="bdcnd-logo-text"><?php bloginfo( 'name' ); ?></span>
				</span>
			</div>
			<div class="bdcnd-footer-meta">
				<?php $editor = get_theme_mod( 'bdcnd_footer_editor' ); ?>
				<?php if ( $editor ) : ?>
					<?php esc_html_e( 'সম্পাদক:', 'bdc-news-desk' ); ?> <?php echo esc_html( $editor ); ?><br>
				<?php endif; ?>
				<?php $email = get_theme_mod( 'bdcnd_footer_email', get_option( 'admin_email' ) ); ?>
				<?php if ( $email ) : ?>
					<?php esc_html_e( 'ইমেইল:', 'bdc-news-desk' ); ?> <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( has_nav_menu( 'footer' ) ) : ?>
			<nav class="bdcnd-footer-nav" aria-label="<?php esc_attr_e( 'Footer Menu', 'bdc-news-desk' ); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_id'        => 'bdcnd-footer-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<div class="bdcnd-footer-bottom">
			<?php
			$rights = get_theme_mod( 'bdcnd_footer_rights', __( 'এই ওয়েবসাইটের কোনো লেখা, ছবি, ভিডিও অনুমতি ছাড়া ব্যবহার করা যাবে না।', 'bdc-news-desk' ) );
			echo esc_html( $rights );
			?>
			&nbsp;&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
			<?php esc_html_e( 'All Rights Reserved.', 'bdc-news-desk' ); ?>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
