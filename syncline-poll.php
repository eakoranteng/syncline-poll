<?php 
/*
 *	Plugin Name: Syncline Poll
 *	Plugin URI: http://syncline.it/
 *	Description: Run a poll on your WordPress posts and pages, using widgets and shortcodes.
 *	Version: 1.0
 *	Author: Emmanuel Koranteng
 *	Author URI: http://syncline.it/
 *	License: GPL2
 *
*/

/*
 * Global variables
 *
*/
$sp_plugin_url = WP_PLUGIN_URL . '/syncline-poll';
$options = array();

/*
 * Top-level admin menu
 * 'Syncline Poll'
 *
*/
function syncline_poll_menu() {
	/*
	 * add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position )
	 *
	*/
	add_menu_page(
		'Syncline Poll',
		'Syncline Poll',
		'manage_options',
		'syncline-poll',
		'admin_page',
		'dashicons-image-filter'
		);
}
add_action('admin_menu', 'syncline_poll_menu');


function admin_page() {
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

		update_option('syncline_poll', $options);
	}
	$options = get_option('syncline_poll');
	
	if ($options != '') {
		$syncline_poll_name = $options['syncline_poll_name'];
		$syncline_poll_yes = $options['syncline_poll_yes'];
		$syncline_poll_no = $options['syncline_poll_no'];

		$syncline_poll_count = $syncline_poll_yes + $syncline_poll_no;
		$syncline_poll_yes_percent = round(($syncline_poll_yes / $syncline_poll_count) * 100);
		$syncline_poll_no_percent = round(($syncline_poll_no / $syncline_poll_count) * 100);

		$syncline_poll_label = "Change Current Poll";
		$syncline_submit_btn = "Update";
	} else {
		$syncline_poll_label = "Create A Poll";
		$syncline_submit_btn = "Save";
	}

	require 'inc/admin.php';
}


class Syncline_Poll_Widget extends WP_Widget {

	function syncline_poll_widget() {
		// Instantiate the parent object
		parent::__construct( false, 'Syncline Poll' );
	}

	function widget( $args, $instance ) {
		// Widget output
		extract($args);
		$options = get_option('syncline_poll');
		$title = apply_filters('widget_title', $options['syncline_poll_name']);

		require 'inc/widget-ui.php';
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];

		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form
		$options = get_option('syncline_poll');
		$syncline_poll_name = $options['syncline_poll_name'];

		require 'inc/widget-admin.php';
	}
}

/*
 * Register widget
 *
*/
function syncline_poll_register_widget() {
	register_widget( 'Syncline_Poll_Widget' );
}
add_action( 'widgets_init', 'syncline_poll_register_widget' );

/*
 * Add Shortcode
 * 'syncline-poll'
 *
*/
function syncline_poll_shortcode($atts, $content = null) {
	global $post;
	global $sp_plugin_url;

	$options = get_option('syncline_poll');
	$syncline_poll_name = $options['syncline_poll_name'];
	$syncline_poll_count = $options['syncline_poll_yes'] + $options['syncline_poll_no'];
	$syncline_poll_yes = round(($options['syncline_poll_yes'] / $syncline_poll_count) * 100);
	$syncline_poll_no = round(($options['syncline_poll_no'] / $syncline_poll_count) * 100);

	ob_start();
	require 'inc/shortcode.php';
	$content = ob_get_clean();
	return $content;
}
add_shortcode('syncline-poll', 'syncline_poll_shortcode');

/*
 * Frontend AJAX API
 *
*/
function syncline_poll_count() {
	$options = get_option('syncline_poll');
	$feedback = $_POST['feedback'];
	if ($feedback == "yes") {
		$options['syncline_poll_yes'] += 1;
	} else {
		$options['syncline_poll_no'] += 1;
	}
	update_option('syncline_poll', $options);

	$syncline_poll_count = $options['syncline_poll_yes'] + $options['syncline_poll_no'];
	$syncline_poll_yes = round(($options['syncline_poll_yes'] / $syncline_poll_count) * 100);
	$syncline_poll_no = round(($options['syncline_poll_no'] / $syncline_poll_count) * 100);
	$syncline_response = array(
		"yes" => $syncline_poll_yes,
		"no" => $syncline_poll_no,
		"all" => $syncline_poll_count
		);
	echo json_encode($syncline_response);
	wp_die();
}
add_action('wp_ajax_syncline_poll_count', 'syncline_poll_count');


function enable_ajax() {
	?>
	<script>
		var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
	</script>
	<?php
}
add_action('wp_head', 'enable_ajax');

/*
 * Backend styles
 *
*/
function backend_assets() {
	wp_enqueue_style('syncline_poll_css', plugins_url('syncline-poll/assets/syncline-poll.css'));
}
add_action('admin_head', 'backend_assets');

/*
 * Frontend styles and scripts
 *
*/
function frontend_assets() {
	wp_enqueue_style('syncline_poll_css', plugins_url('syncline-poll/assets/syncline-poll.css'));
	wp_enqueue_script('syncline_poll_js', plugins_url('syncline-poll/assets/syncline-poll.js'), array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'frontend_assets');

/*
 * Clear database when plugin uninstalls
 *
*/
function clean_db() {
	delete_option('syncline_poll');
}
register_uninstall_hook(__FILE__, 'clean_db');


?>
