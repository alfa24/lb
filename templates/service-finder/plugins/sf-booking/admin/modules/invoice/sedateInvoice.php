<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class SERVICE_FINDER_sedateFeatured
 */
class SERVICE_FINDER_sedateInvoice extends SERVICE_FINDER_sedateManager{

	
	/*Initial Function*/
	public function service_finder_index()
    {
        
		/*Rander providers template*/
		$this->service_finder_render( 'index','invoice',$this->service_finder_getAllProvidersList() );
		
		/*Action for wp ajax call*/
		$this->service_finder_registerWpActions();
		
    }
	
	/*Actions for wp ajax call*/
	protected function service_finder_registerWpActions() {
       $_this = $this;
	   add_action(
                    'wp_ajax_get_admin_invoice',
					function () use ( $_this ) {
						call_user_func( array( $_this, 'service_finder_get_admin_invoice' ) );
                    }
						
                );
		add_action(
                    'wp_ajax_delete_admin_invoice',
					function () use ( $_this ) {
						call_user_func( array( $_this, 'service_finder_delete_admin_invoice' ) );
                    }
						
                );		
    }
	
	/*Display invoice into datatable*/
	public function service_finder_get_admin_invoice(){
		global $wpdb, $service_finder_Tables;
		$requestData= $_REQUEST;
		$currUser = wp_get_current_user(); 
		$columns = array( 
			0 =>'id', 
			1 =>'id', 
		);
		
		//$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
		
		// getting total number records without any search
		$sql = $wpdb->prepare("SELECT * FROM ".$service_finder_Tables->invoice."");
		$query=$wpdb->get_results($sql);
		$totalData = count($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		
		$sql = "SELECT * FROM ".$service_finder_Tables->invoice." WHERE 1 = 1";
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( `invoice_number` LIKE '".$requestData['search']['value']."%' )";    
		}
		
		if( !empty($requestData['columns'][3]['search']['value']) ){
			$sql.=" AND provider_id = ".$requestData['columns'][3]['search']['value'];
		}
		
		$query=$wpdb->get_results($sql);
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." DESC LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$query=$wpdb->get_results($sql);
		$data = array();
		
		foreach($query as $result){
			$nestedData=array(); 
		
			$nestedData[] = '
<div class="checkbox">
  <input type="checkbox" id="invoice-'.esc_attr($result->id).'" class="deleteInvoiceRow" value="'.esc_attr($result->id).'">
  <label for="invoice-'.esc_attr($result->id).'"></label>
</div>';
			
			$q = $wpdb->get_row($wpdb->prepare('SELECT name FROM '.$service_finder_Tables->customers.' WHERE `email` = "%s" GROUP BY email',$result->customer_email));
			$nestedData[] = $result->reference_no;
			$nestedData[] = service_finder_getProviderName($result->provider_id);
			$nestedData[] = $q->name;
			$nestedData[] = $result->duedate;
			$nestedData[] = $result->grand_total;
			$nestedData[] = $result->adminfee;
			
			$now = time();
			$date = $result->duedate;
			
			if($result->status == 'pending' && strtotime($date) < $now){
				$status = esc_html__('Overdue', 'service-finder');
			}else{
				$status = service_finder_translate_static_status_string($result->status);
			}
			
			$nestedData[] = $status;
			$nestedData[] = $result->txnid;
			if($result->status != 'paid'){
			$reminder = '
<button type="button" class="btn btn-primary btn-xs sendReminder" data-id="'.esc_attr($result->id).'" title="'.esc_html__('Send Reminder', 'service-finder').'"><i class="fa fa-envelope"></i></button>
';
			
			$editbtn = '
<button type="button" data-id="'.esc_attr($result->id).'" class="btn btn-warning btn-xs editInvoice margin-r-5" title="'.esc_html__('Edit Invoice', 'service-finder').'"><i class="fa fa-pencil"></i></button>
';
			}else{
			$reminder = '';
			$editbtn = '';
			}
			
			
			$data[] = $nestedData;
		}
		
		
		
		$json_data = array(
					"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
					"recordsTotal"    => intval( $totalData ),  // total number of records
					"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
					"data"            => $data   // total data array
					);
		
		echo json_encode($json_data);  // send data as json format
		exit(0);
	}
	
	/*Delete Invoice*/
	public function service_finder_delete_admin_invoice(){
	global $wpdb, $service_finder_Tables;
			$data_ids = $_REQUEST['data_ids'];
			$data_id_array = explode(",", $data_ids); 
			if(!empty($data_id_array)) {
				foreach($data_id_array as $id) {
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->invoice." WHERE id = %d",$id);
					$query=$wpdb->query($sql);
				}
			}
	}
	
}