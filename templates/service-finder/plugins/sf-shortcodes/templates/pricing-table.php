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
if($a['style'] ==  'no-gap'){
$class1 = 'p-lr15';
$class2 = 'no-col-gap';
}else{
$class1 = '';
$class2 = '';
}

$html = '<section class="section-full bg-white">
            <div class="container">
            
            
            	<div class="section-head text-center">
                    <h2>'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p>'.esc_html($a['tagline']).'</p>
                </div>
                    
                <div class="section-content">
                	<div class="pricingtable-row m-b30 '.sanitize_html_class($class1).' '.sanitize_html_class($class2).' equal-col-outer">
					<div class="row" id="sf-pricingtable-wrap">'.do_shortcode( $content ).'</div>
					</div>
                </div>
                
            </div>
        </section>';
$html = str_replace('<br />','',$html);
$html = str_replace('<p></p>','',$html);
?>
