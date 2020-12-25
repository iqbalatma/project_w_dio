<?php

/**
 * 
 * @dioilham
 * 
 */
class Inventory_product_model extends CI_Model
{

  var $table          = 'product_inventory';
  var $tb_product     = 'product';
  var $tb_store       = 'store';
  // var $tb_employee  = 'employee';

  //  =============================================== SETTER ===============================================
  /**
   * 
   * Insert new product to the database.
   * 
   * @param array $data [5 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */

  // public function get_where($data)
  // {
  // }
  public function set_new_inventory($data)
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
   * 
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
    if (($data['edit-tipeupdate'] !== '+') && ($data['edit-tipeupdate'] !== '-')) {
      return FALSE;
    }
    $createdAt = unix_to_human(now(), true, 'europe');
    // ('+' or '-') and (total stok to be inputted)
    $operand  = $data['edit-tipeupdate'];
    $total    = $data['edit-updatestok'];
    $data = [
      "updated_at"    => $createdAt,
      "updated_by"    => $data['edit-username'],
    ];
    // pprint($total);
    // pprintd($operand);
    // set data to table `quantity`
    $this->db->set("quantity", "quantity {$operand} {$total}", FALSE);
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);



    // $this->db->trans_start();
    // $this->db->trans_complete();

    // if ($this->db->trans_status() === FALSE)
    // {
    //   // flashdata untuk sweetalert
    //   $this->session->set_flashdata('failed_message', 1);
    //   $this->session->set_flashdata('title', "Input gagal!");
    //   $this->session->set_flashdata('text', 'Data gagal diproses! Hubungi administrator segera.');
    //   redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
    // }
    // else
    // {
    //   return 1;
    // }

  }

  /**
   * 
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



  //  =============================================== GETTER ===============================================
  /**
   * 
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
   * 
   * Get all rows from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all($select = '*', $orderBy = 'pi.id', $ascDesc = 'ASC')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by($orderBy, $ascDesc);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  /**
   * 
   * Get all rows from certain table by certain id
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_by_store_id($storeId, $select = '*', $orderBy = 'pi.id', $ascDesc = 'ASC')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pi.store_id", $storeId);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by($orderBy, $ascDesc);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
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
   * to select some table(s) name of your choice.
   * 
   */
  public function get_by_id($id, $select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where('pi.id', $id);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by("pi.id", 'ASC');
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
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
   * 
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
   * 
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
}
