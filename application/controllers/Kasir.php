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
            'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert()
    {

        // Logic Tabel dan Alur data
        // pertama tama lakukan pencatatan pada tabel transaksi
        // kemudian transaksi di acu oleh invoice item yang mana dapat terdapat banyak item dalam satu transaksi
        // item tersebut datanya memiliki id produk yang mana akan di didapat dari tabel produk
        // produk yang keluar akan tercatat didalam product_mutation
        // kemudian yang terakhir adalah transaksi tersebut akan masuk kedalam tabel invoice


        // PENTING ALUR TABEL
        // Transaction->invoice_item[i]->invoice->
        // item price dari quantitas dikali harga
        // produk harus tau di gudang mana dan kuantitasnya berapa
        // harus melakukan update pada kuantitas produk


        $date = new DateTime();
        $createdAt = unix_to_human(now(), true, 'europe');

        // $invoice = 'INV' . $_SESSION['store_id'] . $date->format('m');

        $invoice = rand(10, 1000000);
        $price_total = 40000;
        $invoice_payment_id = '';

        $employee_id = $_SESSION['id'];
        $checkbox_value = $this->input->post('product');






        // BEGIN PROSES INSERT DATA TRANSAKSI


        // format trans_number = TRANS-

        $price_total = 0;
        $store_id = $_SESSION['store_id'];
        $customer_id = $this->input->post('nama_pelanggan');
        $data_customer = $this->Kasir_model->get_customer($customer_id);
        $customer_type = $data_customer['cust_type'];
        // var_dump($data_customer);
        $due_at = unix_to_human(now() + (86400 * 7), true, 'europe');
        $trans_number = 'TRANS-' . date("m.d.y") . now(); //primary_key pada tabel transaksi format menyesuaikan
        $data_transaction = [
            'trans_number' => $trans_number,     //
            'price_total' => $price_total, // price total di kosongkan dulu karena item belum masuk, setelah item masuk di di iterasi barulah di hitung total_price untuk diupdate
            'store_id' => $store_id,
            'customer_id' => $customer_id,
            'due_at' => $due_at,
            'created_at' => $createdAt,
            'is_deleted' => 0
        ];
        $insert = $this->Kasir_model->insert_transaction($data_transaction);

        // END PROSES INSERT DATA TRANSAKSI






        // BEGIN PROSES INSERT INVOICE ITEM
        $i = 0;
        $item_price_total = 0;
        $quantity = $this->input->post('quantity');

        // untuk mengambil data id terbaru yang di insert diatas karena auto increament
        // setelah id didapat maka lakukan insert pada invoice item, dilakukan berulang ulang sesuai dengan jumlah produk yang dimasukkan
        $invoice_id = $this->Kasir_model->get_row_terbaru();
        $invoice_id = $invoice_id['id'];


        // var_dump($quantity);
        // echo "<br>";
        // var_dump($checkbox_value);

        // BEGIN PERULANGAN UNTUK BANYAK PRODUK YANG MASUK
        foreach ($checkbox_value as $id_product) {

            // echo $id_product;
            // // echo "<br>";
            // echo $quantity[$id_product];


            // untuk mengambil harga dari produk berdasarkan id yang dipilih
            // $id_product pada view valuenya diambil dari id pada tabel data product jadi tidak perlu khawatir akan missmatch data
            $price = $this->Product_model->get_by_id($id_product);


            //setelah price diambil maka simpan pada array data
            // PENTING, index quantity adalah id_product - 1 karena value dan indexnya tidak sesuai
            $data_invoice_item = [
                'id' => '',
                'quantity' => $quantity[$id_product],
                'item_price' => $price->price_base,
                'invoice_id' => $invoice_id,
                'product_id' => $id_product
            ];
            $insert = $this->Kasir_model->insert_invoice_item($data_invoice_item); //kemudian masukkan data invoice kedalam tabel



            // setelah data invoice masing-masing item ada, maka kita dapat menghitung harga totalnya dengan menjumlahkan
            $item_price_total +=  $price->price_base;


            // product_mutation akan menghasilkan history barang yang keluar dari store mana, produk apa, serta siapa yang melakukan

            // $mutation_code = $invoice . rand(10, 100); //Masih data dummy 
            $mutation_code = "MUTATION-" . date('Y-m-d h:i:sa');
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
            $insert = $this->Kasir_model->insert_product_mutation($data_product_mutation);


            //setelah data di insert pada produk mutasi, kita juga harus mengupdate kuantitas barang yang kita keluarkan yaitu dengan mengirimkan id produk yang keluar serta kuantitas produk yang keluar
            $data_update_inventory_product = [
                'id' => $id_product,
                'quantity' => $quantity[$id_product],
                'store_id' => $_SESSION['store_id']
            ];
            var_dump($data_update_inventory_product);
            $update = $this->Kasir_model->update_quantity_inventory_product($data_update_inventory_product);
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
        $update_price_total = $this->Kasir_model->update_total_price($data_update);

        //INVOICE FORMAT NO. 49/AR/03/2020

        // echo date('Y');
        $tanggal = date('Y-m-d');
        $tanggal2 = date('Y-m-d');

        $is_there_number_invoice = $this->Kasir_model->cek_number_invoice($tanggal);
        $is_there_number_invoice2 = $this->Kasir_model->cek_invoice_terakhir($tanggal2);
        var_dump($is_there_number_invoice2);
        echo $is_there_number_invoice;
        if ($is_there_number_invoice) { //saat nomor pada hari pertama tidak ada
            $invoice1 = "NO. " . "1/AR/" . date('d') . "/" . date('m') . "/" . date('Y');
            echo $invoice1;
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
            $invoice1 = "NO. " . "$nomor_invoice_sekarang/AR/" . date('d') . "/" . date('m') . "/" . date('Y');
        }



        $paid_amount = $this->input->post('paid_amount'); //yang dibayarkan oleh pembeli
        // sisa yang harus dibayar (lunas atau tidak)
        $left_to_paid = $paid_amount - $item_price_total;
        $data_invoice = [
            'id' => '',
            'invoice_number' => $invoice1,
            'paid_amount' => $paid_amount,
            'left_to_paid' => $left_to_paid,
            // 'paid_at' => '',
            'transaction_id' => $invoice_id, //invoice id adalah data row terbaru yang masuk dalam database atau data yang sedang diolah sekarang
            'employee_id' => $employee_id,
            'created_at' => $createdAt,
            'is_deleted' => 0

        ];
        $insert = $this->Kasir_model->insert_invoice($data_invoice);
    }



    // TODO LIST BUAT quantity dinamis berdasarkan toko
    // CUSTOM HARGA

}
