<?php

// Template Name: WPCampus 2017 Livestream

// Add livestream URLs to the page
function wpc_2017_add_livestream_template( $content ) {

	ob_start();

	// Add the template
	?>
	<script id="wpcampus-livestream-template" type="text/x-handlebars-template">
		<div id="wpc-ls-event-{{id}}" class="wpc-ls{{#event_types}} {{.}}{{/event_types}}">
			<h3 class="event-title"><strong>{{{title.rendered}}}</strong></h3>
			{{#session_livestream_url}}
				<div class="callout wpc-ls-callout"><a href="{{session_livestream_url}}" target="_blank">Watch the livestream</a></div>
			{{/session_livestream_url}}
			{{^session_livestream_url}}
				<p><em><strong>This event does not have a livestream.</strong></em></p>
			{{/session_livestream_url}}
			{{#if event_speakers}}<div class="event-speakers">{{#each event_speakers}}{{#unless @first}}, {{/unless}}<span class="event-speaker">{{post_title}}</span>{{/each}}</div>{{/if}}
			<div class="event-dt">{{event_time_display}}</div>
			<a href="{{link}}">View session details</a>
			{{#if session_categories}}<div class="event-categories">{{#each session_categories}}{{#unless @first}}, {{/unless}}{{.}}{{/each}}</div>{{/if}}
			{{#event_links}}{{body}}{{/event_links}}
			<?php /*<iframe src="{{session_livestream_url}}" style="width:100%;height:600px;"></iframe>*/ ?>
		</div>
	</script>
	<?php

	// Add the schedule holder
	?>
	<div id="wpcampus-livestream"></div>
	<?php

	return $content . ob_get_clean();
}
add_filter( 'the_content', 'wpc_2017_add_livestream_template' );

get_template_part( 'index' );
