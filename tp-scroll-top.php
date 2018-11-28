<?php

/*
Plugin Name: Tp Scroll Top
Plugin URI: http://www.themepoints.com
Description: Tp Scroll To Top is fully responsive plugin for WordPress.
Version: 1.2
Author: themepoints
Author URI: http://www.themepoints.com
License URI: http://www.themepoints.com/copyright/

Globital Media

*/


if ( ! defined( 'ABSPATH' ) ) exit;

/***************************************
Tp Scroll Top plugins path register
***************************************/



define('TP_SCROLL_TOP_PLUGIN_PATH', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


/***************************************
Tp scroll top admin enqueue scripts
***************************************/

function tp_scroll_top_active_script()
	{
	wp_enqueue_script('jquery');
	wp_enqueue_script('scroll-top-js', plugins_url( '/js/ap-scroll-top.js', __FILE__ ), array('jquery'), '1.0', false);
	wp_enqueue_style('scroll-top-css', TP_SCROLL_TOP_PLUGIN_PATH.'css/tp-scroll-top.css');
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_script('scrolltop-wp-color-picker', plugins_url(), array( 'wp-color-picker' ), false, true );
	}
add_action('init', 'tp_scroll_top_active_script');



function tp_scroll_to_top_option_init(){
	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_option_enable');
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_scroll_fade_speed');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_visibility_fade_speed');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_visibility_trigger');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_scroll_position');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_scrollbg');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_scrollbg_hover');	
	register_setting( 'tp_scroll_to_top_plugin_options', 'tp_scroll_top_scrollradious');	
    }
add_action('admin_init', 'tp_scroll_to_top_option_init' );

function tp_scroll_top_custom_css_style(){
	 $tp_scroll_top_scrollbg = get_option( 'tp_scroll_top_scrollbg' );	
	 $tp_scroll_top_scrollbg_hover = get_option( 'tp_scroll_top_scrollbg_hover' );	
	 $tp_scroll_top_scrollradious = get_option( 'tp_scroll_top_scrollradious' );	
	?>
	<style type="text/css">
	.apst-button {
		background-color:<?php echo $tp_scroll_top_scrollbg; ?>  !important;
    }
	.apst-button {
	  background-color: #555;
	  border-radius: <?php echo $tp_scroll_top_scrollradious; ?>%;
	  display: block;
	  height: 80px;
	  position: relative;
	  transition: all 0.2s ease 0s;
	  width: 80px;
	}	
	.apst-button:hover {
		background-color: <?php echo $tp_scroll_top_scrollbg_hover; ?> !important;
    }		
	</style>
	<?php
}
add_action('wp_head', 'tp_scroll_top_custom_css_style');


function tp_scroll_top_display_script(){
	
	 $tp_scroll_top_option_enable = get_option( 'tp_scroll_top_option_enable' );	
	 $tp_scroll_top_scroll_fade_speed = get_option( 'tp_scroll_top_scroll_fade_speed' );	
	 $tp_scroll_top_visibility_fade_speed = get_option( 'tp_scroll_top_visibility_fade_speed' );	
	 $tp_scroll_top_visibility_trigger = get_option( 'tp_scroll_top_visibility_trigger' );	
	 $tp_scroll_top_scroll_position = get_option( 'tp_scroll_top_scroll_position' );	
	
	?>
	<script type="text/javascript">
		// Setup plugin with default settings
		jQuery(document).ready(function($) {
			jQuery.apScrollTop({
				enabled: <?php echo $tp_scroll_top_option_enable ;?>,
				visibilityTrigger: <?php echo $tp_scroll_top_visibility_trigger ;?>,
				visibilityFadeSpeed: <?php echo $tp_scroll_top_visibility_fade_speed ;?>,
				scrollSpeed: <?php echo $tp_scroll_top_scroll_fade_speed ;?>,
				position: '<?php echo $tp_scroll_top_scroll_position ;?>',
			});
		});
	</script>

    <?php
	}
add_action('wp_head', 'tp_scroll_top_display_script');





/***************************************
tp scroll top option page setting
***************************************/

function tp_scroll_top_option_settings(){
	include('admin/tp-scroll-top-admin.php');
}

function tp_scroll_top_menu_init() {
	add_menu_page(__('Tp Scroll Top','tpscrolltop'), __('Tp Scroll Top','tpscrolltop'), 'manage_options', 'tp_scroll_top_option_settings', 'tp_scroll_top_option_settings');
}
add_action('admin_menu', 'tp_scroll_top_menu_init');



?>
