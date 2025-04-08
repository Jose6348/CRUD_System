<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cargo_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * Get all cargos with pagination
     * @param int $limit Number of records per page
     * @param int $offset Starting record
     * @return array List of cargos
     */
    public function get_all($limit = null, $offset = 0) {
        $this->db->select('c.*, COUNT(hc.id) as total_pessoas');
        $this->db->from('cargos c');
        $this->db->join('historico_cargos hc', 'c.id = hc.cargo_id AND hc.data_fim IS NULL', 'left');
        $this->db->group_by('c.id');
        $this->db->order_by('c.nome', 'ASC');
        
        if ($limit !== null) {
            $this->db->limit($limit, $offset);
        }
        
        return $this->db->get()->result();
    }

    /**
     * Get cargo by ID
     * @param int $id Cargo ID
     * @return object|null Cargo data or null if not found
     */
    public function get_by_id($id) {
        return $this->db->get_where('cargos', array('id' => $id))->row();
    }

    /**
     * Insert new cargo
     * @param array $data Cargo data
     * @return int|bool Inserted ID or false on error
     */
    public function insert($data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('cargos', $data) ? $this->db->insert_id() : false;
    }

    /**
     * Update cargo
     * @param int $id Cargo ID
     * @param array $data Cargo data
     * @return bool True on success, false on failure
     */
    public function update($id, $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        
        $this->db->where('id', $id);
        return $this->db->update('cargos', $data);
    }

    /**
     * Delete cargo
     * @param int $id Cargo ID
     * @return bool True on success, false on failure
     */
    public function delete($id) {
        $this->db->trans_start();
        
        // First delete all historical records for this cargo
        $this->db->where('cargo_id', $id);
        $this->db->delete('historico_cargos');
        
        // Then delete the cargo
        $this->db->where('id', $id);
        $this->db->delete('cargos');

        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

    /**
     * Get people by cargo
     * @param int $cargo_id Cargo ID
     * @return array List of people
     */
    public function get_pessoas_by_cargo($cargo_id) {
        $this->db->select('p.*, hc.data_inicio');
        $this->db->from('pessoas p');
        $this->db->join('historico_cargos hc', 'p.id = hc.pessoa_id');
        $this->db->where('hc.cargo_id', $cargo_id);
        $this->db->where('hc.data_fim IS NULL');
        $this->db->order_by('p.nome', 'ASC');
        return $this->db->get()->result();
    }

    /**
     * Count total cargos
     * @return int Total number of cargos
     */
    public function count_all() {
        return $this->db->count_all('cargos');
    }
} 