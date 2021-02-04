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
  // public function get_all($select = '*', $asc_desc = 'DESC', $order_by = 'id', $limit = 20000)
  // {
  //   $this->db->select($select);
  //   $this->db->from($this->table);
  //   $this->db->where('is_deleted', 0);
  //   $this->db->order_by($order_by, $asc_desc);
  //   $this->db->limit($limit);

  //   $query = $this->db->get();
  //   if ($query->num_rows() > 0) return $query->result_array();
  //   return FALSE;
  // }

  
  /**
   * 
   * Get all rows from certain table
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all($select = '*', $asc_desc = 'DESC', $order_by = 'trx.id', $limit = 20000, $date_range = 'all')
  {
    $this->tb_invoice      = 'invoice';
    $this->tb_invoice_item = 'invoice_item';
    $this->tb_store        = 'store';
    $this->tb_employee     = 'employee';

    $this->db->select($select);
    $this->db->from("{$this->table} AS trx");

    // $this->db->join("{$this->tb_invoice} AS inv", "trx.id = inv.transaction_id");
    // $this->db->join("{$this->tb_invoice_item} AS inv_item", "inv.id = inv_item.invoice_id");
    $this->db->join("{$this->tb_store} AS s", "trx.store_id = s.id");
    $this->db->join("{$this->tb_employee} AS e", "trx.employee_id = e.id");
    $this->db->where('trx.is_deleted', 0);

    if ($date_range != 'all' && is_array($date_range)) {
      $this->db->where('trx.created_at >=', $date_range['awal']);
      $this->db->where('trx.created_at <=', $date_range['akhir']);
    }

    $this->db->order_by($order_by, $asc_desc);
    $this->db->limit($limit);

    $query = $this->db->get();
    if ( $query->num_rows() > 0) return $query->result_array();
    return FALSE;
  }

  public function get_laba_rugi($filter)
  {
    if ($filter == 'perhari')
    {
      $query = $this->db->query("
        (
          SELECT 
            'penjualan' AS col_type,
            id, 
            created_at, 
            SUM(price_total) AS money,
            SUM(hpp_total) AS modal,
            DATE_FORMAT(created_at, '%d-%b-%Y') AS day_per_month_year,
            CONCAT(YEAR(created_at), '||', MONTH(created_at), '||', DAY(created_at)) AS unique_value
          FROM transaction
          GROUP BY unique_value
          ORDER BY created_at
          DESC
          LIMIT 2000000
        )
        UNION ALL
        (
          SELECT 
            'pengeluaran' AS col_type,
            id, 
            date, 
            SUM(kredit) AS total_kredit, 
            0 AS modal,
            DATE_FORMAT(created_at, '%d-%b-%Y') AS day_per_month_year,
            CONCAT(YEAR(date), '||', MONTH(date), '||', DAY(date)) AS unique_value
          FROM kas
          GROUP BY unique_value
          ORDER BY date
          DESC 
          LIMIT 2000000
        )
        ORDER BY unique_value DESC
      ");
    }
    elseif ($filter == 'perminggu')
    {
      $query = $this->db->query("
        (
          SELECT 
            'penjualan' AS col_type,
            id, 
            created_at, 
            SUM(price_total) AS money,
            SUM(hpp_total) AS modal,
            WEEK(created_at) - WEEK(DATE_FORMAT(created_at, '%Y-%m-01')) + 1 AS week_per_month, 
            DATE_FORMAT(created_at, '%b-%Y') AS month_per_year, 
            CONCAT(YEAR(created_at), '||', MONTH(created_at), '||', WEEK(created_at) + 1) AS unique_value
          FROM transaction
          GROUP BY unique_value
          ORDER BY created_at
          DESC
          LIMIT 2000000
        )
        UNION ALL
        (
          SELECT 
            'pengeluaran' AS col_type,
            id, 
            date, 
            SUM(kredit) AS total_kredit, 
            0 AS modal,
            WEEK(date) - WEEK(DATE_FORMAT(date, '%Y-%m-01')) + 1 AS week_per_month, 
            DATE_FORMAT(date, '%b-%Y') AS month_per_year, 
            CONCAT(YEAR(date), '||', MONTH(date), '||', WEEK(date) + 1) AS unique_value
          FROM kas
          GROUP BY unique_value
          ORDER BY date
          DESC 
          LIMIT 2000000
        )
        ORDER BY unique_value DESC
      ");
    }
    elseif ($filter == 'perbulan')
    {
      $query = $this->db->query("
        (
          SELECT 
            'penjualan' AS col_type,
            id, 
            created_at, 
            SUM(price_total) AS money,
            SUM(hpp_total) AS modal,
            DATE_FORMAT(created_at, '%b-%Y') AS month_per_year, 
            CONCAT(YEAR(created_at), '||', MONTH(created_at)) AS unique_value
          FROM transaction
          GROUP BY unique_value
          ORDER BY created_at
          DESC
          LIMIT 2000000
        )
        UNION ALL
        (
          SELECT 
            'pengeluaran' AS col_type,
            id, 
            date, 
            SUM(kredit) AS total_kredit, 
            0 AS modal,
            DATE_FORMAT(date, '%b-%Y') AS month_per_year, 
            CONCAT(YEAR(date), '||', MONTH(date)) AS unique_value
          FROM kas
          GROUP BY unique_value
          ORDER BY date
          DESC 
          LIMIT 2000000
        )
        ORDER BY unique_value DESC
      ");
    }
    else
    {
      return FALSE;
    }

    if ($query->num_rows() > 1) return $query->result_array();
    else return FALSE;
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
  public function get_all_penjualan_xxx($select = '*', $asc_desc = 'DESC', $order_by = 'id', $limit = 20000, $group_by = null)
  {
    $this->db->select($select);
    $this->db->from("{$this->table}");

    if ($group_by != null)
    {
      $this->db->group_by($group_by);
    }

    $this->db->order_by($order_by, $asc_desc);
    $this->db->limit($limit);

    $query = $this->db->get();

    if ($query->num_rows() > 0) return $query->result_array();
    // elseif ($query->num_rows() > 1) return $query->result_array();
    else return FALSE;
  }

  public function get_some_last_invoice($n = 10)
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
      LIMIT {$n}
    ");

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
      FROM transaction 
      WHERE MONTH(created_at) = MONTH('{$currentDate}') 
      AND YEAR(created_at) = YEAR('{$currentDate}')
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  public function get_total_sales()
  {
    $datestring = '%Y-%m-%d';
    $time = time();
    $currentDate = mdate($datestring, $time);
    
    $query = $this->db->query("
      SELECT price_total FROM transaction
      WHERE MONTH(created_at) = MONTH('{$currentDate}') 
      AND YEAR(created_at) = YEAR('{$currentDate}')
    ");
    
    if ($query->num_rows() > 0) {
      $totalSales = 0;
      foreach ($query->result_array() as $row) {
        $totalSales = $totalSales + $row['price_total'];
      }
      return $totalSales;
    }
    return FALSE;
  }


}
