<?php

/**
 * 
 * @dioilham
 * 
 */
class Product_mutation_model extends CI_Model
{

  var $table          = 'product_mutation';
  var $tb_product     = 'product';
  var $tb_store       = 'store';
  // var $tb_employee  = 'employee';


  //  ===============================================GETTER===============================================
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
  public function get_all($select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pm", "pm.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pm.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pm.is_deleted", 0);
    $this->db->order_by("pm.id", 'ASC');
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
    $this->db->join("{$this->table} AS pm", "pm.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pm.store_id");
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
  public function get_by_store_id($id)
  {
    $this->db->select("*");
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pm", "pm.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pm.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pm.store_id", $id);
    $this->db->order_by("pm.id", 'ASC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function product_paling_laku()
  {
    $query = $this->db->query("SELECT *, count(product_mutation.product_id) as jumlah FROM product_mutation INNER JOIN product ON product_mutation.product_id = product.id WHERE product_mutation.mutation_type = 'keluar' GROUP BY product_mutation.product_id ORDER BY jumlah DESC LIMIT 5");

    $row = $query->result_array();


    return $row;
  }
}
