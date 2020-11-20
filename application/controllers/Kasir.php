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
            'data_product' => $this->Product_model->get_all(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert()
    {
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
        // var_dump($data_transaction);
        $insert = $this->Kasir_model->insert_transaction($data_transaction);











        // var_dump($checkbox_value);
        $i = 0;
        $item_price_total = 0;
        $quantity = $this->input->post('quantity');

        $invoice_id = $this->Kasir_model->get_row_terbaru();
        $invoice_id = $invoice_id['id'];
        // var_dump($invoice_id);
        var_dump($quantity);
        echo "<br>";
        var_dump($checkbox_value);
        foreach ($checkbox_value as $id_product) {
            // echo $i;
            // echo $id_product;
            // echo "<br>";
            // echo "<br>";
            // // // var_dump($quantity);
            // echo $quantity[$id_product - 1];
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // var_dump($checkbox_value);
            $price = $this->Product_model->get_by_id($id_product);

            $data_invoice_item = [
                'id' => '',
                'quantity' => $quantity[$id_product - 1],
                'item_price' => $price->price_base,
                'invoice_id' => $invoice_id,
                'product_id' => $id_product
            ];
            // echo $quantity[$id_product];
            // // var_dump($data_invoice_item);
            // echo "<br>";
            $insert = $this->Kasir_model->insert_invoice_item($data_invoice_item);
            $item_price_total +=  $price->price_base;
            // echo $quantity[0];

            $data_product_mutation = [
                'id' => '',
                'product_id' =>  $id_product,
                'store_id' => $store_id,
                'mutation_code' => $invoice . rand(10, 100),
                'quantity' => $quantity[$id_product - 1],
                'mutation_type' => 'keluar',
                'created_by' => $_SESSION['username'],
                'is_deleted' => 0,
            ];

            $insert = $this->Kasir_model->insert_product_mutation($data_product_mutation);



            $data_update_inventory_product = [
                'id' => $id_product,
                'quantity' => $quantity[$id_product - 1]
            ];
            $update = $this->Kasir_model->update_quantity_inventory_product($data_update_inventory_product);

            $i++;
        }

        $data_update = [
            'id' => $invoice_id,
            'price_total' => $item_price_total
        ];
        $update_price_total = $this->Kasir_model->update_total_price($data_update);

        // data transaksi di update oleh total price

        // update price total berdasarkan item yang sudah ditambahkan
        $paid_amount = $this->input->post('paid_amount'); //yang dibayarkan oleh pembeli
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



        // echo $invoice;
    }
}
