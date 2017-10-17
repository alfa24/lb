<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*Get Provider Bokings Ajax Call*/
add_action('wp_ajax_get_bookings', 'service_finder_get_bookings');
add_action('wp_ajax_nopriv_get_bookings', 'service_finder_get_bookings');

function service_finder_get_bookings(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$getBookings = new SERVICE_FINDER_Bookings();
$getBookings->service_finder_getBookings($_POST);
exit;
}

/*Load All Available member or assign Ajax Call*/
add_action('wp_ajax_load_allmembers', 'service_finder_load_allmembers');
add_action('wp_ajax_nopriv_load_allmembers', 'service_finder_load_allmembers');

function service_finder_load_allmembers(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$loadAllMembers = new SERVICE_FINDER_Bookings();
$loadAllMembers->service_finder_loadAllMembers($_POST);
exit;
}

/*Assign member for new booking Ajax Call*/
add_action('wp_ajax_assign_new_member', 'service_finder_assign_new_member');
add_action('wp_ajax_nopriv_assign_new_member', 'service_finder_assign_new_member');

function service_finder_assign_new_member(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$assignMember = new SERVICE_FINDER_Bookings();
$assignMember->service_finder_assignMember($_POST);
exit;
}

/*Assign member for new booking Ajax Call*/
add_action('wp_ajax_change_status', 'service_finder_change_status');
add_action('wp_ajax_nopriv_change_status', 'service_finder_change_status');

function service_finder_change_status(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$changeStatus = new SERVICE_FINDER_Bookings();
$changeStatus->service_finder_changeStatus($_POST);
exit;
}


/*Delete Provider Bokings Ajax Call*/
add_action('wp_ajax_delete_bookings', 'service_finder_delete_bookings');
add_action('wp_ajax_nopriv_delete_bookings', 'service_finder_delete_bookings');

function service_finder_delete_bookings(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$deleteBooking = new SERVICE_FINDER_Bookings();
$deleteBooking->service_finder_deleteBookings();
exit;
}

/*View Provider Booking Details Ajax Call*/
add_action('wp_ajax_booking_details', 'service_finder_booking_details');
add_action('wp_ajax_nopriv_booking_details', 'service_finder_booking_details');

function service_finder_booking_details(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$viewBooking = new SERVICE_FINDER_Bookings();
$viewBooking->service_finder_viewBookings();
exit;
}

/*Get Customer Past Bokings Ajax Call*/
add_action('wp_ajax_get_customer_pastbookings', 'service_finder_get_customer_pastbookings');
add_action('wp_ajax_nopriv_get_customer_pastbookings', 'service_finder_get_customer_pastbookings');

function service_finder_get_customer_pastbookings(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$getBookings = new SERVICE_FINDER_Bookings();
$getBookings->service_finder_getCustomerPastBookings();
exit;
}

/*Get Customer Upcoming Bokings Ajax Call*/
add_action('wp_ajax_get_customer_upcomingbookings', 'service_finder_get_customer_upcomingbookings');
add_action('wp_ajax_nopriv_get_customer_upcomingbookings', 'service_finder_get_customer_upcomingbookings');

function service_finder_get_customer_upcomingbookings(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$getBookings = new SERVICE_FINDER_Bookings();
$getBookings->service_finder_getCustomerUpcomingBookings();
exit;
}

/*Delete Customer Bokings Ajax Call*/
add_action('wp_ajax_delete_customer_bookings', 'service_finder_delete_customer_bookings');
add_action('wp_ajax_nopriv_delete_customer_bookings', 'service_finder_delete_customer_bookings');

function service_finder_delete_customer_bookings(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$deleteBooking = new SERVICE_FINDER_Bookings();
$deleteBooking->service_finder_deleteCustomerBookings();
exit;
}

/*Add Invoice Data Ajax Call*/
add_action('wp_ajax_add_booking_invoice', 'service_finder_add_booking_invoice');
add_action('wp_ajax_nopriv_add_booking_invoice', 'service_finder_add_booking_invoice');

function service_finder_add_booking_invoice(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$addData = new SERVICE_FINDER_Bookings();
$addData->service_finder_addInvoiceData($_POST);
exit;
}

/*Add Feedback Data Ajax Call*/
add_action('wp_ajax_add_feedback', 'service_finder_add_feedback');
add_action('wp_ajax_nopriv_add_feedback', 'service_finder_add_feedback');

function service_finder_add_feedback(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$addData = new SERVICE_FINDER_Bookings();
$addData->service_finder_addFeedback($_POST);
exit;
}

/*Show Feedback Data Ajax Call*/
add_action('wp_ajax_show_feedback', 'service_finder_show_feedback');
add_action('wp_ajax_nopriv_show_feedback', 'service_finder_show_feedback');

function service_finder_show_feedback(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$getData = new SERVICE_FINDER_Bookings();
$getData->service_finder_getFeedback($_POST);
exit;
}

/*Cancel booking ajax call*/
add_action('wp_ajax_cancel_booking', 'service_finder_cancel_booking');
add_action('wp_ajax_nopriv_cancel_booking', 'service_finder_cancel_booking');

function service_finder_cancel_booking(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$cancelBooking = new SERVICE_FINDER_Bookings();
$cancelBooking->service_finder_cancelBooking($_POST);
exit;
}

/*Edit Booking Ajax Call*/
add_action('wp_ajax_editbooking', 'service_finder_editbooking');
add_action('wp_ajax_nopriv_editbooking', 'service_finder_editbooking');

function service_finder_editbooking(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$editBooking = new SERVICE_FINDER_Bookings();
echo $editBooking->service_finder_editBooking($_POST);
exit;
}

/*Update Booking Ajax Call*/
add_action('wp_ajax_update_booking', 'service_finder_update_booking');
add_action('wp_ajax_nopriv_update_booking', 'service_finder_update_booking');

function service_finder_update_booking(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$updateBooking = new SERVICE_FINDER_Bookings();
$updateBooking->service_finder_updateBooking($_POST);
exit;
}

/*Approve wired booking*/
add_action('wp_ajax_wired_booking_approval', 'service_finder_wired_booking_approval');
function service_finder_wired_booking_approval(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/Bookings.php';
$approvebooking = new SERVICE_FINDER_Bookings();
$approvebooking->service_finder_approvebooking($_POST);
exit;
}