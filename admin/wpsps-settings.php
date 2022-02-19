<?php
//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}
?>
<?php settings_errors(); ?>
<div class="wpsps-container">
	<div class="wpsps-main">
		<form method="POST" action="options.php" class="xoo-cp-form">
			<?php settings_fields('wpsps_group'); ?>
			<?php do_settings_sections('wpsps'); ?>
			<?php submit_button(); ?>
		</form>
	</div>
	<div class="wpsps-about">
		<img src="<?php echo WPSPS_URL. '/assets/img/icon.png'?>" alt="">
		<p><strong>About:</strong> WP Simple Post Slider, will create a beautiful slideshow automatically populated with the posts you add on your Wordpress Website. </p>
		<p><strong>Posts:</strong> This is the number of posts that will appear on the slider automatically, order default by date. Image shown on sliders are taking automatically from featured image, recommended size for image aprox: 1350x556 px. Slider is fully responsive.</p>
		<p><strong>Themes:</strong> 3 themes, basic will adjust to your site’s styles with square corners, simple will have some styles and round corners, advance it’s fancy with animations, ken burns and round corners.</p>
		<p><strong>Categories:</strong> The category you select here with the posts within that category will appear in slider, otherwise the slider will show posts from all categories automatically.</p>
		<p><strong>Short Code:</strong> Add this shortcode in your wordpress theme where you wish WP Simple Post Slider to appear.</p>
		<p class="wpsps-about_version">version <?php echo WPSPS_VERSION;?></p>
	</div>

	<div class="xoo-sidebar">
		<?php //require_once XOO_CP_PATH.'/admin/xoo-cp-sidebar.php'; ?>
	</div>
</div>

