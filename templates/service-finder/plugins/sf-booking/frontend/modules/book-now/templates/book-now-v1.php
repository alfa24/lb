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
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');

$payment_methods = (!empty($service_finder_options['payment-methods'])) ? $service_finder_options['payment-methods'] : '';
$show_booking_otp = (!empty($service_finder_options['show-booking-otp'])) ? $service_finder_options['show-booking-otp'] : '';
$paid_booking = (!empty($service_finder_options['paid-booking'])) ? $service_finder_options['paid-booking'] : '';

/*Include Book Now Class*/
$userInfo = service_finder_getCurrentUserInfo();
$userCap = service_finder_get_capability($author);
$settings = service_finder_getProviderSettings($author);
if(!empty($userCap)){
$capability = '';
foreach($userCap as $cap){
$capability .= '"'.$cap.'",';
}
}
$capability = rtrim($capability,',');

$jobid = (!empty($_GET['jobid'])) ? $_GET['jobid']  : '';
if($jobid != ""){
$jobpost = get_post($jobid);
if(!empty($jobpost)){
$jobauthor = $jobpost->post_author;
}
}

$bookingcost = get_post_meta($jobid,'_job_cost',true);
if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer' && $jobid > 0 && $jobauthor == $current_user->ID && $bookingcost > 0){
$bookingcost = get_post_meta($jobid,'_job_cost',true);
}else{
$bookingcost = $settings['mincost'];
}

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';
if($pay_booking_amount_to == 'admin'){
	$stripetype = (!empty($service_finder_options['stripe-type'])) ? esc_html($service_finder_options['stripe-type']) : '';
	if($stripetype == 'live'){
		$stripepublickey = (!empty($service_finder_options['stripe-live-public-key'])) ? esc_html($service_finder_options['stripe-live-public-key']) : '';
	}else{
		$stripepublickey = (!empty($service_finder_options['stripe-test-public-key'])) ? esc_html($service_finder_options['stripe-test-public-key']) : '';
	}
}elseif($pay_booking_amount_to == 'provider'){
	$stripepublickey = esc_html($settings['stripepublickey']);
}

$twocheckouttype = (!empty($service_finder_options['twocheckout-type'])) ? esc_html($service_finder_options['twocheckout-type']) : '';
if($twocheckouttype == 'live'){
	$twocheckoutmode = 'production';
}else{
	$twocheckoutmode = 'sandbox';
}
if($pay_booking_amount_to == 'admin'){
	if($twocheckouttype == 'live'){
		$twocheckoutpublishkey = (!empty($service_finder_options['twocheckout-live-publish-key'])) ? esc_html($service_finder_options['twocheckout-live-publish-key']) : '';
		$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-live-account-id'])) ? esc_html($service_finder_options['twocheckout-live-account-id']) : '';
	}else{
		$twocheckoutpublishkey = (!empty($service_finder_options['twocheckout-test-publish-key'])) ? esc_html($service_finder_options['twocheckout-test-publish-key']) : '';
		$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-test-account-id'])) ? esc_html($service_finder_options['twocheckout-test-account-id']) : '';
	}
}elseif($pay_booking_amount_to == 'provider'){
	$twocheckoutpublishkey = esc_html($settings['twocheckoutpublishkey']);
	$twocheckoutaccountid = esc_html($settings['twocheckoutaccountid']);
}

if(service_finder_is_job_author($jobid,$jobauthor)){
$checkjobauthor = 1;
}else{
$checkjobauthor = 0;
}

$admin_fee_type = (!empty($service_finder_options['admin-fee-type'])) ? $service_finder_options['admin-fee-type'] : 0;
$admin_fee_percentage = (!empty($service_finder_options['admin-fee-percentage'])) ? $service_finder_options['admin-fee-percentage'] : 0;
$admin_fee_fixed = (!empty($service_finder_options['admin-fee-fixed'])) ? $service_finder_options['admin-fee-fixed'] : 0;

$admin_fee_label = (!empty($service_finder_options['admin-fee-label'])) ? $service_finder_options['admin-fee-label'] : esc_html__('Admin Fee', 'service-finder');
$charge_admin_fee = (!empty($service_finder_options['charge-admin-fee'])) ? $service_finder_options['charge-admin-fee'] : '';
$charge_admin_fee_from = (!empty($service_finder_options['charge-admin-fee-from'])) ? $service_finder_options['charge-admin-fee-from'] : '';

if($charge_admin_fee && $pay_booking_amount_to == 'admin' && (($admin_fee_type == 'fixed' && $admin_fee_fixed > 0) || ($admin_fee_type == 'percentage' && $admin_fee_percentage > 0)) && $charge_admin_fee_from == 'customer'){
$showadminfee = '<li>'.esc_html__('Booking Amount', 'service-finder').': <strong><span id="bookingfee"></span></strong> </li>';
$showadminfee .= '<li>'.sprintf( esc_html__('%s', 'service-finder'), $admin_fee_label ).': <strong><span id="bookingadminfee"></span></strong> </li>';
$showadminfee .= '<li>'.esc_html__('Total Amount', 'service-finder').': <strong><span id="totalbookingfee"></span></strong> </li>';
$showadminfee = '<ul class="sf-adminfee-bx">'.$showadminfee.'</ul>';
}else{
$totalamount = $bookingcost;
$showadminfee = '';
}

wp_add_inline_script( 'service_finder-js-booking-form-v1', '/*Declare global variable*/
var staffmember = "'.$settings['members_available'].'";
var jobid = "'.$jobid.'";
var checkjobauthor = "'.$checkjobauthor.'";
var totalcost = "'.$bookingcost.'";
var adminfeetype = "'.$admin_fee_type.'";
var adminfeefixed = "'.$admin_fee_fixed.'";
var adminfeepercentage = "'.$admin_fee_percentage.'";
var mincost = "'.$bookingcost.'";
var booking_basedon = "'.$settings['booking_basedon'].'";
var booking_basedon = "'.$settings['booking_basedon'].'";
var stripepublickey = "'.$stripepublickey.'";
var twocheckoutaccountid = "'.$twocheckoutaccountid.'";
var twocheckoutpublishkey = "'.$twocheckoutpublishkey.'";
var twocheckouttype = "'.$twocheckouttype.'";
var twocheckoutmode = "'.$twocheckoutmode.'";
var booking_charge_on_service = "'.$settings['booking_charge_on_service'].'";
var caps = ['.$capability.'];', 'after' );

wp_add_inline_script( 'service_finder-js-booking-form-free-v1', '/*Declare global variable*/
var staffmember = "'.$settings['members_available'].'";
var jobid = "'.$jobid.'";
var checkjobauthor = "'.$checkjobauthor.'";
var totalcost = "'.$bookingcost.'";
var adminfeetype = "'.$admin_fee_type.'";
var adminfeefixed = "'.$admin_fee_fixed.'";
var adminfeepercentage = "'.$admin_fee_percentage.'";
var mincost = "'.$bookingcost.'";
var booking_basedon = "'.$settings['booking_basedon'].'";
var booking_basedon = "'.$settings['booking_basedon'].'";
var stripepublickey = "'.$stripepublickey.'";
var twocheckoutaccountid = "'.$twocheckoutaccountid.'";
var twocheckoutpublishkey = "'.$twocheckoutpublishkey.'";
var twocheckouttype = "'.$twocheckouttype.'";
var twocheckoutmode = "'.$twocheckoutmode.'";
var booking_charge_on_service = "'.$settings['booking_charge_on_service'].'";
var caps = ['.$capability.'];', 'after' );


wp_add_inline_script( 'google-map', 'jQuery(function() {
/*Autofill address by google script in 1st Step*/
function service_finder_initBookingAutoComplete(){
			var address = document.getElementById("booking-location");
			var my_address = new google.maps.places.Autocomplete(address);
	
			google.maps.event.addListener(my_address, "place_changed", function() {
		var place = my_address.getPlace();
		
		// if no location is found
		if (!place.geometry) {
			return;
		}
		var $zipcode = jQuery("#zipcode");
		
		var country_long_name = "";
		var country_short_name = "";
		
		for(var i=0; i<place.address_components.length; i++){
			var address_component = place.address_components[i];
			var ty = address_component.types;

			for (var k = 0; k < ty.length; k++) {
				if (ty[k] === "locality" || ty[k] === "sublocality" || ty[k] === "sublocality_level_1"  || ty[k] === "postal_town") {
					var city = address_component.long_name;
			   } else if (ty[k] === "administrative_area_level_1" || ty[k] === "administrative_area_level_2") {
					var statename = address_component.long_name;
				} else if (ty[k] === "postal_code") {
					$zipcode.val(address_component.short_name);
					jQuery(".book-now").bootstrapValidator("revalidateField", "zipcode");
				}
			}
		}
		
		var address = jQuery("#booking-location").val();
		var new_address = address.replace(city,"");
		new_address = new_address.replace(statename,"");
		
		new_address = new_address.replace(country_long_name,"");
		new_address = new_address.replace(country_short_name,"");
		new_address = jQuery.trim(new_address);
		
		
		new_address = new_address.replace(/,/g, "");
		new_address = new_address.replace(/ +/g," ");
		jQuery("#booking-location").val(address);
		jQuery("#booking-location").change();
		
		
	
	 });
		}
google.maps.event.addDomListener(window, "load", service_finder_initBookingAutoComplete);

/*Autofill address by google script in 3rd Step*/
function service_finder_initBookingAddressAutoComplete(){
	
			var address = document.getElementById("booking-address");

			var my_address = new google.maps.places.Autocomplete(address);
	
			google.maps.event.addListener(my_address, "place_changed", function() {
		var place = my_address.getPlace();
		
		// if no location is found
		if (!place.geometry) {
			return;
		}
		
		var $city =jQuery("#bookingcity");
		var $state = jQuery("#bookingstate");
		var $country = jQuery("#bookingcountry");
		
		var country_long_name = "";
		var country_short_name = "";
		
		for(var i=0; i<place.address_components.length; i++){
			var address_component = place.address_components[i];
			var ty = address_component.types;

			for (var k = 0; k < ty.length; k++) {
				if (ty[k] === "locality" || ty[k] === "sublocality" || ty[k] === "sublocality_level_1"  || ty[k] === "postal_town") {
					$city.val(address_component.long_name);
					jQuery(".book-now").bootstrapValidator("revalidateField", "city");
					var cityname = address_component.long_name;
				} else if (ty[k] === "administrative_area_level_1" || ty[k] === "administrative_area_level_2") {
					$state.val(address_component.long_name);
					jQuery(".book-now").bootstrapValidator("revalidateField", "state");
					var statename = address_component.long_name;
				} else if(ty[k] === "country"){
					country_long_name = address_component.long_name;
					country_short_name = address_component.short_name;
					$country.val(address_component.long_name);
					jQuery(".book-now").bootstrapValidator("revalidateField", "country");
				}
			}
		}
		
		var address = jQuery("#booking-address").val();
		var new_address = address.replace(cityname,"");
		new_address = new_address.replace(statename,"");
		
		new_address = new_address.replace(country_long_name,"");
		new_address = new_address.replace(country_short_name,"");
		new_address = jQuery.trim(new_address);
		
		
		new_address = new_address.replace(/,/g, "");
		new_address = new_address.replace(/ +/g," ");
		jQuery("#booking-address").val(address);
		
	
	 });
		}

google.maps.event.addDomListener(window, "load", service_finder_initBookingAddressAutoComplete);

});', 'after' );
?>
<!--Book Now Form Template Start Version 1-->
<form class="myform book-now" method="post">
  <!--Step 1-->
  <div id="panel-1" class="padding-20 clearfix margin-b-30  bg-white sf-rouned-box">
    <div class="form-step-bx padding-lr-20">
      <h6><strong>1.</strong>
        <?php echo (!empty($service_finder_options['label-task-location'])) ? esc_html($service_finder_options['label-task-location']) : esc_html__('Your Task Location', 'service-finder'); ?>
      </h6>
      <div class="panel-summary"></div>
      <div class="clearfix f-row">
  		<?php 
		$service_perform = get_user_meta($author,'service_perform',true); 
		if(($service_perform == 'provider_location' || $service_perform == 'both') && $service_finder_options['show-address-info'] && service_finder_check_address_info_access()){
		$my_location = get_user_meta($author,'my_location',true); 
		$providerlat = get_user_meta($author,'providerlat',true); 
		$providerlng = get_user_meta($author,'providerlng',true); 
		$locationzoomlevel = get_user_meta($author,'locationzoomlevel',true); 
		?>
          <div class="col-md-6">
            <div class="form-group">
              <label>
              <?php esc_html_e('Service Location', 'service-finder'); ?>
              </label>
              <div class="input-group">
              <?php echo $my_location; ?>
              <button class="btn btn-primary btn-sm" data-tool="tooltip" title="<?php echo esc_html__('View Map','servide-finder'); ?>" id="viewmylocation" data-locationzoomlevel="<?php echo esc_attr($locationzoomlevel); ?>" data-providerlat="<?php echo esc_attr($providerlat); ?>" data-providerlng="<?php echo esc_attr($providerlng); ?>" type="button"><i class="fa fa-map-marker"></i>
                </button>
              </div>
              
            </div>
          </div>
          <?php } ?>     
        <?php if($settings['booking_basedon'] == 'zipcode'){ 
		if($service_perform != 'provider_location' || !$service_finder_options['show-address-info']){
		?>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Enter Location', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-location-arrow"></i>
              <input id="booking-location" name="location" type="text" class="form-control" value="<?php echo esc_attr($userInfo['address']) ?>">
            </div>
          </div>
        </div>
        <?php } ?>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Enter Your Zip code', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
              <input id="zipcode" name="zipcode" type="text" class="form-control" value="<?php echo esc_attr($userInfo['zipcode']) ?>">
            </div>
          </div>
        </div>
        <?php }elseif($settings['booking_basedon'] == 'region'){ ?>
        <div class="col-md-12">
            <div class="form-group">
              <label>
              <?php esc_html_e('Select Region', 'service-finder'); ?>
              </label>
              <div class="input-group"> 
                <select name="region" id="region">
                    <option value=""><?php esc_html_e('Select Region', 'service-finder'); ?></option>
                    <?php
                    $regions = service_finder_getServiceRegions($author);
					if(!empty($regions)){
						foreach($regions as $region){
							echo '<option value="'.esc_attr($region->region).'">'.esc_html($region->region).'</option>';
						}
					}
					?>
                </select>
              </div>
            </div>
          </div>
        <?php }elseif($settings['booking_basedon'] == 'open' && ($service_perform != 'provider_location' || !$service_finder_options['show-address-info'] )){ ?>
        <div class="col-md-12">
          <div class="form-group">
            <label>
            <?php esc_html_e('Enter Location', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-location-arrow"></i>
              <input id="booking-location" name="location" type="text" class="form-control" value="<?php echo esc_attr($userInfo['address']) ?>">
            </div>
          </div>
        </div>
        <?php }?>
        <?php if($settings['booking_charge_on_service'] == 'yes' && !service_finder_is_job_author($jobid,$jobauthor)){ ?>
          <div id="bookingservices" style=" <?php echo ($settings['booking_basedon'] == 'region') ? 'display:block;' : ''; ?>" class="equal-col-outer">
		  <?php
         	$services = service_finder_getServices($author,'active');
				if(!empty($services)){
					foreach($services as $service){
					if($service->cost_type == 'hourly'){
						if($service->hours > 0){
						$addhours = '<div class="input-group bootstrap-touchspin sf-service-fixhr-bx" id="hours-outer-bx-'.esc_attr($service->id).'" style="display:none;">
    <div class="input-table-bx">
	<span class="input-cell-bx">
	<i class="fa fa-clock-o"></i>
     <input id="hours-'.esc_attr($service->id).'" class="form-control" type="text" name="hours[]" style="display:none;">
    </span>
    <span class="input-cell-bx">
	'.esc_html__('Hour', 'service-finder').'
    </span>
	</div>
</div>';
						}else{
						$addhours = '<input id="hours-'.esc_attr($service->id).'" class="form-control" type="text" name="hours[]" style="display:none;">';
						}
						
						if($service->hours > 0){
						$perhr = service_finder_money_format($service->cost);
						$perhr .= '<span class="sf-fix-hours"><i class="fa fa-clock-o"></i> '.$service->hours.esc_html__(' hrs', 'service-finder').'</span>';
						}else{
						$perhr = service_finder_money_format($service->cost).esc_html__('/hour', 'service-finder');
						}
						
						$totalhrsprs = $service->hours;
					}elseif($service->cost_type == 'perperson'){
						if($service->persons > 0){
						$addhours = '<div class="input-group bootstrap-touchspin sf-service-fixhr-bx" id="hours-outer-bx-'.esc_attr($service->id).'" style="display:none;">
    <div class="input-table-bx">
	<span class="input-cell-bx">
	<i class="fa fa-user"></i>
     <input id="hours-'.esc_attr($service->id).'" class="form-control" type="text" name="hours[]" style="display:none;">
    </span>
    <span class="input-cell-bx">
	'.esc_html__('Person', 'service-finder').'
    </span>
	</div>
</div>';
						}else{
						$addhours = '<input id="hours-'.esc_attr($service->id).'" class="form-control" type="text" name="hours[]" style="display:none;">';
						}
						
						if($service->persons > 0){
						$perhr = service_finder_money_format($service->cost);
						$perhr .= '<span class="sf-fix-hours"><i class="fa fa-user"></i> '.$service->persons.esc_html__(' items', 'service-finder').'</span>';
						}else{
						$perhr = service_finder_money_format($service->cost).esc_html__('/person', 'service-finder');
						}
						
						$totalhrsprs = $service->persons;
					}else{
						$addhours = '';
						$perhr = service_finder_money_format($service->cost);
						$totalhrsprs = 0;
					}

						echo '<div class="col-md-4 aon-service-outer equal-col">
							  	<div class="aon-service-bx unselected" data-hours="'.esc_attr($totalhrsprs).'" data-costtype="'.esc_attr($service->cost_type).'" data-id="'.esc_attr($service->id).'" data-cost="'.esc_attr($service->cost).'">
									<div class="aon-service-name"><h5>'.esc_html($service->service_name).'</h5></div>
									<div class="aon-service-price">'.$perhr.'</div>
									<div class="aon-service-done"><i class="fa fa-check"></i></div>
								</div>
								'.$addhours.'
							</div>';				
					}
				}	
			  ?>
          </div>
          <?php }?>  
        <div class="col-md-12">
          <div class="form-group">
          <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <input type="button" class="btn btn-primary center-block" data-action="login" data-redirect="no" data-toggle="modal" value="<?php esc_html_e('Continue...', 'service-finder'); ?>" data-target="#login-Modal">
          <?php }else{ ?>  
	        <input name="save-zipcodes" id="save-zipcodes" type="button" value="<?php esc_html_e('Continue...', 'service-finder'); ?>" class="btn btn-primary center-block"> 
          <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Step 2-->
  <div id="panel-2" class="padding-20 clearfix margin-b-30  bg-white sf-rouned-box">
    <div class="form-step-bx padding-lr-20">
      <h6 class="mainheading"><strong>2.</strong>
        <?php echo (!empty($service_finder_options['label-date-time'])) ? esc_html($service_finder_options['label-date-time']) : esc_html__('Choose Date & Time', 'service-finder'); ?>
      </h6>
      <div class="panel-summary"></div>
      <div class="clearfix f-row hidden">
        <div class="col-md-12">
          <div id="my-calendar"></div>
        </div>
        <div class="col-md-12">
          <ul class="indiget-booking">
            <li class="allbooked"><b></b>
              <?php esc_html_e('All Booked', 'service-finder'); ?>
            </li>
            <li class="unavailable"><b></b>
              <?php esc_html_e('Unavailable', 'service-finder'); ?>
            </li>
          </ul>
        </div>
        <?php
                                        if(!empty($userCap)){
										if(in_array('availability',$userCap) && in_array('bookings',$userCap)){
										?>
        <div class="col-md-12">
          <ul class="timeslots timelist list-inline">
            <span class="notavail">
              <?php esc_html_e('Please select date to show timeslot.', 'service-finder'); ?>
            </span>
          </ul>
        </div>
        <?php 
										}
										}
										?>
        <?php
                                        if(!empty($userCap)){
										if(in_array('staff-members',$userCap) && in_array('bookings',$userCap)){
										if($settings['members_available'] == 'yes'){
										?>
        <div class="col-md-12" id="members"> </div>
        <?php 
										}
										}
										} 
										?>
        <div class="col-md-12">
          <div class="form-group">
            <input name="save-timeslot" id="save-timeslot" type="button" value="<?php esc_html_e('Continue...', 'service-finder'); ?>" class="btn btn-primary center-block">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Step 3-->
  <div id="panel-3" class="padding-20 clearfix margin-b-30  bg-white sf-rouned-box">
    <div class="form-step-bx padding-lr-20">
      <h6><strong>3.</strong>
        <?php echo (!empty($service_finder_options['label-customer-info'])) ? esc_html($service_finder_options['label-customer-info']) : esc_html__('Customer info', 'service-finder'); ?>
      </h6>
      <div class="clearfix f-row hidden">
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('First Name', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-user"></i>
              <input name="firstname" id="firstname" type="text" class="form-control" value="<?php echo esc_attr($userInfo['fname']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Last Name', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-user"></i>
              <input name="lastname" id="lastname" type="text" class="form-control" value="<?php echo esc_attr($userInfo['lname']) ?>">
            </div>
          </div>
        </div>
        <div class=" <?php echo ($show_booking_otp) ? 'col-md-6' : 'col-md-12'; ?>">
          <div class="form-group">
            <label>
            <?php esc_html_e('Email', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-envelope"></i>
              <input id="email" name="email" type="text" class="form-control" value="<?php echo esc_attr($userInfo[0]->user_email) ?>">
            </div>
          </div>
        </div>
        <?php if($show_booking_otp){ ?>
        <div class="col-md-6">
          <div class="form-group otp-section">
            <label>
            <?php esc_html_e('One Time Password', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-lock"></i>
              <input id="fillotp" name="fillotp" type="text" class="form-control" value="">
            </div>
            <a href="javascript:;" class="otp">
            <?php esc_html_e('Generate One time Password to Confirm Email', 'service-finder'); ?>
            </a> </div>
        </div>
        <?php } ?>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Phone', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-phone"></i>
              <input id="phone" name="phone" type="text" class="form-control" value="<?php echo esc_attr($userInfo['phone']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Alt. Phone', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-phone"></i>
              <input name="phone2" id="phone2" type="text" class="form-control" value="<?php echo (!empty($userInfo['phone2'])) ? esc_attr($userInfo['phone2']) : '' ?>">
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="form-group">
            <label>
            <?php esc_html_e('Address', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-globe"></i>
              <input id="booking-address" name="address" type="text" class="form-control" value="<?php echo esc_attr($userInfo['address']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label>
            <?php esc_html_e('Apt/Suite #', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-building-o"></i>
              <input name="apt" id="apt" type="text" class="form-control" value="<?php echo esc_attr($userInfo['apt']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('City', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
              <input id="bookingcity" name="city" type="text" class="form-control" value="<?php echo esc_attr($userInfo['city']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('State', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
              <input id="bookingstate" name="state" type="text" class="form-control" value="<?php echo esc_attr($userInfo['state']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>
            <?php esc_html_e('Country', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fa fa-map-marker"></i>
              <input id="bookingcountry" name="country" type="text" class="form-control" value="<?php echo esc_attr($userInfo['country']) ?>">
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>
            <?php esc_html_e('Describe Your Task', 'service-finder'); ?>
            </label>
            <div class="input-group"> <span class="input-group-addon v-align-t"><i class="fa fa-pencil"></i></span>
              <textarea id="shortdesc" name="shortdesc" class="form-control" placeholder="<?php esc_html_e('Please insert short description of your task', 'service-finder'); ?>"><?php echo (is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer' && $jobid > 0 && $jobauthor == $current_user->ID) ? strip_tags($jobpost->post_content) : ''; ?></textarea>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <input name="save-cusinfo" id="save-cusinfo" type="button" value="<?php esc_html_e('Continue...', 'service-finder'); ?>" class="btn btn-primary center-block">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Step 4 if booking option is paid-->
  <?php if($settings['booking_option'] == 'paid' && $paid_booking){ ?>
  <div id="panel-4" class="padding-20 clearfix margin-b-30  bg-white sf-rouned-box">
    <div class="form-step-bx padding-lr-20">
      <h6><strong>4.</strong>
        <?php echo (!empty($service_finder_options['label-payment'])) ? esc_html($service_finder_options['label-payment']) : esc_html__('Payment', 'service-finder'); ?>
      </h6>
      <div class="panel-summary"></div>
      <div class="clearfix f-row hidden">
      <?php echo $showadminfee; ?>
        <div class="col-md-12">
          <div class="form-group form-inline">
            <div class="col-md-12">
              <div class="form-group form-inline sf-card-group">
                <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['paypal']){
						$checkpaypal = true;
					}else{
						$checkpaypal = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('paypal',$settings['paymentoption'])){
						$checkpaypal = true;
					}else{
						$checkpaypal = false;
					}
					}else{
						$checkpaypal = false;
					}
				  }
				  
				  if($checkpaypal){ 
				  ?>
                <div class="radio">
                  <input type="radio" value="paypal" name="bookingpayment_mode" id="paymentviapaypal" >
                  <label for="paymentviapaypal"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/paypal.jpg" alt="'.esc_html__('paypal','service-finder').'">'; ?></label>
                </div>
                <?php } ?>
                <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['stripe']){
						$checkstripe = true;
					}else{
						$checkstripe = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
				  	if(in_array('stripe',$settings['paymentoption'])){
						$checkstripe = true;
					}else{
						$checkstripe = false;
					}
					}else{
						$checkstripe = false;
					}
				  }
				  
				  if($checkstripe){
				  ?>
                <div class="radio">
                  <input type="radio" value="stripe" name="bookingpayment_mode" id="paymentviastripe">
                  <label for="paymentviastripe"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/mastercard.jpg" alt="'.esc_html__('mastercard','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/payment.jpg" alt="'.esc_html__('american express','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/discover.jpg" alt="'.esc_html__('discover','service-finder').'"><img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/visa.jpg" alt="'.esc_html__('visa','service-finder').'">'; ?></label>
                </div>
                <?php } ?>
                
                <?php  
				$checktwocheckout = '';	
				  if($pay_booking_amount_to == 'admin'){
				  	if(isset($payment_methods['twocheckout'])){
					if($payment_methods['twocheckout']){
						$checktwocheckout = true;
					}else{
						$checktwocheckout = false;
					}
					}else{
						$checktwocheckout = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('twocheckout',$settings['paymentoption'])){
						$checktwocheckout = true;
					}else{
						$checktwocheckout = false;
					}
					}else{
						$checktwocheckout = false;
					}
				  }
				  
				  if($checktwocheckout){
				  ?>
                <div class="radio">
                  <input type="radio" value="twocheckout" name="bookingpayment_mode" id="paymentviatwocheckout">
                  <label for="paymentviatwocheckout"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/twocheckout.jpg" alt="'.esc_html__('2Checkout','service-finder').'">'; ?></label>
                </div>
                <?php } ?>
                
                <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['wired']){
						$checkwired = true;
					}else{
						$checkwired = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('wired',$settings['paymentoption'])){
						$checkwired = true;
					}else{
						$checkwired = false;
					}
					}else{
						$checkwired = false;
					}
				  }
				  
				  if($checkwired){
				  ?>
                  <div class="radio">
                    <input type="radio" value="wired" name="bookingpayment_mode" id="paymentviawired">
                    <label for="paymentviawired"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/wired.jpg" alt="'.esc_html__('Wire Transfer','service-finder').'">'; ?></label>
                  </div>
                  <?php } ?>
                  
                  <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['payumoney']){
						$checkpayumoney = true;
					}else{
						$checkpayumoney = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('payumoney',$settings['paymentoption'])){
						$checkpayumoney = true;
					}else{
						$checkpayumoney = false;
					}
					}else{
						$checkpayumoney = false;
					}
				  }
				  
				  if($checkpayumoney){
				  ?>
                  <div class="radio">
                    <input type="radio" value="payumoney" name="bookingpayment_mode" id="paymentviapayumoney">
                    <label for="paymentviapayumoney"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/payumoney.jpg" alt="'.esc_html__('PayU Money','service-finder').'">'; ?></label>
                  </div>
                  <?php } ?>
                  
                  <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['payulatam']){
						$checkpayulatam = true;
					}else{
						$checkpayulatam = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('payulatam',$settings['paymentoption'])){
						$checkpayulatam = true;
					}else{
						$checkpayulatam = false;
					}
					}else{
						$checkpayulatam = false;
					}
				  }
				  
				  if($checkpayulatam){
				  ?>
                  <div class="radio">
                    <input type="radio" value="payulatam" name="bookingpayment_mode" id="paymentviapayulatam">
                    <label for="paymentviapayulatam"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/payulatam.jpg" alt="'.esc_html__('PayU Latam','service-finder').'">'; ?></label>
                  </div>
                  <?php } ?>
                  <?php  
				  if($pay_booking_amount_to == 'admin'){
				  	if($payment_methods['cod']){
						$checkcod = true;
					}else{
						$checkcod = false;
					}
				  }elseif($pay_booking_amount_to == 'provider'){
				  	if(!empty($settings['paymentoption'])){
					if(in_array('cod',$settings['paymentoption'])){
						$checkcod = true;
					}else{
						$checkcod = false;
					}
					}else{
						$checkcod = false;
					}
				  }
				  
				  if($checkcod){ 
				  ?>
                <div class="radio">
                  <input type="radio" value="cod" name="bookingpayment_mode" id="paymentviacod" >
                  <label for="paymentviacod"><?php echo '<img src="'.SERVICE_FINDER_BOOKING_IMAGE_URL.'/payment/cod.jpg" alt="'.esc_html__('Cash on Delevery','service-finder').'">'; ?></label>
                </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div id="bookingcardinfo" class="default-hidden">
          <div class="col-md-8">
            <div class="form-group">
              <label>
              <?php esc_html_e('Card Number', 'service-finder'); ?>
              </label>
              <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                <input type="text" id="card_number" name="card_number" class="form-control">
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>
              <?php esc_html_e('CVC', 'service-finder'); ?>
              </label>
              <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                <input type="text" id="card_cvc" name="card_cvc" class="form-control">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group has-select">
              <label>
              <?php esc_html_e('Select Month', 'service-finder'); ?>
              </label>
              <select id="card_month" name="card_month" class="form-control" title="Select Month">
               	  <option value="1"><?php echo esc_html__('January', 'service-finder') ?></option>
                  <option value="2"><?php echo esc_html__('February', 'service-finder')?></option>
                  <option value="3"><?php echo esc_html__('March', 'service-finder')?></option>
                  <option value="4"><?php echo esc_html__('April', 'service-finder')?></option>
                  <option value="5"><?php echo esc_html__('May', 'service-finder')?></option>
                  <option value="6"><?php echo esc_html__('June', 'service-finder')?></option>
                  <option value="7"><?php echo esc_html__('July', 'service-finder')?></option>
                  <option value="8"><?php echo esc_html__('August', 'service-finder')?></option>
                  <option value="9"><?php echo esc_html__('September', 'service-finder')?></option>
                  <option value="10"><?php echo esc_html__('October', 'service-finder')?></option>
                  <option value="11"><?php echo esc_html__('November', 'service-finder')?></option>
                  <option value="12"><?php echo esc_html__('December', 'service-finder')?></option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group has-select">
              <label>
              <?php esc_html_e('Select Year', 'service-finder'); ?>
              </label>
              <select id="card_year" name="card_year" class="form-control"  title="Select Year">
                <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.esc_attr($i).'">'.$i.'</option>';
											}
											?>
              </select>
            </div>
          </div>
        </div>
        <div id="bookingtwocheckoutcardinfo" class="default-hidden">
            <div class="col-md-8">
              <div class="form-group">
                <label>
                <?php esc_html_e('Card Number', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                  <input type="text" id="twocheckout_card_number" name="twocheckout_card_number" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>
                <?php esc_html_e('CVC', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                  <input type="text" id="twocheckout_card_cvc" name="twocheckout_card_cvc" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-select">
                <label>
                <?php esc_html_e('Select Month', 'service-finder'); ?>
                </label>
                <select id="twocheckout_card_month" name="twocheckout_card_month" class="form-control" title="Select Month">
                  <option value="1"><?php echo esc_html__('January', 'service-finder') ?></option>
                  <option value="2"><?php echo esc_html__('February', 'service-finder')?></option>
                  <option value="3"><?php echo esc_html__('March', 'service-finder')?></option>
                  <option value="4"><?php echo esc_html__('April', 'service-finder')?></option>
                  <option value="5"><?php echo esc_html__('May', 'service-finder')?></option>
                  <option value="6"><?php echo esc_html__('June', 'service-finder')?></option>
                  <option value="7"><?php echo esc_html__('July', 'service-finder')?></option>
                  <option value="8"><?php echo esc_html__('August', 'service-finder')?></option>
                  <option value="9"><?php echo esc_html__('September', 'service-finder')?></option>
                  <option value="10"><?php echo esc_html__('October', 'service-finder')?></option>
                  <option value="11"><?php echo esc_html__('November', 'service-finder')?></option>
                  <option value="12"><?php echo esc_html__('December', 'service-finder')?></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-select">
                <label>
                <?php esc_html_e('Select Year', 'service-finder'); ?>
                </label>
                <select id="twocheckout_card_year" name="twocheckout_card_year" class="form-control"  title="Select Year">
                  <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
											?>
                </select>
              </div>
            </div>
          </div>
        <div id="bookingpayulatamcardinfo" class="default-hidden">
            <div class="col-md-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Select Card', 'service-finder'); ?>
                </label>
                <select id="payulatam_cardtype" name="payulatam_cardtype" class="form-control"  title="<?php esc_html_e('Select Card', 'service-finder'); ?>">
                  <?php
				  $country = (isset($service_finder_options['payulatam-country'])) ? $service_finder_options['payulatam-country'] : '';
				  $cards = service_finder_get_cards($country);
				  foreach($cards as $card){
				  	echo '<option value="'.esc_attr($card).'">'.$card.'</option>';
				  }
                                            
											?>
                </select>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>
                <?php esc_html_e('Card Number', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                  <input type="text" id="payulatam_card_number" name="payulatam_card_number" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>
                <?php esc_html_e('CVC', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                  <input type="text" id="payulatam_card_cvc" name="payulatam_card_cvc" class="form-control">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-select">
                <label>
                <?php esc_html_e('Select Month', 'service-finder'); ?>
                </label>
                <select id="payulatam_card_month" name="payulatam_card_month" class="form-control" title="<?php esc_html_e('Select Month', 'service-finder'); ?>">
                  <option value="01"><?php echo esc_html__('January', 'service-finder') ?></option>
                  <option value="02"><?php echo esc_html__('February', 'service-finder')?></option>
                  <option value="03"><?php echo esc_html__('March', 'service-finder')?></option>
                  <option value="04"><?php echo esc_html__('April', 'service-finder')?></option>
                  <option value="05"><?php echo esc_html__('May', 'service-finder')?></option>
                  <option value="06"><?php echo esc_html__('June', 'service-finder')?></option>
                  <option value="07"><?php echo esc_html__('July', 'service-finder')?></option>
                  <option value="08"><?php echo esc_html__('August', 'service-finder')?></option>
                  <option value="09"><?php echo esc_html__('September', 'service-finder')?></option>
                  <option value="10"><?php echo esc_html__('October', 'service-finder')?></option>
                  <option value="11"><?php echo esc_html__('November', 'service-finder')?></option>
                  <option value="12"><?php echo esc_html__('December', 'service-finder')?></option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group has-select">
                <label>
                <?php esc_html_e('Select Year', 'service-finder'); ?>
                </label>
                <select id="payulatam_card_year" name="payulatam_card_year" class="form-control"  title="<?php esc_html_e('Select Year', 'service-finder'); ?>">
                  <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.$i.'">'.$i.'</option>';
											}
											?>
                </select>
              </div>
            </div>
          </div>
        <div id="wiredinfo" class="default-hidden">
            <div class="col-md-12">
            	<?php
                $pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? $service_finder_options['pay_booking_amount_to'] : '';
				if($pay_booking_amount_to == 'admin'){
				$description = (!empty($service_finder_options['wire-transfer-description'])) ? $service_finder_options['wire-transfer-description'] : '';
				echo $description;
				}elseif($pay_booking_amount_to == 'provider'){
				echo (!empty($settings['wired_description'])) ? $settings['wired_description'] : '';
				}
				?>
            </div>
          </div>
        <?php if($checkpaypal || $checkwired || $checktwocheckout || $checkstripe || $checkpayumoney || $checkcod){ ?>  
        <div class="col-md-12">
          <div class="form-group">
            <input name="book-now" id="save-booking" type="submit" value="<?php esc_html_e('Pay Now', 'service-finder'); ?>" class="btn btn-primary center-block">
          </div>
        </div>
        <?php }else{
		echo '<p>';
		echo esc_html__('There is no payment method available.','service-finder');
		echo '</p>';
		} ?>
      </div>
    </div>
  </div>
  <?php } ?>
  <input type="hidden" id="provider" name="provider" data-provider="<?php echo esc_attr($author) ?>" value="<?php echo esc_attr($author) ?>" />
  <input type="hidden" id="provider" name="jobid" value="<?php echo esc_attr($jobid) ?>" />
  <input type="hidden" id="boking-slot" data-slot="" name="boking-slot" value="" />
  <input type="hidden" id="memberid" data-memid="" name="memberid" value="" />
  <input type="hidden" id="totalcost" name="totalcost" value="" />
  <input type="hidden" id="servicearr" name="servicearr" value="" />
  <input type="hidden" name="jobid" value="<?php echo esc_attr($jobid) ?>" />
  <input type="hidden" id="selecteddate" data-seldate="" name="selecteddate" />
</form>
<!--Book Now Form Template End Version 1-->
