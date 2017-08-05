(function( $ ) {
	'use strict';

	// Will hold the template.
	var $wpc_ls_templ = false;

	// Will hold the schedule.
	var $wpc_ls_container = null;

	// When the document is ready...
	$(document).ready(function() {

		// Set the schedule container.
		$wpc_ls_container = $( '#wpcampus-livestream' );

		// Get the templates.
		var $wpc_ls_templ_content = $('#wpcampus-livestream-template').html();
		if ( $wpc_ls_templ_content !== undefined && $wpc_ls_templ_content ) {

			// Parse the template.
			$wpc_ls_templ = Handlebars.compile( $wpc_ls_templ_content );

			// Render the livestream.
			render_wpc_livestream();

		}
	});

	///// FUNCTIONS /////

	// Get/update the livestream.
	function render_wpc_livestream() {

		// Get the livestream information.
		$.ajax( {
			url: wpc_ls.wp_api_route + 'schedule',
			success: function( $schedule_items ) {

				// Build the HTML.
				var $livestream_html = '';

				// Go through each item.
				$.each( $schedule_items, function( $index, $item ) {

					/*
					 * Only active sessions will have a URL
					 * that's either a string or null.
					 *
					 * Inactive sessions wil be marked as false.
					 *
					 * @TODO this could be a problem for schedule
					 * items that aren't sessions, like "Lunch".
					 */
					if ( $item.session_livestream_url !== false ) {

						// Render the templates.
						$livestream_html += $wpc_ls_templ( $item );

					}
				});

				// Add a header.
				if ( ! $livestream_html ) {
					$livestream_html = '<p><em>' + wpc_ls.messages.no_streams + '</em></p>';
				}

				// Replace the container with the template markup.
				$wpc_ls_container.html( $livestream_html );

			}
		});
	}
})( jQuery );