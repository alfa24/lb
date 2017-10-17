/*****************************************************************************

*

*	copyright(c) - sedatelab.com - SedateTheme

*	More Info: http://sedatelab.com/

*	Coder: SedateLab Team

*	Email: sedatelab@gmail.com

*

******************************************************************************/



// When the browser is ready...

  jQuery(function() {
				  
	jQuery('body').on('change', '#country', function(){
													 
        // Get the record's ID via attribute
        var country = jQuery(this).val();
		
		var data = {
			  "action": "load_cities",
			  "country": country
			};
			
	  var formdata = jQuery.param(data);
	  
	  jQuery.ajax({

						type: 'POST',

						url: ajaxurl,

						data: formdata,
						
						dataType: "json",
						
						beforeSend: function() {
							jQuery('.loading-srh-bar').show();
						},

						success:function (data, textStatus) {
							jQuery('.loading-srh-bar').hide();
							if(data['status'] == 'success'){
								jQuery('select[name="city"]').html(data['html']);
								jQuery('select[name="city"]').selectpicker('refresh');
							}
						
						}

					});
		
	
	});

	
  });
  
  // Window Load START========================================================//

	jQuery(window).load(function () {
		jQuery('#categorysrh').selectpicker('refresh');						  
		jQuery('#country').selectpicker('refresh');
		jQuery('#city').selectpicker('refresh');
	})