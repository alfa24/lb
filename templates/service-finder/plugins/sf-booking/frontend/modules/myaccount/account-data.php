<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/* Submit Provider Form via Ajax*/
add_action('wp_ajax_update_user', 'service_finder_user_update');
add_action('wp_ajax_nopriv_update_user', 'service_finder_user_update');

function service_finder_user_update(){
global $wpdb, $service_finder_Errors;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/MyAccount.php';
$updateProfile = new SERVICE_FINDER_MyAccount();
$updateProfile->service_finder_updateUserProfile($_POST);
exit;
}

/* Submit Customer Form via Ajax*/
add_action('wp_ajax_update_customer', 'service_finder_customer_update');
add_action('wp_ajax_nopriv_update_customer', 'service_finder_customer_update');

function service_finder_customer_update(){
global $wpdb, $service_finder_Errors;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/MyAccount.php';
$updateProfile = new SERVICE_FINDER_MyAccount();
$updateProfile->service_finder_updateCustomerProfile($_POST);
exit;
}

/*Identity check */
add_action('wp_ajax_upload_identity', 'service_finder_upload_identity');
function service_finder_upload_identity(){
global $wpdb, $service_finder_Errors;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/MyAccount.php';
$uploadIdentity = new SERVICE_FINDER_MyAccount();
$uploadIdentity->service_finder_uploadIdentity($_POST);
exit;
}

/*Get my current location*/
add_action('wp_ajax_get_mycurrent_location', 'service_finder_get_mycurrent_location');
function service_finder_get_mycurrent_location(){
global $wpdb, $service_finder_Errors;
		
		$providerid = (!empty($_POST['providerid'])) ? sanitize_text_field($_POST['providerid']) : '';
		$address = (!empty($_POST['address'])) ? sanitize_text_field($_POST['address']) : '';
		
		$lat = get_user_meta($providerid,'providerlat',true);
		$lng = get_user_meta($providerid,'providerlng',true);
		
		$my_location = get_user_meta($providerid,'my_location',true);
		
		if(($lat == '' && $lng == '') || $my_location != $address){
		$address = str_replace(" ","+",$address);
		$res = service_finder_getLatLong($address);
		$lat = $res['lat'];
		$lng = $res['lng'];
		}
		
		$success = array(
				'status' => 'success',
				'lat' => esc_html($lat),
				'lng' => esc_html($lng)
				);
		echo json_encode($success);
exit;
}

/* Submit Provider Form via Ajax*/
add_action('wp_ajax_claimbusiness', 'service_finder_claimbusiness');
add_action('wp_ajax_nopriv_claimbusiness', 'service_finder_claimbusiness');
function service_finder_claimbusiness(){
global $wpdb;
		$providerid = (!empty($_POST['providerid'])) ? sanitize_text_field($_POST['providerid']) : '';
		$status = (!empty($_POST['status'])) ? sanitize_text_field($_POST['status']) : '';
		
		update_user_meta($providerid,'claimbusiness',$status);
		
		if($status == 'enable'){
			$succmsg = esc_html__('Claim business successfully enabled for this profile.', 'service-finder');
		}else{
			$succmsg = esc_html__('Claim business successfully disabled for this profile.', 'service-finder');
		}
		
		$success = array(
				'status' => 'success',
				'suc_message' => $succmsg
				);
		echo json_encode($success);
		exit;
}

/* Submit Provider Form via Ajax*/
add_action('wp_ajax_update_gcal_info', 'service_finder_update_gcal_info');
add_action('wp_ajax_nopriv_update_gcal_info', 'service_finder_update_gcal_info');
function service_finder_update_gcal_info(){
global $wpdb, $service_finder_Errors;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/MyAccount.php';
$updateGcalinfo = new SERVICE_FINDER_MyAccount();
$updateGcalinfo->service_finder_updateGcalInfo($_POST);
exit;
}

/* Submit Provider Form via Ajax*/
add_action('wp_ajax_identify_video_type', 'service_finder_identify_video_type');
function service_finder_identify_video_type(){
global $wpdb, $service_finder_Errors;
		
		$embeded_code = (!empty($_POST['embeded_code'])) ? sanitize_text_field($_POST['embeded_code']) : '';
		
		$fbfind   = '//www.facebook.com';
		$fbpos = strpos($embeded_code, $fbfind);
		
		if ($fbpos !== false) {
			if (preg_match("~(?:t\.\d+/)?(\d+)~i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				$videotype = 'facebook';
				$xml = file_get_contents('http://graph.facebook.com/' . $videoid); 
			    $result = json_decode($xml); 
				$thumb = $result->format[1]->picture; 
		    }
		
		}
		
		$ytfind   = 'youtube.com';
		$ytpos = strpos($embeded_code, $ytfind);
		
		if ($ytpos !== false) {
			 if (preg_match("/(?:.*)v=([a-zA-Z0-9]*)/i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				$videotype = 'youtube';
				$thumb = '';
		    }
		
		}
		
		$vmfind   = 'vimeo.com';
		$vmpos = strpos($embeded_code, $vmfind);
		
		if ($vmpos !== false) {
			 if (preg_match("/(?:.*)\/([0-9]*)/i", $embeded_code, $matches)) {
		   		$videoid = $matches[1];
				$videotype = 'vimeo';
				if($videoid != ""){
				$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/".$videoid.".php"));
				
				$thumb = $hash[0]['thumbnail_medium'];
				}
		    }
		
		}
		
		$success = array(
				'videoid' => $videoid,
				'videotype' => $videotype,
				'thumburl' => $thumb,
				);
		echo json_encode($success);
exit;
}
