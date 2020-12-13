<?php

/**
 * 
 * @dioilham
 * 
 */
class Invoice_model extends CI_Model
{

  var $table  = 'invoice';
  var $tb_trx = 'transaction';

//  ===============================================GETTER===============================================
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

  /**
   * 
   * Get all rows from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_with_trx($select = '*')
  {
    $this->db->select($select);
    $this->db->from("{$this->table} AS i");
    $this->db->join("{$this->tb_trx} AS t", "t.id=i.transaction_id");
    $this->db->order_by("i.id", 'DESC')->limit(300);
    $query = $this->db->get();
    if ( $query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_month_total()
  {
    $query = $this->db->query("
      SELECT COUNT(created_at) AS total
      FROM invoice
      WHERE MONTH(created_at) = MONTH(CURRENT_DATE) 
      AND YEAR(created_at) = YEAR(CURRENT_DATE)
      AND left_to_paid != 0
      AND status = '0'
      AND is_deleted = 0
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }


}
