<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'mkd_15729588_wp');

/** MySQL database username */
define('DB_USER', 'mkd_15729588');

/** MySQL database password */
define('DB_PASSWORD', '1234567890');

/** MySQL hostname */
define('DB_HOST', 'sql306.con.mk');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'OMlm|y6po;m5{8/B7sInVf]r0L(&D.W$OpgfP!nR;!El*46br-M(w_]R1tLbNiJr');
define('SECURE_AUTH_KEY',  '2hR%lps?u]gwpAaOj+c478wr{?vaArKd)Dp+f>J}5q:bOM9C!&^>]l`[I7E{Q%Ql');
define('LOGGED_IN_KEY',    'D&Ww`pO|Yi>bse/w/y`~7V}6@.[HM|(ur_jkKWB97<=s,y(^f#:R$b/LraJNQ>4g');
define('NONCE_KEY',        '4Oy,U{IRr-^HxJAPhnZu+W;_>(;mL)CVuIt[|V+sL+N8!K;c:;9QL3BzcZ:2in;~');
define('AUTH_SALT',        'a,EN@-mRuYRbv[n[qgtC>zch;hT3C97>[lh[Oxiq(].M(MW<9NE&m[=#7l|TY`|@');
define('SECURE_AUTH_SALT', '?P;gc,SD3|(z?rSvfg|-+{!@EL R44)-L!;wkF=:kGm.%Zg;=x57S?!nDM|[I?`_');
define('LOGGED_IN_SALT',   'uB~8/rnvvPnCZQ`U]MD8!uKggtW|EM3Q25Xbw([E/^.#*;6H*B8y5o20,l;#==.{');
define('NONCE_SALT',       'c(lzbh,$b6%?FADf:XR>;UbFk+vn^AH?!L}GHqhAHcWv1HnJEDM3QFl(*K&T|;,O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
