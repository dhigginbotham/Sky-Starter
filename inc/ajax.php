<?php 
/**
 * SkyStarter Ajax Functions
 *
 * @package SkyStarter
 * @since SkyStarter 1.0
 */

/**
 * Get Home RSS Feed - Ajax
 * 
 * @since SkyStarter 1.0
 */
function skystarter_home_rss_feed(){

	$feed = array( 
	  'http://wordpress.org/news/feed/'
	);

	$current_page = 'home';

	$feed = skystarter_get_rss_feeds( 4, $feed, true, $current_page, 2400 );

	$response = json_encode( array( 'feed' => $feed, 'success' => true ) );

	echo $response;

	die();
	
}
add_action( 'wp_ajax_home_rss', 'skystarter_home_rss_feed' );
add_action( 'wp_ajax_nopriv_home_rss', 'skystarter_home_rss_feed' );
?>