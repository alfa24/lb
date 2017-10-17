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
/*Get Quote Ajax Call*/
add_action('wp_ajax_get_quotation', 'service_finder_get_quotation');
add_action('wp_ajax_nopriv_get_quotation', 'service_finder_get_quotation');

function service_finder_get_quotation(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/get-quote/GetQuote.php';
$reqQuote = new SERVICE_FINDER_GetQuote();
$provider_id = (!empty($_POST['provider_id'])) ? $_POST['provider_id'] : '';
$proid = (!empty($_POST['proid'])) ? $_POST['proid'] : '';
$proid = ($provider_id != "") ? $provider_id : $proid;
$reqQuote->service_finder_get_quote_mail($proid,$_POST['customer_name'],$_POST['customer_email'],$_POST['phone'],$_POST['description'],$_POST['captcha_code'],$_POST['captchaon']);
exit;
} 