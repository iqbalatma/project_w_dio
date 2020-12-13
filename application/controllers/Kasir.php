<?php


class Kasir extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Customer_model");
        $this->load->model("Kasir_model");
        $this->load->model("Product_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Kasir',
            'content'           => 'kasir/v_kasir.php',
            'menuActive'        => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer' => $this->Customer_model->get_all(),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            'data_product' => $this->Product_model->get_all2(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert_dio()
    {
        // // cek apakah tombol cekout ditekan tanpa memilih satupun produk
        // if ( ! isset($post['product']) )
        // {
        //     // flashdata untuk sweetalert
        //     $this->session->set_flashdata('failed_message', 1);
        //     $this->session->set_flashdata('title', "Pembelanjaan kosong!");
        //     $this->session->set_flashdata('text', 'Mohon cek kembali sesi belanja anda.');
        //     redirect(base_url( getBeforeLastSegment($this->modules) ));
        // }

        $this->session->keep_flashdata('dari_konfirmasi_kasir');
        $cekoutData = $this->session->dari_konfirmasi_kasir;
        
        $post                       = $this->input->post();
        $cekoutData['paid_amount']  = $post['paid_amount'];
        $cekoutData['total_harga']  = $post['total_harga'];
        $kembalian                  = ($post['paid_amount'] - $post['total_harga']) * (-1);

        // seluruh proses checkout, termasuk interaksi dengan 7 tabel di database, return array yg (hanya) berisi invoice id dan nomor invoice terbaru
        $query = $this->Kasir_model->set_new_checkout($cekoutData);
        $query['paid_amount'] = $post['paid_amount'];
        $query['total_harga'] = $post['total_harga'];

        $this->session->set_flashdata('dari_insert_dio', $query);

        if ($query !== FALSE) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('success_message', 1);
            $this->session->set_flashdata('title', "Pembelian sukses!");
            $this->session->set_flashdata('text', 'Invoice juga udah siap!');
            redirect(base_url('kasir/kembalian-kasir/' . $query['invoice_id'] . "/" . $kembalian));
    
          }else {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelian gagal!");
            $this->session->set_flashdata('text', 'Mohon hubungi administrator segera. kode: (C/K/ID)');
            redirect(current_url('kasir'));
          } // end if($query): success or failed
        die;
    }

    public function insert()
    {
        
        $createdAt = unix_to_human(now(), true, 'europe');
        
        $employee_id = $_SESSION['id'];
        $checkbox_value = $this->input->post('checkbox_value');
        
        // BEGIN PROSES INSERT DATA TRANSAKSI
        
        $price_total = 0;
        $store_id = $_SESSION['store_id'];
        $customer_id = $this->input->post('customer_id');
        $data_customer = $this->Kasir_model->get_customer($customer_id);
        $customer_type = $data_customer['cust_type'];
        
        if ($customer_type == "retail") {
            $customer_type = "KS";
        } else {
            $customer_type = "AR";
        }
        // pprintd($this->input->post());
        
        $due_at = unix_to_human(now() + (86400 * 7), true, 'europe');
        $trans_number = 'TRANS-' . date("m.d.y") . now(); //primary_key pada tabel transaksi format menyesuaikan
        $address = $this->input->post('address');
        $data_transaction = [
            'trans_number' => $trans_number,     //
            'deliv_address' => $address,
            'price_total' => $price_total, // price total di kosongkan dulu karena item belum masuk, setelah item masuk di di iterasi barulah di hitung total_price untuk diupdate
            'store_id' => $store_id,
            'customer_id' => $customer_id,
            'employee_id' => $employee_id,
            'due_at' => $due_at,
            'created_at' => $createdAt,
            'is_deleted' => 0
        ];
        pprintd($data_transaction);
        $insert1 = $this->Kasir_model->insert_transaction($data_transaction);

        // // END PROSES INSERT DATA TRANSAKSI
        $invoice_id = $this->Kasir_model->get_row_terbaru();
        $invoice_id = $invoice_id['id']; //id_transaksi
        $tanggal = unix_to_human(now(), true, 'europe');
        $tanggal = explode(" ", $tanggal);
        $tanggal = $tanggal[0];


        $is_there_number_invoice = $this->Kasir_model->cek_number_invoice($tanggal);
        $is_there_number_invoice2 = $this->Kasir_model->cek_invoice_terakhir($tanggal);


        $tanggal = explode("-", $tanggal);
        // INVOICE NUMBER PERBULAN


        if ($is_there_number_invoice) { //saat nomor pada hari pertama tidak ada


            $invoice1 = "1/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
            // echo $invoice1;

            // echo "bangsat";
        } elseif ($is_there_number_invoice2) { //invoice pada hari itu ada

            // var_dump($is_there_number_invoice2);
            $invoice_number =  $is_there_number_invoice2['invoice_number'];
            // $invoice_sebelumnya = $is_there_number_invoice2['invoice_number'];
            // $invoice_sebelumnya = explode("/", $invoice_number);
            // $invoice_sebelumnya = $invoice_sebelumnya[0];
            // $invoice_sebelumnya = explode(" ", $invoice_sebelumnya);
            $invoice_number = explode("/", $invoice_number);
            $invoice_sebelumnya = $invoice_number[0];
            $nomor_invoice_sekarang = $invoice_sebelumnya + 1;
            $invoice1 = "$nomor_invoice_sekarang/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
        }



        $paid_amount = $this->input->post('paid_amount'); //yang dibayarkan oleh pembeli
        // sisa yang harus dibayar (lunas atau tidak)


        $data_invoice = [
            'id' => '',
            'invoice_number' => $invoice1,
            'paid_amount' => $paid_amount,
            'left_to_paid' => 0,
            // 'paid_at' => '',
            'transaction_id' => $invoice_id, //invoice id adalah data row terbaru yang masuk dalam database atau data yang sedang diolah sekarang

            'created_at' => $createdAt,
            'is_deleted' => 0,
            'status' => 0,

        ];
        $insert2 = $this->Kasir_model->insert_invoice($data_invoice);


        // BEGIN PROSES INSERT INVOICE ITEM
        $i = 0;
        $item_price_total = 0;
        // $quantity = $this->input->post('quantity');

        $custom_harga = $this->input->post('custom_harga');
        var_dump($custom_harga);
        // untuk mengambil data id terbaru yang di insert diatas karena auto increament
        // setelah id didapat maka lakukan insert pada invoice item, dilakukan berulang ulang sesuai dengan jumlah produk yang dimasukkan
        // var_dump($custom_harga);
        // var_dump($quantity);



        // var_dump($quantity);
        // echo "<br>";
        // var_dump($checkbox_value);
        $data_id_invoice_terakhir = $this->Kasir_model->cek_id_invoice_terakhir();
        $data_id_invoice_terakhir = $data_id_invoice_terakhir['id'];
        // BEGIN PERULANGAN UNTUK BANYAK PRODUK YANG MASUK
        foreach ($checkbox_value as $id_product) {


            // echo $this->input->("quantity[".$id_product."]");


            // untuk mengambil harga dari produk berdasarkan id yang dipilih
            // $id_product pada view valuenya diambil dari id pada tabel data product jadi tidak perlu khawatir akan missmatch data
            $price = $this->Product_model->get_by_id($id_product);

            $price_per_produk = $price->selling_price;



            $cek_code_product = $this->Kasir_model->get_code_product($id_product);
            // echo "<br>";
            // var_dump($cek_code_product);
            $cek_code_product = $cek_code_product[0]['product_code'];
            $data_cek_harga_custom = [
                'code_product' => $cek_code_product,
                'id_customer' => $customer_id
            ];
            $cek_harga_custom = $this->Kasir_model->cek_harga_custom($data_cek_harga_custom);
            $b = true;
            if ($custom_harga[$id_product] !== "") {
                $price_per_produk = $custom_harga[$id_product];
                // $b = false;
            } elseif ($cek_harga_custom && $b) {
                $price_per_produk = $cek_harga_custom[0]['price'];
            }

            //setelah price diambil maka simpan pada array data
            // PENTING, index quantity adalah id_product - 1 karena value dan indexnya tidak sesuai
            $data_invoice_item = [
                'id' => '',
                'quantity' => $this->input->post("quantity[" . $id_product . "]"),
                'item_price' => $price_per_produk * $this->input->post("quantity[" . $id_product . "]"),
                'invoice_id' => $data_id_invoice_terakhir,
                'product_id' => $id_product
            ];

            $insert3 = $this->Kasir_model->insert_invoice_item($data_invoice_item); //kemudian masukkan data invoice kedalam tabel



            // setelah data invoice masing-masing item ada, maka kita dapat menghitung harga totalnya dengan menjumlahkan
            $item_price_total +=  $price_per_produk * $this->input->post("quantity[" . $id_product . "]");


            // product_mutation akan menghasilkan history barang yang keluar dari store mana, produk apa, serta siapa yang melakukan

            // $mutation_code = $invoice . rand(10, 100); //Masih data dummy 
            $mutation_code = "MUTATION-" . date('Y-m-d h:i:sa') . rand(10, 1000);
            $data_product_mutation = [
                'id' => '',
                'product_id' =>  $id_product,
                'store_id' => $store_id,
                'mutation_code' => $mutation_code,
                'quantity' => $this->input->post("quantity[" . $id_product . "]"),
                'mutation_type' => 'keluar',
                'created_by' => $_SESSION['username'],
                'is_deleted' => 0,
            ];
            $insert4 = $this->Kasir_model->insert_product_mutation($data_product_mutation);


            //setelah data di insert pada produk mutasi, kita juga harus mengupdate kuantitas barang yang kita keluarkan yaitu dengan mengirimkan id produk yang keluar serta kuantitas produk yang keluar

            // UPDATE QUANTITIY LOGICNYA DISINI

            // cari tahu komposisi pada suatu produk
            $komposisi = $this->Kasir_model->cek_komposisi($id_product);
            foreach ($komposisi as $data) {
                $material_id = $data['material_id'];
                $volume = $data['volume'];
                $quantity_material = $this->input->post("quantity[" . $id_product . "]") * $volume;
                $data = [
                    'material_id' => $material_id,
                    'quantity_material' => $quantity_material,
                    'store_id' => $store_id
                ];
                // query update material
                $xct = $this->Kasir_model->update_quantity_material($data);


                // INSERT PRODUCT MUTATION
                $data = [
                    'id' => '',
                    'material_id' => $material_id,
                    'store_id' => $store_id,
                    'mutation_code' => 'MUTATION-MATERIAL-' . date("Y-m-d") . rand(10, 1000),
                    'quantity' => $quantity_material,
                    'mutation_type' => 'keluar',
                    'created_by' => $_SESSION['username'],
                    'is_deleted' => 0
                ];

                $this->Kasir_model->insert_material_mutation($data);
            }
            $i++;
        }

        // END PERULANGAN UNTUK BANYAK PRODUK YANG MASUK



        // price total pada transaction hanya bisa di update jika invoice_item sudah masuk semua, tapi invoice item hanya bisa masuk jika row transaksi sudah dibuat, berarti memang harus melakukan insert transaksi kemudian price totalnya nanti akan di update setelah invoice item masuk semua
        $data_update = [
            // data transaksi di update oleh total price
            // update price total berdasarkan item yang sudah ditambahkan
            'id' => $invoice_id,
            'price_total' => $this->input->post('harga_total'),
        ];
        $update_price_total5 = $this->Kasir_model->update_total_price($data_update);



        $left_to_paid =    intval($item_price_total) - intval($paid_amount);
        $kembalian = 0;
        if ($left_to_paid <= 0) {
            // $left_to_paid = 0;
            $kembalian = $left_to_paid * (-1);
        }
        $data_update_invoice = [
            'id' => $data_id_invoice_terakhir,
            'left_to_paid' => $left_to_paid
        ];
        $update_left_to_paid = $this->Kasir_model->update_left_to_paid($data_update_invoice);
        // echo "<br>";
        // echo $left_to_paid;



        // echo $kembalian;

        if ($insert1 == 1 && $insert2 == 1 && $insert3 == 1 && $insert4 == 1 && $update_price_total5 == 1 && $update_left_to_paid == 1) {
            echo "input berhasil";
            $this->session->set_flashdata('message_berhasil', 'Berhasil checkout product. Kembalian Rp. ' . $kembalian);
            // redirect(base_url('generate-report/invoice/generate/' . $data_id_invoice_terakhir));
            redirect(base_url('Kasir/kembalian_kasir/' . $data_id_invoice_terakhir . "/" . $kembalian));
        } else {
            echo "input gagal";
            $this->session->set_flashdata('message_gagal', 'Gagal checkout product');
            redirect(base_url('Kasir'));
        }
    }

    public function get_ajax()
    {
        $this->Kasir_mode->get_ajax();
    }

    public function konfirmasi_kasir()
    {
        // $startTime = round(microtime(true) * 1000);
        $post = $this->input->post();

        // cek apakah tombol cekout ditekan tanpa memilih satupun produk
        if ( ! isset($post['product']) )
        {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelanjaan kosong!");
            $this->session->set_flashdata('text', 'Mohon cek kembali sesi belanja anda.');
            redirect(base_url( getBeforeLastSegment($this->modules) ));
        }
        // pprintd($post);
        
        // sort array quantity produk dari kecil ke terbesar ambil indek pertama dan terakhir, kemudian cek
        // jika
        $__qty   = $post['quantity'];
        // sort($__qty);
        // $isZero    = $__qty[0];
        // $notZero = end($__qty);
        $isZero = array_search(0, $__qty);
        // cek apakah array pertama yg udh disort bernilai 0, jika iya keluar karena ada produk yg qty == 0
        if ( $isZero !== FALSE )
        {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Cek kuantitas produk!");
            $this->session->set_flashdata('text', 'Kuantitas produk belum dipilih.');
            redirect(base_url( getBeforeLastSegment($this->modules) ));
        }
        // pprintd($post);

        $checkbox_value     = $this->input->post('product');
        $customer_id        = $this->input->post('nama_pelanggan');
        $address            = $this->input->post('alamat_pelanggan');
        $quantity           = $this->input->post('quantity');
        $custom_harga       = $this->input->post('custom_harga');

        // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
        // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
        // contoh  ==>  id=1 OR id=9 OR id=13
        $productQuery = '';
        foreach ($checkbox_value as $row) {
            // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
            if ($productQuery !== '') $productQuery .= " OR ";
            $productQuery .= "id={$row}";
        }
        // pprintd($productQuery);

        // var_dump($checkbox_value);
        // echo "<br>";
        // var_dump($customer_id);
        // echo "<br>";
        // var_dump($address);
        // echo "<br>";
        // var_dump($paid_amount);
        // echo "<br>";
        // var_dump($quantity);
        // echo "<br>";
        // var_dump($custom_harga);
        // echo "<br>";
        // pprintd($this->input->post());

        // get data dari db yg dibutuhkan, dari tabel customer dan produk yg relevan dengan environment ketika cekout
        $data_customer  = $this->Customer_model->get_by_id($customer_id, 'id, full_name, address, phone, cust_type');
        $data_product   = $this->Product_model->get_by_where($productQuery, 'id, product_code, full_name, image, selling_price');
        // pprintd($data_product);

        // inisiasi $container untuk menyimpan hasil iterasi di bawah
        $container      = [];

        // MULAI : cek custom harga dari inputan dengan key dari id produk
        // untuk mengolah harga custom per produk di cekout
        foreach ($data_product as $row) 
        {
            // jika ada harga custom = set custom_price, dan jika tidak ada set selling_price
            if ($custom_harga[$row['id']]) {
                $row['kasir_price'] = $custom_harga[$row['id']];
            } else {
                $row['kasir_price'] = $row['selling_price'];
            }
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;
        
        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk quantity ketika cekout
        $container = [];
        foreach ($data_product as $row) 
        {
            // jika ada harga custom = set custom_price, dan jika tidak ada set selling_price
            if ($quantity[$row['id']]) {
                $row['kasir_qty'] = $quantity[$row['id']];
            } else {
                $row['kasir_qty'] = 0;
            }
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk total harga per item
        $container = [];
        foreach ($data_product as $row) {
            $row['kasir_total_per_item'] = $row['kasir_price'] * $row['kasir_qty'];
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        $data = [
            'title'             => 'Kasir',
            'content'           => 'kasir/v_konfirmasi_kasir.php',
            'menuActive'        => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer'     => $data_customer,
            'data_product'      => $data_product,
            'checkbox_value' => $checkbox_value,
            // 'customer_id' => $customer_id,
            'address'           => $address,
            // 'quantity'          => $quantity,
            // 'custom_harga'      => $custom_harga,
            'datatables'        => 1
        ];

        $sessionTest['data_customer']   = (array)$data['data_customer'];
        $sessionTest['data_product']    = $data['data_product'];
        $sessionTest['deliv_address']   = $data['address'];
        $sessionTest['store_id']        = $_SESSION['store_id'];
        $sessionTest['employee_id']     = $_SESSION['id'];
        $sessionTest['username']        = $_SESSION['username'];
        $this->session->set_flashdata('dari_konfirmasi_kasir', $sessionTest);
        // pprintd($post);


        // $endTime     = round(microtime(true) * 1000);
        // $elapsedTime = ($endTime - $startTime);
        // echo '<script>';
        // echo "console.log('Elapsed time : {$elapsedTime} miliseconds')";
        // echo '</script>';


        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function kembalian_kasir($id_invoice, $kembalian)
    {
        $this->session->keep_flashdata('dari_insert_dio');

        $data = [
            'title'             => 'Kasir',
            'content'           => 'kasir/v_kembalian.php',
            'menuActive'        => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_customer' => $this->Customer_model->get_all(),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            // 'data_product' => $this->Product_model->get_all2(),
            'datatables' => 1,
            'id_invoice' => $id_invoice,
            'kembalian' => $kembalian,
            
            'cekout' => $this->session->dari_insert_dio,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function test()
    {
        echo $x = $this->input->post('a');
        var_dump($this->input->post('checkbox_value'));
        var_dump($this->input->post('custom_harga'));
    }





    //    TODO LIST :  custom harga

    // DONE : CUSTOMER TYPE ON INVOICE, CUSTOM ALAMAT , UPDATE QUANTITY,INVOICE BY MONTH, VIEW KASIR BASE ON STORE, 

}
