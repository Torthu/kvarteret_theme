<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.0
 */

get_header(); ?>
	<div class="all_cols content" role="main">
		<?php if(has_post_thumbnail()) { ?>
			<div class="wrapper post_thumbnail">
				<?php the_post_thumbnail('full-thumbnail'); ?>
				<h1 class="article post_thumbnail"><?php the_title(); ?></h1>
			</div>	
        <?php } else { ?>
			<h1><?php the_title(); ?></h1>
		<?php } ?>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="article meta byline">
				<?php the_post_thumbnail_caption(); ?>
			</div>

			<div class="two_cols left date meta text_right">
				<div class="right date_wrap">
					<span class="bebas day huge right"><?php the_time('d'); ?></span>
					<span class="month"><?php the_time('M'); ?></span>
					<span class="year"><?php the_time('Y'); ?></span>
				</div>
			</div>
			<div class="two_cols right">
				<span class="bebas left author huge">av</span>
				<?php
					$custom_author = get_post_meta($post->ID, "article_author", true);
					$curauth = get_the_author();
					
					$custom_author ? $author = $custom_author : $author = $curauth;
					
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
			<div class="six_cols center cf share">
				<h2>Del</h2>
				<a href="https://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&t=<?php echo urlencode(get_the_title()); ?>" class="facebook_share" title="Del på Facebook">Del på facebook</a>
				<a href="http://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php the_title(); ?>&via=Kvarteret" target="_blank" onClick="tweetpopup(); return false;" rel="nofollow" class="twitter_share" alt="Del på Twitter">Tweet</a>
				<!--<a href="https://twitter.com/share" class="twitter-share-button twitter_share" data-via="Kvarteret" data-lang="no">Tweet</a>
				<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>-->
			</div>


<?php endwhile; // end of the loop. ?>

</div>
<script type="text/javascript">
$(document).ready(function() {
    //url = "<?php echo get_permalink(); ?>";
	var url = "http://kvarteret.no";
	// Get number of Tweets for this article
	$.getJSON('http://api.tweetmeme.com/url_info.jsonc?url='+url+'&callback=?',
    function(data) {
		var tweets = 0;
		if('story' in data) {
			tweets = data.story.url_count;
			console.log('tweets' + data.story.url_count);
		}
        $('.twitter_share').append('<div class="count">' + tweets + '</div>');
	});
	
	// Get number of Likes (Shares + likes + mentions)
	$.getJSON('http://graph.facebook.com/?id='+url+'&callback=?',
    function(data) {
		var shares = 0;
		if('shares' in data) {
			shares = data.shares;
			console.log('Likes' + data.shares);
		}
        $('.facebook_share').append('<div class="count">' + shares + '</div>');
	});
});	


/*function tweetpopup() {

	window.open( "http://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=the%20text%20you%20wish%20the%20tweet%20to%20say&count=none/", "tweet", "height=450,width=550,resizable=1" ) 

}*/
</script>

<?php get_footer(); ?>
