<?php

/**
 * 
 * @dioilham
 * 
 */
class Transaction_model extends CI_Model
{

  var $table = 'transaction';

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
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all($select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->table}");
    $this->db->order_by("id", 'DESC');
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_some_last_invoice()
  {
    $query = $this->db->query("
      SELECT i.id, i.invoice_number, i.paid_amount, i.left_to_paid, i.paid_at, t.deliv_address, t.price_total, s.store_name, t.id AS trx_id
      FROM invoice AS i
      JOIN transaction AS t
      ON t.id = i.transaction_id
      JOIN store AS s
      ON s.id = t.store_id
      WHERE i.is_deleted = 0
      AND t.is_deleted = 0
      AND s.is_deleted = 0
      ORDER BY i.id DESC
      LIMIT 10
    ");

    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_month_total()
  {
    $query = $this->db->query("
      SELECT COUNT(created_at) AS total
      FROM transaction 
      WHERE MONTH(created_at) = MONTH(CURRENT_DATE) 
      AND YEAR(created_at) = YEAR(CURRENT_DATE)
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }


}
