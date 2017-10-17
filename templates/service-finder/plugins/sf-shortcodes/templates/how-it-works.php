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
<!-- How sf Works -->
<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){
$html = '<section class="section-full text-center bg-white">
            <div class="container">
            
            	<div class="section-head">
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
        </section>';
}else{
$html = '<section class="section-full text-center bg-white how-sf-work">
  <div class="container">
    <div class="section-head">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row">
        '.do_shortcode( $content ).'
        <div class="col-md-12">
          <div class="line-bx">
            <div class="col-md-6 padding-r-40">
              <div class="pull-right">
                <hr>
              </div>
            </div>
            <div class="col-md-6 padding-l-40">
              <div  class="pull-left">
                <hr>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>';
}
$html = str_replace('<br />','',$html);
$html = str_replace('<br>','',$html);
$html = str_replace('<p></p>','',$html);
?>
<!-- How sf Works END -->
