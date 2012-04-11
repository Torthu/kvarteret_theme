<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */
?>

<?php if(is_front_page()) : ?>
	<div class="right widget four_cols" role="complementary">
		<?php // Get next Helhus
			$dew_options = DEW_Management::getOptions();
			$client = new eventsCalendarClient ($dew_options['eventServerUrl'], null, $dew_options['cache'], $dew_options['cacheTime']);

			$festivalSearch = $client->festivalList(array('titleContains' => 'helhus', 'limit' => 1));

			if (!empty($festivalSearch->data[0]->id)) { 
				$helhus = $festivalSearch->data[0];
				print_r($festivalSearch);
		?>

				<a href="<?php echo $helhus->url; ?>" class="large bebas helhus">Neste Helhus<br /><small><?php echo date("D, d M Y", strtotime($helhus->startDate)); ?> CC: <?php echo $helhus->covercharge; ?></small></a>
				
			<?php } // startDate, covercharge, url
		?>
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'frontpage' ); ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(is_page('arrangere') || in_array(499, get_post_ancestors($post))) : ?>
	<div class="right widget four_cols" role="complementary">
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'arrangere' ); ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(is_page('bli-med') || in_array(13, get_post_ancestors($post))) : ?>
	<div class="right widget four_cols" role="complementary">
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'bli-med' ); ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(is_page('samarbeidspartnere') || in_array(15, get_post_ancestors($post))) : ?>
	<div class="right widget four_cols" role="complementary">
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'samarbeidspartnere' ); ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(is_page('om-kvarteret') || in_array(19, get_post_ancestors($post))) : ?>
	<div class="right widget four_cols" role="complementary">
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'samarbeidspartnere' ); ?>
		</ul>
	</div>
<?php endif; ?>

<?php if(is_page('program')) : ?>
	<div class="right widget four_cols" role="complementary">
		<ul class="widget_ul">
			<?php dynamic_sidebar( 'program' ); ?>
		</ul>
	</div>
<?php endif; ?>
