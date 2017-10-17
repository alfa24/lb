<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/* Apply to job form */
add_action('wp_ajax_applyjobform', 'service_finder_applyjobform');
if ( !function_exists( 'service_finder_applyjobform' )){
function service_finder_applyjobform(){
	global $wpdb, $service_finder_options, $service_finder_Tables;
	$current_user = wp_get_current_user(); 
	
	$jobid = (!empty($_POST['jobid'])) ? $_POST['jobid']  : '';
	$costing = (!empty($_POST['costing'])) ? $_POST['costing']  : '';
	$description = (!empty($_POST['description'])) ? $_POST['description']  : '';
	
	$userCap = array();
	if(class_exists('service_finder_booking_plugin')) {
	$userCap = service_finder_get_capability($current_user->ID);
	}
	
	if(!empty($userCap)){
	if(!in_array('apply-for-job',$userCap)){
		$msg = esc_html__( 'You do not have capability to apply for job. Please upgrade your package.', 'wp-job-manager' );
		$success = array(
				'status' =>'error',
				'err_message' => $msg
				);
		echo json_encode($success);
		exit;
	}else{
		$availablelimit = service_finder_get_avl_job_limits($current_user->ID);
		if($availablelimit < 1){
		$msg = esc_html__( 'You do not have available connects. Please upgrade you plan.', 'wp-job-manager' );
		$success = array(
				'status' =>'error',
				'err_message' => $msg
				);
		echo json_encode($success);
		exit;
		}
	}
	}
	
	$jobinfo = get_post($jobid);
	$customerid = $jobinfo->post_author;
	$customer = get_user_by( 'id', $customerid );
	$customer_email = $customer->user_email;
	
	$jobtitle = '<a href="'.esc_url(get_post_permalink($jobid)).'" target="_blank">'.esc_html($jobinfo->post_title).'</a>';
	
	$applications_cost = get_user_meta($current_user->ID,'job_applications_cost',true);
	if($applications_cost != ""){
		
		$costdata = $applications_cost.','.esc_html($jobid).'-'.esc_html($costing);
		
		update_user_meta($current_user->ID,'job_applications_cost',$costdata);
	}else{
		add_user_meta($current_user->ID,'job_applications_cost',esc_html($jobid).'-'.esc_html($costing));
	}
	
	$applications_desc = get_user_meta($current_user->ID,'job_applications_description',true);
	if($applications_desc != ""){
		
		$descdata = $applications_desc.'%NEXT%'.esc_html($jobid).'%SEP%'.esc_html($description);
		
		update_user_meta($current_user->ID,'job_applications_description',$descdata);
	}else{
		add_user_meta($current_user->ID,'job_applications_description',esc_html($jobid).'%SEP%'.esc_html($description));
	}
	
	$itemarr = get_user_meta($current_user->ID,'job_applications');
	if(!empty($itemarr)){

		$itemarr = implode(',',$itemarr);
		$jobitems = $itemarr.','.esc_html($jobid);
		
		update_user_meta($current_user->ID,'job_applications',$jobitems);
	}else{
	add_user_meta($current_user->ID,'job_applications',esc_html($jobid));
	}
	
	$itemarr = get_post_meta($jobid,'job_applications');
	if(!empty($itemarr)){

		$itemarr = implode(',',$itemarr);
		$providers = $itemarr.','.$current_user->ID;
		
		update_post_meta($jobid,'job_applications',$providers);
	}else{
	add_post_meta($jobid,'job_applications',$current_user->ID);
	}
	
	if(!empty($service_finder_options['applyjob-to-customer'])){
		$message = $service_finder_options['applyjob-to-customer'];
	}else{
		$message = 'Job Application from provider

Job Title: %JOBTITLE%

Full Name: %FULLNAME%

Email: %EMAIL%

Phone: %PHONE%

Cost: %COST%

Description: %DESCRIPTION%
';
	}
	
	if(!empty($service_finder_options['applyjob-to-admin'])){
		$adminmessage = $service_finder_options['applyjob-to-admin'];
	}else{
		$adminmessage = 'Job Application from provider

Job Title: %JOBTITLE%

Full Name: %FULLNAME%

Email: %EMAIL%

Phone: %PHONE%

Cost: %COST%

Description: %DESCRIPTION%
';
	}
			
			$tokens = array('%JOBTITLE%','%FULLNAME%','%EMAIL%','%PHONE%','%COST%','%DESCRIPTION%');
			
			$providerInfo = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `wp_user_id` = %d',$current_user->ID));
			
			$replacements = array($jobtitle,service_finder_get_providername_with_link($providerInfo->wp_user_id),esc_html($providerInfo->email),esc_html($providerInfo->phone),service_finder_money_format($costing),$description);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['applyjob-to-customer-subject'] != ""){
				$msg_subject = $service_finder_options['applyjob-to-customer-subject'];
			}else{
				$msg_subject = esc_html__('Job Application', 'service-finder');
			}
			
			$adminmsg_body = str_replace($tokens,$replacements,$adminmessage);
			
			if($service_finder_options['applyjob-to-admin-subject'] != ""){
				$adminmsg_subject = $service_finder_options['applyjob-to-admin-subject'];
			}else{
				$adminmsg_subject = esc_html__('Job Application', 'service-finder');
			}
			
			
			
			$adminemail = get_option( 'admin_email' );
			
			$applymail = (!empty($service_finder_options['job-apply-mail-to-admin'])) ? $service_finder_options['job-apply-mail-to-admin'] : '';
			
			$row = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->job_limits.' WHERE `provider_id` = "'.$current_user->ID.'"');

			if(!empty($row)){
			$available_limits = $row->available_limits - 1;
			$data = array(
					'available_limits' => $available_limits,
					);
			$where = array(
					'provider_id' => $current_user->ID,
					);		
			
			$wpdb->update($service_finder_Tables->job_limits,wp_unslash($data),$where);
			}
			
			if($applymail){
				service_finder_wpmailer($customer_email,$msg_subject,$msg_body);
				service_finder_wpmailer($adminemail,$adminmsg_subject,$adminmsg_body);
				
				$msg = (!empty($service_finder_options['apply-job'])) ? $service_finder_options['apply-job'] : esc_html__('Applied to this job successfully', 'service-finder');
				$success = array(
						'status' =>'success',
						'suc_message' => $msg
						);
				echo json_encode($success);
				
			}else{
				service_finder_wpmailer($customer_email,$msg_subject,$msg_body);
				$msg = (!empty($service_finder_options['apply-job'])) ? $service_finder_options['apply-job'] : esc_html__('Applied to this job successfully', 'service-finder');
				$success = array(
						'status' =>'success',
						'suc_message' => $msg
						);
				echo json_encode($success);

			}

	exit;

}
}

/*Get number of applicants*/
if ( !function_exists( 'service_finder_get_number_of_applicants' )){
function service_finder_get_number_of_applicants($jobid){
	$job_applications = get_post_meta($jobid,'job_applications',true);
	if($job_applications != ""){
	$applicants = explode(',',$job_applications);
	$number_of_applicants = count(array_unique($applicants));
	}else{
	$number_of_applicants = 0;
	}
	return $number_of_applicants;
}
}

/* Display applicants listing */
add_action('wp_ajax_applicants_listing', 'service_finder_applicants_listing');
if ( !function_exists( 'service_finder_applicants_listing' )){
function service_finder_applicants_listing(){
	global $wpdb, $service_finder_options, $service_finder_Tables;
	$current_user = wp_get_current_user(); 
	
	$jobid = (!empty($_POST['jobid'])) ? $_POST['jobid']  : '';
	
	$job_applications = get_post_meta($jobid,'job_applications',true);
	$applicants = array();
	$job_cost = get_post_meta($jobid,'_job_cost',true);
	if($job_applications != ""){
	$applicants = explode(',',$job_applications);
	$applicants = array_unique($applicants);
	}
	if(!empty($applicants)){
	$html = '';
		foreach($applicants as $applicant){
		
		$provider = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->providers.' WHERE `admin_moderation` = "approved" AND `account_blocked` != "yes" AND `wp_user_id` = %d',$applicant));
		
		$link = service_finder_get_author_url($applicant);
		$settings = service_finder_getProviderSettings($provider->wp_user_id);

		if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
			$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-provider-thumb' );
			$src  = $src[0];
		}else{
			$src  = service_finder_get_default_avatar();
		}
		
		if($src != ''){
			$imgtag = '<img src="'.esc_url($src).'" width="358" height="259" alt="">';
		}else{
			$imgtag = '';
		}
		
		if(service_finder_is_featured($provider->wp_user_id)){
		$featured = '<strong class="sf-featured-label"><span>'.esc_html__( 'Featured', 'service-finder' ).'</span></strong>';
		}else{
		$featured = '';
		}
		
		$hired = '';
		$hireurl = add_query_arg( array( 'jobid' => absint( $jobid ) . '#book-now-section' ), $link );
		$jobexpire = get_post_meta($jobid,'_job_expires',true);
		
			if(get_post_meta($jobid,'_filled',true)){
				if(get_post_meta($jobid,'_assignto',true) == $provider->wp_user_id){
					$hireme = '<a href="javascript:;" class="btn btn-primary">'.esc_html__( 'Hired', 'service-finder' ).' <i class="fa fa-user"></i></a>';
					$hired = '<strong class="sf-hired-label"><span>'.esc_html__( 'Hired', 'service-finder' ).'</span></strong>';
				}else{
					$hireme = '<a href="javascript:;" class="btn btn-primary">'.esc_html__( 'Closed', 'service-finder' ).' <i class="fa fa-user"></i></a>';
				}
			}else{
				if(strtotime(date('Y-m-d')) > strtotime( $jobexpire )){
					$hireme = '<a href="javascript:;" class="btn btn-primary">'.esc_html__( 'Expired', 'service-finder' ).' <i class="fa fa-heart"></i></a>';
				}else{
					if($settings['booking_process'] == 'on'){
					$hireme = '<a href="'.esc_url($hireurl).'" class="btn btn-primary">'.esc_html__( 'Hire Me', 'service-finder' ).' <i class="fa fa-user"></i></a>';
					}else{
					$hireme = '<a href="javascript:;" class="btn btn-primary hire_if_booking_off" data-providerid="'.$provider->wp_user_id.'" data-jobid="'.$jobid.'">'.esc_html__( 'Hire Me', 'service-finder' ).' <i class="fa fa-user"></i></a>';
					}
				}
			}
		
		$applications_cost = get_user_meta($provider->wp_user_id,'job_applications_cost',true);
		
		$tempdata = explode(',',$applications_cost);
		if(!empty($tempdata)){
			foreach($tempdata as $temp){
				$tmp = explode('-',$temp);
				if($tmp[0] == $jobid){
					$quotecost = $tmp[1];
				}
			}
		}
		
		$applications_desc = get_user_meta($provider->wp_user_id,'job_applications_description',true);
		
		$tempdata = explode('%NEXT%',$applications_desc);
		
		if(!empty($tempdata)){
			foreach($tempdata as $temp){
				$tmp = explode('%SEP%',$temp);
				if($tmp[0] == $jobid){
					$quotedesc = $tmp[1];
				}
			}
		}
		
		if($quotedesc != ""){
		$quotation_desc = '<div class="btn-group sf-provider-tooltip" role="group"><button type="button" class="btn btn-border provider_description" data-toggle="tooltip" data-placement="top" title="'.esc_html__('Provider Description','service-finder').'" data-providerid="'.$provider->wp_user_id.'" data-jobid="'.$jobid.'"><i class="fa fa-commenting-o"></i></button></div>';
		}
		
		if($quotecost != ""){
		$quotation = '<div class="provider-quotation">
                          '.esc_html__('Quotation','service-finder').': '.service_finder_money_format($quotecost).'
                        </div>';
		}
		$addressbox = '';
		$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
		if($showaddressinfo && $service_finder_options['show-postal-address'] && service_finder_check_address_info_access()){
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
		}
			
		$html .= '<div class="col-md-4 col-sm-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            '.$hired.'
                        </div>
                        
                        <div class="padding-20 bg-white">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                            
                        </div>
                        '.$quotation.' '.$quotation_desc.'
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom mark-fullview">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$hireme.'
                        </div>
						
                        
                    </div>
                </div>

            </div>';
		}
		
		$success = array(
				'status' =>'success',
				'applicants' => $html,
				);
		echo json_encode($success);
	}else{
		$error = array(
				'status' => 'error',
				'err_message' => esc_html__('No Applicants Found.', 'service-finder'),
				);
		echo json_encode($error);
	}
	exit;
}
}	

/* Display applicants listing */
add_action('wp_ajax_hire_if_booking_off', 'service_finder_hire_if_booking_off');
if ( !function_exists( 'service_finder_hire_if_booking_off' )){
function service_finder_hire_if_booking_off(){
	global $wpdb, $service_finder_options, $service_finder_Tables;
	$current_user = wp_get_current_user(); 
	
	$jobid = (!empty($_POST['jobid'])) ? $_POST['jobid']  : '';
	$providerid = (!empty($_POST['providerid'])) ? $_POST['providerid']  : '';
	
	update_post_meta($jobid,'_filled',1);
	update_post_meta($jobid,'_assignto',$providerid);
	update_post_meta($jobid,'_hire_when_booking_is_off','yes');
	
	$customerid = get_post_field( 'post_author', $jobid );
	$customername = get_user_meta($customerid,'first_name',true).' '.get_user_meta($customerid,'last_name',true);
	$customeremail = get_post_meta($jobid,'_application',true);
		
	if(function_exists('service_finder_add_notices')) {
	
		$noticedata = array(
				'provider_id' => $providerid,
				'target_id' => $jobid, 
				'topic' => esc_html__('Hire for job', 'service-finder'),
				'notice' => sprintf( esc_html__('You have been hired for applied job by %s (%s).', 'service-finder'), $customername,$customeremail ),
				);
		service_finder_add_notices($noticedata);
	
	}
	
	$msg_subject = esc_html__('Hire for job', 'service-finder');
	
	$msg_body = 'You have been hired for applied job. <br/><br/>
	
	Customer Name: '.$customername.' <br/>
	
	Customer Email: '.$customeremail;
	
	$provideremail = service_finder_getProviderEmail($providerid);
			
	service_finder_wpmailer($provideremail,$msg_subject,$msg_body);
	
	$providerprofilelink = service_finder_get_author_url($providerid);
	
	$success = array(
				'status' => 'success',
				'link' => $providerprofilelink,
				'suc_message' => esc_html__('The provider has been notified you have accepted their offer. Click continue to view providers contact information.', 'service-finder'),
				);
	echo json_encode($success);
	exit;
}
}	

/* get quoteation description */
add_action('wp_ajax_get_quote_description', 'service_finder_get_quote_description');
if ( !function_exists( 'service_finder_get_quote_description' )){
function service_finder_get_quote_description(){
	global $wpdb, $service_finder_options, $service_finder_Tables;
	$current_user = wp_get_current_user(); 
	
	$jobid = (!empty($_POST['jobid'])) ? $_POST['jobid']  : '';
	$providerid = (!empty($_POST['providerid'])) ? $_POST['providerid']  : '';
	
	$applications_desc = get_user_meta($providerid,'job_applications_description',true);
		
	$tempdata = explode('%NEXT%',$applications_desc);
	if(!empty($tempdata)){
		foreach($tempdata as $temp){
			$tmp = explode('%SEP%',$temp);
			if($tmp[0] == $jobid){
				$quotedesc = $tmp[1];
			}
		}
	}

	echo $quotedesc;
	exit;

}
}