<?php
/**
 * WooCommerce Template
 * 
 * Template principal para páginas do WooCommerce
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main class="py-12">
    <div class="container mx-auto px-4">
        
        <?php woocommerce_content(); ?>
        
    </div>
</main>

<?php get_footer(); ?>
