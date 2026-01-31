<?php
/**
 * 404 Error Page Template
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main class="container mx-auto px-4 py-20">
    <div class="max-w-2xl mx-auto text-center">
        
        <h1 class="text-[ads-title] font-bold text-gray-900 mb-4">404</h1>
        <h2 class="text-3xl font-semibold text-gray-700 mb-4">
            Página Não Encontrada
        </h2>
        <p class="text-lg text-gray-600 mb-8">
            Desculpe, a página que você está procurando não existe.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                Voltar para Home
            </a>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>
