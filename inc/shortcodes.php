<?php
/**
 * Shortcodes
 * 
 * Shortcodes reutilizáveis para usar no editor
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Shortcode: Botão
 * 
 * Uso: [button url="#" text="Clique aqui" style="primary" size="md"]
 */
function frameworkupsites_button_shortcode($atts) {
    $atts = shortcode_atts(array(
        'url'    => '#',
        'text'   => 'Clique aqui',
        'style'  => 'primary', // primary, secondary, outline
        'size'   => 'md',      // sm, md, lg
        'target' => '_self',
        'class'  => '',
    ), $atts);
    
    $size_classes = array(
        'sm' => 'px-4 py-2 text-sm',
        'md' => 'px-6 py-3',
        'lg' => 'px-8 py-4 text-lg',
    );
    
    $style_classes = array(
        'primary'   => 'bg-blue-600 text-white hover:bg-blue-700',
        'secondary' => 'bg-gray-200 text-gray-900 hover:bg-gray-300',
        'outline'   => 'border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white',
    );
    
    $size_class = isset($size_classes[$atts['size']]) ? $size_classes[$atts['size']] : $size_classes['md'];
    $style_class = isset($style_classes[$atts['style']]) ? $style_classes[$atts['style']] : $style_classes['primary'];
    
    $output = sprintf(
        '<a href="%s" target="%s" class="inline-block rounded-lg font-semibold transition %s %s %s">%s</a>',
        esc_url($atts['url']),
        esc_attr($atts['target']),
        $size_class,
        $style_class,
        esc_attr($atts['class']),
        esc_html($atts['text'])
    );
    
    return $output;
}
add_shortcode('button', 'frameworkupsites_button_shortcode');

/**
 * Shortcode: Box de Destaque
 * 
 * Uso: [highlight style="info"]Seu texto aqui[/highlight]
 */
function frameworkupsites_highlight_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'style' => 'info', // info, success, warning, error
        'title' => '',
    ), $atts);
    
    $styles = array(
        'info'    => 'bg-blue-50 border-blue-200 text-blue-800',
        'success' => 'bg-green-50 border-green-200 text-green-800',
        'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800',
        'error'   => 'bg-red-50 border-red-200 text-red-800',
    );
    
    $style_class = isset($styles[$atts['style']]) ? $styles[$atts['style']] : $styles['info'];
    
    $title_html = '';
    if (!empty($atts['title'])) {
        $title_html = '<strong class="block mb-2 text-lg">' . esc_html($atts['title']) . '</strong>';
    }
    
    $output = sprintf(
        '<div class="p-4 rounded-lg border-l-4 %s">%s%s</div>',
        $style_class,
        $title_html,
        do_shortcode($content)
    );
    
    return $output;
}
add_shortcode('highlight', 'frameworkupsites_highlight_shortcode');

/**
 * Shortcode: Colunas
 * 
 * Uso: [columns cols="2"][column]Conteúdo 1[/column][column]Conteúdo 2[/column][/columns]
 */
function frameworkupsites_columns_shortcode($atts, $content = null) {
    $atts = shortcode_atts(array(
        'cols' => '2',
        'gap'  => '4',
    ), $atts);
    
    $col_classes = array(
        '2' => 'md:grid-cols-2',
        '3' => 'md:grid-cols-3',
        '4' => 'md:grid-cols-4',
    );
    
    $col_class = isset($col_classes[$atts['cols']]) ? $col_classes[$atts['cols']] : 'md:grid-cols-2';
    
    $output = sprintf(
        '<div class="grid grid-cols-1 %s gap-%s">%s</div>',
        $col_class,
        esc_attr($atts['gap']),
        do_shortcode($content)
    );
    
    return $output;
}
add_shortcode('columns', 'frameworkupsites_columns_shortcode');

function frameworkupsites_column_shortcode($atts, $content = null) {
    return '<div class="column">' . do_shortcode($content) . '</div>';
}
add_shortcode('column', 'frameworkupsites_column_shortcode');

/**
 * Shortcode: Ícone
 * 
 * Uso: [icon name="check" color="green"]
 */
function frameworkupsites_icon_shortcode($atts) {
    $atts = shortcode_atts(array(
        'name'  => 'check',
        'color' => 'blue',
        'size'  => 'md',
    ), $atts);
    
    $sizes = array(
        'sm' => 'w-4 h-4',
        'md' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
    );
    
    $icons = array(
        'check'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>',
        'x'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>',
        'info'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>',
        'alert'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
        'star'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>',
        'heart'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>',
    );
    
    $size_class = isset($sizes[$atts['size']]) ? $sizes[$atts['size']] : $sizes['md'];
    $icon_path = isset($icons[$atts['name']]) ? $icons[$atts['name']] : $icons['check'];
    
    $output = sprintf(
        '<svg class="inline-block %s text-%s-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">%s</svg>',
        $size_class,
        esc_attr($atts['color']),
        $icon_path
    );
    
    return $output;
}
add_shortcode('icon', 'frameworkupsites_icon_shortcode');

/**
 * Shortcode: Telefone (formatado)
 * 
 * Uso: [phone]
 */
function frameworkupsites_phone_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number' => '',
        'link'   => 'no', // yes ou no
    ), $atts);
    
    $phone = !empty($atts['number']) ? $atts['number'] : frameworkupsites_get_phone();
    
    if (empty($phone)) {
        return '';
    }
    
    $formatted = frameworkupsites_format_phone($phone);
    
    if ($atts['link'] === 'yes') {
        $clean = preg_replace('/[^0-9]/', '', $phone);
        return '<a href="tel:+55' . $clean . '" class="text-blue-600 hover:text-blue-800">' . $formatted . '</a>';
    }
    
    return $formatted;
}
add_shortcode('phone', 'frameworkupsites_phone_shortcode');

/**
 * Shortcode: WhatsApp Button
 * 
 * Uso: [whatsapp text="Fale conosco" message="Olá!"]
 */
function frameworkupsites_whatsapp_shortcode($atts) {
    $atts = shortcode_atts(array(
        'number'  => '',
        'text'    => 'WhatsApp',
        'message' => '',
        'style'   => 'primary',
    ), $atts);
    
    $whatsapp_link = frameworkupsites_whatsapp_link($atts['number'], $atts['message']);
    
    $style_classes = array(
        'primary' => 'bg-green-500 text-white hover:bg-green-600',
        'outline' => 'border-2 border-green-500 text-green-500 hover:bg-green-500 hover:text-white',
    );
    
    $style_class = isset($style_classes[$atts['style']]) ? $style_classes[$atts['style']] : $style_classes['primary'];
    
    $output = sprintf(
        '<a href="%s" target="_blank" rel="noopener" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg font-semibold transition %s">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.652a11.944 11.944 0 005.699 1.448h.005c6.555 0 11.89-5.335 11.893-11.893a11.802 11.802 0 00-3.468-8.413z"/>
            </svg>
            %s
        </a>',
        esc_url($whatsapp_link),
        $style_class,
        esc_html($atts['text'])
    );
    
    return $output;
}
add_shortcode('whatsapp', 'frameworkupsites_whatsapp_shortcode');

/**
 * Shortcode: Ano atual
 * 
 * Uso: [year]
 */
function frameworkupsites_year_shortcode() {
    return date('Y');
}
add_shortcode('year', 'frameworkupsites_year_shortcode');

/**
 * Shortcode: Nome do site
 * 
 * Uso: [sitename]
 */
function frameworkupsites_sitename_shortcode() {
    return get_bloginfo('name');
}
add_shortcode('sitename', 'frameworkupsites_sitename_shortcode');

