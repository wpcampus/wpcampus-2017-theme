<?php

get_header();

if ( have_posts() ) :

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
