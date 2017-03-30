(function( $ ) {
	'use strict';

	// Process the notifications.
	$.get( 'https://wpcampus.org/wp-json/wp/v2/notifications' ).done(function( data ) {

		// Get the template HTML.
		var template = $( '#wpc-notification-template' ).html();
		Mustache.parse( template );

		// Render the template.
		var rendered = Mustache.render( template, data );

		// Add the result to the page.
		$( '#wpc-notification-wrapper' ).html( rendered ).fadeIn();

	});

})( jQuery );