<?php
define('DB_NAME', 'Your database name');
define('DB_USER', 'Your database username');
define('DB_PASSWORD', 'Your database password');
define('DB_HOST', 'localhost');

define('G_DEV_API_KEY', 'Google Maps API KEY');
define('G_RE_CAPTCHA_SECRET_KEY', 'Goole ReCaptcha Key');

// Hides errors from being displayed on-screen
@ini_set( 'display_errors', false );
// Store all the errors inside the default server error.log if no `error_log` defined
@ini_set( 'log_errors', false );
// Define where you want to store the error log file on your server side
@ini_set( 'error_reporting', E_ALL );
@ini_set('error_log', dirname(__FILE__) . '/php-errors.log');
// Turns WordPress debugging off
define( 'WP_DEBUG', false );
// Don't display errors on screen
define( 'WP_DEBUG_DISPLAY', false );
// Tells WordPress not to log everything to the /wp-content/debug.log
define( 'WP_DEBUG_LOG', false );
// Disable the editing of theme and plugin files
// define( 'DISALLOW_FILE_EDIT', true );
// Disable installing new themes and plugins, and updating them
// define( 'DISALLOW_FILE_MODS', true );
