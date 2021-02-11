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
define( 'DB_NAME', 'agriview_new' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'e<QCG}Z8TzK%a$oN-v:!Pa&pbv/2!EJIbW(V_4T2.cm9-vY8]dL9S+:PuSJ ~]YG' );
define( 'SECURE_AUTH_KEY',  'Efp2`]cD<DY%@6Y@uk*q9cr6g9!AC{N<Q_*MvefLs!QCuo$4]nQQo,J1l-:;mGf|' );
define( 'LOGGED_IN_KEY',    'F_rTC@st6k1W|HBYRmg;}Gn;J*beD)[wySPjMq`[{Qx@Ak)2%AQj{Li~Lr`R@Wj#' );
define( 'NONCE_KEY',        'LvLW_0`p[k<E#A_[J#fBi_!QA$IX$<Rr+S*)?i{`EFS51|H1~9Ka}!Pl!7O<;DbC' );
define( 'AUTH_SALT',        '[+#+kCfo|7bSbQw;[jwg mt5JFiC<?s`Ny9jx@mo$i1[)7|C.]vSO[h`eDno|1k?' );
define( 'SECURE_AUTH_SALT', '}I;pqHJ6p)` RFzd{0|ow}L0ozjzM`le,4`oyzl0Mer@LU<C;{Lg;dQAyP@pEA*P' );
define( 'LOGGED_IN_SALT',   '@se38fHq?g.-N6lzvl@ND}].$/K|tX}t `Y|YP2mZTq^HZx[Id=@8~2r9@ ,l2_ ' );
define( 'NONCE_SALT',       '1EbFk9~!^tHy]{/3a002(~w/CgAk)C]<w.b@EXLt:N49*yK1y@P;}#H:_&$ekl}0' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'agriview_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
