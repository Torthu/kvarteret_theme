<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
	<div class="all_cols" role="main">
		<?php if(has_post_thumbnail()) { ?>
			<div class="wrapper post_thumbnail">
				<?php the_post_thumbnail('full-thumbnail'); ?>
				<h1 class="article post_thumbnail"><?php the_title(); ?></h1>
			</div>	
        <?php } else { ?>
			<h1><?php the_title(); ?></h1>
		<?php } ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="article meta">
				<?php echo the_date(); ?> - 
				av <?php
					$custom_author = get_post_meta($post->ID, "article_author", true);
					$curauth = get_the_author();
					if ( $custom_author ) {
						echo $custom_author;
					}
					else {
						echo $curauth;
					}
					?>
			</div>
			<div class="six_cols center article content">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
			</div>
		</div>
				<!--<div id="standard_right_menu" class="widget-area">
					<!--Publisert <?php echo the_date(); ?> <br />
					Skrevet av <?php
						$custom_author = get_post_meta($post->ID, "article_author", true);
						$curauth = get_the_author();
						if ( $custom_author ) {
						  echo $custom_author;
						}
						else {
						  echo $curauth;
						}
					?>
					
					<h2>Abonner på nytt fra Kvarteret</h2>
					<ul class="article_feed_icons">
						<li><a href="http://kvarteret.no/feed">RSS</a></li>
						<li><a href="https://www.facebook.com/Kvarteret">Facebook</a></li>
						<li><a href="http://twitter.com/#!/kvarteret">Twitter</a></li>
					</ul>
				</div>
				
				<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
					<div id="entry-author-info">
						<div id="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyten_author_bio_avatar_size', 60 ) ); ?>
						</div><!-- #author-avatar 
						<div id="author-description">
							<h2><?php printf( esc_attr__( 'About %s', 'twentyten' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
							<div id="author-link">
								<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
									<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyten' ), get_the_author() ); ?>
								</a>
							</div><!-- #author-link	
						</div><!-- #author-description -->
					</div><!-- #entry-author-info -->
<?php endif; ?>
				</div><!-- #post-## -->


<?php endwhile; // end of the loop. ?>

</div>
<?php get_footer(); ?>
