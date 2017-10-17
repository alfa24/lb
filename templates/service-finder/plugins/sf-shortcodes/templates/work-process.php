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
$html = '<div class="col-md-4">
                          <div class="sf-how-work padding-lr-40 equal-col">
                                <div class="sf-icon-xl margin-b-20">
                                    <img src="'.esc_url($a['img']).'" width="139" height="140" alt="">
                                    <span class="sf-no-step">'.esc_html($a['number']).'</span>
                                </div>
                                <h4 class="sf-tilte">'.esc_html($a['title']).'</h4>
                                <p>'.$content.'</p>
                                
                          </div>
                        </div>';
}else{
$html = '<div class="col-md-4 col-sm-4">
  <div class="sf-element-bx padding-lr-30">
    <div class="icon-bx-lg rounded-bx mostion"><img src="'.esc_url($a['img']).'" width="139" height="140" alt=""></div>
    <div class="shadow-bx mostion"><img src="'.plugins_url('/sf-shortcodes/').'images/shadow.png'.'" alt=""></div>
    <h4>'.esc_html($a['title']).'</h4>
    <p>'.$content.'</p>
    <div class="step-no-bx mostion">'.esc_html($a['number']).'</div>
  </div>
</div>';
}
?>
<!-- Work process Template-->
