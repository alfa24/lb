<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/
get_header(); 
?>
<!-- Blog Detail page layout -->
<div class="page-content">
  <!-- Left & right section start -->
  <div class="container">
    <div class="section-content  job-content" >
      <div class="row">
        <!-- Left part start -->
        <div class="col-md-12">
        <?php
		$current_user = wp_get_current_user(); 
		if(is_user_logged_in()){
        if ( service_finder_UserRole($current_user->ID) == 'Provider' ){
		
			$userCap = array();
			if(class_exists('service_finder_booking_plugin')) {
			$userCap = service_finder_get_capability($current_user->ID);
			}
			
			if(!empty($userCap)){
			if(!in_array('apply-for-job',$userCap)){
				echo '<div class="alert alert-danger">'.esc_html__( 'You do not have capability to apply for job. Please upgrade your package.', 'wp-job-manager' ).'</div>';
			}else{
				$availablelimit = service_finder_get_avl_job_limits($current_user->ID);
				if($availablelimit < 1){
				echo '<div class="alert alert-danger">'.esc_html__( 'You do not have available connects. Please upgrade you plan.', 'wp-job-manager' ).'</div>';
				}
			}
			}
		
		}
		}
		?>
        
          <?php if ( have_posts() ) : the_post();
				$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id(), 'service_finder-blog-thumbimage', false );
		  ?>
          <div id="post-<?php the_ID(); ?>">
            <div class="post">
              
              <div class="sf-job-info clearfix">
                
                <div class="company-logo-info"><?php the_company_logo(); ?></div>
                
                <div class="sf-job-title-company">  
                    <h2 class="sf-job-title">
                       <?php the_title(); ?>
                    </h2>
				 	<div class="sf-job-company-name"> <?php the_company_name( '<strong itemprop="name">', '</strong>' ); ?></div>
				</div>
                <?php if ( candidates_can_apply() ) : ?>
                <div class="sf-job-apply">
					<?php get_job_manager_template( 'job-application.php' ); ?>
                </div>    
                <?php endif; ?> 
                <div class="sf-job-detail">
                 
                  <?php the_content(); ?>
                  
                </div>
                <?php edit_post_link( esc_html__( 'Edit', 'service-finder' ), '<div class="entry-footer"><span class="edit-link">', '</span></div><!-- .entry-footer -->' ); ?>
              </div>
            </div>
          </div>
         
        <?php
        // Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next post:', 'service-finder' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'service-finder' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		?>
          
          <?php endif; ?>
        </div>
        <!-- Left part END -->
      </div>
    </div>
  </div>
  <!-- Left & right section  END -->
</div>
<?php get_footer(); ?>
