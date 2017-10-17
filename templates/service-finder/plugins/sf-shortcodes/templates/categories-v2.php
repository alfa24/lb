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
<!-- services Finder categories version 2   -->
<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){
$html = '<section class="section-full text-center bg-white sf-category2">
  <div class="container">
    <div class="section-head">
      <h2>'.esc_html($a['title']).'</h2>
	  '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row catlistv2 equal-col-outer">';
						
						if(class_exists('service_finder_texonomy_plugin')){
						
						if($a['showmore'] == 'yes'){
						$limit=8; //define results limit
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
								$catimage =  service_finder_getCategoryIcon($catdetails->term_id,'service_finder-category-icon');
		
		$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
		$imgtag = '';
		if($catimage != ""){
              $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($catdetails->name).'">';
        }
		
		$excerpt = '';
		if($a['showdescription'] == 'yes'){
            $excerpt = '<p>'.nl2br(service_finder_getExcerpts($catdetails->description,0,60)).'</p>';
        }
		
        $html .= '<div class="col-md-3">
          <div class="sf-categories-2 padding-lr-10 equal-col">
            <div class="icon-bx-md rounded-corner bg-primary margin-b-20 '.$nocaticon.'">
              '.$imgtag.'
			  <span class="sf-categories-2-count">'.service_finder_getTotalProvidersByCategory( $catdetails->term_id ).'</span>
			  <a href="'.esc_url(get_term_link( $catdetails )).'" class="sf-category2-link"></a>
            </div>
            <h4 class="sf-tilte"><a href="'.esc_url(get_term_link( $catdetails )).'">'.esc_html($catdetails->name).'</a></h4>
            '.$excerpt.'
          </div>
        </div>';
		}
							}
							?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){
		if(!empty($catdetails)){
        $html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($limit).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($limit).'" data-showdes="'.esc_attr($a['showdescription']).'" class="btn btn-primary show_more_v2" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
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
			
									$catimage =  service_finder_getCategoryIcon($category->term_id,'service_finder-category-icon');
			
        $nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
		$imgtag = '';
		if($catimage != ""){
              $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($category->name).'">';
        }
		
		$excerpt = '';
		if($a['showdescription'] == 'yes'){
            $excerpt = '<p>'.nl2br(service_finder_getExcerpts($category->description,0,60)).'</p>';
        }
		
		$html .= '<div class="col-md-3">
          <div class="sf-categories-2 padding-lr-10 equal-col">
            <div class="icon-bx-md rounded-corner bg-primary margin-b-20 '.$nocaticon.'">
              '.$imgtag.'
			  <span class="sf-categories-2-count">'.service_finder_getTotalProvidersByCategory( $category->term_id ).'</span>
			  <a href="'.esc_url(get_term_link( $category )).'" class="sf-category2-link"></a>
            </div>
            <h4><a href="'.esc_url(get_term_link( $category )).'">'.esc_html($category->name).'</a></h4>
            '. $excerpt.'
          </div>
        </div>';
			
								}
							?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){
        $html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($limit).'"> <span id="'.esc_attr($category->term_id).'" data-subcat="'.esc_attr($subcategory).'" data-offset="'.esc_attr($limit).'" data-showdes="'.esc_attr($a['showdescription']).'" class="show_more_v2 btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
							}
			
							}
						}
						}
						
      $html .= '</div>
    </div>
  </div>
</section>';

}else{
$html = '<section class="section-full text-center bg-white sf-category2">
  <div class="container">
    <div class="section-head">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row catlistv2 equal-col-outer">';
						
						if(class_exists('service_finder_texonomy_plugin')){
						
						if($a['showmore'] == 'yes'){
						$limit=8; //define results limit
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
								$catimage =  service_finder_getCategoryIcon($catdetails->term_id,'service_finder-category-icon');
		
		$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
		$imgtag = '';
		if($catimage != ""){
              $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($catdetails->name).'">';
        }
		
		$excerpt = '';
		if($a['showdescription'] == 'yes'){
            $excerpt = '<p>'.nl2br(service_finder_getExcerpts($catdetails->description,0,60)).'</p>';
        }
		
        $html .= '<div class="col-md-3 col-sm-4 col-xs-6 equal-col">
          <div class="sf-element-bx">
            <div class="icon-bx-md rounded-bx '.$nocaticon.'">
              '.$imgtag.'
            </div>
            <h4><a href="'.esc_url(get_term_link( $catdetails )).'">'.esc_html($catdetails->name).'</a></h4>
            '.$excerpt.'
          </div>
        </div>';
		}
							}
							?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){
		if(!empty($catdetails)){
        $html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($limit).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($limit).'" data-showdes="'.esc_attr($a['showdescription']).'" class="btn btn-primary show_more_v2" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
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
			
									$catimage =  service_finder_getCategoryIcon($category->term_id,'service_finder-category-icon');
			
        $nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
		$imgtag = '';
		if($catimage != ""){
              $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($category->name).'">';
        }
		
		$excerpt = '';
		if($a['showdescription'] == 'yes'){
            $excerpt = '<p>'.nl2br(service_finder_getExcerpts($category->description,0,60)).'</p>';
        }
		
		$html .= '<div class="col-md-3 col-sm-4 col-xs-6 equal-col">
          <div class="sf-element-bx">
            <div class="icon-bx-md rounded-bx '.$nocaticon.'">
              '.$imgtag.'
            </div>
            <h4><a href="'.esc_url(get_term_link( $category )).'">'.esc_html($category->name).'</a></h4>
            '. $excerpt.'
          </div>
        </div>';
			
								}
							?>
        <?php if($totalcat > $limit && $a['showmore'] == 'yes'){
        $html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($limit).'"> <span id="'.esc_attr($category->term_id).'" data-subcat="'.esc_attr($subcategory).'" data-offset="'.esc_attr($limit).'" data-showdes="'.esc_attr($a['showdescription']).'" class="show_more_v2 btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
							}
			
							}
						}
						}
						
      $html .= '</div>
    </div>
  </div>
</section>';
}
?>
<!-- services Finder categories  END -->
