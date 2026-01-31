<?php
/**
 * Theme Options
 * 
 * Página de configurações do tema no admin
 * Permite configurar opções globais sem precisar editar código
 * 
 * @package FrameworkUpsites
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Adiciona página de opções do tema no admin
 */
function frameworkupsites_add_theme_options_page() {
  add_menu_page(
    'Opções do Tema',           // Título da página
    'Opções FrameworkUpsites',         // Título no menu
    'manage_options',           // Capacidade necessária
    'frameworkupsites-options',        // Slug da página
    'frameworkupsites_render_options_page', // Função de callback
    'dashicons-admin-customizer',    // Ícone
    61                          // Posição no menu
    );
}
add_action('admin_menu', 'frameworkupsites_add_theme_options_page');

/**
 * Registra as configurações
 */
function frameworkupsites_register_settings() {
    // Seção: Informações de Contato
    register_setting('frameworkupsites_options', 'frameworkupsites_phone');
    register_setting('frameworkupsites_options', 'frameworkupsites_email');
    register_setting('frameworkupsites_options', 'frameworkupsites_address');
    register_setting('frameworkupsites_options', 'frameworkupsites_whatsapp');
    
    // Seção: Redes Sociais
    register_setting('frameworkupsites_options', 'frameworkupsites_facebook');
    register_setting('frameworkupsites_options', 'frameworkupsites_instagram');
    register_setting('frameworkupsites_options', 'frameworkupsites_linkedin');
    register_setting('frameworkupsites_options', 'frameworkupsites_twitter');
    register_setting('frameworkupsites_options', 'frameworkupsites_youtube');
    
    // Seção: Scripts
    register_setting('frameworkupsites_options', 'frameworkupsites_google_analytics');
    register_setting('frameworkupsites_options', 'frameworkupsites_facebook_pixel');
    register_setting('frameworkupsites_options', 'frameworkupsites_header_scripts');
    register_setting('frameworkupsites_options', 'frameworkupsites_footer_scripts');
    
    // Seção: Performance
    register_setting('frameworkupsites_options', 'frameworkupsites_disable_emojis');
    register_setting('frameworkupsites_options', 'frameworkupsites_disable_embeds');
    register_setting('frameworkupsites_options', 'frameworkupsites_lazy_load');
}
add_action('admin_init', 'frameworkupsites_register_settings');

/**
 * Renderiza a página de opções
 */
function frameworkupsites_render_options_page() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Salva as configurações
    if (isset($_GET['settings-updated'])) {
        add_settings_error(
            'frameworkupsites_messages',
            'frameworkupsites_message',
            'Configurações salvas com sucesso!',
            'updated'
        );
    }
    
    settings_errors('frameworkupsites_messages');
    ?>
    
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form method="post" action="options.php">
            <?php settings_fields('frameworkupsites_options'); ?>
            
            <div class="nav-tab-wrapper">
                <a href="#tab-contact" class="nav-tab nav-tab-active">Contato</a>
                <a href="#tab-social" class="nav-tab">Redes Sociais</a>
                <a href="#tab-scripts" class="nav-tab">Scripts</a>
                <a href="#tab-performance" class="nav-tab">Performance</a>
            </div>
            
            <!-- Tab: Contato -->
            <div id="tab-contact" class="tab-content" style="display: block;">
                <h2>Informações de Contato</h2>
                <p>Configure as informações de contato que aparecem no site.</p>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="frameworkupsites_phone">Telefone</label></th>
                        <td>
                            <input type="text" id="frameworkupsites_phone" name="frameworkupsites_phone" 
                                   value="<?php echo esc_attr(get_option('frameworkupsites_phone')); ?>" 
                                   class="regular-text">
                            <p class="description">Ex: (11) 1234-5678</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_whatsapp">WhatsApp</label></th>
                        <td>
                            <input type="text" id="frameworkupsites_whatsapp" name="frameworkupsites_whatsapp" 
                                   value="<?php echo esc_attr(get_option('frameworkupsites_whatsapp')); ?>" 
                                   class="regular-text">
                            <p class="description">Ex: 5511912345678 (com DDI + DDD, sem espaços)</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_email">Email</label></th>
                        <td>
                            <input type="email" id="frameworkupsites_email" name="frameworkupsites_email" 
                                   value="<?php echo esc_attr(get_option('frameworkupsites_email')); ?>" 
                                   class="regular-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_address">Endereço</label></th>
                        <td>
                            <textarea id="frameworkupsites_address" name="frameworkupsites_address" 
                                      rows="3" class="large-text"><?php echo esc_textarea(get_option('frameworkupsites_address')); ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Tab: Redes Sociais -->
            <div id="tab-social" class="tab-content" style="display: none;">
                <h2>Redes Sociais</h2>
                <p>Adicione os links das suas redes sociais.</p>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="frameworkupsites_facebook">Facebook</label></th>
                        <td>
                            <input type="url" id="frameworkupsites_facebook" name="frameworkupsites_facebook" 
                                   value="<?php echo esc_url(get_option('frameworkupsites_facebook')); ?>" 
                                   class="regular-text" placeholder="https://facebook.com/sua-pagina">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_instagram">Instagram</label></th>
                        <td>
                            <input type="url" id="frameworkupsites_instagram" name="frameworkupsites_instagram" 
                                   value="<?php echo esc_url(get_option('frameworkupsites_instagram')); ?>" 
                                   class="regular-text" placeholder="https://instagram.com/seu-perfil">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_linkedin">LinkedIn</label></th>
                        <td>
                            <input type="url" id="frameworkupsites_linkedin" name="frameworkupsites_linkedin" 
                                   value="<?php echo esc_url(get_option('frameworkupsites_linkedin')); ?>" 
                                   class="regular-text" placeholder="https://linkedin.com/company/sua-empresa">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_twitter">Twitter / X</label></th>
                        <td>
                            <input type="url" id="frameworkupsites_twitter" name="frameworkupsites_twitter" 
                                   value="<?php echo esc_url(get_option('frameworkupsites_twitter')); ?>" 
                                   class="regular-text" placeholder="https://twitter.com/seu-perfil">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_youtube">YouTube</label></th>
                        <td>
                            <input type="url" id="frameworkupsites_youtube" name="frameworkupsites_youtube" 
                                   value="<?php echo esc_url(get_option('frameworkupsites_youtube')); ?>" 
                                   class="regular-text" placeholder="https://youtube.com/@seu-canal">
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Tab: Scripts -->
            <div id="tab-scripts" class="tab-content" style="display: none;">
                <h2>Scripts e Rastreamento</h2>
                <p>Adicione códigos de rastreamento e scripts personalizados.</p>
                
                <table class="form-table">
                    <tr>
                        <th scope="row"><label for="frameworkupsites_google_analytics">Google Analytics 4 ID</label></th>
                        <td>
                            <input type="text" id="frameworkupsites_google_analytics" name="frameworkupsites_google_analytics" 
                                   value="<?php echo esc_attr(get_option('frameworkupsites_google_analytics')); ?>" 
                                   class="regular-text" placeholder="G-XXXXXXXXXX">
                            <p class="description">Apenas o ID, ex: G-XXXXXXXXXX</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_facebook_pixel">Facebook Pixel ID</label></th>
                        <td>
                            <input type="text" id="frameworkupsites_facebook_pixel" name="frameworkupsites_facebook_pixel" 
                                   value="<?php echo esc_attr(get_option('frameworkupsites_facebook_pixel')); ?>" 
                                   class="regular-text" placeholder="123456789012345">
                            <p class="description">Apenas o ID numérico</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_header_scripts">Scripts no Header</label></th>
                        <td>
                            <textarea id="frameworkupsites_header_scripts" name="frameworkupsites_header_scripts" 
                                      rows="5" class="large-text code"><?php echo esc_textarea(get_option('frameworkupsites_header_scripts')); ?></textarea>
                            <p class="description">Códigos que serão inseridos antes do &lt;/head&gt;</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row"><label for="frameworkupsites_footer_scripts">Scripts no Footer</label></th>
                        <td>
                            <textarea id="frameworkupsites_footer_scripts" name="frameworkupsites_footer_scripts" 
                                      rows="5" class="large-text code"><?php echo esc_textarea(get_option('frameworkupsites_footer_scripts')); ?></textarea>
                            <p class="description">Códigos que serão inseridos antes do &lt;/body&gt;</p>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!-- Tab: Performance -->
            <div id="tab-performance" class="tab-content" style="display: none;">
                <h2>Otimizações de Performance</h2>
                <p>Ative otimizações para melhorar o desempenho do site.</p>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Desativar Emojis</th>
                        <td>
                            <label>
                                <input type="checkbox" name="frameworkupsites_disable_emojis" value="1" 
                                       <?php checked(get_option('frameworkupsites_disable_emojis'), 1); ?>>
                                Remove scripts de emojis do WordPress (melhora performance)
                            </label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Desativar Embeds</th>
                        <td>
                            <label>
                                <input type="checkbox" name="frameworkupsites_disable_embeds" value="1" 
                                       <?php checked(get_option('frameworkupsites_disable_embeds'), 1); ?>>
                                Remove scripts de embed do WordPress
                            </label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Lazy Load de Imagens</th>
                        <td>
                            <label>
                                <input type="checkbox" name="frameworkupsites_lazy_load" value="1" 
                                       <?php checked(get_option('frameworkupsites_lazy_load'), 1); ?>>
                                Ativa carregamento lazy de imagens (nativo do navegador)
                            </label>
                        </td>
                    </tr>
                </table>
            </div>
            
            <?php submit_button('Salvar Configurações'); ?>
        </form>
    </div>
    
    <style>
        .nav-tab-wrapper { margin-bottom: 20px; }
        .tab-content { 
            background: #fff; 
            padding: 20px; 
            border: 1px solid #ccd0d4;
            border-top: none;
        }
    </style>
    
    <script>
        jQuery(document).ready(function($) {
            $('.nav-tab').on('click', function(e) {
                e.preventDefault();
                var target = $(this).attr('href');
                
                $('.nav-tab').removeClass('nav-tab-active');
                $(this).addClass('nav-tab-active');
                
                $('.tab-content').hide();
                $(target).show();
            });
        });
    </script>
    
    <?php
}

/**
 * Helper functions para acessar as opções
 */
function frameworkupsites_get_option($option_name, $default = '') {
    $value = get_option('frameworkupsites_' . $option_name, $default);
    return !empty($value) ? $value : $default;
}

function frameworkupsites_get_phone() {
    return frameworkupsites_get_option('phone');
}

function frameworkupsites_get_whatsapp() {
    return frameworkupsites_get_option('whatsapp');
}

function frameworkupsites_get_email() {
    return frameworkupsites_get_option('email');
}

function frameworkupsites_get_address() {
    return frameworkupsites_get_option('address');
}

function frameworkupsites_get_social($network) {
    return frameworkupsites_get_option($network);
}

// Adiciona novos campos de opções
add_action('admin_init', function() {
    register_setting('frameworkupsites_options', 'frameworkupsites_footer_description');
    register_setting('frameworkupsites_options', 'frameworkupsites_contact_cta_title');
    register_setting('frameworkupsites_options', 'frameworkupsites_contact_cta_description');
    register_setting('frameworkupsites_options', 'frameworkupsites_contact_cta_button');
    register_setting('frameworkupsites_options', 'frameworkupsites_contact_cta_link');
    register_setting('frameworkupsites_options', 'frameworkupsites_site_tagline');
});
