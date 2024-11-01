<?php wp_enqueue_style( 'social_share_count_admin_style', SOCIAL_SHARE_COUNT_URL.'assets/css/admin.css');
$share_button_opt = get_option('link_button_options');
$available_services = $this->social_link_services;
$defset = 'set1';
if(isset($share_button_opt['share_image_set']) && !empty($share_button_opt['share_image_set'])) {
	$defset = $share_button_opt['share_image_set'];
}
$image_set = SOCIAL_SHARE_COUNT_URL.'assets/buttons/'.$defset.'/';
$this->save_link_button_options();
$share_image_size = isset($share_button_opt['share_image_size']) ? $share_button_opt['share_image_size'] : '25';
$share_services =  array();
if(isset($share_button_opt['share_services']) && !empty($share_button_opt['share_services'])) {
	$share_services = explode(',',$share_button_opt['share_services']);
	$available_services = array_diff($this->social_link_services, $share_services);
}
sort($available_services);
$set_types = array('Arbenting', 'Stitchy Round', 'Stitchy Square', 'Simple', 'Metal', 'Pagepeel', 'Ribbons', 'Somacro');
?>
<div class="social_share_count_form_dv">
<form action="" name="share_btn_form" method="post">
	<?php wp_nonce_field( 'link_button_action', 'link_button_nonce_field' ); ?>
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
           <ul id="sortable1" class="connectedSortable">
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
      <input id="share_caption" name="share_caption" value="<?php echo isset($share_button_opt['share_caption']) ? $share_button_opt['share_caption'] : 'Find me on:'; ?>" type="text">
      <span class="description"><?php _e('Displays before the set of share buttons', 'social-share-count');?> 	    
      </span>

   </td>
</tr>	
	
	<tr><th scope="row"><?php _e('Caption Position', 'social-share-count');?></th><td>
      <select id="share_caption_position" name="share_caption_position">
         <option value="inline-block" <?php echo isset($share_button_opt['share_caption_position']) && ($share_button_opt['share_caption_position'] == 'inline-block') ? 'selected="selected"' : ''; ?>><?php _e('On same line as icons', 'social-share-count');?></option>
         <option value="block" <?php echo isset($share_button_opt['share_caption_position']) && ($share_button_opt['share_caption_position'] == 'block') ? 'selected="selected"' : ''; ?>><?php _e('On separate line above icons', 'social-share-count');?> &nbsp; </option>
      </select>

   </td></tr>
   <tr><th scope="row"><?php _e('Link Icons Alignment', 'social-share-count');?></th><td>
      <select id="share_alignment" name="share_alignment">
         <option value="left" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'left') ? 'selected="selected"' : ''; ?>><?php _e('Left', 'social-share-count');?></option>
         <option value="center" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'center') ? 'selected="selected"' : ''; ?>><?php _e('Center', 'social-share-count');?></option>
         <option value="right" <?php echo isset($share_button_opt['share_alignment']) && ($share_button_opt['share_alignment'] == 'right') ? 'selected="selected"' : ''; ?>><?php _e('Right', 'social-share-count');?></option>
      </select>


   </td></tr>
   <tr><th scope="row"><?php _e('Open in new window', 'social-share-count');?></th><td>
      <input id="new_window" name="new_window" value="1" type="checkbox">
      <span class="description" for="new_window">
                            </span>

   </td></tr>
   <tr><th scope="row"><?php _e('Hover Effect', 'social-share-count');?></th><td>
              <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-none') ? 'checked="checked"' : ''; ?> value="hover-none" type="radio"> <?php _e('No effect', 'social-share-count');?> &nbsp; </label>
           <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-dim') ? 'checked="checked"' : ''; ?> value="hover-dim" type="radio"> <?php _e('Dim on hover', 'social-share-count');?> &nbsp; </label>
           <label>
       <input id="share_hover_effect" name="share_hover_effect" <?php echo isset($share_button_opt['share_hover_effect']) && ($share_button_opt['share_hover_effect'] == 'hover-brighten') ? 'checked="checked"' : ''; ?> value="hover-brighten" type="radio"> <?php _e('Brighten on hover', 'social-share-count');?> &nbsp; </label>
         <span class="description" for="share_hover_effect"></span>

   </td></tr></tbody></table>

<h2><?php _e('User IDs', 'social-share-count');?></h2>
<table class="form-table"><tbody>
<?php 
foreach($this->social_link_services_usernames as $name => $hint) {?>
<tr><th scope="row"><?php echo ucfirst($name);?></th><td>
      <input id="<?php echo $name;?>" name="<?php echo $name;?>" value="<?php echo isset($share_button_opt[$name]) ? $share_button_opt[$name] : '';?>" type="text">
      <span class="description"> <?php _e('Hint:', 'social-share-count');?> <?php echo $hint; ?> </span>

   </td></tr>
<?php } ?>
   </tbody>
</table>

<h2><?php _e('Advanced', 'social-share-count');?></h2>
<table class="form-table"><tbody>
<tr><th scope="row"><?php _e('Link Button CSS Classes', 'social-share-count');?></th><td>
      <input id="link_css_classes" name="link_css_classes" value="<?php echo isset($share_button_opt['link_css_classes']) ? $share_button_opt['link_css_classes'] : '';?>" type="text">
      <span class="description"><?php _e('Add css classes, separated by spaces.  These will be added to the block of Link buttons', 'social-share-count');?>
 	                      </span>

   </td></tr>
<tr><th scope="row"><?php _e('Nofollow attributes', 'social-share-count');?></th><td>
      <input id="link_nofollow" name="link_nofollow" value="1" type="checkbox" <?php echo isset($share_button_opt['link_nofollow']) && ($share_button_opt['link_nofollow'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="link_nofollow">
       Add <code>rel="nofollow"</code> to link buttons 
      </span>
   </td></tr>   
   </tbody>
</table>

<p class="submit"><input type="submit" name="submit_link_btn" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>
<?php wp_enqueue_script('jquery-ui-sortable');
wp_enqueue_script( 'social-share-count-admin', SOCIAL_SHARE_COUNT_URL.'assets/js/admin.js', array( 'jquery' ) );
?>