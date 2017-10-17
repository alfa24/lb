<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

require SERVICE_FINDER_BOOKING_FRONTEND_MODULE_DIR . '/invoice/Invoice.php';
$currUser = wp_get_current_user();
$invoiceData = new SERVICE_FINDER_Invoice();
$service_finder_options = get_option('service_finder_options');
$customers = $invoiceData->service_finder_getCustomers($globalproviderid);
$services = service_finder_getServices($globalproviderid);

$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customers', 'service-finder');	

wp_add_inline_script( 'service_finder-js-bookings-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'after' );
?>
<!--Booking datatable-->

<h4>
  <?php echo (!empty($service_finder_options['label-bookings'])) ? esc_html($service_finder_options['label-bookings']) : esc_html__('Bookings', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <table id="bookings-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th class="text-nowrap"> <div class="checkbox">
            <input type="checkbox" id="bulkBookingsDelete">
            <label for="bulkBookingsDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteBookingTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php echo esc_html( $customerreplacestring ).' '.esc_html__('Name', 'service-finder'); ?></th>
        <th><?php esc_html_e('Email', 'service-finder'); ?></th>
        <th><?php esc_html_e('Date', 'service-finder'); ?></th>
        <th><?php esc_html_e('Time', 'service-finder'); ?></th>
        <th><?php esc_html_e('Assigned Member', 'service-finder'); ?></th>
        <th><?php esc_html_e('Upcoming or Past', 'service-finder'); ?></th>
        <th><?php esc_html_e('Booking Status', 'service-finder'); ?></th>
        <th><?php esc_html_e('Type', 'service-finder'); ?></th>
        <th><?php esc_html_e('Invoice ID (Wire Transfer)', 'service-finder'); ?></th>
        <th><?php esc_html_e( 'Transaction ID', 'service-finder' ); ?></th>
        <th><?php esc_html_e( 'Payment Type', 'service-finder' ); ?></th>
        <th><?php esc_html_e( 'Payment Status', 'service-finder' ); ?></th>
        <th><?php esc_html_e('Action', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!--Booking details start-->
  <div id="booking-details" class="hidden"> </div>
  <!--Booking details end-->
  <!--Assign member start-->
  <form method="post" class="assign-member default-hidden" id="assignmember">
    <div class="clearfix row input_fields_wrap">
      <div id="allmembers"></div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">
      <?php esc_html_e('Cancel', 'service-finder'); ?>
      </button>
      <input type="hidden" name="memberid" id="memberid">
      <input type="hidden" name="bookingid" id="bookingid">
      <input type="submit" class="btn btn-primary" name="edit-member" value="<?php esc_html_e('Update', 'service-finder'); ?>" />
    </div>
  </form>
  <!--Assign member end-->
</div>
<!-- Modal Add Invoice-->
<form method="post" class="add-booking-invoice default-hidden" id="addBookingInvoice">
  <div class="col-md-6">
    <div class="form-group">
      <label>
      <?php esc_html_e('Reference No', 'service-finder'); ?>
      </label>
      <div class="input-group"> <i class="input-group-addon fixed-w fa fa-random gen_ref"></i>
        <input name="refno" type="text" class="form-control" placeholder="">
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group">
      <label>
      <?php esc_html_e('Due Date', 'service-finder'); ?>
      </label>
      <div class="input-group input-append date dueDatePicker"> <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
        <input type="text" class="form-control" name="dueDate" placeholder="<?php esc_html_e('Due Date', 'service-finder'); ?>" />
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group has-select">
      <select title="<?php echo esc_html( $customerreplacestring ); ?>" name="customer" class="form-control">
        <option value="">
        <?php esc_html_e('Select', 'service-finder').' '.esc_html( $customerreplacestring ); ?>
        </option>
        <?php 
								if(!empty($customers)){
									foreach($customers as $customer){
										echo '<option value="'.esc_attr($customer->email).'">'.$customer->name.' ('.$customer->email.')</option>';
									}	
								}
								?>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group has-select">
      <select title="Status" name="status" class="form-control">
        <option value="canceled">
        <?php esc_html_e('Canceled', 'service-finder'); ?>
        </option>
        <option value="overdue">
        <?php esc_html_e('Overdue', 'service-finder'); ?>
        </option>
        <option value="paid">
        <?php esc_html_e('Paid', 'service-finder'); ?>
        </option>
        <option value="pending">
        <?php esc_html_e('Pending', 'service-finder'); ?>
        </option>
      </select>
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-inline">
      <label class="help-block">
      <?php esc_html_e('Discount', 'service-finder'); ?>
      </label>
      <div class="radio">
        <input id="dis-booking-fix" type="radio" name="discount-type" value="fix" checked>
        <label for="dis-booking-fix">
        <?php esc_html_e('Fix', 'service-finder'); ?>
        </label>
      </div>
      <div class="radio">
        <input id="dis-booking-percentage" type="radio" name="discount-type" value="percentage">
        <label for="dis-booking-percentage">
        <?php esc_html_e('Percentage', 'service-finder'); ?>
        </label>
      </div>
    </div>
    <div class="form-group">
      <input name="discount" type="text" class="form-control" placeholder="<?php esc_html_e('Discount Amount/Percentage', 'service-finder'); ?>">
    </div>
  </div>
  <div class="col-md-6">
    <div class="form-group form-inline">
      <label class="help-block">
      <?php esc_html_e('Tax', 'service-finder'); ?>
      </label>
      <div class="radio">
        <input id="tax-booking-fix" type="radio" name="tax-type" value="fix" checked>
        <label for="tax-booking-fix">
        <?php esc_html_e('Fix', 'service-finder'); ?>
        </label>
      </div>
      <div class="radio">
        <input id="tax-booking-percentage" type="radio" name="tax-type" value="percentage">
        <label for="tax-booking-percentage">
        <?php esc_html_e('Percentage', 'service-finder'); ?>
        </label>
      </div>
    </div>
    <div class="form-group">
      <input name="tax" type="text" class="form-control" placeholder="<?php esc_html_e('Tax Amount/Percentage', 'service-finder'); ?>">
    </div>
  </div>
  <div class="col-md-12">
    <div class="servicearea-group">
      <div class="form-group clearfix ">
        <div class="col-xs-3">
          <select title="Services" name="service_title[0]" data-index="0" class="form-control">
            <option value="new">
            <?php esc_html_e('Bookings', 'service-finder'); ?>
            New</option>
            <?php 
											if(!empty($services)){
												foreach($services as $service){
													echo '<option value="'.esc_attr($service->id).'">'.stripcslashes($service->service_name).'</option>';
												}	
											}
											?>
          </select>
        </div>
        <div class="col-xs-3">
          <div class="form-group form-inline text-nowrap">
            <div class="radio">
              <input id="fix-booking-price[0]" type="radio" data-index="0" name="cost_type[0]" value="fix" checked>
              <label for="fix-booking-price[0]">
              <?php esc_html_e('Fix', 'service-finder'); ?>
              </label>
            </div>
            <div class="radio">
              <input id="hourly-booking-price[0]" type="radio" data-index="0" name="cost_type[0]" value="hourly">
              <label for="hourly-booking-price[0]">
              <?php esc_html_e('Hour', 'service-finder'); ?>
              </label>
            </div>
            <div class="num-hours default-hidden num-hrs-btn-in">
              <input class="service-num-hours" data-index="0" type="text" value="1" name="num_hours[0]">
            </div>
          </div>
        </div>
        <div class="col-xs-3">
          <input type="text" name="service_desc[0]" data-index="0" class="form-control" placeholder="<?php esc_html_e('Description', 'service-finder'); ?>">
        </div>
        <div class="col-xs-2">
          <input type="text" name="service_price[0]" data-index="0" class="form-control text-right" placeholder="<?php esc_html_e('Price', 'service-finder'); ?>">
        </div>
        <div class="col-xs-1">
          <button type="button" class="btn btn-default addButton"><i class="fa fa-plus"></i></button>
        </div>
      </div>
      <!-- The template for adding new field -->
      <div class="form-group hide clearfix " id="serviceBookingTemplate">
        <div class="col-xs-3 col-xs-offset-1">
          <select title="Services" name="service_title" data-index="" class="form-control servicedrp">
            <option value="new">
            <?php esc_html_e('New Service', 'service-finder'); ?>
            </option>
            <?php 
											if(!empty($services)){
												foreach($services as $service){
													echo '<option value="'.esc_attr($service->id).'">'.stripcslashes($service->service_name).'</option>';
												}	
											}
											?>
          </select>
        </div>
        <div class="col-xs-3">
          <div class="form-group form-inline text-nowrap">
            <div class="radio">
              <input id="fix-booking-price" type="radio" data-index="" name="cost_type" value="fix" checked>
              <label for="fix-booking-price">
              <?php esc_html_e('Fix', 'service-finder'); ?>
              </label>
            </div>
            <div class="radio">
              <input id="hourly-booking-price" type="radio" data-index="" name="cost_type" value="hourly">
              <label for="hourly-booking-price">
              <?php esc_html_e('Hour', 'service-finder'); ?>
              </label>
            </div>
            <div class="num-hours default-hidden num-hrs-btn-in">
              <input class="service-num-hours num_hours2" type="text" data-index="" value="1" name="num_hours">
            </div>
          </div>
        </div>
        <div class="col-xs-3">
          <input type="text" name="service_desc" data-index="" class="form-control" placeholder="<?php esc_html_e('Description', 'service-finder'); ?>">
        </div>
        <div class="col-xs-2">
          <input type="text" name="service_price" data-index="" class="form-control text-right" placeholder="<?php esc_html_e('Price', 'service-finder'); ?>">
        </div>
        <div class="col-xs-1">
          <button type="button" class="btn btn-default removeButton"><i class="fa fa-minus"></i></button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 margin-b-30">
    <div class="sf-summary-lists">
    <div class="well well-sm margin-0">
      <h5 class="margin-0">
        <?php esc_html_e('Amount', 'service-finder'); ?>
        <span id="total_amount" class="pull-right">0.00</span></h5>
    </div>
    <div class="well well-sm margin-0">
      <h5 class="margin-0">
        <?php esc_html_e('Discount', 'service-finder'); ?>
        <span id="total_discount" class="pull-right">0.00</span></h5>
    </div>
    <div class="well well-sm margin-0">
      <h5 class="margin-0">
        <?php esc_html_e('Tax', 'service-finder'); ?>
        <span id="total_tax" class="pull-right">0.00</span></h5>
    </div>
    <div class="well well-sm margin-0">
      <h5 class="margin-0">
        <?php esc_html_e('Total', 'service-finder'); ?>
        <span id="grand_total" class="pull-right">0.00</span></h5>
    </div>
    </div>
  </div>
  <div class="col-md-12">
    <div class="form-group">
      <textarea name="short-desc" cols="" rows="3+" class="form-control" placeholder="<?php esc_html_e('Enter text', 'service-finder'); ?>"></textarea>
    </div>
  </div>
  <div class="col-md-12">
    <input name="" type="submit" class="btn btn-primary" value="<?php esc_html_e('Submit', 'service-finder'); ?>">
  </div>
</form>
<!-- Modal Add Invoice END-->
