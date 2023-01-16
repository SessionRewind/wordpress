<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://sessionrewind.com
 * @since      1.0.0
 *
 * @package    Session_Rewind
 * @subpackage Session_Rewind/admin/partials
 */
?>

<div class="wrap">
  <h2>Session Rewind Settings</h2>
  <?php settings_errors(); ?>
  <form method="POST" action="options.php">
    <?php
      settings_fields('session_rewind_general_settings');
      do_settings_sections('session_rewind_general_settings');
    ?>
    <?php submit_button(); ?>
  </form>
</div>