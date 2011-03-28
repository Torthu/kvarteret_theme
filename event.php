<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

// if this is a full event, attach wp_title filter
$event_id = 0;
if (!empty($_GET['event_id']) || $wp_query->get('event_id')) {
	$event_id = (empty($_GET['event_id'])) ? $wp_query->get('event_id') : $_GET['event_id'];
	$event_id = intval($event_id);
}

if ( ! in_array('dak_events_wp/dak_events_wp.php', get_option('active_plugins')) ) {
	// Don't do anything if the dak_events_wp isn't activated
	get_header(); ?>
<div id="content" class="narrowcolumn">
	<h2 class="center">The plugin <dd>dak_events_wp</dd> <em>must</em> be activated before you can use this template</h2>
</div>
<?php
	get_sidebar();
	get_footer();

	exit();
}

if ($event_id > 0) {
	$eventOptions = get_option('optionsDakEventsWp');
	$client = new eventsCalendarClient($eventOptions['eventServerUrl'], null, $eventOptions['cache'], $eventOptions['cacheTime']);
	$event = $client->event($event_id);

	/**
	 * Ouput event or festival title in header, overrides the page's title
	 */
	function dew_event_template_wp_title ($title, $sep, $seplocation) {
		global $event;

		$title = $event->data[0]->title;

		$t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

		$prefix = '';
		if ( !empty($title) ) {
			$prefix = " $sep ";
		}

	 	// Determines position of the separator and direction of the breadcrumb
		if ( 'right' == $seplocation ) { // sep on right, so reverse the order
			$title_array = explode( $t_sep, $title );
			$title_array = array_reverse( $title_array );
			$title = implode( " $sep ", $title_array ) . $prefix;
		} else {
			$title_array = explode( $t_sep, $title );
			$title = $prefix . implode( " $sep ", $title_array );
		}

		return $title;
	}

	add_filter('wp_title', 'dew_event_template_wp_title', 5, 3);
}

if ($event_id > 0) {
	$title = apply_filters('the_title', $event->data[0]->title);
} else {
	$title = the_title('', '', false);
}

get_header(); ?>

			<div id="content" role="main">
				<div id="left_content">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php echo $title; ?></h2>
					<?php } else { ?>
						<h1 class="entry-title"><?php echo $title; ?></h1>
					<?php } ?>

<?php if ( $event_id > 0 ): ?>
<!-- # event page -->

						<div class="entry-content">

						<?php echo dew_fullevent_shortcode_handler (array('event_id' => $event_id, 'no_title' => true)) ?>

						</div>

<!-- # end event page -->
<?php else: ?>
<!-- # agenda page -->

						<div class="entry-content">

						<?php echo dew_agenda_shortcode_handler (array()) ?>

						</div>

<!-- #end agenda page -->
<?php endif ?>
					</div>
				  </div>

<?php get_sidebar(); ?>
			</div><!-- #content -->
<?php get_footer(); ?>
