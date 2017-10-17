<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
$service_finder_options = get_option('service_finder_options');
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');

if(service_finder_getUserRole($current_user->ID) == 'Provider'){
$userInfo = service_finder_getCurrentUserInfo();
}else{
$userInfo = service_finder_getUserInfo($globalproviderid);
}

$user_info = get_user_by('ID',$globalproviderid);
$user_email = $user_info->user_email;

$userCap = service_finder_get_capability($globalproviderid);
$url = str_replace('/','\/',$service_finder_Params['homeUrl']);
$adminajaxurl = str_replace('/','\/',admin_url('admin-ajax.php'));
$hiddenclass = '';
$settings = service_finder_getProviderSettings($globalproviderid);

$payment_methods = (!empty($service_finder_options['payment-methods'])) ? $service_finder_options['payment-methods'] : '';

$google_calendar = (!empty($settings['google_calendar'])) ? $settings['google_calendar'] : '';
$paymentoption = (!empty($settings['paymentoption'])) ? $settings['paymentoption'] : '';
$booking_process = (!empty($settings['booking_process'])) ? $settings['booking_process'] : '';
$availability_based_on = (!empty($settings['availability_based_on'])) ? $settings['availability_based_on'] : '';
$booking_option = (!empty($settings['booking_option'])) ? $settings['booking_option'] : '';
$booking_assignment = (!empty($settings['booking_assignment'])) ? $settings['booking_assignment'] : '';
$members_available = (!empty($settings['members_available'])) ? $settings['members_available'] : '';
$booking_charge_on_service = (!empty($settings['booking_charge_on_service'])) ? $settings['booking_charge_on_service'] : '';
$booking_basedon = (!empty($settings['booking_basedon'])) ? $settings['booking_basedon'] : '';
$mincost = (isset($settings['mincost'])) ? $settings['mincost'] : '';
$paypalusername = (!empty($settings['paypalusername'])) ? $settings['paypalusername'] : '';
$paypalpassword = (!empty($settings['paypalpassword'])) ? $settings['paypalpassword'] : '';
$paypalsignatue = (!empty($settings['paypalsignatue'])) ? $settings['paypalsignatue'] : '';
$stripesecretkey = (!empty($settings['stripesecretkey'])) ? $settings['stripesecretkey'] : '';
$stripepublickey = (!empty($settings['stripepublickey'])) ? $settings['stripepublickey'] : '';
$wired_description = (!empty($settings['wired_description'])) ? $settings['wired_description'] : '';
$wired_instructions = (!empty($settings['wired_instructions'])) ? $settings['wired_instructions'] : '';
$twocheckoutaccountid = (!empty($settings['twocheckoutaccountid'])) ? $settings['twocheckoutaccountid'] : '';
$twocheckoutpublishkey = (!empty($settings['twocheckoutpublishkey'])) ? $settings['twocheckoutpublishkey'] : '';
$twocheckoutprivatekey = (!empty($settings['twocheckoutprivatekey'])) ? $settings['twocheckoutprivatekey'] : '';
$payumoneymid = (!empty($settings['payumoneymid'])) ? $settings['payumoneymid'] : '';
$payumoneykey = (!empty($settings['payumoneykey'])) ? $settings['payumoneykey'] : '';
$payumoneysalt = (!empty($settings['payumoneysalt'])) ? $settings['payumoneysalt'] : '';
$payulatammerchantid = (!empty($settings['payulatammerchantid'])) ? $settings['payulatammerchantid'] : '';
$payulatamapilogin = (!empty($settings['payulatamapilogin'])) ? $settings['payulatamapilogin'] : '';
$payulatamapikey = (!empty($settings['payulatamapikey'])) ? $settings['payulatamapikey'] : '';
$payulatamaccountid = (!empty($settings['payulatamaccountid'])) ? $settings['payulatamaccountid'] : '';

$pay_booking_amount_to = (!empty($service_finder_options['pay_booking_amount_to'])) ? esc_html($service_finder_options['pay_booking_amount_to']) : '';

$bankaccount_info_section = (isset($service_finder_options['bank-account-info-section'])) ? esc_html($service_finder_options['bank-account-info-section']) : '';

$adminavailabilitybasedon = (!empty($service_finder_options['availability-based-on'])) ? esc_html($service_finder_options['availability-based-on']) : '';

$paid_booking = (!empty($service_finder_options['paid-booking'])) ? $service_finder_options['paid-booking'] : '';

$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';
$restrictmyaccount = (isset($service_finder_options['restrict-my-account'])) ? esc_attr($service_finder_options['restrict-my-account']) : '';

$signupautosuggestion = (!empty($service_finder_options['signup-auto-suggestion'])) ? esc_html($service_finder_options['signup-auto-suggestion']) : '';

$identityapproved = $userInfo['identity'];
$attachmentIDs = service_finder_get_identity($globalproviderid);
if(!empty($attachmentIDs)){
$identityupload = 'yes';
}else{
$identityupload = 'no';
}

wp_add_inline_script( 'bootstrap', 'jQuery(document).ready(function($) {
var identitycheckfeature = "'.$identitycheck.'";
var restrictmyaccount = "'.$restrictmyaccount.'";
var identityapproved = "'.$identityapproved.'";
var identityupload = "'.$identityupload.'";

if(identitycheckfeature > 0 && identityupload == "no"){
       jQuery("#identityCheck").modal({

            backdrop: "static",

            keyboard: false

        });
}
})', 'after' );

wp_add_inline_script( 'map', '/*Declare global variable*/
var signupautosuggestion = "'.$signupautosuggestion.'";
', 'after' );

wp_add_inline_script( 'service_finder-js-form-submit', '/*Declare global variable*/
var signupautosuggestion = "'.$signupautosuggestion.'";
', 'after' );
?>
<!--Provider Profile Settings Template-->

<h4>
  <?php echo (!empty($service_finder_options['label-profile-settings'])) ? esc_html($service_finder_options['label-profile-settings']) : esc_html__('Profile Settings', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <form class="pro-setting user-update" method="post">
  <div id="submit-fixed" class="sf-submit-my-profile">
  	<input type="submit" class="btn btn-primary margin-r-10" name="update-profile" value="<?php esc_html_e('Submit information', 'service-finder'); ?>" />
  </div>
  <div class="text-right padding-b-30 sf-check-my-profile">
  <a href="<?php echo esc_js(service_finder_get_author_url($globalproviderid)); ?>" class="btn btn-primary"><i class="fa fa-user"></i> <?php esc_html_e('My Profile', 'service-finder'); ?></a>
  <?php if ( class_exists( 'WP_Job_Manager_Alerts' ) ) { ?>
  <a href="<?php echo esc_url(service_finder_get_url_by_shortcode('[job_alerts')); ?>" class="btn btn-primary"><i class="fa fa-bell"></i>  <?php esc_html_e('Job Alerts', 'service-finder'); ?></a>
  <?php if(service_finder_getUserRole($current_user->ID) == 'administrator'){ 
  if(get_user_meta($globalproviderid,'claimbusiness',true) == 'enable'){
  $claimstatus = 'disable';
  $claimstring = esc_html__('Disable Claim Business', 'service-finder');
  }else{
  $claimstatus = 'enable';
  $claimstring = esc_html__('Enable Claim Business', 'service-finder');
  }
  ?>
  <a href="javascript:;" class="btn btn-primary claimbusinessaction" data-providerid="<?php echo esc_attr($globalproviderid); ?>" data-status="<?php echo esc_attr($claimstatus); ?>"><i class="fa fa-briefcase"></i> <?php echo esc_html($claimstring); ?></a>
  <?php } ?>
  <?php } ?>
  </div>
    <div class="auther-pic-text form-inr clearfix">
      <!--Avatar Upload-->
      <div class="profile-pic-bx">
        <div class="rwmb-field rwmb-plupload_image-wrapper">
          <div class="rwmb-input">
            <ul class="rwmb-images rwmb-uploaded" data-field_id="plavatarupload" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="1">
              <?php
				if(!empty($userInfo['avatar_id']) && $userInfo['avatar_id'] > 0){
					$src  = wp_get_attachment_image_src( $userInfo['avatar_id'], 'thumbnail' );
					$src  = $src[0];
					$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
					$hiddenclass = 'hidden';
					
					$html = sprintf('<li id="item_%s">
					<img src="%s" />
					<div class="rwmb-image-bar">
						<a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
						<input type="hidden" name="plavatar" value="%s">
					</div>
				</li>',
				esc_attr($userInfo['avatar_id']),
				esc_url($src),
				esc_attr($i18n_delete), esc_attr($userInfo['avatar_id']),
				esc_attr($userInfo['avatar_id'])
				);
					echo $html;	
				}
				?>
            </ul>
            <div id="plavatarupload-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files <?php echo esc_attr($hiddenclass); ?>" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;plavatarupload-browse-button&quot;,&quot;drop_element&quot;:&quot;plavatarupload-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($adminajaxurl); ?>&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed Image Files&quot;,&quot;extensions&quot;:&quot;jpg,jpeg,gif,png&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;plavatarupload&quot;,&quot;action&quot;:&quot;avatar_upload&quot;}}">
              <div class = "drag-drop-inside text-center"> <img src="<?php echo esc_url($service_finder_Params['pluginImgUrl'].'/no_img.jpg'); ?>">
                <p class="drag-drop-info">
                  <?php esc_html_e('Drop avatar here', 'service-finder'); ?>
                </p>
                <p><?php esc_html_e('or', 'service-finder'); ?></p>
                <p class="drag-drop-buttons">
                  <input id="plavatarupload-browse-button" type="button" value="<?php esc_html_e('Select Image', 'service-finder'); ?>" class="button btn btn-primary" />
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="profile-text-bx">
        <p><em>
          <?php esc_html_e('Update your avatar manually,If not set, the default Gravatar will be the same as your login email/user account.', 'service-finder'); ?>
          </em></p>
        <ul class="auther-limit list-unstyled">
          <li><strong>
            <?php esc_html_e('Max Upload Size', 'service-finder'); ?>
            :</strong> 1MB</li>
          <li><strong>
            <?php esc_html_e('Dimensions', 'service-finder'); ?>
            :</strong> 300x350</li>
          <li><strong>
            <?php esc_html_e('Extensions', 'service-finder'); ?>
            :</strong> JPEG,PNG</li>
        </ul>
      </div>
    </div>
    <div class="panel-group">
      <!--About Me Section-->
      <div class="panel panel-default about-me-here">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('About me', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Company Name', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-user"></i>
                  <input type="text" class="form-control" name="company_name" value="<?php echo esc_attr($userInfo['company_name']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('First Name', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-user"></i>
                  <input type="text" class="form-control" name="first_name" value="<?php echo esc_attr($userInfo['fname']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Last Name', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-user"></i>
                  <input type="text" class="form-control" name="last_name" value="<?php echo esc_attr($userInfo['lname']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('TagLine', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-user"></i>
                  <input name="tagline" type="text" class="form-control" value="<?php echo esc_attr($userInfo['tagline']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Biography', 'service-finder'); ?>
                </label>
                  <?php 
				  $settings = array( 
									'editor_height' => '100px',
									'textarea_name' => 'bio',
								);

				  wp_editor( wp_unslash($userInfo['bio']), 'bio', $settings );
				  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Contact Details Section-->
      <div class="panel panel-default contact-details">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Contact Detail', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Landline', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-phone"></i>
                  <input type="text" class="form-control" name="phone" value="<?php echo esc_attr($userInfo['phone']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Mobile', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-mobile font-size-20"></i>
                  <input type="text" class="form-control" name="mobile" value="<?php echo esc_attr($userInfo['mobile']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Email Address', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
                  <input type="text" class="form-control" name="user_email" value="<?php echo esc_attr($user_email) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Skype', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-skype"></i>
                  <input type="text" class="form-control" name="skypeid" value="<?php echo esc_attr($userInfo['skypeid']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Website', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-globe"></i>
                  <input type="text" class="form-control" name="website" value="<?php echo esc_attr($userInfo['website']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Fax', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-fax"></i>
                  <input type="text" class="form-control" name="fax" value="<?php echo esc_attr($userInfo['fax']) ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Address Section-->
      <div class="panel panel-default address-here">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Address', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class=" col-md-12 rwmb-field rwmb-map-wrapper checkbox-condition show">
              <div class="rwmb-label">
                <label for="location">
                <?php esc_html_e('Location', 'service-finder'); ?>
                </label>
              </div>
              <div class="rwmb-input margin-b-30">
                <div class="rwmb-map-field">
                  <div class="rwmb-map-canvas margin-b-30" data-default-loc=""></div>
                  <input type="hidden" name="location" class="rwmb-map-coordinate" value="">
                  <?php 
				  if($signupautosuggestion){
				  	$fieldval = 'address';
				  }else{
				  	$fieldval = '';
				  }
				   ?>
                  <button class="button rwmb-map-goto-address-button btn btn-primary" value="<?php echo esc_attr($fieldval); ?>">
                  <?php esc_html_e('Find Address on Map', 'service-finder'); ?>
                  </button>
                  <p><?php esc_html_e('Note: This will load your address on map and fillup latitude and longitude', 'service-finder'); ?></p>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Address', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-globe"></i>
                  <input type="text" class="form-control" placeholder="<?php esc_html_e('Please enter only address', 'service-finder'); ?>" name="address" id="address" value="<?php echo esc_attr(stripcslashes($userInfo['address'])) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Apt/Suite #', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-map-marker"></i>
                  <input type="text" class="form-control" name="apt" id="apt" value="<?php echo esc_attr($userInfo['apt']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group city-outer-bx">
                <label>
                <?php esc_html_e('City', 'service-finder'); ?>
                </label>
                <div class="input-group" id="cityautosuggestion"> <i class="input-group-addon fixed-w fa fa-map-marker"></i>
                  <?php if($signupautosuggestion){ ?>
                  <input type="text" class="form-control" name="city" id="city" value="<?php echo esc_attr($userInfo['city']) ?>">
                  <?php }else{ ?>
                  <select class="form-control" name="city" data-live-search="true" title="<?php esc_html_e('Select City', 'service-finder'); ?>" id="city">
                  <?php
				  $selectedcountry = (!empty($userInfo['country'])) ? esc_html($userInfo['country']) : '';
                  $cities = service_finder_get_cities($selectedcountry);
                  if(!empty($cities)){
                    foreach($cities as $city){
						if($userInfo['city'] == $city->cityname){
						$select = 'selected="selected"';
						}else{
						$select = '';
						}
                        echo '<option '.$select.' value="'.esc_attr($city->cityname).'">'.$city->cityname.'</option>';
                    }
                  }
                  ?>
                  </select>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('State', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-map-marker"></i>
                  <input type="text" class="form-control" name="state" id="state" value="<?php echo esc_attr($userInfo['state']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Postal Code', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-map-marker"></i>
                  <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?php echo esc_attr($userInfo['zipcode']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Country', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-map-marker"></i>
                  <select class="form-control" name="country" id="<?php echo ($signupautosuggestion) ? 'country' : 'customcountry'; ?>" data-live-search="true" title="<?php esc_html_e('Country', 'service-finder'); ?>">
                    <option value="">
                    <?php esc_html_e('Select Country', 'service-finder'); ?>
                    </option>
                    <?php
                    $selectedcountry = (!empty($userInfo['country'])) ? esc_html($userInfo['country']) : '';
                    $allcountry = (!empty($service_finder_options['all-countries'])) ? $service_finder_options['all-countries'] : '';
                    $countries = service_finder_get_countries();
                    if($allcountry){
                      if(!empty($countries)){
                        foreach($countries as $key => $country){
                            if($selectedcountry == $country){
                            $select = 'selected="selected"';
                            }else{
                            $select = '';
                            }
                            echo '<option '.$select.' value="'.esc_attr($country).'" data-code="'.esc_attr($key).'">'. $country.'</option>';
                        }
                      }
                    }else{
                     $countryarr = (!empty($service_finder_options['allowed-country'])) ? $service_finder_options['allowed-country'] : '';
                     if($countryarr){
                        foreach($countryarr as $key){
                            if($selectedcountry == $countries[$key]){
                            $select = 'selected="selected"';
                            }else{
                            $select = '';
                            }
                            echo '<option '.$select.' value="'.esc_attr($countries[$key]).'" data-code="'.esc_attr($key).'">'. $countries[$key].'</option>';
                        }
                     }
                    }
                    ?>
                </select>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Latitude', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-street-view"></i>
                  <input type="text" class="form-control" name="lat" id="lat" value="<?php echo esc_attr($userInfo['lat']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Longitude', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-street-view"></i>
                  <input type="text" class="form-control" name="long" id="long" value="<?php echo esc_attr($userInfo['long']) ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Service to Perform Section-->
      <?php if($service_finder_options['show-address-info']){ ?>
      <div class="panel panel-default service-perform-here">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Service to Perform At', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
          	<div class="col-lg-12">
              <div class="form-group form-inline">
                <div class="radio">
                  <input id="provider_location" type="radio" name="service_perform" value="provider_location" <?php echo ($userInfo['service_perform'] == 'provider_location') ? 'checked' : ''; ?>>
                  <label for="provider_location">
                  <?php esc_html_e('My Location', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="customer_location" type="radio" name="service_perform" value="customer_location" <?php echo ($userInfo['service_perform'] == 'customer_location' || $userInfo['service_perform'] == '') ? 'checked' : ''; ?>>
                  <label for="customer_location">
                  <?php esc_html_e('Customer Location', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="both_location" type="radio" name="service_perform" value="both" <?php echo ($userInfo['service_perform'] == 'both') ? 'checked' : ''; ?>>
                  <label for="both_location">
                  <?php esc_html_e('Both', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-12" id="providerlocation_bx" <?php echo ($userInfo['service_perform'] == 'customer_location' || $userInfo['service_perform'] == '') ? 'style="display:none"' : ''; ?>>
              <div class="form-group">
                <label>
                <?php esc_html_e('My Location', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-street-view"></i>
                  <input type="text" class="form-control" name="my_location" id="my_location" value="<?php echo esc_attr($userInfo['my_location']) ?>">
                </div>
              </div>
              <button id="showmylocation" class="btn btn-primary" data-providerid="<?php echo esc_attr($globalproviderid); ?>" type="button"><i class="fa fa-plus"></i>
				<?php esc_html_e('Set Marker Position', 'service-finder'); ?>
                </button>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <!--Social Media Section-->
      <div class="panel panel-default social-media-here">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Social Media', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Facebook', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-facebook"></i>
                  <input type="text" class="form-control" name="facebook" value="<?php echo esc_attr($userInfo['facebook']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Twitter', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-twitter "></i>
                  <input type="text" class="form-control" name="twitter" value="<?php echo esc_attr($userInfo['twitter']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Linkedin', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-linkedin"></i>
                  <input type="text" class="form-control" name="linkedin" value="<?php echo esc_attr($userInfo['linkedin']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Pinterest', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-pinterest"></i>
                  <input type="text" class="form-control" name="pinterest" value="<?php echo esc_attr($userInfo['pinterest']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Google Plus', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-google-plus"></i>
                  <input type="text" class="form-control" name="google_plus" value="<?php echo esc_attr($userInfo['google_plus']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Digg', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-digg"></i>
                  <input type="text" class="form-control" name="digg" value="<?php echo esc_attr($userInfo['digg']) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Instagram', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-instagram"></i>
                  <input type="text" class="form-control" name="instagram" value="<?php echo esc_attr($userInfo['instagram']) ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Password Update Section-->
      <div class="panel panel-default password-update">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Password Update', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('New Password', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Repeat Password', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="password" class="form-control" name="confirm_password" id="confirm_password">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <p  class="margin-0">
                <?php esc_html_e('Enter same password in both fields. Use an uppercase letter and a number for stronger password.', 'service-finder'); ?>
              </p>
            </div>
          </div>
        </div>
      </div>
      <?php
      if(!empty($userCap)){
		if(in_array('bookings',$userCap)){	
	  ?>
      <!--Booking Settings Section-->
      <div class="panel panel-default paypal-pay">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Booking Settings', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Short Description for Booking', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-pencil v-align-t"></i>
                  <textarea class="form-control" maxlength="200" rows="3" cols="" name="booking_description"><?php echo esc_textarea($userInfo['booking_description']) ?></textarea>
                </div>
              </div>
            </div>
            <div class="col-lg-12" id="bookingalert" <?php echo ($booking_process == 'off' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
                <div class="alert alert-warning">
				  <?php esc_html_e('Please set available times for the booking system to work', 'service-finder'); ?>
                </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Booking Process', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="on" type="radio" name="booking_process" value="on" <?php echo ($booking_process == 'on') ? 'checked' : ''; ?>>
                  <label for="on">
                  <?php esc_html_e('On', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="off" type="radio" name="booking_process" value="off" <?php echo ($booking_process == 'off' || $booking_process == '') ? 'checked' : ''; ?>>
                  <label for="off">
                  <?php esc_html_e('Off', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <?php if($adminavailabilitybasedon == 'both'){ ?>
            <div class="col-lg-6">
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Availability Based On', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="timeslots" type="radio" name="availability_based_on" value="timeslots" <?php echo ($availability_based_on == 'timeslots' || $availability_based_on == '') ? 'checked' : ''; ?>>
                  <label for="timeslots">
                  <?php esc_html_e('Time Slots', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="starttime" type="radio" name="availability_based_on" value="starttime" <?php echo ($availability_based_on == 'starttime') ? 'checked' : ''; ?>>
                  <label for="starttime">
                  <?php esc_html_e('Start Time', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <?php } ?>
            <div class="col-lg-6" id="bookingbasedon" <?php echo ($booking_process == 'off' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Booking Based On', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="basedonzipcode" type="radio" name="booking_basedon" value="zipcode" <?php echo ($booking_basedon == 'zipcode') ? 'checked' : ''; ?>>
                  <label for="basedonzipcode">
                  <?php esc_html_e('Postal Code', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="region" type="radio" name="booking_basedon" value="region" <?php echo ($booking_basedon == 'region') ? 'checked' : ''; ?>>
                  <label for="region">
                  <?php esc_html_e('Region', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="open" type="radio" name="booking_basedon" value="open" <?php echo ($booking_basedon == 'open' || $booking_basedon == '') ? 'checked' : ''; ?>>
                  <label for="open">
                  <?php esc_html_e('Open', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-6" id="bookingchargeamount" <?php echo ($booking_process == 'off' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Booking Amount Charged based on Services', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="charge_on_service_yes" type="radio" name="booking_charge_on_service" value="yes" <?php echo ($booking_charge_on_service == 'yes') ? 'checked' : ''; ?>>
                  <label for="charge_on_service_yes">
                  <?php esc_html_e('Yes', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="charge_on_service_no" type="radio" name="booking_charge_on_service" value="no" <?php echo ($booking_charge_on_service == 'no' || $booking_charge_on_service == '') ? 'checked' : ''; ?>>
                  <label for="charge_on_service_no">
                  <?php esc_html_e('No', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-6" id="bookingOption" <?php echo ($booking_process == 'off' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Profile', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="free" type="radio" name="booking_option" value="free" <?php echo ($booking_option == 'free' || $booking_option == '' || !$paid_booking) ? 'checked' : ''; ?>>
                  <label for="free">
                  <?php esc_html_e('Free Booking', 'service-finder'); ?>
                  </label>
                </div>
                <?php if($paid_booking){ ?>
                <div class="radio">
                  <input id="paid" type="radio" name="booking_option" value="paid" <?php echo ($booking_option == 'paid') ? 'checked' : ''; ?>>
                  <label for="paid">
                  <?php esc_html_e('Paid Booking', 'service-finder'); ?>
                  </label>
                </div>
                <?php } ?>
              </div>
            </div>
            <?php 
														if(!empty($userCap)):
														if(in_array('staff-members',$userCap) && in_array('bookings',$userCap)):		
														?>
            <div class="col-lg-6" id="bookingAssignment" <?php echo ($booking_process == 'off' ||  $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Booking Assignment', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="automatically" type="radio" name="booking_assignment" value="automatically" <?php echo ($booking_assignment == 'automatically') ? 'checked' : ''; ?>>
                  <label for="automatically">
                  <?php esc_html_e('Automatically', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="manually" type="radio" name="booking_assignment" value="manually" <?php echo ($booking_assignment == 'manually' || $booking_assignment == '') ? 'checked' : ''; ?>>
                  <label for="manually">
                  <?php esc_html_e('Manually', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-lg-6" id="membersAvailable" <?php echo ($booking_assignment == 'manually' || $booking_process == 'off' || $booking_assignment == '' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Staff members available at the time of booking', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="yes" type="radio" name="members_available" value="yes" <?php echo ($members_available == 'yes') ? 'checked' : ''; ?>>
                  <label for="yes">
                  <?php esc_html_e('Yes', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="no" type="radio" name="members_available" value="no" <?php echo ($members_available == 'no' || $members_available == '') ? 'checked' : ''; ?>>
                  <label for="no">
                  <?php esc_html_e('No', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <?php 
														endif;
														endif;
														?>
            <div class="col-lg-12" id="minCost" <?php echo ($booking_option == 'free' || !$paid_booking || $booking_process == 'off' || $booking_option == '' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="form-group">
                <label>
                <?php esc_html_e('Minimum Amount (It will be charge at the time of booking)', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-money"></i>
                  <input type="text" class="form-control" name="mincost" value="<?php echo esc_attr($mincost) ?>" placeholder="ex. 0 if no mimimum amount">
                </div>
              </div>
            </div>
            <?php if($pay_booking_amount_to == 'provider'){ ?>
            <div id="payoptions" <?php echo ($booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == '') ? 'style="display: none;"' : ''; ?>>
              <div class="col-lg-12">
                <div class="form-group form-inline">
                  <label>
                  <?php esc_html_e('Payment Method', 'service-finder'); ?>
                  </label>
                  <br>

                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['paypal']){
				  
				  if(!empty($paymentoption)){
						if(in_array('paypal',$paymentoption)){
						$check1 = 'checked="checked"';
						}else{
						$check1 = '';
						}
					}else{
						$check1 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input <?php echo esc_attr($check1); ?> type="checkbox" value="paypal" name="pay_options[]" id="bypaypal">
                    <label for="bypaypal">
                    <?php esc_html_e('Paypal', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['stripe']){
				  
				  if(!empty($paymentoption)){
						if(in_array('stripe',$paymentoption)){
						$check2 = 'checked="checked"';
						}else{
						$check2 = '';
						}
					}else{
						$check2 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo esc_attr($check2); ?> value="stripe" name="pay_options[]" id="bystripe">
                    <label for="bystripe">
                    <?php esc_html_e('Stripe', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                  <?php
                  /*?>if(!empty($payment_methods)){
				  if($payment_methods['twocheckout']){
				  
				  if(!empty($paymentoption)){
						if(in_array('twocheckout',$paymentoption)){
						$check4 = 'checked="checked"';
						}else{
						$check4 = '';
						}
					}else{
						$check4 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo esc_attr($check4); ?> value="twocheckout" name="pay_options[]" id="bytwocheckout">
                    <label for="bytwocheckout">
                    <?php esc_html_e('2Checkout', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }<?php */?>
                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['wired']){
				  
				  if(!empty($paymentoption)){
						if(in_array('wired',$paymentoption)){
						$check3 = 'checked="checked"';
						}else{
						$check3 = '';
						}
					}else{
						$check3 = '';
					}
				  
				  ?>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo esc_attr($check3); ?> value="wired" name="pay_options[]" id="bywire">
                    <label for="bywire">
                    <?php esc_html_e('Wire Transfer', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['payumoney']){
				  
				  if(!empty($paymentoption)){
				  if(in_array('payumoney',$paymentoption)){
						$check5 = 'checked="checked"';
						}else{
						$check5 = '';
						}
					}else{
						$check5 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo esc_attr($check5); ?> value="payumoney" name="pay_options[]" id="bypayumoney">
                    <label for="bypayumoney">
                    <?php esc_html_e('PayU Money', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['payulatam']){
				  
				  if(!empty($paymentoption)){
				  if(in_array('payulatam',$paymentoption)){
						$check6 = 'checked="checked"';
						}else{
						$check6 = '';
						}
					}else{
						$check6 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input type="checkbox" <?php echo esc_attr($check6); ?> value="payulatam" name="pay_options[]" id="bypayulatam">
                    <label for="bypayulatam">
                    <?php esc_html_e('PayU Latam', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                  <?php
                  if(!empty($payment_methods)){
				  if($payment_methods['cod']){
				  
				  if(!empty($paymentoption)){
				  if(in_array('cod',$paymentoption)){
						$check7 = 'checked="checked"';
						}else{
						$check7 = '';
						}
					}else{
						$check7 = '';
					}
				  ?>
                  <div class="checkbox">
                    <input <?php echo esc_attr($check7); ?> type="checkbox" value="cod" name="pay_options[]" id="bycod">
                    <label for="bycod">
                    <?php esc_html_e('Cash on Delevery', 'service-finder'); ?>
                    </label>
                  </div>
                  <?php
                  }
				  }
				  ?>
                </div>
              </div>
            </div>
            <?php
                                                        if(!empty($paymentoption)){
															if(!in_array('paypal',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
															$stybx = 'style="display: none;"';
															}else{
															$stybx = '';
															}
														}else{
															$stybx = 'style="display: none;"';
														}
														?>
            <div id="paypalemail" <?php echo $stybx; ?> >
              <div class="col-lg-6">
                <div class="form-group">
                  <label>
                  <?php esc_html_e('PayPal API Username', 'service-finder'); ?>
                  </label>
                  <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
                    <input type="text" class="form-control" name="paypalusername" value="<?php echo esc_attr($paypalusername) ?>">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>
                  <?php esc_html_e('PayPal API Password', 'service-finder'); ?>
                  </label>
                  <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                    <input type="text" class="form-control" name="paypalpassword" value="<?php echo esc_attr($paypalpassword) ?>">
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label>
                  <?php esc_html_e('PayPal API Signatue', 'service-finder'); ?>
                  </label>
                  <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
                    <input type="text" class="form-control" name="paypalsignatue" value="<?php echo esc_attr($paypalsignatue) ?>">
                  </div>
                </div>
              </div>
            </div>
            <?php
                                                        if(!empty($paymentoption)){
															if(!in_array('stripe',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
															$stybx = 'style="display: none;"';
															}else{
															$stybx = '';
															}
														}else{
															$stybx = 'style="display: none;"';
														}
														?>
            <div id="stripekey" <?php echo $stybx; ?> >
              <div class="col-lg-6">
                <div class="form-group">
                  <label>
                  <?php esc_html_e('Stripe Secret Key', 'service-finder'); ?>
                  </label>
                  <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
                    <input type="text" class="form-control" name="stripesecretkey" value="<?php echo esc_attr($stripesecretkey) ?>">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label>
                  <?php esc_html_e('Stripe Public Key', 'service-finder'); ?>
                  </label>
                  <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
                    <input type="text" class="form-control" name="stripepublickey" value="<?php echo esc_attr($stripepublickey) ?>">
                  </div>
                </div>
              </div>
            </div>
            <?php
			if(!empty($paymentoption)){
				if(!in_array('twocheckout',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
				$stybx = 'style="display: none;"';
				}else{
				$stybx = '';
				}
			}else{
				$stybx = 'style="display: none;"';
			}
			?>
            <div id="twocheckoutkey" <?php echo $stybx; ?> >
            <div class="col-lg-12">
            <div class="form-group">
            <label>
            <?php esc_html_e('2Checkout Account ID', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="twocheckoutaccountid" value="<?php echo esc_attr($twocheckoutaccountid) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('2Checkout Publish Key', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="twocheckoutpublishkey" value="<?php echo esc_attr($twocheckoutpublishkey) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('2Checkout Private Key', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="twocheckoutprivatekey" value="<?php echo esc_attr($twocheckoutprivatekey) ?>">
            </div>
            </div>
            </div>
            </div>
            <?php
			if(!empty($paymentoption)){
				if(!in_array('payumoney',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
				$stybx = 'style="display: none;"';
				}else{
				$stybx = '';
				}
			}else{
				$stybx = 'style="display: none;"';
			}
			?>
            <div id="payumoneyinfo" <?php echo $stybx; ?> >
            <div class="col-lg-12">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Money MID', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payumoneymid" value="<?php echo esc_attr($payumoneymid) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Money Key', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payumoneykey" value="<?php echo esc_attr($payumoneykey) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Money Salt', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payumoneysalt" value="<?php echo esc_attr($payumoneysalt) ?>">
            </div>
            </div>
            </div>
            </div>
            <?php
			if(!empty($paymentoption)){
				if(!in_array('payulatam',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
				$stybx = 'style="display: none;"';
				}else{
				$stybx = '';
				}
			}else{
				$stybx = 'style="display: none;"';
			}
			?>
            <div id="payulataminfo" <?php echo $stybx; ?> >
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Latam Merchant Id', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payulatammerchantid" value="<?php echo esc_attr($payulatammerchantid) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Latam API Login', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payulatamapilogin" value="<?php echo esc_attr($payulatamapilogin) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Latam API Key', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payulatamapikey" value="<?php echo esc_attr($payulatamapikey) ?>">
            </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="form-group">
            <label>
            <?php esc_html_e('PayU Latam Account Id', 'service-finder'); ?>
            </label>
            <div class="input-group"> <i class="input-group-addon fixed-w fa fa-envelope"></i>
            <input type="text" class="form-control" name="payulatamaccountid" value="<?php echo esc_attr($payulatamaccountid) ?>">
            </div>
            </div>
            </div>
            </div>
			<?php
			if(!empty($paymentoption)){
				if(!in_array('wired',$paymentoption) || $booking_option == 'free' || $booking_process == 'off' || $booking_option == '' || $booking_process == ''){
				$stybx = 'style="display: none;"';
				}else{
				$stybx = '';
				}
			}else{
				$stybx = 'style="display: none;"';
			}
			?>
            <div id="wiredescription" <?php echo $stybx; ?> >
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Description for Wired Transfer', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-pencil v-align-t"></i>
                  <textarea class="form-control" maxlength="200" rows="3" cols="" name="wired_description"><?php echo (isset($wired_description)) ? esc_attr($wired_description) : '' ?></textarea>
                </div>
              </div>
            </div>
            </div>
            
            <div id="wireinstructions" <?php echo $stybx; ?> >
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Instructions for Wired Transfer (For Mail Template)', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-pencil v-align-t"></i>
                  <textarea class="form-control" maxlength="200" rows="3" cols="" name="wired_instructions"><?php echo (isset($wired_instructions)) ? esc_attr($wired_instructions) : '' ?></textarea>
                </div>
              </div>
            </div>
            </div>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php 
	  	}
	  }
	  ?>
      <?php
	  if($pay_booking_amount_to == 'admin' && $bankaccount_info_section){
	  ?>
      <!--Back Account Details Section-->
      <div class="panel panel-default password-update">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Bank Account Details', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Bank Account Holder\'s Name', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="bank_account_holder_name" value="<?php echo esc_attr(get_user_meta($globalproviderid,'bank_account_holder_name',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Bank Account Number/IBAN', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="bank_account_number" value="<?php echo esc_attr(get_user_meta($globalproviderid,'bank_account_number',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Swift Code', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="swift_code" value="<?php echo esc_attr(get_user_meta($globalproviderid,'swift_code',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Bank Name in Full', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="bank_name" value="<?php echo esc_attr(get_user_meta($globalproviderid,'bank_name',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Bank Branch City', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="bank_branch_city" value="<?php echo esc_attr(get_user_meta($globalproviderid,'bank_branch_city',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="form-group">
                <label>
                <?php esc_html_e('Bank Branch Country', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="bank_branch_country" value="<?php echo esc_attr(get_user_meta($globalproviderid,'bank_branch_country',true)) ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
      <?php 
	  if(!empty($userCap)){
	  if(in_array('google-calendar',$userCap)){	
	  	require_once SERVICE_FINDER_BOOKING_LIB_DIR.'/google-api-php-client/src/Google/autoload.php';
	    $client_id = get_user_meta($globalproviderid,'google_client_id',true);
		$client_secret = get_user_meta($globalproviderid,'google_client_secret',true);
		$redirect_uri = add_query_arg( array('action' => 'googleoauth-callback'), home_url() );
		$_SESSION['providerid'] = $globalproviderid;
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->setAccessType("offline");
		$client->setScopes('https://www.googleapis.com/auth/calendar');	
		
	  ?>
      <!--Google Calendar Section-->
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Google Calendar Settings', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Google Calendar', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="google_calendar_on" type="radio" name="google_calendar" value="on" <?php echo ($google_calendar == 'on') ? 'checked' : ''; ?>>
                  <label for="google_calendar_on">
                  <?php esc_html_e('On', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="google_calendar_off" type="radio" name="google_calendar" value="off" <?php echo ($google_calendar == 'off' || $google_calendar == '') ? 'checked' : ''; ?>>
                  <label for="google_calendar_off">
                  <?php esc_html_e('Off', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div id="google_calendar_options" <?php echo ($google_calendar != 'on') ? 'style="display: none;"' : ''; ?>>
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Google Client ID', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="google_client_id" value="<?php echo esc_attr(get_user_meta($globalproviderid,'google_client_id',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Google Client Secret', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="google_client_secret" value="<?php echo esc_attr(get_user_meta($globalproviderid,'google_client_secret',true)) ?>">
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
              <?php
			    echo '<a href="javascript:;" class="btn btn-primary margin-r-10 updategcal" data-providerid="'.$globalproviderid.'">'.esc_html__('Update Credentials', 'service-finder').'</a>';
				
			  ?>
              
            </div>
            </div>
            <?php
			$flag = 0;
            if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			  $client->setAccessToken($_SESSION['access_token']);
			  $flag = 1;
			
			} elseif(service_finder_get_gcal_access_token($globalproviderid) != ""){
			  $client->setAccessToken(service_finder_get_gcal_access_token($globalproviderid));
			  $flag = 1;
			}
			 
			if($client->isAccessTokenExpired()) {
				 try{
				 
				 if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				  $newaccesstoken = json_decode($_SESSION['access_token']);
				  $client->refreshToken($newaccesstoken->refresh_token);
				
				 }elseif(service_finder_get_gcal_access_token($globalproviderid) != ""){
				  $newaccesstoken = json_decode(service_finder_get_gcal_access_token($globalproviderid));
				  $client->refreshToken($newaccesstoken->refresh_token);
				 }
				 
				 } catch (Exception $e) {
					
				 }
		
			 }
			?>
            <?php if($flag == 1){ ?>
            <div class="col-lg-12" id="gcallist">
              <div class="form-group">
                <label>
                <?php esc_html_e('Calendar ID', 'service-finder'); ?>
                </label>
                <div class="input-group"> 
                  <select name="google_calendar_id" id="google_calendar_id" title="<?php esc_html_e('Select Calendar ID', 'service-finder'); ?>">
                   	<?php
                    try{
					$service = new Google_Service_Calendar($client);
                    $calendarList = $service->calendarList->listCalendarList();
            		if(!empty($calendarList)){
                    while(true) {
                      foreach ($calendarList->getItems() as $calendarListEntry) {
					  	if(get_user_meta($globalproviderid,'google_calendar_id',true) == $calendarListEntry->id){
							$select = 'selected="selected"';
						}else{
							$select = '';
						}
						echo '<option '.$select.' value="'.$calendarListEntry->id.'">'.$calendarListEntry->getSummary().'</option>';
                      }
                      $pageToken = $calendarList->getNextPageToken();
                      if ($pageToken) {
                        $optParams = array('pageToken' => $pageToken);
                        $calendarList = $service->calendarList->listCalendarList($optParams);
                      } else {
                        break;
                      }
                    } 
					}
					} catch (Exception $e) {
					print_r($e);
					}
					?>
                  </select>
                </div>
              </div>
            </div>
            <?php } ?>
             <div class="col-lg-12">
              <div class="form-group">
              <?php
                if(isset($_SESSION['access_token']) && $_SESSION['access_token']) {
				  $client->setAccessToken($_SESSION['access_token']);
				  echo '<div id="connectbtn"><a href="javascript:;" class="btn btn-primary margin-r-10">'.esc_html__('Already Connected to Google Calendar', 'service-finder').'</a></div>';
				
				} elseif(service_finder_get_gcal_access_token($globalproviderid) != ""){
				  $client->setAccessToken(service_finder_get_gcal_access_token($globalproviderid));
				  echo '<div id="connectbtn"><a href="javascript:;" class="btn btn-primary margin-r-10">'.esc_html__('Already Connected to Google Calendar', 'service-finder').'</a></div>';
				
				}else {
				  $authUrl = $client->createAuthUrl();
				  echo '<div id="connectbtn"><a href="'.esc_url($authUrl).'" class="btn btn-primary margin-r-10">'.esc_html__('Connect to Google Calendar', 'service-finder').'</a></div>';
				}
			  ?>
              
            </div>
            </div>
            </div>
          </div>
        </div> 		
      </div>
      <?php } 
	  }
	  ?>
      <?php 
	  if(!empty($payment_methods)){
	  if($payment_methods['paypal-adaptive']){
	  ?>
      <div class="panel panel-default password-update">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Paypal Account Details', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Paypal Email ID', 'service-finder'); ?>
                </label>
                <div class="input-group"> <i class="input-group-addon fixed-w fa fa-lock"></i>
                  <input type="text" class="form-control" name="paypal_email_id" value="<?php echo esc_attr(get_user_meta($globalproviderid,'paypal_email_id',true)) ?>">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
	  }
	  }
	  ?>
      <!--Category Select Section-->
      <div class="panel panel-default category-drop">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Category', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-lg-12">
              <div class="form-group">
                <label>
                <?php esc_html_e('Category', 'service-finder'); ?>
                </label>
                <div class="input-group">
                <?php 
				$multiple = '';
				if(!empty($userCap)):
					if(in_array('multiple-categories',$userCap)):
						$multiple = 'multiple="multiple"';
					endif;
				endif;
				if(!empty($userInfo['category'])){
				$allcategories = explode(',',$userInfo['category']);
				}else{
				$allcategories[] = $userInfo['category'];
				}

				$primary_category = get_user_meta($globalproviderid,'primary_category',true);
				
				if(!empty($userCap)){
					if(in_array('multiple-categories',$userCap)){
						$package = get_user_meta($globalproviderid,'provider_role',true);
						$packageNum = intval(substr($package, 8));
						$maxcategory = (!empty($service_finder_options['package'.$packageNum.'-multiple-categories'])) ? $service_finder_options['package'.$packageNum.'-multiple-categories'] : '';
					}else{
					$maxcategory = '';
					}
				}else{
					$maxcategory = '';
				}
				?>
                  <select name="category[]" id="category" <?php echo esc_attr($multiple);?> data-primaryid="<?php echo esc_attr($primary_category); ?>" data-max-options="<?php echo esc_attr($maxcategory);?>">
                    <?php
					if(class_exists('service_finder_texonomy_plugin')){
					$limit = 1000;
					$categories = service_finder_getCategoryList($limit);
					$texonomy = 'providers-category';
					if(!empty($categories)){
						foreach($categories as $category){
							if(in_array($category->term_id,$allcategories)){
							$select = 'selected="selected"';
							}else{
							$select = '';
							}
							echo '<option '.$select.' value="'.esc_attr($category->term_id).'">'. $category->name.'</option>';
							$term_children = get_term_children($category->term_id,$texonomy);
							if(!empty($term_children)){
								foreach($term_children as $term_child_id) {
	
									$term_child = get_term_by('id',$term_child_id,$texonomy);
									
									if(in_array($term_child_id,$allcategories)){
										$childselect = 'selected="selected"';
									}else{
										$childselect = '';
									}
									
									echo '<option '.$childselect.' value="'.esc_attr($term_child_id).'" data-content="<span class=\'childcat\'>'.esc_attr($term_child->name).'</span>">'. $term_child->name.'</option>';
									
								}
							}
						}
					}	
					}
					?>
                  </select>
                </div>
              </div>
            </div>
            <?php
            if(!empty($userCap)){
				if(in_array('multiple-categories',$userCap)){
			?>
            <div class="col-lg-12">
                      <div class="form-group form-inline">
                        <label>
                        <?php esc_html_e('Primary Category', 'service-finder'); ?>
                        </label>
                        <br>
                        <div id="providers-category-bx">
                        <?php
                        if(!empty($allcategories)){
							foreach($allcategories as $category){
							$catname = service_finder_getCategoryName($category);
							?>
							<div class="radio">
                              <input id="cat-<?php echo esc_attr($category); ?>" type="radio" name="primary_category" <?php echo ($primary_category == $category) ? 'checked' : ''; ?> value="<?php echo esc_attr($category); ?>">
                              <label for="cat-<?php echo esc_attr($category); ?>">
                              <?php echo esc_html($catname);  ?>
                              </label>
                            </div>
							<?php
							}
						}
						?>
                        </div>
                      </div>
                    </div>
            <?php 
				}
			}
			?>        
          </div>
        </div>
      </div>
      <!--Add cover image Section-->
      <?php 
										if(!empty($userCap)):
										if(in_array('cover-image',$userCap)):
										?>
      <div class="panel panel-default gallery-images">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Cover Image', 'service-finder'); ?>
          </h4>
          <span><?php esc_html_e('Please upload 2000px x 400px size image for higher quality', 'service-finder'); ?></span> </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-md-12">
              <div class="rwmb-field rwmb-plupload_image-wrapper">
                <div class="rwmb-input">
                  <ul class="rwmb-images rwmb-uploaded" data-field_id="coverimageuploader" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="1">
                    <?php
                                                                $coverimage = service_finder_getProviderAttachments($globalproviderid,'cover-image');
																$hiddencoverclass = '';
                                                                if(!empty($coverimage)){
                                                                foreach($coverimage as $cimage){
                                                                        $src  = wp_get_attachment_image_src( $cimage->attachmentid, 'thumbnail' );
                                                                        $src  = $src[0];
                                                                        $i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
																		$hiddencoverclass = 'hidden';
                                                                        
                                                                        $html = sprintf('<li id="item_%s">
                                                                        <img src="%s" />
                                                                        <div class="rwmb-image-bar">
                                                                            <a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
                                                                            <input type="hidden" name="coverimageattachmentid[]" value="%s">
                                                                        </div>
                                                                    </li>',
                                                                    esc_attr($cimage->attachmentid),
                                                                    esc_url($src),
                                                                    esc_attr($i18n_delete), esc_attr($cimage->attachmentid),
                                                                    esc_attr($cimage->attachmentid)
                                                                    );
                                                                        echo $html;	
                                                                    }
                                                                }
                                                                ?>
                  </ul>
                  <div id="coverimageuploader-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files <?php echo esc_attr($hiddencoverclass); ?>" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;coverimageuploader-browse-button&quot;,&quot;drop_element&quot;:&quot;coverimageuploader-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($adminajaxurl); ?>&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed  Files&quot;,&quot;extensions&quot;:&quot;jpg,jpeg,gif,png&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;coverimageuploader&quot;,&quot;action&quot;:&quot;coverimage_upload&quot;}}">
                    <div class = "drag-drop-inside text-center">
                      <p class="drag-drop-info"><?php esc_html_e('Drop files here', 'service-finder'); ?></p>
                      <p><?php esc_html_e('or', 'service-finder'); ?></p>
                      <p class="drag-drop-buttons">
                        <input id="coverimageuploader-browse-button" type="button" value="<?php esc_html_e('Select Files', 'service-finder'); ?>" class="button btn btn-default" />
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php 
										endif;
										endif;
										?>
      <!--Gallery Images Section-->
      <div class="panel panel-default gallery-images">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Gallery Images', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-md-12">
              <div class="rwmb-field rwmb-plupload_image-wrapper">
                <div class="rwmb-input">
                  <?php 
					if(!empty($userCap)){
						if(in_array('gallery-images',$userCap)){
							$package = get_user_meta($globalproviderid,'provider_role',true);
							$packageNum = intval(substr($package, 8));
							$maxupload = (!empty($service_finder_options['package'.$packageNum.'-gallery-images']))? $service_finder_options['package'.$packageNum.'-gallery-images'] : '';
						}else{
						$maxupload = (!empty($service_finder_options['default-gallery-images'])) ? $service_finder_options['default-gallery-images'] : '';
						}
					}else{
						$maxupload = (!empty($service_finder_options['default-gallery-images'])) ? $service_finder_options['default-gallery-images'] : '';
					}
					?>
	<ul class="rwmb-images rwmb-uploaded" data-field_id="plupload" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="<?php echo esc_attr($maxupload); ?>">
	<?php
						
						$images = service_finder_getProviderAttachments($globalproviderid,'gallery');
						$totalimages = count($images);
						if($totalimages >= $maxupload){
						$hiddenclass = 'hidden';
						}else{
						$hiddenclass = '';
						}
						if(!empty($images)){
						foreach($images as $image){
							$src  = wp_get_attachment_image_src( $image->attachmentid, 'thumbnail' );
							$src  = $src[0];
							$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
							
							$html = sprintf('<li id="item_%s">
							<img src="%s" />
							<div class="rwmb-image-bar">
								<a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
								<input type="hidden" name="attachmentid[]" value="%s">
							</div>
						</li>',
						esc_attr($image->attachmentid),
						esc_url($src),
						esc_attr($i18n_delete), esc_attr($image->attachmentid),
						esc_attr($image->attachmentid)
						);
							echo $html;	
						}
						}
						?>
                  </ul>
                  <div id="plupload-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files <?php echo esc_attr($hiddenclass); ?>" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;plupload-browse-button&quot;,&quot;drop_element&quot;:&quot;plupload-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($adminajaxurl); ?>&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed Image Files&quot;,&quot;extensions&quot;:&quot;jpg,jpeg,gif,png&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;plupload&quot;,&quot;action&quot;:&quot;image_upload&quot;}}">
                    <div class = "drag-drop-inside text-center">
                      <p class="drag-drop-info">
                        <?php esc_html_e('Drop images here', 'service-finder'); ?>
                      </p>
                      <p>or</p>
                      <p class="drag-drop-buttons">
                        <input id="plupload-browse-button" type="button" value="Select Files" class="button btn btn-default" />
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Attachments Section-->
      <div class="panel panel-default attachment-files">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Attachments', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-md-12">
              <div class="rwmb-field rwmb-plupload_image-wrapper">
                <div class="rwmb-input">
                  <ul class="rwmb-images rwmb-uploaded" data-field_id="sffileuploader" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="25">
                    <?php
                $files = service_finder_getProviderAttachments($globalproviderid,'file');
				if(!empty($files)){
				foreach($files as $file){
					
					$fileicon = new SERVICE_FINDER_ImageSpace();
					$arr  = $fileicon->get_icon_for_attachment($file->attachmentid);

					$i18n_delete = apply_filters( 'rwmb_image_delete_string', _x( 'Delete', 'image upload', 'service-finder' ) );
					
					$html = sprintf('<li id="item_%s">
					<img src="%s" />
					<div class="rwmb-image-bar">
						<a title="%s" class="rwmb-delete-file" href="#" data-attachment_id="%s">&times;</a>
						<input type="hidden" name="fileattachmentid[]" value="%s">
					</div>
				</li>',
				esc_attr($file->attachmentid),
				esc_url($arr['src']),
				esc_attr($i18n_delete), esc_attr($file->attachmentid),
				esc_attr($file->attachmentid)
				);
					echo $html;	
				}
				}
				?>
                  </ul>
                  <div id="sffileuploader-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;sffileuploader-browse-button&quot;,&quot;drop_element&quot;:&quot;sffileuploader-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($adminajaxurl); ?>&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed  Files&quot;,&quot;extensions&quot;:&quot;doc,docx,pdf,xls,xlsx,txt,ppt,pptx&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;sffileuploader&quot;,&quot;action&quot;:&quot;file_upload&quot;}}">
                    <div class = "drag-drop-inside text-center">
                      <p class="drag-drop-info">
                        <?php esc_html_e('Drop files here', 'service-finder'); ?>
                      </p>
                      <p><?php esc_html_e('or', 'service-finder'); ?></p>
                      <p class="drag-drop-buttons">
                        <input id="sffileuploader-browse-button" type="button" value="<?php esc_html_e('Select Files', 'service-finder'); ?>" class="button btn btn-default" />
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--Embedded Code Section-->
      <div class="panel panel-default embeded-code">
        <div class="panel-heading">
          <h4 class="panel-title">
            <?php esc_html_e('Embeded Code', 'service-finder'); ?>
          </h4>
        </div>
        <div class="panel-body padding-30">
          <div class="row">
            <div class="col-md-12">
              <div class="rwmb-field rwmb-oembed-wrapper">
                <div class="rwmb-label">
                  <label for="your_prefix_oembed"><?php esc_html_e('Video URL', 'service-finder'); ?></label>
                </div>
                <div class="rwmb-input ui-sortable">
                  <input type="url" size="30" placeholder="<?php echo esc_html__('Insert YouTube or Vimeo or Facebook Vedio Url', 'service-finder') ?>" value="" id="embeded_code" name="embeded_code" class="rwmb-oembed valid form-control">
                  <button type="button" class="show-embed button btn btn-primary">
                  <?php esc_html_e('Preview', 'service-finder'); ?>
                  </button>
                  <span class="spinner default-hidden"></span>
                  <div class="embed-code embed-responsive embed-responsive-16by9" style="display:none;">
                  </div>
                  <div class="addbtn sf-add-video"><input type="button" class="btn btn-primary margin-r-10" name="addvideo" value="<?php esc_html_e('Add Video', 'service-finder'); ?>" /></div>
                  <div class="sf-videothumbs">
                  	<ul class="rwmb-video-thumb rwmb-video-uploaded">
                    <?php
					if(is_serialized($userInfo['embeded_code'])){
					$embeded_codes = unserialize($userInfo['embeded_code']);
                    if(!empty($embeded_codes)){
						foreach($embeded_codes as $embeded_code){
							$thumbnail = service_finder_identify_videos($embeded_code);
							echo '<li data-url="'.$embeded_code.'">'.$thumbnail.'<div class="rwmb-thumb-bar rwmb-image-bar"><a title="Delete" class="rwmb-delete-vthumb rwmb-delete-file" href="javascript:;">x</a></div></li>';
						}
					}
					}else{
						if($userInfo['embeded_code'] != ""){
						$thumbnail = service_finder_identify_videos($embeded_code);
						echo '<li data-url="'.$userInfo['embeded_code'].'">'.$thumbnail.'<div class="rwmb-thumb-bar rwmb-image-bar"><a title="Delete" class="rwmb-delete-vthumb rwmb-delete-file" href="javascript:;">x</a></div></li>';	
						}
					}
					?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group margin-0">
      <input type="hidden" name="zoomlevel" id="zoomlevel" value="<?php echo get_user_meta($globalproviderid,'zoomlevel',true); ?>" />
      <input type="hidden" name="locationzoomlevel" id="locationzoomlevel" value="<?php echo get_user_meta($globalproviderid,'locationzoomlevel',true); ?>" />
      <input type="hidden" name="user_id" value="<?php echo esc_attr($globalproviderid); ?>" />
    </div>
  </form>
</div>
