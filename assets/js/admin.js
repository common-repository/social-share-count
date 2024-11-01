 jQuery( function(a) {
    jQuery( "#sortable1, #sortable2" ).sortable({
      connectWith: ".connectedSortable",
		update: function( event, ui ) {
            var services;
            services = a("#sortable1 li").map(function() {
                return a(this).attr("data-item")
            }).get(), a(".share_services").val(services)
       
        }
    }).disableSelection(),  a(".share_image_set").change(function() {
        var b = a(this).val();
        a.each(a(".ssc-services img"), function(c, d) {
            var e = a(d).attr("data-url"),
                g = a(d).attr("data-filename"),
                h = e + b + "/" + g,
                i = b + "/" + g;
            a(d).attr("src", h), a(d).attr("data-image-set", b), a.ajax(h, {
                method: "get",
                error: function(b, c, e) {
                    a(d).attr("src", i);
                }
            })
        })
    }), a("#share_image_size").bind("input", function() {
        var b = a(this).val();
        a.each(a(".ssc-services img"), function(c, d) {
            a(d).attr("width", b), a(d).attr("height", b)
        })
    }); 
  });
  jQuery(document).ready(function() {
	    jQuery('.wssrs').delay( 5000 ).slideDown('slow');
  		jQuery('.close_ss_help').on('click', function(e) {
					var what_to_do = jQuery(this).data('ct');
					alert(what_to_do);
					/* jQuery.ajax({
						 type : "post",
						 url : ajaxurl,
						 data : {action: "mk_ss_close_fm_help", what_to_do : what_to_do},
						 success: function(response) {
							jQuery('.wfmrs').slideUp('slow');
						 }
						});*/	
						
						});
  });