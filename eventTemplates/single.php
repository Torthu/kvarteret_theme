<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

//require_once('dew_template.php');

// if this is a full event, attach wp_title filter
//require_once('../../../plugins/dak_event_plugin/dew_shell_classes.php');
$event_id = 0;
$event_id = (empty($_GET['event_id'])) ? $wp_query->get('event_id') : $_GET['event_id'];
$event_id = intval($event_id);

if ($event_id > 0) {
	$eventOptions = get_option('optionsDakEventsWp');
	$client = new eventsCalendarClient($eventOptions['eventServerUrl'], null, $eventOptions['cache'], $eventOptions['cacheTime']);

	$arr = $client->event($event_id);
	$rawEvent = $arr->data[0];

	add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);
}

if ($event_id > 0) {
	$dew_title = $rawEvent->title;
	$title = apply_filters('the_title', $dew_title);
} else {
	$title = the_title('', '', false);
}

get_header(); ?>
				<?php echo dew_agenda_menu_shortcode_handler() ?>
				<?php
					$event = new DEW_event($rawEvent);
					if($event->hasPrimaryPicture()) {
						$eventPic = DEW_tools::getPicture($event->getPrimaryPicture(), 960, 400);
					?>
						<div class="wrapper post_thumbnail">
							<img src="<?=home_url();?>/wp-content/uploads<?=$eventPic['relative'];?>" alt="" />';
							<h1 class="article post_thumbnail"><?=$title;?></h1>
						</div>
					<?php } else { ?>
						<h1><?php echo $title; ?></h1>
					<?php } ?>
				
				<div id="post-<?php the_ID(); ?>" class="left six_cols content"><!-- # event page -->

					<?php if ( $event_id > 0 ): ?>
						<?php echo dew_fullevent_shortcode_handler (array('event_id' => $event_id, 'no_title' => true, 'exclude_metadata' => true)) ?>

					<!-- # end event page -->
					<?php endif ?>
				</div><!-- end #left_content -->

				<div class="right four_cols widget" role="complementary">
					<?php if ( !empty($rawEvent) ): 
						do_action('kvarteret_event_detailbox', $rawEvent, $client);
					endif ?>
				</div>
<?php get_footer(); ?>
