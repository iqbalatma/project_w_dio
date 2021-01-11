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
        $query = $this->db->query("SELECT  material_inventory.critical_point, material_inventory.id,material_inventory.created_at,material_inventory.created_by, material.material_code,material_inventory.material_id, material_inventory.updated_at, material.full_name,  material_inventory.quantity, material_inventory.updated_by FROM material_inventory INNER JOIN material ON material_inventory.material_id = material.id INNER JOIN store ON material_inventory.store_id = store.id WHERE material_inventory.is_deleted=0 ORDER BY updated_at DESC");

        $row = $query->result();
        return $row;
    }
    public function get_inventory_by_store_id($store_id)
    {
        $query = $this->db->query("SELECT  material_inventory.critical_point, material_inventory.id,material_inventory.created_at,material_inventory.created_by, material.material_code,material_inventory.material_id, material_inventory.updated_at, material.full_name,  material_inventory.quantity, material_inventory.updated_by FROM material_inventory INNER JOIN material ON material_inventory.material_id = material.id INNER JOIN store ON material_inventory.store_id = store.id WHERE material_inventory.is_deleted=0 AND material_inventory.store_id = '$store_id' ORDER BY updated_at DESC");

        $row = $query->result();
        return $row;
    }
    public function getKritis()
    {
        // $this->db->select('material_inventory.id,material_inventory.created_at,material_inventory.created_by, material.material_code,material_inventory.material_id, material.full_name, store.store_name, material_inventory.quantity, material_inventory.updated_by');
        // $this->db->from('material_inventory');
        // $this->db->join('material', 'material_inventory.material_id = material.id');
        // // $this->db->join('material', 'material_inventory.material_id = material.material_code');
        // $this->db->join('store', 'material_inventory.store_id = store.id');
        // $this->db->where('material_inventory.is_deleted', 0);
        // $this->db->where('material_inventory.id', 1);
        // $query = $this->db->get();
        // return $query->result();


        // $tanggal = $data;

        $query = $this->db->query("SELECT material_inventory.id,material_inventory.created_at,material_inventory.created_by, material.material_code,material_inventory.material_id, material.full_name, store.store_name, material_inventory.quantity, material_inventory.updated_by FROM material_inventory INNER JOIN material ON material_inventory.material_id = material.id INNER JOIN store ON material_inventory.store_id = store.id WHERE material_inventory.is_deleted=0 AND material_inventory.quantity < 10");

        $row = $query->result();
        return $row;
        // return $_SESSION;
        // return $this->db->get_where($this->table, array('is_deleted' => 0))->result();
    }

    public function getMaterialInventoryById($id)
    {
        $query = $this->db->query("SELECT material_inventory.critical_point,material_inventory.material_id, material.material_code, material.full_name, material_inventory.quantity FROM material_inventory INNER JOIN material ON material_inventory.material_id = material.id WHERE material_inventory.id = '$id'");

        $row = $query->result();
        return $row;
    }


    public function insert($data, $status)
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

        $cek_data = $this->db->get_where($this->table, array('material_id' => $material_id))->result();

        if ($cek_data) {
            // var_dump($data);
            // var_dump($cek_data[0]->id);
            $id = $cek_data[0]->id;
            $quantity_form = $data['quantity'];
            $quantitiy_table = $cek_data[0]->quantity;
            $quantity_final = $quantity_form + $quantitiy_table;
            if ($status === "kurang") {
                $quantity_final = $quantitiy_table - $quantity_form;
            }

            $updated_at = $data['updated_at'];

            $slq = $this->db->query("UPDATE $this->table SET quantity = $quantity_final, updated_at = '$updated_at' WHERE id=$id");
            return $slq;

            // $sql = 
        } else {
            // var_dump($data);
            return $this->db->insert($this->table, $data);
        }
    }

    public function update($data)
    {
        $this->db->where('material_id', $data['material_id']);
        return $this->db->update("material_inventory", $data);
    }

    public function ubah_quantity($data)
    {
        $id = $data['id'];
        $quantity = $data['quantity'];
        $query = $this->db->query("UPDATE  material_inventory SET quantity = $quantity WHERE material_id = $id");
        return $query;
    }
    public function ubah_critical_point($data)
    {
        $id = $data['id'];
        $critical_point = $data['critical_point'];
        $query = $this->db->query("UPDATE  material_inventory SET critical_point = $critical_point WHERE material_id = $id");
        return $query;
    }



    public function get_critical_material($n = 5)
    {
        $query = $this->db->query("
            SELECT mi.id, m.material_code, m.full_name, m.image, mi.quantity, s.store_name
            FROM material AS m
            JOIN material_inventory AS mi
            ON mi.material_id = m.id
            JOIN store AS s
            ON s.id = mi.store_id
            WHERE mi.quantity <= mi.critical_point
            AND m.is_deleted = 0
            AND mi.is_deleted = 0
            AND s.is_deleted = 0
            ORDER BY mi.quantity ASC
            LIMIT {$n}
        ");

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    /**
     * Get all rows from certain table
     * 
     * @param string $select 
     * Default value is '*', but you can input some string
     * to select some table(s) name of your choice.
     * 
     */
    public function get_all($select = '*', $orderBy = 'id', $ascDesc = 'DESC')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->order_by($orderBy, $ascDesc);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    /**
     * Get all rows from certain table
     * 
     * @param string $select 
     * Default value is '*', but you can input some string
     * to select some table(s) name of your choice.
     * 
     */
    public function get_all_by_id($id, $select = '*', $orderBy = 'id', $ascDesc = 'DESC')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where('material_id', $id);
        $this->db->where('is_deleted', 0);
        $this->db->order_by($orderBy, $ascDesc);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    /**
     * Get product by custom where clause
     * 
     * @param string $where
     * Query string for where clause (ex. id=5 OR id=6 OR id=10)
     * @param string $select 
     * Default value is '*', but you can input some string
     * to select some table(s) name of your choice.
     * 
     */
    public function get_by_where($where = NULL, $select = '*')
    {
      // get from table
      $this->db->select($select);
      $this->db->from($this->table);
      $this->db->where($where);
      $this->db->where('is_deleted', 0);
      $query = $this->db->get();
      // pprintd($where);
      if ($query->num_rows() > 0) {
        return $query->result_array();
      }
      return FALSE;
    }









}
