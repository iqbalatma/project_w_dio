<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Store_model extends CI_Model
{
    protected $table = 'store';
    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }

    // get 1 store berdasarkan id
    // parameter pertama untuk id sebagai acuan
    // parameter kedua untuk tabel yg akan diquery
    public function get_by_id($id, $select = '*'){
        // get from table
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $this->db->where('is_deleted', 0);
        $query = $this->db->get();
        if ( $query->num_rows() == 1) {
        return $query->row();
        }
        return FALSE;
    }
}
