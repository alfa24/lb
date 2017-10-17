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
$service_finder_Tables = service_finder_shortcode_global_vars('service_finder_Tables');
$current_user = wp_get_current_user(); 
?>
<!-- Featured Providers  -->
          <?php
		  $html = '';
		  $innerhtml = '';
		  
				$limit = $a['numberofproviders'];
				$showitem = $a['showitem'];
				$categoryid = ($a['categoryid'] != "" && $a['categoryid'] > 0) ? $a['categoryid'] : 0;
				
				wp_add_inline_script( 'service_finder-js-custom', 'var showfeatureditem = "'.$showitem.'";', 'before' );
				
                $providers = service_finder_getFeaturedProviders($limit,$categoryid);
				//print_r($providers);
				if(!empty($providers)){
					foreach($providers as $provider){
					$subinner = '';
					$addressbox = '';
					$userLink = service_finder_get_author_url($provider->provider_id);

					if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
						$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-featured-provider' );
						$src  = $src[0];
					}else{
						$src  = '';
					}
					
					if($src != ''){
						$imgtag = '<img src="'.esc_url($src).'" width="358" height="259" alt="">';
					}else{
						$imgtag = '';
					}
					
					$chkclass = '';
					$prometa = '';
					if(class_exists('service_finder_booking_plugin')){
					$chkclass = service_finder_check_varified($provider->provider_id);
					
					$prometa = service_finder_show_provider_meta($provider->provider_id,$provider->phone,$provider->mobile);
					$prometa .= service_finder_check_varified_icon($provider->provider_id);
					$prometa .= service_finder_displayRating(service_finder_getAverageRating($provider->provider_id));
					}
					
					$link = $userLink;
					
							if(is_user_logged_in()){
								if($wpdb->get_var("SHOW TABLES LIKE '".$service_finder_Tables->favorites."'") == $service_finder_Tables->favorites) {
								$myfav = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->favorites.' where user_id = %d AND provider_id = %d',$current_user->ID, $provider->provider_id));
								
								if(!empty($myfav)){
								$subinner .= '<a href="javascript:;" class="remove-favorite btn btn-primary" data-proid="'.esc_attr($provider->provider_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'My Favorite', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
								}else{
								$subinner .= '<a href="javascript:;" class="add-favorite btn btn-primary" data-proid="'.esc_attr($provider->provider_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
								}
								}
							}else{
								$subinner .= '<a class="btn btn-primary" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
							}
							
							$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
							
							if($showaddressinfo && $service_finder_options['show-postal-address']){
								$addressbox = '<div class="overlay-text">
                    <div class="sf-address-bx"> <i class="fa fa-map-marker"></i> '.service_finder_getshortAddress($provider->provider_id).'</div>
                  </div>';
							}
					
					if(service_finder_themestyle_for_plugin() == 'style-2'){
					 $current_user = wp_get_current_user();         
					if(is_user_logged_in()){
						$myfav = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->favorites.' where user_id = %d AND provider_id = %d',$current_user->ID,$provider->provider_id));
						
						if(!empty($myfav)){
						$addtofavorite = '<a href="javascript:;" class="remove-favorite sf-featured-item" data-proid="'.esc_attr($provider->provider_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart"></i></a>';
						}else{
						$addtofavorite = '<a href="javascript:;" class="add-favorite sf-featured-item" data-proid="'.esc_attr($provider->provider_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart-o"></i></a>';
						}
					}else{
						$addtofavorite = '<a class="sf-featured-item" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-heart-o"></i></a>';
					}
									$addressbox = service_finder_getshortAddress($provider->provider_id);
					$innerhtml .= '<div class="sf-featured-girds item" id="proid-'.esc_attr($provider->provider_id).'">
						<div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->provider_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->provider_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->provider_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        <div  class="sf-featured-sign">'.esc_html__( 'Featured', 'service-finder' ).'</div>
                                        <div  class="sf-featured-provider">'.esc_html($provider->full_name).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->provider_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->provider_id),0,30).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,130).'</div>
                                    '.service_finder_show_provider_meta($provider->provider_id,$provider->phone,$provider->mobile).'
                                </div>
					  </div>';
					}else{
					$innerhtml .= '<div class="sf-featured-bx item">
						<div class="sf-element-bx">
						  <div class="sf-thum-bx sf-featured-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a class="sf-featured-link" href="'.esc_url($link).'"></a>
							<div class="overlay-bx">
							  '.$addressbox.'
							</div>
							<strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->provider_id,'primary_category',true))).'">'. service_finder_getCategoryName(get_user_meta($provider->provider_id,'primary_category',true)).'</a></strong> </div>
						  <div class="padding-20 bg-white '.$chkclass.'">
							<h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->provider_id),0,30).'</h4>
							<p>'.service_finder_getExcerpts(strip_tags($provider->bio),0,130).'</p>
							<strong class="sf-company-name"><a href="'.esc_url($link).'">'.esc_html($provider->full_name).'</a></strong> '.$prometa.'</div>
						  <div class="btn-group-justified" id="proid-'.esc_attr($provider->provider_id).'"> <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View', 'service-finder').'<i class="fa fa-arrow-circle-o-right"></i></a>
							'.$subinner.'
						  </div>
						</div>
					  </div>';
					  }
					}
				}
				?>
<?php
$bgimage = (!empty($service_finder_options['featured-providers-bg-image']['url'])) ? $service_finder_options['featured-providers-bg-image']['url'] : '';
$bgattachment = (isset($service_finder_options['featured-providers-background-attachment'])) ? esc_html($service_finder_options['featured-providers-background-attachment']) : '';
$bgcolor = (!empty($service_finder_options['featured-providers-bg-color'])) ? $service_finder_options['featured-providers-bg-color'] : '';
$bgopacity = (!empty($service_finder_options['featured-providers-bg-opacity'])) ? $service_finder_options['featured-providers-bg-opacity'] : '';

$fullwidth = (isset($a['fullwidth'])) ? esc_html($a['fullwidth']) : '';

$fullwidthclass = ($fullwidth == 'yes') ? 'sf-featured-fullwidth' : '';

if(service_finder_themestyle_for_plugin() == 'style-2'){
$html .= '<section class="section-full">
            <div class="container '.sanitize_html_class($fullwidthclass).'">
            
            	<div class="section-head text-center">
                    <h2>'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p>'.esc_html($a['tagline']).'</p>
                </div>
                    
                <div class="section-content">
                    
                        <div class="owl-featured-2">';
                        	$html .= $innerhtml;
                        $html .= '</div>
                    
                </div>
                    
            </div>
        </section>';		

}else{
$html .= '<section class="section-full sf-overlay-wrapper text-center sf-category" style="background-image:url('.$bgimage.');background-attachment: '.$bgattachment.'">
  <div class="container '.sanitize_html_class($fullwidthclass).'">
    <div class="section-head w-t-element">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row">
        <div class="owl-featured">';

$html .= $innerhtml;		

$html .= '</div>
      </div>
    </div>
  </div>
  <div class="sf-overlay-main" style="opacity:'.$bgopacity.'; background-color:'.$bgcolor.'">
  </div>
</section>';		
}
?>
<!-- Featured Providers END -->
