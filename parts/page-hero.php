<?php
/**
 * Page Hero Component - Minimalista
 * 
 * Component reutilizável para o topo de páginas internas
 * 
 * @package FrameworkUpsites
 * 
 * @param string $subtitle - Subtítulo/categoria (opcional)
 * @param string $title - Título principal (obrigatório)
 * @param string $description - Descrição (opcional)
 */

// Valores padrão
$subtitle = isset($subtitle) ? $subtitle : '';
$title = isset($title) ? $title : get_the_title();
$description = isset($description) ? $description : '';
?>

<section class="relative pt-32 pb-16 md:pt-40 md:pb-20 bg-framework-black border-b border-white/10">
    
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            
            <!-- Logo da Empresa -->
            <div class="mb-10">
                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/icone-grid.svg'); ?>" 
                     alt="Grid Company" 
                     class="h-10 md:h-auto mx-auto opacity-70">
            </div>
            
            <?php if ($subtitle) : ?>
                <!-- Subtítulo -->
                <p class="text-framework-primary font-semibold text-xs md:text-sm uppercase tracking-wider mb-4">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php endif; ?>
            
            <!-- Título Principal -->
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                <?php echo wp_kses_post($title); ?>
            </h1>
            
            <?php if ($description) : ?>
                <!-- Descrição -->
                <p class="text-base md:text-lg text-white/60 leading-relaxed max-w-2xl mx-auto">
                    <?php echo wp_kses_post($description); ?>
                </p>
            <?php endif; ?>
            
            <?php if (is_single()) : ?>
                <!-- Meta informações para posts -->
                <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
                    <div class="flex items-center gap-2 text-white/50 text-sm">
                        <i class="fa-solid fa-calendar text-framework-primary"></i>
                        <time datetime="<?php echo get_the_date('c'); ?>">
                            <?php echo get_the_date('d/m/Y'); ?>
                        </time>
                    </div>
                    <span class="text-white/20">•</span>
                    <div class="flex items-center gap-2 text-white/50 text-sm">
                        <i class="fa-solid fa-user text-framework-primary"></i>
                        <span><?php the_author(); ?></span>
                    </div>
                    <?php if (get_comments_number() > 0) : ?>
                        <span class="text-white/20">•</span>
                        <div class="flex items-center gap-2 text-white/50 text-sm">
                            <i class="fa-solid fa-comments text-framework-primary"></i>
                            <span><?php comments_number('0', '1', '%'); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    
</section>
