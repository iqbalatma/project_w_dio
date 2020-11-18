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
    }

    public function index()
    {
        $data = [
            'title'             => 'Kasir',
            'content'           => 'v_kasir.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer' => $this->Customer_model->get_all(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert()
    {
        $date = new DateTime();
        $createdAt = unix_to_human(now(), true, 'europe');
        $pelanggan = $this->input->post('nama_pelanggan');
        // $invoice = 'INV' . $_SESSION['store_id'] . $date->format('m');
        $invoice = rand(10, 1000000);
        $price_total = 40000;
        $invoice_payment_id = '';
        $store_id = $_SESSION['store_id'];
        $employee_id = $_SESSION['id'];
        $due_at = unix_to_human(now() + (86400 * 7), true, 'europe');
        // 86400,
        $paid_amount = 109000;
        $left_to_paid = 9000;
        // $paid_at = 
        $transaction_id = 1;
        $employee_id = $_SESSION['id'];
        $data_invoice = [
            'id' => '',
            'invoice_number' => $invoice,
            'paid_amount' => $paid_amount,
            'left_to_paid' => $left_to_paid,
            // 'paid_at' => '',
            'transaction_id' => $transaction_id,
            'employee_id' => $employee_id,
            'created_at' => $createdAt,
            'is_deleted' => 0

        ];

        $insert = $this->Kasir_model->insert_invoice($data_invoice);



        // echo $invoice;
    }
}
