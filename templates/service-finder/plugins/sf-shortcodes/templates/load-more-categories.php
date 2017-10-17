<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*Load more categories on home page for version 1*/
add_action('wp_ajax_load_more', 'service_finder_load_more');
add_action('wp_ajax_nopriv_load_more', 'service_finder_load_more');

function service_finder_load_more(){
global $service_finder_options;

		$html = '';
		if(service_finder_themestyle_for_plugin() == 'style-2'){
		//If admin selected categories display of home page else all categories show on show page
		$catarr = (!empty($_POST['catarr'])) ? $_POST['catarr'] : '';
		if($catarr == 'yes'){
		$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
				$limit=3; //define results limit
				$newoffset = $getoffset + $limit; //define offset
				$i=0; //start line counter
				
		
				$categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				$totalcat = count($categories);
					
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						if ($i++ < $getoffset) continue;
					    if ($i > $getoffset + $limit) break;
						
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
                    </div>
					<a href="'.esc_url(get_term_link( $catdetails )).'" class="sf-category-link"></a>
              </div>
            </div>';
}

                    }
					
					?>
<?php if($totalcat > $newoffset){
if(!empty($catdetails)){
$html .= '<div class="show_more_main" id="show_more_main'.esc_attr($newoffset).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($newoffset).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
}
					}
					
                }
		}else{
					$limit = 3;
					$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
					$getsubcat = (!empty($_POST['subcat'])) ? $_POST['subcat'] : '';
					$newoffset = $getoffset + $limit;
					
					if($getsubcat == true){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$getoffset);
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
						
						?>
<?php if($totalcat > $newoffset){
$html .= '<div class="show_more_main" id="show_more_main'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-offset="'.esc_attr($newoffset).'" class="show_more btn btn-primary" title="Load more posts"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
} 
	
					}
		}
		}else{
		//If admin selected categories display of home page else all categories show on show page
		$catarr = (!empty($_POST['catarr'])) ? $_POST['catarr'] : '';
		if($catarr == 'yes'){
		$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
				$limit=3; //define results limit
				$newoffset = $getoffset + $limit; //define offset
				$i=0; //start line counter
				
		
				$categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				$totalcat = count($categories);
					
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						if ($i++ < $getoffset) continue;
					    if ($i > $getoffset + $limit) break;
						
                        $catimage =  service_finder_getCategoryImage($catdetails->term_id,'service_finder-category-home');
						if($catimage != ""){
						$class = '';
						$catimgtag = '<img src="'.esc_url($catimage).'" width="600" height="350" alt="'.esc_attr($catdetails->name).'">';
						}else{
						$class = 'sf-cate-no-img';
						$catimgtag = '';
						}
$html .= '<div class="col-md-4 col-sm-6">
  <div class="sf-element-bx equal-col">
  <a href="'.esc_url(get_term_link( $catdetails )).'">
  <div class="'.sanitize_html_class($class).' overlay-bg">
    <div class="sf-thum-bx sf-catagories-listing img-effect1" style="background-image:url('.esc_url($catimage).');">  </div>
    <span  class="service-plus"> <i class="fa fa-user-plus"></i> ('.service_finder_getTotalProvidersByCategory( $catdetails->term_id ).') </span>
    <h4 class="service-name pull-left">'.esc_html($catdetails->name).'</h4>
  </div>
  </a>
  </div>
</div>';
}

                    }
					
					?>
<?php if($totalcat > $newoffset){
if(!empty($catdetails)){
$html .= '<div class="show_more_main" id="show_more_main'.esc_attr($newoffset).'"> <span id="'.esc_attr($catdetails->term_id).'" data-catarr="yes" data-offset="'.esc_attr($newoffset).'" class="show_more btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
}
					}
					
                }
		}else{
					$limit = 3;
					$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
					$getsubcat = (!empty($_POST['subcat'])) ? $_POST['subcat'] : '';
					$newoffset = $getoffset + $limit;
					
					if($getsubcat == true){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$getoffset);
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
$html .= '<div class="col-md-4 col-sm-6">
  <div class="sf-element-bx equal-col">
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
						
						?>
<?php if($totalcat > $newoffset){
$html .= '<div class="show_more_main" id="show_more_main'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-offset="'.esc_attr($newoffset).'" class="show_more btn btn-primary" title="Load more posts"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="loding default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> </div>';
} 
	
					}
		}					
		}
		echo $html;
exit;
}

/*Load more categories on home page for version 2*/
add_action('wp_ajax_load_more_v2', 'service_finder_load_more_v2');
add_action('wp_ajax_nopriv_load_more_v2', 'service_finder_load_more_v2');

function service_finder_load_more_v2(){
global $service_finder_options;

		$html = '';
		if(service_finder_themestyle_for_plugin() == 'style-2'){
		
		//If admin selected categories display of home page else all categories show on show page
		$catarr = (!empty($_POST['catarr'])) ? $_POST['catarr'] : '';
		$showdes = (!empty($_POST['showdes'])) ? $_POST['showdes'] : '';
		if($catarr == 'yes'){
		
				$limit=4; //define results limit
				$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
				$newoffset = $getoffset + $limit; //define offset
				$i=0; //start line counter
				
		
				$categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				$totalcat = count($categories);
					
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						if ($i++ < $getoffset) continue;
					    if ($i > $getoffset + $limit) break;
						
						$catimage =  service_finder_getCategoryIcon($catdetails->term_id,'service_finder-category-icon');

$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
$imgtag = '';
if($catimage != ""){
	  $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($catdetails->name).'">';
}

$excerpt = '';

if($showdes == 'yes'){
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
<?php if($totalcat > $newoffset){
if(!empty($catdetails)){
$html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-catarr="yes" data-showdes="'.esc_attr($showdes).'" data-offset="'.esc_attr($newoffset).'" class="show_more_v2 btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span> </div>';
}
					}
					
                }
		}else{
					$limit = 4;
					$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
					$getsubcat = (!empty($_POST['subcat'])) ? $_POST['subcat'] : '';
					$newoffset = $getoffset + $limit;
					
					if($getsubcat == true){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$getoffset);
					if(!empty($categories)){
	
						foreach($categories as $category){
	
							$catimage =  service_finder_getCategoryIcon($category->term_id,'service_finder-category-icon');

$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
$imgtag = '';
if($catimage != ""){
	  $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($category->name).'">';
}

$excerpt = '';
if($showdes == 'yes'){
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
<?php if($totalcat > $newoffset){
$html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-showdes="'.esc_attr($showdes).'" data-offset="'.esc_attr($newoffset).'" class="show_more_v2 btn btn-primary" title="Load more posts"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span> </div>';
} 
	
					}
		}	
		
		}else{
		//If admin selected categories display of home page else all categories show on show page
		$catarr = (!empty($_POST['catarr'])) ? $_POST['catarr'] : '';
		$showdes = (!empty($_POST['showdes'])) ? $_POST['showdes'] : '';
		if($catarr == 'yes'){
		
				$limit=4; //define results limit
				$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
				$newoffset = $getoffset + $limit; //define offset
				$i=0; //start line counter
				
		
				$categories = (!empty($service_finder_options['homepage-categories'])) ? $service_finder_options['homepage-categories'] : '';
				$totalcat = count($categories);
					
                if(!empty($categories)){

                    foreach($categories as $category){
						$catdetails = get_term_by('id', $category, 'providers-category');
						if(!empty($catdetails)){
						if ($i++ < $getoffset) continue;
					    if ($i > $getoffset + $limit) break;
						
						$catimage =  service_finder_getCategoryIcon($catdetails->term_id,'service_finder-category-icon');

$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
$imgtag = '';
if($catimage != ""){
	  $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($catdetails->name).'">';
}

$excerpt = '';

if($showdes == 'yes'){
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
<?php if($totalcat > $newoffset){
if(!empty($catdetails)){
$html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-catarr="yes" data-showdes="'.esc_attr($showdes).'" data-offset="'.esc_attr($newoffset).'" class="show_more_v2 btn btn-primary" title="Load more categories"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder').'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span> </div>';
}
					}
					
                }
		}else{
					$limit = 4;
					$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
					$getsubcat = (!empty($_POST['subcat'])) ? $_POST['subcat'] : '';
					$newoffset = $getoffset + $limit;
					
					if($getsubcat == true){
					$subcategory = true;
					}else{
					$subcategory = false;
					}
					
					$allcat = service_finder_getCategoryList(0,$subcategory);
					$totalcat = count($allcat);
					
					$categories = service_finder_getCategoryListwithOffest($limit,$subcategory,$getoffset);
					if(!empty($categories)){
	
						foreach($categories as $category){
	
							$catimage =  service_finder_getCategoryIcon($category->term_id,'service_finder-category-icon');

$nocaticon = ($catimage == "") ? 'no-cat-icon' : '';
$imgtag = '';
if($catimage != ""){
	  $imgtag = '<img src="'.esc_url($catimage).'" width="80" height="80" alt="'.esc_attr($category->name).'">';
}

$excerpt = '';
if($showdes == 'yes'){
	$excerpt = '<p>'.nl2br(service_finder_getExcerpts($category->description,0,60)).'</p>';
}	
$html .= '<div class="col-md-3 col-sm-4 col-xs-6 equal-col">
  <div class="sf-element-bx">
    <div class="icon-bx-md rounded-bx '.$nocaticon.'">
      '.$imgtag.'
    </div>
    <h4><a href="'.esc_url(get_term_link( $category )).'">'.esc_html($category->name).'</a></h4>
    '.$excerpt.'
  </div>
</div>';
	
						}
						
						?>
<?php if($totalcat > $newoffset){
$html .= '<div class="show_more_main_v2" id="show_more_main_v2'.esc_attr($newoffset).'"> <span id="'.esc_attr($category->term_id).'" data-showdes="'.esc_attr($showdes).'" data-offset="'.esc_attr($newoffset).'" class="show_more_v2 btn btn-primary" title="Load more posts"><i class="fa fa-refresh"></i> '.esc_html__('Show more','service-finder') .'</span> <span class="lodingv2 default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span> </div>';
} 
	
					}
		}	
		}
		echo $html;				
exit;
}