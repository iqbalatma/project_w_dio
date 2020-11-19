<?php

/**
 *
 */
class Customer_model extends CI_Model
{

  var $table = 'customer';
  var $tb_custom_price = 'custom_price';

  //  ===============================================SETTER===============================================
  // insert customer baru
  /**
   * setter untuk menambahkan customer baru
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
  
  // insert customer baru
  /**
   * setter untuk menambahkan harga kustom pada pelanggan
   * @param array $data [berisi 4 data]
   */
  public function set_new_customer_price_by_id($id, $data)
  {
    $createdAt = unix_to_human(now(), true, 'europe');

    $this->db->trans_start();
    foreach ($data['custom'] as $c)
    {
      $data = array(
        "price"         => $c['price'],
        "customer_id"   => $id,
        "product_code"  => $c['product_code'],
        "created_at"    => $createdAt,
      );
      $this->db->insert($this->tb_custom_price, $data);
    }
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('failed_message', 1);
      $this->session->set_flashdata('title', "Input gagal!");
      $this->session->set_flashdata('text', 'Data gagal diproses! Hubungi administrator segera.');
      redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
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



  //  ===============================================GETTER===============================================
  // get total customer
  public function get_total()
  {
    // get from $table
    $this->db->select('count(id) AS total');
    $this->db->from($this->table);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
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
}
