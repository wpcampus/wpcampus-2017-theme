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
		<?php

		// Print network footer.
		if ( function_exists( 'wpcampus_print_network_footer' ) ) {
			wpcampus_print_network_footer();
		}

		?>
	</div> <!-- #wpc-wrapper -->
	<?php wp_footer(); ?>
</body>
</html>
