<?php
/**
 * Index Template
 * 
 * Template padrão do WordPress
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto">
        
        <?php if (have_posts()) : ?>
            
            <div class="space-y-8">
                <?php while (have_posts()) : the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h2 class="text-3xl font-bold mb-4">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="prose max-w-none">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>
                    
                <?php endwhile; ?>
            </div>
            
            <?php the_posts_pagination(); ?>
            
        <?php else : ?>
            
            <div class="text-center py-12">
                <h1 class="text-4xl font-bold mb-4">Nenhum conteúdo encontrado</h1>
            </div>
            
        <?php endif; ?>
        
    </div>
</main>

<?php get_footer(); ?>
