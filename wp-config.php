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
define('DB_NAME', 'wordpress-test');

/** MySQL database username */
define('DB_USER', 'yunus');

/** MySQL database password */
define('DB_PASSWORD', '123');

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
define('AUTH_KEY',         'iIjlA>uETh;|=Gkmrt7;teRk;O/Xz.sd&?m(lZ18~UN4%7d>%s)PZlaKLz*dE#h4');
define('SECURE_AUTH_KEY',  '!BBJc4XID?$W;z|5ZK(~nmW9:6`5f,d:%BCE>?c{ bI*nU8Z#9FG%/7a)33G8[O%');
define('LOGGED_IN_KEY',    'q,JBH*CM.7-eXUjBm27F}VfIf>v#J#Wz`pXV}9:}j~{>6;NRL[yB-[(5-kwv[y^D');
define('NONCE_KEY',        '3[vy2,E%;Z6LN*2^A6)qKM_f$-~n:ogFShTo7^rop?@?}ICBbgPe[aK83OdJ^BP/');
define('AUTH_SALT',        '0;lfv]ICr$Ix#*C!_Yqd,_x$(<lElKld`ZiBH(2_+S8+kQ]X[n!bo<m-?+=t%:D[');
define('SECURE_AUTH_SALT', '97( u|FL5Ep):byQM>x>sdc<Onms-}Z4#LH{T.8x_v?E@x$i9V&m8OU(`:P99Lip');
define('LOGGED_IN_SALT',   'oS:@;?TxSZ;k[K=o1D,q^_iqu%WiobOuj]TRIq?n_{:4<Rpp(T*+<Bwn?Ri.(tT1');
define('NONCE_SALT',       '@We{!&.6Im:`N[f}Ucqb!1?4ush]Ag%Wu_lhCg,gx=Xq{E5-J]+ob}|}#,k( >*/');

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
