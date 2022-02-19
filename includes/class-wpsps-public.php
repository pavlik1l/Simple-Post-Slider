<?php

if(!defined('ABSPATH'))
	return;


class WPSPS_CP {

	protected static $instance = null;

	public function __construct(){
		add_action('wp_enqueue_scripts',array($this,'enqueue_scripts'));
		add_shortcode('slider_wpsps', array($this,'slider_shortcode'));
		if ( in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

			add_action('elementor/editor/before_enqueue_scripts', function() {
				
				wp_register_script('wpsps-slick-js',WPSPS_URL.'/assets/js/slick.min.js',array('jquery'),WPSPS_VERSION,true);
				wp_enqueue_script('wpsps-slick-js');
				wp_register_script('wpsps-js-js',WPSPS_URL.'/assets/js/wpsps-js.js',array('jquery'),WPSPS_VERSION,true);
				wp_enqueue_script('wpsps-js-js');
			
			});

		}
	}

	//Get class instance
	public static function get_instance(){
		if(self::$instance === null){
			self::$instance = new self();
		}	
		return self::$instance; 
	}

	public function enqueue_scripts(){
		global $xoo_cp_gl_resetbtn_value;

		wp_enqueue_style('wpsps-slick-style',WPSPS_URL.'/assets/css/slick.css',null,WPSPS_VERSION);
		wp_enqueue_style('wpsps-slick-theme-style',WPSPS_URL.'/assets/css/slick-theme.css',null,WPSPS_VERSION);
		wp_enqueue_style('wpsps-css-style',WPSPS_URL.'/assets/css/wpsps-css.css',null,WPSPS_VERSION);
		wp_enqueue_script('wpsps-slick-js',WPSPS_URL.'/assets/js/slick.min.js',array('jquery'),WPSPS_VERSION,true);
		wp_enqueue_script('wpsps-js-js',WPSPS_URL.'/assets/js/wpsps-js.js',array('jquery'),WPSPS_VERSION,true);

	}

	public function slider_shortcode() {
		$number_option = get_option( 'wpsps_number_posts' );
		$type_template = get_option( 'wpsps_template' );
		$cat = get_option('wpsps_category_post');
		if(empty($type_template)) {
			$type_template = 'simple';
		}
		if(empty($number_option)) {
			$number_option = 3;
		}
		if(empty($cat)) {
			$args = array(
				'posts_per_page' => $number_option,
			);
		} else {
			$args = array(
				'posts_per_page' => $number_option,
				'cat' => $cat
			);
		}
		$query = new WP_Query($args);
		if($query->have_posts()) {
			$html = '';
			$html .= '<div class="slider-wpsps wpsps_' . $type_template . '">';
				while ($query->have_posts()) {
					$query->the_post();
					global $post;
					$html .= '<div class="slider-wpsps__item"><a href="' . get_permalink() . '">';
						$html .= '<div class="slider-wpsps__content">';
							$html .= '<h2>' . get_the_title() . '</h2>';
							$html .= '<p>' . get_the_excerpt() . '</p>';
							if($type_template != 'basic') {
								$html .= '<div class="slider-wpsps__btn">Read more</div>';
							} else {
								$html .= '<button class="button">Read more</button>';
							}
						$html .= '</div>';
						$html .= '<img src="' . get_the_post_thumbnail_url($post->ID, 'full') . '" alt="">';
					$html .= '</a></div>';
				}
				wp_reset_query();
			$html .= '</div>';
		}
		return $html;
	}
}
?>