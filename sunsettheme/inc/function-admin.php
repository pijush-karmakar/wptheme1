
<?php

/*

  @package sunsettheme

		  ====================
		      Admin Page
		  ====================

*/


function sunset_add_admin_page(){
	// Generate sunset Admin page

	add_menu_page('Sunset Theme Options','Sunset','manage_options','pijush_sunset','sunset_theme_create_page',get_template_directory_uri().'/img/sunset-icon.png',110   );

	// Generate sunset Admin submenu page

	add_submenu_page('pijush_sunset','Sunset Sidebar Options','Sidebar','manage_options','pijush_sunset','sunset_theme_create_page');

	add_submenu_page('pijush_sunset','Sunset Contact Form','Contact Form','manage_options','pijush_sunset_contact_form','sunset_contact_form_page');

	add_submenu_page('pijush_sunset','Sunset Theme Options','Theme Options','manage_options','pijush_sunset_theme','sunset_theme_support_page');

	add_submenu_page('pijush_sunset','Sunset CSS Options','Custom CSS','manage_options','pijush_sunset_css','sunset_theme_settings_page');

}


add_action('admin_menu','sunset_add_admin_page');

// Activate Custom Settings
add_action('admin_init','sunset_custom_settings');

function sunset_custom_settings(){
	// Sidebar Settings option  // 

	register_setting('sunset-settings-group','profile_picture');
	register_setting('sunset-settings-group','first_name');
	register_setting('sunset-settings-group','last_name');
	register_setting('sunset-settings-group','user_description');
	register_setting('sunset-settings-group','twitter_handler','sunset_sanitize_twitter_handler');
	register_setting('sunset-settings-group','facebook_handler');
	register_setting('sunset-settings-group','gplus_handler');

	add_settings_section('sunset-sidebar-options','Sidebar Options','sunset_sidebar_options','pijush_sunset');

	add_settings_field('sidebar-profile','Profile Picture','sunset_sidebar_profile','pijush_sunset','sunset-sidebar-options');
	add_settings_field('sidebar-name','Full Name','sunset_sidebar_name','pijush_sunset','sunset-sidebar-options');
	add_settings_field('sidebar-description','Description','sunset_sidebar_description','pijush_sunset','sunset-sidebar-options');

	add_settings_field('sidebar-twitter','Twitter Handler','sunset_sidebar_twitter','pijush_sunset','sunset-sidebar-options');
	add_settings_field('sidebar-facebook','Facebook Handler','sunset_sidebar_facebook','pijush_sunset','sunset-sidebar-options');
	add_settings_field('sidebar-gplus','Google+ Handler','sunset_sidebar_gplus','pijush_sunset','sunset-sidebar-options');

	// Theme support option //
	register_setting('sunset-theme-support','post_formats');
	register_setting('sunset-theme-support','custom_header');
	register_setting('sunset-theme-support','custom_background');

    add_settings_section('sunset-theme-options','Theme Options','sunset_theme_options','pijush_sunset_theme');

   add_settings_field('post-formats','Post Formats','sunset_post_formats','pijush_sunset_theme','sunset-theme-options');
   add_settings_field('custom-header','Custom Header','sunset_custom_header','pijush_sunset_theme','sunset-theme-options');
   add_settings_field('custom-background','Custom Background','sunset_custom_background','pijush_sunset_theme','sunset-theme-options');

   // Contact form option
   register_setting('sunset-contact-options','activate_contact');
   add_settings_section('sunset-contact-section','Contact Form','sunset_contact_section','pijush_sunset_contact_form');
   add_settings_field('activate-form','Contact Form','sunset_contact_form','pijush_sunset_contact_form','sunset-contact-section');

   // Custom CSS  option
   register_setting('sunset-custom-css-options','sunset_custom_css','sunset_sanitize_custom_css');
   add_settings_section('sunset-custom-css-section','Insert Your Custom CSS','sunset_custom_css_section_callback','pijush_sunset_css');
   add_settings_field('custom-css','Custom CSS','sunset_custom_css_callback','pijush_sunset_css','sunset-custom-css-section'); 


}



// Theme and Contact  --> Section callback function

function sunset_custom_css_section_callback(){
	echo 'Customize Sunset Theme your own CSS';
}

function sunset_contact_section(){
	echo 'Activate and Deactivate Contact Form';
}

function sunset_theme_options(){
	echo 'Activate and Deactivate specific theme support options';
}


// Theme support / contact / Custom CSS  --> settings field callback function

function sunset_custom_css_callback(){
    $css = get_option( 'sunset_custom_css' ) ;
	$css = ( empty($css) ? '/* Sunset Theme Custom CSS */' : $css );
    echo '<div id="customCSS">'.$css.'</div><textarea id="sunset_custom_css" name="sunset_custom_css" style="display:none;visibility:hidden;">'.$css.'</textarea>';
}

function sunset_contact_form(){
	$option = get_option( 'activate_contact' ) ;
	$checked = ( @$option == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' >Activate Contact Form </label><br>';
}

function sunset_post_formats(){
	$option = get_option( 'post_formats' ) ;
	$formats = array('aside','gallery','link','image','quote','status','video','audio','chat');
	$output = '';
	foreach ($formats as $format) {
		$checked = ( @$option[$format] == 1 ? 'checked' : '' );
		$output .='<label> <input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.' >'.$format.' </label><br>';
	}
	echo $output;
}

function sunset_custom_header(){
	$option = get_option( 'custom_header' ) ;
	$checked = ( @$option == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' >Activate Custom Header </label><br>';	
}

function sunset_custom_background(){
	$option = get_option( 'custom_background' ) ;
	$checked = ( @$option == 1 ? 'checked' : '' );
    echo '<label> <input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' >Activate Custom Background </label><br>';	
}


// sidebar section callback function

function sunset_sidebar_options(){
	echo 'Customize your sidebar';
}


// sidebar Settings field callback function

function sunset_sidebar_profile(){
	$profile = esc_attr(get_option('profile_picture') );
	if( empty($profile) ){
       echo '<button type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button"><span class="sunset-icon-button dashicons-before dashicons-format-image"></span> Upload Profile Picture</button> <input type="hidden" id="profile_picture" name="profile_picture" value=""/> ';
	}
	else{
		echo ' <button type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button"><span class="sunset-icon-button dashicons-before dashicons-format-image"></span> Replace Profile Picture </button><input type="hidden" id="profile_picture" name="profile_picture" value="'.$profile.'"/> 
        <button type="button" class="button button-secondary" id="remove-picture" value="Remove">
        <span class="sunset-icon-button dashicons-before dashicons-no"></span> Remove </button> ';
	}
    
}

function sunset_sidebar_name(){
	$first_name = esc_attr(get_option('first_name') );
	$last_name = esc_attr(get_option('last_name') );

  echo '<input type="text" name="first_name" value="'.$first_name.'" placeholder="First Name" /> <input type="text" name="last_name" value="'.$last_name.'" placeholder="Last Name" />';	

}

function sunset_sidebar_description(){
	$description = esc_attr(get_option('user_description') );
    echo '<input type="text" class="regular-text" name="user_description" value="'.$description.'" placeholder="description" />  <p class="description">Write some description smartly</p>';
}

function sunset_sidebar_twitter(){
		$twitter = esc_attr(get_option('twitter_handler') );
       echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="twitter handler" />
       <p class="description">Input your twitter username without the @ character</p>
       ';
}

function sunset_sidebar_facebook(){
		$facebook = esc_attr(get_option('facebook_handler') );
       echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="facebook handler" />';
}

function sunset_sidebar_gplus(){
		$gplus = esc_attr(get_option('gplus_handler') );
       echo '<input type="text" name="gplus_handler" value="'.$gplus.'" placeholder="google+ handler" />';
}



// Sanitize text ...........

function sunset_sanitize_twitter_handler($input){
	$output = sanitize_text_field($input);
	$output = str_replace('@', '', $output);
    return $output;
}

function sunset_sanitize_custom_css($input){
	$output = esc_textarea($input);
    return $output;
}


// Template submenu callback Functions

function sunset_theme_create_page(){
    require_once(get_template_directory().'/inc/templates/sunset-admin.php' );

}

function sunset_theme_support_page(){
	require_once( get_template_directory().'/inc/templates/sunset-theme-support.php' );
}

function sunset_contact_form_page(){
   require_once( get_template_directory().'/inc/templates/sunset-contact-form.php' );	
}


function sunset_theme_settings_page(){
     require_once(get_template_directory().'/inc/templates/sunset-custom-css.php' );
}











?>