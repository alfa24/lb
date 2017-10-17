<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Params = service_finder_plugin_global_vars('service_finder_Params');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');

$days = array('monday','tuesday','wednesday','thursday','friday','saturday','sunday');


?>
<!--Availability Template-->

<h4>
  <?php echo (!empty($service_finder_options['label-business-hours'])) ? esc_html($service_finder_options['label-business-hours']) : esc_html__('Business Hours', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <div class="auther-availability form-inr clearfix">
    <p>
      <?php esc_html_e('Set Up business hours for each week day', 'service-finder'); ?>
    </p>
    <div class="tabbable tabs-left">
      <ul class="nav nav-tabs col-md-3 col-sm-3 padding-0" id="subTabHours">
        <?php foreach($days as $day){ 

                                                $class = ($day == 'monday') ? 'active' : '';
												switch($day){
												case 'monday':
													$dayname = esc_html__('Monday','service-finder');
													break;
												case 'tuesday':
													$dayname = esc_html__('Tuesday','service-finder');
													break;
												case 'wednesday':
													$dayname = esc_html__('Wednesday','service-finder');
													break;
												case 'thursday':
													$dayname = esc_html__('Thursday','service-finder');
													break;
												case 'friday':
													$dayname = esc_html__('Friday','service-finder');
													break;
												case 'saturday':
													$dayname = esc_html__('Saturday','service-finder');
													break;
												case 'sunday':
													$dayname = esc_html__('Sunday','service-finder');
													break;						
												}

												echo '<li class="'.sanitize_html_class($class).'"><a data-toggle="tab" href="#bh-'.$day.'">'.$dayname.'</a></li>';

                                                }?>
      </ul>
      <div class="tab-content col-md-9 col-sm-9 padding-0 business-hrs-min-in">
        <?php 

   

										   foreach($days as $day){
											$currUser = wp_get_current_user();
											$res = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->business_hours.' where day = "%s" AND provider_id = %d',$day,$globalproviderid));		
											$from = '';
											$to = '';
											$check = '';
											if(!empty($res)){
											if($res->offday == 'yes'){
											$check = 'checked="checked"';
											}else{
											$check = '';
											}
											if($res->from_time != ""){
											$from = $res->from_time;
											}
											if($res->to_time != ""){
											$to = $res->to_time;
											}
											if($res->offday == 'yes'){
											$from = '';
											$to = '';
											}
											}
										   ?>
        <div id="bh-<?php echo esc_attr($day); ?>" class="tab-pane <?php echo ($day == 'monday') ? 'active' : '';?>">
          <div class="tabs-inr">
            <form class="form-business-hours input_pro_slots <?php echo esc_attr($day); ?>-timeslots" id="<?php echo esc_attr($day); ?>-business-hours" method="post">
              <div class="clearfix">
                  <div class="col-lg-6">
                      <label>
                      <?php esc_html_e('From', 'service-finder'); ?>
                      </label>
                        <select name="from_time">
                          <option value="">
                          <?php esc_html_e('Select Time', 'service-finder'); ?>
                          </option>
                          <?php service_finder_getHours($from); ?>
                        </select>
                  </div>
                  <div class="col-lg-6">
                      <label>
                      <?php esc_html_e('To', 'service-finder'); ?>
                      </label>
                        <select name="to_time">
                          <option value="">
                          <?php esc_html_e('Select Time', 'service-finder'); ?>
                          </option>
                          <?php service_finder_getHours($to); ?>
                        </select>
                  </div>
              </div>
              <br />
              <div class="col-lg-12">
                <div class="form-group form-inline">
                  <div class="checkbox">
                    <input <?php echo esc_attr($check); ?> type="checkbox" value="yes" name="offday" id="<?php echo esc_attr($day); ?>-offday">
                    <label for="<?php echo esc_attr($day); ?>-offday">
                    <?php esc_html_e('OFF', 'service-finder'); ?>
                    </label>
                  </div>
                </div>
              </div>
              <input type="hidden" name="user_id" value="<?php echo esc_attr($globalproviderid); ?>" />
              <div class="col-lg-12">
                <div class="form-group">
                  <button class="btn btn-primary margin-r-10" name="Save" type="submit" >
                  <?php esc_html_e('Submit', 'service-finder'); ?>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <?php

										   }

										   ?>
      </div>
    </div>
  </div>
</div>
