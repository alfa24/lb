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
<!-- Testimonials Outer Template-->
<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){

$html = '<section class="section-full bg-gray sf-testimonials">
            <div class="container">
            
            	<div class="section-head text-center">
                    <h2>'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p >'.esc_html($a['tagline']).'</p >
                </div>
                    
                <div class="section-content">
                    <div class="section-content">
                      <div class="owl-testimonials">'.do_shortcode( $content ).'</div>
                </div>
                </div>
                
            </div>
        </section>';
}else{
$html = '<section class="section-full bg-gray sf-testimonials">
  <div class="container">
    <div class="section-head text-center ">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p >'.esc_html($a['tagline']).'</p >
    </div>
    <div class="section-content">
      <div class="section-content">
        <div class="owl-carousel">'.do_shortcode( $content ).'</div>
      </div>
    </div>
  </div>
</section>';
}
$html = str_replace('<br />','',$html);
$html = str_replace('<p>','',$html);
$html = str_replace('</p>','',$html);

?>
<!-- Testimonials Outer Template-->
