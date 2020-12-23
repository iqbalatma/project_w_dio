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

    /**
     * 
     * Get one row from certain table
     * 
     * @param string $select 
     * Default value is '*', but you can input some string
     * to select some table(s) name of your choice.
     * 
     */
    public function get_by_id($id, $select = '*')
    {
        $this->db->select($select);
        $this->db->from("{$this->table} AS s");
        // $this->db->where("{$this->tb_product_composition}.product_id", $id);
        $this->db->where('id', $id);
        
        $query = $this->db->get();
        if ( $query->num_rows() == 1) {
        return $query->row();
        }
        return FALSE;
    }

}
