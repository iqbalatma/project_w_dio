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
            'content'           => 'v_kasir.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer' => $this->Customer_model->get_all(),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            'data_product' => $this->Product_model->get_all2(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert()
    {





        $createdAt = unix_to_human(now(), true, 'europe');

        $employee_id = $_SESSION['id'];
        $checkbox_value = $this->input->post('product');






        // BEGIN PROSES INSERT DATA TRANSAKSI


        $price_total = 0;
        $store_id = $_SESSION['store_id'];
        $customer_id = $this->input->post('nama_pelanggan');
        $data_customer = $this->Kasir_model->get_customer($customer_id);
        $customer_type = $data_customer['cust_type'];

        if ($customer_type == "retail") {
            $customer_type = "KS";
        } else {
            $customer_type = "AR";
        }

        $due_at = unix_to_human(now() + (86400 * 7), true, 'europe');
        $trans_number = 'TRANS-' . date("m.d.y") . now(); //primary_key pada tabel transaksi format menyesuaikan
        $address = $this->input->post('alamat_pelanggan');
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


            $invoice1 = "NO. " . "1/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
            // echo $invoice1;

            // echo "bangsat";
        } elseif ($is_there_number_invoice2) { //invoice pada hari itu ada

            // var_dump($is_there_number_invoice2);
            $invoice_number =  $is_there_number_invoice2['invoice_number'];
            // $invoice_sebelumnya = $is_there_number_invoice2['invoice_number'];
            $invoice_sebelumnya = explode("/", $invoice_number);
            $invoice_sebelumnya = $invoice_sebelumnya[0];
            $invoice_sebelumnya = explode(" ", $invoice_sebelumnya);
            $invoice_sebelumnya = $invoice_sebelumnya[1];
            $nomor_invoice_sekarang = $invoice_sebelumnya + 1;
            $invoice1 = "NO. " . "$nomor_invoice_sekarang/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
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
            'is_deleted' => 0

        ];
        $insert2 = $this->Kasir_model->insert_invoice($data_invoice);




        // BEGIN PROSES INSERT INVOICE ITEM
        $i = 0;
        $item_price_total = 0;
        $quantity = $this->input->post('quantity');

        $custom_harga = $this->input->post('custom_harga');

        // untuk mengambil data id terbaru yang di insert diatas karena auto increament
        // setelah id didapat maka lakukan insert pada invoice item, dilakukan berulang ulang sesuai dengan jumlah produk yang dimasukkan
        var_dump($custom_harga);
        // var_dump($quantity);



        // var_dump($quantity);
        // echo "<br>";
        // var_dump($checkbox_value);
        $data_id_invoice_terakhir = $this->Kasir_model->cek_id_invoice_terakhir();
        $data_id_invoice_terakhir = $data_id_invoice_terakhir['id'];
        // BEGIN PERULANGAN UNTUK BANYAK PRODUK YANG MASUK
        foreach ($checkbox_value as $id_product) {


            // echo $quantity[$id_product];


            // untuk mengambil harga dari produk berdasarkan id yang dipilih
            // $id_product pada view valuenya diambil dari id pada tabel data product jadi tidak perlu khawatir akan missmatch data
            $price = $this->Product_model->get_by_id($id_product);

            $price_per_produk = $price->price_base;



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
                $b = false;
            } elseif ($cek_harga_custom && $b) {
                $price_per_produk = $cek_harga_custom[0]['price'];
            }
            echo $price_per_produk;
            //setelah price diambil maka simpan pada array data
            // PENTING, index quantity adalah id_product - 1 karena value dan indexnya tidak sesuai
            $data_invoice_item = [
                'id' => '',
                'quantity' => $quantity[$id_product],
                'item_price' => $price_per_produk * $quantity[$id_product],
                'invoice_id' => $data_id_invoice_terakhir,
                'product_id' => $id_product
            ];

            $insert3 = $this->Kasir_model->insert_invoice_item($data_invoice_item); //kemudian masukkan data invoice kedalam tabel



            // setelah data invoice masing-masing item ada, maka kita dapat menghitung harga totalnya dengan menjumlahkan
            $item_price_total +=  $price_per_produk * $quantity[$id_product];


            // product_mutation akan menghasilkan history barang yang keluar dari store mana, produk apa, serta siapa yang melakukan

            // $mutation_code = $invoice . rand(10, 100); //Masih data dummy 
            $mutation_code = "MUTATION-" . date('Y-m-d h:i:sa') . rand(10, 1000);
            $data_product_mutation = [
                'id' => '',
                'product_id' =>  $id_product,
                'store_id' => $store_id,
                'mutation_code' => $mutation_code,
                'quantity' => $quantity[$id_product],
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
                $quantity_material = $quantity[$id_product] * $volume;
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
            'price_total' => $item_price_total
        ];
        $update_price_total5 = $this->Kasir_model->update_total_price($data_update);

        $left_to_paid = $paid_amount - $item_price_total;
        if ($left_to_paid >= 0) {
            $left_to_paid = 0;
        }
        $data_update_invoice = [
            'id' => $data_id_invoice_terakhir,
            'left_to_paid' => $left_to_paid
        ];
        $update_left_to_paid = $this->Kasir_model->update_left_to_paid($data_update_invoice);

        // echo "insert 1 " .  $insert1;
        // echo "<br>";
        // echo "insert 2 " . $insert2;
        // echo "<br>";
        // echo "insert 3 " . $insert3;
        // echo "<br>";
        // echo "insert 4 " . $insert4;
        // echo "<br>";
        // echo "insert 5 " . $update_price_total5;
        // echo "<br>";
        // echo "insert 6 " . $update_left_to_paid;
        // echo "<br>";

        if ($insert1 == 1 && $insert2 == 1 && $insert3 == 1 && $insert4 == 1 && $update_price_total5 == 1 && $update_left_to_paid == 1) {
            echo "input berhasil";
            $this->session->set_flashdata('message_berhasil', 'Berhasil checkout product');
            redirect(base_url('Kasir'));
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



    //    TODO LIST :  custom harga

    // DONE : CUSTOMER TYPE ON INVOICE, CUSTOM ALAMAT , UPDATE QUANTITY,INVOICE BY MONTH, VIEW KASIR BASE ON STORE, 

}
