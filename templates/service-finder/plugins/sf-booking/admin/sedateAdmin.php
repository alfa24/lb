<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SERVICE_FINDER_sedateAdmin {

	/* Call the construct when class initialize */    
	public function __construct() {
        add_action( 'admin_menu', array( $this, 'service_finder_addAdminMenu' ) );

        // Admin Manager
        $this->bookingManager     	   = new SERVICE_FINDER_sedateBookingManager();
		$this->bookingCalendar     	   = new SERVICE_FINDER_sedateBookingCalendar();
		$this->providers     	   	   = new SERVICE_FINDER_sedateProviders();
		$this->customers     	   	   = new SERVICE_FINDER_sedateCustomers();
		$this->featured     	   	   = new SERVICE_FINDER_sedateFeatured();
		$this->invoice     	   	   	   = new SERVICE_FINDER_sedateInvoice();
		$this->cities     	   	   	   = new SERVICE_FINDER_sedateCities();
		$this->quotations     	   	   = new SERVICE_FINDER_sedateQuotations();
		$this->claimbusiness     	   = new SERVICE_FINDER_sedateClaimBusiness();

    }

    /*Add menus for admin panel*/
	public function service_finder_addAdminMenu() {
        global $wpdb, $current_user;
		$service_finder_options = get_option('service_finder_options');
		$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');
		$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customers', 'service-finder');	
		$claimbusinessstr = (!empty($service_finder_options['string-claim-business'])) ? $service_finder_options['string-claim-business'] : esc_html__('Claim Business', 'service-finder');	
		
		$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';

        // For Menu Translatins
        $bookings       = esc_html__( 'Bookings', 'service-finder' );
		$bookingCalendar       = esc_html__( 'Calendar View', 'service-finder' );
		$bookingProviders       = esc_html( $providerreplacestring );
		$providersIdentity       = esc_html( $providerreplacestring ).' '.esc_html__( 'Identity Check', 'service-finder' );
		$bookingCustomers       =  esc_html( $customerreplacestring );
		$featuredRequests       = esc_html__( 'Featured Requests', 'service-finder' );
		$invoices       = esc_html__( 'Invoices', 'service-finder' );
		$cities       = esc_html__( 'Cities', 'service-finder' );
		$quotations       = esc_html__( 'Quotations', 'service-finder' );
		$claimbusiness       = $claimbusinessstr;

        if ( in_array( 'administrator', $current_user->roles ) ) {
            if ( function_exists( 'add_options_page' ) ) {
                $position = '80.0000001' . mt_rand( 1, 1000 ); // Position always is under `Settings`
				
				add_menu_page( esc_html__( 'Service Finder', 'service-finder' ), esc_html__( 'Service Finder', 'service-finder' ), 'manage_options', 'service-finder', '','', $position );
                add_submenu_page( 'service-finder', $bookings, $bookings, 'manage_options', 'bookings',array( $this->bookingManager, 'service_finder_index' ) );
				add_submenu_page( 'service-finder', $bookingCalendar, $bookingCalendar, 'manage_options', 'booking-calendar',array( $this->bookingCalendar, 'service_finder_index' ) );
				add_submenu_page( 'service-finder', $bookingProviders, $bookingProviders, 'manage_options', 'providers',array( $this->providers, 'service_finder_index' ) );
				if($identitycheck){
				add_submenu_page( 'service-finder', $bookingProviders, $providersIdentity, 'manage_options', 'identity-check',array( $this->providers, 'service_finder_identitycheck' ) );
				}
				add_submenu_page( 'service-finder', $bookingCustomers, $bookingCustomers, 'manage_options', 'customers',array( $this->customers, 'service_finder_index' ) );
				add_submenu_page( 'service-finder', $featuredRequests, $featuredRequests, 'manage_options', 'featured-requests',array( $this->featured, 'service_finder_index' ) );
				add_submenu_page( 'service-finder', $invoices, $invoices, 'manage_options', 'invoices',array( $this->invoice, 'service_finder_index' ) );
				
				$autosuggestion = (!empty($service_finder_options['signup-auto-suggestion'])) ? $service_finder_options['signup-auto-suggestion'] : '';
				if(!$autosuggestion){
				add_submenu_page( 'service-finder', $cities, $cities, 'manage_options', 'cities',array( $this->cities, 'service_finder_index' ) );
				}
				
				add_submenu_page( 'service-finder', $quotations, $quotations, 'manage_options', 'quotations',array( $this->quotations, 'service_finder_index' ) );
				add_submenu_page( 'service-finder', $claimbusiness, $claimbusiness, 'manage_options', 'claimbusiness',array( $this->claimbusiness, 'service_finder_index' ) );
				
				global $submenu;
                unset( $submenu[ 'service-finder' ][ 0 ] );

            }
        }
    }

} 