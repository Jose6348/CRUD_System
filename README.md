# Sistema de Gestão de Cargos e Pessoas

Sistema desenvolvido em CodeIgniter 3 para gerenciamento de cargos e pessoas, com histórico de cargos.

## Instalação

1. Clone o repositório:
```bash
git clone https://github.com/Jose6348/CRUD_System
cd CRUD_System
```

2. Instale as dependências via Composer:
```bash
composer install
```

3. Configure o banco de dados PostgreSQL:
   - Crie um novo banco de dados:
     ```bash
     createdb nome_do_banco
     ```
   - Importe o arquivo `database.sql`:
     ```bash
     psql -U seu_usuario -d nome_do_banco -f database.sql
     ```
   - Copie o arquivo de configuração do banco:
     ```bash
     cp application/config/database.php.example application/config/database.php
     ```
   - Edite o arquivo `application/config/database.php` com suas credenciais:
     ```php
     $db['default'] = array(
         'hostname' => 'localhost',
         'username' => 'seu_usuario',
         'password' => 'sua_senha',
         'database' => 'nome_do_banco',
         'dbdriver' => 'postgre',
         ...
     );
     ```

4. Configure as permissões (Linux/Mac):
```bash
chmod -R 755 .
chmod -R 777 application/cache
chmod -R 777 application/logs
```

5. Inicie o servidor de desenvolvimento:
```bash
php -S localhost:8000
```

## Requisitos do Sistema

- PHP 7.2 ou superior
- PostgreSQL
- Apache/Nginx (produção) ou PHP Built-in Server (desenvolvimento)
- Composer
- Extensões PHP necessárias:
  - pdo_pgsql
  - pgsql
  - mbstring
  - json
  - session

## Estrutura do Banco de Dados

O sistema utiliza três tabelas principais:

- **cargos**: Armazena informações dos cargos
  - id (PK)
  - nome
  - descricao
  - created_at
  - updated_at

- **pessoas**: Cadastro de funcionários
  - id (PK)
  - nome
  - email
  - telefone
  - created_at
  - updated_at

- **historico_cargos**: Histórico de cargos por pessoa
  - id (PK)
  - pessoa_id (FK)
  - cargo_id (FK)
  - data_inicio
  - data_fim
  - created_at
  - updated_at

## Funcionalidades

- **Gestão de Cargos**
  - Cadastro, edição e exclusão de cargos
  - Visualização de pessoas vinculadas ao cargo

- **Gestão de Pessoas**
  - Cadastro completo de funcionários
  - Vinculação de cargos com data de início
  - Histórico completo de cargos ocupados

- **Histórico e Consultas**
  - Consulta de pessoas com cargo atual
  - Histórico detalhado de cargos por pessoa
  - Relatórios e listagens com paginação

## Interface

- Interface responsiva (desktop e mobile)
- Desenvolvida com Bootstrap 5
- Ícones Font Awesome
- Navegação intuitiva

## Solução de Problemas

1. **Erro de permissão em logs/cache**:
```bash
chmod -R 777 application/cache application/logs
```

2. **Erro de conexão com banco**:
- Verifique as credenciais em `database.php`
- Confirme se o PostgreSQL está rodando
- Teste a conexão: `pg_connect("host=localhost dbname=seu_banco user=seu_usuario password=sua_senha")`

3. **Porta 8000 em uso**:
```bash
# Encontre o processo
lsof -i :8000
# Mate o processo
kill [PID]
```

## Desenvolvimento

Para contribuir com o projeto:

1. Crie um branch para sua feature
```bash
git checkout -b feature/nova-funcionalidade
```

2. Faça suas alterações e commit
```bash
git add .
git commit -m "Descrição da alteração"
```

3. Push para o repositório
```bash
git push origin feature/nova-funcionalidade
```

4. Crie um Pull Request

## Suporte

Para reportar bugs ou sugerir melhorias, abra uma issue no repositório. 