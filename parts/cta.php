<?php
/**
 * Part: CTA (Call to Action) Section
 * 
 * Seção reutilizável de call to action
 * 
 * Variáveis aceitas:
 * - $title: Título do CTA
 * - $description: Descrição do CTA
 * - $button_text: Texto do botão
 * - $button_url: URL do botão
 * - $bg_color: Cor de fundo (opcional, padrão: blue-600)
 * 
 * @package FrameworkUpsites
 */

$title = $title ?? 'Título do CTA';
$description = $description ?? 'Descrição do CTA';
$button_text = $button_text ?? 'Botão';
$button_url = $button_url ?? '#';
$bg_color = $bg_color ?? 'framework-primary';
?>

<section class="bg-<?php echo esc_attr($bg_color); ?> text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl font-bold mb-4">
                <?php echo esc_html($title); ?>
            </h2>
            <p class="text-xl mb-8 opacity-90">
                <?php echo esc_html($description); ?>
            </p>
            <a href="<?php echo esc_url($button_url); ?>" class="inline-block bg-white text-framework-black px-8 py-3 rounded-lg font-semibold hover:opacity-90 transition">
                <?php echo esc_html($button_text); ?>
            </a>
        </div>
    </div>
</section>
