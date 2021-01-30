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
  var $tb_cust = 'customer';

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
    if ($query->num_rows() > 0) {
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
  public function get_all_with_trx($select = '*', $idToko = null, $limit = 999999999)
  {
    $this->db->select($select);
    $this->db->from("{$this->table} AS i");
    $this->db->join("{$this->tb_trx} AS t", "t.id=i.transaction_id");
    
    if ($idToko != null) {
      $this->db->where('t.store_id', $idToko);
    }

    $this->db->order_by("i.id", 'DESC')->limit($limit);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_all_first_inv_per_trx($select = '*', $idToko = null, $limit = 999999999)
  {
    // ini subquery
    $this->db->select("MIN(id) AS id");
    $this->db->group_by("transaction_id");
    $subQuery = $this->db->get_compiled_select('invoice');

    // ini query utama
    $this->db->select("{$select}");
    $this->db->from("{$this->table} AS i, ({$subQuery}) AS first_invoice");
    $this->db->join("{$this->tb_trx} AS t", "t.id=i.transaction_id");
    $this->db->where('i.id = first_invoice.id');
    $this->db->order_by("i.id", 'DESC')->limit($limit);

    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;


    // $datestring = '%Y-%m-%d';
    // $time = time();
    // $currentDate = mdate($datestring, $time);

    // $query_xxx = $this->db->query("
    //   SELECT invoice.left_to_paid AS total_hutang FROM invoice, 
    //   (
    //       SELECT MIN(id) AS id, transaction_id
    //       FROM invoice
    //       GROUP BY transaction_id
    //   ) AS last_debt
    //   WHERE invoice.id = last_debt.id

    //   AND invoice.transaction_id = last_debt.transaction_id
    //   AND left_to_paid != 0
    //   AND MONTH(created_at) = MONTH('{$currentDate}')
    //   AND YEAR(created_at) = YEAR('{$currentDate}')

    //   ORDER BY invoice.id  DESC
    // ");
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
  public function get_all_hutang($select = '*', $idToko = null, $limit = 999999999)
  {
    $this->db->select($select);
    $this->db->from("{$this->table} AS inv");
    $this->db->join("{$this->tb_trx} AS trx", "trx.id = inv.transaction_id");
    $this->db->join("{$this->tb_cust} AS cust", "cust.id = trx.customer_id");
    
    if ($idToko != null) {
      $this->db->where('trx.store_id', $idToko);
    }
    $this->db->where('inv.status', '0');
    $this->db->where('inv.is_deleted', 0);
    $this->db->where('inv.left_to_paid >', 0);
    $this->db->order_by("inv.id", 'DESC')->limit($limit);
    
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_month_total()
  {
    $datestring = '%Y-%m-%d';
    $time = time();
    $currentDate = mdate($datestring, $time);

    $query = $this->db->query("
      SELECT COUNT(created_at) AS total
      FROM invoice
      WHERE MONTH(created_at) = MONTH('{$currentDate}') 
      AND YEAR(created_at) = YEAR('{$currentDate}')
      AND left_to_paid != 0
      AND status = '0'
      AND is_deleted = 0
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  public function get_total_debt()
  {
    $datestring = '%Y-%m-%d';
    $time = time();
    $currentDate = mdate($datestring, $time);

    $query = $this->db->query("
      SELECT invoice.left_to_paid AS total_hutang FROM invoice, 
      (
          SELECT MAX(id) AS id, transaction_id
          FROM invoice
          GROUP BY transaction_id
      ) AS last_debt
      WHERE invoice.id = last_debt.id
      AND invoice.transaction_id = last_debt.transaction_id
      AND left_to_paid != 0
      AND MONTH(created_at) = MONTH('{$currentDate}')
      AND YEAR(created_at) = YEAR('{$currentDate}')
      ORDER BY invoice.id  DESC
    ");

    if ($query->num_rows() > 0) {
      $totalDebt = 0;
      foreach ($query->result_array() as $row) {
        $totalDebt = $totalDebt + $row['total_hutang'];
      }
      return $totalDebt;
    }
    return FALSE;
  }


  public function get_total_debt2()
  {
    $datestring = '%Y-%m-%d';
    $time = time();
    $currentDate = mdate($datestring, $time);

    $query = $this->db->query("
      SELECT left_to_paid AS total_hutang FROM invoice
      WHERE left_to_paid != 0
      GROUP BY transaction_id DESC
    ");

    if ($query->num_rows() > 0) {
      $totalDebt = 0;
      foreach ($query->result_array() as $row) {
        $totalDebt = $totalDebt + $row['total_hutang'];
      }
      return $totalDebt;
    }
    return FALSE;
  }


  public function get_hutang($transaction_id)
  {
    $query = $this->db->query("
    SELECT * FROM invoice WHERE transaction_id = $transaction_id ORDER BY created_at DESC LIMIT 1
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }



}
