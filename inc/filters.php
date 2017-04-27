<?php

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
add_filter( 'the_title', 'wpc_2017_filter_post_title' );

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
