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
	var date = '';
	var mysetdate = '';
	var oldzipcode = '';
	var totalhours = 0;
	var daynumarr = [];
	var datearr = [];
	var bookedarr = [];
	var region_flag = 1;
	var servicearr = '';
	var service_flag = 0;
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
				jQuery('#hours-outer-bx-'+serviceid).hide();
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
		var str = param.perpersion;
		var step = 1;
	}else{
		var str = param.perhour;
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
					jQuery("#step2").find(".alert").remove();
					 if(data != null){
						if(data['status'] == 'success'){
							jQuery("#step2").find("#members").html(data['members']);
							if(data['totalmember'] > 0){
							jQuery("#step2").find("#members").append('<div class="col-lg-12"><div class="row"><div class="checkbox text-left"><input id="anymember" class="anymember" type="checkbox" name="anymember[]" value="yes" checked><label for="anymember">'+param.anyone+'</label></div></div></div>');
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
	/*Staff member click event*/ 
	jQuery('body').on('click', '.staff-member .sf-element-bx', function(){																		
		var memberid = jQuery(this).attr("data-id");																
		jQuery("#memberid").val(memberid);
		jQuery(".staff-member .sf-element-bx").removeClass('selected');
		jQuery(this).addClass('selected');
		jQuery(this).prop("checked",status);
		jQuery('.anymember').prop("checked",false);
		jQuery(".anymember").removeAttr("disabled");
	});
	/*Add Any member*/
	jQuery('body').on('click', '.anymember', function(){				
		jQuery(".staff-member .sf-element-bx").removeClass('selected');
				jQuery("#memberid").val('');
				jQuery("#memberid").attr('data-memid','');
				
				jQuery(".anymember")
				 .prop("disabled", this.checked)
				 .prop("checked", this.checked);
	});

	
	/*Add to favorite*/
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
	/*Remove from favorite*/
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
								jQuery('#selecteddate').val(date);
							}
                        },
                    });	
					
					}else if(data['status'] == 'error'){
					}
					
					
				
				}

			});
	
	
	/*Adjust Iframe Height*/
	function service_finder_adjustIframeHeight() {
        var $body   = jQuery('body'),
                $iframe = $body.data('iframe.fv');
        if ($iframe) {
            // Adjust the height of iframe
            $iframe.height($body.height());
        }
    }
	
	
	/*Booking Process*/
	 jQuery('.book-now')
        .bootstrapValidator({
          message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'fa fa-refresh fa-spin'
            },
            fields: {
				zipcode: {
					validators: {
						notEmpty: {
								message: param.postal_code
						},
						remote: {
                        type: 'POST',
                        url: datavalidate+'?provider_id='+provider_id,
                        message: param.postcode_not_avl
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
				firstname: {
					validators: {
						notEmpty: {
							message: param.signup_first_name
						}
					}
				},
				lastname: {
					validators: {
						notEmpty: {
							message: param.signup_last_name
						}
					}
				},
				email: {
                validators: {
                    notEmpty: {
														message: param.req
													},
					emailAddress: {
                        message: param.signup_user_email
                    }
					}
				},
				fillotp: {
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
				},
				phone: {
                validators: {
                    notEmpty: {
														message: param.req
													},
                    digits: {message: param.only_digits},
                }
	            },
				address: {
					validators: {
						notEmpty: {
							message: param.signup_address
						}
					}
				},
				city: {
					validators: {
						notEmpty: {
							message: param.city
						}
					}
				},
				state: {
					validators: {
						notEmpty: {
							message: param.state
						}
					}
				},
				
				country: {
					validators: {
						notEmpty: {
							message: param.signup_country
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
																message: 'Please re-confirm the email address',
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
		.bootstrapWizard({
            tabClass: 'nav nav-pills',
            onTabClick: function(tab, navigation, index) {
				if(booking_basedon == 'region'){
					if(index == 0){
						if(jQuery('.book-now select[name="region"] option:selected').val()==""){
							region_flag = 1;
							jQuery('.book-now select[name="region"]').parent('div').addClass('has-error').removeClass('has-success'); 
						}else{
							region_flag = 0;
							jQuery('.book-now select[name="region"]').parent('div').removeClass('has-error').addClass('has-success'); 
						}
						if(region_flag==1){return false;}
					}
				}
				jQuery("#step1").find(".alert").remove();
				if(service_flag == 0 && booking_charge_on_service == 'yes' && checkjobauthor == 0){
					jQuery("#step1").find('.tab-service-area').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.select_service+'</div></div>');
					return false;
				}
				if(index == 1 || index == 3){
				
			  	var $validator = jQuery('.book-now').data('bootstrapValidator').validate();
					 if($validator.isValid()){
					jQuery("#step2").find(".alert").remove();
						
						var date = jQuery('#selecteddate').attr('data-seldate');
						if(jQuery.inArray("availability", caps) > -1){
							var getslot = jQuery("#boking-slot").attr("data-slot");
							if(getslot != ""){
								if(member_flag == 1){
								return true;
								}else{
								jQuery("#step2").find('.tab-pane-inr').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.member_select+'</div></div>');
								return false;	
								}
							}else{
								jQuery("#step2").find('.tab-pane-inr').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.timeslot+'</div></div>');
								return false;
							}	
						}else{
							return true;	
						}
					 }else{
						return false;	 
					 }
			  
			  }else{
				var $validator = jQuery('.book-now').data('bootstrapValidator').validate();
                                   return $validator.isValid();  
			  }
            },
            onNext: function(tab, navigation, index) {
              var numTabs    = jQuery('#rootwizard').find('.tab-pane').length;
             jQuery("html, body").animate({
				scrollTop: jQuery(".form-wizard").offset().top
			}, 1000);

			if(booking_basedon == 'region'){
				if(index == 1){
					if(jQuery('.book-now select[name="region"] option:selected').val()==""){
						region_flag = 1;
						jQuery('.book-now select[name="region"]').parent('div').addClass('has-error').removeClass('has-success'); 
					}else{
						region_flag = 0;
						jQuery('.book-now select[name="region"]').parent('div').removeClass('has-error').addClass('has-success'); 
					}
					if(region_flag==1){return false;}
				}
			}
			jQuery("#step1").find(".alert").remove();
			if(service_flag == 0 && booking_charge_on_service == 'yes' && checkjobauthor == 0){
					jQuery("#step1").find('.tab-service-area').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.select_service+'</div></div>');
					return false;
				}	
			 if(index == 2){
			  	
					jQuery("#step2").find(".alert").remove();
						var getslot = jQuery("#boking-slot").attr("data-slot");
						var date = jQuery('#selecteddate').attr('data-seldate');
						jQuery("#totalcost").val(totalcost);
						jQuery("#selecteddate").val(date);
						if(jQuery.inArray("availability", caps) > -1){
							if(getslot != ""){
								if(member_flag == 1){
								return true;
								}else{
								jQuery("#step2").find('.tab-pane-inr').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.member_select+'</div></div>');
								return false;	
								}
							}else{
								jQuery("#step2").find('.tab-pane-inr').append('<div class="col-md-12 clearfix"><div class="alert alert-danger">'+param.timeslot+'</div></div>');
								return false;
							}	
						}else{
							return true;	
						}
						
			  
			  }else if(index  == 3){
					var $validator = jQuery('.book-now').data('bootstrapValidator').validate();
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
										if(data['redirecturl'] != ''){
										window.location = data['redirecturl'];	
										}else{
										jQuery("#step3 .tab-pane-inr").html('<h3>'+param.booking_suc+'</h3>');
										jQuery(".wizard-actions").remove();
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
						
			  }else{
				var $validator = jQuery('.book-now').data('bootstrapValidator').validate();
                                   return $validator.isValid();  
			  }
			  
            },
            onPrevious: function(tab, navigation, index) {
				jQuery("html, body").animate({
				scrollTop: jQuery(".form-wizard").offset().top
			}, 1000);
                return true;
            },
            onTabShow: function(tab, navigation, index) {
                // Update the label of Next button when we are at the last tab
                var numTabs = jQuery('#rootwizard').find('.tab-pane').length;
                jQuery('#rootwizard')
                    .find('.next')
                        .removeClass('disabled')    // Enable the Next button
                        .find('a')
                        .html(index === numTabs - 1 ? param.submit_now : param.next_text+' <i class="fa fa-arrow-right"></i>');

                // You don't need to care about it
                // It is for the specific demo
                service_finder_adjustIframeHeight();
				var $total = navigation.find('li').length;
			var $current = index+1;
			var $percent = ($current/$total) * 100;
			jQuery('#rootwizard').find('.progress-bar').css({width:$percent+'%'});
            }
        });


  });
  /*Callback function to get timeslots*/
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
	/*Callback fucntion to get members*/
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
					jQuery("#step2").find(".alert").remove();
					 if(data != null){
						if(data['status'] == 'success'){
							jQuery("#step2").find("#members").html(data['members']);
							jQuery("#step2").find("#members").append('<div class="col-lg-12"><div class="row"><div class="checkbox text-left"><input id="anymember" class="anymember" type="checkbox" name="anymember[]" value="yes" checked><label for="anymember">'+param.anyone+'</label></div></div></div>');
							jQuery('.display-ratings').rating();
							jQuery('.sf-show-rating').show();
						}
					}
			}

		});	

		  return true;
	}	
	/*Reset Members*/
	function service_finder_resetMembers(){
		jQuery("#step2").find("#members").html('');
		jQuery("#memberid").val('');	
	}
