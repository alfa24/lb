<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*Add new team member ajax call*/
add_action('wp_ajax_add_new_member', 'service_finder_add_new_member');
add_action('wp_ajax_nopriv_add_new_member', 'service_finder_add_new_member');

function service_finder_add_new_member(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/TeamMembers.php';
$addMember = new SERVICE_FINDER_TeamMembers();
$addMember->service_finder_addMembers($_POST);
exit;
}

/*Load service area for team members*/
add_action('wp_ajax_loadserviceareas', 'service_finder_loadserviceareas');
add_action('wp_ajax_nopriv_loadserviceareas', 'service_finder_loadserviceareas');

function service_finder_loadserviceareas(){
global $wpdb;
$current_user = wp_get_current_user(); 
$user_id = (!empty($_POST['user_id'])) ? $_POST['user_id'] : '';
$sAreas = service_finder_getServiceArea($user_id);
						if(!empty($sAreas)){
							foreach($sAreas as $sArea){
								echo '
<div class="col-lg-3">
  <div class="checkbox">
    <input id="'.esc_attr($sArea->zipcode).'" type="checkbox" name="sarea[]" value="'.esc_attr($sArea->zipcode).'" checked>
    <label for="'.esc_attr($sArea->zipcode).'">'.esc_html($sArea->zipcode).'</label>
  </div>
</div>
';	
							}
						}
exit;
}

/*Load service regions for team members*/
add_action('wp_ajax_loadserviceregions', 'service_finder_loadserviceregions');

function service_finder_loadserviceregions(){
global $wpdb;
$current_user = wp_get_current_user(); 
$user_id = (!empty($_POST['user_id'])) ? $_POST['user_id'] : '';
$regions = service_finder_getServiceRegions($user_id);
						if(!empty($regions)){
							foreach($regions as $region){
								echo '
<div class="col-lg-3">
  <div class="checkbox">
    <input id="'.esc_attr($region->region).'" type="checkbox" name="region[]" value="'.esc_attr($region->region).'" checked>
    <label for="'.esc_attr($region->region).'">'.esc_html($region->region).'</label>
  </div>
</div>
';	
							}
						}
exit;
}

/*Load member for edit*/
add_action('wp_ajax_load_member', 'service_finder_load_member');
add_action('wp_ajax_nopriv_load_member', 'service_finder_load_member');

function service_finder_load_member(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/TeamMembers.php';
$loadMember = new SERVICE_FINDER_TeamMembers();
$loadMember->service_finder_loadMembers($_POST);
exit;
}

/*Edit member ajax call*/
add_action('wp_ajax_edit_member', 'service_finder_edit_member');
add_action('wp_ajax_nopriv_edit_member', 'service_finder_edit_member');

function service_finder_edit_member(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/TeamMembers.php';
$editMember = new SERVICE_FINDER_TeamMembers();
$editMember->service_finder_editMember($_POST);
exit;
}

/*Get member into datatable ajax call*/
add_action('wp_ajax_get_members', 'service_finder_get_members');
add_action('wp_ajax_nopriv_get_members', 'service_finder_get_members');

function service_finder_get_members(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/TeamMembers.php';
$getMember = new SERVICE_FINDER_TeamMembers();
$getMember->service_finder_getMembers($_POST);
exit;
}

/*Delete members*/
add_action('wp_ajax_delete_members', 'service_finder_delete_members');
add_action('wp_ajax_nopriv_delete_members', 'service_finder_delete_members');

function service_finder_delete_members(){
global $wpdb;
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/team-members/TeamMembers.php';
$deleteMember = new SERVICE_FINDER_TeamMembers();
$deleteMember->service_finder_deleteMembers();
exit;
}