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
define( 'DB_NAME', 'comercifrenel' );

/** MySQL database username */
define( 'DB_USER', 'forge' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Q2b2TQEDvfeD0jiIyF6R' );

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
define( 'AUTH_KEY',         '6cb~,.I hTz,g=9#8;!}6p=!A1J Bh-nQ/;E}=k2uIa{X3A$I^dGTjPSa/G0yu3=' );
define( 'SECURE_AUTH_KEY',  '-30s$Mq-5Q>Uwg?`Fy$>q}Z&}b#T`+etQ`xOM|~E#Vwg I5ac_e$Cv*21v2;<HSN' );
define( 'LOGGED_IN_KEY',    '.?{Y}S@)/&(C2&GJzB|R6xn$0&?fnOuAYv]T[,wc@IC*o =Xq/B+Or7l&@T0+&B#' );
define( 'NONCE_KEY',        'ON2)43  rD9sZF=W7Z0N=RD0|lg4bN]Gf?YWgG`J2&hUS5R~(L@(AE{Uma4kpNac' );
define( 'AUTH_SALT',        '$6/]AZQ8{?yM?ZX( b2#pBFKkc+roT=Dp*[:f|hvyVTV<]mwu,(KvktKI4,8C^De' );
define( 'SECURE_AUTH_SALT', 'gsQ6@214~h58%:~#_vt)(S)$T#BbEgA^vrS{Kdl:7/?gIw1ld.3XV0 9ld-o(rFj' );
define( 'LOGGED_IN_SALT',   'N$G__xZ 5JO]<h5;F$G0O5aEQ7Cc8w_S@%!=3an[5H40l]D.>@h#b[A)DUKAEj6C' );
define( 'NONCE_SALT',       '(Al?le8wi*D`~]IU`69jw8U^[U^M%WXi#rz*- IR-]PG_156Xq}!.&$euh/[+7FK' );

//define('ALLOW_UNFILTERED_UPLOADS', true); // TODO: codigo para subir tipos de archivos de diferentes extensiones

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'lb_';

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
