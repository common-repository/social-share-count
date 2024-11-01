<?php namespace social_share_count\social_share_count_services; if ( ! defined( 'ABSPATH' ) ) exit;
if(!class_exists('social_share_count_services')) {
		class social_share_count_services {
			   /* Link options */
			var $link_share_opt, 
			   /* Share options */
			    $share_button_opt,
			   /* Advanced options */
				$advanced,
			   /* Social link Serviced */	
				$social_link_services;
			/*
			* Auto Load Hooks
			*/
			public function __construct() {
							   
			   $this->link_share_opt = get_option('link_button_options');
			   
			   $this->share_button_opt = get_option('share_button_options');
			   
			   $this->advanced = get_option('social_share_count_advanced_options');
			   
			               $this->social_link_services = [
				                                         'facebook' => 'https://www.facebook.com/'.$this->link_share_opt['facebook'], 
				                                         'digg' => 'https://www.digg.com/'.$this->link_share_opt['digg'], 
														 'twitter' => 'https://twitter.com/'.$this->link_share_opt['twitter'],
														 'google' => !empty($this->link_share_opt['dawanda']) ? 'https://plus.google.com/u/0/'.$this->link_share_opt['google'] : 'https://plus.google.com/',
														 'email' => 'mailto:'.$this->link_share_opt['email'],
														 'linkedin' => 'https://www.linkedin.com/in/'.$this->link_share_opt['linkedin'],
														 'pinterest' => 'https://www.pinterest.com/'.$this->link_share_opt['pinterest'],
														 'ravelry' => 'https://www.ravelry.com/people/'.$this->link_share_opt['ravelry'],
														 'reddit' => 'https://www.reddit.com/user/'.$this->link_share_opt['ravelry'],
														 'stumbleupon' => 'https://www.stumbleupon/stumbler/'.$this->link_share_opt['ravelry'],
														 'tumblr' => 'https://'.!empty($this->link_share_opt['tumblr']) ? 
														  $this->link_share_opt['tumblr'].'.tumblr.com' : 'www.tumblr.com',
														 'vk' => 'https://vk.com/'.$this->link_share_opt['vk'],													
														 'xing' => 'https://www.xing.com/profile/'.$this->link_share_opt['xing'],
														 'craftinoo' => 'https://craftinoo.com/seller/'.$this->link_share_opt['craftinoo'],
														 'craftsy' => 'https://www.craftsy.com/user/'.$this->link_share_opt['craftsy'],
														 'dawanda' => 'https://'.!empty($this->link_share_opt['dawanda']) ? $this->link_share_opt['dawanda'].'.dawanda.com' : 'www.dawanda.com',
														 'ebay' => 'https://www.ebay.com/usr/'.$this->link_share_opt['ebay'],
														 'etsy' => 'https://www.etsy.com/shop/'.$this->link_share_opt['etsy'],
														 'flickr' => 'https://flickr.com/photos/'.$this->link_share_opt['flickr'],
														 'instagram' => 'https://instagram.com/'.$this->link_share_opt['instagram'],
														 'rss' => !empty($this->link_share_opt['rss']) ? $this->link_share_opt['rss'] : get_bloginfo('rss_url'),
														 'specificfeeds' => !empty($this->link_share_opt['specificfeeds']) ? $this->link_share_opt['specificfeeds'] : 'https://www.specificfeeds.com/follow',
														 'youtube' => 'https://youtube.com/user/'.$this->link_share_opt['youtube'],
														 'vimeo' => 'https://vimeo.com/'.$this->link_share_opt['vimeo'],
														 ];								 
			}
			/*
			* Get Link - Service Wise
			*/
			public function get_link($service) {
							               
				if(!empty($service)) {
					
				   return $this->social_link_services[$service] ;
				   
				}
			}
			/*
			* Get Share Link - Service Wise
			*/
			public function get_share_link($service) {
				
				global $post;
				
				$url = '';
				
				$email_body = isset($this->share_button_opt['email_body']) ? $this->share_button_opt['email_body'] : 'I thought you might like this:';
				
				if(!empty($service)) {
					
				  $link = get_permalink($post->ID);
				  
				  $title = apply_filters('the_title', $post->post_title);
				  
				  $tweet_title = $title;
				  
				  if(isset($this->share_button_opt['twitter_body'])  && !empty($this->share_button_opt['twitter_body'])) {
					  
					 $tweet_title = $this->share_button_opt['twitter_body'];
					 
				  }
				  
				  if(isset($this->share_button_opt['twitter_show_title']) && $this->share_button_opt['twitter_show_title'] == '1') {
					  
					$tweet_title = isset($this->share_button_opt['twitter_body']) ? $this->share_button_opt['twitter_body'].' '.$title : $title;
					
				  }
				  switch($service):
				  
				   case 'facebook':
				   
				    $url = 'https://www.facebook.com/sharer/sharer.php?u='.$link;  
					
				   break;
				   
				   case 'twitter':
				   
				    $url = 'http://twitter.com/share?url='.$link.'&text='.$tweet_title; 
					 
				   break;
				   
				   case 'tumblr':
				   
				    $url = 'http://www.tumblr.com/widgets/share/tool?canonicalUrl='.$link.'&name='.$title; 
					 
				   break;
				   
				   case 'xing':
				   
				    $url = 'https://www.xing.com/spi/shares/new?sc_p=xing-share&url='.$link.'&title='.$title;  
					
				   break;
				   
				   case 'email':
				   
				    $url = 'mailto:?Subject='.$title.'&Body='.$email_body.' '.$link;  
					
				   break;
				   
				   case 'vk':
				   
				    $url = 'http://vk.com/share.php?url='.$link.'&title='.$title;  
					
				   break;
				   
				   case 'ravelry':
				   
				    $url = 'http://www.ravelry.com/bookmarklets/queue?url='.$link.'&title='.$title;  
					
				   break;
				   
				   case 'reddit':
				   
				    $url = 'http://reddit.com/submit?url='.$link.'&title='.$title;  
					
				   break;
				   
				   case 'google':
				   
				    $url = 'https://plus.google.com/share?url='.$link; 
					 
				   break;
				   
				   case 'linkedin':
				   
				    $url = 'http://www.linkedin.com/shareArticle?mini=true&url='.$link.'&title='.$title; 
					 
				   break;
				   
				   case 'pinterest':
				   
				    $url = "javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;//assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());";  
					
				   break;
				   
				   case 'digg':
				   
				    $url = 'http://www.digg.com/submit?url='.$link;  
					
				   break;
				   
				   case 'stumbleupon':
				   
				    $url = 'http://www.stumbleupon.com/submit?url='.$link.'&title='.$title;  
					
				   break;
				   
				   case 'whatsapp':
				   
				    $title = str_replace(' ', '+', $title);
				    $url = 'whatsapp://send?text='.$title.':+'.$link.'';
				   
				   break;
				  
				   
				 endswitch;
				  
				}
				return $url;
			}
			/*
			* Get Share Count - Service Wise
			*/
			public function get_share_count($service) {
				global $post;
				$count = 0;
				$url = get_permalink($post->ID);
				$cache = false;
				if(isset($this->advanced['cache_share_counts']) && $this->advanced['cache_share_counts'] == '1') {
					$cache = true;
				}
				$exp_time = isset($this->advanced['cache_expiry_minutes']) ? $this->advanced['cache_expiry_minutes'] : '1';
				if($service) {
					
				 switch($service):
				  
				   case 'facebook':
				   
					   if($cache) {
						 if(false === ( $count = get_transient( 'facebook_'.$post->ID ) )) {   
						  $count = $this->facebook_count($url);
						  set_transient( 'facebook_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS );
						} 
					   } else {
							$count = $this->facebook_count($url);
					   }
				   
				   break;
				   
				   case 'twitter':
				   
					 if($cache) {
						 if(false === ( $count = get_transient( 'twitter_'.$post->ID ) )) {   
						  $count = $this->twitter_count($url);
						  set_transient( 'twitter_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
							$count = $this->twitter_count($url);
					   }
					 					
				   break;
				   
				    case 'tumblr':
					
					case 'xing':
					
					case 'email':
					
					case 'vk':
					
					case 'ravelry':
					
					case 'digg':
					
				    $count = $this->no_count($url);
					
				    break;
					
					case 'reddit':
					
					if($cache) {
						 if(false === ( $count = get_transient( 'reddit_'.$post->ID ) )) {   
						  $count = $this->reddit_count($url);
						  set_transient( 'reddit_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
							$count = $this->reddit_count($url);
					   }
					
					break;
					
					case 'google':
					
					if($cache) {
						 if(false === ( $count = get_transient( 'google_'.$post->ID ) )) {   
						  $count = $this->google_count($url);
						  set_transient( 'google_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
							$count = $this->google_count($url);
					   }
					   
					break;
					
					case 'linkedin':
					
					if($cache) {
						 if(false === ( $count = get_transient( 'linkedin_'.$post->ID ) )) {   
						  $count = $this->linkedin_count($url);
						  set_transient( 'linkedin_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
							$count = $this->linkedin_count($url);
					   }					
					break;
					
					
					case 'pinterest':
					
					if($cache) {
						 if(false === ( $count = get_transient( 'pinterest_'.$post->ID ) )) {   
						  $count = $this->pinterest_count($url);
						  set_transient( 'pinterest_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
						  $count = $this->pinterest_count($url);
					   }	
					
					break;
					
					case 'linkedin':
					
					if($cache) {
						 if(false === ( $count = get_transient( 'linkedin_'.$post->ID ) )) {   
						  $count = $this->linkedin_count($url);
						  set_transient( 'linkedin_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
						  $count = $this->linkedin_count($url);
					   }	
										
					break;
					
				    case 'stumbleupon':
				   
					if($cache) {
						 if(false === ( $count = get_transient( 'stumbleupon_'.$post->ID ) )) {   
						  $count = $this->stumbleupon_count($url);
						  set_transient( 'stumbleupon_'.$post->ID, $count, $exp_time * MINUTE_IN_SECONDS);
						} 
					   } else {
						  $count = $this->stumbleupon_count($url);
					   }					
					
				    break;
					
					default:
					
					$count = '';
					
					break;
					
				  endswitch; 
				}
				
				return $count;
				
			}
			/*
			* Facebook Count;
			*/
			public function facebook_count($url) {
				
				$response = wp_remote_get("https://graph.facebook.com?id=".urlencode($url));
				 if (is_wp_error($response)){
					return 0;
				 } else {
					 $value = 0;	
					 	
					 $json = json_decode($response['body'], true);
					 
					 if (!isset($json['share'])) return $value;
		
					 $counts = $json['share'];
		
					 $show = isset($this->advanced['facebook_count']) ? $this->advanced['facebook_count'] : '';
		
					 if (isset($counts['share_count'])) {
						 $value += intval($counts['share_count']);
					 }
					 if (isset($counts['comment_count']) && ($show == 'likes')) {
						 $value += intval($counts['comment_count']);
					 }
					 return $value;
				 }				
			}
			
			/*
			* Twitter Count;
			*/
			public function twitter_count($url) {
			 $response = wp_remote_get('http://public.newsharecounts.com/count.json?url=' . $url);
			 if (is_wp_error($response)){
				return 0;
			 } else {
				 $json = json_decode($response['body'], true);
				 if (isset($json['count'])) {
					 return $json['count'];
				 } else {
					 return 0;
				 }
			 }				
		   }
		   /*
		   * Reddit Count;
		   */
		   public function reddit_count($url) {
			   $response = wp_remote_get('http://www.reddit.com/api/info.json?url=' . $url);
				 if (is_wp_error($response)){
					return 0;
				 } else {
					 $json = json_decode($response['body'], true);
					 if (isset($json['data']['children']['0']['data']['score'])) {
						 return $json['data']['children']['0']['data']['score'];
					 } else {
						 return 0;
					 }
				 }
		   }
		   /*
		   * Google Count
		   */
		   public function google_count($url) {
			   $args = array(
				'method'    => 'POST',
				'headers'   => array(
					'Content-Type' => 'application/json'
				),
				'body'      => json_encode( array(
					'method'     => 'pos.plusones.get',
					'id'         => 'p',
					'jsonrpc'    => '2.0',
					'key'        => 'p',
					'apiVersion' => 'v1',
					'params'     => array(
						'nolog'   => true,
						'id'      => $url,
						'source'  => 'widget',
						'userId'  => '@viewer',
						'groupId' => '@self'
					)
				) ),
				'sslverify' => false
			 );

			  $response = wp_remote_post( "https://clients6.google.com/rpc", $args );
			  if ( is_wp_error( $response ) ) {
				  return 0;
			  } else {
				   $json = json_decode( $response['body'], true );	   
				   return intval( $json['result']['metadata']['globalCounts']['count'] );
			     }
			   }
			  /*
			   * Linked In Count
			  */  
			  public function linkedin_count($url) {
				 $response = wp_remote_get('http://www.linkedin.com/countserv/count/share?format=json&url=' . $url);
					 if (is_wp_error($response)){
						return 0;
					 } else {
						 $json = json_decode($response['body'], true);
						 if (isset($json['count'])) {
							 return $json['count'];
						 } else {
							 return '0';
						 }
					 }  
			  }	
			  /*
			   * Pinterest Count
			  */
			  public function pinterest_count($url) {				
				 $response = wp_remote_get('http://api.pinterest.com/v1/urls/count.json?callback=receiveCount&url=' . $url);
				 if (is_wp_error($response)){
					return 0;
				 } else {
					 $responseBody = str_replace('receiveCount(', '', $response['body']); // remove receiveCount
					 $responseBody = str_replace(')', '', $responseBody);
					 $json = json_decode($responseBody, true);
					 if (isset($json['count'])) {
						 return $json['count'];
					 } else {
						 return 0;
					 }
				 }	  
			   }
			   /*
			   * Stumbleupon Count
			   */
			   public function stumbleupon_count($url) {
				$response = wp_remote_get('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
				 if (is_wp_error($response)){
					return 0;
				 } else {
					 $json = json_decode($response['body'], true);
					 if (isset($json['result']['views'])) {
						 return $json['result']['views'];
					 } else {
						 return 0;
					 }
				 }	  
			   }
			   /*
			   * No Count
			   */
			   public function no_count($url) {
				   return '';
			   }
				
			 }
		}	