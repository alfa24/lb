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

class SERVICE_FINDER_BookNow{

	/*Check Zipcode*/
	public function service_finder_checkZipcode($arg){
		global $wpdb, $service_finder_Tables;
		
		$settings = service_finder_getProviderSettings($arg['provider_id']);
		
		if($settings['booking_basedon'] == 'open'){
		
			$success = array(
						'status' => 'success',
						);
			echo json_encode($success);
		
		}else{
		
		$sql = $wpdb->prepare('SELECT id FROM '.$service_finder_Tables->service_area.' WHERE provider_id = %d AND zipcode = "%s" AND status = "active"',$arg['provider_id'],$arg['zipcode']);
		
		$res = $wpdb->get_row($sql);
		
		if(!empty($res)){
		
			$success = array(
						'status' => 'success',
						);
			echo json_encode($success);
			
		}else{

			$error = array(
						'status' => 'error',
						);
			echo json_encode($error);
		}
		
		}	

	}
	
	/*Load Members*/
	public function service_finder_loadMembers($arg){
		global $wpdb, $service_finder_Tables, $service_finder_Params, $service_finder_options;
			$settings = service_finder_getProviderSettings($arg['provider_id']);
			$editbooking = (!empty($arg['editbooking'])) ? $arg['editbooking'] : '';
			$html = '';
			if($settings['members_available'] == 'yes'){
				$memberid = (!empty($arg['memberid'])) ? $arg['memberid'] : '';
				$slot = (!empty($arg['slot'])) ? $arg['slot'] : '';
				$date = (!empty($arg['date'])) ? $arg['date'] : '';
				$zipcode = (!empty($arg['zipcode'])) ? $arg['zipcode'] : '';
				$region = (!empty($arg['region'])) ? $arg['region'] : '';
				$provider_id = (!empty($arg['provider_id'])) ? $arg['provider_id'] : '';
				$bookingid = (!empty($arg['bookingid'])) ? $arg['bookingid'] : '';
				
				if(service_finder_availability_method($provider_id) == 'timeslots'){
					$members = service_finder_getStaffMembers($provider_id,$zipcode,$date,$slot,$memberid,'',$region);
				}elseif(service_finder_availability_method($provider_id) == 'starttime'){
					$tem = explode('-',$slot);
					$start_time = (!empty($tem[0])) ? $tem[0] : '';
					$end_time = (!empty($tem[1])) ? $tem[1] : '';
					if(!empty($start_time) && !empty($end_time)){
						if($bookingid != "" && $bookingid > 0){
							$members = service_finder_getStaffMembersStartTimeEdit($provider_id,$zipcode,$date,$slot,$memberid,'',$region,$bookingid);
						}else{
							$members = service_finder_getStaffMembersStartTime($provider_id,$zipcode,$date,$slot,$memberid,'',$region);
						}
						
					}else{
						if($bookingid != "" && $bookingid > 0){
							$members = service_finder_getStaffMembersStartTimeEdit_nohours($provider_id,$zipcode,$date,$start_time,$memberid,'',$region,$bookingid);
						}else{
							$members = service_finder_getStaffMembersStartTime_nohours($provider_id,$zipcode,$date,$start_time,$memberid,'',$region);
						}
					}
				}else{
					$members = service_finder_getStaffMembers($provider_id,$zipcode,$date,$slot,$memberid,'',$region);
				}
				
				if(!empty($members)){
  if($service_finder_options['booking-page-style'] == 'style-1'){
  $class = 'col-md-3 col-sm-4 col-xs-6 equal-col';
  $html = '<div class="staff-member clear equal-col-outer">
  <div class="col-md-12">
    <div class="row">
      <h6 class="sf-title-staff">'.esc_html__('Choose Staff Member', 'service-finder').'</h6>
    </div>
  </div>
  ';
  }elseif($service_finder_options['booking-page-style'] == 'style-2'){
  $class = 'col-md-2 col-sm-3 col-xs-6 equal-col';
  $html = '<div class="staff-member clear equal-col-outer">
  <div class="col-md-12">
    <div class="row">
      <h6 class="sf-title-staff">'.esc_html__('Choose Staff Member', 'service-finder').'</h6>
    </div>
  </div>
  ';
  }
  $customeredit = (!empty($arg['customeredit'])) ? $arg['customeredit']  : '';
  if($customeredit == 'yes'){
  $class = 'col-md-3 col-sm-4 col-xs-6 equal-col';
  $html = '<div class="staff-member clear equal-col-outer">
  <div class="col-md-12">
    <div class="row">
      <h6 class="sf-title-staff">'.esc_html__('Choose Staff Member', 'service-finder').'</h6>
    </div>
  </div>
  ';
  }
  
  $html .= '
  <div class="row">';
    foreach($members as $member){
	$editbooking = (!empty($arg['editbooking'])) ? $arg['editbooking']  : '';
	$memberid = (!empty($arg['memberid'])) ? $arg['memberid']  : '';
	$member_id = (!empty($member->id)) ? $member->id  : '';
    if($editbooking == 'yes'){
    if($memberid == $member_id){
    $select = 'selected';
    }else{
    $select = '';
    }	
    }else{
    $select = '';
    }
    $src  = wp_get_attachment_image_src( $member->avatar_id, 'service_finder-staff-member' );
    $src  = $src[0];
	if($src != ''){
	$imgtag = '<img src="'.esc_url($src).'" width="185" height="185" alt="">';
	}else{
	$imgtag = '';
	}
    $html .= sprintf('
    <div class="'.$class.'">
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
</div>
';
					}else{
					$html .= '<div>'.esc_html__('Sorry, There are no members available', 'service-finder').'</div>';
					}
			
			if($editbooking == 'yes'){
				return $html;
			}else{
				$success = array(
				'status' => 'success',
				'members' => $html,
				'totalmember' => count($members)
				);
				echo json_encode($success);
			}
			
											
			}else{
			
			if($arg['editbooking'] == 'yes'){
			return '';
			}else{
			$error = array(
				'status' => 'error',
				);
			echo json_encode($success);
			}
			}	
			
	}
	
	/*Fetch Services*/
	public function service_finder_getServices($provider_id = ''){
	
		global $wpdb, $service_finder_Tables, $service_finder_Params;
		$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `status` = "active" and `wp_user_id` = %d',$provider_id));
		if(!empty($services)){
			foreach($services as $service){
			$servicedata .= '
<li data-serviceid="'.esc_attr($service->id).'" data-cost="'.esc_attr($service->cost).'">
  <div class="addiner">
    <div class="addicon"><img src="'.$service_finder_Params['pluginImgUrl'].'/extra_services/lundry.png" alt=""></div>
    <div class="done"> <img src="'.$service_finder_Params['pluginImgUrl'].'/done.png" width="162" height="130" alt="">
      <h6>'.$service->cost.'</h6>
    </div>
    <p>'.$service->service_name.'</p>
  </div>
</li>
';
			}

			return $services = array(
						'status' => 1,
						'data' => $servicedata,
						);	
		}else{
			$servicedata = '
<li>No Service Found.</li>
';
			
			return $services = array(
						'status' => 0,
						'data' => $servicedata,
						);	
		}

	}
	
	/*Save Booking Data*/
	public function service_finder_SaveBooking($bookingdata = '',$customerid = '',$txnid = '',$adminfee = 0){
		global $wpdb, $service_finder_Tables, $service_finder_Params, $current_user, $service_finder_options;
		
		if(is_user_logged_in()){
			$wp_user_id = $current_user->ID;
		}else{
			$wp_user_id = 'NULL';
		}
		$bookingpayment_mode = (!empty($bookingdata['bookingpayment_mode'])) ? $bookingdata['bookingpayment_mode'] : '';
		
		if($bookingpayment_mode == 'paypal'){
			$paypal_token = $customerid;
			$stripe_cusID = '';
			$invoiceid = '';
			$status = 'Need-Approval';
		}elseif($bookingpayment_mode == 'payumoney'){
			$stripe_cusID = '';
			$paypal_token = '';
			$invoiceid = '';
			$status = 'Need-Approval';
		}elseif($bookingpayment_mode == 'payulatam'){
			$stripe_cusID = '';
			$paypal_token = '';
			$invoiceid = '';
			$status = 'Pending';
		}elseif($bookingpayment_mode == 'wired'){
			$stripe_cusID = '';
			$paypal_token = '';
			$invoiceid = strtoupper(uniqid('BK-'));
			$status = 'Need-Approval';
		}elseif($bookingpayment_mode == 'twocheckout'){
			$stripe_cusID = '';
			$paypal_token = '';
			$invoiceid = '';
			$status = 'Pending';
		}else{
			$stripe_cusID = $customerid;
			$paypal_token = '';
			$invoiceid = '';
			$status = 'Pending';
		}
		
		$customerdata = array(
				'wp_user_id' => $wp_user_id,
				'name' => $bookingdata['firstname'].' '.$bookingdata['lastname'], 
				'phone' => (!empty($bookingdata['phone'])) ? $bookingdata['phone'] : '', 
				'phone2' => (!empty($bookingdata['phone2'])) ? $bookingdata['phone2'] : '',
				'email' => (!empty($bookingdata['email'])) ? $bookingdata['email'] : '',
				'address' => (!empty($bookingdata['address'])) ? $bookingdata['address'] : '', 
				'apt' => (!empty($bookingdata['apt'])) ? $bookingdata['apt'] : '', 
				'city' => (!empty($bookingdata['city'])) ? $bookingdata['city'] : '', 
				'state' => (!empty($bookingdata['state'])) ? $bookingdata['state'] : '', 
				'country' => (!empty($bookingdata['country'])) ? $bookingdata['country'] : '', 
				'zipcode' => (!empty($bookingdata['zipcode'])) ? $bookingdata['zipcode'] : '',
				'region' => (!empty($bookingdata['region'])) ? $bookingdata['region'] : '',
				'description' => (!empty($bookingdata['shortdesc'])) ? $bookingdata['shortdesc'] : '',  
				);
		$wpdb->insert($service_finder_Tables->customers,wp_unslash($customerdata));
		
		$booking_customer_id = $wpdb->insert_id;
		$time = explode('-',$bookingdata['boking-slot']);
		
		$selecteddate = (!empty($bookingdata['selecteddate'])) ? $bookingdata['selecteddate'] : '';
		$bookingdate = (!empty($bookingdata['bookingdate'])) ? $bookingdata['bookingdate'] : '';
		
		if($bookingpayment_mode == 'paypal' || $bookingpayment_mode == 'payumoney'){
		$bookingdate = date('Y-m-d',strtotime($selecteddate));
		}elseif($bookingpayment_mode == 'stripe' || $bookingpayment_mode == 'twocheckout'){
		$bookingdate = date('Y-m-d',strtotime($bookingdate));
		}else{
			if($selecteddate != ""){
			$bookingdate = date('Y-m-d',strtotime($selecteddate));
			}else{
			$bookingdate = date('Y-m-d',strtotime($bookingdate));
			}
		}
		
		$anymember = (!empty($bookingdata['anymember'][0])) ? $bookingdata['anymember'][0] : '';
		if($anymember == 'yes'){
		$memberid = 0;
		}else{
		$memberid = (!empty($bookingdata['memberid'])) ? $bookingdata['memberid'] : '';
		}

		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free'; 
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
		
		$getjobid = (!empty($bookingdata['jobid'])) ? esc_html($bookingdata['jobid']) : '';
		if($getjobid > 0){
			$jobpost = get_post($getjobid);
			$jobauthor = $jobpost->post_author;
				if(service_finder_is_job_author($getjobid,$jobauthor)){
					$jobid = $getjobid;
				}else{
					$jobid = 0;
				}
		}else{
			$jobid = 0;
		}
		
		$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
		$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
		$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		
		if($charge_admin_fee && $pay_booking_amount_to == 'admin' && $admin_fee_percentage > 0){
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		}else{
			$charge_admin_fee_from = '';
		}	

		$bookdata = array(
				'created' => date('Y-m-d h:i:s'), 
				'date' => $bookingdate, 
				'start_time' => (!empty($time[0])) ? $time[0] : Null, 
				'end_time' => (!empty($time[1])) ? $time[1] : Null, 
				'jobid' => $jobid,
				'provider_id' => $bookingdata['provider'], 
				'member_id' => $memberid, 
				'type' => $payent_mode, 
				'services' => (!empty($bookingdata['servicearr'])) ? $bookingdata['servicearr'] : '',
				'booking_customer_id' => $booking_customer_id,
				'stripe_customer_id' => (!empty($stripe_cusID)) ? $stripe_cusID : '',
				'stripe_token' => (!empty($bookingdata['stripeToken'])) ? $bookingdata['stripeToken'] : '',
				'paypal_token' => (!empty($paypal_token)) ? $paypal_token : '',
				'wired_invoiceid' => esc_html($invoiceid),
				'payment_to' => esc_html($pay_booking_amount_to),
				'total' => (!empty($bookingdata['totalcost'])) ? $bookingdata['totalcost'] : '',
				'adminfee' => $adminfee,
				'charge_admin_fee_from' => $charge_admin_fee_from,
				'status' => esc_html($status),
				'txnid' => esc_html($txnid),
				'paid_to_provider' => 'pending',
				);

		$wpdb->insert($service_finder_Tables->bookings,wp_unslash($bookdata));
		$booking_id = $wpdb->insert_id;
		
		$getjobid = (!empty($bookingdata['jobid'])) ? esc_html($bookingdata['jobid']) : '';
		if($getjobid > 0){
			$jobpost = get_post($getjobid);
			$jobauthor = $jobpost->post_author;
				if(service_finder_is_job_author($getjobid,$jobauthor)){
					$jobid = $getjobid;
					update_post_meta($jobid,'_filled',1);
					update_post_meta($jobid,'_assignto',$bookingdata['provider']);
					update_post_meta($jobid,'_bookingid',$booking_id);
				}
		}
		
		$customername = $bookingdata['firstname'].' '.$bookingdata['lastname'];
		
		if(function_exists('service_finder_add_notices')) {
		
			$noticedata = array(
					'provider_id' => $bookingdata['provider'],
					'target_id' => $booking_id, 
					'topic' => esc_html__('Booking', 'service-finder'),
					'notice' => sprintf( esc_html__('You have new booking on %s at %s by %s', 'service-finder'), $bookingdate,$time[0],$customername ),
					);
			service_finder_add_notices($noticedata);
		
		}
		
		$settings = service_finder_getProviderSettings($bookingdata['provider']);
		$google_calendar = (!empty($settings['google_calendar'])) ? $settings['google_calendar'] : '';
		
		if($google_calendar == 'on'){
		service_finder_addto_google_calendar($booking_id,$bookingdata['provider']);
		}
		
		if($payent_mode == 'free' || $payent_mode == 'wired' || $payent_mode == 'cod'){
		$senMail = new SERVICE_FINDER_BookNow();
				
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id),ARRAY_A);
		
		$senMail->service_finder_SendBookingMailToProvider($bookingdata,$invoiceid,$adminfee);
		$senMail->service_finder_SendBookingMailToCustomer($bookingdata,$invoiceid,$adminfee);
		$senMail->service_finder_SendBookingMailToAdmin($bookingdata,$invoiceid,$adminfee);
		
		}

	}
	
	/*Send Booking mail to provider*/
	public function service_finder_SendBookingMailToProvider($maildata = '',$invoiceid = '',$adminfee = '0.0'){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		
		if($payent_mode == 'wired' && $pay_booking_amount_to == 'provider'){
		$message = 'Invoice ID:'.$invoiceid;
		}else{
		$message = '';
		}

		if(!empty($service_finder_options['booking-to-provider'])){
			$message .= $service_finder_options['booking-to-provider'];
		}else{
			$message .= '
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
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%','%SHORTDESCRIPTION%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			
			$services = service_finder_get_booking_services($maildata['id']);
			
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			
			if($charge_admin_fee_from == 'provider' && $pay_booking_amount_to == 'admin' && $charge_admin_fee){
			$bookingamount = $maildata['total'] - $adminfee;
			}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $maildata['total'];
			}else{
			$bookingamount = $maildata['total'];
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),service_finder_money_format($adminfee),$customerInfo->description);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['booking-to-provider-subject'] != ""){
				$msg_subject = $service_finder_options['booking-to-provider-subject'];
			}else{
				$msg_subject = esc_html__('Booking Notification', 'service-finder');
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
	/*Send Booking mail to customer*/
	public function service_finder_SendBookingMailToCustomer($maildata = '',$invoiceid = '',$adminfee = '0.0'){
		global $service_finder_options, $service_finder_Tables, $wpdb;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		
		if($payent_mode == 'wired'){
			if($pay_booking_amount_to == 'admin'){
				$wiretransfermailinstructions = (!empty($service_finder_options['wire-transfer-mail-instructions'])) ? $service_finder_options['wire-transfer-mail-instructions'] : '';
				$message = $wiretransfermailinstructions;
			}elseif($pay_booking_amount_to == 'provider'){
				$settings = service_finder_getProviderSettings($maildata['provider_id']);
				$wired_instructions = (!empty($settings['wired_instructions'])) ? $settings['wired_instructions'] : '';
				$message = $wired_instructions;
			}else{
				$message = 'Use following invoice ID When transfer amount in bank.';
			}
		$message .= 'Invoice ID:'.$invoiceid;
		}else{
		$message = '';
		}

		if(!empty($service_finder_options['booking-to-customer'])){
			$message .= $service_finder_options['booking-to-customer'];
		}else{
			$message .= '
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
		
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%','%SHORTDESCRIPTION%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($maildata['id']);
			
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			
			if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($maildata['total']),service_finder_money_format($adminfee),$customerInfo->description);
			$msg_body = str_replace($tokens,$replacements,$message);

			if($service_finder_options['booking-to-customer-subject'] != ""){
				$msg_subject = $service_finder_options['booking-to-customer-subject'];
			}else{
				$msg_subject = esc_html__('Booking Notification', 'service-finder');
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
	/*Send Booking mail to admin*/
	public function service_finder_SendBookingMailToAdmin($maildata = '',$invoiceid = '',$adminfee = '0.0'){
		global $service_finder_options, $wpdb, $service_finder_Tables;
		$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
		$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
		
		$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
		
		$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
		if($payent_mode == 'wired' && $pay_booking_amount_to == 'admin'){
		$message = 'Invoice ID:'.$invoiceid;
		}else{
		$message = '';
		}


		if(!empty($service_finder_options['booking-to-admin'])){
			$message .= $service_finder_options['booking-to-admin'];
		}else{
			$message .= '
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
			
			$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%ADMINFEE%','%SHORTDESCRIPTION%');
			
			if($maildata['member_id'] > 0){
			$membername = service_finder_getMemberName($maildata['member_id']);
			}else{
			$membername = '-';
			}
			$services = service_finder_get_booking_services($maildata['id']);
			
			$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
			$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
			
			if($charge_admin_fee_from == 'provider' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $maildata['total'] - $adminfee;
			}elseif($charge_admin_fee_from == 'customer' && $charge_admin_fee && $pay_booking_amount_to == 'admin'){
			$bookingamount = $maildata['total'];
			}else{
			$bookingamount = $maildata['total'];
			$adminfee = '0.0';
			}
			
			$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),service_finder_money_format($adminfee),$customerInfo->description);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['booking-to-admin-subject'] != ""){
				$msg_subject = $service_finder_options['booking-to-admin-subject'];
			}else{
				$msg_subject = esc_html__('Booking Notification', 'service-finder');
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
	
	/*Get Calendar TimeSlot*/
	public function service_finder_getBookingTimeSlot($data = ''){
	
		global $wpdb, $service_finder_Tables, $service_finder_Params, $service_finder_options;
		
		$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
		
		$wpdb->show_errors();
		$dayname = date('l', strtotime( $data['seldate']));
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->timeslots.' AS timeslots WHERE (SELECT COUNT(*) FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`status` != "Cancel" AND `bookings`.`date` = "%s" AND `bookings`.`start_time` = `timeslots`.`start_time` AND `bookings`.`end_time` = `timeslots`.`end_time`) < `timeslots`.`max_bookings` AND (SELECT COUNT(*) FROM '.$service_finder_Tables->unavailability.' AS unavl WHERE `unavl`.`date` = "%s" AND  `unavl`.availability_method = "timeslots" AND `unavl`.`start_time` = `timeslots`.`start_time` AND `unavl`.`end_time` = `timeslots`.`end_time`) = 0 AND `timeslots`.`provider_id` = %d AND `timeslots`.`day` = "%s"',$data['seldate'],$data['seldate'],$data['provider_id'],strtolower($dayname)));
		
		
		
		$res = '';
		if(!empty($results)){
			foreach($results as $slot){
			
			$qry = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `date` = "%s" AND availability_method = "timeslots" AND start_time = "%s" AND end_time = "%s" AND provider_id = %d',$data['seldate'],$slot->start_time,$slot->end_time,$data['provider_id']));
			
			if(empty($qry)){
			$editbooking = (!empty($data['editbooking'])) ? $data['editbooking'] : '';
			if($editbooking == 'yes'){
				if($data['start_time'] == $slot->start_time && $data['end_time'] == $slot->end_time){
					$active = 'class="active"';
				}else{
					$active = '';
				}
			}else{
				$active = '';
			}
			if($time_format){
				$showtime = $slot->start_time.'-'.$slot->end_time;
			}else{
				$showtime = date('h:i a',strtotime($slot->start_time)).'-'.date('h:i a',strtotime($slot->end_time));
			}
			$res .= '
<li '.$active.' data-source="'.esc_attr($slot->start_time).'-'.esc_attr($slot->end_time).'"><span>'.$showtime.'</span></li>
';
			}
			}
		}else{
			$res .= '
<div class="notavail">'.esc_html__('There are no time slot available.', 'service-finder').'</div>
';
		}
		
		return $res;
	}
	
	/*Get Calendar Start Time*/
	public function service_finder_getBookingStartTime($data = ''){
	
		global $wpdb, $service_finder_Tables, $service_finder_Params, $service_finder_options;
		
		$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
		$res = '';
		$flag = 0;
		$dayname = date('l', strtotime( $data['seldate']));
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->starttime.' AS starttime WHERE `starttime`.`provider_id` = %d AND `starttime`.`day` = "%s"',$data['provider_id'],strtolower($dayname)));
		
		$editbooking = (!empty($data['editbooking'])) ? $data['editbooking'] : 'no';
		$bookingid = (!empty($data['bookingid'])) ? $data['bookingid'] : 0;
		
		
		if(!empty($results)){
			foreach($results as $row){
				$tem = number_format($data['totalhours'], 2);
				$temarr = explode('.',$tem);
				$tem1 = 0;
				$tem2 = 0;
				if(!empty($temarr)){
				
				if(!empty($temarr[0])){
					$tem1 = floatval($temarr[0]) * 60;
				}
				if(!empty($temarr[1])){
					$tem2 = $temarr[1];
				}
				
				}
				
				$totalhours = floatval($tem1) + floatval($tem2);
			
				if($totalhours > 0 && $totalhours != ""){
					$endtime = date('H:i:s', strtotime($row->start_time." +".$totalhours." minutes"));
	
					
					$totalbookings = $this->service_finder_get_availability( $data['seldate'],$row->start_time,$endtime,$data['provider_id'],$bookingid);
					
					$chkunavailability = $this->service_finder_get_chkunavailability( $data['seldate'],$row->start_time,$data['provider_id']);
					
					if($row->max_bookings > $totalbookings && $chkunavailability == 0) {		
						$flag = 1;
						if($editbooking == 'yes'){
							$databookingid = 'data-bookingid="'.$bookingid.'"';
							if($data['start_time'] == $row->start_time){
								$active = 'class="active"';
							}else{
								$active = '';
							}
						}else{
							$active = '';
							$databookingid = '';
						}
						
						
						if($time_format){
							$showtime = date('H:i',strtotime($row->start_time));
						}else{
							$showtime = date('h:i a',strtotime($row->start_time));
						}
						$res .= '<li '.$active.' '.$databookingid.' data-source="'.esc_attr($row->start_time).'-'.esc_attr($endtime).'"><span>'.$showtime.'</span></li>';
					}
				}else{
					$totalbookings = $this->service_finder_get_availability_nohours( $data['seldate'],$row->start_time,$data['provider_id'],$bookingid);
					
					$chkunavailability = $this->service_finder_get_chkunavailability( $data['seldate'],$row->start_time,$data['provider_id']);
					
					if($row->max_bookings > $totalbookings && $chkunavailability == 0) {		
						$flag = 1;
						
						if($editbooking == 'yes'){
							$databookingid = 'data-bookingid="'.$bookingid.'"';
							if($data['start_time'] == $row->start_time){
								$active = 'class="active"';
							}else{
								$active = '';
							}
						}else{
							$active = '';
							$databookingid = '';
						}
						
						if($time_format){
							$showtime = date('H:i',strtotime($row->start_time));
						}else{
							$showtime = date('h:i a',strtotime($row->start_time));
						}
						$res .= '<li '.$active.' '.$databookingid.' data-source="'.esc_attr($row->start_time).'"><span>'.$showtime.'</span></li>';
					}
				}
			}
		}
		
		if($flag == 0){
			$res = '<div class="notavail">'.esc_html__('There are no time slot available.', 'service-finder').'</div>';
		}
		
		return $res;
	}
	
	/*Get Availability*/
	public function service_finder_get_availability($date,$starttime,$endtime,$provider_id,$bookingid = 0){
		global $wpdb,$service_finder_Tables;
		
		if($bookingid != '' && $bookingid > 0){
		$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`id` != %d AND `bookings`.`status` != "Cancel" AND `bookings`.`provider_id` = %d AND `bookings`.`date` = "%s" AND (start_time > "%s" AND start_time < "%s" OR (end_time > "%s" AND end_time < "%s") OR (start_time < "%s" AND end_time > "%s") OR (start_time = "%s" OR end_time = "%s") )',$bookingid,$provider_id,$date,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime));
		}else{
		$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`status` != "Cancel" AND `bookings`.`provider_id` = %d AND `bookings`.`date` = "%s" AND (start_time > "%s" AND start_time < "%s" OR (end_time > "%s" AND end_time < "%s") OR (start_time < "%s" AND end_time > "%s") OR (start_time = "%s" OR end_time = "%s") )',$provider_id,$date,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime,$starttime,$endtime));		
		}
		
		$totalrows = count($result);
		//echo $wpdb->last_query;//lists only single query
		return $totalrows;
		
	}
	
	/*Get Availability for without hours*/
	public function service_finder_get_availability_nohours($date,$starttime,$provider_id,$bookingid = 0){
		global $wpdb,$service_finder_Tables;
		
		if($bookingid != '' && $bookingid > 0){
		$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`id` != %d AND `bookings`.`status` != "Cancel" AND `bookings`.`provider_id` = %d AND `bookings`.`date` = "%s" AND start_time = "%s"',$bookingid,$provider_id,$date,$starttime));
		}else{
		$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`status` != "Cancel" AND `bookings`.`provider_id` = %d AND `bookings`.`date` = "%s" AND start_time = "%s"',$provider_id,$date,$starttime));
		}
		
		$totalrows = count($result);
		//echo $wpdb->last_query;//lists only single query
		return $totalrows;
		
	}
	
	/*Check UNAvailability*/
	public function service_finder_get_chkunavailability($date,$starttime,$provider_id){
		global $wpdb,$service_finder_Tables;
		
		$result = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' AS unavl WHERE `unavl`.`date` = "%s" AND availability_method = "starttime" AND `unavl`.`single_start_time` = "%s" AND `unavl`.`provider_id` = %d',$date,$starttime,$provider_id));
		
		$totalrows = count($result);
		//echo $wpdb->last_query;//lists only single query
		return $totalrows;
		
	}
	
	
	
	/*Inner Login*/
	public function service_finder_innerLogin($data = ''){
	
		global $wpdb, $service_finder_Tables, $service_finder_Params, $user;

		$creds = array();
			$creds['user_login'] = esc_attr($data['username']);
			$creds['user_password'] = esc_attr($data['password']);
			$creds['remember'] = true;
			$user = wp_signon( $creds, false );
			if(is_wp_error($user)) {
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Couldn&rsquo;t Login. Please try again', 'service-finder'),
						);
						
				echo json_encode($error);
				
			} else {
			$fname = get_user_meta($user->ID, 'first_name', true);
			$lname = get_user_meta($user->ID, 'last_name', true);
			$udata = $user->data;
			$uemail = $udata->user_email;
			
			if(service_finder_getUserRole($user->ID) == 'Provider'){
			
				/* Get Provider info */
				$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$user->ID));
				
				$userinfo = array(
							$currUser,
							'userid' => $user->ID,
							'firstname' => $fname,
							'lastname' => $lname,
							'email' => $uemail,
							'provider_id' => $sedateProvider->id,
							'country' => $sedateProvider->country,
							'city' => $sedateProvider->city,
							'phone' => $sedateProvider->phone,
							'category' => get_user_meta($user->ID,'primary_category',true),
							'min_cost' => $sedateProvider->min_cost,
							);
			}else{
				
				/* Get Customer info */
				$sedateCustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$user->ID));
				
				$userinfo = array(
							$currUser,
							'userid' => $user->ID,
							'firstname' => $fname,
							'lastname' => $lname,
							'email' => $uemail,
							'phone' => $sedateCustomer->phone,
							'phone2' => $sedateCustomer->phone2,
							'address' => $sedateCustomer->address,
							'apt' => $sedateCustomer->apt,
							'city' => $sedateCustomer->city,
							'state' => $sedateCustomer->state,
							'zipcode' => $sedateCustomer->zipcode,
							);
			}	
			
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Login Successfull', 'service-finder'),
						'userinfo' => $userinfo,
						);
				echo json_encode($success);
			}
		
	}
	
	/*Add to Favorite*/
	public function service_finder_addtofavorite($data = ''){
	global $wpdb, $service_finder_Tables;
	
			$data = array(
				'user_id' => $data['userid'],
				'provider_id' => $data['providerid'],
				'favorite' => 'yes',
				);

			$wpdb->insert($service_finder_Tables->favorites,wp_unslash($data));
			
			$favorite_id = $wpdb->insert_id;
			
			if ( ! $favorite_id ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t added to favorite... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Added to favorite successfully.', 'service-finder'),
						'favoriteid' => $favorite_id,
						);
				echo json_encode($success);
			}
	}
	
	/*Remove From Favorite*/
	public function service_finder_removeFromFavorite($data = ''){
	global $wpdb, $service_finder_Tables;
	
			$res = $wpdb->query($wpdb->prepare('DELETE FROM `'.$service_finder_Tables->favorites.'` WHERE `provider_id` = %d AND `user_id` = %d',$data['providerid'],$data['userid']));
			
			if($res){
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Remove from favorite successfully.', 'service-finder'),
						);
				echo json_encode($success);
			}
			
	}
	
	/*Reset Booking Calendar*/
	public function service_finder_resetBookingCalender($data = ''){
	$date = null;
	$bookeddate = null;
	$allocateddate = null;
	$daynum = null;
	
	
			global $wpdb, $service_finder_Tables;
			$provider_id = $data['provider_id']; 
			
			$res = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND wholeday = "yes" GROUP BY date',$provider_id));
			
			$bookings = $wpdb->get_results($wpdb->prepare('SELECT date, COUNT(ID) as totalbooked FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d AND date > now() GROUP BY date',$provider_id));
			if(!empty($bookings)){
				foreach($bookings as $booking){
					$dayname = date('l', strtotime($booking->date));
					$q = $wpdb->get_row($wpdb->prepare('SELECT sum(max_bookings) as avlbookings FROM '.$service_finder_Tables->timeslots.' WHERE `provider_id` = %d AND day = "%s"',$provider_id,strtolower($dayname)));
					if(!empty($q)){
						if($q->avlbookings <= $booking->totalbooked){
							$bookeddate[] = date('Y-n-j',strtotime($booking->date));			
						}
					}
				}
			}
			
			$getalloteddates = $wpdb->get_results($wpdb->prepare('SELECT date FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND wholeday != "yes" AND date > now() GROUP BY date',$provider_id));
			
			if(!empty($getalloteddates)){
				foreach($getalloteddates as $getalloteddate){
					$allocateddate[] = date('Y-n-j',strtotime($getalloteddate->date));
				}
			}
			
			$getdays = $wpdb->get_results($wpdb->prepare('SELECT day FROM '.$service_finder_Tables->timeslots.' WHERE `provider_id` = %d GROUP BY day',$provider_id));
			
			if(!empty($getdays)){
				foreach($getdays as $getday){
					$daynum[] = date('N', strtotime($getday->day)) - 1;
				}
			}
			
			
			if(!empty($res)){
				foreach($res as $row){
				$date[] = date('Y-n-j',strtotime($row->date));
				}
			}
			
			$success = array(
						'status' => 'success',
						'daynum' => json_encode($daynum),
						'dates' => json_encode($date),
						'bookeddates' => json_encode($bookeddate),
						'allocateddates' => json_encode($allocateddate)
						);
				echo json_encode($success);
			
		}	
		
	/*Reset Start Time Booking Calendar*/
	public function service_finder_resetStartTimeBookingCalender($data = ''){
	$date = null;
	$bookeddate = null;
	$allocateddate = null;
	$daynum = null;
	
	
			global $wpdb, $service_finder_Tables;
			$provider_id = $data['provider_id']; 
			
			$res = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND wholeday = "yes" GROUP BY date',$provider_id));
			
			$bookings = $wpdb->get_results($wpdb->prepare('SELECT date, COUNT(ID) as totalbooked FROM '.$service_finder_Tables->bookings.' WHERE `provider_id` = %d AND date > now() GROUP BY date',$provider_id));
			if(!empty($bookings)){
				foreach($bookings as $booking){
					$dayname = date('l', strtotime($booking->date));
					$q = $wpdb->get_row($wpdb->prepare('SELECT sum(max_bookings) as avlbookings FROM '.$service_finder_Tables->starttime.' WHERE `provider_id` = %d AND day = "%s"',$provider_id,strtolower($dayname)));
					if(!empty($q)){
						if($q->avlbookings <= $booking->totalbooked){
							$bookeddate[] = date('Y-n-j',strtotime($booking->date));			
						}
					}
				}
			}
			
			$getalloteddates = $wpdb->get_results($wpdb->prepare('SELECT date FROM '.$service_finder_Tables->unavailability.' WHERE `provider_id` = %d AND wholeday != "yes" AND date > now() GROUP BY date',$provider_id));
			
			if(!empty($getalloteddates)){
				foreach($getalloteddates as $getalloteddate){
					$allocateddate[] = date('Y-n-j',strtotime($getalloteddate->date));
				}
			}
			
			$getdays = $wpdb->get_results($wpdb->prepare('SELECT day FROM '.$service_finder_Tables->starttime.' WHERE `provider_id` = %d GROUP BY day',$provider_id));

			if(!empty($getdays)){
				foreach($getdays as $getday){
					$daynum[] = date('N', strtotime($getday->day)) - 1;
				}
			}
			
			
			if(!empty($res)){
				foreach($res as $row){
				$date[] = date('Y-n-j',strtotime($row->date));
				}
			}
			
			$success = array(
						'status' => 'success',
						'daynum' => json_encode($daynum),
						'dates' => json_encode($date),
						'bookeddates' => json_encode($bookeddate),
						'allocateddates' => json_encode($allocateddate)
						);
				echo json_encode($success);
			
		}	
				
}