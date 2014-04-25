<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wuls_demo');

/** MySQL database username */
define('DB_USER', 'wuls');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '}rU;p,PxR?q+K>eTb5a?$+F;0cWG#J`D83+Q|x,isM=yMFeF<t7OB2W#@%oB/_6H');
define('SECURE_AUTH_KEY',  'q20TZC@{cZR!8]w-_L%0h>:p8G172zJ{An@ON@0=cUz`sH-c#xOFYUoFuHk7}Ty?');
define('LOGGED_IN_KEY',    '5OTI;z/NxMr]XY0,xje9*#Mb3Vl5YVnu,MW,l#jNsbHT3|Tn1|Gf]|<r8H-0K+HG');
define('NONCE_KEY',        'KN4LU]*NGdat?g#vFszycXYk<hf+ma7]).%t3s{[3>wssl{4,=<!N6=z:>*`kmu8');
define('AUTH_SALT',        'WYQ0~]JL:my|c}I.,dWkr>bH84-}u3,.[,oQIcoMR^-S(4Vv.N@RFNu^_[;L69yn');
define('SECURE_AUTH_SALT', 'd+GjB,coKdEM3;cXl,]xaPg?Q`pC1mFq|?a|%X}M%B[>B7xjS/=a^XIZK2.MmBb/');
define('LOGGED_IN_SALT',   '1Pa?.-IO70H]YW(b=4PFs,L`g7CpHcm(cWtO<i$!C7rlW%8sY*D:r-Kb=}OpzD(/');
define('NONCE_SALT',       '[SGb5HBX8=+tZB5Esc)<-q?5zo[Xu OoJQ&-3y[*5tk*Z3]?O8M[>@@g)*zQBsh_');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
