<?php

// Get some site information.
$blog_url = get_bloginfo( 'url' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a href="#wpc-main" id="skip-to-content"><?php _e( 'Skip to Content', 'wpcampus' ); ?></a>
	<div id="wpc-wrapper">
		<div id="wpc-hero">
			<div class="wpc-notification">
				<div class="inside">
					<div class="wpc-notification-message">
						<p><span class="information"></span> Our <a href="https://2017.wpcampus.org/call-for-speakers/">call for speakers</a> is open until <strong>March 24, 2017</strong>.</p>
					</div>
				</div>
			</div>
		</div>
		<div id="wpc-banner"></div>
		<div id="wpc-header">
			<div class="inside">

				<div class="wpc-header-left">
					<div class="wpc-header-menu">
						<ul class="menu">
							<li<?php echo is_page( 'about' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/about/">About</a></li>
							<li<?php echo is_page( 'watch' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/watch/">Watch</a></li>
							<li<?php echo ( is_page( 'schedule' ) || is_singular( 'schedule' ) ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/schedule/">Schedule</a></li>
						</ul>
					</div>
				</div>

				<a class="wpc-logo" href="<?php echo $blog_url; ?>"><span class="for-screen-reader"><?php printf( __( '%1$s: Where %2$s Meets Higher Education', 'wpcampus' ), 'WPCampus', 'WordPress' ); ?></span></a>

				<div class="wpc-header-right">
					<div class="wpc-header-menu">
						<ul class="menu">
							<li<?php echo is_page( 'attendees' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/attendees/">Attendees</a></li>
							<li class="has-submenu<?php echo ( is_page( 'venue' ) || is_page( 'hotels' ) || is_page( 'transportation' ) ) ? ' current': null; ?>">
								<a href="<?php echo $blog_url; ?>/venue">Venue</a>
								<ul class="submenu">
									<li<?php echo is_page( 'hotels' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/venue/hotels/">Hotels</a></li>
									<li<?php echo is_page( 'transportation' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/venue/transportation/">Transportation</a></li>
									<li<?php echo is_page( 'map' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/map/">Map</a></li>
								</ul>
							</li>
							<li class="has-submenu<?php echo ( is_page( 'sponsors' ) || is_page( 'become-a-sponsor' ) ) ? ' current': null; ?>">
								<a href="<?php echo $blog_url; ?>/sponsors">Sponsors</a>
								<ul class="submenu">
									<li<?php echo is_page( 'become-a-sponsor' ) ? ' class="current"': null; ?>><a href="<?php echo $blog_url; ?>/sponsors/become-a-sponsor/">Become A Sponsor</a></li>
								</ul>
							</li>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<div id="wpc-main">
			<div class="inside">
				<div class="wpc-content">
