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

class SERVICE_FINDER_TeamMembers{

	/*Add New Member*/
	public function service_finder_addMembers($arg){
			global $wpdb, $service_finder_Tables;
			
			$currUser = wp_get_current_user(); 
			$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
			$getsarea = (!empty($arg['sarea'])) ? $arg['sarea'] : '';
			if(!empty($getsarea)){
			$sarea = implode(',',$getsarea);
			}
			$getregion = (!empty($arg['region'])) ? $arg['region'] : '';
			if(!empty($getregion)){
			$regions = implode('%%%',$getregion);
			}
			$data = array(
					'avatar_id' => (!empty($arg['sfmemberavatar'])) ? esc_attr($arg['sfmemberavatar']) : '',
					'member_name' => (!empty($arg['member_fullname'])) ? esc_attr($arg['member_fullname']) : '',
					'email' => (!empty($arg['member_email'])) ? esc_attr($arg['member_email']) : '',
					'phone' => (!empty($arg['member_phone'])) ? esc_attr($arg['member_phone']) : '',
					'service_area' => (!empty($sarea)) ? esc_attr($sarea) : '',
					'regions' => (!empty($regions)) ? esc_attr($regions) : '',
					'admin_wp_id' => esc_attr($user_id),
					'is_admin' => 'no',
					);

			$wpdb->insert($service_finder_Tables->team_members,wp_unslash($data));
			
			$member_id = $wpdb->insert_id;
			
			if ( ! $member_id ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t add member... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Add member successfully.', 'service-finder'),
						'memberid' => $member_id,
						);
				echo json_encode($success);
			}
		
		}
		
	/*Edit Member*/
	public function service_finder_editMember($arg){
			global $wpdb, $service_finder_Tables;
			
			$currUser = wp_get_current_user();
			if(!empty($arg['sarea'])){
			$sarea = implode(',',$arg['sarea']);
			}else{
			$sarea = '';
			}
			
			if(!empty($arg['region'])){
			$regions = implode('%%%',$arg['region']);
			}else{
			$regions = '';
			}
			
			$sfmemberavatar = (isset($arg['sfmemberavatar'])) ? $arg['sfmemberavatar'] : '';
			$sfmemberavataredit = (isset($arg['sfmemberavataredit'])) ? $arg['sfmemberavataredit'] : '';
			if($sfmemberavatar > 0){
			$avtid = $sfmemberavatar;
			}else{
			$avtid = $sfmemberavataredit;
			}
			
			$data = array(
					'avatar_id' => $avtid,
					'member_name' => (!empty($arg['member_fullname'])) ? esc_attr($arg['member_fullname']) : '',
					'email' => (!empty($arg['member_email'])) ? esc_attr($arg['member_email']) : '',
					'phone' => (!empty($arg['member_phone'])) ? esc_attr($arg['member_phone']) : '',
					'service_area' => esc_attr($sarea),
					'regions' => esc_attr($regions)
					);
			
			$where = array(
						'id' => $arg['memberid'],
						);
			$member_id = $wpdb->update($service_finder_Tables->team_members,wp_unslash($data),$where);		
			
			if(is_wp_error($member_id)){
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'data' => $data,
						'where' => $where,
						'member_id' => $member_id->get_error_message(),
						'dbtable' => $service_finder_Tables->team_members,
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t edit member... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Edit member successfully.', 'service-finder'),
						'memberid' => $arg['memberid'],
						);
				echo json_encode($success);
			}
		
		}	
		
	/*Get Saved Members into datatable*/
	public function service_finder_getMembers($arg){
		global $wpdb, $service_finder_Tables;
		$requestData= $_REQUEST;
		$currUser = wp_get_current_user(); 
		$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
		$members = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `admin_wp_id` = %d',$user_id));
		
		// storing  request (ie, get/post) global array to a variable  
		$requestData= $_REQUEST;
		
		
		$columns = array( 
			0 =>'member_name', 
			1 =>'member_name', 
			2=> 'phone',
			3 => 'email',
			4=> 'is_admin'
		);
		
		// getting total number records without any search
		$sql = $wpdb->prepare("SELECT id, member_name, phone, email, is_admin FROM ".$service_finder_Tables->team_members. " WHERE `admin_wp_id` = %d",$user_id);
		$query=$wpdb->get_results($sql);
		$totalData = count($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		
		
		$sql = "SELECT id, member_name, phone, email, is_admin";
		$sql.=" FROM ".$service_finder_Tables->team_members." WHERE `admin_wp_id` = ".$user_id;
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( member_name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR phone LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR email LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$wpdb->get_results($sql);
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."  LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$query=$wpdb->get_results($sql);
		
		$data = array();
		
		foreach($query as $result){
			$nestedData=array(); 
		
			$nestedData[] = '
<div class="checkbox">
  <input type="checkbox" id="member-'.$result->id.'" class="deleteMemberRow" value="'.esc_attr($result->id).'">
  <label for="member-'.$result->id.'"></label>
</div>
';
			$nestedData[] = $result->member_name;
			$nestedData[] = $result->phone;
			$nestedData[] = $result->email;
			$nestedData[] = $result->is_admin;
			if($result->is_admin == 'yes'){
			$nestedData[] = '';
			}else{
			$nestedData[] = '
<button type="button" data-id="'.esc_attr($result->id).'" class="btn btn-primary btn-xs editMemberButton"><i class="fa fa-pencil"></i>'.esc_html__('Edit','service-finder').'</button>
';
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
	}
	
	/*Load member for edit*/
	public function service_finder_loadMembers($arg){
			global $wpdb, $service_finder_Tables;
			$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';		
			$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$arg['memberid']));
			$avatar_id = '';
			$html = '';
			if(!empty($member)){
			
			if($member->is_admin == 'yes' && $member->avatar_id == 0){
				$avatar_id = service_finder_getUserAvatarID($member->admin_wp_id);
				$src  = wp_get_attachment_image_src( $avatar_id, 'thumbnail' );
					$src  = $src[0];
					$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
					
					$html = sprintf('
<li id="item_%s"> <img src="%s" />
  <div class="rwmb-image-bar"> <a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
    <input type="hidden" name="sfmemberavatar" value="%s">
  </div>
</li>
',
				esc_attr($avatar_id),
				esc_url($src),
				esc_attr($i18n_delete), esc_attr($avatar_id),
				esc_attr($avatar_id)
				);
			}else{
				if(!empty($member->avatar_id) && $member->avatar_id > 0){
					$src  = wp_get_attachment_image_src( $member->avatar_id, 'service_finder-provider-thumb' );
					$src  = $src[0];
					$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
					
					$html = sprintf('
<li id="item_%s"> <img src="%s" />
  <div class="rwmb-image-bar"> <a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
    <input type="hidden" name="sfmemberavatar" value="%s">
  </div>
</li>
',
				esc_attr($member->avatar_id),
				esc_url($src),
				esc_attr($i18n_delete), esc_attr($member->avatar_id),
				esc_attr($member->avatar_id)
				);
				}
			}	
			
					$current_user = wp_get_current_user(); 
					$newzipcodes = '';
					$sAreas = service_finder_getServiceArea($user_id);
											if(!empty($sAreas)){
												foreach($sAreas as $sArea){
													$newzipcodes .= '
<div class="col-lg-3">
  <div class="checkbox">
    <input id="sf-'.esc_attr($sArea->zipcode).'" type="checkbox" name="sarea[]" value="'.esc_attr($sArea->zipcode).'">
    <label for="sf-'.esc_attr($sArea->zipcode).'">'.esc_html($sArea->zipcode).'</label>
  </div>
</div>
';	
												}
											}
					
					$regions = service_finder_getServiceRegions($user_id);
					$newregions = '';
											if(!empty($regions)){
												foreach($regions as $region){
													$newregions .= '<div class="col-lg-3">
  <div class="checkbox">
    <input id="sf-'.esc_attr($region->region).'" type="checkbox" name="region[]" value="'.esc_attr($region->region).'">
    <label for="sf-'.esc_attr($region->region).'">'.esc_html($region->region).'</label>
  </div>
</div>
';	
												}
											}						
					
					$result = array(
							'member_fullname' => $member->member_name,
							'member_email' => $member->email,
							'member_phone' => $member->phone,
							'avatar' => $html,
							'avatar_id' => $member->avatar_id,
							'service_area' => $member->service_area,
							'admin_avatar_id' => $avatar_id,
							'newzipcodes' => $newzipcodes,
							'newregions' => $newregions,
							'selected_regions' => $member->regions,
					);

			}
			echo json_encode($result);
	}
	
	/*Delete Members*/
	public function service_finder_deleteMembers(){
	global $wpdb, $service_finder_Tables;
			$data_ids = $_REQUEST['data_ids'];
			$data_id_array = explode(",", $data_ids); 
			if(!empty($data_id_array)) {
				foreach($data_id_array as $id) {
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->team_members." WHERE id = %d",$id);
					$query=$wpdb->query($sql);
				}
			}
	}
				
}