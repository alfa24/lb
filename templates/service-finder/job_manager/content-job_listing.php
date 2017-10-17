<?php global $post; ?>
<?php 
if(get_option('timezone_string') != ""){
date_default_timezone_set(get_option('timezone_string'));
}
?>
<li <?php job_listing_class(); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
    <a class="job-clickable-box" href="<?php the_job_permalink(); ?>"></a>
    <div class="job-comapny-logo"><?php the_company_logo(); ?></div>
        <div class="job-comapny-info">
            <div class="position">
                <h3><?php the_title(); ?></h3>
                <div class="company">
                    <?php the_company_name( '<strong>', '</strong> ' ); ?>
                    <?php the_company_tagline( '<span class="tagline">', '</span>' ); ?>
                </div>
            </div>
            <div class="location">
                <?php the_job_location( false ); ?>
            </div>
            <ul class="meta">
                <?php do_action( 'job_listing_meta_start' ); ?>
    			
                <li class="job-type <?php echo get_the_job_type() ? sanitize_title( get_the_job_type()->slug ) : ''; ?>"><?php the_job_type(); ?></li>
                <li class="date"><date><?php printf( __( '%s ago', 'wp-job-manager' ), human_time_diff( get_post_time( 'U' ), time() ) ); ?></date></li>
    
                <?php do_action( 'job_listing_meta_end' ); ?>
            </ul>
        </div>
</li>