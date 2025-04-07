# Sistema de Gestão de Cargos e Pessoas

Sistema desenvolvido em CodeIgniter 3 para gerenciamento de cargos e pessoas, com histórico de cargos.

## Requisitos

- PHP 7.2 ou superior
- PostgreSQL
- Apache/Nginx
- Composer

## Configuração do Banco de Dados

1. Criar um banco de dados PostgreSQL
2. Importar o arquivo `database.sql` que contém a estrutura das tabelas
3. Configurar as credenciais do banco em `application/config/database.php`

## Estrutura do Banco de Dados

- `cargos`: Armazena os cargos disponíveis
- `pessoas`: Armazena informações das pessoas
- `historico_cargos`: Armazena o histórico de cargos das pessoas

## Funcionalidades

- CRUD de Cargos
- CRUD de Pessoas
- Vinculação de cargos a pessoas
- Histórico de cargos
- Consulta de pessoas com último cargo
- Consulta de histórico de cargos por pessoa 