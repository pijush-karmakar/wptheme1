
<h1>Sunset Sidebar Options</h1>
<?php settings_errors(); ?>

<?php 
    $profile = esc_attr(get_option('profile_picture') );
	$first_name = esc_attr(get_option('first_name') );
	$last_name = esc_attr(get_option('last_name') );
    $full_name = $first_name.' '.$last_name;
    $description = esc_attr(get_option('user_description') );

    $twitter_icon = esc_attr( get_option( 'twitter_handler' ) );
	$facebook_icon = esc_attr( get_option( 'facebook_handler' ) );
	$gplus_icon = esc_attr( get_option( 'gplus_handler' ) );

 ?>

<div class="sunset-sidebar-preview">
	<div class="sunset-sidebar">
		<div class="image-container">
			<div id="profile-picture-preview" class="profile-picture" style="background-image:url(<?php print $profile; ?>); ">
				
			</div>
		</div>
		<h1 class="sunset-username"><?php print $full_name; ?></h1>
		<h2 class="sunset-description"><?php print $description; ?></h2>
		<div class="icon-wrapper">
			<?php if( !empty( $twitter_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-twitter"></span>
			<?php endif; 
			if( !empty( $gplus_icon ) ): ?>
				<span class="sunset-icon-sidebar sunset-icon-sidebar--gplus dashicons-before dashicons-googleplus"></span>
			<?php endif; 
			if( !empty( $facebook_icon ) ): ?>
				<span class="sunset-icon-sidebar dashicons-before dashicons-facebook-alt"></span>
			<?php endif; ?>
		</div>
	</div>
</div>



<form action="options.php" method="post" class="sunset-general-form">
	<?php settings_fields('sunset-settings-group'); ?>
	<?php do_settings_sections('pijush_sunset'); ?>
	<?php submit_button('Settings Saved','primary','btnsaved'); ?>
</form>