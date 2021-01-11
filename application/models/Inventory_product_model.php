<?php

/**
 * 
 * @dioilham
 * 
 */
class Inventory_product_model extends CI_Model
{

  var $table          = 'product_inventory';
  var $tb_product     = 'product';
  var $tb_store       = 'store';
  // var $tb_employee  = 'employee';

  //  =============================================== SETTER ===============================================
  /**
   * 
   * Insert new product to the database.
   * 
   * @param array $data [5 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */

  // public function get_where($data)
  // {
  // }
  public function set_new_inventory($data)
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
   * 
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
    if (($data['edit-tipeupdate'] !== '+') && ($data['edit-tipeupdate'] !== '-')) {
      return FALSE;
    }
    $createdAt = unix_to_human(now(), true, 'europe');
    // ('+' or '-') and (total stok to be inputted)
    $operand  = $data['edit-tipeupdate'];
    $total    = $data['edit-updatestok'];
    $data = [
      "updated_at"    => $createdAt,
      "updated_by"    => $data['edit-username'],
    ];
    // pprint($total);
    // pprintd($operand);
    // set data to table `quantity`
    $this->db->set("quantity", "quantity {$operand} {$total}", FALSE);
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);



    // $this->db->trans_start();
    // $this->db->trans_complete();

    // if ($this->db->trans_status() === FALSE)
    // {
    //   // flashdata untuk sweetalert
    //   $this->session->set_flashdata('failed_message', 1);
    //   $this->session->set_flashdata('title', "Input gagal!");
    //   $this->session->set_flashdata('text', 'Data gagal diproses! Hubungi administrator segera.');
    //   redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
    // }
    // else
    // {
    //   return 1;
    // }

  }

  /**
   * 
   * Delete employee that already registered, but not the actual row data deletion,
   * this is just updating "is_deleted" fields in the table from 0 to 1.
   * 
   * @param array $id
   * Set the $id from the product id to fetch the data relatives to the id.
   * 
   */
  public function set_delete_by_id($id)
  {
    // echo '<pre>'; print_r($id); die;
    $data = array(
      "is_deleted"   => 1,
    );
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }



  //  =============================================== GETTER ===============================================
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
  public function get_all($select = '*', $orderBy = 'pi.id', $ascDesc = 'ASC')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by($orderBy, $ascDesc);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }

  /**
   * 
   * Get all rows from certain table by certain id
   * 
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_by_store_id($storeId, $select = '*', $orderBy = 'pi.id', $ascDesc = 'ASC')
  {
    $this->db->select($select);
    $this->db->from("{$this->tb_product} AS p");
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
    // $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $this->db->where("pi.store_id", $storeId);
    $this->db->where("pi.is_deleted", 0);
    $this->db->order_by($orderBy, $ascDesc);
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
    $this->db->join("{$this->table} AS pi", "pi.product_id = p.id");
    $this->db->join("{$this->tb_store} AS s", "s.id = pi.store_id");
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

  // get 1 product_composition berdasarkan id
  // masukkan parameter kedua sebagai nama kolom pada database, untuk select kolom
  /**
   * 
   * Get all Product Composition that is belong to
   * the corresponding Product by joining some tables on its id.
   * 
   * @param string $id 
   * Set the $id from the product id to fetch the data relatives to the id.
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  public function get_all_composition_by_id($id, $select = '*')
  {
    // get from tb_department
    $this->db->select($select);
    $this->db->from($this->table);
    $this->db->join($this->tb_product_composition, "{$this->table}.id={$this->tb_product_composition}.product_id");
    $this->db->join($this->tb_material, "{$this->tb_product_composition}.material_id={$this->tb_material}.id");
    $this->db->where("{$this->tb_product_composition}.product_id", $id);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result_array();
    }
    return FALSE;
  }





  
  // ====================================================================== SELURUH PROSES CHECKOUT DARI GUDANG UNTUK STOK PRODUCT - DIO =============================================================

  private function __generate_new_trx_number($timestamp)
  {
      $table = 'transaction';

      // trans_number format, string build
      $code  = 'TRX/'; // kode untuk transaksi
      $code .= mdate('%m/%Y/', $timestamp); // kode untukhari bulan tahun

      // get last trans_number from table row
      $lastRow           = $this->db->select('trans_number')->order_by('id', "desc")->limit(1)->get($table);
      // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
      if ($lastRow->num_rows() > 0) $lastCode = $lastRow->row()->trans_number;
      else $lastCode = $code . '000000'; // panjang nomor kode ada 6 angka
      // pecah $lastCode dari db
      $lastCode  = explode('/', $lastCode);
      // increment 1
      $codeNum   = end($lastCode) + 1; // ini kode nomor urut
      // ambil seluruh kode date, kemudian pecah, lalu ambil bulan
      // $codeDate  = prev($lastCode);
      // $codeDate  = explode('_', $codeDate);
      $codeMonth = $lastCode[1]; // ini kode bulan
      // siapkan string bulan ini dari timestamp sekarang, untuk dicek sama apa engga nanti
      $currMonth = mdate('%m', $timestamp);

      // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 000001
      // jika tidak, maka gunakan angka yg sudah diincrement 1, yaitu $codeNum
      // append 0 di depan dan sesuaikan total panjang angka yaitu 6
      // kemudian masukan kembali ke string $code, dan trans_number selesai
      $codeNum        = ($codeMonth !== $currMonth) ? '000001' : $codeNum;
      $code          .= str_pad($codeNum, 6, "0", STR_PAD_LEFT);
      $transNumber    = $code;

      return $transNumber;
  }

  private function __generate_new_invoice_number_gudang($timestamp)
  {
      $table = 'invoice';

      $custCode = "CB";

      $custAndDateCode   = "{$custCode}/"; // string kode customer
      $custAndDateCode  .= mdate('%m/%Y', $timestamp); // tambah string kode untuk bulan tahun

      // get last invoice_number from table row
      $lastRow           = $this->db->select('invoice_number')->order_by('id', "desc")->limit(1)->get($table);
      // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
      if ($lastRow->num_rows() > 0) $lastCode = $lastRow->row()->invoice_number;
      else $lastCode = "0/{$custAndDateCode}"; // panjang nomor kode ada (bebas) angka

      // pecah $lastCode dari db
      $lastCode  = explode('/', $lastCode);
      // increment 1
      $codeNum   = $lastCode[0] + 1; // ini kode nomor urut
      $codeMonth = $lastCode[2]; // ini kode bulan
      // siapkan string bulan ini dari timestamp sekarang, untuk dicek sama apa engga nanti
      $currMonth = mdate('%m', $timestamp);

      // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 1
      // jika tidak, maka gunakan angka yg sudah diincrement 1, yaitu $codeNum
      // kemudian susun sesuai urutan dengan nomor/kode_customer/bulan/tahun, dan invoice_number selesai
      $codeNum        = ($codeMonth !== $currMonth) ? '1' : $codeNum;
      $invoiceNumber  = "{$codeNum}/{$custAndDateCode}";

      return $invoiceNumber;
  }

  private function __generate_new_invoice_number($timestamp, $customerType)
  {
      $table = 'invoice';

      // trans_number format, string build
      if ($customerType == "retail") {
          $custCode = "KS";
      } else {
          $custCode = "AR";
      }

      $custAndDateCode   = "{$custCode}/"; // string kode customer
      $custAndDateCode  .= mdate('%m/%Y', $timestamp); // tambah string kode untuk bulan tahun

      // get last invoice_number from table row
      $lastRow           = $this->db->select('invoice_number')->order_by('id', "desc")->limit(1)->get($table);
      // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
      if ($lastRow->num_rows() > 0) $lastCode = $lastRow->row()->invoice_number;
      else $lastCode = "0/{$custAndDateCode}"; // panjang nomor kode ada (bebas) angka

      // pecah $lastCode dari db
      $lastCode  = explode('/', $lastCode);
      // increment 1
      $codeNum   = $lastCode[0] + 1; // ini kode nomor urut
      $codeMonth = $lastCode[2]; // ini kode bulan
      // siapkan string bulan ini dari timestamp sekarang, untuk dicek sama apa engga nanti
      $currMonth = mdate('%m', $timestamp);

      // jika data yang ingin diinput adalah data terbaru di bulan terkait, maka mulai dari 1
      // jika tidak, maka gunakan angka yg sudah diincrement 1, yaitu $codeNum
      // kemudian susun sesuai urutan dengan nomor/kode_customer/bulan/tahun, dan invoice_number selesai
      $codeNum        = ($codeMonth !== $currMonth) ? '1' : $codeNum;
      $invoiceNumber  = "{$codeNum}/{$custAndDateCode}";

      return $invoiceNumber;
  }

  private function __generate_new_due_at($now, $nextDue, $unixOrHuman = 'human')
  {
      // tambahkan timestamp dan timestamp untuk tenggat waktu selanjutnya
      $dueTimestamp = $now + $nextDue;
      // opsi untuk return sebagai timestamp atau tanggal human readable (DEFAULT = HUMAN)
      if ($unixOrHuman == 'human') $dueAt = unix_to_human($dueTimestamp, true, 'europe');
      else $dueAt = $dueTimestamp;

      return $dueAt;
  }

  private function __generate_new_mutation_code($timestamp, $arr = NULL)
  {
      // params ke-2 berupa:
      // $arr['item_type'] ; $arr['mutation_type'] ;

      if ($arr === NULL) return FALSE;

      // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
      // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn

      // set tabel yang digunakan dan kode jenis item, untuk build string mutation_code
      if ($arr['item_type'] == 'product') {
          $table      = 'product_mutation';
          $itemCode   = 'PRO';
      } elseif ($arr['item_type'] == 'material') {
          $table      = 'material_mutation';
          $itemCode   = 'MAT';
      } else {
          return FALSE;
      }

      // set kode tipe mutasi, untuk build string mutation_code
      if ($arr['mutation_type'] == 'masuk') {
          $mutationCode   = 'MSK';
      } elseif ($arr['mutation_type'] == 'keluar') {
          $mutationCode   = 'KEL';
      } else {
          return FALSE;
      }

      // get last mutation_code from table row
      $lastRow           = $this->db->select('mutation_code')->order_by('id', "desc")->limit(1)->get($table);
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

  /**
   * Get product composition by custom where clause
   * 
   * @param string $where
   * Query string for where clause (ex. id=5 OR id=6 OR id=10)
   * @param string $select 
   * Default value is '*', but you can input some string
   * to select some table(s) name of your choice.
   * 
   */
  private function __get_by_where($where = NULL, $select = '*')
  {
    // get from table
    $this->db->select($select);
    $this->db->from('product_composition');
    $this->db->where($where);
    $query = $this->db->get();
    // pprintd($where);
    if ($query->num_rows() > 0) {
        return $query->result_array();
    }
    return FALSE;
  }

  private function __check_product_inventory($prodId, $storeId, $select = '*')
  {
    // get from table
    $this->db->select($select);
    $this->db->from('product_inventory');
    $this->db->where('product_id', $prodId);
    $this->db->where('store_id', $storeId);
    $query = $this->db->get();
    // pprintd($where);
    if ($query->num_rows() == 1) {
      return $query->row();
    }
    return FALSE;
  }



  /**
   * 
   * Insert new row to the database.
   * 
   * @param array $data [10 data]
   * The key and value in the array that will be inserted into the database.
   * 
   */
  public function set_new_qty($data)
  {
      // ============================================================ [0] MULAI INISIASI AWAL YANG DIBUTUHKAN ===================
      // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
      // | ! NOTE:
      // | Urutan proses = material_mutation, material_inventory, product_mutation, product_inventory
      // | Masukin ke tabel masing2 menggunakan konsep TRANSACTION dari MYSQL
      // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    // inisiasi nama tabel yg digunakan, lokal hanya untuk method ini
      // $tb_transaction         = 'transaction';
      // $tb_invoice             = 'invoice';
      // $tb_invoice_item        = 'invoice_item';
      $tb_material_inventory  = 'material_inventory';
      $tb_material_mutation   = 'material_mutation';
      $tb_product_mutation    = 'product_mutation';
      $tb_product_inventory   = 'product_inventory';

      $this->db->trans_start();

      // set waktu awal untuk method ini
      $now          = now();
      $createdAt    = unix_to_human($now, true, 'europe');

      // pprintd($data);


    //  ini bukan untuk inventory ke gudang.
    //
      // // ============================================================ [1] MULAI SIAPKAN DATA-DATA UNTUK TRANSACTION ===================


      //   if ($data['data_product']->reseller_price > 0) {
      //     $totalPrice = $data['data_product']->reseller_price;
      //     $leftToPaid = $totalPrice; // sisa bayar pasti full, karena auto kontrabon
      //   } else {
      //     $totalPrice = $data['data_product']->selling_price;
      //     $leftToPaid = $totalPrice; // sisa bayar pasti full, karena auto kontrabon
      //   }

      //   $nextDue      = 86400 * 7; // tambah 7 hari
      //   $nextDue      = ($leftToPaid == 0) ? 0 : $nextDue; // cek apakah lunas atau hutang, kalau lunas dueAt adalah waktu yg sama
      //   $transNumber  = $this->__generate_new_trx_number($now);
      //   $dueAt        = $this->__generate_new_due_at($now, $nextDue);

      //   $data_transaction  = [
      //     'trans_number'  => $transNumber,
      //     'deliv_address' => $data['data_cust']['address'],
      //     'price_total'   => $totalPrice,
      //     'store_id'      => $data['store_id'],
      //     'customer_id'   => $data['data_cust']['id'],
      //     'employee_id'   => $data['employee_id'],
      //     'due_at'        => $dueAt,
      //     'created_at'    => $createdAt,
      //   ];

      //   $isTransactionSuccess = $this->db->insert($tb_transaction, $data_transaction);
      //   $lastTrxId            = $this->db->insert_id();


      // // ============================================================ SELESAI PERSIAPAN DATA TRANSACTION ===================
      // // ============================================================ [2] MULAI SIAPKAN DATA-DATA UNTUK INVOICE ===================


      //   $invoiceNumber = $this->__generate_new_invoice_number($now, $data['data_cust']['cust_type']);

      //   if ($data['data_product']->reseller_price > 0) {
      //     $totalPrice = $data['data_product']->reseller_price;
      //     $leftToPaid = $totalPrice; // sisa bayar pasti full, karena auto kontrabon
      //   } else {
      //     $totalPrice = $data['data_product']->selling_price;
      //     $leftToPaid = $totalPrice; // sisa bayar pasti full, karena auto kontrabon
      //   }
        
      //   $data_invoice = [
      //     'invoice_number'    => $invoiceNumber,
      //     'paid_amount'       => 0,
      //     'left_to_paid'      => $leftToPaid,
      //     'paid_at'           => $createdAt,
      //     'paid_type'         => 'kontrabon',
      //     'transaction_id'    => $lastTrxId,
      //     'created_at'        => $createdAt,
      //     'status'            => '0',
      //   ];

      //   $isInvoiceSuccess = $this->db->insert($tb_invoice, $data_invoice);
      //   $lastInvoiceId    = $this->db->insert_id();


      // // ============================================================ SELESAI PERSIAPAN DATA INVOICE ===================
      // // ============================================================ [3] MULAI SIAPKAN DATA-DATA UNTUK INVOICE ITEM ===================


      //   $data_invoice_item = $data['data_product'];
      //   pprintd($data_invoice_item);

      //   $container = [];
      //   foreach ($data['data_product'] as $row) {
      //     $x['quantity']   = $row['kasir_qty'];
      //     $x['item_price'] = $row['kasir_total_per_item'];
      //     $x['invoice_id'] = $lastInvoiceId;
      //     $x['product_id'] = $row['id'];
      //     $container[] = $x;
      //   }
      //   $data_invoice_item = $container;

      //   $isInvoiceItemSuccess = $this->db->insert_batch($tb_invoice_item, $data_invoice_item);


      // // ============================================================ SELESAI PERSIAPAN DATA INVOICE ITEM ===================
    //


    // ============================================================ [1] MULAI SIAPKAN DATA MUTASI MATERIAL ===================


      // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
      // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn
      $arr = [
        'item_type' => 'material', // PRO=Product ; MAT=Material ;
        'mutation_type' => 'keluar', // KEL=Keluar ; MSK=Masuk ;
      ];
      $materialMutationCode = $this->__generate_new_mutation_code($now, $arr);

      //
        // // get seluruh material dari seluruh produk id yang di cekout
        // // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
        // // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
        // // contoh  ==>  id=1 OR id=9 OR id=13
        // $productQuery = '';
        // foreach ($data['data_product_comp'] as $__product) {
        //   // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
        //   if ($productQuery !== '') $productQuery .= " OR ";
        //   $productQuery .= "material_id={$__product['mat_id']}";
        // }
        // // get data dari db dengan klausa where di atas
        // $data['product_composition'] = $this->__get_by_where($productQuery, 'id, volume, product_id, material_id');

        // $container = [];
        // foreach ($data['data_product'] as $__prod) {
        //   foreach ($data['product_composition'] as $__pc) {
        //     if ($__prod['id'] == $__pc['product_id']) {
        //       $temp['product_id']    = $__prod['id'];
        //       $temp['material_id']   = $__pc['material_id'];
        //       $temp['mutation_qty']  = $__prod['kasir_qty'] * $__pc['volume'];
        //       $container[] = $temp;
        //       // break;
        //     }
        //   }
        // }
      //
      
      // variabel untuk digunakan di sub-bab material mutation
      $data_material_mutation  = $data['data_product_comp'];
      // variabel untuk digunakan di sub-bab material inventory, biar gaproses 2kali, jadi cukup di sini
      $data_material_inventory = $data['data_product_comp'];

      // pprintd($data);

      $container = [];
      $i = 0;
      foreach ($data_material_mutation as $row) {
        // pecah mutation code yang asli, untuk dilooping increment 1 si nomor depannya
        $__exploded     = explode('/', $materialMutationCode);
        $__exploded[0]  = $__exploded[0] + $i;
        $__exploded[0]  = str_pad($__exploded[0], 6, "0", STR_PAD_LEFT);
        // gabungin lagi yang udah dipecah dan diincrement 1
        $__materialMutationCode = implode('/', $__exploded);

        $data_material_mutation = [
          'material_id'   => $row['mat_id'],
          'store_id'      => '1', // pasti dari gudang
          'mutation_code' => $__materialMutationCode,
          'quantity'      => $row['new_comp_qty_needed_single'],
          'mutation_type' => 'keluar', // pasti keluar, untuk bikin stok produk
          'created_at'    => $createdAt,
          'created_by'    => $data['username'],
        ];
        $container[] = $data_material_mutation;
        $i++;
      }
      $data_material_mutation = $container;

      $isMaterialMutationSuccess = $this->db->insert_batch($tb_material_mutation, $data_material_mutation);
      // pprintd($lastInvoiceId);


    // ============================================================ SELESAI PERSIAPAN DATA MUTASI MATERIAL ===================
    // ============================================================ [2] MULAI SIAPKAN DATA INVENTORY MATERIAL ===================


      $container = [];
      $i = 0;
      foreach ($data_material_inventory as $row) {
          $data_material_inventory = [
              'material_id'   => $row['mat_id'],
              'store_id'      => '1',
              'quantity'      => $row['qty_final'],
              'updated_at'    => $createdAt,
              'updated_by'    => $data['username'],
          ];
          $container[] = $data_material_inventory;
          $i++;

          $this->db->from($tb_material_inventory);
          $this->db->set("quantity", "{$row['qty_final']}");
          $this->db->set("updated_at", "{$createdAt}");
          $this->db->set("updated_by", "{$data['username']}");
          $this->db->where('material_id', "{$row['mat_id']}");
          $this->db->where('store_id', "1"); // pasti dari gudang
          $this->db->update();
      }
      $data_material_inventory = $container;
    

    // ============================================================ SELESAI PERSIAPAN DATA INVENTORY MATERIAL ===================
    // ============================================================ [3] MULAI SIAPKAN DATA MUTASI PRODUK ===================


      // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
      // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn

      $arr = [
          'item_type' => 'product', // PRO=Product ; MAT=Material ;
          'mutation_type' => 'masuk', // KEL=Keluar ; MSK=Masuk ;
      ];
      $productMutationCode = $this->__generate_new_mutation_code($now, $arr);

      $data['data_product_comp'] = $row;
      $data_product_mutation = [
          'product_id'    => $row['prod_id'],
          'store_id'      => $data['store_id'],
          'mutation_code' => $productMutationCode,
          'quantity'      => $data['add-qty'],
          'mutation_type' => $arr['mutation_type'],
          'created_at'    => $createdAt,
          'created_by'    => $data['username'],
      ];


      $isProductMutationSuccess = $this->db->insert($tb_product_mutation, $data_product_mutation);


    // ============================================================ SELESAI PERSIAPAN DATA MUTASI PRODUK ===================
    // ============================================================ [4] MULAI SIAPKAN DATA INVENTORY PRODUK ===================


      $data_product_inventory = [
        'product_id'    => $row['prod_id'],
        'store_id'      => $data['store_id'],
        'quantity'      => $data['add-qty'],
        'updated_at'    => $createdAt,
        'created_by'    => $data['username'],
        'updated_by'    => $data['username'],
      ];

      $isAvailable = $this->__check_product_inventory($data['data_product']->id, $data['store_id'], 'id');

      // pprintd($data_product_inventory);

      if ($isAvailable == FALSE) {
        $isProductInvSuccess = $this->db->insert($tb_product_inventory, $data_product_inventory);
      } else {
        $this->db->from($tb_product_inventory);
        $this->db->set("quantity", "quantity + {$data['add-qty']}", FALSE);
        $this->db->set("updated_at", "{$createdAt}");
        $this->db->set("updated_by", "{$data['username']}");
        $this->db->where('product_id', "{$data['data_product']->id}");
        $this->db->where('store_id', "{$data['store_id']}");
        $this->db->update();
      }

      // pprintd($isProductInvSuccess);
      

    // ============================================================ SELESAI PERSIAPAN DATA INVENTORY PRODUK ===================
    // ============================================================ [5] MULAI VALIDASI DAN COMPLETE KEMBALI KE CONTROLLER ===================


    $this->db->trans_complete();

    // return value untuk dipake setelah ini
    $returnVal = [
      // 'invoice_id'        => $lastInvoiceId,
      // 'invoice_number'    => $invoiceNumber,
      // 'due_at'            => $dueAt,
    ];

    // pprintd($returnVal);

    return ($this->db->trans_status() === FALSE) ? FALSE : TRUE;
  }







}
