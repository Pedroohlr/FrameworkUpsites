<?php
/**
 * Footer Template
 * 
 * @package FrameworkUpsites
 */
?>
    </div><!-- #content -->
    
    <footer class="bg-framework-black text-white mt-auto">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-8">
                
                <!-- Logo e Descrição -->
                <div class="lg:col-span-2">
                    <div class="mb-4">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php if (has_custom_logo()) : ?>
                                <?php 
                                $logo_id = get_theme_mod('custom_logo');
                                $logo = wp_get_attachment_image_src($logo_id, 'full');
                                if ($logo) :
                                ?>
                                    <img src="<?php echo esc_url($logo[0]); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-12 w-auto brightness-0 invert filter">
                                <?php else : ?>
                                    <span class="text-2xl font-bold text-white">
                                        <?php bloginfo('name'); ?>
                                    </span>
                                <?php endif; ?>
                            <?php else : ?>
                                <span class="text-2xl font-bold text-white">
                                    <?php bloginfo('name'); ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                    <p class="text-gray-400 text-sm max-w-md">
                        <?php 
                        $footer_description = get_option('frameworkupsites_footer_description', 'Transformamos sua presença digital com sites modernos, rápidos e otimizados.');
                        echo esc_html($footer_description); 
                        ?>
                    </p>
                </div>
                
                <!-- Menu Footer 1 -->
                <?php if (has_nav_menu('footer')) : ?>
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Menu</h3>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container' => false,
                        'menu_class' => 'space-y-2',
                        'fallback_cb' => false,
                        'walker' => new FrameworkUpsites_Footer_Walker(),
                    ));
                    ?>
                </div>
                <?php endif; ?>
                
                <!-- Widget Footer 1 -->
                <?php if (is_active_sidebar('footer-1')) : ?>
                <div>
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
                <?php endif; ?>
                
                <!-- Contato -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-4">Contato</h3>
                    <ul class="space-y-2 text-gray-400 text-sm">
                        <?php if (frameworkupsites_get_phone()) : ?>
                        <li>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', frameworkupsites_get_phone())); ?>" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <i class="fa-solid fa-phone text-framework-primary"></i>
                                <?php echo esc_html(frameworkupsites_format_phone(frameworkupsites_get_phone())); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (frameworkupsites_get_email()) : ?>
                        <li>
                            <a href="mailto:<?php echo esc_attr(frameworkupsites_get_email()); ?>" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <i class="fa-solid fa-envelope text-framework-primary"></i>
                                <?php echo esc_html(frameworkupsites_get_email()); ?>
                            </a>
                        </li>
                        <?php endif; ?>
                        
                        <?php if (frameworkupsites_get_whatsapp()) : ?>
                        <li>
                            <a href="<?php echo esc_url(frameworkupsites_whatsapp_link()); ?>" target="_blank" rel="noopener" class="hover:text-white transition-colors inline-flex items-center gap-2">
                                <i class="fa-brands fa-whatsapp text-framework-primary"></i>
                                WhatsApp
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <!-- Linha Divisória e Copyright -->
            <div class="border-t border-gray-800 pt-8 mt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-400 text-sm">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Todos os direitos reservados.
                    </p>
                    <div class="flex items-center gap-4">
                        <p class="text-gray-400 text-sm">
                            Desenvolvido com <i class="fa-solid fa-heart text-framework-primary"></i> por <?php bloginfo('name'); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
