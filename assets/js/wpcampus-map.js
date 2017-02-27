jQuery(document).ready(function($) {

	// Get the map element.
	var $wpc_map = jQuery( '#wpcampus-2017-map' );

	// Adjust iframe on init and resize.
	wpcampus_iframe_resize();
	jQuery( window ).resize(function() {
		wpcampus_iframe_resize();
	});

	// Adjust iframe height to fill the screen.
	function wpcampus_iframe_resize() {
		var $wpc_map_height = jQuery(window).height() - $wpc_map.offset().top - 40;
		//$wpc_map.height( $wpc_map_height );
	}
});