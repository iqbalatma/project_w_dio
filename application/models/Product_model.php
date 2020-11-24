<?php

/**
 * 
 * @dioilham
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
  /**
   * Insert new product to the database.
   * 
   * @param array $data [5 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_new_product($data)
  {
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

  /**
   * Update product that already registered and still active (not deleted).
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param array $data [8 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_update_by_id($id, $data)
  {
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

  /**
   * Delete employee that already registered, but not the actual row data deletion,
   * this is just updating "is_deleted" fields in the table from 0 to 1.
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_by_id($id)
  {
    // echo '<pre>'; print_r($id); die;
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

    if ($keyName !== NULL) {
      if ($keyName === '') $keyName = 'key';
      $total = [$keyName => $total];
    }
    return $total;
  }

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
    $this->db->order_by('id', 'ASC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  /**
   * Get one product by the product unique id
   * 
   * @param string $id 
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_by_id($id, $select = '*')
  {
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $this->db->where('is_deleted', 0);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  /**
   * Get one role by the role unique id
   * 
   * @param string $id 
   * Set the $id from the role id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_role_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_role, "{$this->tb_role}.id={$this->table}.role_id");
    $this->db->where("{$this->table}.id", $id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  /**
   * Get one store by the store unique id
   * 
   * @param string $id 
   * Set the $id from the store id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_store_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_store, "{$this->tb_store}.id={$this->table}.store_id");
    $this->db->where("{$this->table}.id", $id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  // get 1 product_composition berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  /**
   * Get all Product Composition that is belong to
   * the corresponding Product by joining some tables on its id.
   * 
   * @param string $id 
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_composition_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_product_composition, "{$this->table}.id={$this->tb_product_composition}.product_id");
    $this->db->join($this->tb_material, "{$this->tb_product_composition}.material_id={$this->tb_material}.id");
    $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }
  public function get_by_store_id($id)
  {
    $this->db->select('product.id, product.product_code, product.full_name, product_inventory.quantity, product.price_retail');
    $this->db->from($this->table);
    $this->db->join('product_inventory', 'product_inventory.product_id = product.id');
    $this->db->where("store_id", $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return false;
    // return $query->result();
  }
}
