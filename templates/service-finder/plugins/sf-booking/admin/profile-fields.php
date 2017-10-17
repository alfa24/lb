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
$service_finder_options = get_option('service_finder_options');
if($args != 'add-new-user'){
$userid = ($args->ID) ? $args->ID : 0;
if(service_finder_getUserRole($userid) != 'Provider'){
	$style = 'style="display:none;"';
	}else{
	$style = '';
	}
$userInfo = service_finder_getUserInfo($userid);	
}else{
	$style = 'style="display:none;"';
	$userid = 0;
}

$screen = get_current_screen();
if($screen->base == 'user-edit' && $userid > 0){
$getcity = (!empty($userInfo['city'])) ? esc_html($userInfo['city']) : '';
wp_add_inline_script( 'service_finder-js-manage-signup', '/*Declare global variable*/
var mycity = "'.$getcity.'"; var currentrole = "'.service_finder_getUserRole($userid).'"', 'after' );
}elseif($screen->base == 'user' && $screen->action == 'add'){
wp_add_inline_script( 'service_finder-js-manage-signup', '/*Declare global variable*/
var mycity;', 'after' );
}
?>
<!--Template for Add new maid-->
<table class="form-table bx-cleaner" <?php echo $style; ?>>
<tr class="form-field form-required">
<th><label for="company_name"><?php esc_html_e('Company Name', 'service-finder'); ?></label></th>
<td>
<input name="signup_company_name" type="text" class="regular-text form-control" id="signup_company_name" value="<?php echo (!empty($userInfo['company_name'])) ? esc_html($userInfo['company_name']) : ''; ?>">
</td>
</tr>
<tr class="form-field form-required">
<th><label for="address"><?php esc_html_e('Address', 'service-finder'); ?></label></th>
<td>
<input type="text" class="form-control" name="signup_address" id="signup_address" value="<?php echo (!empty($userInfo['simpleaddress'])) ? esc_html($userInfo['simpleaddress']) : ''; ?>">
</td>
</tr>
<tr class="form-field form-required">
<th><label for="country"><?php esc_html_e('Country', 'service-finder'); ?></label></th>
<td>
<?php
if($screen->base == 'user' && $screen->action == 'add'){
$disable = 'readonly="readonly"';
$placeholder = esc_html__('City (Select country to enable auto suggestion)','service-finder');
}else{
$disable = '';
$placeholder = esc_html__('City (Please select city from auto suggestion)','service-finder');
}
?>
<select class="form-control" name="signup_country" data-live-search="true" title="<?php esc_html_e('Country', 'service-finder'); ?>" id="signup_country">
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
 $totalcountry = count($countryarr);
 if($countryarr){
	foreach($countryarr as $key){
	
		if($totalcountry == 1){
			$select = 'selected="selected"';
			$disable = '';
			$placeholder = esc_html__('City (Please select city from auto suggestion)','service-finder');
		}else{
			if($selectedcountry == $countries[$key]){
			$select = 'selected="selected"';
			}else{
			$select = '';
			}
		}
		echo '<option '.$select.' value="'.esc_attr($countries[$key]).'" data-code="'.esc_attr($key).'">'. $countries[$key].'</option>';
	}
 }
}
?>
</select>
</td>
</tr>
<tr class="form-field form-required">
<th><label for="city"><?php esc_html_e('City', 'service-finder'); ?></label></th>
<td id="autocity">
<div class="sf-admin-city">
<input type="text" <?php echo esc_attr($disable); ?> class="form-control" name="signup_city" id="signup_city" placeholder="<?php echo esc_attr($placeholder); ?>" autocomplete="off" value="<?php echo (!empty($userInfo['city'])) ? esc_html($userInfo['city']) : ''; ?>"> 
</div>
</td>
</tr>
<tr class="form-field">
<th><label for="apt"><?php esc_html_e('Apt/Suite #', 'service-finder'); ?></label></th>
<td>
<input type="text" class="form-control" name="signup_apt" value="<?php echo (!empty($userInfo['apt'])) ? esc_html($userInfo['apt']) : ''; ?>">
</td>
</tr>
<tr class="form-field">
<th><label for="state"><?php esc_html_e('State', 'service-finder'); ?></label></th>
<td>
<input type="text" class="form-control" name="signup_state" id="signup_state" value="<?php echo (!empty($userInfo['state'])) ? esc_html($userInfo['state']) : ''; ?>">
</td>
</tr>
<tr class="form-field">
<th><label for="zipcode"><?php esc_html_e('Postal Code', 'service-finder'); ?></label></th>
<td>
<input type="text" class="form-control" name="signup_zipcode" id="signup_zipcode" value="<?php echo (!empty($userInfo['zipcode'])) ? esc_html($userInfo['zipcode']) : ''; ?>">
</td>
</tr>
<tr class="form-field form-required">
<th><label for="category"><?php esc_html_e('Select Primary Category', 'service-finder'); ?></label></th>
<td>
<select class="form-control" name="signup_category" id="signup_category" data-live-search="true" title="Category">
<option value="">
<?php esc_html_e('Select Category', 'service-finder'); ?>
</option>
<?php
if(class_exists('service_finder_texonomy_plugin')){
$limit = 1000;
$categories = service_finder_getCategoryList($limit);
$texonomy = 'providers-category';
if(!empty($categories)){
$selectedcategory = get_user_meta($userid,'primary_category',true);
    foreach($categories as $category){
    $term_id = (!empty($category->term_id)) ? $category->term_id : '';
    $term_name = (!empty($category->name)) ? $category->name : '';
	if($selectedcategory == $term_id){
	$select = 'selected="selected"';
	}else{
	$select = '';
	}
    echo '<option '.$select.' value="'.esc_attr($term_id).'" data-content="<span>'.esc_attr($term_name).'</span>">'. $term_name.'</option>';
    
    $term_children = get_term_children($term_id,$texonomy);
    if(!empty($term_children)){
        foreach($term_children as $term_child_id) {

            $term_child = get_term_by('id',$term_child_id,$texonomy);

            $term_child_id = (!empty($term_child_id)) ? $term_child_id : '';
            $term_childname = (!empty($term_child->name)) ? $term_child->name : '';
			if($selectedcategory == $term_child_id){
			$selectchild = 'selected="selected"';
			}else{
			$selectchild = '';
			}
            echo '<option '.$selectchild.' value="'.esc_attr($term_child_id).'" data-content="<span class=\'childcat\'>'.esc_attr($term_childname).'</span>">'. $term_childname.'</option>';
            
        }
    }
    
    }
}	
}
?>
</select>
</td>
</tr>
<tr class="form-field">
<th><label for="package"><?php esc_html_e('Select Package', 'service-finder'); ?></label></th>
<td>
<select name="provider-role" class="form-control">
<option class="blank" value="">
<?php esc_html_e('No Package', 'service-finder'); ?>
</option>
<?php 
$selectedpackage = get_user_meta($userid,'provider_role',true);
echo service_finder_getPackages($selectedpackage);
?>
</select>
</td>
</tr>
</table>
