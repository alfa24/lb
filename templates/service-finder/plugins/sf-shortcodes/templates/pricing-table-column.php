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

if(service_finder_themestyle_for_plugin() == 'style-2'){
$class = 'sf-pricing-box-new';
}else{
$class = '';
}

$highlight = (isset($a['highlight'])) ? esc_html($a['highlight']) : 'no';
if($highlight == 'yes'){
$highlightclass = 'sf-pricing-highlight';
}else{
$highlightclass = '';
}

$signup = '';
if(!is_user_logged_in()){

$signuptype = (isset($a['signuptype'])) ? esc_html($a['signuptype']) : '';
$packagenumber = (isset($a['packagenumber'])) ? esc_html($a['packagenumber']) : '';

if($signuptype == 'popup'){
$signup = '<div class="pricingtable-footer">
            <a class="btn btn-primary" href="javascript:;" data-action="signup" data-package="'.$packagenumber.'" data-redirect="no" data-toggle="modal" data-target="#login-Modal">'.esc_html__('Sign Up','service-finder').'</a>
        </div>';

}else{

$link = add_query_arg( array(
    'package' => $packagenumber,
), $a['link'] );

$signup = '<div class="pricingtable-footer">
            <a class="btn btn-primary " href="'.esc_html($link).'" target="_blank">'.esc_html__('Sign Up','service-finder').'</a>
        </div>';

}

}

$html = '<div class="col-sm-6 col-md-3 col-lg-3 equal-col pricingtable-cell">
<div class="pricingtable-wrapper '.sanitize_html_class($class).' '.sanitize_html_class($highlightclass).'">
    <div class="pricingtable-inner">
    
        <div class="pricingtable-price">
            <span class="pricingtable-bx">'.esc_html($a['price']).'</span>
            <span class="pricingtable-type">'.esc_html($a['period']).'</span>
        </div>
        
        <div class="pricingtable-title">
            <h2>'.esc_html($a['title']).'</h2>
        </div>
        
        <ul class="pricingtable-features">
            '.do_shortcode( $content ).'
        </ul>
        
        '.$signup.'
    
    </div>
</div>
</div>';
?>
