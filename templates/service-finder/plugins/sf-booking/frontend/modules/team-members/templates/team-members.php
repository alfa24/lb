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
global $wpdb, $service_finder_Tables; 
$wpdb = service_finder_plugin_global_vars('wpdb');
$service_finder_Tables = service_finder_plugin_global_vars('service_finder_Tables');
$currUser = wp_get_current_user(); 
$settings = service_finder_getProviderSettings($globalproviderid);

wp_add_inline_script( 'service_finder-js-team-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'after' );
?>

<h4>
  <?php echo (!empty($service_finder_options['label-team-members'])) ? esc_html($service_finder_options['label-team-members']) : esc_html__('Team Members', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <div class="margin-b-30 text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addmember" type="button"><i class="fa fa-plus"></i>
    <?php esc_html_e('ADD TEAM MEMBER', 'service-finder'); ?>
    </button>
  </div>
  <!--Display Team Member template-->
  <table id="members-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> <div class="checkbox">
            <input type="checkbox" id="bulkMemberDelete">
            <label for="bulkMemberDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteMemberTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php esc_html_e('Name', 'service-finder'); ?></th>
        <th><?php esc_html_e('Phone', 'service-finder'); ?></th>
        <th><?php esc_html_e('Email', 'service-finder'); ?></th>
        <th><?php esc_html_e('Is Admin?', 'service-finder'); ?></th>
        <th><?php esc_html_e('Action', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!-- Basic -->
  <!-- Add Team Member Modal Popup Box -->
  <div id="addmember" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" class="add-new-member">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <?php esc_html_e('Add New Member', 'service-finder'); ?>
            </h4>
          </div>
          <div class="modal-body clearfix row input_fields_wrap">
            <div class="profile-pic-bx">
              <div class="rwmb-field rwmb-plupload_image-wrapper">
                <div class="rwmb-input">
                  <ul class="rwmb-images rwmb-uploaded" data-field_id="sfmemberavatarupload" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="1" id="memberavatar">
                  </ul>
                  <div id="sfmemberavatarupload-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;sfmemberavatarupload-browse-button&quot;,&quot;drop_element&quot;:&quot;sfmemberavatarupload-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($url); ?>wp-admin\/admin-ajax.php&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed Image Files&quot;,&quot;extensions&quot;:&quot;jpg,jpeg,gif,png&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;sfmemberavatarupload&quot;,&quot;action&quot;:&quot;memberavatar_upload&quot;}}">
                    <div class = "drag-drop-inside text-center"> <img src="<?php echo esc_url($service_finder_Params['pluginImgUrl'].'/no_img.jpg'); ?>">
                      <p class="drag-drop-info">
                        <?php esc_html_e('Drop avatar here', 'service-finder'); ?>
                      </p>
                      <p><?php esc_html_e('or', 'service-finder'); ?></p>
                      <p class="drag-drop-buttons">
                        <input id="sfmemberavatarupload-browse-button" type="button" value="<?php esc_html_e('Select Image', 'service-finder'); ?>" class="button btn btn-primary" />
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input name="member_fullname" id="member_fullname" type="text" class="form-control" placeholder="<?php esc_html_e('Full Name', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input name="member_email" id="member_email" type="text" class="form-control" placeholder="<?php esc_html_e('Member Email', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input name="member_phone" id="member_phone" type="text" class="form-control" placeholder="<?php esc_html_e('Member Phone', 'service-finder'); ?>">
              </div>
            </div>
            <?php if($settings['booking_basedon'] == 'zipcode'){ ?>
            <div class="col-md-12">
              <label>
              <?php esc_html_e('Service Area', 'service-finder'); ?>
              </label>
            </div>
            <div id="loadservices"> </div>
            <?php }elseif($settings['booking_basedon'] == 'region'){ ?>
            <div class="col-md-12">
              <label>
              <?php esc_html_e('Regions', 'service-finder'); ?>
              </label>
            </div>
            <div id="loadregions"> </div>
            <?php }?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <?php esc_html_e('Cancel', 'service-finder'); ?>
            </button>
            <input type="submit" class="btn btn-primary" name="add-member" value="<?php esc_html_e('Create', 'service-finder'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Add Modal END-->
  <!-- Edit Team Members Modal Popup box -->
  <form method="post" class="edit-member default-hidden" id="editmember">
    <div class="clearfix row input_fields_wrap">
      <div class="profile-pic-bx">
        <div class="rwmb-field rwmb-plupload_image-wrapper">
          <div class="rwmb-input">
            <ul class="rwmb-images rwmb-uploaded" data-field_id="sfmemberavataruploadedit" data-delete_nonce="" data-reorder_nonce="" data-force_delete="0" data-max_file_uploads="1" id="memberavataredit">
            </ul>
            <div id="sfmemberavataruploadedit-dragdrop" class="RWMB-drag-drop drag-drop hide-if-no-js new-files" data-upload_nonce="1f7575f6fa" data-js_options="{&quot;runtimes&quot;:&quot;html5,silverlight,flash,html4&quot;,&quot;file_data_name&quot;:&quot;async-upload&quot;,&quot;browse_button&quot;:&quot;sfmemberavataruploadedit-browse-button&quot;,&quot;drop_element&quot;:&quot;sfmemberavataruploadedit-dragdrop&quot;,&quot;multiple_queues&quot;:true,&quot;max_file_size&quot;:&quot;8388608b&quot;,&quot;url&quot;:&quot;<?php echo esc_url($url); ?>wp-admin\/admin-ajax.php&quot;,&quot;flash_swf_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.flash.swf&quot;,&quot;silverlight_xap_url&quot;:&quot;<?php echo esc_url($url); ?>wp-includes\/js\/plupload\/plupload.silverlight.xap&quot;,&quot;multipart&quot;:true,&quot;urlstream_upload&quot;:true,&quot;filters&quot;:[{&quot;title&quot;:&quot;Allowed Image Files&quot;,&quot;extensions&quot;:&quot;jpg,jpeg,gif,png&quot;}],&quot;multipart_params&quot;:{&quot;field_id&quot;:&quot;sfmemberavataruploadedit&quot;,&quot;action&quot;:&quot;memberavatar_uploadedit&quot;}}">
              <div class = "drag-drop-inside text-center"> <img src="<?php echo esc_url($service_finder_Params['pluginImgUrl'].'/no_img.jpg'); ?>">
                <p class="drag-drop-info">
                  <?php esc_html_e('Drop avatar here', 'service-finder'); ?>
                </p>
                <p><?php esc_html_e('or', 'service-finder'); ?></p>
                <p class="drag-drop-buttons">
                  <input id="sfmemberavataruploadedit-browse-button" type="button" value="<?php esc_html_e('Select Image', 'service-finder'); ?>" class="button btn btn-primary" />
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input name="member_fullname" id="member_fullname" type="text" class="form-control" placeholder="<?php esc_html_e('Full Name', 'service-finder'); ?>">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input name="member_email" id="member_email" type="text" class="form-control" placeholder="<?php esc_html_e('Member Email', 'service-finder'); ?>">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <input name="member_phone" id="member_phone" type="text" class="form-control" placeholder="<?php esc_html_e('Member Phone', 'service-finder'); ?>">
        </div>
      </div>
      <?php if($settings['booking_basedon'] == 'zipcode'){ ?>
      <div class="col-md-12">
        <label><?php esc_html_e('Service Area', 'service-finder'); ?></label>
      </div>
      <div id="editloadservices"> </div>
      <?php }elseif($settings['booking_basedon'] == 'region'){ ?>
      <div class="col-md-12">
        <label><?php esc_html_e('Regions', 'service-finder'); ?></label>
      </div>
      <div id="editloadregions"> </div>
      <?php }?>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">
      <?php esc_html_e('Cancel', 'service-finder'); ?>
      </button>
      <input type="hidden" name="memberid">
      <input type="submit" class="btn btn-primary" name="edit-member" value="<?php esc_html_e('Update', 'service-finder'); ?>" />
    </div>
  </form>
  <!-- Edit Team Members Modal END-->
</div>
