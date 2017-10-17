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
if(service_finder_UserRole($author) != 'Provider' || !class_exists('service_finder_booking_plugin') || !class_exists('service_finder_texonomy_plugin')){ 
/*Author page for normal user*/
?>

<div class="container">
  <div class="col-md-6">
    <h2 class="result-title"> <?php printf( esc_html__('All posts by %s', 'service-finder' ), get_the_author() ); ?> </h2>
  </div>
  <div class="section-content blog-content" >
    <div class="row">
      <!-- Blog part start -->
      <div class="col-md-9">
        <?php
			if ( have_posts() ) : 
			while ( have_posts() ) : the_post(); ?>
           
        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="post">
            <?php get_template_part( 'content', 'author' ); ?>
          </div>
        </div>
        <?php
				
			endwhile;

			the_posts_pagination( array(
					'prev_text'          => "<i class='fa fa-angle-left'></i>".esc_html__(' Prev', 'service-finder' ),
					'next_text'          => esc_html__('Next ', 'service-finder' )."<i class='fa fa-angle-right'></i>",
					'before_page_number' => '',
				) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'content', 'none' );

		endif;
		?>
      </div>
      <!-- Blog part END -->
      <!-- Side bar start -->
      <div class="col-md-3">
        <?php get_sidebar(); ?>
      </div>
      <!-- Side bar END -->
    </div>
  </div>
</div>
<?php 
}
get_footer();
