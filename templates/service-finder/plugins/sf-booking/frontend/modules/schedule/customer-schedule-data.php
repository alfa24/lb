<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
require_once('../../../../../../wp-load.php');

if(get_option('timezone_string') != ""){
date_default_timezone_set(get_option('timezone_string'));
}


$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');

$service_finder_options = get_option('service_finder_options');

$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';

$currUser = wp_get_current_user(); 


$json = array();

// Query that retrieves bookings
$string = "";

$alldata = $wpdb->get_results($wpdb->prepare('SELECT bookings.id, bookings.jobid, bookings.provider_id, bookings.date, bookings.start_time, bookings.end_time, bookings.status, providers.full_name, providers.phone, providers.email FROM '.$service_finder_Tables->bookings.' as bookings INNER JOIN '.$service_finder_Tables->customers.' as customers INNER JOIN '.$service_finder_Tables->providers.' as providers on bookings.booking_customer_id = customers.id AND bookings.provider_id = providers.wp_user_id WHERE customers.`wp_user_id` = %d',$currUser->ID));

$i=1;

$num = count($alldata);

foreach($alldata as $data)
{
$start = strtotime($data->date.$data->start_time);
$end = strtotime($data->date.$data->end_time);

if($time_format){
	$showtime = $data->start_time.'-'.$data->end_time;
}else{
	$showtime = date('h:i a',strtotime($data->start_time)).'-'.date('h:i a',strtotime($data->end_time));
}

$bookingdata = '<strong>'.ucfirst(service_finder_getProviderName($data->provider_id)).'</strong>';

$bookingdata .= '<p>'.$showtime.'</p>';

if($data->status == 'Cancel' || $data->status == 'Completed'){
$status = service_finder_translate_static_status_string($data->status);
$class = ($data->status == 'Cancel') ? 'sf-cancel' : 'sf-complete';
}elseif($data->status == 'Pending'){
$status = esc_html__('Incomplete','service-finder');
$class = 'sf-pending';
}else{
$status = service_finder_translate_static_status_string($data->status);
$class = 'sf-pending';
}


if($data->jobid > 0){
	$classtype = 'jobs-bx';
}else{
	$classtype = 'bookings-bx';
}
				
$bookingdata .= '<span>'.ucfirst($status).'</span>';

if($i<$num){$string.='{"id":"'.$data->id.'","title":"'.$bookingdata.'","start":"'.$start.'000","end":"'.$end.'000","class":"'.sanitize_html_class($classtype).' event-info '.sanitize_html_class($class).'","url":"'.admin_url('admin-ajax.php').'?action=booking_details&bookingid='.$data->id.'&calendar=true"},';}else{$string.='{"id":"'.$data->id.'","title":"'.$bookingdata.'","start":"'.$start.'000","end":"'.$end.'000","class":"retrieves '.sanitize_html_class($classtype).' event-info '.sanitize_html_class($class).'","url":"'.admin_url('admin-ajax.php').'?action=booking_details&bookingid='.$data->id.'&calendar=true"}';}

$i++;

}

$result = '['.$string.']';

echo '{
	"success": 1,
	"result": '.$result.'
}';