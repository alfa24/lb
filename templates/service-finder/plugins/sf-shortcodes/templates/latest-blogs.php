<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$wpdb = service_finder_shortcode_global_vars('wpdb');
?>
<!-- Latest blog post -->
<?php
$postinner = '';

$showitem = (isset($a['showitem'])) ? esc_html($a['showitem']) : 3;

if(service_finder_themestyle_for_plugin() == 'style-2'){
$slideritem = 3;
}else{
$slideritem = 2;
}

wp_add_inline_script( 'service_finder-js-custom', 'var showblogitem = "'.$slideritem.'";', 'before' );

$args = array(

	'post_type'=> 'post',

	'post_status' => 'publish',

	'orderby' => 'post_date',
	
	'order' => 'DESC',

	'posts_per_page'  => $showitem,

);

$the_query = new WP_Query( $args );
while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
<?php
if ( has_post_thumbnail() ) { 
$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'service_finder-blog-home-page' );
$imgsrc = $imgsrc[0];
}else{
$imgsrc = '';
}

if($imgsrc != ""){
if(service_finder_themestyle_for_plugin() == 'style-2'){
$imgtag = '<a href="'.esc_url(get_the_permalink()).'"><img src="'.esc_url($imgsrc).'" alt=""><div class="sf-overlay-box"></div></a>';
}else{
$imgtag = '<img src="'.esc_url($imgsrc).'" alt="">';
}
$class = 'sf-no-img-blog';
}else{
$imgtag = '';
$class = 'sf-no-img-blog';
}
$posttags = get_the_tags(get_the_id());
$tagname = '';
if ($posttags) {
  foreach($posttags as $tag) {
    $tagname .= '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a>' . ' '; 
  }
}
?>
<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){
$postinner .= '<div class="blog-post '.sanitize_html_class($class).' equal-height-bx">
                              <div class="post-bx sf-latest-news">
                              
                                <div class="post-thum">
                                    '.$imgtag.'
                                </div>
                                
                                <div class="post-info">
                                    
                                    <div class="post-text">
                                        <h4 class="post-title"><a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a></h4>
                                        <div class="post-meta">
                                            <ul>
                                                <li class="post-author"><i class="fa fa-user"></i>'.esc_html__('By', 'service-finder').' '.get_the_author_posts_link().'</li>
                                                <li class="post-comment"><i class="fa fa-comments"></i><a href="'.esc_url(get_comments_link()).'">'.get_comments_number( get_the_id() ).' '.esc_html__('Comments','service-finder').'</a></li>
                                            </ul>
                                        </div>
                                        <p>'.service_finder_getExcerpts(get_the_excerpt(),0,75).'</p> 
                                    </div>
                                    
                                </div>
                                
                              </div>
                            </div>';
}else{
$postinner .= '<div class="blog-post '.sanitize_html_class($class).' equal-height-bx">
<div class="post-bx">
  <div class="post-thum img-effect2">
	'.$imgtag.'
	<div class="post-date"> <strong><a href="'.esc_url(get_the_permalink()).'">'.date('d',strtotime(get_the_date())).'</a></strong> <span>'.date('M',strtotime(get_the_date())).'</span> </div>
  </div>
  <div class="post-info">
	<div class="post-text">
	  <h4 class="post-title">
	   <a href="'.esc_url(get_the_permalink()).'">'.get_the_title().'</a>
	  </h4>
	  <div class="post-meta">
		<ul>
		  <li class="post-author"><i class="fa fa-user"></i>
			'.esc_html__('By', 'service-finder').'
		   '.get_the_author_posts_link().'
		  </li>
		  <li class="post-comment"><i class="fa fa-comments"></i>
		  <a href="'.esc_url(get_comments_link()).'">'.get_comments_number( get_the_id() ).' '.esc_html__('Comments','service-finder').'</a>
		  </li>
		  <li class="post-tags"><i class="fa fa-tags"></i>
			'.$tagname.'
		  </li>
		</ul>
	  </div>
	  <p>'.get_the_excerpt().'</p>
	  <a href="'.esc_url(get_the_permalink()).'" class="read-more">
	  '.esc_html__('Read More', 'service-finder').'
	  </a> </div>
  </div>
</div>
</div>';
}
?>                                        
<?php 
endwhile; 
?>
<!-- Latest blog post -->

<?php
if(service_finder_themestyle_for_plugin() == 'style-2'){
$html = '<section class="section-full latest-blog">
            <div class="container">
            
            
            	<div class="section-head text-center">
                    <h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
					'.service_finder_title_separator().'
                    <p>'.esc_html($a['tagline']).'</p>
                </div>
                    
                <div class="section-content">
                    <div class="owl-blogs">';
                        
                        $html .= $postinner;
                        
                    $html .= '</div>
                </div>
                
            </div>
        </section>';
}else{
$html = '<section class="section-full bg-white latest-blog">
<div class="container">
<div class="section-head text-center">
<h2 class="text-uppercase">'.esc_html($a['title']).'</h2>
'.service_finder_title_separator().'
<p>'.esc_html($a['tagline']).'</p>
</div>
<div class="section-content">
<div class="row equal-bx-outer"><div class="owl-blogs">';

$html .= $postinner;

$html .= '</div></div>
</div>
</div>
</section>';	  
}
?>
