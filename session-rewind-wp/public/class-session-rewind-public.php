<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://sessionrewind.com
 * @since      1.0.0
 *
 * @package    Session_Rewind
 * @subpackage Session_Rewind/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Session_Rewind
 * @subpackage Session_Rewind/public
 * @author     Session Rewind <yair@sessionrewind.com>
 */
class Session_Rewind_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Session_Rewind_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Session_Rewind_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		$data = json_encode(array(
			'apiKey' => get_option('session_rewind_api_key'),
			'startRecording' => true
		));


		wp_enqueue_script( $this->plugin_name, plugin_dir_url(__FILE__) . 'js/session-rewind-public.js', array( 'jquery' ), $this->version, true );
		wp_add_inline_script($this->plugin_name, 'var sessionRewindOptions = ' . $data . ';', 'before');

	}

}
