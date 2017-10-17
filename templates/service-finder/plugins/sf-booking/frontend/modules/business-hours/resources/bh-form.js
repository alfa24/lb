/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

// When the browser is ready...
  jQuery(function() {
	'use strict';
	
	var dayname = 'Mon';
	var tabname = 'monday';
	var mflag = 0;
	var tflag = 0;
	var wflag = 0;
	var thflag = 0;
	var frflag = 0;
	var saflag = 0;
	var suflag = 0;
	/*Click event on subtabs*/
	jQuery('body').on('click', '#subTabHours li a', function(){
		dayname = jQuery(this).attr('href');													
		dayname = dayname.replace("#bh-", "");
		tabname = dayname;
		dayname = dayname.replace("day", "");
		dayname = dayname.substr(0, 1).toUpperCase() + dayname.substr(1);
	});				  
	//Save Business Hours
	jQuery('.form-business-hours')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {}
        })
		.on('error.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false); // disable submit buttons on errors
	    })
		.on('status.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false); // disable submit buttons on valid
        })
        .on('success.form.bv', function(form) {
            // Prevent form submission
			
            form.preventDefault();

            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "save_businesshours",
			  "day": tabname,
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						dataType: "json",
						
						beforeSend: function() {
							jQuery(".alert").remove();
							jQuery('.loading-area').show();
						},
						
						data: formdata,

						success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							$form.find('button[type="submit"]').prop('disabled', false);
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "#"+tabname+"-business-hours" );	
										
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "#"+tabname+"-business-hours" );
							}
							
						}

					});
			
        });
	
  });