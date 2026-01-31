<?php
/**
 * Header Template
 * 
 * @package FrameworkUpsites
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen flex flex-col">
    
    <?php
    // Verifica se é uma das páginas que precisa do tema escuro inicial
    $needs_dark_header = false;
    
    // Verifica se é página de blog
    if (is_page_template('pages/blog.php')) {
        $needs_dark_header = true;
    }
    
    // Verifica se é página de nossos projetos
    if (is_page_template('pages/nossos-projetos.php')) {
        $needs_dark_header = true;
    }
    
    // Verifica se é página de contato
    if (is_page_template('pages/contato.php')) {
        $needs_dark_header = true;
    }
    
    // Verifica se é página de segmentos
    if (is_page_template('pages/segmentos.php')) {
        $needs_dark_header = true;
    }

    // Verifica se é post interno (blog)
    if (is_single() && get_post_type() === 'post') {
        $needs_dark_header = true;
    }
    
    // Verifica se é projeto interno
    if (is_singular('projetos')) {
        $needs_dark_header = true;
    }
    
    $header_class = $needs_dark_header ? 'header-dark-initial' : '';
    ?>
    <header id="main-header" class="absolute top-0 left-0 right-0 z-40 transition-all duration-300 <?php echo esc_attr($header_class); ?>">
        <nav class="container text-ads-primary mx-auto px-2 py-4 relative transition-all duration-300">
            <div class="flex items-center justify-between">
                
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <?php if (has_custom_logo()) : ?>
                        <div class="custom-logo-wrapper">
                            <?php the_custom_logo(); ?>
                        </div>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo-text text-[31px] font-bold text-framework-black transition-colors duration-300">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                </div>
                
                <!-- Menu Desktop - Centro -->
                <div class="hidden lg:flex flex-1 items-center justify-center">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex space-x-8',
                        'fallback_cb' => false,
                    ));
                    ?>
                </div>
                
                <!-- Botão CTA Desktop - Direita -->
                <div class="hidden lg:flex items-center">
                    <a href="<?php echo esc_url(home_url('/contato')); ?>" class="cta-button bg-framework-primary text-white px-8 py-2 rounded-full font-semibold flex items-center gap-3">
                        Entre em contato
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <!-- Mobile: Botão CTA + Menu Toggle -->
                <div class="flex lg:hidden items-center gap-3">
                    <!-- Botão CTA Mobile -->
                    <a href="<?php echo esc_url(home_url('/contato')); ?>" class="cta-button bg-framework-primary text-white px-4 py-2 rounded-full font-semibold text-sm flex items-center gap-2">
                        Contato
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                    
                    <!-- Botão Menu Hamburguer -->
                    <button id="mobile-menu-toggle" class="relative z-[60] flex flex-col items-center justify-center w-10 h-10 gap-1.5 cursor-pointer outline-none focus-visible:outline-0" aria-label="Menu" aria-expanded="false">
                        <span class="menu-line block w-7 h-[2px] bg-framework-primary rounded-full transition-all duration-300 ease-in-out"></span>
                        <span class="menu-line block w-7 h-[2px] bg-framework-primary rounded-full transition-all duration-300 ease-in-out"></span>
                        <span class="menu-line block w-7 h-[2px] bg-framework-primary rounded-full transition-all duration-300 ease-in-out"></span>
                    </button>
                </div>
            </div>
            
            <!-- Menu Mobile Dropdown -->
            <div id="mobile-menu" class="absolute top-full left-0 right-0 mx-4 border-2 border-t-0 border-framework-primary rounded-b-2xl shadow-xl z-50 lg:hidden backdrop-blur-md bg-white/80" style="max-height: 0; opacity: 0; overflow: hidden; transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;">
                <div class="px-4 py-6 mobile-menu-scroll" style="max-height: 70vh; overflow-y: auto;">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex flex-col space-y-2',
                        'fallback_cb' => false,
                    ));
                    ?>
                    
                    <!-- Botão CTA no Menu -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <a href="<?php echo esc_url(home_url('/contato')); ?>" class="cta-button bg-framework-primary text-white px-8 py-3 rounded-full font-semibold flex items-center justify-center gap-3 w-full">
                            Entre em contato
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <div id="content" class="flex-grow">