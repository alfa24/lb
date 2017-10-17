<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */
global $service_finder_options;
    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "service_finder_options";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * -->

Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
    *
    */
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
	
    $sampleHTML = '';
    if ( file_exists( plugin_dir_path( __FILE__ ) . '/info-html.html' ) ) {
    Redux_Functions::initWpFilesystem();
    
    global $wp_filesystem;
    
    $sampleHTML = $wp_filesystem->get_contents( plugin_dir_path( __FILE__ ) . '/info-html.html' );
    }
    
    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();
    
    if ( is_dir( $sample_patterns_path ) ) {
    
    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
    $sample_patterns = array();
    
    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {
    
    if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
    $name              = explode( '.', $sample_patterns_file );
    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
    $sample_patterns[] = array(
    'alt' => $name,
    'img' => $sample_patterns_url . $sample_patterns_file
    );
    }
    }
    }
    }
    
    /**
    * ---> SET ARGUMENTS
    * All the possible arguments for Redux.
    * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
    * */
    
    $theme = wp_get_theme(); // For use with some settings. Not necessary.
    
    $args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get( 'Name' ),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get( 'Version' ),
    // Version that appears at the top of your panel
    'menu_type'            => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__( 'Theme Options', 'service-finder' ),
    'page_title'           => esc_html__( 'Theme Options', 'service-finder' ),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => 'service_finder_globals',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => false,
    // Show the time the page took to load, etc
    'update_notice'        => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.
    
    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    
    // HINTS
    'hints'                => array(
    'icon'          => 'el el-question-sign',
    'icon_position' => 'right',
    'icon_color'    => 'lightgray',
    'icon_size'     => 'normal',
    'tip_style'     => array(
    'color'   => 'red',
    'shadow'  => true,
    'rounded' => false,
    'style'   => '',
    ),
    'tip_position'  => array(
    'my' => 'top left',
    'at' => 'bottom right',
    ),
    'tip_effect'    => array(
    'show' => array(
    'effect'   => 'slide',
    'duration' => '500',
    'event'    => 'mouseover',
    ),
    'hide' => array(
    'effect'   => 'slide',
    'duration' => '500',
    'event'    => 'click mouseleave',
    ),
    ),
    )
    );
    
    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
    if ( ! empty( $args['global_variable'] ) ) {
    $v = $args['global_variable'];
    } else {
    $v = str_replace( '-', '_', $args['opt_name'] );
    }
    
    } else {
    
    }
    
    // Add content after the form.
    
    
    Redux::setArgs( $opt_name, $args );
    
    /*
    * ---> END ARGUMENTS
    */
    
    
    /*
    * ---> START HELP TABS
    */
    
    $tabs = array(
    array(
    'id'      => 'redux-help-tab-1',
    'title'   => esc_html__( 'Theme Information 1', 'service-finder' ),
    'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'service-finder' )
    ),
    array(
    'id'      => 'redux-help-tab-2',
    'title'   => esc_html__( 'Theme Information 2', 'service-finder' ),
    'content' => esc_html__( '
<p>This is the tab content, HTML is allowed.</p>
', 'service-finder' )
    )
    );
    Redux::setHelpTab( $opt_name, $tabs );
    
    // Set the help sidebar
    $content = esc_html__( '
<p>This is the sidebar content, HTML is allowed.</p>
', 'service-finder' );
    Redux::setHelpSidebar( $opt_name, $content );
    
    
    /*
    * <--- END HELP TABS
    */
    
    
    /*
    *
    * ---> START SECTIONS
    *
    */
    
    /*
    
    As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for
    
    
    */
    $service_finder_options = get_option('service_finder_options');
	$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');
	$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customers', 'service-finder');
    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'General Settings', 'service-finder' ),
    'id'               => 'general',
    'desc'             => esc_html__( 'Site General Settings', 'service-finder' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-home'
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Theme Layout', 'service-finder' ),
    'id'               => 'theme-layout-settings',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'theme-style',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Theme Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'style-1' => esc_html__( 'Style 1', 'service-finder' ),
    'style-2' => esc_html__( 'Style 2', 'service-finder' ),
    ),
	'default'  => 'style-1',
    )
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Header Settings', 'service-finder' ),
    'id'               => 'header-settings',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'site-logo',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Site Logo', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => '',
    'subtitle' => esc_html__( 'Upload site logo', 'service-finder' ),
    ),
	array(
    'id'       => 'email-logo',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Logo for Email Template', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => '',
    'subtitle' => esc_html__( 'Upload logo for email tempalte', 'service-finder' ),
    ),
    array(
    'id'             => 'logo-dimensions',
    'type'           => 'dimensions',
    'units'          => array( 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
    'units_extended' => 'true',  // Allow users to select any type of unit
    'title'          => esc_html__( 'Logo Dimensions', 'service-finder' ),
    'subtitle'       => esc_html__( '(Width/Height)', 'service-finder' ),
    'desc'           => '',
    'default'        => array(
    'width'  => '',
    'height' => '30px',
    )
    ),
    array(
    'id'             => 'logo-margin',
    'type'           => 'spacing',
    'mode'           => 'margin',
    'all'            => false,
    'units'          => array( 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
    'units_extended' => 'true',    // Allow users to select any type of unit
    'title'          => esc_html__( 'Logo Margin', 'service-finder' ),
    'subtitle'       => '',
    'desc'           => '',
    'default'        => array(
    'margin-top'    => '30px',
    'margin-right'  => '0px',
    'margin-bottom' => '30px',
    'margin-left'   => '0px'
    )
    ),
	array(
    'id'            => 'header-logo-title-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Header Logo Title Font Size', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => 'Works when logo image is missing for mobile',
    'default'       => 20,
    'min'           => 12,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'header-top-bar-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Header Top Bar Font Size', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 12,
    'min'           => 12,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'             => 'logo-dimensions-mobile',
    'type'           => 'dimensions',
    'units'          => array( 'px', '%' ),    // You can specify a unit value. Possible: px, em, %
    'units_extended' => 'true',  // Allow users to select any type of unit
    'title'          => esc_html__( 'Logo Dimensions for Mobile', 'service-finder' ),
    'subtitle'       => esc_html__( '(Width/Height)', 'service-finder' ),
    'desc'           => 'Works only for mobile',
    'default'        => array(
    'width'  => '',
    'height' => '30px',
    )
    ),
    array(
    'id'             => 'logo-margin-mobile',
    'type'           => 'spacing',
    'mode'           => 'margin',
    'all'            => false,
    'units'          => array( 'px', '%' ),      // You can specify a unit value. Possible: px, em, %
    'units_extended' => 'true',    // Allow users to select any type of unit
    'title'          => esc_html__( 'Logo Margin for Mobile', 'service-finder' ),
    'subtitle'       => '',
    'desc'           => 'Works only for mobile',
    'default'        => array(
    'margin-top'    => '30px',
    'margin-right'  => '0px',
    'margin-bottom' => '30px',
    'margin-left'   => '0px'
    )
    ),
	array(
    'id'            => 'header-logo-title-fontsize-mobile',
    'type'          => 'slider',
    'title'         => esc_html__( 'Header Logo Title Font Size for Mobile', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => 'Works when logo image is missing',
    'default'       => 20,
    'min'           => 12,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
    array(
    'id'       => 'header-style',
    'type'     => 'select',
    'title'    => esc_html__( 'Header Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for select options
    'options'  => array(
    'banner' => 'Banner Image',
    'map' => 'Map',
    ),
    'default'  => 'map'
    ),
	array(
    'id'       => 'header-full-width',
    'type'     => 'switch',
    'title'    => esc_html__( 'Header Full Width', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'home-search-bar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Hide Search Bar', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
    array(
    'id'       => 'header-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Banner Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => 'Only for home page (1920 x 840 px)',
    'subtitle' => '',
    ),
	array(
    'id'            => 'banner-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Banner Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => 0.3,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'banner-bg-color',
    'type'     => 'color',
    'title'    => esc_html__('Banner BG Color', 'service-finder'),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
	array(
    'id'       => 'banner-heading',
    'type'     => 'text',
    'title'    => esc_html__( 'Banner Heading', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter text for banner heading', 'service-finder' ),
	'default'  => 'We find Services For You'
    ),
	array(
    'id'            => 'banner-heading-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Banner Heading Font Size', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 72,
    'min'           => 10,
    'step'          => 1,
    'max'           => 100,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'banner-heading-line-height',
    'type'          => 'slider',
    'title'         => esc_html__( 'Banner Heading Line Height', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 70,
    'min'           => 10,
    'step'          => 1,
    'max'           => 100,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'banner-subheading',
    'type'     => 'text',
    'title'    => esc_html__( 'Banner Sub Heading', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter text for banner sub heading', 'service-finder' ),
	'default'  => 'Help around the home is just a few clicks away'
    ),
	array(
    'id'            => 'banner-sub-heading-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Banner Sub Heading Font Size', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 24,
    'min'           => 10,
    'step'          => 1,
    'max'           => 100,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'banner-sub-heading-line-height',
    'type'          => 'slider',
    'title'         => esc_html__( 'Banner Sub Heading Line Height', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 30,
    'min'           => 10,
    'step'          => 1,
    'max'           => 100,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'header-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Header BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'Only works with header white overlay and header black overlay style',
    'default'       => 0,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'top-bar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Top Bar', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'show-page-title',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Page Title', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'header-templates',
    'type'     => 'image_select',
    'title'    => esc_html__( 'Header Styles', 'service-finder' ),
    'subtitle' => '',
    'desc'     => 'First five header styles will work only if top bar is on',
    'options'  => array(
    'classic' => array(
    'alt' => 'classic',
    'img' => get_template_directory_uri().'/inc/images/redux/classic.jpg'
    ),
    'center-mode' => array(
    'alt' => 'center-mode',
    'img' => get_template_directory_uri().'/inc/images/redux/center-mode.jpg'
    ),
    'transperent' => array(
    'alt' => 'transperent',
    'img' => get_template_directory_uri().'/inc/images/redux/transperent.jpg'
    ),
    'overlay-white' => array(
    'alt' => 'overlay-white',
    'img' => get_template_directory_uri().'/inc/images/redux/overlay-white.jpg'
    ),
    'overlay-black' => array(
    'alt' => 'overlay-black',
    'img' => get_template_directory_uri().'/inc/images/redux/overlay-black.jpg'
    ),
    'no-top-bar' => array(
    'alt' => 'fixed',
    'img' => get_template_directory_uri().'/inc/images/redux/fixed.jpg'
    ),
	'transperent-no-top-bar' => array(
    'alt' => 'transperent-no-top-bar',
    'img' => get_template_directory_uri().'/inc/images/redux/transperent-no-top-bar.jpg'
    ),
    ),
    'default'  => 'classic'
    ),
    array(
    'id'       => 'favicon-icon',
    'type'     => 'media',
	'customizer'           => false,
    'url'      => true,
    'title'    => esc_html__( 'Upload Favicon', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => '',
    'subtitle' => esc_html__( '(.ico file)', 'service-finder' ),
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Navigation Settings', 'service-finder' ),
    'id'               => 'navigation-settings',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'login-signup-popup',
    'type'     => 'switch',
    'title'    => esc_html__( 'Login/Signup via Popup', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'top-bar-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Top Bar Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'top-bar-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Top Bar Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'enable-sticky',
    'type'     => 'switch',
    'title'    => esc_html__( 'Enable Sticky Header', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'breadcrumbs',
    'type'     => 'switch',
    'title'    => esc_html__( 'Breadcrumbs', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Navigation Styling', 'service-finder' ),
    'id'               => 'navigation-styling',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'            => 'parent-navigation-menu-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Font Size of Parent Navigation Menu', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 12,
    'min'           => 10,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'parent-navigation-menu-fontweight',
    'type'     => 'select',
    'title'    => esc_html__( 'Font Weight of Parent Navigation Menu', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'normal' => 'Normal',
    'bold' => 'Bold',
    ),
    'default'  => 'normal'
    ),
	array(
    'id'            => 'child-navigation-menu-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Font Size of Child Navigation Menu', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 11,
    'min'           => 10,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'child-navigation-menu-fontweight',
    'type'     => 'select',
    'title'    => esc_html__( 'Font Weight of Child Navigation Menu', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'normal' => 'Normal',
    'bold' => 'Bold',
    ),
    'default'  => 'normal'
    ),
	array(
    'id'       => 'navigation-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
	array(
    'id'       => 'navigation-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#555555',
    'validate' => 'color',
    ),
    array(
    'id'       => 'navigation-text-hover-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Text Hover Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'navigation-dropdown-bg',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Dropdown BG', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
	array(
    'id'       => 'navigation-dropdown-hover-bg',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Dropdown Hover BG', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ebebeb',
    'validate' => 'color',
    ),
    array(
    'id'       => 'navigation-dropdown-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Dropdown Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#555555',
    'validate' => 'color',
    ),
    array(
    'id'       => 'navigation-dropdown-text-hover',
    'type'     => 'color',
    'title'    => esc_html__( 'Navigation Dropdown Text Hover', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396D1',
    'validate' => 'color',
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Styling & Layout', 'service-finder' ),
    'id'               => 'styling-and-layout',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'color-scheme',
    'type'     => 'color',
    'title'    => esc_html__( 'Theme Primary Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
	array(
    'id'       => 'seconday-color-scheme',
    'type'     => 'color',
    'title'    => esc_html__( 'Theme Secondary Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#77c04b',
    'validate' => 'color',
    ),
	array(
    'id'       => 'header-logo-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Header Logo Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
	array(
    'id'       => 'footer-logo-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Footer Logo Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-primary-background-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Primary Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#77c04b',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-primary-border-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Primary Border Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#62a643',
    'validate' => 'color',
    ),
    array(

    'id'       => 'button-primary-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Text Primary Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-primary-hover-background-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Primary Hover Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#6ab33e',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-primary-hover-border-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Primary Hover Border Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#5a9e2f',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-primary-hover-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Primary Text Hover Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-background-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-border-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Border Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#1f82bd',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-hover-background-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Hover Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#1f82bd',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-hover-border-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Hover Border Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#0c6faa',
    'validate' => 'color',
    ),
    array(
    'id'       => 'button-secondary-hover-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Button Secondary Text Hover Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Footer Setting', 'service-finder' ),
    'id'               => 'footer-setting',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'show-footer',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Top Footer', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'footer-background-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Footer Background Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#202020',
    'validate' => 'color',
    ),
    array(
    'id'            => 'footer-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Footer Top Overlay', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'Only works with footer background image',
    'default'       => 0,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'footer-fontsize',
    'type'          => 'slider',
    'title'         => esc_html__( 'Footer Font Size', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => '',
    'default'       => 13,
    'min'           => 12,
    'step'          => 1,
    'max'           => 40,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
    array(
    'id'       => 'footer-layout',
    'type'     => 'image_select',
    'title'    => esc_html__( 'Footer Layout', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value(array:title|img) pairs for radio options
    'options'  => array(
    'col-4' => array(
    'alt' => '4 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-4.jpg'
    ),
    'col-3' => array(
    'alt' => '3 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-3.jpg'
    ),
    'col-2-1' => array(
    'alt' => '2-1 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-2-1.jpg'
    ),
    'col-2' => array(
    'alt' => '2 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-2.jpg'
    ),
    'col-1' => array(
    'alt' => '1-1 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-1-4.jpg'
    ),
    'col-1-3' => array(
    'alt' => '1-3 Column',
    'img' => get_template_directory_uri().'/inc/images/redux/f-col-1-3.jpg'
    )
    ),
    'default'  => 'col-4'
    ),
    array(
    'id'       => 'show-bottom-footer',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Bottom Footer', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'footer-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Footer BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => '',
    'subtitle' => '',
    ),
    array(
    'id'       => 'bottom-footer-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Bottom Footer BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#3396d1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'bottom-footer-text-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Bottom Footer Text Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'            => 'bottom-footer-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Footer Bottom Overlay', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'Only works with footer background image',
    'default'       => 0,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
    array(
    'id'       => 'show-copyright',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Copyright', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'copyright',
    'type'     => 'text',
    'title'    => esc_html__( 'Copyright', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Copyright Text Here', 'service-finder' ),
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Inner Page Banner Settings', 'service-finder' ),
    'id'               => 'sub-header-setting',
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'sub-header',
    'type'     => 'switch',
    'title'    => esc_html__( 'Sub Header', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'contact-sub-header-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Contact Us Banner Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '1920 x 345 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For Contact Page', 'service-finder' ),
    ),
    array(
    'id'       => 'inner-sub-header-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Inner Page Banner Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '2000 x 1280 px', 'service-finder' ),
    'subtitle' => '',
    ),
    array(
    'id'       => 'provider-sub-header-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => sprintf( esc_html__('%s Page Banner Image', 'service-finder'), $providerreplacestring ),
    'compiler' => 'true',
    'desc'     => esc_html__( '2000 x 1280 px', 'service-finder' ),
    'subtitle' => sprintf( esc_html__('For %s Page', 'service-finder'), $providerreplacestring ),
    ),
	array(
    'id'            => 'inner-banner-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Inner Banner Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => 0.3,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'inner-banner-bg-color',
    'type'     => 'color',
    'title'    => esc_html__('Inner Banner BG Color', 'service-finder'),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Background Images', 'service-finder' ),
    'id'               => 'background-images',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'featured-providers-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => sprintf( esc_html__('Featured %s BG Image', 'service-finder'), $providerreplacestring ),
    'compiler' => 'true',
    'desc'     => esc_html__( '1920 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For Home Page', 'service-finder' ),
    ),
	array(
    'id'       => 'featured-providers-background-attachment',
    'type'     => 'button_set',
    'title'    => sprintf( esc_html__('Featured %s Background Attachment', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'scroll',
    ),
	array(
    'id'            => 'featured-providers-bg-opacity',
    'type'          => 'slider',
    'title'         => sprintf( esc_html__('Featured %s BG Opacity', 'service-finder'), $providerreplacestring ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'featured-providers-bg-color',
    'type'     => 'color',
    'title'    => sprintf( esc_html__('Featured %s BG Color', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
    array(
    'id'       => 'follow-us-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Follow Us BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '2000 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For Home Page', 'service-finder' ),
    ),
	array(
    'id'       => 'follow-us-background-attachment',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Follow Us Background Attachment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'fixed',
    ),
	array(
    'id'            => 'follow-us-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Follow Us BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'follow-us-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Follow Us BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
	array(
    'id'       => 'why-choose-us-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Why Choose Us BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '2000 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For Home Page', 'service-finder' ),
    ),
	array(
    'id'       => 'why-choose-us-background-attachment',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Why Choose Us Background Attachment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'scroll',
    ),
	array(
    'id'            => 'why-choose-us-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Why Choose Us BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'why-choose-us-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Why Choose Us BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
	array(
    'id'       => 'after-title-separator',
    'type'     => 'switch',
    'title'    => esc_html__( 'After Title Separator', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'icon-between-devider',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'After Title Separator Icon', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '25 x 25 px', 'service-finder' ),
    ),
    array(
    'id'       => 'bio-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Bio BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '1920 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For Who\'s on service finder.com section on home page', 'service-finder' ),
    ),
	array(
    'id'       => 'bio-background-attachment',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Bio Background Attachment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'fixed',
    ),
	array(
    'id'            => 'bio-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Bio BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'bio-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Bio BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
    array(
    'id'       => 'photo-gallery-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Photo Gallery BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '1920 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For photo gallery section on provider\'s page style 2', 'service-finder' ),
    ),
	array(
    'id'       => 'photo-gallery-background-attachment',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Photo Gallery Background Attachment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'fixed',
    ),
	array(
    'id'            => 'photo-gallery-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Photo Gallery BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'photo-gallery-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Photo Gallery BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
    array(
    'id'       => 'request-quote-bg-image',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Request a Quote BG Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '2000 x 1200 px', 'service-finder' ),
    'subtitle' => esc_html__( 'For request a quote section on provider\'s page style 2', 'service-finder' ),
    ),
	array(
    'id'       => 'request-quote-background-attachment',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Request a Quote Background Attachment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'scroll' => esc_html__( 'Scroll', 'service-finder' ),
    'fixed' => esc_html__( 'Fixed', 'service-finder' ),
    ),
	'default'  => 'fixed',
    ),
	array(
    'id'            => 'request-quote-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Request a Quote BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .8,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'request-quote-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Request a Quote BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#000',
    'validate' => 'color',
    ),
    array(
    'id'           => 'quote-description',
    'type'         => 'textarea',
    'title'        => esc_html__( 'Description for Request a Quote', 'service-finder' ),
    'subtitle'     => esc_html__( 'Enter description for request a quote section', 'service-finder' ),
    'desc'         => '',
    'validate'     => 'html_custom',
    'default'      => '',
    'allowed_html' => array(
    'a'      => array(
    'href'  => array(),
    'title' => array()
    ),
    'br'     => array(),
    'em'     => array(),
    'strong' => array()
    ) 
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Blog Settings', 'service-finder' ),
    'id'               => 'blog-setting',
    'subsection'       => true,
    'customizer_width' => '450px',
	'customizer'           => false,
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'blog-templates',
    'type'     => 'image_select',
    'title'    => esc_html__( 'Blog Templates', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value(array:title|img) pairs for radio options
    'options'  => array(
    'blog-grid-2' => array(
    'alt' => 'Blog Grid 2',
    'img' => get_template_directory_uri().'/inc/images/redux/blog-grid-2.jpg'
    ),
    'blog-grid-3' => array(
    'alt' => 'Blog Grid 3',
    'img' => get_template_directory_uri().'/inc/images/redux/blog-grid-3.jpg'
    ),
    'blog-standard' => array(
    'alt' => 'Blog Large Image',
    'img' => get_template_directory_uri().'/inc/images/redux/blog-large-image.jpg'
    ),
    'blog-left-sidebar' => array(
    'alt' => 'Blog with Left Sidebar',
    'img' => get_template_directory_uri().'/inc/images/redux/left-sidebar.jpg'
    ),
    'blog-no-sidebar' => array(
    'alt' => 'Blog with No Sidebar',
    'img' => get_template_directory_uri().'/inc/images/redux/no-side-bar.jpg'
    ),
    'blog-right-sidebar' => array(
    'alt' => 'Blog with Right Sidebar',
    'img' => get_template_directory_uri().'/inc/images/redux/blog-half-image.jpg'
    )
    ),
    'default'  => 'blog-standard'
    ),
    )
    ) );
    
	$allcountries = service_finder_get_allcountries();
    if(!empty($allcountries)){
    foreach($allcountries as $country){
    $countryarr[$country] = $country;
    }
    }else{
    $countryarr[] = 'Please Select a Country';
    }
    
    $service_finder_options = get_option('service_finder_options');
    if($wpdb->get_var("SHOW TABLES LIKE '".$service_finder_Tables->providers."'") == $service_finder_Tables->providers) {
	
	if(!empty($service_finder_options['default-country'])){
    $defaultcities = $wpdb->get_results('SELECT DISTINCT city FROM '.$service_finder_Tables->providers.' WHERE admin_moderation = "approved" AND account_blocked != "yes" AND `country` LIKE "'.$service_finder_options['default-country'].'"');
    if(!empty($defaultcities)){
	$cityarr[] = 'Please Select a City';
    foreach($defaultcities as $city){
    $cityarr[$city->city] = $city->city;
    }
    }else{
    $cityarr[] = 'Please Select a City';
    }
    }else{
    $cityarr[] = 'Please Select a City';
    }
	
	}else{
	$cityarr[] = 'Please Select a City';
	}
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Page Setting', 'service-finder' ),
    'id'               => 'page-setting',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'page-sidebar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Page Sidebar', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'sidebar-position',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Sidebar Position', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'left' => esc_html__( 'Left', 'service-finder' ),
    'right' => esc_html__( 'Right', 'service-finder' ),
    ),
    'default'  => 'right'
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Map Setting', 'service-finder' ),
    'id'               => 'map-setting',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'google-map-api-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Browser API Key', 'service-finder' ),
    'desc' => esc_html__( 'Enter Registered Browser API Key by Google (Required)', 'service-finder' ),
    ),
	array(
    'id'       => 'server-api-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Server API Key', 'service-finder' ),
    'desc' => esc_html__( 'Enter Registered Server API Key by Google (Optional)', 'service-finder' ),
    ),
	array(
    'id'       => 'default-map-marker-icon',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Default Map Marker Icon', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => esc_html__( '20 x 32 px', 'service-finder' ),
    'subtitle' => '',
    ),
	array(
    'id'            => 'map-height-desktop',
    'type'          => 'slider',
    'title'         => esc_html__( 'Map Height in Desktop', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => 'Works only for home page',
    'default'       => 600,
    'min'           => 100,
    'step'          => 1,
    'max'           => 1000,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'map-height-ipad',
    'type'          => 'slider',
    'title'         => esc_html__( 'Map Height in Ipad', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => 'Works only for home page',
    'default'       => 650,
    'min'           => 100,
    'step'          => 1,
    'max'           => 1000,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'map-height-mobile',
    'type'          => 'slider',
    'title'         => esc_html__( 'Map Height in Mobile', 'service-finder' ),
    'subtitle'      => '(In px)',
    'desc'          => 'Works only for home page',
    'default'       => 350,
    'min'           => 100,
    'step'          => 1,
    'max'           => 1000,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
    array(
    'id'       => 'default-location-section',
    'type'     => 'section',
    'title'    => esc_html__( 'Default Location', 'service-finder' ),
    'subtitle' => 'Only registered providers cities will be populated here.',
    'indent'   => false,
    ),
    array(
    'id'       => 'default-country',
    'type'     => 'select',
    'title'    => esc_html__( 'Select Country', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $countryarr,
    ),
    array(
    'id'       => 'default-city',
    'type'     => 'select',
    'title'    => esc_html__( 'Select City', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $cityarr,
    ),
    array(
    'id'       => 'map-color-administrative',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Administrative)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#0088ff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-landscape',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Landscape)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ff0000',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-poi-government',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Poi-Government)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#aaaaaa',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-road-geometry',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Road Geometry)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#f0ece9',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-road-labels',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Road Labels)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ccdca1',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-water-all',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Water All)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#767676',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-water-geometry',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Water Geometry)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#ffffff',
    'validate' => 'color',
    ),
    array(
    'id'       => 'map-color-water-labels',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Water Labels)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#e8e0d8',
    'validate' => 'color',
    ),
	array(
    'id'       => 'map-color-cluster',
    'type'     => 'color',
    'title'    => esc_html__( 'Map Color (Cluster)', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#0088ff',
    'validate' => 'color',
    ),
	array(
    'id'            => 'zoom-level-address',
    'type'          => 'slider',
    'title'         => esc_html__( 'Zoom Level for Address', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'It works only for home page',
    'default'       => 14,
    'min'           => 0,
    'step'          => 1,
    'max'           => 20,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'zoom-level-city',
    'type'          => 'slider',
    'title'         => esc_html__( 'Zoom Level for City', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'It works only for home page',
    'default'       => 12,
    'min'           => 0,
    'step'          => 1,
    'max'           => 20,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'zoom-level-country',
    'type'          => 'slider',
    'title'         => esc_html__( 'Zoom Level for Country', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'It works only for home page',
    'default'       => 5,
    'min'           => 0,
    'step'          => 1,
    'max'           => 20,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'zoom-level',
    'type'          => 'slider',
    'title'         => esc_html__( 'Zoom Level', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => 'It works only for inner pages like contact us, provider profile etc..',
    'default'       => 15,
    'min'           => 0,
    'step'          => 1,
    'max'           => 20,
    'display_value' => 'text'
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Search Setting', 'service-finder' ),
    'id'               => 'search-setting',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'search-template',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Search Template', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'style-1' => esc_html__( 'Style 1', 'service-finder' ),
    'style-2' => esc_html__( 'Style 2', 'service-finder' ),
    ),
    'default'  => 'style-1'
    ),
	array(
    'id'       => 'search-bar-position',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Search Bar Position', 'service-finder' ),
    'subtitle' => '',
    'desc'     => 'Only works for home page',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'middle' => esc_html__( 'In Middle', 'service-finder' ),
    'bottom' => esc_html__( 'In Bottom', 'service-finder' ),
    ),
    'default'  => 'bottom'
    ),
	array(
    'id'       => 'default-view',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Default View (Style 1)', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'grid-4' => 'Grid View 4 Column',
    'grid-3' => 'Grid View 3 Column',
	'listview' => 'List View',
    ),
    'default'  => 'grid-4'
    ),
	array(
    'id'       => 'default-view-2',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Default View (Style 2)', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'grid-2' => 'Grid View 2 Column',
	'listview' => 'List View',
    ),
    'default'  => 'grid-2'
    ),
	array(
    'id'       => 'srhresult-search-bar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Hide Search Bar', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'search-bar-bg-color',
    'type'     => 'color',
    'title'    => esc_html__( 'Search Bar BG Color', 'service-finder' ),
    'subtitle' => '',
    'default'  => '#fff',
    'validate' => 'color',
    ),
	array(
    'id'            => 'search-bar-bg-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Search Bar BG Opacity', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => .3,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
    array(
    'id'       => 'search-header-style',
    'type'     => 'select',
    'title'    => esc_html__( 'Search Page Header Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'banner' => 'Banner',
    'map' => 'Map',
    ),
    'default'  => 'map'
    ),
    array(
    'id'       => 'search-style',
    'type'     => 'select',
    'title'    => esc_html__( 'Search Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'ajax-search' => 'Ajax Search',
    'page-reload' => 'Page Realod',
    'ajax-with-url-change' => 'Ajax Search with URL Change',
    ),
    'default'  => 'ajax-search'
    ),
    array(
    'id'      => 'srh-per-page',
    'type'    => 'spinner',
    'title'   => esc_html__( 'Show number of items per page', 'service-finder' ),
    'desc'    => '',
    'default' => '12',
    'min'     => '1',
    'step'    => '1',
    'max'     => '120',
    ),
	array(
    'id'       => 'show-featured-providers-top',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Featured Providers on Top', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'advance-search-view',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Advance Search Default View', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'show' => esc_html__( 'Show', 'service-finder' ),
	'hide' => esc_html__( 'Hide', 'service-finder' ),
    ),
    'default'  => 'hide'
    ),
	array(
    'id'       => 'search-fields-section',
    'type'     => 'section',
    'title'    => esc_html__( 'Search Fields', 'service-finder' ),
    'subtitle' => '',
    'indent'   => false,
    ),
	array(
    'id'       => 'search-keyword',
    'type'     => 'switch',
    'title'    => esc_html__( 'Keyword', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-address',
    'type'     => 'switch',
    'title'    => esc_html__( 'Address', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-category',
    'type'     => 'switch',
    'title'    => esc_html__( 'Category', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-country',
    'type'     => 'switch',
    'title'    => esc_html__( 'Country', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-city',
    'type'     => 'switch',
    'title'    => esc_html__( 'City', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-price',
    'type'     => 'switch',
    'title'    => esc_html__( 'Price Range', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'search-radius',
    'type'     => 'switch',
    'title'    => esc_html__( 'Radius', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'            => 'search-max-price',
    'type'          => 'slider',
    'title'         => esc_html__( 'Maximum Price for Search Filter', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => 1000,
    'min'           => 1,
    'step'          => 1,
    'max'           => 100000,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'search-max-radius',
    'type'          => 'slider',
    'title'         => esc_html__( 'Maximum Radius for Search Filter', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => 1000,
    'min'           => 1,
    'step'          => 1,
    'max'           => 5000,
    'resolution'    => 1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'radius-search-unit',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Radius Search in', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'mi' => 'Miles',
	'km' => 'Km',
    ),
    'default'  => 'mi'
    ),
    array(
    'id'         => 'search-preview',
    'type'       => 'raw',
    'full_width' => false,
    'title'      => esc_html__( 'Preview', 'service-finder' ),
    'subtitle'   => '',
    'desc'       => '',
    'content'    => '<img src="'.get_template_directory_uri().'/inc/images/redux/search-template-demo.jpg">',
    ),
    )
    ) );
    
    $categories = $wpdb->get_results("SELECT t.term_id, t.name, t.slug FROM ".$wpdb->prefix."terms AS t INNER JOIN ".$wpdb->prefix."term_taxonomy AS tt ON (t.term_id = tt.term_id) WHERE tt.taxonomy IN ('providers-category') ORDER BY t.name ASC");
    
    if(!empty($categories)){
    foreach($categories as $category){
    $categoryarr[$category->term_id] = $category->name;
    }
    }else{
    $categoryarr[] = '';
    }

    Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'Category Settings', 'service-finder' ),
    'id'               => 'provider-category-setting',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'sub-category-layout',
    'type'     => 'button_set',
    'title'    => sprintf( esc_html__('Sub Category Layout on %s Category Page', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'style-1' => 'Style 1',
    'style-2' => 'Style 2',
	'style-3' => 'Style 3',
    ),
    'default'  => 'style-1'
    ),
    array(
    'id'            => 'overlay-hover-opacity',
    'type'          => 'slider',
    'title'         => esc_html__( 'Overlay Opacity on Hover', 'service-finder' ),
    'subtitle'      => '',
    'desc'          => '',
    'default'       => 0.3,
    'min'           => 0,
    'step'          => .1,
    'max'           => 1,
    'resolution'    => 0.1,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'category-search-bar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Hide Search Bar', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'show-category-featured-providers-top',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Featured Providers on Top', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'providers-category-replace-string',
    'type'     => 'text',
    'title'    => sprintf( esc_html__( 'String that will replace "providers-category" Word on %s Category Page URL', 'service-finder' ), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => esc_html__('Leave blank for no changes', 'service-finder'),
    'default'  => '',
	'required' => array( 'keep-author-word', '=', 'yes' ),
    ),
	array(
    'id'       => 'category-image-banner',
    'type'     => 'switch',
    'title'    => esc_html__( 'Use Category Image as Banner for Individual Category Page', 'service-finder' ),
	'desc'     => esc_html__( 'Use 2000 x 1200 px image for better quality banner', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'homepage-categories',
    'type'     => 'select',
    'multi'    => true,
	'sortable' => true,
    'title'    => esc_html__( 'Home Page Categories', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $categoryarr,
    'default'  => ''
    ),
	array(
    'id'         => 'category-styles',
    'type'       => 'raw',
    'full_width' => false,
    'title'      => esc_html__( 'Style Preview', 'service-finder' ),
    'subtitle'   => '',
    'desc'       => '',
    'content'    => '<img src="'.get_template_directory_uri().'/inc/images/redux/provider-categories.jpg">',
    ),
    )
    ) );

    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Settings', 'service-finder' ),
    'id'               => 'social-settings',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
	'customizer'           => false,
    'icon'             => 'el el-thumbs-up'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Media', 'service-finder' ),
    'id'               => 'social-media',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'fb-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Facebook URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Facebook URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'linkedin-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Linkedin URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Linkedin URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'twitter-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Twitter URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Twitter URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'pinterest-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Pinterest URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Pinterest URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'g-plus-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Google Plus URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Google Plus URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'delicious-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Delicious URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Delicius URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'digg-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Digg URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Digg URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    array(
    'id'       => 'flickr-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Flickr URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Flickr URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
	array(
    'id'       => 'instagram-link',
    'type'     => 'text',
    'title'    => esc_html__( 'Instagram URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Instagram URL', 'service-finder' ),
    'desc'     => '',
    'validate' => 'url',
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Social Shares', 'service-finder' ),
    'id'               => 'social-shares',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'enable-social-shares',
    'type'     => 'switch',
    'title'    => esc_html__( 'Enable Social Shares', 'service-finder' ),
    'subtitle' => esc_html__( 'Enable this option to show social shares below each post', 'service-finder' ),
    'default'  => true,
    ),
    array(
    'id'       => 'facebook',
    'type'     => 'switch',
    'title'    => esc_html__( 'Facebook', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'linkedin',
    'type'     => 'switch',
    'title'    => esc_html__( 'Linkedin', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'twitter',
    'type'     => 'switch',
    'title'    => esc_html__( 'Twitter', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'pinterest',
    'type'     => 'switch',
    'title'    => esc_html__( 'Pinterest', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'google-plus',
    'type'     => 'switch',
    'title'    => esc_html__( 'Google Plus', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    array(
    'id'       => 'digg',
    'type'     => 'switch',
    'title'    => esc_html__( 'Digg', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    )
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Typography Settings', 'service-finder' ),
    'id'               => 'typography-settings',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-font'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Predefine Tags', 'service-finder' ),
    'id'               => 'predefine-tags',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    /*array(
    'id'       => 'body-tag',
    'type'     => 'typography',
    'title'    => esc_html__( 'Body Tag', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'text-align' => false,
	'text-transform' => false,
	'subsets' => false,
    'default'  => array(
    'color'       => '#767676',
    'font-size'   => '13px',
    'font-family' => "Open Sans",
    'font-weight' => '400',
    'line-height' => '24px',
    ),
    ),*/
	array(
    'id'       => 'h1-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H1 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'subsets' => false,
	'text-align' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '24px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '24px',
    ),
    ),
    array(
    'id'       => 'h2-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H2 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'text-align' => false,
	'subsets' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '24px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '24px',
    ),
    ),
    array(
    'id'       => 'h3-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H3 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'subsets' => false,
	'text-align' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '20px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '24px',
    ),
    ),
    array(
    'id'       => 'h4-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H4 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'text-align' => false,
	'subsets' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '18px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '22px',
    ),
    ),
    array(
    'id'       => 'h5-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H5 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'text-align' => false,
	'subsets' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '16px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '22px',
    ),
    ),
    array(
    'id'       => 'h6-size',
    'type'     => 'typography',
    'title'    => esc_html__( 'H6 Size', 'service-finder' ),
    'subtitle' => '',
    'google'   => true,
	'text-align' => false,
	'subsets' => false,
	'text-transform' => true,
    'default'  => array(
    'color'       => '#555555',
    'font-size'   => '14px',
    'font-family' => "Open Sans",
    'font-weight' => 'Normal',
    'line-height' => '18px',
    ),
    ),
    )
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Contact Page', 'service-finder' ),
    'id'               => 'contact-page',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-envelope'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Contact Us', 'service-finder' ),
    'id'               => 'contact-us',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'contact-templates',
    'type'     => 'image_select',
    'title'    => esc_html__( 'Contact Templates', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value(array:title|img) pairs for radio options
    'options'  => array(
    'contact-us' => array(
    'alt' => 'Contact ver 1',
    'img' => get_template_directory_uri().'/inc/images/redux/contact-1.jpg'
    ),
    'contact-us-v2' => array(
    'alt' => 'Contact ver 2',
    'img' => get_template_directory_uri().'/inc/images/redux/contact-2.jpg'
    ),
    'contact-us-v3' => array(
    'alt' => 'Contact ver 3',
    'img' => get_template_directory_uri().'/inc/images/redux/contact-4.jpg'
    ),
    'contact-us-v4' => array(
    'alt' => 'Contact ver 4',
    'img' => get_template_directory_uri().'/inc/images/redux/contact-3.jpg'
    ),
    ),
    'default'  => 'contact-us'
    ),
    array(
    'id'       => 'phone',
    'type'     => 'text',
    'title'    => esc_html__( 'Phone', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter phone number', 'service-finder' ),
    ),
    array(
    'id'       => 'email',
    'type'     => 'text',
    'title'    => esc_html__( 'Email', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter Valid Email', 'service-finder' ),
    'desc'     => '',
    'validate' => 'email',
    'msg'      => 'Please enter valid email address',
    'default'  => '',
    ),
    array(
    'id'           => 'address',
    'type'         => 'textarea',
    'title'        => esc_html__( 'Address', 'service-finder' ),
    'subtitle'     => esc_html__( 'Enter address here', 'service-finder' ),
    'desc'         => '',
    'validate'     => 'html_custom',
    'default'      => '',
    'allowed_html' => array(
    'a'      => array(
    'href'  => array(),
    'title' => array()
    ),
    'br'     => array(),
    'em'     => array(),
    'strong' => array()
    ) 
    ),
    )
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Accounts', 'service-finder' ),
    'id'               => 'accounts',
	'customizer'           => false,
    'desc'             => esc_html__( 'Accounts Settings', 'service-finder' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-user'
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Payment Settings', 'service-finder' ),
    'id'               => 'payment-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'pay_booking_amount_to',
    'type'     => 'select',
    'title'    => esc_html__( 'Booking Payment to', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'admin' => 'Admin',
    'provider' => esc_html($providerreplacestring),
    ),
    'default'  => 'admin'
    ),
	array(
    'id'       => 'payment-methods',
    'type'     => 'checkbox',
	'desc'     => 'Wire Transfer for booking and registration/Paypal Adaptive for pay to provider from admin',
    'title'    => esc_html__( 'Payment Methods', 'service-finder' ),
    'options'  => array(
    'paypal' => 'Paypal',
    'stripe' => 'Stripe',
	/*'twocheckout' => '2Checkout',*/
	'wired' => 'Wire Transfer',
	'paypal-adaptive' => 'Paypal Adaptive',
	'payumoney' => 'PayU Money '.esc_html__( '(Works for one time payment, not recurring.)', 'service-finder' ),
	'payulatam' => 'PayU Latam '.esc_html__( '(Works for one time payment, not recurring.)', 'service-finder' ),
	'cod' => 'Cash on Delivery '.esc_html__( '(Works only for booking)', 'service-finder' ),
    ),
    'default'  => array(
    'wired' => '0',
	'paypal' => '1',
    'stripe' => '0',
	'paypal-adaptive' => '0',
	'payu-money' => '0',
	'cod' => '0',
    )
    ),
	array(
    'id'       => 'currency-format',
    'type'     => 'text',
    'title'    => esc_html__( 'Currency Format According to Language Code', 'service-finder' ),
    'subtitle' => '',
	'desc'    => sprintf( esc_html__( 'Ex.: en_US. You can get locals code from %s', 'service-finder' ), '<a target="_blank" href="http://www.roseindia.net/tutorials/I18N/locales-list.shtml">here</a>' ),
    'default'  => ''
    ),
    array(
    'id'       => 'currency-code',
    'type'     => 'select',
    'title'    => esc_html__( 'Currency Code', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'AED' => esc_html__( 'United Arab Emirates Dirham', 'service-finder' ),
    'AUD' => esc_html__( 'Australian Dollars (&#36;)', 'service-finder' ),
	'ARS' => esc_html__( 'Argentina (&#36;)', 'service-finder' ),
    'BDT' => esc_html__( 'Bangladeshi Taka (&#2547;&nbsp;)', 'service-finder' ),
    'BRL' => esc_html__( 'Brazilian Real (&#82;&#36;)', 'service-finder' ),
    'BGN' => esc_html__( 'Bulgarian Lev (&#1083;&#1074;.)', 'service-finder' ),
    'CAD' => esc_html__( 'Canadian Dollars (&#36;)', 'service-finder' ),
    'CLP' => esc_html__( 'Chilean Peso (&#36;)', 'service-finder' ),
    'CNY' => esc_html__( 'Chinese Yuan (&yen;)', 'service-finder' ),
    'COP' => esc_html__( 'Colombian Peso (&#36;)', 'service-finder' ),
    'CZK' => esc_html__( 'Czech Koruna (&#75;&#269;)', 'service-finder' ),
    'DKK' => esc_html__( 'Danish Krone (kr.)', 'service-finder' ),
    'DOP' => esc_html__( 'Dominican Peso (RD&#36;)', 'service-finder' ),
    'EUR' => esc_html__( 'Euros (&euro;)', 'service-finder' ),
    'HKD' => esc_html__( 'Hong Kong Dollar (&#36;)', 'service-finder' ),
    'HRK' => esc_html__( 'Croatia kuna (Kn)', 'service-finder' ),
    'HUF' => esc_html__( 'Hungarian Forint (&#70;&#116;)', 'service-finder' ),
    'ISK' => esc_html__( 'Icelandic krona (Kr.)', 'service-finder' ),
    'IDR' => esc_html__( 'Indonesia Rupiah (Rp)', 'service-finder' ),
    'INR' => esc_html__( 'Indian Rupee (Rs.)', 'service-finder' ),
    'NPR' => esc_html__( 'Nepali Rupee (Rs.)', 'service-finder' ),
    'ILS' => esc_html__( 'Israeli Shekel (&#8362;)', 'service-finder' ),
    'JPY' => esc_html__( 'Japanese Yen (&yen;)', 'service-finder' ),
    'KIP' => esc_html__( 'Lao Kip (&#8365;)', 'service-finder' ),
    'KRW' => esc_html__( 'South Korean Won (&#8361;)', 'service-finder' ),
    'MAD' => esc_html__( 'Moroccan Dirham (&#x2e;&#x62f;&#x2e;&#x645;)', 'service-finder' ),
	'MYR' => esc_html__( 'Malaysian Ringgits (&#82;&#77;)', 'service-finder' ),
	'MVR' => esc_html__( 'Maldivian Rufiyaa (Rf)', 'service-finder' ),
    'MXN' => esc_html__( 'Mexican Peso (&#36;)', 'service-finder' ),
    'NGN' => esc_html__( 'Nigerian Naira (&#8358;)', 'service-finder' ),
    'NOK' => esc_html__( 'Norwegian Krone (&#107;&#114;)', 'service-finder' ),
    'NZD' => esc_html__( 'New Zealand Dollar (&#36;)', 'service-finder' ),
    'PEN' => esc_html__( 'Peru (Sol)', 'service-finder' ),
	'PYG' => esc_html__( 'Paraguayan Guaran&&iuml; (&#8370;)', 'service-finder' ),
    'PHP' => esc_html__( 'Philippine Pesos (&#8369;)', 'service-finder' ),
    'PLN' => esc_html__( 'Polish Zloty (&#122;&#322;)', 'service-finder' ),
    'GBP' => esc_html__( 'Pounds Sterling (&pound;)', 'service-finder' ),
    'RON' => esc_html__( 'Romanian Leu (lei)', 'service-finder' ),
    'RUB' => esc_html__( 'Russian Ruble (&#1088;&#1091;&#1073;.)', 'service-finder' ),
    'SGD' => esc_html__( 'Singapore Dollar (&#36;)', 'service-finder' ),
	'LKR' => esc_html__( 'Sri Lankan Rupee (Rs)', 'service-finder' ),
    'ZAR' => esc_html__( 'South African rand (&#82;)', 'service-finder' ),
    'SEK' => esc_html__( 'Swedish Krona (&#107;&#114;)', 'service-finder' ),
    'CHF' => esc_html__( 'Swiss Franc (&#67;&#72;&#70;)', 'service-finder' ),
    'TWD' => esc_html__( 'Taiwan New Dollars (&#78;&#84;&#36;)', 'service-finder' ),
    'THB' => esc_html__( 'Thai Baht (&#3647;)', 'service-finder' ),
    'TRY' => esc_html__( 'Turkish Lira (&#8378;)', 'service-finder' ),
    'USD' => esc_html__( 'US Dollars (&#36;)', 'service-finder' ),
    'VND' => esc_html__( 'Vietnamese Dong (&#8363;)', 'service-finder' ),
    'EGP' => esc_html__( 'Egyptian Pound (EGP)', 'service-finder' ),
	'XOF' => esc_html__( 'West African Franc (FCFA)', 'service-finder' ),
	'SAR' => esc_html__( 'Saudi Riyal', 'service-finder' ),
	'KSH' => esc_html__( 'Kenyan Shilling', 'service-finder' ),
    ),
    'default'  => 'USD'
    ),
    array(
    'id'       => 'payment-type',
    'type'     => 'radio',
    'title'    => esc_html__( 'Payment Type ', 'service-finder' ),
    'options'  => array(
    'single' => 'Single payments',	
    'recurring' => 'Recurring payments (Subscriptions)',
    ),
    'default'  => 'single'
    ),
    array(
    'id'       => 'wire-transfer-settings',
    'type'     => 'section',
    'title'    => esc_html__( 'Wire Transfer Settings', 'service-finder' ),
    'indent'   => false,
    ),
	array(
    'id'      => 'wire-transfer-description',
    'type'    => 'editor',
    'title'   => esc_html__( 'Description for Wire Transfer', 'service-finder' ),
    'desc' => "",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'      => 'wire-transfer-mail-instructions',
    'type'    => 'editor',
    'title'   => esc_html__( 'Instructions for Wire Transfer', 'service-finder' ),
    'desc' => sprintf( esc_html__('This instruction will be send in mail template to %s', 'service-finder'), $customerreplacestring ),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'paypal-settings',
    'type'     => 'section',
    'title'    => esc_html__( 'Paypal Settings', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-paypal',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Enable paypal', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'paypal-type',
    'type'     => 'radio',
    'title'    => esc_html__( 'PayPal API Enviroment', 'service-finder' ),
    'options'  => array(
    'sandbox' => esc_html__( 'Use sandbox (virtual) enviroment to testing paypal functionality', 'service-finder' ),
    'live' 	  => esc_html__( 'Use live (real) enviroment ', 'service-finder' ),
    ),
    'default'  => 'sandbox'
    ),
    array(
    'id'       => 'paypal-username',
    'type'     => 'text',
    'title'    => esc_html__( 'PayPal API Username', 'service-finder' ),
    ),
    array(
    'id'       => 'paypal-password',
    'type'     => 'text',
    'title'    => esc_html__( 'PayPal API Password', 'service-finder' ),
    ),
    array(
    'id'       => 'paypal-signatue',
    'type'     => 'text',
    'title'    => esc_html__( 'PayPal API Signatue', 'service-finder' ),
    ),
	array(
    'id'       => 'paypal-app-id',
    'type'     => 'text',
    'title'    => esc_html__( 'PayPal App ID', 'service-finder' ),
	'desc' 	   => esc_html__( 'It will use for paypal adaptive payment option', 'service-finder' ),
    ),
    array(
    'id'       => 'paypal-payment-name',
    'type'     => 'text',
    'title'    => esc_html__( 'PayPal Payment Name', 'service-finder' ),
    ),
    array(
    'id'       => 'stripe-settings',
    'type'     => 'section',
    'title'    => esc_html__( 'Stripe Settings', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-stripe',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Enable Stripe', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'stripe-type',
    'type'     => 'radio',
    'title'    => esc_html__( 'Stripe Mode', 'service-finder' ),
    'options'  => array(
    'test' => 'Test Mode',	
    'live' => 'Live Mode',
    ),
    'default'  => 'test'
    ),
    array(
    'id'       => 'stripe-test-secret-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Test Secret Key', 'service-finder' ),
    ),
    array(
    'id'       => 'stripe-test-public-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Test Public Key', 'service-finder' ),
    ),
    array(
    'id'       => 'stripe-live-secret-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Live Secret Key', 'service-finder' ),
    ),
    array(
    'id'       => 'stripe-live-public-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Live Public Key', 'service-finder' ),
    ),
    array(
    'id'       => 'stripe-payment-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Stripe Payment Name', 'service-finder' ),
    ),
	array(
    'id'       => 'payu-money-settings',
    'type'     => 'section',
    'title'    => esc_html__( 'PayU Money Settings', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-payu-money',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Enable PayU Money', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'payumoney-type',
    'type'     => 'radio',
    'title'    => esc_html__( 'PayU Money Mode', 'service-finder' ),
    'options'  => array(
    'test' => 'Test Mode',	
    'live' => 'Live Mode',
    ),
    'default'  => 'test'
    ),
    array(
    'id'       => 'payumoney-mid-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Money MID', 'service-finder' ),
    ),
    array(
    'id'       => 'payumoney-key-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Money Key', 'service-finder' ),
    ),
    array(
    'id'       => 'payumoney-salt-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Money Salt', 'service-finder' ),
    ),
	array(
    'id'       => 'payumoney-mid-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Money MID', 'service-finder' ),
    ),
    array(
    'id'       => 'payumoney-key-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Money Key', 'service-finder' ),
    ),
    array(
    'id'       => 'payumoney-salt-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Money Salt', 'service-finder' ),
    ),
	array(
    'id'       => 'payumoney-payment-name',
    'type'     => 'text',
    'title'    => esc_html__( 'PayU Money Payment Name', 'service-finder' ),
    ),
	array(
    'id'       => 'payu-latam-settings',
    'type'     => 'section',
    'title'    => esc_html__( 'PayU Latam Settings', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-payu-latam',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Enable PayU Latam', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'payulatam-type',
    'type'     => 'radio',
    'title'    => esc_html__( 'PayU Latam Mode', 'service-finder' ),
    'options'  => array(
    'test' => 'Test Mode',	
    'live' => 'Live Mode',
    ),
    'default'  => 'test'
    ),
    array(
    'id'       => 'payulatam-merchantid-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Latam Merchant Id', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-apilogin-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Latam API Login', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-apikey-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Latam API Key', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-accountid-test',
    'type'     => 'text',
    'title'    => esc_html__( 'Test PayU Latam Account Id', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-merchantid-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live  PayU Latam Merchant Id', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-apilogin-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Latam API Login', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-apikey-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Latam API Key', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-accountid-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Latam Account Id', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-apilogin-live',
    'type'     => 'text',
    'title'    => esc_html__( 'Live PayU Latam 	API Login', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-payment-name',
    'type'     => 'text',
    'title'    => esc_html__( 'PayU Latam Payment Name', 'service-finder' ),
    ),
	array(
    'id'       => 'payulatam-country',
    'type'     => 'select',
    'title'    => esc_html__( 'Country', 'service-finder' ),
    'options'  => array(
    'AR' => 'Argentina',
    'BR' => 'Brazil',
	'CO' => 'Colombia',
    'MX' => 'Mexico',
    'PA' => 'Panama',
	'PE' => 'Peru',
    ),
    'default'  => 'AR'
    ),
	/*array(
    'id'       => 'twocheckout-settings',
    'type'     => 'section',
    'title'    => esc_html__( '2Checkout Settings', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'twocheckout-type',
    'type'     => 'radio',
    'title'    => esc_html__( '2Checkout Mode', 'service-finder' ),
    'options'  => array(
    'test' => 'Test Mode',	
    'live' => 'Live Mode',
    ),
    'default'  => 'test'
    ),
	array(
    'id'       => 'twocheckout-api-username',
    'type'     => 'text',
    'title'    => esc_html__( 'API Username', 'service-finder' ),
    ),
	array(
    'id'       => 'twocheckout-api-password',
    'type'     => 'text',
    'title'    => esc_html__( 'API Password', 'service-finder' ),
    ),
	array(
    'id'       => 'twocheckout-test-account-id',
    'type'     => 'text',
    'title'    => esc_html__( 'Test Account ID', 'service-finder' ),
    ),
    array(
    'id'       => 'twocheckout-test-publish-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Test Publish Key', 'service-finder' ),
    ),
    array(
    'id'       => 'twocheckout-test-private-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Test Private Key', 'service-finder' ),
    ),
	array(
    'id'       => 'twocheckout-live-account-id',
    'type'     => 'text',
    'title'    => esc_html__( 'Live Account ID', 'service-finder' ),
    ),
    array(
    'id'       => 'twocheckout-live-publish-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Live Publish Key', 'service-finder' ),
    ),
    array(
    'id'       => 'twocheckout-live-private-key',
    'type'     => 'text',
    'title'    => esc_html__( 'Live Private Key', 'service-finder' ),
    ),*/
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Packages', 'service-finder' ),
    'id'               => 'payment-packages',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'enable-package0',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Trial Package', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'package0-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Package Name', 'service-finder' ),
    ),
	array(
    'id'       => 'package0-expday',
    'type'     => 'text',
    'title'    => esc_html__( 'Account expiration limit in days', 'service-finder' ),
    'subtitle' => '',
    'default'  => '30'
    ),
	array(
    'id'       => 'package0-capabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Capabilities', 'service-finder' ),
    'options'  => array(
    'booking' => esc_html__( 'Booking', 'service-finder' ),
    'cover-image' => sprintf( esc_html__('Own Cover Image on %s Page', 'service-finder'), $providerreplacestring ),
    'gallery-images' => esc_html__( 'Gallery with more Images', 'service-finder' ),
	'multiple-categories' => esc_html__( 'Multiple Categories', 'service-finder' ),
	'apply-for-job' => esc_html__( 'Apply for Job', 'service-finder' ),
	'job-alerts' => esc_html__( 'Job Alerts', 'service-finder' ),
	'branches' => esc_html__( 'More Locations (Branches)', 'service-finder' ),
	'google-calendar' => esc_html__( 'Google Calendar', 'service-finder' ),
    ),
    'default'  => 'booking'
    ),
    array(
    'id'       => 'capabilities0-subsection',
    'type'     => 'section',
    'title'    => '',
    'indent'   => false,
    ),
    array(
    'id'       => 'package0-subcapabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Sub Capabilities', 'service-finder' ),
    'options'  => array(
    'invoice' => esc_html__('Invoice', 'service-finder' ),
    'availability' => esc_html__('Availability', 'service-finder' ),
    'staff-members' => esc_html__('Staff Members', 'service-finder' ),
    ),
    ),
	array(
    'id'       => 'enable-package1',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Active Packages 1', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'package1-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Package Name', 'service-finder' ),
    ),
    array(
    'id'       => 'package1-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price (0 for free)', 'service-finder' ),
    'default'  => '0'
    ),
    array(
    'id'       => 'package1-expday',
    'type'     => 'text',
    'title'    => esc_html__( 'Account expiration limit in days (0 for unlimited)', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for free and single payments', 'service-finder' ),
    'default'  => '0'
    ),
    array(
    'id'       => 'package1-billing-period',
    'type'     => 'select',
    'title'    => esc_html__( 'Billing Period', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for recurring payments', 'service-finder' ),
    'options'  => array(
    'Year' => 'Year',
    'Month' => 'Month',
    'Week' => 'Week',
    'Day' => 'Day',
    ),
    'default'  => 'Year'
    ),
    array(
    'id'       => 'package1-capabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Capabilities', 'service-finder' ),
    'options'  => array(
    'booking' => esc_html__( 'Booking', 'service-finder' ),
    'cover-image' => sprintf( esc_html__('Own Cover Image on %s Page', 'service-finder'), $providerreplacestring ),
    'gallery-images' => esc_html__( 'Gallery with more Images', 'service-finder' ),
	'multiple-categories' => esc_html__( 'Multiple Categories', 'service-finder' ),
	'apply-for-job' => esc_html__( 'Apply for Job', 'service-finder' ),
	'job-alerts' => esc_html__( 'Job Alerts', 'service-finder' ),
	'branches' => esc_html__( 'More Locations (Branches)', 'service-finder' ),
	'google-calendar' => esc_html__( 'Google Calendar', 'service-finder' ),
    ),
    'default'  => 'booking'
    ),
    
    array(
    'id'       => 'capabilities1-subsection',
    'type'     => 'section',
    'title'    => '',
    'indent'   => false,
    ),
    array(
    'id'       => 'package1-subcapabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Sub Capabilities', 'service-finder' ),
    'options'  => array(
    'invoice' => esc_html__('Invoice', 'service-finder' ),
    'availability' => esc_html__('Availability', 'service-finder' ),
    'staff-members' => esc_html__('Staff Members', 'service-finder' ),
    ),
    ),
    
    array(
    'id'       => 'package2',
    'type'     => 'section',
    'title'    => esc_html__( 'Package 2', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-package2',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Active Packages 2', 'service-finder' ),
    'default'  => '0'
    ),
    array(
    'id'       => 'package2-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Package Name', 'service-finder' ),
    ),
    array(
    'id'       => 'package2-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price (0 for free)', 'service-finder' ),
    ),
    array(
    'id'       => 'package2-expday',
    'type'     => 'text',
    'title'    => esc_html__( 'Account expiration limit in days (0 for unlimited)', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for free and single paypal/stripe payments', 'service-finder' ),
    ),
    array(
    'id'       => 'package2-billing-period',
    'type'     => 'select',
    'title'    => esc_html__( 'Billing Period', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for paypal/stripe recurring payments', 'service-finder' ),
    'options'  => array(
    'Year' => 'Year',
    'Month' => 'Month',
    'Week' => 'Week',
    'Day' => 'Day',
    ),
    'default'  => 'Year'
    ),
    array(
    'id'       => 'package2-capabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Capabilities', 'service-finder' ),
    'options'  => array(
    'booking' => esc_html__( 'Booking', 'service-finder' ),
    'cover-image' => sprintf( esc_html__('Own Cover Image on %s Page', 'service-finder'), $providerreplacestring ),
    'gallery-images' => esc_html__( 'Gallery with more Images', 'service-finder' ),
	'multiple-categories' => esc_html__( 'Multiple Categories', 'service-finder' ),
	'apply-for-job' => esc_html__( 'Apply for Job', 'service-finder' ),
	'job-alerts' => esc_html__( 'Job Alerts', 'service-finder' ),
	'branches' => esc_html__( 'More Locations (Branches)', 'service-finder' ),
	'google-calendar' => esc_html__( 'Google Calendar', 'service-finder' ),
    ),
    'default'  => 'booking'
    ),
    
    array(
    'id'       => 'capabilities2-subsection',
    'type'     => 'section',
    'title'    => '',
    'indent'   => false,
    ),
    array(
    'id'       => 'package2-subcapabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Sub Capabilities', 'service-finder' ),
    'options'  => array(
    'invoice' => 'Invoice',
    'availability' => 'Availability',
    'staff-members' => 'Staff Members',
    ),
    ),
    
    array(
    'id'       => 'package3',
    'type'     => 'section',
    'title'    => esc_html__( 'Package 3', 'service-finder' ),
    'indent'   => false,
    ),
    array(
    'id'       => 'enable-package3',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Active Packages 3', 'service-finder' ),
    'default'  => '0'
    ),
    array(
    'id'       => 'package3-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Package Name', 'service-finder' ),
    ),
    array(
    'id'       => 'package3-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price (0 for free)', 'service-finder' ),
    ),
    array(
    'id'       => 'package3-expday',
    'type'     => 'text',
    'title'    => esc_html__( 'Account expiration limit in days (0 for unlimited)', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for free and single paypal/stripe payments', 'service-finder' ),
    ),
    array(
    'id'       => 'package3-billing-period',
    'type'     => 'select',
    'title'    => esc_html__( 'Billing Period', 'service-finder' ),
    'subtitle' => esc_html__( 'Used for paypal/stripe recurring payments', 'service-finder' ),
    'options'  => array(
    'Year' => 'Year',
    'Month' => 'Month',
    'Week' => 'Week',
    'Day' => 'Day',
    ),
    'default'  => 'Year'
    ),
    array(
    'id'       => 'package3-capabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Capabilities', 'service-finder' ),
    'options'  => array(
    'booking' => esc_html__( 'Booking', 'service-finder' ),
    'cover-image' => sprintf( esc_html__('Own Cover Image on %s Page', 'service-finder'), $providerreplacestring ),
    'gallery-images' => esc_html__( 'Gallery with more Images', 'service-finder' ),
	'multiple-categories' => esc_html__( 'Multiple Categories', 'service-finder' ),
	'apply-for-job' => esc_html__( 'Apply for Job', 'service-finder' ),
	'job-alerts' => esc_html__( 'Job Alerts', 'service-finder' ),
	'branches' => esc_html__( 'More Locations (Branches)', 'service-finder' ),
	'google-calendar' => esc_html__( 'Google Calendar', 'service-finder' ),
    ),
    'default'  => 'booking'
    ),
    
    array(
    'id'       => 'capabilities3-subsection',
    'type'     => 'section',
    'title'    => '',
    'indent'   => false,
    ),
    array(
    'id'       => 'package3-subcapabilities',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'Package Sub Capabilities', 'service-finder' ),
    'options'  => array(
    'invoice' => 'Invoice',
    'availability' => 'Availability',
    'staff-members' => 'Staff Members',
    ),
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Account Moderation', 'service-finder' ),
    'id'               => 'account-moderation-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'account-moderation',
    'type'     => 'switch',
    'title'    => esc_html__( 'Account Moderation', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Commission System', 'service-finder' ),
    'id'               => 'commission-system-settings',
	'customizer'       => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'charge-admin-fee',
    'type'     => 'switch',
    'title'    => esc_html__( 'Charge Admin Fee', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'admin-fee-type',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Admin Fee Type', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'fixed' => 'Fixed',
    'percentage' => 'In Percentage',
    ),
    'default'  => ''
    ),
	array(
    'id'            => 'admin-fee-percentage',
    'type'          => 'slider',
    'title'    => esc_html__( 'Admin Fee (In Pecentage)', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Enter admin fee on each booking', 'service-finder' ),
    'default'       => 0,
    'min'           => 0,
    'step'          => 1,
    'max'           => 100,
    'display_value' => 'text'
    ),
	array(
    'id'       => 'admin-fee-fixed',
    'type'     => 'text',
    'title'    => esc_html__( 'Admin Fee (Fixed Amount)', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'charge-admin-fee-from',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Charge Admin Fee From', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'provider' => esc_html($providerreplacestring),
    'customer' => esc_html( $customerreplacestring ),
    ),
    'default'  => ''
    ),
	array(
    'id'       => 'admin-fee-label',
    'type'     => 'text',
    'title'    => esc_html__( 'Label for Admin Fee', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    )
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'Settings', 'service-finder' ),
    'id'               => 'provider-settings',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-cog'
    ) );
	
    Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'Page Setting', 'service-finder' ),
    'id'               => 'booking-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'default-avatar',
    'type'     => 'media',
    'url'      => true,
    'title'    => esc_html__( 'Default Avatar Image', 'service-finder' ),
    'compiler' => 'true',
    'desc'     => '',
    'subtitle' => sprintf( esc_html__('Upload Default Avatar for %s', 'service-finder'), $providerreplacestring ),
    ),
	array(
    'id'       => 'booking-page-style',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Profile Page Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'style-1' => 'Style 1',
    'style-2' => 'Style 2',
    ),
    'default'  => 'style-1'
    ),
	array(
    'id'       => 'availability-based-on',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Availability Based On', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'timeslots' => 'Time Slots',
    'starttime' => 'Start Time',
	'both' => 'Both',
    ),
    'default'  => 'timeslots'
    ),
	array(
    'id'       => 'review-system',
    'type'     => 'switch',
    'title'    => esc_html__( 'Review System', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'display-basicfeature-after-sociallogin',
    'type'     => 'switch',
    'title'    => esc_html__( 'Display Basic Feature After Social Login', 'service-finder' ),
	'desc'     => esc_html__( 'If provider registered via social login then do you want him to display basic profile. If set OFF then only upgrade account section will be visible.', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'profile-search-bar',
    'type'     => 'switch',
    'title'    => esc_html__( 'Hide Search Bar', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'review-style',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Review & Rating to show on profile page', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'booking-review' => esc_html__( 'Booking Review', 'service-finder' ),
    'open-review' => esc_html__( 'Open Review', 'service-finder' ),
    ),
    'default'  => 'open-review'
    ),
	array(
    'id'       => 'providers-review',
    'type'     => 'switch',
    'title'    => esc_html__( 'Provider Can Leave Review', 'service-finder' ),
    'subtitle' => '',
	'required' => array( 'review-style', '=', 'open-review' ),
    'default'  => false,
    ),
	array(
    'id'       => 'request-quote',
    'type'     => 'switch',
    'title'    => esc_html__( 'Request a Quote', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'request-quote-after-login',
    'type'     => 'switch',
    'title'    => esc_html__( 'Request a Quote Form Show Only After Login', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'request-quote-mail-to',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Request a Quote Mail Send to', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    //Must provide key => value pairs for radio options
    'options'  => array(
    'provider' => esc_html__( 'Provider', 'service-finder' ),
    'admin' => esc_html__( 'Admin', 'service-finder' ),
	'both' => esc_html__( 'Both', 'service-finder' ),
	'hold' => esc_html__( 'Hold for Moderation', 'service-finder' ),
    ),
    'default'  => 'both'
    ),
	array(
    'id'       => 'paid-booking',
    'type'     => 'switch',
    'title'    => esc_html__( 'Paid Booking', 'service-finder' ),
	'desc'     => 'if this option is on then provider will have free or paid booking option and if off then provider will only have free booking option',
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'guest-booking',
    'type'     => 'switch',
    'title'    => esc_html__( 'Guest Booking', 'service-finder' ),
	'desc'     => sprintf( esc_html__('if this option is off then remove booking form for non registered %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'time-format',
    'type'     => 'switch',
    'title'    => esc_html__( 'Use 24-Hour Format for Time Slots', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'keep-author-word',
    'type'     => 'button_set',
    'title'    => sprintf( esc_html__( 'Want to Keep "author" Word on %s Profile Page', 'service-finder' ), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'yes' =>  esc_html__( 'Yes', 'service-finder' ),
    'no' =>  esc_html__( 'No', 'service-finder' ),
    ),
    'default'  => 'yes'
    ),
	array(
    'id'       => 'author-replace-string',
    'type'     => 'text',
    'title'    => sprintf( esc_html__( 'String that will replace "author" Word on %s Profile Page URL', 'service-finder' ), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => esc_html__('Leave blank for no changes', 'service-finder'),
    'default'  => '',
	'required' => array( 'keep-author-word', '=', 'yes' ),
    ),
    array(
    'id'       => 'redirect-option',
    'type'     => 'select',
    'title'    => esc_html__( 'Redirect after booking', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'booking-page' => 'Same Booking Page',
    'thankyou-page' => 'Thank You Page',
    ),
    'default'  => 'booking-page'
    ),
    array(
    'id'       => 'thankyou-page-url',
    'type'     => 'text',
    'title'    => esc_html__( 'Thank You Page URL', 'service-finder' ),
    'subtitle' => esc_html__( 'Enter page url for redirect after booking', 'service-finder' ),
    'desc'     => sprintf( esc_html__('Ex: %s', 'service-finder'), home_url('/thank-you/') ),
    'default'  => ''
    ),
	array(
    'id'       => 'provider-replace-string',
    'type'     => 'text',
    'title'    => esc_html__( 'String That will replace "Provider" word', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Enter a string that will replace with provider word in frontend.', 'service-finder' ),
    'default'  => ''
    ),
	array(
    'id'       => 'customer-replace-string',
    'type'     => 'text',
    'title'    => esc_html__( 'String That will replace "Customer" word', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Enter a string that will replace with customer word in frontend.', 'service-finder' ),
    'default'  => ''
    ),
	array(
    'id'       => 'requestquote-replace-string',
    'type'     => 'text',
    'title'    => esc_html__( 'String That will replace "Request a Quote" title', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Enter a string that will replace with "Request a Quote" title in frontend.', 'service-finder' ),
    'default'  => ''
    ),
	array(
    'id'       => 'show-booking-otp',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show OTP in Booking', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'show-address-info',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Address Info', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'only-registered-user',
    'type'     => 'switch',
    'title'    => esc_html__( 'Only Register User can View Address Info', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-postal-address',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Postal Address', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-gps',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show GPS Info (Latitude and Longitude)', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-contact-number',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Contact Numbers', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-email-address',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Email Address', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-fax',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Fax', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-website',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Website', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'show-contact-map',
    'type'     => 'switch',
    'title'    => esc_html__( 'Show Contact Map', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'show-address-info', '=', true ),
    ),
	array(
    'id'       => 'identity-check',
    'type'     => 'switch',
    'title'    => esc_html__( 'Identity Check Feature', 'service-finder' ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'basic-profile-after-trial-expire',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Display basic profile after trial package expire', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'yes' => 'Yes',
    'no' => 'No',
    ),
    'default'  => 'light'
    ),
	array(
    'id'       => 'msg-identity-approval-waiting',
    'type'     => 'text',
    'title'    => esc_html__( 'Message when identity is waiting for admin approval', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'This Message will show when identity is waiting for admin approval', 'service-finder' ),
    'default'  => ''
    ),
	array(
    'id'       => 'msg-identity-approved',
    'type'     => 'text',
    'title'    => esc_html__( 'Message when identity is approved', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'This Message will show when identity has been approved', 'service-finder' ),
    'default'  => ''
    ),
	array(
    'id'       => 'restrict-my-account',
    'type'     => 'switch',
    'title'    => esc_html__( 'Restrict My Account', 'service-finder' ),
	'desc'     => esc_html__('It only works when identity check feature is on', 'service-finder'),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'restrict-user-area',
    'type'     => 'switch',
    'title'    => esc_html__( 'Restrict User Area', 'service-finder' ),
	'desc'     => esc_html__('It only works when identity check feature is on', 'service-finder'),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'      => 'identity-check-description',
    'type'    => 'editor',
    'title'   => esc_html__( 'Description about Identity check documents', 'service-finder' ),
    'desc' => esc_html__('This will display when popup for identity check', 'service-finder'),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'         => 'style-1',
    'type'       => 'raw',
    'full_width' => false,
    'title'      => esc_html__( 'Style Preview', 'service-finder' ),
    'subtitle'   => '',
    'desc'       => '',
    'content'    => '<img src="'.get_template_directory_uri().'/inc/images/redux/provider-style.jpg">',
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'Menu', 'service-finder' ),
    'id'               => 'provider-menu',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'availability-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Availability', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'set-unavailability-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Set UnAvailability', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'business-hours-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Business Hours', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'postal-codes-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Postal Codes', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'our-branches-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Our Branches', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'regions-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Regions', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'my-services-menu',
    'type'     => 'switch',
    'title'    => esc_html__('My Services', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'my-jobs-menu',
    'type'     => 'switch',
    'title'    => esc_html__('My Jobs', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'job-apply-limits-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Job Apply Limits', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'team-members-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Team Members', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'bookings-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Bookings', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'schedule-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Schedule', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'invoice-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Invoice', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'upgrade-account-menu',
    'type'     => 'switch',
    'title'    => esc_html__('Upgrade Account', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'bank-account-info-section',
    'type'     => 'switch',
    'title'    => esc_html__('Bank Account Info Section', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
    )
    ) );
	
	$pages = $wpdb->get_results("select * from ".$wpdb->prefix."posts WHERE post_type = 'page' AND post_status = 'publish'");
	
    if(!empty($pages)){
		$pagearr['no'] = 'No Redirect';
		foreach($pages as $page){
		$pagearr[$page->ID] = $page->post_title;
		}
    }else{
   		$pagearr['no'] = 'No Redirect';
    }
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Captcha', 'service-finder' ),
    'id'               => 'captcha',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'captcha-style',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Captcha Style', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'style-1' => 'Style 1',
    'style-2' => 'Style 2',
    ),
    'default'  => 'style-1'
    ),
	array(
    'id'       => 'captcha-sitekey',
    'type'     => 'text',
    'title'    => esc_html__( 'reCAPTCHA Site Key', 'service-finder' ),
    'subtitle' => '',
    'desc'     => sprintf( esc_html__( 'You can get site key from %s', 'service-finder' ), '<a target="_blank" href="https://www.google.com/recaptcha/admin">here</a>' ),
	'required' => array( 'captcha-style', '=', 'style-2' ),
    'default'  => ''
    ),
	array(
    'id'       => 'captcha-theme',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Captcha Theme', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
	'required' => array( 'captcha-style', '=', 'style-2' ),
    'options'  => array(
    'light' => 'Light',
    'dark' => 'Dark',
    ),
    'default'  => 'light'
    ),
	array(
    'id'       => 'provider-signup-captcha',
    'type'     => 'switch',
    'title'    => sprintf( esc_html__('Captcha on %s Signup', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'customer-signup-captcha',
    'type'     => 'switch',
    'title'    => sprintf( esc_html__('Captcha on %s Signup', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'request-quote-captcha',
    'type'     => 'switch',
    'title'    => esc_html__( 'Captcha on Request a Quote', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'claim-business-captcha',
    'type'     => 'switch',
    'title'    => esc_html__( 'Captcha on Claim Business', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Claim Business', 'service-finder' ),
    'id'               => 'claim-business',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'string-claim-business',
    'type'     => 'text',
    'title'    => esc_html__('String that will use for Claim Business', 'service-finder'),
    'subtitle' => '',
    'default'  => esc_html__('Claim Business', 'service-finder'),
    ),
	array(
    'id'       => 'claim-business-option',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Claim Business', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'free' => 'Free',
    'paid' => 'Paid',
    ),
    'default'  => 'free'
    ),
	array(
    'id'       => 'claimed-redirect-option',
    'type'     => 'select',
    'title'    => sprintf( esc_html__('Redirect after Claimed Business', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $pagearr,
    'default'  => 'no'
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Sign Up Restriction', 'service-finder' ),
    'id'               => 'signup-restriction',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'all-countries',
    'type'     => 'checkbox',
    'title'    => esc_html__( 'All Countries', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'If checked this option following allowed countries option will not work', 'service-finder' ),
    'default'  => '1'
    ),
    array(
    'id'       => 'allowed-country',
    'type'     => 'select',
    'multi'    => true,
    'title'    => esc_html__( 'Allowed Countries', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    "AF" => esc_html__( 'Afghanistan', 'service-finder' ),
    "AX" => esc_html__( 'Aland Islands', 'service-finder' ),
    "AL" => esc_html__( 'Albania', 'service-finder' ),
    "DZ" => esc_html__( 'Algeria', 'service-finder' ),
    "AS" => esc_html__( 'American Samoa', 'service-finder' ),
    "AD" => esc_html__( 'Andorra', 'service-finder' ),
    "AO" => esc_html__( 'Angola', 'service-finder' ),
    "AI" => esc_html__( 'Anguilla', 'service-finder' ),
    "AQ" => esc_html__( 'Antarctica', 'service-finder' ),
    "AG" => esc_html__( 'Antigua and Barbuda', 'service-finder' ),
    "AR" => esc_html__( 'Argentina', 'service-finder' ),
    "AM" => esc_html__( 'Armenia', 'service-finder' ),
    "AW" => esc_html__( 'Aruba', 'service-finder' ),
    "AU" => esc_html__( 'Australia', 'service-finder' ),
    "AT" => esc_html__( 'Austria', 'service-finder' ),
    "AZ" => esc_html__( 'Azerbaijan', 'service-finder' ),
    "BS" => esc_html__( 'Bahamas', 'service-finder' ),
    "BH" => esc_html__( 'Bahrain', 'service-finder' ),
    "BD" => esc_html__( 'Bangladesh', 'service-finder' ),
    "BB" => esc_html__( 'Barbados', 'service-finder' ),
    "BY" => esc_html__( 'Belarus', 'service-finder' ),
    "BE" => esc_html__( 'Belgium', 'service-finder' ),
    "BZ" => esc_html__( 'Belize', 'service-finder' ),
    "BJ" => esc_html__( 'Benin', 'service-finder' ),
    "BM" => esc_html__( 'Bermuda', 'service-finder' ),
    "BT" => esc_html__( 'Bhutan', 'service-finder' ),
    "BO" => esc_html__( 'Bolivia', 'service-finder' ),
    "BA" => esc_html__( 'Bosnia and Herzegovina', 'service-finder' ),
    "BW" => esc_html__( 'Botswana', 'service-finder' ),
    "BV" => esc_html__( 'Bouvet Island', 'service-finder' ),
    "BR" => esc_html__( 'Brazil', 'service-finder' ),
    "IO" => esc_html__( 'British Indian Ocean Territory', 'service-finder' ),
    "BN" => esc_html__( 'Brunei Darussalam', 'service-finder' ),
    "BG" => esc_html__( 'Bulgaria', 'service-finder' ),
    "BF" => esc_html__( 'Burkina Faso', 'service-finder' ),
    "BI" => esc_html__( 'Burundi', 'service-finder' ),
    "KH" => esc_html__( 'Cambodia', 'service-finder' ),
    "CM" => esc_html__( 'Cameroon', 'service-finder' ),
    "CA" => esc_html__( 'Canada', 'service-finder' ),
    "CV" => esc_html__( 'Cape Verde', 'service-finder' ),
    "KY" => esc_html__( 'Cayman Islands', 'service-finder' ),
    "CF" => esc_html__( 'Central African Republic', 'service-finder' ),
    "TD" => esc_html__( 'Chad', 'service-finder' ),
    "CL" => esc_html__( 'Chile', 'service-finder' ),
    "CN" => esc_html__( 'China', 'service-finder' ),
    "CX" => esc_html__( 'Christmas Island', 'service-finder' ),
    "CC" => esc_html__( 'Cocos (Keeling) Islands', 'service-finder' ),
    "CO" => esc_html__( 'Colombia', 'service-finder' ),
    "KM" => esc_html__( 'Comoros', 'service-finder' ),
    "CG" => esc_html__( 'Congo', 'service-finder' ),
    "CD" => esc_html__( 'Congo, The Democratic Republic of The', 'service-finder' ),
    "CK" => esc_html__( 'Cook Islands', 'service-finder' ),
    "CR" => esc_html__( 'Costa Rica', 'service-finder' ),
    "CI" => esc_html__( 'Cote D\'ivoire', 'service-finder' ),
    "HR" => esc_html__( 'Croatia', 'service-finder' ),
    "CU" => esc_html__( 'Cuba', 'service-finder' ),
    "CY" => esc_html__( 'Cyprus', 'service-finder' ),
    "CZ" => esc_html__( 'Czech Republic', 'service-finder' ),
    "DK" => esc_html__( 'Denmark', 'service-finder' ),
    "DJ" => esc_html__( 'Djibouti', 'service-finder' ),
    "DM" => esc_html__( 'Dominica', 'service-finder' ),
    "DO" => esc_html__( 'Dominican Republic', 'service-finder' ),
    "EC" => esc_html__( 'Ecuador', 'service-finder' ),
    "EG" => esc_html__( 'Egypt', 'service-finder' ),
    "SV" => esc_html__( 'El Salvador', 'service-finder' ),
    "GQ" => esc_html__( 'Equatorial Guinea', 'service-finder' ),
    "ER" => esc_html__( 'Eritrea', 'service-finder' ),
    "EE" => esc_html__( 'Estonia', 'service-finder' ),
    "ET" => esc_html__( 'Ethiopia', 'service-finder' ),
    "FK" => esc_html__( 'Falkland Islands (Malvinas)', 'service-finder' ),
    "FO" => esc_html__( 'Faroe Islands', 'service-finder' ),
    "FJ" => esc_html__( 'Fiji', 'service-finder' ),
    "FI" => esc_html__( 'Finland', 'service-finder' ),
    "FR" => esc_html__( 'France', 'service-finder' ),
    "GF" => esc_html__( 'French Guiana', 'service-finder' ),
    "PF" => esc_html__( 'French Polynesia', 'service-finder' ),
    "TF" => esc_html__( 'French Southern Territories', 'service-finder' ),
    "GA" => esc_html__( 'Gabon', 'service-finder' ),
    "GM" => esc_html__( 'Gambia', 'service-finder' ),
    "GE" => esc_html__( 'Georgia', 'service-finder' ),
    "DE" => esc_html__( 'Germany', 'service-finder' ),
    "GH" => esc_html__( 'Ghana', 'service-finder' ),
    "GI" => esc_html__( 'Gibraltar', 'service-finder' ),
    "GR" => esc_html__( 'Greece', 'service-finder' ),
    "GL" => esc_html__( 'Greenland', 'service-finder' ),
    "GD" => esc_html__( 'Grenada', 'service-finder' ),
    "GP" => esc_html__( 'Guadeloupe', 'service-finder' ),
    "GU" => esc_html__( 'Guam', 'service-finder' ),
    "GT" => esc_html__( 'Guatemala', 'service-finder' ),
    "GG" => esc_html__( 'Guernsey', 'service-finder' ),
    "GN" => esc_html__( 'Guinea', 'service-finder' ),
    "GW" => esc_html__( 'Guinea-bissau', 'service-finder' ),
    "GY" => esc_html__( 'Guyana', 'service-finder' ),
    "HT" => esc_html__( 'Haiti', 'service-finder' ),
    "HM" => esc_html__( 'Heard Island and Mcdonald Islands', 'service-finder' ),
    "VA" => esc_html__( 'Holy See (Vatican City State)', 'service-finder' ),
    "HN" => esc_html__( 'Honduras', 'service-finder' ),
    "HK" => esc_html__( 'Hong Kong', 'service-finder' ),
    "HU" => esc_html__( 'Hungary', 'service-finder' ),
    "IS" => esc_html__( 'Iceland', 'service-finder' ),
    "IN" => esc_html__( 'India', 'service-finder' ),
    "ID" => esc_html__( 'Indonesia', 'service-finder' ),
    "IR" => esc_html__( 'Iran', 'service-finder' ),
    "IQ" => esc_html__( 'Iraq', 'service-finder' ),
    "IE" => esc_html__( 'Ireland', 'service-finder' ),
    "IM" => esc_html__( 'Isle of Man', 'service-finder' ),
    "IL" => esc_html__( 'Israel', 'service-finder' ),
    "IT" => esc_html__( 'Italy', 'service-finder' ),
    "JM" => esc_html__( 'Jamaica', 'service-finder' ),
    "JP" => esc_html__( 'Japan', 'service-finder' ),
    "JE" => esc_html__( 'Jersey', 'service-finder' ),
    "JO" => esc_html__( 'Jordan', 'service-finder' ),
    "KZ" => esc_html__( 'Kazakhstan', 'service-finder' ),
    "KE" => esc_html__( 'Kenya', 'service-finder' ),
    "KI" => esc_html__( 'Kiribati', 'service-finder' ),
    "KP" => esc_html__( 'Korea, Democratic People\'s Republic of', 'service-finder' ),
    "KR" => esc_html__( 'Korea, Republic of', 'service-finder' ),
    "KW" => esc_html__( 'Kuwait', 'service-finder' ),
    "KG" => esc_html__( 'Kyrgyzstan', 'service-finder' ),
    "LA" => esc_html__( 'Lao People\'s Democratic Republic', 'service-finder' ),
    "LV" => esc_html__( 'Latvia', 'service-finder' ),
    "LB" => esc_html__( 'Lebanon', 'service-finder' ),
    "LS" => esc_html__( 'Lesotho', 'service-finder' ),
    "LR" => esc_html__( 'Liberia', 'service-finder' ),
    "LY" => esc_html__( 'Libyan Arab Jamahiriya', 'service-finder' ),
    "LI" => esc_html__( 'Liechtenstein', 'service-finder' ),
    "LT" => esc_html__( 'Lithuania', 'service-finder' ),
    "LU" => esc_html__( 'Luxembourg', 'service-finder' ),
    "MO" => esc_html__( 'Macao', 'service-finder' ),
    "MK" => esc_html__( 'Macedonia, The Former Yugoslav Republic of', 'service-finder' ),
    "MG" => esc_html__( 'Madagascar', 'service-finder' ),
    "MW" => esc_html__( 'Malawi', 'service-finder' ),
    "MY" => esc_html__( 'Malaysia', 'service-finder' ),
    "MV" => esc_html__( 'Maldives', 'service-finder' ),
    "ML" => esc_html__( 'Mali', 'service-finder' ),
    "MT" => esc_html__( 'Malta', 'service-finder' ),
    "MH" => esc_html__( 'Marshall Islands', 'service-finder' ),
    "MQ" => esc_html__( 'Martinique', 'service-finder' ),
    "MR" => esc_html__( 'Mauritania', 'service-finder' ),
    "MU" => esc_html__( 'Mauritius', 'service-finder' ),
    "YT" => esc_html__( 'Mayotte', 'service-finder' ),
    "MX" => esc_html__( 'Mexico', 'service-finder' ),
    "FM" => esc_html__( 'Micronesia, Federated States of', 'service-finder' ),
    "MD" => esc_html__( 'Moldova, Republic of', 'service-finder' ),
    "MC" => esc_html__( 'Monaco', 'service-finder' ),
    "MN" => esc_html__( 'Mongolia', 'service-finder' ),
    "ME" => esc_html__( 'Montenegro', 'service-finder' ),
    "MS" => esc_html__( 'Montserrat', 'service-finder' ),
    "MA" => esc_html__( 'Morocco', 'service-finder' ),
    "MZ" => esc_html__( 'Mozambique', 'service-finder' ),
    "MM" => esc_html__( 'Myanmar', 'service-finder' ),
    "NA" => esc_html__( 'Namibia', 'service-finder' ),
    "NR" => esc_html__( 'Nauru', 'service-finder' ),
    "NP" => esc_html__( 'Nepal', 'service-finder' ),
    "NL" => esc_html__( 'Netherlands', 'service-finder' ),
    "AN" => esc_html__( 'Netherlands Antilles', 'service-finder' ),
    "NC" => esc_html__( 'New Caledonia', 'service-finder' ),
    "NZ" => esc_html__( 'New Zealand', 'service-finder' ),
    "NI" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NE" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NG" => esc_html__( 'Nigeria', 'service-finder' ),
    "NU" => esc_html__( 'Niue', 'service-finder' ),
    "NF" => esc_html__( 'Norfolk Island', 'service-finder' ),
    "MP" => esc_html__( 'Northern Mariana Islands', 'service-finder' ),
    "NO" => esc_html__( 'Norway', 'service-finder' ),
    "OM" => esc_html__( 'Oman', 'service-finder' ),
    "PK" => esc_html__( 'Pakistan', 'service-finder' ),
    "PW" => esc_html__( 'Palau', 'service-finder' ),
    "PS" => esc_html__( 'Palestinian Territory, Occupied', 'service-finder' ),
    "PA" => esc_html__( 'Panama', 'service-finder' ),
    "PG" => esc_html__( 'Papua New Guinea', 'service-finder' ),
    "PY" => esc_html__( 'Paraguay', 'service-finder' ),
    "PE" => esc_html__( 'Peru', 'service-finder' ),
    "PH" => esc_html__( 'Philippines', 'service-finder' ),
    "PN" => esc_html__( 'Pitcairn', 'service-finder' ),
    "PL" => esc_html__( 'Poland', 'service-finder' ),
    "PT" => esc_html__( 'Portugal', 'service-finder' ),
    "PR" => esc_html__( 'Puerto Rico', 'service-finder' ),
    "QA" => esc_html__( 'Qatar', 'service-finder' ),
    "RE" => esc_html__( 'Reunion', 'service-finder' ),
    "RO" => esc_html__( 'Romania', 'service-finder' ),
    "RU" => esc_html__( 'Russian Federation', 'service-finder' ),
    "RW" => esc_html__( 'Rwanda', 'service-finder' ),
    "SH" => esc_html__( 'Saint Helena', 'service-finder' ),
    "KN" => esc_html__( 'Saint Kitts and Nevis', 'service-finder' ),
    "LC" => esc_html__( 'Saint Lucia', 'service-finder' ),
    "PM" => esc_html__( 'Saint Pierre and Miquelon', 'service-finder' ),
    "VC" => esc_html__( 'Saint Vincent and The Grenadines', 'service-finder' ),
    "WS" => esc_html__( 'Samoa', 'service-finder' ),
    "SM" => esc_html__( 'San Marino', 'service-finder' ),
    "ST" => esc_html__( 'Sao Tome and Principe', 'service-finder' ),
    "SA" => esc_html__( 'Saudi Arabia', 'service-finder' ),
    "SN" => esc_html__( 'Senegal', 'service-finder' ),
    "RS" => esc_html__( 'Serbia', 'service-finder' ),
    "SC" => esc_html__( 'Seychelles', 'service-finder' ),
    "SL" => esc_html__( 'Sierra Leone', 'service-finder' ),
    "SG" => esc_html__( 'Singapore', 'service-finder' ),
    "SK" => esc_html__( 'Slovakia', 'service-finder' ),
    "SI" => esc_html__( 'Slovenia', 'service-finder' ),
    "SB" => esc_html__( 'Solomon Islands', 'service-finder' ),
    "SO" => esc_html__( 'Somalia', 'service-finder' ),
    "ZA" => esc_html__( 'South Africa', 'service-finder' ),
    "GS" => esc_html__( 'South Georgia and The South Sandwich Islands', 'service-finder' ),
    "ES" => esc_html__( 'Spain', 'service-finder' ),
    "LK" => esc_html__( 'Sri Lanka', 'service-finder' ),
    "SD" => esc_html__( 'Sudan', 'service-finder' ),
    "SR" => esc_html__( 'Suriname', 'service-finder' ),
    "SJ" => esc_html__( 'Svalbard and Jan Mayen', 'service-finder' ),
    "SZ" => esc_html__( 'Swaziland', 'service-finder' ),
    "SE" => esc_html__( 'Sweden', 'service-finder' ),
    "CH" => esc_html__( 'Switzerland', 'service-finder' ),
    "SY" => esc_html__( 'Syrian Arab Republic', 'service-finder' ),
    "TW" => esc_html__( 'Taiwan, Province of China', 'service-finder' ),
    "TJ" => esc_html__( 'Tajikistan', 'service-finder' ),
    "TZ" => esc_html__( 'Tanzania, United Republic of', 'service-finder' ),
    "TH" => esc_html__( 'Thailand', 'service-finder' ),
    "TL" => esc_html__( 'Timor-leste', 'service-finder' ),
    "TG" => esc_html__( 'Togo', 'service-finder' ),
    "TK" => esc_html__( 'Tokelau', 'service-finder' ),
    "TO" => esc_html__( 'Tonga', 'service-finder' ),
    "TT" => esc_html__( 'Trinidad and Tobago', 'service-finder' ),
    "TN" => esc_html__( 'Tunisia', 'service-finder' ),
    "TR" => esc_html__( 'Turkey', 'service-finder' ),
    "TM" => esc_html__( 'Turkmenistan', 'service-finder' ),
    "TC" => esc_html__( 'Turks and Caicos Islands', 'service-finder' ),
    "TV" => esc_html__( 'Tuvalu', 'service-finder' ),
    "UG" => esc_html__( 'Uganda', 'service-finder' ),
    "UA" => esc_html__( 'Ukraine', 'service-finder' ),
    "AE" => esc_html__( 'United Arab Emirates', 'service-finder' ),
    "GB" => esc_html__( 'United Kingdom', 'service-finder' ),
    "US" => esc_html__( 'United States', 'service-finder' ),
    "UM" => esc_html__( 'United States Minor Outlying Islands', 'service-finder' ),
    "UY" => esc_html__( 'Uruguay', 'service-finder' ),
    "UZ" => esc_html__( 'Uzbekistan', 'service-finder' ),
    "VU" => esc_html__( 'Vanuatu', 'service-finder' ),
    "VE" => esc_html__( 'Venezuela', 'service-finder' ),
    "VN" => esc_html__( 'Viet Nam', 'service-finder' ),
    "VG" => esc_html__( 'Virgin Islands, British', 'service-finder' ),
    "VI" => esc_html__( 'Virgin Islands, U.S.', 'service-finder' ),
    "WF" => esc_html__( 'Wallis and Futuna', 'service-finder' ),
    "EH" => esc_html__( 'Western Sahara', 'service-finder' ),
    "YE" => esc_html__( 'Yemen', 'service-finder' ),
    "ZM" => esc_html__( 'Zambia', 'service-finder' ),
    "ZW" => esc_html__( 'Zimbabwe', 'service-finder' )
	),
    'default'  => 'US'
    ),
	array(
    'id'       => 'signup-auto-suggestion',
    'type'     => 'switch',
    'title'    => esc_html__('Google Auto Suggestion for Signup Address', 'service-finder'),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'show-signup-otp',
    'type'     => 'switch',
    'title'    => sprintf( esc_html__( 'Show OTP in %s Signup', 'service-finder' ), $providerreplacestring ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'signup-redirect-option',
    'type'     => 'select',
    'title'    => sprintf( esc_html__('Redirect after %s Signup', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $pagearr,
    'default'  => 'no'
    ),
	array(
    'id'       => 'signup-redirect-customer-option',
    'type'     => 'select',
    'title'    => esc_html__( 'Redirect after customer Signup', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => $pagearr,
    'default'  => 'no'
    ),
	array(
    'id'       => 'terms-condition-checkbox-providers',
    'type'     => 'switch',
    'title'    => sprintf( esc_html__('Terms and Condition Checkbox on Signup Form for %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'text-terms-condition-checkbox-providers',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Text for Terms and Condition Checkbox for %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => 'It only works when terms and condition is on.',
    'default'  => ''
    ),
	array(
    'id'       => 'terms-condition-checkbox-customers',
    'type'     => 'switch',
    'title'    => sprintf( esc_html__('Terms and Condition Checkbox on Signup Form for %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'text-terms-condition-checkbox-customers',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Text for Terms and Condition Checkbox for %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => 'It only works when terms and condition is on.',
    'default'  => ''
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Gallery Settings', 'service-finder' ),
    'id'               => 'gallery-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'            => 'default-gallery-images',
    'type'          => 'slider',
    'title'         => esc_html__( 'Gallery Images for Default', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of Gallery Images for default version', 'service-finder' ),
    'desc'          => '',
    'default'       => 5,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package0-gallery-images',
    'type'          => 'slider',
    'title'         => esc_html__( 'Gallery Images for Trial Package', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of Gallery Images for Trial Package', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'package1-gallery-images',
    'type'          => 'slider',
    'title'         => esc_html__( 'Gallery Images for Package 1', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of Gallery Images for Package 1', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package2-gallery-images',
    'type'          => 'slider',
    'title'         => esc_html__( 'Gallery Images for Package 2', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of Gallery Images for Package 2', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package3-gallery-images',
    'type'          => 'slider',
    'title'         => esc_html__( 'Gallery Images for Package 3', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of Gallery Images for Package 3', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Multiple Category Settings', 'service-finder' ),
    'id'               => 'multiple-category-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'            => 'package1-multiple-categories',
    'type'          => 'slider',
    'title'         => esc_html__( 'Multiple Categories for Package 1', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of categories for Package 1', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package2-multiple-categories',
    'type'          => 'slider',
    'title'         => esc_html__( 'Multiple Categories for Package 2', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of categories for Package 2', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package3-multiple-categories',
    'type'          => 'slider',
    'title'         => esc_html__( 'Multiple Categories for Package 3', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of categories for Package 3', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Job Application Settings', 'service-finder' ),
    'id'               => 'job-application-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'job-apply-limit-period',
    'type'     => 'button_set',
    'title'    => esc_html__( 'Job Apply Period', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'options'  => array(
    'weekly' => 'Weekly',
    'monthly' => 'Monthly',
    ),
    'default'  => 'monthly'
    ),
	array(
    'id'            => 'job-apply-number-of-week-month',
    'type'          => 'slider',
    'title'         => esc_html__( 'Job Apply Limit For', 'service-finder' ),
    'subtitle'      => esc_html__( 'Number of week/month for job apply limit', 'service-finder' ),
    'desc'          => '',
    'default'       => 1,
    'min'           => 1,
    'step'          => 1,
    'max'           => 48,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'package0-job-apply',
    'type'          => 'slider',
    'title'         => esc_html__( 'Apply for Job for Trial Package', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of job apply for Trial Package', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
	array(
    'id'            => 'package1-job-apply',
    'type'          => 'slider',
    'title'         => esc_html__( 'Apply for Job for Package 1', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of job apply for Package 1', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package2-job-apply',
    'type'          => 'slider',
    'title'         => esc_html__( 'Apply for Job for Package 2', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of job apply for Package 2', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    array(
    'id'            => 'package3-job-apply',
    'type'          => 'slider',
    'title'         => esc_html__( 'Apply for Job for Package 3', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set number of job apply for Package 3', 'service-finder' ),
    'desc'          => '',
    'default'       => 10,
    'min'           => 1,
    'step'          => 1,
    'max'           => 500,
    'display_value' => 'text'
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Job Apply Limit Plans', 'service-finder' ),
    'id'               => 'job-limit-plans',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'increase-limit-plans',
    'type'     => 'switch',
    'title'    => esc_html__( 'Increase Job Apply Limit Plans', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => false,
    ),
	array(
    'id'       => 'append-limit',
    'type'     => 'switch',
    'title'    => esc_html__( 'Add Remaining Limits to Next Month/Week', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => false,
	'required' => array( 'increase-limit-plans', '=', true ),
    ),
	array(
    'id'       => 'plan1',
    'type'     => 'switch',
    'title'    => esc_html__( 'Plan 1', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'increase-limit-plans', '=', true ),
    ),
    array(
    'id'       => 'plan1-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Name', 'service-finder' ),
	'required' => array( 'plan1', '=', true ),
    ),
    array(
    'id'       => 'plan1-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price', 'service-finder' ),
    'default'  => '0',
	'required' => array( 'plan1', '=', true ),
    ),
    array(
    'id'            => 'plan1-limit',
    'type'          => 'slider',
    'title'         => esc_html__( 'Limit', 'service-finder' ),
    'desc'          => '',
    'default'       => 1,
    'min'           => 1,
    'step'          => 1,
    'max'           => 5000,
    'display_value' => 'text',
	'required' => array( 'plan1', '=', true )
    ),
    array(
    'id'       => 'plan2',
    'type'     => 'switch',
    'title'    => esc_html__( 'Plan 2', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'increase-limit-plans', '=', true ),
    ),
    array(
    'id'       => 'plan2-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Name', 'service-finder' ),
	'required' => array( 'plan2', '=', true )
    ),
    array(
    'id'       => 'plan2-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price', 'service-finder' ),
    'default'  => '0',
	'required' => array( 'plan2', '=', true )
    ),
    array(
    'id'            => 'plan2-limit',
    'type'          => 'slider',
    'title'         => esc_html__( 'Limit', 'service-finder' ),
    'desc'          => '',
    'default'       => 1,
    'min'           => 1,
    'step'          => 1,
    'max'           => 5000,
    'display_value' => 'text',
	'required' => array( 'plan2', '=', true )
    ),
	array(
    'id'       => 'plan3',
    'type'     => 'switch',
    'title'    => esc_html__( 'Plan 3', 'service-finder' ),
	'desc'     => '',
    'subtitle' => '',
    'default'  => true,
	'required' => array( 'increase-limit-plans', '=', true ),
    ),
    array(
    'id'       => 'plan3-name',
    'type'     => 'text',
    'title'    => esc_html__( 'Name', 'service-finder' ),
	'required' => array( 'plan3', '=', true )
    ),
    array(
    'id'       => 'plan3-price',
    'type'     => 'text',
    'title'    => esc_html__( 'Price', 'service-finder' ),
    'default'  => '0',
	'required' => array( 'plan3', '=', true )
    ),
    array(
    'id'            => 'plan3-limit',
    'type'          => 'slider',
    'title'         => esc_html__( 'Limit', 'service-finder' ),
    'desc'          => '',
    'default'       => 1,
    'min'           => 1,
    'step'          => 1,
    'max'           => 5000,
    'display_value' => 'text',
	'required' => array( 'plan3', '=', true )
    ),
    )
    ) );
	
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'SEO Settings', 'service-finder' ),
    'id'               => 'seo-settings-page',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-graph'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'SEO Settings', 'service-finder' ),
    'id'               => 'provider-seo-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'provider-meta-title',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Title', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%NAME%,%COMPANY-NAME%,%SINGLE-CATEGORY%,%MULTIPLE-CATEGORY%,%COUNTRY%,%CITY%,%DESCRIPTION%',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-meta-keywords',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Keywords', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%NAME%,%COMPANY-NAME%,%SINGLE-CATEGORY%,%MULTIPLE-CATEGORY%,%COUNTRY%,%CITY%,%DESCRIPTION%',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-meta-desription',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Desription', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%NAME%,%COMPANY-NAME%,%SINGLE-CATEGORY%,%MULTIPLE-CATEGORY%,%COUNTRY%,%CITY%,%DESCRIPTION%',
    'default'  => ''
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Search Page SEO Settings', 'service-finder' ),
    'id'               => 'search-seo-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'search-meta-title',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Title', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%KEYWORD%,%ADDRESS%,%CATEGORY%,%COUNTRY%,%CITY%',
    'default'  => ''
    ),
	array(
    'id'       => 'search-meta-keywords',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Keywords', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%KEYWORD%,%ADDRESS%,%CATEGORY%,%COUNTRY%,%CITY%',
    'default'  => ''
    ),
	array(
    'id'       => 'search-meta-desription',
    'type'     => 'text',
    'title'    => esc_html__( 'Meta Desription', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '%KEYWORD%,%ADDRESS%,%CATEGORY%,%COUNTRY%,%CITY%',
    'default'  => ''
    ),
    )
    ) );
	
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Featured Settings', 'service-finder' ),
    'id'               => 'featured-settings-page',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-cog'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Featured Settings', 'service-finder' ),
    'id'               => 'featured-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'provider-feature',
    'type'     => 'switch',
    'title'    => esc_html__( 'Feature', 'service-finder' ).' '.esc_html($providerreplacestring),
    'subtitle' => '',
    'default'  => true
    ),
    array(
    'id'            => 'feature-min-max-days',
    'type'          => 'slider',
    'title'         => esc_html__( 'Days for Feature', 'service-finder' ),
    'subtitle'      => esc_html__( 'Please set min and max number of days available to make provider as featured', 'service-finder' ),
    'desc'          => '',
    'default'       => array(
    1 => 30,
    2 => 1000,
    ),
    'min'           => 1,
    'step'          => 1,
    'max'           => '365',
    'display_value' => 'select',
    'handles'       => 2,
    ),
    )
    ) );
	
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Labels', 'service-finder' ),
    'id'               => 'labels-setting',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-cog'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => sprintf( esc_html__('%s My Account Labels', 'service-finder'), $providerreplacestring ),
    'id'               => 'provider-myaccount-labels',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'label-profile-settings',
    'type'     => 'text',
    'title'    => esc_html__( 'Profile Settings', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-identity-check',
    'type'     => 'text',
    'title'    => esc_html__( 'Identity Check', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-availability',
    'type'     => 'text',
    'title'    => esc_html__( 'Availability', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-set-unavailability',
    'type'     => 'text',
    'title'    => esc_html__( 'Set Unavailability', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-business-hours',
    'type'     => 'text',
    'title'    => esc_html__( 'Business Hours', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-postal-codes',
    'type'     => 'text',
    'title'    => esc_html__( 'Postal Codes', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-our-branches',
    'type'     => 'text',
    'title'    => esc_html__( 'Our Branches', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-regions',
    'type'     => 'text',
    'title'    => esc_html__( 'Regions', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-my-services',
    'type'     => 'text',
    'title'    => esc_html__( 'My Services', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-my-jobs',
    'type'     => 'text',
    'title'    => esc_html__('My Jobs', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'       => 'label-job-limits',
    'type'     => 'text',
    'title'    => esc_html__('Job Limits', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-team-members',
    'type'     => 'text',
    'title'    => esc_html__( 'Team Members', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-bookings',
    'type'     => 'text',
    'title'    => esc_html__( 'Bookings', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-schedule',
    'type'     => 'text',
    'title'    => esc_html__( 'Schedule', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-invoice',
    'type'     => 'text',
    'title'    => esc_html__( 'Invoice', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-upgrade',
    'type'     => 'text',
    'title'    => esc_html__( 'Upgrade', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => sprintf( esc_html__('%s Public Profile Labels', 'service-finder'), $providerreplacestring ),
    'id'               => 'provider-public-profile-labels',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'label-photo-gallery',
    'type'     => 'text',
    'title'    => esc_html__( 'Photo Gallery', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-provider-bio',
    'type'     => 'text',
    'title'    => esc_html__( 'Provider Bio', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-public-business-hours',
    'type'     => 'text',
    'title'    => esc_html__( 'Business Hours', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-our-video',
    'type'     => 'text',
    'title'    => esc_html__( 'Our Video', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-our-services',
    'type'     => 'text',
    'title'    => esc_html__( 'Our services', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-services',
    'type'     => 'text',
    'title'    => esc_html__( 'Services', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-documents',
    'type'     => 'text',
    'title'    => esc_html__( 'Documents', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-book-now',
    'type'     => 'text',
    'title'    => esc_html__('Book Now', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'       => 'label-related-provider',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Related %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-booking-amount',
    'type'     => 'text',
    'title'    => esc_html__('Booking Amount', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-task-location',
    'type'     => 'text',
    'title'    => esc_html__( 'Your Task Location', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-date-time',
    'type'     => 'text',
    'title'    => esc_html__( 'Choose Date & Time', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-customer-info',
    'type'     => 'text',
    'title'    => esc_html__( 'Customer Info ', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-payment',
    'type'     => 'text',
    'title'    => esc_html__( 'Payment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'label-review',
    'type'     => 'text',
    'title'    => esc_html__( 'Review', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    )
    ) );
	
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Custom Messages', 'service-finder' ),
    'id'               => 'custom-messages-page',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-cog'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Custom Messages', 'service-finder' ),
    'id'               => 'custom-messages',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'login-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Login Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-signup-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Provider Signup Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'claimed-business-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Claimed Business Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'customer-signup-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Customer Signup Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-upgrade-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Provider Upgrade Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-upgrade-failed',
    'type'     => 'text',
    'title'    => esc_html__( 'Provider Upgrade Failed', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'jobapply-limit-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Job Apply Limit Upgrade Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-recurring-signup-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Provider Recurring Signup Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-recurring-upgrade-successfull',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('%s Recurring Upgrade Successfull', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'       => 'customer-signup-successfull',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('%s Signup Successfull', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'password-reset-successfull',
    'type'     => 'text',
    'title'    => esc_html__( 'Password Reset Successfull', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'feature-request',
    'type'     => 'text',
    'title'    => esc_html__( 'Send Feature Request', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'feature-payment',
    'type'     => 'text',
    'title'    => esc_html__( 'After Feature Payment', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'featured-account',
    'type'     => 'text',
    'title'    => esc_html__( 'After being Featured in Upgrade Account Tab', 'service-finder' ),
    'subtitle' => '',
    'desc'     => 'Use %REMAININGDAYS% keyword to show reamining days to expire featured account',
    'default'  => ''
    ),
	array(
    'id'       => 'subscription-cancel',
    'type'     => 'text',
    'title'    => esc_html__( 'Subscription Cancelled', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'featured-cancel',
    'type'     => 'text',
    'title'    => esc_html__( 'Featured/Featured Request Cancelled', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'booking-approve',
    'type'     => 'text',
    'title'    => esc_html__( 'Booking Approve', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'provider-booked',
    'type'     => 'text',
    'title'    => esc_html__( 'After book Provider', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'get-quote',
    'type'     => 'text',
    'title'    => esc_html__( 'Get Quotation', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'pay-invoice',
    'type'     => 'text',
    'title'    => esc_html__( 'After Pay Invoice', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'job-limit',
    'type'     => 'text',
    'title'    => esc_html__( 'After Payment for Increase Job Limit', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'upload-identity',
    'type'     => 'text',
    'title'    => esc_html__( 'After Upload Identity', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'nl-subscription',
    'type'     => 'text',
    'title'    => esc_html__( 'Newsletter Subscription', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'apply-job',
    'type'     => 'text',
    'title'    => esc_html__( 'Apply for Job', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'hire-bookingoff',
    'type'     => 'text',
    'title'    => esc_html__( 'Hire if booking is off', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'google-calendar-booking-title',
    'type'     => 'text',
    'title'    => esc_html__( 'Title for Booking in Google Calendar', 'service-finder' ),
    'subtitle' => '',
    'desc' 	   => "Keywords: %CUSTOMERNAME%,%CUSTOMEREMAIL%",
    'default'  => ''
    ),
	array(
    'id'      => 'claim-business-payment',
    'type'    => 'editor',
    'title'   => esc_html__('Claim Business Payment', 'service-finder'),
    'desc' => "Keywords: %PROVIDERNAME%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Mail Settings', 'service-finder' ),
    'id'               => 'mail-templates',
	'customizer'           => false,
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-envelope'
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Set From Name and Email in Mail Function', 'service-finder' ),
    'id'               => 'set-from-address',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'from-name',
    'type'     => 'text',
    'title'    => esc_html__( 'From Name', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'       => 'from-email',
    'type'     => 'text',
    'title'    => esc_html__( 'From Email', 'service-finder' ),
    'subtitle' => '',
    'desc'     => 'Ex.:- example@domain.com',
    'default'  => ''
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html($providerreplacestring).' '.esc_html__( 'Expiry Mail Notification', 'service-finder' ),
    'id'               => 'expiry-mail-notification',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'expiry-mail-notification-days',
    'type'     => 'multi_text',
    'title'    => esc_html__( 'Number of Days Before mail Send', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Set the number of days before expiry mail send', 'service-finder' )
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Signup Mail', 'service-finder' ),
    'id'               => 'signup-mail-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'send-to-user-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-user',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'send-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-provider',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
 	array(
    'id'       => 'provider-to-admin-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for %s Signup Mail to Admin', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),  
    array(
    'id'      => 'provider-to-admin',
    'type'    => 'editor',
    'title'   => esc_html($providerreplacestring).' '.esc_html__( 'Signup Mail to Admin', 'service-finder' ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%,%ADDRESS%,%CITY%,%COUNTRY%,%ZIPCODE%,%CATEGORY%,%PACKAGENAME%,%PAYMENTTYPE%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'customer-to-admin-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for %s Signup Mail to Admin', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'      => 'customer-to-admin',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('%s Signup Mail to Admin', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Provider Account Approval', 'service-finder' ),
    'id'               => 'provider-account-approval-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'provider-account-approval-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s for Account Approval', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-provider-account-approval',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s for Account Approval', 'service-finder'), $providerreplacestring ),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Featured Request Approval', 'service-finder' ),
    'id'               => 'provider-featured-request-approval-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'provider-featured-request-approval-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s for Featured Request Approval', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'end-to-provider-featured-request-approval',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s for Featured Request Approval', 'service-finder'), $providerreplacestring ),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Subscription Expire/Cancel Mail', 'service-finder' ),
    'id'               => 'subscription-expire-cancel-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'provider-subscription-expire-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s for Subscription Expire', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-subscription-expire-provider',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s for Subscription Expire', 'service-finder'), $providerreplacestring ),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'admin-subscription-expire-subject',
    'type'     => 'text',
    'title'    => esc_html__('Subject for Mail Send to Admin for Subscription Expire', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-subscription-expire-admin',
    'type'    => 'editor',
    'title'   => esc_html__('Mail Send to Admin for Subscription Expire', 'service-finder'),
	'desc' => "Keywords: %PROVIDERNAME%,%PROVIDEREMAIL%,%PROVIDERPHONE%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'provider-subscription-cancel',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s for Subscription Cancel', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-subscription-cancel-provider',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s for Subscription Cancel', 'service-finder'), $providerreplacestring ),
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'admin-subscription-cancel',
    'type'     => 'text',
    'title'    => esc_html__('Subject for Mail Send to Admin for Subscription Cancel', 'service-finder'),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'send-to-subscription-cancel-admin',
    'type'    => 'editor',
    'title'   => esc_html__('Mail Send to Admin for Subscription Cancel', 'service-finder'),
	'desc' => "Keywords: %PROVIDERNAME%,%PROVIDEREMAIL%,%PROVIDERPHONE%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Upgrade Mail', 'service-finder' ),
    'id'               => 'upgrade-mail-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'upgrade-send-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Upgrade Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'upgrade-send-to-provider',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Upgrade Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%,%PACKAGENAME%,%PAYMENTTYPE%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'upgrade-provider-to-admin-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for %s Upgrade Mail to Admin', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),   
    array(
    'id'      => 'upgrade-provider-to-admin',
    'type'    => 'editor',
    'title'   => esc_html($providerreplacestring).' '.esc_html__( 'Upgrade Mail to Admin', 'service-finder' ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%,%ADDRESS%,%CITY%,%COUNTRY%,%ZIPCODE%,%CATEGORY%,%PACKAGENAME%,%PAYMENTTYPE%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Booking Mail', 'service-finder' ),
    'id'               => 'booking-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'booking-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-to-customer',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE%, %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
   array(
    'id'       => 'booking-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'      => 'booking-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE%, %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'       => 'booking-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE% %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Booking Reminder Mail', 'service-finder' ),
    'id'               => 'booking-reminder-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'booking-reminder-mail-notification-days',
    'type'     => 'multi_text',
    'title'    => esc_html__( 'Number of Days Before mail Send', 'service-finder' ),
    'subtitle' => '',
    'desc'     => esc_html__( 'Set the number of days before booking reminder mail send', 'service-finder' )
    ),
	array(
    'id'       => 'booking-reminder-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-reminder-to-customer',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
   array(
    'id'       => 'booking-reminder-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'      => 'booking-reminder-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'       => 'booking-reminder-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-reminder-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %SERVICES%, %SHORTDESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Booking Approval Mail If Booking Made via Wire Transfer', 'service-finder' ),
    'id'               => 'booking-approval-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'booking-approval-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-approval-to-customer',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE%, %SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
   array(
    'id'       => 'booking-approval-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
    array(
    'id'      => 'booking-approval-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE%, %SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'       => 'booking-approval-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'booking-approval-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%, %ADMINFEE% %SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Change Booking Status to Complete Mail', 'service-finder' ),
    'id'               => 'change-booking-status-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'change-booking-status-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'change-booking-status-to-customer',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'       => 'change-booking-status-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'change-booking-status-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    array(
    'id'       => 'change-booking-status-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'change-booking-status-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, '%SERVICES%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Invoice Mail', 'service-finder' ),
    'id'               => 'invoice-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'invoice-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Generate Invoice Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'invoice-to-customer',
    'type'    => 'editor',
    'title'   => esc_html__( 'Generate Invoice Mail Send to Customer', 'service-finder' ),
    'desc' => "Keywords: %REFERENCENO%,%DUEDATE%,%PROVIDERNAME%,%DISCOUNTTYPE%,%DISCOUNT%,'%TAXTYPE%',%TAX%,%DISCRIPTION%,%TOTAL%,%GRANDTOTAL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'invoice-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Invoice Paid Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),   
    array(
    'id'      => 'invoice-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Invoice Paid Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %REFERENCENO%,%DUEDATE%,%CUSTOMEREMAIL%,%DISCOUNTTYPE%,%DISCOUNT%,'%TAXTYPE%',%TAX%,%DISCRIPTION%,%TOTAL%,%GRANDTOTAL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Contact Us Mail', 'service-finder' ),
    'id'               => 'contactus-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'contactus-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Contact Us Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ), 
	array(
    'id'      => 'contactus-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Contact Us Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %FULLNAME%,%EMAIL%,%PHONE%,%COMMENT%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Job Apply Mail', 'service-finder' ),
    'id'               => 'jobapply-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'job-apply-mail-to-admin',
    'type'     => 'switch',
    'title'    => esc_html__( 'Job Apply Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'default'  => true,
    ),
	array(
    'id'       => 'applyjob-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Apply for Job Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ), 
	array(
    'id'      => 'applyjob-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Apply for Job Mail Send to Admin', 'service-finder' ),
    'desc' => "%JOBTITLE%,%FULLNAME%,%EMAIL%,%PHONE%,%COST%,%DESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'applyjob-to-customer-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Apply for Job Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ), 
	array(
    'id'      => 'applyjob-to-customer',
    'type'    => 'editor',
    'title'   => sprintf( esc_html__('Apply for Job Mail Send to %s', 'service-finder'), $customerreplacestring ),
    'desc' => "%JOBTITLE%,%FULLNAME%,%EMAIL%,%PHONE%,%COST%,%DESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Job Assign to Member Mail', 'service-finder' ),
    'id'               => 'job-assign-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'job-assign-to-member-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Mail Send to Member', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ), 
	array(
    'id'      => 'job-assign-to-member',
    'type'    => 'editor',
    'title'   => esc_html__( 'Mail Send to Member', 'service-finder' ),
    'desc' => "Keywords: %DATE%, %STARTTIME%, %ENDTIME%, %MEMBERNAME%, %PROVIDERNAME%, %PROVIDEREMAIL%, %PROVIDERPHONE%, %CUSTOMERNAME%, %CUSTOMEREMAIL%, %CUSTOMERPHONE%, %CUSTOMERPHONE2%, %ADDRESS%, %APT%, %CITY%, %STATE%, %ZIPCODE%, %COUNTRY%, %PAYMENTMETHOD%, %AMOUNT%", '%SERVICES%',
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Identity Check Mail', 'service-finder' ),
    'id'               => 'identity-check-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'identity-approve-mail-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Identity Approve Mail to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'identity-approve-mail',
    'type'    => 'editor',
    'title'   => esc_html__( 'Identity Approve Mail to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'identity-unapprove-mail-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Identity UnApprove Mail to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'identity-unapprove-mail',
    'type'    => 'editor',
    'title'   => esc_html__( 'Identity UnApprove Mail to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Request a Quote Mail', 'service-finder' ),
    'id'               => 'quote-mail-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'quote-to-provider-subject',
    'type'     => 'text',
    'title'    => sprintf( esc_html__('Subject for Request a Quote Mail Send to %s', 'service-finder'), $providerreplacestring ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'quote-to-provider',
    'type'    => 'editor',
    'title'   => esc_html__( 'Request a Quote Mail Send to', 'service-finder' ).' '.esc_html($providerreplacestring),
    'desc' => "Keywords: %CUSTOMERNAME%,%EMAIL%,%PHONE%,%DESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'quote-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Request a Quote Mail Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'quote-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Request a Quote Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %PROVIDERNAME%,%PROVIDEREMAIL%,%CUSTOMERNAME%,%EMAIL%,%PHONE%,%DESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html__( 'Claim Business Mail', 'service-finder' ),
    'id'               => 'claim-business-mail-settings',
    'subsection'       => true,
	'customizer'           => false,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
	array(
    'id'       => 'claimbusiness-to-admin-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Claim Business Send to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'claimbusiness-to-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'Claim Business Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %PROVIDERNAME%,%PROVIDEREMAIL%,%PROVIDERPROFILELINK%,%CUSTOMERNAME%,%EMAIL%,%DESCRIPTION%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'approve-claim-free-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Free Approve Claim Business Send to User', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'approve-claim-free',
    'type'    => 'editor',
    'title'   => esc_html__( 'Free Approve Claim Business Mail Send to User', 'service-finder' ),
    'desc' => "Keywords: %USERNAME%,%PASSWORD%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'approve-claim-paid-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Paid Approve Claim Business Send to User', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'approve-claim-paid',
    'type'    => 'editor',
    'title'   => esc_html__( 'Paid Approve Claim Business Mail Send to User', 'service-finder' ),
    'desc' => "Keywords: %PROVIDERNAME%,%PROVIDERPROFILELINK%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'after-claimedpayment-subject-user',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for After Claimed to User', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'after-claimedpayment-message-user',
    'type'    => 'editor',
    'title'   => esc_html__( 'After Claimed Payment Mail Send to User', 'service-finder' ),
    'desc' => "Keywords: %PROVIDERNAME%,%PROVIDERPROFILELINK%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'after-claimedpayment-subject-admin',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for After Claimed to Admin', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'after-claimedpayment-message-admin',
    'type'    => 'editor',
    'title'   => esc_html__( 'After Claimed Payment Mail Send to Admin', 'service-finder' ),
    'desc' => "Keywords: %USERNAME%,%EMAIL%,%PACKAGENAME%,%PAYMENTTYPE%,%CUSTOMERNAME%,%CUSTOMEREMAIL%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
	array(
    'id'       => 'decline-claim-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Decline Claim Business Send to User', 'service-finder' ),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ),
	array(
    'id'      => 'decline-claim',
    'type'    => 'editor',
    'title'   => esc_html__( 'Decline Claim Business Mail Send to User', 'service-finder' ),
    'desc' => "Keywords: %PROVIDERNAME%,%PROVIDEREMAIL%,%PROVIDERPROFILELINK%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
	Redux::setSection( $opt_name, array(
    'title'            => esc_html($customerreplacestring).' '.esc_html__( 'Registered via Job Posting Email', 'service-finder' ),
    'id'               => 'password-reset-mail-settings',
	'customizer'           => false,
    'subsection'       => true,
    'customizer_width' => '450px',
    'desc'             => '',
    'fields'           => array(
    array(
    'id'       => 'password-reset-to-customer-subject',
    'type'     => 'text',
    'title'    => esc_html__( 'Subject for Password Reset Mail Send to', 'service-finder' ).' '.esc_html($customerreplacestring),
    'subtitle' => '',
    'desc'     => '',
    'default'  => ''
    ), 
	array(
    'id'      => 'password-reset-to-customer',
    'type'    => 'editor',
    'title'   => esc_html__( 'Password Reset Mail Send to', 'service-finder' ).' '.esc_html($customerreplacestring),
    'desc' => "Keywords: %USERNAME%,%PASSWORDRESETLINK%",
    'default' => '',
    'args'    => array(
    'wpautop'       => false,
    'media_buttons' => false,
    'textarea_rows' => 5,
    'teeny'         => false,
    'quicktags'     => true,
    )
    ),
    )
    ) );
    
    if ( file_exists( plugin_dir_path( __FILE__ ) . '/../README.md' ) ) {
    $section = array(
    'icon'   => 'el el-list-alt',
    'title'  => esc_html__( 'Documentation', 'service-finder' ),
    'fields' => array(
    array(
    'id'       => '17',
    'type'     => 'raw',
    'markdown' => true,
    'content_path' => plugin_dir_path( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
    ),
    ),
    );
    Redux::setSection( $opt_name, $section );
    }
    /*
    * <--- END SECTIONS
    */
    
    
    add_filter('redux/options/' . $opt_name . '/settings/change', 'service_finder_save_action', 10, 3);
    
    if ( ! function_exists( 'service_finder_save_action' ) ) {
    function service_finder_save_action( $values ) {
    
	if ( function_exists( 'service_finder_generate_options_css' ) ) {
	/*Re-Generate style.css file*/
	service_finder_generate_options_css($values);
	}
	
	if ( function_exists( 'service_finder_createPlans' ) ) {
	/*Plans create for stripe*/
    service_finder_createPlans($values);
	}
    
    }
    }
    
    
    /*
    *
    * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
    *
    */
    
    /*
    *
    * --> Action hook examples
    *
    */
    
    /**
    * This is a test function that will let you see when the compiler hook occurs.
    * It only runs if a field    set with compiler=>true is changed.
    * */
    if ( ! function_exists( 'compiler_action' ) ) {
    function compiler_action( $options, $css, $changed_values ) {
    echo '
<h1>The compiler hook has run!</h1>
';
    }
    }
    
    /**
    * Custom function for the callback validation referenced above
    * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
    function redux_validate_callback_function( $field, $value, $existing_value ) {
    $error   = false;
    $warning = false;
    
    //do your validation
    if ( $value == 1 ) {
    $error = true;
    $value = $existing_value;
    } elseif ( $value == 2 ) {
    $warning = true;
    $value   = $existing_value;
    }
    
    $return['value'] = $value;
    
    if ( $error == true ) {
    $return['error'] = $field;
    $field['msg']    = 'your custom error message';
    }
    
    if ( $warning == true ) {
    $return['warning'] = $field;
    $field['msg']      = 'your custom warning message';
    }
    
    return $return;
    }
    }
    
    /**
    * Custom function for the callback referenced above
    */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
    function redux_my_custom_field( $field, $value ) {
    print_r( $field );
    echo '<br/>
';
    print_r( $value );
    }
    }
    
    /**
    * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
    * Simply include this function in the child themes functions.php file.
    * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
    * so you must use get_template_directory_uri() if you want to use any of the built in icons
    * */
    if ( ! function_exists( 'dynamic_section' ) ) {
    function dynamic_section( $sections ) {
    $sections[] = array(
    'title'  => esc_html__( 'Section via hook', 'service-finder' ),
    'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>
', 'service-finder' ),
    'icon'   => 'el el-paper-clip',
    // Leave this as a blank section, no options just some intro text set above.
    'fields' => array()
    );
    
    return $sections;
    }
    }
    
    /**

    * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
    * */
    if ( ! function_exists( 'change_arguments' ) ) {
    function change_arguments( $args ) {
    //$args['dev_mode'] = true;
    
    return $args;
    }
    }
    
    /**
    * Filter hook for filtering the default value of any given field. Very useful in development mode.
    * */
    if ( ! function_exists( 'change_defaults' ) ) {
    function change_defaults( $defaults ) {
    $defaults['str_replace'] = 'Testing filter hook!';
    
    return $defaults;
    }
    }
    
    /**
    * Removes the demo link and the notice of integrated demo from the sedate plugin
    */
    if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
    // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
    if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
    remove_filter( 'plugin_row_meta', array(
    ReduxFrameworkPlugin::instance(),
    'plugin_metalinks'
    ), null, 2 );
    
    // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
    remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
    }
    }
    } 