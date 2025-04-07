<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargos extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library(['session', 'pagination', 'form_validation']);
        $this->load->model('Cargo_model');
    }

    public function index($offset = 0) {
        // Configuração da paginação
        $config['base_url'] = base_url('cargos/index');
        $config['total_rows'] = $this->Cargo_model->count_all();
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

        $data['cargos'] = $this->Cargo_model->get_all(ITEMS_PER_PAGE, $offset);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('templates/header');
        $this->load->view('cargos/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $this->load->view('templates/header');
        $this->load->view('cargos/create');
        $this->load->view('templates/footer');
    }

    public function store() {
        // Validation rules
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required|min_length[10]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('cargos/create');
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao')
            );

            if ($this->Cargo_model->insert($data)) {
                $this->session->set_flashdata('success', 'Cargo criado com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao criar cargo. Tente novamente.');
            }
            
            redirect('cargos');
        }
    }

    public function edit($id) {
        $data['cargo'] = $this->Cargo_model->get_by_id($id);
        $data['pessoas'] = $this->Cargo_model->get_pessoas_by_cargo($id);
        
        if (empty($data['cargo'])) {
            show_404();
        }
        
        $this->load->view('templates/header');
        $this->load->view('cargos/edit', $data);
        $this->load->view('templates/footer');
    }

    public function update($id) {
        // Validation rules
        $this->form_validation->set_rules('nome', 'Nome', 'required|min_length[3]');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required|min_length[10]');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('cargos/edit/' . $id);
        } else {
            $data = array(
                'nome' => $this->input->post('nome'),
                'descricao' => $this->input->post('descricao')
            );

            if ($this->Cargo_model->update($id, $data)) {
                $this->session->set_flashdata('success', 'Cargo atualizado com sucesso!');
            } else {
                $this->session->set_flashdata('error', 'Erro ao atualizar cargo. Tente novamente.');
            }
            
            redirect('cargos');
        }
    }

    public function delete($id) {
        if ($this->Cargo_model->delete($id)) {
            $this->session->set_flashdata('success', 'Cargo excluído com sucesso!');
        } else {
            $this->session->set_flashdata('error', 'Erro ao excluir cargo. Tente novamente.');
        }
        
        redirect('cargos');
    }
} 