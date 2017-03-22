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

$sp_plugin_url = WP_PLUGIN_URL . '/syncline-poll';
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
	global $sp_plugin_url;
	global $options;
	if (isset($_POST['syncline_poll_name']) && !empty($_POST['syncline_poll_name'])) {
		$syncline_poll_name = esc_html($_POST['syncline_poll_name']);

		$options['syncline_poll_name'] = $syncline_poll_name;
		$options['syncline_poll_yes'] = 0;
		$options['syncline_poll_no'] = 0;
		$options['syncline_poll_time'] = time();

		update_option('syncline_poll', $options);
	}
	$options = get_option('syncline_poll');
	// var_dump($options['syncline_poll_yes']);
	if ($options != '') {
		$syncline_poll_name = $options['syncline_poll_name'];
		$syncline_poll_yes = $options['syncline_poll_yes'];
		$syncline_poll_no = $options['syncline_poll_no'];
		$syncline_poll_time = $options['syncline_poll_time'];

		$syncline_poll_label = "Change Current Poll";
		$syncline_submit_label = "Update";
	} else {
		$syncline_poll_label = "Create A Poll";
		$syncline_submit_label = "Save";
	}

	require 'inc/options-page-wrapper.php';
}


class Syncline_Poll_Widget extends WP_Widget {

	function syncline_poll_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Syncline Poll' );
	}

	function widget( $args, $instance ) {
		// Widget output
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);

		$options = get_option('syncline_poll');
		$syncline_poll_name = $options['syncline_poll_name'];
		$syncline_poll_yes = $options['syncline_poll_yes'];
		$syncline_poll_no = $options['syncline_poll_no'];

		require 'inc/front-end.php';
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$options = get_option('syncline_poll');
		$syncline_poll_name = $options['syncline_poll_name'];

		require 'inc/widget-fields.php';
	}
}

function syncline_poll_register_widgets() {
	register_widget( 'Syncline_Poll_Widget' );
}
add_action( 'widgets_init', 'syncline_poll_register_widgets' );


function syncline_poll_styles() {
	wp_enqueue_style('syncline_poll_styles', plugins_url('syncline-poll/syncline-poll.css'));
}
add_action('admin_head', 'syncline_poll_styles');



?>