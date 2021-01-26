<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Material_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    protected $table      = 'material';
    // protected $table2      = 'test';
    protected $primaryKey = 'material_code';
    protected $returnType     = 'array';

    // buat yg returnnya array -dio
    /**
     * Get all rows from certain table
     * 
     * @param string $select 
     * Default value is '*', but you can input some string
     * to select some table(s) name of your choice.
     * 
     */
    public function get_all($select = '*')
    {
        $this->db->select($select);
        $this->db->from($this->table);
        $this->db->where('is_deleted', 0);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function getAll()
    {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get_where($this->table, array('is_deleted' => 0));

        return $query->result();
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->result();
    }
    public function insert($data, $insertInven = FALSE, $dataInven = NULL)
    {
        // $post = $this->input->post();
        // $this->product_id = uniqid();
        // $this->name = $post["name"];
        // $this->price = $post["price"];
        // $this->description = $post["description"];

        // $this->db->insert('entries', $this);

        // $this->username = $data['username'];
        // $this->password = $data['password'];
        // $this->email = $data['email'];

        // set waktu awal untuk method ini
        $now          = now();
        $createdAt    = unix_to_human($now, true, 'europe');

        // ini yg awalnya
        if (($insertInven == FALSE) && ($dataInven == NULL)) {
            return $this->db->insert($this->table, $data);
        }
        // ini tambahannya
        elseif (($insertInven == TRUE) && ($dataInven != NULL)) {
            $this->db->trans_start();

            $this->db->insert($this->table, $data);
            $lastMatId = $this->db->insert_id();

            $dataInven = [
                'material_id'       => $lastMatId,
                'store_id'          => $dataInven['store_id'],
                'quantity'          => $dataInven['quantity'],
                'critical_point'    => 10,
                'created_at'        => $createdAt,
                'created_by'        => $dataInven['created_by'],
            ];

            $this->db->insert('material_inventory', $dataInven);

            $this->db->trans_complete();

            return ($this->db->trans_status() === FALSE) ? FALSE : TRUE;
        }
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data, array('id' => $data['id']));
    }

    public function delete($id)
    {
        $this->db->trans_start();

        $this->is_deleted = 1;
        $this->db->update($this->table, $this, array('id' => $id));
        $this->db->update('material_inventory', $this, array('material_id' => $id));

        $this->db->trans_complete();

        return ($this->db->trans_status() === FALSE) ? FALSE : TRUE;
    }

    public function get_transaksi_barang($where = '')
    {
        // get from tb_department
        $this->db->select("material.material_code, material.full_name, store.store_name, material_mutation.mutation_code, material_mutation.quantity, material_mutation.mutation_type, material_mutation.created_at, material_mutation.created_by");
        $this->db->from("material_mutation");
        $this->db->join("material", "material_mutation.material_id = material.id");
        $this->db->join("store", "material_mutation.store_id = store.id");

        if ($where == '') {
            $this->db->where("material_mutation.is_deleted = 0");
        } else {
            $this->db->where("material_mutation.is_deleted = 0 AND {$where}");
        }
        
        $this->db->order_by("material_mutation.created_at", "DESC");
        $query = $this->db->get();

        return $query->result();
        // if ($query->num_rows() == 1) {
        //     return $query->row();
        // }
        // return FALSE;
    }
    public function get_transaksi_barang_by_store_id($store_id)
    {
        // get from tb_department
        $this->db->select("material.material_code, material.full_name, store.store_name, material_mutation.mutation_code, material_mutation.quantity, material_mutation.mutation_type, material_mutation.created_at, material_mutation.created_by");
        $this->db->from("material_mutation");
        $this->db->join("material", "material_mutation.material_id = material.id");
        $this->db->join("store", "material_mutation.store_id = store.id");
        $this->db->where("material_mutation.is_deleted", 0);
        $this->db->where("material_mutation.store_id", $store_id);
        $this->db->order_by("material_mutation.created_at", "DESC");
        $query = $this->db->get();

        return $query->result();
        // if ($query->num_rows() == 1) {
        //     return $query->row();
        // }
        // return FALSE;
    }
}
