<?php

// Include filters.
require_once( STYLESHEETPATH . '/inc/filters.php' );

// Include admin file.
if ( is_admin() ) {
	require_once( STYLESHEETPATH . '/inc/admin.php' );
}

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
		'banner'    => __( 'Banner Menu', 'wpcampus' ),
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
	$wpcampus_version = '0.29';

	// Get the directory.
	$wpcampus_dir = trailingslashit( get_stylesheet_directory_uri() );

	// Load the conference schedule icons.
	wp_enqueue_style( 'conf-schedule-icons' );

	// Load Fonts.
	wp_enqueue_style( 'wpcampus-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:600,400,300' );

	// Enqueue the base styles.
	wp_enqueue_style( 'wpcampus', $wpcampus_dir . 'assets/css/styles.min.css', array( 'wpcampus-fonts' ), $wpcampus_version, 'all' );

	// Register modernizr.
	wp_register_script( 'modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js' );

	// Enqueue the main script - goes in footer.
	wp_enqueue_script( 'wpcampus', $wpcampus_dir . 'assets/js/wpcampus.min.js', array( 'jquery', 'modernizr' ), $wpcampus_version, true );

	// Add our iframe script.
	/*if ( is_page_template( 'template-map.php' ) ) {
		wp_enqueue_script( 'wpcampus-map', $wpcampus_dir . 'assets/js/wpcampus-map.min.js', array( 'jquery' ), null, true );
	}*/
}
add_action( 'wp_enqueue_scripts', 'wpc_2017_enqueue_scripts', 100 );

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

	// Check the layout setting.
	$post_id = get_the_ID();
	if ( $post_id ) {

		// Get the layout setting.
		$layout = get_post_meta( $post_id, 'wpc_2017_layout', true );

		// If full width, we don't want the sidebar.
		if ( 'fullwidth' == $layout ) {
			return false;
		}
	}

	// Not on our map page.
	if ( is_page_template( 'template-map.php' ) ) {
		return false;
	}

	return true;
}

/**
 * Get markup for list of social media icons.
 *
 * @param   $color - string - color of icon, black is default.
 */
function wpc_get_social_media_icons( $color = 'black' ) {

	// Get the theme directory.
	$theme_dir = trailingslashit( get_template_directory_uri() );

	// If color, prefix with dash.
	if ( $color ) {
		$color = "-{$color}";
	}

	$social_media = array(
		'slack' => array(
			'href'  => 'https://wpcampus.org/get-involved/',
			'label' => sprintf( __( 'Join %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Slack' ),
		),
		'twitter' => array(
			'href'  => 'https://twitter.com/wpcampusorg',
			'label' => sprintf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Twitter' ),
		),
		'facebook' => array(
			'href'  => 'https://www.facebook.com/wpcampus',
			'label' => sprintf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Facebook' ),
		),
		'youtube' => array(
			'href'  => 'https://www.youtube.com/wpcampusorg',
			'label' => sprintf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'YouTube' ),
		),
		'lanyrd' => array(
			'href'  => 'http://lanyrd.com/2017/wpcampus/',
			'label' => sprintf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'Lanyrd' ),
		),
		'github' => array(
			'href'  => 'https://github.com/wpcampus/',
			'label' => sprintf( __( 'Follow %1$s on %2$s', 'wpcampus' ), 'WPCampus', 'GitHub' ),
		),
	);

	// Build the items output.
	$social_items = array();
	foreach ( $social_media as $key => $social ) {
		$social_img = $theme_dir . "assets/images/{$key}{$color}.svg";
		$social_items[] = sprintf( '<li><a class="%1$s" href="%2$s"><img src="%3$s" alt="%4$s" /></a></li>', $key, $social['href'], $social_img, $social['label'] );
	}

	if ( ! empty( $social_items ) ) {
		return '<ul class="social-media-icons">' . implode( '', $social_items ) . '</ul>';
	}

	return null;
}

// Get the post type archive title
function wpcampus_get_post_type_archive_title( $post_type = '' ) {

	// Make sure we have a post type.
	if ( ! $post_type ) {
		$post_type = get_query_var( 'post_type' );
	}

	// Get post type archive title
	if ( $post_type ) {

		// Make sure its not an array
		if ( is_array( $post_type ) ) {
			$post_type = reset( $post_type );
		}

		// Get the post type data
		if ( $post_type_obj = get_post_type_object( $post_type ) ) {

			// Get the title
			$title = apply_filters( 'post_type_archive_title', $post_type_obj->labels->name, $post_type );

			// Return the title
			return apply_filters( 'wpcampus_post_type_archive_title', $title, $post_type );

		}
	}

	return null;
}

// Get breadcrumbs
function wpcampus_get_breadcrumbs_html() {

	// Build array of breadcrumbs
	$breadcrumbs = array();

	// Not for front page
	if ( is_front_page() ) {
		return false;
	}

	// Get post type
	$post_type = get_query_var( 'post_type' );

	// Make sure its not an array
	if ( is_array( $post_type ) ) {
		$post_type = reset( $post_type );
	}

	// Add home
	$breadcrumbs[] = array(
		'url'   => get_bloginfo( 'url' ),
		'label' => __( 'Home', 'wpcampus' ),
	);

	// Add archive(s)
	if ( is_archive() ) {

		if ( is_post_type_archive() ) {

			// Add crumb to schedule page.
			if ( is_post_type_archive( 'speakers' ) ) {
				$breadcrumbs[] = array(
					'url'   => '/schedule/',
					'label' => 'Schedule',
				);
			}

			// Get the info
			$post_type_archive_link = get_post_type_archive_link( $post_type );
			$post_type_archive_title = wpcampus_get_post_type_archive_title( $post_type );

			// Add the breadcrumb
			if ( $post_type_archive_link && $post_type_archive_title ) {
				$breadcrumbs[] = array(
					'url' 	=> $post_type_archive_link,
					'label' => $post_type_archive_title,
				);
			}
		} else {

			// Add crumb to announcements page.
			$breadcrumbs[] = array(
				'url'	=> '/announcements/',
				'label'	=> 'Announcements',
			);

			// Add category.
			if ( is_category() ) {

				$categories = get_the_category();
				if ( ! empty( $categories ) ) {
					$category = array_shift( $categories );
					if ( ! empty( $category ) ) {

						$breadcrumbs[] = array(
							'url'	=> get_category_link( $category->term_id ),
							'label'	=> $category->name,
						);
					}
				}
			}
		}
	} else {

		// Add links to announcements.
		if ( is_singular( 'schedule' ) ) {

			// Add crumb to schedule page.
			$breadcrumbs[] = array(
				'url'	=> '/schedule/',
				'label'	=> 'Schedule',
			);

		} elseif ( is_singular( 'speakers' ) ) {

			// Add crumb to schedule page.
			$breadcrumbs[] = array(
					'url'	=> '/speakers/',
					'label'	=> 'Speakers',
			);

		} elseif ( is_single() ) {

			// Add crumb to announcements page.
			$breadcrumbs[] = array(
				'url'	=> '/announcements/',
				'label'	=> 'Announcements',
			);

		} elseif ( is_singular() ) {

			// Get the information
			$post_type_archive_link = get_post_type_archive_link( $post_type );
			$post_type_archive_title = wpcampus_get_post_type_archive_title( $post_type );

			if ( $post_type_archive_link ) {
				$breadcrumbs[] = array(
					'url'	=> $post_type_archive_link,
					'label'	=> $post_type_archive_title,
				);
			}
		}

		// Print info for the current post
		$post = get_queried_object();
		if ( $post && is_a( $post, 'WP_Post' ) ) {

			// Get ancestors
			$post_ancestors = isset( $post ) ? get_post_ancestors( $post->ID ) : array();

			// Add the ancestors
			foreach ( $post_ancestors as $post_ancestor_id ) {

				// Add ancestor
				$breadcrumbs[] = array(
					'ID' 	=> $post_ancestor_id,
					'url' 	=> get_permalink( $post_ancestor_id ),
					'label' => get_the_title( $post_ancestor_id ),
				);

			}

			// Add current page - if not home page
			if ( isset( $post ) ) {
				$breadcrumbs['current'] = array(
					'ID'	=> $post->ID,
					'url'	=> get_permalink( $post ),
					'label'	=> get_the_title( $post->ID ),
				);
			}
		}
	}

	// Filter the breadcrumbs
	$breadcrumbs = apply_filters( 'wpcampus_breadcrumbs', $breadcrumbs );

	// Build breadcrumbs HTML
	$breadcrumbs_html = null;

	foreach ( $breadcrumbs as $crumb_key => $crumb ) {

		// Make sure we have what we need
		if ( empty( $crumb['label'] ) ) {
			continue;
		}

		// If no string crumb key, set as ancestor
		if ( ! $crumb_key || is_numeric( $crumb_key ) ) {
			$crumb_key = 'ancestor';
		}

		// Setup classes
		$crumb_classes = array( $crumb_key );

		// Add if current
		if ( isset( $crumb['current'] ) && $crumb['current'] ) {
			$crumb_classes[] = 'current';
		}

		$breadcrumbs_html .= '<li role="menuitem"' . ( ! empty( $crumb_classes ) ? ' class="' . implode( ' ', $crumb_classes ) . '"' : null ) . '>';

		// Add URL and label
		if ( ! empty( $crumb['url'] ) ) {
			$breadcrumbs_html .= '<a href="' . $crumb['url'] . '"' . ( ! empty( $crumb['title'] ) ? ' title="' . $crumb['title'] . '"' : null ) . '>' . $crumb['label'] . '</a>';
		} else {
			$breadcrumbs_html .= $crumb['label'];
		}

		$breadcrumbs_html .= '</li>';

	}

	// Wrap them in nav
	$breadcrumbs_html = '<div id="wpcampus-breadcrumbs">
		<nav class="breadcrumbs" role="navigation" aria-label="Breadcrumbs">
			<ul>' . $breadcrumbs_html . '</ul>
		</nav>
	</div>';

	//  We change up the variable so it doesn't interfere with global variable
	return $breadcrumbs_html;
}

function wpcampus_2017_print_article( $args = array() ) {

	// Define the defaults.
	$defaults = array(
		'heading'       => 'h2',
		'link_to_post'  => true,
		'print_content' => false,
	);

	// Merge incoming with defaults.
	$args = wp_parse_args( $args, $defaults );

	// Get post information.
	$post_id = get_the_ID();
	$post_permalink = get_permalink( $post_id );
	$post_thumbnail_id = get_post_thumbnail_id( $post_id );

	?>
	<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
		<<?php echo $args['heading']; ?>><?php

		if ( $args['link_to_post'] ) {
			?><a href="<?php echo $post_permalink; ?>"><?php the_title(); ?></a><?php
		} else {
			the_title();
		}

		?></<?php echo $args['heading']; ?>>
		<?php

		do_action( 'wpcampus_2017_after_article_heading' );

		// Get the featured image.
		$featured_image = $post_thumbnail_id > 0 ? wp_get_attachment_image_src( $post_thumbnail_id, 'thumbnail' ) : '';
		if ( ! empty( $featured_image[0] ) ) :
			?><img class="article-thumbnail" src="<?php echo $featured_image[0]; ?>" /><?php
		endif;

		do_action( 'wpcampus_2017_before_article_content' );

		if ( $args['print_content'] ) {
			the_content();
		} else {
			the_excerpt();
		}

		do_action( 'wpcampus_2017_after_article_content' );

		?>
	</article>
	<?php
}

function wpcampus_2017_print_article_meta() {

	// Get categories.
	$categories = get_the_category_list( ', ' );

	?>
	<div class="article-meta">
		<span class="article-time"><?php wpcampus_2017_print_article_time(); ?></span>
		<?php

		if ( $categories ) :
			?> - <span class="article-categories"><?php echo $categories; ?></span><?php
		endif;

		?>
	</div>
	<?php

}
add_action( 'wpcampus_2017_after_article_heading', 'wpcampus_2017_print_article_meta' );

function wpcampus_2017_print_article_time() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	}

	echo sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date()
	);

}

function wpcampus_2017_print_main_callout() {
	//wpcampus_2017_print_ed_survey_callout();
}

function wpcampus_2017_print_ed_survey_callout() {

	?>
	<div class="callout" style="text-align:center;"><h2>The "WordPress in Education" Survey</h2><p>After an overwhelming response to our 2016 survey, WPCampus is back this year to dig a little deeper on key topics that schools and campuses care about most when it comes to WordPress and website development. We’d love to include your feedback in our results this year. The larger the data set, the more we all benefit. <strong>The survey will close on June 23rd, 2017.</strong></p><a class="button block" style="color:#fff;margin-bottom:0;" href="https://2017.wpcampus.org/announcements/wordpress-in-education-survey/">Take the "WordPress in Education" survey</a></div>
	<?php
}
