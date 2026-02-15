<?php
/**
 * Scripts e Estilos
 *
 * Enfileiramento de CSS e JavaScript do tema
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Enfileira scripts e estilos
 */
function frameworkupsites_enqueue_scripts()
{
  wp_enqueue_style(
    'frameworkupsites-google-fonts',
    'https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300;400;500;600;700&display=swap',
    array(),
    null
  );

  wp_enqueue_style(
    'font-awesome',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
    array(),
    '6.5.1'
  );

  wp_enqueue_style(
    'frameworkupsites-tailwind',
    FRAMEWORKUPSITES_URI . '/assets/css/tailwind.css',
    array(),
    FRAMEWORKUPSITES_VERSION
  );

  wp_enqueue_style(
    'frameworkupsites-style',
    get_stylesheet_uri(),
    array('frameworkupsites-tailwind'),
    FRAMEWORKUPSITES_VERSION
  );

  wp_enqueue_script(
    'frameworkupsites-main',
    FRAMEWORKUPSITES_URI . '/assets/js/main.js',
    array('jquery'),
    FRAMEWORKUPSITES_VERSION,
    true
  );

  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'frameworkupsites_enqueue_scripts');
