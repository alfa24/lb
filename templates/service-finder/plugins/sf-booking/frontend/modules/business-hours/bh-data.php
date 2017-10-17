<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*Save Business Hours Ajax Call*/
add_action('wp_ajax_save_businesshours', 'service_finder_save_businesshours');
add_action('wp_ajax_nopriv_save_businesshours', 'service_finder_save_businesshours');

function service_finder_save_businesshours(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/business-hours/BusinessHours.php';
$addBusinessHours = new SERVICE_FINDER_BusinessHours();
$addBusinessHours->service_finder_addBusinessHours($_POST);
exit;
}