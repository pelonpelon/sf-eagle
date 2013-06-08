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
define('DB_NAME', 'sfeagle');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8888');

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
define('AUTH_KEY',         '*bjA;&|(rv+dLDfIR-y[Lu>Hs?AO[DJdpr=+$q/pOBLpxh1wnt}.tCBw`WNp&}9B');
define('SECURE_AUTH_KEY',  'L*?V !boa}#E!Ac!5 C^JMcq4r--:m~90GVIXoOg{&;Y+6uj0h<+YOTxE^1^/KiA');
define('LOGGED_IN_KEY',    '`SGe((PL`WVw~_Y-w)/*Hd{R!}gL!hbk19!Dv9wb617/cjz||hR:4wUYM>T_&VmL');
define('NONCE_KEY',        ' {x9b>r1AD7a+o)bi?IY&yB*_DkT5?99-jvhhSb.%%RR,t!Wp+b+@j>)!v-#}6xN');
define('AUTH_SALT',        'L &7*/UQPCC~+}EDsWZ,w@+SsEiSarke.N<:}y}IAfVc0Q|a-t`j-r~#*>Sm^7_9');
define('SECURE_AUTH_SALT', 'YZ-QR#DBu$<^;j@,WDQy-uB7c7-ua9xGn4%JNze0AM`h24.tF|$Gm.;O}qz*-Jty');
define('LOGGED_IN_SALT',   'G`IcRpfrA.E[G4?q?>osJc3@G-2_PQF8G~ug22-%*!aV!?ZYxV*6bOn`|`v0,M|v');
define('NONCE_SALT',       '8fQ~-*?~T&`MG5+tB8<P-9Csu[EgwR%47Q^A )dXC&V-u^_Q<Zc?&pAaTh#FA|g&');

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
