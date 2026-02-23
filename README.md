# FrameworkUpsites - Tema WordPress Moderno e Reutilizável

Tema WordPress moderno e flexível com Tailwind CSS, desenvolvido para ser reutilizável em qualquer projeto.

## Características

- **Framework CSS**: Tailwind CSS 3.4
- **Cores Personalizáveis**: Sistema de cores via `tailwind.config.js`
- **Menu Responsivo**: Com submenu customizado
- **Header Fixo**: Com compactação no scroll (desktop)
- **Suporte WooCommerce**: Completo
- **Custom Post Types**: Sistema de projetos incluído
- **Sistema de Templates**: Automático via pasta `/pages/`
- **Otimizações**: Performance e SEO

## Instalação

1. Faça upload do tema para `/wp-content/themes/frameworkupsites/`
2. Ative o tema no WordPress
3. Instale e ative o plugin **Advanced Custom Fields (ACF)** (recomendado)
4. Configure as opções do tema em **Opções FrameworkUpsites** no admin

## Configuração Inicial

### 1. Opções do Tema
Acesse **Opções FrameworkUpsites** no admin do WordPress e configure:

#### Aba Contato
- Telefone
- WhatsApp (formato: DDI + DDD + número, ex: 5534997100854)
- Email
- Endereço

#### Aba Redes Sociais
- Facebook
- Instagram
- LinkedIn
- Twitter/X
- YouTube

#### Aba Scripts
- Google Analytics 4 ID
- Facebook Pixel ID
- Scripts customizados (header/footer)

#### Aba Performance
- Desativar Emojis
- Desativar Embeds
- Lazy Load de Imagens

### 2. Menus
Configure em **Aparência > Menus**:
- **Menu Principal** (primary): Menu do header
- **Menu Rodapé** (footer): Menu do footer

### 3. Logo
Configure em **Aparência > Personalizar > Identidade do Site**

### 4. Cores do Tema
Edite o arquivo `tailwind.config.js` para personalizar as cores:

```javascript
colors: {
  'tema-primary': '#4b58ff',  // Cor principal
  'tema-white': '#fff',    // Cor de fundo clara
  'tema-black': '#000',    // Cor escura
}
```

Após alterar, execute:
```bash
npm run build
```

## 🛠️ Desenvolvimento

### Requisitos
- Node.js 14+
- npm ou yarn

### Instalação de Dependências
```bash
npm install
```

### Desenvolvimento (Watch Mode)
```bash
npm run dev
```

Isso irá:
- Compilar Tailwind CSS em watch mode
- Iniciar BrowserSync para live reload

### Build para Produção
```bash
npm run build
```

## 📁 Estrutura de Arquivos

```
frameworkupsites/
├── assets/
│   ├── css/
│   │   └── tailwind.css (compilado)
│   ├── img/
│   └── js/
│       └── main.js
├── inc/
│   ├── class-walker-nav-menu.php
│   ├── helpers.php
│   ├── performance.php
│   ├── security.php
│   ├── shortcodes.php
│   └── theme-options.php
├── pages/
│   ├── blog.php
│   ├── contato.php
│   ├── home.php
│   └── nossos-projetos.php
├── parts/
│   ├── cta.php
│   └── page-hero.php
├── src/
│   └── input.css (source Tailwind)
├── functions.php
├── header.php
├── footer.php
├── style.css
└── tailwind.config.js
```

## 🎨 Sistema de Cores Padrão

- **Primary**: `#4b58ff` (Azul vibrante)
- **White**: `#f1eded` (Branco suave)
- **Black**: `#1e1c1c` (Preto suave)

Todas as cores podem ser alteradas em `tailwind.config.js`

## 📱 Breakpoints Responsivos

- **sm**: 640px
- **md**: 768px
- **lg**: 1024px
- **xl**: 1200px

## 🔧 Funções Auxiliares

### Helpers disponíveis (inc/helpers.php)

```php
// Formatar telefone
frameworkupsites_format_phone($phone)

// Link do WhatsApp
frameworkupsites_whatsapp_link($number, $message)

// Obter opções do tema
frameworkupsites_get_phone()
frameworkupsites_get_whatsapp()
frameworkupsites_get_email()
frameworkupsites_get_address()
frameworkupsites_get_social('facebook') // instagram, linkedin, twitter, youtube

// Limitar texto
frameworkupsites_limit_text($text, $limit, $ending)
frameworkupsites_limit_words($text, $limit, $ending)

// Tempo de leitura
frameworkupsites_reading_time($content)
```

### Shortcodes disponíveis (inc/shortcodes.php)

```
[button url="#" text="Clique aqui" style="primary" size="md"]
[highlight style="info" title="Título"]Texto[/highlight]
[icon name="check" color="blue" size="md"]
[phone link="yes"]
[whatsapp text="Fale conosco" message="Olá!"]
[year]
[sitename]
```

## 🔒 Segurança

O tema inclui várias medidas de segurança:
- Remoção de informações sensíveis do WordPress
- Headers de segurança
- Sanitização automática de formulários
- Limitação de tentativas de login
- Desabilitação de edição de arquivos no admin

## 📊 Performance

Otimizações incluídas:
- Lazy loading de imagens
- Defer de JavaScript
- Preconnect a recursos externos
- Remoção de scripts desnecessários
- Cache de queries

## Suporte

Para dúvidas ou problemas:
1. Verifique se o ACF está instalado e ativo
2. Certifique-se de que os permalinks estão configurados
3. Limpe o cache após alterações
4. Recompile o Tailwind CSS após mudanças de estilo

## Changelog

### Versão 1.0.0
- Lançamento inicial
- Tema base reutilizável
- Suporte completo a WooCommerce
- Custom Post Type "Projetos"
- Sistema de templates flexível
- Menu responsivo com submenu
- Otimizações de performance e SEO

## Licença

GPL v2 or later

## Créditos

Desenvolvido por: Pedro Hilário
Github: https://github.com/Pedroohlr
