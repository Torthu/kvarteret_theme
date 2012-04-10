<?php
/**
 * Template Name: Default Frontpage
 *
 * A custom page template for the frontpage.
 *
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
<?php
// Add custom excerpt length
function custom_excerpt_length($length) {
	return 20;
}
add_filter('excerpt_length', 'custom_excerpt_length');
?>
    <div class="left six_cols content">
      <?php
        global $post;
        $featured = get_posts('numberposts=3&category_name=featured');
        $current_news = get_posts('numberposts=10&category_name=aktuelt,featured');
        ?>
		<div id="featured_news">
			<ul class="all_cols featured news">
			<?php
			  foreach($featured as $post) :
				setup_postdata($post);
				
			?>          
			<li>  
				<div class="wrapper post_thumbnail">
					<?php if ( has_post_thumbnail() ) {?>
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('featured-thumbnail'); ?>
						</a>
					<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/images/featured_image_missing_<?php echo rand(1,2) ?>.png">
						</a>
					<?php } ?>

					<h2><a href="<?php the_permalink(); ?>" class="featured_title"><?php the_title(); ?></a></h2>
				</div>
				<span class="excerpt">
					<?php the_excerpt(); ?>
				</span>
				
			</li>
			<?php endforeach; ?>
			</ul>
        </div>
		<ul class="current_news">
			<?php
			$i = 0;
			$odd_even = "";
			foreach($current_news as $post) :
			  setup_postdata($post);
			  $i++;
				if($i%2 == 0) {
					$odd_even = "right";
				} else {
					$odd_even = "left";
				}
			?>
				<li class="three_cols">
					<?php if ( has_post_thumbnail() ) { ?>
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'current-news-thumbnail' ); ?></a>
					<?php } else { ?>
						<a href="<?php the_permalink(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/images/current_news_image_missing_<?php echo rand(1,2) ?>.png">
						</a>
					<?php } ?>
					<h2><a href="<?php the_permalink(); ?>" class="current_news_title"><?php the_title(); ?></a></h2>
					<?php the_excerpt(); ?>
				</li>
        <?php endforeach; ?>
    </ul>
      
  </div><!-- #content -->
  <?php get_sidebar(); ?>

<?php get_footer(); ?>
