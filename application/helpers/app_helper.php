<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('format_date')) {
    function format_date($date, $format = DATE_FORMAT) {
        return date($format, strtotime($date));
    }
}

if (!function_exists('is_active_menu')) {
    function is_active_menu($menu) {
        $CI =& get_instance();
        return $CI->router->fetch_class() === $menu ? 'active' : '';
    }
}

if (!function_exists('flash_message')) {
    function flash_message() {
        $CI =& get_instance();
        $message = $CI->session->flashdata('message');
        $type = $CI->session->flashdata('message_type');
        
        if ($message) {
            return sprintf(
                '<div class="alert alert-%s alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    %s
                </div>',
                $type,
                $message
            );
        }
        return '';
    }
} 