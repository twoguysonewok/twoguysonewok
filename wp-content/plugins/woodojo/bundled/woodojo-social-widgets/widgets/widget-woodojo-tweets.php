<?php
/*-----------------------------------------------------------------------------------

CLASS INFORMATION

Description: A bundled WooDojo Tweets widget.
Date Created: 2012-03-23.
Last Modified: 2011-03-23.
Author: WooThemes.
Since: 1.0.0


TABLE OF CONTENTS

- var $woo_widget_cssclass
- var $woo_widget_description
- var $woo_widget_idbase
- var $woo_widget_title

- function __construct
- function widget
- function update
- function form
- function get_stored_data
- function request_tweets
- function enqueue_styles

- Register the widget on `widgets_init`.

-----------------------------------------------------------------------------------*/

class WooDojo_Widget_Tweets extends WP_Widget {

	/* Variable Declarations */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_title;

	var $transient_expire_time;

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @uses WooDojo
	 * @return void
	 */
	function __construct () {
		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'widget_woodojo_tweets';
		$this->woo_widget_description = __( 'This is a WooDojo bundled tweets widget.', 'woodojo' );
		$this->woo_widget_idbase = 'woodojo_tweets';
		$this->woo_widget_title = __('WooDojo - Tweets', 'woodojo' );
		
		$this->transient_expire_time = 60 * 60; // 1 hour.

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Widget control settings. */
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => $this->woo_widget_idbase );

		/* Create the widget. */
		$this->WP_Widget( $this->woo_widget_idbase, $this->woo_widget_title, $widget_ops, $control_ops );
	} // End Constructor

	/**
	 * widget function.
	 * 
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		// Twitter handle is required.
		if ( ! isset( $instance['twitter_handle'] ) || ( $instance['twitter_handle'] == '' ) ) { return; }

		extract( $args, EXTR_SKIP );
		
		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'], $instance, $this->id_base );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title ) {
		
			echo $before_title . $title . $after_title;
		
		} // End IF Statement
		
		/* Widget content. */
		
		// Add actions for plugins/themes to hook onto.
		do_action( $this->woo_widget_cssclass . '_top' );
		
		// Load widget content here.
		$html = '';
		
		$args = array(
					'username' => $instance['twitter_handle'], 
					'limit' => $instance['limit'], 
					'include_retweets' => $instance['include_retweets'], 
					'exclude_replies' => $instance['exclude_replies']
					);

		$tweets = $this->get_stored_data( $args );

		if ( is_array( $tweets ) && ( count( $tweets ) > 0 ) ) {
			$html .= '<ul class="tweets">' . "\n";
			foreach ( $tweets as $k => $v ) {
				$text = $v->text;

				if ( $v->truncated == false ) {
					$text = make_clickable( $text );
				}

				$html .= '<li class="tweet-number-' . esc_attr( ( $k + 1 ) ) . '">' . "\n";
				$html .= $text . "\n";
				$html .= '<small class="time-ago"><a href="' . esc_url( 'https://twitter.com/#!/' . urlencode( $instance['twitter_handle'] ) . '/status/' . $v->id_str ) . '">' . human_time_diff( strtotime( $v->created_at ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'woodojo' ) . '</a></small>' . "\n";
				$html .= '</li>' . "\n";
			}
			$html .= '</ul>' . "\n";
		}

		if ( $instance['include_follow_link'] != false ) {
			$html .= '<p class="follow-link"><a href="' . esc_url( 'http://twitter.com/' . urlencode( $instance['twitter_handle'] ) ) . '">' . sprintf( __( 'Follow %s on Twitter', 'woodojo' ), $instance['twitter_handle'] ) . '</a></p>';
		}

		echo $html; // If using the $html variable to store the output, you need this. ;)
		
		// Add actions for plugins/themes to hook onto.
		do_action( $this->woo_widget_cssclass . '_bottom' );

		/* After widget (defined by themes). */
		echo $after_widget;

	} // End widget()

	/**
	 * update function.
	 * 
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array $instance
	 */
	function update ( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* Strip tags for the Twitter username, and sanitize it as if it were a WordPress username. */
		$instance['twitter_handle'] = strip_tags( sanitize_user( $new_instance['twitter_handle'] ) );
		
		/* Escape the text string and convert to an integer. */
		$instance['limit'] = intval( strip_tags( $new_instance['limit'] ) );

		/* The checkbox is returning a Boolean (true/false), so we check for that. */
		$instance['include_retweets'] = (bool) esc_attr( $new_instance['include_retweets'] );
		$instance['exclude_replies'] = (bool) esc_attr( $new_instance['exclude_replies'] );
		$instance['include_follow_link'] = (bool) esc_attr( $new_instance['include_follow_link'] );
		
		// Allow child themes/plugins to act here.
		$instance = apply_filters( $this->woo_widget_idbase . '_widget_save', $instance, $new_instance, $this );
		
		// Clear the transient, forcing an update on next frontend page load.
		delete_transient( $this->id . '-tweets' );

		return $instance;
	} // End update()

   /**
    * form function.
    * 
    * @access public
    * @param array $instance
    * @return void
    */
   function form ( $instance ) {
		/* Set up some default widget settings. */
		/* Make sure all keys are added here, even with empty string values. */
		$defaults = array(
						'title' => __( 'Tweets', 'woodojo' ), 
						'twitter_handle' => '', 
						'limit' => 5, 
						'include_retweets' => 0, 
						'exclude_replies' => 0, 
						'include_follow_link' => 1
					);
		
		// Allow child themes/plugins to filter here.
		$defaults = apply_filters( $this->woo_widget_idbase . '_widget_defaults', $defaults, $this );
		
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title (optional):', 'woodojo' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $instance['title']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
		</p>
		<!-- Widget Twitter Handle: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter_handle' ); ?>"><?php _e( 'Twitter Username (required):', 'woodojo' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'twitter_handle' ); ?>"  value="<?php echo $instance['twitter_handle']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'twitter_handle' ); ?>" />
		</p>
		<!-- Widget Limit: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Limit:', 'woodojo' ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name( 'limit' ); ?>"  value="<?php echo $instance['limit']; ?>" class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" />
		</p>
		<!-- Widget Include Retweets: Checkbox Input -->
		<p>
			<input id="<?php echo $this->get_field_id( 'include_retweets' ); ?>" name="<?php echo $this->get_field_name( 'include_retweets' ); ?>" type="checkbox"<?php checked( $instance['include_retweets'], 1 ); ?> />
        	<label for="<?php echo $this->get_field_id( 'include_retweets' ); ?>"><?php _e( 'Include Retweets', 'woodojo' ); ?></label>
		</p>
		<!-- Widget Exclude Replies: Checkbox Input -->
		<p>
			<input id="<?php echo $this->get_field_id( 'exclude_replies' ); ?>" name="<?php echo $this->get_field_name( 'exclude_replies' ); ?>" type="checkbox"<?php checked( $instance['exclude_replies'], 1 ); ?> />
        	<label for="<?php echo $this->get_field_id( 'exclude_replies' ); ?>"><?php _e( 'Exclude Replies', 'woodojo' ); ?></label>
		</p>
		<!-- Widget Include Follow Link: Checkbox Input -->
		<p>
			<input id="<?php echo $this->get_field_id( 'include_follow_link' ); ?>" name="<?php echo $this->get_field_name( 'include_follow_link' ); ?>" type="checkbox"<?php checked( $instance['include_follow_link'], 1 ); ?> />
        	<label for="<?php echo $this->get_field_id( 'include_follow_link' ); ?>"><?php _e( 'Include Follow Link', 'woodojo' ); ?></label>
		</p>
<?php
		
		// Allow child themes/plugins to act here.
		do_action( $this->woo_widget_idbase . '_widget_settings', $instance, $this );

	} // End form()
	/**
	 * Retrieve stored data, or query for new data.
	 * @param  array $args
	 * @return array
	 */
	public function get_stored_data ( $args ) {
		$data = array();
		$transient_key = $this->id . '-tweets';
		
		if ( false === ( $data = get_transient( $transient_key ) ) ) {
			$response = $this->request_tweets( $args );

			if ( isset( $response[0]->user->id ) ) {
				$data = $response;
				set_transient( $transient_key, $data, $this->transient_expire_time );
			}
		}

		return $data;
	} // End get_stored_data()

	/**
	 * Retrieve tweets for a specified username.
	 * @param  array $args
	 * @return array
	 */
	public function request_tweets ( $args ) {
		$data = array();
		
		$url = 'https://api.twitter.com/1/statuses/user_timeline.json?id=' . urlencode( $args['username'] );
		if ( $args['limit'] != '' ) { $url .= '&count=' . intval( $args['limit'] ); }
		if ( $args['include_retweets'] == true ) { $url .= '&include_rts=1'; }
		if ( $args['exclude_replies'] == true ) { $url .= '&exclude_replies=1'; }

		$response = wp_remote_get( $url, array(
			'method' => 'GET',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => array(),
			'cookies' => array(), 
			'sslverify' => false
		    )
		);

		if( is_wp_error( $response ) ) {
		   $data = array();
		} else {
		   $response = json_decode( $response['body'] );
			if ( isset( $response[0]->user->id ) ) {
				$data = $response;
			}
		}

		return $data;
	} // End request_tweets()

	/**
	 * enqueue_styles function.
	 * 
	 * @access public
	 * @since 1.0.1
	 * @return void
	 */
	function enqueue_styles () {
		wp_register_style( 'woodojo-social-widgets', $this->assets_url . 'css/style.css' );
		wp_enqueue_style( 'woodojo-social-widgets' );
	} // End enqueue_styles()
} // End Class
?>