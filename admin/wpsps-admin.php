<?php
/**
 ========================
      ADMIN SETTINGS
 ========================
 */

//Exit if accessed directly
if(!defined('ABSPATH')){
	return;
}

// Enqueue Scripts & Stylesheet
function wpsps_admin_enqueue($hook){

	wp_enqueue_style('wpsps-admin-css',WPSPS_URL.'/assets/css/wpsps-admin-css.css',null,WPSPS_VERSION);
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('wpsps-admin-js',WPSPS_URL.'/assets/js/admin.js',array('jquery'),WPSPS_VERSION,true);
	wp_enqueue_script('wpsps-slick-js',WPSPS_URL.'/assets/js/slick.min.js',array('jquery'),WPSPS_VERSION,true);
	wp_enqueue_script('wpsps-js-js',WPSPS_URL.'/assets/js/wpsps-js.js',array('jquery'),WPSPS_VERSION,true);
}
add_action('admin_enqueue_scripts','wpsps_admin_enqueue');

add_action('admin_footer', 'wpsps_add_icon_hover');
function wpsps_add_icon_hover() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
		  $('#toplevel_page_wpsps').hover(function() {
		    $(this).find('img').attr('src', '<?php echo WPSPS_URL?>/assets/img/wpsps-icon-hover.png');
		  }, function() {
		    $(this).find('img').attr('src', '<?php echo WPSPS_URL?>/assets/img/slidericon.fw.png');
		  });
		})
	</script>
	<?php
}

//Settings page
function wpsps_menu_settings(){
	add_menu_page( 'WP Simple Post Slider', 'WP Simple Post Slider', 'manage_options', 'wpsps', 'wpsps_settings_admin', WPSPS_URL. '/assets/img/slidericon.fw.png', 61 );
	add_action('admin_init','wpsps_settings');
}
add_action('admin_menu','wpsps_menu_settings');

//Settings callback function
function wpsps_settings_admin(){
	include plugin_dir_path(__FILE__).'wpsps-settings.php';
}

//Custom settings
function wpsps_settings(){

	//General options
	register_setting(
		'wpsps_group',
		'wpsps_number_posts'
	);
	register_setting(
		'wpsps_group',
		'wpsps_template'
	);
	register_setting(
		'wpsps_group',
		'wpsps_category_post'
	);
 	/** Settings Section **/
 	add_settings_section(
 		'wpsps_number_posts',
 		'',
 		'wpsps_number_posts_function',
 		'wpsps'
 	);
 	add_settings_section(
 		'wpsps_template',
 		'',
 		'wpsps_template_function',
 		'wpsps'
 	);
 	add_settings_section(
 		'wpsps_category_post',
 		'',
 		'wpsps_category_post_function',
 		'wpsps'
 	);
 	add_settings_section(
 		'wpsps_get_shortcode',
 		'',
 		'wpsps_get_shortcode_function',
 		'wpsps'
 	);

}

//General Options Callback
function wpsps_number_posts_function() {
	$number_of_posts = get_option( 'wpsps_number_posts' );
	if(empty($number_of_posts)) {
		$number_of_posts = 3;
	}
	$html  = '<div class="wpsps-input__wrap">';
	$html .= '<h2>Number of Posts</h2>';
	$html .= '<input type="number" name="wpsps_number_posts" id="wpsps_number_posts" value="' . $number_of_posts . '">';
	$html .= '<label for="wpsps_number_posts"></label>';
	$html .= '</div>';
	echo $html;
}
function wpsps_template_function() {
	$html  = '<div class="wpsps-input__wrap">';
	$html .= '<h2>Select Theme</h2>';
	$html .= '<select id="wpsps_template" name="wpsps_template">';
	$selected_simple = '';
	$selected_advanced= '';
	$selected_basic = '';
	if(get_option( 'wpsps_template' ) === 'simple') {
		$selected_simple = 'selected';
	}
	if(get_option( 'wpsps_template' ) === 'basic') {
		$selected_basic = 'selected';
	}
	if(get_option( 'wpsps_template' ) === 'advanced') {
		$selected_advanced = 'selected';
	}
	$html .= '<option value="basic" ' . $selected_basic . '>Basic</option>';
	$html .= '<option value="simple" ' . $selected_simple . '>Simple</option>';
	$html .= '<option value="advanced" ' . $selected_advanced . '>Advanced</option>';
	$html .= '</select>';
	$html .= '</div>';
	echo $html;
}
function wpsps_category_post_function() {
	$current_cat = get_option( 'wpsps_category_post' );
	echo '<div class="wpsps-input__wrap">';
	echo '<h2>Select Category</h2>';
	 wp_dropdown_categories(array('show_option_all' => 'Choose a category','hide_empty' => 0, 'name' => 'wpsps_category_post', 'orderby' => 'name', 'selected' => $current_cat, 'hierarchical' => true));
	echo '</div>';
}
function wpsps_get_shortcode_function() {
	echo '<div class="wpsps-input__wrap">';
	echo '<h2>Shortcode</h2>';
	echo '<input id="copy-wpsps-short" type="text" disabled="disabled" value="[slider_wpsps]">';
	echo '<div id="copy-wpsps-short-btn" class="button button-primary">Copy</div>';
	echo '<div class="copy_link_mess">Shortcode copied</div>';
	echo '</div>';
}
?>