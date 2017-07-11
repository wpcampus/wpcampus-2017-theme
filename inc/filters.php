<?php

/**
 * Adjust queries
 */
function wpc_2017_adjust_queries( $query ) {

	// Don't run in the admin.
	if ( is_admin() ) {
		return;
	}

	// Only for the main query.
	if ( ! $query->is_main_query() ) {
		return;
	}

	/*
	 * For now, get all announcements.
	 *
	 * @TODO add pagination.
	 */
	if ( is_home() ) {
		$query->set( 'nopaging', true );
	}
}
add_action( 'pre_get_posts', 'wpc_2017_adjust_queries' );

/**
 * Filtering the title.
 */
function wpc_2017_filter_post_title( $post_title, $post_id ) {

	// Not in the admin.
	if ( is_admin() ) {
		return $post_title;
	}

	// Only for schedule.
	if ( 'schedule' != get_post_type( $post_id ) ) {
		return $post_title;
	}

	// Add "Workshop" when needed.
	if ( has_term( 'workshop', 'event_types' ) ) {
		$post_title = '<span class="wpc-event-type">Workshop:</span> ' . $post_title;
	}

	return $post_title;
}
add_filter( 'the_title', 'wpc_2017_filter_post_title', 100, 2 );

/**
 * Tracking ticket purchase from Facebook.
 */
/*add_action( 'wpcampus_facebook_pixel', 'wpcampus_2017_fb_track_tickets' );
function wpcampus_2017_fb_track_tickets() {
	if ( is_page( 'tickets/tickets-confirmation' ) ) :
		?>
		<script>
			fbq( 'track', 'Purchase', { value: '150.00', currency: 'USD' } );
		</script>
		<?php
	endif;
}*/

/**
 * Filter the <body> class.
 */
function wpc_2017_filter_body_class( $classes, $class ) {

	// Let us know we're on the front page.
	if ( is_front_page() ) {
		$classes[] = 'front';
	}

	// No point if no sidebar.
	if ( wpc_has_sidebar() ) {

		// See if there is a sidebar ID.
		$sidebar_id = wpc_get_current_sidebar();
		if ( $sidebar_id ) {
			$classes[] = 'has-sidebar';
			$classes[] = 'has-sidebar-' . preg_replace( '/^wpc\-sidebar\-/i', '', $sidebar_id );
		}
	}

	return $classes;
}
add_filter( 'body_class', 'wpc_2017_filter_body_class', 10, 2 );

/**
 * Tweak the excerpt length.
 */
function wpc_2017_filter_excerpt_length( $excerpt_length ) {
	return 70;
}
add_filter( 'excerpt_length', 'wpc_2017_filter_excerpt_length' );

/**
 * Tweak the excerpt more.
 */
function wpc_2017_filter_excerpt_more( $excerpt_more ) {
	return ' &hellip;';
}
add_filter( 'excerpt_more', 'wpc_2017_filter_excerpt_more' );

/**
 * Add link to all announcements
 * at end of blog posts.
 */
function wpc_2017_add_to_content( $content ) {

	if ( is_singular( 'schedule' ) ) :

		ob_start();

		// Print main callout.
		wpcampus_2017_print_main_callout();

		$content .= ob_get_clean();

	elseif ( is_singular( 'post' ) ) :

		ob_start();

		// Print main callout.
		wpcampus_2017_print_main_callout();

		?>
		<hr />
		<em><a class="button secondary block" href="/announcements/"><?php _e( 'View all announcements', 'wpcampus' ); ?></a></em>
		<?php

		$content .= ob_get_clean();

	endif;

	return $content;
}
add_filter( 'the_content', 'wpc_2017_add_to_content' );
