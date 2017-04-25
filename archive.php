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

			// Get post information.
			$post_id = get_the_ID();
			$post_permalink = get_permalink( $post_id );

			?>
			<article id="post-<?php echo $post_id; ?>" <?php post_class(); ?>>
				<h2><a href="<?php echo $post_permalink; ?>"><?php the_title(); ?></a></h2>
				<?php

				wpcampus_2017_print_article_meta();

				the_excerpt();

				?>
			</article>
			<?php

		endwhile;

		?>
	</div>
	<?php

endif;

get_footer();
