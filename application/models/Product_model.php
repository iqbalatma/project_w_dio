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
    $data2 = array(
      "product_code"        => $data['edit-kodeproduk'],
      "full_name"           => $data['edit-fullname'],
      "unit"                => $data['edit-unit'],
      "volume"              => $data['edit-volume'],
      "selling_price"       => $data['edit-sellingprice'],
    );
    // 0 = error
    if ($data['edit-foto'] !== 0) $data2['image'] = $data['edit-foto'];

    $this->db->where('id', $id);
    return $this->db->update($this->table, $data2);
  }

  /**
   * Delete product that already registered, but not the actual row data deletion,
   * this is just updating "is_deleted" fields in the table from 0 to 1.
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
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






  /**
   * 
   * Check whether if cust have composition for specific product or not
   * if they have composition, then update the existing one
   * if not, then create a new one
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function __get_by_product_id_and_material_code($product_id, $material_code, $select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product_composition} AS pc");
    $this->db->join("{$this->tb_material} AS m", "m.id = pc.material_id");
    $this->db->where('pc.product_id', $product_id);
    $this->db->where('m.material_code', $material_code);
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->row();
    }
    return FALSE;
  }

  /**
   * Get one material by the material unique id
   * 
   * @param string $id 
   * Set the $id from the material id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function __get_material_by_code($code, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->tb_material);
    $this->db->where("{$this->tb_material}.material_code", $code);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  public function __set_update_hpp_by_product_id($product_id)
  {
    $this->db->select('SUM(m.price_base * pc.volume) AS price_base');
    $this->db->from("{$this->table} AS p");
    $this->db->join("{$this->tb_product_composition} AS pc", "pc.product_id = p.id");
    $this->db->join("{$this->tb_material} AS m", "m.id = pc.material_id");
    $this->db->where('pc.product_id', $product_id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      $data = $query->row();

      $this->db->where('id', $product_id);
      return $this->db->update($this->table, $data);
    }
    return FALSE;

  }
  
  /**
   * setter untuk menambahkan harga kustom pada pelanggan
   * 
   * @param array $data [berisi 4 data]
   */
  public function set_new_composition_by_id($id, $data)
  {
    // $newHpp = 0;
    $updatedAt = unix_to_human(now(), true, 'europe');
    
    $this->db->trans_start();
    foreach ($data['custom'] as $c)
    {
      // inputnya material code, tapi yg dibutuhin material id buat ke tabel pc
      // jadi return material id dari proses join 2 tabel dengan method di bawah ini.
      $cek          = $this->__get_by_product_id_and_material_code($id, $c['material_code'], 'pc.material_id, m.price_base');
      $material     = $this->__get_material_by_code($c['material_code'], 'id, price_base');
      // $newHpp[]     = $material->price_base;

      $data = array(
        "volume"        => $c['volume'],
        "product_id"    => $id,
        "material_id"   => $material->id,
        "updated_at"    => $updatedAt,
      );
      
      // cek apakah data sudah ada atau belum
      // kalo udah ada berarti update, kalo belum berarti insert baru
      if ($cek)
      {
        $this->db->where('product_id', $id);
        $this->db->where('material_id', $material->id);
        $this->db->update($this->tb_product_composition, $data);
      }
      else
      {
        $this->db->insert($this->tb_product_composition, $data);
      }
    }
    $this->__set_update_hpp_by_product_id($id);
    $this->db->trans_complete();
    
    if ($this->db->trans_status() === FALSE)
    {
      return FALSE;
    }
    else
    {
      return 1;
    }
  }

  /**
   * Delete composition data row (real delete). Second params is optional,
   * if omitted it will only delete composition, if not it will update the hpp too.
   * 
   * @param int,string $id
   * Set the $id from the kas id to fetch the data relatives to the id.
   * 
   * @param int,string $productId
   * Refer for updating HPP in product table with product id provided.
   * 
   */
  public function set_delete_composition_by_id($id, $productId=NULL)
  {
    $this->db->trans_start();
    $this->db->where('id', $id);
    $this->db->delete($this->tb_product_composition);
    if ($productId !== NULL) $this->__set_update_hpp_by_product_id($productId);
    $this->db->trans_complete();
    return 1;
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
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  // 
  // 
  public function get_all2($select = '*')
  {
    $query = $this->db->query("SELECT DISTINCTROW product.id, product.full_name, product.selling_price FROM product INNER JOIN product_composition ON product.id = product_composition.product_id WHERE product.is_deleted = 0");

    $row = $query->result_array();
    return $row;
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

  /**
   * Get all Product Composition that is belong to
   * the corresponding Product by joining some tables on its id.
   * 
   * @param string $id 
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some field(s) name of your choice.
   * 
   */
  public function get_all_composition_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from("{$this->table} AS p");
    $this->db->join("{$this->tb_product_composition} AS pc", "p.id=pc.product_id");
    $this->db->join("{$this->tb_material} AS m", "pc.material_id=m.id");
    $this->db->where("pc.product_id", $id);
    $this->db->where('pc.is_deleted', 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_by_store_id($id)
  {
    $this->db->select('product.id, product.product_code, product.full_name, product.selling_price');
    $this->db->from($this->table);
    // $this->db->where("store_id", $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return false;
    // return $query->result();
  }

  /**
   * Get product by custom where clause
   * 
   * @param string $where
   * Query string for where clause (ex. id=5 OR id=6 OR id=10)
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_by_where($where = NULL, $select = '*')
  {
    // get from table
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->where($where);
    $query = $this->db->get();
    // pprintd($where);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }
}
