<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
?>
<?php
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$service_finder_options = get_option('service_finder_options');

$signupautosuggestion = (!empty($service_finder_options['signup-auto-suggestion'])) ? esc_html($service_finder_options['signup-auto-suggestion']) : '';
$show_signup_otp = (!empty($service_finder_options['show-signup-otp'])) ? esc_html($service_finder_options['show-signup-otp']) : '';

$countryarr = (!empty($service_finder_options['allowed-country'])) ? $service_finder_options['allowed-country'] : '';
$totalcountry = count($countryarr);

wp_add_inline_script( 'service_finder-js-branches-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";
var totalcountry = "'.$totalcountry.'";
var signupautosuggestion = "'.$signupautosuggestion.'";
', 'after' );

$currUser = wp_get_current_user(); 
?>

<h4>
  <?php echo (!empty($service_finder_options['label-our-branches'])) ? esc_html($service_finder_options['label-our-branches']) : esc_html__('Our Branches', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <div class="margin-b-30 text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addbranch" type="button"><i class="fa fa-plus"></i>
    <?php esc_html_e('ADD NEW BRANCH', 'service-finder'); ?>
    </button>
  </div>
  <!--Display Services into datatable-->
  <table id="branches-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> <div class="checkbox">
            <input type="checkbox" id="bulkBranchDelete">
            <label for="bulkBranchDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteBranchTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php esc_html_e('Address', 'service-finder'); ?></th>
        <th><?php esc_html_e('Apt/Suite', 'service-finder'); ?></th>
        <th><?php esc_html_e('City', 'service-finder'); ?></th>
        <th><?php esc_html_e('State', 'service-finder'); ?></th>
        <th><?php esc_html_e('Country', 'service-finder'); ?></th>
        <th><?php esc_html_e('Zipcode', 'service-finder'); ?></th>
        <th><?php esc_html_e('Action', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!-- Add Branch Modal Popup Box-->
  <div id="addbranch" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <?php esc_html_e('Add New Branch', 'service-finder'); ?>
            </h4>
          </div>
        <form method="post" class="add-new-branch">
          <div class="modal-body clearfix row input_fields_wrap">
            <div class="col-md-12">
            <div class="form-group">
              <input type="text" class="form-control" name="signup_address" id="signup_address" placeholder="<?php esc_html_e('Address', 'service-finder'); ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <?php
              $readonly = 'readonly="readonly"';
              $disabled = 'disabled="disabled"';
              $placeholder = esc_html__('City (Select country to enable)','service-finder');
              ?>
              <select class="form-control" name="signup_country" data-live-search="true" title="<?php esc_html_e('Country', 'service-finder'); ?>" id="signup_country">
              <option value="">
                <?php esc_html_e('Select Country', 'service-finder'); ?>
                </option>
              <?php
              $allcountry = (!empty($service_finder_options['all-countries'])) ? $service_finder_options['all-countries'] : '';
              $countries = service_finder_get_countries();
              if($allcountry){
                  if(!empty($countries)){
                    foreach($countries as $key => $country){
                        echo '<option value="'.esc_attr($country).'" data-code="'.esc_attr($key).'">'. $country.'</option>';
                    }
                  }
              }else{
                 $countryarr = (!empty($service_finder_options['allowed-country'])) ? $service_finder_options['allowed-country'] : '';
                 $totalcountry = count($countryarr);
                 if($countryarr){
                    foreach($countryarr as $key){
                    if($totalcountry == 1){
                        $select = 'selected="selected"';
                        $readonly = '';
                        $disabled = '';
                        $placeholder = esc_html__('Plz select city from suggestion','service-finder');
                    }else{
                        $select = '';
                    }
                        echo '<option '.$select.' value="'.esc_attr($countries[$key]).'" data-code="'.esc_attr($key).'">'. $countries[$key].'</option>';
                    }
                 }
              }
              ?>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" id="autocity">
            <?php if($signupautosuggestion){ ?>
              <input type="text" class="form-control" name="signup_city" placeholder="<?php echo $placeholder; ?>" <?php echo $readonly; ?> id="signup_city" autocomplete="off" placeholder="<?php esc_html_e('City', 'service-finder'); ?>">
            <?php }else{ ?>
            <select <?php echo $readonly; ?> <?php echo $disabled; ?> class="form-control" name="signup_city" data-live-search="true" title="<?php echo $placeholder; ?>" id="signup_city">
              <option value="">
                <?php esc_html_e('Select City', 'service-finder'); ?>
                </option>
              </select>
            <?php } ?>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="signup_apt" placeholder="<?php esc_html_e('Apt/Suite #', 'service-finder'); ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="signup_state" id="signup_state" placeholder="<?php esc_html_e('State', 'service-finder'); ?>">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" class="form-control" name="signup_zipcode" id="signup_zipcode" placeholder="<?php esc_html_e('Postal Code', 'service-finder'); ?>">
            </div>
          </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <?php esc_html_e('Cancel', 'service-finder'); ?>
            </button>
            <input type="submit" class="btn btn-primary" name="add-service" value="<?php esc_html_e('Add New Branch', 'service-finder'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
