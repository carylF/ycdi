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
define('DB_NAME', 'ycdi_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '7QlqF~xf</eCC^W<Ayu4A<CBiG2%km9P%30@%(T<X,,u3pm:D49$;[ZXY[*3s|K ');
define('SECURE_AUTH_KEY',  's6]igw&kB]1aJc{Xz5y.9EGd6eRJEC-kT6/.a95dlL:wbS(BUgcPY/OykJ@;dxwO');
define('LOGGED_IN_KEY',    'OKPC=V>h>2RW4r1[`USWGVzb,-l$L2N@!MnqpQ@qm&J[EITSxmt:NPERYHt#*jtS');
define('NONCE_KEY',        'LH(p/t&v2l>@#buFenR|Y^,=tkIbv 8ILD7l65DAjJT*|RJ&*d9$Q1s5m2!=<uho');
define('AUTH_SALT',        '=!O{%-4/vJ3<_,lCaY2(9]Ozx77u1r${RE?N?@X&N,8RJug2L?li6fX@XZ8Xa%6{');
define('SECURE_AUTH_SALT', 'k<K95h3%i0rE6s4f?v_m~@}?)QvsyaO27u46VExP(6oH>2)AnkQU<H%;% $drKj;');
define('LOGGED_IN_SALT',   'f(W:i+zI23K]3|Eq_,8a$*$&R,b ASTL<#7nmyc:(syaHr |ZOWG1I2j;I-cEv2-');
define('NONCE_SALT',       'f}G%@%n!]Q#Sr|}.H~q4,?hrj>Ax4k3CwJOl-UnKmhy<]LiT[^sA<~{1ftLQU3Mp');

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
