<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<div class="wrap admin_social_wrap">
<?php $this->load_help_desk(); ?>
<h2 class="heading"><?php _e('Social Buttons', SOCIAL_SHARE_COUNT_SLUG);?></h2>
<?php
            $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'share_button';
            if(isset($_GET['tab'])) $active_tab = $_GET['tab']; ?>

<h2 class="nav-tab-wrapper">
            <a href="?page=social_share_count&amp;tab=share_button" class="nav-tab <?php echo $active_tab == 'share_button' ? 'nav-tab-active' : ''; ?>"><?php _e('Share Button', SOCIAL_SHARE_COUNT_SLUG); ?></a>

            <a href="?page=social_share_count&amp;tab=link_button" class="nav-tab <?php echo $active_tab == 'link_button' ? 'nav-tab-active' : ''; ?>"><?php _e('Link Button', SOCIAL_SHARE_COUNT_SLUG); ?></a>
            
            <a href="?page=social_share_count&amp;tab=advanced_options" class="nav-tab <?php echo $active_tab == 'advanced_options' ? 'nav-tab-active' : ''; ?>"><?php _e('Advanced', SOCIAL_SHARE_COUNT_SLUG); ?></a>
            
            <a href="?page=social_share_count&amp;tab=shortcodes" class="nav-tab <?php echo $active_tab == 'shortcodes' ? 'nav-tab-active' : ''; ?>"><?php _e('Shortcodes', SOCIAL_SHARE_COUNT_SLUG); ?></a>
</h2>
<?php include($active_tab.'.php');?>
</div>
