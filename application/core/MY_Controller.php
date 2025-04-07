<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
    }

    protected function render($view, $data = []) {
        $this->load->view('templates/header', $data);
        $this->load->view($view, $data);
        $this->load->view('templates/footer', $data);
    }

    protected function redirect_with_message($url, $message, $type = 'success') {
        $this->session->set_flashdata('message', $message);
        $this->session->set_flashdata('message_type', $type);
        redirect($url);
    }
} 