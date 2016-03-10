<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
require( dirname( __FILE__ ) . '/config.php' );

define( 'DB_CHARSET', 'utf8mb4' );
define( 'DB_COLLATE', '' );
define( 'WPLANG', 'en_GB' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

// ========================
//    Custom Directory
// ========================
define( 'WP_HOME',    'http://'.$_SERVER['SERVER_NAME'] );
define( 'WP_SITEURL', WP_HOME . '/wordpress' );

define( 'WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'].'/content' );
define( 'WP_CONTENT_URL', '/content' );

// Disable people edit file from inside WordPress
define( 'DISALLOW_FILE_EDIT', true );

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '\/wordpress\/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
