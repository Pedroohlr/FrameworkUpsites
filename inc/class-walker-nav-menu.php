<?php
/**
 * Custom Walker Nav Menu
 * 
 * Walker customizado para menus com Tailwind CSS
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit;
}

class FrameworkUpsites_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl(&$output, $depth = 0, $args = null) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = str_repeat($t, $depth);
        
        // Submenu classes
        $classes = array('sub-menu', 'absolute', 'left-0', 'mt-2', 'w-48', 'bg-white', 'rounded-lg', 'shadow-lg', 'hidden', 'group-hover:block', 'z-50');
        $class_names = implode(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }
    
    /**
     * Starts the element output.
     */
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';
        
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Adiciona classes Tailwind
        if ($depth === 0) {
            $classes[] = 'relative';
            $classes[] = 'group';
        }
        
        if (in_array('current-menu-item', $classes)) {
            $classes[] = 'active';
        }
        
        if ($args->walker->has_children) {
            $classes[] = 'has-children';
        }
        
        $class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        $atts = array();
        $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        if ('_blank' === $item->target && empty($item->xfn)) {
            $atts['rel'] = 'noopener';
        } else {
            $atts['rel'] = $item->xfn;
        }
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['aria-current'] = $item->current ? 'page' : '';
        
        // Classes do link baseado na profundidade
        if ($depth === 0) {
            $atts['class'] = 'text-framework-black font-medium menu-link';
            if (in_array('current-menu-item', $classes)) {
                $atts['class'] = 'text-grid-primary font-semibold menu-link menu-link-active';
            }
        } else {
            $atts['class'] = 'block px-4 py-2 text-framework-black hover:bg-framework-white hover:text-grid-primary transition';
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (is_scalar($value) && '' !== $value && false !== $value) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // Adiciona ícone de dropdown se tiver filhos
        if ($args->walker->has_children && $depth === 0) {
            $item_output .= '<svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}

/**
 * Walker simples para o footer
 */
class FrameworkUpsites_Footer_Walker extends Walker_Nav_Menu {
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $output .= '<li>';
        $output .= '<a href="' . esc_url($item->url) . '" class="text-gray-400 hover:text-white transition-colors text-sm">';
        $output .= esc_html($item->title);
        $output .= '</a>';
        $output .= '</li>';
    }
    
    public function end_el(&$output, $item, $depth = 0, $args = null) {
        // Não precisa fazer nada
    }
}

