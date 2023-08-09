<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bike_meihao_shopping');

/** Database username */
define('DB_USER', 'bike_meihao_shopping');

/** Database password */
define('DB_PASSWORD', 'Xjb8sfEkcDjDoldv');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'xe1E9Ixz51KzQ5k3SblMt2Oqlpzkk0MVjJAIiQwQmao9gO0Z4czj3w7wnzES0Fav');
define('SECURE_AUTH_KEY', 'dS47l9OLdpFXUEgVS7YNTm7BpN2WHXMRuRherkhvtvp9hxIDzqd3nEt3aFG9tmgq');
define('LOGGED_IN_KEY', 'RZ71HoO6WX6XsvAObeXQdARRqLoh5ljeTTaKilhpKuY3WLDCYsldpFcewTQcTm96');
define('NONCE_KEY', '1339DA4wSQyujJHLS6LmjiG4prNYj6YuzuSqiven3WS3DCBQZOTK7RdSOQfAAROd');
define('AUTH_SALT', 'bJEcnQGRX8pjqEUElOB8oMRH1RnwIhvTPMY1PMDILPWntHqVxSzqVfoS2ZqpLR4M');
define('SECURE_AUTH_SALT', 'PG0Fs6J4vJFnXAHwuK4qJ8cgX7swgXjednPNTTThMn8D5ZLztjFujOf7S3dun9m3');
define('LOGGED_IN_SALT', 'OanybQW9WgjBYpBjYhZ5ufUIviEbOdmpEgl9YxRgVVIMLHV2QjdDh4l0LjUZ8TPe');
define('NONCE_SALT', 'U4sENliuTIfSmoa4I1onm0EFjI6e07jiOQztAnUTKC4ERGMCAf32ANumVo0fTUgA');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



define('WP_REDIS_SELECTIVE_FLUSH', true);
define('WP_CACHE_KEY_SALT', 'wp_bike.meihao.shopping');
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
