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
?>
<?php 
$imgurl = (!empty($service_finder_options['follow-us-bg-image']['url'])) ? $service_finder_options['follow-us-bg-image']['url'] : '';
$bgattachment = (isset($service_finder_options['follow-us-background-attachment'])) ? esc_html($service_finder_options['follow-us-background-attachment']) : '';
$bgcolor = (!empty($service_finder_options['follow-us-bg-color'])) ? $service_finder_options['follow-us-bg-color'] : '';
$bgopacity = (!empty($service_finder_options['follow-us-bg-opacity'])) ? $service_finder_options['follow-us-bg-opacity'] : '';
?>
<!--  Providers Follow us -->
<?php
$total = service_finder_totalProviders();
$html = '<div class="section-full sf-overlay-wrapper text-center providers-follow" style="background:url('.esc_url($imgurl).') center '.$bgattachment.' no-repeat;">
  <div class="container">
    <div class="w-t-element"> <strong class="sf-title">'.str_replace("%TOTAL-PROVIDERS%",'<span>'.$total.'</span>',$a['title']).'</strong>
      <div class="sf-follow-text">'.$content.'</div>
    </div>
  </div>
  <div class="sf-overlay-main" style="opacity:'.$bgopacity.'; background-color:'.$bgcolor.'">
  </div>
</div>
';
?>
<!--  Providers Follow us -->
