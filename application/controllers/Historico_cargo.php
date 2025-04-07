<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_cargo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('historico_cargo_model');
        $this->load->model('pessoa_model');
        $this->load->model('cargo_model');
        $this->load->library('form_validation');
    }

    public function editar($id) {
        $data['title'] = 'Editar Histórico de Cargo';
        $data['historico'] = $this->historico_cargo_model->get_by_id($id);
        $data['pessoa'] = $this->pessoa_model->get_by_id($data['historico']->pessoa_id);
        $data['cargos'] = $this->cargo_model->get_all();

        if (empty($data['historico'])) {
            show_404();
        }

        $this->form_validation->set_rules('cargo_id', 'Cargo', 'required');
        $this->form_validation->set_rules('data_inicio', 'Data de Início', 'required');
        $this->form_validation->set_rules('data_fim', 'Data de Fim', '');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('historico_cargo/editar', $data);
            $this->load->view('templates/footer');
        } else {
            $this->historico_cargo_model->update($id, array(
                'cargo_id' => $this->input->post('cargo_id'),
                'data_inicio' => $this->input->post('data_inicio'),
                'data_fim' => $this->input->post('data_fim') ? $this->input->post('data_fim') : null
            ));

            $this->session->set_flashdata('success', 'Histórico de cargo atualizado com sucesso.');
            redirect('pessoas/historico/' . $data['historico']->pessoa_id);
        }
    }

    public function excluir($id) {
        $historico = $this->historico_cargo_model->get_by_id($id);
        
        if (empty($historico)) {
            show_404();
        }

        $pessoa_id = $historico->pessoa_id;
        $this->historico_cargo_model->delete($id);
        
        $this->session->set_flashdata('success', 'Histórico de cargo excluído com sucesso.');
        redirect('pessoas/historico/' . $pessoa_id);
    }
} 