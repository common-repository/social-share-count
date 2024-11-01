<?php 
/**
 * @package Social Share Count
 * @version 1.1
 * @Dev MK
 */
/*
Plugin Name: Social Share Count
Plugin URI: http://wordpress.org/plugins/social-share-count/
Description: Share and count social links on your post, pages and custom post types
Author: mndpsingh287
Version: 1.1
Author URI: http://www.webdesi9.com/
*/
define( 'SOCIAL_SHARE_COUNT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SOCIAL_SHARE_COUNT_URL', plugin_dir_url( SOCIAL_SHARE_COUNT_PLUGIN_DIR ) . basename( dirname( __FILE__ ) ) . '/' );
define( 'SOCIAL_SHARE_COUNT_SLUG', 'social-share-count' );
$ssc_classes = ['social_share_count','social_share_count_services','social_share_count_shortcode','social_share_count_widget'];
foreach($ssc_classes as $ssc_class){
  require_once(SOCIAL_SHARE_COUNT_PLUGIN_DIR.'classes/'.$ssc_class.'.php');
}
use social_share_count\social_share_count as soshco;
new soshco;

register_activation_hook(__FILE__, 'mk_plugin_install');

function mk_plugin_install()
{
	$sharebuttons = array(
		'share_image_set' => 'set1',
		'share_image_size' => 25,
		'share_services'=>'',
		'share_caption' => 'Share this:',							
		'share_caption_position'=>'inline-block',
		'position'=>'above',
		'share_alignment'=>'left',
		'share_hover_effect'=>'hover-none',
		'share_float_buttons'=>'',
		'share_float_height'=>10,
		'share_float_alignment'=>'left',	
		'show_on_posts'=>'1',
		'show_on_home'=>'1',							
		'show_on_category'=>'1',
		'show_on_archive'=>'1',
		'show_on_pages'=>'1',
		'show_on_static_home'=>'1',
		'open_in'=>'new_window',
		'email_body'=>'I thought you might like this:',
		'twitter_body'=>'',
		'twitter_show_title'=>'',
		'share_css_classes'=>'',
		'share_nofollow'=>'',
	);					
					
	$link_button = array(		
		'share_image_set'=>'set1',
		'share_image_size'=>25,
		'share_services'=>'',
		'share_caption'=>'Find me on:',
		'share_caption_position'=>'inline-block',
		'share_alignment'=>'left',
		'new_window'=>1,
		'share_hover_effect'=> 'hover-none',
		'craftinoo'=>'',
		'craftsy'=>'',
		'dawanda'=>'',
		'digg'=>'',
		'ebay'=>'',
		'email'=>'',
		'etsy'=>'',
		'facebook'=>'',
		'flickr'=>'',
		'instagram'=>'',
		'linkedin'=>'',
		'pinterest'=>'',
		'ravelry'=>'',
		'reddit'=>'',
		'rss'=>'',
		'specificfeeds'=>'',
		'stumbleupon'=>'',
		'tumblr'=>'',
		'twitter'=>'',
		'vimeo'=>'',
		'vk'=>'',
		'xing'=>'',
		'youtube'=>'',
		'link_css_classes'=>'',
		'link_nofollow'=>'',
	);
										
	$advanced_option = array(
		'post_types_are_filtered'=> '',
		'post_types_for_display'=> array('post'),
		'show_count' => '1',
		'facebook_count'=> 'shares',
		'cache_share_counts'=> '1',
		'cache_expiry_minutes'=>'5'
	);
	/******Default Settings Option ***/		
	$share_opt = get_option('share_button_options');
	if(!$share_opt['share_image_set']) {
		update_option('share_button_options', $sharebuttons);
	}
	$link_opt = get_option('link_button_options');
	if(!$link_opt['share_image_set']) {
		update_option('link_button_options', $link_button);
	}
	$advanced_opt = get_option('social_share_count_advanced_options');
	if(!$advanced_opt['facebook_count']) {
		update_option('social_share_count_advanced_options', $advanced_option);
	}														

}