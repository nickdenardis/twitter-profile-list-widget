<?php
/*
Plugin Name: Twitter Profile List Widget
Description: Adds a list of twitter users sorted by username with photos to the widget column on a Wordpress blog.
Version: 1.0
Author: Wayne State Web Team
Author URI: http://blogs.wayne.edu/web/
License: GPLv2
*/

class Twitter_Profile_List_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(false, $name = 'Twitter Profile List Widget', array( 'description' => 'Adds a list of twitter users sorted by username with photos to the widget column on a Wordpress blog.' ) );
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
		
		// Twitter API Call Docs
		// https://dev.twitter.com/docs/api/1/get/lists/members
		
		if ($instance['title'] != '')
			echo '<h2 class="widgettitle">' . htmlspecialchars(stripslashes($instance['title'])) . '</h2>';
		
		// Get the list of members
		$list = $this->_get('https://api.twitter.com/1/lists/members.json?slug=' . $instance['list'] . '&owner_screen_name=' . $instance['screen_name'] . '&skip_status=1&include_entities=0');
		
		// Decode the list
		$list_members = json_decode($list);
		
		// Start the list
		echo '<ul>';
		
		// Check to see if there is an error
		if (isset($list_members->error)){
			echo '<li class="error notfound">Twitter list not found.</li>';
		}else{
			$users = array();
			
			// Localize each user
			foreach ($list_members->users as $user){
				$users[$user->screen_name] = $user;
			}
			
			// Sort the users
			ksort($users);
			
			// Display the users
			// Fields to display: name, profile_image_url, screen_name, profile_image_url_https
			foreach($users as $user){
				echo '<li>
				<a href="http://twitter.com/' . $user->screen_name . '"><img src="' . $user->profile_image_url . '" height="48" width="48" alt="Profile photo of ' . $user->name . '" /></a> 
				<a href="http://twitter.com/' . $user->screen_name . '">' . $user->name . '</a></li>';
			}
		}
		
		// End the list
		echo  '</ul>';
		
		echo $args['after_widget'];
	}
	
	/*
	 * CURL GET function to call the Twitter API
	 */
	function _get($url, $use_cache=true){
		// Get any existing copy of our transient data
		if ($use_cache === true && (false === ($contents = get_transient('twitter_list')))){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 0);
			curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); 
			curl_setopt($ch, CURLOPT_REFERER, 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); 
			
			$contents = curl_exec ($ch);
			curl_close ($ch);
		    
		    set_transient('twitter_list', $contents, 60*60*4);
		}
		
		return $contents;
	}
	
	/*
	 * Clears the transient data
	 */
	function clear_transient($name){
		delete_transient($name);
	}
};


// Initialize the widget
add_action( 'widgets_init', create_function( '', 'return register_widget( "Twitter_Profile_List_Widget" );' ) );