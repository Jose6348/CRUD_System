<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historico_cargo_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_id($id) {
        return $this->db->get_where('historico_cargos', array('id' => $id))->row();
    }

    public function create($data) {
        // Primeiro, encerra o cargo atual da pessoa, se existir
        $this->db->where('pessoa_id', $data['pessoa_id']);
        $this->db->where('data_fim IS NULL');
        $this->db->update('historico_cargos', array('data_fim' => date('Y-m-d')));

        // Cria o novo registro
        $this->db->insert('historico_cargos', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('historico_cargos', $data);
    }

    public function delete($id) {
        $this->db->where('id', $id);
        return $this->db->delete('historico_cargos');
    }

    public function get_by_pessoa($pessoa_id) {
        $this->db->select('hc.*, c.nome as cargo_nome');
        $this->db->from('historico_cargos hc');
        $this->db->join('cargos c', 'c.id = hc.cargo_id');
        $this->db->where('hc.pessoa_id', $pessoa_id);
        $this->db->order_by('hc.data_inicio', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_cargo($cargo_id) {
        $this->db->select('hc.*, p.nome as pessoa_nome');
        $this->db->from('historico_cargos hc');
        $this->db->join('pessoas p', 'p.id = hc.pessoa_id');
        $this->db->where('hc.cargo_id', $cargo_id);
        $this->db->order_by('hc.data_inicio', 'DESC');
        return $this->db->get()->result();
    }
} 