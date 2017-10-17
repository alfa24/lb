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
require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/book-now/BookNow.php';
$userCap = service_finder_get_capability($globalproviderid);

wp_add_inline_script( 'service_finder-js-unavailability-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'after' );

?>
<!--UnAvailability Template-->

<h4>
  <?php echo (!empty($service_finder_options['label-set-unavailability'])) ? esc_html($service_finder_options['label-set-unavailability']) : esc_html__('Set UnAvailability', 'service-finder'); ?>
</h4>
<!--Display UnAvailability Datatable-->
<div class="profile-form-bx">
  <div class="margin-b-30 text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#setunavailability" type="button"><i class="fa fa-plus"></i>
    <?php esc_html_e('Set New UnAvailability', 'service-finder'); ?>
    </button>
  </div>
  <table id="unavilability-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> <div class="checkbox">
            <input type="checkbox" id="bulkUnAvilabilityDelete">
            <label for="bulkUnAvilabilityDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteUnAvilabilityTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php esc_html_e('Date', 'service-finder'); ?></th>
        <th><?php esc_html_e('Day', 'service-finder'); ?></th>
        <th><?php esc_html_e('Timeslots', 'service-finder'); ?></th>
        <th><?php esc_html_e('Whole Day', 'service-finder'); ?></th>
        <th><?php esc_html_e('Action', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!--Template for set Unavailability modal popup box-->
  <div id="setunavailability" class="modal fade" tabindex="-1" role="dialog" data-proid="<?php echo esc_attr($globalproviderid) ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" class="set-new-unavailability">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <?php esc_html_e('Set New UnAvailability', 'service-finder'); ?>
            </h4>
          </div>
          <div class="modal-body clearfix row input_fields_wrap">
            <div class="col-md-12">
              <div class="form-group" id="loadavlcalendar">
                <div id="availability-calendar"></div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-inline">
                <ul class="protimelist list-inline">
                  <?php esc_html_e('Please select timeslot', 'service-finder'); ?>
                </ul>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Whole Day', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="wholeday" type="checkbox" name="wholeday" value="yes">
                  <label for="wholeday">
                  <?php esc_html_e('Yes', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <?php esc_html_e('Cancel', 'service-finder'); ?>
            </button>
            <input type="submit" class="btn btn-primary" name="set-unavailability" value="<?php esc_html_e('Set UnAvailability', 'service-finder'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--Template for edit Unavailability modal popup box-->
  <form method="post" class="edit-unavailability default-hidden" id="editunavailability">
    <div class="clearfix row input_fields_wrap">
      <div class="col-md-12">
        <div class="form-group" id="loadcalendar">
          <div id="editavailability-calendar"></div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group form-inline">
          <ul class="protimelist list-inline">
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group form-inline">
          <label>
          <?php esc_html_e('Whole Day', 'service-finder'); ?>
          </label>
          <br>
          <div class="radio">
            <input id="editwholeday" type="checkbox" name="wholeday" value="yes">
            <label for="editwholeday">
            <?php esc_html_e('Yes', 'service-finder'); ?>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">
      <?php esc_html_e('Cancel', 'service-finder'); ?>
      </button>
      <input type="submit" class="btn btn-primary" name="edit-unavailability" value="<?php esc_html_e('Update', 'service-finder'); ?>" />
    </div>
  </form>
</div>
