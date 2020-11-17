<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Inventory_material_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    protected $table      = 'material_inventory';
    // protected $table2      = 'test';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';


    public function getAll()
    {
        $this->db->select('material_inventory.id,material_inventory.created_at,material_inventory.created_by, material.material_code,material_inventory.material_id, material.full_name, store.store_name, material_inventory.quantity, material_inventory.updated_by');
        $this->db->from('material_inventory');
        $this->db->join('material', 'material_inventory.material_id = material.id');
        // $this->db->join('material', 'material_inventory.material_id = material.material_code');
        $this->db->join('store', 'material_inventory.store_id = store.id');
        // // // $this->db->where('material_inventory.is_deleted', 0);
        $query = $this->db->get();
        return $query->result();
        // return $_SESSION;
        // return $this->db->get_where($this->table, array('is_deleted' => 0))->result();
    }


    public function insert($data)
    {
        // $this->db->get_where
        // $this->db->select('count(id) AS total');
        // $this->db->from($this->table);
        // $query = $this->db->get();
        // if ($query->num_rows() == 1) {
        //     return $query->row();
        // }
        // return FALSE;
        // return var_dump($data['store_id']);
        $store_id = $data['store_id'];
        $material_id = $data['material_id'];

        $cek_data = $this->db->get_where($this->table, array('material_id' => $material_id, 'store_id' => $store_id))->result();

        if ($cek_data) {
            // var_dump($data);
            // var_dump($cek_data[0]->id);
            $id = $cek_data[0]->id;
            $quantity_form = $data['quantity'];
            $quantitiy_table = $cek_data[0]->quantity;
            $quantity_final = $quantity_form + $quantitiy_table;
            $slq = $this->db->query("UPDATE $this->table SET quantity = $quantity_final WHERE id=$id");
            return $slq;

            // $sql = 
        } else {
            // var_dump($data);
            return $this->db->insert($this->table, $data);
        }
    }
}
