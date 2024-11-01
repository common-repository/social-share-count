<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', SOCIAL_SHARE_COUNT_SLUG); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
</p>

<p>
	<label for="<?php echo $this->get_field_id('buttonType'); ?>"><?php _e('Type:', SOCIAL_SHARE_COUNT_SLUG); ?></label>

	<select class="widefat" 
    	    id="<?php echo $this->get_field_id('buttontype'); ?>" 
            name="<?php echo $this->get_field_name('buttontype'); ?>">
    	<option value="social_share_count_links" <?php echo ($buttonType == 'social_share_count_links') ? 'selected="selected"' : '';?>><?php _e('Link Buttons', SOCIAL_SHARE_COUNT_SLUG); ?></option>
    	<option value="social_share_count_buttons" <?php echo ($buttonType == 'social_share_count_buttons') ? 'selected="selected"' : '';?>><?php _e('Share Buttons', SOCIAL_SHARE_COUNT_SLUG); ?></option>
	</select>
</p>

<p class="description">

 </p>
