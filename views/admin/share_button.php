<?php wp_enqueue_style( 'social_share_count_admin_style', SOCIAL_SHARE_COUNT_URL.'assets/css/admin.css');
$share_button_opt = get_option('share_button_options');
$available_services = $this->social_share_services;
$defset = 'set1';
if(isset($share_button_opt['share_image_set']) && !empty($share_button_opt['share_image_set'])) {
	$defset = $share_button_opt['share_image_set'];
}
$image_set = SOCIAL_SHARE_COUNT_URL.'assets/buttons/'.$defset.'/';
$this->save_share_button_options();
$share_image_size = isset($share_button_opt['share_image_size']) ? $share_button_opt['share_image_size'] : '25';
$share_services =  array();
if(isset($share_button_opt['share_services']) && !empty($share_button_opt['share_services'])) {
	$share_services = explode(',',$share_button_opt['share_services']);
	$available_services = array_diff($this->social_share_services, $share_services);
}
sort($available_services);
$set_types = array('Arbenting', 'Stitchy Round', 'Stitchy Square', 'Simple', 'Metal', 'Pagepeel', 'Ribbons', 'Somacro');
?>
<div class="social_share_count_form_dv">
<form action="" name="share_btn_form" method="post">
	<?php wp_nonce_field( 'share_button_action', 'share_button_nonce_field' ); ?>
<table class="form-table"><tbody>
<tr>
<th scope="row"><?php _e('Image Set', 'social-share-count');?></th>
<td>
<select id="share_image_set" class="share_image_set" name="share_image_set">
<?php
$set = 1;
 foreach($set_types as $set_type) { ?>
<option value="set<?php echo $set;?>" <?php echo isset($share_button_opt['share_image_set']) && ($share_button_opt['share_image_set'] == 'set'.$set) ? 'selected="selected"' : ''; ?>><?php _e($set_type, 'social-share-count');?></option>
<?php $set++; } ?>
</select>
</td></tr>
<tr>
<th scope="row"><?php _e('Image Size', 'social-share-count');?></th>
<td>
<input id="share_image_size" name="share_image_size" value="<?php echo $share_image_size; ?>" min="24" max="64" type="number">
      <span class="description"><?php _e('Size in pixels, between 24 and 64', 'social-share-count');?></span>
</td>
</tr>


<tr><th scope="row"><?php _e('Show These Services', 'social-share-count');?></th><td>
 <div class="ssc-services">

         <div class="csb-include-list chosen">
            <div><span class="include-heading"><?php _e('Selected', $this->plugin_slug); ?></span>
               (<?php _e('these will be displayed', $this->plugin_slug); ?></div>
           <ul id="sortable1" class="connectedSortable" >
			    <?php foreach($share_services as $service) { ?>
			  <li class="ui-state-highlight" data-item = "<?php echo $service; ?>">
				  <img src="<?php echo $image_set.$service.'.png'?>" width="<?php echo $share_image_size; ?>" height="<?php echo $share_image_size; ?>" data-url="<?php echo SOCIAL_SHARE_COUNT_URL.'assets/buttons/'?>" data-filename = "<?php echo $service.'.png';?>" data-image-set="set1">
			</li>
              <?php } ?>
			</ul>
         </div>

         <div class="csb-include-list available">
            <div><span class="include-heading"><?php _e('Available', $this->plugin_slug) ?></span>
               (<?php _e('these will <strong>not</strong> be displayed', $this->plugin_slug) ?>)
            </div>
            <ul id="sortable2" class="connectedSortable">
			 <?php foreach($available_services as $service) { ?>
			  <li class="ui-state-highlight" data-item = "<?php echo $service; ?>">
				  <img src="<?php echo $image_set.$service.'.png'?>" width="<?php echo $share_image_size; ?>" height="<?php echo $share_image_size; ?>" data-url="<?php echo SOCIAL_SHARE_COUNT_URL.'assets/buttons/'?>" data-filename = "<?php echo $service.'.png';?>" data-image-set="set1">
			</li>
              <?php } ?>
             </ul>
            </ul>
            </center>
         </div>
      </div>
<input type="hidden" name="share_services" id="share_services" class="share_services" value="<?php echo isset($share_button_opt['share_services']) ? $share_button_opt['share_services'] : ''; ?>"> 
   </td>
</tr>	
<tr><th scope="row"><?php _e('Caption', 'social-share-count');?></th><td>
      <input id="share_caption" name="share_caption" value="<?php echo isset($share_button_opt['share_caption']) ? $share_button_opt['share_caption'] : 'Share this:'; ?>" type="text">
      <span class="description"> <?php _e('Displays before the set of share buttons', 'social-share-count');?> 	    
      </span>

   </td>
</tr>	
	
	<tr><th scope="row"><?php _e('Caption Position', 'social-share-count');?></th><td>
      <select id="share_caption_position" name="share_caption_position">
         <option value="inline-block" <?php echo isset($share_button_opt['share_caption_position']) && ($share_button_opt['share_caption_position'] == 'inline-block') ? 'selected="selected"' : ''; ?>><?php _e('On same line as icons', 'social-share-count');?></option>
         <option value="block" <?php echo isset($share_button_opt['share_caption_position']) && ($share_button_opt['share_caption_position'] == 'block') ? 'selected="selected"' : ''; ?>><?php _e('On separate line above icons', 'social-share-count');?> &nbsp; </option>
      </select>

   </td></tr><tr><th scope="row"><?php _e('Share Icons Position', 'social-share-count');?></th><td>
      <select id="position" name="position">
         <option value="above" <?php echo isset($share_button_opt['position']) && ($share_button_opt['position'] == 'above') ? 'selected="selected"' : ''; ?>><?php _e('Above Content', 'social-share-count');?></option>
         <option value="below" <?php echo isset($share_button_opt['position']) && ($share_button_opt['position'] == 'below') ? 'selected="selected"' : ''; ?>><?php _e('Below Content', 'social-share-count');?></option>
	      <option value="both" <?php echo isset($share_button_opt['position']) && ($share_button_opt['position'] == 'both') ? 'selected="selected"' : ''; ?>><?php _e('Both above and below content', 'social-share-count');?></option>
      </select>
   </td></tr><tr><th scope="row"><?php _e('Share Icons Alignment', 'social-share-count');?></th><td>
      <select id="share_alignment" name="share_alignment">
         <option value="left" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'left') ? 'selected="selected"' : ''; ?>><?php _e('Left', 'social-share-count');?></option>
         <option value="center" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'center') ? 'selected="selected"' : ''; ?>><?php _e('Center', 'social-share-count');?></option>
         <option value="right" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'right') ? 'selected="selected"' : ''; ?>><?php _e('Right', 'social-share-count');?></option>
      </select>


   </td></tr><tr><th scope="row"><?php _e('Hover Effect', 'social-share-count');?></th><td>
              <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-none') ? 'checked="checked"' : ''; ?> value="hover-none" type="radio"> <?php _e('No effect', 'social-share-count');?>  &nbsp; </label>
           <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-dim') ? 'checked="checked"' : ''; ?> value="hover-dim" type="radio"> <?php _e('Dim on hover', 'social-share-count');?> &nbsp; </label>
           <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-brighten') ? 'checked="checked"' : ''; ?> value="hover-brighten" type="radio"> <?php _e('Brighten on hover', 'social-share-count');?> &nbsp; </label>
         <span class="description" for="share_hover_effect"></span>

   </td></tr></tbody></table>

<h2><?php _e('Floating Button Options', 'social-share-count');?></h2>
<table class="form-table"><tbody><tr><th scope="row"><?php _e('Float Share Buttons', 'social-share-count');?></th><td>
      <input type="checkbox" id="share_float_buttons" name="share_float_buttons" value="1" <?php echo isset($share_button_opt['share_float_buttons']) && ($share_button_opt['share_float_buttons'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="share_float_buttons"> <?php _e('Make share buttons float on single post pages', 'social-share-count');?>
                           </span>

   </td></tr><tr><th scope="row"><?php _e('Float Alignment', 'social-share-count');?></th><td>
      <select id="share_float_alignment" name="share_float_alignment">
         <option value="left" <?php echo isset($share_button_opt['share_float_alignment']) && ($share_button_opt['share_float_alignment'] == 'left') ? 'selected="selected"' : ''; ?>><?php _e('Left', 'social-share-count');?></option>
         <option value="right" <?php echo isset($share_button_opt['share_float_alignment']) && ($share_button_opt['share_float_alignment'] == 'right') ? 'selected="selected"' : ''; ?>><?php _e('Right', 'social-share-count');?></option>
      </select>

   </td></tr><tr><th scope="row"><?php _e('Float Height', 'social-share-count');?></th><td>
		<select id="share_float_height" name="share_float_height">
			<option value="10" <?php echo isset($share_button_opt['share_float_height']) && ($share_button_opt['share_float_height'] == '10') ? 'selected="selected"' : ''; ?>><?php _e('10% down from top', 'social-share-count');?></option>
			<option value="20" <?php echo isset($share_button_opt['share_float_height']) && ($share_button_opt['share_float_height'] == '20') ? 'selected="selected"' : ''; ?>><?php _e('20% down from top', 'social-share-count');?></option>
			<option value="30" <?php echo isset($share_button_opt['share_float_height']) && ($share_button_opt['share_float_height'] == '30') ? 'selected="selected"' : ''; ?>><?php _e('30% down from top', 'social-share-count');?></option>
			<option value="40" <?php echo isset($share_button_opt['share_float_height']) && ($share_button_opt['share_float_height'] == '40') ? 'selected="selected"' : ''; ?>><?php _e('40% down from top', 'social-share-count');?></option>
			<option value="50" <?php echo isset($share_button_opt['share_float_height']) && ($share_button_opt['share_float_height'] == '50') ? 'selected="selected"' : ''; ?>><?php _e('50% down from top', 'social-share-count');?></option>
		</select>

	</td></tr></tbody></table>

<h2><?php _e('Display Options', 'social-share-count');?></h2>
<table class="form-table"><tbody><tr><th scope="row"><?php _e('Show on Posts', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_posts" name="show_on_posts" value="1" <?php echo isset($share_button_opt['show_on_posts']) && ($share_button_opt['show_on_posts'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_posts"> <?php _e('Shares a single post', 'social-share-count');?>
                            </span>

   </td></tr><tr><th scope="row"><?php _e('Show on Home Page', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_home" name="show_on_home" value="1" <?php echo isset($share_button_opt['show_on_home']) && ($share_button_opt['show_on_home'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_home"> <?php _e('Shares each post on home page', 'social-share-count');?>
                            </span>

   </td></tr><tr><th scope="row"><?php _e('Show on Category Pages', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_category" name="show_on_category" value="1" <?php echo isset($share_button_opt['show_on_category']) && ($share_button_opt['show_on_category'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_category"> <?php _e('Shares each post on category pages', 'social-share-count');?>
                            </span>

   </td></tr><tr><th scope="row"><?php _e('Show on Archive Pages', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_archive" name="show_on_archive" value="1" <?php echo isset($share_button_opt['show_on_archive']) && ($share_button_opt['show_on_archive'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_archive"> <?php _e('Shares each post on archive and tags pages', 'social-share-count');?>
                            </span>

   </td></tr><tr><th scope="row"><?php _e('Show on Pages', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_pages" name="show_on_pages" value="1" <?php echo isset($share_button_opt['show_on_pages']) && ($share_button_opt['show_on_pages'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_pages"> <?php _e('Shares the page', 'social-share-count');?>
                           </span>

   </td></tr><tr><th scope="row"><?php _e('Show on Static Front Page', 'social-share-count');?></th><td>
      <input type="checkbox" id="show_on_static_home" name="show_on_static_home" value="1" <?php echo isset($share_button_opt['show_on_static_home']) && ($share_button_opt['show_on_static_home'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_on_static_home"> <?php _e('Shares the home page if you have a static front page', 'social-share-count');?>
                            </span>

   </td></tr></tbody></table>
<h2><?php _e('Advanced Options', 'social-share-count');?></h2>
<table class="form-table"><tbody><tr><th scope="row"><?php _e('Open in', 'social-share-count');?></th><td>
              <label>
       <input type="radio" id="open_in" name="open_in" checked="checked" value="new_window" <?php echo isset($share_button_opt['open_in']) && ($share_button_opt['open_in'] == 'new_window') ? 'checked="checked"' : ''; ?>> <?php _e('New Window', 'social-share-count');?> &nbsp; </label>
           <label>
       <input type="radio" id="open_in" name="open_in" value="same_window" <?php echo isset($share_button_opt['open_in']) && ($share_button_opt['open_in'] == 'same_window') ? 'checked="checked"' : ''; ?>> <?php _e('Same Window', 'social-share-count');?> &nbsp; </label>
           <!--label>
       <input type="radio" id="open_in" name="open_in" value="popup" <?php echo isset($share_button_opt['open_in']) && ($share_button_opt['open_in'] == 'popup') ? 'checked="checked"' : ''; ?>> Popup &nbsp; </label-->
         <span class="description" for="open_in">
                            </span>

   </td></tr><tr><th scope="row"><?php _e('Email text', 'social-share-count');?></th><td>
      <input type="text" id="email_body" name="email_body" value="<?php echo isset($share_button_opt['email_body']) ? $share_button_opt['email_body'] : 'I thought you might like this:'; ?>">
      <span class="description"> <?php _e('Default Email text (user can override this)', 'social-share-count');?>
 	                       </span>

   </td></tr><tr><th scope="row"><?php _e('Tweet text', 'social-share-count');?></th><td>
      <input type="text" id="twitter_body" name="twitter_body" value="<?php echo isset($share_button_opt['twitter_body']) ? $share_button_opt['twitter_body'] : ''; ?>">
      <span class="description"> <?php _e('Default Tweet text (user can override this)', 'social-share-count');?>
 	                       </span>

   </td></tr><tr><th scope="row"><?php _e('Title in Tweet text', 'social-share-count');?></th><td>
      <input type="checkbox" id="twitter_show_title" name="twitter_show_title" value="1" <?php echo isset($share_button_opt['twitter_show_title']) && ($share_button_opt['twitter_show_title'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="twitter_show_title"> <?php _e('Include the post/page title in the default Tweet text', 'social-share-count');?>
                            </span>

   </td></tr>
   <tr><th scope="row"><?php _e('Share Button CSS Classes', 'social-share-count');?></th><td>
      <input id="share_css_classes" name="share_css_classes" value="<?php echo isset($share_button_opt['share_css_classes']) ? $share_button_opt['share_css_classes'] : '';?>" type="text">
      <span class="description"> <?php _e('Add css classes, separated by spaces.  These will be added to the block of Share buttons', 'social-share-count');?>
 	                       </span>

   </td></tr>
<tr><th scope="row"><?php _e('Nofollow attributes', 'social-share-count');?></th><td>
      <input id="share_nofollow" name="share_nofollow" value="1" type="checkbox" <?php echo isset($share_button_opt['share_nofollow']) && ($share_button_opt['share_nofollow'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="link_nofollow">
       Add <code>rel="nofollow"</code> to share buttons 
      </span>
   </td></tr>   

   </tbody></table>
      
<p class="submit"><input type="submit" name="submit_share_btn" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>
<?php wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'social-share-count-admin', SOCIAL_SHARE_COUNT_URL.'assets/js/admin.js', array( 'jquery' ) ); 
?>