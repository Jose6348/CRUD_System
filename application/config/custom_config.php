<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Configurações Personalizadas
|--------------------------------------------------------------------------
|
| Este arquivo contém configurações personalizadas para a aplicação
|
*/

// Configurações Gerais
$config['app_name'] = 'Sistema de Gestão de Pessoas e Cargos';
$config['app_version'] = '1.0.0';
$config['company_name'] = 'Sua Empresa';

// Configurações de Paginação
$config['per_page'] = 10;
$config['num_links'] = 2;

// Configurações de Upload
$config['upload_path'] = './uploads/';
$config['allowed_types'] = 'gif|jpg|png|pdf|doc|docx';
$config['max_size'] = 2048; // 2MB

// Configurações de Data e Hora
$config['date_format'] = 'd/m/Y';
$config['time_format'] = 'H:i:s';
$config['datetime_format'] = 'd/m/Y H:i:s';
$config['timezone'] = 'America/Sao_Paulo';

// Configurações de Email
$config['email_from'] = 'seu-email@dominio.com';
$config['email_from_name'] = 'Sistema de Gestão';

// Configurações de Segurança
$config['min_password_length'] = 8;
$config['max_login_attempts'] = 3;
$config['lockout_time'] = 900; // 15 minutos em segundos

// Configurações de Cache
$config['cache_time'] = 300; // 5 minutos em segundos 