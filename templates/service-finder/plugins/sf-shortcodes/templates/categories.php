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
<!-- sf categories  -->

<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){
$html = '<section class="section-full text-center bg-gray ">
            <div class="container">
            
            	<div class="section-head">
                    <h2>'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p>'.esc_html($a['tagline']).'</p>
                </div>
                    
                <div class="section-content">
    <div class="row">
        <div id="masonry" class="catlist sf-catlist-new">';
        
            if(class_exists('service_finder_texonomy_plugin')){
				
				if($a['showmore'] == 'yes'){
				$limit=6; //define results limit
				}else{
				$limit = $a['limit'];
				}
				
				$offset=0; //define offset
				$i=0; //start line counter


                $categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				
				$totalcat = count($categories);
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						
						if ($i++ < $offset) continue;
					    if ($i > $offset + $limit) break;
						
                        $catimage =  service_finder_getCategoryImage($catdetails->term_id,'service_finder-category-home');
						if($catimage != ""){
						$class = '';
						$catimgtag = '<img src="'.esc_url($catimage).'" width="600" height="350" alt="'.esc_attr($catdetails->name).'">';
						}else{
						$class = 'sf-cate-no-img';
						$catimgtag = '';
						}
						
						$provider_category_hightlight = get_term_meta( $catdetails->term_id, 'provider_category_hightlight', true );
						
						$hightlight = ($provider_category_hightlight == 'yes') ? 'high-light' : '';

        $html .= '<div class="card-container col-md-4 col-sm-4 col-xs-6">
              <div class="sf-categories-girds '.sanitize_html_class($hightlight).' '.sanitize_html_class($class).'">
                    <div class="sf-categories-thum" style="background-image:url('.esc_url($catimage).')"></div>
                    <div class="sf-overlay-box"></div>
                    <div class="sf-categories-content text-center">
                        <span  class="sf-categories-quantity"><i class="fa fa-user-plus"></i> '.service_finder_getTotalProvidersByCategory( $catdetails->term_id ).'</span>
                        <div  class="sf-categories-title">'.esc_html($catdetails->name).'</div>
						<a href="'.esc_url(get_term_link( $catdetails )).'" class="sf-category-link"></a>
                    </div>
              </div>
            </div>';
		}
                    }
					$html .= '</div>';
					?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){ 
		if(!empty($catdetails)){
        $html .= '<div class="show_more_main" id="show_more_main'.esc_attr($limit).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($limit).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
		}
					}
					
                }else{
					$limit = $a['limit'];
					if($a['subcategory'] == 'yes'){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$offset = 0;
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$offset);
					if(!empty($categories)){
	
						foreach($categories as $category){
	
							$catimage =  service_finder_getCategoryImage($category->term_id,'service_finder-category-home');
							
							if($catimage != ""){
							$class = '';
							$catimgtag = '<img src="'.esc_url($catimage).'" width="600" height="350" alt="'.esc_attr($category->name).'">';
							}else{
							$class = 'sf-cate-no-img';
							$catimgtag = '';
							}
							
							$provider_category_hightlight = get_term_meta( $category->term_id, 'provider_category_hightlight', true );
							
							$hightlight = ($provider_category_hightlight == 'yes') ? 'high-light' : '';
        $html .= '<div class="card-container col-md-4 col-sm-4 col-xs-6">
              <div class="sf-categories-girds '.sanitize_html_class($hightlight).' '.sanitize_html_class($class).'">
                    <div class="sf-categories-thum" style="background-image:url('.esc_url($catimage).')"></div>
                    <div class="sf-overlay-box"></div>
                    <div class="sf-categories-content text-center">
                        <span  class="sf-categories-quantity"><i class="fa fa-user-plus"></i> '.service_finder_getTotalProvidersByCategory( $category->term_id ).'</span>
                        <div  class="sf-categories-title">'.esc_html($category->name).'</div>
                    </div>
					<a href="'.esc_url(get_term_link( $category )).'" class="sf-category-link"></a>
              </div>
            </div>';
						}
		$html .= '</div>';				
						?>
         
		<?php if($totalcat > $limit && $a['showmore'] == 'yes'){
        $html .= '<div class="show_more_main" id="show_more_main'.esc_attr($limit).'"> <span id="'.esc_attr($category->term_id).'" data-subcat="'.esc_attr($subcategory).'" data-offset="'.esc_attr($limit).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
						}
	
					}
				}
				}
            
        $html .= '</div>
</div>
                
            </div>
        </section>';
}else{
$html = '<section class="section-full text-center bg-gray sf-category">
  <div class="container">
    <div class="section-head">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row catlist">';

				if(class_exists('service_finder_texonomy_plugin')){
				
				if($a['showmore'] == 'yes'){
				$limit=6; //define results limit
				}else{
				$limit = $a['limit'];
				}
				
				$offset=0; //define offset
				$i=0; //start line counter


                $categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				$totalcat = count($categories);
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						
						if ($i++ < $offset) continue;
					    if ($i > $offset + $limit) break;
						
                        $catimage =  service_finder_getCategoryImage($catdetails->term_id,'service_finder-category-home');
						if($catimage != ""){
						$class = '';
						$catimgtag = '<img src="'.esc_url($catimage).'" width="600" height="350" alt="'.esc_attr($catdetails->name).'">';
						}else{
						$class = 'sf-cate-no-img';
						$catimgtag = '';
						}

        $html .= '<div class="col-md-4 col-sm-6 test1">
          <div class="sf-element-bx">
          <a href="'.esc_url(get_term_link( $catdetails )).'">
          <div class="'.sanitize_html_class($class).' overlay-bg">
            <div class="sf-thum-bx sf-catagories-listing img-effect1" style="background-image:url('.esc_url($catimage).');"> </div>
            <span  class="service-plus"> <i class="fa fa-user-plus"></i> ('.service_finder_getTotalProvidersByCategory( $catdetails->term_id ).') </span>
            <h4 class="service-name pull-left">'.esc_html($catdetails->name).'</h4>
          </div>
          </a>
          </div>
        </div>';
		}
                    }
					
					?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){ 
		if(!empty($catdetails)){
        $html .= '<div class="show_more_main" id="show_more_main'.esc_attr($limit).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($limit).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
		}
					}
					
                }else{
					$limit = $a['limit'];
					if($a['subcategory'] == 'yes'){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$offset = 0;
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$offset);
					if(!empty($categories)){
	
						foreach($categories as $category){
	
							$catimage =  service_finder_getCategoryImage($category->term_id,'service_finder-category-home');
							
							if($catimage != ""){
							$class = '';
							$catimgtag = '<img src="'.esc_url($catimage).'" width="600" height="350" alt="'.esc_attr($category->name).'">';
							}else{
							$class = 'sf-cate-no-img';
							$catimgtag = '';
							}
        $html .= '<div class="col-md-4 col-sm-6 test2">
        <div class="sf-element-bx">
          <a href="'.esc_url(get_term_link( $category )).'">
          <div class="'.sanitize_html_class($class).' overlay-bg">
            <div class="sf-thum-bx sf-catagories-listing img-effect1" style="background-image:url('.esc_url($catimage).');"> </div>
            <span  class="service-plus"> <i class="fa fa-user-plus"></i> ('.service_finder_getTotalProvidersByCategory( $category->term_id ).') </span>
            <h4 class="service-name pull-left">'.esc_html($category->name).'</h4>
          </div>
          </a>
        </div>  
        </div>';
						}
				$html .= '</div>';						
						?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){
        $html .= '<div class="show_more_main" id="show_more_main'.esc_attr($limit).'"> <span id="'.esc_attr($category->term_id).'" data-subcat="'.esc_attr($subcategory).'" data-offset="'.esc_attr($limit).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
						}
	
					}
				}
				}
      $html .= '
    </div>
  </div>
</section>';
}
?>
<!-- sf categories END -->
