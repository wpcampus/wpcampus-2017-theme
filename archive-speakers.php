<?php

get_header();

// Don't print the meta.
remove_action( 'wpcampus_2017_after_article_heading', 'wpcampus_2017_print_article_meta' );

// Print speaker meta.
function wpcampus_2017_archive_speaker_meta() {

	// Get the speaker meta.
	$speaker_id = get_the_ID();
	$speaker_position = get_post_meta( $speaker_id, 'conf_sch_speaker_position', true );
	$speaker_company = get_post_meta( $speaker_id, 'conf_sch_speaker_company', true );

	// Get the speaker social media.
	$speaker_twitter = get_post_meta( $speaker_id, 'conf_sch_speaker_twitter', true );
	$speaker_linkedin = get_post_meta( $speaker_id, 'conf_sch_speaker_linkedin', true );

	?>
	<div class="article-speaker">
		<?php

		// Print speaker meta.
		if ( $speaker_position || $speaker_company ) :

			?>
			<div class="article-speaker-meta">
				<?php

				// Print the speaker position.
				if ( $speaker_position ) :
					?><span class="speaker-position"><?php echo $speaker_position; ?></span><?php
				endif;

				// Print the speaker company.
				if ( $speaker_company ) :

					if ( $speaker_position ) {
						echo ', ';
					}

					// Add the company URL.
					$speaker_company_url = get_post_meta( $speaker_id, 'speaker_company_url', true );
					if ( $speaker_company_url ) {
						$speaker_company = '<a href="' . $speaker_company_url . '">' . $speaker_company . '</a>';
					}

					?><span class="speaker-company"><?php echo $speaker_company; ?></span><?php
				endif;

				?>
			</div>
			<?php

		endif;

		if ( $speaker_twitter || $speaker_linkedin ) :

			?>
			<ul class="article-speaker-social-media">
				<?php

				foreach ( array( 'twitter', 'linkedin' ) as $social ) :

					// Build social media URL and label.
					$social_url = '';
					$social_label = '';

					if ( 'twitter' == $social ) {
						$social_url = "https://twitter.com/{$speaker_twitter}";
						$social_label = '@' . str_replace( '@', '', $speaker_twitter );
					} elseif ( 'linkedin' == $social ) {
						$social_url = $speaker_linkedin;
						$social_label = 'LinkedIn';
					}

					if ( $social_label ) :

						?>
						<li class="social-media <?php echo $social; ?>"><a href="<?php echo $social_url; ?>"><i class="conf-sch-icon conf-sch-icon-<?php echo $social; ?>"></i> <span class="icon-label"><?php echo $social_label; ?></span></a></li>
						<?php
					endif;
				endforeach;

				?>
			</ul>
			<?php
		endif;

		?>
	</div>
	<?php
}
add_action( 'wpcampus_2017_before_article_content', 'wpcampus_2017_archive_speaker_meta' );

function wpcampus_2017_archive_speaker_events() {

	if ( ! class_exists( 'Conference_Schedule_Speaker' ) ) {
		return;
	}

	// Get speaker.
	$speaker = new Conference_Schedule_Speaker( get_the_ID() );

	// Get the events
	$events = $speaker->get_events();
	if ( ! $events ) {
		return;
	}

	// Build events with links.
	$event_links = array();

	foreach ( $events as $event ) {
		$event_links[] = '<a href="' . get_permalink( $event->ID ) . '">' . $event->post_title . '</a>';
	}

	// Print events, separated by comma.
	?>
	<div class="article-speaker-sessions">
		<span class="article-speaker-session-label"><?php echo _n( 'Session:', 'Sessions:', count( $event_links ), 'wpcampus' ); ?></span>
		<span class="article-speaker-session-events"><?php echo implode( ',', $event_links ); ?></span>
	</div>
	<?php

}
add_action( 'wpcampus_2017_after_article_content', 'wpcampus_2017_archive_speaker_events' );

if ( have_posts() ) :

	?>
	<div class="wpc-articles">
		<?php

		// Setup article args.
		$args = array(
			'link_to_post'  => false,
			'print_content' => true,
		);

		while ( have_posts() ) :
			the_post();

			wpcampus_2017_print_article( $args );

		endwhile;

		?>
	</div>
	<?php

endif;

get_footer();
