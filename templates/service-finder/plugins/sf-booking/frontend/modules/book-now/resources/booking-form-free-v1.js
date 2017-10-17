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
  	
	var map = null;
	var marker = null;
	var provider_id = '';
	var scost = '';
	var sid = '';
	var totalservicecost = 0;
	var totalhours = 0;
	var date = '';
	var mysetdate = '';
	var oldzipcode = '';
	var oldregion = '';
	
	var daynumarr = [];
	var datearr = [];
	var bookedarr = [];
	var service_flag = 0;
	var servicearr = '';
	var member_flag = 1;
	
	/*Display Services*/
	jQuery('form.book-now').on('change', 'select[name="region"]', function(){
		var region = jQuery('select[name="region"]').val();
		if(region != ""){
			jQuery("#bookingservices").show();	
		}else{
			jQuery("#bookingservices").hide();	
		}
	});
	
	jQuery(document).on('click','.set-marker-popup-close',function(){
		jQuery('.set-marker-popup').hide();
	});															   
	jQuery(document).on('click','#viewmylocation',function(){
     jQuery('.set-marker-popup').show();
	 
	 var providerlat = jQuery(this).data('providerlat');
	 var providerlng = jQuery(this).data('providerlng');
  	 var zooml = jQuery(this).data('locationzoomlevel');
	 
	 if(zooml == ""){
		zooml = 14;	 
	 }
	 if(providerlat > 0 && providerlng > 0){
	 initMap(providerlat,providerlng,zooml);
	 }else{
	 initMap(28.6430536,77.2223442,2);	
	 }
	 
	 });
	
	function initMap(lat,lng,zoom) {
	var map = new google.maps.Map(document.getElementById('marker-map'), {
	  zoom: zoom,
	  center: {lat: lat, lng: lng}
	});
	
	marker = new google.maps.Marker({
	  map: map,
	  draggable: true,
	  animation: google.maps.Animation.DROP,
	  position: {lat: lat, lng: lng}
	});

	}
	
	/*Update booking price according to services selected*/
	jQuery('#bookingservices').on('click', '.aon-service-bx', function(){
																				   
		var serviceid = jQuery(this).data('id');
		var costtype = jQuery(this).data('costtype');
		var providerhours = jQuery(this).data('hours');
		
		if(jQuery(this).hasClass('selected') && (costtype == 'hourly' || costtype == 'perperson')) { 
			if(providerhours > 0){
				jQuery('#hours-outer-bx-'+serviceid).show();
				jQuery('#hours-'+serviceid).show();
				jQuery('#hours-'+serviceid).val(providerhours);
				jQuery('#hours-'+serviceid).attr('readonly','readonly');	
			}else{
				jQuery('#hours-'+serviceid).closest('.bootstrap-touchspin').show();
				converttoslider(serviceid,costtype);
			}
		}else{ 
			if(providerhours > 0){
				jQuery('#hours-outer-bx-'+serviceid).hide();
				jQuery('#hours-'+serviceid).hide();	
				jQuery('#hours-'+serviceid).val('');
				jQuery('#hours-'+serviceid).removeAttr('readonly','readonly');	
			}else{
				jQuery('#hours-'+serviceid).closest('.bootstrap-touchspin').hide();
			}
		}
				
		getservices();
	});
	
	/*Save services to a variable*/
	function getservices(){
		servicearr = '';
		service_flag = 0;	
		var servicehours = 0;
		jQuery("#bookingservices .aon-service-bx").each( function() {
			if(jQuery(this).hasClass('selected')) { 
			service_flag = 1;
				var costtype = jQuery(this).data('costtype');
				var serviceid = jQuery(this).data('id');
				if(costtype == 'fixed'){
					var hours = 0;
					servicearr = servicearr + serviceid +'-'+ hours + '%%';
				}else if(costtype == 'hourly' || costtype == 'perperson'){
					var hours = jQuery('#hours-'+serviceid).val();
					servicearr = servicearr + serviceid +'-'+ hours + '%%';
					servicehours = parseFloat(servicehours) + parseFloat(hours);
				}
			}
        });
		jQuery('#servicearr').val(servicearr);
		totalhours = servicehours;
	}
	
	function converttoslider(serviceid,costtype){
	if(costtype == 'perperson'){
		var str = param.perpersion_short;	
		var step = 1;	
	}else{
		var str = param.perhour_short;
		var step = 0.5;
	}	
	//Apply touch spin js on cleaning hours
	jQuery('#hours-'+serviceid).TouchSpin({
        min: 1,
		max: 12,
		initval: 1,
		step: step,
		decimals: 1,
		postfix: str
	}).on('change', function() {
		getservices();
	});
	}
	
	/*Get Time Slots*/
			jQuery('ul.timelist').on('click', 'li', function(){
				jQuery(this).addClass('active').siblings().removeClass('active');
				service_finder_resetMembers();
				var slot = jQuery(this).attr('data-source');
				var t = jQuery(this).find("span").html();
				jQuery("#boking-slot").attr('data-slot',t);
				jQuery("#boking-slot").val(slot);
				
				if(jQuery.inArray("availability", caps) > -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
				var zipcode = jQuery('input[name="zipcode"]').val();
				var region = jQuery('select[name="region"]').val();
				var provider_id = jQuery('#provider').attr('data-provider');
				var date = jQuery('#selecteddate').attr('data-seldate');
				
				var data = {
					  "action": "load_members",
					  "zipcode": zipcode,
					  "region": region,
					  "provider_id": provider_id,
					  "date": date,
					  "slot": slot,
					};
				var formdata = jQuery.param(data);
				  
				jQuery.ajax({
	
					type: 'POST',
	
					url: ajaxurl,
	
					data: formdata,
					
					dataType: "json",
					
					beforeSend: function() {
						jQuery('.loading-area').show();
					},
	
					success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							jQuery("#panel-2").find(".alert").remove();
							 if(data != null){
								if(data['status'] == 'success'){
									jQuery("#panel-2").find("#members").html(data['members']);
									if(data['totalmember'] > 0){
									jQuery("#panel-2").find("#members").append('<div class="col-lg-12"><div class="row"><div class="checkbox text-left"><input id="anymember" class="anymember" type="checkbox" name="anymember[]" value="yes" checked><label for="anymember">'+param.anyone+'</label></div></div></div>');
									member_flag = 1;
									}else{
									member_flag = 0;								
									}
									jQuery('.display-ratings').rating();
									jQuery('.sf-show-rating').show();
								}
							}
					}
	
				});	
				}
				
				
			});	
			/*Staff Member click event*/
			jQuery('body').on('click', '.staff-member .sf-element-bx', function(){																		
				var memberid = jQuery(this).attr("data-id");																
				jQuery("#memberid").val(memberid);
				jQuery(".staff-member .sf-element-bx").removeClass('selected');
				jQuery(this).addClass('selected');
				jQuery(this).prop("checked",status);
				jQuery('.anymember').prop("checked",false);
				jQuery(".anymember").removeAttr("disabled");
			});
			/*Select any staff member*/
			jQuery('body').on('click', '.anymember', function(){				
				jQuery(".staff-member .sf-element-bx").removeClass('selected');
				jQuery("#memberid").val('');
				jQuery("#memberid").attr('data-memid','');
				
				jQuery(".anymember")
				 .prop("disabled", this.checked)
				 .prop("checked", this.checked);
			});
			
			
			/*Step 1 Start*/
			jQuery('body').on('click', '#panel-1 button.edit', function(){
				
				jQuery(this).parent("h6").parent("div").find(".panel-summary").html('');
				jQuery("#panel-2").find(".f-row").addClass('hidden');
				jQuery("#panel-3").find(".f-row").addClass('hidden');
				jQuery("#panel-4").find(".f-row").addClass('hidden');
				jQuery("#panel-1 .f-row").removeClass('hidden');
				
				jQuery("#panel-2 h6").find("button.edit").remove();
				jQuery("#panel-3 h6").find("button.edit").remove();
				jQuery("#panel-4 h6").find("button.edit").remove();
				
			});
			/*Step 2 Start*/
			jQuery('body').on('click', '#panel-2 button.edit', function(){
				
				jQuery(this).parent("h6").parent("div").find(".panel-summary").html('');
				jQuery("#panel-1").find(".f-row").addClass('hidden');
				jQuery("#panel-3").find(".f-row").addClass('hidden');
				jQuery("#panel-4").find(".f-row").addClass('hidden');
				jQuery("#panel-2 .f-row").removeClass('hidden');
				
				jQuery("#panel-3 h6").find("button.edit").remove();
				jQuery("#panel-4 h6").find("button.edit").remove();
				
			});
			/*Step 3 Start*/
			jQuery('body').on('click', '#panel-3 button.edit', function(){
				
				jQuery(this).parent("h6").parent("div").find(".panel-summary").html('');
				jQuery("#panel-1").find(".f-row").addClass('hidden');
				jQuery("#panel-2").find(".f-row").addClass('hidden');
				jQuery("#panel-4").find(".f-row").addClass('hidden');
				jQuery("#panel-3 .f-row").removeClass('hidden');
				
				jQuery("#panel-4 h6").find("button.edit").remove();
				
			});
			/*Step 4 Start*/
			jQuery('body').on('click', '#panel-4 button.edit', function(){
				
				jQuery(this).parent("h6").parent("div").find(".panel-summary").html('');
				jQuery("#panel-1").find(".f-row").addClass('hidden');
				jQuery("#panel-2").find(".f-row").addClass('hidden');
				jQuery("#panel-3").find(".f-row").addClass('hidden');
				jQuery("#panel-4 .f-row").removeClass('hidden');
				
			});
	
	/*Gallery*/
			jQuery('.gallery-thums').on('click', 'div.item a', function(){
				jQuery('.loading-cover').show();
				var src = jQuery(this).attr('data-src');	 
				jQuery('.galley-details').find('.item a img').load(function() {
				  jQuery('.loading-cover').hide();
				}).attr('src',src);
			});
			
	/*Add to Favorite*/
	jQuery('body').on('click', '.add-favorite', function(){

				var providerid = jQuery(this).attr('data-proid');
				var userid = jQuery(this).attr('data-userid');
				var data = {
						  "action": "addtofavorite",
						  "userid": userid,
						  "providerid": providerid
						};
						
				var formdata = jQuery.param(data);
				
				jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						beforeSend: function() {
							jQuery('.loading-area').show();
						},
						
						data: formdata,
						
						dataType: "json",

						success:function (data, textStatus) {
							
							jQuery('.loading-area').hide();
							if(data['status'] == 'success'){
								
								jQuery( '<a href="javascript:;" class="remove-favorite" data-proid="'+providerid+'" data-userid="'+userid+'"><i class="fa fa-heart"></i>'+param.my_fav+'</a>' ).insertBefore( ".add-favorite" );
								jQuery('.add-favorite').remove();

							}

							
						}

					});																
	});
	
	/*Remove from Favorite*/
	jQuery('body').on('click', '.remove-favorite', function(){

				var providerid = jQuery(this).attr('data-proid');
				var userid = jQuery(this).attr('data-userid');
				var data = {
						  "action": "removefromfavorite",
						  "userid": userid,
						  "providerid": providerid
						};
						
				var formdata = jQuery.param(data);
				
				jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						beforeSend: function() {
							jQuery('.loading-area').show();
						},
						
						data: formdata,
						
						dataType: "json",

						success:function (data, textStatus) {
							
							jQuery('.loading-area').hide();
							if(data['status'] == 'success'){
								
								jQuery( '<a href="javascript:;" class="add-favorite" data-proid="'+providerid+'" data-userid="'+userid+'"><i class="fa fa-heart"></i>'+param.add_to_fav+'</a>' ).insertBefore( ".remove-favorite" );
								jQuery('.remove-favorite').remove();

							}

							
						}

					});																
	});
	
	provider_id = jQuery('#provider').attr('data-provider');
	
	
	var data = {
				  "action": "reset_bookingcalendar",
				  "provider_id": provider_id
				};
		
	var formdata = jQuery.param(data);
	
	jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery('.loading-area').show();
				},
				
				data: formdata,

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					if(data['status'] == 'success'){
					daynumarr = jQuery.parseJSON(data['daynum']);
					datearr = jQuery.parseJSON(data['dates']);
					bookedarr = jQuery.parseJSON(data['bookeddates']);
					service_finder_deleteCookie('setselecteddate');
					jQuery("#my-calendar").zabuto_calendar({
						today: true,
						show_previous: false,
						mode : 'add',
						daynum : daynumarr,
						datearr : datearr,
						bookedarr : bookedarr,
                        action: function () {
							jQuery('.dow-clickable').removeClass("selected");
							jQuery(this).addClass("selected");
							date = jQuery("#" + this.id).data("date");
							service_finder_setCookie('setselecteddate', date); 
							
							if(jQuery.inArray("availability", caps) > -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
								return service_finder_timeslotCallback(this.id, provider_id, totalhours);
							}else if(jQuery.inArray("availability", caps) > -1 && jQuery.inArray("staff-members", caps) > -1 && (staffmember == 'no' || staffmember == "")){
								return service_finder_timeslotCallback(this.id, provider_id, totalhours);
							}else if(jQuery.inArray("availability", caps) > -1 && (jQuery.inArray("staff-members", caps) == -1 || (staffmember == 'no' || staffmember == ""))){
								return service_finder_timeslotCallback(this.id, provider_id, totalhours);
							}else if(jQuery.inArray("availability", caps) == -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
								return service_finder_memberCallback(this.id, provider_id);	
							}else if(jQuery.inArray("availability", caps) == -1 && (jQuery.inArray("staff-members", caps) == -1 || (staffmember == 'no' || staffmember == ""))){
								jQuery('#selecteddate').attr('data-seldate',date);	
							}
                        },
                    });
					
					}else if(data['status'] == 'error'){
					}
					
					
				
				}

			});
	
	
	/*Booknow wizard continue action*/
	jQuery('.book-now')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				zipcode: {
					validators: {
						notEmpty: {
							message: param.postal_code
						}
					}
				},
				region: {
					validators: {
						notEmpty: {
							message: param.region
						}
					}
				},
				'service[]': {
					validators: {
						choice: {
							min: 1,
							max: 100,
							message: param.select_service
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
		.on('click', '.otp', function() {
				
				var emailid = jQuery("#email").val();
				var data = {
						  "action": "sendotp",
						  "emailid": emailid,
						};
						
				var formdata = jQuery.param(data);
				
				jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						beforeSend: function() {
							jQuery('.loading-area').show();
						},
						
						data: formdata,

						success:function (data, textStatus) {
							service_finder_clearconsole();
							jQuery('.loading-area').hide();
							jQuery( '<div class="alert alert-success padding-5 otpsuccess">'+param.otp_mail+'</div>' ).insertAfter( ".otp-section .input-group" );
							service_finder_setCookie('otppass', data); 
							service_finder_setCookie('vaildemail',emailid);
							jQuery(".otp").remove();
							
											jQuery('.book-now')
											.bootstrapValidator('addField', 'fillotp', {
												validators: {
															notEmpty: {
																message: param.otp_pass
															},
															callback: {
																message: param.otp_right,
																callback: function(value, validator, $field) {
																	if(service_finder_getCookie('otppass') == value){
																	return true;
																	}else{
																	return false;	
																	}
																}
															}
														}
											})
											.bootstrapValidator('addField', 'email', {
												validators: {
															emailAddress: {
																message: param.signup_user_email
															},
															callback: {
																message: param.reconfirm_email,
																callback: function(value, validator, $field) {
																	if(service_finder_getCookie('vaildemail') == value){
																	return true;
																	}else{
																	jQuery(".otp").remove();
																	jQuery(".otpsuccess").remove();	
																	jQuery( '<a href="javascript:;" class="otp">'+param.gen_otp+'</a>' ).insertAfter( ".otp-section .input-group" );
																	
																	return false;	
																	}
																}
															}
														}
											});
						}

					});					  
		})
		.on('click', '#save-zipcodes', function() {
												
						jQuery('.book-now').bootstrapValidator('validate');
						
						var zipcode = jQuery('input[name="zipcode"]').val();
						var region = jQuery('select[name="region"]').val();
						if(booking_basedon == 'zipcode'){
							if(zipcode != ""){	
							var data = {
								  "action": "check_zipcode",
								  "zipcode": zipcode,
								  "provider_id": provider_id,
								};
							var formdata = jQuery.param(data);
							  
							jQuery.ajax({
				
								type: 'POST',
				
								url: ajaxurl,
				
								data: formdata,
								
								dataType: "json",
								
								beforeSend: function() {
									jQuery('.loading-area').show();
								},
				
								success:function (data, textStatus) {
									jQuery('.loading-area').hide();
									jQuery("#panel-1").find(".alert").remove();
									if(data['status'] == 'success' && ((service_flag == 1 || checkjobauthor == 1) || booking_charge_on_service == 'no')){
										jQuery("#panel-1 .f-row").addClass('hidden');
										jQuery("#panel-1").find(".panel-summary").html(zipcode);
										jQuery("#panel-1 h6").append('<button class="btn btn-border btn-xs edit"><i class="fa fa-pencil"></i>'+param.edit_text+'</button>');
										jQuery("#panel-2 .f-row").removeClass('hidden');
										jQuery("#panel-2").find(".panel-summary").html('');
										if(oldzipcode != zipcode){
											
										
										jQuery("#panel-3").find(".panel-summary").html('');
										
										jQuery('.timeslots').html('');
										jQuery('#members').html('');
										
										jQuery('#boking-slot').val('');
										jQuery('#memberid').val('');
										jQuery('#selecteddate').val('');
										}
										
										oldzipcode = zipcode;
										
										jQuery('.book-now')
										.bootstrapValidator('addField', 'firstname', {
											validators: {
												notEmpty: {
													message: param.signup_first_name
												}
											}
										})
										.bootstrapValidator('addField', 'lastname', {
											validators: {
												notEmpty: {
													message: param.signup_last_name
												}
											}
										})
										.bootstrapValidator('addField', 'email', {
											validators: {
												notEmpty: {
														message: param.req
													},
												emailAddress: {
													message: param.signup_user_email
												}
											}
										})
										.bootstrapValidator('addField', 'fillotp', {
											validators: {
												notEmpty: {
														message: param.req
													},
												callback: {
																message: 'Please insert correct otp',
																callback: function(value, validator, $field) {
																	if(service_finder_getCookie('otppass') == value && service_finder_getCookie('otppass') != ""){
																	return true;
																	}else{
																	return false;	
																	}
																}
															}
											}
										})
										.bootstrapValidator('addField', 'phone', {
											validators: {
												notEmpty: {
														message: param.req
													},
                   								digits: {message: param.only_digits},
											}
										})
										.bootstrapValidator('addField', 'address', {
											validators: {
												notEmpty: {
													message: param.signup_address
												}
											}
										})
										.bootstrapValidator('addField', 'city', {
											validators: {
												notEmpty: {
													message: param.city
												}
											}
										})
										.bootstrapValidator('addField', 'state', {
											validators: {
												notEmpty: {
													message: param.state
												}
											}
										})
										.bootstrapValidator('addField', 'country', {
											validators: {
												notEmpty: {
													message: param.signup_country
												}
											}
										});
									}else{
										jQuery(".f-row").addClass('hidden');
										jQuery("#panel-1 .f-row").removeClass('hidden');
										jQuery(".panel-summary").html('');
										jQuery("button.edit").remove();
										if(checkjobauthor == 1 || booking_charge_on_service == 'no'){
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.service_not_avl+'</div></div>');
										}else{
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.notavl_select_service+'</div></div>');	
										}
									}
								}
				
							});	
						}
						}else if(booking_basedon == 'region'){
								
									jQuery("#panel-1").find(".alert").remove();
									if(region != "" && ((service_flag == 1 || checkjobauthor == 1) || booking_charge_on_service == 'no')){
										jQuery("#panel-1 .f-row").addClass('hidden');
										jQuery("#panel-1").find(".panel-summary").html(region);
										jQuery("#panel-1 h6").append('<button class="btn btn-border btn-xs edit"><i class="fa fa-pencil"></i>EDIT</button>');
										jQuery("#panel-2 .f-row").removeClass('hidden');
										jQuery("#panel-2").find(".panel-summary").html('');
										if(oldregion != region){
											
										
										jQuery("#panel-3").find(".panel-summary").html('');
										
										jQuery('.timeslots').html('');
										jQuery('#members').html('');
										
										jQuery('#boking-slot').val('');
										jQuery('#memberid').val('');
										jQuery('#selecteddate').val('');
										}
										
										oldregion = region;
										
										jQuery('.book-now')
										.bootstrapValidator('addField', 'firstname', {
											validators: {
												notEmpty: {
													message: param.signup_first_name
												}
											}
										})
										.bootstrapValidator('addField', 'lastname', {
											validators: {
												notEmpty: {
													message: param.signup_last_name
												}
											}
										})
										.bootstrapValidator('addField', 'email', {
											validators: {
												notEmpty: {
														message: param.req
													},
												emailAddress: {
													message: param.signup_user_email
												}
											}
										})
										.bootstrapValidator('addField', 'fillotp', {
											validators: {
												notEmpty: {
														message: param.req
													},
												callback: {
																message: param.otp_right,
																callback: function(value, validator, $field) {
																	if(service_finder_getCookie('otppass') == value && service_finder_getCookie('otppass') != ""){
																	return true;
																	}else{
																	return false;	
																	}
																}
															}
											}
										})
										.bootstrapValidator('addField', 'phone', {
											validators: {
												notEmpty: {
														message: param.req
													},
                   								digits: {message: param.only_digits},
											}
										})
										.bootstrapValidator('addField', 'address', {
											validators: {
												notEmpty: {
													message: param.signup_address
												}
											}
										})
										.bootstrapValidator('addField', 'city', {
											validators: {
												notEmpty: {
													message: param.city
												}
											}
										})
										.bootstrapValidator('addField', 'state', {
											validators: {
												notEmpty: {
													message: param.state
												}
											}
										})
										.bootstrapValidator('addField', 'country', {
											validators: {
												notEmpty: {
													message: param.signup_country
												}
											}
										});
									}else{
										jQuery(".f-row").addClass('hidden');
										jQuery("#panel-1 .f-row").removeClass('hidden');
										jQuery(".panel-summary").html('');
										jQuery("button.edit").remove();
										if(checkjobauthor == 1 || booking_charge_on_service == 'no'){
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.region+'</div></div>');
										}else{
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.region_and_service+'</div></div>');			
										}
									}
									
						}else if(booking_basedon == 'open'){
						if(zipcode != ""){	
							var data = {
								  "action": "check_zipcode",
								  "zipcode": zipcode,
								  "provider_id": provider_id,
								};
							var formdata = jQuery.param(data);
							  
							jQuery.ajax({
				
								type: 'POST',
				
								url: ajaxurl,
				
								data: formdata,
								
								dataType: "json",
								
								beforeSend: function() {
									jQuery('.loading-area').show();
								},
				
								success:function (data, textStatus) {
									jQuery('.loading-area').hide();
									jQuery("#panel-1").find(".alert").remove();
									if(data['status'] == 'success' && ((service_flag == 1 || checkjobauthor == 1) || booking_charge_on_service == 'no')){
										jQuery("#panel-1 .f-row").addClass('hidden');
										jQuery("#panel-1").find(".panel-summary").html(zipcode);
										jQuery("#panel-1 h6").append('<button class="btn btn-border btn-xs edit"><i class="fa fa-pencil"></i>EDIT</button>');
										jQuery("#panel-2 .f-row").removeClass('hidden');
										jQuery("#panel-2").find(".panel-summary").html('');
										if(oldzipcode != zipcode){
											
										
										
										jQuery("#panel-3").find(".panel-summary").html('');
										jQuery("#panel-4").find(".panel-summary").html('');
										
										jQuery('.timeslots').html('');
										jQuery('#members').html('');
										
										jQuery('#boking-slot').val('');
										jQuery('#memberid').val('');
										jQuery('#selecteddate').val('');
										}
										
										oldzipcode = zipcode;
										
										jQuery('.book-now')
										.bootstrapValidator('addField', 'firstname', {
											validators: {
												notEmpty: {
													message: param.signup_first_name
												}
											}
										})
										.bootstrapValidator('addField', 'lastname', {
											validators: {
												notEmpty: {
													message: param.signup_last_name
												}
											}
										})
										.bootstrapValidator('addField', 'email', {
											validators: {
												notEmpty: {
														message: param.req
													},
												emailAddress: {
													message: param.signup_user_email
												}
											}
										})
										.bootstrapValidator('addField', 'fillotp', {
											validators: {
												notEmpty: {
														message: param.req
													},
												callback: {
																message: param.otp_right,
																callback: function(value, validator, $field) {
																	if(service_finder_getCookie('otppass') == value && service_finder_getCookie('otppass') != ""){
																	return true;
																	}else{
																	return false;	
																	}
																}
															}
											}
										})
										.bootstrapValidator('addField', 'phone', {
											validators: {
												notEmpty: {
														message: param.req
													},
                   								digits: {message: param.only_digits},
											}
										})
										.bootstrapValidator('addField', 'address', {
											validators: {
												notEmpty: {
													message: param.signup_address
												}
											}
										})
										.bootstrapValidator('addField', 'city', {
											validators: {
												notEmpty: {
													message: param.city
												}
											}
										})
										.bootstrapValidator('addField', 'state', {
											validators: {
												notEmpty: {
													message: param.state
												}
											}
										})
										.bootstrapValidator('addField', 'country', {
											validators: {
												notEmpty: {
													message: param.signup_country
												}
											}
										})
										.bootstrapValidator('addField', 'bookingpayment_mode', {
											validators: {
												notEmpty: {
													message: param.select_payment
												}
											}
										});
										
									}else{
										jQuery(".f-row").addClass('hidden');
										jQuery("#panel-1 .f-row").removeClass('hidden');
										jQuery(".panel-summary").html('');
										jQuery("button.edit").remove();
										if(checkjobauthor == 1 || booking_charge_on_service == 'no'){
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.service_not_avl+'</div></div>');
										}else{
										jQuery("#panel-1").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.notavl_select_service+'</div></div>');	
										}
									}
								}
				
							});	
						}
						}
		})
		.on('click', '#save-timeslot', function() {
						jQuery("#panel-2").find(".alert").remove();
						var getslot = jQuery("#boking-slot").attr("data-slot");
						var date = jQuery('#selecteddate').attr('data-seldate');

						if(jQuery.inArray("availability", caps) == -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
						jQuery("#panel-2").find(".panel-summary").html(date+ ' ' +getslot);
						}
						if(jQuery.inArray("availability", caps) > -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
							jQuery("#panel-2").find(".panel-summary").html(date+ ' ' +getslot);
						}else if(jQuery.inArray("availability", caps) > -1 && jQuery.inArray("staff-members", caps) == -1 && (staffmember == 'no' || staffmember == "")){
							jQuery("#panel-2").find(".panel-summary").html(date+ ' ' +getslot);
						}else if(jQuery.inArray("availability", caps) == -1 && jQuery.inArray("staff-members", caps) > -1 && staffmember == 'yes'){
							jQuery("#panel-2").find(".panel-summary").html(date);
						}else if(jQuery.inArray("availability", caps) == -1 && jQuery.inArray("staff-members", caps) == -1 && (staffmember == 'no' || staffmember == "")){
							jQuery("#panel-2").find(".panel-summary").html(date);
						}
										jQuery("#panel-3 h6").remove('button.edit');
										
										
										jQuery("#panel-3").find(".panel-summary").html('');

						if(jQuery.inArray("availability", caps) > -1){
						if(getslot != ""){
							if(member_flag == 1){
							jQuery("#panel-2 .f-row").addClass('hidden');
							jQuery("#panel-2 h6.mainheading").append('<button class="btn btn-border btn-xs edit"><i class="fa fa-pencil"></i>EDIT</button>');
							jQuery("#panel-3 .f-row").removeClass('hidden');	
							}else{
							jQuery("#step2").find('.tab-pane-inr').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.member_select+'</div></div>');
							}
							
							
						}else{
							jQuery("#panel-2").find('.form-step-bx').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.timeslot+'</div></div>');
						}											   
						}else{
							jQuery("#panel-2 .f-row").addClass('hidden');
							jQuery("#panel-2 h6.mainheading").append('<button class="btn btn-border btn-xs edit"><i class="fa fa-pencil"></i>'+param.edit_text+'</button>');
							jQuery("#panel-3 .f-row").removeClass('hidden');	
						}
		})
		.on('click', '#save-cusinfo', function() {
						var $validator = jQuery('.book-now').data('bootstrapValidator').validate();
						jQuery("#panel-4").find(".panel-summary").html('');
						
						var firstname = jQuery('input[name="firstname"]').val();
						var lastname = jQuery('input[name="lastname"]').val();
						var email = jQuery('input[name="email"]').val();
						var fillotp = jQuery('input[name="fillotp"]').val();
						var phone = jQuery('input[name="phone"]').val();
						var address = jQuery('input[name="address"]').val();
						var city = jQuery('input[name="city"]').val();
						var state = jQuery('input[name="state"]').val();
						var country = jQuery('input[name="country"]').val();

											if($validator.isValid()){		
												var data = {
												  "action": "freecheckout",
												  "provider": provider_id,
												  "totalcost": totalcost,
												  "bookingdate": date,
												};
												
												var formdata = jQuery('form.book-now').serialize() + "&" + jQuery.param(data);
												
												jQuery.ajax({
								
														type: 'POST',
								
														url: ajaxurl,
														
														dataType: "json",
														
														beforeSend: function() {
														jQuery('.loading-area').show();
														},
														
														data: formdata,
								
														success:function (data, textStatus) {
															jQuery('.loading-area').hide();
															jQuery('.alert').remove();
															jQuery('form.book-now').find('input[type="submit"]').prop('disabled', false);
															if(data['status'] == 'success'){
																jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.book-now" );	
																jQuery("html, body").animate({
																	scrollTop: jQuery(".alert-success").offset().top
																}, 1000);
																if(data['redirecturl'] != ''){
																window.location = data['redirecturl'];	
																}else{
																jQuery("#panel-3 .tab-pane-inr").html('<h3>Congratuations! Your booking made successully.</h3>');
																}
																
																		
															}else if(data['status'] == 'error'){
																jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.book-now" );
																jQuery("html, body").animate({
																	scrollTop: jQuery(".alert-danger").offset().top
																}, 1000);
															}
															
														}
								
													});
											}else{
												return false;	
											}
		})
     	.on('success.form.bv', function(form) {
            // Prevent form submission
	        form.preventDefault();
		});

		
  });
   /*Timeslot callback function*/
  function service_finder_timeslotCallback(id, provider_id, totalhours) {
	  	service_finder_resetMembers();
		var date = jQuery("#" + id).data("date");
		jQuery('#selecteddate').attr('data-seldate',date);
		var data = {
			  "action": "get_bookingtimeslot",
			  "seldate": date,
			  "provider_id": provider_id,
			  "totalhours": totalhours,
			};
		var formdata = jQuery.param(data);
		  
		jQuery.ajax({

			type: 'POST',

			url: ajaxurl,

			data: formdata,
			
			beforeSend: function() {
				jQuery('.loading-area').show();
			},

			success:function (data, textStatus) {
				jQuery('.loading-area').hide();
				jQuery('.timeslots').html(data);
				jQuery("#panel-3 h6").remove('button.edit');
				jQuery("#panel-4 h6").remove('button.edit');
			}

		});

		  return true;
	}
	/*Member callback function*/
	function service_finder_memberCallback(id, provider_id) {
	  	service_finder_resetMembers();
		var zipcode = jQuery('input[name="zipcode"]').val();
		var region = jQuery('select[name="region"]').val();
		var provider_id = jQuery('#provider').attr('data-provider');
		var date = jQuery("#" + id).data("date");
		
		var data = {
			  "action": "load_members",
			  "zipcode": zipcode,
			  "region": region,
			  "provider_id": provider_id,
			  "date": date,
			};
		var formdata = jQuery.param(data);
		  
		jQuery.ajax({

			type: 'POST',

			url: ajaxurl,

			data: formdata,
			
			dataType: "json",
			
			beforeSend: function() {
				jQuery('.loading-area').show();
			},

			success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							jQuery("#panel-2").find(".alert").remove();
							 if(data != null){
								if(data['status'] == 'success'){
									jQuery("#panel-2").find("#members").html(data['members']);
									jQuery("#panel-2").find("#members").append('<div class="col-lg-12"><div class="row"><div class="checkbox text-left"><input id="anymember" class="anymember" type="checkbox" name="anymember[]" value="yes" checked><label for="anymember">'+param.anyone+'</label></div></div></div>');
									jQuery('.display-ratings').rating();
									jQuery('.sf-show-rating').show();
								}
							}
					}

		});	

		  return true;
	}	
	/*Reset member function*/
	function service_finder_resetMembers(){
		jQuery("#panel-2").find("#members").html('');
		jQuery("#memberid").val('');	
	}
