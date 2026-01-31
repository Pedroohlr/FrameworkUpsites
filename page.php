<?php
/**
 * Page Template
 * 
 * Template padrão para páginas
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main>
    
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <?php
        $title = get_the_title();
        $description = has_excerpt() ? get_the_excerpt() : '';
        include get_template_directory() . '/parts/page-hero.php';
        ?>
        
        <!-- Conteúdo -->
        <section class="py-16 md:py-20 bg-white">
            <div class="container mx-auto px-4">
                <article id="page-<?php the_ID(); ?>" <?php post_class('max-w-4xl mx-auto'); ?>>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="mb-12 rounded-2xl overflow-hidden shadow-xl">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="prose prose-lg max-w-none prose-headings:text-framework-black prose-p:text-gray-700 prose-a:text-grid-primary prose-strong:text-framework-black prose-img:rounded-xl">
                        <?php the_content(); ?>
                    </div>
                    
                </article>
            </div>
        </section>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>
