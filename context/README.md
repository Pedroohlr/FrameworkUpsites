# Context - Documentação para IA

Esta pasta contém arquivos de contexto estruturados para uso com IA (Cursor + MCP Figma) na criação automatizada de páginas e seções do tema.

## 📁 Arquivos

### 1. `style-guide.json`
Guia completo de estilos e padrões de código do projeto.

**Conteúdo:**
- Framework CSS (Tailwind)
- Cores padrão do tema
- Tipografia e tamanhos
- Componentes comuns (botões, cards, inputs)
- Sistema de grid e breakpoints
- Animações e transições
- Padrões HTML semânticos
- Padronização de código (PHP, JS, CSS)
- WordPress hooks
- Otimizações
- Ícones e formulários

### 2. `theme-context.json`
Contexto geral do tema e como ele funciona.

**Conteúdo:**
- Estrutura de diretórios
- Arquivos principais
- Sistema de templates
- Componentes reutilizáveis
- Sistema de menus
- Opções do tema
- Funções helper disponíveis
- Recursos WordPress habilitados
- JavaScript e funcionalidades
- Otimizações e segurança
- Fluxo de criação de páginas
- Padrões de seções
- Boas práticas
- Integração Figma
- Checklist para novas seções

## 🤖 Como Usar com IA

### Para criar uma nova página/seção:

1. **Referência o contexto:**
   ```
   "Leia os arquivos em /context/ para entender os padrões do projeto"
   ```

2. **Especifique o que precisa:**
   ```
   "Crie uma seção de serviços seguindo o style-guide.json e theme-context.json"
   ```

3. **A IA seguirá automaticamente:**
   - Padrões de código
   - Classes Tailwind corretas
   - Estrutura HTML semântica
   - Cores e tipografia do tema
   - Espaçamentos consistentes
   - Responsividade mobile-first
   - Acessibilidade

### Integração Figma → Código:

1. Extrair design do Figma via MCP
2. Referenciar `/context/style-guide.json` para mapeamento de cores
3. Referenciar `/context/theme-context.json` para estrutura
4. IA implementa seguindo padrões automaticamente

## ✅ Benefícios

- **Consistência:** Todas as páginas seguem o mesmo padrão
- **Velocidade:** IA não precisa adivinhar, sabe exatamente como implementar
- **Qualidade:** Código segue boas práticas definidas
- **Manutenibilidade:** Padrões documentados facilitam futuras alterações
- **Zero alucinações:** IA tem contexto completo do projeto

## 📝 Atualização

Sempre que adicionar novos padrões, componentes ou funcionalidades ao tema, atualize estes arquivos JSON para manter o contexto sincronizado.
