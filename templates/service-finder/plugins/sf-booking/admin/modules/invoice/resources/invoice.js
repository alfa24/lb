/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
var dataTable = '';

// When the browser is ready...
  jQuery(function() {
  'use strict';
  
	/*Start Featured Providers Table*/
	dataTable = jQuery('#invoice-requests-grid').DataTable( {
	"serverSide": true,
	"columnDefs": [ {
		  "targets": 0,
		  "orderable": false,
		  "searchable": false
		   
		},
		],
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
		data: {"action": "get_admin_invoice"},
		error: function(){  // error handling
			jQuery(".invoice-requests-grid-error").html("");
			jQuery("#invoice-requests-grid").append('<tbody class="invoice-requests-grid-error"><tr><th colspan="3">'+param.no_data+'</th></tr></tbody>');
			jQuery("#invoice-requests-grid_processing").css("display","none");
			
		}
	}
	} );
	
	/*Search By Provider*/
	jQuery('#byproviderinvoice').change(function(){

		dataTable.column(3).search(this.value).draw();
	
	});
	
	//Bulk Providers Delete
	jQuery("#bulkAdminInvoiceDelete").on('click',function() { // bulk checked
        var status = this.checked;
        jQuery(".deleteInvoiceRow").each( function() {
            jQuery(this).prop("checked",status);
        });
    });
     
    //Single Providers Delete
	jQuery('#deleteAdminInvoiceTriger').on("click", function(event){ // triggering delete one by one
        if( jQuery('.deleteInvoiceRow:checked').length > 0 ){  // at-least one checkbox checked
            
			bootbox.confirm(param.are_you_sure, function(result) {

		  if(result){

           var ids = [];
            jQuery('.deleteInvoiceRow').each(function(){
                if(jQuery(this).is(':checked')) { 
                    ids.push(jQuery(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion 
            jQuery.ajax({
                type: "POST",
                url: ajaxurl,
                data: {action: "delete_admin_invoice", data_ids:ids_string},
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
	/*End Providers Table*/
	
  });