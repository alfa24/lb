<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
get_header();

$service_finder_options = get_option('service_finder_options');

$current_user = service_finder_plugin_global_vars('current_user');

$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');
$userInfo = service_finder_getCurrentUserInfo();

$manageaccountby = (isset($_GET['manageaccountby'])) ? esc_attr($_GET['manageaccountby']) : '';
$manageproviderid = (isset($_GET['manageproviderid'])) ? esc_attr($_GET['manageproviderid']) : '';

if(service_finder_getUserRole($current_user->ID) == 'administrator' && $manageaccountby != 'admin'){
$redirect = admin_url( 'profile.php' );
wp_redirect($redirect);
}

$identitycheck = (isset($service_finder_options['identity-check'])) ? esc_attr($service_finder_options['identity-check']) : '';

$tabname = (isset($_GET['tabname'])) ? esc_html($_GET['tabname']) : '';

$availabilitytab = '';
if($tabname == 'availability'){
$availabilitytab = 'yes';
}
wp_add_inline_script( 'service_finder-js-availability-form', '/*Declare global variable*/
var availabilitytab = "'.$availabilitytab.'";
', 'after' );
?>
<!-- My Profile page template for provider and customers -->

<div class="page-content">
  <!-- Left & right section start -->
  <div class="container">
    <div class="section-content profiles-content" >
      <div class="row">
        <?php if(service_finder_getUserRole($current_user->ID) == 'Provider' || service_finder_check_account_authorization($manageaccountby,$manageproviderid)){ ?>
        <!-- Provider Section Start -->
        <?php 
		if(service_finder_getUserRole($current_user->ID) == 'Provider'){
		$userCap = service_finder_get_capability($current_user->ID);
		$globalproviderid = $current_user->ID;
		$userInfo = service_finder_getCurrentUserInfo();
		}else{
		$userCap = service_finder_get_capability($manageproviderid);
		$globalproviderid = $manageproviderid;
		$userInfo = service_finder_getUserInfo($manageproviderid);
		}
		$package = get_user_meta($current_user->ID,'provider_role',true);
		?>
        <!-- Left part start -->
        <div class="col-md-3">
          <aside  class="side-bar">
            <?php
                                if(!empty($userInfo['avatar_id']) && $userInfo['avatar_id'] > 0){
								$src  = wp_get_attachment_image_src( $userInfo['avatar_id'], 'thumbnail' );
								$src  = $src[0];
								}
								$src = (!empty($src)) ? $src : '';
								?>
            <div class="auther-bx">
              <div class="auther-pic">
              <?php if($src != ""){ ?>
               <img src="<?php echo esc_url($src); ?>" alt=""> 
              <?php } ?> 
              </div>
              <h6><?php echo service_finder_getCompanyName($globalproviderid); ?></h6>
              <p><?php echo esc_html($userInfo['fname']).' '.esc_html($userInfo['lname']) ?></p>
              <?php echo service_finder_check_varified_icon($globalproviderid); ?>
            </div>
            <!-- Profile Settings Tab Start-->
            <nav class="profile-menu">
              <ul id="myTab">
                <?php if(service_finder_check_profile_after_trial_expire($globalproviderid)){ ?>
                <?php if(service_finder_check_display_features_after_social_login($globalproviderid)){ ?>
                <li class="active"><a href="#my-profile"><i class="fa fa-user"></i>
                  <?php echo (!empty($service_finder_options['label-profile-settings'])) ? esc_html($service_finder_options['label-profile-settings']) : esc_html__('Profile Settings', 'service-finder'); ?>
                  </a></li>
                  <?php } ?>
                <?php 
				if(!empty($userCap)):
				if(in_array('availability',$userCap) && in_array('bookings',$userCap)):
				?>
                <?php if($identitycheck){ ?>
                <li><a href="#my-profile" class="openidentitychk"><i class="fa fa-location-arrow"></i>
                  <?php echo (!empty($service_finder_options['label-identity-check'])) ? esc_html($service_finder_options['label-identity-check']) : esc_html__('Identity Check', 'service-finder'); ?>
                  </a></li>  
                <?php } ?> 
                <?php if($service_finder_options['availability-menu']){ ?> 
                <li><a href="#availability"><i class="fa fa-calendar"></i>
                  <?php echo (!empty($service_finder_options['label-availability'])) ? esc_html($service_finder_options['label-availability']) : esc_html__('Availability', 'service-finder'); ?>
                  </a></li>
                <?php } ?>  
                <?php if($service_finder_options['set-unavailability-menu']){ ?>
                <li><a href="#unavailability"><i class="fa fa-calendar"></i>
                  <?php echo (!empty($service_finder_options['label-set-unavailability'])) ? esc_html($service_finder_options['label-set-unavailability']) : esc_html__('Set UnAvailability', 'service-finder'); ?>
                  </a></li>
                 <?php } ?> 
				<?php 
									endif;
									endif;
									?>
                <?php if(service_finder_check_display_features_after_social_login($globalproviderid) && $service_finder_options['business-hours-menu']){ ?>
                <li><a href="#business-hours"><i class="fa fa-clock-o"></i>
                  <?php echo (!empty($service_finder_options['label-business-hours'])) ? esc_html($service_finder_options['label-business-hours']) : esc_html__('Business Hours', 'service-finder'); ?>
                  </a></li>
                  <?php } ?>
                <?php 
									if(!empty($userCap)){
									if(in_array('bookings',$userCap) && $service_finder_options['postal-codes-menu']){
									?>
                <li><a href="#postal-codes"><i class="fa fa-book"></i>
                  <?php echo (!empty($service_finder_options['label-postal-codes'])) ? esc_html($service_finder_options['label-postal-codes']) : esc_html__('Postal Codes', 'service-finder'); ?>
                  </a></li>
                  <?php }
				}
				 ?>  
                <?php
				if(!empty($userCap)){
				if(in_array('branches',$userCap) && $service_finder_options['our-branches-menu']){
				?> 
                <li><a href="#our-branches"><i class="fa fa-map-marker"></i>
                  <?php echo (!empty($service_finder_options['label-our-branches'])) ? esc_html($service_finder_options['label-our-branches']) : esc_html__('Our Branches', 'service-finder'); ?>
                  </a></li>  
                <?php }
				}
				 ?>   
                 <?php 
									if(!empty($userCap)){
									if(in_array('bookings',$userCap) && $service_finder_options['regions-menu']){
									?>
                <li><a href="#service-regions"><i class="fa fa-location-arrow"></i>
                  <?php echo (!empty($service_finder_options['label-regions'])) ? esc_html($service_finder_options['label-regions']) : esc_html__('Regions', 'service-finder'); ?>
                  </a></li>
                  <?php }
				}
				 ?>    
                <?php if(service_finder_check_display_features_after_social_login($globalproviderid) && $service_finder_options['my-services-menu']){ ?>
                <li><a href="#my-services"><i class="fa fa-server"></i>
                  <?php echo (!empty($service_finder_options['label-my-services'])) ? esc_html($service_finder_options['label-my-services']) : esc_html__('My Services', 'service-finder'); ?>
                  </a></li>
                  <?php } ?>
                <?php  if(class_exists('WP_Job_Manager')){ 
				if(!empty($userCap)){
				if(in_array('apply-for-job',$userCap) && $service_finder_options['my-jobs-menu']){
				?> 
                <li><a href="#my-jobs"><i class="fa fa-briefcase"></i>
                  <?php echo (!empty($service_finder_options['label-my-jobs'])) ? esc_html($service_finder_options['label-my-jobs']) : esc_html__('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php }
				}
				}
				 ?> 
                <?php  if(class_exists('WP_Job_Manager')){ 
				if(!empty($userCap)){
				if(in_array('apply-for-job',$userCap) && $service_finder_options['job-apply-limits-menu']){
				?>
                <li><a href="#job-limits"><i class="fa fa-check-circle-o"></i>
                  <?php echo (!empty($service_finder_options['label-job-limits'])) ? esc_html($service_finder_options['label-job-limits']) : esc_html__('Job Apply Limits', 'service-finder'); ?>
                  </a></li>  
                <?php }
				}
				}
				 ?>  
                <?php 
									if(!empty($userCap)):
									if(in_array('staff-members',$userCap) && in_array('bookings',$userCap) && $service_finder_options['team-members-menu']):
									?>
                <li><a href="#team-members"><i class="fa fa-users"></i>
                  <?php echo (!empty($service_finder_options['label-team-members'])) ? esc_html($service_finder_options['label-team-members']) : esc_html__('Team Members', 'service-finder'); ?>
                  </a></li>
                <?php 
									endif;
									endif;
									?>
                <?php 
									if(!empty($userCap)):
									if(in_array('bookings',$userCap)):
									?>
                <?php if($service_finder_options['bookings-menu']){ ?>
                <li><a href="#bookings"><i class="fa fa-hand-o-up"></i>
                  <?php echo (!empty($service_finder_options['label-bookings'])) ? esc_html($service_finder_options['label-bookings']) : esc_html__('Bookings', 'service-finder'); ?>
                  </a></li>
                <?php } ?>  
                <?php if($service_finder_options['schedule-menu']){ ?>
                <li><a href="#schedule"><i class="fa fa-clock-o"></i>
                  <?php echo (!empty($service_finder_options['label-schedule'])) ? esc_html($service_finder_options['label-schedule']) : esc_html__('Schedule', 'service-finder'); ?>
                  </a></li>
                <?php } ?>  
                <?php 
									endif;
									endif;
									?>
                <?php 
									if(!empty($userCap)):
									if(in_array('invoice',$userCap) && in_array('bookings',$userCap) && $service_finder_options['invoice-menu']):
									?>
                <li><a href="#invoice"><i class="fa fa-file-text-o"></i>
                  <?php echo (!empty($service_finder_options['label-invoice'])) ? esc_html($service_finder_options['label-invoice']) : esc_html__('Invoice', 'service-finder'); ?>
                  </a></li>
                <?php 
									endif;
									endif;
									?>
                <?php } ?>        
                <?php if($service_finder_options['upgrade-account-menu']){ ?>            
                <li><a href="#upgrade"><i class="fa fa-gear"></i>
                  <?php echo (!empty($service_finder_options['label-upgrade'])) ? esc_html($service_finder_options['label-upgrade']) : esc_html__('Upgrade Account', 'service-finder'); ?>
                  </a></li>
                 <?php } ?> 
              </ul>
            </nav>
            <!-- Profile Settings Tab End-->
          </aside>
        </div>
        <!-- Left part END -->
        <!-- Right part start -->
        <div class="col-md-9 tab-content">
          <?php if(get_user_meta($globalproviderid, 'trial_package', true) == 'yes' && get_user_meta($globalproviderid, 'current_provider_status', true) == 'expire' && get_user_meta($globalproviderid, 'provider_role', true) == ''){ ?>
          <div class="alert alert-danger"><?php esc_html_e('You trial package has been expired. Please update with available packages.', 'service-finder'); ?></div>
          <?php } ?>
		  <?php if(service_finder_check_profile_after_trial_expire($globalproviderid)){ ?>
          <?php if(service_finder_check_display_features_after_social_login($globalproviderid)){ ?>
          <div id="my-profile" class="tab-pane fade in active">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/templates/my-account.php'; ?>
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/templates/identity-check.php'; ?>
          </div>
          <?php } ?>
          <?php 
									if(!empty($userCap)):
									if(in_array('availability',$userCap) && in_array('bookings',$userCap)):
									?>
          <?php if($service_finder_options['availability-menu']){ ?> 
          <div id="availability" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/availability/templates/availability.php'; ?>
          </div>
          <?php } ?>
           <?php if($service_finder_options['set-unavailability-menu']){ ?>
          <div id="unavailability" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/availability/templates/unavailability.php'; ?>
          </div>
          <?php } ?>
          <?php 
									endif;
									endif;
									?>
          <?php if(service_finder_check_display_features_after_social_login($globalproviderid) && $service_finder_options['business-hours-menu']){ ?>
          <div id="business-hours" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/business-hours/templates/business-hours.php'; ?>
          </div>
          <?php } ?>
          <?php 
									if(!empty($userCap)){
									if(in_array('bookings',$userCap) && $service_finder_options['postal-codes-menu']){
									?>
          <div id="postal-codes" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/service-area/templates/service-area.php'; ?>
          </div>
          <?php
          }
		  }
		  ?>
          <?php
		  if(!empty($userCap)){
		  if(in_array('branches',$userCap) && $service_finder_options['our-branches-menu']){
		  ?>
          <div id="our-branches" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/branches/templates/branches.php'; ?>
          </div>
          <?php } 
		  }
		  ?>
          <?php 
									if(!empty($userCap)){
									if(in_array('bookings',$userCap) && $service_finder_options['regions-menu']){
									?>
          <div id="service-regions" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/service-area/templates/service-regions.php'; ?>
          </div>
          <?php }
		  }
		  ?>
          <?php if(service_finder_check_display_features_after_social_login($globalproviderid) && $service_finder_options['my-services-menu']){ ?>
          <div id="my-services" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myservices/templates/my-services.php'; ?>
          </div>
          <?php } ?>
          <?php  if(class_exists('WP_Job_Manager')){
		  if(!empty($userCap)){
		  if(in_array('apply-for-job',$userCap) && $service_finder_options['my-jobs-menu']){
		  ?>	
          <div id="my-jobs" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/jobs/templates/my-jobs.php'; ?>
          </div>
          <?php } 
		  }
		  }
		  ?>
          <?php  if(class_exists('WP_Job_Manager')){
		  if(!empty($userCap)){
		  if(in_array('apply-for-job',$userCap) && $service_finder_options['job-apply-limits-menu']){
		  ?>							
          <div id="job-limits" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/jobs/templates/job-limits.php'; ?>
          </div>
          <?php } 
		  }
		  }
		  ?>
          <?php 
									if(!empty($userCap)):
									if(in_array('staff-members',$userCap) && in_array('bookings',$userCap) && $service_finder_options['team-members-menu']):
									?>
          <div id="team-members" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/templates/team-members.php'; ?>
          </div>
          <?php 
									endif;
									endif;
									?>
          <?php 
									if(!empty($userCap)):
									if(in_array('bookings',$userCap)):
									?>
          <?php if($service_finder_options['bookings-menu']){ ?>
          <div id="bookings" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/templates/bookings.php'; ?>
          </div>
          <?php } ?>
          <?php if($service_finder_options['schedule-menu']){ ?>
          <div id="schedule" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/schedule/templates/schedule.php'; ?>
          </div>
          <?php } ?>
          <?php 
									endif;
									endif;
									?>
          <?php 
									if(!empty($userCap)):
									if(in_array('invoice',$userCap) && in_array('bookings',$userCap) && $service_finder_options['invoice-menu']):
									?>
          <div id="invoice" class="tab-pane fade">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/invoice/templates/invoice.php'; ?>
          </div>
          <?php 
									endif;
									endif;
									?>
		  <?php } ?>	              
          <?php if($service_finder_options['upgrade-account-menu']){ ?>
          <div id="upgrade" class="tab-pane fade <?php if(!service_finder_check_profile_after_trial_expire($globalproviderid) || !service_finder_check_display_features_after_social_login($globalproviderid)){ echo 'in active'; }?>">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/upgrade/templates/account.php'; ?>
          </div>
          <?php } ?>
        </div>
        <!-- Right part END -->
        <!-- Provider Section End -->
        <?php }elseif(service_finder_getUserRole($current_user->ID) == 'Customer'){ 
		$action = (isset($_GET['action'])) ? $_GET['action'] : '';
		$job_id = (isset($_GET['job_id'])) ? $_GET['job_id'] : '';
		?>
        <!-- Customer Section Start -->
        <!-- Right part start -->
        <div class="col-md-12 tab-content">
          <?php if($action == 'my-profile' || !isset($_GET['action'])):?>
          <div id="my-profile" class="tab-pane fade in active">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/myaccount/templates/customer-account.php'; ?>
          </div>
          <?php endif; ?>
          <?php if($action == 'bookings'):?>
          <div id="bookings" class="tab-pane fade in active">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/bookings/templates/customer-bookings.php'; ?>
          </div>
          <?php endif; ?>
          <?php if($action == 'schedule'):?>
          <div id="schedule" class="tab-pane fade in active schedule-bx">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/schedule/templates/customer-schedule.php'; ?>
          </div>
          <?php endif; ?>
          <?php if($action == 'invoice'):?>
          <div id="invoice" class="tab-pane fade in active">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/invoice/templates/customer-invoice.php'; ?>
          </div>
          <?php endif; ?>
          <?php if($action == 'my-favorites'):?>
          <div id="my-favorites" class="tab-pane fade in active">
            <?php require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/favorites/templates/my-favorites.php'; ?>
          </div>
          <?php endif; ?>
        </div>
        <!-- Right part END -->
        <!-- Customer Section End -->
        <?php

						}else{
						echo esc_html__('This provider profile is not found.','service-finder');
						}?>
      </div>
    </div>
  </div>
  <!-- Left & right section  END -->
</div>
<?php get_footer();

