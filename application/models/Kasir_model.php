<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Kasir_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // protected $table      = '';
    // protected $table2      = 'test';
    // protected $primaryKey = 'material_code';
    protected $returnType     = 'array';


    public function insert_invoice($data)
    {
        return $this->db->insert('invoice', $data);
    }
}
