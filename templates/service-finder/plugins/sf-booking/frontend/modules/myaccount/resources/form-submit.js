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
	
	var category_flag = 1;
	var countryflag = 0;
	var providerlat = '';
	var providerlng = '';
	var map = null;
	var marker = null;
	var videosarr = [];
	
	jQuery('form.user-update input[name="password"]').val('');
	
	jQuery(document).on('click','.claimbusinessaction',function(){
		var providerid = jQuery(this).data('providerid');
		var claimstatus = jQuery(this).data('status');
		claimbusiness(claimstatus,providerid);
	});
	
	function claimbusiness(status,providerid){
		var data = {
		  "action": "claimbusiness",
		  "status": status,
		  "providerid": providerid,
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
							jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.user-update" );	
							if(status == 'enable'){
								jQuery( ".claimbusinessaction" ).data( "status","disable" );
								jQuery( ".claimbusinessaction" ).text( param.disbalebusiness );
							}else{
								jQuery( ".claimbusinessaction" ).data( "status","enable" );
								jQuery( ".claimbusinessaction" ).text( param.enablebusiness );
							}
						}
					
					}
	
				});
	}
	
	jQuery(document).on('click','.set-marker-popup-close',function(){
		jQuery('.set-marker-popup').css('display','none');
	});															   
	jQuery(document).on('click','#showmylocation',function(){
     jQuery('.set-marker-popup').css('display','block');
	 
	 var providerid = jQuery(this).data('providerid');
	 var address = jQuery('input[name="my_location"]').val();
	 var zooml = jQuery('#locationzoomlevel').val();	
	 if(zooml == ""){
		zooml = 14;	 
	 }
	 
	 var data = {
	  "action": "get_mycurrent_location",
	  "providerid": providerid,
	  "address": address,
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
						var providerlat = parseFloat(data['lat']);
						var providerlng = parseFloat(data['lng']);
						if(providerlat > 0 && providerlng > 0){
						initMap(providerlat,providerlng,zooml);
						}else{
						initMap(28.6430536,77.2223442,2);	
						}
						
					}
				
				}

			});
	 
	});
	
	function initMap(lat,lng,zoom) {
	var map = new google.maps.Map(document.getElementById('marker-map'), {
	  zoom: parseInt(zoom),
	  center: {lat: lat, lng: lng}
	});
	
	marker = new google.maps.Marker({
	  map: map,
	  draggable: true,
	  animation: google.maps.Animation.DROP,
	  position: {lat: lat, lng: lng}
	});
	marker.addListener('click', toggleBounce);
	
	map.addListener('zoom_changed', function() {
	  var locationzoomlevel = map.getZoom();
	  jQuery('#locationzoomlevel').val(locationzoomlevel);
	});
	
	google.maps.event.addListener(marker, 'dragend', function (event) {
		providerlat = event.latLng.lat();
		providerlng = event.latLng.lng();
	});
	}
	
	function toggleBounce() {
	if (marker.getAnimation() !== null) {
	  marker.setAnimation(null);
	} else {
	  marker.setAnimation(google.maps.Animation.BOUNCE);
	}
	}
	
	var Youtube = (function () {
		'use strict';
	
		var video, results;
	
		var getThumb = function (url, size) {
			if (url === null) {
				return '';
			}
			size    = (size === null) ? 'big' : size;
			results = url.match('[\\?&]v=([^&#]*)');
			video   = (results === null) ? url : results[1];
	
			if (size === 'small') {
				return 'http://img.youtube.com/vi/' + video + '/default.jpg';
			}
			return 'http://img.youtube.com/vi/' + video + '/0.jpg';
		};
	
		return {
			thumb: getThumb
		};
	}());
	
	function create_video_array(){
		videosarr = [];
		jQuery('ul.rwmb-video-thumb li').each(function(){
				videosarr.push(jQuery(this).data('url'));
		});	
	}
	
	// User Registration Validation and Sublit Form For Provider
	jQuery('.user-update')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				user_name: {
					validators: {
						notEmpty: {
							message: param.signup_user_name
						}
					}
				},
				first_name: {
					validators: {
						notEmpty: {
							message: param.signup_first_name
						}
					}
				},
				primary_category: {
					validators: {
						notEmpty: {
							message: param.primary_category
						}
					}
				},
				category: {
					validators: {
						notEmpty: {
							message: param.category
						}
					}
				},
				last_name: {
					validators: {
						notEmpty: {
							message: param.signup_last_name
						}
					}
				},
				user_email: {
					validators: {
						notEmpty: {
														message: param.req
													},
						emailAddress: {
							message: param.signup_user_email
						}
					}
				},
				address: {
					validators: {
						notEmpty: {
										message: param.signup_address	
									},
									callback: {
										message: param.allowed_country,
										callback: function(value, validator, $field) {
											if(countrycount > 1){
												if(countryflag == 1){
												return false;
												}else{
												return true;	
												}
											}else{
												return true;	
											}
										}
									}
					}
				},
				city: {
					validators: {
						notEmpty: {
							message: param.signup_city
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
				password: {
					validators: {
						identical: {
							field: 'confirm_password',
							message: param.signup_password_confirm
						},
					}
				},
				confirm_password: {
					validators: {
						identical: {
							field: 'password',
							message: param.signup_password_confirm
						},
					}
				},
            }
        })
		.on('click',  'input[name="update-profile"]', function(e) {
															   
			var getaddress = jQuery("#address").val();
			var getcity = jQuery("#city").val();
			var getstate = jQuery("#state").val();
			var getcountry = jQuery("#country").val();
				
			getaddress = getaddress.toLowerCase();
			getcity = getcity.toLowerCase();
			getstate = getstate.toLowerCase();
			getcountry = getcountry.toLowerCase();
			
			getaddress = getaddress.replace(getcity,"");
			getaddress = getaddress.replace(getstate,"");
			getaddress = getaddress.replace(getcountry,"");
			getaddress = jQuery.trim(getaddress);
			
			
			getaddress = getaddress.replace(/,/g, '');
			getaddress = getaddress.replace(/ +/g," ");
			jQuery("#address").val(getaddress);															   
			
			jQuery('.user-update').bootstrapValidator('revalidateField', 'address');
			jQuery('.user-update').bootstrapValidator('revalidateField', 'city');
			jQuery('.user-update').bootstrapValidator('revalidateField', 'country');
			
		
			if(jQuery('.user-update select[name="country"] option:selected').val()==""){countryflag = 1;jQuery('.user-update select[name="country"]').parent('div').addClass('has-error').removeClass('has-success'); jQuery('form.user-update').find('input[type="submit"]').prop('disabled', false);}else{countryflag = 0;jQuery('.user-update select[name="country"]').parent('div').removeClass('has-error').addClass('has-success'); jQuery('form.user-update').find('input[type="submit"]').prop('disabled', false);}
			
	    })
		.on('error.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false); // disable submit buttons on errors
	    })
		.on('status.field.bv', function(e, data) {
            data.bv.disableSubmitButtons(false); // disable submit buttons on valid
        })
		.on('change', 'input[type="radio"][name="service_perform"]', function() {
                var service_perform = jQuery(this).val();
                if (service_perform == 'provider_location') {
                    jQuery('#providerlocation_bx').show();
				} else if(service_perform == 'customer_location' || service_perform == 'both') {
					jQuery('#providerlocation_bx').hide();
				} 
        })
		.on('click', 'input[name="addvideo"]', function() {
               var embeded_code = jQuery('#embeded_code').val();
			   
			   if(embeded_code != '' && embeded_code != undefined){
			   	 var selectedcountry = jQuery(this).val();
			   var data = {
						  "action": "identify_video_type",
						  "embeded_code": embeded_code
						};
			
				var formdata = jQuery.param(data);

				jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: formdata,
									dataType: "json",
									success:function (data, textStatus) {
										if(data['videotype'] == 'youtube'){
										   var thumb = Youtube.thumb(embeded_code, 'small');
										   jQuery('.sf-videothumbs ul.rwmb-video-thumb').append('<li data-url="'+embeded_code+'"><img src="'+thumb+'" width="150"><div class="rwmb-thumb-bar rwmb-image-bar"><a title="Delete" class="rwmb-delete-vthumb rwmb-delete-file" href="javascript:;">x</a></div></li>');
										   jQuery('#embeded_code').val('');
										   create_video_array();
										}else if(data['videotype'] == 'vimeo'){
											var thumb = data['thumburl'];
										   jQuery('.sf-videothumbs ul.rwmb-video-thumb').append('<li data-url="'+embeded_code+'"><img src="'+thumb+'" width="150"><div class="rwmb-thumb-bar rwmb-image-bar"><a title="Delete" class="rwmb-delete-vthumb rwmb-delete-file" href="javascript:;">x</a></div></li>');
										   jQuery('#embeded_code').val('');
										   create_video_array();
										}else if(data['videotype'] == 'facebook'){
											var thumb = data['thumburl'];
										   jQuery('.sf-videothumbs ul.rwmb-video-thumb').append('<li data-url="'+embeded_code+'"><img src="'+thumb+'" width="150"><div class="rwmb-thumb-bar rwmb-image-bar"><a title="Delete" class="rwmb-delete-vthumb rwmb-delete-file" href="javascript:;">x</a></div></li>');
										   jQuery('#embeded_code').val('');
										   create_video_array();
										}		

									}
			
								});
				
				
			   }else{
				alert(param.video_req);   
			   }
        })
		.on('click', '.rwmb-thumb-bar a', function() {
               jQuery(this).closest('li').remove();
			   
			   create_video_array();
        })
		.on('change', 'input[type="radio"][name="booking_process"]', function() {
                var bookingProcess   = jQuery(this).val();
				var bookingOption   = jQuery('input[type="radio"][name="booking_option"]:checked').val();
				var bookingAssignment   = jQuery('input[type="radio"][name="booking_assignment"]:checked').val();
                if (bookingProcess == 'off') {
                    jQuery('#bookingalert').hide();
					jQuery('#bookingchargeamount').hide();
					jQuery('#bookingbasedon').hide();
					jQuery('#bookingOption').hide();
					jQuery('#minCost').hide();
					jQuery('#paypalemail').hide();
					jQuery('#payoptions').hide();
					jQuery('#stripekey').hide();
					jQuery('#twocheckoutkey').hide();
					jQuery('#wiredescription').hide();
					jQuery('#wireinstructions').hide();
					jQuery('#bookingAssignment').hide();
					jQuery('#membersAvailable').hide();

                } else if(bookingProcess == 'on' && bookingOption == 'paid') {
					jQuery('#bookingalert').show();
					jQuery('#bookingchargeamount').show();
					jQuery('#bookingbasedon').show();
                    jQuery('#bookingOption').show();
					jQuery('#minCost').show();
					jQuery('#paypalemail').show();
					jQuery('#stripekey').show();
					jQuery('#twocheckoutkey').show();
					jQuery('#wiredescription').show();
					jQuery('#wireinstructions').show();
					jQuery('#payoptions').hide();
					jQuery('#bookingAssignment').show();
					jQuery('#membersAvailable').show();
					
				} else if(bookingProcess == 'on') {
					jQuery('#bookingalert').show();
					jQuery('#bookingchargeamount').show();		
					jQuery('#bookingbasedon').show();
                    jQuery('#bookingOption').show();
					jQuery('#bookingAssignment').show();
					jQuery('#membersAvailable').show();
					jQuery('#paypalemail').hide();
					jQuery('#stripekey').hide();
					jQuery('#twocheckoutkey').hide();
					jQuery('#wiredescription').hide();
					jQuery('#wireinstructions').hide();
				} 
				if(bookingProcess == 'on' && bookingAssignment == 'automatically') {
					jQuery('#membersAvailable').show();
				 }else if(bookingProcess == 'on' && bookingAssignment == 'manually') {
					jQuery('#membersAvailable').hide();
				 } 
         })
		.on('change', 'input[type="radio"][name="booking_assignment"]', function() {
                var bookingAssignment = jQuery(this).val();
                if (bookingAssignment == 'manually') {
                    jQuery('#membersAvailable').hide();

				} else if(bookingAssignment == 'automatically') {
					jQuery('#membersAvailable').show();
				} 
         })
		.on('change', 'input[type="radio"][name="google_calendar"]', function() {
                var google_calendar = jQuery(this).val();
                if (google_calendar == 'on') {
                    jQuery('#google_calendar_options').show();
					jQuery('.user-update')
					.bootstrapValidator('addField', 'google_calendar_id', {
						validators: {
							notEmpty: {
								message: param.req
							},
						}
					});

				} else if(google_calendar == 'off') {
					jQuery('#google_calendar_options').hide();
					jQuery('.user-update')
					.bootstrapValidator('removeField', 'google_calendar_id');
				} 
         })
		.on('change', 'select[name="category[]"]', function() {
				var provider_categories = '';															
				var primaryid = jQuery(this).data('primaryid');

				jQuery('select[name="category[]"] option:selected').each(function(){
					var catid = jQuery(this).val();
					var catname = jQuery(this).text();
					if(primaryid == catid){
						var checked = 'checked';	
					}else{
						var checked = '';
					}
					provider_categories += '<div class="radio"><input id="cat-'+catid+'" '+checked+' type="radio" name="primary_category" value="'+catid+'"><label for="cat-'+catid+'">'+catname+'</label></div>'																				  	
				});
				jQuery('#providers-category-bx').html(provider_categories)
				
				jQuery('.user-update')
				.bootstrapValidator('addField', 'primary_category', {
					validators: {
						notEmpty: {
														message: param.req
													},
					}
				});
         })
		.on('change', 'select[name="country"]', function() {
				var selectedcountry = jQuery(this).val();
				var data = {
						  "action": "load_cities_by_country",
						  "country": selectedcountry
						};
			
				var formdata = jQuery.param(data);

				jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: formdata,
									dataType: "text",
									success:function (data, textStatus) {
										jQuery('#city').html(data);
										jQuery('select').selectpicker('refresh');
									}
			
								});
		})
		.on('click', '.updategcal', function() {
				var google_client_id = jQuery('input[name="google_client_id"]').val();
				var google_client_secret = jQuery('input[name="google_client_secret"]').val();
				var providerid = jQuery(this).data('providerid');
				
				if(google_client_id == ""){
					alert(param.google_client_id_req);	
					return false;
				}
				
				if(google_client_secret == ""){
					alert(param.google_client_secret_req);	
					return false;
				}
				
				var data = {
						  "action": "update_gcal_info",
						  "google_client_id": google_client_id,
						  "google_client_secret": google_client_secret,
						  "providerid": providerid
						};
			
				var formdata = jQuery.param(data);

				jQuery.ajax({
									type: 'POST',
									url: ajaxurl,
									data: formdata,
									dataType: "json",
									beforeSend: function() {
										jQuery(".alert").remove();
										jQuery('.loading-area').show();
									},
									success:function (data, textStatus) {
										jQuery('.loading-area').hide();
										if(data['status'] == 'success'){
											jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.user-update" );	
											jQuery( "#connectbtn" ).html(data['connectlink']);	
											jQuery( "#gcallist" ).remove();	
										}else if(data['status'] == 'error'){
											jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.user-update" );
										}
									}
			
								});
		})
		.on('click', 'input[type="checkbox"][name="pay_options[]"]', function() {
				var option = jQuery(this).val();
				if(jQuery(this).is(':checked')) { 
					if(option == 'paypal'){
						jQuery('#paypalemail').show();
											jQuery('.user-update')
											.bootstrapValidator('addField', 'paypalusername', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'paypalpassword', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'paypalsignatue', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
											
						
					}else if(option == 'stripe'){
						jQuery('#stripekey').show();
						
										    jQuery('.user-update')
											.bootstrapValidator('addField', 'stripesecretkey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'stripepublickey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
					}else if(option == 'twocheckout'){
						jQuery('#twocheckoutkey').show();
						
										    jQuery('.user-update')
											.bootstrapValidator('addField', 'twocheckoutaccountid', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'twocheckoutpublishkey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'twocheckoutprivatekey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
					}else if(option == 'wired'){
						jQuery('#wiredescription').show();
						jQuery('#wireinstructions').show();
						
										    jQuery('.user-update')
											.bootstrapValidator('addField', 'wired_description', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'wired_instructions', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
					}else if(option == 'payumoney'){
						jQuery('#payumoneyinfo').show();
						
										    jQuery('.user-update')
											.bootstrapValidator('addField', 'payumoneymid', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'payumoneykey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'payumoneysalt', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
					}else if(option == 'payulatam'){
						jQuery('#payulataminfo').show();
						
										    jQuery('.user-update')
											.bootstrapValidator('addField', 'payulatammerchantid', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'payulatamapilogin', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'payulatamapikey', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											})
											.bootstrapValidator('addField', 'payulatamaccountid', {
												validators: {
													notEmpty: {
														message: param.req
													},
												}
											});
					}
					
                }else{
					if(option == 'paypal'){
						jQuery('#paypalemail').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'paypalusername')
											.bootstrapValidator('removeField', 'paypalpassword')
											.bootstrapValidator('removeField', 'paypalsignatue');
						
					}else if(option == 'stripe'){
						jQuery('#stripekey').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'stripesecretkey')
											.bootstrapValidator('removeField', 'stripepublickey');
					}else if(option == 'twocheckout'){
						jQuery('#twocheckoutkey').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'twocheckoutaccountid')
											.bootstrapValidator('removeField', 'twocheckoutpublishkey')
											.bootstrapValidator('removeField', 'twocheckoutprivatekey');
					}else if(option == 'wired'){
						jQuery('#wiredescription').hide();
						jQuery('#wireinstructions').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'wired_description')
											.bootstrapValidator('removeField', 'wired_instructions');
					}else if(option == 'payumoney'){
						jQuery('#payumoneyinfo').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'payumoneymid')
											.bootstrapValidator('removeField', 'payumoneykey')
											.bootstrapValidator('removeField', 'payumoneysalt');
					}else if(option == 'payulatam'){
						jQuery('#payulataminfo').hide();
											jQuery('.user-update')
											.bootstrapValidator('removeField', 'payulatammerchantid')
											.bootstrapValidator('removeField', 'payulatamapilogin')
											.bootstrapValidator('removeField', 'payulatamapikey')
											.bootstrapValidator('removeField', 'payulatamaccountid');
					}
				}																			
         })
		.on('change', 'input[type="radio"][name="booking_option"]', function() {
                var bookingOption   = jQuery(this).val();

                if (bookingOption == 'free') {
                    jQuery('#minCost').hide();
					jQuery('#payoptions').hide();
					jQuery('#paypalemail').hide();
					jQuery('#stripekey').hide();
					jQuery('#twocheckoutkey').hide();
					jQuery('#wiredescription').hide();
					jQuery('#wireinstructions').hide();
					
					jQuery('.user-update')
                       .bootstrapValidator('removeField', 'mincost');

                } else if(bookingOption == 'paid') {
                    jQuery('#minCost').show();
					jQuery('#payoptions').show();
					jQuery('#paypalemail').show();
					jQuery('#stripekey').show();
					jQuery('#twocheckoutkey').show();
					jQuery('#wiredescription').show();
					jQuery('#wireinstructions').show();
					jQuery('.user-update')
                       .bootstrapValidator('addField', 'mincost', {
                            validators: {
                                notEmpty: {
                                    message: param.min_cost
                                }
                            }
                        });
				}
         })
        .on('success.form.bv', function(form) {
            // Prevent form submission
			
			//tinyMCE.triggerSave();
			
            form.preventDefault();
			
			// Get the form instance
            var $form = jQuery(form.target);
			
			if(jQuery('select[name="category[]"] option:selected').val() > 0){
				category_flag = 0;
				jQuery('select[name="category[]"]').parent('div').removeClass('has-error').addClass('has-success'); 
			}else{
				category_flag = 1;
				jQuery('select[name="category[]"]').parent('div').addClass('has-error').removeClass('has-success'); 
			}
			if(category_flag==1){
				$form.find('input[type="submit"]').prop('disabled', false);
				return false;
			}
			
			//tinyMCE.triggerSave();
            
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "update_user",
			  "providerlat": providerlat,
			  "providerlng": providerlng,
			  "videosarr": videosarr,
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
							$form.find('input[type="submit"]').prop('disabled', false);
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.user-update" );	
								jQuery('select[name="category[]"]').attr('data-primaryid',data['primarycatid']);
								jQuery('select').selectpicker('refresh');
								jQuery("html, body").animate({
										scrollTop: jQuery("#my-profile").offset().top
									}, 1000);
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.user-update" );
								jQuery("html, body").animate({
										scrollTop: jQuery("#my-profile").offset().top
									}, 1000);
							}
						
						}

					});
			
        });
	
	//Customer Update section
	jQuery('.customer-update')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				first_name: {
					validators: {
						notEmpty: {
							message: param.signup_first_name
						}
					}
				},
				last_name: {
					validators: {
						notEmpty: {
							message: param.signup_last_name
						}
					}
				},
				user_email: {
					validators: {
						notEmpty: {
														message: param.req
													},
						emailAddress: {
							message: param.signup_user_email
						}
					}
				},
				password: {
					validators: {
						identical: {
							field: 'confirm_password',
							message: param.signup_password_confirm
						},
					}
				},
				confirm_password: {
					validators: {
						identical: {
							field: 'password',
							message: param.signup_password_confirm
						},
					}
				},
            }
        })
		 .on('success.form.bv', function(form) {
            // Prevent form submission
			
            form.preventDefault();
			
            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "update_customer"
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
							$form.find('input[type="submit"]').prop('disabled', false);
							
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.customer-update" );	
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.customer-update" );
							}
						
						}

					});
        });
	
	//Tabbing on My Account Page
	jQuery("#myTab a").click(function(e){
		e.preventDefault();
		jQuery(this).tab('show');
	});
	
	//Tabbing on My Account Page
	jQuery(".openidentitychk").click(function(e){
		 jQuery("#identityCheck").modal({

            backdrop: "static",

            keyboard: false

        });
	});
	
	//Identity Check
	jQuery('.identitycheck')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				identityattachmentid: {
					validators: {
						notEmpty: {}
					}
				},
            }
        })
		 .on('success.form.bv', function(form) {
            // Prevent form submission
			
            form.preventDefault();
			
            // Get the form instance
            var $form = jQuery(form.target);
            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
			
			var data = {
			  "action": "upload_identity"
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
							$form.find('input[type="submit"]').prop('disabled', false);
							
							if(data['status'] == 'success'){
								jQuery( "<div class='alert alert-success'>"+data['suc_message']+"</div>" ).insertBefore( "form.identitycheck" );	
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.identitycheck" );
							}
						
						}

					});
        });
	
  
  
  if (jQuery('#submit-fixed').length){
  var top = jQuery('#submit-fixed').offset().top - parseFloat(jQuery('#submit-fixed').css('marginTop').replace(/auto/, 0));
  var footTop = jQuery('#footer').offset().top - parseFloat(jQuery('#footer').css('marginTop').replace(/auto/, 0));
 
  var maxY = footTop - jQuery('#submit-fixed').outerHeight();
 
  jQuery(window).scroll(function(evt) {
   var y = jQuery(this).scrollTop();
   if (y > top) {
    if (y < maxY) {
     jQuery('#submit-fixed').addClass('fixed').removeAttr('style');
    } else {
     jQuery('#submit-fixed').removeClass('fixed').css({
      position: 'absolute',
      top: (maxY - top) + 'px'
     });
    }
   } else {
    jQuery('#submit-fixed').removeClass('fixed');
   }
  });
  }
  
  
  
  
  });
  
  