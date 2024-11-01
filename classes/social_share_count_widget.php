<?php namespace social_share_count\social_share_count_widget; if ( ! defined( 'ABSPATH' ) ) exit;
use WP_Widget;
if(!class_exists('social_share_count_widget')) {
		class social_share_count_widget extends WP_Widget {
			/**
			 * Instance of this class.
			 */
	       protected static $instance = null;
		   public function __construct() {
			 parent::__construct(
			   SOCIAL_SHARE_COUNT_SLUG.'_widget', // Base ID
			__('Social Share Count', SOCIAL_SHARE_COUNT_SLUG), // Name
			array( 'description' => __( 'Add Social Link Buttons or Share Buttons to your site', SOCIAL_SHARE_COUNT_SLUG ), ) 
		      );	
			}	
		public function widget( $args, $instance ) {

		$title = isset($instance['title']) ? $instance['title'] : '';
		$buttonType = isset($instance['buttontype']) ? $instance['buttontype'] : 'social_share_count_link';

		$widget_id = $args['widget_id'];
		$before_widget = isset($args['before_widget']) ? $args['before_widget'] : '<div id="'.$widget_id.'" class="widget widget_crafty_social_buttons">';
		$after_widget = isset($args['after_widget']) ? $args['after_widget'] : '</div>';
		$before_title = isset($args['before_title']) ? $args['before_title'] : '<h2 class="widget-title">';
		$after_title = isset($args['after_title']) ? $args['after_title'] : '</h2>';

		echo $before_widget;

		if (!empty($title))
			echo $before_title . $title . $after_title;

		$shortcode = "[$buttonType]";
	
		echo do_shortcode($shortcode, SOCIAL_SHARE_COUNT_SLUG . "_widget" );
	
		echo $after_widget;
	
	}

	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['buttontype'] = strip_tags( $new_instance['buttontype'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	
	}

		public function form( $instance ) {
			
			extract($instance);
	
			$title = isset($instance['title']) ? $instance['title'] : '';
			$buttonType = isset($instance['buttontype']) ? $instance['buttontype'] : 'social_share_count_link';
	
			include( SOCIAL_SHARE_COUNT_PLUGIN_DIR . '/views/admin/widget.php' );
	
		}
			
			
		 } 	 
}