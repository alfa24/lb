/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
	
//Load services for editing
  jQuery('body').on('click', '.editServiceButton', function(){
															
		jQuery('.loading-area').show();												


        // Get the record's ID via attribute

        var serviceid = jQuery(this).attr('data-id');

		

		var data = {

			  "action": "load_service",

			  "serviceid": serviceid

			};

			

	  var formdata = jQuery.param(data);

	  

	  jQuery.ajax({



						type: 'POST',



						url: ajaxurl,



						data: formdata,

						

						dataType: "json",



						success:function (data, textStatus) {

							// Populate the form fields with the data returned from server

							jQuery('#editservice')

								.find('[name="service_name"]').val(data['service_name']).end()

								.find('[name="cost_type"][value="'+data['cost_type']+'"]').prop('checked', true).end()

								.find('[name="service_cost"]').val(data['cost']).end()

								.find('[name="serviceid"]').val(serviceid).end()
								
								.find('[name="service_hours"]').val(data['hours']).end()
								
								.find('[name="service_persons"]').val(data['persons']).end()
								
								.find('#edit_grouparea').html(data['html']).end()

								.find('[name="editdesc"]').val(data['description']).end();
								
								jQuery('select').selectpicker('refresh');

							
							if(data['cost_type'] == 'hourly'){
								jQuery('#edit_service_persons_bx').hide();
								jQuery('#edit_service_hours_bx').show();
							}else if(data['cost_type'] == 'perperson'){
								jQuery('#edit_service_hours_bx').hide();
								jQuery('#edit_service_persons_bx').show();
							}else{
								jQuery('#edit_service_hours_bx').hide();
								jQuery('#edit_service_persons_bx').hide();
							}

							// Show the dialog

							bootbox

								.dialog({

									title: param.edit_service,

									message: jQuery('#editservice'),

									show: false // We will show it manually later

								})
								
								.on('shown.bs.modal', function() {
									
								tinymce.EditorManager.execCommand('mceAddEditor', true, "editdesc");

									jQuery('.loading-area').hide();

									jQuery('#editservice')

										.show()                             // Show the login form

										.bootstrapValidator('resetForm'); // Reset form

								})

								.on('hide.bs.modal', function(e) {

									// Bootbox will remove the modal (including the body which contains the login form)

									// after hiding the modal

									// Therefor, we need to backup the form
									tinymce.EditorManager.execCommand('mceRemoveEditor', true, "editdesc");

									jQuery('#editservice').hide().appendTo('body');

								})

								.modal('show');

							

							

						

						}



					});



    });



// When the browser is ready...

  jQuery(function() {
	'use strict';
	
	//Change Status for service
	jQuery('body').on('click', '.changeServiceStatus', function(){
												  
		var rid = jQuery(this).data('id');
		var status = jQuery(this).data('status');
		
		bootbox.confirm(param.change_status, function(result) {
		  if(result){
			  var data = {
			  "action": "change_service_status",
			  "serviceid": rid,
			  "status": status,
			};
			
			var data = jQuery.param(data);
			
			jQuery.ajax({

						type: 'POST',

						url: ajaxurl,
						
						data: data,
						
						beforeSend: function() {
							jQuery('.loading-area').show();
						},

						success:function (data, textStatus) {
							jQuery('.loading-area').hide();
							dataTable.ajax.reload(null, false);
						}

					});
			  }
		}); 
		
    });
	

	jQuery('#addservice').on('hide.bs.modal', function() {
		jQuery('.add-new-service').bootstrapValidator('resetForm',true); // Reset form
	});

  	

	

	

	// Add New service

	jQuery('.add-new-service')

        .bootstrapValidator({

            message: param.not_valid,

            feedbackIcons: {

                valid: 'glyphicon glyphicon-ok',

                invalid: 'glyphicon glyphicon-remove',

                validating: 'glyphicon glyphicon-refresh'

            },

            fields: {

				service_name: {

					validators: {

						notEmpty: {

							message: param.service_name

						}

					}

				},
				
				service_cost: {

					validators: {

						notEmpty: {

							message: param.req

						},
						numeric: {message: param.only_numeric},

					}

				},
				
				service_hours: {

					validators: {

						numeric: {message: param.only_numeric},

					}

				},
				
				service_persons: {

					validators: {

						digits: {message: param.only_digits},

					}

				},
				
				group_name: {

					validators: {

						notEmpty: {

							message: param.group_req

						}

					}

				},

				description: {

					validators: {

						notEmpty: {

							message: param.req

						}

					}

	            },

            }

        })

		
		.on('change', 'input[name="cost_type"]', function() {
			var ctype = jQuery(this).val();
			if(ctype == 'hourly'){
				jQuery('#service_persons_bx').hide();
				jQuery('#service_hours_bx').show();
			}else if(ctype == 'perperson'){
				jQuery('#service_hours_bx').hide();
				jQuery('#service_persons_bx').show();
			}else{
				jQuery('#service_hours_bx').hide();
				jQuery('#service_persons_bx').hide();
			}
			
		})
		
		.on('click', '.togglenewgroup', function() {
			jQuery('.service_group_bx').toggle();
			jQuery('input[name="group_name"]').val('');
		})
		.on('click', '.addnewgroup', function() {
			
			var group_name = jQuery('input[name="group_name"]').val();
			
			if(group_name == "" || group_name == undefined){
				jQuery('.add-new-service').bootstrapValidator('revalidateField', 'group_name');
				return false;
			}
			
			var data = {
			  "action": "add_new_group",
			  "group_name": group_name,
			  "user_id": user_id
			};
			
			var data = jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				data: data,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery('.loading-area').show();
					jQuery('.alert').remove();
				},

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					
					if(data['status'] == 'success'){

						jQuery('.service_group_bx').toggle();
			
						jQuery('#grouparea').html(data['html']);
						
						jQuery('select').selectpicker('refresh');

					}else if(data['status'] == 'error'){

						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "input[name='group_name']" );

					}
				}

			});
		})

        .on('success.form.bv', function(form) {

            // Prevent form submission

			tinyMCE.triggerSave();

            form.preventDefault();

			var gname = jQuery('.add-new-service select[name="group_id"] option:selected').text();

            // Get the form instance

            var $form = jQuery(form.target);

            // Get the BootstrapValidator instance

            var bv = $form.data('bootstrapValidator');

			

			var data = {

			  "action": "add_new_service",
			  "user_id": user_id,
			  "gname": gname

			};

			

			var formdata = jQuery($form).serialize() + "&" + jQuery.param(data);

			

			jQuery.ajax({



						type: 'POST',



						url: ajaxurl,

						

						dataType: "json",

						

						beforeSend: function() {

							jQuery(".success").remove();

							jQuery(".error").remove();

							jQuery('.loading-area').show();

						},

						

						data: formdata,



						success:function (data, textStatus) {

							jQuery('.loading-area').hide();

							if(data['status'] == 'success'){

								jQuery("#service_name").val('');

								jQuery("#service_cost").val('');
								
								jQuery("#service_hours").val('');

								tinyMCE.activeEditor.setContent('');

								/*Close the popup window*/

								jQuery('#addservice').modal('hide');

								
								
								

								/*Reaload datatable after add new service*/

								dataTable.ajax.reload(null, false);

										

							}else if(data['status'] == 'error'){

								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.add-new-service" );

							}

							

							

						

						}



					});

			

        });

		

	

	

    

	

	//Display Services in Data Table

	var dataTable = jQuery('#service-grid').DataTable( {

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

		data: {"action": "get_services","user_id": user_id},

		error: function(){  // error handling

			jQuery(".service-grid-error").html("");

			jQuery("#service-grid").append('<tbody class="service-grid-error"><tr><th colspan="3">'+param.no_data+'</th></tr></tbody>');

			jQuery("#service-grid_processing").css("display","none");

			

		}

	}

	} );

	

	// Edit service

	jQuery('.edit-service')

        .bootstrapValidator({

            message: param.not_valid,

            feedbackIcons: {

                valid: 'glyphicon glyphicon-ok',

                invalid: 'glyphicon glyphicon-remove',

                validating: 'glyphicon glyphicon-refresh'

            },
			
            fields: {

				service_name: {

					validators: {

						notEmpty: {

							message: param.service_name

						}

					}

				},
				service_cost: {

					validators: {

						notEmpty: {

							message: param.req

						},
						numeric: {message: param.only_numeric},

					}

				},
				
				service_hours: {

					validators: {

						numeric: {message: param.only_numeric},

					}

				},
				
				service_persons: {

					validators: {

						digits: {message: param.only_digits},

					}

				},
				
				group_name: {
	
					validators: {
	
						notEmpty: {
	
							message: param.group_req
	
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
		
		.on('click', '.togglenewgroup', function() {
			jQuery('.edit_service_group_bx').toggle();
		})
		.on('click', '.addnewgroup', function() {
			
			var group_name = jQuery('input[name="edit_group_name"]').val();
			
			if(group_name == "" || group_name == undefined){
				jQuery('.edit-service').bootstrapValidator('revalidateField', 'group_name');
				return false;
			}
			
			var data = {
			  "action": "add_new_group",
			  "group_name": group_name,
			  "user_id": user_id
			};
			
			var data = jQuery.param(data);
			
			jQuery.ajax({

				type: 'POST',

				url: ajaxurl,
				
				data: data,
				
				dataType: "json",
				
				beforeSend: function() {
					jQuery('.loading-area').show();
					jQuery('.alert').remove();
				},

				success:function (data, textStatus) {
					jQuery('.loading-area').hide();
					
					if(data['status'] == 'success'){

						jQuery('.service_group_bx').toggle();
			
						jQuery('#edit_grouparea').html(data['html']);
						
						jQuery('select').selectpicker('refresh');

					}else if(data['status'] == 'error'){

						jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "input[name='group_name']" );

					}
				}

			});
		})
		
		.on('change', 'input[name="cost_type"]', function() {
			var ctype = jQuery(this).val();
			var gethours = jQuery('#editservice #service_hours').val();
			var getpersons = jQuery('#editservice #service_persons').val();
			
			
			if(ctype == 'hourly'){
				if(gethours == 0){
				jQuery('#editservice #service_hours').val('');
				}	
				jQuery('#edit_service_persons_bx').hide();
				jQuery('#edit_service_hours_bx').show();
			}else if(ctype == 'perperson'){
				if(getpersons == 0){
				jQuery('#editservice #service_persons').val('');
				}
				jQuery('#edit_service_hours_bx').hide();
				jQuery('#edit_service_persons_bx').show();
			}else{
				jQuery('#edit_service_hours_bx').hide();
				jQuery('#edit_service_persons_bx').hide();
			}
			
		})

        .on('success.form.bv', function(form) {

            // Prevent form submission

			tinyMCE.triggerSave();

            form.preventDefault();

			var gname = jQuery('.edit-service select[name="group_id"] option:selected').text();

            // Get the form instance

            var $form = jQuery(form.target);

            // Get the BootstrapValidator instance

            var bv = $form.data('bootstrapValidator');

			

			var data = {

			  "action": "edit_service",
			  "user_id": user_id,
			  "gname": gname

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

								/*Close the popup window*/

								$form.parents('.bootbox').modal('hide');

								/*Reaload datatable after add new service*/

								dataTable.ajax.reload(null, false);

										

							}else if(data['status'] == 'error'){

								jQuery( "<div class='alert alert-danger'>"+data['err_message']+"</div>" ).insertBefore( "form.edit-service" );

							}

							

							

						

						}



					});

			

        });

	

	jQuery("#bulkDelete").on('click',function() { // bulk checked

        var status = this.checked;

        jQuery(".deleteRow").each( function() {

            jQuery(this).prop("checked",status);

        });

    });

     

    jQuery('#deleteTriger').on("click", function(event){ // triggering delete one by one

		

			  if( jQuery('.deleteRow:checked').length > 0 ){

				  bootbox.confirm(param.are_you_sure, function(result) {

		  if(result){

				  // at-least one checkbox checked

            var ids = [];

            jQuery('.deleteRow').each(function(){

                if(jQuery(this).is(':checked')) { 

                    ids.push(jQuery(this).val());

                }

            });

            var ids_string = ids.toString();  // array to string conversion 

            jQuery.ajax({

                type: "POST",

                url: ajaxurl,

                data: {action: "delete_services", data_ids:ids_string},

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