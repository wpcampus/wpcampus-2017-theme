<?php

get_header();

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();

		// Print title on certain pages.
		if ( is_single() ) :

			?>
			<h1><?php the_title(); ?></h1>
			<?php

			// Don't print on certain pages.
			if ( ! is_singular( array( 'schedule', 'speakers' ) ) ) {
				wpcampus_2017_print_article_meta();
			}

		endif;

		the_content();

		/*if ( is_single() ) {
			echo 'previous';
			echo get_previous_posts_link();// __( 'Previous post', 'wpcampus' ) );
			echo get_next_posts_link();// __( 'Next post', 'wpcampus' ) );
			echo 'next';
		}*/

	endwhile;
endif;

do_action( 'wpc_add_after_content' );

get_footer();
