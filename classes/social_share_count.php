<?php namespace social_share_count; if ( ! defined( 'ABSPATH' ) ) exit;	
use social_share_count\social_share_count_services\social_share_count_services as soshcose;
use social_share_count\social_share_count_shortcode\social_share_count_shortcode as soshcosh;
use social_share_count\social_share_count_widget\social_share_count_widget as soshcowi;
/* Widget Init */
add_action( 'widgets_init', function(){
		register_widget( 'social_share_count\social_share_count_widget\social_share_count_widget' );
});
if(!class_exists('social_share_count')) {
		class social_share_count {
			var $shortcode,
				$widget,
				$service,
				$social_share_services,
				$plugin_slug;
			/*
			* Auto load - Hooks
			*/	
			public function __construct() {
				 add_action("wp_ajax_mk_ss_close_fm_help", array($this, "mk_ss_close_fm_help"));
			   $this->plugin_slug = 'social-share-count';
			   $this->load_classes(); 
			   add_action('admin_menu', array(&$this, 'social_share_count_menu_page'));
				$this->social_share_services = ['facebook', 'digg', 'twitter', 'google', 'email', 'linkedin', 'pinterest', 'ravelry', 'reddit', 'stumbleupon','tumblr', 'vk', 'whatsapp', 'xing'];
				$this->social_link_services = ['facebook', 'digg', 'twitter', 'google', 'email', 'linkedin', 'pinterest', 'ravelry', 'reddit', 'stumbleupon','tumblr', 'vk', 'xing', 'craftinoo', 'craftsy', 'dawanda', 'ebay', 'etsy', 'flickr','instagram', 'rss', 'specificfeeds', 'youtube','vimeo'];
				$this->social_link_services_usernames = [
				                                         'facebook' => 'www.facebook.com/<strong>user-id</strong>/ ', 
				                                         'digg' => 'www.digg.com/<strong>user-id</strong>', 
														 'twitter' => '<strong>@user-id</strong>',
														 'google' => 'plus.google.com/u/0/<strong>user-id</strong> (a long number) ',
														 'email' => 'Your email address',
														 'linkedin' => 'www.linkedin.com/in/<strong>user-id</strong> or www.linkedin.com/<strong>company/company-id</strong>',
														 'pinterest' => 'www.pinterest.com/<strong>user-id</strong>',
														 'ravelry' => 'www.ravelry.com/people/<strong>user-id</strong>',
														 'reddit' => 'www.reddit.com/user/<strong>user-id</strong>',
														 'stumbleupon' => 'www.stumbleupon/stumbler/user-id',
														 'tumblr' => 'http://<strong>user-id</strong>.tumblr.com',
														 'vk' => ' vk.com/<strong>user-id</strong>/ or enter the full url.',													
														 'xing' => 'www.xing.com/profile/user-id/ or enter the full url',
														 'craftinoo' => 'craftinoo.com/seller/<strong>user-id</strong>/ or enter the full url.',
														 'craftsy' => 'www.craftsy.com/user/<strong>user-id</strong>/ (numbers)To link to pattern store or instructor page, enter the full url. ',
														 'dawanda' => '<strong>user-id</strong>.dawanda.com or enter the full url. ',
														 'ebay' => 'www.ebay.com/usr/<strong>user-id</strong>/. To link to a store, enter the full store url.',
														 'etsy' => 'www.etsy.com/shop/<strong>user-id</strong>/',
														 'flickr' => 'flickr.com/photos/<strong>user-id</strong> (numbers and letters) ',
														 'instagram' => 'instagram.com/<strong>user-id</strong>',
														 'rss' => 'enter full url for feed service (including http://) or leave blank to use built-in WordPress RSS feed url',
														 'specificfeeds' => 'Optional - defaults to <em>subscribe by email</em> page.  Or enter your custom url.<a href="http://www.specificfeeds.com/rss">More info</a>.',
														 'youtube' => 'youtube.com/user/<strong>user-id</strong>',
														 'vimeo' => 'vimeo.com/<strong>user-id</strong>/'
														 ];
							ksort($this->social_link_services_usernames);						 
			}
			/*
			* Help Tabs
			*/
			public function admin_add_help_tab() {
				$screen = get_current_screen();
				if($screen->id == 'toplevel_page_social_share_count')
				{
					$screen->add_help_tab( array(
							 'id'       => 'social-share-count-welcome'
							,'title'    => __( 'Welcome', SOCIAL_SHARE_COUNT_SLUG )
							,'content'  => file_get_contents(SOCIAL_SHARE_COUNT_PLUGIN_DIR.'views/admin/help/welcome.php')
						) );
					$screen->add_help_tab( array(
							 'id'       => 'social-share-count-help'
							,'title'    => __( 'More Help', SOCIAL_SHARE_COUNT_SLUG )
							,'content'  => file_get_contents(SOCIAL_SHARE_COUNT_PLUGIN_DIR.'views/admin/help/share_button_options.php')
						) );
				}
			}
			/*
			* Load All Classes
			*/
			public function load_classes() {
			  $this->shortcode =  new soshcosh; 
			  $this->widget = new soshcowi;
			}
			/*
			* Menus
			*/
			public function social_share_count_menu_page() {
			  $cmp = add_menu_page(
			__( 'Social Share Count', SOCIAL_SHARE_COUNT_SLUG ),
			__( 'Social Share Count', SOCIAL_SHARE_COUNT_SLUG ),
			'manage_options',
			'social_share_count',
			 array($this, 'social_share_count_callback'),
			   'dashicons-admin-site'
			 );
			 add_action('load-'.$cmp, array($this,'admin_add_help_tab'));
			}
			/*
			* Settings
			*/
			public function social_share_count_callback() {
			  if(is_admin() && current_user_can('manage_options')) {
				include(SOCIAL_SHARE_COUNT_PLUGIN_DIR.'views/admin/settings.php');
			  }
			}
            /*
			* Save Share Buttons
			*/
			public function save_share_button_options() {
				if(isset($_POST['submit_share_btn']) && wp_verify_nonce( $_POST['share_button_nonce_field'], 'share_button_action' )) {
					 $saveSettings = update_option('share_button_options', $_POST );
					 if($saveSettings) {
						$this->redirect('?page=social_share_count&tab=share_button&msg=1'); 
					 } else {
						$this->redirect('?page=social_share_count&tab=share_button&msg=2');  
					 }
               }
			 }
			/*
			* Save Link Buttons
			*/
			 public function save_link_button_options() {
				if(isset($_POST['submit_link_btn']) && wp_verify_nonce( $_POST['link_button_nonce_field'], 'link_button_action' )) {
					 $saveSettings = update_option('link_button_options', $_POST );
					 if($saveSettings) {
						$this->redirect('?page=social_share_count&tab=link_button&msg=1'); 
					 } else {
						$this->redirect('?page=social_share_count&tab=link_button&msg=2');  
					 }
               }
			 }
			/*
			* Save Advanced
			*/
			  public function save_social_share_count_advanced_options() {
				if(isset($_POST['submit_advanced_btn']) && wp_verify_nonce( $_POST['advanced_options_nonce_field'], 'advanced_options_action' )) {
					 $saveSettings = update_option('social_share_count_advanced_options', $_POST );
					 if($saveSettings) {
						$this->redirect('?page=social_share_count&tab=advanced_options&msg=1'); 
					 } else {
						$this->redirect('?page=social_share_count&tab=advanced_options&msg=2');  
					 }
               }
			 } 
		   /*
		   * Post Types
		   */
		   public function post_types() {
			   $args = array(
				   'public'   => true,
				   '_builtin' => false
				);			  
			   $output = 'names';
			   $operator = 'and';			  
			   $post_types = array_merge(array('post','page'), get_post_types( $args, $output, $operator ));
			  return $post_types;
		   }
		   /*
		   * Load Help Desk
		   */
		   public function load_help_desk() {
			$mkcontent = '';
			$mkcontent .='<div class="wssrs">';
			$mkcontent .='<div class="l_wssrs">';
			$mkcontent .='';
			$mkcontent .='</div>';
            $mkcontent .='<div class="r_wssrs">';
            $mkcontent .='<a class="close_ss_help fm_close_btn" href="javascript:void(0)" data-ct="rate_later" title="close">X</a><strong>Social Share Count</strong><p> We love and care about you. Our team is putting maximum efforts to provide you the best functionalities. It would be highly appreciable if you could spend a couple of seconds to give a Nice Review to the plugin to appreciate our efforts. So we can work hard to provide new features regularly :)</p><a class="close_ss_help fm_close_btn_1" href="javascript:void(0)" data-ct="rate_later" title="Remind me later">Later</a> <a class="close_ss_help fm_close_btn_2" href="https://wordpress.org/support/plugin/social-share-count/reviews/?filter=5" data-ct="rate_now" title="Rate us now" target="_blank">Rate Us</a> <a class="close_ss_help fm_close_btn_3" href="javascript:void(0)" data-ct="rate_never" title="Not interested">Never</a>';
			$mkcontent .='</div></div>';
            if ( false === ( $mk_ss_close_fm_help_c = get_transient( 'mk_ss_close_fm_help_c' ) ) ) {
			  	_e(apply_filters('the_content', $mkcontent), SOCIAL_SHARE_COUNT_SLUG);  
		    } 
		}
		/*
		* SC close Help
		*/
		 public function mk_ss_close_fm_help() {
		   $what_to_do = sanitize_text_field($_POST['what_to_do']);
		   $expire_time = 15;
			  if($what_to_do == 'rate_now' || $what_to_do == 'rate_never') {
				 $expire_time = 365;
			  } else if($what_to_do == 'rate_later') {
				 $expire_time = 15;
			  }	
		  if ( false === ( $mk_fm_close_fm_help_c = get_transient( 'mk_ss_close_fm_help_c' ) ) ) {
			   $set =  set_transient( 'mk_ss_close_fm_help_c', 'mk_ss_close_fm_help_c', 60 * 60 * 24 * $expire_time );
				 if($set) {
					 echo 'ok';
				 } else {
					 echo 'oh';
				 }
			   } else {
				    echo 'ac';
			   }
		   die;
	   }
		   /*
		   * Redirection, a common fxn in all our plugins , lol :)
		   */
			public function redirect($url) {
			  echo '<script>window.location.href="'.$url.'"</script>';	
			}
		 }
	}	