<?php
/*
Plugin Name: Twitter Profile List Widget
Description: Adds a list of twitter users with photos to the widget column on a Wordpress blog.
Version: 1.0
Author: Waybe State Web Team
Author URI: http://blogs.wayne.edu/web/
License: GPLv2
*/

class Twitter_Profile_List_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(false, $name = 'Twitter Profile List Widget', array( 'description' => 'Adds a list of twitter users with photos to the widget column on a Wordpress blog.' ) );
	}
	
	/*
	 * Displays the widget form in the admin panel
	 */
	function form( $instance ) {
		// Stub function
	}
	
	/*
	 * Renders the widget in the sidebar
	 */
	function widget( $args, $instance ) {
		// Stub function
	}
};


// Initialize the widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "Twitter_Profile_List_Widget" );' ) );