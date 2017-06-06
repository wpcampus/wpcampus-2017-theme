				</div><!-- .wpc-content -->
				<?php get_sidebar(); ?>
			</div> <!-- .inside -->
		</div> <!-- #wpc-main -->
		<?php /* get_template_part( 'partials/get-involved' ); */ ?>
		<div id="wpc-mailing-list">
			<div class="inside">
				<h2><?php printf( __( 'Subscribe to %s', 'wpcampus' ), 'WPCampus' ); ?></h2>
				<p><?php printf( __( 'Enter your email address to receive notifications about %s.', 'wpcampus' ), 'WPCampus' ); ?></p>
				<?php echo do_shortcode( '[gravityform id="4" title="false" description="false" ajax="false" tabindex="2000"]' ); ?>
			</div>
		</div>
		<div id="wpc-footer">
			<div class="inside">
				<a class="wpc-logo" href="https://wpcampus.org/"><span class="for-screen-reader"><?php printf( __( '%1$s: Where %2$s Meets Higher Education', 'wpcampus' ), 'WPCampus', 'WordPress' ); ?></span></a>
				<?php

				// Print the footer menu.
				wp_nav_menu( array(
					'theme_location'    => 'footer',
					'container'         => 'div',
					'container_class'   => 'wpc-footer-menu-wrapper',
					'menu_id'           => 'wpc-footer-menu',
					'menu_class'        => 'wpc-footer-menu',
					'fallback_cb'       => false,
				) );

				?>
				<p><strong>WPCampus is a community of networking, resources, and events for those using WordPress in the world of higher education.</strong><br />If you are not a member of the WPCampus community, we'd love for you to <a href="https://wpcampus.org/get-involved/">get involved</a>.</p>
				<p class="disclaimer">This site is powered by <a href="https://wordpress.org/">WordPress</a>. You can view, and contribute to, the theme on <a href="https://github.com/wpcampus/wpcampus-2017-theme">GitHub</a>.<br />WPCampus events are not WordCamps and are not affiliated with the WordPress Foundation.</p>
				<?php wpc_print_social_media_icons(); ?>
				<p class="copyright">&copy; <?php echo date( 'Y' ); ?> WPCampus</p>
			</div><!-- .inside -->
		</div><!-- #wpc-footer -->
	</div> <!-- #wpc-wrapper -->
	<?php wp_footer(); ?>
</body>
</html>
