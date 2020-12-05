<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_transaksi_barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Transaksi Barang',
            'content'           => 'data-gudang/v_transaksi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_transaksi_barang' => $this->Material_model->get_transaksi_barang(),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
