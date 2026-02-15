<?php
/**
 * Page Templates e Parts
 *
 * Registro automático de templates e função para incluir parts
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Registra automaticamente todos os templates da pasta pages/
 */
function frameworkupsites_register_page_templates($templates)
{
  $pages_dir = FRAMEWORKUPSITES_DIR . '/pages';

  if (!is_dir($pages_dir)) {
    return $templates;
  }

  $files = glob($pages_dir . '/*.php');

  foreach ($files as $file) {
    $filename = basename($file, '.php');
    $file_data = get_file_data($file, array(
      'Template Name' => 'Template Name',
    ));

    if (!empty($file_data['Template Name'])) {
      $template_name = $file_data['Template Name'];
    } else {
      $template_name = ucwords(str_replace(array('-', '_'), ' ', $filename));
    }

    $templates['pages/' . $filename . '.php'] = $template_name;
  }

  return $templates;
}
add_filter('theme_page_templates', 'frameworkupsites_register_page_templates');

/**
 * Carrega o template correto da pasta pages/
 */
function frameworkupsites_load_page_template($template)
{
  $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);

  if (strpos($page_template, 'pages/') === 0) {
    $custom_template = FRAMEWORKUPSITES_DIR . '/' . $page_template;

    if (file_exists($custom_template)) {
      return $custom_template;
    }
  }

  return $template;
}
add_filter('template_include', 'frameworkupsites_load_page_template', 99);

/**
 * Inclui um part (componente) da pasta parts/
 *
 * @param string $part_name Nome do arquivo sem .php (ex: 'cta', 'page-hero')
 * @param array  $variables Variáveis disponíveis no escopo do part
 */
function get_part($part_name, $variables = array())
{
  $part_file = FRAMEWORKUPSITES_DIR . '/parts/' . $part_name . '.php';

  if (file_exists($part_file)) {
    if (!empty($variables)) {
      extract($variables);
    }
    include $part_file;
  } else {
    echo "<!-- Part não encontrado: {$part_name} -->";
  }
}
