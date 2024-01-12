<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://sessionrewind.com
 * @since      1.0.0
 *
 * @package    Session_Rewind
 * @subpackage Session_Rewind/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Session_Rewind
 * @subpackage Session_Rewind/admin
 * @author     Session Rewind <yair@sessionrewind.com>
 */
class Session_Rewind_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action('admin_menu', array( $this, 'addPluginAdminMenu' ), 9);
		add_action('admin_init', array( $this, 'registerAndBuildFields' ));
	}

	public function addPluginAdminMenu() {
		add_options_page(
			'Session Rewind',
			'Session Rewind',
			'administrator',
			'session-rewind-options',
			[$this, 'displayPluginAdminSettings']
		);
	}


	public function displayPluginAdminSettings() {
		if(isset($_GET['error_message'])){
			$message = sanitize_text_field($_GET['error_message']);
			$message = esc_html($message);
			add_action('admin_notices', array($this,'pluginNameSettingsMessages'));
			do_action( 'admin_notices', $message );
		}
		require_once 'partials/'.$this->plugin_name.'-admin-settings-display.php';
	}

	public function pluginNameSettingsMessages($error_message){
		switch ($error_message) {
				case '1':
						$message = __( 'There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'my-text-domain' );                 
						$err_code = esc_attr( 'plugin_name_example_setting' );                 
						$setting_field = 'plugin_name_example_setting';                 
						break;
		}
		$type = 'error';
		add_settings_error(
					 $setting_field,
					 $err_code,
					 $message,
					 $type
			 );
	}

	public function registerAndBuildFields() {
		add_settings_section(
			'session_rewind_general_section',
			'Configuration options',
			array( $this, 'session_rewind_display_general_account' ),
			'session_rewind_general_settings'
		);

		register_setting(
			'session_rewind_general_settings',
			'session_rewind_api_key'
		);

		$args = array (
			'type'      => 'input',
			'subtype'   => 'text',
			'id'    => 'session_rewind_api_key',
			'name'      => 'Session Rewind API Key',
			'required' => true,
			'get_options_list' => '',
			'value_type'=>'normal',
			'wp_data' => 'option'
		);

		if (defined('SESSIONREWIND_API_KEY')) {
			$args['disabled'] = true;
			$args['force_value'] = SESSIONREWIND_API_KEY;
			$args['description'] = 'A Session Rewind API key was found in your WordPress configuration file. To manage your API key here, first remove the key from the configuration file.';
		}

		add_settings_field(
			'session_rewind_api_key',
			'Session Rewind API Key',
			array( $this, 'session_rewind_render_settings_field' ),
			'session_rewind_general_settings',
			'session_rewind_general_section',
			$args
		);

		register_setting(
			'session_rewind_general_settings',
			'session_rewind_start_recording'
		);
//		add_settings_field(
//			'session_rewind_start_recording',
//			'Start recording',
//			array( $this, 'session_rewind_render_settings_field' ),
//			'session_rewind_general_settings',
//			'session_rewind_general_section',
//			array (
//				'type'      => 'input',
//				'subtype'   => 'checkbox',
//				'id'    => 'session_rewind_start_recording',
//				'name'      => 'Start recording',
//				'required' => false,
//				'get_options_list' => '',
//				'value_type'=>'normal',
//				'wp_data' => 'option',
//				'label' => 'If not checked recording will need to be started later via window.sessionRewind.startSession()'
//			)
//		);

		register_setting(
			'session_rewind_general_settings',
		'session_rewind_create_new_session'
		);
//		add_settings_field(
//			'session_rewind_create_new_session',
//			'Create a new session',
//			array( $this, 'session_rewind_render_settings_field' ),
//			'session_rewind_general_settings',
//			'session_rewind_general_section',
//			array (
//				'type'      => 'input',
//				'subtype'   => 'checkbox',
//				'id'    => 'session_rewind_create_new_session',
//				'name'      => 'Create a new session',
//				'required' => false,
//				'get_options_list' => '',
//				'value_type'=>'normal',
//				'wp_data' => 'option',
//				'label' => 'Create a new session upon page load, even if one has already started.'
//			)
//		);
	}

	public function session_rewind_display_general_account() {
	  echo '<!--<p>These settings apply to all Session Rewind functionality.</p>-->';
	}



	public function session_rewind_render_settings_field($args) {
		if($args['wp_data'] == 'option'){
			$wp_data_value = get_option($args['id']);
		} elseif($args['wp_data'] == 'post_meta'){
			$wp_data_value = get_post_meta($args['post_id'], $args['id'], true );
		}
		if(isset($args['force_value'])) {
			$wp_data_value = $args['force_value'];
		}
		switch ($args['type']) {
			case 'input':
				$value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
				$required = ($args['required'] === true) ? 'required' : '';

				$allowedHtml = [
					'input' => [
						'step' => [],
						'min' => [],
						'max' => [],
						'type' => [],
						'id' => [],
						'name' => [],
						'size' => [],
						'disabled' => [],
						'value' => []
					],
					'div' => [
						'class' => [],
					],
					'span' => [
						'class' => [],
					],
					'label' => [
						'for' => []
					],
					'p' => [
						'class' => []
					]
				];

				if($args['subtype'] != 'checkbox'){
					$prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">'.esc_html($args['prepend_value']).'</span>' : '';
					$prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
					$step = (isset($args['step'])) ? 'step="'.esc_attr($args['step']).'"' : '';
					$min = (isset($args['min'])) ? 'min="'.esc_attr($args['min']).'"' : '';
					$max = (isset($args['max'])) ? 'max="'.esc_attr($args['max']).'"' : '';
					$description = (isset($args['description'])) ? '<p class="description">' . $args['description'] . '</p>' : '';

					if(isset($args['disabled'])){
						// hide the actual input bc if it was just a disabled input the informaiton saved in the database would be wrong - bc it would pass empty values and wipe the actual information
						echo wp_kses($prependStart
						     . '<input type="'
							 . esc_attr($args['subtype'])
							 . '" id="'
							 . esc_attr($args['id'])
							 . '_disabled" '
							 . $step . ' ' . $max . ' ' . $min
							 . ' name="'
							 . esc_attr($args['id'])
							 . '_disabled" size="50" disabled value="'
							 . esc_attr($value)
							 . '" /><input type="hidden" id="'
							 . esc_attr($args['id'])
							 . '" '
							 . $step . ' ' . $max . ' ' . $min
							 . ' name="'
							 . esc_attr($args['id'])
							 . '" size="40" value="'
							 . esc_attr($value)
							 . '" />'
							 . $prependEnd
							 . $description, $allowedHtml);
					} else {
						echo wp_kses($prependStart
						     . '<input type="'
						     . esc_attr($args['subtype'])
						     . '" id="'
						     . esc_attr($args['id'])
						     . '"' . $required . ' '
						     . $step . ' ' . $max . ' ' . $min
						     . ' name="'
						     . esc_attr($args['id'])
						     . '" size="50" value="'
						     . esc_attr($value)
						     . '" />'
						     . $prependEnd
				             . $description, $allowedHtml);
					}
				} else {
					$checked = ($value) ? 'checked' : '';
					$markup = '<input type="checkbox" id="'.esc_attr($args['id']).'" '.$required.' name="'.esc_attr($args['id']).'" value="1" '.$checked.' />';
					if (array_key_exists('label', $args)) {
						$markup .= '<label for="' .esc_attr($args['id']).'" >'.esc_html($args['label']).'</label>';
					}
					echo wp_kses($markup, $allowedHtml);
				}
				break;
		}
	}
}
