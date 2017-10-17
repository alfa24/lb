<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*************************************************************
*
*	SedateTheme (c) sedatelab.com - Breadcrumb
*	Description: 
*
**************************************************************/
$service_finder_options = get_option('service_finder_options');
?>
<?php
$li = '';
$texonomy = 'providers-category';
if(is_tax( $texonomy )){
	$catid = get_queried_object()->term_id;
	$term = get_term( $catid, $texonomy );
	if($term->parent > 0){
	$termid = $term->parent;
		$li = '<li><a href="'.esc_url(get_term_link( $term->parent, $texonomy )).'">'.service_finder_getCategoryName($term->parent).'</a></li>';
		$li .= '<li>'.service_finder_getCategoryName($catid).'</li>';
	}else{
		$li = '<li>'.service_finder_getCategoryName($catid).'</li>';
	}
}elseif(is_author()){
$authorcatid = get_user_meta($author,'primary_category',true);
$term = term_exists($authorcatid, $texonomy);
if ($term !== 0 && $term !== null) {
if($authorcatid != ""){
$link = get_term_link( $authorcatid, $texonomy );
	$li = '<li><a href="'.esc_url($link).'">'.service_finder_getCategoryName($authorcatid).'</a></li>';
	$li .= '<li>'.service_finder_getProviderName($author).'</li>';
}	
}
}elseif(is_search()){
	$li .= '<li>Search</li>';
}elseif(is_404()){
	$li .= '<li>404</li>';
}else{
	$li .= '<li>'.get_the_title().'</li>';
}

?>
<?php
$breadcrumbs = service_finder_breadcrumb();
if($breadcrumbs):
?>
<!-- Breadcrumb  Templates Start -->

<div class="breadcrumb-row">
  <div class="container">
    <ul class="list-inline">
      <li><a href="<?php echo esc_url(home_url('/')); ?>">
        <?php esc_html_e('Home', 'service-finder'); ?>
        </a></li>
      <?php 
	  $allowedhtml = array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'li' => array(),
		);
	  echo wp_kses($li,$allowedhtml); 
	  ?>
    </ul>
  </div>
</div>
<!-- Breadcrumb  Templates End -->
<?php endif; ?>
