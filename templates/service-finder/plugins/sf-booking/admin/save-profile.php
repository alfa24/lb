<?php 
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
global $current_user;
if ( !current_user_can( 'edit_user', $current_user->ID ) ) { return false; }
$signup_user_role = (isset($_POST['role'])) ? $_POST['role'] : '';
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$service_finder_options = get_option('service_finder_options');
if(strtolower($signup_user_role) == 'provider'){
$signup_address = (isset($_POST['signup_address'])) ? $_POST['signup_address'] : '';
$signup_city = (isset($_POST['signup_city'])) ? esc_html($_POST['signup_city']) : '';
$signup_country = (isset($_POST['signup_country'])) ? esc_html($_POST['signup_country']) : '';

$full_address = $signup_address.' '.$signup_city.' '.$signup_country;

$address = str_replace(" ","+",$full_address);
$res = service_finder_getLatLong($address);
$lat = $res['lat'];
$lng = $res['lng'];

if($service_finder_options['account-moderation']){
	$adminapproval = 'pending';
}else{
	$adminapproval = 'approved';
}

$fname = (!empty($_POST['first_name'])) ? esc_html($_POST['first_name']) : '';
$lname = (!empty($_POST['last_name'])) ? esc_html($_POST['last_name']) : '';

$data = array(

			'wp_user_id' => $user_id,

			'admin_moderation' => $adminapproval,
			
			'company_name' => (!empty($_POST['signup_company_name'])) ? esc_html($_POST['signup_company_name']) : '',
			
			'full_name' => $fname.' '.$lname,

			'email' => (!empty($_POST['email'])) ? esc_html($_POST['email']) : '',

			'category_id' => (!empty($_POST['signup_category'])) ? esc_html($_POST['signup_category']) : '',

			'address' => (!empty($_POST['signup_address'])) ? esc_html($_POST['signup_address']) : '',

			'apt' => (!empty($_POST['signup_apt'])) ? esc_html($_POST['signup_apt']) : '',

			'city' => (!empty($_POST['signup_city'])) ? esc_html($_POST['signup_city']) : '',

			'state' => (!empty($_POST['signup_state'])) ? esc_html($_POST['signup_state']) : '',

			'zipcode' => (!empty($_POST['signup_zipcode'])) ? esc_html($_POST['signup_zipcode']) : '',

			'country' => (!empty($_POST['signup_country'])) ? esc_html($_POST['signup_country']) : '',
			
			'lat' => $lat,
			
			'long' => $lng,

		);
$wpdb->insert($service_finder_Tables->providers,wp_unslash($data));

$primarycategory = (!empty($_POST['signup_category'])) ? esc_html($_POST['signup_category']) : '';
update_user_meta($user_id,'primary_category',$primarycategory);



$memberData = array(

'member_name' => $fname.' '.$lname,

'email' => (!empty($_POST['email'])) ? esc_html($_POST['email']) : '',

'admin_wp_id' => esc_html($user_id),

'is_admin' => 'yes',

);

$wpdb->insert($service_finder_Tables->team_members,wp_unslash($memberData));

$roleNum = 1;
$rolePrice = '0';
$free = true;
$price = '0';
$packageName = '';

if(isset($_POST['provider-role'])){
	$role = (!empty($_POST['provider-role'])) ? esc_html($_POST['provider-role']) : '';
	if (($role == "package_0") || ($role == "package_1") || ($role == "package_2") || ($role == "package_3")){
	$roleNum = intval(substr($role, 8));
	switch ($role) {
		case "package_1":
			if(isset($service_finder_options['package1-price'])) {
				$free = false;
				$packageName = $service_finder_options['package1-name'];
				$expire_limit = $service_finder_options['package1-expday'];
				$price = trim($service_finder_options['package1-price']);								
			}
			break;
		case "package_2":
			if(isset($service_finder_options['package2-price'])) {
				$expire_limit = $service_finder_options['package2-expday'];
				$free = false;
				$packageName = $service_finder_options['package2-name'];
				$price = trim($service_finder_options['package2-price']);								
			}
			break;
		case "package_3":
			if(isset($service_finder_options['package3-price'])) {
				$expire_limit = $service_finder_options['package3-expday'];
				$free = false;
				$packageName = $service_finder_options['package3-name'];
				$price = trim($service_finder_options['package3-price']);								
			}
			break;
		default:
			break;
	}

	// free
	$user = new WP_User( $user_id );
	$user->set_role('Provider');
	
	update_user_meta( $user_id, 'provider_activation_time', array( 'role' => $role, 'time' => time()) );
	$roleNum = intval(substr($role, 8));
	$roleName = $service_finder_options['package'.$roleNum.'-name'];
	update_user_meta( $user_id, 'expire_limit', $expire_limit);
	update_user_meta( $user_id, 'provider_role', $role );
	update_user_meta( $user_id, 'created_by', 'admin' );
	
	if($roleNum == 0){
		update_user_meta($userId, 'trial_package', 'yes');
	}
	
	$userInfo = service_finder_getUserInfo($user_id);
	$args = array(
			'username' => (!empty($_POST['user_login'])) ? esc_html($_POST['user_login']) : '',
			'email' => (!empty($_POST['email'])) ? esc_html($_POST['email']) : '',
			'address' => $userInfo['address'],
			'city' => $userInfo['city'],
			'country' => $userInfo['country'],
			'zipcode' => $userInfo['zipcode'],
			'category' => $userInfo['categoryname'],
			'package_name' => $roleName,
			'payment_type' => 'By Admin'
			);
	
	service_finder_sendProviderEmail($args);
	$user_login = (!empty($_POST['user_login'])) ? esc_html($_POST['user_login']) : '';
	$email = (!empty($_POST['email'])) ? esc_html($_POST['email']) : '';
	service_finder_sendRegMailToUser($user_login,$email);

}
}

}elseif(strtolower($signup_user_role) == 'customer'){
	$data = array(
				'wp_user_id' => $user_id,
			);
	$wpdb->insert($service_finder_Tables->customers_data,wp_unslash($data));
}

	
?>