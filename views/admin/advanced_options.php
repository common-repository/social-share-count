<?php wp_enqueue_style( 'social_share_count_admin_style', SOCIAL_SHARE_COUNT_URL.'assets/css/admin.css');
$social_share_count_advanced_options = get_option('social_share_count_advanced_options'); 
$this->save_social_share_count_advanced_options();
?>
<div class="social_share_count_form_dv">
<form action="" name="advanced_options_form" method="post">
<?php wp_nonce_field( 'advanced_options_action', 'advanced_options_nonce_field' ); ?>
<h2><?php _e('Post Type Filter', 'social-share-count');?></h2>
<table class="form-table">
<tbody>
<tr><th scope="row"><?php _e('Post Type Filtering', 'social-share-count');?></th><td>
      <input id="post_types_are_filtered" name="post_types_are_filtered" value="1" type="checkbox" <?php echo isset($social_share_count_advanced_options['post_types_are_filtered']) && ($social_share_count_advanced_options['post_types_are_filtered'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="post_types_are_filtered"><?php _e('Enable post type filtering', 'social-share-count');?></span>

   </td></tr><tr><th scope="row"><?php _e('Selected Post Types', 'social-share-count');?></th><td>
          <?php foreach($this->post_types() as $post_type) {?>
                <p>
                <input id="post_types_for_display" name="post_types_for_display[]" value="<?php echo $post_type;?>" type="checkbox" <?php echo isset($social_share_count_advanced_options['post_types_for_display']) && (in_array($post_type, $social_share_count_advanced_options['post_types_for_display'])) ? 'checked="checked"' : ''; ?>>
                <?php echo $post_type;?>
                </p>
          <?php }?>                  
                <p><?php _e('If filtering is enabled, Share buttons will only be shown on the post types you select', 'social-share-count');?></p>
                <p class="description ssc_note"><?php _e('( This Options will not work in case of shortcodes )', 'social-share-count');?></p>
   </td></tr>
 </tbody>
</table>
<h2><?php _e('Display Options', 'social-share-count');?></h2>
<table class="form-table"><tbody><tr><th scope="row"><?php _e('Show share counts', 'social-share-count');?></th><td>
      <input id="show_count" name="show_count" value="1" type="checkbox" <?php echo isset($social_share_count_advanced_options['show_count']) && ($social_share_count_advanced_options['show_count'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="show_count">
        <?php _e('Counts are displayed only for services that provide the count data.', 'social-share-count');?></span>

   </td></tr><tr><th scope="row"><?php _e('Facebook Count includes', 'social-share-count');?></th><td>
              <label>
       <input id="facebook_count" name="facebook_count" value="shares" type="radio" <?php echo isset($social_share_count_advanced_options['facebook_count']) && ($social_share_count_advanced_options['facebook_count'] == 'shares') ? 'checked="checked"' : ''; ?>> <?php _e('Shares &nbsp;', 'social-share-count');?></label>
           <label>
       <input id="facebook_count" name="facebook_count" value="likes" type="radio" <?php echo isset($social_share_count_advanced_options['facebook_count']) && ($social_share_count_advanced_options['facebook_count'] == 'likes') ? 'checked="checked"' : ''; ?>> <?php _e('Shares and Comments &nbsp;', 'social-share-count');?> </label>

         <span class="description" for="facebook_count"><?php _e('Number of Minutes to remember share counts (between 5 and 60) ', 'social-share-count');?> </span>

   </td></tr></tbody></table>
<h2><?php _e('Cache', 'social-share-count');?></h2>   
<table class="form-table"><tbody><tr><th scope="row"><?php _e('Cache share counts', 'social-share-count');?></th><td>
      <input id="cache_share_counts" name="cache_share_counts" value="1" type="checkbox" <?php echo isset($social_share_count_advanced_options['cache_share_counts']) && ($social_share_count_advanced_options['cache_share_counts'] == '1') ? 'checked="checked"' : ''; ?>>
      <span class="description" for="cache_share_counts"><?php _e('Return cached share count values.', 'social-share-count');?></span>

   </td></tr><tr><th scope="row"><?php _e('Cache expiry', 'social-share-count');?></th><td>
      <input id="cache_expiry_minutes" name="cache_expiry_minutes" value="<?php echo isset($social_share_count_advanced_options['cache_expiry_minutes']) ? $social_share_count_advanced_options['cache_expiry_minutes'] : '5'; ?>" min="5" max="60" type="number">
      <span class="description"><?php _e('Number of Minutes to remember share counts (between 5 and 60)', 'social-share-count');?></span>

   </td></tr></tbody></table>   
   <p class="submit"><input type="submit" name="submit_advanced_btn" id="submit" class="button button-primary" value="Save Changes"></p>
</form>
</div>