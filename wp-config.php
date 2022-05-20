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
define( 'DB_NAME', 'invxadmin_dev_cdi' );

/** Database username */
define( 'DB_USER', 'invxadmin_develop' );

/** Database password */
define( 'DB_PASSWORD', 'Develop@1234' );

/** Database hostname */
define( 'DB_HOST', 'inovexiasoftware.in' );

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
define( 'AUTH_KEY',         'z<`0T3%Bc3J]z-fEOZ%L<BTcI4Sgy+q#cvtAb-Sia_NCC~kgEwM7|&>D%zHg|Km0' );
define( 'SECURE_AUTH_KEY',  'C]?+pWO4AUS+C%Im{1^f[Aa;s;BUb]yQfVV(m !L2>pRR<m@T;3z0(Q<4+lh{F0A' );
define( 'LOGGED_IN_KEY',    'zDk#7x!8J(eG-{D3f@|)JsSJvMibQqc<*=W sU{7T@vAY1u-4DO4yovq7MEPsiIm' );
define( 'NONCE_KEY',        'd9-QS5=u)2r.R>O b6[Alh;ZK>*@OtD0dT?SX&~yu&JU?=[QP+G=h5<~KD2SYL8U' );
define( 'AUTH_SALT',        '-/:gIJAiTqp`;o@(}6{*D{3n4LOu#&8%CS&TpUThW4F|~+aJ*QcPeje#Qw,yE`Ej' );
define( 'SECURE_AUTH_SALT', 'I#6}}-)>.-kaL2ncR7._}5C,~{E^BP&f8H3sPT* %IY/kHg1$1@5gH?URcwk35i2' );
define( 'LOGGED_IN_SALT',   '*yf(spYd:(krtsr]~IRp*-puB|n!)aEl3*k6$+aqnH9Q&SqwijtKzPOZNT7A N~<' );
define( 'NONCE_SALT',       '+.?+CldeGiK)$W`y~mr[FN}DGGz*rl-rk#}MPZ-/_=.;tq!hx+-b7vLY<9_?&C<B' );


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

define( 'WP_SITEURL', 'http://localhost/dev/cdi-latest' );
define( 'WP_HOME', 'http://localhost/dev/cdi-latest' );


/* That's all, stop editing! Happy publishing. */
/** Absolute path to the WordPress directory. */

if ( ! defined( 'ABSPATH' ) ) {

	define( 'ABSPATH', __DIR__ . '/' );

}
/** Sets up WordPress vars and included files. */

require_once ABSPATH . 'wp-settings.php';
