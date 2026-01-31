<?php
/**
 * Search Results Template
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main class="container mx-auto px-4 py-12">
    
    <header class="mb-12 text-center">
        <h1 class="text-4xl font-bold mb-4">Resultados da Busca</h1>
        <p class="text-xl text-gray-600">
            <?php printf('Busca por: <strong>"%s"</strong>', get_search_query()); ?>
        </p>
    </header>
    
    <?php if (have_posts()) : ?>
        
        <div class="max-w-4xl mx-auto space-y-6">
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 class="text-2xl font-bold mb-2">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="text-gray-700">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                
            <?php endwhile; ?>
        </div>
        
        <?php the_posts_pagination(); ?>
        
    <?php else : ?>
        
        <div class="text-center py-12">
            <h2 class="text-2xl font-bold mb-4">Nada foi encontrado</h2>
            <p class="text-gray-600">Tente novamente com outras palavras-chave.</p>
        </div>
        
    <?php endif; ?>
    
</main>

<?php get_footer(); ?>
