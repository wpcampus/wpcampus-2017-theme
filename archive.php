<?php

get_header();

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

			wpcampus_2017_print_article();

		endwhile;

		?>
	</div>
	<?php

endif;

get_footer();
