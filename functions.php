<?php
// Load styles from parent template
function knns_enqueue_parent_theme_style() {
	wp_enqueue_style( 'knns-parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'knns_enqueue_parent_theme_style', 99 );

// Google Fonts Enqueue
function knns_add_google_fonts() {
	wp_enqueue_style( 'knns-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:300|Roboto:300&amp;subset=greek,greek-ext', false );
}
add_action( 'wp_enqueue_scripts', 'knns_add_google_fonts' );

// Adding DNS Prefetching
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

// Add Facebook domain verification meta tag
function knns_facebook_domain_verification() {
	echo "<meta name=\"facebook-domain-verification\" content=\"XXXXXXXXXXXXXXXXXXXXXXXXXXXXXX\" />";
}
add_action( 'wp_head', 'knns_facebook_domain_verification' );

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

// Disabling Feeds
function knns_disable_feed() {
	wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}
add_action( 'do_feed', 'knns_disable_feed', 1 );
add_action( 'do_feed_rdf', 'knns_disable_feed', 1 );
add_action( 'do_feed_rss', 'knns_disable_feed', 1 );
add_action( 'do_feed_rss2', 'knns_disable_feed', 1 );
add_action( 'do_feed_atom', 'knns_disable_feed', 1 );
add_action( 'do_feed_rss2_comments', 'knns_disable_feed', 1 );
add_action( 'do_feed_atom_comments', 'knns_disable_feed', 1 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

// Cookie Consent by Silktide - http://silktide.com/cookieconsent
function knns_cookie_consent() {
	wp_register_script(
		'knns-cookie-consent-local',
		get_stylesheet_directory_uri() . '/js/cookie-consent-local.js',
		false,
		'1.0',
		true
	);
	wp_enqueue_script( 'knns-cookie-consent-local' );

	wp_register_script(
		'knns-cookie-consent-external',
		'//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js',
		false,
		'2.0',
		true
	);
	wp_enqueue_script( 'knns-cookie-consent-external' );
}
add_action( 'wp_enqueue_scripts', 'knns_cookie_consent' );

// Search posts by ID
function idsearch( $wp ) {
	global $pagenow;

	// If it's not the post listing return
	if( 'edit.php' != $pagenow )
		return;

	// If it's not a search return
	if( !isset( $wp->query_vars['s'] ) )
		return;

	// If it's a search but there's no prefix, return
	if( '#' != substr( $wp->query_vars['s'], 0, 1 ) )
		return;

	// Validate the numeric value
	$id = absint( substr( $wp->query_vars['s'], 1 ) );
	if( !$id )
		return; // Return if no ID, absint returns 0 for invalid values

	// If we reach here, all criteria is fulfilled, unset search and select by ID instead
	unset( $wp->query_vars['s'] );
	$wp->query_vars['p'] = $id;
}
add_action( 'parse_request', 'idsearch' );

// Add extra "Contact us" button next to "Add To Cart" in two languages
add_action( 'woocommerce_after_add_to_cart_button', 'knns_custom_contact_us_link', 5 ); 
function knns_custom_contact_us_link() {
	$languages = icl_get_languages( 'skip_missing=1' );
	if( 1 < count($languages) ) {
		foreach( $languages as $l ) {
			if ( $l['active'] ) {
				if( $l['language_code'] === 'fr' ) {
					echo '<a class="knns-custom-contact-us" href="/fr/contact" title="Contactez nous">Contactez nous</a>';
				} else {
					echo '<a class="knns-custom-contact-us" href="/contact" title="Contact us">Contact us</a>';
				}
			}
		}
	}
}
