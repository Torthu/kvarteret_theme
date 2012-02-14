<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

$queryYear = null;
$queryMonth = null;

$dateComponents = explode('-', $dew_archive);

if (count($dateComponents) >= 2) {
	$queryYear = intval($dateComponents[0]);
	$queryMonth = intval($dateComponents[1]);
}

if (($queryMonth >= 1) && ($queryMonth <= 12)) {
	$config['start_date'] = sprintf('%04d-%02d-01', $queryYear, $queryMonth);
	$config['end_date'] = sprintf('%04d-%02d-', $queryYear, $queryMonth);

	$config['end_date'] .= date('t' , strtotime($config['start_date']));
}

add_filter('wp_title', 'dew_arrangement_template_wp_title', 5, 3);

$dew_title  = 'Events in ' . $month[sprintf('%02d', $queryMonth)] . ' ' . $queryYear;
$title = apply_filters('the_title', $dew_title);

get_header(); ?>
				<?php echo dew_agenda_menu_shortcode_handler() ?>
				<h1 class="entry-title"><?php echo $title ?></h1>
				
				<div id="post-<?php the_ID(); ?>" class="left six_cols content">

<!-- # agenda or ordinary page -->
					<?php echo dew_agenda_shortcode_handler($config); ?>

<!-- #end agenda or ordinary page -->

				</div>

				<div class="right four_cols widget" role="complementary">
						<?php dynamic_sidebar( 'primary-widget-area' ) ?>
				</div>				

<?php get_footer(); ?>
