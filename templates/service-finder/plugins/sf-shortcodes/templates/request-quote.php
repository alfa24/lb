<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$service_finder_options = get_option('service_finder_options');
$wpdb = service_finder_shortcode_global_vars('wpdb');
if(service_finder_request_quote_for_loggedin_user()){
$captchafield = '';

if($a['type'] == 'popup'){
if(class_exists('service_finder_booking_plugin')){
$captchafield = service_finder_captcha('requestquotepopup');
}
$html = '<div class="req-quote">
        <a href="javascript:void(0);" data-toggle="modal" data-target="#quotes-Modal-shortcode" class="btn btn-primary btn-lg">
       '.esc_html($a['title']).'
        </a> </div>';
		
$html .= '<div id="quotes-Modal-shortcode" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">
          '.esc_html($a['title']).'
        </h4>
      </div>
      <form class="get-quote-shortcode" method="post">
        <div class="modal-body clearfix row">
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group"> <i class="input-group-addon fa fa-user"></i>
                <input name="customer_name" id="customer_name" type="text" class="form-control" placeholder="'.esc_html__("Name", "service-finder").'">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <div class="input-group"> <i class="input-group-addon fa fa-envelope"></i>
                <input name="customer_email" id="customer_email" type="text" class="form-control" placeholder="'.esc_html__("Email", "service-finder").'">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group"> <i class="input-group-addon fa fa-phone"></i>
                <input name="phone" type="text" class="form-control" placeholder="'.esc_html__("Phone", "service-finder").'">
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <div class="input-group"> <i class="input-group-addon fa fa-pencil"></i>
                <textarea name="description" id="description" cols="4" class="form-control"></textarea>
              </div>
            </div>
          </div>
        </div>
		'.$captchafield.'
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
          '.esc_html__("Cancel", "service-finder").'
          </button>
          <input type="submit" value="'.esc_html__("Send information", "service-finder").'" name="get-quote" class="btn btn-primary">
        </div>
      </form>
    </div>
  </div>
</div>';
}elseif($a['type'] == 'page'){
if(class_exists('service_finder_booking_plugin')){
$captchafield = service_finder_captcha('requestquote');
}
$html = '<form class="get-quote-shortcode" method="post">
  <div class="form-group">
    <label>
    '.esc_html__('Name', 'service-finder').'
    </label>
    <input name="customer_name" id="customer_name" type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>
    '.esc_html__('Email', 'service-finder').'
    </label>
    <input name="customer_email" id="customer_email" type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>
    '.esc_html__('Phone', 'service-finder').'
    </label>
    <input name="phone" type="text" class="form-control">
  </div>
  <div class="form-group">
    <label>
    '.esc_html__('Message', 'service-finder').'
    </label>
    <textarea name="description" id="description" class="form-control"></textarea>
  </div>
  '.$captchafield.'
  <div class="form-group">
    <input type="submit" value="'.esc_html__('Send information', 'service-finder').'" name="get-quote" class="btn btn-primary btn-block">
  </div>
</form>';
}		
}else{
$html = '<div>'.esc_html__('Please login to view request a quote form', 'service-finder').'</div>';
}
?>

