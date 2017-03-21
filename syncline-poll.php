<?php 

/*
 *	Plugin Name: Syncline Poll
 *	Plugin URI: http://syncline.it/syncline-poll/
 *	Description: Run polls on your WordPress posts and pages, using widgets and shortcodes.
 *	Version: 1.0
 *	Author: Emmanuel Koranteng
 *	Author URI: http://syncline.it/
 *	License: GPL2
 *
*/

/*
 * Assign global variables
 *
*/

$plugin_url = WP_PLUGIN_URL . '/syncline-poll';
$options = array();

/*
 * Add a link to our plugin in the admin menu
 * under 'Settings > Syncline Poll'
 *
*/

function syncline_poll_menu() {
	/*
	 * Use the add_options_page function
	 * add_options_page( $page_title, $menu_title, $capability, $menu_slug, $function )
	 *
	*/
	add_options_page(
		'Syncline Poll',
		'Syncline Poll',
		'manage_options',
		'syncline-poll',
		'syncline_poll_options_page'
	);
}
add_action('admin_menu', 'syncline_poll_menu');


function syncline_poll_options_page() {
	if (!current_user_can('manage_options')) {
		wp_die( 'You do not have sufficient permissions to access this page.' );
	}
	global $plugin_url;
	global $options;
	if (isset($_POST['syncline_poll_name']) && !empty($_POST['syncline_poll_name'])) {
		$syncline_poll_name = esc_html($_POST['syncline_poll_name']);

		$options['syncline_poll_name'] = $syncline_poll_name;
		$options['syncline_poll_time'] = time();

		update_option('syncline_poll', $options);
	}
	$options = get_option('syncline_poll');
	var_dump($options);
	if ($options != '') {
		$syncline_poll_name = $options['syncline_poll_name'];
		$syncline_poll_time = $options['syncline_poll_time'];
	}

	require('inc/options-page-wrapper.php');
}


function syncline_poll_styles() {
	wp_enqueue_style('syncline_poll_styles', plugins_url('syncline-poll/syncline-poll.css'));
}
add_action('admin_head', 'syncline_poll_styles');



?>