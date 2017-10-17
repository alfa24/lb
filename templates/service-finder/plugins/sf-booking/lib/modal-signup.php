<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

$service_finder_ThemeParams = service_finder_plugin_global_vars('service_finder_ThemeParams');
$service_finder_options = get_option('service_finder_options');
$providerreplacestring = (!empty($service_finder_options['provider-replace-string'])) ? $service_finder_options['provider-replace-string'] : esc_html__('Provider', 'service-finder');	
$customerreplacestring = (!empty($service_finder_options['customer-replace-string'])) ? $service_finder_options['customer-replace-string'] : esc_html__('Customer', 'service-finder');	

$twocheckouttype = (!empty($service_finder_options['twocheckout-type'])) ? esc_html($service_finder_options['twocheckout-type']) : '';
if($twocheckouttype == 'live'){
	$twocheckoutmode = 'production';
}else{
	$twocheckoutmode = 'sandbox';
}

if($twocheckouttype == 'live'){
	$twocheckoutpublishkey = (!empty($service_finder_options['twocheckout-live-publish-key'])) ? esc_html($service_finder_options['twocheckout-live-publish-key']) : '';
	$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-live-account-id'])) ? esc_html($service_finder_options['twocheckout-live-account-id']) : '';
}else{
	$twocheckoutpublishkey = (!empty($service_finder_options['twocheckout-test-publish-key'])) ? esc_html($service_finder_options['twocheckout-test-publish-key']) : '';
	$twocheckoutaccountid = (!empty($service_finder_options['twocheckout-test-account-id'])) ? esc_html($service_finder_options['twocheckout-test-account-id']) : '';
}

$signupautosuggestion = (!empty($service_finder_options['signup-auto-suggestion'])) ? esc_html($service_finder_options['signup-auto-suggestion']) : '';
$show_signup_otp = (!empty($service_finder_options['show-signup-otp'])) ? esc_html($service_finder_options['show-signup-otp']) : '';

$countryarr = (!empty($service_finder_options['allowed-country'])) ? $service_finder_options['allowed-country'] : '';
$totalcountry = count($countryarr);

wp_add_inline_script( 'service_finder-js-form-validation', '/*Declare global variable*/
var twocheckoutaccountid = "'.$twocheckoutaccountid.'";
var twocheckoutpublishkey = "'.$twocheckoutpublishkey.'";
var twocheckouttype = "'.$twocheckouttype.'";
var twocheckoutmode = "'.$twocheckoutmode.'";
var totalcountry = "'.$totalcountry.'";
var signupautosuggestion = "'.$signupautosuggestion.'";
', 'after' );
?>
<!-- Modal Login & Register-->

<div id="login-Modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content login-bx-dynamic">
      <!-- Modal Login Template-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">
          <?php esc_html_e('Login', 'service-finder'); ?>
        </h4>
      </div>
      <div class="modal-body clearfix">
        <div class="row ">
          <form class="loginform" method="post">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group"> <i class="input-group-addon fa fa-user"></i>
                  <input name="login_user_name" type="text" class="form-control" placeholder="<?php esc_html_e('Username', 'service-finder'); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group"> <i class="input-group-addon fa fa-lock"></i>
                  <input name="login_password" type="password" class="form-control" placeholder="<?php esc_html_e('Password', 'service-finder'); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" name="redirectnonce" id="redirectnonce" value="">
                <input type="submit" class="btn btn-primary btn-block" name="user-login" value="<?php esc_html_e('Login', 'service-finder'); ?>" />
              </div>
            </div>
            <div class="col-md-12 text-center"> <small><a href="javascript:;" class="regform">
              <?php esc_html_e('Don\'t have an account?', 'service-finder'); ?>
              </a> | <a href="javascript:;" class="forgotpassform">
              <?php esc_html_e('Forgot Password', 'service-finder'); ?>
              </a></small> </div>
          </form>
          <div class="col-md-12">
          <?php do_action( 'wordpress_social_login' ); ?>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-content register-modal hidden">
      <!-- Modal Register Template-->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">
          <?php esc_html_e('Sign up', 'service-finder'); ?>
        </h4>
      </div>
      <div class="modal-body clearfix">
        <div class="tabbable">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">
              <?php echo esc_html($customerreplacestring); ?>
              </a></li>
            <li><a data-toggle="tab" href="#tab2">
              <?php echo esc_html($providerreplacestring); ?>
              </a></li>
          </ul>
          <div class="tab-content">
            <!-- Customer form Template-->
            <div id="tab1" class="tab-pane fade in active">
              <form class="customer_registration" method="post">
                <div class="customer-bx clearfix row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_first_name" type="text" class="form-control" placeholder="<?php esc_html_e('First Name', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_last_name" type="text" class="form-control" placeholder="<?php esc_html_e('Last Name', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_user_name" type="text" class="form-control" placeholder="<?php esc_html_e('Username', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_user_email" type="text" class="form-control" placeholder="<?php esc_html_e('Email', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_password" type="password" class="form-control" placeholder="<?php esc_html_e('Password', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_confirm_password" type="password" class="form-control" placeholder="<?php esc_html_e('Confirm Password', 'service-finder'); ?>">
                    </div>
                  </div>
                  <?php
                  $customertermchk = (isset($service_finder_options['terms-condition-checkbox-customers'])) ? esc_attr($service_finder_options['terms-condition-checkbox-customers']) : '';
				  if($customertermchk){
				  ?>
                  <div class="col-md-12">
                  <div class="form-group">
                    <div class="checkbox">
                    <input type="checkbox" value="yes" name="customertermsncondition" id="customertermsncondition">
                    <label for="customertermsncondition">
                    <?php
                    $customerterms = (isset($service_finder_options['text-terms-condition-checkbox-customers'])) ? $service_finder_options['text-terms-condition-checkbox-customers'] : '';	
					$allowedhtml = array(
								'a' => array(
									'href' => array(),
									'class' => array(),
									'target' => array()
								),
							);
					echo wp_kses($customerterms,$allowedhtml); ?>
                    </label>
                  </div>
                  </div>
                  </div>
                  <?php } ?>
                  <?php echo service_finder_captcha('customersignup'); ?>
                  <div class="col-md-12">
                    <input type="hidden" name="signup_user_role" value="<?php echo esc_attr($service_finder_ThemeParams['role']['customer']); ?>" />
                    <input type="submit" class="btn btn-primary btn-block" name="user-register" value="<?php esc_html_e('Sign up', 'service-finder'); ?>" />
                  </div>
                  <div class="col-md-12 text-center"> <small><a href="javascript:;" class="loginform">
                    <?php esc_html_e('Already Registered?', 'service-finder'); ?>
                    </a></small> </div>
                </div>
              </form>
              <?php do_action( 'wordpress_social_login' ); ?>
            </div>
            <!-- Provider form Template-->
            <div id="tab2" class="tab-pane fade">
              <form class="provider_registration" method="post">
                <div class="provider-bx clearfix row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input name="signup_company_name" type="text" class="form-control" placeholder="<?php esc_html_e('Company Name', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_first_name" type="text" class="form-control" placeholder="<?php esc_html_e('First Name', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_last_name" type="text" class="form-control" placeholder="<?php esc_html_e('Last Name', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_user_name" type="text" class="form-control" placeholder="<?php esc_html_e('Username', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_user_email" id="signup_user_email" type="text" class="form-control" placeholder="<?php esc_html_e('Email', 'service-finder'); ?>">
                    </div>
                  </div>
                  <?php if($show_signup_otp){ ?>
                    <div class="col-md-12">
                      <div class="form-group signupotp-section">
                        <label>
                        <?php esc_html_e('One Time Password', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-lock"></i>
                          <input id="fillsignupotp" name="fillsignupotp" type="text" class="form-control" value="">
                        </div>
                        <a href="javascript:;" class="signupotp">
                        <?php esc_html_e('Generate One time Password to Confirm Email', 'service-finder'); ?>
                        </a> </div>
                    </div>
                    <?php } ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_password" id="password" type="password" class="form-control" placeholder="<?php esc_html_e('Password', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input name="signup_confirm_password" type="password" class="form-control" placeholder="<?php esc_html_e('Confirm Password', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="signup_phone" id="signup_phone" placeholder="<?php esc_html_e('Phone', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" class="form-control" name="signup_address" id="signup_address" placeholder="<?php esc_html_e('Address', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group has-select">
                      <?php
                      $readonly = 'readonly="readonly"';
					  $disabled = 'disabled="disabled"';
					  $placeholder = esc_html__('City (Select country to enable)','service-finder');
					  ?>
                      <select class="form-control" name="signup_country" data-live-search="true" title="<?php esc_html_e('Country', 'service-finder'); ?>" id="signup_country">
                      <option value="">
                        <?php esc_html_e('Select Country', 'service-finder'); ?>
                        </option>
					  <?php
					  $allcountry = (!empty($service_finder_options['all-countries'])) ? $service_finder_options['all-countries'] : '';
					  $countries = service_finder_get_countries();
					  if($allcountry){
						  if(!empty($countries)){
							foreach($countries as $key => $country){
								echo '<option value="'.esc_attr($country).'" data-code="'.esc_attr($key).'">'. $country.'</option>';
							}
						  }
					  }else{
					 	 $countryarr = (!empty($service_finder_options['allowed-country'])) ? $service_finder_options['allowed-country'] : '';
						 $totalcountry = count($countryarr);
						 if($countryarr){
						 	foreach($countryarr as $key){
							if($totalcountry == 1){
								$select = 'selected="selected"';
								$readonly = '';
								$disabled = '';
								$placeholder = esc_html__('Please select city from suggestion','service-finder');
							}else{
								$select = '';
							}
								echo '<option '.$select.' value="'.esc_attr($countries[$key]).'" data-code="'.esc_attr($key).'">'. $countries[$key].'</option>';
							}
						 }
					  }
					  ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="autocity">
                    <?php if($signupautosuggestion){ ?>
                      <input type="text" class="form-control" name="signup_city" placeholder="<?php echo $placeholder; ?>" <?php echo $readonly; ?> id="signup_city" autocomplete="off" placeholder="<?php esc_html_e('City', 'service-finder'); ?>">
                    <?php }else{ ?>
                    <select <?php echo $readonly; ?> <?php echo $disabled; ?> class="form-control" name="signup_city" data-live-search="true" title="<?php echo $placeholder; ?>" id="signup_city">
                      <option value="">
                        <?php esc_html_e('Select City', 'service-finder'); ?>
                        </option>
                      </select>
                    <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="signup_apt" placeholder="<?php esc_html_e('Apt/Suite #', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="signup_state" id="signup_state" placeholder="<?php esc_html_e('State', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="text" class="form-control" name="signup_zipcode" id="signup_zipcode" placeholder="<?php esc_html_e('Postal Code', 'service-finder'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group has-select">
                      <select class="form-control" name="signup_category" data-live-search="true" title="<?php esc_html_e('Category', 'service-finder'); ?>">
                        <option value="">
                        <?php esc_html_e('Select Category', 'service-finder'); ?>
                        </option>
                        <?php
                                                  if(class_exists('service_finder_texonomy_plugin')){
												    $limit = 1000;
                                                    $categories = service_finder_getCategoryList($limit);
                                                    $texonomy = 'providers-category';
                                                    if(!empty($categories)){
                                                        foreach($categories as $category){
                                                        $term_id = (!empty($category->term_id)) ? $category->term_id : '';
														$term_name = (!empty($category->name)) ? $category->name : '';
                                                        echo '<option value="'.esc_attr($term_id).'" data-content="<span>'.esc_attr($term_name).'</span>">'. $term_name.'</option>';
                                                        
                                                        $term_children = get_term_children($term_id,$texonomy);
                                                        if(!empty($term_children)){
															$namearray = array();
															foreach ($term_children as $child) {
																$term = get_term_by( 'id', $child, $texonomy );
																$namearray[$term->name]= $child;
															}
															ksort($namearray);
															
                                                            foreach($namearray as $term_child_id) {
															
                                                                $term_child = get_term_by('id',$term_child_id,$texonomy);
        
		                                                        $term_child_id = (!empty($term_child_id)) ? $term_child_id : '';
																$term_childname = (!empty($term_child->name)) ? $term_child->name : '';
                                                                echo '<option value="'.esc_attr($term_child_id).'" data-content="<span class=\'childcat\'>'.esc_attr($term_childname).'</span>">'. $term_childname.'</option>';
                                                                
                                                            }
                                                        }
                                                        
                                                        }
                                                    }	
												   }
                                                    ?>
                      </select>
                    </div>
                  </div>
                  <?php
                      $enablepackage0 = (!empty($service_finder_options['enable-package0'])) ? $service_finder_options['enable-package0'] : '';
					  $enablepackage1 = (!empty($service_finder_options['enable-package1'])) ? $service_finder_options['enable-package1'] : '';
					  $enablepackage2 = (!empty($service_finder_options['enable-package2'])) ? $service_finder_options['enable-package2'] : '';
					  $enablepackage3 = (!empty($service_finder_options['enable-package3'])) ? $service_finder_options['enable-package3'] : '';
					  if($enablepackage0 || $enablepackage1 || $enablepackage2 || $enablepackage3){
					  $withoutpackage = false;
					  ?>
                  <div class="col-md-6">
                    <div class="form-group">
                      <select name="provider-role" class="form-control">
                        <option class="blank" value="">
                        <?php esc_html_e('Select a Package', 'service-finder'); ?>
                        </option>
                        <?php echo service_finder_getPackages() ?>
                      </select>
                    </div>
                  </div>
                  <?php }else{
				  		$withoutpackage = true;
				  } ?>
                  <?php
				  $package1price = (isset($service_finder_options['package1-price'])) ? $service_finder_options['package1-price'] : '';	
				  
                                        $free = (trim($package1price) == '0') ? true : false;
										?>
                  <div class="col-md-12 margin-less sf-card-group" id="paymethod" <?php echo ($free) ? 'style="display:none;"' : ''; ?> >
                    <div class="form-group form-inline">
                      <?php
                                                                $payment_methods = (!empty($service_finder_options['payment-methods'])) ? $service_finder_options['payment-methods'] : '';
																$paymentflag = 0;
																if(!empty($payment_methods)){
																foreach($payment_methods as $key => $value){
																if($key != 'paypal-adaptive' && $key != 'cod'){
																	if($key == 'stripe'){
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/mastercard.jpg" alt="'.esc_html__('mastercard','service-finder').'"><img src="'.get_template_directory_uri().'/inc/images/payment/payment.jpg" alt="'.esc_html__('american express','service-finder').'"><img src="'.get_template_directory_uri().'/inc/images/payment/discover.jpg" alt="'.esc_html__('discover','service-finder').'"><img src="'.get_template_directory_uri().'/inc/images/payment/visa.jpg" alt="'.esc_html__('visa','service-finder').'">';
																	}elseif($key == 'twocheckout'){
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/twocheckout.jpg" alt="'.esc_html__('2Checkout','service-finder').'">';
																	}elseif($key == 'wired'){
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/wired.jpg" alt="'.esc_html__('wired','service-finder').'">';
																	}elseif($key == 'payumoney' && $service_finder_options['payment-type'] == 'single'){
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/payumoney.jpg" alt="'.esc_html__('PayU Money','service-finder').'">';
																	}elseif($key == 'payulatam'){
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/payulatam.jpg" alt="'.esc_html__('PayU Latam','service-finder').'">';
																	}else{
																	$label = '<img src="'.get_template_directory_uri().'/inc/images/payment/paypal.jpg" alt="'.esc_html__('paypal','service-finder').'">';
																	}
																	if($value == 1){
																	$paymentflag = 1;
																		if($key == 'payumoney'){
																			if($service_finder_options['payment-type'] == 'single'){
																			echo '<div class="radio">
																					<input id="'.$key.'" type="radio" name="payment_mode" value="'.esc_attr($key).'">
																					<label for="'.$key.'">'.$label.'</label>
																				</div>';	
																			}	
																		}else{
																		
																		echo '<div class="radio">
																					<input id="'.$key.'" type="radio" name="payment_mode" value="'.esc_attr($key).'">
																					<label for="'.$key.'">'.$label.'</label>
																				</div>';	
																		}	
																		
																	}
																}	
																}
																}
																
																if($paymentflag == 0){
																	echo '<div class="sf-alert-bx alert-danger">';
																	echo esc_html__('Payment method not available.', 'service-finder');
																	echo '</div>';
																}
																?>
                    </div>
                  </div>
                  <div id="cardinfo" class="default-hidden">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('Card Number', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                          <input type="text" id="cd_number" name="cd_number" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('CVC', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                          <input type="text" id="cd_cvc" name="cd_cvc" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Month', 'service-finder'); ?>
                        </label>
                        <select id="cd_month" name="cd_month" class="form-control" title="<?php esc_html_e('Select Month', 'service-finder'); ?>">
                          <option value="1"><?php esc_html_e('January', 'service-finder'); ?></option>
                          <option value="2"><?php esc_html_e('February', 'service-finder'); ?></option>
                          <option value="3"><?php esc_html_e('March', 'service-finder'); ?></option>
                          <option value="4"><?php esc_html_e('April', 'service-finder'); ?></option>
                          <option value="5"><?php esc_html_e('May', 'service-finder'); ?></option>
                          <option value="6"><?php esc_html_e('June', 'service-finder'); ?></option>
                          <option value="7"><?php esc_html_e('July', 'service-finder'); ?></option>
                          <option value="8"><?php esc_html_e('August', 'service-finder'); ?></option>
                          <option value="9"><?php esc_html_e('September', 'service-finder'); ?></option>
                          <option value="10"><?php esc_html_e('October', 'service-finder'); ?></option>
                          <option value="11"><?php esc_html_e('November', 'service-finder'); ?></option>
                          <option value="12"><?php esc_html_e('December', 'service-finder'); ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Year', 'service-finder'); ?>
                        </label>
                        <select id="cd_year" name="cd_year" class="form-control"  title="<?php esc_html_e('Select Year', 'service-finder'); ?>">
                          <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.esc_attr($i).'">'.$i.'</option>';
											}
											?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="twocheckoutcardinfo" class="default-hidden">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('Card Number', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                          <input type="text" id="twocheckout_cd_number" name="twocheckout_cd_number" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('CVC', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                          <input type="text" id="twocheckout_cd_cvc" name="twocheckout_cd_cvc" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Month', 'service-finder'); ?>
                        </label>
                        <select id="twocheckout_cd_month" name="twocheckout_cd_month" class="form-control" title="<?php esc_html_e('Select Month', 'service-finder'); ?>">
                          <option value="1"><?php esc_html_e('January', 'service-finder'); ?></option>
                          <option value="2"><?php esc_html_e('February', 'service-finder'); ?></option>
                          <option value="3"><?php esc_html_e('March', 'service-finder'); ?></option>
                          <option value="4"><?php esc_html_e('April', 'service-finder'); ?></option>
                          <option value="5"><?php esc_html_e('May', 'service-finder'); ?></option>
                          <option value="6"><?php esc_html_e('June', 'service-finder'); ?></option>
                          <option value="7"><?php esc_html_e('July', 'service-finder'); ?></option>
                          <option value="8"><?php esc_html_e('August', 'service-finder'); ?></option>
                          <option value="9"><?php esc_html_e('September', 'service-finder'); ?></option>
                          <option value="10"><?php esc_html_e('October', 'service-finder'); ?></option>
                          <option value="11"><?php esc_html_e('November', 'service-finder'); ?></option>
                          <option value="12"><?php esc_html_e('December', 'service-finder'); ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Year', 'service-finder'); ?>
                        </label>
                        <select id="twocheckout_cd_year" name="twocheckout_cd_year" class="form-control"  title="<?php esc_html_e('Select Year', 'service-finder'); ?>">
                          <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.esc_attr($i).'">'.$i.'</option>';
											}
											?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="payulatamcardinfo" class="default-hidden">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('Select Card', 'service-finder'); ?>
                        </label>
                       <select id="payulatam_signup_cardtype" name="payulatam_signup_cardtype" class="form-control"  title="<?php esc_html_e('Select Card', 'service-finder'); ?>">
                          <?php
                          $country = (isset($service_finder_options['payulatam-country'])) ? $service_finder_options['payulatam-country'] : '';
                          $cards = service_finder_get_cards($country);
                          foreach($cards as $card){
                            echo '<option value="'.esc_attr($card).'">'.$card.'</option>';
                          }
                                                    
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('Card Number', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-credit-card"></i>
                          <input type="text" id="payulatam_cd_number" name="payulatam_cd_number" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>
                        <?php esc_html_e('CVC', 'service-finder'); ?>
                        </label>
                        <div class="input-group"> <i class="input-group-addon fa fa-ellipsis-h"></i>
                          <input type="text" id="payulatam_cd_cvc" name="payulatam_cd_cvc" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Month', 'service-finder'); ?>
                        </label>
                        <select id="payulatam_cd_month" name="payulatam_cd_month" class="form-control" title="<?php esc_html_e('Select Month', 'service-finder'); ?>">
                          <option value="01"><?php esc_html_e('January', 'service-finder'); ?></option>
                          <option value="02"><?php esc_html_e('February', 'service-finder'); ?></option>
                          <option value="03"><?php esc_html_e('March', 'service-finder'); ?></option>
                          <option value="04"><?php esc_html_e('April', 'service-finder'); ?></option>
                          <option value="05"><?php esc_html_e('May', 'service-finder'); ?></option>
                          <option value="06"><?php esc_html_e('June', 'service-finder'); ?></option>
                          <option value="07"><?php esc_html_e('July', 'service-finder'); ?></option>
                          <option value="08"><?php esc_html_e('August', 'service-finder'); ?></option>
                          <option value="09"><?php esc_html_e('September', 'service-finder'); ?></option>
                          <option value="10"><?php esc_html_e('October', 'service-finder'); ?></option>
                          <option value="11"><?php esc_html_e('November', 'service-finder'); ?></option>
                          <option value="12"><?php esc_html_e('December', 'service-finder'); ?></option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-select">
                        <label>
                        <?php esc_html_e('Select Year', 'service-finder'); ?>
                        </label>
                        <select id="payulatam_cd_year" name="payulatam_cd_year" class="form-control"  title="<?php esc_html_e('Select Year', 'service-finder'); ?>">
                          <?php
											$year = date('Y');
                                            for($i = $year;$i<=$year+50;$i++){
												echo '<option value="'.esc_attr($i).'">'.$i.'</option>';
											}
											?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div id="signupwiredinfo" class="default-hidden">
                    <div class="col-md-12">
                        <?php
                        $description = (!empty($service_finder_options['wire-transfer-description'])) ? $service_finder_options['wire-transfer-description'] : '';
                        echo $description;
                        ?>
                    </div>
                  </div>
                  <?php
                  $providertermchk = (isset($service_finder_options['terms-condition-checkbox-providers'])) ? esc_attr($service_finder_options['terms-condition-checkbox-providers']) : '';
				  if($providertermchk){
				  ?>
                  <div class="col-md-12">
                    <div class="form-group">
                    <div class="checkbox">
                    <input type="checkbox" value="yes" name="providertermsncondition" id="providertermsncondition">
                    <label for="providertermsncondition">
                    <?php
                    $providerterms = (isset($service_finder_options['text-terms-condition-checkbox-providers'])) ? $service_finder_options['text-terms-condition-checkbox-providers'] : '';	
					$allowedhtml = array(
								'a' => array(
									'href' => array(),
									'class' => array(),
									'target' => array()
								),
							);
					echo wp_kses($providerterms,$allowedhtml); ?>
                    </label>
                  </div>
                  	</div>
                  </div>
                  <?php } ?>
                  <?php echo service_finder_captcha('providersignup'); ?>
                  <div class="col-md-12">
                    <input type="hidden" name="freemode" id="freemode" value="<?php echo ($free || $withoutpackage) ? 'yes' : 'no';?>" />
                    <input type="hidden" name="signup_user_role" value="<?php echo esc_attr($service_finder_ThemeParams['role']['provider']); ?>" />
                    <input type="submit" class="btn btn-primary btn-block" name="user-register" value="<?php esc_html_e('Sign up', 'service-finder'); ?>" />
                  </div>
                  <div class="col-md-12 text-center"> <small><a href="javascript:;" class="loginform">
                    <?php esc_html_e('Already Registered?', 'service-finder'); ?>
                    </a></small> </div>
                </div>
              </form>
              <?php do_action( 'wordpress_social_login' ); ?>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-gray"> </div>
    </div>
    <!-- Forgot Password Template-->
    <div class="modal-content forgotpass-modal hidden">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title">
          <?php esc_html_e('Forgot Password', 'service-finder'); ?>
        </h4>
      </div>
      <div class="modal-body clearfix">
        <div class="row ">
          <form class="forgotpassform" method="post">
            <div class="col-md-12">
              <div class="form-group">
                <div class="input-group"> <i class="input-group-addon fa fa-user"></i>
                  <input name="fp_user_login" id="fp_user_login" type="text" class="form-control" placeholder="<?php esc_html_e('Username or E-mail:', 'service-finder'); ?>">
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" name="action" value="resetpass" />
                <input type="submit" class="btn btn-primary btn-block" name="user-login" value="<?php esc_html_e('Get New Password', 'service-finder'); ?>" />
              </div>
            </div>
            <div class="col-md-12 text-center"> <small><a href="javascript:;" class="regform">
              <?php esc_html_e('Don\'t have an account?', 'service-finder'); ?>
              </a> | <a href="javascript:;" class="loginform">
              <?php esc_html_e('Already Registered?', 'service-finder'); ?>
              </a></small> </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal END-->