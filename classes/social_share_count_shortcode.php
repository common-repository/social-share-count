<?php namespace social_share_count\social_share_count_shortcode;
use social_share_count\social_share_count_services\social_share_count_services as soshcose;
if ( ! defined( 'ABSPATH' ) ) exit;
if(!class_exists('social_share_count_shortcode')) {
		class social_share_count_shortcode {
			/*
			* Service
			*/
			var $service;
			/*
			* Auto Load Hooks
			*/
			public function __construct() {
					
				 add_filter('the_content', array(&$this, 'social_share_count_the_content'));
				 
				 add_shortcode( 'social_share_count_links', array( $this, 'get_social_share_count_link_html' ) );
				 
				 add_shortcode( 'social_share_count_buttons', array( $this, 'get_social_share_count_share_html' ));
				 
				 add_action( 'social-share-count-buttons', array( $this, 'output_share_button_html' ), 10, 3 );
				 
				 add_action( 'social-share-count-links', array( $this, 'output_link_button_html' ) );
				 
				 add_action('get_header', array($this, 'add_social_share_count_styles'));
				 
				 add_action('get_footer', array($this, 'add_social_share_count_scripts'));
				 				 
			}
			/*
			* Social Share Count Share Html
			*/			
			public function get_social_share_count_share_html() {
				
			    return $this->get_buttons_html( 'share' , true);
					
			}
			/*
			* Social Share Count Links Html
			*/				
			public function get_social_share_count_link_html() {
				
				return $this->get_buttons_html( 'link', true );
				
			}
			/*
			* Social Share CountShare Html
			*/	
			public function output_share_button_html() {
				
			    return $this->get_buttons_html( 'share' );
					
			}	
			/*
			* Social Share Count Links Html
			*/			
			public function output_link_button_html() {
				
				return $this->get_buttons_html( 'link' );
				
			}
			/*
			* Html Return
			*/
			public function get_buttons_html($type = 'share', $is_shortcode = false) {
				global $post, $wp;
				$this->service = new soshcose;
				
				$content = '';
				
				$defset = 'set1';
				
                $share_button_opt = get_option('share_button_options');
				
				$link_button_options = get_option('link_button_options');
				
				$social_share_count_advanced_options = get_option('social_share_count_advanced_options'); 
				
				$share_button_opt = get_option('share_button_options');
				
					if ( 'share' != $type && 'link' != $type ) {
						$type = 'share';
					}
					// type - link
					if($type == 'link') {
						
						if(isset($link_button_options['share_image_set']) && !empty($link_button_options['share_image_set'])) {
							
							$defset = $link_button_options['share_image_set'];
							
						}
                      $image_set = SOCIAL_SHARE_COUNT_URL.'assets/buttons/'.$defset.'/';
					  
					  if(isset($link_button_options['share_services']) && !empty($link_button_options['share_services']) && $this->allow($post->post_type,$is_shortcode)) {
						  
						 $link_image_size = isset($link_button_options['share_image_size']) ? $link_button_options['share_image_size'] : '25';
						 
					     $link_services = explode(',',$link_button_options['share_services']);
						 
						 $extra_classes = isset($link_button_options['link_css_classes']) ? $link_button_options['link_css_classes'] : '';
						 
						 $link_nofollow = isset($link_button_options['link_nofollow']) && ($link_button_options['link_nofollow'] == '1') ? ' rel="nofollow"' : '';
						 $new_window = isset($link_button_options['new_window']) && ($link_button_options['new_window'] == '1') ? ' target="_blank"' : '';
						 
						 $share_link_caption = isset($link_button_options['share_caption']) ? $link_button_options['share_caption'] : '';
						 
						 $hover_effect = isset($link_button_options['link_hover_effect']) ? $link_button_options['link_hover_effect'] : 'hover-none';
						 
						 $link_align_ment = isset($link_button_options['share_alignment']) ? $link_button_options['share_alignment'] : 'left';
						 
						 $alignment_class = isset($link_button_options['share_caption_position']) && !empty($link_button_options['share_caption_position']) ? $link_button_options['share_caption_position'] : '';	
						 
						 $content .= '<div class="share_count_link_share '.$extra_classes.' align_'.$link_align_ment.' '.$alignment_class.'">';
						 
						 $content .= '<div class="share_count_link_share_caption ">'.$share_link_caption.'</div>';
						 
						 $content .= '<ul>';
						 
							 foreach($link_services as $service):
							 
									 $content .= '<li class="'. $hover_effect.'">';
									 
									 $content .= '<a href="'.$this->service->get_link($service).'" '.$link_nofollow.' '.$new_window.'><img src="'.$image_set.$service.'.png" width="'.$link_image_size.'" height="'.$link_image_size.'"></a>';
									 
									 $content .= '</li>';
									 
							 endforeach;
							 
							 
						 $content .= '</ul>';
						 
						 $content .= '</div>';
					  }
					/* type - share */	
					} else {
						
						if(isset($share_button_opt['share_image_set']) && !empty($share_button_opt['share_image_set'])) {
							
							$defset = $share_button_opt['share_image_set'];
							
						}
						
                        $image_set = SOCIAL_SHARE_COUNT_URL.'assets/buttons/'.$defset.'/'; 
						
						if(isset($share_button_opt['share_services']) && !empty($share_button_opt['share_services']) && $this->allow_share($share_button_opt, $is_shortcode)) {
						 $share_image_size = isset($share_button_opt['share_image_size']) ? $share_button_opt['share_image_size'] : '25';
						 
					     $share_services = explode(',',$share_button_opt['share_services']);
						 
						 $extra_classes = isset($share_button_opt['share_css_classes']) ? $share_button_opt['share_css_classes'] : '';
						 
						 $link_nofollow = isset($share_button_opt['share_nofollow']) && ($share_button_opt['share_nofollow'] == '1') ? ' rel="nofollow"' : '';
						 $open_in = ' target="_self"';
						 
						 $share_link_caption = isset($share_button_opt['share_caption']) ? $share_button_opt['share_caption'] : '';
						 
						 $hover_effect = isset($share_button_opt['share_hover_effect']) ? $share_button_opt['share_hover_effect'] : 'hover-none';
						 
						 $link_align_ment = isset($share_button_opt['share_alignment']) ? $share_button_opt['share_alignment'] : 'left';
						 
						 $float_class = '';
						 
						 $float_align = '';
						 
						 $float_top_margin = '';

						 if(isset($share_button_opt['share_float_buttons']) && $share_button_opt['share_float_buttons'] == '1' && (is_single() || is_page()) ) { 
						    $float_class = ' single_float';
							
						    $float_align = isset($share_button_opt['share_float_alignment']) && !empty($share_button_opt['share_float_alignment']) ? ' single_float_'.$share_button_opt['share_float_alignment'] : '';
							
							$float_top_margin = isset($share_button_opt['share_float_height']) && !empty($share_button_opt['share_float_height']) ? ' single_float_height_'.$share_button_opt['share_float_height'] : '';
							
							$link_align_ment = 'none';
							
						 }	
						  $alignment_class = isset($share_button_opt['share_caption_position']) && !empty($share_button_opt['share_caption_position']) ? $share_button_opt['share_caption_position'] : '';					 
						 
							 $content .= '<div class="share_count_share '.$extra_classes.' align_'.$link_align_ment.' '.$float_class.$float_align.$float_top_margin.' '.$alignment_class.'">';
							 if(isset($share_button_opt['share_float_buttons']) && $share_button_opt['share_float_buttons'] == '1') {							                                //nothing to do
							 } else {
								  $content .= '<div class="share_count_share_caption" style="height: '.$share_image_size.'px">
								  
								  <span class="mid_tbl">
								  
								  <span class="mid_cel">
								  
								  '.$share_link_caption.'
								  
								  </span>
								  
								  </span>
								  
								  </div>';
							 }
							 
							 $content .= '<ul>';
							 
							 $open_in_class = ''; 
							  
							 foreach($share_services as $share_service) {	
							 
							 if(isset($share_button_opt['open_in']) && !empty($share_button_opt['open_in'])) {
								 
						      	 if($share_button_opt['open_in'] == 'new_window') {
									 
									 $open_in = ' target="_blank"';
									 
								 } else if($share_button_opt['open_in'] == 'popup') {
									 
									 $open_in = ' target="popup" ';
									 
									 $open_in_class = ' open_in_popup';
									 
								 } else {
									 
									 $open_in = ' target="_self"';
									 
								 }
						     }	
							 if($share_service == 'pinterest') {
								 
								 $open_in = '';
								 
								 $open_in_class = '';
								 
							 }
							 $share_count = $this->service->get_share_count($share_service);
							 
							 
							 $share_count_css = 'share_with_count';
							 
							 if(isset($social_share_count_advanced_options['show_count']) && $social_share_count_advanced_options['show_count'] == '1') {
								 
								 if($share_count == '0') {									 
									 $share_count = '';																	 	 
								 } 
								  $share_count_css = '';
							 }							 
							 
							 $content .= '<li class="'. $hover_effect.' share_service_'.$share_service.' '.$share_count_css.'">';
							 					
							 $content .= '<a href="'.$this->service->get_share_link($share_service).'" '.$open_in.' '.$link_nofollow.' class="social_share_count_button ssc_'.$share_service.''.$open_in_class.'" title="share with '.$share_service.'">';
							 
							 if($share_count != '') {
							   $content .= '<span class="social_share_counter '.$share_service.'_count"><span class="rel_pos_txt">'.$share_count.'</span></span>';
							 }
							 
							$content .= '<img src="'.$image_set.$share_service.'.png" height="'.$share_image_size.'" width="'.$share_image_size.'"></a>';
							 
							 $content .= '</li>';
							 
							 }
							 $content .= '</ul>';
							  
						     $content .= '</div>';
						}
					}	
					
					return $content;	

			}
			/* 
			* Allow
			*/
			public function allow($post_type, $is_shortcode = 0) {
				if($is_shortcode) {
					return true;
				} else {				
					$social_share_count_advanced_options = get_option('social_share_count_advanced_options');
					
					if(isset($social_share_count_advanced_options['post_types_are_filtered']) && $social_share_count_advanced_options['post_types_are_filtered'] == '1') {
					$allowed_post_type = $social_share_count_advanced_options['post_types_for_display'];
					
					   return in_array($post_type, $allowed_post_type);
					   
					} else {
						
						return true;
						
					}
				}
			}
			/* 
			* Allow Share
			*/
			public function allow_share($settings, $is_shortcode = 0) {
				
			  global $post;
			  if($is_shortcode) {
					return true;
				} else {			  
			  $advanced = get_option('social_share_count_advanced_options');
			  
			  if ( is_page() && ! is_front_page() && isset($settings['show_on_pages']) ) {
				  
					return true;
					
				}
				if ( is_home() && isset($settings['show_on_home']) ) {
					
					return true;
					
				}
				if ( is_category() && isset($settings['show_on_category']) ) {
					
					return true;
					
				}
				if ( is_archive() && ! is_category() && isset($settings['show_on_archive']) ) {
					
					return true;
					
				}
				if ( is_front_page() && isset($settings['show_on_static_home']) ) {
					
					return true;
					
				}
				if ( is_single() && isset($settings['show_on_posts']) ) {
					
					 if(isset($advanced['post_types_are_filtered']) && $advanced['post_types_are_filtered'] == '1') {
		                
						$post_type = $post->post_type;
						
						$allowed_post_type = $advanced['post_types_for_display'];
						
						if (!is_array($allowed_post_type)) { return false; }
						
		                 return in_array($post_type, $allowed_post_type);	
						 
					} else {
						
						return true;
						
					}
				}	
				}
			     return false; 

			}
			/* 
			 * Share buttons on Content 
			*/
			public function social_share_count_the_content($content) {
				$share_button_opt = get_option('share_button_options');
				$html = $this->get_buttons_html($type = 'share');
				if(isset($share_button_opt['position'])) {
					switch($share_button_opt['position']) {
					   case 'above':
						$return = $html.$content;
					   break;	
					   case 'below':
						$return = $content.$html;
						break;
						case 'both':
						$return = $html.$content.$html;
						break;
						default:
						$return = $content.$html;
						break;
					}
				} else {
					$return = $content.$html;
				}
				return $return;
				
			}
			/* 
			 * header scripts 
			*/
			public function add_social_share_count_styles() {
			 wp_enqueue_style( 'social_share_count_style', SOCIAL_SHARE_COUNT_URL.'assets/css/social_share_count_style.css');
			}
			/* 
			* footer scripts 
			*/
			public function add_social_share_count_scripts() {
				wp_enqueue_script( 'social_share_count_script', SOCIAL_SHARE_COUNT_URL.'assets/js/social_share_count_script.js', array( 'jquery' ) );
			}
			
		 }
	}	