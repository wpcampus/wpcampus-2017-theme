<div role="complementary" id="wpc-hero">
	<div class="inside">
		<div id="wpc-hero-bg"></div>
		<?php

		if ( ! is_front_page() ) :

			// Print title
			if ( is_singular( 'schedule' ) ) :
				?><div class="wpc-hero-title"><?php _e( 'Schedule', 'wpcampus' ); ?></div><?php
			elseif ( is_post_type_archive() ) :
				?><div class="wpc-hero-title"><?php post_type_archive_title(); ?></div><?php
			elseif ( is_home() || is_single() || is_archive() ) :
				?><div class="wpc-hero-title"><?php _e( 'Announcements', 'wpcampus' ); ?></div><?php
			else :

				?>
				<h1 class="wpc-hero-title">
					<?php

					if ( is_404() ) :
						_e( 'Page Not Found', 'wpcampus' );
					elseif ( is_search() ) :
						_e( 'Search Results', 'wpcampus' );
					else :
						echo apply_filters( 'wpcampus_page_title', get_the_title() );
					endif;

					?>
				</h1>
				<?php

			endif;
		endif;

		?>
	</div>
	<?php

	// Include notifications.
	require( STYLESHEETPATH . '/partials/notifications.html' );

	?>
</div><!-- #wpc-hero -->
