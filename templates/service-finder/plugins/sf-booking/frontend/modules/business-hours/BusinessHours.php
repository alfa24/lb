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

class SERVICE_FINDER_BusinessHours{

	/*Save Business Hours*/
	public function service_finder_addBusinessHours($bhs = ''){

			global $wpdb, $service_finder_Tables;
			$currUser = wp_get_current_user(); 
			$user_id = (!empty($bhs['user_id'])) ? $bhs['user_id'] : '';
			$res = $wpdb->get_row('SELECT * FROM '.$service_finder_Tables->business_hours.' where day = "'.$bhs['day'].'" AND provider_id = '.$user_id);
			
			if(empty($res)){
			$dataset = array(
								'provider_id' => esc_attr($user_id),
								'day' => $bhs['day'],
								'from_time' => esc_attr($bhs['from_time'].':00'),
								'to_time' => esc_attr($bhs['to_time'].':00'),
								'offday' => (!empty($bhs['offday'])) ? esc_attr($bhs['offday']) : '',
								);
			/*Insert Business Hours into DB*/
			$wpdb->insert($service_finder_Tables->business_hours,wp_unslash($dataset));
			
			$bhid = $wpdb->insert_id;
			
			if ( ! $bhid ) {
				$adminemail = get_option( 'admin_email' );
				$allowedhtml = array(
					'a' => array(
						'href' => array(),
						'title' => array()
					),
				);
				$error = array(
						'status' => 'error',
						'err_message' => sprintf( wp_kses(esc_html__('Couldn&#8217;t add business hours... please contact the <a href="mailto:%s">Administrator</a> !', 'service-finder'),$allowedhtml), $adminemail )
						);
				echo json_encode($error);
			}else{
				$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Business hours added successfully.', 'service-finder'),
						);
				echo json_encode($success);
			}
			
			}else{
			$dataset = array(
								'provider_id' => esc_attr($user_id),
								'day' => $bhs['day'],
								'from_time' => esc_attr($bhs['from_time'].':00'),
								'to_time' => esc_attr($bhs['to_time'].':00'),
								'offday' => (!empty($bhs['offday'])) ? esc_attr($bhs['offday']) : '',
								);
			$where = array(
								'id' => $res->id
								);								
			/*Insert Business Hours into DB*/
			$wpdb->update($service_finder_Tables->business_hours,wp_unslash($dataset),$where);
			
			$success = array(
						'status' => 'success',
						'suc_message' => esc_html__('Business hours updated successfully.', 'service-finder'),
						);
				echo json_encode($success);
			}
			
			
			
		
		}
}