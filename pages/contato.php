<?php
/**
 * Template Name: Contato
 * 
 * Template para a página de contato
 * 
 * @package FrameworkUpsites
 */

get_header(); ?>

<main>

  <!-- Hero Section -->
  <?php
  $subtitle = 'Entre em contato';
  $title = 'Vamos criar algo incrível juntos?';
  $description = 'Estamos prontos para transformar suas ideias em realidade digital';
  include get_template_directory() . '/parts/page-hero.php';
  ?>

  <!-- Formulário de Contato -->
  <section class="py-16 md:py-24 bg-white">
    <div class="container mx-auto px-4">
      <div class="max-w-5xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

          <!-- Informações de Contato -->
          <div>
            <h2 class="text-3xl font-bold text-framework-black mb-6">
              Fale conosco
            </h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
              Preencha o formulário ao lado ou entre em contato através de um dos nossos canais. Responderemos o mais
              breve possível.
            </p>

            <!-- Canais de Contato -->
            <div class="space-y-6">

              <?php if (frameworkupsites_get_whatsapp()): ?>
                <!-- WhatsApp -->
                <a href="<?php echo esc_url(frameworkupsites_whatsapp_link()); ?>" target="_blank" rel="noopener"
                  class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:border-framework-primary hover:bg-framework-primary/5 transition-all duration-300 group">
                  <div
                    class="w-12 h-12 bg-framework-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-framework-primary group-hover:scale-110 transition-all duration-300">
                    <i class="fa-brands fa-whatsapp text-2xl text-framework-primary group-hover:text-white"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-framework-black mb-1">WhatsApp</h3>
                    <p class="text-gray-600 text-sm">
                      <?php echo esc_html(frameworkupsites_format_phone(frameworkupsites_get_whatsapp())); ?></p>
                  </div>
                </a>
              <?php endif; ?>

              <?php if (frameworkupsites_get_email()): ?>
                <!-- E-mail -->
                <a href="mailto:<?php echo esc_attr(frameworkupsites_get_email()); ?>"
                  class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:border-framework-primary hover:bg-framework-primary/5 transition-all duration-300 group">
                  <div
                    class="w-12 h-12 bg-framework-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-framework-primary group-hover:scale-110 transition-all duration-300">
                    <i class="fa-solid fa-envelope text-2xl text-framework-primary group-hover:text-white"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-framework-black mb-1">E-mail</h3>
                    <p class="text-gray-600 text-sm"><?php echo esc_html(frameworkupsites_get_email()); ?></p>
                  </div>
                </a>
              <?php endif; ?>

              <?php if (frameworkupsites_get_address()): ?>
                <!-- Localização -->
                <div class="flex items-start gap-4 p-4 rounded-xl border border-gray-200">
                  <div
                    class="w-12 h-12 bg-framework-primary/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-location-dot text-2xl text-framework-primary"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-framework-black mb-1">Localização</h3>
                    <p class="text-gray-600 text-sm"><?php echo esc_html(frameworkupsites_get_address()); ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (frameworkupsites_get_phone()): ?>
                <!-- Telefone -->
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', frameworkupsites_get_phone())); ?>"
                  class="flex items-start gap-4 p-4 rounded-xl border border-gray-200 hover:border-framework-primary hover:bg-framework-primary/5 transition-all duration-300 group">
                  <div
                    class="w-12 h-12 bg-framework-primary/10 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-framework-primary group-hover:scale-110 transition-all duration-300">
                    <i class="fa-solid fa-phone text-2xl text-framework-primary group-hover:text-white"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-framework-black mb-1">Telefone</h3>
                    <p class="text-gray-600 text-sm">
                      <?php echo esc_html(frameworkupsites_format_phone(frameworkupsites_get_phone())); ?></p>
                  </div>
                </a>
              <?php endif; ?>

            </div>

            <!-- Redes Sociais -->
            <?php
            $has_social = frameworkupsites_get_social('facebook') || frameworkupsites_get_social('instagram') ||
              frameworkupsites_get_social('linkedin') || frameworkupsites_get_social('twitter') ||
              frameworkupsites_get_social('youtube');
            if ($has_social):
              ?>
              <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="font-bold text-framework-black mb-4">Siga-nos nas redes sociais</h3>
                <div class="flex gap-3">
                  <?php if (frameworkupsites_get_social('facebook')): ?>
                    <a href="<?php echo esc_url(frameworkupsites_get_social('facebook')); ?>" target="_blank" rel="noopener"
                      class="w-10 h-10 bg-framework-primary/10 rounded-lg flex items-center justify-center text-framework-primary hover:bg-framework-primary hover:text-white transition-all duration-300">
                      <i class="fa-brands fa-facebook"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (frameworkupsites_get_social('instagram')): ?>
                    <a href="<?php echo esc_url(frameworkupsites_get_social('instagram')); ?>" target="_blank"
                      rel="noopener"
                      class="w-10 h-10 bg-framework-primary/10 rounded-lg flex items-center justify-center text-framework-primary hover:bg-framework-primary hover:text-white transition-all duration-300">
                      <i class="fa-brands fa-instagram"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (frameworkupsites_get_social('linkedin')): ?>
                    <a href="<?php echo esc_url(frameworkupsites_get_social('linkedin')); ?>" target="_blank" rel="noopener"
                      class="w-10 h-10 bg-framework-primary/10 rounded-lg flex items-center justify-center text-framework-primary hover:bg-framework-primary hover:text-white transition-all duration-300">
                      <i class="fa-brands fa-linkedin"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (frameworkupsites_get_social('twitter')): ?>
                    <a href="<?php echo esc_url(frameworkupsites_get_social('twitter')); ?>" target="_blank" rel="noopener"
                      class="w-10 h-10 bg-framework-primary/10 rounded-lg flex items-center justify-center text-framework-primary hover:bg-framework-primary hover:text-white transition-all duration-300">
                      <i class="fa-brands fa-twitter"></i>
                    </a>
                  <?php endif; ?>

                  <?php if (frameworkupsites_get_social('youtube')): ?>
                    <a href="<?php echo esc_url(frameworkupsites_get_social('youtube')); ?>" target="_blank" rel="noopener"
                      class="w-10 h-10 bg-framework-primary/10 rounded-lg flex items-center justify-center text-framework-primary hover:bg-framework-primary hover:text-white transition-all duration-300">
                      <i class="fa-brands fa-youtube"></i>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>

          </div>

          <!-- Formulário -->
          <div class="bg-gray-50 rounded-2xl p-8">
            <h2 class="text-2xl font-bold text-framework-black mb-6">
              Envie sua mensagem
            </h2>

            <form id="contact-form" class="space-y-6">

              <!-- Nome -->
              <div>
                <label for="nome" class="block text-sm font-semibold text-framework-black mb-2">
                  Nome completo *
                </label>
                <input type="text" id="nome" name="nome" required
                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-framework-primary focus:border-transparent transition-all duration-300">
              </div>

              <!-- E-mail -->
              <div>
                <label for="email" class="block text-sm font-semibold text-framework-black mb-2">
                  E-mail *
                </label>
                <input type="email" id="email" name="email" required
                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-framework-primary focus:border-transparent transition-all duration-300">
              </div>

              <!-- Telefone -->
              <div>
                <label for="telefone" class="block text-sm font-semibold text-framework-black mb-2">
                  Telefone / WhatsApp *
                </label>
                <input type="tel" id="telefone" name="telefone" required
                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-framework-primary focus:border-transparent transition-all duration-300">
              </div>

              <!-- Assunto -->
              <div>
                <label for="assunto" class="block text-sm font-semibold text-framework-black mb-2">
                  Assunto *
                </label>
                <select id="assunto" name="assunto" required
                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-framework-primary focus:border-transparent transition-all duration-300">
                  <option value="">Selecione um assunto</option>
                  <option value="orcamento">Solicitar orçamento</option>
                  <option value="duvida">Tirar dúvida</option>
                  <option value="suporte">Suporte técnico</option>
                  <option value="outro">Outro</option>
                </select>
              </div>

              <!-- Mensagem -->
              <div>
                <label for="mensagem" class="block text-sm font-semibold text-framework-black mb-2">
                  Mensagem *
                </label>
                <textarea id="mensagem" name="mensagem" rows="5" required
                  class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-framework-primary focus:border-transparent transition-all duration-300 resize-none"></textarea>
              </div>

              <!-- Botão Enviar -->
              <button type="submit"
                class="w-full bg-framework-primary text-white px-8 py-4 rounded-lg font-semibold hover:bg-opacity-90 transition-all duration-300 flex items-center justify-center gap-3">
                <span>Enviar mensagem</span>
                <i class="fa-solid fa-paper-plane"></i>
              </button>

              <!-- Mensagem de sucesso/erro -->
              <div id="form-message" class="hidden p-4 rounded-lg text-sm"></div>

            </form>
          </div>

        </div>

      </div>
    </div>
  </section>

  <!-- CTA Final -->
  <?php
  $cta_title = get_option('frameworkupsites_contact_cta_title', 'Tem alguma dúvida?');
  $cta_description = get_option('frameworkupsites_contact_cta_description', 'Nossa equipe está pronta para ajudar você');
  $cta_button_text = get_option('frameworkupsites_contact_cta_button', 'Fale conosco');
  $cta_button_link = get_option('frameworkupsites_contact_cta_link', home_url('/'));
  ?>
  <section class="py-16 md:py-24 bg-gray-50">
    <div class="container mx-auto px-4">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-framework-black mb-4">
          <?php echo esc_html($cta_title); ?>
        </h2>
        <p class="text-lg text-gray-600 mb-8">
          <?php echo esc_html($cta_description); ?>
        </p>
        <a href="<?php echo esc_url($cta_button_link); ?>"
          class="cta-button bg-framework-primary text-white px-8 py-4 rounded-full font-semibold inline-flex items-center gap-3 transition-all duration-300">
          <?php echo esc_html($cta_button_text); ?>
          <i class="fa-solid fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

</main>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('contact-form');
    const formMessage = document.getElementById('form-message');

    if (form) {
      form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Aqui você pode adicionar a lógica de envio do formulário
        // Por exemplo, usando AJAX para enviar para um endpoint PHP

        // Simulação de envio bem-sucedido
        formMessage.classList.remove('hidden', 'bg-red-100', 'text-red-700');
        formMessage.classList.add('bg-green-100', 'text-green-700');
        formMessage.textContent = 'Mensagem enviada com sucesso! Entraremos em contato em breve.';

        // Limpar formulário
        form.reset();

        // Esconder mensagem após 5 segundos
        setTimeout(function () {
          formMessage.classList.add('hidden');
        }, 5000);
      });
    }
  });
</script>

<?php get_footer(); ?>