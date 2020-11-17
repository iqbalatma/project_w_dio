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

    public function getAll()
    {
        return $this->db->get_where($this->table, array('is_deleted' => 0))->result();
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
}
