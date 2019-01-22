<?php

// BEGIN iThemes Security - Do not modify or remove this line
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Disable File Editor - Security > Settings > WordPress Tweaks > File Editor
// END iThemes Security - Do not modify or remove this line

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'buddhism_wp');

/** MySQL database username */
define('DB_USER', 'buddhism_katala');

/** MySQL database password */
define('DB_PASSWORD', 'karmapachenno108');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=#^*8j=FOc[%ip0%)dubRbdM5t6 mT+O2`osCWDdM9 )f}`:F=@qw&-MK)7xXlLO');
define('SECURE_AUTH_KEY',  'O_vt?Xg2-P{}CK n4G=.RyMSVb9UYkBPngNWp7oV${ 3V?OHu!UF5c1ST+N{zTaI');
define('LOGGED_IN_KEY',    'KZ_w.`t|)}%LC``B6k$KHQ#^vHU0MjVN8g?G~=B(8g@k*ob@n$@4Q@vFax/8hvA6');
define('NONCE_KEY',        '-jt!OmXssYSh9[17T*9o!^?*g1:aQ3JyR],+x=nIe=yFx>4AYp:WYtmA3 QvmoWz');
define('AUTH_SALT',        'm]cVIbK5K`w7wSm#MY}*?uu+c-cpJ3^o&JV>l0,`=@axG7Lj<NU>H,>hb$Q@fB8N');
define('SECURE_AUTH_SALT', 'i6H4w #Sh(CFs%b,DOI)`=.@r7n`1o%+cOUuN;wJ|Dw/}.bz~?,Erp,b{<|1(#uE');
define('LOGGED_IN_SALT',   '@jcb]{i31p`e8wMT_1]weA$3Ol}Zxnj:Bi$k*5!]Ti&wD+qI sQ*Hh?#+D3 0]d~');
define('NONCE_SALT',       '8B~8VOW5.8@Vrdkj6^qf/vgWT)XDvhjJIb}~X_U%jy$Y(ecw|t1Y9p>PlO=2viL/');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

ini_set('log_errors', 'On');
ini_set('error_log', '/home/buddhism/public_html/php-errors.log');
