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
add_action('wp_head', 'knns_dns_prefetch', 0);

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
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

