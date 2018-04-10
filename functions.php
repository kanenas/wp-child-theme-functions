<?php
/* Adding DNS Prefetching */
function knns_dns_prefetch() {
	echo '<meta http-equiv="x-dns-prefetch-control" content="on">
				<link rel="dns-prefetch" href="//a.disquscdn.com" />
				<link rel="dns-prefetch" href="//disqus.com" />
				<link rel="dns-prefetch" href="//apis.google.com" />
				<link rel="dns-prefetch" href="//farm1.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm2.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm3.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm4.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm5.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm6.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm7.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm8.static.flickr.com" />
				<link rel="dns-prefetch" href="//farm9.static.flickr.com" />
				<link rel="dns-prefetch" href="//www.google-analytics.com" />
				<link rel="dns-prefetch" href="//assets.pinterest.com" />
				<link rel="dns-prefetch" href="//s-passets.pinimg.com" />
				<link rel="dns-prefetch" href="//platform.linkedin.com" />
				<link rel="dns-prefetch" href="//platform.twitter.com" />
				<link rel="dns-prefetch" href="//ssl.google-analytics.com" />
				<link rel="dns-prefetch" href="//fbstatic-a.akamaihd.net" />
				<link rel="dns-prefetch" href="//wprp.zemanta.com" />
				<link rel="dns-prefetch" href="//ssl.gstatic.com" />
				<link rel="dns-prefetch" href="//fonts.gstatic.com" />
				<link rel="dns-prefetch" href="//i.shareasale.com" />
				<link rel="dns-prefetch" href="//kanenas-net.disqus.com" />
				<link rel="dns-prefetch" href="//accounts.google.com" />
				<link rel="dns-prefetch" href="//stackoverflow.com" />';
}
add_action( 'wp_head', 'knns_dns_prefetch', 0 );

// Google Analytics
add_action( 'wp_head', function () { ?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXXXX-X"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-XXXXXXX-X');
</script>
<?php });

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
				if(post_type_supports($post_type, 'comments')) {
						remove_post_type_support($post_type, 'comments');
						remove_post_type_support($post_type, 'trackbacks');
				}
	}
}
add_action( 'admin_init', 'df_disable_comments_post_types_support' );

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter( 'comments_open', 'df_disable_comments_status', 20, 2 );
add_filter( 'pings_open', 'df_disable_comments_status', 20, 2 );

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter( 'comments_array', 'df_disable_comments_hide_existing_comments', 10, 2 );

// Add Facebook Pixel
function knns_facebook_pixel() {
	echo "
	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', 'XXXXXXXXXXXXXXXX');
	fbq('track', 'PageView');
	fbq('track', 'ViewContent');
	</script>
	<noscript><img height=\"1\" width=\"1\" style=\"display:none\"
	src=\"https://www.facebook.com/tr?id=XXXXXXXXXXXXXXXX&ev=PageView&noscript=1\"
	/></noscript>
	<!-- DO NOT MODIFY -->
	<!-- End Facebook Pixel Code -->
	";
}
add_action( 'wp_head', 'knns_facebook_pixel' );

// Remove dashboard widgets
function remove_dashboard_widgets () {
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); //Quick Press widget
	remove_meta_box( 'dashboard_recent_drafts', 'dashboard', 'side' ); //Recent Drafts
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); //WordPress.com Blog
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'side' ); //Other WordPress News
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' ); //Incoming Links
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' ); //Plugins
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); //Right Now
	//remove_meta_box( 'rg_forms_dashboard', 'dashboard', 'normal' ); //Gravity Forms
	remove_meta_box( 'dashboard_recent_comments', 'dashboard', 'normal' ); //Recent Comments
	//remove_meta_box( 'icl_dashboard_widget', 'dashboard', 'normal' ); //Multi Language Plugin
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); //Activity
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

// Cookie Consent by Silktide - http://silktide.com/cookieconsent
function knn_cookie_consent() {
	wp_register_script(
		'knn-cookie-consent-local',
		get_stylesheet_directory_uri() . '/js/cookie-consent-local.js',
		false,
		'1.0',
		true
	);
	wp_enqueue_script( 'knn-cookie-consent-local' );

	wp_register_script(
		'knn-cookie-consent-external',
		'//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js',
		false,
		'2.0',
		true
	);
	wp_enqueue_script( 'knn-cookie-consent-external' );
}
add_action( 'wp_enqueue_scripts', 'knn_cookie_consent' );

