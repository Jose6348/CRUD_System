<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoas extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library(['session', 'pagination', 'form_validation']);
        $this->load->model('Pessoa_model');
        $this->load->model('Cargo_model');
    }

    public function index($offset = 0) {
        // Configuração da paginação
        $config['base_url'] = base_url('pessoas/index');
        $config['total_rows'] = $this->Pessoa_model->count_all();
        $config['per_page'] = ITEMS_PER_PAGE;
        $config['uri_segment'] = 3;
        
        // Bootstrap 5 styling
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo;';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = '&raquo;';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '&gt;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '&lt;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data['pessoas'] = $this->Pessoa_model->get_all_with_last_cargo(ITEMS_PER_PAGE, $offset);
        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('templates/header');
        $this->load->view('pessoas/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['cargos'] = $this->Cargo_model->get_all();
        $this->load->view('templates/header');
        $this->load->view('pessoas/create', $data);
        $this->load->view('templates/footer');
    }

    public function store() {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'telefone' => $this->input->post('telefone')
        );

        $pessoa_id = $this->Pessoa_model->insert($data);

        if ($pessoa_id && $this->input->post('cargo_id')) {
            $this->Pessoa_model->add_cargo($pessoa_id, $this->input->post('cargo_id'), $this->input->post('data_inicio'));
        }

        redirect('pessoas');
    }

    public function edit($id) {
        $data['pessoa'] = $this->Pessoa_model->get_by_id($id);
        $data['cargos'] = $this->Cargo_model->get_all();
        $data['historico'] = $this->Pessoa_model->get_historico_cargos($id);
        
        $this->load->view('templates/header');
        $this->load->view('pessoas/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id) {
        $data = array(
            'nome' => $this->input->post('nome'),
            'email' => $this->input->post('email'),
            'telefone' => $this->input->post('telefone')
        );

        $this->Pessoa_model->update($id, $data);
        redirect('pessoas');
    }

    public function delete($id) {
        // Verifica se a pessoa existe
        $pessoa = $this->Pessoa_model->get_by_id($id);
        if (!$pessoa) {
            $this->session->set_flashdata('error', 'Pessoa não encontrada.');
            redirect('pessoas');
            return;
        }

        // Tenta excluir a pessoa
        if ($this->Pessoa_model->delete($id)) {
            $this->session->set_flashdata('success', 'Pessoa excluída com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Erro ao excluir pessoa. Tente novamente.');
        }
        
        redirect('pessoas');
    }

    public function add_cargo($pessoa_id) {
        $cargo_id = $this->input->post('cargo_id');
        $data_inicio = $this->input->post('data_inicio');
        
        $this->Pessoa_model->add_cargo($pessoa_id, $cargo_id, $data_inicio);
        redirect('pessoas/edit/' . $pessoa_id);
    }

    public function update_historico($historico_id) {
        $data = array(
            'data_inicio' => $this->input->post('data_inicio'),
            'data_fim' => $this->input->post('data_fim')
        );
        
        $this->Pessoa_model->update_historico($historico_id, $data);
        redirect('pessoas/edit/' . $this->input->post('pessoa_id'));
    }

    public function delete_historico($id) {
        if (!$id) {
            $this->session->set_flashdata('error', 'ID do histórico não fornecido.');
            redirect('pessoas/edit/' . $this->input->post('pessoa_id'));
            return;
        }

        $historico = $this->db->get_where('historico_cargos', ['id' => $id])->row();
        if (!$historico) {
            $this->session->set_flashdata('error', 'Registro de histórico não encontrado.');
            redirect('pessoas/edit/' . $this->input->post('pessoa_id'));
            return;
        }

        $pessoa_id = $historico->pessoa_id;

        if ($this->db->delete('historico_cargos', ['id' => $id])) {
            $this->session->set_flashdata('success', 'Cargo removido do histórico com sucesso.');
        } else {
            $this->session->set_flashdata('error', 'Erro ao remover cargo do histórico.');
        }

        redirect('pessoas/edit/' . $pessoa_id);
    }
} 