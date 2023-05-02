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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'smarthome' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '(36Idq69h(.aC)w.I+F^Z[504<NOLKBQorH=j(c41/3.wJTe(Bq7P0@RWveo/g?x' );
define( 'SECURE_AUTH_KEY',  'p7`}SrN;]GS*<gYEC&m4QU|bj(qjTh|2-MYjl,hSvOjgGNXHX!.F,fLb}.f@Vckn' );
define( 'LOGGED_IN_KEY',    'ATcJDW4>GI^MZ=@#$qD/8M[CfZcR$OzhuukNt!;PZ_kV^#:/S,(aW%_t5E|YbW-l' );
define( 'NONCE_KEY',        'S&z&^Z9n~]TgbT7A3jHU)TgVkk}}<.58cP3+m)@c]^Yuk5bs#Ru}{iwSJ{Y9|TRR' );
define( 'AUTH_SALT',        'xXH1:b5wpkVA*2^nO]I-%&Y#t5tk.a]kr_mpKdv}XqXkxpe8wW15M}.;+ ct4e~-' );
define( 'SECURE_AUTH_SALT', ',J:fh.Tp8P`[kfC}HCNX@|w$My(ZK|oyXh_/l S!mfp%Kdw%|$&yX)|]B5<e)NR5' );
define( 'LOGGED_IN_SALT',   '|A#~(*@0mbfWk(5CZRbw5N#?nC~K]pW&O=/SJyvJBK3U!vn<fes{?_Fp!~=f+D1n' );
define( 'NONCE_SALT',       '0Hf2,;)&d@fIWH%FH[J$i[dE<&PZEB6sh$Yi2X5* !DZQfBb93}y|hO^6|1-VNZ>' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
