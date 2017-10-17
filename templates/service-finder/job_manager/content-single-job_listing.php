<?php global $post; ?>
<?php
if(get_option('timezone_string') != ""){
date_default_timezone_set(get_option('timezone_string'));
}
?>
<div class="single_job_listing" itemscope itemtype="http://schema.org/JobPosting">
	<meta itemprop="title" content="<?php echo esc_attr( $post->post_title ); ?>" />

	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php _e( 'This listing has expired.', 'wp-job-manager' ); ?></div>
	<?php else : ?>
		<?php
			/**
			 * single_job_listing_start hook
			 *
			 * @hooked job_listing_meta_display - 20
			 * @hooked job_listing_company_display - 30
			 */
			do_action( 'single_job_listing_start' );
		?>

		<div class="job_description" itemprop="description">
			<?php echo apply_filters( 'the_job_description', get_the_content() ); ?>
		</div>

		<?php
			/**
			 * single_job_listing_end hook
			 */
			 if(is_user_logged_in()){
			 $current_user = wp_get_current_user(); 
				 if(service_finder_getUserRole($current_user->ID) == 'Provider'){
					do_action( 'single_job_listing_end' );
				 }	
			}
		?>
	<?php endif; ?>
</div>
