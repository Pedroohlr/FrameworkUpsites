<?php
/**
 * WooCommerce
 *
 * Integração e customizações do WooCommerce
 *
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
  exit;
}

if (!class_exists('WooCommerce')) {
  return;
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

function frameworkupsites_woocommerce_wrapper_start()
{
  echo '<div class="container mx-auto px-4 py-8">';
}
add_action('woocommerce_before_main_content', 'frameworkupsites_woocommerce_wrapper_start', 10);

function frameworkupsites_woocommerce_wrapper_end()
{
  echo '</div>';
}
add_action('woocommerce_after_main_content', 'frameworkupsites_woocommerce_wrapper_end', 10);

function frameworkupsites_products_per_page()
{
  return 12;
}
add_filter('loop_shop_per_page', 'frameworkupsites_products_per_page', 20);
