<?php
/**
 * Template Name: Blog
 * 
 * Template para a página do blog
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main>
    
    <!-- Header do Blog -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-16 bg-grid-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                
                <!-- Esquerda: Título -->
                <div>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-framework-black">
                        BLOG SOBRE WEB DESIGN, VENDAS ONLINE E SEO
                    </h1>
                </div>
                
                <!-- Direita: Ícone e Descrição -->
                <div class="flex items-center gap-4">
                    <img src="<?php echo GRIDTHEME_URI; ?>/assets/img/icone-grid.svg" alt="Grid Icon" class="w-12 h-12 md:w-16 md:h-16 flex-shrink-0">
                    <p class="text-lg md:text-xl text-framework-black/80 font-medium">
                        Tudo sobre web design, vendas online e SEO!
                    </p>
                </div>
                
            </div>
        </div>
    </section>
    
    <!-- Conteúdo Principal -->
    <section class="py-8 md:py-12 bg-grid-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                <!-- Sidebar: Categorias -->
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 sticky top-24">
                        <h2 class="text-xl font-bold text-framework-black mb-6">Categorias</h2>
                        <ul class="space-y-3">
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'name',
                                'order' => 'ASC',
                                'hide_empty' => true,
                            ));
                            
                            // Verifica se há categoria selecionada via query string
                            $selected_category = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
                            ?>
                            
                            <li>
                                <a href="<?php echo esc_url(get_permalink()); ?>" 
                                   class="block px-4 py-2 rounded-lg transition-colors duration-200 <?php echo $selected_category == 0 ? 'bg-framework-primary text-white font-semibold' : 'text-framework-black hover:bg-framework-primary/10 hover:text-framework-primary'; ?>">
                                    Todas as Categorias
                                </a>
                            </li>
                            
                            <?php foreach ($categories as $category) : 
                                $is_active = $selected_category == $category->term_id;
                                $category_url = add_query_arg('categoria', $category->term_id, get_permalink());
                            ?>
                                <li>
                                    <a href="<?php echo esc_url($category_url); ?>" 
                                       class="block px-4 py-2 rounded-lg transition-colors duration-200 <?php echo $is_active ? 'bg-framework-primary text-white font-semibold' : 'text-framework-black hover:bg-framework-primary/10 hover:text-framework-primary'; ?>">
                                        <?php echo esc_html($category->name); ?>
                                        <span class="text-sm opacity-70 ml-2">(<?php echo $category->count; ?>)</span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </aside>
                
                <!-- Posts: Grade de 3 colunas -->
                <div class="lg:col-span-3">
                    <?php
                    // Configura query dos posts
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    $category_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
                    
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 12,
                        'paged' => $paged,
                        'post_status' => 'publish',
                    );
                    
                    if ($category_id > 0) {
                        $args['cat'] = $category_id;
                    }
                    
                    $blog_query = new WP_Query($args);
                    ?>
                    
                    <?php if ($blog_query->have_posts()) : ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                                
                                <article class="bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-xl transition-shadow duration-300">
                                    
                                    <!-- Imagem Destacada -->
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php the_permalink(); ?>" class="block overflow-hidden">
                                            <?php the_post_thumbnail('medium_large', array(
                                                'class' => 'w-full h-48 object-cover transition-transform duration-300 hover:scale-105'
                                            )); ?>
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php the_permalink(); ?>" class="block bg-framework-primary/10 h-48 flex items-center justify-center">
                                            <img src="<?php echo GRIDTHEME_URI; ?>/assets/img/icone-grid.svg" alt="Grid Icon" class="w-16 h-16 opacity-50">
                                        </a>
                                    <?php endif; ?>
                                    
                                    <!-- Conteúdo do Card -->
                                    <div class="p-6">
                                        
                                        <!-- Categoria -->
                                        <?php 
                                        $categories = get_the_category();
                                        if (!empty($categories)) : 
                                            $category = $categories[0];
                                            $category_link = add_query_arg('categoria', $category->term_id, get_permalink());
                                        ?>
                                            <a href="<?php echo esc_url($category_link); ?>" 
                                               class="inline-block text-sm font-semibold text-framework-primary mb-3 hover:underline">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <!-- Título -->
                                        <h2 class="text-xl font-bold text-framework-black mb-3 line-clamp-2">
                                            <a href="<?php the_permalink(); ?>" class="hover:text-framework-primary transition-colors duration-200">
                                                <?php the_title(); ?>
                                            </a>
                                        </h2>
                                        
                                        <!-- Data -->
                                        <time datetime="<?php echo get_the_date('c'); ?>" class="text-sm text-gray-500">
                                            <?php echo get_the_date('d/m/Y'); ?>
                                        </time>
                                        
                                    </div>
                                    
                                </article>
                                
                            <?php endwhile; ?>
                        </div>
                        
                        <!-- Paginação -->
                        <div class="mt-12 flex justify-center">
                            <?php
                            $big = 999999999;
                            $pagination_args = array(
                                'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                                'format' => '?paged=%#%',
                                'current' => max(1, $paged),
                                'total' => $blog_query->max_num_pages,
                                'prev_text' => '<i class="fa-solid fa-chevron-left"></i> Anterior',
                                'next_text' => 'Próxima <i class="fa-solid fa-chevron-right"></i>',
                                'type' => 'list',
                                'end_size' => 2,
                                'mid_size' => 2,
                            );
                            
                            // Adiciona categoria à paginação se estiver selecionada
                            if ($category_id > 0) {
                                $pagination_args['add_args'] = array('categoria' => $category_id);
                            }
                            
                            echo paginate_links($pagination_args);
                            ?>
                        </div>
                        
                        <?php wp_reset_postdata(); ?>
                        
                    <?php else : ?>
                        
                        <div class="text-center py-16">
                            <img src="<?php echo GRIDTHEME_URI; ?>/assets/img/icone-grid.svg" alt="Grid Icon" class="w-20 h-20 mx-auto mb-6 opacity-50">
                            <h2 class="text-2xl font-bold text-framework-black mb-4">Nenhum post encontrado</h2>
                            <p class="text-gray-600 mb-6">Não há posts publicados ainda.</p>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="cta-button bg-framework-primary text-white px-6 py-3 rounded-full font-semibold inline-flex items-center gap-3">
                                Voltar para Home
                                <i class="fa-solid fa-arrow-left"></i>
                            </a>
                        </div>
                        
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
    </section>
    
</main>

<?php get_footer(); ?>

