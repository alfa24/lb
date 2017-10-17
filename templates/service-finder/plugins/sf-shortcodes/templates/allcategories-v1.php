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
$innerhtml = '';
?>
<!-- sf categories  -->
        <?php
				if(class_exists('service_finder_texonomy_plugin')){
				
					if($a['subcategory'] == 'yes'){
						$categories = service_finder_getCategoryList(0,true);
					}else{
						$categories = service_finder_getCategoryList(0,false);
					}

					if(!empty($categories)){
	
						foreach($categories as $category){
	
							$catimage =  service_finder_getCategoryImage($category->term_id,'service_finder-category-home');
							$term_id = (!empty($catdetails->term_id)) ? $catdetails->term_id : '';
							if($catimage != ""){
							$class = '';
							}else{
							$class = 'sf-cate-no-img';
							}
							
							$innerhtml .= '<div class="col-md-4 equal-col col-sm-6">
							<a href="'.esc_url(get_term_link( $category )).'">
          <div class="sf-element-bx '.sanitize_html_class($class).' overlay-bg">
            <div class="sf-thum-bx sf-catagories-listing img-effect1" style="background-image:url('.esc_url($catimage).');"> </div>
            <span  class="service-plus"> <i class="fa fa-user-plus"></i>('.service_finder_getTotalProvidersByCategory( $category->term_id ).')</span>
            <h4 class="service-name pull-left">'.esc_html($category->name).'</h4>
          </div>
		  </a>
        </div>';
	
						}
						
						?>
        <?php
	
					}
				}
                ?>

<?php 
$html = '<section class="section-full text-center bg-gray sf-category">
  <div class="container">
    <div class="section-head">
      <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
      '.service_finder_title_separator().'
      <p>'.esc_html($a['tagline']).'</p>
    </div>
    <div class="section-content">
      <div class="row catlist equal-col-outer">'; 

$html .= $innerhtml;
	  
$html .= '</div>
    </div>
  </div>
</section>';	  
?>
<!-- sf categories END -->
