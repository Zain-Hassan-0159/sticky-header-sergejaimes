<?php

/**
 * Plugin Name:       Sticky Header Sergejaimes
 * Description:       Sticky Header Sergejaimes Widget is created by Zain Hassan.
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Zain Hassan
 * Author URI:        https://hassanzain.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hz-widgets
*/

if(!defined('ABSPATH')){
    exit;
}


/**
 * Register List Widget.
 *
 * Include widget file and register widget class.
 *
 * @since 1.0.0
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
 * @return void
 */
function register_shs_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/shs-widget.php' );

	$widgets_manager->register( new \Elementor_Shs_Widget() );

}
add_action( 'elementor/widgets/register', 'register_shs_widget' );

function shs_register_dependencies_scripts() {

	/* Scripts */
	wp_register_script( 'sticky-nav-shs', plugins_url( 'inc/assets/js/sticky-nav-shs.js', __FILE__ ));

}
add_action( 'wp_enqueue_scripts', 'shs_register_dependencies_scripts' );

