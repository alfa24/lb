<?php
require_once('../../../../wp-load.php');
// CONFIG: Enable debug mode. This means we'll log requests into 'ipn.log' in the same directory.
// Especially useful if you encounter network errors or other intermittent problems with IPN (validation).
// Set this to 0 once you go live or don't require logging.
define("DEBUG", 1);
// Set to 0 once you're ready to go live
define("USE_SANDBOX", 1);
define("LOG_FILE", "./ipn.log");
// Read POST data
// reading posted data directly from $_POST causes serialization
// issues with array data in POST. Reading raw POST data from input stream instead.
global $wpdb, $service_finder_Tables;
$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
	$keyval = explode ('=', $keyval);
	if (count($keyval) == 2)
		$myPost[$keyval[0]] = urldecode($keyval[1]);
}
// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
	$get_magic_quotes_exists = true;
}
$status = '';
$bookingid = (!empty($_GET['bookingid'])) ? esc_html($_GET['bookingid']) : '';
foreach ($myPost as $key => $value) {
	if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
		$value = urlencode(stripslashes($value));
	} else {
		$value = urlencode($value);
	}
	if($key == "transaction%5B0%5D.status"){
		$sender_status = $value;
	}
	if($key == "status"){
		$status = $value;
	}
	if($key == "transaction%5B0%5D.id"){
		$txnid = $value;
	}
	$req .= "&$key=$value";
}

if($sender_status == "Completed" && $status == "COMPLETED"){
$data = array(
		'paid_to_provider' => 'paid',
		'paid_to_provider_txnid' => $txnid,
		);

$where = array(
		'id' => $bookingid,
		);

$wpdb->update($service_finder_Tables->bookings,wp_unslash($data),$where);		

if(function_exists('service_finder_add_notices')) {
	$row = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->bookings.' WHERE `id` = %d',$bookingid));	
	$noticedata = array(
			'provider_id' => $row->provider_id,
			'target_id' => $row, 
			'topic' => esc_html__('Booking Payment', 'service-finder'),
			'notice' => esc_html__('Site administrator paid you for your service via adaptive paypal', 'service-finder')
			);
	service_finder_add_notices($noticedata);

}
}

error_log($req, 3, LOG_FILE);
?>
