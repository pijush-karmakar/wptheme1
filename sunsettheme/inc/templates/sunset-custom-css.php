

<h1>Sunset Custom CSS</h1>
<?php settings_errors(); ?>

<form id="sunset-custom-css-form" action="options.php" method="post" class="sunset-general-form">
	<?php settings_fields('sunset-custom-css-options'); ?>
	<?php do_settings_sections('pijush_sunset_css'); ?>
	<?php submit_button(); ?>
</form>