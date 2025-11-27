# 🏢 WAMAS Infocenter

Sistema de gerenciamento integrado para operações logísticas, desenvolvido com Laravel e Bootstrap.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat-square&logo=bootstrap)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=flat-square&logo=php)
![SQLite](https://img.shields.io/badge/SQLite-3-green?style=flat-square&logo=sqlite)

## 📋 Sobre

WAMAS Infocenter é uma aplicação web completa para gerenciar operações de logística e armazenamento. O sistema oferece uma interface intuitiva com controle de visibilidade de ferramentas, configurações de servidor e integração de dados.

## ✨ Funcionalidades Principais

### 🎛️ Painel de Configurações
- **Gerenciador de Ferramentas**: Ativar/desativar itens do painel principal com toggles
- **Configurações de Servidor**: Definir endpoints e credenciais de banco de dados
- Interface com duas abas (Ferramentas e Servidor)

### 🔗 Sistema de Integrações
- **Módulo de Itens**: Gestão de SKU, descrição e quantidade
- **Armazenamento**: Controle de zonas e quantidades em estoque
- **Picking**: Gerenciamento de retiradas com localização
- **Inventário**: Tabela com dados em tempo real, exportação para Excel e refresh automático

### 🏠 Home Dinâmica
- Exibição de ferramentas configuráveis
- Cards com ícones e rápido acesso
- Layout responsivo (2-6 colunas)

### 📊 Ferramentas Disponíveis
- Integração de dados
- Grupo P2L Prateleira
- Compartimentos
- Desbloquear Compartimentos
- Cubatura Item para Caixa
- Escanear para Pegar/Guardar
- Terminais
- Gerenciamento de Estoque Mínimo
- Estatísticas
- Importação de Planilha
- Erros de Interface
- Manuais

## 🚀 Começando

### Requisitos
- PHP 8.2+
- Composer
- Node.js e npm
- SQLite

### Instalação

```bash
# Clone o repositório
git clone https://github.com/brunobendel/wamas_Infocenter.git
cd wamas_Infocenter

# Instale dependências PHP
composer install

# Instale dependências JavaScript
npm install

# Configure o arquivo .env
cp .env.example .env

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrações e seeders
php artisan migrate --seed

# Compile assets
npm run dev
```

### Rodando a Aplicação

```bash
# Em um terminal - iniciar o servidor Laravel
php artisan serve

# Em outro terminal - compilar assets em tempo real
npm run dev
```

A aplicação estará disponível em `http://localhost:8000`

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── SettingsController.php
│   │       └── IntegracaoController.php
│   ├── Models/
│   │   ├── ToolSetting.php
│   │   ├── ServerSetting.php
│   │   └── User.php
│   └── Imports/
│       └── ColunaImport.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── ToolSettingSeeder.php
│   │   └── ServerSettingSeeder.php
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── site/
│   │   │   ├── home.blade.php
│   │   │   ├── settings.blade.php
│   │   │   └── integracao.blade.php
│   │   └── welcome.blade.php
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── console.php
└── public/
```

## 🔌 API Endpoints

### Configurações
- `GET /settings` - Página de configurações
- `POST /api/settings/toggle` - Alternar visibilidade de ferramenta
- `POST /api/settings/server` - Atualizar configuração de servidor

### Integrações
- `GET /integracao` - Página de integrações

## 💾 Banco de Dados

### Tabelas Principais

**tool_settings**
- ID única
- Nome da ferramenta (único)
- Label para exibição
- Caminho do ícone
- Status de visibilidade (booleano)
- Ordem de exibição

**server_settings**
- ID única
- Chave de configuração (única)
- Label descritivo
- Valor da configuração
- Tipo de campo
- Timestamps

## 🛠️ Tecnologias Utilizadas

- **Backend**: Laravel 11
- **Frontend**: Bootstrap 5.3.2, Font Awesome
- **Banco de Dados**: SQLite
- **Build Tool**: Vite
- **Exportação**: XLSX (cdnjs)
- **Validação**: CSRF Token
- **API**: REST JSON

## 📝 Funcionalidades Técnicas

- Autenticação com CSRF protection
- Migrações versionadas
- Seeders para dados iniciais
- Controllers com validação
- Blade templating
- AJAX com fetch API
- Export para Excel
- Layout responsivo

## 🔐 Segurança

- CSRF token em todos os formulários
- Validação de entrada
- Headers de segurança
- Proteção contra SQL Injection (Eloquent ORM)

## 📈 Roadmap

- [ ] APIs de backend para integrações
- [ ] Conexão com MSSQL
- [ ] Autenticação de usuários
- [ ] Dashboard com gráficos
- [ ] Relatórios avançados
- [ ] Mobile app

## 👨‍💻 Autor

**Bruno Bendel**
- GitHub: [@brunobendel](https://github.com/brunobendel)
- Projeto: [wamas_Infocenter](https://github.com/brunobendel/wamas_Infocenter)

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo LICENSE para mais detalhes.

## 🤝 Contribuições

Contribuições são bem-vindas! Para grandes mudanças, abra uma issue primeiro para discutir as alterações propostas.

## 📞 Suporte

Para suporte, abra uma issue no repositório GitHub.

---

**Desenvolvido com ❤️ usando Laravel e Bootstrap**

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
