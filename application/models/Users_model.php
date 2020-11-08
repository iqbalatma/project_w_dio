<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    protected $table      = 'user';
    protected $table2      = 'test';
    protected $primaryKey = 'id';
    protected $returnType     = 'array';


    // public function getAll()
    // {
    //     return $this->db->get($this->table)->result();
    // }

    public function getByUsername($id)
    {
        return $this->db->get_where($this->table, ["username" => $id])->row();
    }

    public function save($data)
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

        $this->db->insert($this->table, $data);
    }

    public function update()
    {
        // $post = $this->input->post();
        // $this->product_id = $post["id"];
        // $this->name = $post["name"];
        // $this->price = $post["price"];
        // $this->description = $post["description"];
        // return $this->db->update($this->_table, $this, array('product_id' => $post['id']));
    }

    public function delete($id)
    {
        // return $this->db->delete($this->_table, array("product_id" => $id));
    }
}
