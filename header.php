<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage kvarteret
 * @since Kvarteret 1.5
 */
?>
<!DOCTYPE html>
<html lang="nb">

	<head>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/favicon.ico" />
		<link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/favicon.ico">
		<meta name="viewport" content="width=device-width">
		<title><?php
		/*
		 * Print the <title> tag based on what is being viewed.
		 */
		global $page, $paged;

		wp_title( '|', true, 'right' );

		// Add the blog name.
		bloginfo( 'name' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) )
			echo " | $site_description";

		// Add a page number if necessary:
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );

		 ?></title>
	  
	   <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	   
	   <?php
			if ( is_singular() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );
			wp_head();
		?>
		<script src="http://code.jquery.com/jquery-latest.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_directory'); ?>/javascript/jquery.slider.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_directory'); ?>/javascript/application.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_directory'); ?>/javascript/modernizr.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-18345888-1']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
		
		<script type="text/javascript">
			var language = window.navigator.userLanguage || window.navigator.language;
			//if(language != 'nb' && language != 'no' && language != 'nn-no' && language != 'nb-no' || false) {
				$("#english_language").prepend("hjghg<div class="message small">English speaking user?</div>");
			//}
		</script>
	</head>

	<body <?php body_class(); ?>>
		
		<!--[if IE 6]>
			<div class="message">
				<h2>Du bruker en utdatert nettleser</h2>
				Med mindre du sitter på en jobbdatamaskin (unnskyld) kan du oppdatere din nettleser (til internet explorer 9) eller bytte til en konkurrent slik som (norske) Opera, Google Chrome eller Mozilla Firefox for å se siden slik som den er ment.
			</div>
		<![endif]-->
	
		<div id="header">
		
			<ul id="opening_times" class="left">
				<li><strong>Man-ons</strong> 11:30 - 01:00</li>
				<li><strong>Tor-fre</strong> 11:30 - 03:00</li>
				<li><strong>Lør</strong> 14:00 - 03:00</li>
				<li><strong>Søn</strong> Se tider for fotballkamp</li>
			</ul>
			<div id="language_selection" class="right">
				<a href="" id="english_language">English</a>
			</div>
			<div id="follow_buttons" class="right">
				<a href="http://twitter.com/Kvarteret"><img src="http://kvarteret.no/wp-content/themes/kvarteret/images/twitter.png" alt="Twitter" /></a>
				<a href="http://www.facebook.com/pages/Det-Akademiske-Kvarter/20210537496"><img src="http://kvarteret.no/wp-content/themes/kvarteret/images/facebook.png" alt="Facebook" /></a> 
				<a href="https://intern.kvarteret.no/events/api/atom/upcomingEvents"><img src="http://kvarteret.no/wp-content/themes/kvarteret/images/rss.png" alt="Upcoming events" /></a> 
			</div>
		
			<div id="search_form" class="right">
				<form action="http://kvarteret.no/?" method="get">
					<input name="s" id="search_input_box" placeholder="Skriv inn søkeord" type="text" />
					<button id="search_button" title="søk">søk</button>
				</form>
			</div>
			
			<a href="http://kvarteret.no/" title="Det Akademiske Kvarter" rel="home" id="logo">
				<img src="http://kvarteret.no/wp-content/themes/kvarteret/images/logo.png" title="Det Akademiske Kvarter" alt="Det Akademiske Kvarter" />
			</a>
			
		</div><!-- end #header -->
		
		<div id="navigation_bar" role="navigation">
		
				<?php wp_nav_menu( array( 'container_class' => 'left navigation', 'menu' => 'Nav left' ) ); ?>
				<?php wp_nav_menu( array( 'container_class' => 'right navigation', 'menu' => 'Nav right' ) ); ?>
		
		</div><!-- end #navigation_bar -->
		
		<div id="body" class="cf">
