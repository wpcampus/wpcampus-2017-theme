<?php

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
	/*register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'wpcampus' ),
		'footer'    => __( 'Footer Menu', 'wpcampus' ),
	));*/

}
add_action( 'after_setup_theme', 'wpc_2017_theme_setup' );

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
