<?php
/**
 * Single Post Template
 * 
 * Template para exibir posts individuais do blog
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main>
    
    <?php while (have_posts()) : the_post(); ?>
        
        <!-- Hero Section -->
        <?php
        $categories = get_the_category();
        $subtitle = !empty($categories) ? $categories[0]->name : 'Blog';
        $title = get_the_title();
        $description = has_excerpt() ? get_the_excerpt() : wp_trim_words(get_the_content(), 30, '...');
        $icon = 'fa-solid fa-newspaper';
        include get_template_directory() . '/parts/page-hero.php';
        ?>
        
        <!-- Imagem Destacada -->
        <?php if (has_post_thumbnail()) : ?>
            <section class="py-12 bg-white">
                <div class="container mx-auto px-4">
                    <div class="max-w-4xl mx-auto">
                        <div class="rounded-2xl overflow-hidden shadow-2xl">
                            <?php the_post_thumbnail('large', array('class' => 'w-full h-auto')); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
        
        <!-- Conteúdo do Post -->
        <section class="py-8 md:py-12 bg-grid-white">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    
                    <article class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </article>
                    
                    <!-- Tags -->
                    <?php 
                    $tags = get_the_tags();
                    if ($tags) : 
                    ?>
                        <div class="mt-12 pt-8 border-t border-gray-200">
                            <h3 class="text-lg font-bold text-framework-black mb-4">Tags:</h3>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach ($tags as $tag) : ?>
                                    <a href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>" 
                                       class="inline-block px-4 py-2 bg-grid-primary/10 text-grid-primary rounded-full text-sm font-medium hover:bg-grid-primary hover:text-white transition-colors duration-200">
                                        <?php echo esc_html($tag->name); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Navegação entre Posts -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Post Anterior -->
                            <?php 
                            $prev_post = get_previous_post();
                            if ($prev_post) : 
                            ?>
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                                    <p class="text-sm text-gray-500 mb-2">Post Anterior</p>
                                    <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="block">
                                        <h3 class="text-lg font-bold text-framework-black hover:text-grid-primary transition-colors duration-200">
                                            <?php echo esc_html(get_the_title($prev_post)); ?>
                                        </h3>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Próximo Post -->
                            <?php 
                            $next_post = get_next_post();
                            if ($next_post) : 
                            ?>
                                <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition-shadow duration-300 md:text-right">
                                    <p class="text-sm text-gray-500 mb-2">Próximo Post</p>
                                    <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="block">
                                        <h3 class="text-lg font-bold text-framework-black hover:text-grid-primary transition-colors duration-200">
                                            <?php echo esc_html(get_the_title($next_post)); ?>
                                        </h3>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                    <!-- Posts Relacionados -->
                    <?php
                    $related_posts = get_posts(array(
                        'category__in' => wp_get_post_categories(get_the_ID()),
                        'numberposts' => 3,
                        'post__not_in' => array(get_the_ID()),
                    ));
                    
                    if ($related_posts) :
                    ?>
                        <div class="mt-16 pt-12 border-t border-gray-200">
                            <h2 class="text-2xl md:text-3xl font-bold text-framework-black mb-8">Posts Relacionados</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <?php foreach ($related_posts as $related_post) : 
                                    setup_postdata($related_post);
                                ?>
                                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                        
                                        <!-- Imagem -->
                                        <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                            <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>" class="block overflow-hidden">
                                                <?php echo get_the_post_thumbnail($related_post->ID, 'medium', array(
                                                    'class' => 'w-full h-40 object-cover transition-transform duration-300 hover:scale-105'
                                                )); ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>" class="block bg-grid-primary/10 h-40 flex items-center justify-center">
                                                <img src="<?php echo GRIDTHEME_URI; ?>/assets/img/icone-grid.svg" alt="Grid Icon" class="w-12 h-12 opacity-50">
                                            </a>
                                        <?php endif; ?>
                                        
                                        <!-- Conteúdo -->
                                        <div class="p-4">
                                            <?php 
                                            $related_categories = get_the_category($related_post->ID);
                                            if (!empty($related_categories)) : 
                                                $related_category = $related_categories[0];
                                            ?>
                                                <a href="<?php echo esc_url(get_category_link($related_category->term_id)); ?>" 
                                                   class="inline-block text-xs font-semibold text-grid-primary mb-2 hover:underline">
                                                    <?php echo esc_html($related_category->name); ?>
                                                </a>
                                            <?php endif; ?>
                                            
                                            <h3 class="text-base font-bold text-framework-black line-clamp-2">
                                                <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>" class="hover:text-grid-primary transition-colors duration-200">
                                                    <?php echo esc_html(get_the_title($related_post->ID)); ?>
                                                </a>
                                            </h3>
                                        </div>
                                        
                                    </article>
                                <?php 
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
        </section>
        
        <!-- CTA Final -->
        <section class="py-16 md:py-24 bg-grid-white">
            <div class="container mx-auto px-4">
                <div class="flex justify-center">
                    <div class="bg-grid-primary rounded-2xl p-8 md:p-12 shadow-xl max-w-[600px] w-full text-center">
                        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4">
                            Precisando de um site profissional?
                        </h2>
                        <p class="text-lg md:text-xl text-white/90 mb-8">
                            Descubra quanto custa o seu site
                        </p>
                        <a href="/orcamentos" class="cta-button bg-white text-grid-primary px-8 py-4 rounded-full font-semibold inline-flex items-center gap-3 text-lg hover:shadow-xl transition-all duration-300">
                            Peça um orçamento
                            <i class="fa-solid fa-bolt animate-pulse"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
    <?php endwhile; ?>
    
</main>

<?php get_footer(); ?>
