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

        // 86400,

        // $paid_at = 
        $transaction_id = 1;
        $employee_id = $_SESSION['id'];

        $checkbox_value = $this->input->post('product');






        // BEGIN PROSES INSERT DATA TRANSAKSI

        $price_total = 0;
        $store_id = $_SESSION['store_id'];
        $customer_id = $this->input->post('nama_pelanggan');
        $due_at = unix_to_human(now() + (86400 * 7), true, 'europe');
        $trans_number = 'TRANS' . $invoice; //primary_key pada tabel transaksi format menyesuaikan
        $data_transaction = [
            'trans_number' => $trans_number,     //XXX  Belum ada formatnya
            'price_total' => $price_total, //XXX
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


        var_dump($quantity);
        echo "<br>";
        var_dump($checkbox_value);

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
            $data_product_mutation = [
                'id' => '',
                'product_id' =>  $id_product,
                'store_id' => $store_id,
                'mutation_code' => $invoice . rand(10, 100),
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



        $paid_amount = $this->input->post('paid_amount'); //yang dibayarkan oleh pembeli
        // sisa yang harus dibayar (lunas atau tidak)
        $left_to_paid = $paid_amount - $item_price_total;
        $data_invoice = [
            'id' => '',
            'invoice_number' => $invoice,
            'paid_amount' => $paid_amount,
            'left_to_paid' => $left_to_paid,
            // 'paid_at' => '',
            'transaction_id' => $invoice_id, //masih dummy statis
            'employee_id' => $employee_id,
            'created_at' => $createdAt,
            'is_deleted' => 0

        ];
        $insert = $this->Kasir_model->insert_invoice($data_invoice);
    }



    // TODO LIST BUAT quantity dinamis berdasarkan toko
    // CUSTOM HARGA

}
