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
		global $sp_plugin_url;
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


function syncline_poll_shortcode($atts, $content = null) {
	global $post;
	global $sp_plugin_url;

	$options = get_option('syncline_poll');
	$syncline_poll_name = $options['syncline_poll_name'];
	$syncline_poll_yes = $options['syncline_poll_yes'];
	$syncline_poll_no = $options['syncline_poll_no'];

	ob_start();
	require 'inc/shortcode.php';
	$content = ob_get_clean();
	return $content;
}
add_shortcode('syncline-poll', 'syncline_poll_shortcode');


function syncline_poll_count() {
	$options = get_option('syncline_poll');
	$feedback = $_POST['feedback'];
	if ($feedback == "yes") {
		$options['syncline_poll_yes'] += 1;
	} else {
		$options['syncline_poll_no'] += 1;
	}
	update_option('syncline_poll', $options);
	echo $feedback;
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


function backend_assets() {
	wp_enqueue_style('syncline_poll_css', plugins_url('syncline-poll/syncline-poll.css'));
}
add_action('admin_head', 'backend_assets');


function frontend_assets() {
	wp_enqueue_style('syncline_poll_css', plugins_url('syncline-poll/syncline-poll.css'));
	wp_enqueue_script('syncline_poll_js', plugins_url('syncline-poll/syncline-poll.js'), array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'frontend_assets');



?>