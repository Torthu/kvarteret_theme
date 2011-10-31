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

			<div id="content" role="main">
				<h1 class="entry-title"><?php echo the_title(); ?></h1>
				<?php echo dew_agenda_menu_shortcode_handler() ?>
				<div id="left_content">
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<!-- # agenda or ordinary page -->

						<div class="entry-content">

							<?php echo dew_archive_list_shortcode_handler(); ?>

						</div>

<!-- #end agenda or ordinary page -->

					</div>
				  </div>

				<div id="standard_right_menu" class="widget-area" role="complementary">
					<ul class="xoxo">
						<?php dynamic_sidebar( 'primary-widget-area' ) ?>
					</ul>
				</div>				
			</div><!-- #content -->
<?php get_footer(); ?>
