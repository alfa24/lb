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

wp_add_inline_script( 'service_finder-js-service-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'after' );

$currUser = wp_get_current_user(); 
?>

<h4>
  <?php echo (!empty($service_finder_options['label-my-services'])) ? esc_html($service_finder_options['label-my-services']) : esc_html__('My Services', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <div class="margin-b-30 text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addservice" type="button"><i class="fa fa-plus"></i>
    <?php esc_html_e('ADD A SERVICE', 'service-finder'); ?>
    </button>
  </div>
  <!--Display Services into datatable-->
  <table id="service-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> <div class="checkbox">
            <input type="checkbox" id="bulkDelete">
            <label for="bulkDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php esc_html_e('Service Name', 'service-finder'); ?></th>
        <th><?php esc_html_e('Cost', 'service-finder'); ?></th>
        <th><?php esc_html_e('Action', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!-- Add Service Modal Popup Box-->
  <div id="addservice" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" class="add-new-service">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <?php esc_html_e('Add New Service', 'service-finder'); ?>
            </h4>
          </div>
          <div class="modal-body clearfix row input_fields_wrap">
            <div class="col-md-12">
              <div class="form-group">
                <input name="service_name" id="service_name" type="text" class="form-control" placeholder="<?php esc_html_e('Service Name', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group form-inline">
                <label>
                <?php esc_html_e('Service Cost', 'service-finder'); ?>
                </label>
                <br>
                <div class="radio">
                  <input id="fixed" type="radio" name="cost_type" value="fixed" checked>
                  <label for="fixed">
                  <?php esc_html_e('Fixed Price', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="hourly" type="radio" name="cost_type" value="hourly">
                  <label for="hourly">
                  <?php esc_html_e('Per Hour', 'service-finder'); ?>
                  </label>
                </div>
                <div class="radio">
                  <input id="perperson" type="radio" name="cost_type" value="perperson">
                  <label for="perperson">
                  <?php esc_html_e('Per Person', 'service-finder'); ?>
                  </label>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input name="service_cost" id="service_cost" type="text" class="form-control" placeholder="<?php esc_html_e('Service Cost', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12" id="service_hours_bx" style="display:none;">
              <div class="form-group">
                <input name="service_hours" id="service_hours" type="text" class="form-control" placeholder="<?php esc_html_e('Service Hours e.g. 1.5 (1 hour 50 minutes) or .5 (50 minutes)', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12" id="service_persons_bx" style="display:none;">
              <div class="form-group">
                <input name="service_persons" id="service_persons" type="text" class="form-control" placeholder="<?php esc_html_e('Service Persons', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group" id="grouparea">
                <select class="form-control" name="group_id" data-live-search="true" title="<?php esc_html_e('Select Group', 'service-finder'); ?>" id="group_id">
                      <?php
                      $groupinfo = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->service_groups.' where provider_id = %d ORDER BY group_name',$globalproviderid));
					  if(!empty($groupinfo)){
					  	foreach($groupinfo as $grouprow){
							echo '<option value="'.esc_attr($grouprow->id).'">'.esc_html($grouprow->group_name).'</option>';
						}
					  }
					  ?>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group group-outer-bx">
                <label>
                <?php echo '<a href="javascript:;" class="togglenewgroup">'.esc_html__('+ Add New Group', 'service-finder').'</a>'; ?>
                </label>
              </div>
            </div>
            <div class="service_group_bx" style="display:none;">
            <div class="col-md-12">
              <div class="form-group">
                <input name="group_name" id="group_name" type="text" class="form-control" placeholder="<?php esc_html_e('Add New Group', 'service-finder'); ?>">
              </div>
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn-default addnewgroup">
                <?php esc_html_e('Add New Group', 'service-finder'); ?>
                </button>
            </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
               	  <?php 
				  $settings = array( 
									'editor_height' => '100px',
									'textarea_name' => 'description',
									 'default_editor'      => 'quicktags'
								);
	
				  wp_editor( '', 'description', $settings );
				  ?>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <?php esc_html_e('Cancel', 'service-finder'); ?>
            </button>
            <input type="submit" class="btn btn-primary" name="add-service" value="<?php esc_html_e('Create', 'service-finder'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Edit Service Modal Popup Box-->
  <form method="post" class="edit-service default-hidden" id="editservice">
    <div class="clearfix row input_fields_wrap">
      <div class="col-md-12">
        <div class="form-group">
          <input name="service_name" id="service_name" type="text" class="form-control" placeholder="<?php esc_html_e('Service Name', 'service-finder'); ?>">
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group form-inline">
          <label>
          <?php esc_html_e('Service Cost', 'service-finder'); ?>
          </label>
          <br>
          <div class="radio">
            <input id="editfixed" type="radio" name="cost_type" value="fixed" checked>
            <label for="editfixed">
            <?php esc_html_e('Fixed Price', 'service-finder'); ?>
            </label>
          </div>
          <div class="radio">
            <input id="edithourly" type="radio" name="cost_type" value="hourly">
            <label for="edithourly">
            <?php esc_html_e('Per Hour', 'service-finder'); ?>
            </label>
          </div>
          <div class="radio">
            <input id="editperperson" type="radio" name="cost_type" value="perperson">
            <label for="editperperson">
            <?php esc_html_e('Per Person', 'service-finder'); ?>
            </label>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <input name="service_cost" id="service_cost" type="text" class="form-control" placeholder="<?php esc_html_e('Service Cost', 'service-finder'); ?>">
        </div>
      </div>
      <div class="col-md-12" id="edit_service_hours_bx" style="display:none;">
          <div class="form-group">
            <input name="service_hours" id="service_hours" type="text" class="form-control" placeholder="<?php esc_html_e('Service Hours', 'service-finder'); ?>">
          </div>
        </div>
      <div class="col-md-12" id="edit_service_persons_bx" style="display:none;">
          <div class="form-group">
            <input name="service_persons" id="service_persons" type="text" class="form-control" placeholder="<?php esc_html_e('Service Persons', 'service-finder'); ?>">
          </div>
        </div>  
      <div class="col-md-12">
      <div class="form-group" id="edit_grouparea">
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group group-outer-bx">
        <label>
        <?php echo '<a href="javascript:;" class="togglenewgroup">'.esc_html__('+ Add New Group', 'service-finder').'</a>'; ?>
        </label>
      </div>
    </div>
    <div class="edit_service_group_bx" style="display:none;">
    <div class="col-md-12">
      <div class="form-group">
        <input name="edit_group_name" type="text" class="form-control" placeholder="<?php esc_html_e('Add New Group', 'service-finder'); ?>">
      </div>
    </div>
    <div class="col-md-12">
        <button type="button" class="btn btn-default addnewgroup">
        <?php esc_html_e('Add New Group', 'service-finder'); ?>
        </button>
    </div>
    </div>  
      <div class="col-md-12">
        <div class="form-group">
         <textarea id="editdesc" name="editdesc"></textarea>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">
      <?php esc_html_e('Cancel', 'service-finder'); ?>
      </button>
      <input type="hidden" name="serviceid">
      <input type="submit" class="btn btn-primary" name="edit-service" value="<?php esc_html_e('Update', 'service-finder'); ?>" />
    </div>
  </form>
</div>
