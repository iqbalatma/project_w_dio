<?php

/**
 *
 */
class Employee_model extends CI_Model
{

  var $table        = 'employee';
  var $tb_employee  = 'employee';
  var $tb_role      = 'role';
  var $tb_store     = 'store';

//  ===============================================SETTER===============================================
  // insert employee baru
  /**
   * setter untuk menambahkan employee baru
   * @param array $data [berisi 11 data]
   */
  public function set_new_employee($data){
    $createdAt = unix_to_human(now(), true, 'europe');
    $data = array(
		  "username"      => $data['add-username'],
		  "email"         => $data['add-email'],
      "password"      => $this->bcrypt->hash_password($data['add-password']),
		  "first_name"    => $data['add-firstname'],
		  "last_name"     => $data['add-lastname'],
		  "phone"         => $data['add-phone'],
		  "address"       => $data['add-address'],
      "avatar"        => 'avatar-'.mt_rand(0,7).'.png',
		  "role_id"       => $data['add-role'],
		  "store_id"      => $data['add-store'],
		  "created_at"    => $createdAt,
    );
		return $this->db->insert($this->table, $data);
  }

  // update employee by id
  public function set_update_by_id($id, $data){
    $data = array(
		  "first_name"    => $data['edit-firstname'],
		  "last_name"     => $data['edit-lastname'],
		  "phone"         => $data['edit-phone'],
		  "address"       => $data['edit-address'],
		  "role_id"       => $data['edit-role'],
		  "store_id"      => $data['edit-store'],
    );
    $this->db->where('id', $id);
		return $this->db->update($this->table, $data);
  }

  // update is_deleted employee by id
  public function set_delete_by_id($id){
    // echo '<pre>'; print_r($id); die;
    $data = array(
		  "is_deleted"   => 1,
    );
    $this->db->where('id', $id);
		return $this->db->update($this->table, $data);
  }



//  ===============================================GETTER===============================================
  // get total employee
  public function get_total(){
    // get from $table
    $this->db->select('count(id) AS total');
    $this->db->from($this->table);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  // get all employee
  // parameter pertama untuk tabel yg akan diquery
  public function get_all($select = '*'){
    // get from table
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->where('is_deleted', 0);
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  // get 1 employee berdasarkan id
  // parameter pertama untuk id sebagai acuan
  // parameter kedua untuk tabel yg akan diquery
  public function get_by_id($id, $select = '*'){
    // get from table
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $this->db->where('is_deleted', 0);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }
    
  // get 1 role berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  public function get_role_by_id($id, $select = '*'){
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->tb_employee);
    $this->db->join($this->tb_role, "{$this->tb_role}.id={$this->tb_employee}.role_id");
    $this->db->where("{$this->tb_employee}.id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }
    
  // get 1 store berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  public function get_store_by_id($id, $select = '*'){
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->tb_employee);
    $this->db->join($this->tb_store, "{$this->tb_store}.id={$this->tb_employee}.store_id");
    $this->db->where("{$this->tb_employee}.id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }



}

?>
