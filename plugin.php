<?php
/*
 * Plugin Name: Плавающие кнопки связи
 * Plugin URI: 
 * Description: Кнопки связи для сайта (ватсап, вк и пр.)
 * Version: 1.1.1
 * Author: Artyom
 * Author URI: https://artweb29.ru
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: art
 * Domain Path: /languages
 *
 * Network: true
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

require_once plugin_dir_path( __FILE__ ) . 'class-float-buttons.php';

function wp_float_buttons_init() {
    $plugin= new wp_float_buttons();
}

add_action( 'plugins_loaded', 'wp_float_buttons_init' );


// cтили и скрипты кнопок

function buttons_style() {
	wp_enqueue_style( 'button',   plugin_dir_url(__FILE__). '/assets/css/style.css', array(), '4.1.2' );
	wp_enqueue_script( 'script',  plugin_dir_url(__FILE__). '/assets/js/script.js', array('jquery'), '3.0' );
}

add_action( 'wp_enqueue_scripts', 'buttons_style', 10);


// скрипты админки

function admin_script() {
   // if(is_admin()) {
	wp_enqueue_script( 'script',  plugin_dir_url(__FILE__). '/assets/js/tabs.js', array('jquery'), '3.0' );
  //}	
}
add_action( 'admin_enqueue_scripts', 'admin_script', 10);

