<?php

/**
 * Filter the <body> class.
 */
function wpc_2017_filter_body_class( $classes, $class ) {

	// No point if no sidebar.
	if ( ! wpc_has_sidebar() ) {
		return $classes;
	}

	// See if there is a sidebar ID.
	$sidebar_id = wpc_get_current_sidebar();
	if ( $sidebar_id ) {
		$classes[] = 'has-sidebar';
		$classes[] = 'has-sidebar-' . preg_replace( '/^wpc\-sidebar\-/i', '', $sidebar_id );
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
