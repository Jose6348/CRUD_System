<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Formata uma data para o padrão brasileiro
 *
 * @param string $date Data no formato Y-m-d
 * @return string Data formatada (d/m/Y)
 */
if (!function_exists('format_date')) {
    function format_date($date) {
        if (!$date) return '';
        return date('d/m/Y', strtotime($date));
    }
}

/**
 * Formata um valor monetário
 *
 * @param float $value Valor a ser formatado
 * @return string Valor formatado (R$ 1.234,56)
 */
if (!function_exists('format_money')) {
    function format_money($value) {
        if (!$value) return 'R$ 0,00';
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}

/**
 * Formata um número de telefone
 *
 * @param string $phone Número de telefone
 * @return string Telefone formatado ((99) 99999-9999)
 */
if (!function_exists('format_phone')) {
    function format_phone($phone) {
        if (!$phone) return '';
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) === 11) {
            return '(' . substr($phone, 0, 2) . ') ' . substr($phone, 2, 5) . '-' . substr($phone, 7);
        }
        return $phone;
    }
}

/**
 * Verifica se uma string é um email válido
 *
 * @param string $email Email a ser validado
 * @return bool True se for válido, False se não for
 */
if (!function_exists('is_valid_email')) {
    function is_valid_email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

/**
 * Gera um slug a partir de uma string
 *
 * @param string $string String a ser convertida
 * @return string Slug gerado
 */
if (!function_exists('generate_slug')) {
    function generate_slug($string) {
        $string = strtolower($string);
        $string = preg_replace('/[áàãâä]/ui', 'a', $string);
        $string = preg_replace('/[éèêë]/ui', 'e', $string);
        $string = preg_replace('/[íìîï]/ui', 'i', $string);
        $string = preg_replace('/[óòõôö]/ui', 'o', $string);
        $string = preg_replace('/[úùûü]/ui', 'u', $string);
        $string = preg_replace('/[ç]/ui', 'c', $string);
        $string = preg_replace('/[^a-z0-9]/i', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
}

/**
 * Trunca um texto mantendo palavras inteiras
 *
 * @param string $text Texto a ser truncado
 * @param int $limit Limite de caracteres
 * @param string $end Final do texto truncado
 * @return string Texto truncado
 */
if (!function_exists('truncate_text')) {
    function truncate_text($text, $limit = 100, $end = '...') {
        if (strlen($text) <= $limit) return $text;
        
        $truncated = substr($text, 0, $limit);
        $last_space = strrpos($truncated, ' ');
        
        if ($last_space !== false) {
            $truncated = substr($truncated, 0, $last_space);
        }
        
        return $truncated . $end;
    }
}

/**
 * Retorna o tempo decorrido de uma data até agora
 *
 * @param string $date Data no formato Y-m-d H:i:s
 * @return string Tempo decorrido em formato legível
 */
if (!function_exists('time_elapsed')) {
    function time_elapsed($date) {
        $timestamp = strtotime($date);
        $difference = time() - $timestamp;
        
        $periods = array(
            31536000 => 'ano',
            2592000 => 'mês',
            604800 => 'semana',
            86400 => 'dia',
            3600 => 'hora',
            60 => 'minuto',
            1 => 'segundo'
        );
        
        foreach ($periods as $seconds => $name) {
            $count = floor($difference / $seconds);
            if ($count > 0) {
                if ($count > 1) {
                    $name = str_replace('ês', 'eses', $name);
                    $name .= 's';
                }
                return "há {$count} {$name}";
            }
        }
        
        return 'agora mesmo';
    }
}

/**
 * Retorna o status de um registro em formato legível
 *
 * @param int $status Código do status
 * @return string Status em formato legível
 */
if (!function_exists('get_status')) {
    function get_status($status) {
        $statuses = array(
            0 => 'Inativo',
            1 => 'Ativo',
            2 => 'Pendente',
            3 => 'Cancelado',
            4 => 'Concluído'
        );
        
        return isset($statuses[$status]) ? $statuses[$status] : 'Desconhecido';
    }
}

/**
 * Retorna a classe CSS para um status
 *
 * @param int $status Código do status
 * @return string Classe CSS correspondente
 */
if (!function_exists('get_status_class')) {
    function get_status_class($status) {
        $classes = array(
            0 => 'text-danger',
            1 => 'text-success',
            2 => 'text-warning',
            3 => 'text-danger',
            4 => 'text-info'
        );
        
        return isset($classes[$status]) ? $classes[$status] : '';
    }
}

/**
 * Retorna o ícone para um status
 *
 * @param int $status Código do status
 * @return string Classe do ícone Font Awesome
 */
if (!function_exists('get_status_icon')) {
    function get_status_icon($status) {
        $icons = array(
            0 => 'fa-times-circle',
            1 => 'fa-check-circle',
            2 => 'fa-clock',
            3 => 'fa-ban',
            4 => 'fa-check-double'
        );
        
        return isset($icons[$status]) ? 'fas ' . $icons[$status] : 'fas fa-question-circle';
    }
} 