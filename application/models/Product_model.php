<?php

/**
 *
 */
class Product_model extends CI_Model
{

  var $table                    = 'product';
  var $tb_product_composition   = 'product_composition';
  var $tb_material              = 'material';
  // var $tb_employee  = 'employee';
  // var $tb_role      = 'role';
  // var $tb_store     = 'store';

//  ===============================================SETTER===============================================
  // insert employee baru
  /**
   * setter untuk menambahkan employee baru
   * @param array $data [berisi 11 data]
   */
  public function set_new_product($data){
    $createdAt = unix_to_human(now(), true, 'europe');
    $data = array(
		  "product_code"  => $data['add-kodeproduk'],
		  "full_name"     => $data['add-fullname'],
		  "unit"          => $data['add-unit'],
		  "volume"        => $data['add-volume'],
		  "created_at"    => $createdAt,
    );
		return $this->db->insert($this->table, $data);
  }

  // update employee by id
  public function set_update_by_id($id, $data){
    $data = array(
		  "product_code"        => $data['edit-kodeproduk'],
		  "full_name"           => $data['edit-fullname'],
		  "unit"                => $data['edit-unit'],
		  "volume"              => $data['edit-volume'],
		  "price_base"          => $data['edit-hpp'],
		  "price_retail"        => $data['edit-priceretail'],
		  "price_reseller"      => $data['edit-pricereseller'],
		  "price_wholesale"     => $data['edit-pricewholesale'],
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
    $this->db->from($this->table);
    $this->db->join($this->tb_role, "{$this->tb_role}.id={$this->table}.role_id");
    $this->db->where("{$this->table}.id", $id);
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
    $this->db->from($this->table);
    $this->db->join($this->tb_store, "{$this->tb_store}.id={$this->table}.store_id");
    $this->db->where("{$this->table}.id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }
    
  // get 1 product_composition berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  public function get_all_composition_by_id($id, $select = '*'){
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_product_composition, "{$this->table}.id={$this->tb_product_composition}.product_id");
    $this->db->join($this->tb_material, "{$this->tb_product_composition}.material_id={$this->tb_material}.id");
    $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }



}

?>
