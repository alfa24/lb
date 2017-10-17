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

wp_add_inline_script( 'service_finder-js-schedule-form', '/*Declare global variable*/
var user_id = "'.$currUser->ID.'";', 'after' );

wp_add_inline_script( 'service_finder-js-app', '/*Declare global variable*/
var user_id = "'.$currUser->ID.'";', 'after' );
?>
<h4 id="customer_calmonth"></h4>
<div class="profile-form-bx">
  <!--Calendar Navigation-->
  <div class="pull-right form-inline">
    <div class="btn-group">
      <button class="btn btn-primary" data-calendar-nav="prev"><< <?php esc_html_e('Prev', 'service-finder'); ?></button>
      <button class="btn btn-default" data-calendar-nav="today">
      <?php esc_html_e('Today', 'service-finder'); ?>
      </button>
      <button class="btn btn-primary" data-calendar-nav="next">
      <?php esc_html_e('Next', 'service-finder'); ?>
      >></button>
    </div>
    <div class="btn-group">
      <button class="btn btn-custom" data-calendar-view="year">
      <?php esc_html_e('Year', 'service-finder'); ?>
      </button>
      <button class="btn btn-custom active" data-calendar-view="month">
      <?php esc_html_e('Month', 'service-finder'); ?>
      </button>
      <button class="btn btn-custom" data-calendar-view="week">
      <?php esc_html_e('Week', 'service-finder'); ?>
      </button>
      <button class="btn btn-custom" data-calendar-view="day">
      <?php esc_html_e('Day', 'service-finder'); ?>
      </button>
    </div>
  </div>
  <br />
  <br />
  <br />
  <!--Load Calendar-->
  <div id="calendar"></div>
</div>
<!--Load Booking Details-->
<div id="booking-details" class="hidden"> </div>
<div class="modal fade" id="events-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title">
          <?php esc_html_e('Booking', 'service-finder'); ?>
        </h3>
      </div>
      <div class="modal-body"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">
        <?php esc_html_e('Close', 'service-finder'); ?>
        </button>
      </div>
    </div>
  </div>
</div>
