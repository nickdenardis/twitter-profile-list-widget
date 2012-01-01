<?php
/*
Plugin Name: Twitter Profile List Widget
Description: Adds a list of twitter users with photos to the widget column on a Wordpress blog.
Version: 1.0
Author: Wayne State Web Team
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
		$title = esc_attr( $instance['title'] );
		$screen_name = esc_attr( $instance['screen_name'] );
		$list = esc_attr( $instance['list'] );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'screen_name' ); ?>">Screen name:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'screen_name' ); ?>" name="<?php echo $this->get_field_name( 'screen_name' ); ?>" type="text" value="<?php echo $screen_name; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'list' ); ?>">List:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'list' ); ?>" name="<?php echo $this->get_field_name( 'list' ); ?>" type="text" value="<?php echo $list; ?>" />
		</p>
		<?php
	}
	
	/*
	 * Renders the widget in the sidebar
	 */
	function widget( $args, $instance ) {
		echo $args['before_widget'];
		
		//https://dev.twitter.com/docs/api/1/get/lists/members
		if ($instance['title'] != ''){
			echo '<h2 class="widgettitle">' . htmlspecialchars(stripslashes($instance['title'])) . '</h2>';
		}
		?>
		<?php echo $instance['screen_name']; ?>/<?php echo $instance['list']; ?>
		<?php
		echo $args['after_widget'];
	}
};


// Initialize the widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "Twitter_Profile_List_Widget" );' ) );