<?php global $current_user; ?>
<div class="profile-form-bx">
<div id="job-manager-job-dashboard">
    <?php if(is_user_logged_in() && service_finder_getUserRole($current_user->ID) == 'Customer'){ ?>
    <p><?php esc_html_e( 'Your listings are shown in the table below.', 'service-finder' ); ?></p>
	<table class="job-manager-jobs table table-striped">
		<thead>
			<tr>
				<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
					<th class="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $column ); ?></th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php if ( ! $jobs ) : ?>
				<tr>
					<td colspan="6"><?php _e( 'You do not have any active listings.', 'wp-job-manager' ); ?></td>
				</tr>
			<?php else : ?>
				<?php foreach ( $jobs as $job ) : ?>
					<tr>
						<?php foreach ( $job_dashboard_columns as $key => $column ) : ?>
							<td class="<?php echo esc_attr( $key ); ?>">
								<?php if ('job_title' === $key ) : ?>
									<?php if ( $job->post_status == 'publish' ) : ?>
										<a href="<?php echo get_permalink( $job->ID ); ?>"><?php echo $job->post_title; ?></a>
									<?php else : ?>
										<?php echo $job->post_title; ?> <small>(<?php the_job_status( $job ); ?>)</small>
									<?php endif; ?>
									<ul class="job-dashboard-actions">
										<?php
											$actions = array();

											switch ( $job->post_status ) {
												case 'publish' :
													$actions['edit'] = array( 'label' => __( 'Edit', 'wp-job-manager' ), 'nonce' => false );

													if ( is_position_filled( $job ) ) {
														$actions['mark_not_filled'] = array( 'label' => __( 'Mark not filled', 'wp-job-manager' ), 'nonce' => true );
													} else {
														$actions['mark_filled'] = array( 'label' => __( 'Mark filled', 'wp-job-manager' ), 'nonce' => true );
													}

													$actions['duplicate'] = array( 'label' => __( 'Duplicate', 'wp-job-manager' ), 'nonce' => true );
													break;
												case 'expired' :
													if ( job_manager_get_permalink( 'submit_job_form' ) ) {
														$actions['relist'] = array( 'label' => __( 'Relist', 'wp-job-manager' ), 'nonce' => true );
													}
													break;
												case 'pending_payment' :
												case 'pending' :
													if ( job_manager_user_can_edit_pending_submissions() ) {
														$actions['edit'] = array( 'label' => __( 'Edit', 'wp-job-manager' ), 'nonce' => false );
													}
												break;
											}

											$actions['delete'] = array( 'label' => __( 'Delete', 'wp-job-manager' ), 'nonce' => true );
											$actions           = apply_filters( 'job_manager_my_job_actions', $actions, $job );

											foreach ( $actions as $action => $value ) {
												$action_url = add_query_arg( array( 'action' => $action, 'job_id' => $job->ID ) );
												if ( $value['nonce'] ) {
													$action_url = wp_nonce_url( $action_url, 'job_manager_my_job_actions' );
												}
												echo '<li><a href="' . esc_url( $action_url ) . '" class="job-dashboard-action-' . esc_attr( $action ) . '">' . esc_html( $value['label'] ) . '</a></li>';
											}
										?>
									</ul>
								<?php elseif ('date' === $key ) : ?>
									<?php echo date_i18n( get_option( 'date_format' ), strtotime( $job->post_date ) ); ?>
								<?php elseif ('expires' === $key ) : ?>
									<?php echo $job->_job_expires ? date_i18n( get_option( 'date_format' ), strtotime( $job->_job_expires ) ) : '&ndash;'; ?>
                                <?php elseif ('number_of_applicants' === $key ) : ?>
									<?php 
									if(service_finder_get_number_of_applicants($job->ID) > 0){
									echo '<a href="javascript:;" class="show_applicants" data-jobid="'.esc_attr($job->ID).'">' . service_finder_get_number_of_applicants($job->ID) . '</a>'; 
									}else{
									echo '<a href="javascript:;">' . service_finder_get_number_of_applicants($job->ID) . '</a>'; 						
									}
									?>    
								<?php elseif ('filled' === $key ) : ?>
									<?php echo is_position_filled( $job ) ? '&#10004;' : '&ndash;'; ?>
								<?php else : ?>
									<?php do_action( 'job_manager_job_dashboard_column_' . $key, $job ); ?>
								<?php endif; ?>
							</td>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
	<?php get_job_manager_template( 'pagination.php', array( 'max_num_pages' => $max_num_pages ) ); ?>
    <?php }else{ ?>
    <p><?php esc_html_e( 'Sorry you do not have access to this page.', 'service-finder' ); ?></p>
    <?php } ?>
</div>
<div id="job-manager-job-applicants" style="display:none">
<div class="listing-grid-box sf-listing-grid-4 equal-col-outer">
<div class="row">
<div class="col-md-12">
<a href="javascript:;" class="gotodashboard btn btn-primary"><?php esc_html_e('Back','service-finder')?></a>
</div>
</div>
<div class="row" id="applicants-listing">
</div>            
<br class="clear">
</div>            
</div>
</div>
