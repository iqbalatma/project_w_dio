<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_barang_laku extends CI_Controller
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

    public function index()
    {
        $data = [
            'title'             => 'Data Barang',
            'content'           => 'v_barang_laku.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_laku' => $this->Product_mutation_model->product_paling_laku(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
