<?php
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
define('DB_NAME', 'gwis_important');

/** MySQL database username */
define('DB_USER', 'gwis_important');

/** MySQL database password */
define('DB_PASSWORD', 'gwis_important');

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
define('AUTH_KEY',         ',9M/u/oR~?3B8g]1O,(j3fF2$vg=NpskiLpS 6A(`z v?wozM)14*>iMR iA1Qg,');
define('SECURE_AUTH_KEY',  ';uxvr~x~y!g]6[R0c:Q4;olQ!uU}Am+oV4h6U(1-D;X-Uu_E, aw@EgxQIWJ[<Ka');
define('LOGGED_IN_KEY',    'G8FKC VixpfcELQH@*$n~Gxv%DI$*s< O`eN0089%^&k1[knaiT6+1>1YE9!.YYZ');
define('NONCE_KEY',        'cqMI2Y*jwAh%#L8:[7&Q]Z|6A a<0U;{bnvw_=r>8VS;6O4 n$xA),P-RARE9G>t');
define('AUTH_SALT',        '!HbgdI7X~0>%^foxSn`HA)_Tjlb#eJ#=lIlLFFVw l5izY71E%z?@t+0hi#3_$$[');
define('SECURE_AUTH_SALT', 'ZZ8uV#17q4]rt]vh_:;nl!f,1cG)vFn:!.?O/Yt-pCZ7V?<Dkf<RCcAYL}K_l8pM');
define('LOGGED_IN_SALT',   'DnYO0-O0$<SU^VR=R$!m:*`(p;hA+tfEpKK=#SXw]{|5G@6iI0rY pkYY~~*y?Bn');
define('NONCE_SALT',       'oh_!?i$O$%upOlXYPf4@f>?[yI|~Al;>~^p-# -bjzb6[-w_sH*!O~5vE{@kdnIN');

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
