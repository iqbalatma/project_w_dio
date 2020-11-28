<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_penjualan_pertoko extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Product_mutation_model");
    }

    public function index($id_toko)
    {
        $data = [
            'title'             => 'Data Barang',
            'content'           => 'v_penjualan_pertoko.php',
            'menuActive'        => 'data-penjualan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-penjualan-per-toko', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_master_penjualan' => $this->Product_mutation_model->get_by_store_id($id_toko),
            // 'data_master_penjualan' => $this->Product_mutation_model->get_all(),
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}