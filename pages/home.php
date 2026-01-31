<?php
/**
 * Template Name: Home Page
 * 
 * Template para a página inicial - personalize conforme sua necessidade
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main>
    
    <?php while (have_posts()) : the_post(); ?>
        
        <section class="py-24 md:py-32">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    
                    <h1 class="text-4xl md:text-6xl font-bold text-framework-black mb-6">
                        <?php the_title(); ?>
                    </h1>
                    
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                    
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>
