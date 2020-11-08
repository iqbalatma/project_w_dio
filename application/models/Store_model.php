<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Store_model extends CI_Model
{
    protected $table      = 'store';
    public function __construct()
    {
        parent::__construct();
    }


    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }
}
