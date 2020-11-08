<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Role_model extends CI_Model
{
    protected $table      = 'role';
    public function __construct()
    {
        parent::__construct();
    }


    public function getAll()
    {
        return $this->db->get($this->table)->result();
    }
}
