<?php
/*
Plugin Name: Service Finder Texonomies
Plugin URI: http://aonetheme.com/
Description: This is a plugin for providers category
Version: 2.3.1
Author: Aonetheme
Author URI: http://aonetheme.com/
*/

if(!class_exists('service_finder_texonomy_plugin')) {
	class service_finder_texonomy_plugin {
		/**
		 * Construct the plugin object
		 */
		public function __construct() {
			
			add_action( 'init', array(&$this, 'service_finder_register_user_taxonomy') );
			
			add_action( 'admin_head', array( &$this, 'service_finder_tax_inline_styles'));
			
			add_action( 'admin_menu', array(&$this, 'service_finder_add_user_category_menu') );
			
			add_action( 'providers-category_add_form_fields', array(&$this, 'service_finder_add_provider_image_field') );
			
			add_action( 'providers-category_edit_form_fields', array(&$this, 'service_finder_service_finder_providers_edit_meta_field') );
			
			add_action( 'edited_providers-category', array(&$this, 'service_finder_save_providers_custom_meta') );
			
			add_action( 'create_providers-category', array(&$this, 'service_finder_save_providers_custom_meta') );
			
			add_action( 'admin_enqueue_scripts', array(&$this, 'service_finder_load_wp_media_files') );
			
		} // END public function __construct
		
		/**
		 * Activate the plugin
		 */
		public static function service_finder_activate() {
			global $wpdb, $service_finder_Tables;

			/*Create object for table name access in theme*/
			$service_finder_Tables = (object) array(
										'providers' =>  'service_finder_providers',
										'services' =>  'service_finder_services',
										'team_members' =>  'service_finder_team_members',
										'bookings' =>  'service_finder_bookings',
										'customers' =>  'service_finder_customers',
										'customers_data' =>  'service_finder_customers_data',
										'booked_services' =>  'service_finder_booked_services',
										'timeslots' =>  'service_finder_timeslots',
										'service_area' =>  'service_finder_service_area',
										'attachments' =>  'service_finder_attachments',
										'invoice' =>  'service_finder_invoice',
										'feedback' =>  'service_finder_feedback',
										'feature' =>  'service_finder_feature',
										'favorites' =>  'service_finder_favorites',
										'newsletter' =>  'service_finder_newsletter',
										'unavailability' =>  'service_finder_unavailability',
										'business_hours' =>  'service_finder_business_hours',
							);
		} // END public static function activate

		/**
		 * Deactivate the plugin
		 */
		public static function service_finder_deactivate() {
			// Do nothing
		} // END public static function deactivate
		
		/*Get User Role By ID*/
		public function service_finder_getrole($userid){
		if($userid > 0){
			$user = new WP_User( $userid );
			return $user->roles[0];
		}	
		}
		
		/*Register Taxonomy*/
		public function service_finder_register_user_taxonomy(){
			global $service_finder_options;
			
			$providerscategoryreplacestring = (!empty($service_finder_options['providers-category-replace-string'])) ? $service_finder_options['providers-category-replace-string'] : 'providers-category';
				 
			$labels = array(
				'name' => esc_html__('Providers Category', 'service-finder'),
				'singular_name' => esc_html__('Providers Category', 'service-finder'),
				'search_items' => esc_html__('Search Providers Categories', 'service-finder'),
				'all_items' => esc_html__('All Providers Categories', 'service-finder'),
				'parent_item' => esc_html__('Parent Providers Category', 'service-finder'),
				'parent_item_colon' => esc_html__('Parent Providers Category', 'service-finder'),
				'edit_item' => esc_html__('Edit Providers Category', 'service-finder'),
				'update_item' => esc_html__('Update Providers Category', 'service-finder'),
				'add_new_item' => esc_html__('Add New Providers Category', 'service-finder'),
				'new_item_name' => esc_html__('New Providers Category Name', 'service-finder'),
				'menu_name' => esc_html__('Providers Category', 'service-finder')
			);
		 
		 	if($providerscategoryreplacestring != ""){
				$catslug = $providerscategoryreplacestring;
			}else{
				$catslug = 'providers-category';
			}	
		 
			$args = array(
				'hierarchical' => true,
				'labels' => $labels,
				'show_ui' => true,
				'show_admin_column' => true,
				'query_var' => true,
				'rewrite' => array( 'slug' => $catslug)
			);
		 
			register_taxonomy( 'providers-category' , array('user') , $args );
			
			//Size for Category Image at Home
			add_image_size( 'service_finder-category-home', 600, 450, true ); 
			
			//Size for Category Image at Home
			add_image_size( 'service_finder-category-small', 60, 60, true ); 
			
			//Size for marker icon
			add_image_size( 'service_finder-marker-icon', 40, 40, true ); 
			
			//Size for category icon
			add_image_size( 'service_finder-category-icon', 80, 80, true ); 
			
			//Size for category icon
			add_image_size( 'service_finder-all-category-icon', 128, 128, true ); 
		}
		
		/*User Category Add Menu*/
		public function service_finder_add_user_category_menu() {
			add_submenu_page( 'users.php' , esc_html__('Providers Category', 'service-finder'), esc_html__('Providers Category', 'service-finder') , 'manage_options',  'edit-tags.php?taxonomy=providers-category' );
		}
		
		/* Add Image Upload to Provider Category Taxonomy */
		public function service_finder_add_provider_image_field() {
			// this will add the custom meta field to the add new term page
			?>
		
		<div class="form-field">
		  <label for="provider_image">
		  <?php esc_html_e( 'Category Image:', 'service-finder' ); ?>
		  </label>
		  <input type="text" name="provider_image[image]" id="provider_image[image]" class="provider-image" value="">
		  <input class="upload_image_button button" name="_add_provider_image" id="_add_provider_image" type="button" value="<?php esc_html_e( 'Select/Upload Image', 'service-finder' ); ?>" />
		</div>
		<div class="form-field">
		  <label for="provider_icon">
		  <?php esc_html_e( 'Category Icon:', 'service-finder' ); ?>
		  </label>
		  <input type="text" name="provider_icon[icon]" id="provider_icon[icon]" class="provider-icon" value="">
		  <input class="upload_image_button button" name="_add_provider_icon" id="_add_provider_icon" type="button" value="<?php esc_html_e( 'Select/Upload Icon', 'service-finder' ); ?>" />
		  <script>
		  // <![CDATA[
			jQuery(document).ready(function() {
				jQuery( '.colorpicker' ).wpColorPicker();
				jQuery('#_add_provider_icon').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.provider-icon').val(attachment.url);
					}
					wp.media.editor.open(this);
					return false;
				});
				jQuery('#_add_provider_image').click(function() {
					wp.media.editor.send.attachment = function(props, attachment) {
						jQuery('.provider-image').val(attachment.url);
					}
					wp.media.editor.open(this);
					return false;
				});
			});
			// ]]>
		</script>
		</div>
        <div class="form-field term-colorpicker-wrap">
            <label for="term-colorpicker"><?php esc_html_e( 'Color:', 'service-finder' ); ?></label>
            <input name="provider_category_color" value="" class="colorpicker" id="term-colorpicker" />
        </div>
        
        <tr class="form-field">
                <th scope="row"><label for="term-colorpicker"><?php esc_html_e( 'Make it Hightlight:', 'service-finder' ); ?></label></th>
                <td>
                    <input type="checkbox" name="provider_category_hightlight" value="yes" id="provider_category_hightlight" />
                </td>
            </tr>
		<?php
		}
		
		// Add Upload fields to "Edit Taxonomy" form
		public function service_finder_service_finder_providers_edit_meta_field($term) {
		 
			// put the term ID into a variable
			$t_id = $term->term_id;
		 
			// retrieve the existing value(s) for this meta field. This returns an array
			$term_meta_image = get_option( "providers-category_image_".$t_id );
			$term_meta_icon = get_option( "providers-category_icon_".$t_id );
			$color = get_term_meta( $t_id, 'provider_category_color', true );
            $color = ( ! empty( $color ) ) ? "{$color}" : '';
			
			$provider_category_hightlight = get_term_meta( $t_id, 'provider_category_hightlight', true );
			?>
            <tr class="form-field">
              <th scope="row" valign="top"><label for="_provider_image">
                <?php esc_html_e( 'Provider Image', 'service-finder' ); ?>
                </label></th>
              <td><?php
                            $providerimage = esc_attr( $term_meta_image ) ? esc_attr( $term_meta_image ) : ''; 
                            ?>
                <input type="text" name="provider_image[image]" id="provider_image[image]" class="provider-image" value="<?php echo esc_attr($providerimage); ?>">
                <input class="upload_image_button button" name="_provider_image" id="_provider_image" type="button" value="<?php esc_html_e( 'Select/Upload Image', 'service-finder' ); ?>" />
              </td>
            </tr>
            <tr class="form-field">
              <th scope="row" valign="top"></th>
              <td class="tax-height-bx"><style>
                            div.img-wrap {
                                background: url('http://placehold.it/960x300') no-repeat center; 
                                background-size:contain; 
                                max-width: 450px; 
                                max-height: 150px; 
                                width: 100%; 
                                height: 100%; 
                                overflow:hidden; 
                            }
                            div.img-wrap img {
                                max-width: 450px;
                            }
                        </style>
                <div class="sf-img-wrap-bx"> <img src="<?php echo esc_url($providerimage); ?>" id="provider-img"> </div>
              </td>
            </tr>
            <tr class="form-field">
              <th scope="row" valign="top"><label for="_provider_icon">
                <?php esc_html_e( 'Provider Icon', 'service-finder' ); ?>
                </label></th>
              <td><?php
                            $providericon = esc_attr( $term_meta_icon ) ? esc_attr( $term_meta_icon ) : ''; 
                            ?>
                <input type="text" name="provider_icon[icon]" id="provider_image[icon]" class="provider-icon" value="<?php echo esc_attr($providericon); ?>">
                <input class="upload_image_button button" name="_provider_icon" id="_provider_icon" type="button" value="<?php esc_html_e( 'Select/Upload Icon', 'service-finder' ); ?>" />
              </td>
            </tr>
            <tr class="form-field">
              <th scope="row" valign="top"></th>
              <td class="tax-height-bx">
                <div class="sf-img-wrap-bx"> <img src="<?php echo esc_url($providericon); ?>" id="provider-icn"> </div>
                <script>
                // <![CDATA[
				jQuery(document).ready(function() {
					jQuery( '.colorpicker' ).wpColorPicker();
					jQuery('#_provider_image').click(function() {
						wp.media.editor.send.attachment = function(props, attachment) {
							jQuery('#provider-img').attr("src",attachment.url)
							jQuery('.provider-image').val(attachment.url)
						}
						wp.media.editor.open(this);
						return false;
					});
					jQuery('#_provider_icon').click(function() {
						wp.media.editor.send.attachment = function(props, attachment) {
							jQuery('#provider-icn').attr("src",attachment.url)
							jQuery('.provider-icon').val(attachment.url)
						}
						wp.media.editor.open(this);
						return false;
					});
				});
				// ]]>
				</script>
              </td>
            </tr>
            <tr class="form-field term-colorpicker-wrap">
                <th scope="row"><label for="term-colorpicker"><?php esc_html_e( 'Color', 'service-finder' ); ?></label></th>
                <td>
                    <input name="provider_category_color" value="<?php echo $color; ?>" class="colorpicker" id="term-colorpicker" />
                </td>
            </tr>
            
            <tr class="form-field">
                <th scope="row"><label for="term-colorpicker"><?php esc_html_e( 'Make it Hightlight', 'service-finder' ); ?></label></th>
                <td>
                    <input type="checkbox" name="provider_category_hightlight" <?php echo ($provider_category_hightlight == 'yes') ? 'checked="checked"' : ''; ?> value="yes" id="provider_category_hightlight" />
                </td>
            </tr>
        
		<?php
		}
		
		//Inline Styles
		public function service_finder_tax_inline_styles() {
		
		?>
		<style>
			div.img-wrap {
				background: url('http://placehold.it/960x300') no-repeat center; 
				background-size:contain; 
				max-width: 450px; 
				max-height: 150px; 
				width: 100%; 
				height: 100%; 
				overflow:hidden; 
			}
			div.img-wrap img {
				max-width: 450px;
			}
			
			.tax-height-bx{ 
				height:150px;
			}
		</style>
		<?php
		
		}
		// Save Taxonomy Image fields callback function.
		public function service_finder_save_providers_custom_meta( $term_id ) {
			if ( isset( $_POST['provider_image'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "providers-category_".$t_id );
				$cat_keys = array_keys( $_POST['provider_image'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['provider_image'][$key] ) ) {
						$term_meta_image = $_POST['provider_image'][$key];
					}
				}
				// Save the option array.
				update_option( "providers-category_image_".$t_id, $term_meta_image );
			}
			
			if ( isset( $_POST['provider_icon'] ) ) {
				$t_id = $term_id;
				$term_meta = get_option( "providers-category_".$t_id );
				$cat_keys = array_keys( $_POST['provider_icon'] );
				foreach ( $cat_keys as $key ) {
					if ( isset ( $_POST['provider_icon'][$key] ) ) {
						$term_meta_icon = $_POST['provider_icon'][$key];
					}
				}
				// Save the option array.
				update_option( "providers-category_icon_".$t_id, $term_meta_icon );
			}
			
			// Save term color if possible
			if( isset( $_POST['provider_category_color'] ) && ! empty( $_POST['provider_category_color'] ) ) {
				update_term_meta( $term_id, 'provider_category_color', $_POST['provider_category_color'] );
			} else {
				delete_term_meta( $term_id, 'provider_category_color' );
			}
			
			// Save term hightlight
			if( isset( $_POST['provider_category_hightlight'] ) && ! empty( $_POST['provider_category_hightlight'] ) ) {
				update_term_meta( $term_id, 'provider_category_hightlight', $_POST['provider_category_hightlight'] );
			} else {
				delete_term_meta( $term_id, 'provider_category_hightlight' );
			}
		}  
		
		/**
		 * Load media files needed for Uploader
		 */
		public function service_finder_load_wp_media_files() {
		  wp_enqueue_media();
		  
		 // Colorpicker Scripts
		 wp_enqueue_script( 'wp-color-picker' );
	
		 // Colorpicker Styles
		 wp_enqueue_style( 'wp-color-picker' );
		}
		



	} // END class booked_plugin
} // END if(!class_exists('service_finder_booking_plugin'))

if(class_exists('service_finder_texonomy_plugin')) {
	
	// Installation and uninstallation hooks
	register_activation_hook(__FILE__, array('service_finder_texonomy_plugin', 'service_finder_activate'));
	register_deactivation_hook(__FILE__, array('service_finder_texonomy_plugin', 'service_finder_deactivate'));

	// instantiate the plugin class
	$service_finder_texonomy_plugin = new service_finder_texonomy_plugin();
}