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
$service_finder_ThemeParams = service_finder_global_params('service_finder_ThemeParams');
?>
<!-- Footer -->
<?php 
service_finder_footer_layout(); 
?>
<!-- Footer END-->
</div>
<?php
wp_add_inline_script( 'image-manager', 'var rwmbFile = {"maxFileUploadsSingle":"'.esc_html__('You may only upload maximum %d file', 'service-finder').'","maxFileUploadsPlural":"'.esc_html__('You may only upload maximum %d files', 'service-finder').'"};
var RWMB = {"url":"'.esc_html($service_finder_ThemeParams['themeImgUrl']).'"};', 'before' );

wp_add_inline_script( 'managefiles', 'var rwmbFile = {"maxFileUploadsSingle":"'.esc_html__('You may only upload maximum %d file', 'service-finder').'","maxFileUploadsPlural":"'.esc_html__('You may only upload maximum %d files', 'service-finder').'"};
var RWMB = {"url":"'.esc_html($service_finder_ThemeParams['themeImgUrl']).'"};', 'before' );

?>

<!-- Loading area start -->
<div class="loading-area default-hidden">
  <div class="loading-box"></div>
  <div class="loading-pic"></div>
</div>
<!-- Loading area end -->
<?php wp_footer(); ?>
</body></html>