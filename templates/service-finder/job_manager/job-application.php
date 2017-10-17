<?php 
$current_user = wp_get_current_user(); 
$service_finder_options = get_option('service_finder_options');

if ( $apply = get_the_job_application_method() && (service_finder_UserRole($current_user->ID) == 'Provider' || !is_user_logged_in()) ) :
	$apply = get_the_job_application_method();
	wp_enqueue_script( 'wp-job-manager-job-application' );
	?>
	<div class="job_application application">

		<?php do_action( 'job_application_start', $apply ); ?>

        <?php if(is_user_logged_in()){ ?>
        
        <?php
		$userCap = array();
		if(class_exists('service_finder_booking_plugin')) {
		$userCap = service_finder_get_capability($current_user->ID);
		}
		
		$jobid = get_the_id();
        $jobs = get_user_meta($current_user->ID,'job_applications',true);
		if($jobs != ""){
		$jobs = array_unique(explode(',',$jobs));
		}
		
		if(!empty($userCap)){
		if(in_array('apply-for-job',$userCap)){
		
		$package = get_user_meta($current_user->ID,'provider_role',true);
		$packageNum = intval(substr($package, 8));
		$availablelimit = service_finder_get_avl_job_limits($current_user->ID);
		
		if(!empty($jobs)){
			if(in_array($jobid,$jobs)){
				echo '<a href="javascript:;" class="btn btn-primary">' . esc_html__( 'Applied', 'wp-job-manager' ) . '</a>';	
			}else{
				
				if(!empty($jobs)){
				$jobcount = count($jobs);
				}else{
				$jobcount = 0;				
				}
				
				if($availablelimit > 0){
				echo '<div id="applybtn">';
				echo '<input type="button" data-target="#job-apply-form" data-toggle="modal" class="btn btn-primary" value="' . esc_html__( 'Apply for job', 'wp-job-manager' ) . '" />';
				echo '</div>';
				?>
				<div id="job-apply-form" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                          <?php esc_html_e('Apply Now', 'service-finder'); ?>
                        </h4>
                      </div>
                        <?php
                            /**
                             * job_manager_application_details_email or job_manager_application_details_url hook
                             */
                            $allowed_application_method = get_option( 'job_manager_allowed_application_method', '' );
                            if($allowed_application_method == 'custom'){
                            include( locate_template( 'job_manager/job-application-custom.php' ) );
                            }else{
                            do_action( 'job_manager_application_details_' . $apply->type, $apply );
                            }
                        ?>
                        <?php do_action( 'job_application_end', $apply ); ?>
                    </div>
                  </div>
                </div>
				<?php
				}
			}	
		}else{
				if(!empty($jobs)){
				$jobcount = count($jobs);
				}else{
				$jobcount = 0;				
				}
				if($availablelimit > 0){
				echo '<div id="applybtn">';
				echo '<input type="button" data-target="#job-apply-form" data-toggle="modal" class="btn btn-primary" value="' . esc_html__( 'Apply for job', 'wp-job-manager' ) . '" />';
				echo '</div>';
				?>
				<div id="job-apply-form" class="modal fade" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">
                          <?php esc_html_e('Apply Now', 'service-finder'); ?>
                        </h4>
                      </div>
                        <?php
                            /**
                             * job_manager_application_details_email or job_manager_application_details_url hook
                             */
                            $allowed_application_method = get_option( 'job_manager_allowed_application_method', '' );
                            if($allowed_application_method == 'custom'){
                            include( locate_template( 'job_manager/job-application-custom.php' ) );
                            }else{
                            do_action( 'job_manager_application_details_' . $apply->type, $apply );
                            }
                        ?>
                        <?php do_action( 'job_application_end', $apply ); ?>
                    </div>
                  </div>
                </div>
				<?php
				}
		}
		
		}
		}
		?>
        <?php }else{ ?>
        <a href="javascript:;" class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php _e( 'Apply for job', 'wp-job-manager' ); ?></a>
        <?php } ?>
		
		
	</div>
<?php endif; ?>

