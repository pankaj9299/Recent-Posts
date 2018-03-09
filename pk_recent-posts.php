<?php
/**
 * Plugin Name: PK Recent Posts
 * Plugin URI: http://pankaj.com
 * Description: This plugin get the recent posts in Grid view.
 * Version: 1.0.0
 * Author: Pankaj Kumar
 * Author URI: http://pankaj.com
 * License: GPL2
 */

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Function to display dashboard configuration page
function mrp_admin() {
    include('pk_import_admin.php');
}

function mrp_admin_actions() {
	add_options_page("Most Recent Posts", "Most Recent Posts", 1, "Most Recent Posts", "mrp_admin");	
}
 
add_action('admin_menu', 'mrp_admin_actions');
 
// Start Bootstrap //

function wpse_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'style1', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css' );
	wp_enqueue_style( 'style2', $plugin_url.'/css/pk_style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpse_load_plugin_css' );

// End Bootstrap //



//include the file from where the shortcode will be fetch
include 'pk_recent_shortcode.php';
?>
