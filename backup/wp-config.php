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
define('DB_NAME', 'db506990140');

/** MySQL database username */
define('DB_USER', 'dbo506990140');

/** MySQL database password */
define('DB_PASSWORD', 'Aixin1#');

/** MySQL hostname */
define('DB_HOST', 'db506990140.db.1and1.com');

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
define('AUTH_KEY',         '|8Hn;:_OPPY7^qLo8ID1R@</+;:`/kC1k*+RlIU;;4)WmSG*qh0k|uPlS+]+uqgP');
define('SECURE_AUTH_KEY',  'Ok|0SnuLgQ.yV{nwY)Y]ACIF!q~+T=JqQ;/7RCU0$CV[?+>-0/@</I fmSO7K,UZ');
define('LOGGED_IN_KEY',    'l|U52%7Ht%Lv+F49+Ag>}g{]Aq^L.aoHu]gK+TI,9b=@|9erGq:9-#j^|yV#xJ!e');
define('NONCE_KEY',        'PXL5SN]kS)R^R[ebkYNSdfjC~hd3**7{in E$F^jmI}2~NT-hx8@8Md(%3#g_h+$');
define('AUTH_SALT',        '.>Y[(x,QyLL~!_`Xk_;~ki]Ey1=l:U->]+MN?mj-8&jEA/~l($_H+`- .&z;@k*Z');
define('SECURE_AUTH_SALT', 'FW-n%,`0K+F)b{$4$je-;Y?k1NzeJ9b|!L.>[qXXbQ^20VTWL-jXBYo&9;HLq_CM');
define('LOGGED_IN_SALT',   '$K+Yl``gXo-L$G|H{s$s-HAc(6?+&g`TaX)[[U[:.oiUt4l?Q8@F2DSZ7u9-amr/');
define('NONCE_SALT',       '?{xNP&28qIc)?}uCPK+,C]a.x]u@iECg:zBqks^jKkJl>G>)6Ur/{.lNu<exd&lU');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wpax_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'zh_CN');

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
