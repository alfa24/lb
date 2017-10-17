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

class SERVICE_FINDER_GetQuote{

	/*Get Service Quotetion*/
	public function service_finder_get_quote_mail($provider_id=null,$customer_name='',$customer_email='',$phone='',$description='',$captcha_code='',$captchaon=0){
			global $wpdb, $service_finder_Tables, $service_finder_options;
			if($captchaon == 1){

			if((empty($_SESSION['captcha_code_requestquote'] ) || strcasecmp($_SESSION['captcha_code_requestquote'], $captcha_code) != 0) && (strcasecmp($_SESSION['captcha_code_requestquotepopup'], $captcha_code) != 0 || empty($_SESSION['captcha_code_requestquotepopup'] ))){  
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('The Validation code does not match!', 'service-finder'),
						);
				echo json_encode($error);
				exit;
			}

			}
			
			if($service_finder_options['request-quote-mail-to'] == 'hold'){
				$status = 'hold';
			}else{
				$status = 'approved';
			}
			$data = array(
					'provider_id' => $provider_id,
					'date' => date('Y-m-d h:i:s'),
					'name' => $customer_name,
					'email' => $customer_email,
					'phone' => $phone,
					'message' => $description,
					'status' => $status,
					);

			$wpdb->insert($service_finder_Tables->quotations,wp_unslash($data));
			
			$getProvider = new SERVICE_FINDER_searchProviders();
			$providerInfo = $getProvider->service_finder_getProviderInfo(esc_attr($provider_id));
			
			$adminemail = get_option( 'admin_email' );

			if(!empty($service_finder_options['quote-to-provider'])){
				$message = $service_finder_options['quote-to-provider'];
			}else{
				$message = 'Requesting for Quotation

Customer Name: %CUSTOMERNAME%

Email: %EMAIL%

Phone: %PHONE%

Description: %DESCRIPTION%
';
			}
			
			if(!empty($service_finder_options['quote-to-admin'])){
				$adminmessage = $service_finder_options['quote-to-admin'];
			}else{
				$adminmessage = 'Requesting for Quotation for provider

Provider Name: %PROVIDERNAME%

Provider Email: %PROVIDEREMAIL%

Customer Name: %CUSTOMERNAME%

Email: %EMAIL%

Phone: %PHONE%

Description: %DESCRIPTION%
';
			}
			
			$userLink = service_finder_get_author_url($provider_id);
			
			$tokens = array('%PROVIDERNAME%','%PROVIDEREMAIL%','%CUSTOMERNAME%','%EMAIL%','%PHONE%','%DESCRIPTION%');
			$replacements = array(service_finder_get_providername_with_link($provider_id),'<a href="mailto:'.$providerInfo->email.'">'.$providerInfo->email.'</a>',$customer_name,$customer_email,$phone,$description);
			$msg_body = str_replace($tokens,$replacements,$message);
			$adminmsg_body = str_replace($tokens,$replacements,$adminmessage);
			if($service_finder_options['quote-to-provider-subject'] != ""){
				$msg_subject = $service_finder_options['quote-to-provider-subject'];
			}else{
				$msg_subject = esc_html__('Request a Quotation', 'service-finder');
			}
			if($service_finder_options['quote-to-admin-subject'] != ""){
				$adminmsg_subject = $service_finder_options['quote-to-admin-subject'];
			}else{
				$adminmsg_subject = esc_html__('Request a Quotation for provider', 'service-finder');
			}
			
			$msg = (!empty($service_finder_options['get-quote'])) ? $service_finder_options['get-quote'] : esc_html__('Message has been sent', 'service-finder');
			
			if($service_finder_options['request-quote-mail-to'] == 'provider'){
				
				if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body)) {
					$success = array(
							'status' => 'success',
							'suc_message' => $msg
							);
					echo json_encode($success);
				} else {
					$error = array(
							'status' => 'error',
							'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
							);
					echo json_encode($error);
				}
			
			}elseif($service_finder_options['request-quote-mail-to'] == 'admin' || $service_finder_options['request-quote-mail-to'] == 'hold'){
			
				if(service_finder_wpmailer($adminemail,$adminmsg_subject,$adminmsg_body)) {
					$success = array(
							'status' => 'success',
							'suc_message' => $msg
							);
					echo json_encode($success);
				} else {
					$error = array(
							'status' => 'error',
							'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
							);
					echo json_encode($error);
				}
			
			}elseif($service_finder_options['request-quote-mail-to'] == 'both'){
			
				if(service_finder_wpmailer($providerInfo->email,$msg_subject,$msg_body) && service_finder_wpmailer($adminemail,$adminmsg_subject,$adminmsg_body)) {
					$success = array(
							'status' => 'success',
							'suc_message' => $msg
							);
					echo json_encode($success);
				} else {
					$error = array(
							'status' => 'error',
							'err_message' => esc_html__('Message could not be sent.', 'service-finder'),
							);
					echo json_encode($error);
				}

			}
			
			
		}
				
}