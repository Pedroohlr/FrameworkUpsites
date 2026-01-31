/**
 * Browser-sync Configuration
 *
 * Configuração para live reload no desenvolvimento
 *
 * @package FrameworkUpsites
 */

module.exports = {
  // Proxy do seu site LocalWP
  // IMPORTANTE: Altere "grid-agency.local" para o domínio do seu site no LocalWP
  proxy: "grid-agency.local",

  // Arquivos para observar (live reload automático)
  files: [
    "**/*.php",
    "**/*.js",
    "assets/css/*.css",
    "parts/**/*.php",
    "pages/**/*.php",
  ],

  // Configurações adicionais
  notify: false, // Desativa notificações na tela
  open: true, // Abre o navegador automaticamente
  reloadDelay: 0, // Sem delay no reload
  reloadDebounce: 500, // Debounce para evitar múltiplos reloads

  // Porta do Browser-sync (padrão: 3000)
  port: 3000,

  // UI do Browser-sync (painel de controle)
  ui: {
    port: 3001,
  },

  // Sincroniza ações entre navegadores/dispositivos
  ghostMode: {
    clicks: true, // Sincroniza cliques
    forms: true, // Sincroniza formulários
    scroll: true, // Sincroniza scroll
  },

  // Snippets customizados (opcional)
  snippetOptions: {
    rule: {
      match: /<\/body>/i,
      fn: function (snippet, match) {
        return snippet + match;
      },
    },
  },
};
