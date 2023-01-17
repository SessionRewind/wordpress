<div class="wrap">
  <h2>Session Rewind Settings</h2>
  <?php settings_errors(); ?>
  <form method="POST" action="options.php">
    <?php
        settings_fields('session_rewind_general_settings');
        do_settings_sections('session_rewind_general_settings');
        submit_button();
    ?>
  </form>
</div>
