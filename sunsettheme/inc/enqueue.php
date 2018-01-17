<?php

/*
  @package sunsettheme

		  ===============================
		      Admin enqueue Scripts
		  ===============================

*/




function sunset_load_admin_scripts($hook){
	//echo $hook;

 if('toplevel_page_pijush_sunset' == $hook){
	  
	wp_register_style('sunset-admin',get_template_directory_uri().'/css/sunset.admin.css',array(),'1.0.0','all' );
	wp_enqueue_style('sunset-admin');


    wp_enqueue_media();
	wp_register_script('sunset-admin-script',get_template_directory_uri().'/js/sunset.admin.js',array('jquery'),'1.0.0',true );
	wp_enqueue_script('sunset-admin-script');
          }

  elseif ('sunset_page_pijush_sunset_css' == $hook) {

    wp_enqueue_style('ace',get_template_directory_uri().'/css/sunset.ace.css',array(),'1.0.0','all' );  	
	wp_enqueue_script('ace-js',get_template_directory_uri().'/js/ace/ace.js',array('jquery'),'1.2.1',true );
	wp_enqueue_script('sunset-custom-css-script',get_template_directory_uri().'/js/sunset_custom_css.js',array('jquery'),'1.0.0',true );

          }      

    else{ return; }



}

add_action('admin_enqueue_scripts','sunset_load_admin_scripts');

/*

		  ===============================
		      Front-end enqueue Scripts
		  ===============================

*/

function sunset_load_scripts(){
	 wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css',array(),'4.0.0','all' );
	 wp_enqueue_style('sunset-css',get_template_directory_uri().'/css/sunset.css',array(),'1.0.0','all' );

	 wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway:200,300,500' );

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery',get_template_directory_uri().'/js/jquery.js',false,'1.12.4',true );

    wp_enqueue_script('jquery') ;
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),'4.0.0',true );


}

add_action('wp_enqueue_scripts','sunset_load_scripts');


?>
