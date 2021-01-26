<?php

/**
 * 
 * @dioilham
 * 
 */
class Material_mutation_model extends CI_Model
{

  var $table          = 'material_mutation';
  var $tb_material    = 'material';
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
  public function get_all($select = '*', $asc_desc = 'DESC', $order_by = 'pm.id', $limit = 20000)
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pm", "pm.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pm.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pm.is_deleted", 0);
    $this->db->order_by($order_by, $asc_desc);
    $this->db->limit($limit);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }



  public function get_transaksi_barang()
  {
    $this->db->select("material.material_code, material.full_name, store.store_name, product_mutation.mutation_code, product_mutation.quantity, product_mutation.mutation_type, product_mutation.created_at, product_mutation.created_by");
    $this->db->from("product_mutation");
    $this->db->join("product", "product_mutation.product_id = material.id");
    $this->db->join("store", "product_mutation.store_id = store.id");
    $this->db->where("product_mutation.is_deleted", 0);
    $this->db->order_by("product_mutation.created_at", "DESC");
    $query = $this->db->get();

    return $query->result();
  }


  public function get_transaksi_barang_by_store_id($store_id)
  {
    $this->db->select("material.material_code, material.full_name, store.store_name, material_mutation.mutation_code, material_mutation.quantity, material_mutation.mutation_type, material_mutation.created_at, material_mutation.created_by");
    $this->db->from("material_mutation");
    $this->db->join("material", "material_mutation.material_id = material.id");
    $this->db->join("store", "material_mutation.store_id = store.id");
    $this->db->where("material_mutation.is_deleted", 0);
    $this->db->where("material_mutation.store_id", $store_id);
    $this->db->order_by("material_mutation.created_at", "DESC");
    $query = $this->db->get();

    return $query->result();
  }
}
