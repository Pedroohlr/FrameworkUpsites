<?php
/**
 * Sidebars e Widget Areas
 *
 * Registro de áreas de widgets do tema
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Registra sidebars/widget areas
 */
function frameworkupsites_widgets_init()
{
  register_sidebar(array(
    'name' => __('Sidebar Principal', 'frameworkupsites'),
    'id' => 'sidebar-1',
    'description' => __('Adicione widgets aqui.', 'frameworkupsites'),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => '</section>',
    'before_title' => '<h2 class="widget-title">',
    'after_title' => '</h2>',
  ));

  register_sidebar(array(
    'name' => __('Footer 1', 'frameworkupsites'),
    'id' => 'footer-1',
    'description' => __('Widget area do rodapé 1', 'frameworkupsites'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
add_action('widgets_init', 'frameworkupsites_widgets_init');
