<?php

// Default options values
$sa_options = array(
	'footer_text' => '',
	'intro_text' => '',
);

if ( is_admin() ) : // Load only if we are viewing an admin page

function sa_register_settings() {
	// Register settings and call sanitation functions
	register_setting( 'sa_theme_options', 'sa_options', 'sa_validate_options' );
}

add_action( 'admin_init', 'sa_register_settings' );
add_action( 'admin_init', 'include_scripts' );

function sa_theme_options() {
	// Add theme options page to the addmin menu
	add_theme_page( 'Theme Options', 'Theme Options', 'edit_theme_options', 'theme_options', 'sa_theme_options_page' );
}

add_action( 'admin_menu', 'sa_theme_options' );

// Function to generate options page
function sa_theme_options_page() {?>
<script type = "text/javascript" src = "<?php echo get_bloginfo('template_directory')?>/js/jquery.min.js" ></script>
<?php
	global $sa_options, $sa_categories, $sa_layouts;

	if ( ! isset( $_REQUEST['updated'] ) )
		$_REQUEST['updated'] = false; // This checks whether the form has just been submitted. ?>

<div class="wrap snapycode_wrap">
  <?php screen_icon(); echo "<h2>" . get_current_theme() . __( ' Theme Options' ) . "</h2>";
	// This shows the page's name and an icon if one has been provided ?>
  <?php if ( false !== $_REQUEST['updated'] ) : ?>
  <div class="updated fade">
    <p><strong>
      <?php _e( 'Options saved' ); ?>
      </strong></p>
  </div>
  <?php endif; // If the form has just been submitted, this shows the notification ?>
  <div class="themesettingpage" id="poststuff">
    <form method="post" action="options.php">
      <?php $settings = get_option( 'sa_options', $sa_options ); ?>
      <?php settings_fields( 'sa_theme_options' );?>
      <div class="wpsm_tabs">
        <ul>
          <li><a href="#tabs-general">General Settings</a></li>
          <li><a href="#tabs-footer">Footer Settings</a></li>
        </ul>
        <div id="tabs-general"><!-- General tab -->
          <div class="postbox">
            <h3><span>General Settings</span></h3>
            <div class="inside">
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_header_logo" class="wpsm_level">Header Logo</label>
                </p>
                <input class="wpsm_header_logo" type="text" size="50" name="sa_options[header_logo]" 
                           value="<?php echo esc_attr($settings['header_logo']); ?>" />
                <input id="header_logo" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['header_logo']) && !empty($settings['header_logo'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['header_logo'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_header_image" class="wpsm_level">Header Right Side Image</label>
                </p>
                <input class="wpsm_header_image" type="text" size="50" name="sa_options[header_img]" 
                           value="<?php echo esc_attr($settings['header_img']); ?>" />
                <input id="header_image" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['header_img']) && !empty($settings['header_img'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['header_img'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              
              
              <div class="postarea">
                <p class="stat">
                  <label for="shoplink" class="wpsm_level">Shop page link</label>
                </p>
                <input type="text" name="sa_options[shoplink]" id="shoplink" value="<?php echo stripslashes($settings['shoplink']); ?>" />
	              </div>
                  
                  <div class="postarea">
                <p class="stat">
                  <label for="contactlink" class="wpsm_level">Contact page link</label>
                </p>
                <input type="text" name="sa_options[contactlink]" id="contactlink" value="<?php echo stripslashes($settings['contactlink']); ?>" />
	              </div>
                  
                  <div class="postarea">
                <p class="stat">
                  <label for="blogsidebartitle" class="wpsm_level">Blog Sidebar Title</label>
                </p>
                <input type="text" name="sa_options[blogsidebartitle]" id="blogsidebartitle" value="<?php echo stripslashes($settings['blogsidebartitle']); ?>" />
	              </div>
                  
                  <div class="postarea">
                <p class="stat">
                  <label for="recipesidebartitle" class="wpsm_level">Recipe Sidebar Title</label>
                </p>
                <input type="text" name="sa_options[recipesidebartitle]" id="recipesidebartitle" value="<?php echo stripslashes($settings['recipesidebartitle']); ?>" />
	              </div>
            </div>
          </div>
        </div>
        <!-- General tab ends --> 
        
        <!-- Social tab ends -->
        
        <div id="tabs-footer"><!-- General tab -->
          <div class="postbox">
            <h3><span>Footer Settings</span></h3>
            <div class="inside">
              <div class="postarea">
                <p class="stat">
                  <label for="footerlefttxt" class="wpsm_level">Footer Left Side Text</label>
                </p>
                <textarea name="sa_options[footerlefttxt]" id="footerlefttxt"><?php echo stripslashes($settings['footerlefttxt']); ?></textarea>
	              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_footer_logo" class="wpsm_level">Footer Logo</label>
                </p>
                <input class="wpsm_footer_logo" type="text" size="50" name="sa_options[footer_logo]" 
                           value="<?php echo esc_attr($settings['footer_logo']); ?>" />
                <input id="footer_logo" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['footer_logo']) && !empty($settings['footer_logo'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['footer_logo'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="futitle" class="wpsm_level">Follow Us Title</label>
                </p>
                <input type="text" name="sa_options[futitle]" id="futitle" value="<?php echo stripslashes($settings['futitle']); ?>" />
	              </div>
                  <div class="postarea">
                <p class="stat">
                  <label for="wpsm_fblimg" class="wpsm_level">Footer Facebook logo</label>
                </p>
                <input class="wpsm_fblimg" type="text" size="50" name="sa_options[fblimg]" 
                           value="<?php echo esc_attr($settings['fblimg']); ?>" />
                <input id="fblimg" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['fblimg']) && !empty($settings['fblimg'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['fblimg'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="foofaburl" class="wpsm_level">Footer Facebook Url</label>
                </p>
                <input type="text" name="sa_options[foofaburl]" id="foofaburl" value="<?php echo stripslashes($settings['foofaburl']); ?>" />
                </div>
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_finimg" class="wpsm_level">Footer Instagram Logo</label>
                </p>
                <input class="wpsm_finimg" type="text" size="50" name="sa_options[finimg]" 
                           value="<?php echo esc_attr($settings['finimg']); ?>" />
                <input id="finimg" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['finimg']) && !empty($settings['finimg'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['finimg'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="fooinsurl" class="wpsm_level">Footer Instagram Url</label>
                </p>
                <input type="text" name="sa_options[fooinsurl]" id="fooinsurl" value="<?php echo stripslashes($settings['fooinsurl']); ?>" />
               </div>
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_flnimg" class="wpsm_level">Footer Linked In Logo</label>
                </p>
                <input class="wpsm_flnimg" type="text" size="50" name="sa_options[flnimg]" 
                           value="<?php echo esc_attr($settings['flnimg']); ?>" />
                <input id="flnimg" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['flnimg']) && !empty($settings['flnimg'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['flnimg'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="foolinurl" class="wpsm_level">Footer Linked In Url</label>
                </p>
                <input type="text" name="sa_options[foolinurl]" id="foolinurl" value="<?php echo stripslashes($settings['foolinurl']); ?>" />
               </div>
              <div class="postarea">
                <p class="stat">
                  <label for="wpsm_femimg" class="wpsm_level1">Footer Email Logo</label>
                </p>
                <input class="wpsm_femimg" type="text" size="50" name="sa_options[femimg]" 
                           value="<?php echo esc_attr($settings['femimg']); ?>" />
                <input id="femimg" class="wpsm_image_upload button" type="button" value="Upload Image" />
                <?php if(isset($settings['femimg']) && !empty($settings['femimg'])){ 
						  	 		echo '<p class="stat"><img src="'.$settings['femimg'].'" height="100px"></p>'; 
						   		}
						   ?>
              </div>
              <div class="postarea">
                <p class="stat">
                  <label for="fooemurl" class="wpsm_level">Footer Email Url</label>
                </p>
                <input type="text" name="sa_options[fooemurl]" id="fooemurl" value="<?php echo stripslashes($settings['fooemurl']); ?>" />
               </div>
               
               <div class="postarea">
                <p class="stat">
                  <label for="footercopytxt" class="wpsm_level">Footer copy right Text</label>
                </p>
                <textarea name="sa_options[footercopytxt]" id="footercopytxt"><?php echo stripslashes($settings['footercopytxt']); ?></textarea>
	              </div>
            </div>
          </div>
        </div>
        <div class="postarea">
          <input type="submit" class="button button-primary" value="Save Settings" />
        </div>
      </div>
      <!-- tab ends -->
      
    </form>
  </div>
</div>
<?php
}

function sa_validate_options( $input ) {
	global $sa_options, $sa_categories, $sa_layouts;

	$settings = get_option( 'sa_options', $sa_options );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['footer_copyright'] = wp_filter_nohtml_kses( $input['footer_copyright'] );
	
	// We strip all tags from the text field, to avoid vulnerablilties like XSS
	$input['intro_text'] = wp_filter_post_kses( $input['intro_text'] );
	
	return $input;
}

endif;  // EndIf is_admin()

/**
 * Function to include scripts
 */
function include_scripts()
{
 $curl = $_SERVER['QUERY_STRING'];
 if($curl == "page=theme_options" || $curl == "page=theme_options&settings-updated=true"){
 wp_enqueue_script('jquery.min.js', 'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js');
 }
 wp_enqueue_script('jquery-ui-tabs');
 wp_enqueue_style('jquery.ui.theme', get_bloginfo('template_directory') . '/css/theme-option.min.css');
 
 if( $_GET['page'] == 'theme_options' )
 {
  wp_enqueue_media(); //support media upload
 }
 //http://code.jquery.com/jquery-2.2.2.min.js
 wp_enqueue_script('logotoday_admin_js', get_bloginfo('template_directory') . '/js/themesetting_admin.js');
}
