(function( $ ) {
	'use strict';

	// Changes .svg to .png if doesn't support SVG (Fallback).
	if ( ! Modernizr.svg ) {

		$( 'img[src*="svg"]' ).attr( 'src', function() {
			return $( this ).attr( 'src' ).replace( '.svg', '.png' );
		});
	}

	// Get the main menu.
	var $main_menu = $( '#wpc-2017-main-menu' );

	// Add listener to all elements who have the class to toggle the main menu.
	$main_menu.find( '.toggle-main-menu' ).on( 'touchstart click', function( $event ) {

		// Stop stuff from happening.
		$event.stopPropagation();
		$event.preventDefault();

		// If main menu isn't open, open it.
		if ( ! $( 'body' ).hasClass( 'open-menu' ) ) {

			$( 'body' ).addClass( 'open-menu' );
			$main_menu.find( '.menu' ).slideDown( 400 );

		} else {

			$( 'body' ).removeClass( 'open-menu' );
			$main_menu.find( '.menu' ).hide();

		}
	});
})( jQuery );