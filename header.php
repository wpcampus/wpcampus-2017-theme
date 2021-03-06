<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php

	wp_head();

	/*<!-- Facebook Pixel Code -->
	<script>
		!function(f,b,e,v,n,t,s)
		{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window,document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1843264549234403');
		fbq('track', 'PageView');
	</script>
	<?php

	do_action( 'wpcampus_facebook_pixel' );

	<noscript>
		<img height="1" width="1" src="https://www.facebook.com/tr?id=1843264549234403&ev=PageView&noscript=1"/>
	</noscript>
	<!-- End Facebook Pixel Code -->*/

	?>
</head>
<body <?php body_class(); ?>>
	<?php

	// Print network banner.
	if ( function_exists( 'wpcampus_print_network_banner' ) ) {
		wpcampus_print_network_banner( array(
			'skip_nav_id' => 'wpc-main',
		));
	}

	?>
	<div id="wpc-wrapper">
		<?php

		// Get white social media icons.
		$white_social_media_icons = wpc_get_social_media_icons( 'white' );

		?>
		<div role="navigation" id="wpc-2017-main-menu">
			<button class="wpc-toggle-menu" data-toggle="wpc-2017-main-menu" aria-label="<?php _e( 'Toggle menu', 'wpcampus' ); ?>">
				<div class="toggle-icon">
					<div class="bar one"></div>
					<div class="bar two"></div>
					<div class="bar three"></div>
				</div>
				<div class="open-menu-label"><?php _e( 'Menu', 'wpcampus' ); ?></div>
				<div class="close-menu-label"><?php _e( 'Close', 'wpcampus' ); ?></div>
			</button>
			<?php

			// Print social media icons.
			echo $white_social_media_icons;

			// Print main menu.
			wp_nav_menu( array(
				'theme_location'    => 'primary',
				'container'         => false,
			));

			?>
		</div>
		<div role="navigation" id="wpc-banner">
			<div class="inside">
				<?php

				// Print banner menu.
				wp_nav_menu( array(
					'theme_location'    => 'banner',
					'container'         => false,
				));

				// Print social media icons.
				echo $white_social_media_icons;

				?>
			</div>
		</div>

		<div role="banner" id="wpc-header">
			<div class="inside">
				<div role="navigation" class="wpc-header-menu wpc-header-left">
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
						<li<?php echo is_page( 'watch' ) ? ' class="current"': null; ?>><a href="/watch/"><?php _e( 'Watch', 'wpcampus' ); ?></a></li>
					</ul>
				</div>
				<a class="wpc-logo" href="/"><span class="for-screen-reader"><?php printf( __( '%1$s: Where %2$s Meets Higher Education - July 14-15, 2017 - Buffalo, New York', 'wpcampus' ), 'WPCampus', 'WordPress' ); ?></span></a>
				<div role="navigation" class="wpc-header-menu wpc-header-right">
					<ul class="menu">
						<li class="has-submenu<?php echo ( is_page( 'location' ) || is_page( 'hotels' ) || is_page( 'transportation' ) ) ? ' current': null; ?>">
							<a href="/location/">Buffalo</a>
							<ul class="submenu">
								<li<?php echo is_page( 'location' ) ? ' class="current"': null; ?>><a href="/location/"><?php _e( 'Venue', 'wpcampus' ); ?></a></li>
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
		<div role="main" id="wpc-main">
			<div class="inside">
				<div class="wpc-content">
					<?php

					// Print breadcrumbs.
					if ( ! is_page( 'map' ) ) {
						echo wpcampus_get_breadcrumbs_html();
					}

					// Don't add callout to certain pages.
					if ( ! is_singular( 'post' )
						&& ! is_singular( 'schedule' )
					    && ! is_page( 'map' )
					    && ! is_page( 'tickets' )
					    && ! is_page( 'watch' )
					    && ! is_single( 'wordpress-in-education-survey' ) ) :

						wpcampus_2017_print_main_callout();

					endif;
