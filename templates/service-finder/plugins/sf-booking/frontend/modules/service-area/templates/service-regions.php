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

$sAreas = service_finder_getServiceArea($current_user->ID);
if(!empty($sAreas)){
	foreach($sAreas as $sArea){
		$ziparr[] = $sArea->zipcode;
	}
	$sAreas = implode(',',$ziparr);
}
wp_add_inline_script( 'service_finder-js-servicearea-form', '/*Declare global variable*/
var user_id = "'.$globalproviderid.'";', 'before' );
?>

<h4>
 	<?php echo (!empty($service_finder_options['label-regions'])) ? esc_html($service_finder_options['label-regions']) : esc_html__('Regions', 'service-finder'); ?>
</h4>
<div class="profile-form-bx">
  <div class="margin-b-30 text-right">
    <button class="btn btn-primary" data-toggle="modal" data-target="#addserviceregions" type="button"><i class="fa fa-plus"></i>
    <?php esc_html_e('ADD REGIONS', 'service-finder'); ?>
    </button>
  </div>
  <input id="switch-state12" name="status" type="checkbox" checked>
  <!--Display service area template-->
  <table id="regions-grid" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th> <div class="checkbox">
            <input type="checkbox" id="bulkRegionsDelete">
            <label for="bulkRegionsDelete"></label>
          </div>
          <button class="btn btn-danger btn-xs" id="deleteRegionTriger" title="Delete"><i class="fa fa-trash-o"></i></button></th>
        <th><?php esc_html_e('Regions', 'service-finder'); ?></th>
        <th><?php esc_html_e('Status', 'service-finder'); ?></th>
      </tr>
    </thead>
  </table>
  <!-- Add service area modal popup box -->
  <div id="addserviceregions" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" class="add-service-region">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">
              <?php esc_html_e('Add New Region', 'service-finder'); ?>
            </h4>
          </div>
          <div class="modal-body clearfix row input_fields_wrap">
            <div class="col-md-12">
              <div class="form-group">
                <input placeholder="<?php esc_html_e('Add Region', 'service-finder'); ?>" type="text" class="form-control" name="region">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">
            <?php esc_html_e('Cancel', 'service-finder'); ?>
            </button>
            <input type="submit" class="btn btn-primary" name="add-serviceregion" value="<?php esc_html_e('Save', 'service-finder'); ?>" />
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal END-->
</div>
