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
?>
<?php 
$imgurl = (!empty($service_finder_options['why-choose-us-bg-image']['url'])) ? $service_finder_options['why-choose-us-bg-image']['url'] : '';
$bgattachment = (isset($service_finder_options['why-choose-us-background-attachment'])) ? esc_html($service_finder_options['why-choose-us-background-attachment']) : '';
$bgcolor = (!empty($service_finder_options['why-choose-us-bg-color'])) ? $service_finder_options['why-choose-us-bg-color'] : '';
$bgopacity = (!empty($service_finder_options['why-choose-us-bg-opacity'])) ? $service_finder_options['why-choose-us-bg-opacity'] : '';
?>
<?php
$html = '<section class="section-full sf-overlay-wrapper text-center" style="background-image:url('.esc_url($imgurl).');background-attachment: '.$bgattachment.'">
            <div class="container">
            
            	<div class="section-head w-t-element">
                    <h2>'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p>'.esc_html($a['tagline']).'</p>
                </div>
                    
                <div class="section-content">
                    <div class="row">
                        '.do_shortcode( $content ).'
                    </div>
                </div>
            </div>
			<div class="sf-overlay-main" style="opacity:'.$bgopacity.'; background-color:'.$bgcolor.'">
        </section>';
?>

