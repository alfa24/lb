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
	
		/*Contact Form*/
		jQuery('.contactform')
        .bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				uname: {
					validators: {
						notEmpty: {
							message: args.fullname
						}
					}
				},
				email: {
					validators: {
						notEmpty: {
														message: param.req
													},
						emailAddress: {
							message: args.email
						}
					}
				},
				comment: {
					validators: {
						notEmpty: {
							message: args.comment
						}
					}
				},
            }
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
				  "action": "contactform"
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
								jQuery('form.contactform').find('input[type="submit"]').prop('disabled', false);	
								if(data['status'] == 'success'){
									jQuery('.contactform').bootstrapValidator('resetForm',true); // Reset form
									jQuery('input[name="phone"]').val(''); // Reset form
									jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.contactform" );	
								}else{
									jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.contactform" );
								}
							
							}
	
						});
		});
	
});