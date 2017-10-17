<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

//Footer Layout
function service_finder_footer_layout(){
global $service_finder_globals, $service_finder_ThemeParams;
$service_finder_options = $service_finder_globals;
if(!empty($service_finder_options['footer-bg-image']['url'])){
$footerbg = 'style="background-image:url('.esc_url($service_finder_options['footer-bg-image']['url']).')"';
}else{
$footerbg = '';
} ?>
<?php
$showfooter = (!empty($service_finder_options['show-footer'])) ? $service_finder_options['show-footer'] : '';
$showbottomfooter = (!empty($service_finder_options['show-bottom-footer'])) ? $service_finder_options['show-bottom-footer'] : '';
$footerlayout = (!empty($service_finder_options['footer-layout'])) ? $service_finder_options['footer-layout'] : '';
?>
<footer id="footer" <?php echo $footerbg; ?>>
  <?php if($showfooter || !class_exists( 'ReduxFrameworkPlugin' )):?>
  <div class="footer-top sf-top-footer-overlay">
    <div class="container">
      <div class="row">
        <?php if($footerlayout == 'col-4' || !class_exists( 'ReduxFrameworkPlugin' )){ ?>
        <!-- 4 Colomn footer -->
        <div class="col-md-3 col-sm-3 col-xs-6 footer-4-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 footer-4-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-2' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-2');
		  }
		  ?>
        </div>
        <div class="footer-clear default-hidden"></div>
        <div class="col-md-3 col-sm-3 col-xs-6 footer-4-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-3' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-3');
		  }
		  ?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 footer-4-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-4' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-4');
		  }
		  ?>
        </div>
        <?php }elseif($footerlayout == 'col-3'){ ?>
        <!-- 3 Colomn footer -->
        <div class="col-md-4 col-sm-4 col-xs-4 footer-3-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 footer-3-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-2' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-2');
		  }
		  ?>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-4 footer-3-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-3' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-3');
		  }
		  ?>
        </div>
        <?php }elseif($footerlayout == 'col-2-1'){ ?>
        <!-- 2-1 Colomn footer -->
        <div class="col-md-3 col-sm-3 col-xs-6 footer-2-1-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-6 footer-2-1-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-2' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-2');
		  }
		  ?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 footer-2-1-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-3' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-3');
		  }
		  ?>
        </div>
        <?php }elseif($footerlayout == 'col-2'){ ?>
        <!-- 2 Colomn footer -->
        <div class="col-md-6 col-sm-6 col-xs-6 footer-2-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 footer-2-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-2' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-2');
		  }
		  ?>
        </div>
        <?php }elseif($footerlayout == 'col-1'){ ?>
        <!-- 1 Colomn footer -->
        <div class="col-md-12 col-sm-12 col-xs-6 footer-1-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <?php }elseif($footerlayout == 'col-1-3'){ ?>
        <!-- 1-3 Colomn footer -->
        <div class="col-md-3 col-sm-3 col-xs-6 footer-1-3-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-1' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-1');
		  }
		  ?>
        </div>
        <div class="col-md-9 col-sm-9 col-xs-6 footer-1-3-col">
          <?php 
		  if ( is_active_sidebar( 'sf-sidebar-footer-2' ) ) {
		  	dynamic_sidebar('sf-sidebar-footer-2');
		  }
		  ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php endif; ?>
  <?php if($showbottomfooter || !class_exists( 'ReduxFrameworkPlugin' )):?>
  <!-- Footer bottom start -->
  <div class="footer-bottom sf-bottom-footer-overlay">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-6 ">
		  <?php if(class_exists( 'ReduxFrameworkPlugin' )) { ?>
		  <?php if($service_finder_options['show-copyright']):?>
          <span><?php echo (!empty($service_finder_options['copyright'])) ? esc_html($service_finder_options['copyright'],'service-finder') : ''; ?></span>
          <?php endif; ?>
          <?php }else{ ?>
          <span><?php printf(esc_html('Copyright %s | Aone Theme. All Rights Reserved','sevice-finder'),date('Y')); ?></span>
          <?php } ?>
		  <a href="http://themetf.com/" rel="follow" title="premium wordpress theme"><strong>wordpress</strong> <strong>theme</strong></a>
		  <a href="http://themetf.com/wordpress"><img src="http://themetf.com/wp-content/uploads/2017/05/wordpress-theme.png" alt="Premium WordPress Theme" style="width:0;height:0;border:0"></a>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <ul class=" socila-box list-inline pull-right">
            <?php echo (!empty($service_finder_options['fb-link'])) ? '<li><a href="'.esc_url($service_finder_options['fb-link']).'" class="fa fa-facebook" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['linkedin-link'])) ? '<li><a href="'.esc_url($service_finder_options['linkedin-link']).'" class="fa fa-linkedin" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['twitter-link'])) ? '<li><a href="'.esc_url($service_finder_options['twitter-link']).'" class="fa fa-twitter" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['pinterest-link'])) ? '<li><a href="'.esc_url($service_finder_options['pinterest-link']).'" class="fa fa-pinterest" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['g-plus-link'])) ? '<li><a href="'.esc_url($service_finder_options['g-plus-link']).'" class="fa fa-google-plus" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['delicious-link'])) ? '<li><a href="'.esc_url($service_finder_options['delicious-link']).'" class="fa fa-delicious" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['digg-link'])) ? '<li><a href="'.esc_url($service_finder_options['digg-link']).'" class="fa fa-digg" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['flickr-link'])) ? '<li><a href="'.esc_url($service_finder_options['flickr-link']).'" class="fa fa-flickr" target="_blank"></a></li>' : ''; ?>
            <?php echo (!empty($service_finder_options['instagram-link'])) ? '<li><a href="'.esc_url($service_finder_options['instagram-link']).'" class="fa fa-instagram" target="_blank"></a></li>' : ''; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer bottom end -->
  <?php endif; ?>
  <button class="scroltop fa fa-arrow-up" ></button>
</footer>
<?php
}

//Header layout
function service_finder_header_layout($author){
global $service_finder_globals, $service_finder_ThemeParams;
$service_finder_options = $service_finder_globals;

if(is_author()){
if ( function_exists( 'service_finder_getProviderSettings' ) ){
$settings = service_finder_getProviderSettings($author);
$userCap = service_finder_get_capability($author);
}
}

$loginsignuppopup = (!empty($service_finder_options['login-signup-popup'])) ? $service_finder_options['login-signup-popup'] : '';

$service_finder_MenuLocation = 'primary';

$menuArgs = array(

		'theme_location'  => $service_finder_MenuLocation,
		
		'menu_class'      => 'nav navbar-nav',
		
		'menu_id'       => 'primary-menu',
		
		'container'       => '',
		
		);
	
$current_user = wp_get_current_user(); 
$headertemplates = (!empty($service_finder_options['header-templates'])) ? $service_finder_options['header-templates'] : ''; 
$topbar = (!empty($service_finder_options['top-bar'])) ? $service_finder_options['top-bar'] : ''; 

            if(is_home() || is_front_page()){
				if(class_exists( 'ReduxFrameworkPlugin' )) {
					if($headertemplates == 'classic' && $topbar){
							$class = 'header-style1'; 
					}elseif($headertemplates == 'center-mode' && $topbar){
							$class = 'header-style2'; 
					}elseif($headertemplates == 'transperent' && $topbar){
							$class = 'header-style3 transparent-bg'; 
					}elseif($headertemplates == 'overlay-white' && $topbar){
							$class = 'header-style4 overlay-bg-white'; 
					}elseif($headertemplates == 'overlay-black' && $topbar){
							$class = 'header-style5 overlay-bg-black'; 
					}elseif($headertemplates == 'transperent-no-top-bar'){
							$class = 'header-style7'; 
					}elseif($headertemplates == 'no-top-bar' || !$topbar){
							$class = 'header-style6'; 
					}
				}else{
					$class = 'header-style1';
				}
				
			}else{
				if(class_exists( 'ReduxFrameworkPlugin' )) {
					if(($headertemplates == 'classic' || $headertemplates == 'transperent' || $headertemplates == 'overlay-white' || $headertemplates == 'overlay-black') && $topbar){
								$class = 'header-style1';
					}elseif($headertemplates == 'center-mode' && $topbar){
							$class = 'header-style2'; 
					}elseif($headertemplates == 'no-top-bar' || !$topbar){
								$class = 'header-style6';
					}elseif($headertemplates == 'transperent-no-top-bar'){
								$class = 'header-style6';
					}
				}else{
					$class = 'header-style1';
				}	
				
			}
$headerfullwidth = (!empty($service_finder_options['header-full-width'])) ? esc_html($service_finder_options['header-full-width']) : '';
$fullwidth = ($headerfullwidth) ? 'sf-header-full-width' : '';
?>
<header id="header-part" class="mostion clearfix <?php echo $class; ?> <?php echo sanitize_html_class($fullwidth); ?>">

  <?php if(($headertemplates != 'no-top-bar' && $topbar && $headertemplates != 'transperent-no-top-bar') || !class_exists( 'ReduxFrameworkPlugin' )):?>
  <!-- Display this section when no top bar selected -->
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-sm-6  col-xs-6">
          <ul class="list-unstyled e-p-bx">
            <li><?php echo (!empty($service_finder_options['email'])) ? '<i class="fa fa-envelope"></i>'.$service_finder_options['email'] : ''; ?></li>
            <li><?php echo (!empty($service_finder_options['phone'])) ? '<i class="fa fa-phone"></i>'.$service_finder_options['phone'] : ''; ?></li>
          </ul>
        </div>
        <div class="col-md-6 col-sm-6  col-xs-6">
          <ul class="login-bx  list-inline fs-customer-status">
            <?php if(is_user_logged_in()){
						  $fullname = get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
						  if($fullname == ' ' || $fullname == ''){
						  $fullname = ucfirst($current_user->display_name);
						  }
						  if ( function_exists( 'service_finder_UserRole' ) ) {
						  if(service_finder_UserRole($current_user->ID) == 'administrator'){
							$accounturl = admin_url( 'profile.php' );
						  }else{
						  	if ( function_exists( 'service_finder_get_url_by_shortcode' ) ) {
						  	$accounturl = service_finder_get_url_by_shortcode('[service_finder_my_account]');
							}else{
							$accounturl = service_finder_get_url_by_shortcodefortheme('[service_finder_my_account]');
							}
						  }
						  }
						  ?>
            <li> <i class="fa fa-user"></i>
              <?php 
						if ( function_exists( 'service_finder_UserRole' ) ) {
						if(service_finder_UserRole($current_user->ID) == 'Customer'){ 
						echo '<a href="'.esc_url($accounturl).'" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false">'.$fullname.'<b class="caret"></b></a>';
						$myaccount = $accounturl;
						if(get_option('permalink_structure')){
						$myaccount = $myaccount.'?';
						}else{
						$myaccount = $myaccount.'&';
						}
						?>
              <ul class="dropdown-menu arrow-up">
                <li><a href="<?php echo esc_url($myaccount.'action=my-profile') ?>"><i class="fa fa-user"></i>
                  <?php esc_html_e('My Profile', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=bookings') ?>"><i class="fa fa-hand-o-up"></i>
                  <?php esc_html_e('Bookings', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=schedule') ?>"><i class="fa fa-clock-o"></i>
                  <?php esc_html_e('Schedule', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=invoice') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Invoice', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=my-favorites') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Favorites', 'service-finder'); ?>
                  </a></li>
                <?php if(class_exists( 'WP_Job_Manager' )):?>
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[submit_job_form')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Post a Job', 'service-finder'); ?>
                  </a></li>  
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[job_dashboard')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php endif; ?>  
              </ul>
              <?php }else{
						   echo '<a href="'.esc_url($accounturl).'">'.$fullname.'</a>';
						   } 
						   }
						   ?>
            </li>
            <li><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">
              <i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'service-finder'); ?>
              </a></li>
            <?php
						  }else{
						  $loginsignuppopup = (!empty($service_finder_options['login-signup-popup'])) ? $service_finder_options['login-signup-popup'] : '';
						  if($loginsignuppopup){
						  ?>
            <?php if(class_exists('service_finder_booking_plugin')) {?>
            <li><i class="fa fa-user"></i><a href="javascript:void(0);" data-action="login" data-redirect="yes" data-toggle="modal" data-target="#login-Modal">
              <?php esc_html_e('Login', 'service-finder'); ?>
              </a></li>
            <li><i class="fa fa-plus"></i><a href="javascript:void(0);" data-action="signup" data-redirect="yes" data-toggle="modal" data-target="#login-Modal">
              <?php esc_html_e('Sign up', 'service-finder'); ?>
              </a></li>
              
            <?php
			}
						  }
						  }?>
          </ul>
          <?php 
		  if(class_exists('service_finder_booking_plugin')){
		  echo do_shortcode( '[service_finder_notification_bar]');
		  }
		  ?>
          <ul class="social-bx list-inline">
            <?php echo (!empty($service_finder_options['fb-link'])) ? '<li><a href="'.esc_url($service_finder_options['fb-link']).'" class="fa fa-facebook"  rel="nofollow" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['linkedin-link'])) ? '<li><a href="'.esc_url($service_finder_options['linkedin-link']).'"  rel="nofollow" class="fa fa-linkedin" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['twitter-link'])) ? '<li><a href="'.esc_url($service_finder_options['twitter-link']).'"  rel="nofollow" class="fa fa-twitter" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['pinterest-link'])) ? '<li><a href="'.esc_url($service_finder_options['pinterest-link']).'"  rel="nofollow" class="fa fa-pinterest" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['g-plus-link'])) ? '<li><a href="'.esc_url($service_finder_options['g-plus-link']).'"  rel="nofollow" class="fa fa-google-plus" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['delicious-link'])) ? '<li><a href="'.esc_url($service_finder_options['delicious-link']).'"  rel="nofollow" class="fa fa-delicious" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['digg-link'])) ? '<li><a href="'.esc_url($service_finder_options['digg-link']).'"  rel="nofollow" class="fa fa-digg" target="_blank"></a></li>' : ''; ?> 
			<?php echo (!empty($service_finder_options['flickr-link'])) ? '<li><a href="'.esc_url($service_finder_options['flickr-link']).'"  rel="nofollow" class="fa fa-flickr" target="_blank"></a></li>' : ''; ?>
            <?php echo (!empty($service_finder_options['instagram-link'])) ? '<li><a href="'.esc_url($service_finder_options['instagram-link']).'"  rel="nofollow" class="fa fa-instagram" target="_blank"></a></li>' : ''; ?>
          </ul>
        </div>
      </div>
    </div>
    <div class="curve-box"></div>
  </div>
  <?php endif; ?>
  <?php if(is_home() || is_front_page()){ ?>
<?php 
$headertemplates = (!empty($service_finder_options['header-templates'])) ? $service_finder_options['header-templates'] : ''; 
$topbar = (!empty($service_finder_options['top-bar'])) ? $service_finder_options['top-bar'] : ''; 
?>

  <?php if(($headertemplates == 'classic' && $topbar) || !class_exists( 'ReduxFrameworkPlugin' )){ ?>
  <!-- Classic header style start -->
  <div class="main-bar clearfix">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Classic header style end -->
  <?php }elseif($headertemplates == 'center-mode' && $topbar){ ?>
  <!-- Center mode header style start -->
  <div class="main-bar">
    <div class="container">
      <div class="logo-header center-block"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <div class="nav-outer center-block">
        <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
        <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
        </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
  
        <nav class="header-nav navbar-collapse collapse">
          <?php 
			if (has_nav_menu($service_finder_MenuLocation)) {
			wp_nav_menu( $menuArgs);
			}
			?>
        </nav>
      </div>
    </div>
  </div>
  <!-- Center mode header style end -->
  <?php }elseif($headertemplates == 'transperent' && $topbar){ ?>
  <!-- Transparent header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Transparent header style end -->
  <?php }elseif($headertemplates == 'overlay-white' && $topbar){ ?>
  <!-- Overlay header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Overlay header style end -->
  <?php }elseif($headertemplates == 'overlay-black' && $topbar){ ?>
  <!-- Overlay black header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Overlay black header style end -->
  <?php }elseif($headertemplates == 'no-top-bar' || !$topbar){ ?>
  <!-- No top bar header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
     <?php if(class_exists('service_finder_booking_plugin')) { ?>
	 <?php if(!is_user_logged_in()){ ?>	 
      <div class="extra-nav"> 
      <?php if($loginsignuppopup){ ?>
      <div class="extra-cell">
      <a href="javascript:void(0);" class="btn btn-border btn-sm" data-redirect="yes" data-action="login" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-user"></i>
        <?php esc_html_e('Login', 'service-finder'); ?>
        </a></div>
      <div class="extra-cell"> <a href="javascript:void(0);" class="btn btn-border btn-sm"  data-toggle="modal" data-action="signup" data-target="#login-Modal"><i class="fa fa-plus"></i>
        <?php esc_html_e('Sign up', 'service-finder'); ?>
        </a> </div>
      <?php } ?>  
        
		<?php if(is_author()){ ?>
        <?php
        if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
		?>
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
		<?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
        <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
        <?php } ?>
        </div>
        <?php } ?> 
        <?php 
		}
		}
		?>
        <?php } ?>
        
        </div>
        <?php }else{
		?>
		<div class="extra-nav">
        <?php echo do_shortcode( '[service_finder_notification_notopbar]');//For No Top Bar Home Page ?>
            <?php if(is_user_logged_in()){
						  $fullname = get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
						  if($fullname == ' ' || $fullname == ''){
						  $fullname = ucfirst($current_user->display_name);
						  }
						  if ( function_exists( 'service_finder_UserRole' ) ) {
						  if(service_finder_UserRole($current_user->ID) == 'administrator'){
							$accounturl = admin_url( 'profile.php' );
						  }else{
						  	if ( function_exists( 'service_finder_get_url_by_shortcode' ) ) {
						  	$accounturl = service_finder_get_url_by_shortcode('[service_finder_my_account]');
							}else{
							$accounturl = service_finder_get_url_by_shortcodefortheme('[service_finder_my_account]');
							}
						  }
						  }
						  ?>
             
              <?php 
						if ( function_exists( 'service_finder_UserRole' ) ) {
						if(service_finder_UserRole($current_user->ID) == 'Customer'){ 
						echo '<div class="extra-cell fs-customer-status2"><a href="'.esc_url($accounturl).'" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle btn btn-border btn-sm" aria-expanded="false"><i class="fa fa-user"></i> '.$fullname.' <b class="caret"></b></a>';
						$myaccount = $accounturl;
						if(get_option('permalink_structure')){
						$myaccount = $myaccount.'?';
						}else{
						$myaccount = $myaccount.'&';
						}
						?>
              <ul class="dropdown-menu arrow-up">
                <li><a href="<?php echo esc_url($myaccount.'action=my-profile') ?>"><i class="fa fa-user"></i>
                  <?php esc_html_e('My Profile', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=bookings') ?>"><i class="fa fa-hand-o-up"></i>
                  <?php esc_html_e('Bookings', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=schedule') ?>"><i class="fa fa-clock-o"></i>
                  <?php esc_html_e('Schedule', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=invoice') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Invoice', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=my-favorites') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Favorites', 'service-finder'); ?>
                  </a></li>
                <?php if(class_exists( 'WP_Job_Manager' )):?>
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[submit_job_form')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Post a Job', 'service-finder'); ?>
                  </a></li>  
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[job_dashboard')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php endif; ?>  
              </ul>
              </div>
              <?php }else{
						   echo '<div class="extra-cell"><a href="'.esc_url($accounturl).'" class="btn btn-border btn-sm"><i class="fa fa-user"></i>'.$fullname.'</a></div>';
						   } 
						   }
						   ?>
            
            <div class="extra-cell"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="btn btn-border btn-sm">
              <i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'service-finder'); ?>
              </a></div>
              <?php if(is_author()){ ?>
              <?php
			if(!empty($userCap)){
			if(in_array('bookings',$userCap)){
			?>
            <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
            <div class="extra-cell">
            <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
            </div>  
            <?php } ?>
            <?php } ?>
            <?php 
}
}
?>
			<?php
						  }?>
          </div>
		<?php
		} ?>    
      <?php } ?>  
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- No top bar header style end -->
  <?php }elseif($headertemplates == 'transperent-no-top-bar'){ ?>
  <!-- No top bar header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
     <?php if(class_exists('service_finder_booking_plugin')) { ?>
	 <?php if(!is_user_logged_in()){ ?>	 
      <div class="extra-nav"> 
      <?php if($loginsignuppopup){ ?>
      <div class="extra-cell">
      <a href="javascript:void(0);" class="btn btn-border btn-sm" data-redirect="yes" data-action="login" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-user"></i>
        <?php esc_html_e('Login', 'service-finder'); ?>
        </a></div>
      <div class="extra-cell"> <a href="javascript:void(0);" class="btn btn-border btn-sm"  data-toggle="modal" data-action="signup" data-target="#login-Modal"><i class="fa fa-plus"></i>
        <?php esc_html_e('Sign up', 'service-finder'); ?>
        </a> </div>
      <?php } ?>  
        <?php if(is_author()){ ?>
        <?php
		if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
		?>
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
		<?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
        <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
        <?php } ?>
        </div>
        <?php } ?> 
        <?php 
		}
		}
		?>
        <?php } ?>
        </div>
        <?php }else{
		?>
		<div class="extra-nav">
        <?php echo do_shortcode( '[service_finder_notification_notopbar]');//For No Top Bar Home Page ?>
            <?php if(is_user_logged_in()){
						  $fullname = get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
						  if($fullname == ' ' || $fullname == ''){
						  $fullname = ucfirst($current_user->display_name);
						  }
						  if ( function_exists( 'service_finder_UserRole' ) ) {
						  if(service_finder_UserRole($current_user->ID) == 'administrator'){
							$accounturl = admin_url( 'profile.php' );
						  }else{
						  	if ( function_exists( 'service_finder_get_url_by_shortcode' ) ) {
						  	$accounturl = service_finder_get_url_by_shortcode('[service_finder_my_account]');
							}else{
							$accounturl = service_finder_get_url_by_shortcodefortheme('[service_finder_my_account]');
							}
						  }
						  }
						  ?>
             
              <?php 
						if ( function_exists( 'service_finder_UserRole' ) ) {
						if(service_finder_UserRole($current_user->ID) == 'Customer'){ 
						echo '<div class="extra-cell fs-customer-status2"><a href="'.esc_url($accounturl).'" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle btn btn-border btn-sm" aria-expanded="false"><i class="fa fa-user"></i> '.$fullname.' <b class="caret"></b></a>';
						$myaccount = $accounturl;
						if(get_option('permalink_structure')){
						$myaccount = $myaccount.'?';
						}else{
						$myaccount = $myaccount.'&';
						}
						?>
              <ul class="dropdown-menu arrow-up">
                <li><a href="<?php echo esc_url($myaccount.'action=my-profile') ?>"><i class="fa fa-user"></i>
                  <?php esc_html_e('My Profile', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=bookings') ?>"><i class="fa fa-hand-o-up"></i>
                  <?php esc_html_e('Bookings', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=schedule') ?>"><i class="fa fa-clock-o"></i>
                  <?php esc_html_e('Schedule', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=invoice') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Invoice', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=my-favorites') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Favorites', 'service-finder'); ?>
                  </a></li>
                <?php if(class_exists( 'WP_Job_Manager' )):?>
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[submit_job_form')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Post a Job', 'service-finder'); ?>
                  </a></li>  
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[job_dashboard')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php endif; ?>  
              </ul>
              </div>
              <?php }else{
						   echo '<div class="extra-cell"><a href="'.esc_url($accounturl).'" class="btn btn-border btn-sm"><i class="fa fa-user"></i>'.$fullname.'</a></div>';
						   } 
						   }
						   ?>
            
            <div class="extra-cell"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="btn btn-border btn-sm">
              <i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'service-finder'); ?>
              </a></div>
              <?php if(is_author()){ ?>
              <?php
			if(!empty($userCap)){
			if(in_array('bookings',$userCap)){
			?>
            <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
            <div class="extra-cell">
            <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
            </div>  
            <?php } ?>
            <?php } ?>
            <?php 
			}
			}
			?>
            <?php
						  }?>
          </div>
		<?php
		} ?>    
      <?php } ?>  
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- No top bar header style end -->
  <?php } ?>
  <?php }else{
  if((($headertemplates == 'classic' || $headertemplates == 'transperent' || $headertemplates == 'overlay-white' || $headertemplates == 'overlay-black') && $headertemplates) || !class_exists( 'ReduxFrameworkPlugin' )){
  ?>
  <!-- Classic header style start -->
  <div class="main-bar clearfix">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <?php 
						  if(is_author()){
						  if(!empty($userCap)){
						  if(in_array('bookings',$userCap)){
						  $booking_process = (!empty($settings['booking_process'])) ? $settings['booking_process'] : '';
						  if($booking_process == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){
						  ?>
	<?php if(!($headertemplates == 'no-top-bar' || !$topbar)){?>	                          
      <div class="extra-nav">
      <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
          <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
          </div>
      </div>
      <?php 
	  }
	  }
						   }
						   }
						   }
						   }
						   ?>
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Classic header style end -->
  <?php 
  }elseif($headertemplates == 'center-mode' && $topbar){ ?>
  <!-- Center mode header style start -->
  <div class="main-bar clearfix">
    <div class="container">
      <div class="logo-header center-block"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <div class="main-bar-inr">
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <?php 
						  if(is_author()){
						  if(!empty($userCap)){
						  if(in_array('bookings',$userCap)){
						  $booking_process = (!empty($settings['booking_process'])) ? $settings['booking_process'] : '';
						  if($booking_process == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){
						  ?>
	<?php if(!($headertemplates == 'no-top-bar' || !$topbar)){?>	                          
      <div class="extra-nav">
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
          <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
          </div>
        <?php } ?>  
      </div>
      <?php 
	  }
						   }
						   }
						   }
						   }
						   ?>
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
      </div>
    </div>
  </div>
  <!-- Center mode header style end -->
  <?php }elseif($headertemplates == 'no-top-bar' || !$topbar){ ?>
  <!-- No top bar header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <?php 
						  if(is_author()){
						  if(!empty($userCap)){
						  if(in_array('bookings',$userCap)){
						  $booking_process = (!empty($settings['booking_process'])) ? $settings['booking_process'] : '';
						  if($booking_process == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){
						  ?>
		<?php if(!($headertemplates == 'no-top-bar' || !$topbar)){?>	               
      <div class="extra-nav">
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
            <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
            
          </div>
        <?php } ?>  
      </div>
      <?php 
	  }
						   }
						   }
						   }
						   }
						   ?>
      <?php if(class_exists('service_finder_booking_plugin')) { ?>
	  <?php if(!is_user_logged_in()){ ?>	 
      <div class="extra-nav"> 
        <?php if($loginsignuppopup){ ?>
        <div class="extra-cell"><a href="javascript:void(0);" class="btn btn-border btn-sm" data-redirect="yes" data-action="login" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-user"></i>
        <?php esc_html_e('Login', 'service-finder'); ?>
        </a> </div>
        <div class="extra-cell">
        <a href="javascript:void(0);" class="btn btn-border btn-sm"  data-toggle="modal" data-action="signup" data-target="#login-Modal"><i class="fa fa-plus"></i>
        <?php esc_html_e('Sign up', 'service-finder'); ?>
        </a> </div>
        <?php } ?>
        <?php if(is_author()){ 
		if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
		?>
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
        <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
        </div>  
        <?php } ?>
        <?php 
		}
		}
		} ?>
        </div>
        <?php }else{
		?>
		<div class="extra-nav">
        <?php echo do_shortcode( '[service_finder_notification_notopbar]');//For No Top Bar Inner Page ?>
            <?php if(is_user_logged_in()){
						  $fullname = get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
						  if($fullname == ' ' || $fullname == ''){
						  $fullname = ucfirst($current_user->display_name);
						  }
						  if ( function_exists( 'service_finder_UserRole' ) ) {
						  if(service_finder_UserRole($current_user->ID) == 'administrator'){
							$accounturl = admin_url( 'profile.php' );
						  }else{
						  	if ( function_exists( 'service_finder_get_url_by_shortcode' ) ) {
						  	$accounturl = service_finder_get_url_by_shortcode('[service_finder_my_account]');
							}else{
							$accounturl = service_finder_get_url_by_shortcodefortheme('[service_finder_my_account]');
							}
						  }
						  }
						  ?>
             
              <?php 
						if ( function_exists( 'service_finder_UserRole' ) ) {
						if(service_finder_UserRole($current_user->ID) == 'Customer'){ 
						echo '<div class="extra-cell fs-customer-status2"><a href="'.esc_url($accounturl).'" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle btn btn-border btn-sm" aria-expanded="false"><i class="fa fa-user"></i> '.$fullname.' <b class="caret"></b></a>';
						$myaccount = $accounturl;
						if(get_option('permalink_structure')){
						$myaccount = $myaccount.'?';
						}else{
						$myaccount = $myaccount.'&';
						}
						?>
              <ul class="dropdown-menu arrow-up">
                <li><a href="<?php echo esc_url($myaccount.'action=my-profile') ?>"><i class="fa fa-user"></i>
                  <?php esc_html_e('My Profile', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=bookings') ?>"><i class="fa fa-hand-o-up"></i>
                  <?php esc_html_e('Bookings', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=schedule') ?>"><i class="fa fa-clock-o"></i>
                  <?php esc_html_e('Schedule', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=invoice') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Invoice', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=my-favorites') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Favorites', 'service-finder'); ?>
                  </a></li>
                <?php if(class_exists( 'WP_Job_Manager' )):?>
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[submit_job_form')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Post a Job', 'service-finder'); ?>
                  </a></li>  
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[job_dashboard')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php endif; ?>  
              </ul>
              </div>
              <?php }else{
						   echo '<div class="extra-cell"><a href="'.esc_url($accounturl).'" class="btn btn-border btn-sm"><i class="fa fa-user"></i>'.$fullname.'</a></div>';
						   } 
						   }
						   ?>
            
            <div class="extra-cell"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="btn btn-border btn-sm">
              <i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'service-finder'); ?>
              </a></div>
              
              <?php if(is_author()){
			  if(!empty($userCap)){
			  if(in_array('bookings',$userCap)){
			   ?>
              <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
              <div class="extra-cell">
              <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
              </div>  
              <?php } ?>
              <?php 
			  }
			  }
			  } ?>
            <?php
						  }?>
          </div>
		<?php
		} ?>	 
      <?php } ?>  
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- No top bar header style end -->
  <?php }elseif($headertemplates == 'transperent-no-top-bar'){ ?>
  <!-- No top bar header style start -->
  <div class="main-bar clearfix ">
    <div class="container">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggle collapsed"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <?php 
						  if(is_author()){
						  if(!empty($userCap)){
						  if(in_array('bookings',$userCap)){
						  $booking_process = (!empty($settings['booking_process'])) ? $settings['booking_process'] : '';
						  if($booking_process == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){
						  ?>
		<?php if($headertemplates != 'transperent-no-top-bar'){?>	               
      <div class="extra-nav">
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
            <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
            
          </div>
        <?php } ?>  
      </div>
      <?php 
	  }
						   }
						   }
						   }
						   }
						   ?>
      <?php if(class_exists('service_finder_booking_plugin')) { ?>
	  <?php if(!is_user_logged_in()){ ?>	 
      <div class="extra-nav"> 
        <?php if($loginsignuppopup){ ?>
        <div class="extra-cell"><a href="javascript:void(0);" class="btn btn-border btn-sm" data-redirect="yes" data-action="login" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-user"></i>
        <?php esc_html_e('Login', 'service-finder'); ?>
        </a> </div>
        <div class="extra-cell">
        <a href="javascript:void(0);" class="btn btn-border btn-sm"  data-toggle="modal" data-action="signup" data-target="#login-Modal"><i class="fa fa-plus"></i>
        <?php esc_html_e('Sign up', 'service-finder'); ?>
        </a> </div>
        <?php } ?>
        <?php if(is_author()){
		if(!empty($userCap)){
		if(in_array('bookings',$userCap)){
		 ?>
        <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
        <div class="extra-cell">
        <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
        </div>  
        <?php } ?>
        <?php 
		}
		}
		} ?>
        </div>
        <?php }else{
		?>
		<div class="extra-nav">
        <?php echo do_shortcode( '[service_finder_notification_notopbar]');//For No Top Bar Inner Page ?>
            <?php if(is_user_logged_in()){
						  $fullname = get_user_meta($current_user->ID,'first_name',true).' '.get_user_meta($current_user->ID,'last_name',true);
						  if($fullname == ' ' || $fullname == ''){
						  $fullname = ucfirst($current_user->display_name);
						  }
						  if ( function_exists( 'service_finder_UserRole' ) ) {
						  if(service_finder_UserRole($current_user->ID) == 'administrator'){
							$accounturl = admin_url( 'profile.php' );
						  }else{
						  	if ( function_exists( 'service_finder_get_url_by_shortcode' ) ) {
						  	$accounturl = service_finder_get_url_by_shortcode('[service_finder_my_account]');
							}else{
							$accounturl = service_finder_get_url_by_shortcodefortheme('[service_finder_my_account]');
							}
						  }
						  }
						  ?>
             
              <?php 
						if ( function_exists( 'service_finder_UserRole' ) ) {
						if(service_finder_UserRole($current_user->ID) == 'Customer'){ 
						echo '<div class="extra-cell fs-customer-status2"><a href="'.esc_url($accounturl).'" data-delay="1000" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle btn btn-border btn-sm" aria-expanded="false"><i class="fa fa-user"></i> '.$fullname.' <b class="caret"></b></a>';
						$myaccount = $accounturl;
						if(get_option('permalink_structure')){
						$myaccount = $myaccount.'?';
						}else{
						$myaccount = $myaccount.'&';
						}
						?>
              <ul class="dropdown-menu arrow-up">
                <li><a href="<?php echo esc_url($myaccount.'action=my-profile') ?>"><i class="fa fa-user"></i>
                  <?php esc_html_e('My Profile', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=bookings') ?>"><i class="fa fa-hand-o-up"></i>
                  <?php esc_html_e('Bookings', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=schedule') ?>"><i class="fa fa-clock-o"></i>
                  <?php esc_html_e('Schedule', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=invoice') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Invoice', 'service-finder'); ?>
                  </a></li>
                <li><a href="<?php echo esc_url($myaccount.'action=my-favorites') ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Favorites', 'service-finder'); ?>
                  </a></li>
                <?php if(class_exists( 'WP_Job_Manager' )):?>
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[submit_job_form')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('Post a Job', 'service-finder'); ?>
                  </a></li>  
                <li><a href="<?php echo esc_url(service_finder_get_url_by_shortcodefortheme('[job_dashboard')) ?>"><i class="fa fa-file-text-o"></i>
                  <?php esc_html_e('My Jobs', 'service-finder'); ?>
                  </a></li>  
                <?php endif; ?>  
              </ul>
              </div>
              <?php }else{
						   echo '<div class="extra-cell"><a href="'.esc_url($accounturl).'" class="btn btn-border btn-sm"><i class="fa fa-user"></i>'.$fullname.'</a></div>';
						   } 
						   }
						   ?>
            
            <div class="extra-cell"><a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>" class="btn btn-border btn-sm">
              <i class="fa fa-sign-out"></i> <?php esc_html_e('Logout', 'service-finder'); ?>
              </a></div>
              
              <?php if(is_author()){ 
			  if(!empty($userCap)){
			  if(in_array('bookings',$userCap)){
			  ?>
              <?php if($settings['booking_process'] == 'on' && (!is_user_logged_in() || service_finder_getUserRole($current_user->ID) == 'Customer' || service_finder_getUserRole($current_user->ID) == 'administrator' || (service_finder_getUserRole($current_user->ID) == 'Provider' && $current_user->ID == $author) )){ ?>
              <div class="extra-cell">
              <?php if((!is_user_logged_in() && !$service_finder_options['guest-booking'])){ ?>
            <button class="btn btn-primary" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><?php esc_html_e('Book now','service-finder')?></button>
          <?php }else{ ?>  
	        <button class="btn btn-primary sf-booknow-btn"><?php esc_html_e('Book now','service-finder')?></button>
          <?php } ?>
              </div>  
              <?php } ?>
              <?php 
			  }
			  }
			  }
			  ?>
            <?php
						  }?>
          </div>
		<?php
		} ?>	 
      <?php } ?>  
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- No top bar header style end -->
  <?php }
  } ?>
</header>
<?php
}

//Header layout for search style 2
function service_finder_header_layout_searchmapstyle($author){
global $service_finder_globals, $service_finder_ThemeParams;
$service_finder_options = $service_finder_globals;
$loginsignuppopup = (!empty($service_finder_options['login-signup-popup'])) ? $service_finder_options['login-signup-popup'] : '';
if(is_author()){
if ( function_exists( 'service_finder_getProviderSettings' ) ){
$settings = service_finder_getProviderSettings($author);
}
}

$service_finder_MenuLocation = 'primary';

$headertemplates = (!empty($service_finder_options['header-templates'])) ? $service_finder_options['header-templates'] : ''; 
$topbar = (!empty($service_finder_options['top-bar'])) ? $service_finder_options['top-bar'] : ''; 

$menuArgs = array(

		'theme_location'  => $service_finder_MenuLocation,
		
		'menu_class'      => 'nav navbar-nav',
		
		'menu_id'       => 'primary-menu',
		
		'container'       => '',
		
		);
	
$current_user = wp_get_current_user(); 


            if(is_home() || is_front_page()){
				if(class_exists( 'ReduxFrameworkPlugin' )) {
					if($headertemplates == 'classic' && $topbar){
							$class = 'header-style1'; 
					}elseif($headertemplates == 'center-mode' && $topbar){
							$class = 'header-style2'; 
					}elseif($headertemplates == 'transperent' && $topbar){
							$class = 'header-style3 transparent-bg'; 
					}elseif($headertemplates == 'overlay-white' && $topbar){
							$class = 'header-style4 overlay-bg-white'; 
					}elseif($headertemplates == 'overlay-black' && $topbar){
							$class = 'header-style5 overlay-bg-black'; 
					}elseif($headertemplates == 'no-top-bar' || !$topbar){
							$class = 'header-style6'; 
					}
				}else{
					$class = 'header-style1';
				}
				
			}else{
				if(class_exists( 'ReduxFrameworkPlugin' )) {				
					if(($headertemplates == 'classic' || $headertemplates == 'center-mode' || $headertemplates == 'transperent' || $headertemplates == 'overlay-white' || $headertemplates == 'overlay-black') && $topbar){
								$class = 'header-style1';
					}elseif($headertemplates == 'no-top-bar' || !$topbar){
								$class = 'header-style6';
					}
				}else{
					$class = 'header-style1';
				}	
				
			}
			?>
			<header id="header-part" class=" fix-map-header" >
  <!-- Map page header style start -->
  <div class="main-bar clearfix">
    <div class="container-fluid">
      <div class="logo-header mostion"><a href="<?php echo esc_url($service_finder_ThemeParams['homeUrl']); ?>"><?php if(!empty($service_finder_options['site-logo']['url'])){ ?> <img src="<?php echo esc_url($service_finder_options['site-logo']['url']); ?>" alt="<?php echo esc_attr(get_bloginfo('name')) ?>" title="<?php echo esc_attr(get_bloginfo('name')) ?>"> <?php }else{ echo get_bloginfo('name'); }?></a></div>
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".header-nav"> <span class="sr-only">
      <?php esc_html_e('Toggle navigation', 'service-finder'); ?>
      </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <?php if(class_exists('service_finder_booking_plugin')) { ?>
	  <?php if(!is_user_logged_in()){ ?>
      <?php if($loginsignuppopup){ ?>
      <div class="extra-nav">
        <div class="extra-cell">
           <a href="javascript:void(0);" class="btn btn-border btn-sm" data-redirect="yes" data-action="login" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-user"></i>
            <?php esc_html_e('Login', 'service-finder'); ?>
            </a> </div>
        <div class="extra-cell"> <a href="javascript:void(0);" class="btn btn-border btn-sm"  data-toggle="modal" data-action="signup" data-target="#login-Modal"><i class="fa fa-plus"></i>
            <?php esc_html_e('Sign up', 'service-finder'); ?>
            </a> </div>
      </div>
      <?php } ?>
      <?php } ?>
      <?php } ?>
      <div class="header-nav navbar-collapse collapse">
        <?php 
		if (has_nav_menu($service_finder_MenuLocation)) {
		wp_nav_menu( $menuArgs);
		}
		?>
      </div>
    </div>
  </div>
  <!-- Map page header style end -->
</header>
<?php
}

//Favicon
function service_finder_fav_icon(){
if (!function_exists('has_site_icon') || !has_site_icon()) {//Backward-compatible favicons/icons
global $service_finder_globals;
$service_finder_options = $service_finder_globals;
?>
<link rel="shortcut icon" href="<?php echo (!empty($service_finder_options['favicon-icon']['url'])) ? esc_url($service_finder_options['favicon-icon']['url']) : ''; ?>" />
<?php
}
}

//Header Banner
function service_finder_header_banner(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

wp_add_inline_script( 'service_finder-js-custom', 'jQuery("body").on("change", "#country", function(){
                    var country = jQuery(this).val();

					var data = {
						  "action": "load_cities",
						  "country": country
						};
						
				  var formdata = jQuery.param(data);
				  
				  jQuery.ajax({
			
									type: "POST",
			
									url: ajaxurl,
			
									data: formdata,
									
									dataType: "json",
									
									success:function (data, textStatus) {
										if(data["status"] == "success"){
											
											jQuery("select[name=\'city\']").html(data["html"]);
											jQuery("select[name=\'city\']").selectpicker("refresh");
										}
									
									}
			
								});
					

                });', 'after' );
$bgcolor = (!empty($service_finder_options['banner-bg-color'])) ? $service_finder_options['banner-bg-color'] : '';
$bgopacity = (!empty($service_finder_options['banner-opacity'])) ? $service_finder_options['banner-opacity'] : '';
?>

<section class="sf-banner-row">
<?php if(!empty($service_finder_options['header-bg-image']['url'])){ ?>
  <div class="sf-banner-outer sf-overlay-wrapper">
    <div class="sf-bnr-pic"> 
    <div class="sf-overlay-main" style="opacity:<?php echo $bgopacity ?>; background-color:<?php echo $bgcolor ?>;"></div>
    <img src="<?php echo (!empty($service_finder_options['header-bg-image']['url'])) ? esc_url($service_finder_options['header-bg-image']['url']) : '' ?>" width="1919" height="910" alt=""> 
    </div>
    <div class="sf-bnr-text text-center">
      <div class="container"> <strong class="text-uppercase">
        <?php echo (!empty($service_finder_options['banner-heading'])) ? esc_html($service_finder_options['banner-heading'],'sevice-finder') : ''; ?>
        </strong> <span>
        <?php echo (!empty($service_finder_options['banner-subheading'])) ? esc_html($service_finder_options['banner-subheading'],'sevice-finder') : ''; ?>
        </span> </div>
    </div>
  </div>
 <?php } ?> 
  <!--Search form-->
  <?php if(!$service_finder_options['home-search-bar']){ 
   $srhposition = (!empty($service_finder_options['search-bar-position'])) ? $service_finder_options['search-bar-position'] : 'bottom';
   if($srhposition == 'middle'){
   	$positionclass = 'pos-v-center';
   }else{
   	$positionclass = 'pos-v-bottom';
   }
   $classes = (service_finder_themestyle_fortheme() == 'style-2') ? 'sf-search-result' : '';
  ?>
  <div class="sf-find-bar <?php echo sanitize_html_class($classes); ?> <?php echo sanitize_html_class($positionclass); ?>">
    <div class="container">
      <?php if(service_finder_themestyle_fortheme() == 'style-2'){ ?>
      <ul class="sf-search-title clearfix">
            <li><?php echo esc_html__('Search Provider', 'service-finder'); ?></li>
        </ul>
       <?php } ?> 
      <div class="search-form">
        <?php echo do_shortcode('[service_finder_search_form]'); ?>
      </div>
    </div>
  </div>
  <?php } ?>
</section>
<?php
}

//Header style
function service_finder_header_style(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$headerstyle = (!empty($service_finder_options['header-style'])) ? $service_finder_options['header-style'] : '';
return $headerstyle;
}

//Sub header
function service_finder_sub_header(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$subheader = (!empty($service_finder_options['sub-header'])) ? $service_finder_options['sub-header'] : '';
return $subheader;
}

//Contact us banner image
function service_finder_contactus_banner(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$bannerimg = (!empty($service_finder_options['contact-sub-header-bg-image']['url'])) ? $service_finder_options['contact-sub-header-bg-image']['url'] : ''; 
return $bannerimg;
}

//Inner page banner image
function service_finder_innerpage_banner(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$bannerimg = (!empty($service_finder_options['inner-sub-header-bg-image']['url'])) ? $service_finder_options['inner-sub-header-bg-image']['url'] : '';
return $bannerimg;
}

//Breadcrumb
function service_finder_breadcrumb(){
global $service_finder_globals;
$service_finder_options = $service_finder_globals;

$breadcrumbs = (!empty($service_finder_options['breadcrumbs'])) ? $service_finder_options['breadcrumbs'] : '';
return $breadcrumbs;
}

/*Load Markers for Home Page*/	
add_action( 'wp_ajax_load-markers', 'service_finder_load_markers' );
add_action( 'wp_ajax_nopriv_load-markers', 'service_finder_load_markers' );

function service_finder_load_markers() {
   
   global $service_finder_ThemeParams, $wpdb, $service_finder_options;

   $getProviders = new SERVICE_FINDER_searchProviders();
	
   $providersInfoArr = $getProviders->service_finder_getProvidersMarkers(esc_attr($_POST['allproviers']),esc_attr($_POST['address']),esc_attr($_POST['city']),esc_attr($_POST['catid']),esc_attr($_POST['country']));
   
   $providersInfo = $providersInfoArr['srhResult'];
   $count = $providersInfoArr['count'];
	
	$markers = '';
	if(!empty($providersInfo)){ 
	foreach($providersInfo as $provider){

	$userLink = get_author_posts_url($provider->wp_user_id);

	if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
		$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-provider-thumb' );
		$src  = $src[0];
	}else{
		$src  = '';
	}
	
	$catid = get_user_meta($provider->wp_user_id,'primary_category',true);
	
	
	$icon = service_finder_getCategoryIcon($catid);
	if($icon == ""){
	$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
	}
	
	$markeraddress = service_finder_getAddress($provider->wp_user_id);
	
	$companyname = service_finder_getCompanyName($provider->wp_user_id);
	$companyname = str_replace(array("\n", "\r"), ' ', $companyname);
	$companyname = preg_replace('/\t+/', '', $companyname);
	
	$full_name = str_replace(array("\n", "\r"), ' ', $provider->full_name);
	$full_name = preg_replace('/\t+/', '', $full_name);
	
	$markeraddress = str_replace(array("\n", "\r"), ' ', $markeraddress);
	$markeraddress = str_replace('\t', '', $markeraddress);
	
	$categorycolor = service_finder_getCategoryColor(get_user_meta($provider->wp_user_id,'primary_category',true));
	
	//Create Markers
	$markers .= '["'.stripcslashes($full_name).'","'.$provider->lat.'","'.$provider->long.'","'.$src.'","'.$icon.'","'.$userLink.'","'.$provider->wp_user_id.'","'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'","'.stripcslashes($markeraddress).'","'.stripcslashes($companyname).'","'.$categorycolor.'"],';
	
     }
	 	if($_POST['city'] == 'New York'){
			$newcity = $_POST['city'].', NY';
		}else{
			$newcity = $_POST['city'];
		}
		
		if($_POST['address'] != ""){
			$address = str_replace(" ","+",$_POST['address']);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] != "" && $_POST['country'] != ""){
			$address = str_replace(" ","+",$newcity).'+'.str_replace(" ","+",$_POST['country']);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] == "" && $_POST['country'] != ""){
			$address = str_replace(" ","+",$_POST['country']);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] != "" && $_POST['country'] == ""){
			$defaultcountry = (!empty($service_finder_options['default-country'])) ? $service_finder_options['default-country'] : '';
			if($defaultcountry != ""){
			$address = str_replace(" ","+",$newcity).'+'.str_replace(" ","+",$defaultcountry);
			}else{
			$address = str_replace(" ","+",$newcity);
			}
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}
			
		

	}else{
		if($_POST['city'] == 'New York'){
			$newcity = $_POST['city'].', NY';
		}else{
			$newcity = $_POST['city'];
		}
	
		if($_POST['address'] != ""){
			$address = str_replace(" ","+",$_POST['address']);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] != ""){
			$address = str_replace(" ","+",$newcity);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] == "" && $_POST['country'] != ""){
			$address = str_replace(" ","+",$_POST['country']);
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}elseif($_POST['address'] == "" && $_POST['city'] != "" && $_POST['country'] == ""){
			
			$defaultcountry = (!empty($service_finder_options['default-country'])) ? $service_finder_options['default-country'] : '';
			if($defaultcountry != ""){
			$address = str_replace(" ","+",$newcity).'+'.str_replace(" ","+",$defaultcountry);
			}else{
			$address = str_replace(" ","+",$newcity);
			}
			$res = service_finder_getLatLong($address);
			$lat = $res['lat'];
			$lng = $res['lng'];
		}
	
	}
	
		$markers = rtrim($markers,',');
		$markers = '[ '.$markers.' ]';
		
		$lat = (isset($lat)) ? $lat : '';
		$lng = (isset($lng)) ? $lng : '';
		
		$resarr = array(
					'catid' => $_POST['catid'],
					'address' => $_POST['address'],
					'city' => $_POST['city'],
					'country' => $_POST['country'],
					'lat' => $lat,
					'lng' => $lng,
					'count' => $count,
					'markers' => $markers
				);
		
		echo json_encode($resarr);		
		
    exit();
}

/*Generate style.css file from styles.php for dynamic css from framework*/
function service_finder_generate_options_css($newdata) {
	global $wp_filesystem,$wpdb;
	$data = $newdata;	
	$css_dir = get_template_directory();
	ob_start();
	$blogTemplate = 'templates/'.$newdata['blog-templates'].'.php';
	$contactTemplate = 'templates/'.$newdata['contact-templates'].'.php';
	
	$table_name = $wpdb->prefix . 'postmeta';
	$contactPages = $wpdb->get_results('SELECT post_id from '.$table_name.' where `meta_key` = "_wp_page_template" and `meta_value` IN ("templates/contact-us.php","templates/contact-us-v2.php","templates/contact-us-v3.php","templates/contact-us-v4.php")');
	
	$defaultBlogPages = $wpdb->get_results('SELECT post_id from '.$table_name.' where `meta_key` = "_wp_page_template" and `meta_value` IN ("templates/blog-standard.php","templates/blog-grid-2.php","templates/blog-grid-3.php","templates/blog-left-sidebar.php","templates/blog-no-sidebar.php","templates/blog-right-sidebar.php")');
	
	$page_for_posts = get_option('page_for_posts');
	update_post_meta($page_for_posts, '_wp_page_template', $blogTemplate);
	if(!empty($contactPages)) {
		foreach($contactPages as $contactPage){
			$contactPageID = $contactPage->post_id;
			update_post_meta($contactPageID, '_wp_page_template', $contactTemplate);
		}
	}
	
	if(!empty($defaultBlogPages)) {
		foreach($defaultBlogPages as $defaultBlogPage){
			$defaultBlogPageID = $defaultBlogPage->post_id;
			update_post_meta($defaultBlogPageID, '_wp_page_template', $blogTemplate);
		}
	}
				
	require(get_template_directory() . '/styles.php'); // Generate CSS

	$css = ob_get_clean(); // Get generated CSS (output buffering)
	WP_Filesystem();
	$wp_filesystem->put_contents(get_template_directory() . '/style.css', $css, FS_CHMOD_FILE); // Save it
	
}

//Save Post Hook
function service_finder_update_page_template( $post_id, $post, $update ) {
global $service_finder_options;

if($post->page_template == 'templates/contact-us.php' || $post->page_template == 'templates/contact-us-v2.php' || $post->page_template == 'templates/contact-us-v3.php' || $post->page_template == 'templates/contact-us-v4.php'){
$tem = explode('.ph',basename($post->page_template));
$service_finder_options['contact-templates'] = $tem[0];
update_option('service_finder_options',$service_finder_options);
}

if($post->page_template == 'templates/blog-standard.php' || $post->page_template == 'templates/blog-grid-2.php' || $post->page_template == 'templates/blog-grid-3.php' || $post->page_template == 'templates/blog-left-sidebar.php' || $post->page_template == 'templates/blog-no-sidebar.php' || $post->page_template == 'templates/blog-right-sidebar.php'){
$tem = explode('.ph',basename($post->page_template));
$service_finder_options['blog-templates'] = $tem[0];
update_option('service_finder_options',$service_finder_options);
}

}
add_action( 'save_post', 'service_finder_update_page_template', 10, 3 );

/*Get Page ID By Its Slug for theme*/
function service_finder_get_id_by_slug_theme($page_slug) {
    $page = get_page_by_path($page_slug);
    if ($page) {
        return $page->ID;
    } else {
        return null;
    }
}

/*Add Custom classes for default widget*/
add_filter('dynamic_sidebar_params', 'service_finder_add_classes_to_widget'); 
function service_finder_add_classes_to_widget($params){
	$classe_to_add = '';
	switch($params[0]['widget_name']){
	case 'Search':
		$classe_to_add = 'bx-search ';
		break;
	case 'Recent Comments':
		$classe_to_add = 'bx-recent-comments ';
		break;
	case 'Recent Posts':
		$classe_to_add = 'bx-recent-post ';
		break;
	case 'Recent Posts with Thumbnail':
		$classe_to_add = 'bx-recent-post-thumbnail recent-posts-entry ';
		break;
	case 'Archives':
		$classe_to_add = 'bx-archives ';
		break;
	case 'Categories':
		$classe_to_add = 'bx-categories ';
		break;
	case 'Meta':
		$classe_to_add = 'bx-meta ';
		break;
	case 'Calendar':
		$classe_to_add = 'bx-calendar ';
		break;
	case 'Custom Menu':
		$classe_to_add = 'bx-custom-menu ';
		break;
	case 'Pages':
		$classe_to_add = 'bx-pages ';
		break;
	case 'RSS':
		$classe_to_add = 'bx-rss ';
		break;
	case 'Tag Cloud':
		$classe_to_add = 'bx-tag-cloud ';
		break;
	case 'Text':
		$classe_to_add = 'bx-text ';
		break;					
	}
    $classe_to_add = 'class="'.$classe_to_add;
    $params[0]['before_widget'] = str_replace('class="',$classe_to_add,$params[0]['before_widget']);

	
    return $params;
} 

// SERVICE_FINDER_MultiPostThumbnails Class calling
if (class_exists('SERVICE_FINDER_MultiPostThumbnails')) {
    new SERVICE_FINDER_MultiPostThumbnails(array(
        'label' => esc_html__('Banner Image', 'service-finder'),
        'id' => 'banner-image',
        'post_type' => 'page'
        )
    );
};

/*Get User Role By ID*/
function service_finder_UserRole($userid){
	$user = new WP_User( $userid );
	return (!empty($user->roles[0])) ? $user->roles[0] : '';
}

/*Get page url by shortcode call withing that page*/
function service_finder_get_url_by_shortcodefortheme($shortcode) {
	global $wpdb;

	$url = '';

	$sql = 'SELECT ID FROM '.$wpdb->posts.' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';

	if ($id = $wpdb->get_var($sql)) {
		$url = get_permalink($id);
	}

	return $url;
}

/*Get page id by shortcode call withing that page*/
function service_finder_get_id_by_shortcodefortheme($shortcode) {
	global $wpdb;

	$url = '';
	$pageids = array();
	$sql = 'SELECT ID FROM ' . $wpdb->posts . ' WHERE post_type = "page" AND post_status="publish" AND post_content LIKE "%'.$shortcode.'%"';
	
	if ($results = $wpdb->get_results($sql)) {
		foreach($results as $res){
			$pageids[] = $res->ID;
		}
	}
	return $pageids;
	
}

/*Add inline css for admin TGM Plugin*/
function service_finder_custom_inline_css() {
	   echo '<style type="text/css">
		   .update-nag{display:block;clear:both;}
		 </style>';
}
add_action('admin_head', 'service_finder_custom_inline_css');

/*Get Lat Long By Address*/
function service_finder_getLatLong_for_theme($address){
	global $wp_filesystem, $service_finder_options;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }
	
	$apikey = (!empty($service_finder_options['server-api-key'])) ? $service_finder_options['server-api-key'] : '';
	if($apikey != ""){			
		$geocode_stats = $wp_filesystem->get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=".$apikey."&address=".$address);
	}else{
		$geocode_stats = $wp_filesystem->get_contents("http://maps.googleapis.com/maps/api/geocode/json?address=".$address);
	}
	
	$output_deals = json_decode($geocode_stats);
	
	$latLng = (!empty($output_deals->results[0]->geometry->location)) ? $output_deals->results[0]->geometry->location : '';
	
	
	$res = array(
			'lat' => (!empty($latLng->lat)) ? $latLng->lat : '',
			'lng' => (!empty($latLng->lng)) ? $latLng->lng : '',
	);
	
	return $res;
}

function service_finder_contactmap($lat,$lng,$h,$w,$title)
{
global $service_finder_options;
$defaults = array('general_latitude'=>$lat,'general_longitude'=>$lng,'path'=>'','idx_status'=>'0','page_custom_zoom'=>'12','markers'=>'','generated_pins'=>'0');

$height = $h;

$html = '<!-- Google Map -->
<div id="gmap_wrapper"   data-post_id="661" data-cur_lat="0" data-cur_long="0"  style="height:'.$h.'"  >
	<span id="isgooglemap" data-isgooglemap="1"></span>       
   
	<div id="gmap-controls-wrapper">
		<div id="gmapzoomplus"><i class="fa fa-plus"></i></div>
		<div id="gmapzoomminus"><i class="fa fa-minus"></i></div>
		<div  id="gmap-full"><i class="fa fa-arrows-alt"></i></div>
	</div>
	<div id="googleMap"  style="height:'.$h.'">   
	</div>    
   <div class="tooltip"> click to enable zoom</div>
   <div id="gmap-loading">     
		<div class="loader-inner ball-pulse"  id="listing_loader_maps">
			<div class="double-bounce1"></div>
			<div class="double-bounce2"></div>
		</div>
   </div>
  
</div>    
<!-- END Google Map --> ';		

$imagepath = get_template_directory_uri().'/inc/images/markers';

$administrativeColor = (!empty($service_finder_options['map-color-administrative'])) ? $service_finder_options['map-color-administrative'] : '#0088ff';
$landscapeColor = (!empty($service_finder_options['map-color-landscape'])) ? $service_finder_options['map-color-landscape'] : '#ff0000';
$poiColor = (!empty($service_finder_options['map-color-poi-government'])) ? $service_finder_options['map-color-poi-government'] : '#aaaaaa';
$roadGeometryColor = (!empty($service_finder_options['map-color-road-geometry'])) ? $service_finder_options['map-color-road-geometry'] : '#f0ece9';
$roadLabelsColor = (!empty($service_finder_options['map-color-road-labels'])) ? $service_finder_options['map-color-road-labels'] : '#ccdca1';
$waterAllColor = (!empty($service_finder_options['map-color-water-all'])) ? $service_finder_options['map-color-water-all'] : '#767676';
$waterGeometryColor = (!empty($service_finder_options['map-color-water-geometry'])) ? $service_finder_options['map-color-water-geometry'] : '#ffffff';
$waterLabelsColor = (!empty($service_finder_options['map-color-water-labels'])) ? $service_finder_options['map-color-water-labels'] : '#b8cb93';

wp_add_inline_script( 'service_finder-js-theme-gmapfunctions', 'var mapfunctions_vars = {"path":"'.esc_js($imagepath).'","pin_images":"{}","geolocation_radius":"1000","adv_search":"","in_text":"","zoom_cluster":"12","user_cluster":"yes","generated_pins":"0","geo_no_pos":"The browser couldn\'t detect your position!","geo_no_brow":"Geolocation is not supported by this browser.","map_style":"[{\"featureType\":\"water\",\"stylers\":[{\"saturation\":43},{\"lightness\":-11},{\"hue\":\"'.esc_js($administrativeColor).'\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"hue\":\"'.esc_js($landscapeColor).'\"},{\"saturation\":-100},{\"lightness\":99}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"'.esc_js($poiColor).'\"},{\"lightness\":54}]},{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"'.esc_js($roadGeometryColor).'\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"'.esc_js($roadLabelsColor).'\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"color\":\"'.esc_js($waterAllColor).'\"}]},{\"featureType\":\"road\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"color\":\"'.esc_js($waterGeometryColor).'\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"'.esc_js($waterLabelsColor).'\"}]},{\"featureType\":\"poi.park\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"poi.sports_complex\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"poi.medical\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"poi.business\",\"stylers\":[{\"visibility\":\"simplified\"}]}]"};', 'before' );

return $html;	
}

//Customizer live preview css update
add_filter( 'redux/customizer/live_preview', 'service_finder_livepreview' );
function service_finder_livepreview() {
global $service_finder_globals,$wp_filesystem,$wpdb;
$data = $service_finder_globals;

	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }

	$css_dir = get_template_directory();
	ob_start();

	require(get_template_directory() . '/styles.php'); // Generate CSS

	$css = ob_get_clean(); // Get generated CSS (output buffering)
	$wp_filesystem->put_contents(get_template_directory() . '/inc/css/preview.css', $css, FS_CHMOD_FILE); // Save it

}

// Custom CSS for Redux Framework admin panel
function service_finder_custom_redux_css() {
  wp_dequeue_style( 'redux-admin-css' );
  wp_register_style(
  'service_finder-redux-admin-css',
  get_template_directory_uri().'/inc/css/redux-admin.css',
  array(),
  time(),
  'all'
  );    
   wp_enqueue_style('service_finder-redux-admin-css');
}
add_action( 'redux/page/service_finder_options/enqueue', 'service_finder_custom_redux_css' );

//Save customizer data
function service_finder_customizer_save(){
global $service_finder_globals,$wp_filesystem,$wpdb;
$data = $service_finder_globals;
	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }

	$css_dir = get_template_directory();
	ob_start();

	require(get_template_directory() . '/inc/css/preview.css'); // Generate CSS

	$css = ob_get_clean(); // Get generated CSS (output buffering)
	$wp_filesystem->put_contents(get_template_directory() . '/style.css', $css, FS_CHMOD_FILE); // Save it
}
add_action( 'customize_save_after', 'service_finder_customizer_save' );

//Reset preview css
add_filter('redux/options/service_finder_options/reset', 'service_finder_reset_preview', 10, 3);
add_filter('redux/options/service_finder_options/section/reset', 'service_finder_reset_preview', 10, 3);
if ( ! function_exists( 'service_finder_reset_preview' ) ) {
function service_finder_reset_preview( $values ) {
global $service_finder_globals,$wp_filesystem,$wpdb;
$data = $service_finder_globals;

	if ( empty( $wp_filesystem ) ) {
          require_once ABSPATH . '/wp-admin/includes/file.php';
          WP_Filesystem();
    }

	$css_dir = get_template_directory();
	ob_start();

	require(get_template_directory() . '/styles.php'); // Generate CSS

	$css = ob_get_clean(); // Get generated CSS (output buffering)
	$wp_filesystem->put_contents(get_template_directory() . '/inc/css/preview.css', $css, FS_CHMOD_FILE); // Save it
}
}

/*Get currecy code*/
if ( !function_exists( 'service_finder_currencycode' ) ){
function service_finder_currencycode(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';
return $currency;
}
}

/*Get currecy symbol*/
if ( !function_exists( 'service_finder_currencysymbol' ) ){
function service_finder_currencysymbol(){
global $service_finder_options;
$currency = (!empty($service_finder_options['currency-code'])) ? $service_finder_options['currency-code'] : 'USD';

switch ( $currency ) {
		case 'AED' :
			$currency_symbol = '';
			break;
		case 'BDT':
			$currency_symbol = '&#2547;&nbsp;';
			break;
		case 'BRL' :
			$currency_symbol = '&#82;&#36;';
			break;
		case 'BGN' :
			$currency_symbol = '&#1083;&#1074;.';
			break;
		case 'AUD' :
		case 'CAD' :
		case 'CLP' :
		case 'COP' :
		case 'MXN' :
		case 'NZD' :
		case 'HKD' :
		case 'SGD' :
		case 'USD' :
			$currency_symbol = '&#36;';
			break;
		case 'EUR' :
			$currency_symbol = '&euro;';
			break;
		case 'CNY' :
		case 'RMB' :
		case 'JPY' :
			$currency_symbol = '&yen;';
			break;
		case 'RUB' :
			$currency_symbol = '&#1088;&#1091;&#1073;.';
			break;
		case 'KRW' : $currency_symbol = '&#8361;'; break;
        	case 'PYG' : $currency_symbol = '&#8370;'; break;
		case 'TRY' : $currency_symbol = '&#8378;'; break;
		case 'NOK' : $currency_symbol = '&#107;&#114;'; break;
		case 'ZAR' : $currency_symbol = '&#82;'; break;
		case 'CZK' : $currency_symbol = '&#75;&#269;'; break;
		case 'MYR' : $currency_symbol = '&#82;&#77;'; break;
		case 'DKK' : $currency_symbol = 'kr.'; break;
		case 'HUF' : $currency_symbol = '&#70;&#116;'; break;
		case 'IDR' : $currency_symbol = 'Rp'; break;
		case 'INR' : $currency_symbol = 'Rs.'; break;
		case 'NPR' : $currency_symbol = 'Rs.'; break;
		case 'LKR' : $currency_symbol = 'Rs'; break;
		case 'ISK' : $currency_symbol = 'Kr.'; break;
		case 'ILS' : $currency_symbol = '&#8362;'; break;
		case 'PHP' : $currency_symbol = '&#8369;'; break;
		case 'PLN' : $currency_symbol = '&#122;&#322;'; break;
		case 'SEK' : $currency_symbol = '&#107;&#114;'; break;
		case 'CHF' : $currency_symbol = '&#67;&#72;&#70;'; break;
		case 'TWD' : $currency_symbol = '&#78;&#84;&#36;'; break;
		case 'THB' : $currency_symbol = '&#3647;'; break;
		case 'GBP' : $currency_symbol = '&pound;'; break;
		case 'RON' : $currency_symbol = 'lei'; break;
		case 'VND' : $currency_symbol = '&#8363;'; break;
		case 'NGN' : $currency_symbol = '&#8358;'; break;
		case 'HRK' : $currency_symbol = 'Kn'; break;
		case 'EGP' : $currency_symbol = 'EGP'; break;
		case 'DOP' : $currency_symbol = 'RD&#36;'; break;
		case 'KIP' : $currency_symbol = '&#8365;'; break;
		case 'MAD' : $currency_symbol = '&#x2e;&#x62f;&#x2e;&#x645;'; break;
		case 'XOF' : $currency_symbol = 'FCFA'; break;
		case 'MVR' : $currency_symbol = 'Rf'; break;
		case 'SAR' : $currency_symbol = 'SAR'; break;
		case 'KSH' : $currency_symbol = 'Ksh'; break;
		default    : $currency_symbol = ''; break;
	}


return $currency_symbol;
}
}


/*Scan Directory for css/js*/
if(!function_exists('service_finder_scan_dir')){
	function service_finder_scan_dir($folder) {
	  $dircontent = scandir($folder);
	  $ret='';
	  foreach($dircontent as $filename) {
	    if ($filename != '.' && $filename != '..') {
	      if (filemtime($folder.$filename) === false) return false;
	      $ret.=date("YmdHis", filemtime($folder.$filename)).$filename;
	    }
	  }
	  return md5($ret);
	}
}

/*Delete Old Cache*/
if(!function_exists('service_finder_delete_old_cache')){
	function service_finder_delete_old_cache($folder) {
	  $olddate=time()-60;
	  $dircontent = scandir($folder);
	  foreach($dircontent as $filename) {
	    if (strlen($filename)==32 && filemtime($folder.$filename) && filemtime($folder.$filename)<$olddate) unlink($folder.$filename);
	  }
	}
}

function service_finder_get_allcountries(){
	$countries = array(
    "AF" => esc_html__( 'Afghanistan', 'service-finder' ),
    "AX" => esc_html__( 'Aland Islands', 'service-finder' ),
    "AL" => esc_html__( 'Albania', 'service-finder' ),
    "DZ" => esc_html__( 'Algeria', 'service-finder' ),
    "AS" => esc_html__( 'American Samoa', 'service-finder' ),
    "AD" => esc_html__( 'Andorra', 'service-finder' ),
    "AO" => esc_html__( 'Angola', 'service-finder' ),
    "AI" => esc_html__( 'Anguilla', 'service-finder' ),
    "AQ" => esc_html__( 'Antarctica', 'service-finder' ),
    "AG" => esc_html__( 'Antigua and Barbuda', 'service-finder' ),
    "AR" => esc_html__( 'Argentina', 'service-finder' ),
    "AM" => esc_html__( 'Armenia', 'service-finder' ),
    "AW" => esc_html__( 'Aruba', 'service-finder' ),
    "AU" => esc_html__( 'Australia', 'service-finder' ),
    "AT" => esc_html__( 'Austria', 'service-finder' ),
    "AZ" => esc_html__( 'Azerbaijan', 'service-finder' ),
    "BS" => esc_html__( 'Bahamas', 'service-finder' ),
    "BH" => esc_html__( 'Bahrain', 'service-finder' ),
    "BD" => esc_html__( 'Bangladesh', 'service-finder' ),
    "BB" => esc_html__( 'Barbados', 'service-finder' ),
    "BY" => esc_html__( 'Belarus', 'service-finder' ),
    "BE" => esc_html__( 'Belgium', 'service-finder' ),
    "BZ" => esc_html__( 'Belize', 'service-finder' ),
    "BJ" => esc_html__( 'Benin', 'service-finder' ),
    "BM" => esc_html__( 'Bermuda', 'service-finder' ),
    "BT" => esc_html__( 'Bhutan', 'service-finder' ),
    "BO" => esc_html__( 'Bolivia', 'service-finder' ),
    "BA" => esc_html__( 'Bosnia and Herzegovina', 'service-finder' ),
    "BW" => esc_html__( 'Botswana', 'service-finder' ),
    "BV" => esc_html__( 'Bouvet Island', 'service-finder' ),
    "BR" => esc_html__( 'Brazil', 'service-finder' ),
    "IO" => esc_html__( 'British Indian Ocean Territory', 'service-finder' ),
    "BN" => esc_html__( 'Brunei Darussalam', 'service-finder' ),
    "BG" => esc_html__( 'Bulgaria', 'service-finder' ),
    "BF" => esc_html__( 'Burkina Faso', 'service-finder' ),
    "BI" => esc_html__( 'Burundi', 'service-finder' ),
    "KH" => esc_html__( 'Cambodia', 'service-finder' ),
    "CM" => esc_html__( 'Cameroon', 'service-finder' ),
    "CA" => esc_html__( 'Canada', 'service-finder' ),
    "CV" => esc_html__( 'Cape Verde', 'service-finder' ),
    "KY" => esc_html__( 'Cayman Islands', 'service-finder' ),
    "CF" => esc_html__( 'Central African Republic', 'service-finder' ),
    "TD" => esc_html__( 'Chad', 'service-finder' ),
    "CL" => esc_html__( 'Chile', 'service-finder' ),
    "CN" => esc_html__( 'China', 'service-finder' ),
    "CX" => esc_html__( 'Christmas Island', 'service-finder' ),
    "CC" => esc_html__( 'Cocos (Keeling) Islands', 'service-finder' ),
    "CO" => esc_html__( 'Colombia', 'service-finder' ),
    "KM" => esc_html__( 'Comoros', 'service-finder' ),
    "CG" => esc_html__( 'Congo', 'service-finder' ),
    "CD" => esc_html__( 'Congo, The Democratic Republic of The', 'service-finder' ),
    "CK" => esc_html__( 'Cook Islands', 'service-finder' ),
    "CR" => esc_html__( 'Costa Rica', 'service-finder' ),
    "CI" => esc_html__( 'Cote D\'ivoire', 'service-finder' ),
    "HR" => esc_html__( 'Croatia', 'service-finder' ),
    "CU" => esc_html__( 'Cuba', 'service-finder' ),
    "CY" => esc_html__( 'Cyprus', 'service-finder' ),
    "CZ" => esc_html__( 'Czech Republic', 'service-finder' ),
    "DK" => esc_html__( 'Denmark', 'service-finder' ),
    "DJ" => esc_html__( 'Djibouti', 'service-finder' ),
    "DM" => esc_html__( 'Dominica', 'service-finder' ),
    "DO" => esc_html__( 'Dominican Republic', 'service-finder' ),
    "EC" => esc_html__( 'Ecuador', 'service-finder' ),
    "EG" => esc_html__( 'Egypt', 'service-finder' ),
    "SV" => esc_html__( 'El Salvador', 'service-finder' ),
    "GQ" => esc_html__( 'Equatorial Guinea', 'service-finder' ),
    "ER" => esc_html__( 'Eritrea', 'service-finder' ),
    "EE" => esc_html__( 'Estonia', 'service-finder' ),
    "ET" => esc_html__( 'Ethiopia', 'service-finder' ),
    "FK" => esc_html__( 'Falkland Islands (Malvinas)', 'service-finder' ),
    "FO" => esc_html__( 'Faroe Islands', 'service-finder' ),
    "FJ" => esc_html__( 'Fiji', 'service-finder' ),
    "FI" => esc_html__( 'Finland', 'service-finder' ),
    "FR" => esc_html__( 'France', 'service-finder' ),
    "GF" => esc_html__( 'French Guiana', 'service-finder' ),
    "PF" => esc_html__( 'French Polynesia', 'service-finder' ),
    "TF" => esc_html__( 'French Southern Territories', 'service-finder' ),
    "GA" => esc_html__( 'Gabon', 'service-finder' ),
    "GM" => esc_html__( 'Gambia', 'service-finder' ),
    "GE" => esc_html__( 'Georgia', 'service-finder' ),
    "DE" => esc_html__( 'Germany', 'service-finder' ),
    "GH" => esc_html__( 'Ghana', 'service-finder' ),
    "GI" => esc_html__( 'Gibraltar', 'service-finder' ),
    "GR" => esc_html__( 'Greece', 'service-finder' ),
    "GL" => esc_html__( 'Greenland', 'service-finder' ),
    "GD" => esc_html__( 'Grenada', 'service-finder' ),
    "GP" => esc_html__( 'Guadeloupe', 'service-finder' ),
    "GU" => esc_html__( 'Guam', 'service-finder' ),
    "GT" => esc_html__( 'Guatemala', 'service-finder' ),
    "GG" => esc_html__( 'Guernsey', 'service-finder' ),
    "GN" => esc_html__( 'Guinea', 'service-finder' ),
    "GW" => esc_html__( 'Guinea-bissau', 'service-finder' ),
    "GY" => esc_html__( 'Guyana', 'service-finder' ),
    "HT" => esc_html__( 'Haiti', 'service-finder' ),
    "HM" => esc_html__( 'Heard Island and Mcdonald Islands', 'service-finder' ),
    "VA" => esc_html__( 'Holy See (Vatican City State)', 'service-finder' ),
    "HN" => esc_html__( 'Honduras', 'service-finder' ),
    "HK" => esc_html__( 'Hong Kong', 'service-finder' ),
    "HU" => esc_html__( 'Hungary', 'service-finder' ),
    "IS" => esc_html__( 'Iceland', 'service-finder' ),
    "IN" => esc_html__( 'India', 'service-finder' ),
    "ID" => esc_html__( 'Indonesia', 'service-finder' ),
    "IR" => esc_html__( 'Iran', 'service-finder' ),
    "IQ" => esc_html__( 'Iraq', 'service-finder' ),
    "IE" => esc_html__( 'Ireland', 'service-finder' ),
    "IM" => esc_html__( 'Isle of Man', 'service-finder' ),
    "IL" => esc_html__( 'Israel', 'service-finder' ),
    "IT" => esc_html__( 'Italy', 'service-finder' ),
    "JM" => esc_html__( 'Jamaica', 'service-finder' ),
    "JP" => esc_html__( 'Japan', 'service-finder' ),
    "JE" => esc_html__( 'Jersey', 'service-finder' ),
    "JO" => esc_html__( 'Jordan', 'service-finder' ),
    "KZ" => esc_html__( 'Kazakhstan', 'service-finder' ),
    "KE" => esc_html__( 'Kenya', 'service-finder' ),
    "KI" => esc_html__( 'Kiribati', 'service-finder' ),
    "KP" => esc_html__( 'Korea, Democratic People\'s Republic of', 'service-finder' ),
    "KR" => esc_html__( 'Korea, Republic of', 'service-finder' ),
    "KW" => esc_html__( 'Kuwait', 'service-finder' ),
    "KG" => esc_html__( 'Kyrgyzstan', 'service-finder' ),
    "LA" => esc_html__( 'Lao People\'s Democratic Republic', 'service-finder' ),
    "LV" => esc_html__( 'Latvia', 'service-finder' ),
    "LB" => esc_html__( 'Lebanon', 'service-finder' ),
    "LS" => esc_html__( 'Lesotho', 'service-finder' ),
    "LR" => esc_html__( 'Liberia', 'service-finder' ),
    "LY" => esc_html__( 'Libyan Arab Jamahiriya', 'service-finder' ),
    "LI" => esc_html__( 'Liechtenstein', 'service-finder' ),
    "LT" => esc_html__( 'Lithuania', 'service-finder' ),
    "LU" => esc_html__( 'Luxembourg', 'service-finder' ),
    "MO" => esc_html__( 'Macao', 'service-finder' ),
    "MK" => esc_html__( 'Macedonia, The Former Yugoslav Republic of', 'service-finder' ),
    "MG" => esc_html__( 'Madagascar', 'service-finder' ),
    "MW" => esc_html__( 'Malawi', 'service-finder' ),
    "MY" => esc_html__( 'Malaysia', 'service-finder' ),
    "MV" => esc_html__( 'Maldives', 'service-finder' ),
    "ML" => esc_html__( 'Mali', 'service-finder' ),
    "MT" => esc_html__( 'Malta', 'service-finder' ),
    "MH" => esc_html__( 'Marshall Islands', 'service-finder' ),
    "MQ" => esc_html__( 'Martinique', 'service-finder' ),
    "MR" => esc_html__( 'Mauritania', 'service-finder' ),
    "MU" => esc_html__( 'Mauritius', 'service-finder' ),
    "YT" => esc_html__( 'Mayotte', 'service-finder' ),
    "MX" => esc_html__( 'Mexico', 'service-finder' ),
    "FM" => esc_html__( 'Micronesia, Federated States of', 'service-finder' ),
    "MD" => esc_html__( 'Moldova, Republic of', 'service-finder' ),
    "MC" => esc_html__( 'Monaco', 'service-finder' ),
    "MN" => esc_html__( 'Mongolia', 'service-finder' ),
    "ME" => esc_html__( 'Montenegro', 'service-finder' ),
    "MS" => esc_html__( 'Montserrat', 'service-finder' ),
    "MA" => esc_html__( 'Morocco', 'service-finder' ),
    "MZ" => esc_html__( 'Mozambique', 'service-finder' ),
    "MM" => esc_html__( 'Myanmar', 'service-finder' ),
    "NA" => esc_html__( 'Namibia', 'service-finder' ),
    "NR" => esc_html__( 'Nauru', 'service-finder' ),
    "NP" => esc_html__( 'Nepal', 'service-finder' ),
    "NL" => esc_html__( 'Netherlands', 'service-finder' ),
    "AN" => esc_html__( 'Netherlands Antilles', 'service-finder' ),
    "NC" => esc_html__( 'New Caledonia', 'service-finder' ),
    "NZ" => esc_html__( 'New Zealand', 'service-finder' ),
    "NI" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NE" => esc_html__( 'Nicaragua', 'service-finder' ),
    "NG" => esc_html__( 'Nigeria', 'service-finder' ),
    "NU" => esc_html__( 'Niue', 'service-finder' ),
    "NF" => esc_html__( 'Norfolk Island', 'service-finder' ),
    "MP" => esc_html__( 'Northern Mariana Islands', 'service-finder' ),
    "NO" => esc_html__( 'Norway', 'service-finder' ),
    "OM" => esc_html__( 'Oman', 'service-finder' ),
    "PK" => esc_html__( 'Pakistan', 'service-finder' ),
    "PW" => esc_html__( 'Palau', 'service-finder' ),
    "PS" => esc_html__( 'Palestinian Territory, Occupied', 'service-finder' ),
    "PA" => esc_html__( 'Panama', 'service-finder' ),
    "PG" => esc_html__( 'Papua New Guinea', 'service-finder' ),
    "PY" => esc_html__( 'Paraguay', 'service-finder' ),
    "PE" => esc_html__( 'Peru', 'service-finder' ),
    "PH" => esc_html__( 'Philippines', 'service-finder' ),
    "PN" => esc_html__( 'Pitcairn', 'service-finder' ),
    "PL" => esc_html__( 'Poland', 'service-finder' ),
    "PT" => esc_html__( 'Portugal', 'service-finder' ),
    "PR" => esc_html__( 'Puerto Rico', 'service-finder' ),
    "QA" => esc_html__( 'Qatar', 'service-finder' ),
    "RE" => esc_html__( 'Reunion', 'service-finder' ),
    "RO" => esc_html__( 'Romania', 'service-finder' ),
    "RU" => esc_html__( 'Russian Federation', 'service-finder' ),
    "RW" => esc_html__( 'Rwanda', 'service-finder' ),
    "SH" => esc_html__( 'Saint Helena', 'service-finder' ),
    "KN" => esc_html__( 'Saint Kitts and Nevis', 'service-finder' ),
    "LC" => esc_html__( 'Saint Lucia', 'service-finder' ),
    "PM" => esc_html__( 'Saint Pierre and Miquelon', 'service-finder' ),
    "VC" => esc_html__( 'Saint Vincent and The Grenadines', 'service-finder' ),
    "WS" => esc_html__( 'Samoa', 'service-finder' ),
    "SM" => esc_html__( 'San Marino', 'service-finder' ),
    "ST" => esc_html__( 'Sao Tome and Principe', 'service-finder' ),
    "SA" => esc_html__( 'Saudi Arabia', 'service-finder' ),
    "SN" => esc_html__( 'Senegal', 'service-finder' ),
    "RS" => esc_html__( 'Serbia', 'service-finder' ),
    "SC" => esc_html__( 'Seychelles', 'service-finder' ),
    "SL" => esc_html__( 'Sierra Leone', 'service-finder' ),
    "SG" => esc_html__( 'Singapore', 'service-finder' ),
    "SK" => esc_html__( 'Slovakia', 'service-finder' ),
    "SI" => esc_html__( 'Slovenia', 'service-finder' ),
    "SB" => esc_html__( 'Solomon Islands', 'service-finder' ),
    "SO" => esc_html__( 'Somalia', 'service-finder' ),
    "ZA" => esc_html__( 'South Africa', 'service-finder' ),
    "GS" => esc_html__( 'South Georgia and The South Sandwich Islands', 'service-finder' ),
    "ES" => esc_html__( 'Spain', 'service-finder' ),
    "LK" => esc_html__( 'Sri Lanka', 'service-finder' ),
    "SD" => esc_html__( 'Sudan', 'service-finder' ),
    "SR" => esc_html__( 'Suriname', 'service-finder' ),
    "SJ" => esc_html__( 'Svalbard and Jan Mayen', 'service-finder' ),
    "SZ" => esc_html__( 'Swaziland', 'service-finder' ),
    "SE" => esc_html__( 'Sweden', 'service-finder' ),
    "CH" => esc_html__( 'Switzerland', 'service-finder' ),
    "SY" => esc_html__( 'Syrian Arab Republic', 'service-finder' ),
    "TW" => esc_html__( 'Taiwan, Province of China', 'service-finder' ),
    "TJ" => esc_html__( 'Tajikistan', 'service-finder' ),
    "TZ" => esc_html__( 'Tanzania, United Republic of', 'service-finder' ),
    "TH" => esc_html__( 'Thailand', 'service-finder' ),
    "TL" => esc_html__( 'Timor-leste', 'service-finder' ),
    "TG" => esc_html__( 'Togo', 'service-finder' ),
    "TK" => esc_html__( 'Tokelau', 'service-finder' ),
    "TO" => esc_html__( 'Tonga', 'service-finder' ),
    "TT" => esc_html__( 'Trinidad and Tobago', 'service-finder' ),
    "TN" => esc_html__( 'Tunisia', 'service-finder' ),
    "TR" => esc_html__( 'Turkey', 'service-finder' ),
    "TM" => esc_html__( 'Turkmenistan', 'service-finder' ),
    "TC" => esc_html__( 'Turks and Caicos Islands', 'service-finder' ),
    "TV" => esc_html__( 'Tuvalu', 'service-finder' ),
    "UG" => esc_html__( 'Uganda', 'service-finder' ),
    "UA" => esc_html__( 'Ukraine', 'service-finder' ),
    "AE" => esc_html__( 'United Arab Emirates', 'service-finder' ),
    "GB" => esc_html__( 'United Kingdom', 'service-finder' ),
    "US" => esc_html__( 'United States', 'service-finder' ),
    "UM" => esc_html__( 'United States Minor Outlying Islands', 'service-finder' ),
    "UY" => esc_html__( 'Uruguay', 'service-finder' ),
    "UZ" => esc_html__( 'Uzbekistan', 'service-finder' ),
    "VU" => esc_html__( 'Vanuatu', 'service-finder' ),
    "VE" => esc_html__( 'Venezuela', 'service-finder' ),
    "VN" => esc_html__( 'Viet Nam', 'service-finder' ),
    "VG" => esc_html__( 'Virgin Islands, British', 'service-finder' ),
    "VI" => esc_html__( 'Virgin Islands, U.S.', 'service-finder' ),
    "WF" => esc_html__( 'Wallis and Futuna', 'service-finder' ),
    "EH" => esc_html__( 'Western Sahara', 'service-finder' ),
    "YE" => esc_html__( 'Yemen', 'service-finder' ),
    "ZM" => esc_html__( 'Zambia', 'service-finder' ),
    "ZW" => esc_html__( 'Zimbabwe', 'service-finder' ));
	return $countries;
}

/*For social login*/
if ( function_exists( 'wsl_shortcode_wordpress_social_login' ) ){
add_action( 'wsl_hook_process_login_after_wp_insert_user', 'service_finder_hook_process_login_after_wp_insert_user' , 10 , 4 );
function service_finder_hook_process_login_after_wp_insert_user($user_id, $provider, $hybridauth_user_profile){
global $wpdb,$service_finder_Tables,$service_finder_options;

$userrole = (isset($_SESSION['social_account_role'])) ? $_SESSION['social_account_role'] : 'customer';
unset($_SESSION['social_account_role']);

if($userrole == ''){
$userrole = 'customer';
}

update_user_meta($user_id, 'social_provider', $provider);

$userdata = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$wpdb->users.' WHERE `ID` = %d',$user_id));

if($userrole == 'customer'){

$user = new WP_User( $user_id );
$user->set_role('Customer');

$data = array(

			'wp_user_id' => $user_id,

		);

$wpdb->insert($service_finder_Tables->customers_data,wp_unslash($data));

}

if($userrole == 'provider'){

$user = new WP_User( $user_id );
$user->set_role('Provider');

if($service_finder_options['account-moderation']){
	$adminapproval = 'pending';
}else{
	$adminapproval = 'approved';
}

$fname = get_user_meta($user_id, 'first_name', true);
$lname = get_user_meta($user_id, 'last_name', true);

$data = array(

			'wp_user_id' => $user_id,

			'admin_moderation' => $adminapproval,
			
			'full_name' => esc_attr($fname).' '.esc_attr($lname),

			'email' => esc_attr($userdata->user_email),
			
		);

$wpdb->insert($service_finder_Tables->providers,wp_unslash($data));

$period = (!empty($service_finder_options['job-apply-limit-period'])) ? $service_finder_options['job-apply-limit-period'] : '';
$numberofweekmonth = (!empty($service_finder_options['job-apply-number-of-week-month'])) ? $service_finder_options['job-apply-number-of-week-month'] : 1;
$numberofperiod = (!empty($service_finder_options['job-apply-number-of-week-month'])) ? $service_finder_options['job-apply-number-of-week-month'] : '';

$startdate = date('Y-m-d h:i:s');

if($period == 'weekly'){
	$freq = 7 * $numberofweekmonth;
	$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
}elseif($period == 'monthly'){
	$freq = 30 * $numberofweekmonth;
	$expiredate = date('Y-m-d h:i:s', strtotime("+".$freq." days"));
}

$data = array(
		'provider_id' => $user_id,
		'membership_date' => $startdate,
		'start_date' => $startdate,
		'expire_date' => $expiredate,
		);

$wpdb->insert($service_finder_Tables->job_limits,wp_unslash($data));


$memberData = array(

			'member_name' => esc_attr($fname).' '.esc_attr($lname),

			'email' => esc_attr($userdata->user_email),

			'admin_wp_id' => esc_attr($user_id),

			'is_admin' => 'yes',

			);

$wpdb->insert($service_finder_Tables->team_members,wp_unslash($memberData));
}

}
}

/*Redirect after social login*/
add_filter( 'wsl_hook_process_login_alter_redirect_to', 'service_finder_hook_process_login_alter_redirect_to_callback' );
function service_finder_hook_process_login_alter_redirect_to_callback($redirect_to) {
	
	$account_url = service_finder_get_url_by_shortcode('[service_finder_my_account]');
	return $account_url;
}

/*google calendar date format*/
function service_finder_themestyle_fortheme() {
	global $service_finder_options;
	
	$themestyle = (isset($service_finder_options['theme-style'])) ? esc_html($service_finder_options['theme-style']) : '';
	return $themestyle;
}