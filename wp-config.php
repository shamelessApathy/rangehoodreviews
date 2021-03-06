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
define('DB_NAME', 'rhr_live');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'c88b856d09836b07d8a391a1bd83d326051754ba6aeb54bb');

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
define('AUTH_KEY',         'vVf&j,u6L2uDLw%83x;Cz1WXa/zUU1;hYN^[O(<dfukq[xG:NAs$6-h7e%8ON@Xx');
define('SECURE_AUTH_KEY',  'D~*!MEmSPRW%Nb1bcO,-){v0t;AWtzBA%%BMYEG 8_azAz4ncAj!^{&xYnH=r<Ni');
define('LOGGED_IN_KEY',    '-nNqZq,>w`54Rnx*s|@7DO^I%P2(GG/~~pAn|=:3O>3Q%9ojOQrf1j|{Os#H9%x9');
define('NONCE_KEY',        'k>tH6IYpgnFY0)Vs8aPP0!503d+$5z.-Te8*yYVtw7Mg{74<cH[6aVuoHW6vLQ.p');
define('AUTH_SALT',        '5YemR7~[Xsob30Y)iTBsjMtVpLLx`W%#`ovgn]t>TOt!!YStv-j(hx0D6?>=DKD#');
define('SECURE_AUTH_SALT', '=~k=z3KN7qHY@2[Qi%X*V[>|eTe):CMt6ax?VP6`.pkPR>u?E5yuKVM{jrGQj_iI');
define('LOGGED_IN_SALT',   'OB#n^W%RdLd49<2Mxx,/c7+F@uXm3J:ZgDqK|a43hv3(nm=W:vTg?Ng*4V0Kb463');
define('NONCE_SALT',       '|1_+aX_G#<%mK7ov=##0,H&FP7-jJWhwm-U/9olB]~qP+m,?5L<bJ-0zYKFj,/>_');

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
