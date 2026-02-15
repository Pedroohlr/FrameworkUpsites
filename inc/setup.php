<?php
/**
 * Theme Setup
 *
 * Configurações iniciais do tema: suportes e menus
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

function frameworkupsites_setup()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ));

  add_theme_support('custom-logo', array(
    'height' => 100,
    'width' => 400,
    'flex-height' => true,
    'flex-width' => true,
  ));

  register_nav_menus(array(
    'primary' => __('Menu Principal', 'frameworkupsites'),
    'footer' => __('Menu Rodapé', 'frameworkupsites'),
  ));

  add_theme_support('woocommerce');
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'frameworkupsites_setup');
