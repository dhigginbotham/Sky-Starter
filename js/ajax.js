/**
 * Ajax functions for WordPress
 * 
 * @since 1.0
 */
jQuery('document').ready(function($){

	// Example of a feed coming in.
	// Define Home Vars
	// var home_feed 				= $('#home-feed'),
	//     home_feed_posts 	= $('#home-feed-posts');

	// Get The home feed.
	// if ( home_feed.length != 0 ) {
		 	
	//  	// Hide the posts area.
	//   home_feed_posts.hide();

	//   // Initiate the spinner
	//   home_feed.spin({
	//   	lines: 10, // The number of lines to draw
	// 	  length: 10, // The length of each line
	// 	  width: 5, // The line thickness
	// 	  radius: 10, // The radius of the inner circle
	// 	  color: '#6A1401', // #rgb or #rrggbb
	// 	  speed: 1, // Rounds per second
	// 	  trail: 44, // Afterglow percentage
	// 	  shadow: false, // Whether to render a shadow
	// 	  hwaccel: false, // Whether to use hardware acceleration
	// 	  className: 'spinner', // The CSS class to assign to the spinner
	// 	  zIndex: 2e9, // The z-index (defaults to 2000000000)
	// 	  top: 'auto', // Top position relative to parent in px
	// 	  left: 'auto' // Left position relative to parent in px
	//   });
	    
	//    // Get Feed Data
	//    $.post( 
	//    	gfajax.ajaxurl, // URL
	//    	{ 
	//    		action : 'home_rss' // Action in ajax.php
	//    	}, 
	//    	function( data ) { 
	//    		// Check if successfull
	//    		if ( data.success ) {
	//    			// Get data
	//    			home_feed_posts.append(data.feed);
	//    			// Wait.
	// 			  setTimeout(function(){ 
	// 			  	//Stop Spinner
	// 			  	home_feed.spin(false);
	// 			  	// Fade in Slider.
	// 			  	home_feed_posts.fadeIn( 'slow' );
	// 			  }, 1000 ); // Stop Waiting
	//    		} // End Success
	//    	},
	//    	"json"
	//    );
	// } // End Home Feed

});