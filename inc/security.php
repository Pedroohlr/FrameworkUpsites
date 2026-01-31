<?php
/**
 * Security Enhancements
 * 
 * Melhorias de segurança para o tema
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove versão do WordPress de scripts e estilos
 */
function frameworkupsites_remove_version_from_assets($src) {
    if (strpos($src, 'ver=' . get_bloginfo('version'))) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'frameworkupsites_remove_version_from_assets', 10, 2);
add_filter('script_loader_src', 'frameworkupsites_remove_version_from_assets', 10, 2);

/**
 * Remove meta generator do WordPress
 */
remove_action('wp_head', 'wp_generator');

/**
 * Desabilita edição de arquivos no admin
 */
if (!defined('DISALLOW_FILE_EDIT')) {
    define('DISALLOW_FILE_EDIT', true);
}

/**
 * Adiciona cabeçalhos de segurança
 */
function frameworkupsites_security_headers() {
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('X-XSS-Protection: 1; mode=block');
    header('Referrer-Policy: strict-origin-when-cross-origin');
}
add_action('send_headers', 'frameworkupsites_security_headers');

/**
 * Remove informações de erro de login
 */
function frameworkupsites_failed_login() {
    return 'Login inválido. Por favor, tente novamente.';
}
add_filter('login_errors', 'frameworkupsites_failed_login');

/**
 * Adiciona rel="noopener noreferrer" em links externos
 */
function frameworkupsites_add_noopener($content) {
    $pattern = '/<a([^>]*) href=["\']([^"\']+)["\']([^>]*)>/i';
    
    return preg_replace_callback($pattern, function($matches) {
        $link = $matches[0];
        $href = $matches[2];
        
        // Verifica se é link externo
        $site_url = parse_url(home_url());
        $link_url = parse_url($href);
        
        if (isset($link_url['host']) && $link_url['host'] !== $site_url['host']) {
            // Verifica se já tem target="_blank"
            if (strpos($link, 'target="_blank"') !== false || strpos($link, "target='_blank'") !== false) {
                // Adiciona rel se não tiver
                if (strpos($link, 'rel=') === false) {
                    $link = str_replace('<a', '<a rel="noopener noreferrer"', $link);
                } else {
                    // Adiciona noopener noreferrer ao rel existente
                    $link = preg_replace('/rel=["\']([^"\']+)["\']/', 'rel="$1 noopener noreferrer"', $link);
                }
            }
        }
        
        return $link;
    }, $content);
}
add_filter('the_content', 'frameworkupsites_add_noopener');

/**
 * Sanitiza inputs de busca
 */
function frameworkupsites_sanitize_search($query) {
    if ($query->is_search && !is_admin()) {
        $search = trim($query->get('s'));
        $search = sanitize_text_field($search);
        $query->set('s', $search);
    }
    return $query;
}
add_filter('pre_get_posts', 'frameworkupsites_sanitize_search');

/**
 * Limita tentativas de login (básico)
 * Para produção, use um plugin dedicado como Wordfence
 */
function frameworkupsites_limit_login_attempts() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'login_attempts_' . md5($ip);
    $attempts = get_transient($transient_key);
    
    if ($attempts && $attempts >= 5) {
        wp_die(
            'Muitas tentativas de login. Por favor, aguarde 15 minutos.',
            'Bloqueado',
            array('response' => 403)
        );
    }
}
add_action('wp_login_failed', function() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'login_attempts_' . md5($ip);
    $attempts = get_transient($transient_key);
    
    if (!$attempts) {
        set_transient($transient_key, 1, 15 * MINUTE_IN_SECONDS);
    } else {
        set_transient($transient_key, $attempts + 1, 15 * MINUTE_IN_SECONDS);
    }
});

// Reseta contador em login bem-sucedido
add_action('wp_login', function() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $transient_key = 'login_attempts_' . md5($ip);
    delete_transient($transient_key);
});

/**
 * Oculta mensagem de erro detalhada do WordPress
 */
function frameworkupsites_hide_wp_errors() {
    return 'Ocorreu um erro. Por favor, contate o administrador.';
}
add_filter('wp_die_handler', function() {
    return 'frameworkupsites_hide_wp_errors';
}, 10, 3);

/**
 * Desabilita listagem de diretórios
 */
function frameworkupsites_disable_directory_browsing() {
    if (!is_admin()) {
        $htaccess = ABSPATH . '.htaccess';
        
        if (is_writable($htaccess)) {
            $content = file_get_contents($htaccess);
            
            if (strpos($content, 'Options -Indexes') === false) {
                $content = "Options -Indexes\n" . $content;
                file_put_contents($htaccess, $content);
            }
        }
    }
}
// Removi o add_action pois pode não funcionar em todos os ambientes

/**
 * Sanitiza campos de formulário automaticamente
 */
function frameworkupsites_sanitize_form_data($data) {
    if (is_array($data)) {
        return array_map('frameworkupsites_sanitize_form_data', $data);
    }
    return sanitize_text_field($data);
}

/**
 * Proteção contra SQL Injection em queries customizadas
 * Sempre use $wpdb->prepare() em suas queries!
 */
function frameworkupsites_safe_query($query, ...$args) {
    global $wpdb;
    return $wpdb->prepare($query, ...$args);
}

