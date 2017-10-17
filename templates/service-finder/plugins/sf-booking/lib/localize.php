<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
?>
<?php
$service_finder_options = get_option('service_finder_options');
$hire_if_booking_off_msg = (!empty($service_finder_options['hire-bookingoff'])) ? esc_attr($service_finder_options['hire-bookingoff']) : esc_html__( 'Provider booking form is closed. Still you want to book him?', 'service-finder' );
$string_array = array(
	'not_valid' => esc_html__( 'This value is not valid', 'service-finder' ),
	'req' => esc_html__( 'This field is required', 'service-finder' ),
	'are_you_sure' => esc_html__( 'Are you sure?', 'service-finder' ),
	'are_you_sure_approve_mail' => esc_html__( 'Are you sure? Mail will be sent to provider after approve autometically.', 'service-finder' ),
	'login_user_name' => esc_html__( 'Username is required', 'service-finder' ),
	'login_password' => esc_html__( 'Password is required', 'service-finder' ),
	'fp_user_login' => esc_html__( 'Please enter username or email', 'service-finder' ),
	'signup_user_name' => esc_html__( 'Username is required', 'service-finder' ),
	'signup_first_name' => esc_html__( 'First name is required', 'service-finder' ),
	'signup_last_name' => esc_html__( 'Last name is required', 'service-finder' ),
	'signup_address' => esc_html__( 'Address is required', 'service-finder' ),
	'allowed_country' => esc_html__( 'This country is not allowed', 'service-finder' ),
	'signup_city' => esc_html__( 'Please select city from suggestion', 'service-finder' ),
	'signup_country' => esc_html__( 'Country is required', 'service-finder' ),
	'signup_user_email' => esc_html__( 'The input is not a valid email address', 'service-finder' ),
	'providertermsncondition' => esc_html__( 'Please check the checkbox', 'service-finder' ),
	'signup_password_empty' => esc_html__( 'The password is required and cannot be empty', 'service-finder' ),
	'signup_password_length' => esc_html__( 'Password must be 5 to 15 characters long', 'service-finder' ),
	'signup_password_confirm' => esc_html__( 'The password and its confirm are not the same', 'service-finder' ),
	'primary_category' => esc_html__( 'Primary Category is required', 'service-finder' ),
	'category' => esc_html__( 'Category is required', 'service-finder' ),
	'min_cost' => esc_html__( 'Minimum cost is required', 'service-finder' ),
	'allowed_booking' => esc_html__( 'Number of bookings allowed', 'service-finder' ),
	'edit_unavl' => esc_html__( 'Edit UnAvailability', 'service-finder' ),
	'select_date' => esc_html__( 'Please select date', 'service-finder' ),
	'select_timeslot' => esc_html__( 'Please select timeslot or check the checkbox for wholeday', 'service-finder' ),
	'select_checkbox' => esc_html__( 'Please select atleast one checkbox', 'service-finder' ),
	'region' => esc_html__( 'Region is required', 'service-finder' ),
	'change_status' => esc_html__( 'Are you sure you want to change the status?', 'service-finder' ),
	'no_data' => esc_html__( 'No data found in the server', 'service-finder' ),
	'postal_code' => esc_html__( 'Postal Code is required', 'service-finder' ),
	'edit_service' => esc_html__( 'Edit Service', 'service-finder' ),
	'edit_applied_job' => esc_html__( 'Edit Applied Job', 'service-finder' ),
	'view_applied_job' => esc_html__( 'View Applied Job', 'service-finder' ),
	'service_name' => esc_html__( 'Service name is required', 'service-finder' ),
	'select_payment' => esc_html__( 'Please select payment method', 'service-finder' ),
	'set_key' => esc_html__( 'Please set secret and publish key for stripe', 'service-finder' ),
	'pub_key' => esc_html__( 'You did not set a valid publishable key', 'service-finder' ),
	'change_complete_status' => esc_html__( 'Are you sure you want to change the status to completed?', 'service-finder' ),
	'member' => esc_html__( 'Member name is required', 'service-finder' ),
	'anyone' => esc_html__( 'Any One', 'service-finder' ),
	'assign_member' => esc_html__( 'Assign Member', 'service-finder' ),
	'add_feedback' => esc_html__( 'Add Feedback', 'service-finder' ),
	'feedback' => esc_html__( 'Feedback', 'service-finder' ),
	'edit_booking' => esc_html__( 'Edit Booking', 'service-finder' ),
	'rating' => esc_html__( 'Please give some rating', 'service-finder' ),
	'comment' => esc_html__( 'Please enter some comment', 'service-finder' ),
	'any_member' => esc_html__( 'Please select any member', 'service-finder' ),
	'timeslot_member' => esc_html__( 'Please select timeslot or member', 'service-finder' ),
	'add_invoice' => esc_html__( 'Add Invoice', 'service-finder' ),
	'desc_req' => esc_html__( 'Description is required', 'service-finder' ),
	'price' => esc_html__( 'The price is required', 'service-finder' ),
	'due_date' => esc_html__( 'The due date is required', 'service-finder' ),
	'edit_invoice' => esc_html__( 'Edit Invoice', 'service-finder' ),
	'reminder_mail' => esc_html__( 'Send Reminder Mail', 'service-finder' ),
	'comment_text' => esc_html__( 'Comments', 'service-finder' ),
	'cancel' => esc_html__( 'Cancel', 'service-finder' ),
	'cancel_sub' => esc_html__( 'Are you sure you want to cancel subscription?', 'service-finder' ),
	'edit_featured_price' => esc_html__( 'Edit Price', 'service-finder' ),
	'cancel_featured' => esc_html__( 'Are you sure you want to cancel featured/featured request?', 'service-finder' ),
	'customer_name' => esc_html__( 'Customer name is required', 'service-finder' ),
	'add_to_fav' => esc_html__( 'Add to Fav', 'service-finder' ),
	'select_service' => esc_html__( 'Please select atleast one service', 'service-finder' ),
	'otp_mail' => esc_html__( 'Please check email for OTP', 'service-finder' ),
	'otp_pass' => esc_html__( 'Please enter otp password', 'service-finder' ),
	'otp_right' => esc_html__( 'Please insert correct otp', 'service-finder' ),
	'reconfirm_email' => esc_html__( 'Please re-confirm the email address', 'service-finder' ),
	'gen_otp' => esc_html__( 'Generate One time Password to Confirm Email', 'service-finder' ),
	'edit_text' => esc_html__( 'Please insert correct otp', 'service-finder' ),
	'state' => esc_html__( 'State is required', 'service-finder' ),
	'city' => esc_html__( 'City is required', 'service-finder' ),
	'service_not_avl' => esc_html__( 'Service not available in your area', 'service-finder' ),
	'notavl_select_service' => esc_html__( 'Service not available in your area/Select atleast one service', 'service-finder' ),
	'region_and_service' => esc_html__( 'Please select region and atleat one service', 'service-finder' ),
	'timeslot' => esc_html__( 'Please select timeslot', 'service-finder' ),
	'member_select' => esc_html__( 'Please select member', 'service-finder' ),
	'my_fav' => esc_html__( 'My Favorite', 'service-finder' ),
	'booking_suc' => esc_html__( 'Congratuations! Your booking made successully', 'service-finder' ),
	'postcode_not_avl' => esc_html__( 'Postal Code is not available', 'service-finder' ),
	'submit_now' => esc_html__( 'Submit Now', 'service-finder' ),
	'next_text' => esc_html__( 'Next', 'service-finder' ),
	'paynow' => esc_html__( 'Pay Now', 'service-finder' ),
	'dt_first' => esc_html__( 'First', 'service-finder' ),
	'dt_last' => esc_html__( 'Last', 'service-finder' ),
	'dt_previous' => esc_html__( 'Prev', 'service-finder' ),
	'dt_next' => esc_html__( 'Next', 'service-finder' ),
	'dt_search' => esc_html__( 'Search', 'service-finder' ),
	'dt_show' => esc_html__( 'Show', 'service-finder' ),
	'dt_entries' => esc_html__( 'entries', 'service-finder' ),
	'dt_showing' => esc_html__( 'Showing', 'service-finder' ),
	'dt_to' => esc_html__( 'to', 'service-finder' ),
	'dt_of' => esc_html__( 'of', 'service-finder' ),
	'lang' => str_replace('_','-',get_locale()),
	'select_timeslot' => esc_html__( 'Select Timeslot', 'service-finder' ),
	'hire_if_booking_off_msg' => $hire_if_booking_off_msg,
	'select_plan' => esc_html__( 'Please select plan', 'service-finder' ),
	'add_city' => esc_html__( 'Add new city', 'service-finder' ),
	'latlng_notfound' => esc_html__( 'Lat and long cannot be found', 'service-finder' ),
	'captcha_validate' => esc_html__( 'The Validation code does not match!', 'service-finder' ),
	'no_result' => esc_html__( 'No results matched', 'service-finder' ),
	'only_digits' => esc_html__( 'Please enter only digits', 'service-finder' ),
	'not_selected' => esc_html__( 'Nothing selected', 'service-finder' ),
	'empty_table' => esc_html__( 'No data available in table', 'service-finder' ),
	'captchaverify' => esc_html__( 'Please verify the captcha code', 'service-finder' ),
	'enablebusiness' => esc_html__( 'Enable Claim Business', 'service-finder' ),
	'disbalebusiness' => esc_html__( 'Disable Claim Business', 'service-finder' ),
	'applied' => esc_html__( 'Applied', 'service-finder' ),
	'group_req' => esc_html__( 'Please insert group name', 'service-finder' ),
	'video_req' => esc_html__( 'Please inset video url', 'service-finder' ),
	'google_client_id_req' => esc_html__( 'Please inset Google Client ID', 'service-finder' ),
	'google_client_secret_req' => esc_html__( 'Please inset Google Client Secret', 'service-finder' ),
	'perpersion' => esc_html__( 'Item', 'service-finder' ),
	'perhour' => esc_html__( 'Hour', 'service-finder' ),
	'perpersion_short' => esc_html__( 'Item', 'service-finder' ),
	'perhour_short' => esc_html__( 'Hr', 'service-finder' ),
	'radius_search' => esc_html__( 'Please fill address to search by radius', 'service-finder' ),
	'show_more' => esc_html__( 'Show More Location', 'service-finder' ),
	'show_less' => esc_html__( 'Show Less Location', 'service-finder' ),
	'currencysymbol' => service_finder_currencysymbol(),
	'only_numeric' => esc_html__( 'Please enter only numerics', 'service-finder' ),
);
wp_localize_script( 'service_finder-js-form-validation', 'param', $string_array );
wp_localize_script( 'service_finder-js-registration', 'param', $string_array );
wp_localize_script( 'service_finder-js-form-submit', 'param', $string_array );
wp_localize_script( 'service_finder-js-availability-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-unavailability-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-bh-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-servicearea-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-service-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-job-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-team-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-bookings-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-invoice-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-invoice-customer-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-upgrade', 'param', $string_array );
wp_localize_script( 'service_finder-js-my-favorites', 'param', $string_array );
wp_localize_script( 'service_finder-js-quote-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-newsletter', 'param', $string_array );
wp_localize_script( 'service_finder-js-booking-form-v1', 'param', $string_array );
wp_localize_script( 'service_finder-js-booking-form-free-v1', 'param', $string_array );
wp_localize_script( 'service_finder-js-booking-form-v2', 'param', $string_array );
wp_localize_script( 'service_finder-js-booking-form-free-v2', 'param', $string_array );
wp_localize_script( 'service_finder-js-invoice-paid', 'param', $string_array );
wp_localize_script( 'service_finder-js-app', 'param', $string_array );
wp_localize_script( 'service_finder-js-schedule', 'param', $string_array );
wp_localize_script( 'service_finder-js-providers', 'param', $string_array );
wp_localize_script( 'admin-booking-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-admin-booking-form', 'param', $string_array );
wp_localize_script( 'service_finder-js-featured-requests', 'param', $string_array );
wp_localize_script( 'service_finder-js-invoice-requests', 'param', $string_array );
wp_localize_script( 'bootstrap-select', 'param', $string_array );
wp_localize_script( 'service_finder-js-quotations', 'param', $string_array );
wp_localize_script( 'service_finder-js-claimbusiness', 'param', $string_array );
wp_localize_script( 'service_finder-js-claimbusiness-payment', 'param', $string_array );
wp_localize_script( 'service_finder-js-job-apply', 'param', $string_array );
wp_localize_script( 'service_finder-js-custom', 'param', $string_array );
wp_localize_script( 'service_finder-js-custom-effects', 'param', $string_array );

?>