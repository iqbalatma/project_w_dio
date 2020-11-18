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
    }

    public function index()
    {
        $data = [
            'title'             => 'Kasir',
            'content'           => 'v_kasir.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_masuk' => $this->Inventory_material_model->getAll(),
            // 'data_barang_kimia' => $this->Material_model->getAll(),
            // 'data_store' => $this->Store_model->getAll(),
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
        $data = [
            'id' => '',
            'invoice_number' => $invoice,
            'price_total' => $price_total,
            'invoice_payment_id' => $invoice_payment_id,
            'store_id' => $store_id,
            'customer_id' => $pelanggan,
            'employee_id' => $employee_id,
            'created_at' => $createdAt,
            'due_at' => $due_at,
            'is_deleted' => 0


        ];
        // var_dump($data);
        // echo $createdAt;
        // echo $due_at;



        // echo $invoice;
    }
}
