<?php
/*
Plugin Name: JGC Content for Registered Users
Description: This plugin lets you hide the content of posts and pages to unregistered users.
Version: 1.0.0
Author: GalussoThemes
Author URI: http://galussothemes.com
Text Domain: jgccfr-plugin
License: GPLv2
*/

// Salir si se accede directamente
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define ( 'JGC_CFR_VERSION', '1.0.0' );

register_activation_hook( __FILE__, 'jgccfr_install');
function jgccfr_install(){
	
	/* 
	 * Si es una reactivación del plugin las opciones guardadas se mantienen.
	 * Si es una activación desde cero, se establecen las opciones por defecto.
	 */
	
	if (get_option("jgccfr_opciones") == false) {
		
		$arr_opciones = array(
			'color_mensaje' => 'azul',
			'texto_mensaje' => __('This content is for registered users only.', 'jgccfr-plugin'),
		);
		
		//Actualizar opciones
		update_option( 'jgccfr_opciones', $arr_opciones );
		
	}
	
}

add_action('init', 'jgccfr_load_textdomain');
function jgccfr_load_textdomain() {
	
	load_plugin_textdomain( 'jgccfr-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );
	
}

add_action('wp_enqueue_scripts', 'jgccfr_style');
function jgccfr_style(){
	
	wp_enqueue_style( 'jgccfr-msg-style', plugins_url( 'css/jgc-cfr-style.css', __FILE__ ), '', JGC_CFR_VERSION );
	
}

require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-cfr-functions.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-cfr-options.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-cfr-meta-box.php' );
require_once( plugin_dir_path( __FILE__ ) . 'inc/jgc-cfr-tiny-button.php' );

?>
