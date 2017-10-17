/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

  jQuery('body').on('click', '.editMemberButton', function(){
        jQuery('.loading-area').show();
		// Get the record's ID via attribute
        var memberid = jQuery(this).attr('data-id');
		
		var data = {
			  "action": "load_member",
			  "memberid": memberid,
			  "user_id": user_id
			};
			
	  var formdata = jQuery.param(data);
	  
	  jQuery.ajax({

						type: 'POST',

						url: ajaxurl,

						data: formdata,
						
						dataType: "json",

						success:function (data, textStatus) {
							// Populate the form fields with the data returned from server
							jQuery('#editmember')
								.find('[name="member_fullname"]').val(data['member_fullname']).end()
								.find('[name="member_email"]').val(data['member_email']).end()
								.find('[name="memberid"]').val(memberid).end()
								.find('#memberavataredit').html(data['avatar']).end()
								.find('#editloadservices').html(data['newzipcodes']).end()
								.find('#editloadregions').html(data['newregions']).end()
								.find('[name="member_phone"]').val(data['member_phone']).end();
							
								var str = data['service_area'];
								if(str != "" && str != null){
								var areas = str.split(",");
								for(x in areas){
								jQuery('[name="sarea[]"][value="'+areas[x]+'"]').prop('checked', true).end()
								}
								}
								
								var str = data['selected_regions'];
								if(str != "" && str != null){
								var regions = str.split("%%%");
								for(x in regions){
								jQuery('[name="region[]"][value="'+regions[x]+'"]').prop('checked', true).end()
								}
								}

								
							if((data['avatar_id'] != "" && data['avatar_id'] > 0) || data['admin_avatar_id']){
								jQuery('#sfmemberavataruploadedit-dragdrop').addClass('hidden');
							}else{
								jQuery('#sfmemberavataruploadedit-dragdrop').removeClass('hidden');
							}
							// Show the dialog
							bootbox
								.dialog({
									title: 'Edit Member',
									message: jQuery('#editmember'),
									show: false // We will show it manually later
								})
								.on('shown.bs.modal', function() {
									jQuery('.loading-area').hide();															   
									jQuery('#editmember')
										.show()                             // Show the login form
										.bootstrapValidator('resetForm'); // Reset form
								})
								.on('hide.bs.modal', function(e) {
									// Bootbox will remove the modal (including the body which contains the login form)
									// after hiding the modal
									// Therefor, we need to backup the form
									jQuery('#editmember').hide().appendTo('body');
								})
								.modal('show');
							
							
						
						}

					});

    });

// When the browser is ready...
  jQuery(function() {
  'use strict';
  
   jQuery('#addmember').on('hide.bs.modal', function() {
		jQuery('.add-new-member').bootstrapValidator('resetForm',true); // Reset form
	});
   //When Show modal popup box for add new member
   jQuery('#addmember').on('show.bs.modal', function() {
		
		var data = {
			  "action": "loadserviceareas",
			  "user_id": user_id
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
							jQuery('.loading-area').hide();
							jQuery('#loadservices').html(data);
						
						}

					});
		var data = {
			  "action": "loadserviceregions",
			  "user_id": user_id
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
							jQuery('.loading-area').hide();
							jQuery('#loadregions').html(data);
						
						}

					});
   });
   
   // Save New Member
    jQuery('.add-new-member')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				member_fullname: {
					validators: {
						notEmpty: {
							message: param.member
						}
					}
				},
				member_email: {
                validators: {
                    notEmpty: {
														message: param.req
													},
					emailAddress: {
                        message: param.signup_user_email
                    }
					}
				},
				member_phone: {
                validators: {
                    notEmpty: {
														message: param.req
													},
                    digits: {message: param.only_digits},
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
			  "action": "add_new_member",
			  "user_id": user_id
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
								jQuery("#memberavatar").html('');
								jQuery("#member_fullname").val('');
								jQuery("#member_email").val('');
								jQuery("#member_phone").val('');
								jQuery('input[type="checkbox"][name="sarea\\[\\]"]:checked').prop('checked',true);
								/*Close the popup window*/
								jQuery('#addmember').modal('hide');
								jQuery('#sfmemberavatarupload-dragdrop').removeClass('hidden');
								
								
								/*Reaload datatable after add new member*/
								dataTable.ajax.reload(null, false);
										
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.add-new-member" );
							}
							
							
						
						}

					});
			
        });
		
	// Edit Member
    jQuery('.edit-member')
        .bootstrapValidator({
            message: param.not_valid,
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
				member_fullname: {
					validators: {
						notEmpty: {
							message: param.member
						}
					}
				},
				member_email: {
                validators: {
                    notEmpty: {
														message: param.req
													},
					emailAddress: {
                        message: param.signup_user_email
                    }
					}
				},
				member_phone: {
                validators: {
                    notEmpty: {
														message: param.req
													},
                    digits: {message: param.only_digits},
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
			  "action": "edit_member",
			  "user_id": user_id
			};
			
			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);
			
			jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						dataType: "json",
						
						beforeSend: function() {
							jQuery(".alert-success").remove();
							jQuery(".alert-danger").remove();
							jQuery('.loading-area').show();
						},
						
						data: formdata,

						success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							$form.find('input[type="submit"]').prop('disabled', false);
							if(data['status'] == 'success'){
								jQuery("#member_fullname").val('');
								jQuery("#member_email").val('');
								jQuery("#member_phone").val('');
								jQuery('input[type="checkbox"][name="sarea\\[\\]"]:checked').prop('checked',true);
								/*Close the popup window*/
								// Hide the dialog
				                $form.parents('.bootbox').modal('hide');
								
								/*Reaload datatable after add new member*/
								dataTable.ajax.reload(null, false);
										
							}else if(data['status'] == 'error'){
								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.edit-member" );
							}
							
							
						
						}

					});
			
        });	
	
	//Display Members in Data Table
	var dataTable = jQuery('#members-grid').DataTable( {
	"serverSide": true,
	"bAutoWidth": false,
	"columnDefs": [ {
		  "targets": 0,
		  "orderable": false,
		  "searchable": false
		   
		} ],
	"processing": true,
	"language": {
					"processing": "<div></div><div></div><div></div><div></div><div></div>",
					"emptyTable":     param.empty_table,
					"search":         param.dt_search+":",
					"lengthMenu":     param.dt_show + " _MENU_ " + param.dt_entries,
					"info":           param.dt_showing + " _START_ " + param.dt_to + " _END_ " + param.dt_of + " _TOTAL_ " + param.dt_entries,
					"paginate": {
						first:      param.dt_first,
						previous:   param.dt_previous,
						next:       param.dt_next,
						last:       param.dt_last,
					},
				},
	"ajax":{
		url :ajaxurl, // json datasource
		type: "post",  // method  , by default get
		data: {"action": "get_members","user_id": user_id},
		error: function(){  // error handling
			jQuery(".members-grid-error").html("");
			jQuery("#members-grid").append('<tbody class="members-grid-error"><tr><th colspan="3">'+param.no_data+'</th></tr></tbody>');
			jQuery("#members-grid_processing").css("display","none");
			
		}
	}
	} );
	
	jQuery("#bulkMemberDelete").on('click',function() { // bulk checked
        var status = this.checked;
        jQuery(".deleteMemberRow").each( function() {
            jQuery(this).prop("checked",status);
        });
    });
    
    jQuery('#deleteMemberTriger').on("click", function(event){ // triggering delete one by one
		
		
			  if( jQuery('.deleteMemberRow:checked').length > 0 ){  // at-least one checkbox checked
           
		   bootbox.confirm(param.are_you_sure, function(result) {
		  if(result){
		   var ids = [];
            jQuery('.deleteMemberRow').each(function(){
                if(jQuery(this).is(':checked')) { 
                    ids.push(jQuery(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion 
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {action: "delete_members", data_ids:ids_string},
                success: function(result) {
                    dataTable.draw(); // redrawing datatable
                },
                async:false
            });
        	}
		}); 
		
		}else{
				bootbox.alert(param.select_checkbox);
		}
		  
		
        
    });
	

	
  });