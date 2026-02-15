<?php
/**
 * FrameworkUpsites - Bootstrap
 *
 * Carrega constantes e módulos do tema.
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

define('FRAMEWORKUPSITES_VERSION', '1.0.0');
define('FRAMEWORKUPSITES_DIR', get_template_directory());
define('FRAMEWORKUPSITES_URI', get_template_directory_uri());

$inc = FRAMEWORKUPSITES_DIR . '/inc';

require_once $inc . '/class-walker-nav-menu.php';
require_once $inc . '/setup.php';
require_once $inc . '/enqueue.php';
require_once $inc . '/templates.php';
require_once $inc . '/sidebars.php';
require_once $inc . '/theme-options.php';
require_once $inc . '/helpers.php';
require_once $inc . '/shortcodes.php';
require_once $inc . '/performance.php';
require_once $inc . '/security.php';
require_once $inc . '/woocommerce.php';
require_once $inc . '/integrations.php';
