<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoa_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_all() {
        return $this->db->get('pessoas')->result();
    }

    public function get_all_with_last_cargo($limit = ITEMS_PER_PAGE, $offset = 0) {
        $this->db->select('p.*, hc.data_inicio, c.nome as cargo_atual');
        $this->db->from('pessoas p');
        $this->db->join('(
            SELECT DISTINCT ON (pessoa_id) pessoa_id, cargo_id, data_inicio
            FROM historico_cargos
            WHERE data_fim IS NULL
            ORDER BY pessoa_id, data_inicio DESC
        ) hc', 'p.id = hc.pessoa_id', 'left');
        $this->db->join('cargos c', 'hc.cargo_id = c.id', 'left');
        $this->db->order_by('p.nome', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('pessoas', array('id' => $id))->row();
    }

    public function insert($data) {
        $this->db->insert('pessoas', $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('pessoas', $data);
    }

    /**
     * Delete a person and their job history
     * @param int $id Person ID
     * @return bool True on success, false on failure
     */
    public function delete($id) {
        $this->db->trans_start();

        // Delete job history first (foreign key constraint)
        $this->db->where('pessoa_id', $id);
        $this->db->delete('historico_cargos');

        // Then delete the person
        $this->db->where('id', $id);
        $this->db->delete('pessoas');

        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    public function get_historico_cargos($pessoa_id) {
        $this->db->select('hc.*, c.nome as cargo_nome');
        $this->db->from('historico_cargos hc');
        $this->db->join('cargos c', 'c.id = hc.cargo_id');
        $this->db->where('hc.pessoa_id', $pessoa_id);
        $this->db->order_by('hc.data_inicio', 'DESC');
        return $this->db->get()->result();
    }

    public function add_cargo($pessoa_id, $cargo_id, $data_inicio) {
        // Fecha o cargo atual se existir
        $this->db->where('pessoa_id', $pessoa_id);
        $this->db->where('data_fim IS NULL');
        $this->db->update('historico_cargos', array('data_fim' => $data_inicio));

        // Adiciona o novo cargo
        $data = array(
            'pessoa_id' => $pessoa_id,
            'cargo_id' => $cargo_id,
            'data_inicio' => $data_inicio
        );
        $this->db->insert('historico_cargos', $data);
    }

    public function update_historico($historico_id, $data) {
        $this->db->where('id', $historico_id);
        $this->db->update('historico_cargos', $data);
    }

    public function count_all() {
        return $this->db->count_all('pessoas');
    }

    public function get_ultimas_pessoas($limit = 5) {
        $this->db->select('p.*, c.nome as cargo_atual')
                 ->from('pessoas p')
                 ->join('(SELECT pessoa_id, MAX(data_inicio) as ultima_data 
                         FROM historico_cargos 
                         GROUP BY pessoa_id) pc', 'p.id = pc.pessoa_id', 'left')
                 ->join('historico_cargos pch', 'p.id = pch.pessoa_id AND pc.ultima_data = pch.data_inicio', 'left')
                 ->join('cargos c', 'pch.cargo_id = c.id', 'left')
                 ->order_by('p.id', 'DESC')
                 ->limit($limit);
        
        return $this->db->get()->result();
    }

    public function get_ultimas_alteracoes_cargo($limit = 5) {
        $this->db->select('hc.*, p.nome as nome_pessoa, c.nome as nome_cargo')
                 ->from('historico_cargos hc')
                 ->join('pessoas p', 'hc.pessoa_id = p.id')
                 ->join('cargos c', 'hc.cargo_id = c.id')
                 ->order_by('hc.data_inicio', 'DESC')
                 ->limit($limit);
        
        return $this->db->get()->result();
    }
} 