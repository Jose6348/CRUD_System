<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Pessoa_model');
        $this->load->model('Cargo_model');
    }

    public function index() {
        // Busca totais
        $data['total_pessoas'] = $this->Pessoa_model->count_all();
        $data['total_cargos'] = $this->Cargo_model->count_all();
        
        // Calcula média de pessoas por cargo
        $data['media_pessoas_por_cargo'] = $data['total_cargos'] > 0 
            ? $data['total_pessoas'] / $data['total_cargos'] 
            : 0;

        // Busca últimas 5 pessoas cadastradas
        $data['ultimas_pessoas'] = $this->Pessoa_model->get_ultimas_pessoas(5);

        // Busca últimas 5 alterações de cargo
        $data['ultimas_alteracoes'] = $this->Pessoa_model->get_ultimas_alteracoes_cargo(5);

        $this->load->view('templates/header');
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
} 