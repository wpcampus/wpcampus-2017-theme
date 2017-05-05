<?php

// URL for the tagboard.
$tweets_tagboard = 'https://tagboard.com/wpcampus/300756';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<a href="#wpc-main" id="skip-to-content" tabindex="1"><?php _e( 'Skip to Content', 'wpcampus' ); ?></a>
	<div id="wpc-wrapper">

		<div id="wpc-2017-main-menu">
			<div class="toggle-main-menu">
				<div class="toggle-icon">
					<div class="bar one"></div>
					<div class="bar two"></div>
					<div class="bar three"></div>
				</div>
				<div class="open-menu-label"><?php _e( 'Menu', 'wpcampus' ); ?></div>
				<div class="close-menu-label"><?php _e( 'Close', 'wpcampus' ); ?></div>
			</div>
			<?php

			// Print main menu.
			wp_nav_menu( array(
				'theme_location'    => 'primary',
				'container'         => false,
			));

			?>
		</div>

		<div id="wpc-banner">
			<div class="inside">
				<ul class="menu">
					<li><a href="https://wpcampus.org/get-involved/"><?php _e( 'Community', 'wpcampus' ); ?></a></li>
					<li><a href="<?php echo $tweets_tagboard; ?>"><?php _e( 'Tweets', 'wpcampus' ); ?></a></li>
					<li<?php echo is_page( 'contact' ) ? ' class="current"': null; ?>><a href="/contact/"><?php _e( 'Contact', 'wpcampus' ); ?></a></li>
				</ul>
				<?php wpc_print_social_media_icons( 'white' ); ?>
			</div>
		</div>

		<div id="wpc-header">
			<div class="inside">
				<div class="wpc-header-menu wpc-header-left">
					<ul class="menu">
						<li class="has-submenu<?php echo is_page( 'about' ) || is_home() ? ' current': null; ?>">
							<a href="/about/"><?php _e( 'About', 'wpcampus' ); ?></a>
							<ul class="submenu">
								<li<?php echo is_home() ? ' class="current"': null; ?>><a href="/announcements/"><?php _e( 'Announcements', 'wpcampus' ); ?></a></li>
							</ul>
						</li>
						<li class="has-submenu<?php echo ( is_page( 'schedule' ) || is_singular( 'schedule' ) || is_post_type_archive( 'speakers' ) ) ? ' current': null; ?>">
							<a href="/schedule/"><?php _e( 'Schedule', 'wpcampus' ); ?></a>
							<ul class="submenu">
								<li<?php echo is_post_type_archive( 'speakers' ) ? ' class="current"': null; ?>><a href="/speakers/"><?php _e( 'Speakers', 'wpcampus' ); ?></a></li>
							</ul>
						</li>
						<li<?php echo is_page( 'tickets' ) ? ' class="current"': null; ?>><a href="/tickets/"><?php _e( 'Tickets', 'wpcampus' ); ?></a></li>
					</ul>
				</div>
				<a class="wpc-logo" href="/"><span class="for-screen-reader"><?php printf( __( '%1$s: Where %2$s Meets Higher Education - July 14-15, 2017 - Buffalo, New York', 'wpcampus' ), 'WPCampus', 'WordPress' ); ?></span></a>
				<div class="wpc-header-menu wpc-header-right">
					<ul class="menu">
						<li class="has-submenu<?php echo ( is_page( 'location' ) || is_page( 'hotels' ) || is_page( 'transportation' ) ) ? ' current': null; ?>">
							<a href="/location/">Buffalo</a>
							<ul class="submenu">
								<li<?php echo is_page( 'location/hotels' ) ? ' class="current"': null; ?>><a href="/location/hotels/"><?php _e( 'Hotels', 'wpcampus' ); ?></a></li>
								<li<?php echo is_page( 'location/transportation' ) ? ' class="current"': null; ?>><a href="/location/transportation/"><?php _e( 'Transportation', 'wpcampus' ); ?></a></li>
								<li<?php echo is_page( 'map' ) ? ' class="current"': null; ?>><a href="/map/"><?php _e( 'Map', 'wpcampus' ); ?></a></li>
							</ul>
						</li>
						<li<?php echo is_page( 'attendees' ) ? ' class="current"': null; ?>><a href="/attendees/"><?php _e( 'Attendees', 'wpcampus' ); ?></a></li>
						<li class="has-submenu<?php echo is_page( 'sponsors' ) || is_page( 'sponsors/become-a-sponsor/' ) || is_page( 'sponsors/contact/' ) ? ' current' : null; ?>">
							<a href="/sponsors/"><?php _e( 'Sponsors', 'wpcampus' ); ?></a>
							<ul class="submenu">
								<li<?php echo is_page( 'sponsors/become-a-sponsor/' ) ? ' class="current"': null; ?>><a href="/sponsors/become-a-sponsor/"><?php _e( 'Become A Sponsor', 'wpcampus' ); ?></a></li>
								<li<?php echo is_page( 'sponsors/contact/' ) ? ' class="current"': null; ?>><a href="/sponsors/contact/"><?php _e( 'Contact Us', 'wpcampus' ); ?></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<?php get_template_part( 'partials/hero' ); ?>
		<div id="wpc-main">
			<div class="inside">
				<div class="wpc-content">
					<?php

					// Print breadcrumbs.
					if ( ! is_page( 'map' ) ) {
						echo wpcampus_get_breadcrumbs_html();
					}
