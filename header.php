<?php
/**
 * Header Template
 * 
 * @package FrameworkUpsites
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>

  <div id="page" class="min-h-screen flex flex-col">
    <header id="main-header"
      class="absolute top-0 left-0 right-0 z-40 transition-all duration-300 <?php echo esc_attr($header_class); ?>">
    </header>

    <div id="content" class="flex-grow">