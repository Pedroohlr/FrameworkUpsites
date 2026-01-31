<?php
/**
 * FrameworkUpsites Functions and Definitions
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define constantes do tema
define('FRAMEWORKTEMA_VERSION', '1.0.0');
define('FRAMEWORKTEMA_DIR', get_template_directory());
define('FRAMEWORKTEMA_URI', get_template_directory_uri());

// Inclui arquivos necessários
require_once FRAMEWORKTEMA_DIR . '/inc/class-walker-nav-menu.php';
require_once FRAMEWORKTEMA_DIR . '/inc/theme-options.php';
require_once FRAMEWORKTEMA_DIR . '/inc/helpers.php';
require_once FRAMEWORKTEMA_DIR . '/inc/shortcodes.php';
require_once FRAMEWORKTEMA_DIR . '/inc/performance.php';
require_once FRAMEWORKTEMA_DIR . '/inc/security.php';

/**
 * Configuração do tema
 */
function frameworkupsites_setup() {
    // Adiciona suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Adiciona suporte a imagens destacadas
    add_theme_support('post-thumbnails');
    
    // Adiciona suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    
    // Adiciona suporte a logo customizado
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Registra menu
    register_nav_menus(array(
        'primary' => __('Menu Principal', 'frameworkupsites'),
        'footer'  => __('Menu Rodapé', 'frameworkupsites'),
    ));
    
    // Adiciona suporte a WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'frameworkupsites_setup');

/**
 * Enfileira scripts e estilos
 */
function frameworkupsites_enqueue_scripts() {
    // Google Fonts - Readex Pro
    wp_enqueue_style(
        'frameworkupsites-google-fonts',
        'https://fonts.googleapis.com/css2?family=Readex+Pro:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );
    
    // Font Awesome
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
    
    // Tailwind CSS - arquivo compilado
    wp_enqueue_style(
        'frameworkupsites-tailwind',
        FRAMEWORKTEMA_URI . '/assets/css/tailwind.css',
        array(),
        FRAMEWORKTEMA_VERSION
    );
    
    // Style principal do tema
    wp_enqueue_style(
        'frameworkupsites-style',
        get_stylesheet_uri(),
        array('frameworkupsites-tailwind'),
        FRAMEWORKTEMA_VERSION
    );
    
    // Script principal do tema
    wp_enqueue_script(
        'frameworkupsites-main',
        FRAMEWORKTEMA_URI . '/assets/js/main.js',
        array('jquery'), // Adiciona jQuery como dependência
        FRAMEWORKTEMA_VERSION,
        true // Carrega no footer
    );
    
    // jQuery (se necessário)
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'frameworkupsites_enqueue_scripts');

/**
 * Registra automaticamente todos os templates da pasta pages/
 */
function frameworkupsites_register_page_templates($templates) {
    $pages_dir = FRAMEWORKTEMA_DIR . '/pages';
    
    if (!is_dir($pages_dir)) {
        return $templates;
    }
    
    $files = glob($pages_dir . '/*.php');
    
    foreach ($files as $file) {
        $filename = basename($file, '.php');
        
        // Lê o cabeçalho do arquivo para pegar o nome do template
        $file_data = get_file_data($file, array(
            'Template Name' => 'Template Name',
        ));
        
        if (!empty($file_data['Template Name'])) {
            $template_name = $file_data['Template Name'];
        } else {
            // Se não tiver Template Name, cria um nome baseado no arquivo
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
function frameworkupsites_load_page_template($template) {
    $page_template = get_post_meta(get_the_ID(), '_wp_page_template', true);
    
    if (strpos($page_template, 'pages/') === 0) {
        $custom_template = FRAMEWORKTEMA_DIR . '/' . $page_template;
        
        if (file_exists($custom_template)) {
            return $custom_template;
        }
    }
    
    return $template;
}
add_filter('template_include', 'frameworkupsites_load_page_template', 99);

/**
 * Função helper para incluir parts
 */
function get_part($part_name, $variables = array()) {
    $part_file = FRAMEWORKTEMA_DIR . '/parts/' . $part_name . '.php';
    
    if (file_exists($part_file)) {
        // Extrai variáveis para o escopo do template
        if (!empty($variables)) {
            extract($variables);
        }
        
        include $part_file;
    } else {
        echo "<!-- Part não encontrado: {$part_name} -->";
    }
}

/**
 * Registra sidebar/widget areas
 */
function frameworkupsites_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar Principal', 'frameworkupsites'),
        'id'            => 'sidebar-1',
        'description'   => __('Adicione widgets aqui.', 'frameworkupsites'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer 1', 'frameworkupsites'),
        'id'            => 'footer-1',
        'description'   => __('Widget area do rodapé 1', 'frameworkupsites'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'frameworkupsites_widgets_init');

/**
 * Configurações adicionais do WooCommerce
 */
if (class_exists('WooCommerce')) {
    /**
     * Remove wrapper padrão do WooCommerce
     */
    remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    
    /**
     * Adiciona wrapper customizado do WooCommerce
     */
    function gridtheme_woocommerce_wrapper_start() {
        echo '<div class="container mx-auto px-4 py-8">';
    }
    add_action('woocommerce_before_main_content', 'gridtheme_woocommerce_wrapper_start', 10);
    
    function gridtheme_woocommerce_wrapper_end() {
        echo '</div>';
    }
    add_action('woocommerce_after_main_content', 'gridtheme_woocommerce_wrapper_end', 10);
    
    /**
     * Define número de produtos por página
     */
    function gridtheme_products_per_page() {
        return 12;
    }
    add_filter('loop_shop_per_page', 'gridtheme_products_per_page', 20);
}

/**
 * Define número de posts por página no blog
 */
function gridtheme_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && (is_home() || is_archive())) {
        $query->set('posts_per_page', 12);
    }
}
add_action('pre_get_posts', 'gridtheme_posts_per_page');

/**
 * Altera o separador do título da página
 */
function gridtheme_document_title_separator($sep) {
    return '|';
}
add_filter('document_title_separator', 'gridtheme_document_title_separator');

/**
 * Limpa o head do WordPress de códigos desnecessários
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
// Mantém wp_shortlink_wp_head pois alguns plugins podem precisar
// remove_action('wp_head', 'wp_shortlink_wp_head');

/**
 * Função helper para obter URL de imagem otimizada
 */
function gridtheme_get_image_url($image_id, $size = 'full') {
    if (!$image_id) {
        return '';
    }
    
    $image = wp_get_attachment_image_src($image_id, $size);
    return $image ? $image[0] : '';
}

/**
 * Adiciona Google Analytics
 */
function gridtheme_add_google_analytics() {
    $ga_id = get_option('gridtheme_google_analytics');
    
    if (!empty($ga_id) && !is_admin() && !current_user_can('manage_options')) {
        ?>
        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?php echo esc_js($ga_id); ?>');
        </script>
        <?php
    }
}
add_action('wp_head', 'gridtheme_add_google_analytics');

/**
 * Adiciona Facebook Pixel
 */
function gridtheme_add_facebook_pixel() {
    $pixel_id = get_option('gridtheme_facebook_pixel');
    
    if (!empty($pixel_id) && !is_admin() && !current_user_can('manage_options')) {
        ?>
        <!-- Facebook Pixel -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '<?php echo esc_js($pixel_id); ?>');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1" style="display:none" 
                 src="https://www.facebook.com/tr?id=<?php echo esc_attr($pixel_id); ?>&ev=PageView&noscript=1"/>
        </noscript>
        <?php
    }
}
add_action('wp_head', 'gridtheme_add_facebook_pixel');

/**
 * Adiciona scripts customizados no header
 */
function gridtheme_add_header_scripts() {
    $scripts = get_option('gridtheme_header_scripts');
    
    if (!empty($scripts) && !is_admin()) {
        echo $scripts;
    }
}
add_action('wp_head', 'gridtheme_add_header_scripts', 100);

/**
 * Adiciona scripts customizados no footer
 */
function gridtheme_add_footer_scripts() {
    $scripts = get_option('gridtheme_footer_scripts');
    
    if (!empty($scripts) && !is_admin()) {
        echo $scripts;
    }
}
add_action('wp_footer', 'gridtheme_add_footer_scripts', 100);

/**
 * Modifica links de menu com âncoras (#) para funcionar corretamente
 * Se o link começa com #, adiciona a URL da home antes da âncora quando não estiver na home
 */
function gridtheme_menu_anchor_links($atts, $item, $args) {
    // Verifica se o link começa com #
    if (isset($atts['href']) && strpos($atts['href'], '#') === 0) {
        // Se não estiver na home, adiciona a URL da home antes da âncora
        if (!is_front_page() && !is_page_template('pages/home.php')) {
            $atts['href'] = home_url('/') . $atts['href'];
        }
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'gridtheme_menu_anchor_links', 10, 3);