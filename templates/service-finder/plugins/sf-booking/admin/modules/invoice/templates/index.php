<?php 
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<!--Template for dispaly featured requests-->
<?php
$service_finder_options = get_option('service_finder_options');
$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');	
$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customers', 'service-finder');	
$admin_fee_label = (!empty($service_finder_options['admin-fee-label'])) ? esc_html($service_finder_options['admin-fee-label']) : esc_html__('Admin Fee', 'service-finder');
?>
<div class="sf-wpbody-inr">
  <div class="sedate-title">
    <h2>
      <?php esc_html_e( 'Invoices', 'service-finder' ); ?>
    </h2>
  </div>
  <div class="sf-by-provider"> <?php echo esc_html__( 'By', 'service-finder' ).' '.esc_html($providerreplacestring); ?> -
    <select name="byproviderinvoice" id="byproviderinvoice">
      <?php
if(!empty($args)){
	echo '<option value="">'.esc_html__( 'All ', 'service-finder' ).esc_html($providerreplacestring).'</option>';
	foreach($args as $arg){
	echo '<option value="'.esc_attr($arg->wp_user_id).'">'.$arg->full_name.'</option>';
	}
}else{
	echo '<option value="">'.esc_html__( 'No Providers Found', 'service-finder' ).'</option>';
}
?>
    </select>
  </div>
  <div class="table-responsive">
    <table id="invoice-requests-grid" class="table table-bordered table-striped" cellpadding="0" cellspacing="0" border="0" class="display" width="100%">
    <thead>
      <tr>
      	<th><input type="checkbox"  id="bulkAdminInvoiceDelete"  />
          <button id="deleteAdminInvoiceTriger" class="btn btn-danger btn-xs">
          <?php esc_html_e( 'Delete', 'service-finder' ); ?>
        </button></th>
        <th><?php esc_html_e('Reference No', 'service-finder'); ?></th>
        <th><?php echo esc_html($providerreplacestring).' '.esc_html__( 'Name', 'service-finder' ); ?></th>
        <th><?php echo esc_html($customerreplacestring).' '.esc_html__( 'Name', 'service-finder' ); ?></th>
        <th><?php esc_html_e('Due Date', 'service-finder'); ?></th>
        <th><?php esc_html_e('Amount', 'service-finder'); ?></th>
        <th><?php echo esc_html($admin_fee_label); ?></th>
        <th><?php esc_html_e('Status', 'service-finder'); ?></th>
        <th><?php esc_html_e('Txn ID', 'service-finder' ); ?></th>
      </tr>
    </thead>
    </table>
  </div>
</div>
