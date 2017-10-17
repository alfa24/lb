<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
/**
* Add the stylesheet
*/

function service_finder_shortcodes_scripts() {
 
	/*Bootstrap Validator*/
	wp_enqueue_script('bootstrapValidator', plugins_url('/sf-shortcodes/') . '/js/validator/bootstrapValidator.js', array('jquery') , '', true);
	wp_enqueue_style('bootstrapValidator', plugins_url('/sf-shortcodes/') . '/js/validator/bootstrapValidator.css');
	
	/*For Featured Providers*/
	if(!is_author()){
	wp_enqueue_script('service_finder-js-featured-providers', plugins_url('/sf-shortcodes/') . '/js/featured-providers.js', array('jquery') , '', true);
	}
	wp_enqueue_script('service_finder-js-plugin-custom', plugins_url('/sf-shortcodes/') . '/js/custom.js', array('jquery') , '', true);
	/*For Contact form*/
	wp_enqueue_script('service_finder-js-plugin-contactform', plugins_url('/sf-shortcodes/') . '/js/contactform.js', array('jquery') , '', true);
	
}
add_action( 'wp_enqueue_scripts', 'service_finder_shortcodes_scripts' );

/* Contact Us Form Submission via ajax */
add_action('wp_ajax_contactform', 'service_finder_contactform');
add_action('wp_ajax_nopriv_contactform', 'service_finder_contactform');

function service_finder_contactform(){
	global $wpdb, $service_finder_options;

	$admin_email = (!empty($service_finder_options['email'])) ? $service_finder_options['email'] : '';

	if(!empty($service_finder_options['contactus-to-admin'])){
		$message = $service_finder_options['contactus-to-admin'];
	}else{
		$message = 'Contact Us

Full Name: %FULLNAME%

Email: %EMAIL%

Phone: %PHONE%

Comment: %COMMENT%
';
	}
			
			$tokens = array('%FULLNAME%','%EMAIL%','%PHONE%','%COMMENT%');
			$replacements = array($_POST['uname'],$_POST['email'],$_POST['phone'],$_POST['comment']);
			$msg_body = str_replace($tokens,$replacements,$message);
			
			if($service_finder_options['contactus-to-admin-subject'] != ""){
				$msg_subject = $service_finder_options['contactus-to-admin-subject'];
			}else{
				$msg_subject = esc_html__('Contact Us', 'service-finder');
			}
			
			if(service_finder_wpmailer($admin_email,$msg_subject,$msg_body)) {

				$success = array(
						'status' =>'success',
						'suc_message' => esc_html__('Mail has been sent', 'service-finder'),
						);
				echo json_encode($success);
				
			} else {
					
				$error = array(
						'status' => 'error',
						'err_message' => esc_html__('Mail could not be sent.', 'service-finder'),
						);
				echo json_encode($error);
			}
	exit;

} 

//Action hook to call shortcodes
add_action( 'init', 'service_finder_register_shortcodes');
function service_finder_register_shortcodes() {
	/* Contact Us Page */
	function service_finder_contactus_form($atts, $content = null)
	{
	$html = '<form method="post" class="contactform">
	  <div class="row">
		<div class="col-md-6">
		  <div class="form-group">
			<div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i></span>
			  <input name="uname" type="text" class="form-control" placeholder="'.esc_html__('Name', 'service-finder').'">
			</div>
		  </div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
			<div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
			  <input name="email" type="text" class="form-control" placeholder="'.esc_html__('Email', 'service-finder').'">
			</div>
		  </div>
		</div>
		<div class="col-md-12">
		  <div class="form-group">
			<div class="input-group"> <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
			  <input name="phone" type="text" class="form-control" placeholder="'.esc_html__('Phone', 'service-finder').'">
			</div>
		  </div>
		</div>
		<div class="col-md-12">
		  <div class="form-group">
			<div class="input-group"> <span class="input-group-addon v-align-t"><i class="fa fa-pencil"></i></span>
			  <textarea name="comment" rows="4" class="form-control" placeholder="'.esc_html__('Comments', 'service-finder').'"></textarea>
			</div>
		  </div>
		</div>
		<div class="col-md-12">
		  <input name="submit" type="submit" value="'.esc_html__('Submit', 'service-finder').'" class="btn btn-primary margin-r-10">
		  <input name="Resat" type="reset" value="'.esc_html__('Reset', 'service-finder').'"  class="btn btn-custom">
		</div>
	  </div>
	</form>';
	return $html;
	}
	add_shortcode( 'service-finder-contactus', 'service_finder_contactus_form' );
	
	/*Home Page Shortcodes Start*/

	/*How Service Finder Works Start 1. Outer and 2. Inner*/
	function service_finder_how_works($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/how-it-works.php';
			
			return $html;
	}
	add_shortcode( 'How-It-Works', 'service_finder_how_works' );
	
	function service_finder_workprocess($atts, $content = null)
	{
	
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'img' => '',
			   
			   'number' => '',
	
			), $atts );
	
			require plugin_dir_path(__FILE__) . '/work-process.php';
			
			return $html;
	
	}
	add_shortcode( 'Work-Process', 'service_finder_workprocess' );
	/*How Service Finder Works End*/
	
	/*Why Choose Us Start 1. Outer and 2. Inner*/
	function service_finder_why_choose_us($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/why-choose-us.php';
			
			return $html;
	}
	add_shortcode( 'Why-Choose-Us', 'service_finder_why_choose_us' );
	
	function service_finder_why_choose_us_inner($atts, $content = null)
	{
	
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'img' => '',
			   
			), $atts );
	
			require plugin_dir_path(__FILE__) . '/why-choose-us-inner.php';
			
			return $html;
	
	}
	add_shortcode( 'Why-Choose-Us-Inner', 'service_finder_why_choose_us_inner' );
	/*Why Choose Us End*/
	
	/*Statistics Start 1. Outer and 2. Inner*/
	function service_finder_statistics($atts, $content = null)
	{
			
			require plugin_dir_path(__FILE__) . '/statistics.php';
			
			return $html;
	}
	add_shortcode( 'service-finder-statistics', 'service_finder_statistics' );
	
	function service_finder_statistics_inner($atts, $content = null)
	{
	
			$a = shortcode_atts( array(
	
			   'fa-icon' => '',
	
			   'number' => '0',
			   
			   'text' => '',
			   
			   'type' => '',
			   
			), $atts );
	
			require plugin_dir_path(__FILE__) . '/statistics-inner.php';
			
			return $html;
	
	}
	add_shortcode( 'service-finder-statistics-Inner', 'service_finder_statistics_inner' );
	/*Statistics End*/
	
	/*Jobs outer start*/
	function service_finder_jobs_outer($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/jobs-outer.php';
			
			return $html;
	}
	add_shortcode( 'service-finder-jobs-outer', 'service_finder_jobs_outer' );
	/*Jobs outer end*/
	
	/*Who's Service Finder Start*/
	function service_finder_bio($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			   'btntext' => '',
			   
			   'btnlink' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/bio.php';
			
			return $html;
	}
	add_shortcode( 'Show-Bio', 'service_finder_bio' );
	/*Who's Service Finder End*/
	
	/*Why Use Service Finder Start 1. Outer ans 2. Inner*/
	function service_finder_features_outer($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/features-outer.php';
			
			return $html;
	}
	add_shortcode( 'Show-Features', 'service_finder_features_outer' );
	
	function service_finder_features_inner($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'fa_icon' => '',
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/features-inner.php';
			
			return $html;
	}
	add_shortcode( 'Feature', 'service_finder_features_inner' );
	/*Why Use Service Finder End*/
	
	/*Testimonials Start 1. Outer ans 2. Inner*/
	function service_finder_testimonials_outer($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/testimonials-outer.php';
			
			return $html;
	}
	add_shortcode( 'Show-Testimonials', 'service_finder_testimonials_outer' );
	
	function service_finder_testimonials_inner($atts, $content = null)
	{
			
			$html = '';
			
			$a = shortcode_atts( array(
	
			   'name' => '',
	
			   'avatar' => '',
			   
			   'designation' => '',
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/testimonials-inner.php';
			
			return $html;
	}
	add_shortcode( 'Testimonial', 'service_finder_testimonials_inner' );
	/*Testimonials End*/
	
	/*Latest Blogs Start*/
	function service_finder_latest_blogs($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
			   
			   'tagline' => '',
			   
			   'showitem' => 3,
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/latest-blogs.php';
			
			return $html;
	}
	add_shortcode( 'Latest-Blogs', 'service_finder_latest_blogs' );
	/*Latest Blogs End*/
	
	/*Featured Providers Start*/
	if(class_exists('service_finder_booking_plugin')) {
	function service_finder_featured_providers($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
			   
			   'tagline' => '',
			   
			   'numberofproviders' => '',
			   
			   'showitem' => 3,
			   
			   'categoryid' => 0,
			   
			   'fullwidth' => 'no',
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/featured-providers.php';
			
			return $html;
	}
	add_shortcode( 'Featured-Providers', 'service_finder_featured_providers' );
	
	/*Service Finder Categories Start*/
	function service_finder_categories($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			   'limit' => 6,
	
			   'subcategory' => false,
			   
			   'showmore' => 'yes',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/categories.php';
			
			return $html;
	}
	add_shortcode( 'Show-Categories', 'service_finder_categories' );
	/*Service Finder Categories End*/
	
	/*Service Finder Categories V2 Start*/
	function service_finder_categories_version2($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			   'limit' => 8,
	
			   'subcategory' => false,
			   
			   'showmore' => 'yes',
			   
			   'showdescription' => 'yes',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/categories-v2.php';
			
			return $html;
	}
	add_shortcode( 'Show-Categories-V2', 'service_finder_categories_version2' );
	/*Service Finder Categories V2 End*/
	
	/*Service Finder Show All Categories Start*/
	function service_finder_all_categories($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
	
			   'tagline' => '',
			   
			   'subcategory' => 'yes',
			   
			   'style' => '2',
			   
			), $atts );
			
			if($a['style'] == 2){
			require plugin_dir_path(__FILE__) . '/allcategories-v2.php';
			}else{
			require plugin_dir_path(__FILE__) . '/allcategories-v1.php';
			}
			
			return $html;
	}
	add_shortcode( 'Show-All-Categories', 'service_finder_all_categories' );
	/*Service Finder Show All Categories End*/
	
	/*Followers Section Start*/
	function service_finder_followers($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
			   
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/followers.php';
			
			return $html;
	}
	add_shortcode( 'Show-Followers', 'service_finder_followers' );
	/*Followers Section End*/
	}
	/*Featured Providers End*/
	
	/*Home Page Shortcodes End*/
	
	/*Show providers based on category and location*/
	function service_finder_show_providers($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'catid' => '',
	
			   'location' => '',
			   
			   'featured' => 0,
			   
			   'limit' => 10,
			   
			   'orderby' => 'title',
			   
			   'viewtype' => 'grid-4',
	
			), $atts );
			
			require plugin_dir_path(__FILE__) . '/providers.php';
			
			return $html;
	}
	add_shortcode( 'Show-Providers', 'service_finder_show_providers' );
	
	/*Show pricing table*/
	function service_finder_pricing_table($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
			   
			   'style' => '',
			   
			   'tagline' => '',

			), $atts );
			
			require plugin_dir_path(__FILE__) . '/pricing-table.php';
			
			return $html;
	}
	add_shortcode( 'service-finder-pricing-table', 'service_finder_pricing_table' );
	
	/*Show pricing table column */
	function service_finder_pricing_table_column($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'price' => '',
			   
			   'period' => '',
	
			   'title' => '',
			   
			   'link' => '',
			   
			   'signuptype' => 'page',
			   
			   'packagenumber' => '2',
			   
			   'highlight' => 'no',

			), $atts );
			
			require plugin_dir_path(__FILE__) . '/pricing-table-column.php';
			
			return $html;
	}
	add_shortcode( 'pricing-table-column', 'service_finder_pricing_table_column' );
	
	/*Pricing table column feature*/
	function service_finder_pricing_table_column_feature($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => '',
			   
			   'available' => 'yes',

			), $atts );
			
			require plugin_dir_path(__FILE__) . '/pricing-table-features.php';
			
			return $html;
	}
	add_shortcode( 'pricing-table-column-feature', 'service_finder_pricing_table_column_feature' );
	
	/*Request Quote Form*/
	function service_finder_request_quote($atts, $content = null)
	{
			
			$a = shortcode_atts( array(
	
			   'title' => esc_html__('Request a Quote', 'service-finder'),
			   
			   'type' => 'page',

			), $atts );
			
			require plugin_dir_path(__FILE__) . '/request-quote.php';
			
			return $html;
	}
	add_shortcode( 'request-quote', 'service_finder_request_quote' );
	
} 
