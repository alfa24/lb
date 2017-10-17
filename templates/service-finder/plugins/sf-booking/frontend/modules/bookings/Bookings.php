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

class SERVICE_FINDER_Bookings{
	
	/*Load Members for Assign*/
	public function service_finder_loadAllMembers($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
			$booking = $wpdb->get_row($wpdb->prepare('SELECT bookings.id, bookings.provider_id, bookings.date, bookings.start_time, bookings.end_time, customers.zipcode FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers on bookings.booking_customer_id = customers.id WHERE `bookings`.`id` = %d',$arg['bookingid']));
			
			
			$slot = $booking->start_time.'-'.$booking->end_time;
			$memberid = (!empty($arg['memberid'])) ? $arg['memberid'] : '';
			$members = service_finder_getStaffMembers($booking->provider_id,$booking->zipcode,$booking->date,$slot,$memberid);
				$html = '';
				if(!empty($members)){
					$html = '
<div class="staff-member clear equal-col-outer">';
  $html .= '
  <div class="col-md-12">
    <h6>Choose Staff Member</h6>
  </div>
  ';
  foreach($members as $member){
  $src  = wp_get_attachment_image_src( $member->avatar_id, 'service_finder-provider-thumb' );
  $src  = $src[0];
  $memberid = (!empty($arg['memberid'])) ? $arg['memberid']  : '';
  $member_id = (!empty($member->id)) ? $member->id  : '';
  if($memberid == $member_id){
  $select = 'selected';
  }else{
  $select = '';
  }
  
  if($src != ''){
	$imgtag = '<img src="'.esc_url($src).'" width="185" height="185" alt="">';
	}else{
	$imgtag = '';
	}
  $html .= sprintf('
  <div class="col-md-3 col-sm-4 col-xs-6 equal-col">
    <div class="sf-element-bx '.$select.'" data-id="'.esc_attr($member->id).'">
      <div class="sf-thum-bx overlay-black-light"> '.$imgtag.'
        <div class="member-done"><i class="fa fa-check"></i></div>
      </div>
      <div class="sf-title-bx clearfix"> <strong class="member-name">%s</strong> '.service_finder_displayRating(service_finder_getMemberAverageRating($member->id)).' </div>
    </div>
  </div>
  ',
  $member->member_name
  );
  }
  $html .= '</div>
';
					
					
					}
					$success = array(
						'status' => 'success',
						'members' => $html,
						);
					echo json_encode($success);
			
				
	}	
	
	/*Approve wired booking*/
	public function service_finder_approvebooking(){
	global $wpdb, $service_finder_Tables;
	
	$bookingid = (!empty($_POST['bookingid'])) ? esc_html($_POST['bookingid']) : '';
	
		$data = array(
				'status' => 'Pending',
				);
		
		$where = array(
				'id' => $bookingid,
				);

		$booking_id = $wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);		

		if(is_wp_error($booking_id)){
			$error = array(
					'status' => 'error',
					'err_message' => $service_id->get_error_message()
					);
			echo json_encode($error);
		}else{
			
			$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid),ARRAY_A);
			if(function_exists('service_finder_add_notices')) {
			$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']),ARRAY_A);
			$users = $wpdb->prefix . 'users';
			$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$users.' WHERE `user_email` = "%s"',$res['email']));
			
			
			$noticedata = array(
						'customer_id' => $row->ID,
						'target_id' => $bookingid, 
						'topic' => esc_html__('Approve Booking', 'service-finder'),
						'notice' => esc_html__('Booking have been approved after wired bank transffer', 'service-finder')
						);
				service_finder_add_notices($noticedata);
			
			}
			
			$senMail = new SERVICE_FINDER_Bookings();
			$senMail->service_finder_SendApproveBookingMailToProvider($bookingdata);
			$senMail->service_finder_SendApproveBookingMailToCustomer($bookingdata);
			$senMail->service_finder_SendApproveBookingMailToAdmin($bookingdata);
			
			$msg = (!empty($service_finder_options['booking-approve'])) ? $service_finder_options['booking-approve'] : esc_html__('Booking approved successfully', 'service-finder');
			$success = array(
					'status' => 'success',
					'suc_message' => $msg,
					);
			echo json_encode($success);
		}
	}
	
	/*Send Booking Approval mail to provider*/
	public function service_finder_SendApproveBookingMailToProvider($bookingdata){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingdata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		
		if(!empty($service_finder_options['booking-approval-to-provider'])){
			$message = $service_finder_options['booking-approval-to-provider'];
		}else{
			$message = '
<h4>Booking Approved</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%

<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
Amount: %AMOUNT%
				
Admin Fee: %ADMINFEE%';
}
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%');
			
			if($bookingdata['member_id'] > 0){
			$membername = service_finder_getMemberName($bookingdata['member_id']);
			}else{
			$membername = '-';
			}
			
			$services = service_finder_get_booking_services($bookingdata['id']);
			
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			
			if($charge_admin_fee_from == 'provider' && $pay_booking_amount_to == 'admin' && $charge_admin_fee){
			$bookingamount = $bookingdata['total'] - $adminfee;
			}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $bookingdata['total'];
			}else{
			$bookingamount = $bookingdata['total'];
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingdata['date'])),$bookingdata['start_time'],$bookingdata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),service_finder_money_format($adminfee));
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['booking-approval-to-provider-subject'] != ""){
				$msg_subject = $service_finder_options['booking-approval-to-provider-subject'];
			}else{
				$msg_subject = esc_html__('Booking Approval Notification', 'service-finder');
			}
			
			if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Booking Approval mail to customer*/
	public function service_finder_SendApproveBookingMailToCustomer($bookingdata){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingdata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		
		if(!empty($service_finder_options['booking-approval-to-customer'])){
			$message = $service_finder_options['booking-approval-to-customer'];
		}else{
			$message = '
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%

<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%
				
				Admin Fee: %ADMINFEE%';
		}
		
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%');
			
			if($bookingdata['member_id'] > 0){
			$membername = service_finder_getMemberName($bookingdata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($bookingdata['id']);
			
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			
			if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingdata['date'])),$bookingdata['start_time'],$bookingdata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingdata['total']),service_finder_money_format($adminfee));
			$msg_body = str_replace($tokens,$replacements,$message);

			if($service_finder_options['booking-approval-to-customer-subject'] != ""){
				$msg_subject = $service_finder_options['booking-approval-to-customer-subject'];
			}else{
				$msg_subject = esc_html__('Booking Approval Notification', 'service-finder');
			}
			
			if(service_finder_wpmailer($customerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Booking Approval mail to admin*/
	public function service_finder_SendApproveBookingMailToAdmin($bookingdata){
		global $service_finder_options, $wpdb, $service_finder_Tables;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingdata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($bookingdata['type'])) ? $bookingdata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		
		if(!empty($service_finder_options['booking-approval-to-admin'])){
			$message = $service_finder_options['booking-approval-to-admin'];
		}else{
			$message = '
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%


<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%
				
				Admin Fee: %ADMINFEE%';
		}
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%');
			
			if($bookingdata['member_id'] > 0){
			$membername = service_finder_getMemberName($bookingdata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($bookingdata['id']);
			
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			
			if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $bookingdata['total'] - $adminfee;
			}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $bookingdata['total'];
			}else{
			$bookingamount = $bookingdata['total'];
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingdata['date'])),$bookingdata['start_time'],$bookingdata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),service_finder_money_format($adminfee));
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['booking-approval-to-admin-subject'] != ""){
				$msg_subject = $service_finder_options['booking-approval-to-admin-subject'];
			}else{
				$msg_subject = esc_html__('Booking Approval Notification', 'service-finder');
			}
			
			if(service_finder_wpmailer(get_option('admin_email'),$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Assign Member for new booking*/
	public function service_finder_assignMember($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$data = array(
					'member_id' => esc_attr($arg['memberid']),
					);
					
		$where = array(
					'id' => esc_attr($arg['bookingid']),
					);			

		$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
		
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$arg['bookingid']),ARRAY_A);
		
		$senMail = new SERVICE_FINDER_Bookings();
		
		$senMail->service_finder_SendAssignBookingMailToMember($bookingdata);
		
		$success = array(
			'status' => 'success',
			);

		echo json_encode($success);
			
				
	}	
	
	/*Send Assign Booking mail to provider*/
	public function service_finder_SendAssignBookingMailToMember($maildata = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$job_assign = (!empty($service_finder_options['job-assign-to-member'])) ? $service_finder_options['job-assign-to-member'] : '';
		
		if(!empty($job_assign)){
			$message = $job_assign;
		}else{
			$message = '<h3>Booking Assigned</h3>
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%';
		}
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			$memberemail = service_finder_getMemberEmail($maildata['member_id']);
			}else{
			$membername = '-';
			}
			
			$services = service_finder_get_booking_services($maildata['id']);
			
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services);
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Assigned to you';
			
			if($service_finder_options['job-assign-to-member-subject'] != ""){
				$msg_subject = $service_finder_options['job-assign-to-member-subject'];
			}else{
				$msg_subject = esc_html__('Booking Assigned to you', 'service-finder');
			}
			
			if(service_finder_wpmailer($memberemail,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
		
	/*Display provider bookings into datatable*/
	public function service_finder_getBookings($arg){
		global $wpdb, $service_finder_Tables, $service_finder_options;
		$requestData= $_REQUEST;
		$currUser = wp_get_current_user(); 
		$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
		$members = $wpdb->get_results($wpdb->prepare('SELECT bookings.id, bookings.payment_to, bookings.type, bookings.jobid, bookings.wired_invoiceid, bookings.date, bookings.start_time, bookings.end_time, members.member_name, bookings.member_id, bookings.status, bookings.txnid, customers.name, customers.phone, customers.email, customers.address, customers.city FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers on bookings.booking_customer_id = customers.id LEFT JOIN '.$service_finder_Tables->team_members.' as members on bookings.member_id = members.id WHERE `provider_id` = %d',$user_id));
		
		
		$columns = array( 
			0 =>'name', 
			1 =>'name', 
			2 => 'email',
			3 =>'date', 
			4=> 'start_time',
			5=> 'member_name',
			6=> 'status',
			7=> 'status'
		);
		
		// getting total number records without any search
		$sql = $wpdb->prepare("SELECT bookings.id, bookings.jobid, bookings.payment_to, bookings.type, bookings.wired_invoiceid, bookings.date, bookings.start_time, bookings.end_time, members.member_name, bookings.member_id, bookings.status, bookings.txnid, customers.name, customers.phone, customers.email, customers.address, customers.city FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers on bookings.booking_customer_id = customers.id LEFT JOIN ".$service_finder_Tables->team_members." as members on bookings.member_id = members.id WHERE `provider_id` = %d",$user_id);
		$query=$wpdb->get_results($sql);
		$totalData = count($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		
		
		$sql = "SELECT bookings.id, bookings.jobid, bookings.payment_to, bookings.type, bookings.wired_invoiceid, bookings.date, bookings.start_time, bookings.end_time, members.member_name, bookings.member_id, bookings.status, bookings.txnid, customers.name, customers.phone, customers.email, customers.address, customers.city";
		$sql.=" FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers on bookings.booking_customer_id = customers.id LEFT JOIN ".$service_finder_Tables->team_members." as members on bookings.member_id = members.id WHERE `provider_id` = ".$user_id;
		
		if( !empty($requestData['search']['value']) && $requestData['search']['value'] == 'upcoming') {
			$sql.=" AND bookings.date >= CURDATE()";
		}elseif( !empty($requestData['search']['value']) && $requestData['search']['value'] == 'past') {
			$sql.=" AND bookings.date < CURDATE()";
		}elseif( !empty($requestData['search']['value']) ) {
			$sql.=" AND ( customers.name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR bookings.date LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.start_time LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR members.member_name LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.status LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR customers.email LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$wpdb->get_results($sql);
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 
		$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
		$query=$wpdb->get_results($sql);
		
		$data = array();
		
		foreach($query as $result){
			$nestedData=array(); 
		

			$nestedData[] = '
<div class="checkbox">
  <input type="checkbox" id="booking-'.esc_attr($result->id).'" class="deleteBookingRow" value="'.esc_attr($result->id).'">
  <label for="booking-'.$result->id.'"></label>
</div>
';
			
			if($result->status == 'Cancel' || $result->status == 'Completed'){
				
				$status = ($result->status == 'Cancel') ? esc_html__('Cancelled','service-finder') : esc_html__('Completed','service-finder');
				$assign = ($result->member_id > 0) ? '<span class="btn-block">'.ucfirst($result->member_name).'</span>' : '-';
				$statusbtn = '';
			}else{
				$statusbtn = '
<button type="button" class="btn btn-warning btn-xs changeStatus" data-id="'.esc_attr($result->id).'" title="'.esc_html__('Change Status', 'service-finder').'"><i class="fa fa-battery-half"></i></button>
';
				$status = esc_html__('Incomplete','service-finder');
				$assign = ($result->member_id > 0) ? '<span class="btn-block">'.ucfirst($result->member_name).'</span>
<button type="button" data-id="'.esc_attr($result->id).'-'.esc_attr($result->member_id).'" class="btn btn-primary btn-xs editAssignButton margin-t-5"><i class="fa fa-pencil"></i>'.esc_html__('Edit Assign', 'service-finder').'</button>
' : '
<button type="button" data-id="'.esc_attr($result->id).'" class="btn btn-primary btn-xs assignButton"><i class="fa fa-pencil"></i>'.esc_html__('Assign Now', 'service-finder').'</button>
';
				
			}
			
			if(strtotime($result->date) >= strtotime(date("Y-m-d"))){
				$status2 = esc_html__('Upcoming','service-finder');
				$upcoming = 'yes';
				
			}else{
				$status2 = esc_html__('Past','service-finder');
				$upcoming = 'no';
				
			}
			
			if($result->jobid > 0){
				$type = esc_html__('Job','service-finder');
			}else{
				$type = esc_html__('Booking','service-finder');
			}
			
			if($result->type == 'wired' && $result->payment_to == 'provider'){
				$invoiceid = esc_html($result->wired_invoiceid);
			}else{
				$invoiceid = '';
			}
			
			$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
			
			if($time_format){
				$showtime = $result->start_time.'-'.$result->end_time;
			}else{
				$showtime = date('h:i a',strtotime($result->start_time)).'-'.date('h:i a',strtotime($result->end_time));
			}
			
			$nestedData[] = $result->name;
			$nestedData[] = $result->email;
			$nestedData[] = $result->date;
			$nestedData[] = $showtime;
			$nestedData[] = $assign;
			$userCap = service_finder_get_capability($user_id);
			$actions = '';
			if(!empty($userCap)){
				if(in_array('invoice',$userCap) && in_array('bookings',$userCap)){
				$actions = '
<button type="button" data-email="'.esc_attr($result->email).'" data-id="'.esc_attr($result->id).'" class="btn btn-primary btn-xs addInvoice margin-r-5" title="'.esc_html__('Add Invoice', 'service-finder').'"><i class="fa fa-plus"></i></button>
';
				}
			}
			
			$actions .= '
<button type="button" class="btn btn-custom btn-xs viewBookings" data-upcoming="'.esc_attr($upcoming).'" data-id="'.esc_attr($result->id).'" title="'.esc_html__('View Booking', 'service-finder').'"><i class="fa fa-eye"></i></button>
'.$statusbtn;

			if($result->type == 'wired' && $result->status == 'Need-Approval' && $result->payment_to == 'provider'){
			$actions .= '
<button type="button" data-bookingid="'.esc_attr($result->id).'" class="btn btn-primary btn-xs approvewiredbooking" title="'.esc_html__('Approve Booking', 'service-finder').'"><i class="fa fa-check-square"></i></button>';
			}
				
			$paymentstatus = '';
			if(($result->type == 'stripe' && ($result->status == 'Pending' || $result->status == 'Completed')) || ($result->type == 'paypal' && ($result->status == 'Pending' || $result->status == 'Completed')) || ($result->type == 'wired' && ($result->status == 'Pending' || $result->status == 'Completed'))){
			$paymentstatus = esc_html__('Paid', 'service-finder');
			}elseif(($result->type == 'wired' && $result->type == 'Need-Approval') || ($result->type == 'paypal' && $result->type == 'Need-Approval') || ($result->type == 'stripe' && $result->type == 'Need-Approval')){
			$paymentstatus = esc_html__('Pending', 'service-finder');
			}elseif($result->type == 'free'){
			$paymentstatus = esc_html__('Free', 'service-finder');
			}
			
			$nestedData[] = $status2;
			
			$nestedData[] = $status;
			
			$nestedData[] = $type;
			
			$nestedData[] = $invoiceid;
			
			$nestedData[] = $result->txnid;
			
			$nestedData[] = ucfirst($result->type);
			
			$nestedData[] = $paymentstatus;
			
			$nestedData[] = $actions;

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
	
	/*Delete provider Bookings*/
	public function service_finder_deleteBookings(){
	global $wpdb, $service_finder_Tables;
			$data_ids = $_REQUEST['data_ids'];
			$data_id_array = explode(",", $data_ids); 
			if(!empty($data_id_array)) {
				foreach($data_id_array as $id) {
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->bookings." WHERE id = %d",$id);
					$query=$wpdb->query($sql);
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->booked_services." WHERE booking_id = %d",$id);
					$query=$wpdb->query($sql);
				}
			}
	}
	
	
	/*View provider Bookings*/
	public function service_finder_viewBookings(){
		global $wpdb, $service_finder_Tables, $service_finder_options, $current_user;
	
		$bookingid = $_REQUEST['bookingid'];
		$cancel = '';
		
		$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customers', 'service-finder');	
	
		$sql = $wpdb->prepare("SELECT * FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers on bookings.booking_customer_id = customers.id WHERE bookings.id = %d",$bookingid);
	
		$row = $wpdb->get_row($sql);
		$feedbackrow = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' WHERE booking_id = %d',$bookingid));
		
		if(!isset($_REQUEST['calendar'])){
		$back = '
<button type="button" class="btn btn-primary closeDetails"><i class="fa fa-arrow-left"></i>'.esc_html__('Back', 'service-finder').'</button>
';
			if($_REQUEST['flag'] == 1 && $row->status != "Cancel" && $row->status != "Completed"){
			$cancel = '
<button type="button" class="btn btn-danger cancelbooking" data-id="'.esc_attr($bookingid).'">'.esc_html__('Cancel Booking', 'service-finder').'</button>
';
			}else{
			$cancel = '';
			}
		}else{
		$back = '';
		}
		$member = '';
		if($row->member_id > 0){
		if(service_finder_getMemberAvatar($row->member_id) != ""){
		$imgtag = '<img src="'.esc_url(service_finder_getMemberAvatar($row->member_id)).'" width="50" height="50" alt="">';
		}else{
		$imgtag = '';
		}
		$member = '
<tr>
  <td>'.esc_html__('Staff Member', 'service-finder').'</td>
  <td><div class="member-thumb">'.$imgtag.service_finder_getMemberName($row->member_id).'</div></td>
</tr>
';
		}		  
		
		$rating = (!empty($feedbackrow->rating)) ? $feedbackrow->rating : '';;
		$comment = (!empty($feedbackrow->comment)) ? $feedbackrow->comment : '';
		$description = (!empty($row->description)) ? $row->description : '';
		$phone2 = (!empty($row->phone2)) ? $row->phone2 : '';
		$apt = (!empty($row->apt)) ? $row->apt : '';
		
		$jobtitle = '';
		if($row->jobid > 0){
		$jobtitle = '<tr>
						<td>'.esc_html__('Job Title', 'service-finder').'</td>
						<td>'.get_the_title($row->jobid).'</td>
					  </tr>';
		}
		
		if(($row->type == 'stripe' && $row->status == 'Pending') || ($row->type == 'paypal' && $row->status == 'Pending') || ($row->type == 'wired' && $row->status == 'Pending')){
			$paymentstatus = esc_html__('Paid', 'service-finder');
			}elseif(($row->type == 'wired' && $row->type == 'Need-Approval') || ($row->type == 'paypal' && $row->type == 'Need-Approval') || ($row->type == 'stripe' && $row->type == 'Need-Approval')){
			$paymentstatus = esc_html__('Pending', 'service-finder');
			}elseif($row->type == 'free'){
			$paymentstatus = esc_html__('Free', 'service-finder');
			}
			
			if($row->status == 'Cancel'){
				$bookingstatus = service_finder_translate_static_status_string($row->status);
			}elseif($row->status == 'Pending'){
				$bookingstatus = esc_html__('Incomplete','service-finder');
			}else{
				$bookingstatus = service_finder_translate_static_status_string($row->status);
			}
		
	$admin_fee_label = (!empty($service_finder_options['admin-fee-label'])) ? esc_html($service_finder_options['admin-fee-label']) : esc_html__('Admin Fee', 'service-finder');
	
	if(service_finder_getUserRole($current_user->ID) == 'Customer'){
		if($row->charge_admin_fee_from == 'provider'){
			$bookingamount = $row->total;
			$adminfee = '0.0';
		}elseif($row->charge_admin_fee_from == 'customer'){
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}else{
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}	
	}elseif(service_finder_getUserRole($current_user->ID) == 'Provider'){
		if($row->charge_admin_fee_from == 'provider'){
			$bookingamount = $row->total - $row->adminfee;
			$adminfee = $row->adminfee;
		}elseif($row->charge_admin_fee_from == 'customer'){
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}else{
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}
	}else{
		if($row->charge_admin_fee_from == 'provider'){
			$bookingamount = $row->total - $row->adminfee;
			$adminfee = $row->adminfee;
		}elseif($row->charge_admin_fee_from == 'customer'){
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}else{
			$bookingamount = $row->total;
			$adminfee = $row->adminfee;
		}
	}
	
	$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
	
	if($time_format){
		if($row->end_time != Null){
		$showtime = $row->start_time.'-'.$row->end_time;
		}else{
		$showtime = $row->start_time;
		}
		
	}else{
		if($row->end_time != Null){
		$showtime = date('h:i a',strtotime($row->start_time)).'-'.date('h:i a',strtotime($row->end_time));
		}else{
		$showtime = date('h:i a',strtotime($row->start_time));
		}
		
	}
		
		$html = '
<div class="margin-b-30 text-right"> '.$cancel.' '.$back.' </div>
<table class="table table-striped table-bordered" border="0">
  '.$jobtitle.'	
  <tr>
    <td>'.esc_html( $customerreplacestring ).' '.esc_html__('Name', 'service-finder').'</td>
    <td>'.esc_html($row->name).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Email', 'service-finder').'</td>
    <td>'.esc_html($row->email).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Date', 'service-finder').'</td>
    <td>'.$row->date.'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Time', 'service-finder').'</td>
    <td>'.$showtime.'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Phone', 'service-finder').'</td>
    <td>'.esc_html($row->phone).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Phone2', 'service-finder').'</td>
    <td>'.esc_html($phone2).'</td>
  </tr>
  '.$member.'
  <tr>
    <td>'.esc_html__('Apartment', 'service-finder').'</td>
    <td>'.esc_html($apt).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Address', 'service-finder').'</td>
    <td>'.esc_html($row->address).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('City', 'service-finder').'</td>
    <td>'.esc_html($row->city).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('State', 'service-finder').'</td>
    <td>'.$row->state.'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Postal Code', 'service-finder').'</td>
    <td>'.esc_html($row->zipcode).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Country', 'service-finder').'</td>
    <td>'.esc_html($row->country).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Short Description', 'service-finder').'</td>
    <td>'.nl2br(stripcslashes($description)).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Services', 'service-finder').'</td>
    <td>'.service_finder_get_booking_services($bookingid).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Rating', 'service-finder').'</td>
    <td>'.service_finder_displayRating($rating).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Feedback', 'service-finder').'</td>
    <td>'.esc_html($comment).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Booking Amount', 'service-finder').'</td>
    <td>'.service_finder_money_format($bookingamount).'</td>
  </tr>
  <tr>
    <td>'.$admin_fee_label.'</td>
    <td>'.service_finder_money_format($adminfee).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Booking Status', 'service-finder').'</td>
    <td>'.esc_html($bookingstatus).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Payment Type', 'service-finder').'</td>
    <td>'.service_finder_translate_static_status_string($row->type).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Payment Status', 'service-finder').'</td>
    <td>'.esc_html($paymentstatus).'</td>
  </tr>
  <tr>
    <td>'.esc_html__('Txn ID', 'service-finder').'</td>
    <td>'.esc_html($row->txnid).'</td>
  </tr>
</table>
';
		
		echo $html;
	}
	
	/*Display customer past bookings into datatable*/
	public function service_finder_getCustomerPastBookings(){
		global $wpdb, $service_finder_Tables, $service_finder_Params, $service_finder_options;
		$requestData= $_REQUEST;
		$currUser = wp_get_current_user(); 

		$members = $wpdb->get_results($wpdb->prepare('SELECT bookings.id, bookings.jobid, bookings.provider_id, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, customers.address, providers.full_name, providers.wp_user_id, providers.avatar_id, providers.phone, providers.email, customers.address FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers INNER JOIN '.$service_finder_Tables->providers.' as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date < CURDATE() AND customers.`wp_user_id` = %d',$currUser->ID));
		
		$columns = array( 
			0 =>'date', 
			1=> 'start_time',
			2 => 'end_time',
			3 =>'full_name', 
			4=> 'phone',
			5 => 'email',
		);
		
		// getting total number records without any search
		$sql = $wpdb->prepare("SELECT bookings.id, bookings.jobid, bookings.provider_id, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, customers.address, providers.full_name, providers.wp_user_id, providers.phone, providers.avatar_id, providers.email, customers.address FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers INNER JOIN ".$service_finder_Tables->providers." as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date < CURDATE() AND customers.`wp_user_id` = %d",$currUser->ID);
		$query=$wpdb->get_results($sql);
		$totalData = count($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		
		
		$sql = "SELECT bookings.id, bookings.provider_id, bookings.jobid, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, customers.address, providers.full_name, providers.wp_user_id, providers.phone, providers.avatar_id, providers.email, customers.address";
		$sql.=" FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers INNER JOIN ".$service_finder_Tables->providers." as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date < CURDATE() AND customers.`wp_user_id` = ".$currUser->ID;
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( customers.name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR bookings.date LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.start_time LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.end_time LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.full_name LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.phone LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.email LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.status LIKE '".$requestData['search']['value']."%' )";
		}
		$query=$wpdb->get_results($sql);
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

		$query=$wpdb->get_results($sql);
		
		$data = array();
		
		foreach($query as $result){
			$nestedData=array(); 
		

			
			if(!empty($result->avatar_id) && $result->avatar_id > 0){
				$src  = wp_get_attachment_image_src( $result->avatar_id, 'service_finder-provider-thumb' );
				$src  = $src[0];
				$imgtag = '<img class="img-thumbnail" src="'.esc_url($src).'" alt="">';
			}else{
				$imgtag = '';
			}
			
			$feedback = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' WHERE booking_id = %d',$result->id));
			
			$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
	
			if($time_format){
				if($result->end_time != Null){
				$showtime = $result->start_time.' TO '.$result->end_time;
				}else{
				$showtime = $result->start_time;
				}
			}else{
				if($result->end_time != Null){
				$showtime = date('h:i a',strtotime($result->start_time)).' TO '.date('h:i a',strtotime($result->end_time));
				}else{
				$showtime = date('h:i a',strtotime($result->start_time));
				}
			}
			
			$userLink = service_finder_get_author_url($result->provider_id);
			$nestedData[] = '<div class="provider-pic">
<div class="thum-bx">'.$imgtag.'</div>
';
			$nestedData[] = '
<div class="booking-date-time"> <span><i class="fa fa-calendar"></i>'.$result->date.'</span> <span><i class="fa fa-clock-o"></i>'.$showtime.'</span> </div>
';
			$nestedData[] = '
<div class="address-col">'.$result->address.'</div>
';
			$nestedData[] = '
<div class="name-rating"><a href="'.esc_url($userLink).'">'.$result->full_name.'</a> '.service_finder_displayRating(service_finder_getAverageRating($result->wp_user_id)).' </div>
';
			$nestedData[] = '
<div class="booking-price">'.$result->email.'</div>
';
			$nestedData[] = '
<div class="booking-price">'.service_finder_money_format($result->total).'</div>
';

			if($result->jobid > 0){
				$type = esc_html__('Job','service-finder');
			}else{
				$type = esc_html__('Booking','service-finder');
			}
			
			$nestedData[] = $type;
			
			if($result->status == 'Cancel'){
				$status = esc_html__('Cancelled', 'service-finder');
			}elseif($result->status == 'Completed'){
				$status = esc_html__('Completed', 'service-finder');
			}else{
				$status = esc_html__('Incomplete','service-finder');
			}
			
			$nestedData[] = '<div class="booking-price">'.$status.'</div>';
			$option = '';
			if($service_finder_options['review-system']){
			if(!empty($feedback)){
			$option = '
<option value="viewfeedback">'.esc_html__('View Feedback', 'service-finder').'</option>
';
			}else{
			$option = '
<option value="addfeedback">'.esc_html__('Add Feedback', 'service-finder').'</option>
';
			}
			}
			$nestedData[] = '
<div class="booking-option text-right">
  <select title="'.esc_html__('Option', 'service-finder').'" class="bookingOptionSelect" data-bid="'.esc_attr($result->id).'">
    <option value="">'.esc_html__('Select Option', 'service-finder').'</option>
    <option value="booking">'.esc_html__('View Booking', 'service-finder').'</option>
    
												'.$option.'
                                                
    <option value="invoice">'.esc_html__('View Invoice', 'service-finder').'</option>
  </select>
</div>
';
			
			
			
			

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
	
	/*Display customer upcoming bookings into datatable*/
	public function service_finder_getCustomerUpcomingBookings(){
		global $wpdb, $service_finder_Tables, $service_finder_Params, $service_finder_options;
		$requestData= $_REQUEST;
		$currUser = wp_get_current_user(); 

		$members = $wpdb->get_results($wpdb->prepare('SELECT bookings.id, bookings.jobid, bookings.provider_id, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, providers.full_name, providers.avatar_id, providers.phone, providers.email, customers.address FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers INNER JOIN '.$service_finder_Tables->providers.' as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date >= CURDATE() AND customers.`wp_user_id` = %d',$currUser->ID));
		
		$columns = array( 
		// datatable column index  => database column name
			0 =>'date', 
			1=> 'start_time',
			2 => 'end_time',
			3 =>'full_name', 
			4=> 'phone',
			5 => 'email',
			8=> 'status'
		);
		
		// getting total number records without any search
		$sql = $wpdb->prepare("SELECT bookings.id, bookings.provider_id, bookings.jobid, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, providers.full_name, providers.avatar_id, providers.phone, providers.email, customers.address FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers INNER JOIN ".$service_finder_Tables->providers." as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date >= CURDATE() AND customers.`wp_user_id` = %d",$currUser->ID);
		$query=$wpdb->get_results($sql);
		$totalData = count($query);
		$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
		
		
		$sql = "SELECT bookings.id, bookings.provider_id, bookings.jobid, bookings.date, bookings.start_time, bookings.end_time, bookings.status, bookings.txnid, bookings.total, providers.full_name, providers.avatar_id, providers.phone, providers.email, customers.address";
		$sql.=" FROM ".$service_finder_Tables->bookings." as bookings INNER JOIN ".$service_finder_Tables->customers." as customers INNER JOIN ".$service_finder_Tables->providers." as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE bookings.date >= CURDATE() AND customers.`wp_user_id` = ".$currUser->ID;
		if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
			$sql.=" AND ( customers.name LIKE '".$requestData['search']['value']."%' ";    
			$sql.=" OR bookings.date LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.start_time LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.end_time LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.full_name LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.phone LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR providers.email LIKE '".$requestData['search']['value']."%' ";
			$sql.=" OR bookings.status LIKE '".$requestData['search']['value']."%' )";
		}

		$query=$wpdb->get_results($sql);
		$totalFiltered = count($query); // when there is a search parameter then we have to modify total number filtered rows as per search result. 

		$query=$wpdb->get_results($sql);
		
		$data = array();
		
		foreach($query as $result){
			$nestedData=array(); 
			
			$feedback = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' WHERE booking_id = %d',$result->id));
			
			if(!empty($result->avatar_id) && $result->avatar_id > 0){
				$src  = wp_get_attachment_image_src( $result->avatar_id, 'service_finder-provider-thumb' );
				$src  = $src[0];
				$imgtag = '<img class="img-thumbnail" src="'.esc_url($src).'" alt="">';
			}else{
				$imgtag = '';
			}
			
			if($result->status == 'Cancel'){
				$status = esc_html__('Cancelled','service-finder');
				$option = '';
			}elseif($result->status == 'Completed'){
				$status = esc_html__('Completed','service-finder');
				$option = '
<option value="invoice">'.esc_html__('View Invoice', 'service-finder').'</option>
';
				if(!empty($feedback)){
				$option .= '
<option value="viewfeedback">'.esc_html__('View Feedback', 'service-finder').'</option>
';
				}else{
				$option .= '
<option value="addfeedback">'.esc_html__('Add Feedback', 'service-finder').'</option>
';
				}
			}else{
				$status = esc_html__('Incomplete','service-finder');
				$option = '
<option value="invoice">'.esc_html__('View Invoice', 'service-finder').'</option>
';
				$option .= '
<option value="editbooking">'.esc_html__('Edit Bookings', 'service-finder').'</option>
';
			}
			
			$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
			
			if($time_format){
				if($result->end_time != Null){
				$showtime = $result->start_time.' TO '.$result->end_time;
				}else{
				$showtime = $result->start_time;
				}
			}else{
				if($result->end_time != Null){
				$showtime = date('h:i a',strtotime($result->start_time)).' TO '.date('h:i a',strtotime($result->end_time));
				}else{
				$showtime = date('h:i a',strtotime($result->start_time));
				}
			}
			
			$userLink = service_finder_get_author_url($result->provider_id);
			$nestedData[] = '<div class="provider-pic">
<div class="thum-bx">'.$imgtag.'</div>
';
			$nestedData[] = '<div class="booking-date-time"> <span><i class="fa fa-calendar"></i>'.$result->date.'</span> <span><i class="fa fa-clock-o"></i>'.$showtime.'</span> </div>
';
			$address = (!empty($result->address)) ? $result->address : '';
			$nestedData[] = '<div class="address-col">'.$address.'</div>
';
			$nestedData[] = '<div class="name-rating"><a href="'.esc_url($userLink).'">'.$result->full_name.'</a></div>
';
			$nestedData[] = '<div class="booking-price">'.$result->email.'</div>
';
			$nestedData[] = '<div class="booking-price">'.service_finder_money_format($result->total).'</div>
';
			if($result->jobid > 0){
				$type = esc_html__('Job','service-finder');
			}else{
				$type = esc_html__('Booking','service-finder');
			}
			
			$nestedData[] = $type;

			$nestedData[] = '<div class="booking-price">'.esc_html($status).'</div>
';
			$nestedData[] = '<div class="booking-option text-right">
  <select title="'.esc_html__('Option','service-finder').'" class="bookingOptionSelect" data-upcoming="yes" data-bid="'.esc_attr($result->id).'">
    <option value="">'.esc_html__('Select Option', 'service-finder').'</option>
    <option value="booking">'.esc_html__('View Booking', 'service-finder').'</option>
    
												'.$option.'
                                            
  </select>
</div>
';
			

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
	
	/*Delete cutomer Bookings*/
	public function service_finder_deleteCustomerBookings(){
	global $wpdb, $service_finder_Tables;
			$data_ids = $_REQUEST['data_ids'];
			$data_id_array = explode(",", $data_ids); 
			if(!empty($data_id_array)) {
				foreach($data_id_array as $id) {
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->bookings." WHERE id = %d",$id);
					$query=$wpdb->query($sql);
					$sql = $wpdb->prepare("DELETE FROM ".$service_finder_Tables->booked_services." WHERE booking_id = %d",$id);
					$query=$wpdb->query($sql);
				}
			}
	}
	
	/*Add Invoice*/
	public function service_finder_addInvoiceData($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
			$services = array_map(null, $arg['service_title'], $arg['cost_type'], $arg['num_hours'], $arg['service_desc'], $arg['service_price']);
			
			$services = serialize($services);
			
			$currUser = wp_get_current_user(); 
			$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
			$data = array(
					'reference_no'	=>   esc_attr($arg['refno']),
					'duedate'      	=> 	 esc_attr($arg['dueDate']),
					'provider_id'   => 	 $user_id,
					'customer_email'   => esc_attr($arg['customer']),
					'booking_id'   => esc_attr($arg['bookingid']),
					'discount_type' =>   esc_attr($arg['discount-type']),
					'tax_type'      =>	 esc_attr($arg['tax-type']),
					'discount'      =>   esc_attr($arg['discount']),
					'tax'           =>	 esc_attr($arg['tax']),
					'services' 	    => 	 $services,
					'description' 	=>   esc_attr($arg['short-desc']),
					'total'         =>   esc_attr($arg['total']),
					'grand_total'   =>   esc_attr($arg['gtotal']),
					'status'	    => 	 esc_attr($arg['status'])
					);

			$wpdb->insert($service_finder_Tables->invoice,wp_unslash($data));
			
			$invoice_id = $wpdb->insert_id;
			
			if ( ! $invoice_id ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t add invoice... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				
				$users = $wpdb->prefix . 'users';
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$users.' WHERE `user_email` = "%s"',$arg['customer']));
				
				$urole = service_finder_getUserRole($row->ID);
				
				if(empty($row)){
				$userLink = service_finder_get_invoice_author_url($user_id,'',$invoice_id);
				}elseif($urole == 'Provider'){
				$userLink = service_finder_get_invoice_author_url($user_id,'',$invoice_id);
				}else{
				$userLink = '';
				}
				
				/*Send Invoice mail to customer*/
				$this->service_finder_SendInvoiceMailToCustomer($data,$userLink);
				
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Invoice generated successfully.', 'service-finder'),
						'invoiceid' => $invoice_id,
						);
				echo json_encode($success);
			}
		

	}	
	
	/*Send Invoice Mail to Customer*/
	public function service_finder_SendInvoiceMailToCustomer($maildata = '',$userLink = ''){
		global $wpdb, $service_finder_options, $service_finder_Tables;

			if(!empty($service_finder_options['invoice-to-customer'])){
				$message = $service_finder_options['invoice-to-customer'];
			}else{
				$message = '
<h4>Invoice Details</h4>
Reference No: %REFERENCENO%
							
							Due date: %DUEDATE%
							
							Provider Name: %PROVIDERNAME%
							
							Discount Type: %DISCOUNTTYPE%
							
							Discount: %DISCOUNT%
							
							Tax: %TAX%
							
							Description: %DISCRIPTION%
							
							Total: %TOTAL%
							
							Grand Total: %GRANDTOTAL%';
			}
								
			if($userLink != ""){
			$message .= '<br/>
<br/>
<a href="'.esc_url($userLink).'">'.esc_html__('Pay Now','service-finder').'</a>';
			}
			$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
			
			$tokens = array('%REFERENCENO%','%DUEDATE%','%PROVIDERNAME%','%DISCOUNTTYPE%','%DISCOUNT%','%TAX%','%DISCRIPTION%','%TOTAL%','%GRANDTOTAL%');
			$replacements = array($maildata['reference_no'],$maildata['duedate'],service_finder_get_providername_with_link($row->wp_user_id),$maildata['discount_type'],$maildata['discount'],$maildata['tax'],$maildata['description'],$maildata['total'],$maildata['grand_total']);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['invoice-to-customer-subject'] != ""){
				$msg_subject = $service_finder_options['invoice-to-customer-subject'];
			}else{
				$msg_subject = esc_html__('Invoice Notification', 'service-finder');
			}
			
			if(service_finder_wpmailer($maildata['customer_email'],$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Add Feedback*/
	public function service_finder_addFeedback($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
			
			$res = $wpdb->get_row($wpdb->prepare('SELECT provider_id, member_id FROM '.$service_finder_Tables->bookings.' WHERE id = %d',$arg['booking_id']));
			
			$currUser = wp_get_current_user(); 
			$user_id = (!empty($arg['user_id'])) ? $arg['user_id'] : '';
			$data = array(
					'provider_id'   => 	$res->provider_id,
					'customer_id'   => $user_id,
					'member_id'   => $res->member_id,
					'booking_id'   => esc_attr($arg['booking_id']),
					'comment' =>   esc_attr($arg['comment']),
					'rating'      => esc_attr($arg['rating']),
					'date'      => date('Y-m-d h:i:s'),
					);

			$wpdb->insert($service_finder_Tables->feedback,wp_unslash($data));
			
			$rating = $wpdb->get_row($wpdb->prepare('SELECT avg(rating) as avarage FROM '.$service_finder_Tables->feedback.' WHERE `provider_id` = %d',$res->provider_id));
			
			$avgrating = round($rating->avarage, 2);
			
			$wpdb->query($wpdb->prepare('UPDATE '.$service_finder_Tables->providers.' SET `rating` = "%f" WHERE `wp_user_id` = %d',$avgrating,$res->provider_id));
			
			$memberrating = $wpdb->get_row($wpdb->prepare('SELECT avg(rating) as avarage FROM '.$service_finder_Tables->feedback.' WHERE `member_id` = %d',$res->member_id));
			
			$memberavgrating = round($memberrating->avarage, 2);
			
			$wpdb->query($wpdb->prepare('UPDATE '.$service_finder_Tables->team_members.' SET `rating` = "%f" WHERE `id` = %d',$memberavgrating,$res->member_id));
			
			$feedback_id = $wpdb->insert_id;
			
			if ( ! $feedback_id ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t add feedback... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Feedback added successfully.', 'service-finder'),
						'feedbackid' => $feedback_id,
						);
				echo json_encode($success);
			}
		

	}
	
	/*Show Feedback*/
	public function service_finder_getFeedback($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$feedback = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' WHERE booking_id = %d',$arg['feedbookingid']));
		
		if ( ! $feedback ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t get feedback... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'rating' => $feedback->rating,
						'comment' => $feedback->comment
						);
				echo json_encode($success);
			}
				
	}	
	
	/*Cancel Booking*/
	public function service_finder_cancelBooking($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params, $current_user;
		
		$data = array(
					'status' => 'Cancel'
					);

		$where = array(
					'id' => esc_attr($arg['bookingid'])
					);
					
		$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
		$role = service_finder_getUserRole($current_user->ID);
		
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$arg['bookingid']),ARRAY_A);
		if(function_exists('service_finder_add_notices')) {
			
			$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('customer', 'service-finder');	
			$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('provider', 'service-finder');	
			
			$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']));
			
			if($role == 'Customer'){
			$noticedata = array(
						'provider_id' => $bookingdata['provider_id'],
						'target_id' => $arg['bookingid'], 
						'topic' => esc_html__('Cancel Booking', 'service-finder'),
						'notice' => sprintf( esc_html__('Booking have been canceled by %s', 'service-finder'), $customerreplacestring ),
						);
			service_finder_add_notices($noticedata);
			}else{
			$noticedata = array(
						'customer_id' => $customerInfo->wp_user_id,
						'target_id' => $arg['bookingid'], 
						'topic' => esc_html__('Cancel Booking', 'service-finder'),
						'notice' => sprintf( esc_html__('Booking have been canceled by %s', 'service-finder'), $providerreplacestring ),
						);
			service_finder_add_notices($noticedata);
			}
			
		}
		
		$settings = service_finder_getProviderSettings($bookingdata['provider_id']);
		$google_calendar = (!empty($settings['google_calendar'])) ? $settings['google_calendar'] : '';
		
		if($google_calendar == 'on'){
		service_finder_cancelto_google_calendar($arg['bookingid'],$bookingdata['provider_id']);
		}
		
		$this->service_finder_SendCancelBookingMailToProvider($arg['bookingid']);
		$this->service_finder_SendCancelBookingMailToCustomer($arg['bookingid']);
		$this->service_finder_SendCancelBookingMailToAdmin($arg['bookingid']);
		
		$success = array(
						'status' => 'success',
						'role' => strtolower($role) 
						);
		echo json_encode($success);
	}
	
	/*Send Cancel Booking mail to provider*/
	public function service_finder_SendCancelBookingMailToProvider($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Booking Cancelled</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Cancelled';
			
			if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Cancel Booking mail to customer*/
	public function service_finder_SendCancelBookingMailToCustomer($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Booking Cancelled</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Cancelled';
			
			if(service_finder_wpmailer($customerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Cancel Booking mail to admin*/
	public function service_finder_SendCancelBookingMailToAdmin($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Booking Cancelled</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Cancelled';
			
			if(service_finder_wpmailer(get_option('admin_email'),$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Booking Completed*/
	public function service_finder_changeStatus($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$data = array(
					'status' => 'Completed'
					);

		$where = array(
					'id' => esc_attr($arg['bookingid'])
					);
					
		$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);

		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$arg['bookingid']),ARRAY_A);
		
		if(function_exists('service_finder_add_notices')) {
		$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata['booking_customer_id']),ARRAY_A);
		$users = $wpdb->prefix . 'users';
		$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$users.' WHERE `user_email` = "%s"',$res['email']));
		
		
		$noticedata = array(
					'customer_id' => $row->ID,
					'target_id' => $arg['bookingid'], 
					'topic' => esc_html__('Booking Completed', 'service-finder'),
					'notice' => esc_html__('Booking have been completed by service provider', 'service-finder')
					);
		service_finder_add_notices($noticedata);
		
		}
		
		$senMail = new SERVICE_FINDER_Bookings();
		
		$senMail->service_finder_SendChangeBookingStatusMailToProvider($bookingdata);
		$senMail->service_finder_SendChangeBookingStatusMailToCustomer($bookingdata);
		$senMail->service_finder_SendChangeBookingStatusMailToAdmin($bookingdata);
		
		$success = array(
						'status' => 'success',
						);
		echo json_encode($success);
	}	
	
	/*Send Change Status mail to provider*/
	public function service_finder_SendChangeBookingStatusMailToProvider($maildata = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$change_status = (!empty($service_finder_options['change-booking-status-to-provider'])) ? $service_finder_options['change-booking-status-to-provider'] : '';
		
		if(!empty($change_status)){
			$message = $change_status;
		}else{
			$message = '<h3>Booking Completed</h3>
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%';
		}
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			
			$services = service_finder_get_booking_services($maildata['id']);
			
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['change-booking-status-to-provider-subject'] != ""){
				$msg_subject = $service_finder_options['change-booking-status-to-provider-subject'];
			}else{
				$msg_subject = esc_html__('Booking Completed', 'service-finder');
			}
			
			if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	/*Send Change Status mail to customer*/
	public function service_finder_SendChangeBookingStatusMailToCustomer($maildata = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$change_status = (!empty($service_finder_options['change-booking-status-to-customer'])) ? $service_finder_options['change-booking-status-to-customer'] : '';
		
		if(!empty($change_status)){
			$message = $change_status;
		}else{
			$message = '<h3>Booking Completed</h3>
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Zipcode: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%';
		}
		
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($maildata['id']);
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['change-booking-status-to-customer-subject'] != ""){
				$msg_subject = $service_finder_options['change-booking-status-to-customer-subject'];
			}else{
				$msg_subject = esc_html__('Booking Completed', 'service-finder');
			}
			
			if(service_finder_wpmailer($customerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	/*Send Change Status mail to admin*/
	public function service_finder_SendChangeBookingStatusMailToAdmin($maildata = ''){
		global $service_finder_options, $wpdb, $service_finder_Tables;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$change_status = (!empty($service_finder_options['change-booking-status-to-admin'])) ? $service_finder_options['change-booking-status-to-admin'] : '';
		
		if(!empty($change_status)){
			$message = $change_status;
		}else{
			$message = '<h3>Booking Completed</h3>
<h4>Booking Details</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%

Services: %SERVICES%';
		}
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($maildata['id']);
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['change-booking-status-to-admin-subject'] != ""){
				$msg_subject = $service_finder_options['change-booking-status-to-admin-subject'];
			}else{
				$msg_subject = esc_html__('Booking Completed', 'service-finder');
			}
			
			if(service_finder_wpmailer(get_option('admin_email'),$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Edit Booking*/
	public function service_finder_editBooking($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$booking = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE id = %d',$arg['bookingid']));
		
		$bookeddate = array();
		$dayavlnum = array();
		$allocateddate = array();
		$allbookeddate = array();
		
		$dayname = date('l', strtotime( $booking->date));
		require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
		$getBookingTimeSlot = new SERVICE_FINDER_BookNow();
		
		$remtimeinsec = strtotime($booking->end_time) - strtotime($booking->start_time);
		
		$totalhours = $remtimeinsec/(60 * 60);
		
		$argdata = array(
						'seldate' => $booking->date,
						'provider_id' => $booking->provider_id,
						'start_time' => $booking->start_time,
						'end_time' => $booking->end_time,
						'editbooking' => 'yes',
						'bookingid' => $arg['bookingid'],
						'totalhours' => $totalhours,
		);
		
		if(service_finder_availability_method($booking->provider_id) == 'timeslots'){
			$avlslots = $getBookingTimeSlot->service_finder_getBookingTimeSlot($argdata);
		}elseif(service_finder_availability_method($booking->provider_id) == 'starttime'){
			$avlslots = $getBookingTimeSlot->service_finder_getBookingStartTime($argdata);
		}else{
			$avlslots = $getBookingTimeSlot->service_finder_getBookingTimeSlot($argdata);
		}

		
		
		$customerbookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE id = %d',$booking->booking_customer_id));
		$loadMembers = new SERVICE_FINDER_BookNow();
		
		if($arg['customereditbooking'] == 'yes'){
		$argdata = array(
						'date' => $booking->date,
						'provider_id' => $booking->provider_id,
						'editbooking' => 'yes',
						'memberid' => $booking->member_id,
						'zipcode' => $customerbookingdata->zipcode,
						'customeredit' => 'yes',
		);	
		}else{
		$argdata = array(
						'date' => $booking->date,
						'provider_id' => $booking->provider_id,
						'editbooking' => 'yes',
						'memberid' => $booking->member_id,
						'zipcode' => $customerbookingdata->zipcode,
		);
		}
		$avlMembers = $loadMembers->service_finder_loadMembers($argdata);
		
		$settings = service_finder_getProviderSettings($booking->provider_id);
		$userCap = service_finder_get_capability($booking->provider_id);
			
		if(service_finder_availability_method($booking->provider_id) == 'timeslots'){
			$getdays = $wpdb->get_results($wpdb->prepare('SELECT day FROM '.$service_finder_Tables->timeslots.' WHERE `provider_id` = %d GROUP BY day',$booking->provider_id));
		}elseif(service_finder_availability_method($booking->provider_id) == 'starttime'){
			$getdays = $wpdb->get_results($wpdb->prepare('SELECT day FROM '.$service_finder_Tables->starttime.' WHERE `provider_id` = %d GROUP BY day',$booking->provider_id));
		}else{
			$getdays = $wpdb->get_results($wpdb->prepare('SELECT day FROM '.$service_finder_Tables->timeslots.' WHERE `provider_id` = %d GROUP BY day',$booking->provider_id));
		}
		
			
		if(!empty($getdays)){
			foreach($getdays as $getday){
				$dayavlnum[] = date('N', strtotime($getday->day)) - 1;
			}
		}	
		
		if(service_finder_availability_method($booking->provider_id) == 'timeslots'){
			$res2 = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "timeslots" AND wholeday = "yes" GROUP BY date',$booking->provider_id));
		}elseif(service_finder_availability_method($booking->provider_id) == 'starttime'){
			$res2 = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "starttime" AND wholeday = "yes" GROUP BY date',$booking->provider_id));
		}else{
			$res2 = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "timeslots" AND wholeday = "yes" GROUP BY date',$booking->provider_id));
		}
		
			
			$bookings = $wpdb->get_results($wpdb->prepare('SELECT date, COUNT(ID) as totalbooked FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d AND date > now() GROUP BY date',$booking->provider_id));
			if(!empty($bookings)){
				foreach($bookings as $bookingloop){
					$dayname = date('l', strtotime($bookingloop->date));
					$q = $wpdb->get_row($wpdb->prepare('SELECT sum(max_bookings) as avlbookings FROM '.$service_finder_Tables->timeslots.' WHERE `provider_id` = %d AND day = "%s"',$booking->provider_id,strtolower($dayname)));
					if(!empty($q)){
						if($q->avlbookings <= $bookingloop->totalbooked){
							$bookeddate[] = date('Y-n-j',strtotime($bookingloop->date));			
						}
					}
				}
			}
			
			if(service_finder_availability_method($booking->provider_id) == 'timeslots'){
				$getalloteddates = $wpdb->get_results($wpdb->prepare('SELECT date FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "timeslots" AND wholeday != "yes" AND date > now() GROUP BY date',$booking->provider_id));
			}elseif(service_finder_availability_method($booking->provider_id) == 'starttime'){
				$getalloteddates = $wpdb->get_results($wpdb->prepare('SELECT date FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "starttime" AND wholeday != "yes" AND date > now() GROUP BY date',$booking->provider_id));
			}else{
				$getalloteddates = $wpdb->get_results($wpdb->prepare('SELECT date FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND availability_method = "timeslots" AND wholeday != "yes" AND date > now() GROUP BY date',$booking->provider_id));
			}
			
			
			if(!empty($getalloteddates)){
				foreach($getalloteddates as $getalloteddate){
					$allocateddate[] = date('Y-n-j',strtotime($getalloteddate->date));
				}
			}
			
			if(!empty($res2)){
				foreach($res2 as $row){
				$allbookeddate[] = date('Y-n-j',strtotime($row->date));
				}
			}
			
		
		$result = array(
							'provider_id' => $booking->provider_id,
							'date' => $booking->date,
							'dayavlnum' => json_encode($dayavlnum),
							'day' => $dayname,
							'slots' => $avlslots,
							'activeslots' => $booking->start_time.'-'.$booking->end_time,
							'members' => $avlMembers,
							'memberid' => $booking->member_id,
							'staffmember' => $settings['members_available'],		
							'caps' => $userCap,
							'zipcode' => $customerbookingdata->zipcode,
							'daynum' => date('j',strtotime($booking->date)),
							'month' => date('n',strtotime($booking->date)),
							'year' => date('Y',strtotime($booking->date)),
							'dates' => json_encode($allbookeddate),
							'bookeddates' => json_encode($bookeddate),
							'totalhours' => $totalhours,
							'bookingid' => $arg['bookingid'],
					);

			$res = json_encode($result);
			return $res;
				
	}
	
	/*Update Booking*/
	public function service_finder_updateBooking($arg){
		
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$time = explode('-',$arg['boking-slot']);
		if($arg['memberid'] != ""){
		$memberid = $arg['memberid'];
		}else{
		$memberid = 0;
		}
		
		$data = array(
					'date' => $arg['date'],
					'start_time' => (!empty($time[0])) ? $time[0] : Null,
					'end_time' => (!empty($time[1])) ? $time[1] : Null,
					'member_id' => $memberid,
					);

		$where = array(
					'id' => esc_attr($arg['booking_id'])
					);
					
		$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
		
		if(function_exists('service_finder_add_notices')) {
			$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$arg['booking_id']));
			$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$res->booking_customer_id));
			$noticedata = array(
					'provider_id' => $arg['provider'],
					'target_id' => $arg['booking_id'], 
					'topic' => esc_html__('Booking Edited', 'service-finder'),
					'notice' => sprintf( esc_html__('Booking Edited by %s', 'service-finder'), $row->name ),
					);
			service_finder_add_notices($noticedata);
		
		}
		
		$settings = service_finder_getProviderSettings($arg['provider']);
		$google_calendar = (!empty($settings['google_calendar'])) ? $settings['google_calendar'] : '';
		
		if($google_calendar == 'on'){
		service_finder_updateto_google_calendar($arg['booking_id'],$arg['provider']);
		}
		
		
		$this->service_finder_SendEditBookingMailToProvider($arg['booking_id']);
		$this->service_finder_SendEditBookingMailToCustomer($arg['booking_id']);
		$this->service_finder_SendEditBookingMailToAdmin($arg['booking_id']);
		
		$success = array(
						'status' => 'success',
						);
		echo json_encode($success);
	}	
	
	/*Send Edit Booking mail to provider*/
	public function service_finder_SendEditBookingMailToProvider($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Updated Booking Info</h4>
Date: %DATE%
				
Time: %STARTTIME% - %ENDTIME%
				
Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			
			$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customer', 'service-finder');	
			
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Edited by '.$customerreplacestring;
			
			if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Edit Booking mail to customer*/
	public function service_finder_SendEditBookingMailToCustomer($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Updated Booking Info</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customer', 'service-finder');	
			
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Edited by '.$customerreplacestring;
			
			if(service_finder_wpmailer($customerInfo->email,$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
	
	/*Send Edit Booking mail to admin*/
	public function service_finder_SendEditBookingMailToAdmin($bookingid = ''){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$bookingInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$bookingInfo->provider_id));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingInfo->booking_customer_id));

		$message = '
<h4>Updated Booking Info</h4>
Date: %DATE%
				
				Time: %STARTTIME% - %ENDTIME%
				
				Member Name: %MEMBERNAME%
<h4>Provider Details</h4>
Provider Name: %PROVIDERNAME%

				Provider Email: %PROVIDEREMAIL%
				
				Phone: %PROVIDERPHONE%
<h4>Customer Details</h4>
Customer Name: %CUSTOMERNAME%

Customer Email: %CUSTOMEREMAIL%

Phone: %CUSTOMERPHONE%

Alternate Phone: %CUSTOMERPHONE2%

Address: %ADDRESS%

Apt/Suite: %APT%

City: %CITY%

State: %STATE%

Postal Code: %ZIPCODE%

Country: %COUNTRY%
<h4>Payment Details</h4>
Pay Via: %PAYMENTMETHOD%
				
				Amount: %AMOUNT%';
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%PAYMENTMETHOD%','%AMOUNT%');
			
			if($bookingInfo->member_id > 0){
			$membername = service_finder_getMemberName($bookingInfo->member_id);
			}else{
			$membername = '-';
			}
			
			$replacements = array(date('Y-m-d',strtotime($bookingInfo->date)),$bookingInfo->start_time,$bookingInfo->end_time,$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,ucfirst($bookingInfo->type),service_finder_money_format($bookingInfo->total));
			
			$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customer', 'service-finder');	
			
			$msg_body = str_replace($tokens,$replacements,$message);
			$msg_subject = 'Booking Edited by '.$customerreplacestring;
			
			if(service_finder_wpmailer(get_option('admin_email'),$msg_subject,$msg_body)) {

				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Message has been sent', 'service-finder'),
						);
				$service_finder_Success = json_encode($success);
				return $service_finder_Success;
				
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
						);
				$service_finder_Errors = json_encode($error);
				return $service_finder_Errors;
			}
		
	}
				
}