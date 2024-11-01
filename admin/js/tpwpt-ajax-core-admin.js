(function( $ ) {
	'use strict';
	
	jQuery(document).ready( function() {
	
		//console.log("lkeystate: "+ tpwptParam.lkeystate);

        jQuery("#tpwpt_save_license_key").click( function(e) {

            e.preventDefault();
			
			var license_type = jQuery("#tpwpt_save_license_key").data('type');
			//alert(license_type);
			//return false;
            var license_key = jQuery("#tpwpt_license_key").val();

			if(license_key == null || license_key == '' || !license_key){
				jQuery("#tpwpt_license_key_ajax_response").html('<span class="tpa_error_warning">'+tpwptParam.lkeysms1+'</span>');
			} //if(license_key == null)
			else{
				jQuery.ajax({
					method: "POST",
					//dataType : "json",
					url : tpwptParam.ajaxurl,
					data : {
						action: "tpwpt_rest_api_ajax",
						license_type : license_type,
						license_key : license_key
					},
					beforeSend: function() {
						jQuery('.tpwpt-ring-mask').show();
					},
					success: function(response) {
						jQuery('.tpwpt-ring-mask').hide();
						jQuery("#tpwpt_license_key_ajax_response").html(response);
						jQuery("#tpwpt_license_key_ajax_response").append("<div>Registration closes in <span id='time' class='time'>05</span></div>");
						var fiveMinutes = 5,
						display = jQuery('#time');
						startTimer(fiveMinutes, display);
						setTimeout(function() {
							location.reload();
						}, 6000);

					}
				});
			} //else
        }); //jQuery("#tpwpt_save_license_key").click( function(e)

	});

})( jQuery );

function startTimer(duration, display) {
	var timer = duration, minutes, seconds;
	setInterval(function () {
		minutes = parseInt(timer / 60, 10)
		seconds = parseInt(timer % 60, 10);

		minutes = minutes < 10 ? "0" + minutes : minutes;
		seconds = seconds < 10 ? "0" + seconds : seconds;

		display.text(seconds);

		if (--timer < 0) {
			timer = duration;
		}
	}, 1000);
}