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
/*Get Current User Info*/
function service_finder_getCurrentUserInfo(){
			global $wpdb, $service_finder_Tables;
			$currUser = wp_get_current_user(); 
			$fname = get_user_meta($currUser->ID,'first_name',true);
			$lname = get_user_meta($currUser->ID,'last_name',true);	
			
			if(service_finder_getUserRole($currUser->ID) == 'Provider'){
			
				/* Get Provider info */
				$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$currUser->ID));
				
				$address = (!empty($sedateProvider->address)) ? $sedateProvider->address : '';
				$city = (!empty($sedateProvider->city)) ? $sedateProvider->city: '';
				$state = (!empty($sedateProvider->state)) ? $sedateProvider->state : '';
				$country = (!empty($sedateProvider->country)) ? $sedateProvider->country : '';
				
				$state = (!empty($state)) ? ', '.esc_html($state) : '';
						
				$fulladdress = $address.', '.$city.$state.', '.$country;
				
				$service_perform = get_user_meta($currUser->ID,'service_perform',true);
				$my_location = get_user_meta($currUser->ID,'my_location',true);
				$providerlat = get_user_meta($currUser->ID,'providerlat',true);
				$providerlng = get_user_meta($currUser->ID,'providerlng',true);	
				
				$userinfo = array(
							$currUser,
							'company_name' => (!empty($sedateProvider->company_name)) ? $sedateProvider->company_name : '',
							'fname' => $fname,
							'lname' => $lname,
							'email' => (!empty($sedateProvider->email)) ? $sedateProvider->email : '',
							'avatar_id' => (!empty($sedateProvider->avatar_id)) ? $sedateProvider->avatar_id : '',
							'provider_id' => (!empty($sedateProvider->id)) ? $sedateProvider->id : '',
							'identity' => (!empty($sedateProvider->identity)) ? $sedateProvider->identity : '',
							'phone' => (!empty($sedateProvider->phone)) ? $sedateProvider->phone : '',
							'category' => (!empty($sedateProvider->category_id)) ? $sedateProvider->category_id : '',
							'categoryname' => service_finder_getCategoryName(get_user_meta($currUser->ID,'primary_category',true)),
							'tagline' => (!empty($sedateProvider->tagline)) ? $sedateProvider->tagline : '',
							'bio' => (!empty($sedateProvider->bio)) ? $sedateProvider->bio : '',
							'booking_description' => (!empty($sedateProvider->booking_description)) ? $sedateProvider->booking_description : '',
							'embeded_code' => (!empty($sedateProvider->embeded_code)) ? $sedateProvider->embeded_code : '',
							'mobile' => (!empty($sedateProvider->mobile)) ? $sedateProvider->mobile : '',
							'fax' => (!empty($sedateProvider->fax)) ? $sedateProvider->fax : '',
							'lat' => (!empty($sedateProvider->lat)) ? $sedateProvider->lat : '',
							'long' => (!empty($sedateProvider->long)) ? $sedateProvider->long : '',
							'facebook' => (!empty($sedateProvider->facebook)) ? $sedateProvider->facebook : '',
							'twitter' => (!empty($sedateProvider->twitter)) ? $sedateProvider->twitter : '',
							'linkedin' => (!empty($sedateProvider->linkedin)) ? $sedateProvider->linkedin : '',
							'pinterest' => (!empty($sedateProvider->pinterest)) ? $sedateProvider->pinterest : '',
							'digg' => (!empty($sedateProvider->digg)) ? $sedateProvider->digg : '',
							'google_plus' => (!empty($sedateProvider->google_plus)) ? $sedateProvider->google_plus : '',
							'instagram' => (!empty($sedateProvider->instagram)) ? $sedateProvider->instagram : '',
							'skypeid' => (!empty($sedateProvider->skypeid)) ? $sedateProvider->skypeid : '',
							'website' => (!empty($sedateProvider->website)) ? $sedateProvider->website : '',
							'address' => (!empty($address)) ? $address : '',
							'apt' => (!empty($sedateProvider->apt)) ? $sedateProvider->apt : '',
							'city' => (!empty($sedateProvider->city)) ? $sedateProvider->city : '',
							'state' => (!empty($sedateProvider->state)) ? $sedateProvider->state : '',
							'zipcode' => (!empty($sedateProvider->zipcode)) ? $sedateProvider->zipcode : '',
							'country' => (!empty($sedateProvider->country)) ? $sedateProvider->country : '',
							'service_perform' => $service_perform,
							'my_location' => $my_location,
							'providerlat' => $providerlat,
							'providerlng' => $providerlng,
							);
				return $userinfo;	
			
			}else{
				
				/* Get Customer info */
				$sedateCustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$currUser->ID));
				
				$userinfo = array(
							$currUser,
							'fname' => $fname,
							'lname' => $lname,
							'phone' => (!empty($sedateCustomer->phone)) ? $sedateCustomer->phone : '',
							'phone2' => (!empty($sedateCustomer->phone2)) ? $sedateCustomer->phone2 : '',
							'address' =>(!empty($sedateCustomer->address)) ? $sedateCustomer->address : '',
							'apt' => (!empty($sedateCustomer->apt)) ? $sedateCustomer->apt : '',
							'city' => (!empty($sedateCustomer->city)) ? $sedateCustomer->city : '',
							'state' => (!empty($sedateCustomer->state)) ? $sedateCustomer->state : '',
							'zipcode' => (!empty($sedateCustomer->zipcode)) ? $sedateCustomer->zipcode : '',
							'country' => (!empty($sedateCustomer->country)) ? $sedateCustomer->country : '',
							'avatar_id' => (!empty($sedateCustomer->avatar_id)) ? $sedateCustomer->avatar_id : '',
							);
				return $userinfo;
				
			}		
	}
	
/*Get User Info by ID*/
function service_finder_getUserInfo($userid){
			global $wpdb, $service_finder_Tables;
			$fname = get_user_meta($userid,'first_name',true);
			$lname = get_user_meta($userid,'last_name',true);	
			
			if(service_finder_getUserRole($userid) == 'Provider'){
			
				/* Get Provider info */
				$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$userid));
				
				$address = (!empty($sedateProvider->address)) ? $sedateProvider->address : '';
				$city = (!empty($sedateProvider->city)) ? $sedateProvider->city: '';
				$state = (!empty($sedateProvider->state)) ? $sedateProvider->state : '';
				$country = (!empty($sedateProvider->country)) ? $sedateProvider->country : '';
				
				$state = (!empty($state)) ? ', '.esc_html($state) : '';
						
				$fulladdress = $address.', '.$city.$state.', '.$country;
				
				$service_perform = get_user_meta($userid,'service_perform',true);
				$my_location = get_user_meta($userid,'my_location',true);
				$providerlat = get_user_meta($userid,'providerlat',true);
				$providerlng = get_user_meta($userid,'providerlng',true);	
				
				$userinfo = array(
							'company_name' => (!empty($sedateProvider->company_name)) ? $sedateProvider->company_name : '',
							'fname' => $fname,
							'lname' => $lname,
							'email' => (!empty($sedateProvider->email)) ? $sedateProvider->email : '',
							'avatar_id' => (!empty($sedateProvider->avatar_id)) ? $sedateProvider->avatar_id : '',
							'provider_id' => (!empty($sedateProvider->id)) ? $sedateProvider->id : '',
							'identity' => (!empty($sedateProvider->identity)) ? $sedateProvider->identity : '',
							'phone' => (!empty($sedateProvider->phone)) ? $sedateProvider->phone : '',
							'category' => (!empty($sedateProvider->category_id)) ? $sedateProvider->category_id : '',
							'categoryname' => service_finder_getCategoryName(get_user_meta($userid,'primary_category',true)),
							'tagline' => (!empty($sedateProvider->tagline)) ? $sedateProvider->tagline : '',
							'bio' => (!empty($sedateProvider->bio)) ? $sedateProvider->bio : '',
							'booking_description' => (!empty($sedateProvider->booking_description)) ? $sedateProvider->booking_description : '',
							'embeded_code' => (!empty($sedateProvider->embeded_code)) ? $sedateProvider->embeded_code : '',
							'mobile' => (!empty($sedateProvider->mobile)) ? $sedateProvider->mobile : '',
							'fax' => (!empty($sedateProvider->fax)) ? $sedateProvider->fax : '',
							'lat' => (!empty($sedateProvider->lat)) ? $sedateProvider->lat : '',
							'long' => (!empty($sedateProvider->long)) ? $sedateProvider->long : '',
							'facebook' => (!empty($sedateProvider->facebook)) ? $sedateProvider->facebook : '',
							'twitter' => (!empty($sedateProvider->twitter)) ? $sedateProvider->twitter : '',
							'linkedin' => (!empty($sedateProvider->linkedin)) ? $sedateProvider->linkedin : '',
							'pinterest' => (!empty($sedateProvider->pinterest)) ? $sedateProvider->pinterest : '',
							'digg' => (!empty($sedateProvider->digg)) ? $sedateProvider->digg : '',
							'google_plus' => (!empty($sedateProvider->google_plus)) ? $sedateProvider->google_plus : '',
							'instagram' => (!empty($sedateProvider->instagram)) ? $sedateProvider->instagram : '',
							'skypeid' => (!empty($sedateProvider->skypeid)) ? $sedateProvider->skypeid : '',
							'website' => (!empty($sedateProvider->website)) ? $sedateProvider->website : '',
							'simpleaddress' => (!empty($sedateProvider->address)) ? $sedateProvider->address : '',
							'address' => $address,
							'apt' => (!empty($sedateProvider->apt)) ? $sedateProvider->apt : '',
							'city' => (!empty($sedateProvider->city)) ? $sedateProvider->city : '',
							'state' => (!empty($sedateProvider->state)) ? $sedateProvider->state : '',
							'zipcode' => (!empty($sedateProvider->zipcode)) ? $sedateProvider->zipcode : '',
							'country' => (!empty($sedateProvider->country)) ? $sedateProvider->country : '',
							'service_perform' => $service_perform,
							'my_location' => $my_location,
							'providerlat' => $providerlat,
							'providerlng' => $providerlng,
							);
				return $userinfo;	
			
			}else{
				
				/* Get Customer info */
				$sedateCustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$userid));
				
				$userinfo = array(
							'fname' => $fname,
							'lname' => $lname,
							'phone' => (!empty($sedateCustomer->phone)) ? $sedateCustomer->phone : '',
							'phone2' => (!empty($sedateCustomer->phone2)) ? $sedateCustomer->phone2 : '',
							'address' => (!empty($sedateCustomer->address)) ? $sedateCustomer->address : '',
							'apt' => (!empty($sedateCustomer->apt)) ? $sedateCustomer->apt : '',
							'city' => (!empty($sedateCustomer->city)) ? $sedateCustomer->city : '',
							'state' => (!empty($sedateCustomer->state)) ? $sedateCustomer->state : '',
							'zipcode' => (!empty($sedateCustomer->zipcode)) ? $sedateCustomer->zipcode : '',
							'country' => (!empty($sedateCustomer->country)) ? $sedateCustomer->country : '',
							);
				return $userinfo;
				
			}		
	}	

/*Get Providers Settings*/
function service_finder_getProviderSettings($uid){
		global $wpdb, $service_finder_Tables;

		$options = unserialize(get_option( 'provider_settings'));
		if($uid > 0){
		$settings = array(
							'booking_process' => (!empty($options[$uid]['booking_process'])) ? $options[$uid]['booking_process'] : '',
							'availability_based_on' => (!empty($options[$uid]['availability_based_on'])) ? $options[$uid]['availability_based_on'] : '',
							'booking_basedon' => (!empty($options[$uid]['booking_basedon'])) ? $options[$uid]['booking_basedon'] : '',
							'booking_charge_on_service' => (!empty($options[$uid]['booking_charge_on_service'])) ? $options[$uid]['booking_charge_on_service'] : '',
							'booking_option' => (!empty($options[$uid]['booking_option'])) ? $options[$uid]['booking_option'] : '',
							'mincost' => (!empty($options[$uid]['mincost'])) ? $options[$uid]['mincost'] : '',
							'booking_assignment' => (!empty($options[$uid]['booking_assignment'])) ? $options[$uid]['booking_assignment'] : '',
							'members_available' => (!empty($options[$uid]['members_available'])) ? $options[$uid]['members_available'] : '',
							'paymentoption' => (!empty($options[$uid]['paymentoption'])) ? $options[$uid]['paymentoption'] : '',
							'paypalusername' => (!empty($options[$uid]['paypalusername'])) ? $options[$uid]['paypalusername'] : '',
							'paypalpassword' => (!empty($options[$uid]['paypalpassword'])) ? $options[$uid]['paypalpassword'] : '',
							'paypalsignatue' => (!empty($options[$uid]['paypalsignatue'])) ? $options[$uid]['paypalsignatue'] : '',
							'stripesecretkey' => (!empty($options[$uid]['stripesecretkey'])) ? $options[$uid]['stripesecretkey'] : '',
							'stripepublickey' => (!empty($options[$uid]['stripepublickey'])) ? $options[$uid]['stripepublickey'] : '',
							'wired_description' => (!empty($options[$uid]['wired_description'])) ? $options[$uid]['wired_description'] : '',
							'wired_instructions' => (!empty($options[$uid]['wired_instructions'])) ? $options[$uid]['wired_instructions'] : '',
							'twocheckoutaccountid' => (!empty($options[$uid]['twocheckoutaccountid'])) ? $options[$uid]['twocheckoutaccountid'] : '',
							'twocheckoutpublishkey' => (!empty($options[$uid]['twocheckoutpublishkey'])) ? $options[$uid]['twocheckoutpublishkey'] : '',
							'twocheckoutprivatekey' => (!empty($options[$uid]['twocheckoutprivatekey'])) ? $options[$uid]['twocheckoutprivatekey'] : '',
							'payumoneymid' => (!empty($options[$uid]['payumoneymid'])) ? $options[$uid]['payumoneymid'] : '',
							'payumoneykey' => (!empty($options[$uid]['payumoneykey'])) ? $options[$uid]['payumoneykey'] : '',
							'payumoneysalt' => (!empty($options[$uid]['payumoneysalt'])) ? $options[$uid]['payumoneysalt'] : '',
							'payulatammerchantid' => (!empty($options[$uid]['payulatammerchantid'])) ? $options[$uid]['payulatammerchantid'] : '',
							'payulatamapilogin' => (!empty($options[$uid]['payulatamapilogin'])) ? $options[$uid]['payulatamapilogin'] : '',
							'payulatamapikey' => (!empty($options[$uid]['payulatamapikey'])) ? $options[$uid]['payulatamapikey'] : '',
							'payulatamaccountid' => (!empty($options[$uid]['payulatamaccountid'])) ? $options[$uid]['payulatamaccountid'] : '',
							'google_calendar' => (!empty($options[$uid]['google_calendar'])) ? $options[$uid]['google_calendar'] : '',
							);
		return $settings;
		}
}

/*Get User Role By ID*/
function service_finder_getUserRole($userid){
if($userid > 0){
	$user = new WP_User( $userid );
	return (!empty($user->roles[0])) ? $user->roles[0] : '';
}	
}

/*Fetch Category List Array*/
function service_finder_getCategoryList($limit = '',$child=false){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( 'providers-category',$args );
}

/*Fetch Category List Array*/
function service_finder_get_child_category($parentid){
	global $wpdb, $service_finder_Tables;
	
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'number'            => 0,
		'child_of'          => $parentid,
		'hide_empty'        => false, 
	); 
	return $categories = get_terms( 'providers-category',$args );
}

/*Fetch Category List Array*/
function service_finder_getCategoryListwithOffest($limit = '',$child=false,$offset = 0){
	global $wpdb, $service_finder_Tables;
	
	if($child == 'true'){
		$parent = '';
	}else{
		$parent = 0;
	}
	$args = array(
		'orderby'           => 'name',
		'order'             => 'ASC',
		'offset'            => $offset,
		'number'            => $limit,
		'parent'            => $parent,
		'hide_empty'        => false, 
	); 

	return $categories = get_terms( 'providers-category',$args );
}

/*Get Category Link*/
function service_finder_getCategoryLink($catid){
	global $wpdb, $service_finder_Tables;
	
	if($catid > 0){
	$catdetails = get_term_by('id', $catid, 'providers-category');
	if(!empty($catdetails)){
	$link = get_term_link( $catdetails );
	return $link;
	}else{
	return '';
	}
	}else{
	return '';
	}
}

/*Get Provider Services*/
function service_finder_getServices($uid,$status = '',$groupid = 0){
	global $wpdb, $service_finder_Tables;
	
	if($status == 'active'){
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `status` = "active" AND `wp_user_id` = %d',$uid));
	}else{
	if($groupid != '' && $groupid > 0){
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE group_id = %d AND `wp_user_id` = %d',$groupid,$uid));
	}else{
	$services = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE group_id = 0 AND `wp_user_id` = %d',$uid));
	}
	}
	
	return $services;
}

/*Get Provider Service Data*/
function service_finder_getServiceData($sid){
	global $wpdb, $service_finder_Tables;
	
	$servicedata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$sid));
	
	return $servicedata;
}

/*Get Provider Documents*/
function service_finder_getDocuments($uid){
	global $wpdb, $service_finder_Tables;
	
	$attachmentsIDs = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "file" AND `wp_user_id` = %d',$uid));
	
	return $attachmentsIDs;
}

/*Get Provider Identity*/
function service_finder_get_identity($uid){
	global $wpdb, $service_finder_Tables;
	
	$attachmentsIDs = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "identity" AND `wp_user_id` = %d',$uid));
	
	return $attachmentsIDs;
}

/*Fetch Related Providers List Array*/
function service_finder_getRelatedProviders($uid,$catid,$limit=5){
	global $wpdb, $service_finder_Tables, $service_finder_options;
	
	$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
	$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
	
	if($restrictuserarea && $identitycheck){
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND `category_id` = %d AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$catid,$uid,$limit));
	}else{
	$providers = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND `category_id` = %d AND `wp_user_id` != %d ORDER BY RAND() LIMIT %d',$catid,$uid,$limit));
	}
	
	return $providers;
}

/*Fetch Provider Attachments*/
function service_finder_getProviderAttachments($uid,$type){
	global $wpdb, $service_finder_Tables;
	$attachments = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->attachments.' WHERE `type` = "%s" AND `wp_user_id` = %d',$type,$uid));
	
	return $attachments;
}

/*Fetch Service Area*/
function service_finder_getServiceArea($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_area.' WHERE `provider_id` = %d AND `status` = "active"',$uid));
	
	return $results;
}

/*Fetch All Service Area*/
function service_finder_getAllServiceArea($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_area.' WHERE `provider_id` = %d',$uid));
	
	return $results;
}

/*Fetch Service Regions*/
function service_finder_getServiceRegions($uid){
	global $wpdb, $service_finder_Tables;
	$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->regions.' WHERE `status` = "active" AND `provider_id` = %d',$uid));
	
	return $results;
}

/*Fetch Staff Members*/
function service_finder_getStaffMembers($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`start_time` = "'.$start_time.'" AND `bookings`.`end_time` = "'.$end_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members*/
function service_finder_getStaffMembersStartTime($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members Edit*/
function service_finder_getStaffMembersStartTimeEdit($uid,$zipcode='',$date,$slot ='',$memberid = 0,$editbooking = '',$region='',$bookingid = 0){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	$tem = explode('-',$slot);
	$start_time = (!empty($tem[0])) ? $tem[0] : '';
	$end_time = (!empty($tem[1])) ? $tem[1] : '';
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($slot == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND (start_time > "'.$start_time.'" AND start_time < "'.$end_time.'" OR (end_time > "'.$start_time.'" AND end_time < "'.$end_time.'") OR (start_time < "'.$start_time.'" AND end_time > "'.$end_time.'") OR (start_time = "'.$start_time.'" OR end_time = "'.$end_time.'") ) AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members no hours*/
function service_finder_getStaffMembersStartTime_nohours($uid,$zipcode='',$date,$start_time ='',$memberid = 0,$editbooking = '',$region=''){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($start_time == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}

/*Fetch Staff Members no hours Edit*/
function service_finder_getStaffMembersStartTimeEdit_nohours($uid,$zipcode='',$date,$start_time ='',$memberid = 0,$editbooking = '',$region='',$bookingid = 0){
	global $wpdb, $service_finder_Tables;
	
	$settings = service_finder_getProviderSettings($uid);
	
	$dayname = date('l', strtotime( $date ));
	
	if($memberid > 0){
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` != "'.$memberid.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}elseif($start_time == ''){
		
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
		
	}else{
	
		if($settings['booking_basedon'] == 'zipcode'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `service_area` LIKE "%'.$zipcode.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'region'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `regions` LIKE "%'.$region.'%" AND `admin_wp_id` = '.$uid);
		}elseif($settings['booking_basedon'] == 'open'){
		$members = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->team_members.' AS members WHERE NOT EXISTS(SELECT * FROM '.$service_finder_Tables->bookings.' AS bookings WHERE `bookings`.`date` = "'.$date.'" AND `bookings`.`status` != "Cancel" AND `bookings`.`id` != '.$bookingid.' AND start_time = "'.$start_time.'" AND `bookings`.`member_id` = `members`.`id`) AND `is_admin` = "no" AND `admin_wp_id` = '.$uid);
		}
		
	
	}

	return $members;
}


/*Get Members for Schedule Calendar*/
function service_finder_getMembers($uid){
global $wpdb, $service_finder_Tables;
		
		$members = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `is_admin` = "no" AND `admin_wp_id` = %d',$uid));
		return $members;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberName($mid){
global $wpdb, $service_finder_Tables;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		return $member->member_name;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberEmail($mid){
global $wpdb, $service_finder_Tables;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		return $member->email;
		
}

/*Get Members for Schedule Calendar*/
function service_finder_getMemberAvatar($mid){
global $wpdb, $service_finder_Tables, $service_finder_Params;
		
		$member = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$mid));
		
		$src  = wp_get_attachment_image_src( $member->avatar_id, 'service_finder-staff-member' );
		$src  = $src[0];
		$src = ($src != '') ? $src : '';
		
		return $src;
		
}

/*Get Category Image*/
function service_finder_getCategoryImage($cid,$imagesize = 'medium'){
global $wpdb, $service_finder_Tables;
		
		if($cid > 0){
		$term_meta_image = get_option( "providers-category_image_".$cid );
		$providerimage = (!empty($term_meta_image)) ? esc_attr( $term_meta_image ) : '';
		if($providerimage != ""){
			$imageid = service_finder_get_image_id_by_link($providerimage);
			$image_attributes = wp_get_attachment_image_src( $imageid, $imagesize );
			return $image_attributes[0];
		}else{
			return '';		
		}
		}else{
			return '';
		}
												
}

/** Get Category name by catgory id*/
function service_finder_getCategoryName($cid){
		if($cid > 0){
		$term = get_term( $cid, "providers-category" );
		if(!empty($term)){
		return (!empty($term->name)) ? $term->name : '';
		}else{
		return '';
		}
		}else{
		return '';
		}
}

/** Get Category name by catgory id via sql query*/
function service_finder_getCategoryNameviaSql($cid){
		global $wpdb;
		$term = $wpdb->get_row($wpdb->prepare('SELECT * FROM `'.$wpdb->prefix.'terms` WHERE `term_id` = %d',$cid));
		return $term->name;
}

/*Get Category Icon*/
function service_finder_getCategoryIcon($cid, $size = 'service_finder-marker-icon'){
global $wpdb, $service_finder_Tables, $service_finder_options;
		
		if($cid > 0){
		$term_meta_icon = get_option( "providers-category_icon_".$cid );
		$providerimage = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : '';
		$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
		
		$imgid = service_finder_get_image_id_by_link($providerimage);
		$src = wp_get_attachment_image_src( $imgid, $size );
		
		if($src[0] != ""){
			return $src[0];
		}else{
			$term = get_term( $cid, "providers-category" );
			$term_parent = '';
			if(!empty($term)){
				$term_parent = (isset($term->parent)) ? $term->parent : '';
			}
			if($term_parent > 0){
				$termid = $term->parent;
				$term_meta_icon = get_option( "providers-category_icon_".$termid );
				$providerimage = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : '';
				
				$imgid = service_finder_get_image_id_by_link($providerimage);
				$src = wp_get_attachment_image_src( $imgid, $size );
				
				if($size == 'service_finder-marker-icon'){
					if($src[0] != ""){
						return $src[0];
					}elseif($icon != ''){
						return $icon;
					}else{
						return '';
					}
				}else{
					if($src[0] != ""){
						return $src[0];
					}else{
						return '';
					}
				}
				
			}else{
				if($size == 'service_finder-marker-icon'){
					if($icon != ''){
						return $icon;
					}else{
						return '';
					}
				}else{
					return '';
				}
				
			}
		}
		}else{
			return '';
		}
												
}

/*Get Category Icon*/
function service_finder_getCategoryColor($cid){
global $wpdb, $service_finder_Tables, $service_finder_options;
		
		if($cid > 0){
		$categorycolor = get_term_meta( $cid, 'provider_category_color', true );
		
		if($categorycolor != ""){
			return $categorycolor;
		}else{
			$term = get_term( $cid, "providers-category" );
			$term_parent = '';
			if(!empty($term)){
				$term_parent = (isset($term->parent)) ? $term->parent : '';
			}
			if($term_parent > 0){
				$termid = $term->parent;
				$categorycolor = get_term_meta( $termid, 'provider_category_color', true );
				if($categorycolor != ""){
					return $categorycolor;
				}
			}else{
				return '';
			}
		}
		}else{
			return '';
		}
												
}

/*Get brache address*/
function service_finder_getBranches($bid){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE id = %d',$bid));
if(!empty($res)){
$address = $res->address;
$city = $res->city;
$state = $res->state;
$country = $res->country;

$state = (!empty($res->state)) ? ', '.esc_html($res->state) : '';
		
$fulladdress = $address.', '.$city.$state.', '.$country;

return $fulladdress;
}else{
return '';
}

}


/*Get Cities*/
function service_finder_getCities($country){
global $wpdb, $service_finder_Tables, $service_finder_options;

$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
	$maincities = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT city FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND `country` LIKE "%s" ORDER BY `city`',$country));
}else{
	$maincities = $wpdb->get_results($wpdb->prepare('SELECT DISTINCT city FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND `country` LIKE "%s" ORDER BY `city`',$country));
}	

$branchcities = $wpdb->get_results($wpdb->prepare("select DISTINCT city from ".$service_finder_Tables->branches." WHERE country = '%s' ORDER BY `city`",$country));
				
$allcities = array();

if(!empty($maincities)){
foreach($maincities as $city){
	$allcities[] = $city->city;
}
}

if(!empty($branchcities)){
foreach($branchcities as $city){
	$allcities[] = $city->city;
}
}

$allcities = array_unique($allcities);
sort($allcities);
	
			$html = '<option value="">'.esc_html__('Select City', 'service-finder').'</option>';
			if(!empty($allcities)){
			foreach($allcities as $city){
				$html .= '<option value="'.esc_attr($city).'">'.$city.'</option>';
			}
			}else{
				$html .= '<option value="">'.esc_html__('No city available', 'service-finder').'</option>';
			}
		
	$success = array(
			'status' => 'success',
			'html' => $html,
			);
	$service_finder_Success = json_encode($success);
	return $service_finder_Success;
}

/*Get Packages for provider signup*/
function service_finder_getPackages($selectedpackage = ''){
global $wpdb, $service_finder_Tables, $service_finder_options;
$html = '';
$currency = service_finder_currencycode();
for ($i=0; $i <= 3; $i++) {
					if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring') && $i > 0) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('year','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('month','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('week','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('day','service-finder');
								break;
						}
					}
					$packageprice = (isset($service_finder_options['package'.$i.'-price']) && $i > 0) ? $service_finder_options['package'.$i.'-price'] : '';
					$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
					$paymenttype = (!empty($service_finder_options['payment-type'])) ? $service_finder_options['payment-type'] : '';
					$packagename = (!empty($service_finder_options['package'.$i.'-name'])) ? $service_finder_options['package'.$i.'-name'] : '';
					
					$free = (trim($packageprice) == '0' || $i == 0) ? true : false;
					if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
					
					if($selectedpackage == 'package_'.esc_attr($i)){
					$select = 'selected="selected"';
					}else{
					$select = '';
					}
					
						$html .= '<option '.$select.' value="package_'.esc_attr($i).'"'; 
						if($free) { $html .= ' class="free"'; } $html .= '>'.$packagename;
						if(!$free) {
							if (isset($service_finder_options['payment-type']) && ($paymenttype == 'recurring')) {
								$html .= ' - '.trim($packageprice).' '.$currency.' '.esc_html__('per','service-finder').' '.$billingPeriod;
							} else {
								$html .= ' ('.$packageprice.' '.service_finder_currencysymbol().')';
							}
						} 
						$html .= '</option>';
					}
				}		

return $html;
}

/*Get Packages for claim business*/
function service_finder_claimed_getPackages($selectedpackage = ''){
global $wpdb, $service_finder_Tables, $service_finder_options;
$html = '';
$currency = service_finder_currencycode();
for ($i=1; $i <= 3; $i++) {
					if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('year','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('month','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('week','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('day','service-finder');
								break;
						}
					}
					$packageprice = (isset($service_finder_options['package'.$i.'-price']) && $i > 0) ? $service_finder_options['package'.$i.'-price'] : '';
					$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
					$paymenttype = (!empty($service_finder_options['payment-type'])) ? $service_finder_options['payment-type'] : '';
					$packagename = (!empty($service_finder_options['package'.$i.'-name'])) ? $service_finder_options['package'.$i.'-name'] : '';
					
					$free = (trim($packageprice) == '0') ? true : false;
					if(isset($service_finder_options['enable-package'.$i])){
					
					if($selectedpackage == 'package_'.esc_attr($i)){
					$select = 'selected="selected"';
					}else{
					$select = '';
					}
					
						$html .= '<option '.$select.' value="package_'.esc_attr($i).'"'; 
						if($free) { $html .= ' class="free"'; } $html .= '>'.$packagename;
						if(!$free) {
							if (isset($service_finder_options['payment-type']) && ($paymenttype == 'recurring')) {
								$html .= ' - '.trim($packageprice).' '.$currency.' '.esc_html__('per','service-finder').' '.$billingPeriod;
							} else {
								$html .= ' ('.$packageprice.' '.service_finder_currencysymbol().')';
							}
						} 
						$html .= '</option>';
					}
				}		

return $html;
}

/*Check Provider Capability by package*/
function service_finder_get_capability($uid){
global $wpdb, $service_finder_options;
$package = get_user_meta($uid,'provider_role',true);
$userCap = array();
$packageNum = intval(substr($package, 8));
if($package != ''){
$cap = (!empty($service_finder_options['package'.$packageNum.'-capabilities'])) ? $service_finder_options['package'.$packageNum.'-capabilities'] : '';
$subcap = (!empty($service_finder_options['package'.$packageNum.'-subcapabilities'])) ? $service_finder_options['package'.$packageNum.'-subcapabilities'] : '';
	if(!empty($cap['booking'])){
	if($cap['booking']){
		$userCap[] = 'bookings';	
	}
	}
	if(!empty($cap['cover-image'])){
	if($cap['cover-image']){
		$userCap[] = 'cover-image';	
	}
	}
	if(!empty($cap['gallery-images'])){
	if($cap['gallery-images']){
		$userCap[] = 'gallery-images';	
	}
	}
	if(!empty($cap['multiple-categories'])){
	if($cap['multiple-categories']){
		$userCap[] = 'multiple-categories';	
	}
	}
	if(!empty($cap['apply-for-job'])){
	if($cap['apply-for-job']){
		$userCap[] = 'apply-for-job';	
	}
	}
	if(!empty($cap['job-alerts'])){
	if($cap['job-alerts']){
		$userCap[] = 'job-alerts';	
	}
	}
	if(!empty($cap['branches'])){
	if($cap['branches']){
		$userCap[] = 'branches';	
	}
	}
	if(!empty($cap['google-calendar'])){
	if($cap['google-calendar']){
		$userCap[] = 'google-calendar';	
	}
	}
	if(!empty($subcap)){
		foreach($subcap as $key => $val){
			if($val){
				$userCap[] = $key;	
			}
		}
	}
}	

return $userCap;
}

/*Delete Provider's Data when delete user*/
function service_finder_deleteProvidersData($user_id){
global $wpdb, $service_finder_Tables;
/*Delete Providers*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$user_id));

/*Delete User Attchments*/
$galleryattchments = service_finder_getProviderAttachments($user_id,'gallery');
foreach($galleryattchments as $galleryattchment){
wp_delete_attachment( $galleryattchment->attachmentid, true );
}
$galleryattchments = service_finder_getProviderAttachments($user_id,'file');
foreach($galleryattchments as $galleryattchment){
wp_delete_attachment( $galleryattchment->attachmentid, true );
}
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->attachments.' WHERE wp_user_id = %d',$user_id));

/*Delete providers bookings*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->bookings.' WHERE provider_id = %d',$user_id));

/*If user is customer then delete customer data from customer table*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->customers_data.' WHERE wp_user_id = %d',$user_id));
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->customers.' WHERE wp_user_id = %d',$user_id));

/*Delete Providers Feedback*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->feedback.' WHERE provider_id = %d',$user_id));

/*Delete Providers Invoice Generated*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->invoice.' WHERE provider_id = %d',$user_id));

/*Delete Providers Services*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->services.' WHERE wp_user_id = %d',$user_id));

/*Delete Providers Service Area*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->service_area.' WHERE provider_id = %d',$user_id));

/*Delete Providers Team Members*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->team_members.' WHERE admin_wp_id = %d',$user_id));

/*Delete Providers Timeslot*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->timeslots.' WHERE provider_id = %d',$user_id));

/*Delete Providers UnAvailability*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->unavailability.' WHERE provider_id = %d',$user_id));

/*Delete Feature Providers*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->feature.' WHERE provider_id = %d',$user_id));

/*Delete Providers from favorite*/
$wpdb->query($wpdb->prepare('DELETE FROM '.$service_finder_Tables->favorites.' WHERE provider_id = %d',$user_id));

}

/*Get Author's Link by Author ID*/
function service_finder_get_author_url($author_id, $author_nicename = '') {

	$link = get_author_posts_url($author_id);

	$link = apply_filters('author_link', $link, $author_id, $author_nicename);

	return $link;
}

/*Get Author's Link For Invoce Payment*/
function service_finder_get_invoice_author_url($author_id, $author_nicename = '',$invoice_id) {

	if(get_option('permalink_structure')){
		$link = get_author_posts_url($author_id).'?invoiceid='.service_finder_encrypt($invoice_id, 'Developer#@)!%').'#invoiceview';
	}else{
		$link = get_author_posts_url($author_id).'&invoiceid='.service_finder_encrypt($invoice_id, 'Developer#@)!%').'#invoiceview';
	}

	$link = apply_filters('author_link', $link, $author_id, $author_nicename);

	return $link;
}

// To Get attachment image ID By Image Link
function service_finder_get_image_id_by_link($link)
{
    global $wpdb;

    $newlink = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);

    $imageid = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s'",$newlink));
 if(empty($imageid)){$imageid = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE guid='%s'",$link));}
 return $imageid;
}

/*Encrypt Qyery String*/
function service_finder_encrypt($id, $key)
{
    $id = base_convert($id, 10, 36); // Save some space
    $data = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $id, 'ecb');
    $data = bin2hex($data);

    return $data;
}

/*Decrypt Qyery String*/
function service_finder_decrypt($encrypted_id, $key)
{
    $data = pack('H*', $encrypted_id); // Translate back to binary
    $data = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, 'ecb');
    $data = base_convert($data, 36, 10);

    return $data;
}

/*Mailing Function*/
function service_finder_wpmailer($to,$subject,$message){
global $service_finder_options, $wp_filesystem;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }
	add_filter('wp_mail_content_type', 'service_finder_set_html_content_type');

	$emaillogo = (!empty($service_finder_options['email-logo']['url'])) ? $service_finder_options['email-logo']['url'] : '';
	
	$sitelogo = (!empty($service_finder_options['site-logo']['url'])) ? $service_finder_options['site-logo']['url'] : '';
	
	if($emaillogo != ""){
		$logo = '<img src="'.$emaillogo.'" style="max-width:100%; height:auto; display:block; margin:10px 0 20px;">';
	}elseif($sitelogo != ""){
		$logo = '<img src="'.$sitelogo.'" style="max-width:100%; height:auto; display:block; margin:10px 0 20px;">';
	}else{ 
		$logo = '';
	}

	$link_color = (!empty($service_finder_options['link-color'])) ? $service_finder_options['link-color'] : '#56C477';

	$template = $wp_filesystem->get_contents(SERVICE_FINDER_BOOKING_TEMPLATES_DIR.'/default.html', true);
	
	if(is_rtl()){  
	$dir = 'rtl';
	}else{
	$dir = 'ltr';
	}
	
	$filter = array('%SITELOGO%','%MAILBODY%','%LINKCOLOR%','%CHARSET%','%DIRECTION%');
	$replace = array($logo,wpautop($message),$link_color,get_bloginfo( 'charset' ),$dir);
	$headers = array('Content-Type: text/html; charset='.get_bloginfo( 'charset' ));
	$message = str_replace($filter, $replace, $template);

	if(wp_mail($to,$subject,$message,$headers)){
	return true;
	}else{
	return false;
	}
	
	remove_filter('wp_mail_content_type','service_finder_set_html_content_type');

}

/*Set content type for mail function*/
function service_finder_set_html_content_type() {
	return 'text/html';
}

/*Get page url by shortcode call withing that page*/
function service_finder_get_url_by_shortcode($shortcode) {
	global $wpdb;

	$url = '';

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($id = $wpdb->get_var($sql)) {
		$url = get_permalink($id);
	}

	return $url;
}

/*Get page id by shortcode call withing that page*/
function service_finder_get_id_by_shortcode($shortcode) {
	global $wpdb;

	$url = '';
	$pageids = array();

	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($results = $wpdb->get_results($sql)) {
		foreach($results as $res){
			$pageids[] = $res->ID;
		}
	}
	return $pageids;

	
}

/*Get User avatar id by its user id*/
function service_finder_getUserAvatarID($userid){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$userid));
if(!empty($row)){
return $row->avatar_id;
}else{
return '';
}
}

/*Get User avatar id by its user id*/
function service_finder_getCustomerAvatarID($userid){
global $wpdb,$service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$userid));
if(!empty($row)){
return $row->avatar_id;
}else{
return '';
}
}

/*Get Total number of providers*/
function service_finder_totalProviders(){
global $wpdb,$service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes"');
}else{
$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes"');
}
if(!empty($res)){
	return count($res);
}else{
	return 0;
}
}

/*Get Total number of customers*/
function service_finder_totalCustomers(){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->customers_data);

if(!empty($res)){
	return count($res);
}else{
	return 0;
}
}

/*Get feature providers*/
function service_finder_getFeaturedProviders($limit = 3,$categoryid = 0){
global $wpdb,$service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';

if($restrictuserarea && $identitycheck){
if($categoryid > 0){
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE FIND_IN_SET("'.$categoryid.'", provider.category_id) AND identity = "approved" AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}else{
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE identity = "approved" AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}
}else{
if($categoryid > 0){
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE FIND_IN_SET("'.$categoryid.'", provider.category_id) AND featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}else{
$providers = $wpdb->get_results($wpdb->prepare('SELECT featured.id, provider.full_name, provider.phone, provider.mobile, provider.avatar_id, provider.bio, provider.category_id, featured.provider_id, featured.amount, featured.days, featured.status FROM '.$service_finder_Tables->feature.' as featured INNER JOIN '.$service_finder_Tables->providers.' as provider on featured.provider_id = provider.wp_user_id WHERE featured.feature_status = "active" AND (featured.status = "Paid" OR featured.status = "Free") ORDER BY RAND() limit 0,%d',$limit));
}
}

return $providers;

}

/*Get currecy code*/
if ( !function_exists( 'service_finder_currencycode' ) ){
function service_finder_currencycode(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';
return $currency;
}
}

/*Get currecy symbol*/
if ( !function_exists( 'service_finder_currencysymbol' ) ){
function service_finder_currencysymbol(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';

switch ( $currency ) {
		case 'ARS' :
			$currency_symbol = '&#36;';
			break;
		case 'PEN' :
			$currency_symbol = 'Sol';
			break;	
		case 'AED' :
			$currency_symbol = '';
			break;
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'COP' :
		case 'MXN' :
		case 'NZD' :
		case 'HKD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'CNY' :
		case 'RMB' :
		case 'JPY' :
			$currency_symbol = '&yen;';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'KRW' : $currency_symbol = '&#8361;'; break;
        case 'PYG' : $currency_symbol = '&#8370;'; break;
		case 'TRY' : $currency_symbol = '&#8378;'; break;
		case 'NOK' : $currency_symbol = '&#107;&#114;'; break;
		case 'ZAR' : $currency_symbol = '&#82;'; break;
		case 'CZK' : $currency_symbol = '&#75;&#269;'; break;
		case 'MYR' : $currency_symbol = '&#82;&#77;'; break;
		case 'DKK' : $currency_symbol = 'kr.'; break;
		case 'HUF' : $currency_symbol = '&#70;&#116;'; break;
		case 'IDR' : $currency_symbol = 'Rp'; break;
		case 'INR' : $currency_symbol = 'Rs.'; break;
		case 'NPR' : $currency_symbol = 'Rs.'; break;
		case 'ISK' : $currency_symbol = 'Kr.'; break;
		case 'ILS' : $currency_symbol = '&#8362;'; break;
		case 'PHP' : $currency_symbol = '&#8369;'; break;
		case 'PLN' : $currency_symbol = '&#122;&#322;'; break;
		case 'SEK' : $currency_symbol = '&#107;&#114;'; break;
		case 'CHF' : $currency_symbol = '&#67;&#72;&#70;'; break;
		case 'TWD' : $currency_symbol = '&#78;&#84;&#36;'; break;
		case 'THB' : $currency_symbol = '&#3647;'; break;
		case 'GBP' : $currency_symbol = '&pound;'; break;
		case 'RON' : $currency_symbol = 'lei'; break;
		case 'VND' : $currency_symbol = '&#8363;'; break;
		case 'NGN' : $currency_symbol = '&#8358;'; break;
		case 'HRK' : $currency_symbol = 'Kn'; break;
		case 'EGP' : $currency_symbol = 'EGP'; break;
		case 'DOP' : $currency_symbol = 'RD&#36;'; break;
		case 'KIP' : $currency_symbol = '&#8365;'; break;
		case 'MAD' : $currency_symbol = '&#x2e;&#x62f;&#x2e;&#x645;'; break;
		case 'XOF' : $currency_symbol = 'FCFA'; break;
		case 'SAR' : $currency_symbol = 'SAR'; break;
		case 'KSH' : $currency_symbol = 'Ksh'; break;
		default    : $currency_symbol = ''; break;
	}


return $currency_symbol;
}
}

/*Display rating*/
function service_finder_displayRating($rating){
global $service_finder_options;
if($rating > 0){
$rating = $rating;
}else{
$rating = 0;
}
	if($service_finder_options['review-system']){
	return '<div class="sf-show-rating default-hidden"><input class="display-ratings" value="'.esc_attr($rating).'" type="number" min=0 max=5 step=0.5 data-size="sm" disabled="disabled"></div>';
	}else{
	return '';
	}
}

/*Get average rating*/
function service_finder_getAverageRating($providerid){
global $wpdb,$service_finder_Tables,$service_finder_options;

	if($service_finder_options['review-style'] == 'booking-review'){
		$res = $wpdb->get_row($wpdb->prepare('SELECT rating FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$providerid));
		return $res->rating;
	}elseif($service_finder_options['review-style'] == 'open-review'){
		$comment_postid = get_user_meta($providerid,'comment_post',true);
		$comment_rating = 0;
		$avg_rating = 0;
		
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'comments WHERE `comment_approved` = 1 AND `comment_post_ID` = %d',$comment_postid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $result){
			$comment_id = $result->comment_ID;
				$row = $wpdb->get_row($wpdb->prepare('SELECT `meta_value` FROM '.$wpdb->prefix.'commentmeta WHERE `comment_id` = %d AND `meta_key` = "pixrating"',$comment_id));
				if(!empty($row)){
					$comment_rating = $comment_rating + $row->meta_value;
				}
			}
			$avg_rating = $comment_rating/$total_comments;
		}
		
		return $avg_rating;
	}

}

/*Get average rating*/
function service_finder_number_of_stars($providerid){
global $wpdb,$service_finder_Tables,$service_finder_options;
	$onestar = 0;
	$twostar = 0;
	$threestar = 0;
	$fourstar = 0;
	$fivestar = 0;
	if($service_finder_options['review-style'] == 'booking-review'){
		$allreviews = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' where provider_id = %d',$providerid));
		if(!empty($allreviews)){
			foreach($allreviews as $rev){
				if(floatval($rev->rating) > 0 && floatval($rev->rating) < 1.5){
					$onestar = $onestar + 1;
				}elseif(floatval($rev->rating) >= 1.5 && floatval($rev->rating) < 2.5){
					$twostar = $twostar + 1;
				}elseif(floatval($rev->rating) >= 2.5 && floatval($rev->rating) < 3.5){
					$threestar = $threestar + 1;
				}elseif(floatval($rev->rating) >= 3.5 && floatval($rev->rating) < 4.5){
					$fourstar = $fourstar + 1;
				}elseif(floatval($rev->rating) >= 4.5 && floatval($rev->rating) <= 5){
					$fivestar = $fivestar + 1;
				}
			}
		}
	}elseif($service_finder_options['review-style'] == 'open-review'){
		$comment_postid = get_user_meta($providerid,'comment_post',true);
		$comment_rating = 0;
		$results = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$wpdb->prefix.'comments WHERE `comment_approved` = 1 AND `comment_post_ID` = %d',$comment_postid));
		$total_comments = count($results);
		if(!empty($results)){
			foreach($results as $result){
			$comment_id = $result->comment_ID;
				$row = $wpdb->get_row($wpdb->prepare('SELECT `meta_value` FROM '.$wpdb->prefix.'commentmeta WHERE `comment_id` = %d AND `meta_key` = "pixrating"',$comment_id));
				if(!empty($row)){
					if(floatval($row->meta_value) > 0 && floatval($row->meta_value) < 1.5){
						$onestar = $onestar + 1;
					}elseif(floatval($row->meta_value) >= 1.5 && floatval($row->meta_value) < 2.5){
						$twostar = $twostar + 1;
					}elseif(floatval($row->meta_value) >= 2.5 && floatval($row->meta_value) < 3.5){
						$threestar = $threestar + 1;
					}elseif(floatval($row->meta_value) >= 3.5 && floatval($row->meta_value) < 4.5){
						$fourstar = $fourstar + 1;
					}elseif(floatval($row->meta_value) >= 4.5 && floatval($row->meta_value) <= 5){
						$fivestar = $fivestar + 1;
					}
				}
			}
		}
	}
	
	return array(
			'1' => $onestar,
			'2' => $twostar,
			'3' => $threestar,
			'4' => $fourstar,
			'5' => $fivestar,
		);

}

/*Get member average rating*/
function service_finder_getMemberAverageRating($memberid){
global $wpdb,$service_finder_Tables;

$res = $wpdb->get_row($wpdb->prepare('SELECT rating FROM '.$service_finder_Tables->team_members.' WHERE `id` = %d',$memberid));

return $res->rating;
}

/*Get provider name by id*/
function service_finder_getProviderName($providerid){
global $wpdb,$service_finder_Tables;

$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT company_name,full_name FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));

if(!empty($sedateProvider)){
if($sedateProvider->company_name != ""){
$providername = $sedateProvider->company_name;
}else{
$providername = $sedateProvider->full_name;
}
return $providername;
}else{
return '';
}



}

/*Get provider name by id*/
function service_finder_getCompanyName($providerid){
global $wpdb,$service_finder_Tables;

$sedateProvider = $wpdb->get_row($wpdb->prepare('SELECT company_name FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));
if(!empty($sedateProvider)){
return $sedateProvider->company_name;
}

}

/*Get provider category by user id*/
function service_finder_getProviderCategory($providerid){
global $wpdb,$service_finder_Tables;

if($providerid > 0){
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where wp_user_id = %d',$providerid));
return $res->category_id;
}else{
return '';
}

}

/*Get Total Number of Providers in Particular Category*/
function service_finder_getTotalProvidersByCategory($catid){
global $wpdb, $service_finder_Tables, $service_finder_options;
$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictuserarea = (isset($service_finder_options['restrict-user-area'])) ? esc_attr($service_finder_options['restrict-user-area']) : '';
if($restrictuserarea && $identitycheck){
$sql = 'SELECT count(*) as total FROM '.$service_finder_Tables->providers.' where admin_moderation = "approved" AND identity = "approved" AND account_blocked != "yes" AND';
}else{
$sql = 'SELECT count(*) as total FROM '.$service_finder_Tables->providers.' where admin_moderation = "approved" AND account_blocked != "yes" AND';
}



$texonomy = 'providers-category';
$term_children = get_term_children($catid,$texonomy);

if(!empty($term_children)){
$sql .= ' (';
	foreach($term_children as $term_child_id) {
		
		$sql .= ' FIND_IN_SET("'.$term_child_id.'", category_id) OR ';
		
	}
$sql .= ' FIND_IN_SET("'.$catid.'", category_id) ';	
$sql .= ' )';	
	
}else{

$sql .= ' FIND_IN_SET("'.$catid.'", category_id)';

}

$res = $wpdb->get_row($sql);

return $res->total;

}

function service_finder_showBusinessHours($pid){
global $wpdb,$service_finder_Tables,$service_finder_options;
$currUser = wp_get_current_user();
$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
$days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');
$shortdays = array('MON','TUE','WED','THU','FRI','SAT','SUN');
$flag = 0;
$html = '';
$html .= '<table class="sf-business-hours table table-bordered">
    <thead>
        <tr>';
            foreach($shortdays as $day){
			
			switch($day){
			case 'MON':
				$dayname = esc_html__('Mon','service-finder');
				break;
			case 'TUE':
				$dayname = esc_html__('Tue','service-finder');
				break;
			case 'WED':
				$dayname = esc_html__('Wed','service-finder');
				break;
			case 'THU':
				$dayname = esc_html__('Thu','service-finder');
				break;
			case 'FRI':
				$dayname = esc_html__('Fri','service-finder');
				break;
			case 'SAT':
				$dayname = esc_html__('Sat','service-finder');
				break;
			case 'SUN':
				$dayname = esc_html__('Sun','service-finder');
				break;						
			}
			
			$html .= '<th>'.strtoupper($dayname).'</th>';
			}
$html .= '</tr>
    </thead>
    <tbody>
        <tr>';
            foreach($days as $day){
				$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->business_hours.' where day = "%s" AND provider_id = %d',$day,$pid));		
				if(!empty($row)){
				$flag = 1;
					if($row->offday == 'yes'){
						$html .= '<td class="sf-closed-day">'.esc_html__('Closed','service-finder').'</td>';
					}else{
						
						if($time_format){
							$starttime = date('H:i',strtotime(esc_html($row->from_time)));
							$endtime = date('H:i',strtotime(esc_html($row->to_time)));
						}else{
							$starttime = date('h:i a',strtotime(esc_html($row->from_time)));
							$endtime = date('h:i a',strtotime(esc_html($row->to_time)));
						}
						
						$html .= '<td class="other-day">
								<span class="from">'.$starttime.'</span>
								<span class="sf-to">'.esc_html__('to','service-finder').'</span>
								<span class="to">'.$endtime.'</span>
							</td>';
					}
				}else{
					$html .= '<td class="other-day">-</td>';
				}
			}
$html .= '</tr>
    </tbody>
</table>';
if($flag == 1){
return $html; 	
}else{
return false;
}
}

/*Get Stripe Public Key via AJax for Provider*/
add_action('wp_ajax_get_stripekey', 'service_finder_get_stripekey');
add_action('wp_ajax_nopriv_get_stripekey', 'service_finder_get_stripekey');

function service_finder_get_stripekey(){
global $service_finder_options;

$settings = service_finder_getProviderSettings($_POST['provider_id']);

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){
	$stripetype = (!empty($service_finder_options['stripe-type'])) ? esc_html($service_finder_options['stripe-type']) : '';
	if($stripetype == 'live'){
		$stripepublickey = (!empty($service_finder_options['stripe-live-public-key'])) ? esc_html($service_finder_options['stripe-live-public-key']) : '';
	}else{
		$stripepublickey = (!empty($service_finder_options['stripe-test-public-key'])) ? esc_html($service_finder_options['stripe-test-public-key']) : '';
	}
}elseif($pay_booking_amount_to == 'provider'){
	$stripepublickey = esc_html($settings['stripepublickey']);
}

echo esc_html($stripepublickey);
exit;
}

/*Get Stripe Public Key via AJax for Admin*/
add_action('wp_ajax_get_adminstripekey', 'service_finder_get_adminstripekey');
add_action('wp_ajax_nopriv_get_adminstripekey', 'service_finder_get_adminstripekey');

function service_finder_get_adminstripekey(){
global $service_finder_options;
if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
	$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
}else{
	$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
}


$success = array(
			'status' => 'success',
			'secret_key' => $secret_key,
			'public_key' => $public_key,
			);
echo json_encode($success);	

exit;
}

function service_finder_getExcerpts($str,$start,$end){
if(strlen($str) > $end) {
	$s = substr(strip_tags(wpautop($str)), $start, $end);
	$result = substr($s, 0, strrpos($s, ' '));
	if($result != ""){
	return stripcslashes($result).' [...]';
	}else{
	return stripcslashes($result);
	}
}else{
	return stripcslashes($str);
}	
}

function service_finder_getHours($val){
global $service_finder_options;
for($i = 0; $i < 24; $i++):

$tem = ''; 
if($val != ""){
$tem = explode(':',$val);
}
$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';
if($time_format){ 
if(!empty($tem)){
?>
	<option <?php echo ($tem[0] == $i && $tem[1] == 00) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:00"><?php echo esc_attr($i); ?>:00</option>
    <option <?php echo ($tem[0] == $i && $tem[1] == 30) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:30"><?php echo esc_attr($i); ?>:30</option>
    
<?php    
}else{
?>
	<option value="<?php echo esc_attr($i); ?>:00"><?php echo esc_attr($i); ?>:00</option>
    <option value="<?php echo esc_attr($i); ?>:30"><?php echo esc_attr($i); ?>:30</option>
<?php
}
}else{ 
if(!empty($tem)){
?>
<option <?php echo ($tem[0] == $i && $tem[1] == 00) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:00"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:00 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<option <?php echo ($tem[0] == $i && $tem[1] == 30) ? 'selected="selected"' : ''; ?> value="<?php echo esc_attr($i); ?>:30"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:30 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<?php
}else{
?>
<option value="<?php echo esc_attr($i); ?>:00"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:00 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<option value="<?php echo esc_attr($i); ?>:30"><?php echo ($i % 12) ? esc_attr($i) % 12 : 12 ?>:30 <?php echo ($i >= 12) ? 'PM' : 'AM' ?></option>
<?php
}
}
endfor;
}

function service_finder_getAddress($userid){

global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
$address = $res->address;
$city = $res->city;
$state = $res->state;
$country = $res->country;

$state = (!empty($res->state)) ? ', '.esc_html($res->state) : '';
		
$fulladdress = $address.', '.$city.$state.', '.$country;

return $fulladdress;
}else{
return '';
}

}

/*Get provider short address*/
function service_finder_getshortAddress($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
$address = '';
$address .= ' '.$res->city.',';
$address .= ' '.$res->country;
return $address;
}else{
return '';
}
}

/*Get avatar id by user id*/
function service_finder_getAvatarID($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT avatar_id FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->avatar_id;
}else{
return 0;
}
}

/*Get provider email*/
function service_finder_getProviderEmail($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT email FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->email;
}else{
return '';
}
}

/*Get booking xustomer name*/
function service_finder_getBookingCustomerName($bcid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT name FROM '.$service_finder_Tables->customers.' WHERE id = %d',$bcid));
if(!empty($res)){
return $res->name;
}else{
return '';
}
}

/*Check if provider is featured*/
function service_finder_is_featured($pid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feature.' WHERE (`feature_status` = "active" AND (`status` = "Paid" OR `status` = "Free")) AND `provider_id` = %d',$pid));
if(!empty($res)){
return true;
}else{
return false;
}
}

/*Check provider is blocked or not*/
function service_finder_is_blocked($userid){
global $wpdb,$service_finder_Tables;
$res = $wpdb->get_row($wpdb->prepare('SELECT account_blocked FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$userid));
if(!empty($res)){
return $res->account_blocked;
}else{
return '';
}
}

/*Ajax Pagination for load search results*/	
add_action( 'wp_ajax_load-search-result', 'service_finder_load_search_result' );
add_action( 'wp_ajax_nopriv_load-search-result', 'service_finder_load_search_result' );

function service_finder_load_search_result() {
   
   global $service_finder_ThemeParams, $wpdb, $service_finder_options, $service_finder_Tables;

    if($_POST['page'] != ""){
	$page = sanitize_text_field($_POST['page']);
	}else{
	$page = 1;
	}
	$cur_page = $page;
	$page -= 1;
	if($_POST['numberofpages'] != ""){
	$per_page = $_POST['numberofpages'];
	}else{
	$srhperpage = (!empty($service_finder_options['srh-per-page'])) ? $service_finder_options['srh-per-page'] : '';
	$per_page = ($srhperpage > 0) ? $service_finder_options['srh-per-page'] : 12;
	}
	
	if($_POST['setorderby'] != ""){
	$orderby = $_POST['setorderby'];
	}else{
	$orderby = 'id';
	}
	
	if($_POST['setorder'] != ""){
	$order = $_POST['setorder'];
	}else{
	$order = 'desc';
	}
	
	$previous_btn = true;
	$next_btn = true;
	$first_btn = true;
	$last_btn = true;
	$start = $page * $per_page;
	
	$keyword = (isset($_POST['keyword'])) ? $_POST['keyword'] : '';
	$address = (isset($_POST['address'])) ? $_POST['address'] : '';
	$city = (isset($_POST['city'])) ? $_POST['city'] : '';
	$catid = (isset($_POST['catid'])) ? $_POST['catid'] : '';
	$country = (isset($_POST['country'])) ? $_POST['country'] : '';
	$minprice = (isset($_POST['minprice'])) ? esc_html($_POST['minprice']) : '';
	$maxprice = (isset($_POST['maxprice'])) ? esc_html($_POST['maxprice']) : '';
   
    
	
	$distance = (isset($_POST['distance'])) ? $_POST['distance'] : '';
	
   $getProviders = new SERVICE_FINDER_searchProviders();
	
   $providersInfoArr = $getProviders->service_finder_getSearchedProviders($distance,$minprice,$maxprice,esc_attr($keyword),esc_attr($address),esc_attr($city),esc_attr($catid),esc_attr($country),$start,$per_page,$orderby,$order);
   
   $providersInfo = $providersInfoArr['srhResult'];
   $count = $providersInfoArr['count'];
   $msg = '';
	
	$markers = '';
	$flag = 0;
	if(!empty($providersInfo)){ 
		if($service_finder_options['search-template'] == 'style-1'){
			if($_POST['viewtype'] == 'listview'){
			$msg .= '<div class="listing-box row">';
			}elseif($_POST['viewtype'] == 'grid-4'){
			$msg .= '<div class="listing-grid-box sf-listing-grid-4 equal-col-outer">
							<div class="row">';
			}elseif($_POST['viewtype'] == 'grid-3'){
			$msg .= '<div class="listing-grid-box sf-listing-grid-3 equal-col-outer">
							<div class="row">';
			}else{
			$msg .= '<div class="listing-grid-box sf-listing-grid-4 equal-col-outer">
							<div class="row">';
			}
		}elseif($service_finder_options['search-template'] == 'style-2'){
			if($_POST['viewtype'] == 'listview'){
			$msg .= '<div class="listing-box row">';
			}else{
			$msg .= '<div class="listing-grid-box sf-listing-grid-2 equal-col-outer">
							<div class="row">';
			}
		}
	foreach($providersInfo as $provider){

	$userLink = service_finder_get_author_url($provider->wp_user_id);
	
	$services = '';
	if($keyword != "" || ($minprice != "" && $maxprice != "" && $maxprice > 0)){
	$services = service_finder_get_searched_services($provider->wp_user_id,$keyword,$minprice,$maxprice);

    $searchedservices = '';
	if(!empty($services)){
		$searchedservices .= '<ul class="sf-service-price-list">';
		foreach($services as $service){
			$searchedservices .= '<li><span>'.service_finder_money_format(esc_html($service->cost)).'</span> '.esc_html($service->service_name).'</li>';
		}
		$searchedservices .= '</ul>';
	}
	
	}

	if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
		$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-provider-thumb' );
		$src  = $src[0];
	}else{
		$src  = service_finder_get_default_avatar();
	}
	
	$procatid = get_user_meta($provider->wp_user_id,'primary_category',true);
	
	$icon = service_finder_getCategoryIcon($procatid);
	
	if($icon == ""){
	$imagepath = SERVICE_FINDER_BOOKING_IMAGE_URL.'/markers';
	$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
	}
	
	$markeraddress = service_finder_getAddress($provider->wp_user_id);

	$companyname = service_finder_getCompanyName($provider->wp_user_id);
	$companyname = str_replace(array("\n", "\r"), ' ', $companyname);
	$companyname = preg_replace('/\t+/', '', $companyname);
	
	$full_name = str_replace(array("\n", "\r"), ' ', $provider->full_name);
	$full_name = preg_replace('/\t+/', '', $full_name);
	
	$markeraddress = str_replace(array("\n", "\r"), ' ', $markeraddress);
	$markeraddress = str_replace('\t', '', $markeraddress);
	
	$categorycolor = service_finder_getCategoryColor(get_user_meta($provider->wp_user_id,'primary_category',true));
	
	
	//Create the markers	
	$markers .= '["'.stripcslashes($full_name).'","'.$provider->lat.'","'.$provider->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$provider->wp_user_id.'","'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'","'.stripcslashes($markeraddress).'","'.stripcslashes($companyname).'","'.$categorycolor.'"],';
	
	$link = $userLink;
    $current_user = wp_get_current_user();         
	if(is_user_logged_in()){
		$myfav = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->favorites.' where user_id = %d AND provider_id = %d',$current_user->ID,$provider->wp_user_id));
		
		if(!empty($myfav)){
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="remove-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="remove-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'My Favorite', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}else{
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="add-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="add-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}
	}else{
		if(service_finder_themestyle() == 'style-2'){
		$addtofavorite = '<a class="sf-featured-item" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a class="btn btn-primary" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
	}  

	if(service_finder_is_featured($provider->wp_user_id)){
	if(service_finder_themestyle() == 'style-2'){
	$featured = '<div  class="sf-featured-sign">'.esc_html__( 'Featured', 'service-finder' ).'</div>';
	}else{
	$featured = '<strong class="sf-featured-label"><span>'.esc_html__( 'Featured', 'service-finder' ).'</span></strong>';
	}
	}else{
	$featured = '';
	}
	
	if($service_finder_options['search-template'] == 'style-1'){
	$addressbox = '';
	$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
	  if($showaddressinfo && $service_finder_options['show-postal-address'] && service_finder_check_address_info_access()){
			if(service_finder_themestyle() == 'style-2'){
			$addressbox = service_finder_getshortAddress($provider->wp_user_id);			
			}else{
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
			}					
		}
		
			/*Start Search Style 1*/
			if($_POST['viewtype'] == 'grid-4'){
			/*4 grid layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			}else{
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
                           <div class="overlay-bx">
								'.$addressbox.'
						   </div>
                            
                           <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
						   '.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';	
			}
            
			}elseif($_POST['viewtype'] == 'listview'){
			/*listview layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="sf-featured-listing clearfix">
                            
                            <div class="sf-featured-left" id="proid-'.$provider->wp_user_id.'">
                                <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
								<a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                <div class="sf-overlay-box"></div>
                                <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                                '.$addtofavorite.'
                                
                                <div class="sf-featured-info">
                                    '.$featured.'
                                </div>
                            </div>
                            
                            <div class="sf-featured-right">
                                <div  class="sf-featured-provider"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></div>
                                <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                <div class="sf-featured-text">'.service_finder_getExcerpts($provider->bio,0,300).'</div>
                                '.$searchedservices.'
                                '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                            </div>
                            
                        </div>';
			}else{
			$msg .= '<div class="col-md-12">
                                <div class="sf-element-bx result-listing clearfix">
                                
                                    <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                        
                                        <div class="overlay-bx">
											'.$addressbox.'
										</div>
										
										<strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
										'.$featured.'
                                        '.service_finder_check_varified_icon($provider->wp_user_id).'
                                    </div>
                                    
                                    <div class="result-text '.service_finder_check_varified($provider->wp_user_id).'" id="proid-'.$provider->wp_user_id.'">
                                    	<h5 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h5>
										<strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
										'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
										
                                        <div class="sf-address2-bx">
											<i class="fa fa-map-marker"></i>
											'.service_finder_getshortAddress($provider->wp_user_id).'
										</div>
										<p>'.service_finder_getExcerpts($provider->bio,0,300).'</p>
                                        '.$addtofavorite.'
                                    </div>
                                    
                                </div>
                            </div>';
			}				
			}elseif($_POST['viewtype'] == 'grid-3'){
			
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
			/*3 grid layout*/            
		    $msg .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}else{
			/*4 grid layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			}else{
			$msg .= '<div class="col-md-3 col-sm-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
                           <div class="overlay-bx">
								'.$addressbox.'
						   </div>
                            
                           <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
						   '.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';	
			}
            
			}
			/*End Search Style 1*/
	}elseif($service_finder_options['search-template'] == 'style-2'){
	/*Start Search Style 2*/
	
	$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
	$addressbox = '';
	  if($showaddressinfo && $service_finder_options['show-postal-address'] && service_finder_check_address_info_access()){
			if(service_finder_themestyle() == 'style-2'){
			$addressbox = service_finder_getshortAddress($provider->wp_user_id);			
			}else{
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
			}					
		}
			if($_POST['viewtype'] == 'grid-2'){
			/*Grid 2 Layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
            $msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}elseif($_POST['viewtype'] == 'listview'){
			/*Listview layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="sf-featured-listing clearfix">
                            
                            <div class="sf-featured-left" id="proid-'.$provider->wp_user_id.'">
                                <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
								<a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                <div class="sf-overlay-box"></div>
                                <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                                '.$addtofavorite.'
                                
                                <div class="sf-featured-info">
                                    '.$featured.'
                                </div>
                            </div>
                            
                            <div class="sf-featured-right">
                                <div  class="sf-featured-provider"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></div>
                                <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                <div class="sf-featured-text">'.service_finder_getExcerpts($provider->bio,0,300).'</div>
                                '.$searchedservices.'
                                '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                            </div>
                            
                        </div>';
			}else{
			$msg .= '<div class="col-md-12"><div class="sf-element-bx result-listing clearfix">
                        
                            <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                
								<div class="overlay-bx maphover" data-id="'.esc_attr($provider->wp_user_id).'">
									'.$addressbox.'
								</div>
								
								<strong class="sf-category-tag"><a href="'.service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true)).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
								'.$featured.'
                                '.service_finder_check_varified_icon($provider->wp_user_id).'
                            </div>
                            
                            <div class="result-text '.service_finder_check_varified($provider->wp_user_id).'" id="proid-'.$provider->wp_user_id.'">
                                <h5 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h5>
                                <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
								'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							    '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
								
                                <div class="sf-address2-bx">
									<i class="fa fa-map-marker"></i>
									'.service_finder_getshortAddress($provider->wp_user_id).'
								</div>
								<p>'.service_finder_getExcerpts($provider->bio,0,150).'</p>
                                '.$addtofavorite.'
								
                            </div>
                            
                        </div></div>';
			}			
			}else{
			/*Grid 2 Layout*/
			if(service_finder_themestyle() == 'style-2'){
			$msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			}else{
            $msg .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.service_finder_check_varified($provider->wp_user_id).'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
							'.service_finder_check_varified_icon($provider->wp_user_id).'
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}
	}		

     }
	 	if($_POST['viewtype'] == 'listview'){
		$msg .= '</div>';
		}else{
		$msg .= '</div>
                        </div>';
		}

	}else{
		/*No Result Found*/
		$msg .= '<div class="sf-nothing-found">
				<strong class="sf-tilte">'.esc_html__('Nothing Found', 'service-finder').'</strong>
					  <p>'.esc_html__('Apologies, but no results were found for the request.', 'service-finder').'</p>
				</div>';
		$flag = 1;
	}
	
	 // Optional, wrap the output into a container
        $msg = "<div class='cvf-universal-content'>" . $msg . "</div><br class = 'clear' />";
       
        // Ajax Pagination
        $no_of_paginations = ceil($count / $per_page);

        if ($cur_page >= 7) {
            $start_loop = $cur_page - 3;
            if ($no_of_paginations > $cur_page + 3)
                $end_loop = $cur_page + 3;
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
                $start_loop = $no_of_paginations - 6;
                $end_loop = $no_of_paginations;
            } else {
                $end_loop = $no_of_paginations;
            }
        } else {
            $start_loop = 1;
            if ($no_of_paginations > 7)
                $end_loop = 7;
            else
                $end_loop = $no_of_paginations;
        }
       
        // Pagination Buttons logic    
        $pag_container = "";
		$pag_container .= "
        <div class='cvf-universal-pagination pagination clearfix'>
            <ul class='pagination'>";

        if ($first_btn && $cur_page > 1) {
            $pag_container .= "<li data-pnum='1' class='activelink'><a href='javascript:;'><i class='fa fa-angle-double-left'></i></a></li>";
        } else if ($first_btn) {
            $pag_container .= "<li data-pnum='1' class='inactive'><a href='javascript:;'><i class='fa fa-angle-double-left'></i></a></li>";
        }

        if ($previous_btn && $cur_page > 1) {
            $pre = $cur_page - 1;
            $pag_container .= "<li data-pnum='$pre' class='activelink'><a href='javascript:;'><i class='fa fa-angle-left'></i></a></li>";
        } else if ($previous_btn) {
            $pag_container .= "<li class='inactive'><a href='javascript:;'><i class='fa fa-angle-left'></i></a></li>";
        }
        for ($i = $start_loop; $i <= $end_loop; $i++) {

            if ($cur_page == $i)
                $pag_container .= "<li data-pnum='$i' class = 'selected active' ><a href='javascript:;'>{$i}</a></li>";
            else
                $pag_container .= "<li data-pnum='$i' class='activelink'><a href='javascript:;'>{$i}</a></li>";
        }
       
        if ($next_btn && $cur_page < $no_of_paginations) {
            $nex = $cur_page + 1;
            $pag_container .= "<li data-pnum='$nex' class='activelink'><a href='javascript:;'><i class='fa fa-angle-right'></i></a></li>";
        } else if ($next_btn) {
            $pag_container .= "<li class='inactive'><a href='javascript:;'><i class='fa fa-angle-right'></i></a></li>";
        }

        if ($last_btn && $cur_page < $no_of_paginations) {
            $pag_container .= "<li data-pnum='$no_of_paginations' class='activelink'><a href='javascript:;'><i class='fa fa-angle-double-right'></i></a></li>";
        } else if ($last_btn) {
            $pag_container .= "<li data-pnum='$no_of_paginations' class='inactive'><a href='javascript:;'><i class='fa fa-angle-double-right'></i></a></li>";
        }

        $pag_container = $pag_container . "
            </ul>
        </div>";
       
	    if($flag == 1){
			$result = '<div class = "cvf-pagination-content">' . $msg . '</div>';
		}else{
	        $result = '<div class = "cvf-pagination-content">' . $msg . '</div>' .
    	    '<div class = "cvf-pagination-nav">' . $pag_container . '</div>';
		}
        
		
		
		
		$markers = rtrim($markers,',');
		$markers = '[ '.$markers.' ]';
		$resarr = array(
					'result' => $result,
					'markers' => $markers
				);
		
		echo json_encode($resarr);		
		
	
    exit();
}

/*Create plans for stripe*/
function service_finder_createPlans($data){
global $wpdb, $service_finder_Errors, $service_finder_options;

/*Start Stripe Plans*/
require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/Stripe.php');

if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
	$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
}else{
	$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
	$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
}

if($secret_key != ""){
Stripe::setApiKey($secret_key);

// retrieve all plans from stripe
$plans_data = Stripe_Plan::all();
// setup a blank array
$plans = array();
if($plans_data) {
	foreach($plans_data['data'] as $plan) {
		// store the plan ID as the array key and the plan name as the value
		$plans[] = $plan['id'];
	}
}

try {
		for ($i=1; $i <= 3; $i++) {
		$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
		if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
		
		if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = 'year';
								break;
							case 'Month':
								$billingPeriod = 'month';
								break;
							case 'Week':
								$billingPeriod = 'week';
								break;
							case 'Day':
								$billingPeriod = 'day';
								break;
						}
					
		
		$billingPrice = $service_finder_options['package'.$i.'-price'] * 100;
		$packageName = $service_finder_options['package'.$i.'-name'];
		$currencyCode = strtolower(service_finder_currencycode());
		$planID = 'package_'.$i;
		
		
		$free = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		
			if(!$free) {
			
			if(in_array($planID,$plans)){
			
			$p = Stripe_Plan::retrieve($planID);
				if($p->name != $packageName && $p->amount == $billingPrice && $p->interval == $billingPeriod && $p->currency == $currencyCode){
					$p->name = $packageName;
					$p->save();
				}elseif($p->amount != $billingPrice || $p->interval != $billingPeriod || $p->currency != $currencyCode){
					$p->delete();
					Stripe_Plan::create(array(
					  "amount" => $billingPrice,
					  "interval" => $billingPeriod,
					  "name" => $packageName,
					  "currency" => $currencyCode,
					  "id" => $planID)
					);
				}
			}else{
				Stripe_Plan::create(array(
					  "amount" => $billingPrice,
					  "interval" => $billingPeriod,
					  "name" => $packageName,
					  "currency" => $currencyCode,
					  "id" => $planID)
					);
			}	
			
			}
		}
		}
		}
		
		


} catch (Exception $e) {
	$body = $e->getJsonBody();
	$err  = $body['error'];

	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
			);
	$service_finder_Errors = json_encode($error);
}
}
/*End Stripe Plans*/

/*Start PayU Latam Plans*/
require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/payulatam/lib/PayU.php');
					
if( isset($service_finder_options['payulatam-type']) && $service_finder_options['payulatam-type'] == 'test' ){
	$testmode = true;
	$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-test'])) ? $service_finder_options['payulatam-merchantid-test'] : '';
	$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-test'])) ? $service_finder_options['payulatam-apilogin-test'] : '';
	$payulatamapikey = (isset($service_finder_options['payulatam-apikey-test'])) ? $service_finder_options['payulatam-apikey-test'] : '';
	$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-test'])) ? $service_finder_options['payulatam-accountid-test'] : '';
	
	$paymenturl = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
	$reportsurl = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
	$subscriptionurl = "https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
	
	$fullname = 'APPROVED';
	
}else{
	$testmode = false;
	$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-live'])) ? $service_finder_options['payulatam-merchantid-live'] : '';
	$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-live'])) ? $service_finder_options['payulatam-apilogin-live'] : '';
	$payulatamapikey = (isset($service_finder_options['payulatam-apikey-live'])) ? $service_finder_options['payulatam-apikey-live'] : '';
	$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-live'])) ? $service_finder_options['payulatam-accountid-live'] : '';
	
	$paymenturl = "https://api.payulatam.com/payments-api/4.0/service.cgi";
	$reportsurl = "https://api.payulatam.com/reports-api/4.0/service.cgi";
	$subscriptionurl = "https://api.payulatam.com/payments-api/rest/v4.3/";
	
	$fullname = $userdata->user_login;
}

$country = (isset($service_finder_options['payulatam-country'])) ? $service_finder_options['payulatam-country'] : '';

PayU::$apiKey = $payulatamapikey; //Enter your own apiKey here.
PayU::$apiLogin = $payulatamapilogin; //Enter your own apiLogin here.
PayU::$merchantId = $payulatammerchantid; //Enter your commerce Id here.
PayU::$language = SupportedLanguages::EN; //Select the language.
PayU::$isTest = $testmode; //Leave it True when testing.

// Payments URL
Environment::setPaymentsCustomUrl($paymenturl);
// Queries URL
Environment::setReportsCustomUrl($reportsurl);
// Subscriptions for recurring payments URL
Environment::setSubscriptionsCustomUrl($subscriptionurl);

if($payulatamapikey != "" && $payulatamapilogin != "" && $payulatammerchantid != "" && $payulatamaccountid != ""){

try {
	
	for ($i=1; $i <= 3; $i++) {
		$enablepackage = (!empty($service_finder_options['enable-package'.$i])) ? $service_finder_options['enable-package'.$i] : '';
		if(isset($service_finder_options['enable-package'.$i]) && $enablepackage > 0){
		
		if (isset($service_finder_options['payment-type']) && ($service_finder_options['payment-type'] == 'recurring')) {
						$billingPeriod = esc_html__('year','service-finder');
						$packagebillingperiod = (!empty($service_finder_options['package'.$i.'-billing-period'])) ? $service_finder_options['package'.$i.'-billing-period'] : '';
						switch ($packagebillingperiod) {
							case 'Year':
								$billingPeriod = esc_html__('YEAR','service-finder');
								break;
							case 'Month':
								$billingPeriod = esc_html__('MONTH','service-finder');
								break;
							case 'Week':
								$billingPeriod = esc_html__('WEEK','service-finder');
								break;
							case 'Day':
								$billingPeriod = esc_html__('DAY','service-finder');
								break;
						}
					
		
		$billingPrice = $service_finder_options['package'.$i.'-price'] * 100;
		$packageName = $service_finder_options['package'.$i.'-name'];
		$currencyCode = strtoupper(service_finder_currencycode());
		$planID = 'package_'.$i;
		
		
		$free = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		
			if(!$free) {
			
			$parameters = array(
				// Enter the plan‘s description here.
				PayUParameters::PLAN_DESCRIPTION => $packageName,
				// Enter the identification code of the plan here.
				PayUParameters::PLAN_CODE => $planID,
				// Enter the interval of the plan here.
				//DAY||WEEK||MONTH||YEAR
				PayUParameters::PLAN_INTERVAL => $billingPeriod,
				// Enter the number of intervals here.
				PayUParameters::PLAN_INTERVAL_COUNT => "1",
				// Enter the currency of the plan here.
				PayUParameters::PLAN_CURRENCY => $currencyCode,
				// Enter the value of the plan here.
				PayUParameters::PLAN_VALUE => $billingPrice,
				// Enter the account ID of the plan here.
				PayUParameters::ACCOUNT_ID => $payulatamaccountid,
				// Enter the amount of charges that make up the plan here
				PayUParameters::PLAN_MAX_PAYMENTS => "12",
				// Enter the retry interval here
				PayUParameters::PLAN_ATTEMPTS_DELAY => "1",
			);
			
			$response = PayUSubscriptionPlans::create($parameters);

			/*$parameters = array(
				// Enter the identification code of the plan here.
				PayUParameters::PLAN_CODE => $planID,
			);
			
			$response = PayUSubscriptionPlans::find($parameters);*/
			
			/*if($response) {
				 
				 $parameters = array(
					// Enter the plan‘s description here.
					PayUParameters::PLAN_DESCRIPTION => $packageName,
					// Enter the identification code of the plan here.
					PayUParameters::PLAN_CODE => $planID,
					// Enter the currency of the plan here.
					PayUParameters::PLAN_CURRENCY => $currencyCode,
					// Enter the value of the plan here.
					PayUParameters::PLAN_VALUE => $billingPrice,
				);

				$response = PayUSubscriptionPlans::update($parameters);    

			}else{  

			$parameters = array(
				// Enter the plan‘s description here.
				PayUParameters::PLAN_DESCRIPTION => $packageName,
				// Enter the identification code of the plan here.
				PayUParameters::PLAN_CODE => $planID,
				// Enter the interval of the plan here.
				//DAY||WEEK||MONTH||YEAR
				PayUParameters::PLAN_INTERVAL => $billingPeriod,
				// Enter the number of intervals here.
				PayUParameters::PLAN_INTERVAL_COUNT => "1",
				// Enter the currency of the plan here.
				PayUParameters::PLAN_CURRENCY => $currencyCode,
				// Enter the value of the plan here.
				PayUParameters::PLAN_VALUE => $billingPrice,
				// Enter the account ID of the plan here.
				PayUParameters::ACCOUNT_ID => $payulatamaccountid,
				// Enter the amount of charges that make up the plan here
				PayUParameters::PLAN_MAX_PAYMENTS => "12",
			);
			
			$response = PayUSubscriptionPlans::create($parameters);
			
			}*/
			
			}
		}
		}
		}
	
} catch (Exception $e) {

	$error = array(
			'status' => 'error',
			'err_message' => $e->getMessage()
			);
	$service_finder_Errors = json_encode($error);
	
}	

}

/*End PayU Latam Plans*/

}

/*Get Page ID By Its Slug*/
function service_finder_get_id_by_slug($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/*Get Lat Long By Address*/
function service_finder_getLatLong($address){
	global $wp_filesystem, $service_finder_options;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }
	
	$apikey = (!empty($service_finder_options['server-api-key'])) ? $service_finder_options['server-api-key'] : '';
	if($apikey != ""){			
		$geocode_stats = $wp_filesystem->get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=".$apikey."&address=".$address);
	}else{
		$geocode_stats = $wp_filesystem->get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address);
	}
	
	$output_deals = json_decode($geocode_stats);
	
	$latLng = (!empty($output_deals->results[0]->geometry->location)) ? $output_deals->results[0]->geometry->location : '';
	
	
	$res = array(
			'lat' => (!empty($latLng->lat)) ? $latLng->lat : '',
			'lng' => (!empty($latLng->lng)) ? $latLng->lng : '',
	);
	
	return $res;
}

/*Call the function to delete providers data when delete the provider from admin*/
function service_finder_custom_remove_user( $user_id ) {
service_finder_deleteProvidersData($user_id);
}
add_action( 'delete_user', 'service_finder_custom_remove_user', 10 );

/*Manage Redirect after login*/
function service_finder_redirect_afterlogin( $redirect_to, $request, $user ) {
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		if ( in_array( 'administrator', $user->roles ) ) {
			return $redirect_to;
		} elseif(in_array( 'Provider', $user->roles ) || in_array( 'Customer', $user->roles )){
			return service_finder_get_url_by_shortcode('[service_finder_my_account]');
		} else{
			return home_url('/');
		}
	} else {
		return $redirect_to;
	}
}
/*Filter to Manage Redirect after login*/
add_filter( 'login_redirect', 'service_finder_redirect_afterlogin', 10, 3 );

/*Manage authentication user for block and moderation purpose*/
add_filter('wp_authenticate_user', 'service_finder_user_authentication',10,2);
function service_finder_user_authentication ($user, $password) {
	 global $service_finder_Errors,  $service_finder_Tables, $wpdb;

	 $role = service_finder_getUserRole($user->ID);
	 if($role == "Provider"){
		 $service_finder_Errors = new WP_Error();
		 $providerinfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE wp_user_id = %d',$user->ID));
		 
		 if($providerinfo->admin_moderation != "approved"){
			$service_finder_Errors->add( 'admin_moderation', esc_html__( 'ERROR: Your account is not approved' , 'service-finder') );
			return $service_finder_Errors;
		 }elseif($providerinfo->account_blocked == "yes"){
			$service_finder_Errors->add( 'account_block', esc_html__( 'ERROR: Your account has been blocked. Please contact administrator' , 'service-finder') );
			return $service_finder_Errors;
		 }else{
			return $user;
		 }
	 }else{
	 	return $user;
	 }
}

/*Encode url for use in javascript files*/
function service_finder_encodeURIComponent(){
$url = '';
		$unescaped = array(
        '%2D'=>'-','%5F'=>'_','%2E'=>'.','%21'=>'!', '%7E'=>'~',
        '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')'
    );
    $reserved = array(
        '%3B'=>';','%2C'=>',','%2F'=>'/','%3F'=>'?','%3A'=>':',
        '%40'=>'@','%26'=>'&','%3D'=>'=','%2B'=>'+','%24'=>'$'
    );
    $score = array(
        '%23'=>'#'
    );
    return strtr(rawurlencode($url), array_merge($reserved,$unescaped,$score));
}

//function to check permalinks
function service_finder_using_permalink(){
return get_option('permalink_structure');
}

//Sub header
function service_finder_sub_header_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$subheader = (!empty($service_finder_options['sub-header'])) ? $service_finder_options['sub-header'] : '';
return $subheader;
}

//Inner page banner image
function service_finder_innerpage_banner_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$bannerimg = (!empty($service_finder_options['inner-sub-header-bg-image']['url'])) ? $service_finder_options['inner-sub-header-bg-image']['url'] : '';
return $bannerimg;
}

//Provider sub header bg image
function service_finder_provider_coverbanner_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$coverbanner = (!empty($service_finder_options['provider-sub-header-bg-image']['url'])) ? $service_finder_options['provider-sub-header-bg-image']['url'] : '';
return $coverbanner;
}

//Breadcrumb
function service_finder_breadcrumb_pl(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$breadcrumbs = (!empty($service_finder_options['breadcrumbs'])) ? $service_finder_options['breadcrumbs'] : '';
return $breadcrumbs;
}

//Get services
function service_finder_get_booking_services($bookingid){
global $wpdb, $service_finder_Tables;
$html = '';
$row = $wpdb->get_row($wpdb->prepare('SELECT `services` FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));
	if(!empty($row)){
		$services = esc_html($row->services);
		$services = rtrim($services,'%%');
		$servicearr = explode('%%',$services);
		if(!empty($servicearr)){
		$html = '<ul class="sf-booking-services">';
			if(!empty($servicearr)){
			foreach($servicearr as $service){
				$tem = explode('-',$service);
				if(!empty($tem)){
				$serviceid = $tem[0];
				$servicehours = $tem[1];
				$servicedata = service_finder_get_service_by_id($serviceid);
				if(!empty($servicedata)){
					if($servicedata->cost_type == 'hourly'){
					$html .= '<li>'.esc_html($servicedata->service_name).' ('.esc_html__( 'Hourly', 'service-finder' ).') - '.esc_html($servicehours).' '.esc_html__( 'hrs', 'service-finder' ).'</li>';
					}elseif($servicedata->cost_type == 'perperson'){
					$html .= '<li>'.esc_html($servicedata->service_name).' ('.esc_html__( 'Per Person', 'service-finder' ).') - '.esc_html($servicehours).' '.esc_html__( 'persons', 'service-finder' ).'</li>';
					}else{
					$html .= '<li>'.esc_html($servicedata->service_name).'</li>';
					}
				}	
				}
			}
			}
		$html .= '</ul>';	
		}
	}
	return $html;
}

//Get service by id
function service_finder_get_service_by_id($serviceid){
global $wpdb, $service_finder_Tables;
$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->services.' WHERE `id` = %d',$serviceid));
return $row;	
}

add_action( 'post_submitbox_misc_actions', 'service_finder_check_display_banner' );

function service_finder_check_display_banner()
{
    $post_id = get_the_ID();
  
    if (get_post_type($post_id) != 'page') {
        return;
    }
  
  	$value = get_post_meta($post_id, '_display_banner', true);
    wp_nonce_field('my_custom_nonce_'.$post_id, 'my_custom_nonce');
	
	if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
    ?>
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_banner" /><?php esc_html_e('Display Banner', 'service-finder'); ?></label>
    </div>

    <?php
	$value = get_post_meta($post_id, '_display_title', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_title" /><?php esc_html_e('Display Title', 'service-finder'); ?></label>
    </div>
    
    <?php
	$value = get_post_meta($post_id, '_display_sidebar', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_sidebar" /><?php esc_html_e('Display Sidebar', 'service-finder'); ?></label>
    </div>
    
    <?php
	$value = get_post_meta($post_id, '_display_comment', true);
    if (service_finder_is_edit_page('new')){
	    $checked = 'checked="checked"';
	}else{
		$checked = checked($value, true, false);
	}
	?>
    
    <div class="misc-pub-section misc-pub-section-last">
        <label><input type="checkbox" value="1" <?php echo esc_attr($checked); ?> name="_display_comment" /><?php esc_html_e('Display Comment', 'service-finder'); ?></label>
    </div>
    <?php
}

add_action('save_post', 'service_finder_save_display_banner');

function service_finder_save_display_banner($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
	$my_custom_nonce = (!empty($_POST['my_custom_nonce'])) ? esc_html($_POST['my_custom_nonce']) : '';
	$display_banner = (!empty($_POST['_display_banner'])) ? esc_html($_POST['_display_banner']) : '';
	$display_title = (!empty($_POST['_display_title'])) ? esc_html($_POST['_display_title']) : '';
	$display_sidebar = (!empty($_POST['_display_sidebar'])) ? esc_html($_POST['_display_sidebar']) : '';
	$display_comment = (!empty($_POST['_display_comment'])) ? esc_html($_POST['_display_comment']) : '';
	
	if (!isset($my_custom_nonce) || !wp_verify_nonce($my_custom_nonce, 'my_custom_nonce_'.$post_id)) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($display_banner)) {
        update_post_meta($post_id, '_display_banner', $display_banner);
    } else {
        delete_post_meta($post_id, '_display_banner');
    }
	if (isset($display_title)) {
        update_post_meta($post_id, '_display_title', $display_title);
    } else {
        delete_post_meta($post_id, '_display_title');
    }
	if (isset($display_sidebar)) {
        update_post_meta($post_id, '_display_sidebar', $display_sidebar);
    } else {
        delete_post_meta($post_id, '_display_sidebar');
    }
	if (isset($display_comment)) {
        update_post_meta($post_id, '_display_comment', $display_comment);
    } else {
        delete_post_meta($post_id, '_display_comment');
    }
}

function service_finder_is_edit_page($new_edit = null){
    global $pagenow;
    //make sure we are on the backend
    if (!is_admin()) return false;


    if($new_edit == "edit")
        return in_array( $pagenow, array( 'post.php',  ) );
    elseif($new_edit == "new") //check for new post page
        return in_array( $pagenow, array( 'post-new.php' ) );
    else //check for either new or edit
        return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
}

//To Check if job booking is authorized or not
function service_finder_is_job_author($jobid,$jobauthor){
global $wpdb, $current_user; 

	if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer' && $jobid > 0 && $jobauthor == $current_user->ID){
	  return true;
	}else{
	  return false;
	}
}

//To Check if job booking is authorized or not
function service_finder_check_account_authorization($manageaccountby,$manageproviderid){
global $wpdb, $current_user; 

	if(is_user_logged_in() && $manageaccountby == 'admin' && service_finder_getUserRole($manageproviderid) == 'Provider' && service_finder_getUserRole($current_user->ID) == 'administrator'){
	  return true;
	}else{
	  return false;
	}
}

function service_finder_get_countries(){
	$countries = array(
    "AF" => esc_html__( 'Afghanistan', 'service-finder' ),
    "AX" => esc_html__( 'Aland Islands', 'service-finder' ),
    "AL" => esc_html__( 'Albania', 'service-finder' ),
    "DZ" => esc_html__( 'Algeria', 'service-finder' ),
    "AS" => esc_html__( 'American Samoa', 'service-finder' ),
    "AD" => esc_html__( 'Andorra', 'service-finder' ),
    "AO" => esc_html__( 'Angola', 'service-finder' ),
    "AI" => esc_html__( 'Anguilla', 'service-finder' ),
    "AQ" => esc_html__( 'Antarctica', 'service-finder' ),
    "AG" => esc_html__( 'Antigua and Barbuda', 'service-finder' ),
    "AR" => esc_html__( 'Argentina', 'service-finder' ),
    "AM" => esc_html__( 'Armenia', 'service-finder' ),
    "AW" => esc_html__( 'Aruba', 'service-finder' ),
    "AU" => esc_html__( 'Australia', 'service-finder' ),
    "AT" => esc_html__( 'Austria', 'service-finder' ),
    "AZ" => esc_html__( 'Azerbaijan', 'service-finder' ),
    "BS" => esc_html__( 'Bahamas', 'service-finder' ),
    "BH" => esc_html__( 'Bahrain', 'service-finder' ),
    "BD" => esc_html__( 'Bangladesh', 'service-finder' ),
    "BB" => esc_html__( 'Barbados', 'service-finder' ),
    "BY" => esc_html__( 'Belarus', 'service-finder' ),
    "BE" => esc_html__( 'Belgium', 'service-finder' ),
    "BZ" => esc_html__( 'Belize', 'service-finder' ),
    "BJ" => esc_html__( 'Benin', 'service-finder' ),
    "BM" => esc_html__( 'Bermuda', 'service-finder' ),
    "BT" => esc_html__( 'Bhutan', 'service-finder' ),
    "BO" => esc_html__( 'Bolivia', 'service-finder' ),
    "BA" => esc_html__( 'Bosnia and Herzegovina', 'service-finder' ),
    "BW" => esc_html__( 'Botswana', 'service-finder' ),
    "BV" => esc_html__( 'Bouvet Island', 'service-finder' ),
    "BR" => esc_html__( 'Brazil', 'service-finder' ),
    "IO" => esc_html__( 'British Indian Ocean Territory', 'service-finder' ),
    "BN" => esc_html__( 'Brunei Darussalam', 'service-finder' ),
    "BG" => esc_html__( 'Bulgaria', 'service-finder' ),
    "BF" => esc_html__( 'Burkina Faso', 'service-finder' ),
    "BI" => esc_html__( 'Burundi', 'service-finder' ),
    "KH" => esc_html__( 'Cambodia', 'service-finder' ),
    "CM" => esc_html__( 'Cameroon', 'service-finder' ),
    "CA" => esc_html__( 'Canada', 'service-finder' ),
    "CV" => esc_html__( 'Cape Verde', 'service-finder' ),
    "KY" => esc_html__( 'Cayman Islands', 'service-finder' ),
    "CF" => esc_html__( 'Central African Republic', 'service-finder' ),
    "TD" => esc_html__( 'Chad', 'service-finder' ),
    "CL" => esc_html__( 'Chile', 'service-finder' ),
    "CN" => esc_html__( 'China', 'service-finder' ),
    "CX" => esc_html__( 'Christmas Island', 'service-finder' ),
    "CC" => esc_html__( 'Cocos (Keeling) Islands', 'service-finder' ),
    "CO" => esc_html__( 'Colombia', 'service-finder' ),
    "KM" => esc_html__( 'Comoros', 'service-finder' ),
    "CG" => esc_html__( 'Congo', 'service-finder' ),
    "CD" => esc_html__( 'Congo, The Democratic Republic of The', 'service-finder' ),
    "CK" => esc_html__( 'Cook Islands', 'service-finder' ),
    "CR" => esc_html__( 'Costa Rica', 'service-finder' ),
    "CI" => esc_html__( 'Cote D\'ivoire', 'service-finder' ),
    "HR" => esc_html__( 'Croatia', 'service-finder' ),
    "CU" => esc_html__( 'Cuba', 'service-finder' ),
    "CY" => esc_html__( 'Cyprus', 'service-finder' ),
    "CZ" => esc_html__( 'Czech Republic', 'service-finder' ),
    "DK" => esc_html__( 'Denmark', 'service-finder' ),
    "DJ" => esc_html__( 'Djibouti', 'service-finder' ),
    "DM" => esc_html__( 'Dominica', 'service-finder' ),
    "DO" => esc_html__( 'Dominican Republic', 'service-finder' ),
    "EC" => esc_html__( 'Ecuador', 'service-finder' ),
    "EG" => esc_html__( 'Egypt', 'service-finder' ),
    "SV" => esc_html__( 'El Salvador', 'service-finder' ),
    "GQ" => esc_html__( 'Equatorial Guinea', 'service-finder' ),
    "ER" => esc_html__( 'Eritrea', 'service-finder' ),
    "EE" => esc_html__( 'Estonia', 'service-finder' ),
    "ET" => esc_html__( 'Ethiopia', 'service-finder' ),
    "FK" => esc_html__( 'Falkland Islands (Malvinas)', 'service-finder' ),
    "FO" => esc_html__( 'Faroe Islands', 'service-finder' ),
    "FJ" => esc_html__( 'Fiji', 'service-finder' ),
    "FI" => esc_html__( 'Finland', 'service-finder' ),
    "FR" => esc_html__( 'France', 'service-finder' ),
    "GF" => esc_html__( 'French Guiana', 'service-finder' ),
    "PF" => esc_html__( 'French Polynesia', 'service-finder' ),
    "TF" => esc_html__( 'French Southern Territories', 'service-finder' ),
    "GA" => esc_html__( 'Gabon', 'service-finder' ),
    "GM" => esc_html__( 'Gambia', 'service-finder' ),
    "GE" => esc_html__( 'Georgia', 'service-finder' ),
    "DE" => esc_html__( 'Germany', 'service-finder' ),
    "GH" => esc_html__( 'Ghana', 'service-finder' ),
    "GI" => esc_html__( 'Gibraltar', 'service-finder' ),
    "GR" => esc_html__( 'Greece', 'service-finder' ),
    "GL" => esc_html__( 'Greenland', 'service-finder' ),
    "GD" => esc_html__( 'Grenada', 'service-finder' ),
    "GP" => esc_html__( 'Guadeloupe', 'service-finder' ),
    "GU" => esc_html__( 'Guam', 'service-finder' ),
    "GT" => esc_html__( 'Guatemala', 'service-finder' ),
    "GG" => esc_html__( 'Guernsey', 'service-finder' ),
    "GN" => esc_html__( 'Guinea', 'service-finder' ),
    "GW" => esc_html__( 'Guinea-bissau', 'service-finder' ),
    "GY" => esc_html__( 'Guyana', 'service-finder' ),
    "HT" => esc_html__( 'Haiti', 'service-finder' ),
    "HM" => esc_html__( 'Heard Island and Mcdonald Islands', 'service-finder' ),
    "VA" => esc_html__( 'Holy See (Vatican City State)', 'service-finder' ),
    "HN" => esc_html__( 'Honduras', 'service-finder' ),
    "HK" => esc_html__( 'Hong Kong', 'service-finder' ),
    "HU" => esc_html__( 'Hungary', 'service-finder' ),
    "IS" => esc_html__( 'Iceland', 'service-finder' ),
    "IN" => esc_html__( 'India', 'service-finder' ),
    "ID" => esc_html__( 'Indonesia', 'service-finder' ),
    "IR" => esc_html__( 'Iran, Islamic Republic of', 'service-finder' ),
    "IQ" => esc_html__( 'Iraq', 'service-finder' ),
    "IE" => esc_html__( 'Ireland', 'service-finder' ),
    "IM" => esc_html__( 'Isle of Man', 'service-finder' ),
    "IL" => esc_html__( 'Israel', 'service-finder' ),
    "IT" => esc_html__( 'Italy', 'service-finder' ),
    "JM" => esc_html__( 'Jamaica', 'service-finder' ),
    "JP" => esc_html__( 'Japan', 'service-finder' ),
    "JE" => esc_html__( 'Jersey', 'service-finder' ),
    "JO" => esc_html__( 'Jordan', 'service-finder' ),
    "KZ" => esc_html__( 'Kazakhstan', 'service-finder' ),
    "KE" => esc_html__( 'Kenya', 'service-finder' ),
    "KI" => esc_html__( 'Kiribati', 'service-finder' ),
    "KP" => esc_html__( 'Korea, Democratic People\'s Republic of', 'service-finder' ),
    "KR" => esc_html__( 'Korea, Republic of', 'service-finder' ),
    "KW" => esc_html__( 'Kuwait', 'service-finder' ),
    "KG" => esc_html__( 'Kyrgyzstan', 'service-finder' ),
    "LA" => esc_html__( 'Lao People\'s Democratic Republic', 'service-finder' ),
    "LV" => esc_html__( 'Latvia', 'service-finder' ),
    "LB" => esc_html__( 'Lebanon', 'service-finder' ),
    "LS" => esc_html__( 'Lesotho', 'service-finder' ),
    "LR" => esc_html__( 'Liberia', 'service-finder' ),
    "LY" => esc_html__( 'Libyan Arab Jamahiriya', 'service-finder' ),
    "LI" => esc_html__( 'Liechtenstein', 'service-finder' ),
    "LT" => esc_html__( 'Lithuania', 'service-finder' ),
    "LU" => esc_html__( 'Luxembourg', 'service-finder' ),
    "MO" => esc_html__( 'Macao', 'service-finder' ),
    "MK" => esc_html__( 'Macedonia, The Former Yugoslav Republic of', 'service-finder' ),
    "MG" => esc_html__( 'Madagascar', 'service-finder' ),
    "MW" => esc_html__( 'Malawi', 'service-finder' ),
    "MY" => esc_html__( 'Malaysia', 'service-finder' ),
    "MV" => esc_html__( 'Maldives', 'service-finder' ),
    "ML" => esc_html__( 'Mali', 'service-finder' ),
    "MT" => esc_html__( 'Malta', 'service-finder' ),
    "MH" => esc_html__( 'Marshall Islands', 'service-finder' ),
    "MQ" => esc_html__( 'Martinique', 'service-finder' ),
    "MR" => esc_html__( 'Mauritania', 'service-finder' ),
    "MU" => esc_html__( 'Mauritius', 'service-finder' ),
    "YT" => esc_html__( 'Mayotte', 'service-finder' ),
    "MX" => esc_html__( 'Mexico', 'service-finder' ),
    "FM" => esc_html__( 'Micronesia, Federated States of', 'service-finder' ),
    "MD" => esc_html__( 'Moldova, Republic of', 'service-finder' ),
    "MC" => esc_html__( 'Monaco', 'service-finder' ),
    "MN" => esc_html__( 'Mongolia', 'service-finder' ),
    "ME" => esc_html__( 'Montenegro', 'service-finder' ),
    "MS" => esc_html__( 'Montserrat', 'service-finder' ),
    "MA" => esc_html__( 'Morocco', 'service-finder' ),
    "MZ" => esc_html__( 'Mozambique', 'service-finder' ),
    "MM" => esc_html__( 'Myanmar', 'service-finder' ),
    "NA" => esc_html__( 'Namibia', 'service-finder' ),
    "NR" => esc_html__( 'Nauru', 'service-finder' ),
    "NP" => esc_html__( 'Nepal', 'service-finder' ),
    "NL" => esc_html__( 'Netherlands', 'service-finder' ),
    "AN" => esc_html__( 'Netherlands Antilles', 'service-finder' ),
    "NC" => esc_html__( 'New Caledonia', 'service-finder' ),
    "NZ" => esc_html__( 'New Zealand', 'service-finder' ),
    "NI" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NE" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NG" => esc_html__( 'Nigeria', 'service-finder' ),
    "NU" => esc_html__( 'Niue', 'service-finder' ),
    "NF" => esc_html__( 'Norfolk Island', 'service-finder' ),
    "MP" => esc_html__( 'Northern Mariana Islands', 'service-finder' ),
    "NO" => esc_html__( 'Norway', 'service-finder' ),
    "OM" => esc_html__( 'Oman', 'service-finder' ),
    "PK" => esc_html__( 'Pakistan', 'service-finder' ),
    "PW" => esc_html__( 'Palau', 'service-finder' ),
    "PS" => esc_html__( 'Palestinian Territory, Occupied', 'service-finder' ),
    "PA" => esc_html__( 'Panama', 'service-finder' ),
    "PG" => esc_html__( 'Papua New Guinea', 'service-finder' ),
    "PY" => esc_html__( 'Paraguay', 'service-finder' ),
    "PE" => esc_html__( 'Peru', 'service-finder' ),
    "PH" => esc_html__( 'Philippines', 'service-finder' ),
    "PN" => esc_html__( 'Pitcairn', 'service-finder' ),
    "PL" => esc_html__( 'Poland', 'service-finder' ),
    "PT" => esc_html__( 'Portugal', 'service-finder' ),
    "PR" => esc_html__( 'Puerto Rico', 'service-finder' ),
    "QA" => esc_html__( 'Qatar', 'service-finder' ),
    "RE" => esc_html__( 'Reunion', 'service-finder' ),
    "RO" => esc_html__( 'Romania', 'service-finder' ),
    "RU" => esc_html__( 'Russian Federation', 'service-finder' ),
    "RW" => esc_html__( 'Rwanda', 'service-finder' ),
    "SH" => esc_html__( 'Saint Helena', 'service-finder' ),
    "KN" => esc_html__( 'Saint Kitts and Nevis', 'service-finder' ),
    "LC" => esc_html__( 'Saint Lucia', 'service-finder' ),
    "PM" => esc_html__( 'Saint Pierre and Miquelon', 'service-finder' ),
    "VC" => esc_html__( 'Saint Vincent and The Grenadines', 'service-finder' ),
    "WS" => esc_html__( 'Samoa', 'service-finder' ),
    "SM" => esc_html__( 'San Marino', 'service-finder' ),
    "ST" => esc_html__( 'Sao Tome and Principe', 'service-finder' ),
    "SA" => esc_html__( 'Saudi Arabia', 'service-finder' ),
    "SN" => esc_html__( 'Senegal', 'service-finder' ),
    "RS" => esc_html__( 'Serbia', 'service-finder' ),
    "SC" => esc_html__( 'Seychelles', 'service-finder' ),
    "SL" => esc_html__( 'Sierra Leone', 'service-finder' ),
    "SG" => esc_html__( 'Singapore', 'service-finder' ),
    "SK" => esc_html__( 'Slovakia', 'service-finder' ),
    "SI" => esc_html__( 'Slovenia', 'service-finder' ),
    "SB" => esc_html__( 'Solomon Islands', 'service-finder' ),
    "SO" => esc_html__( 'Somalia', 'service-finder' ),
    "ZA" => esc_html__( 'South Africa', 'service-finder' ),
    "GS" => esc_html__( 'South Georgia and The South Sandwich Islands', 'service-finder' ),
    "ES" => esc_html__( 'Spain', 'service-finder' ),
    "LK" => esc_html__( 'Sri Lanka', 'service-finder' ),
    "SD" => esc_html__( 'Sudan', 'service-finder' ),
    "SR" => esc_html__( 'Suriname', 'service-finder' ),
    "SJ" => esc_html__( 'Svalbard and Jan Mayen', 'service-finder' ),
    "SZ" => esc_html__( 'Swaziland', 'service-finder' ),
    "SE" => esc_html__( 'Sweden', 'service-finder' ),
    "CH" => esc_html__( 'Switzerland', 'service-finder' ),
    "SY" => esc_html__( 'Syrian Arab Republic', 'service-finder' ),
    "TW" => esc_html__( 'Taiwan, Province of China', 'service-finder' ),
    "TJ" => esc_html__( 'Tajikistan', 'service-finder' ),
    "TZ" => esc_html__( 'Tanzania, United Republic of', 'service-finder' ),
    "TH" => esc_html__( 'Thailand', 'service-finder' ),
    "TL" => esc_html__( 'Timor-leste', 'service-finder' ),
    "TG" => esc_html__( 'Togo', 'service-finder' ),
    "TK" => esc_html__( 'Tokelau', 'service-finder' ),
    "TO" => esc_html__( 'Tonga', 'service-finder' ),
    "TT" => esc_html__( 'Trinidad and Tobago', 'service-finder' ),
    "TN" => esc_html__( 'Tunisia', 'service-finder' ),
    "TR" => esc_html__( 'Turkey', 'service-finder' ),
    "TM" => esc_html__( 'Turkmenistan', 'service-finder' ),
    "TC" => esc_html__( 'Turks and Caicos Islands', 'service-finder' ),
    "TV" => esc_html__( 'Tuvalu', 'service-finder' ),
    "UG" => esc_html__( 'Uganda', 'service-finder' ),
    "UA" => esc_html__( 'Ukraine', 'service-finder' ),
    "AE" => esc_html__( 'United Arab Emirates', 'service-finder' ),
    "GB" => esc_html__( 'United Kingdom', 'service-finder' ),
    "US" => esc_html__( 'United States', 'service-finder' ),
    "UM" => esc_html__( 'United States Minor Outlying Islands', 'service-finder' ),
    "UY" => esc_html__( 'Uruguay', 'service-finder' ),
    "UZ" => esc_html__( 'Uzbekistan', 'service-finder' ),
    "VU" => esc_html__( 'Vanuatu', 'service-finder' ),
    "VE" => esc_html__( 'Venezuela', 'service-finder' ),
    "VN" => esc_html__( 'Viet Nam', 'service-finder' ),
    "VG" => esc_html__( 'Virgin Islands, British', 'service-finder' ),
    "VI" => esc_html__( 'Virgin Islands, U.S.', 'service-finder' ),
    "WF" => esc_html__( 'Wallis and Futuna', 'service-finder' ),
    "EH" => esc_html__( 'Western Sahara', 'service-finder' ),
    "YE" => esc_html__( 'Yemen', 'service-finder' ),
    "ZM" => esc_html__( 'Zambia', 'service-finder' ),
    "ZW" => esc_html__( 'Zimbabwe', 'service-finder' ));
	return $countries;
}

function service_finder_convert_to_csv($input_array, $output_file_name, $delimiter)
{
    /** open raw memory as file, no need for temp files */
    $temp_memory = fopen('php://memory', 'w');
    /** loop through array  */
    foreach ($input_array as $line) {
        /** default php csv handler **/
        fputcsv($temp_memory, $line, $delimiter);
    }
    /** rewrind the "file" with the csv lines **/
    fseek($temp_memory, 0);
    /** modify header to be downloadable csv file **/
    header('Content-Type: application/csv');
    header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
    /** Send file to browser for download */
    fpassthru($temp_memory);
}

/*Reset provider package*/
function service_finder_resetProviderPackage($userId) {
	global $wpdb, $service_finder_options, $service_finder_Tables;
	for ($i=1; $i <= 3; $i++) {
		$freepackage = (trim($service_finder_options['package'.$i.'-price']) == '0') ? true : false;
		if((trim($service_finder_options['package'.$i.'-price']) == '0')){
			$freepackage = 'package_'.$i;
			break;
		}else{
			$freepackage = '';
		}
	}
	
	if($freepackage != ""){
	update_user_meta( $userId, 'provider_role', $freepackage );
	}else{
	update_user_meta( $userId, 'current_provider_status', 'expire' );
	delete_user_meta($userId,'provider_role' );
	}
	
	delete_user_meta($userId, 'recurring_profile_id');
	delete_user_meta($userId, 'recurring_profile_amt');
	delete_user_meta($userId, 'recurring_profile_period');
	delete_user_meta($userId, 'recurring_profile_desc_full'); 
	delete_user_meta($userId, 'recurring_profile_desc'); 
	delete_user_meta($userId, 'recurring_profile_type');
	delete_user_meta($userId, 'paypal_token');
	delete_user_meta($userId, 'reg_paypal_role');

	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'profile_amt');
	delete_user_meta($userId, 'stripe_customer_id');
	delete_user_meta($userId, 'stripe_token');
	delete_user_meta($userId, 'subscription_id');
	delete_user_meta($userId, 'payment_mode');
	delete_user_meta($userId, 'pay_type');
	
	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'provider_activation_time');
	
	$primarycategory = get_user_meta($userId, 'primary_category',true);
	
	/*Update Primary category*/
	$data = array(
			'category_id' => $primarycategory,
			);
	
	$where = array(
			'wp_user_id' => $userId,
			);
	$wpdb->update($service_finder_Tables->providers,wp_unslash($data),$where);
}

/*Scan Directory for css/js*/
if(!function_exists('service_finder_booking_scan_dir')){
	function service_finder_booking_scan_dir($folder) {
	  $dircontent = scandir($folder);
	  $ret='';
	  foreach($dircontent as $filename) {
	    if ($filename != '.' && $filename != '..') {
	      if (filemtime($folder.$filename) === false) return false;
	      $ret.=date("YmdHis", filemtime($folder.$filename)).$filename;
	    }
	  }
	  return md5($ret);
	}
}

/*Delete Old Cache*/
if(!function_exists('service_finder_booking_delete_old_cache')){
	function service_finder_booking_delete_old_cache($folder) {
	  $olddate=time()-60;
	  $dircontent = scandir($folder);
	  foreach($dircontent as $filename) {
	    if (strlen($filename)==32 && filemtime($folder.$filename) && filemtime($folder.$filename)<$olddate) unlink($folder.$filename);
	  }
	}
}

/*Get contact info*/
if(!function_exists('service_finder_get_contact_info')){
	function service_finder_get_contact_info($phone,$mobile){
		$contactnumber = '';
		if($phone != "" && $mobile != ""){
		$contactnumber = '<b>Tel: </b><a href="tel:'.$phone.'">'.$phone.'</a><br/> <b>Mob: </b><a href="tel:'.$mobile.'">'.$mobile.'</a><br/>';
		}elseif($phone != ""){
		$contactnumber = '<b>Tel: </b><a href="tel:'.$phone.'">'.$phone.'</a>';
		}elseif($mobile != ""){
		$contactnumber = '<b>Mob: </b><a href="tel:'.$mobile.'">'.$mobile.'</a>';
		}
		return $contactnumber;  
	}
}

/*Get contact info*/
if(!function_exists('service_finder_get_contact_info_for_toltip')){
	function service_finder_get_contact_info_for_toltip($phone,$mobile){
		$contactnumber = '';
		if($phone != "" && $mobile != ""){
		$contactnumber = 'Tel: '.$phone.' Mob: '.$mobile;
		}elseif($phone != ""){
		$contactnumber = 'Tel: '.$phone;
		}elseif($mobile != ""){
		$contactnumber = 'Mob: '.$mobile;
		}
		return $contactnumber;  
	}
}


/*Get contact info*/
if(!function_exists('service_finder_cancel_subscription')){
function service_finder_cancel_subscription($userId,$by) {
	global $wpdb, $service_finder_options, $service_finder_Tables;
	service_finder_SendSubscriptionNotificationMail($userId,0,$by);
	
	update_user_meta( $userId, 'current_provider_status', 'cancel' );
	delete_user_meta($userId,'provider_role' );
	
	delete_user_meta($userId, 'payulatam_planid');
	delete_user_meta($userId, 'payulatam_customer_id');
									
	delete_user_meta($userId, 'recurring_profile_id');
	delete_user_meta($userId, 'recurring_profile_amt');
	delete_user_meta($userId, 'recurring_profile_period');
	delete_user_meta($userId, 'recurring_profile_desc_full'); 
	delete_user_meta($userId, 'recurring_profile_desc'); 
	delete_user_meta($userId, 'recurring_profile_type');
	delete_user_meta($userId, 'paypal_token');
	delete_user_meta($userId, 'reg_paypal_role');

	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'profile_amt');
	delete_user_meta($userId, 'stripe_customer_id');
	delete_user_meta($userId, 'stripe_token');
	delete_user_meta($userId, 'subscription_id');
	delete_user_meta($userId, 'payment_mode');
	delete_user_meta($userId, 'pay_type');
	
	delete_user_meta($userId, 'expire_limit');
	delete_user_meta($userId, 'provider_activation_time');
	
	$primarycategory = get_user_meta($userId, 'primary_category',true);
	
	/*Update Primary category*/
	$data = array(
			'category_id' => $primarycategory,
			);
	
	$where = array(
			'wp_user_id' => $userId,
			);
	$wpdb->update($service_finder_Tables->providers,wp_unslash($data),$where);
	
	$data = array(
			'free_limits' => 0,
			'available_limits' => 0,
			'paid_limits' => 0,
			);
	$where = array(
			'provider_id' => $userId,

			);		
	
	$wpdb->update($service_finder_Tables->job_limits,wp_unslash($data),$where);
}
}

/*Redirect after comment submit on author*/
function service_finder_comment_redirect( $location ) {
	
	$postid = (isset($_POST['comment_post_ID'])) ? $_POST['comment_post_ID'] : '';
	$post_type = get_post_type($postid);
	
	if($post_type == 'sf_comment_rating'){
		$location = str_replace('comment-rating','author',$location);
		$tem = explode('comment-page',$location);
		if($tem[1] != ""){
		$base = $tem[0];
		$mid = explode('#',$tem[1]);
			if($mid[1] != ""){
			$end = $mid[1];
			$location = $base.'#'.$end;
			}else{
			$location = $base;
			}
		}
	}
    
	return $location;
}

add_filter( 'comment_post_redirect', 'service_finder_comment_redirect' );

/*Add Notifications*/
if ( !function_exists( 'service_finder_add_notices' ) ){
function service_finder_add_notices($args) {
global $wpdb, $service_finder_Tables;
$data = array(
		'provider_id' => (!empty($args['provider_id'])) ? $args['provider_id'] : 0,
		'customer_id' => (!empty($args['customer_id'])) ? $args['customer_id'] : 0,
		'target_id' => (!empty($args['target_id'])) ? $args['target_id'] : 0,
		'topic' => (!empty($args['topic'])) ? $args['topic'] : '',
		'notice' => (!empty($args['notice'])) ? $args['notice'] : '',
		'extra' => (!empty($args['extra'])) ? $args['extra'] : ''
		);
$wpdb->insert($service_finder_Tables->notifications,wp_unslash($data));

}
}

/*View Notifications*/
add_action('wp_ajax_view_notificaions', 'service_finder_view_notificaions');
add_action('wp_ajax_nopriv_view_notificaions', 'service_finder_view_notificaions');
function service_finder_view_notificaions(){
global $wpdb, $service_finder_Tables;

	$usertype = (isset($_POST['usertype'])) ? esc_html($_POST['usertype']) : '';
	$userid = (isset($_POST['userid'])) ? esc_html($_POST['userid']) : '';
	
	$data = array(
			'read' => 'yes'
			);
	
	$where = '';
	
	if($usertype == 'Provider'){
		$where = array(
				'provider_id' => $userid
				);		
	}elseif($usertype == 'Customer'){
		$where = array(
				'customer_id' => $userid
				);	
	}		

	$wpdb->update($service_finder_Tables->notifications,wp_unslash($data),$where);
	
	exit(0);
}

/*Show contact info at search result page*/
function show_contactinfo_at_search_result($phone,$mobile){
global $service_finder_options;
	if($service_finder_options['show-address-info'] && $service_finder_options['show-contact-number'] && service_finder_check_address_info_access()){
		$contactinfo = '<strong class="sf-provider-phone">'.service_finder_get_contact_info($phone,$mobile).'</strong>';
		return $contactinfo;
	}
}

/*Show total review at search result page*/
function show_review_at_search_result($providerid){
global $service_finder_options,$wpdb,$service_finder_Tables;
	if($service_finder_options['review-system']){
		if($service_finder_options['review-style'] == 'open-review'){
			$comment_postid = get_user_meta($providerid,'comment_post',true);
			$total_review = get_comments_number( $comment_postid );
			$review = $total_review.' '.esc_html__('Review','service-finder');
			return $review; 
		}elseif($service_finder_options['review-style'] == 'booking-review'){
			$allreviews = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->feedback.' where provider_id = %d',$providerid));
			$total_review = count($allreviews);
			$review = $total_review.' '.esc_html__('Review','service-finder');
			return $review; 
		}	
	}

}

/*Show Request a quote model popup to search result page*/
function show_request_quote_at_search_result($providerid){
global $service_finder_options,$wpdb,$service_finder_Tables;
	$requestquote = (!empty($service_finder_options['requestquote-replace-string'])) ? esc_attr($service_finder_options['requestquote-replace-string']) : esc_html__( 'Request a Quote', 'service-finder' );
	
	if($service_finder_options['request-quote']){
		return '<button data-providerid="'.$providerid.'" data-tool="tooltip" data-toggle="modal" data-target="#quotes-Modal" type="button" class="btn btn-border" data-toggle="tooltip" data-placement="top" title="'.$requestquote.'"> <i class="fa fa-file-o"></i> </button>';
	}

}

/*Identity Check*/
function service_finder_is_varified_user($providerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' where `identity` = "approved" AND `wp_user_id` = %d',$providerid));
if(!empty($row)){
	return true;
}else{
	return false;
}
}

/*Check if exist for apply limit table*/
function service_finder_is_exist_in_joblimit($providerid){
global $wpdb,$service_finder_Tables;

$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->job_limits.' where `provider_id` = %d',$providerid));
if(!empty($row)){
	return true;
}else{
	return false;
}
}


/*Add class for verified providers*/
function service_finder_check_varified($providerid){
	if(service_finder_is_varified_user($providerid)){
		return 'sf-approved';
	}else{
		return '';
	}
}

/*Add class for verified providers*/
function service_finder_check_varified_icon($providerid){
	if(service_finder_is_varified_user($providerid)){
		if(service_finder_themestyle() == 'style-2'){
		$html = '<span class="sf-featured-approve"><i class="fa fa-check"></i><span>'.esc_html__('Verified Provider', 'service-finder').'</span></span>';
		}else{
		$html = '<span class="sf-average-question" data-tool="tooltip" data-placement="top" title="'.esc_html__('Verified Provider', 'service-finder').'">
               		<i class="fa fa-check-square-o"></i>
              	 </span>';
		}		 
		return $html;
	}else{
		return '';
	}
}

/*Check if is default view for search result style 1*/
function service_finder_is_default_view($view = "grid-4"){
global $service_finder_options;

$defaultview = (!empty($service_finder_options["default-view"])) ? esc_js($service_finder_options["default-view"]) : "grid-4";

	if($defaultview == $view){
		return 'class="active"';
	}else{
		return '';
	}
}

/*Check if is default view for search result style 2*/
function service_finder_is_default_view_style2($view = "grid-2"){
global $service_finder_options;

$defaultview = (!empty($service_finder_options["default-view-2"])) ? esc_js($service_finder_options["default-view-2"]) : "grid-4";

	if($defaultview == $view){
		return 'class="active"';
	}else{
		return '';
	}
}

function service_finder_show_provider_meta($providerid,$phone,$mobile){
	global $service_finder_options;
	$contact = service_finder_get_contact_info_for_toltip($phone,$mobile);
	$reviewcount = show_review_at_search_result($providerid);
	if($contact == ""){
	$contact = esc_html__('Not Available', 'service-finder');
	}
	
	$showphone = '';
	if($service_finder_options['show-address-info'] && $service_finder_options['show-contact-number'] && service_finder_check_address_info_access()){
	$showphone = '<button type="button" class="btn btn-border" data-tool="tooltip" data-placement="top" title="'.$contact.'"> <i class="fa fa-phone"></i> </button>';
	}
	
	$showreview = '';
	if($service_finder_options['review-system']){
	$showreview = '<button type="button" class="btn btn-border" data-tool="tooltip" data-placement="top" title="'.$reviewcount.'"> <i class="fa fa-commenting-o"></i> </button>';
	}
	
	$html = '<div class="btn-group sf-provider-tooltip" role="group" aria-label="Basic example">
			  '.$showphone.'
			  '.$showreview.'
			  '.show_request_quote_at_search_result($providerid).'
			</div>';
			
	return $html;		
}

/*Get available job apply limits*/
function service_finder_get_avl_job_limits($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$availablelimit = 0;
$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
$availablelimit = $row->available_limits;
}
return $availablelimit;
}

/*Get available job apply data*/
function service_finder_get_job_limits_data($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
return $row;
}else{
return '';
}

}

/*Get job apply limits current plan*/
function service_finder_get_current_plan($providerid){
global $wpdb, $service_finder_options, $service_finder_Tables;

$current_plan = '';
$planname = esc_html__('No Plans', 'service-finder');
$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$providerid.'"');

if(!empty($row)){
	$current_plan = $row->current_plan;
}

return $current_plan;
}

/**********************
Draw Review Box
**********************/
function service_finder_review_box($author,$totalreview){
	global $service_finder_options, $wpdb, $service_finder_Tables;
	
	$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');
	
	$avgrating = service_finder_getAverageRating($author);
	
	$numberofstars = service_finder_number_of_stars($author);
	
	$allbookings = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' where provider_id = %d',$author));
	$totalbookings = count($allbookings);
	
	$completedbookings = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' where status = "Completed" AND provider_id = %d',$author));
	$totalcompleted = count($completedbookings);
	if($totalbookings > 0){
	$completionrate = ($totalcompleted/$totalbookings) * 100;
	}else{
	$completionrate = 0;
	}
	?>
    
    <div class="sf-stats-rating">
    <?php echo service_finder_displayRating($avgrating); ?>
    <div class="sf-average-reviews"><?php echo sprintf( esc_html__('%d stars - ', 'service-finder'), esc_html($avgrating) ); ?></div>
    <div class="sf-average-reviews"><?php echo sprintf( esc_html__('%d reviews', 'service-finder'), esc_html($totalreview) ); ?></div>
    <div class="sf-completion-rate">
        <div class="sf-rate-persent"><?php echo number_format((float)$completionrate,2,'.','').esc_html__('% Completion Rate', 'service-finder'); ?></div>
        <div class="sf-average-question" id="example" type="button" data-toggle="tooltip" data-placement="top" title="<?php echo sprintf( esc_html__('The percentage of accepted tasks this %s has completed', 'service-finder'), esc_html($providerreplacestring) ); ?>"><i class="fa fa-info-circle"></i></div>
    </div>
    <p class="sf-completed-tasks"><?php echo sprintf( esc_html__('%d Completed Task', 'service-finder'), esc_html($totalcompleted) ); ?></p>
</div>
	<div class="sf-reviews-summary">
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[5]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[4]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[3]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[2]); ?></div>
    </div>
    <div class="sf-reviews-row">
        <div class="sf-reviews-star">
            <i class="fa fa-star"></i>
        </div>
        <div class="sf-reviews-star-no"><?php echo esc_html($numberofstars[1]); ?></div>
    </div>
</div>
	<?php
}	

/**********************
Captcha Field
**********************/
function service_finder_captcha($where){
global $service_finder_options;

if($where == 'requestquote' || $where == 'requestquotepopup'){
	$chkcaptcha = ($service_finder_options['request-quote-captcha']) ? true : false;
}elseif($where == 'customersignup' || $where == 'customersignuppage'){
	$chkcaptcha = ($service_finder_options['customer-signup-captcha']) ? true : false;
}elseif($where == 'providersignup' || $where == 'providersignuppage'){
	$chkcaptcha = ($service_finder_options['provider-signup-captcha']) ? true : false;
}elseif($where == 'claimbusiness'){
	$chkcaptcha = ($service_finder_options['claim-business-captcha']) ? true : false;
}

$html = '';
if($chkcaptcha){

if(isset($service_finder_options['captcha-style']) && $service_finder_options['captcha-style'] == 'style-1'){
	$label = esc_html__('Can&#8217;t read the image? click %LINKSTART%here%LINKEND% to refresh.', 'service-finder'); 
	$label = str_replace('%LINKSTART%','<a href="javascript:;" data-where="'.$where.'" class="refreshCaptcha">',$label);
	$label = str_replace('%LINKEND%','</a>',$label);
		
	$html = '<div class="col-md-12 margin-b-20"><img src="'.SERVICE_FINDER_BOOKING_LIB_URL.'/captcha.php?where='.$where.'&rand='.rand().'" id="captchaimg_'.$where.'">
	'.$label.'</div>
	<div class="col-md-12">
	<div class="form-group">
	  <div class="input-group"> <i class="input-group-addon fa fa-pencil"></i>
		<input name="captcha_code" id="captcha_code" type="text" class="form-control" placeholder="'.esc_html__("Enter the code above here", "service-finder").'">					
		<input type="hidden" name="captchaon" value="1">
	  </div>
	</div>
	</div>';
}else{
	$captchasitekey = (isset($service_finder_options['captcha-sitekey'])) ? esc_html($service_finder_options['captcha-sitekey']) : '';
	$captchatheme = (isset($service_finder_options['captcha-theme'])) ? esc_html($service_finder_options['captcha-theme']) : 'light';

	return '<div class="col-md-12">
	<div class="form-group">
	  <div class="input-group">
		<div class="captchaouter" id="recaptcha_'.$where.'" data-theme="'.$captchatheme.'" data-sitekey="'.$captchasitekey.'"></div>
	  </div>
	</div>
	</div>';
}

}
return $html;
}

/*Run Before User Delete*/
add_action('load-users.php','service_finder_before_delete_user');
function service_finder_before_delete_user(){
	if (isset($_GET['action']) && 'delete' === $_GET['action']) {
	  $userid = (isset($_GET['user'])) ? $_GET['user'] : '';
	  if (isset($_GET['user'])) {
		global $wpdb, $service_finder_Errors, $service_finder_options, $paypal;
		
		$creds = array();
		$paypalCreds['USER'] = (isset($service_finder_options['paypal-username'])) ? $service_finder_options['paypal-username'] : '';
		$paypalCreds['PWD'] = (isset($service_finder_options['paypal-password'])) ? $service_finder_options['paypal-password'] : '';
		$paypalCreds['SIGNATURE'] = (isset($service_finder_options['paypal-signatue'])) ? $service_finder_options['paypal-signatue'] : '';
		$paypalType = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';
		
		$paypalTypeBool = (!empty($paypalType)) ? true : false;
		
		$paypal = new Paypal($paypalCreds,$paypalTypeBool);
		
		$subscription_id = get_user_meta($userid,'subscription_id',true);
		$cusID = get_user_meta($userid,'stripe_customer_id',true);
		$payment_mode = get_user_meta($userid,'payment_mode',true);
		$oldProfile = get_user_meta($userid,'recurring_profile_id',true);
		
		$msg = esc_html__('This user cannot be deleted. Due to subscription cancellation failed.', 'service-finder');
		
		
		if($subscription_id != "" && ($payment_mode == 'stripe' || $payment_mode == 'stripe_upgrade')){
		require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/Stripe.php');
		
		if( isset($service_finder_options['stripe-type']) && $service_finder_options['stripe-type'] == 'test' ){
			$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? $service_finder_options['stripe-test-secret-key'] : '';
			$public_key = (!empty($service_finder_options['stripe-test-public-key'])) ? $service_finder_options['stripe-test-public-key'] : '';
		}else{
			$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? $service_finder_options['stripe-live-secret-key'] : '';
			$public_key = (!empty($service_finder_options['stripe-live-public-key'])) ? $service_finder_options['stripe-live-public-key'] : '';
		}
		
			Stripe::setApiKey($secret_key);
			try {			
		
				$currentcustomer = Stripe_Customer::retrieve($cusID);
				$res = $currentcustomer->subscriptions->retrieve($subscription_id)->cancel();
				if($res->status == 'canceled'){
				
				service_finder_cancel_subscription($userid,'manually');
				}else{
					wp_die($msg);
				}
					
								
			} catch (Exception $e) {
			
				$body = $e->getJsonBody();
				$err  = $body['error'];
			
				wp_die($msg);
			}
		}elseif(!empty($oldProfile)) {
			$cancelParams = array(
				'PROFILEID' => $oldProfile,
				'ACTION' => 'Cancel'
			);
			$res = $paypal -> request('ManageRecurringPaymentsProfileStatus',$cancelParams);
			//echo '<pre>';print_r($res);echo '</pre>';
			if($res['ACK'] == 'Success'){
				service_finder_cancel_subscription($userid,'manually');
			}else{
				wp_die($msg);
			}
		}
	  }
	}
}

/*Update Job Limit*/
function service_finder_update_job_limit($userid){
global $service_finder_options, $wpdb, $service_finder_Tables;
	$role = get_user_meta($userid,'provider_role',true);
	if ($role == "package_1" || $role == "package_2" || $role == "package_3"){
	$packageNum = intval(substr($role, 8));
	
	$allowedjobapply = (!empty($service_finder_options['package'.$packageNum.'-job-apply'])) ? $service_finder_options['package'.$packageNum.'-job-apply'] : '';
	
	$period = (!empty($service_finder_options['job-apply-limit-period'])) ? $service_finder_options['job-apply-limit-period'] : '';
	$numberofweekmonth = (!empty($service_finder_options['job-apply-number-of-week-month'])) ? $service_finder_options['job-apply-number-of-week-month'] : 1;
	$numberofperiod = (!empty($service_finder_options['job-apply-number-of-week-month'])) ? $service_finder_options['job-apply-number-of-week-month'] : '';
	
	$startdate = date('Y-m-d h:i:s');
	
	if($period == 'weekly'){
		$freq = 7 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}elseif($period == 'monthly'){
		$freq = 30 * $numberofweekmonth;
		$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
	}
	
	$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$userid.'"');

	if(!empty($row)){
	$available_limits = $row->available_limits + $allowedjobapply;
	}
	
	$data = array(
			'free_limits' => $allowedjobapply,
			'available_limits' => $available_limits,
			'membership_date' => $startdate,
			'start_date' => $startdate,
			'expire_date' => $expiredate,
			);
	$where = array(
			'provider_id' => $userid,
			);		
	
	$wpdb->update($service_finder_Tables->job_limits,wp_unslash($data),$where);
	}
}

/*Get job limit cycle*/
if ( ! function_exists( 'service_finder_get_schedule_cycle' ) ) {
function service_finder_get_schedule_cycle($bookingdate,$selecteddate,$freq = ''){
	
	if(date('Y-m-d',strtotime($bookingdate)) != date('Y-m-d',strtotime($selecteddate))){
		$daysBetween = $freq + 1;
		$start = new DateTime($bookingdate);                        // Meeting origination date
		$target = new DateTime($selecteddate);                       // The given date
		$daysApart = $start->diff($target)->days;
		$nextMultipleOfDaysBetweenAfterDaysApart = ceil($daysApart/$daysBetween) * $daysBetween;
		$dateOfNextMeeting = $start->modify('+' . $nextMultipleOfDaysBetweenAfterDaysApart . 'days');
		$dateOfNextMeeting->modify('-1 day');
		$nextdate = $dateOfNextMeeting->format('Y-m-d');
		
		$fromdate = $nextdate;
		$fromdate = DateTime::createFromFormat('Y-m-d',$fromdate);
		
		$fromdate->modify('-'.$freq.' day');
		$fromdate = $fromdate->format('Y-m-d');
		
		$arr = array(
			'startdate' => $fromdate,
			'expiredate' => $nextdate,
		);
		return $arr;
	}else{
		$fromdate = $selecteddate;
		$fromdate = DateTime::createFromFormat('Y-m-d',$fromdate);
		
		$fromdate->modify('+'.$freq.' day');
		$nextdate = $fromdate->format('Y-m-d');
		
		$arr = array(
			'startdate' => $selecteddate,
			'expiredate' => $nextdate,
		);
		return $arr;
	}
	
}
}

/*Get custom cities*/
function service_finder_get_cities($country = ''){
global $wpdb, $service_finder_Tables; 
	$cities = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `countryname` = "'.$country.'"');
	return $cities;
}

add_action('wp_ajax_load_cities_by_country', 'service_finder_cities_by_country');
add_action('wp_ajax_nopriv_load_cities_by_country', 'service_finder_cities_by_country');
function service_finder_cities_by_country(){
	global $wpdb, $service_finder_Tables; 
	
	$country = (isset($_POST['country'])) ? esc_html($_POST['country']) : '';
	$country = strtolower($country);

	$cities = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `countryname` = "'.$country.'"');
	$citydropdown = '<option value="">'.esc_html__('Select City', 'service-finder').'</option>';
	if(!empty($cities)){
		foreach($cities as $city){
			$citydropdown .= '<option value="'.esc_attr($city->cityname).'">'.$city->cityname.'</option>';
		}
	}
	echo $citydropdown;
	exit;
}

$action = (isset($_POST['action'])) ? esc_html($_POST['action']) : '';

if($action == 'upload_cities'){
	global $wpdb, $service_finder_Tables;
		
	//$filename = SERVICE_FINDER_BOOKING_LIB_DIR.'/cities.csv';
	$filename = $_FILES['citycsv']['tmp_name'];
	$handle = fopen($filename, "r");
	
	$i=1;
	$wpdb->query('DELETE FROM `'.$service_finder_Tables->cities.'`');
	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if($i != 1){
			
		$chkcity = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->cities.' WHERE `cityname` = "%s" AND `countryname` = "%s"',strtolower($data[0]),strtolower($data[1])));
			if(empty($chkcity)){
			$data = array(
					'cityname' => $data[0],
					'countryname' => $data[1], 
					);
			$wpdb->insert($service_finder_Tables->cities,$data);
			}
		}
		$i++;
	}

	fclose($handle);
	
	$cityid = $wpdb->insert_id;
			
	if ($cityid > 0) {
	
		$success = array(
				'status' => 'success',
				'suc_message' => esc_html__('Cities uploaded successfully', 'service-finder'),
				);
		echo json_encode($success);
	}else{
		$error = array(
				'status' => 'error',
				'err_message' => 'Couldn&#8217;t upload cities.'
				);
		echo json_encode($error);
	
	}
	exit(0);
}	

/*Get card by country*/
function service_finder_get_cards($country = 'AR'){
	
	$cards = array();
	
	switch ($country) {
		case 'AR':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'ARGENCARD';
			$cards[] = 'CABAL';
			$cards[] = 'NARANJA';
			$cards[] = 'CENCOSUD';
			$cards[] = 'SHOPPING';
			$cards[] = 'VISA';
			break;
		case 'BR':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			$cards[] = 'DINERS';
			$cards[] = 'ELO';
			$cards[] = 'HIPERCARD';
			break;
		case 'CO':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'CODENSA';
			$cards[] = 'DINERS';
			$cards[] = 'VISA';
			break;
		case 'MX':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			break;
		case 'PA':
			$cards[] = 'MASTERCARD';
			break;
		case 'PE':
			$cards[] = 'MASTERCARD';
			$cards[] = 'AMEX';
			$cards[] = 'VISA';
			$cards[] = 'DINERS';
			break;		
	}
	
	return $cards;
}

/*Get Provider default avatar*/
function service_finder_get_default_avatar(){
global $service_finder_options;

$defaultavatar = (!empty($service_finder_options['default-avatar']['url'])) ? $service_finder_options['default-avatar']['url'] : '';

return $defaultavatar;
}

/*Add http to url*/
function service_finder_addhttp($url) {
    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "http://" . $url;
    }
    return $url;
}

/*Customer Signup*/
add_action( 'user_register', 'service_finder_customer_signup_hook', 10, 1 );
function service_finder_customer_signup_hook( $user_id ) {
global $wpdb, $service_finder_Tables;

if(service_finder_getUserRole($user_id) == 'Customer'){

$chkcustomer = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers_data.' where wp_user_id = %d',$user_id));
if(empty($chkcustomer)){
	$data = array(
			'wp_user_id' => $user_id,
			);
	
	$wpdb->insert($service_finder_Tables->customers_data,wp_unslash($data));
}
}
}

/*Generate OTP*/
add_action('wp_ajax_sendotp', 'service_finder_sendotp');
add_action('wp_ajax_nopriv_sendotp', 'service_finder_sendotp');
function service_finder_sendotp(){
global $wpdb;
		
		$pass = rand(100000, 999999);
		if(service_finder_wpmailer($_POST['emailid'],'One Time Password for confirm email id','Generated OTP is:'.$pass)) {

				echo esc_html($pass);
				
				
			} else {
					
				echo esc_html($pass);
			}
		
		
exit;
}

/*Check display basic profile or not after trial package expire*/
function service_finder_check_profile_after_trial_expire($uid){
global $wpdb, $service_finder_options;

$display_profile_trialexpire = (isset($service_finder_options['basic-profile-after-trial-expire'])) ? esc_attr($service_finder_options['basic-profile-after-trial-expire']) : '';		
$trialpackage = get_user_meta($uid, 'trial_package', true);
$providerstatus = get_user_meta($uid, 'current_provider_status', true);		
		
if($trialpackage == 'yes' && $providerstatus == 'expire' && $display_profile_trialexpire == 'no'){
return false;
}else{
return true;
}
}

/*Check display basic profile or not after trial package expire*/
function service_finder_money_format($amount){
global $service_finder_options;
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN'){
return service_finder_currencysymbol().number_format((float)$amount,2,'.','');
}else{
$local = (isset($service_finder_options['currency-format'])) ? esc_attr($service_finder_options['currency-format']) : '';
$local = get_locale();
setlocale(LC_MONETARY, $local);
return money_format(service_finder_currencysymbol().'%!.2n', $amount);
}

}


/*Claim Business*/
add_action('wp_ajax_claim_business', 'service_finder_claim_business');
add_action('wp_ajax_nopriv_claim_business', 'service_finder_claim_business');
function service_finder_claim_business(){
	global $wpdb, $service_finder_Tables, $service_finder_options;
	
	$claim_business = (!empty($service_finder_options['string-claim-business'])) ? esc_html($service_finder_options['string-claim-business']) : esc_html__('Claim Business', 'service-finder');
	
	$provider_id = (!empty($_POST['provider_id'])) ? esc_html($_POST['provider_id']) : '';
	$customer_name = (!empty($_POST['customer_name'])) ? esc_html($_POST['customer_name']) : '';
	$customer_email = (!empty($_POST['customer_email'])) ? esc_html($_POST['customer_email']) : '';
	$description = (!empty($_POST['description'])) ? esc_html($_POST['description']) : '';
	$captchaon = (!empty($_POST['captchaon'])) ? esc_html($_POST['captchaon']) : '';
	$captcha_code = (!empty($_POST['captcha_code'])) ? esc_html($_POST['captcha_code']) : '';

	if($captchaon == 1){

	if((empty($_SESSION['captcha_code_claimbusiness'] ) || strcasecmp($_SESSION['captcha_code_claimbusiness'], $captcha_code) != 0) && (strcasecmp($_SESSION['captcha_code_claimbusiness'], $captcha_code) != 0 || empty($_SESSION['captcha_code_claimbusiness'] ))){  
		$error = array(
				'status' => 'error',
				'err_message' => esc_html__('The Validation code does not match!', 'service-finder'),
				);
		echo json_encode($error);
		exit;
	}

	}
	
	$data = array(
			'provider_id' => $provider_id,
			'date' => date('Y-m-d h:i:s'),
			'fullname' => $customer_name,
			'email' => $customer_email,
			'message' => $description,
			'status' => 'pending',
			);

	$wpdb->insert($service_finder_Tables->claim_business,wp_unslash($data));
	
	$claim_id = $wpdb->insert_id;
	
	$adminemail = get_option( 'admin_email' );
	
	if($service_finder_options['claimbusiness-to-admin-subject'] != ""){
		$subject = $service_finder_options['claimbusiness-to-admin-subject'];
	}else{
		$subject = $claim_business;
	}
	
	if(!empty($service_finder_options['claimbusiness-to-admin'])){
		$message = $service_finder_options['claimbusiness-to-admin'];
	}else{
		$message = $claim_business.' for following profile

		Provider Name: %PROVIDERNAME%
		
		Provider Email: %PROVIDEREMAIL%
		
		Provider Profile: %PROVIDERPROFILELINK%
		
		Customer Name: %CUSTOMERNAME%
		
		Email: %EMAIL%
		
		Description: %DESCRIPTION%';
	}
	
	$getProvider = new SERVICE_FINDER_searchProviders();
	$providerInfo = $getProvider->service_finder_getProviderInfo(esc_attr($provider_id));
	
	$userLink = service_finder_get_author_url($provider_id);
	
	$tokens = array('%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPROFILELINK%','%CUSTOMERNAME%','%EMAIL%','%DESCRIPTION%');
	$replacements = array(service_finder_get_providername_with_link($provider_id),'<a href="mailto:'.$providerInfo->email.'">'.$providerInfo->email.'</a>',$userLink,$customer_name,$customer_email,$description);
	$msg_body = str_replace($tokens,$replacements,$message);
	
	service_finder_wpmailer($adminemail,$subject,$msg_body);
			
	if ( ! $claim_id ) {
		$error = array(
				'status' => 'error',
				'err_message' => sprintf(esc_html__('Couldn&#8217;t %s.', 'service-finder'),$claim_business)
				);
		echo json_encode($error);
	}else{
		$success = array(
				'status' => 'success',
				'suc_message' => sprintf(esc_html__('%s successfully. Pleast wait for approve', 'service-finder'),$claim_business)
				);
		echo json_encode($success);
	}
	exit;
}

/*Check availability method*/
function service_finder_availability_method($provider_id){
global $service_finder_options;

$adminavailabilitybasedon = (!empty($service_finder_options['availability-based-on'])) ? esc_html($service_finder_options['availability-based-on']) : '';

$settings = service_finder_getProviderSettings($provider_id);

$availability_based_on = (!empty($settings['availability_based_on'])) ? $settings['availability_based_on'] : '';

if($adminavailabilitybasedon == 'timeslots' || ($adminavailabilitybasedon == 'both' && $availability_based_on == 'timeslots')){
	return 'timeslots';
}elseif($adminavailabilitybasedon == 'starttime' || ($adminavailabilitybasedon == 'both' && $availability_based_on == 'starttime')){
	return 'starttime';
}else{
	return 'timeslots';
}

}
//$g = service_finder_radius_search(26.9064744,75.7728014,10);
//echo '<pre>';print_r($g);echo '</pre>';
/*Get earch radius from given distance*/
function service_finder_radius_search($latitude,$longitude,$d){
global $service_finder_options;

$radiussearchunit = (isset($service_finder_options['radius-search-unit'])) ? esc_attr($service_finder_options['radius-search-unit']) : 'mi';
		
if($radiussearchunit == 'km'){
$r = 6371; //earth's radius in km
}else{
$r = 3959; //earth's radius in miles
}



$latN = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
        + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(0))));

$latS = rad2deg(asin(sin(deg2rad($latitude)) * cos($d / $r)
        + cos(deg2rad($latitude)) * sin($d / $r) * cos(deg2rad(180))));

$lonE = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(90))
        * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
        - sin(deg2rad($latitude)) * sin(deg2rad($latN))));

$lonW = rad2deg(deg2rad($longitude) + atan2(sin(deg2rad(270))
        * sin($d / $r) * cos(deg2rad($latitude)), cos($d / $r)
        - sin(deg2rad($latitude)) * sin(deg2rad($latN))));


$radius = array(
			'latN' => $latN,
			'latS' => $latS,
			'lonE' => $lonE,
			'lonW' => $lonW,
			);
return $radius;			
}

/*Check address info crediantials*/
function service_finder_check_address_info_access(){
global $service_finder_options, $current_user;

$onlyregistereduser = (!empty($service_finder_options['only-registered-user'])) ? esc_html($service_finder_options['only-registered-user']) : '';

if($onlyregistereduser){
	if(is_user_logged_in() && ( service_finder_getUserRole($current_user->ID) == 'administrator' || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'Provider' )){
		return true;
	}else{
		return false;
	}
}else{
	return true;
}
}

/*Translate Static Status Messages*/
function service_finder_translate_static_status_string($status){
global $wpdb;

	switch (strtolower($status)) {
		case 'pending':
			$returnstatus = esc_html__('Pending','service-finder');
			break;
		case 'completed':
			$returnstatus = esc_html__('Completed','service-finder');
			break;
		case 'cancel':
			$returnstatus = esc_html__('Cancelled','service-finder');
			break;
		case 'need-approval':
			$returnstatus = esc_html__('Need-Approval','service-finder');
			break;
		case 'free':
			$returnstatus = esc_html__('Free','service-finder');
			break;
		case 'paid':
			$returnstatus = esc_html__('Paid','service-finder');
			break;
		case 'overdue':
			$returnstatus = esc_html__('Overdue','service-finder');
			break;	
		case 'upcoming':
			$returnstatus = esc_html__('Upcoming','service-finder');
			break;	
		case 'past':
			$returnstatus = esc_html__('Past','service-finder');
			break;
		case 'stripe':
			$returnstatus = esc_html__('Stripe','service-finder');
			break;
		case 'paypal':
			$returnstatus = esc_html__('Paypal','service-finder');
			break;
		case 'wired':
			$returnstatus = esc_html__('Wired','service-finder');
			break;
		default:
			$returnstatus = ucfirst($status);
			break;												
	}
	
	return $returnstatus;

}

/*Send Booking Reminder mail to provider*/
function service_finder_SendBookingReminderMailToProvider($maildata = ''){
	global $service_finder_options, $service_finder_Tables, $wpdb;
	
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	
	if(!empty($service_finder_options['booking-reminder-to-provider'])){
		$message .= $service_finder_options['booking-reminder-to-provider'];
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
			
			Amount: %AMOUNT%';
	}
		
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
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
		}
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if($service_finder_options['booking-reminder-to-provider-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-provider-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
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
/*Send Booking Reminder mail to customer*/
function service_finder_SendBookingReminderMailToCustomer($maildata = ''){
	global $service_finder_options, $service_finder_Tables, $wpdb;
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	
	if(!empty($service_finder_options['booking-reminder-to-customer'])){
		$message .= $service_finder_options['booking-reminder-to-customer'];
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
			
			Amount: %AMOUNT%';
	}
	
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
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
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($maildata['total']),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);

		if($service_finder_options['booking-reminder-to-customer-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-customer-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
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
/*Send Booking Reminder mail to admin*/
function service_finder_SendBookingReminderMailToAdmin($maildata = ''){
	global $service_finder_options, $wpdb, $service_finder_Tables;
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$maildata['provider_id']));
	$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$maildata['booking_customer_id']));
	
	$bookingpayment_mode = (!empty($maildata['type'])) ? $maildata['type'] : '';
	
	$payent_mode = ($bookingpayment_mode != '') ? $bookingpayment_mode : 'free';
	$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
	
	$message = '';
	if(!empty($service_finder_options['booking-reminder-to-admin'])){
		$message .= $service_finder_options['booking-reminder-to-admin'];
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
			
			Amount: %AMOUNT%';
	}
		
		$tokens = array('%DATE%','%STARTTIME%','%ENDTIME%','%MEMBERNAME%','%PROVIDERNAME%','%PROVIDEREMAIL%','%PROVIDERPHONE%','%CUSTOMERNAME%','%CUSTOMEREMAIL%','%CUSTOMERPHONE%','%CUSTOMERPHONE2%','%ADDRESS%','%APT%','%CITY%','%STATE%','%ZIPCODE%','%COUNTRY%','%SERVICES%','%PAYMENTMETHOD%','%AMOUNT%','%SHORTDESCRIPTION%');
		
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
		
		$replacements = array(date('Y-m-d',strtotime($maildata['date'])),$maildata['start_time'],$maildata['end_time'],$membername,service_finder_get_providername_with_link($providerInfo->wp_user_id),$providerInfo->email,service_finder_get_contact_info($providerInfo->phone,$providerInfo->mobile),$customerInfo->name,$customerInfo->email,$customerInfo->phone,$customerInfo->phone2,$customerInfo->address,$customerInfo->apt,$customerInfo->city,$customerInfo->state,$customerInfo->zipcode,$customerInfo->country,$services,ucfirst($payent_mode),service_finder_money_format($bookingamount),$customerInfo->description);
		$msg_body = str_replace($tokens,$replacements,$message);
		
		if($service_finder_options['booking-reminder-to-admin-subject'] != ""){
			$msg_subject = $service_finder_options['booking-reminder-to-admin-subject'];
		}else{
			$msg_subject = esc_html__('Booking Reminder Notification', 'service-finder');
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

function service_finder_get_youtube_image($e,$size = ''){
	//GET THE URL
	$url = $e;
	$thumb = '';
	$queryString = parse_url($url, PHP_URL_QUERY);

	parse_str($queryString, $params);

	$v = $params['v'];  
	//DISPLAY THE IMAGE
	if(strlen($v)>0){
		if($size == 'full'){
		$thumb = "<img src='http://img.youtube.com/vi/$v/0.jpg' />";
		}else{
		$thumb = "<img src='http://img.youtube.com/vi/$v/default.jpg' width='150' />";
		}
	}
	return $thumb;
}

/*Set Social Cookie*/
add_action('wp_ajax_set_social_cookie', 'service_finder_set_social_cookie');
add_action('wp_ajax_nopriv_set_social_cookie', 'service_finder_set_social_cookie');
function service_finder_set_social_cookie(){
global $wpdb, $service_finder_Tables;
	unset($_SESSION['social_account_role']);
	$target = (isset($_POST['target'])) ? esc_html($_POST['target']) : '';
	$target = ltrim($target,'#');
	
	if($target == "tab1" || $target == "customertab"){
		$_SESSION['social_account_role'] = "customer";
	}elseif($target == "tab2" || $target == "providertab"){
		$_SESSION['social_account_role'] = "provider";
	}
	exit(0);
}

/*Check display basic feature after social login*/
function service_finder_check_display_features_after_social_login($provider_id){
global $service_finder_options, $current_user;

$socialaccount = get_user_meta($provider_id,'social_provider',true);
$providerrole = get_user_meta($provider_id,'provider_role',true);

if($socialaccount != "" && $providerrole == ""){

$showfeatures = (!empty($service_finder_options['display-basicfeature-after-sociallogin'])) ? esc_html($service_finder_options['display-basicfeature-after-sociallogin']) : '';
	
	if($showfeatures){
		return true;
	}else{
		return false;
	}
}else{
	return true;
}

}

/*Add to google calendar*/
function service_finder_addto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
			$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata->booking_customer_id));
			$offset = 0;
			
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			$dateTimeS = service_finder_date_format_RFC3339($str_date, $offset);
			if($bookingdata->end_time != ""){
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->end_time);
			}else{
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			}
			$dateTimeE = service_finder_date_format_RFC3339($str_date, $offset);
			$address = $customerInfo->apt.' '.$customerInfo->address.' '.$customerInfo->city.' '.$customerInfo->country;
			
			if(get_option('timezone_string') != ""){
			$timezone = get_option('timezone_string');
			}
			
			$bookingtitle = (!empty($service_finder_options['google-calendar-booking-title'])) ? $service_finder_options['google-calendar-booking-title'] : esc_html__('Service Finder Booking', 'service-finder');
			
			$tokens = array('%CUSTOMERNAME%','%CUSTOMEREMAIL%');
			
			$replacements = array($customerInfo->name,$customerInfo->email);
			
			$bookingtitle = str_replace($tokens,$replacements,$bookingtitle);
					
			$event = new Google_Service_Calendar_Event(array(
			  'summary' => $bookingtitle,
			  'location' => $address,
			  'description' => sprintf(esc_html__('Booking Made by %s', 'service-finder'),$customerInfo->name),
			  'start' => array(
				'dateTime' => $dateTimeS,
				'timeZone' => $timezone,
			  ),
			  'end' => array(
				'dateTime' => $dateTimeE,
				'timeZone' => $timezone,
			  ),
			  'attendees' => array(
				array('email' => $customerInfo->email)
			  ),
			));
			
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$event = $cal->events->insert($calendarId, $event);
			$bookdata = array(
					'gcal_booking_url' => $event->htmlLink, 
					'gcal_booking_id' => $event->id, 
					);
					
			$where = array(
					'id' => $booking_id 
					);		
	
			$wpdb->update($service_finder_Tables->bookings,wp_unslash($bookdata),$where);

			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*Update to google calendar*/
function service_finder_updateto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
			$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			$customerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->customers.' WHERE `id` = %d',$bookingdata->booking_customer_id));
			$offset = 0;
			
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			$dateTimeS = service_finder_date_format_RFC3339($str_date, $offset);
			if($bookingdata->end_time != ""){
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->end_time);
			}else{
			$str_date = strtotime($bookingdata->date.' '.$bookingdata->start_time);
			}
			$dateTimeE = service_finder_date_format_RFC3339($str_date, $offset);
			
			if(get_option('timezone_string') != ""){
			$timezone = get_option('timezone_string');
			}
					
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$event = $cal->events->get($calendarId,$bookingdata->gcal_booking_id);
			
			$start = new Google_Service_Calendar_EventDateTime();
			$start->setDateTime($dateTimeS);
	        $event->setStart($start);
			
			$end = new Google_Service_Calendar_EventDateTime();
			$end->setDateTime($dateTimeE);
	        $event->setEnd($end);
			
			$updatedEvent = $cal->events->update($calendarId, $event->getId(), $event);

			$updatedEvent->getUpdated();

			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*Cancel to google calendar*/
function service_finder_cancelto_google_calendar($booking_id,$provider_id){
session_start();
global $service_finder_options, $current_user,  $service_finder_Tables, $wpdb;
		$flag = 0;
		require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
		
		$google_client_id = get_user_meta($provider_id,'google_client_id',$google_client_id);
		$google_client_secret = get_user_meta($provider_id,'google_client_secret',$google_client_secret);
		$google_calendar_id = get_user_meta($provider_id,'google_calendar_id',$google_calendar_id);
		
		$client = new Google_Client();
		$client->setClientId($google_client_id);
		$client->setClientSecret($google_client_secret);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$client->setRedirectUri($redirect_uri);
		$client->setScopes('https://www.googleapis.com/auth/calendar');
		
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
			$flag = 1;
		}elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			$client->setAccessToken(service_finder_get_gcal_access_token($provider_id));
			$flag = 1;
		}
		
		if($client->isAccessTokenExpired()) {
			 try{
			 
			 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $newaccesstoken = json_decode($_SESSION['access_token']);
			  $client->refreshToken($newaccesstoken->refresh_token);
			
			 }elseif(service_finder_get_gcal_access_token($provider_id) != ""){
			  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($provider_id));
			  $client->refreshToken($newaccesstoken->refresh_token);
			 }
			 
			 } catch (Exception $e) {
				
			 }
	
		 }
		
		if($flag == 1){
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$booking_id));
			try{
			$calendarId = $google_calendar_id;
			$cal = new Google_Service_Calendar($client);
			$cal->events->delete($calendarId, $bookingdata->gcal_booking_id);
			
			$data = array(
						'gcal_booking_url' => '',
						'gcal_booking_id' => ''
						);
	
			$where = array(
						'id' => $booking_id
						);
						
			$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);
			
			} catch (Exception $e) {
			//echo '<pre>';print_r($e);
			}
			return true;
		}
}

/*google calendar date format*/
function service_finder_date_format_RFC3339($timestamp = 0, $offset = 0) {
        if(get_option('timezone_string') != ""){
		$timezone = get_option('timezone_string');
		}else{
		$timezone = 'Asia/Kolkata';
		}
        $date = new DateTime(date('Y-m-d H:i:s', $timestamp), new DateTimeZone($timezone));
        return $date->format(DateTime::RFC3339);
}

if (isset($_GET['code']) && isset($_GET['action']) && $_GET['action'] == 'googleoauth-callback') {
    session_start();
	require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
	
	$providerid = isset($_SESSION['providerid']) ? esc_html($_SESSION['providerid']) : '';
	$code = isset($_GET['code']) ? $_GET['code'] : '';
	
	$client_id = get_user_meta($providerid,'google_client_id',true);
	$client_secret = get_user_meta($providerid,'google_client_secret',true);
	$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
	
	$client = new Google_Client();
	$client->setClientId($client_id);
	$client->setClientSecret($client_secret);
	$client->setRedirectUri($redirect_uri);
	$client->setScopes('https://www.googleapis.com/auth/calendar');	
	try{	
    $client->authenticate($_GET['code']);
	} catch (Exception $e) {
	//echo '<pre>';print_r($e);
	}
	
    $_SESSION['access_token'] = $client->getAccessToken();
	update_user_meta($providerid,'gcal_access_token',$_SESSION['access_token']);
	
	$account_url = service_finder_get_url_by_shortcode('[service_finder_my_account]');
	
    header('Location: ' . filter_var($account_url, FILTER_SANITIZE_URL));
	die;
}

/*google calendar date format*/
function service_finder_get_gcal_access_token($providerid) {
	return get_user_meta($providerid,'gcal_access_token',true);
}

/*theme style*/
function service_finder_themestyle() {
	global $service_finder_options;
	
	$themestyle = (isset($service_finder_options['theme-style'])) ? esc_html($service_finder_options['theme-style']) : '';
	return $themestyle;
}

/*Load branch loaction map*/
add_action('wp_ajax_load_branch_marker', 'service_finder_load_branch_marker');
add_action('wp_ajax_nopriv_load_branch_marker', 'service_finder_load_branch_marker');

function service_finder_load_branch_marker(){
global $wpdb,$service_finder_options, $service_finder_Tables;

$branchid = (isset($_POST['branchid'])) ? esc_attr($_POST['branchid']) : '';
$userid = (isset($_POST['userid'])) ? esc_attr($_POST['userid']) : '';

$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->branches.' WHERE id = %d',$branchid));

if(!empty($res)){

$getProvider = new SERVICE_FINDER_searchProviders();
$providerInfo = $getProvider->service_finder_getProviderInfo(esc_attr($userid));

$userLink = service_finder_get_author_url($providerInfo->wp_user_id);
						if(!empty($providerInfo->avatar_id) && $providerInfo->avatar_id > 0){
							$src  = wp_get_attachment_image_src( $providerInfo->avatar_id, 'service_finder-provider-thumb' );
							$src  = $src[0];
						}else{
							$src  = '';
						}
						$icon = service_finder_getCategoryIcon(get_user_meta($providerInfo->wp_user_id,'primary_category',true));
						if($icon == ""){
						$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
						}
						
						$markeraddress = service_finder_getAddress($providerInfo->wp_user_id);
		
						if($res->zoomlevel != ""){
							$zoom_level = $res->zoomlevel;
						}else{
							$zoom_level = get_user_meta($providerInfo->wp_user_id,'zoomlevel',true);
						
							if($zoom_level == ""){
							$zoom_level = (!empty($service_finder_options['zoom-level'])) ? $service_finder_options['zoom-level'] : 14;
							}
						}
				
						
						$companyname = service_finder_getCompanyName($providerInfo->wp_user_id);
						
						$marker = '["'.stripcslashes($providerInfo->full_name).'","'.$providerInfo->lat.'","'.$providerInfo->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$providerInfo->wp_user_id.'","'.service_finder_getCategoryName(get_user_meta($providerInfo->wp_user_id,'primary_category',true)).'","'.stripcslashes($markeraddress).'","'.stripcslashes($companyname).'"]';
						
						//$marker = '["","'.$providerInfo->lat.'","'.$providerInfo->long.'","","","","","","",""]';
						
						$resarr = array(
									'lat' => $res->lat,
									'long' => $res->long,
									'zoomlevel' => $zoom_level,
									'markers' => $marker
								);
						
						echo json_encode($resarr);		

}
exit;
}		

/*Check if request a quote form show to logged in user or without logged in user*/
function service_finder_request_quote_for_loggedin_user(){
global $service_finder_options;

$afterlogin = (!empty($service_finder_options["request-quote-after-login"])) ? esc_html($service_finder_options["request-quote-after-login"]) : "";

	if($afterlogin){
		if(is_user_logged_in()){
			return true;
		}else{
			return false;
		}
		
	}else{
		return true;
	}
}

/*Check is user is login from socail account*/
function service_finder_is_social_user($userid){
global $service_finder_options, $current_user;

	$socialaccount = get_user_meta($userid,'social_provider',true);
	
	if($socialaccount != ""){
	return true;
	}else{
	return false;
	}
}

/*Searched provider services*/
function service_finder_get_searched_services($provider_id,$keyword = '',$minprice = 0,$maxprice = 0){
global $wpdb, $service_finder_Tables, $service_finder_options;

if($minprice != '' && $maxprice != '' && $maxprice > 0 && $keyword == ''){

	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (cost BETWEEN '.$minprice.' AND '.$minprice.')');

}elseif($minprice == 0 && $maxprice == 0 && $keyword != ''){
	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (service_name LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")');

}elseif($minprice != '' && $maxprice != '' && $maxprice > 0 && $keyword != ''){
	$services = $wpdb->get_results('SELECT * FROM '.$service_finder_Tables->services.' WHERE `wp_user_id` = '.$provider_id.' AND (cost BETWEEN '.$minprice.' AND '.$maxprice.') AND (service_name LIKE "%'.$keyword.'%" OR description LIKE "%'.$keyword.'%")');
}else{
	$services = '';
}
	
	return $services;

}


/*Get Provider name with link*/
function service_finder_get_providername_with_link($provider_id){
	global $service_finder_Tables, $wpdb;
		
	$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$provider_id));
		
	$userLink = service_finder_get_author_url($provider_id);
	
	$providerlink = '<a href="'.esc_url($userLink).'" target="_blank">'.esc_html($providerInfo->full_name).'</a>';
		
	return $providerlink;

}

/*Get Provider name with link*/
function service_finder_getServiceGroups($provider_id){
	global $service_finder_Tables, $wpdb;
		
	$groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_groups.' WHERE `provider_id` = %d',$provider_id));
		
	if(!empty($groups)){	
	return $groups;
	}else{
	return '';
	}

}

/*Get video thumbnail*/
function service_finder_identify_videos($embeded_code,$size = ''){
		$fbfind   = '//www.facebook.com';
		$fbpos = strpos($embeded_code, $fbfind);
		
		if ($fbpos !== false) {
			if (preg_match("~(?:t\.\d+/)?(\d+)~i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				
				$xml = file_get_contents('http://graph.facebook.com/' . $videoid); 
			    $result = json_decode($xml); 
				if($size == 'full'){
				$thumburl = $result->format[2]->picture; 
				$thumb = "<img src='".$thumburl."' />";
				}else{
				$thumburl = $result->format[1]->picture; 
				$thumb = "<img src='".$thumburl."' width='150' />";
				}
				
				
		    }
		
		}
		
		$ytfind   = 'youtube.com';
		$ytpos = strpos($embeded_code, $ytfind);
		
		if ($ytpos !== false) {
			 if (preg_match("/(?:.*)v=([a-zA-Z0-9]*)/i", $embeded_code, $matches)) {
				$thumb = service_finder_get_youtube_image($embeded_code,$size);
		    }
		
		}
		
		$vmfind   = 'vimeo.com';
		$vmpos = strpos($embeded_code, $vmfind);
		
		if ($vmpos !== false) {
			 if (preg_match("/(?:.*)\/([0-9]*)/i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				if($videoid != ""){
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$videoid.".php"));
				
				if($size == 'full'){
				$thumburl = $hash[0]['thumbnail_large'];
				$thumb = "<img src='".$thumburl."' />";
				}else{
				$thumburl = $hash[0]['thumbnail_medium'];
				$thumb = "<img src='".$thumburl."' width='150' />";
				}
				}
		    }
		
		}
		
		return $thumb;
}		

/*Get video type*/
function service_finder_get_video_type($embeded_code){
		$fbfind   = '//www.facebook.com';
		$fbpos = strpos($embeded_code, $fbfind);
		
		if ($fbpos !== false) {
			if (preg_match("~(?:t\.\d+/)?(\d+)~i", $embeded_code, $matches)) {
				$videotype = 'facebook';
			}
		
		}
		
		$ytfind   = 'youtube.com';
		$ytpos = strpos($embeded_code, $ytfind);
		
		if ($ytpos !== false) {
			 if (preg_match("/(?:.*)v=([a-zA-Z0-9]*)/i", $embeded_code, $matches)) {
				$videotype = 'youtube';
		    }
		
		}
		
		$vmfind   = 'vimeo.com';
		$vmpos = strpos($embeded_code, $vmfind);
		
		if ($vmpos !== false) {
			 if (preg_match("/(?:.*)\/([0-9]*)/i", $embeded_code, $matches)) {
		   		$videotype = 'vimeo';
		    }
		
		}
		
		return $videotype;
}	

