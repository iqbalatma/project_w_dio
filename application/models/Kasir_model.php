<?php

defined('BASEPATH') or exit('No direct script access allowed');





class Kasir_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    // protected $table      = '';
    // protected $table2      = 'test';
    // protected $primaryKey = 'material_code';
    protected $returnType     = 'array';


    public function insert_invoice($data)
    {
        return $this->db->insert('invoice', $data);
    }

    public function insert_transaction($data)
    {
        return $this->db->insert('transaction', $data);
    }
    public function insert_invoice_item($data)
    {
        return $this->db->insert('invoice_item', $data);
    }

    public function get_row_terbaru()
    {
        $query = $this->db->query("SELECT id FROM transaction ORDER BY id DESC LIMIT 1");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;

        // if (isset($row)) {
        //     echo $row['title'];
        //     echo $row['name'];
        //     echo $row['body'];
        // }
    }

    public function update_total_price($data)
    {
        // $this->db->set('price_total', $data['price_total'], FALSE);
        // $this->db->where('id', $data['id']);
        // $this->db->update('transaction');
        $price_total = $data['price_total'];
        $id = $data['id'];
        $nama_tabel = "transaction";
        $query = $this->db->query("UPDATE $nama_tabel SET price_total = $price_total WHERE id = $id");
        // gives UPDATE mytable SET field = field+1 WHERE id = 2
        return 1;
    }

    public function insert_product_mutation($data)
    {
        return $this->db->insert('product_mutation', $data);
    }

    public function update_quantity_inventory_product($data)
    {
        $id = $data['id'];
        $store_id = $data['store_id'];
        $quantity_input = $data['quantity'];
        $query = $this->db->query("SELECT * FROM product_inventory WHERE product_id=$id AND store_id=$store_id");

        $row = $query->row_array();
        $quantity_db = $row['quantity'];
        // $row = $query->last_row();





        $final_quantity = $quantity_db - $quantity_input;
        $this->db->set('quantity', $final_quantity, FALSE);
        $this->db->where('product_id', $id);
        $this->db->update('product_inventory');
        return 1;
    }

    public function get_customer($data)
    {
        $customer_id = $data;
        $query = $this->db->query("SELECT cust_type FROM customer WHERE id=$customer_id");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;
    }

    public function cek_number_invoice($data)
    {
        $tanggal = $data;
        $tanggal = explode("-", $tanggal);
        $tanggal = $tanggal[1];

        // $this->db->select('*');
        // $this->db->from('invoice');
        // $this->db->where("created_at", $tanggal);

        // $query = $this->db->get();

        $query = $this->db->query("SELECT * FROM invoice  ORDER BY id DESC LIMIT 1 ");
        $row = $query->row_array();
        $row = $row['created_at'];
        $row = explode("-", $row);
        $row = $row[1];



        if ($row == $tanggal) {
            return false;
        }
        return true;
    }

    public function cek_invoice_terakhir($data)
    {
        $tanggal = $data;

        $query = $this->db->query("SELECT * FROM invoice ORDER BY id DESC LIMIT 1 ");

        $row = $query->row_array();
        // $row = $query->last_row();

        return $row;
    }


    public function cek_id_invoice_terakhir()
    {


        $query = $this->db->query("SELECT * FROM invoice WHERE is_deleted=0 ORDER BY id DESC LIMIT 1 ");

        $row = $query->row_array();


        return $row;
    }

    public function update_left_to_paid($data)
    {
        $id = $data['id'];
        $left_to_paid = $data['left_to_paid'];
        $this->db->set('left_to_paid', $left_to_paid, FALSE);
        $this->db->where('id', $id);
        $this->db->update('invoice');
        return 1;
    }



    public function cek_komposisi($data)
    {
        $id_product = $data;

        $this->db->select('*');
        $this->db->from('product_composition');
        $this->db->where("product_id", $id_product);


        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return FALSE;
    }

    public function update_quantity_material($data)
    {
        $material_id = $data['material_id'];
        $quantity = $data['quantity_material'];
        $store_id = $data['store_id'];
        $query = $this->db->query("UPDATE material_inventory SET quantity = quantity - $quantity WHERE material_id = $material_id");
        return $query;
    }

    public function cek_kuantitas_material($id_product)
    {
        $query = $this->db->query("SELECT * FROM product_composition WHERE product_id = $id_product");

        $row = $query->result_array();


        return $row;
    }

    public function cek_inventory($id_material)
    {
        $query = $this->db->query("SELECT * FROM material_inventory WHERE material_id =$id_material");
        if ($query->num_rows() > 0) {
          return $query->result_array();
        }
        return FALSE;

        // $row = $query->result_array();

        // pprintd($row);
        // return $row;
    }

    public function insert_material_mutation($data)
    {
        return $this->db->insert('material_mutation', $data);
    }

    public function cek_harga_custom($data)
    {
        $code_product = $data['code_product'];
        $id_customer = $data['id_customer'];

        $query = $this->db->query("SELECT * FROM custom_price WHERE customer_id ='$id_customer' AND product_code = '$code_product'");

        $row = $query->result_array();


        return $row;
    }
    public function get_code_product($id_product)
    {


        $query = $this->db->query("SELECT * FROM product WHERE id =$id_product");

        $row = $query->result_array();


        return $row;
    }

    public function get_ajax()
    {
        $query = $this->db->query("SELECT * FROM product WHERE id =1");

        $row = $query->result_array();


        return json_encode($row);
    }


    public function get_hutang()
    {
        $query = $this->db->query("SELECT invoice.id, invoice.invoice_number,invoice.left_to_paid, invoice.paid_at, invoice.is_deleted, invoice.transaction_id, transaction.customer_id, customer.full_name, customer.address, customer.phone FROM invoice INNER JOIN transaction ON invoice.transaction_id = transaction.id INNER JOIN customer ON transaction.customer_id = customer.id WHERE invoice.status = '0' AND left_to_paid > 0");

        $row = $query->result_array();


        return $row;
    }

    public function edit_invoice($data)
    {
        $id_invoice = $data['id_invoice'];
        $paid_amount = $data['paid_amount'];
        $query = $this->db->query("UPDATE invoice SET status = '1' WHERE id = $id_invoice");
        return $query;
    }



    public function generate_invoice($invoice_id)
    {
        $query = $this->db->query("SELECT invoice.id, invoice.invoice_number,invoice.left_to_paid, invoice.paid_at, invoice.is_deleted, invoice.transaction_id, invoice.created_at, transaction.customer_id, customer.full_name, customer.address, customer.phone FROM invoice INNER JOIN transaction ON invoice.transaction_id = transaction.id INNER JOIN customer ON transaction.customer_id = customer.id WHERE invoice.is_deleted = 0 AND invoice.id=$invoice_id");

        $row = $query->result_array();


        return $row;
    }
    public function generate_invoice_item($invoice_id)
    {
        $query = $this->db->query("SELECT product.full_name, product.unit,invoice_item.quantity, invoice_item.item_price FROM invoice_item INNER JOIN product ON invoice_item.product_id = product.id WHERE invoice_item.invoice_id=$invoice_id");

        $row = $query->result_array();


        return $row;
    }























// ====================================================================== TESTING KASIR DIO =============================================================

    private function __generate_new_trx_number($timestamp)
    {
        $table = 'transaction';

        // trans_number format, string build
        $code  = 'TRX/'; // kode untuk transaksi
        $code .= mdate('%m/%Y/', $timestamp); // kode untukhari bulan tahun

        // get last trans_number from table row
        $lastRow           = $this->db->select('trans_number')->order_by('id',"desc")->limit(1)->get($table);
        $lastRowValue      = $lastRow->row()->trans_number;
        // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
        if ($lastRow->num_rows() > 0) $lastCode = $lastRowValue;
        else $lastCode = $code.'000000'; // panjang nomor kode ada 6 angka
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
        $lastRow           = $this->db->select('invoice_number')->order_by('id',"desc")->limit(1)->get($table);
        $lastRowValue      = $lastRow->row()->invoice_number;
        // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
        if ($lastRow->num_rows() > 0) $lastCode = $lastRowValue;
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
        $lastRowValue      = $lastRow->row()->mutation_code;
        // else jika belum ada sama sekali data di db (cuma kepake sekali seumur hidup harusnya)
        if ($lastRow->num_rows() > 0) $lastRowValue = $lastRowValue;
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


    
    /**
     * 
     * Insert new row to the database.
     * 
     * @param array $data [10 data]
     * The key and value in the array that will be inserted into the database.
     * 
     */
    public function set_new_checkout($data)
    {
        // ============================================================ [0] MULAI INISIASI AWAL YANG DIBUTUHKAN ===================
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
        // | ! NOTE:
        // | Urutan proses harusnya sih siapin transaksi, invoice, invoice item. (UPDATE: product_mutation, material_mutation, material_inventory, kas)
        // | Kemudian masukin ke tabel masing2 menggunakan konsep TRANSACTION dari MYSQL
        // ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

        // inisiasi nama tabel yg digunakan, lokal hanya untuk method ini
        $tb_transaction         = 'transaction';
        $tb_invoice             = 'invoice';
        $tb_invoice_item        = 'invoice_item';
        $tb_product_mutation    = 'product_mutation';
        $tb_material_mutation   = 'material_mutation';
        $tb_material_inventory  = 'material_inventory';
        $tb_kas                 = 'kas';

        $this->db->trans_start(TRUE);

        // set waktu awal untuk method ini
        $now          = now();
        $createdAt    = unix_to_human($now, true, 'europe');

        
        // ============================================================ [1] MULAI SIAPKAN DATA-DATA UNTUK TRANSACTION ===================


        $transNumber  = $this->__generate_new_trx_number($now);
        $nextDue      = 86400 * 7; // tambah 7 hari
        $dueAt        = $this->__generate_new_due_at($now, $nextDue);

        $data_transaction  = [
            'trans_number'  => $transNumber,
            'deliv_address' => $data['deliv_address'],
            'price_total'   => $data['total_harga'], 
            'store_id'      => $data['store_id'],
            'customer_id'   => $data['data_customer']['id'],
            'employee_id'   => $data['employee_id'],
            'due_at'        => $dueAt,
            'created_at'    => $createdAt,
        ];

        $isTransactionSuccess = $this->db->insert($tb_transaction, $data_transaction);
        $lastTrxId            = $this->db->insert_id();


        // ============================================================ SELESAI PERSIAPAN DATA TRANSACTION ===================
        // ============================================================ [2] MULAI SIAPKAN DATA-DATA UNTUK INVOICE ===================


        $invoiceNumber = $this->__generate_new_invoice_number($now, $data['data_customer']['cust_type']);

        $leftToPaid = $data['total_harga'] - $data['paid_amount'];

        $data_invoice = [
            'invoice_number'    => $invoiceNumber,
            'paid_amount'       => $data['paid_amount'],
            'left_to_paid'      => $leftToPaid,
            'paid_at'           => $createdAt,
            'transaction_id'    => $lastTrxId, 
            'created_at'        => $createdAt,
            'status'            => '0',
        ];

        $isInvoiceSuccess = $this->db->insert($tb_invoice, $data_invoice);
        $lastInvoiceId    = $this->db->insert_id();


        // ============================================================ SELESAI PERSIAPAN DATA INVOICE ===================
        // ============================================================ [3] MULAI SIAPKAN DATA-DATA UNTUK INVOICE ITEM ===================


        $data_invoice_item = $data['data_product'];

        $container = [];
        foreach ($data['data_product'] as $row) {
            $x['quantity']   = $row['kasir_qty'];
            $x['item_price'] = $row['kasir_total_per_item'];
            $x['invoice_id'] = $lastInvoiceId;
            $x['product_id'] = $row['id'];
            $container[] = $x;
        }
        $data_invoice_item = $container;

        $isInvoiceItemSuccess = $this->db->insert_batch($tb_invoice_item, $data_invoice_item);


        // ============================================================ SELESAI PERSIAPAN DATA INVOICE ITEM ===================
        // ============================================================ [4] MULAI SIAPKAN DATA-DATA UNTUK MUTASI PRODUK ===================


        // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
        // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn
        
        $arr = [
            'item_type' => 'product', // PRO=Product ; MAT=Material ;
            'mutation_type' => 'keluar', // KEL=Keluar ; MSK=Masuk ;
        ];
        $productMutationCode = $this->__generate_new_mutation_code($now, $arr);

        $container = [];
        $i = 0;
        foreach ($data['data_product'] as $row) 
        {
            // pecah mutation code yang asli, untuk dilooping increment 1 si nomor depannya
            $__exploded     = explode('/', $productMutationCode);
            $__exploded[0]  = $__exploded[0] + $i;
            $__exploded[0]  = str_pad($__exploded[0], 6, "0", STR_PAD_LEFT);
            // gabungin lagi yang udah dipecah dan diincrement 1
            $__productMutationCode = implode('/', $__exploded);

            $data_product_mutation = [
                'product_id'    => $row['id'],
                'store_id'      => $data['store_id'],
                'mutation_code' => $__productMutationCode,
                'quantity'      => $row['kasir_qty'],
                'mutation_type' => $arr['mutation_type'],
                'created_at'    => $createdAt,
                'created_by'    => $data['username'],
            ];
            $container[] = $data_product_mutation;
            $i++;
        }
        $data_product_mutation = $container;

        $isProductMutationSuccess = $this->db->insert_batch($tb_product_mutation, $data_product_mutation);
        

        // ============================================================ SELESAI PERSIAPAN DATA MUTASI PRODUK ===================
        // ============================================================ [5] MULAI SIAPKAN DATA-DATA UNTUK MUTASI MATERIAL ===================
        
        
        // +++++ FORMAT KODE MUTASI : no_urut/(P/M)/K/%d/%m/%Y
        // +++++ 000001 / (PRO=Product ; MAT=Material ;) / (KEL=Keluar ; MSK=Masuk ;) / tgl / bln / thn
        $arr = [
            'item_type' => 'material', // PRO=Product ; MAT=Material ;
            'mutation_type' => 'keluar', // KEL=Keluar ; MSK=Masuk ;
        ];
        $materialMutationCode = $this->__generate_new_mutation_code($now, $arr);
        
        // get seluruh material dari seluruh produk id yang di cekout
        // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
        // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
        // contoh  ==>  id=1 OR id=9 OR id=13
        $productQuery = '';
        foreach ($data['data_product'] as $__product) {
            // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
            if ($productQuery !== '') $productQuery .= " OR ";
            $productQuery .= "product_id={$__product['id']}";
        }
        // get data dari db dengan klausa where di atas
        $data['product_composition'] = $this->__get_by_where($productQuery, 'id, volume, product_id, material_id');
        
        $container = [];
        foreach ($data['data_product'] as $__prod)
        {
            foreach ($data['product_composition'] as $__pc) 
            {
                if ($__prod['id'] == $__pc['product_id'])
                {
                    $temp['product_id']    = $__prod['id'];
                    $temp['material_id']   = $__pc['material_id'];
                    $temp['mutation_qty']  = $__prod['kasir_qty'] * $__pc['volume'];
                    $container[] = $temp;
                    // break;
                }
            }
        }
        // variabel untuk digunakan di sub-bab material mutation
        $data_material_mutation  = $container;
        // variabel untuk digunakan di sub-bab material inventory, biar gaproses 2kali, jadi cukup di sini
        $data_material_inventory = $container;

        $container = [];
        $i = 0;
        foreach ($data_material_mutation as $row) 
        {
            // pecah mutation code yang asli, untuk dilooping increment 1 si nomor depannya
            $__exploded     = explode('/', $materialMutationCode);
            $__exploded[0]  = $__exploded[0] + $i;
            $__exploded[0]  = str_pad($__exploded[0], 6, "0", STR_PAD_LEFT);
            // gabungin lagi yang udah dipecah dan diincrement 1
            $__materialMutationCode = implode('/', $__exploded);
            
            $data_material_mutation = [
                'material_id'   => $row['material_id'],
                'store_id'      => $data['store_id'],
                'mutation_code' => $__materialMutationCode,
                'quantity'      => $row['mutation_qty'],
                'mutation_type' => $arr['mutation_type'],
                'created_at'    => $createdAt,
                'created_by'    => $data['username'],
            ];
            $container[] = $data_material_mutation;
            $i++;
        }
        $data_material_mutation = $container;

        $isMaterialMutationSuccess = $this->db->insert_batch($tb_material_mutation, $data_material_mutation);

        
        // ============================================================ SELESAI PERSIAPAN DATA MUTASI MATERIAL ===================
        // ============================================================ [6] MULAI SIAPKAN DATA-DATA UNTUK INVENTORY MATERIAL ===================

        
        $container = [];
        $i = 0;
        foreach ($data_material_inventory as $row) 
        {            
            $data_material_inventory = [
                'material_id'   => $row['material_id'],
                'store_id'      => $data['store_id'],
                'quantity'      => $row['mutation_qty'],
                'updated_at'    => $createdAt,
                'updated_by'    => $data['username'],
            ];
            $container[] = $data_material_inventory;
            $i++;

            $this->db->from($tb_material_inventory);
            $this->db->set("quantity", "quantity - {$row['mutation_qty']}", FALSE);
            $this->db->set("updated_at", "{$createdAt}");
            $this->db->set("updated_by", "{$data['username']}");
            $this->db->where('material_id', "{$row['material_id']}");
            $this->db->where('store_id', "{$data['store_id']}");
            $this->db->update();
        }
        $data_material_inventory = $container;

        // ! KERJAIN INI - 13/12/20 - 17.00 udah beres harusnya dua line di bawah nanti dihapus kalo udh gada bug selama bbrp waktu
        // pprintd($data_material_inventory);
        // $isMaterialInventorySuccess = $this->db->insert_batch($tb_material_inventory, $data_material_inventory);

        
        // ============================================================ SELESAI PERSIAPAN DATA INVENTORY MATERIAL ===================
        // ============================================================ [7] MULAI SIAPKAN DATA-DATA UNTUK KAS ===================


        // load model kas untuk update kas di cekout
        $this->load->model('Kas_model', 'kas_m');

        $leftToPaid = $data['total_harga'] - $data['paid_amount'];

        $data_kas = [
            'add-type'       => 'debet',
            'add-nominal'    => $data['paid_amount'],
            'add-perihal'    => "Checkout: INV {$invoiceNumber}",
            'add-keterangan' => "Total harga:{$data['total_harga']} ; Total bayar:{$data['paid_amount']} ; Sisa harus dibayar:{$leftToPaid} ; Oleh:{$data['username']}",
            'add-date'       => $createdAt,
            'created_by'     => $data['username'],
        ];
        
        $isKasSuccess = $this->kas_m->set_new_kas($data_kas);
        

        // ============================================================ SELESAI PERSIAPAN DATA KAS ===================
        // ============================================================ [8] MULAI VALIDASI DAN COMPLETE KEMBALI KE CONTROLLER ===================


        $this->db->trans_complete();

        $returnVal = [
            'invoice_id'        => $lastInvoiceId,
            'invoice_number'    => $invoiceNumber,
            'due_at'            => $dueAt,
        ];
        // return ($this->db->trans_status() === FALSE) ? FALSE : 1;
        if ($this->db->trans_status() === FALSE)
        {
            return FALSE;
        }
        else
        {
            return $returnVal;
        }



    }






}
