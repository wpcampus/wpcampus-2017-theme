<?php

get_header();

// Setup article args.
$args = array();

// Don't link to post or print meta for schedule or speakers.
if ( is_post_type_archive( array( 'schedule', 'speakers' ) ) ) {
	$args['link_to_post'] = false;
	remove_action( 'wpcampus_2017_after_article_heading', 'wpcampus_2017_print_article_meta' );
}

if ( have_posts() ) :

	// Add category header.
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$category = array_shift( $categories );
		if ( ! empty( $category ) ) :
			?><div class="callout archive-category"><?php echo $category->name; ?></div><?php
		endif;
	}

	?>
	<div class="wpc-articles">
		<?php

		while ( have_posts() ) :
			the_post();

			wpcampus_2017_print_article( $args );

		endwhile;

		?>
	</div>
	<?php

endif;

get_footer();
