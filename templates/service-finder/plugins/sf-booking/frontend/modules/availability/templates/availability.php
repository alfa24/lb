<?php
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
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$getTimeSlot = new SERVICE_FINDER_Availability();

$service_finder_options = get_option('service_finder_options');

$time_format = (!empty($service_finder_options['time-format'])) ? $service_finder_options['time-format'] : '';

$days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');

wp_add_inline_script( 'service_finder-js-availability-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'after' );

$adminavailabilitybasedon = (!empty($service_finder_options['availability-based-on'])) ? esc_html($service_finder_options['availability-based-on']) : '';

$settings = service_finder_getProviderSettings($globalproviderid);

$availability_based_on = (!empty($settings['availability_based_on'])) ? $settings['availability_based_on'] : '';
?>
<!--Availability Template-->

<h4>
  <?php echo (!empty($service_finder_options['label-availability'])) ? esc_html($service_finder_options['label-availability']) : esc_html__('Availability', 'service-finder'); ?>
</h4>

<?php
if(service_finder_availability_method($globalproviderid) == 'timeslots'){
	require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/availability/templates/timeslots.php';
}elseif(service_finder_availability_method($globalproviderid) == 'starttime'){
	require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/availability/templates/starttime.php';
}else{
	require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/availability/templates/timeslots.php';
}
?>