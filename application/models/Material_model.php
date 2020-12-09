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
    public function insert($data)
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

        return $this->db->insert($this->table, $data);
    }

    public function update($data)
    {
        return $this->db->update($this->table, $data, array('id' => $data['id']));
    }

    public function delete($id)
    {

        $this->is_deleted = 1;
        return $this->db->update($this->table, $this, array('id' => $id));
    }

    public function get_transaksi_barang()
    {
        // get from tb_department
        $this->db->select("material.material_code, material.full_name, store.store_name, material_mutation.mutation_code, material_mutation.quantity, material_mutation.mutation_type, material_mutation.created_at, material_mutation.created_by");
        $this->db->from("material_mutation");
        $this->db->join("material", "material_mutation.material_id = material.id");
        $this->db->join("store", "material_mutation.store_id = store.id");
        $this->db->where("material_mutation.is_deleted", 0);
        $this->db->order_by("material_mutation.created_at", "DESC");
        $query = $this->db->get();

        return $query->result();
        // if ($query->num_rows() == 1) {
        //     return $query->row();
        // }
        // return FALSE;
    }
}
