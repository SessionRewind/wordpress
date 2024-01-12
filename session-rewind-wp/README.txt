=== Plugin Name ===
Contributors: yairsr
Donate link: https://sessionrewind.com
Tags: session recording, heatmaps, recordings, insights
Requires at least: 2.7
Tested up to: 6.4.2
Stable tag: 1.1.1
Requires PHP: 5.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Optimize your web experience with video recordings of user behavior.

== Description ==

[Session Rewind](https://sessionrewind.com) offers a simple and affordable way to understand your users' behavior.

We offer:

*   **Session Playback**: Watch what happens when you really watch what happens. See exactly what your users saw. Save the most insightful sessions and share them with your teammates.
*   **Custom Notifications**: Get alerted whenever a user session meets pre-specified criteria, or as part of a daily rollup.
*   **Heatmaps**: Quickly identify where your users are spending the most time and attention.

This plugin makes installation of Session Rewind on your WordPress site a breeze.

Please note that an active account and API key with Session Rewind is required to enable this plugin on your site.

== Installation ==

The Session Rewind plugin is available to install via the WordPress plugin library.

Alternatively, you can install the plugin manually:

1. Download the Session Rewind plugin as a zip file
1. Upload the contents of the zip file to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to "Settings" → "Session Rewind" section and set your Session Rewind API Key

*Adding your API key using wp-config*

You can also configure the plugin by setting your Session Rewind API key in wp-config.php by adding the following:
`define('SESSIONREWIND_API_KEY', 'xxxxxxxxx');`

Replace the 'xxxxxxxxx' with the API key from your account with us.

Please note that it will not be possible to change your API key from within the administration page if an API key is found in wp-config.php,
as the latter will take priority.

== Screenshots ==

1. Plugin Configuration

== Changelog ==

= 1.1 =
* Added support for configuration via wp-config.php

= 1.0 =
* Initial Release
