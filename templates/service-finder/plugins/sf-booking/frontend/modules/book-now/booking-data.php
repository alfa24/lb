<?php
ob_start();
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');

/*Boking via paypal*/
if(isset($_POST['bookingpayment_mode']) && ($_POST['bookingpayment_mode'] == 'paypal')){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';

$service_finder_options = get_option('service_finder_options');
$paypal = service_finder_plugin_global_vars('paypal');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$service_finder_Errors = service_finder_plugin_global_vars('service_finder_Errors');
$registerErrors = service_finder_plugin_global_vars('registerErrors');
$registerMessages = service_finder_plugin_global_vars('registerMessages');

$provider = isset($_POST['provider']) ? $_POST['provider'] : '';
$totalcost = isset($_POST['totalcost']) ? $_POST['totalcost'] : '';
$settings = service_finder_getProviderSettings($provider);

$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';

if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){

	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
	$totalcost = $totalcost + $adminfee;
}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
}else{
	$adminfee = 0;
}

/*Initialize Paypal Credentials*/
$creds = array();

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){

	$paypalusername = (!empty($service_finder_options['paypal-username'])) ? $service_finder_options['paypal-username'] : '';
	$paypalpassword = (!empty($service_finder_options['paypal-password'])) ? $service_finder_options['paypal-password'] : '';
	$paypalsignatue = (!empty($service_finder_options['paypal-signatue'])) ? $service_finder_options['paypal-signatue'] : '';

}elseif($pay_booking_amount_to == 'provider'){

	$paypalusername = (isset($settings['paypalusername'])) ? $settings['paypalusername'] : '';
	$paypalpassword = (isset($settings['paypalpassword'])) ? $settings['paypalpassword'] : '';
	$paypalsignatue = (isset($settings['paypalsignatue'])) ? $settings['paypalsignatue'] : '';

}

$paypalCreds['USER'] = esc_html($paypalusername);
$paypalCreds['PWD'] = esc_html($paypalpassword);
$paypalCreds['SIGNATURE'] = esc_html($paypalsignatue);

$sandbox = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';
$paypalType = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';

$paypalTypeBool = (!empty($paypalType)) ? true : false;

$paypal = new Paypal($paypalCreds,$paypalTypeBool);
	$userLink = service_finder_get_author_url($provider);
	$returnUrl = add_query_arg( array('booking_made' => 'success'), $userLink );
	
	// Single payments
	$cancelUrl = add_query_arg( array('booking_made' => 'cancel'), $userLink );
	
	$getMincost = new SERVICE_FINDER_BookNow();

	
	$urlParams = array(
		'RETURNURL' => $returnUrl,
		'CANCELURL' => $cancelUrl
	);
					
	$orderParams = array(
		'PAYMENTREQUEST_0_AMT' => $totalcost,
		'PAYMENTREQUEST_0_SHIPPINGAMT' => '0',
		'PAYMENTREQUEST_0_CURRENCYCODE' => strtoupper(service_finder_currencycode()),
		'PAYMENTREQUEST_0_ITEMAMT' => $totalcost
	);
	$itemParams = array(
		'L_PAYMENTREQUEST_0_NAME0' => 'Payment via paypal',
		'L_PAYMENTREQUEST_0_DESC0' => 'Booking Made',
		'L_PAYMENTREQUEST_0_AMT0' => $totalcost,
		'L_PAYMENTREQUEST_0_QTY0' => '1'
	);
	$params = $urlParams + $orderParams + $itemParams;
	$response = $paypal -> request('SetExpressCheckout',$params);
	$errors = new WP_Error();
	if(!$response){
		$errorMessage = esc_html__( 'ERROR: Bad paypal API settings! Check paypal api credentials in admin settings!', 'service-finder' );
		$detailErrorMessage = $paypal->getErrors();
		$errors->add( 'bad_paypal_api', $errorMessage . ' ' . $detailErrorMessage );
		$registerErrors = $errors;
	}
	
	// Request successful
	if(is_array($response) && $response['ACK'] == 'Success') {
		// write token to DB
		$token = $response['TOKEN'];

		$saveBooking = new SERVICE_FINDER_BookNow();
		$saveBooking->service_finder_SaveBooking($_POST,$token,'',$adminfee);
		// go to payment site
		header( 'Location: https://www.'.$sandbox.'paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token) );
		die();

	} else {
		$errorMessage = esc_html__( 'ERROR: Bad paypal API settings! Check paypal api credentials in admin settings!', 'service-finder' );
		$detailErrorMessage = (isset($response['L_LONGMESSAGE0'])) ? $response['L_LONGMESSAGE0'] : '';
		$errors->add( 'bad_paypal_api', $errorMessage . ' ' . $detailErrorMessage );
		$registerErrors = $errors;
	}
}

// check token (paypal merchant authorization) and Do Payment
if(isset($_GET['booking_made']) && ($_GET['booking_made'] == 'success') && !empty($_GET['token'])) {

$service_finder_options = get_option('service_finder_options');
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');

$paypaltoken = (!empty($_GET['token'])) ? esc_html($_GET['token']) : '';

$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `paypal_token` = "%s"',$paypaltoken),ARRAY_A);

$settings = service_finder_getProviderSettings($bookingdata['provider_id']);
/*Initialize Paypal Credentials*/
$creds = array();
$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){

	$paypalusername = (!empty($service_finder_options['paypal-username'])) ? $service_finder_options['paypal-username'] : '';
	$paypalpassword = (!empty($service_finder_options['paypal-password'])) ? $service_finder_options['paypal-password'] : '';
	$paypalsignatue = (!empty($service_finder_options['paypal-signatue'])) ? $service_finder_options['paypal-signatue'] : '';

}elseif($pay_booking_amount_to == 'provider'){

	$paypalusername = (isset($settings['paypalusername'])) ? $settings['paypalusername'] : '';
	$paypalpassword = (isset($settings['paypalpassword'])) ? $settings['paypalpassword'] : '';
	$paypalsignatue = (isset($settings['paypalsignatue'])) ? $settings['paypalsignatue'] : '';

}

$paypalCreds['USER'] = esc_html($paypalusername);
$paypalCreds['PWD'] = esc_html($paypalpassword);
$paypalCreds['SIGNATURE'] = esc_html($paypalsignatue);

$sandbox = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';
$paypalType = (isset($service_finder_options['paypal-type']) && $service_finder_options['paypal-type'] == 'live') ? '' : 'sandbox.';

$paypalTypeBool = (!empty($paypalType)) ? true : false;

$paypal = new Paypal($paypalCreds,$paypalTypeBool);

	$checkoutDetails = $paypal->request('GetExpressCheckoutDetails', array('TOKEN' => $_GET['token']));
	if( is_array($checkoutDetails) && ($checkoutDetails['ACK'] == 'Success') ) {
				//  Single payment
				$params = array(
					'TOKEN' => $checkoutDetails['TOKEN'],
					'PAYERID' => $checkoutDetails['PAYERID'],
					'PAYMENTACTION' => 'Sale',
					'PAYMENTREQUEST_0_AMT' => $checkoutDetails['PAYMENTREQUEST_0_AMT'], // Same amount as in the original request
					'PAYMENTREQUEST_0_CURRENCYCODE' => $checkoutDetails['CURRENCYCODE'] // Same currency as the original request
				);
				$singlePayment = $paypal -> request('DoExpressCheckoutPayment',$params);
				// IF PAYMENT OK
				if( is_array($singlePayment) && $singlePayment['ACK'] == 'Success') {
					require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
					// We'll fetch the transaction ID for internal bookkeeping
					$transactionId = $singlePayment['PAYMENTINFO_0_TRANSACTIONID'];
					
					$bookdata = array(
							'status' => 'Pending',
							'txnid' => $transactionId,
							);
					
					$where = array(
							'paypal_token' => $paypaltoken, 
							);
					$wpdb->update($service_finder_Tables->bookings,$bookdata,$where);
					
					$senMail = new SERVICE_FINDER_BookNow();
					
					
					$senMail->service_finder_SendBookingMailToProvider($bookingdata,'',$bookingdata->adminfee);
					$senMail->service_finder_SendBookingMailToCustomer($bookingdata,'',$bookingdata->adminfee);
					$senMail->service_finder_SendBookingMailToAdmin($bookingdata,'',$bookingdata->adminfee);
					
					
					
					$userLink = service_finder_get_author_url($bookingdata['provider_id']);
					$redirectOption = $service_finder_options['redirect-option'];
					$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
					if($redirectOption == 'thankyou-page'){
						if($redirectURL != ""){
						$redirect = add_query_arg( array('bookingcompleted' => 'success'), $redirectURL );
						}else{
						$redirect = add_query_arg( array('bookingcompleted' => 'success'), service_finder_get_url_by_shortcode('[service_finder_thank_you]') );
						}
					}else{
					
					$redirect = add_query_arg( array('bookingcompleted' => 'success'), $userLink );
					}
					wp_redirect($redirect);
					die;

				}

		}

}

// delete token and show messages if user cancel payment 
if(isset($_GET['booking_made']) && ($_GET['booking_made'] == 'cancel') && !empty($_GET['token'])){
	// delete token from DB
	$wpdb = service_finder_plugin_global_vars('wpdb');
	$registerErrors = service_finder_plugin_global_vars('registerErrors');
	$token = $_GET['token'];
	$tokenRow = $wpdb->get_row($wpdb->prepare( "SELECT * FROM ".$service_finder_Tables->bookings." WHERE paypal_token = '%s'",$token ));
	if($tokenRow){
		
		$booking_customer_id = $tokenRow->booking_customer_id;
		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$service_finder_Tables->customers." WHERE id = %d", $booking_customer_id ) );
		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$service_finder_Tables->bookings." WHERE paypal_token = '%s'", $token ) );
		
		// show message
		$errors = new WP_Error();
		$message = esc_html__("You canceled payment. Your booking wasn't maid","aone");
		$errors->add( 'cancel_payment', $message);
		$registerErrors = $errors;
	}	
	
}
/*Booking via paypal END*/

/*Booking via payu money start*/
if(isset($_POST['bookingpayment_mode']) && $_POST['bookingpayment_mode'] == 'payumoney'){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';

$service_finder_options = get_option('service_finder_options');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$service_finder_Errors = service_finder_plugin_global_vars('service_finder_Errors');
$registerErrors = service_finder_plugin_global_vars('registerErrors');
$registerMessages = service_finder_plugin_global_vars('registerMessages');

$provider = isset($_POST['provider']) ? esc_html($_POST['provider']) : '';
$totalcost = isset($_POST['totalcost']) ? esc_html($_POST['totalcost']) : '';
$settings = service_finder_getProviderSettings($provider);

$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';

if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){

	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
	$totalcost = $totalcost + $adminfee;
}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
}else{
	$adminfee = 0;
}

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){

	if( isset($service_finder_options['payumoney-type']) && $service_finder_options['payumoney-type'] == 'test' ){
		$MERCHANT_KEY = $service_finder_options['payumoney-key-test'];
		$SALT = $service_finder_options['payumoney-salt-test'];
		$PAYU_BASE_URL = "https://test.payu.in";
	}else{
		$MERCHANT_KEY = $service_finder_options['payumoney-key-live'];
		$SALT = $service_finder_options['payumoney-salt-live'];
		$PAYU_BASE_URL = "https://secure.payu.in";
	}

}elseif($pay_booking_amount_to == 'provider'){

		$MERCHANT_KEY = (isset($settings['payumoneykey'])) ? $settings['payumoneykey'] : '';
		$SALT = (isset($settings['payumoneysalt'])) ? $settings['payumoneysalt'] : '';
		
		if( isset($service_finder_options['payumoney-type']) && $service_finder_options['payumoney-type'] == 'test' ){
		$PAYU_BASE_URL = "https://test.payu.in";
		}else{
		$PAYU_BASE_URL = "https://secure.payu.in";
		}
}

$userLink = service_finder_get_author_url($provider);
$surl = add_query_arg( array('booking_made' => 'success','payutransaction' => 'success'), $userLink );
$furl = add_query_arg( array('booking_made' => 'failed','payutransaction' => 'failed'), $userLink );

$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
$action = $PAYU_BASE_URL . '/_payment';

$price = $totalcost;

$productinfo = 'Payment for Booking';

$firstname = isset($_POST['firstname']) ? esc_html($_POST['firstname']) : '';
$email = isset($_POST['email']) ? esc_html($_POST['email']) : '';
$phone = isset($_POST['phone']) ? esc_html($_POST['phone']) : '';

$saveBooking = new SERVICE_FINDER_BookNow();
$saveBooking->service_finder_SaveBooking($_POST,'',$txnid,$adminfee);

$str = "$MERCHANT_KEY|$txnid|$price|$productinfo|$firstname|$email|||||||||||$SALT";

$hash = strtolower(hash('sha512', $str));

$payuindia_args = array(
	'key' 			=> $MERCHANT_KEY,
	'hash' 			=> $hash,
	'txnid' 		=> $txnid,
	'amount' 		=> $price,
	'firstname'		=> $firstname,
	'email' 		=> $email,
	'phone'			=> $phone,
	'productinfo'	=> $productinfo,
	'surl' 			=> $surl,
	'furl' 			=> $furl,
	'curl'			=> '',
	'address1' 		=> '',
	'address2' 		=> '',
	'city' 			=> '',
	'state' 		=> '',
	'country' 		=> '',
	'zipcode' 		=> '',
	'curl'			=> '',
	'pg' 			=> 'NB',
	'service_provider'	=> 'payu_paisa'
);
$payuindia_args_array = array();
foreach($payuindia_args as $key => $value){
	$payuindia_args_array[] = "<input type='hidden' name='$key' value='$value'/>";
}

echo '<form action="'.$action.'" method="post" id="payuForm" name="payuForm">
	' . implode('', $payuindia_args_array) . '
	<input type="submit" class="button-alt hidebutton" id="submit_payuindia_payment_form" value="'.esc_html__('Pay via PayU', 'service-finder').'" style="display:none;"/> 
	</form>
	<script>
	document.getElementById("payuForm").submit();
	</script>';
		
				
}

if(isset($_GET['booking_made']) && $_GET['booking_made'] == 'success' && $_GET['payutransaction'] == 'success' && isset($_GET['payutransaction']) && isset($_POST['payuMoneyId']) && isset($_POST['status'])){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
$service_finder_options = get_option('service_finder_options');
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');

$txnid = (isset($_POST['txnid'])) ? esc_html($_POST['txnid']) : '';
$payuMoneyId = (isset($_POST['payuMoneyId'])) ? esc_html($_POST['payuMoneyId']) : '';
$status = (isset($_POST['status'])) ? esc_html($_POST['status']) : '';

if($status == 'success' && $payuMoneyId != ""){

	$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `txnid` = "%s"',$txnid),ARRAY_A);

	$bookdata = array(
			'status' => 'Pending',
			'payumoneyid' => $payuMoneyId,
			);
	
	$where = array(
			'txnid' => $txnid, 
			);
	$wpdb->update($service_finder_Tables->bookings,$bookdata,$where);
	
	$senMail = new SERVICE_FINDER_BookNow();
	
	
	$senMail->service_finder_SendBookingMailToProvider($bookingdata,'',$bookingdata->adminfee);
	$senMail->service_finder_SendBookingMailToCustomer($bookingdata,'',$bookingdata->adminfee);
	$senMail->service_finder_SendBookingMailToAdmin($bookingdata,'',$bookingdata->adminfee);
	
	
	
	$userLink = service_finder_get_author_url($bookingdata['provider_id']);
	$redirectOption = $service_finder_options['redirect-option'];
	$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
	if($redirectOption == 'thankyou-page'){
		if($redirectURL != ""){
		$redirect = add_query_arg( array('bookingcompleted' => 'success'), $redirectURL );
		}else{
		$redirect = add_query_arg( array('bookingcompleted' => 'success'), service_finder_get_url_by_shortcode('[service_finder_thank_you]') );
		}
	}else{
	
	$redirect = add_query_arg( array('bookingcompleted' => 'success'), $userLink );
	}
	wp_redirect($redirect);
	die;

}

}

if(isset($_GET['booking_made']) && $_GET['booking_made'] == 'failed' && $_GET['payutransaction'] == 'failed'){

	$wpdb = service_finder_plugin_global_vars('wpdb');
	$registerErrors = service_finder_plugin_global_vars('registerErrors');
	$txnid = (isset($_POST['txnid'])) ? esc_html($_POST['txnid']) : '';
	$row = $wpdb->get_row($wpdb->prepare( "SELECT * FROM ".$service_finder_Tables->bookings." WHERE `txnid` = '%s'",$txnid ));
	if($row){
		
		$booking_customer_id = $row->booking_customer_id;
		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$service_finder_Tables->customers." WHERE id = %d", $booking_customer_id ) );
		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$service_finder_Tables->bookings." WHERE txnid = '%s'", $txnid ) );
		
		// show message
		$errors = new WP_Error();
		$message = esc_html__("You canceled payment. Your booking wasn't maid","aone");
		$errors->add( 'cancel_payment', $message);
		$registerErrors = $errors;
	}

}
/*Booking via payu money end*/

/*Booking Checkout Process*/
add_action('wp_ajax_twocheckout', 'service_finder_twocheckout');
add_action('wp_ajax_nopriv_twocheckout', 'service_finder_twocheckout');

function service_finder_twocheckout(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb, $stripe_options, $service_finder_options, $service_finder_Tables;

$providerid = (!empty($_POST['provider'])) ? esc_html($_POST['provider']) : '';
$token = (!empty($_POST['twocheckouttoken'])) ? esc_html($_POST['twocheckouttoken']) : '';
$totalcost = (!empty($_POST['totalcost'])) ? esc_html($_POST['totalcost']) : '';

$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';

if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}

	$totalcost = $totalcost + $adminfee;
}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
	
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
}else{
	$adminfee = 0;
}

$settings = service_finder_getProviderSettings($providerid);
		
$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
$twocheckouttype = (!empty($service_finder_options['twocheckout-type'])) ? esc_html($service_finder_options['twocheckout-type']) : '';
if($pay_booking_amount_to == 'admin'){
	if($twocheckouttype == 'live'){
		$private_key = (!empty($service_finder_options['twocheckout-live-private-key'])) ? esc_html($service_finder_options['twocheckout-live-private-key']) : '';
		$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-live-account-id'])) ? esc_html($service_finder_options['twocheckout-live-account-id']) : '';
	}else{
		$private_key = (!empty($service_finder_options['twocheckout-test-private-key'])) ? esc_html($service_finder_options['twocheckout-test-private-key']) : '';
		$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-test-account-id'])) ? esc_html($service_finder_options['twocheckout-test-account-id']) : '';
	}
}elseif($pay_booking_amount_to == 'provider'){
	$private_key = esc_html($settings['twocheckoutprivatekey']);
	$twocheckoutaccountid = esc_html($settings['twocheckoutaccountid']);
}

require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/2checkout/lib/Twocheckout.php');
Twocheckout::privateKey($private_key);
Twocheckout::sellerId($twocheckoutaccountid);

if($twocheckouttype == 'test'){
Twocheckout::verifySSL(false);
Twocheckout::sandbox(true);
}

try {

$firstname = (!empty($_POST['firstname'])) ? esc_html($_POST['firstname']) : '';
$lastname = (!empty($_POST['lastname'])) ? esc_html($_POST['lastname']) : '';

$address = (!empty($_POST['address'])) ? esc_html($_POST['address']) : '';
$city = (!empty($_POST['city'])) ? esc_html($_POST['city']) : '';
$state = (!empty($_POST['state'])) ? esc_html($_POST['state']) : '';
$zipcode = (!empty($_POST['zipcode'])) ? esc_html($_POST['zipcode']) : '302020';
$country = (!empty($_POST['country'])) ? esc_html($_POST['country']) : '';
$phone = (!empty($_POST['phone'])) ? esc_html($_POST['phone']) : '';
$email = (!empty($_POST['email'])) ? esc_html($_POST['email']) : '';

	$charge = Twocheckout_Charge::auth(array(
        "sellerId" => $twocheckoutaccountid,
		"privateKey" => $private_key,
	    "merchantOrderId" => time(),
        "token" => $token,
        "currency" => strtoupper(service_finder_currencycode()),
        "total" => $totalcost,
		"tangible"    => "N",
		"billingAddr" => array(
			"name" => $firstname.' '.$lastname,
			"addrLine1" => $address,
			"city" => $city,
			"state" => $state,
			"zipCode" => $zipcode,
			"country" => $country,
			"email" => $email,
			"phoneNumber" => $phone
		)
    ));
    if ($charge['response']['responseCode'] == 'APPROVED') {
	
		$transactionid = $charge['response']['transactionId'];
			
		$saveBooking = new SERVICE_FINDER_BookNow();
		$saveBooking->service_finder_SaveBooking($_POST,'',$transactionid,$adminfee);
		
		$senMail = new SERVICE_FINDER_BookNow();
			
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `txnid` = "%s"',$transactionid),ARRAY_A);
					
		$senMail->service_finder_SendBookingMailToProvider($bookingdata,'',$adminfee);
		$senMail->service_finder_SendBookingMailToCustomer($bookingdata,'',$adminfee);
		$senMail->service_finder_SendBookingMailToAdmin($bookingdata,'',$adminfee);
		
		$redirectOption = $service_finder_options['redirect-option'];
		$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
		if($redirectOption == 'thankyou-page'){
			if($redirectURL != ""){
			$url = $redirectURL.'?bookingcompleted=success';
			}else{
			$url = service_finder_get_url_by_shortcode('[service_finder_thank_you]').'?bookingcompleted=success';
			}
		}else{
		$url = '';
		}
		$msg = (!empty($service_finder_options['provider-booked'])) ? $service_finder_options['provider-booked'] : esc_html__('Provider has been booked successfully', 'service-finder');
		$success = array(
				'status' => 'success',
				'redirecturl' => $url,
				'suc_message' => $msg,
				);
		echo json_encode($success);
	
    }

} catch (Twocheckout_Error $e) {
    $e->getMessage();
	
	$error = array(
			'status' => 'error',
			'err_message' => sprintf( esc_html__('%s', 'service-finder'), $e->getMessage() )
			);
	echo json_encode($error);
}

exit;
}

/*Booking PayU Latam Checkout Process*/
add_action('wp_ajax_payulatam_checkout', 'service_finder_payulatam_checkout');
add_action('wp_ajax_nopriv_payulatam_checkout', 'service_finder_payulatam_checkout');
function service_finder_payulatam_checkout(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb, $stripe_options, $service_finder_options, $service_finder_Tables;
$totalcost = (!empty($_POST['totalcost'])) ? esc_html($_POST['totalcost']) : '';
$provider = (isset($_POST['provider'])) ? esc_html($_POST['provider']) : '';
$cd_number = (isset($_POST['payulatam_card_number'])) ? esc_html($_POST['payulatam_card_number']) : '';
$cd_cvc = (isset($_POST['payulatam_card_cvc'])) ? esc_html($_POST['payulatam_card_cvc']) : '';
$cd_month = (isset($_POST['payulatam_card_month'])) ? esc_html($_POST['payulatam_card_month']) : '';
$cd_year = (isset($_POST['payulatam_card_year'])) ? esc_html($_POST['payulatam_card_year']) : '';
$cardtype = (isset($_POST['payulatam_cardtype'])) ? esc_html($_POST['payulatam_cardtype']) : '';
$currencyCode = service_finder_currencycode();
$locale = get_locale(); 
$temp = explode('_',$locale);
if(!empty($temp)){
$langcode = strtoupper($temp[0]);
define('LANGCODE', $langcode);
}else{
$langcode = 'EN';
define('LANGCODE', $langcode);
}

$userdata = service_finder_getUserInfo($provider);

$fullname = $userdata['fname'].' '.$userdata['lname'];
$user_email = $userdata['email'];
$phone = $userdata['phone'];

$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';

if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}

	$totalcost = $totalcost + $adminfee;
}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
	
	if($admin_fee_type == 'fixed'){
		$adminfee = $admin_fee_fixed;
	}elseif($admin_fee_type == 'percentage'){
		$adminfee = $totalcost * ($admin_fee_percentage/100);	
	}
	
}else{
	$adminfee = 0;
}

$totalcost = $totalcost;
require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/payulatam/lib/PayU.php');

$settings = service_finder_getProviderSettings($provider);

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){
	if( isset($service_finder_options['payulatam-type']) && $service_finder_options['payulatam-type'] == 'test' ){
		$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-test'])) ? $service_finder_options['payulatam-merchantid-test'] : '';
		$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-test'])) ? $service_finder_options['payulatam-apilogin-test'] : '';
		$payulatamapikey = (isset($service_finder_options['payulatam-apikey-test'])) ? $service_finder_options['payulatam-apikey-test'] : '';
		$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-test'])) ? $service_finder_options['payulatam-accountid-test'] : '';
		
		
	}else{
		$payulatammerchantid = (isset($service_finder_options['payulatam-merchantid-live'])) ? $service_finder_options['payulatam-merchantid-live'] : '';
		$payulatamapilogin = (isset($service_finder_options['payulatam-apilogin-live'])) ? $service_finder_options['payulatam-apilogin-live'] : '';
		$payulatamapikey = (isset($service_finder_options['payulatam-apikey-live'])) ? $service_finder_options['payulatam-apikey-live'] : '';
		$payulatamaccountid = (isset($service_finder_options['payulatam-accountid-live'])) ? $service_finder_options['payulatam-accountid-live'] : '';
		
	}
		
}elseif($pay_booking_amount_to == 'provider'){

		$payulatammerchantid = (isset($settings['payulatammerchantid'])) ? $settings['payulatammerchantid'] : '';
		$payulatamapilogin = (isset($settings['payulatamapilogin'])) ? $settings['payulatamapilogin'] : '';
		$payulatamapikey = (isset($settings['payulatamapikey'])) ? $settings['payulatamapikey'] : '';
		$payulatamaccountid = (isset($settings['payulatamaccountid'])) ? $settings['payulatamaccountid'] : '';
		
}

		if( isset($service_finder_options['payulatam-type']) && $service_finder_options['payulatam-type'] == 'test' ){

		$testmode = true;
		
		$paymenturl = "https://sandbox.api.payulatam.com/payments-api/4.0/service.cgi";
		$reportsurl = "https://sandbox.api.payulatam.com/reports-api/4.0/service.cgi";
		$subscriptionurl = "https://sandbox.api.payulatam.com/payments-api/rest/v4.3/";
		
		$fullname = 'APPROVED';

		}else{

		$testmode = false;
		
		$paymenturl = "https://api.payulatam.com/payments-api/4.0/service.cgi";
		$reportsurl = "https://api.payulatam.com/reports-api/4.0/service.cgi";
		$subscriptionurl = "https://api.payulatam.com/payments-api/rest/v4.3/";
		
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

$reference = 'booking_'.time();
$value = $totalcost;		
		
try {			
	$parameters = array(
	//Enter the account’s identifier here
	PayUParameters::ACCOUNT_ID => $payulatamaccountid,
	// Enter the reference code here.
	PayUParameters::REFERENCE_CODE => $reference,
	// Enter the description here.
	PayUParameters::DESCRIPTION => "Payment for Booking via PayU Latam",
	
	// -- Values --
	// Enter the value here.       
	PayUParameters::VALUE => $value,
	// Enter the currency here.
	PayUParameters::CURRENCY => $currencyCode,
	

	// -- Payer --
   ///Enter the payer's name here
	PayUParameters::PAYER_NAME => $fullname,//"APPROVED"
	//Enter the payer's email here
	PayUParameters::PAYER_EMAIL => $user_email,
	//Enter the payer's contact phone here.
	PayUParameters::PAYER_CONTACT_PHONE => $phone,
	
	// -- Credit card data -- 
		// Enter the number of the credit card here
	PayUParameters::CREDIT_CARD_NUMBER => $cd_number,
	// Enter expiration date of the credit card here
	PayUParameters::CREDIT_CARD_EXPIRATION_DATE => $cd_year.'/'.$cd_month,
	//Enter the security code of the credit card here
	PayUParameters::CREDIT_CARD_SECURITY_CODE=> $cd_cvc,
	//Enter the name of the credit card here
	// "MASTERCARD" || "AMEX" || "ARGENCARD" || "CABAL" || "NARANJA" || "CENCOSUD" || "SHOPPING"
	PayUParameters::PAYMENT_METHOD => $cardtype, 
	
	// Enter the number of installments here.
	PayUParameters::INSTALLMENTS_NUMBER => "1",
	// Enter the name of the country here.
	PayUParameters::COUNTRY => $country,
	
	);
	
	$response = PayUPayments::doAuthorizationAndCapture($parameters);

	if ($response->transactionResponse->state == 'APPROVED') {  
		
		$txnid = $response->transactionResponse->transactionId;
	
		$saveBooking = new SERVICE_FINDER_BookNow();
		$saveBooking->service_finder_SaveBooking($_POST,'',$txnid,$adminfee);
		
		$senMail = new SERVICE_FINDER_BookNow();
			
		$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `txnid` = "%s"',$txnid),ARRAY_A);
					
		$senMail->service_finder_SendBookingMailToProvider($bookingdata,'',$adminfee);
		$senMail->service_finder_SendBookingMailToCustomer($bookingdata,'',$adminfee);
		$senMail->service_finder_SendBookingMailToAdmin($bookingdata,'',$adminfee);
		
		$redirectOption = $service_finder_options['redirect-option'];
		$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
		if($redirectOption == 'thankyou-page'){
			if($redirectURL != ""){
			$url = $redirectURL.'?bookingcompleted=success';
			}else{
			$url = service_finder_get_url_by_shortcode('[service_finder_thank_you]').'?bookingcompleted=success';
			}
		}else{
		$url = '';
		}
		$msg = (!empty($service_finder_options['provider-booked'])) ? $service_finder_options['provider-booked'] : esc_html__('Provider has been booked successfully', 'service-finder');
		
		$success = array(
				'status' => 'success',
				'redirecturl' => $url,
				'suc_message' => $msg,
				);
		echo json_encode($success);
	
	}else{
	
		$msg = $response->transactionResponse->state.': '.$response->transactionResponse->responseCode;
		
		$error = array(
				'status' => 'error',
				'err_message' => $msg
				);
		echo json_encode($error);
	}
		
					
} catch (Exception $e) {

	$error = array(
			'status' => 'error',
			'err_message' => $e->getMessage()
			);
	echo json_encode($error);
}

exit;
}

/*Booking Checkout Process*/
add_action('wp_ajax_checkout', 'service_finder_checkout');
add_action('wp_ajax_nopriv_checkout', 'service_finder_checkout');

function service_finder_checkout(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb, $stripe_options, $service_finder_options, $service_finder_Tables;
		$token = (!empty($_POST['stripeToken'])) ? esc_html($_POST['stripeToken']) : '';
		$totalcost = (!empty($_POST['totalcost'])) ? esc_html($_POST['totalcost']) : '';
		
		$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
		$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
		$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

		$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
		$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
		
		if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){
			if($admin_fee_type == 'fixed'){
				$adminfee = $admin_fee_fixed;
			}elseif($admin_fee_type == 'percentage'){
				$adminfee = $totalcost * ($admin_fee_percentage/100);	
			}
		
			$totalcost = $totalcost + $adminfee;
		}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
			
			if($admin_fee_type == 'fixed'){
				$adminfee = $admin_fee_fixed;
			}elseif($admin_fee_type == 'percentage'){
				$adminfee = $totalcost * ($admin_fee_percentage/100);	
			}
			
		}else{
			$adminfee = 0;
		}
		
		$totalcost = $totalcost * 100;
		require_once(SERVICE_FINDER_PAYMENT_GATEWAY_DIR.'/stripe/Stripe.php');
		
		$settings = service_finder_getProviderSettings($_POST['provider']);
		
		$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
		if($pay_booking_amount_to == 'admin'){
			$stripetype = (!empty($service_finder_options['stripe-type'])) ? esc_html($service_finder_options['stripe-type']) : '';
			if($stripetype == 'live'){
				$secret_key = (!empty($service_finder_options['stripe-live-secret-key'])) ? esc_html($service_finder_options['stripe-live-secret-key']) : '';
			}else{
				$secret_key = (!empty($service_finder_options['stripe-test-secret-key'])) ? esc_html($service_finder_options['stripe-test-secret-key']) : '';
			}
		}elseif($pay_booking_amount_to == 'provider'){
			$secret_key = esc_html($settings['stripesecretkey']);
		}

		Stripe::setApiKey($secret_key);
 
		try {			
			$customer = Stripe_Customer::create(array(
					'card' => $token,
					'email' => $_POST['email'],
					'description' => "Provider booked by ".$_POST['firstname']." ".$_POST['lastname']
				)
			);	

			$charge = Stripe_Charge::create(array(
						  "amount" => $totalcost,
						  "currency" => strtolower(service_finder_currencycode()),
						  "customer" => $customer->id, // obtained with Stripe.js
						  "description" => "Charge for Booking"
						));

			if ($charge->paid == true && $charge->status == "succeeded") { 
			
				$saveBooking = new SERVICE_FINDER_BookNow();
				$saveBooking->service_finder_SaveBooking($_POST,$customer->id,$charge->balance_transaction,$adminfee);
				
				$senMail = new SERVICE_FINDER_BookNow();
					
				$bookingdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `stripe_customer_id` = "%s"',$customer->id),ARRAY_A);
							
				$senMail->service_finder_SendBookingMailToProvider($bookingdata,'',$adminfee);
				$senMail->service_finder_SendBookingMailToCustomer($bookingdata,'',$adminfee);
				$senMail->service_finder_SendBookingMailToAdmin($bookingdata,'',$adminfee);
				
				$redirectOption = $service_finder_options['redirect-option'];
				$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
				if($redirectOption == 'thankyou-page'){
					if($redirectURL != ""){
					$url = $redirectURL.'?bookingcompleted=success';
					}else{
					$url = service_finder_get_url_by_shortcode('[service_finder_thank_you]').'?bookingcompleted=success';
					}
				}else{
				$url = '';
				}
				$msg = (!empty($service_finder_options['provider-booked'])) ? $service_finder_options['provider-booked'] : esc_html__('Provider has been booked successfully', 'service-finder');
				
				$success = array(
						'status' => 'success',
						'redirecturl' => $url,
						'suc_message' => $msg,
						);
				echo json_encode($success);
			
			}
				
							
		} catch (Exception $e) {
		
			$body = $e->getJsonBody();
  			$err  = $body['error'];
  
			$error = array(
					'status' => 'error',
					'err_message' => sprintf( esc_html__('%s', 'service-finder'), $err['message'] )
					);
			echo json_encode($error);
		}

exit;
}

/*Booking Free Checkout Process*/
add_action('wp_ajax_freecheckout', 'service_finder_freecheckout');
add_action('wp_ajax_nopriv_freecheckout', 'service_finder_freecheckout');

function service_finder_freecheckout(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb, $service_finder_options;
				
				$totalcost = isset($_POST['totalcost']) ? $_POST['totalcost'] : '';
				
				$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
				$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
				$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;
				
				$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
				$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';
				
				$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
				
				if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){
					if($admin_fee_type == 'fixed'){
						$adminfee = $admin_fee_fixed;
					}elseif($admin_fee_type == 'percentage'){
						$adminfee = $totalcost * ($admin_fee_percentage/100);	
					}
					$totalcost = $totalcost + $adminfee;
				}elseif($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'provider'){
					if($admin_fee_type == 'fixed'){
						$adminfee = $admin_fee_fixed;
					}elseif($admin_fee_type == 'percentage'){
						$adminfee = $totalcost * ($admin_fee_percentage/100);	
					}
				}else{
					$adminfee = 0;
				}

				$saveBooking = new SERVICE_FINDER_BookNow();
				$saveBooking->service_finder_SaveBooking($_POST,'','',$adminfee);
				
				$redirectOption = $service_finder_options['redirect-option'];
				$redirectURL = (!empty($service_finder_options['thankyou-page-url'])) ? $service_finder_options['thankyou-page-url'] : '';
				if($redirectOption == 'thankyou-page'){
					if($redirectURL != ""){
					$url = $redirectURL.'?bookingcompleted=success';
					}else{
					$url = service_finder_get_url_by_shortcode('[service_finder_thank_you]').'?bookingcompleted=success';
					}
				}else{
				$url = '';
				}
				$msg = (!empty($service_finder_options['provider-booked'])) ? $service_finder_options['provider-booked'] : esc_html__('Provider has been booked successfully', 'service-finder');
				$success = array(
						'status' => 'success',
						'redirecturl' => $url,
						'suc_message' => $msg,
						);
				echo json_encode($success);
exit;
}

/*Check Zipcodes*/
add_action('wp_ajax_check_zipcode', 'service_finder_check_zipcode');
add_action('wp_ajax_nopriv_check_zipcode', 'service_finder_check_zipcode');

function service_finder_check_zipcode(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;

$checkZipcode = new SERVICE_FINDER_BookNow();
$checkZipcode = $checkZipcode->service_finder_checkZipcode($_POST);
exit;
}

/*Load Members*/
add_action('wp_ajax_load_members', 'service_finder_load_members');
add_action('wp_ajax_nopriv_load_members', 'service_finder_load_members');

function service_finder_load_members(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;

$loadMembers = new SERVICE_FINDER_BookNow();
echo $loadMembers = $loadMembers->service_finder_loadMembers($_POST);
exit;
}

/*Get Timeslots based on date*/
add_action('wp_ajax_get_bookingtimeslot', 'service_finder_get_bookingtimeslot');
add_action('wp_ajax_nopriv_get_bookingtimeslot', 'service_finder_get_bookingtimeslot');

function service_finder_get_bookingtimeslot(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;

$provider_id = (!empty($_POST['provider_id'])) ? esc_html($_POST['provider_id']) : '';

$getBookingTimeSlot = new SERVICE_FINDER_BookNow();
if(service_finder_availability_method($provider_id) == 'timeslots'){
	echo $getBookingTimeSlot->service_finder_getBookingTimeSlot($_POST);
}elseif(service_finder_availability_method($provider_id) == 'starttime'){
	echo $getBookingTimeSlot->service_finder_getBookingStartTime($_POST);
}else{
	echo $getBookingTimeSlot->service_finder_getBookingTimeSlot($_POST);
}
exit;
}

/*Iner Login*/
add_action('wp_ajax_innerlogin', 'service_finder_innerlogin');
add_action('wp_ajax_nopriv_innerlogin', 'service_finder_innerlogin');

function service_finder_innerlogin(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;
$innerLogin = new SERVICE_FINDER_BookNow();
$innerLogin->service_finder_innerLogin($_POST);
exit;
}

/*Add to Favorite*/
add_action('wp_ajax_addtofavorite', 'service_finder_addtofavorite');
add_action('wp_ajax_nopriv_addtofavorite', 'service_finder_addtofavorite');

function service_finder_addtofavorite(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;
$addfavorite = new SERVICE_FINDER_BookNow();
$addfavorite->service_finder_addtofavorite($_POST);
exit;
}

/*Remove From Favorite*/
add_action('wp_ajax_removefromfavorite', 'service_finder_removefromfavorite');
add_action('wp_ajax_nopriv_removefromfavorite', 'service_finder_removefromfavorite');

function service_finder_removefromfavorite(){
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
global $wpdb;
$removefavorite = new SERVICE_FINDER_BookNow();
$removefavorite->service_finder_removeFromFavorite($_POST);
exit;
}

/*Reset Booking Calendar*/
add_action('wp_ajax_reset_bookingcalendar', 'service_finder_reset_bookingcalendar');
add_action('wp_ajax_nopriv_reset_bookingcalendar', 'service_finder_reset_bookingcalendar');

function service_finder_reset_bookingcalendar(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
$resetBookingCalender = new SERVICE_FINDER_BookNow();

$provider_id = (!empty($_POST['provider_id'])) ? esc_html($_POST['provider_id']) : '';

if(service_finder_availability_method($provider_id) == 'timeslots'){
	$resetBookingCalender->service_finder_resetBookingCalender($_POST);
}elseif(service_finder_availability_method($provider_id) == 'starttime'){
	$resetBookingCalender->service_finder_resetStartTimeBookingCalender($_POST);
}else{
	$resetBookingCalender->service_finder_resetBookingCalender($_POST);
}

exit;
}

/*Send Ivitation*/
add_action('wp_ajax_sendinvitation', 'service_finder_sendinvitation');

function service_finder_sendinvitation(){
global $wpdb;

$invitedjob = (!empty($_POST['invitedjob'])) ? esc_html($_POST['invitedjob']) : '';
$provider_id = (!empty($_POST['provider_id'])) ? esc_html($_POST['provider_id']) : '';
$job = get_post($invitedjob);

$provider = get_user_by('ID',$provider_id);
$msg_subject = esc_html__('Job Invitation');
$msg_body = 'Congratulations, You have been invited for following job. Please go to job link and apply for the job.';
$msg_body .= '<strong>'.$job->post_title.'</strong>';
$msg_body .= get_permalink($invitedjob);;

if(service_finder_wpmailer($provider->user_email,$msg_subject,$msg_body)) {

	$success = array(
			'status' => 'success',
			'suc_message' => esc_html__('Invitation has been sent', 'service-finder'),
			);
	$service_finder_Success = json_encode($success);
	echo $service_finder_Success;
	
	
} else {
		
	$error = array(
			'status' => 'error',
			'err_message' => esc_html__('Invitation could not be sent.', 'service-finder'),
			);
	$service_finder_Errors = json_encode($error);
	echo $service_finder_Errors;
}
exit;
}