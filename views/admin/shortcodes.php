<?php wp_enqueue_style( 'social_share_count_admin_style', SOCIAL_SHARE_COUNT_URL.'assets/css/admin.css'); ?>
<div class="social_share_count_form_dv">
<table class="form-table">
<tbody>
<tr>
<th scope="row"><?php _e('Share Buttons', 'social-share-count');?></th>
<td><code>[social_share_count_buttons]</code> or <code>&lt;?php do_shortcode('[social_share_count_buttons]'); ?&gt;</code></td>
</tr>
<tr>
<th scope="row"><?php _e('Link Buttons', 'social-share-count');?></th>
<td><code>[social_share_count_links]</code> or <code>&lt;?php do_shortcode('[social_share_count_links]'); ?&gt;</code> </td>
</tr>
<tr>
<th scope="row"><?php _e('Share Buttons Action Hook', 'social-share-count');?></th>
<td><code>&lt;?php do_action('social-share-count-buttons'); ?&gt;</code></td>
</tr>
<tr>
<th scope="row"><?php _e('Link Buttons Action Hook', 'social-share-count');?></th>
<td><code>&lt;?php do_action('social-share-count-links'); ?&gt;</code></td>
</tr>
</tbody>
</table>
</div>