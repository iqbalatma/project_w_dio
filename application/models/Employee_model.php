<?php

/**
 * 
 * @dioilham
 * 
 */
class Employee_model extends CI_Model
{

  var $table        = 'employee';
  var $tb_employee  = 'employee';
  var $tb_role      = 'role';
  var $tb_store     = 'store';

//  ===============================================SETTER===============================================
  /**
   * Insert new employee to the database.
   * 
   * @param array $data [11 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_new_employee($data)
  {
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

  /**
   * Update employee that already registered and still active (not deleted).
   * 
   * @param array $id
   * Set the $id from the employee id to fetch the data relatives to the id.
   * @param array $data [6 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_update_by_id($id, $data)
  {
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

  /**
   * Delete employee that already registered, but not the actual row data deletion,
   * this is just updating "is_deleted" fields in the table from 0 to 1.
   * 
   * @param array $id
   * Set the $id from the employee id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_by_id($id)
  {
    $data = array(
		  "is_deleted"   => 1,
    );
    $this->db->where('id', $id);
		return $this->db->update($this->table, $data);
  }



//  ===============================================GETTER===============================================
  /**
   * Get total rows from certain table
   * 
   * @param string $keyName 
   * Default value is NULL, but you can input some string to get array
   * with $keyName as a key and the total row as a value.
   * 
   */
  public function get_total($keyName = NULL)
  {
    $total = $this->db->count_all_results($this->table);

    if ($keyName !== NULL)
    {
      if ($keyName === '') $keyName = 'key';
      $total = [$keyName => $total];
    }
    return $total;
  }

  /**
   * 
   * Get all rows from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some field(s) name of your choice.
   * 
   */
  public function get_all($select = '*')
  {
    // get from table
    $this->db->select($select);
    $this->db->from("{$this->tb_employee} AS e");
    $this->db->join("{$this->tb_role} AS r", "r.id=e.role_id");
    $this->db->join("{$this->tb_store} AS s", "s.id=e.store_id");
    $this->db->where('e.is_deleted', 0);
    $this->db->order_by('e.id', 'DESC');
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  /**
   * 
   * Get one row from certain table 
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some field(s) name of your choice.
   * 
   */
  public function get_by_id($id, $select = '*')
  {
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
  
  /**
   * 
   * Get one role by the role unique id
   * 
   * @param string $id 
   * Set the $id from the role id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some field(s) name of your choice.
   * 
   */
  public function get_role_by_id($id, $select = '*')
  {
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
  
  /**
   * 
   * Get one store by the store unique id
   * 
   * @param string $id 
   * Set the $id from the store id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some field(s) name of your choice.
   * 
   */
  public function get_store_by_id($id, $select = '*')
  {
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
