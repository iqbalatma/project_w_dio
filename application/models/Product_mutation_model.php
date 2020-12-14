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

  public function get_all_2($select = '*')
  {
    // $this->db->select($select);
    // $this->db->from("product_mutation");
    // $this->db->join("product", "product_mutation.product_id = product.id");
    // // $this->db->join("store", "product_mutation.store_id = product.id");

    // $this->db->where("product_mutation.is_deleted", 0);

    $query = $this->db->query("SELECT product_mutation.product_id, product_mutation.store_id, product_mutation.mutation_code, product_mutation.quantity, store.store_name, product.full_name, product.product_code, product_mutation.mutation_type, product_mutation.created_by, product_mutation.created_at FROM product_mutation INNER JOIN product ON product_mutation.product_id = product.id INNER JOIN store ON product_mutation.store_id = store.id ORDER BY product_mutation.created_at DESC");
    // $query = $this->db->query("SELECT * FROM product_mutation ");

    $row = $query->result_array();


    return $row;
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

  public function get_by_store_id_2($id)
  {
    $query = $this->db->query("SELECT product_mutation.product_id, product_mutation.store_id, product_mutation.mutation_code, product_mutation.quantity, store.store_name, product.full_name, product.product_code, product_mutation.mutation_type, product_mutation.created_by, product_mutation.created_at FROM product_mutation INNER JOIN product ON product_mutation.product_id = product.id INNER JOIN store ON product_mutation.store_id = store.id WHERE product_mutation.store_id = $id ORDER BY product_mutation.created_at DESC");
    // $query = $this->db->query("SELECT * FROM product_mutation ");

    $row = $query->result_array();


    return $row;
  }

  public function product_paling_laku()
  {
    $query = $this->db->query("SELECT *, count(product_mutation.product_id) as jumlah FROM product_mutation INNER JOIN product ON product_mutation.product_id = product.id WHERE product_mutation.mutation_type = 'keluar' GROUP BY product_mutation.product_id ORDER BY jumlah DESC LIMIT 5");

    $row = $query->result_array();


    return $row;
  }


  public function jumlah_kuantitas_produk_keluar($product_id)
  {
    $query = $this->db->query("SELECT product.product_code, product.full_name,product_mutation.product_id,SUM(product_mutation.quantity) AS total FROM product_mutation INNER JOIN product ON product_mutation.product_id = product.id WHERE product_mutation.product_id=$product_id");

    $row = $query->result_array();


    return $row;
  }

  public function mendapatkan_id_produk()
  {
    $query = $this->db->query("SELECT *  FROM product");

    $row = $query->result_array();


    return $row;
  }

  public function get_most_buy_product()
  {
    $query = $this->db->query("
      SELECT pm.id, p.product_code, p.full_name, p.image, s.store_name, pm.mutation_code, SUM(pm.quantity) AS freq, pm.mutation_type 
      FROM product AS p
      JOIN product_mutation AS pm
      ON pm.product_id = p.id
      JOIN store AS s
      ON s.id = pm.store_id
      WHERE pm.mutation_type='keluar' 
      GROUP BY pm.product_id 
      ORDER BY freq DESC 
      LIMIT 5
    ");

    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  public function get_least_buy_product()
  {
    $query = $this->db->query("
      SELECT pm.id, p.product_code, p.full_name, p.image, s.store_name, pm.mutation_code, SUM(pm.quantity) AS freq, pm.mutation_type 
      FROM product AS p
      JOIN product_mutation AS pm
      ON pm.product_id = p.id
      JOIN store AS s
      ON s.id = pm.store_id
      WHERE pm.mutation_type='keluar' 
      GROUP BY pm.product_id 
      ORDER BY freq ASC 
      LIMIT 5
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
      FROM product_mutation
      WHERE MONTH(created_at) = MONTH(CURRENT_DATE) 
      AND YEAR(created_at) = YEAR(CURRENT_DATE)
      AND mutation_type = 'keluar'
      AND is_deleted = 0
    ");

    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }

  public function generate_new_mutation_code($timestamp, $arr = NULL)
  {
    // params ke-2 berupa:
    // $arr['item_type'] ; $arr['mutation_type'] ;
    
    if ($arr === NULL) return FALSE;
    
    // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
    // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn

    // set tabel yang digunakan dan kode jenis item, untuk build string mutation_code
    if ($arr['item_type'] == 'product') 
    {
      $table      = 'product_mutation';
      $itemCode   = 'PRO';

    } elseif ($arr['item_type'] == 'material') 
    {
      $table      = 'material_mutation';
      $itemCode   = 'MAT';

    } else {
      return FALSE;
    }
    
    // set kode tipe mutasi, untuk build string mutation_code
    if ($arr['mutation_type'] == 'masuk') 
    {
      $mutationCode   = 'MSK';

    } elseif ($arr['mutation_type'] == 'keluar') 
    {
      $mutationCode   = 'KEL';

    } else {
      return FALSE;
    }
    
    // get last mutation_code from table row
    $lastRow           = $this->db->select('mutation_code')->order_by('id',"desc")->limit(1)->get($table);
    // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
    if ($lastRow->num_rows() > 0) $lastRowValue = $lastRow->row()->mutation_code;
    else $lastRowValue = "0"; // panjang nomor kode ada (bebas) angka

    // pecah $lastRowValue dari db yang isinya code
    $lastCode  = explode('/', $lastRowValue);
    // increment 1
    $codeNum   = $lastCode[0] + 1; // ini kode nomor urut
    end($lastCode); // pindahin pointer ke ujung array
    $codeMonth = prev($lastCode); // ini kode bulan
    // siapkan string bulan ini dari timestamp sekarang, untuk dicek sama apa engga nanti
    $currMonth = mdate('%m', $timestamp);
    
    $dateCode  = mdate('%d/%m/%Y', $timestamp); // tambah string kode untuk hari bulan tahun
    
    // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 1
    // jika tidak, maka gunakan angka yg sudah diincrement 1, yaitu $codeNum
    // append 0 di depan dan sesuaikan total panjang angka yaitu 6
    // kemudian susun sesuai urutan dengan nomor/kode_customer/bulan/tahun, dan invoice_number selesai
    $codeNum      = ($codeMonth !== $currMonth) ? '1' : $codeNum;
    $codeNum      = str_pad($codeNum, 6, "0", STR_PAD_LEFT);
    
    $mutationCode = "{$codeNum}/{$itemCode}/{$mutationCode}/{$dateCode}";
    return $mutationCode;
  }



}
