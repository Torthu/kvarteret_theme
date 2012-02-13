<?php
/**
 * Template Name: Events
 * The Template for displaying dak_event_wp events, festival and agenda
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>

			<h1 class="entry-title"><?php echo the_title(); ?></h1>
			<?php echo dew_agenda_menu_shortcode_handler() ?>
			<div id="post-<?php the_ID(); ?>" class="left six_cols content">
				<!--<h1 class="entry-title"><?php echo the_title(); ?></h1>-->

<!-- # agenda or ordinary page -->

				<?php echo dew_agenda_shortcode_handler(array(
					'dayspan' => 14
				)); ?>

<!-- #end agenda or ordinary page -->

			</div>
			<div class="right four_cols widget" role="complementary">
				<?php dynamic_sidebar( 'primary-widget-area' ) ?>
			</div>				
<?php get_footer(); ?>
