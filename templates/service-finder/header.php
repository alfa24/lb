<?php
ob_start();
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$service_finder_ThemeParams = service_finder_global_params('service_finder_ThemeParams');
$service_finder_options = get_option('service_finder_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="format-detection" content="telephone=no">
<!--[if IE 7 ]>  <html class="isie ie7 oldie no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>  <html class="isie ie8 oldie no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>  <html class="isie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!-- Favicons Icon -->
<?php service_finder_fav_icon();//Favicon  ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
							$registerErrors = service_finder_global_params('registerErrors');
							$bookingcompleted = (isset($_GET['bookingcompleted'])) ? esc_html($_GET['bookingcompleted']) : '';
							$invoicepaidcompleted = (isset($_GET['invoicepaidcompleted'])) ? esc_html($_GET['invoicepaidcompleted']) : '';
							$upgrade = (isset($_GET['upgrade'])) ? esc_html($_GET['upgrade']) : '';
							$cancelsubscription = (isset($_GET['cancelsubscription'])) ? esc_html($_GET['cancelsubscription']) : '';
							$cancelfeatured = (isset($_GET['cancelfeatured'])) ? esc_html($_GET['cancelfeatured']) : '';
							$featured = (isset($_GET['featured'])) ? esc_html($_GET['featured']) : '';
							$created = (isset($_GET['created'])) ? esc_html($_GET['created']) : '';
							$signup = (isset($_GET['signup'])) ? esc_html($_GET['signup']) : '';
							$joblimitplanupdate = (isset($_GET['joblimitplanupdate'])) ? esc_html($_GET['joblimitplanupdate']) : '';
							$registration = (isset($_GET['registration'])) ? esc_html($_GET['registration']) : '';
							$allowedhtml = array(
								'div' => array(
									'class' => array(),
								),
							);
							if( is_wp_error( $registerErrors ) ) {
								echo '<div class="alert alert-danger sf-error-top">'.$registerErrors->get_error_message().'</div>';
							}
							if($registration == 'cancelled') {
							
								echo '<div class="alert alert-danger sf-success-top">'.esc_html__("You canceled payment. Your account wasn't created","service-finder").'</div>';
							}
							$checkpae = service_finder_get_id_by_shortcodefortheme('[service_finder_thank_you]');
							if($bookingcompleted == 'success' && (!is_page(service_finder_get_id_by_shortcodefortheme('[service_finder_thank_you]')) || empty($checkpae))) {
							
							$msg = (!empty($service_finder_options['provider-booked'])) ? $service_finder_options['provider-booked'] : esc_html__('Booking made successfully.', 'service-finder');
							
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($invoicepaidcompleted == 'success' && (!is_page(service_finder_get_id_by_shortcodefortheme('[service_finder_thank_you]')) || empty($checkpae))) {
							$msg = (!empty($service_finder_options['pay-invoice'])) ? $service_finder_options['pay-invoice'] : esc_html__('Invoice paid successfully', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($upgrade == 'success'){
								$msg = (!empty($service_finder_options['provider-upgrade-successfull'])) ? $service_finder_options['provider-upgrade-successfull'] : esc_html__('Your account has been upgraded succssfully', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($upgrade == 'failed'){
								$msg = (!empty($service_finder_options['provider-upgrade-failed'])) ? $service_finder_options['provider-upgrade-failed'] : esc_html__('Your account upgrade failed.', 'service-finder');
								echo '<div class="alert alert-danger sf-success-top">'.esc_html($msg).'</div>';
							}elseif($cancelsubscription == 'success'){
								$msg = (!empty($service_finder_options['subscription-cancel'])) ? $service_finder_options['subscription-cancel'] : esc_html__('Subscription Cancelled successfully.', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($cancelfeatured == 'success'){
								$msg = (!empty($service_finder_options['featured-cancel'])) ? $service_finder_options['featured-cancel'] : esc_html__('Featured/Featured Request Cancelled successfully.', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($featured == 'success'){
								$msg = (!empty($service_finder_options['feature-payment'])) ? $service_finder_options['feature-payment'] : esc_html__('Your profile is featured now', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($created == 'success'){
								$msg = (!empty($service_finder_options['provider-signup-successfull'])) ? $service_finder_options['provider-signup-successfull'] : esc_html__('Your account has been created', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($signup == 'success'){
								$msg = (!empty($service_finder_options['customer-signup-successfull'])) ? $service_finder_options['customer-signup-successfull'] : esc_html__('Your account has been created', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}elseif($joblimitplanupdate == 'success'){
								$msg = (!empty($service_finder_options['jobapply-limit-successfull'])) ? $service_finder_options['jobapply-limit-successfull'] : esc_html__('Your job apply limit updated succssfully', 'service-finder');
								echo '<div class="alert alert-success sf-success-top">'.esc_html($msg).'</div>';
							}
							?>

<div class="page-wraper">
<!-- header -->
<?php
		if(is_search() && ($_GET['s'] == "" && (isset($_GET['keyword']) || isset($_GET['searchAddress']) || isset($_GET['catid']) || isset($_GET['country']) || isset($_GET['city']))) && $service_finder_options['search-template'] == 'style-2'){
service_finder_header_layout_searchmapstyle($author);		
		}else{
service_finder_header_layout($author);		
		}
        ?>
<!-- header END -->
