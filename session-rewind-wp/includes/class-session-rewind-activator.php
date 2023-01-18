<?php

/**
 * Fired during plugin activation.
 *
 * @since      1.0.0
 * @package    Session_Rewind
 * @subpackage Session_Rewind/includes
 * @author     Session Rewind <yair@sessionrewind.com>
 */
class Session_Rewind_Activator {

	public static function activate() {
		update_option('session_rewind_start_recording', true);
	}

}
