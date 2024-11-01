jQuery(document).ready(function(a) {
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|BB10|IEMobile|Opera Mini/i.test(navigator.userAgent) && a(".share_count_share .share_service_whatsapp").show()
});
//jQuery( ".social_share_count_button" ).tooltip();
jQuery(document).ready(function(a) {
	var ss_img_width = jQuery('.share_count_share .social_share_count_button img').width();
	var count_top_pos = ss_img_width/2-6;
	
	jQuery('.single_float_right .social_share_count_button .social_share_counter').css({'right':ss_img_width+7,'top':count_top_pos});	
	jQuery('.single_float_left .social_share_count_button .social_share_counter').css({'left':ss_img_width+7,'top':count_top_pos});
});