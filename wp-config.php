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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '10pearls' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('FS_METHOD', 'direct');


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+3SIk/$TPfwAWM6)Zb^ihes+u i3.hoF#`tP _KdQF[u|>M~0o+D>ryC(N,EGT_Q');
define('SECURE_AUTH_KEY',  'K/@iW{nAv+1HvA&,%(J[`<EexB@fz4.Xh~f&rDQ_^1i$uAvKSdT(36}|5w3Ctvuq');
define('LOGGED_IN_KEY',    'w1Dc!t,S#3qb1_r-5^3`+9?XOJgAIwp1eH_[6B(WbmVV&.q,@yKWTi&e{cu,Sw?C');
define('NONCE_KEY',        'c?G,ZST32I<5(BUv<_02CEt3 fI48}W+Lm7M^u:b_8+4APi[zQ1v{*VVPxP`G|wE');
define('AUTH_SALT',        'cN-/$RR&p]Y.bB,L|,;(Aqt:M$1<|IP&{a-r+e-_I/+=`|eN93Q;KJ(4;>-U3JQ]');
define('SECURE_AUTH_SALT', '>6`Y|9!v6j9^`:J(l?0krtjOJ-zk)#n&[t92Fg[1=|]Tz5p,63-b|x.AV4:6O6rb');
define('LOGGED_IN_SALT',   '^YK{%L.5?FBxRcG|?!AGK|1*?B3$`z}> +mM>Z0%3xQGsh1NUH,(tsqD35uJkP%0');
define('NONCE_SALT',       '%%Cd4eWL;~.Ua_iYQDtvbLB|7i,^u}Cwq4>F5+x@Oz94^KtPR][~a,gZ[E>,>YaF');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/var/www/html/wordpress/wp-load.php' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
