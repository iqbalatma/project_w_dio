<?php 
defined('BASEPATH') or exit('No direct script access allowed');

class Data_transaksi_barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        
        // hanya untuk pemilik dan gudang
        role_validation($this->session->role_id, ['1', '2']);

        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Product_model");
        $this->load->model("Customer_model");
        $this->load->model("Kasir_model");
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Customer_model");
        $this->load->model("Kasir_model");
        $this->load->model("Product_model");
        $this->load->model("Product_mutation_model");
        $this->load->model("Material_mutation_model", 'mm_m');
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Transaksi Barang',
            'content'           => 'data-gudang/v_transaksi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_transaksi_barang' => $this->Material_model->get_transaksi_barang("material_mutation.mutation_type = 'masuk'"),

            'datatables' => 1
        ];

        // jika pemilik yg login
        if (role_access($this->session->role_id, ['1'])) {
            $data['data_transaksi_barang'] = $this->Material_model->get_transaksi_barang();
        }

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function mutasi_by_store_id($store_id = 1)
    {
        $data = [
            'title'             => 'Data Transaksi Barang',
            'content'           => 'data-gudang/v_transaksi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_transaksi_barang' => $this->mm_m->get_transaksi_barang_by_store_id($store_id, "material_mutation.mutation_type = 'masuk'"),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function get_ajax()
    {
        $this->Kasir_mode->get_ajax();
    }


}



