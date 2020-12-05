<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_barang_kritis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Barang',
            'content'           => 'data-gudang/v_barang_kritis.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_kritis' => $this->Inventory_material_model->getKritis(),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
