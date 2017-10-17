<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/* Include all admin core files */
require plugin_dir_path(__FILE__) . 'sedateAdmin.php'; //Main Admin File
require plugin_dir_path(__FILE__) . 'modules/bookings/sedateBookingManager.php'; //Booking Manager Class
require plugin_dir_path(__FILE__) . 'modules/booking-calendar/sedateBookingCalendar.php'; //Booking Calendar Class
require plugin_dir_path(__FILE__) . 'modules/providers/sedateProviders.php'; //Providers Class
require plugin_dir_path(__FILE__) . 'modules/customers/sedateCustomers.php'; //Customers Class
require plugin_dir_path(__FILE__) . 'modules/featured/sedateFeatured.php'; //Featured Class
require plugin_dir_path(__FILE__) . 'modules/invoice/sedateInvoice.php'; //Featured Class
require plugin_dir_path(__FILE__) . 'modules/cities/sedateCities.php'; //Featured Class
require plugin_dir_path(__FILE__) . 'modules/quotations/sedateQuotations.php'; //Featured Class
require plugin_dir_path(__FILE__) . 'modules/claimbusiness/sedateClaimBusiness.php'; //Featured Class
