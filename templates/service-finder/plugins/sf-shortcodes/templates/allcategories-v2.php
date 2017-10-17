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
$html = '<div class="container"><div class="form-bx padding-20 bg-white clearfix">
<h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
'.service_finder_title_separator().'
<p>'.esc_html($a['tagline']).'</p>';
?>
  
  <?php
  
  if(class_exists('service_finder_texonomy_plugin')){
				
		$categories = service_finder_getCategoryList(0,false);

		if(!empty($categories)){
			
			if($a['subcategory'] == 'no'){
				$html .= '<div class="col-md-12 sf-cati-row"><ul class="list-unstyled">';
			}

			foreach($categories as $category){
				
				if($a['subcategory'] == 'yes'){
					
					$html .= '<div class="col-md-12 sf-cati-row">';
					
					$html .= '<h4><a href="'.esc_url(get_term_link( $category )).'">'.esc_html($category->name).'</a></h4>';
					
					$childcategories = service_finder_get_child_category($category->term_id);
					
					if(!empty($childcategories)){
						$html .= '<ul class="list-unstyled">';
						foreach($childcategories as $child){
							$caticon = service_finder_getCategoryIcon($category->term_id,'service_finder-all-category-icon');
							if($caticon != ""){
							$img = '<img src="'.esc_url($caticon).'">';
							}else{
							$img = '';
							}
						
							$html .= '<li><span class="icon-bx-sm">'.$img.'</span><a href="'.esc_url(get_term_link( $child )).'">'.esc_html($child->name).'</a></li>';		
						}
						$html .= '</ul>';
					}
					
					$html .= '</div>';
				}else{
					$html .= '<li><h4><a href="'.esc_url(get_term_link( $category )).'">'.esc_html($category->name).'</a></h4></li>';	
				}	
			}
			
			if($a['subcategory'] == 'no'){
				$html .= '</ul></div>';
			}
		}
	}					
$html .= '</div></div>';
?>
