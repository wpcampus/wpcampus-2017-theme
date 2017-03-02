<?php

// Include filters.
require_once( STYLESHEETPATH . '/inc/filters.php' );

/**
 * Set up the theme.
 */
function wpc_2017_theme_setup() {

	// Make theme available for translation.
	load_theme_textdomain( 'wpcampus', get_stylesheet_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	//add_theme_support( 'automatic-feed-links' );

	// Add theme supports.
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	));

	// Register menus.
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'wpcampus' ),
		'footer'    => __( 'Footer Menu', 'wpcampus' ),
	));

}
add_action( 'after_setup_theme', 'wpc_2017_theme_setup' );

/**
 * Register sidebars.
 */
function wpc_2017_register_sidebars() {

	// Register the main sidebar.
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'wpcampus' ),
		'id'            => 'wpc-sidebar-main',
		'description'   => __( 'Widgets in this area will be the default shown on all posts and pages.', 'wpcampus' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
}
add_action( 'widgets_init', 'wpc_2017_register_sidebars' );

/**
 * Setup styles and scripts.
 */
function wpc_2017_enqueue_scripts() {

	// Get the directory.
	$wpcampus_dir = trailingslashit( get_stylesheet_directory_uri() );

	// Load Fonts.
	wp_enqueue_style( 'wpcampus-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:600,400,300' );

	// Enqueue the base styles.
	wp_enqueue_style( 'wpcampus', $wpcampus_dir . 'assets/css/styles.min.css', array( 'wpcampus-fonts' ), null, 'all' );

	// Enqueue modernizr - goes in header.
	wp_enqueue_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );

	// Enqueue the main script file - goes in footer.
	wp_enqueue_script( 'wpcampus', $wpcampus_dir . 'assets/js/wpcampus.min.js', array( 'jquery', 'modernizr' ), null, true );

	// Add our iframe script.
	/*if ( is_page_template( 'template-map.php' ) ) {
		wp_enqueue_script( 'wpcampus-map', $wpcampus_dir . 'assets/js/wpcampus-map.min.js', array( 'jquery' ), null, true );
	}*/
}
add_action( 'wp_enqueue_scripts', 'wpc_2017_enqueue_scripts', 10 );

/**
 * Load favicons.
 */
function wpc_2017_add_favicons() {

	// Set the images folder.
	$favicons_folder = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/images/favicons/';

	// Print the default icons.
	?>
	<link rel="shortcut icon" href="<?php echo $favicons_folder; ?>wpcampus-favicon-60.png" />
	<link rel="apple-touch-icon" href="<?php echo $favicons_folder; ?>wpcampus-favicon-60.png" />
	<?php

	// Set the image sizes.
	$image_sizes = array( 57, 72, 76, 114, 120, 144, 152 );

	foreach ( $image_sizes as $size ) :
		?>
		<link rel="apple-touch-icon" sizes="<?php echo "{$size}x{$size}"; ?>" href="<?php echo $favicons_folder; ?>wpcampus-favicon-<?php echo $size; ?>.png" />
		<?php
	endforeach;
}
add_action( 'wp_head', 'wpc_2017_add_favicons' );
add_action( 'admin_head', 'wpc_2017_add_favicons' );
add_action( 'login_head', 'wpc_2017_add_favicons' );

/**
 * Define which sidebar to use.
 */
function wpc_get_current_sidebar() {
	global $wpc_sidebar_id;

	// See if sidebar ID is already set.
	if ( isset( $wpc_sidebar_id ) ) {
		return $wpc_sidebar_id;
	}

	$wpc_sidebar_id = 'wpc-sidebar-main';

	return $wpc_sidebar_id;
}

/**
 * Returns true/false if we have sidebar.
 */
function wpc_has_sidebar() {

	// Not on our map page.
	if ( is_page_template( 'template-map.php' ) ) {
		return false;
	}

	return true;
}

/**
 * Prints list of social media icons.
 *
 * @param   $color - string - color of icon, black is default.
 */
function wpc_print_social_media_icons( $color = 'black' ) {

	// Get the theme directory.
	$theme_dir = trailingslashit( get_template_directory_uri() );

	// If color, prefix with dash.
	if ( $color ) {
		$color = "-{$color}";
	}

	?>
	<ul class="social-media-icons">
		<li><a class="slack" href="https://wpcampus.org/get-involved/"><img src="<?php echo $theme_dir; ?>assets/images/slack<?php echo $color; ?>.svg" alt="<?php printf( __( 'Join %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Slack' ); ?>" /></a></li>
		<li><a class="twitter" href="https://twitter.com/wpcampusorg"><img src="<?php echo $theme_dir; ?>assets/images/twitter<?php echo $color; ?>.svg" alt="<?php printf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Twitter' ); ?>" /></a></li>
		<li><a class="facebook" href="https://www.facebook.com/wpcampus"><img src="<?php echo $theme_dir; ?>assets/images/facebook<?php echo $color; ?>.svg" alt="<?php printf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Facebook' ); ?>" /></a></li>
		<li><a class="youtube" href="https://www.youtube.com/wpcampusorg"><img src="<?php echo $theme_dir; ?>assets/images/youtube<?php echo $color; ?>.svg" alt="<?php printf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'YouTube' ); ?>" /></a></li>
		<li><a class="lanyrd" href="http://lanyrd.com/2017/wpcampus/"><img src="<?php echo $theme_dir; ?>assets/images/lanyrd<?php echo $color; ?>.svg" alt="<?php printf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Lanyrd' ); ?>" /></a></li>
		<li><a class="github" href="https://github.com/wpcampus/"><img src="<?php echo $theme_dir; ?>assets/images/github<?php echo $color; ?>.svg" alt="<?php printf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'GitHub' ); ?>" /></a></li>
	</ul>
	<?php

}
