// JavaScript Document
jQuery(document).ready(function() {
    'use strict';
	
	jQuery('body').on('click', '.provider_description', function(){
	
	var providerid = jQuery(this).data('providerid');
	var jobid = jQuery(this).data('jobid');

	var data = {
	   action: 'get_quote_description',
	   providerid: providerid, 
	   jobid: jobid 
	};
	
	jQuery.ajax({
	
		type: 'POST',

		url: ajaxurl,

		data: data,
		
		beforeSend: function() {
			jQuery('.loading-area').show();
		},

		success:function (data, textStatus) {
			jQuery('.loading-area').hide();
			bootbox.alert(data);
		}

	});
	
	});
	
	/*Job Apply Form*/
	jQuery('.applyforjob')
	.bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			description: {
				validators: {
					notEmpty: {}
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
			  "action": "applyjobform"
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
							jQuery('form.applyforjob').find('input[type="submit"]').prop('disabled', false);	
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.applyforjob" );	
								jQuery("#applybtn").html('<a href="javascript:;" class="btn btn-primary">'+param.applied+'</a>');
								jQuery('#job-apply-form').modal('hide');
							}else{
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.applyforjob" );
							}
						
						}

					});
	});
	
	/*Show Applicants*/
	jQuery('body').on('click', '.show_applicants', function(){
		var jobid = jQuery(this).data('jobid');	
		jQuery('#job-manager-job-dashboard').hide();
		jQuery('#job-manager-job-applicants').show();
		
		var data = {
			  "action": "applicants_listing",
			  "jobid": jobid
			};
			
		var formdata = jQuery.param(data);
		
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
			jQuery('form.applyforjob').find('input[type="submit"]').prop('disabled', false);	
			if(data['status'] == 'success'){
				jQuery('#applicants-listing').html(data['applicants']);
				jQuery('[data-toggle="tooltip"]').tooltip();
			}else{
				jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( ".applicants-listing" );
			}
		
		}
	});

	});
	
	/*Hire provider if booking is off*/
	jQuery('body').on('click', '.hire_if_booking_off', function(){
		var jobid = jQuery(this).data('jobid');
		var providerid = jQuery(this).data('providerid');
		
		bootbox.confirm(param.hire_if_booking_off_msg, function(result) {
	    if(result){

		var data = {
			  "action": "hire_if_booking_off",
			  "jobid": jobid,
			  "providerid": providerid
			};
			
		var formdata = jQuery.param(data);
		
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
			if(data['status'] == 'success'){
				//bootbox.alert(data['suc_message']);
				bootbox.confirm({
					message: data['suc_message'],
					buttons: {
						confirm: {
							label: 'Continue',
							className: 'btn-success'
						},
						cancel: {
							label: 'Remain on Same Page',
							className: 'btn-info'
						}
					},
					callback: function (result) {
						if(result){
							window.location.href = data['link'];
						}else{
							jQuery('.hire_if_booking_off').remove();
							jQuery( "<a href='javascript:;' class='btn btn-primary'>Hired <i class='fa fa-user'></i></a>" ).insertAfter( "#proid-"+providerid+" .mark-fullview" );
						}
					}
				});
			}
		
		}
	});
		
		}
		}); 

	});
	
	/*Show Applicants*/
	jQuery('body').on('click', '.gotodashboard', function(){
		jQuery('#job-manager-job-dashboard').show();
		jQuery('#job-manager-job-applicants').hide();
	});
	
});