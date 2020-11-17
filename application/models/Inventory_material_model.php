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
        $this->db->select('material_inventory.created_at, material_inventory.material_code, material.full_name, store.store_name, material_inventory.quantity, material_inventory.updated_by');
        $this->db->from('material_inventory');
        $this->db->join('material', 'material_inventory.material_code = material.material_code');
        // $this->db->join('material', 'material_inventory.material_id = material.material_code');
        $this->db->join('store', 'material_inventory.store_id = store.id');
        // // // $this->db->where('material_inventory.is_deleted', 0);

        // $sql = "SELECT material_inventory. FROM `material_inventory` LEFT OUTER JOIN `material` ON material_inventory.material_code = material.material_code LEFT OUTER JOIN `store` ON material_inventory.store_id = store.id";
        // $sql = "SELECT * FROM `material_inventory` INNER JOIN `material` ON `material_inventory.material_code` = `material.material_code` INNER JOIN `store` ON `material_inventory.store_id` = `store.id`";
        // $sql = "SELECT * FROM material_inventory";
        $query = $this->db->get();
        return $query->result();
        // return $_SESSION;
        // return $this->db->get_where($this->table, array('is_deleted' => 0))->result();
    }


    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
