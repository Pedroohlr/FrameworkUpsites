<?php
/**
 * Integrações
 *
 * Google Analytics, Facebook Pixel, scripts custom, limpeza do head, etc.
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

/**
 * Limpa o head do WordPress (wp_generator está em security.php)
 */
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/**
 * Define número de posts por página no blog
 */
function frameworkupsites_posts_per_page($query)
{
  if (!is_admin() && $query->is_main_query() && (is_home() || is_archive())) {
    $query->set('posts_per_page', 12);
  }
}
add_action('pre_get_posts', 'frameworkupsites_posts_per_page');

/**
 * Altera o separador do título da página
 */
function frameworkupsites_document_title_separator($sep)
{
  return '|';
}
add_filter('document_title_separator', 'frameworkupsites_document_title_separator');

/**
 * Adiciona Google Analytics
 */
function frameworkupsites_add_google_analytics()
{
  $ga_id = get_option('frameworkupsites_google_analytics');

  if (!empty($ga_id) && !is_admin() && !current_user_can('manage_options')) {
    ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() { dataLayer.push(arguments); }
      gtag('js', new Date());
      gtag('config', '<?php echo esc_js($ga_id); ?>');
    </script>
    <?php
  }
}
add_action('wp_head', 'frameworkupsites_add_google_analytics');

/**
 * Adiciona Facebook Pixel
 */
function frameworkupsites_add_facebook_pixel()
{
  $pixel_id = get_option('frameworkupsites_facebook_pixel');

  if (!empty($pixel_id) && !is_admin() && !current_user_can('manage_options')) {
    ?>
    <!-- Facebook Pixel -->
    <script>
      !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () {
          n.callMethod ?
          n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
        n.queue = []; t = b.createElement(e); t.async = !0;
        t.src = v; s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '<?php echo esc_js($pixel_id); ?>');
      fbq('track', 'PageView');
    </script>
    <noscript>
      <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=<?php echo esc_attr($pixel_id); ?>&ev=PageView&noscript=1" />
    </noscript>
    <?php
  }
}
add_action('wp_head', 'frameworkupsites_add_facebook_pixel');

/**
 * Adiciona scripts customizados no header
 */
function frameworkupsites_add_header_scripts()
{
  $scripts = get_option('frameworkupsites_header_scripts');

  if (!empty($scripts) && !is_admin()) {
    echo $scripts;
  }
}
add_action('wp_head', 'frameworkupsites_add_header_scripts', 100);

/**
 * Adiciona scripts customizados no footer
 */
function frameworkupsites_add_footer_scripts()
{
  $scripts = get_option('frameworkupsites_footer_scripts');

  if (!empty($scripts) && !is_admin()) {
    echo $scripts;
  }
}
add_action('wp_footer', 'frameworkupsites_add_footer_scripts', 100);

/**
 * Corrige links de menu com âncoras (#) em páginas internas
 */
function frameworkupsites_menu_anchor_links($atts, $item, $args)
{
  if (isset($atts['href']) && strpos($atts['href'], '#') === 0) {
    if (!is_front_page() && !is_page_template('pages/home.php')) {
      $atts['href'] = home_url('/') . $atts['href'];
    }
  }
  return $atts;
}
add_filter('nav_menu_link_attributes', 'frameworkupsites_menu_anchor_links', 10, 3);
