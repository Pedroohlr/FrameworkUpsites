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
  <?php while (have_posts()):
    the_post(); ?>
    <section class="py-24 md:py-32">
      Olá mundo
    </section>
  <?php endwhile; ?>
</main>

<?php get_footer(); ?>