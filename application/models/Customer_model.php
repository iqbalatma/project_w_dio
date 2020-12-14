<?php

/**
 *
 */
class Customer_model extends CI_Model
{

  var $table            = 'customer';
  var $tb_custom_price  = 'custom_price';
  var $tb_product       = 'product';

  //  ===============================================SETTER===============================================
  /**
   * setter untuk menambahkan customer baru
   * 
   * @param array $data [berisi 5 data]
   */
  public function set_new_customer($data)
  {
    $createdAt = unix_to_human(now(), true, 'europe');
    $data = array(
      "full_name"   => $data['add-fullname'],
      "address"     => $data['add-address'],
      "phone"       => $data['add-phone'],
      "cust_type"   => $data['add-tipe'],
      "created_at"  => $createdAt,
    );
    $this->db->insert($this->table, $data);

    $lastId = $this->db->insert_id();
    $this->session->set_flashdata('last_id', $lastId);

    return $lastId;
  }
  


  /**
   * 
   * Check whether if cust have custom price for specific product or not
   * if they have custom price, then update the existing one
   * if not, then create a new one
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function __get_by_id_and_product_code($id, $code, $select = '*')
  {
    $this->db->select($select);
    $this->db->from($this->tb_custom_price);
    $this->db->where('customer_id', $id);
    $this->db->where('product_code', $code);
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return TRUE;
    }
    return FALSE;
  }
  
  /**
   * setter untuk menambahkan harga kustom pada pelanggan
   * 
   * @param array $data [berisi 4 data]
   */
  public function set_new_customer_price_by_id($id, $data)
  {
    $createdAt = unix_to_human(now(), true, 'europe');
    
    $this->db->trans_start();
    foreach ($data['custom'] as $c)
    {
      $cek = $this->__get_by_id_and_product_code($id, $c['product_code']);
      $data = array(
        "price"         => $c['price'],
        "customer_id"   => $id,
        "product_code"  => $c['product_code'],
        "created_at"    => $createdAt,
      );
      // cek apakah data sudah ada atau belum
      // kalo udah ada berarti update, kalo belum berarti insert baru
      if ($cek)
      {
        $this->db->where('customer_id', $id);
        $this->db->where('product_code', $c['product_code']);
        $this->db->update($this->tb_custom_price, $data);
      }
      else
      {
        $this->db->insert($this->tb_custom_price, $data);
      }
    }
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



  // update customer by id
  public function set_update_by_id($id, $data)
  {
    $data = array(
      "full_name"   => $data['edit-fullname'],
      "address"     => $data['edit-address'],
      "phone"       => $data['edit-phone'],
      "cust_type"   => $data['edit-tipe'],
    );
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  // update is_deleted customer by id
  public function set_delete_by_id($id)
  {
    // echo '<pre>'; print_r($id); die;
    $data = array(
      "is_deleted"   => 1,
    );
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }

  /**
   * 
   * Delete composition dara row, entirely
   * 
   * @param array $id
   * Set the $id from the kas id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_custom_price_by_id($id)
  {
    $this->db->where('id', $id);
    return $this->db->delete($this->tb_custom_price);
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

  // get all customer
  // parameter pertama untuk tabel yg akan diquery
  public function get_all($select = '*')
  {
    // get from table
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

  // get 1 customer berdasarkan id
  // parameter pertama untuk id sebagai acuan
  // parameter kedua untuk tabel yg akan diquery
  public function get_by_id($id, $select = '*')
  {
    // get from table
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

  public function get_customer_price_by_id($id, $select = '*')
  {
    // get from table
    $this->db->select($select);
    $this->db->from("{$this->table} AS c");
    $this->db->join("{$this->tb_custom_price} AS cp", 'cp.customer_id = c.id');
    $this->db->join("{$this->tb_product} AS p", 'p.product_code = cp.product_code');
    $this->db->where('cp.customer_id', $id);
    $this->db->where('cp.is_deleted', 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_customer_price_by_cust_and_product_id($custId = NULL, $productCode = NULL, $select = '*')
  {
    if ( ($custId === NULL) OR ($productCode === NULL) ) return FALSE;

    // get from table
    $this->db->select($select);
    $this->db->from("{$this->table} AS c");
    $this->db->join("{$this->tb_custom_price} AS cp", 'cp.customer_id = c.id');
    $this->db->join("{$this->tb_product} AS p", 'p.product_code = cp.product_code');

    $isArrayCustId = is_array($custId);
    // cek apakah code product array atau bukan, jika array maka looping untuk where, jika bukan maka hanya sekali
    if ($isArrayCustId == 1) {
      $where = '(';
      foreach ($custId as $row) {
        if ($where != '(') $where .= " OR ";
        $where .= "cp.customer_id='{$row}'";
      }
      $where .= ')';
      $this->db->where($where);
    } else {
      $this->db->where('cp.customer_id', $custId);
    }
    
    $isArrayProductCode = is_array($productCode);
    // cek apakah code product array atau bukan, jika array maka looping untuk where, jika bukan maka hanya sekali
    if ($isArrayProductCode == 1) {
      $where = '(';
      foreach ($productCode as $row) {
        if ($where != '(') $where .= " OR ";
        $where .= "cp.product_code='{$row}'";
      }
      $where .= ')';
      $this->db->where($where);
    } else {
      $this->db->where('cp.product_code', $productCode);
    }
    
    $this->db->where('cp.is_deleted', 0);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

}
