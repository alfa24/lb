<?php
/*
Plugin Name: Service Finder Shortcodes
Plugin URI: http://aonetheme.com/
Description: This is a plugin for WordPress that adds shortcodes for home page and others.
Version: 2.3.1
Author: Aonetheme
Author URI: http://aonetheme.com/
*/


require_once( plugin_dir_path( __FILE__ ) . '/globals.php' );
require_once( plugin_dir_path( __FILE__ ) . '/templates/load-more-categories.php' );
require_once( plugin_dir_path( __FILE__ ) . '/templates/load-more-providers.php' );
require_once( plugin_dir_path( __FILE__ ) . '/templates/sf-template-shortcodes.php' );
require_once( plugin_dir_path( __FILE__ ) . '/templates/general-functions.php' );


// Installation and uninstallation hooks
function service_finder_shortcode_activate() {
	global $wpdb, $service_finder_Tables;

	/*Create object for table name access in theme*/
	$service_finder_Tables = (object) array(
								'providers' =>  'service_finder_providers',
								'services' =>  'service_finder_services',
								'team_members' =>  'service_finder_team_members',
								'bookings' =>  'service_finder_bookings',
								'customers' =>  'service_finder_customers',
								'customers_data' =>  'service_finder_customers_data',
								'booked_services' =>  'service_finder_booked_services',
								'timeslots' =>  'service_finder_timeslots',
								'service_area' =>  'service_finder_service_area',
								'regions' => 'service_finder_regions',
								'attachments' =>  'service_finder_attachments',
								'invoice' =>  'service_finder_invoice',
								'feedback' =>  'service_finder_feedback',
								'feature' =>  'service_finder_feature',
								'favorites' =>  'service_finder_favorites',
								'newsletter' =>  'service_finder_newsletter',
								'unavailability' =>  'service_finder_unavailability',
								'business_hours' =>  'service_finder_business_hours',
					);
}
register_activation_hook( __FILE__, 'service_finder_shortcode_activate' );

add_action( 'wp_head', 'service_finder_shortcode_inline_styles');

function service_finder_shortcode_inline_styles(){
?>
<style>
.default-hidden{ 
	display:none;
}
</style>
<?php
require_once( plugin_dir_path( __FILE__ ) . '/localize.php' );
}
