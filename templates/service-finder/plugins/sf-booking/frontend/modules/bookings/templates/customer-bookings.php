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
$currUser = wp_get_current_user(); 

wp_add_inline_script( 'service_finder-js-bookings-form', '/*Declare global variable*/
var user_id = "'.$currUser->ID.'";', 'after' );
?>

<h4>
  <?php esc_html_e('Bookings', 'service-finder'); ?>
</h4>
<!--Display customer upcoming/past bookings-->
<div class="booking-list padding-30 bg-white" >
  <div class="tabbable">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#upcoming">
        <?php esc_html_e('Up coming', 'service-finder'); ?>
        </a></li>
      <li><a data-toggle="tab" href="#past">
        <?php esc_html_e('Past', 'service-finder'); ?>
        </a></li>
    </ul>
    <div class="tab-content">
      <!--upcoming bookings-->
      <div id="upcoming" class="tab-pane fade in active">
        <table id="upcomingbookings-customer-grid" class="table table-striped margin-0 booking-listing">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
        <div id="booking-details" class="hidden"> </div>
      </div>
      <!--past bookings-->
      <div id="past" class="tab-pane fade">
        <table id="pastbookings-customer-grid" class="table table-striped margin-0 booking-listing">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </thead>
        </table>
        <div id="pastbooking-details" class="hidden"> </div>
      </div>
    </div>
  </div>
</div>
<!--Add feedback form for bookings-->
<form method="post" class="add-feedback default-hidden" id="addFeedback">
  <div class="clearfix row input_fields_wrap">
    <div class="col-md-12">
      <div class="form-group rating_bx">
        <input id="comment-rating" name="comment-rating" value="" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <textarea name="comment" id="comment" class="form-control" rows="" cols="4" placeholder="<?php esc_html_e('Enter Some Comments', 'service-finder'); ?>"></textarea>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">
    <?php esc_html_e('Cancel', 'service-finder'); ?>
    </button>
    <input type="submit" class="btn btn-primary" name="add-feedback" value="<?php esc_html_e('Submit', 'service-finder'); ?>" />
  </div>
</form>
<!--View feedback for bookings-->
<form method="post" class="view-feedback default-hidden" id="viewFeedback">
  <div class="clearfix row input_fields_wrap">
    <div class="col-md-12">
      <div class="form-group">
        <input id="show-comment-rating" value="" type="number" class="rating" min=0 max=5 step=0.5 data-size="sm" disabled="disabled">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <p id="showcomment"></p>
      </div>
    </div>
  </div>
</form>
<!--Template for edit bookings modal popup box-->
<form method="post" class="edit-booking default-hidden" id="editbooking">
  <div class="clearfix row input_fields_wrap">
    <div class="col-md-12">
      <div class="form-group" id="loadcalendar">
        <div id="editbooking-calendar"></div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group form-inline">
        <ul class="timeslots protimelist list-inline">
        </ul>
        <div class="col-md-12" id="members"> </div>
      </div>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">
    <?php esc_html_e('Cancel', 'service-finder'); ?>
    </button>
    <input type="submit" class="btn btn-primary" name="edit-booking" value="<?php esc_html_e('Update', 'service-finder'); ?>" />
    <input type="hidden" id="boking-slot" data-slot="" name="boking-slot" value="" />
    <input type="hidden" id="memberid" data-memid="" name="memberid" value="" />
    <input type="hidden" id="date" name="date" value="" />
    <input type="hidden" id="booking_id" name="booking_id" value="" />
    <input type="hidden" id="provider" name="provider" value="" />
  </div>
</form>
