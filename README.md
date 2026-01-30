# 🏢 WAMAS LogiMat Infocenter 2.0

Sistema de gerenciamento integrado para operações logísticas, desenvolvido com Laravel 11 e Bootstrap 5.3.

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-purple?style=flat-square&logo=bootstrap)
![PHP](https://img.shields.io/badge/PHP-8.3-blue?style=flat-square&logo=php)
![SQL Server](https://img.shields.io/badge/SQL%20Server-2019+-orange?style=flat-square&logo=microsoft-sql-server)

## 📋 Sobre

WAMAS LogiMat Infocenter 2.0 é uma aplicação web completa para gerenciar operações de logística e armazenamento. O sistema oferece uma interface intuitiva com autenticação de usuários, controle dinâmico de ferramentas, configurações de servidor em tempo real e integração com SQL Server.

## ✨ Funcionalidades Principais

### 🔐 Autenticação de Usuários
- **Sistema de Login/Logout**: Autenticação segura com CSRF protection
- **Registro de Usuários**: Novo usuários podem se registrar
- **Sessões Persistentes**: Gerenciamento de sessão seguro
- **Proteção de Rotas**: Rotas protegidas por middleware `auth`

### 🎛️ Painel de Configurações
- **Gerenciador de Ferramentas**: Ativar/desativar ferramentas com toggles em tempo real
- **Configurações de Servidor**: Gerenciar endpoints e credenciais de banco de dados dinamicamente
- **Exibição de Valores Atuais**: Cada campo mostra o valor configurado em tempo de execução
- **Variáveis Configuráveis**:
  - DB Engine, DB Server, DB Port, DB Instance
  - DB Username, DB Password
  - WAMAS Production DB, WAMAS View DB, WAMAS Archive DB

### 🔄 Sistema de Configurações Dinâmicas
- **Service Provider**: `DatabaseConfigProvider` carrega configurações do banco em tempo de execução
- **Hot Reload**: Alterações nas configurações são aplicadas imediatamente
- **Persistência**: Todas as configurações salvas no banco de dados

### 🏠 Home Dinâmica
- Exibição de ferramentas configuráveis
- Informações de usuário logado
- Botões de ação (Configurações, Logout)
- Cards responsivos com ícones
- Layout adaptativo (2-6 colunas)

### 🛠️ Ferramentas Disponíveis (12 total)
1. Integração
2. GRUPO P2L PRATELEIRA
3. COMPARTIMENTOS
4. DESBLOQUEAR COMPARTIMENTOS
5. CUBATURA ITEM P/ CAIXA
6. ESCANEIE P/ PEGAR/GUARDAR
7. TERMINAIS
8. Gerenciamento de Estoque Mínimo
9. Estatísticas
10. Importação de planilha
11. ERROS DE INTERFACE
12. MANUAIS

## 🚀 Começando

### Requisitos
- PHP 8.3+
- Composer
- SQL Server 2019+
- Node.js 18+ e npm

### Instalação

```bash
# Clone o repositório
git clone <seu-repo>
cd teste

# Instale dependências PHP
composer install

# Instale dependências JavaScript (opcional para assets)
npm install

# Configure o arquivo .env
cp .env.example .env

# Edite .env com suas credenciais SQL Server
# DB_CONNECTION=sqlsrv
# DB_SERVER=seu-servidor
# DB_PORT=1433
# DB_DATABASE=seu-banco
# DB_USERNAME=seu-usuario
# DB_PASSWORD=sua-senha

# Gere a chave da aplicação
php artisan key:generate

# Execute as migrações
php artisan migrate:fresh --seed

# Popule as ferramentas padrão
php artisan app:populate-tool-settings

# (Opcional) Execute os seeders
php artisan db:seed
```

### Rodando a Aplicação

```bash
# Inicie o servidor Laravel
php artisan serve

# A aplicação estará disponível em http://localhost:8000
```

## 📁 Estrutura do Projeto

```
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── PopulateToolSettings.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── HomeController.php
│   │       ├── SettingsController.php
│   │       ├── IntegracaoController.php
│   │       ├── ImportController.php
│   │       └── TesteController.php
│   ├── Models/
│   │   ├── ToolSetting.php
│   │   ├── ServerSetting.php
│   │   └── User.php
│   └── Providers/
│       ├── AppServiceProvider.php
│       └── DatabaseConfigProvider.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_11_27_000001_create_server_settings_table.php
│   │   ├── 2026_01_29_134819_create_tool_settings_table.php
│   │   ├── 2026_01_29_180000_alter_tool_settings_timestamps.php
│   │   └── 2026_01_29_181000_alter_users_timestamps.php
│   ├── seeders/
│   │   ├── DatabaseSeeder.php
│   │   ├── ToolSettingSeeder.php
│   │   └── ServerSettingSeeder.php
│   └── factories/
├── resources/
│   ├── views/
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   ├── site/
│   │   │   ├── home.blade.php
│   │   │   ├── settings.blade.php
│   │   │   ├── integracao.blade.php
│   │   │   ├── importar-excel.blade.php
│   │   │   └── teste.blade.php
│   │   └── welcome.blade.php
│   ├── css/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
└── public/
```

## 🔌 Rotas e Endpoints

### Autenticação
- `GET /login` - Página de login
- `POST /login` - Autenticação
- `POST /logout` - Deslogar
- `GET /register` - Página de registro
- `POST /register` - Criar novo usuário

### Aplicação Principal
- `GET /` - Home (página inicial com ferramentas)
- `GET /settings` - Painel de configurações *(requer autenticação)*
- `POST /api/settings/toggle` - Alternar visibilidade de ferramenta *(requer autenticação)*
- `POST /api/settings/server` - Atualizar configuração de servidor *(requer autenticação)*
- `GET /integracao` - Página de integrações
- `GET /importar-excel` - Formulário de importação
- `POST /importar-excel` - Processar importação

## 💾 Banco de Dados

### Tabelas Principais

**users**
- id (PK)
- name
- email (UNIQUE)
- password
- created_at, updated_at (datetime2)

**tool_settings**
- id (PK)
- tool_name (UNIQUE)
- tool_label
- icon_path (nullable)
- is_visible (boolean)
- sort_order (integer)
- created_at, updated_at (datetime2)

**server_settings**
- id (PK)
- key (UNIQUE)
- label
- value
- type
- created_at, updated_at (datetime2)

## 🛠️ Tecnologias Utilizadas

- **Framework**: Laravel 11
- **PHP**: 8.3+
- **Frontend**: Bootstrap 5.3.2, Font Awesome 6.4
- **Banco de Dados**: SQL Server 2019+
- **Autenticação**: Laravel Auth built-in
- **Validação**: CSRF Token, Form Validation
- **AJAX**: Fetch API com promises
- **Build Tool**: Vite

## 🔐 Segurança

- ✅ CSRF Token em todos os formulários e requisições AJAX
- ✅ Proteção de rotas com middleware `auth`
- ✅ Validação de entrada em controllers
- ✅ Proteção contra SQL Injection (Eloquent ORM)
- ✅ Senhas criptografadas com bcrypt
- ✅ Sessions persistentes e seguras

## 📊 Comandos Artisan Úteis

```bash
# Repopular banco de dados (migrations + seeders)
php artisan migrate:fresh --seed

# Popular apenas as ferramentas
php artisan app:populate-tool-settings

# Executar seeders específicos
php artisan db:seed --class=ToolSettingSeeder

# Listar todas as rotas
php artisan route:list

# Cache de configuração
php artisan config:cache

# Limpar cache
php artisan cache:clear
```

## 📝 Variáveis de Ambiente (.env)

```env
APP_NAME=WAMAS_LogiMat
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:...

DB_CONNECTION=sqlsrv
DB_SERVER=seu-servidor
DB_PORT=1433
DB_DATABASE=seu-banco
DB_USERNAME=seu-usuario
DB_PASSWORD=sua-senha
```

## 🚦 Status do Projeto

- ✅ Autenticação de usuários
- ✅ Configurações dinâmicas de servidor
- ✅ Gerenciador de ferramentas
- ✅ Home dinâmica
- ✅ Proteção de rotas
- ⏳ Integrações com WAMAS (em progresso)

## 📄 Licença

MIT License - Veja LICENSE para detalhes.

## 👤 Autor

Desenvolvido por Bruno Bendel para operações logísticas.
