<?php
/*****************************************************************************
*
*	copyright(c) - aonetheme.com - Service Finder Team
*	More Info: http://aonetheme.com/
*	Coder: Service Finder Team
*	Email: contact@aonetheme.com
*
******************************************************************************/

/*Load more categories on home page for version 1*/
add_action('wp_ajax_load_more_providers', 'service_finder_load_more_providers');
add_action('wp_ajax_nopriv_load_more_providers', 'service_finder_load_more_providers');

function service_finder_load_more_providers(){
global $wpdb, $service_finder_options, $service_finder_Tables;

					$getoffset = (!empty($_POST['offset'])) ? $_POST['offset'] : '';
					$getlimit = (!empty($_POST['limit'])) ? $_POST['limit'] : '';
					$getcatid = (!empty($_POST['catid'])) ? $_POST['catid'] : '';
					$featured = (!empty($_POST['featured'])) ? $_POST['featured'] : '';
					$getlocation = (!empty($_POST['location'])) ? $_POST['location'] : '';
					$getorderby = (!empty($_POST['orderby'])) ? $_POST['orderby'] : '';
					$getviewtype = (!empty($_POST['viewtype'])) ? $_POST['viewtype'] : '';
					$limit = $getlimit;
					
					$newoffset = $getoffset + $limit;
					
					$providersInfoArr = service_finder_get_providers($getcatid,$getlocation,$featured,$getorderby,$limit,$getoffset);
					
					$providersInfo = $providersInfoArr['srhResult'];
					$count = $providersInfoArr['count'];
					
					
$srhcontent = '';
$viewtype = $getviewtype;

	$markers = '';
	if(!empty($providersInfo)){ 
	
	foreach($providersInfo as $provider){

	$userLink = service_finder_get_author_url($provider->wp_user_id);

	if(!empty($provider->avatar_id) && $provider->avatar_id > 0){
		$src  = wp_get_attachment_image_src( $provider->avatar_id, 'service_finder-provider-thumb' );
		$src  = $src[0];
	}else{
		$src  = service_finder_get_default_avatar();
	}
	$icon = service_finder_getCategoryIcon($getcatid);
	if($icon == ""){
	$icon = (!empty($service_finder_options['default-map-marker-icon']['url'])) ? $service_finder_options['default-map-marker-icon']['url'] : '';
	}

	$link = $userLink;
	$current_user = wp_get_current_user(); 
	if(is_user_logged_in()){
		$myfav = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$service_finder_Tables->favorites.' where user_id = %d AND provider_id = %d',$current_user->ID,$provider->wp_user_id));
		
		if(!empty($myfav)){
		if(service_finder_themestyle_for_plugin() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="remove-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="remove-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'My Favorite', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}else{
		if(service_finder_themestyle_for_plugin() == 'style-2'){
		$addtofavorite = '<a href="javascript:;" class="add-favorite sf-featured-item" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a href="javascript:;" class="add-favorite btn btn-primary" data-proid="'.esc_attr($provider->wp_user_id).'" data-userid="'.esc_attr($current_user->ID).'">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
		}
	}else{
		if(service_finder_themestyle_for_plugin() == 'style-2'){
		$addtofavorite = '<a class="sf-featured-item" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal"><i class="fa fa-heart-o"></i></a>';
		}else{
		$addtofavorite = '<a class="btn btn-primary" href="javascript:;" data-action="login" data-redirect="no" data-toggle="modal" data-target="#login-Modal">'.esc_html__( 'Add to Fav', 'service-finder' ).'<i class="fa fa-heart"></i></a>';
		}
	}
            if(service_finder_is_featured($provider->wp_user_id)){
			if(service_finder_themestyle_for_plugin() == 'style-2'){
			$featured = '<div  class="sf-featured-sign">'.esc_html__( 'Featured', 'service-finder' ).'</div>';
			}else{
			$featured = '<strong class="sf-featured-label"><span>'.esc_html__( 'Featured', 'service-finder' ).'</span></strong>';
			}
			}else{
			$featured = '';
			}
			
			$addressbox = '';
			$showaddressinfo = (isset($service_finder_options['show-address-info'])) ? esc_attr($service_finder_options['show-address-info']) : '';
	  if($showaddressinfo && $service_finder_options['show-postal-address']){
			if(service_finder_themestyle_for_plugin() == 'style-2'){
			$addressbox = service_finder_getshortAddress($provider->wp_user_id);			
			}else{
			$addressbox = '<div class="overlay-text">
									<div class="sf-address-bx">
										<i class="fa fa-map-marker"></i>
										'.service_finder_getshortAddress($provider->wp_user_id).'
									</div>
								</div>';
			}	
		}
		
		$chkclass = '';
		$prometa = '';
		if(class_exists('service_finder_booking_plugin')){
		$chkclass = service_finder_check_varified($provider->wp_user_id);
		
		$prometa = service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile);
		$prometa .= service_finder_check_varified_icon($provider->wp_user_id);
		$prometa .= service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id));
		}
		
			$viewtype =  $getviewtype;
			if($viewtype == 'grid-4'){
			
			/*4 colomn layout*/
			if(service_finder_themestyle_for_plugin() == 'style-2'){
			
			$srhcontent .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			
			}else{
            $srhcontent .= '<div class="col-md-3 col-sm-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.$chkclass.'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.$prometa.'
							'.$checkedicon.'
							'.$prorating.'
                            
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';
			}
			}elseif($viewtype == 'listview'){
			if($src != ''){
				$imgtag = '<img src="'.esc_url($src).'" width="600" height="350" alt="">';
			}else{
				$imgtag = '';
			}
			/*List view layout*/
			 if(service_finder_themestyle_for_plugin() == 'style-2'){
			$srhcontent .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			
			}else{
			$srhcontent .= '<div class="col-md-12">
                                <div class="sf-element-bx result-listing clearfix '.$chkclass.'">
                                
                                    <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                                        
                                        <div class="overlay-bx">
											'.$addressbox.'
										</div>
										
										<strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
										'.$featured.'
                                        
                                    </div>
                                    
                                    <div class="result-text" id="proid-'.$provider->wp_user_id.'">
                                    	<h5 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h5>
                                        <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
										'.$prometa.'
                                        <div class="sf-address2-bx">
											<i class="fa fa-map-marker"></i>
											'.service_finder_getshortAddress($provider->wp_user_id).'
										</div>
										<p>'.service_finder_getExcerpts($provider->bio,0,300).'</p>
                                        '.$addtofavorite.'
										
                                    </div>
                                    
                                </div>
                            </div>';
			}				
			}elseif($viewtype == 'grid-3'){
			/*3 colomn layout*/
			if(service_finder_themestyle_for_plugin() == 'style-2'){
			$srhcontent .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			
			}else{
            $srhcontent .= '<div class="col-md-4 col-sm-6 equal-col">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.$chkclass.'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.$prometa.'
							'.$checkedicon.'
							'.$prorating.'	
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
				}			
			}elseif($viewtype == 'grid-2'){
			/*3 colomn layout*/
            if(service_finder_themestyle_for_plugin() == 'style-2'){
			$srhcontent .= '<div class="col-md-6 col-sm-6 equal-col maphover" data-id="'.esc_attr($provider->wp_user_id).'">
                                <div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,60).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
                            </div>';
			
			}else{
			$srhcontent .= '<div class="col-md-6 col-sm-6 equal-col">
                                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.$chkclass.'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,30).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.$prometa.'
							'.$checkedicon.'
							'.$prorating.'
                            
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>
                            </div>';
			}				
			}else{
			
			/*4 colomn layout*/
			if(service_finder_themestyle_for_plugin() == 'style-2'){
			
			$srhcontent .= '<div class="col-md-3 col-sm-6 equal-col">
			<div class="sf-search-result-girds" id="proid-'.$provider->wp_user_id.'">
                            
                                <div class="sf-featured-top">
                                    <div class="sf-featured-media" style="background-image:url('.esc_url($src).')"></div>
                                    <div class="sf-overlay-box"></div>
                                    <span class="sf-categories-label"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></span>
                                    '.service_finder_check_varified_icon($provider->wp_user_id).'
									'.$addtofavorite.'
                                    
                                    <div class="sf-featured-info">
                                        '.$featured.'
                                        <div  class="sf-featured-provider">'.service_finder_getExcerpts($provider->full_name,0,35).'</div>
                                        <div  class="sf-featured-address"><i class="fa fa-map-marker"></i> '.$addressbox.' </div>
                                        '.service_finder_displayRating(service_finder_getAverageRating($provider->wp_user_id)).'
                                    </div>
									<a href="'.esc_url($link).'" class="sf-profile-link"></a>
                                </div>
                                
                                <div class="sf-featured-bot">
                                    <div class="sf-featured-comapny">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</div>
                                    <div class="sf-featured-text">'.service_finder_getExcerpts(nl2br(stripcslashes($provider->bio)),0,75).'</div>
                                    '.service_finder_show_provider_meta($provider->wp_user_id,$provider->phone,$provider->mobile).'
                                </div>
                                
                            </div>
							 </div>';
			
			}else{
            $srhcontent .= '<div class="col-md-3 col-sm-6 equal-col">

                <div class="sf-provider-bx item">
                    <div class="sf-element-bx">
                    
                        <div class="sf-thum-bx sf-listing-thum img-effect2" style="background-image:url('.esc_url($src).');"> <a href="'.esc_url($link).'" class="sf-listing-link"></a>
                            
							<div class="overlay-bx">
								'.$addressbox.'
							</div>
                            
                            <strong class="sf-category-tag"><a href="'.esc_url(service_finder_getCategoryLink(get_user_meta($provider->wp_user_id,'primary_category',true))).'">'.service_finder_getCategoryName(get_user_meta($provider->wp_user_id,'primary_category',true)).'</a></strong>
							'.$featured.'
                            
                        </div>
                        
                        <div class="padding-20 bg-white '.$chkclass.'">
                            <h4 class="sf-title">'.service_finder_getExcerpts(service_finder_getCompanyName($provider->wp_user_id),0,20).'</h4>
                            <strong class="sf-company-name"><a href="'.esc_url($link).'">'.service_finder_getExcerpts($provider->full_name,0,35).'</a></strong>
							'.$prometa.'
							'.$checkedicon.'
							'.$prorating.'
                            
                        </div>
                        
                        <div class="btn-group-justified" id="proid-'.$provider->wp_user_id.'">
                          <a href="'.esc_url($link).'" class="btn btn-custom">'.esc_html__('Full View','service-finder').' <i class="fa fa-arrow-circle-o-right"></i></a>
                          '.$addtofavorite.'
                        </div>
                        
                    </div>
                </div>

            </div>';
			}
			}

     }

	}else{
	/*No result found*/
		$srhcontent .= '<div class="sf-nothing-found">
				<strong class="sf-tilte">'.esc_html__('Nothing Found', 'service-finder').'</strong>
					  <p>'.esc_html__('Apologies, but no results were found for the request.', 'service-finder').'</p>
				</div>';
	
	}
		
		
		echo $srhcontent;
		?>
						
		

<?php if($count > $newoffset){ ?>
		<div class="show_more_main_providers clear" id="show_more_main_providers<?php echo esc_attr($newoffset); ?>"> 
        <span id="<?php echo esc_attr($provider->wp_user_id); ?>" data-catid="<?php echo esc_attr($getcatid) ?>" data-featured="<?php echo esc_attr($featured) ?>" data-limit="<?php echo esc_attr($limit) ?>" data-orderby="<?php echo esc_attr($getorderby) ?>" data-viewtype="<?php echo esc_attr($getviewtype) ?>" data-location="<?php echo esc_attr($getlocation) ?>" data-offset="<?php echo esc_attr($newoffset); ?>" class="show_more_providers btn btn-primary" title="Load more providers">
        <i class="fa fa-refresh"></i> <?php echo esc_html__('Show more','service-finder') ?></span> 
        <span class="lodingproviders default-hidden"><span class="loding_txt btn btn-default"><i class="fa fa-refresh fa-spin"></i></span></span> 
        </div>

<?php } 
	
exit;
}