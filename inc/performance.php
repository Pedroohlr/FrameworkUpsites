<?php
/**
 * Performance Optimizations
 * 
 * Otimizações para melhorar o desempenho do site
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove emojis se ativado nas opções
 */
if (get_option('frameworkupsites_disable_emojis')) {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    add_filter('tiny_mce_plugins', function($plugins) {
        return is_array($plugins) ? array_diff($plugins, array('wpemoji')) : array();
    });
    
    add_filter('wp_resource_hints', function($urls, $relation_type) {
        if ('dns-prefetch' == $relation_type) {
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
            $urls = array_diff($urls, array($emoji_svg_url));
        }
        return $urls;
    }, 10, 2);
}

/**
 * Remove WordPress Embeds se ativado nas opções
 */
if (get_option('frameworkupsites_disable_embeds')) {
    function frameworkupsites_disable_embeds_init() {
        global $wp;
        $wp->public_query_vars = array_diff($wp->public_query_vars, array('embed'));
        remove_action('rest_api_init', 'wp_oembed_register_route');
        add_filter('embed_oembed_discover', '__return_false');
        remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links');
        remove_action('wp_head', 'wp_oembed_add_host_js');
        add_filter('tiny_mce_plugins', function($plugins) {
            return array_diff($plugins, array('wpembed'));
        });
        add_filter('rewrite_rules_array', function($rules) {
            foreach($rules as $rule => $rewrite) {
                if(false !== strpos($rewrite, 'embed=true')) {
                    unset($rules[$rule]);
                }
            }
            return $rules;
        });
        remove_filter('pre_oembed_result', 'wp_filter_pre_oembed_result', 10);
    }
    add_action('init', 'frameworkupsites_disable_embeds_init', 9999);
}

/**
 * Lazy Loading de imagens (HTML nativo)
 */
if (get_option('frameworkupsites_lazy_load')) {
    add_filter('wp_get_attachment_image_attributes', function($attr) {
        if (!isset($attr['loading'])) {
            $attr['loading'] = 'lazy';
        }
        return $attr;
    });
    
    add_filter('the_content', function($content) {
        if (!is_admin()) {
            $content = preg_replace('/<img/', '<img loading="lazy"', $content);
        }
        return $content;
    });
}

/**
 * Remove query strings de assets estáticos
 * IMPORTANTE: Não remove query strings de plugins para evitar conflitos
 */
function frameworkupsites_remove_query_strings($src) {
    // Não remove query strings de plugins
    if (strpos($src, '/plugins/') !== false) {
        return $src;
    }
    
    $parts = explode('?ver', $src);
    return $parts[0];
}
add_filter('script_loader_src', 'frameworkupsites_remove_query_strings', 15);
add_filter('style_loader_src', 'frameworkupsites_remove_query_strings', 15);

/**
 * Defer JavaScript não crítico
 * IMPORTANTE: Não aplica defer em scripts de plugins para evitar conflitos
 */
function frameworkupsites_defer_scripts($tag, $handle, $src) {
    // Lista de scripts que NÃO devem ter defer (incluindo plugins comuns)
    $no_defer = array(
        'jquery', 
        'jquery-core', 
        'jquery-migrate',
        'wp-embed',
        'wp-api',
        'wp-api-fetch',
        'wp-element',
        'wp-components',
        'wp-blocks',
        'wp-editor',
        'wp-i18n',
        'wp-hooks',
        'wp-data',
        'wp-dom-ready',
        'wp-polyfill'
    );
    
    // Não aplica defer em scripts de plugins (identificados por padrões comuns)
    if (strpos($handle, 'plugin-') !== false || 
        strpos($handle, 'elementor') !== false ||
        strpos($handle, 'woocommerce') !== false ||
        strpos($handle, 'contact-form') !== false ||
        strpos($handle, 'cf7') !== false ||
        strpos($handle, 'ninja') !== false ||
        strpos($handle, 'gravity') !== false ||
        strpos($handle, 'wpcf7') !== false ||
        strpos($src, '/plugins/') !== false ||
        in_array($handle, $no_defer)) {
        return $tag;
    }
    
    // Aplica defer apenas em scripts do próprio tema
    if (strpos($src, get_template_directory_uri()) !== false) {
        return str_replace(' src', ' defer src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'frameworkupsites_defer_scripts', 10, 3);

/**
 * Preconnect a recursos externos
 */
function frameworkupsites_resource_hints($hints, $relation_type) {
    if ('preconnect' === $relation_type) {
        $hints[] = array(
            'href' => 'https://fonts.googleapis.com',
            'crossorigin',
        );
        $hints[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $hints;
}
add_filter('wp_resource_hints', 'frameworkupsites_resource_hints', 10, 2);

/**
 * Remove versão do WordPress do head
 */
remove_action('wp_head', 'wp_generator');

/**
 * Desativa XML-RPC se não for necessário
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Limita revisões de posts
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Aumenta tempo de autosave
 */
if (!defined('AUTOSAVE_INTERVAL')) {
    define('AUTOSAVE_INTERVAL', 300); // 5 minutos
}

/**
 * Otimiza queries do WordPress
 */
function frameworkupsites_optimize_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Remove campos desnecessários
        $query->set('no_found_rows', true);
        
        // Desativa update post term cache se não for necessário
        $query->set('update_post_term_cache', false);
    }
}
add_action('pre_get_posts', 'frameworkupsites_optimize_queries');

/**
 * Limpa wp_head de tags desnecessárias
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'feed_links_extra', 3);

/**
 * Adiciona atributos async/defer nos scripts
 */
function frameworkupsites_async_scripts($tag, $handle) {
    $async_scripts = array('frameworkupsites-main'); // Adicione handles aqui
    
    if (in_array($handle, $async_scripts)) {
        return str_replace(' src', ' async src', $tag);
    }
    
    return $tag;
}
add_filter('script_loader_tag', 'frameworkupsites_async_scripts', 10, 2);

