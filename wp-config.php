<?php
define( 'WP_CACHE', true );
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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u811466505_3RbTz' );

/** Database username */
define( 'DB_USER', 'u811466505_Q6Uv8' );

/** Database password */
define( 'DB_PASSWORD', 'AYMUBYCeSa' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          'e#lU9_`9h;-XQ$kuB;.8:l#$B8]&qWT6eeot*z!}@w{NZS2??SVkfMp#i<G(==N*' );
define( 'SECURE_AUTH_KEY',   't6u.Z,^oP1vA-5XruZ>#9Dn*#u1(&z.NVaZa2n$Or1PGqYT&3q3XB|v-J=ds1=px' );
define( 'LOGGED_IN_KEY',     'KA;FL^Uo>#K}5>f74_;+%J!fxOk8]tSj;zgwfj}: G$uQ)Gq7POwI2T_ZML8+X|F' );
define( 'NONCE_KEY',         ' c#c-_zuECz 3.5jD#i.bWF:0Q]ue[6o3^K-~a<,J/{c%V?o_K^tts4VjdtVY~<*' );
define( 'AUTH_SALT',         'v}eUW+l{]ju&=Z*b=2S.)am)Ik.z-QZ4=7D18wN|--{r&Q-hvXOYS5=3rs5wr*s0' );
define( 'SECURE_AUTH_SALT',  '$kX$ZBx7f ll|I;++=3[9A#D+K+IJ6):J+athYklY)AS?PN,)}192BOtGt,5@>#x' );
define( 'LOGGED_IN_SALT',    'D@ki%wa|1UQ4)yj<Z<>#kn4ION]lt)!cH47t~r=c]w+_KvW6Ha#B^7Xb0mJZNfhS' );
define( 'NONCE_SALT',        '7}YMX[f%L/W;WDG@fRHqD XG^^@Mp]+{u3#{WIk@wk:A&)`rS(x.dbp(#a@YuCdf' );
define( 'WP_CACHE_KEY_SALT', 'f>Yp4P~Ph <GY]5V_}xnx,H7tR4`:0C{:x&D]VHhX]n0CXW!#TJ2#3$l- P~pP*U' );


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



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
