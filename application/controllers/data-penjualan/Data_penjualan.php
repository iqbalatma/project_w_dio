<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_penjualan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Product_mutation_model");
        $this->load->model("Transaction_model", "trx_m");
    }

    public function index()
    {
        // hanya untuk pemilik
        role_validation($this->session->role_id, ['1']);

        $data = [
            'title'             => 'Data Barang',
            'content'           => 'data-penjualan/v_master_penjualan.php',
            'menuActive'        => 'data-penjualan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-penjualan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_master_penjualan' => $this->Product_mutation_model->get_all_2(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function cetak_laporan()
    {
        // hanya untuk pemilik
        role_validation($this->session->role_id, ['1']);
        
        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');

        if ($this->form_validation->run() == FALSE)
        {
            $data = [
                'title'             => 'Menu Cetak Laporan Penjualan',
                'content'           => 'data-penjualan/v_menu_cetak_laporan.php',
                'menuActive'        => 'data-penjualan', // harus selalu ada, buat indikator sidebar menu yg aktif
                'submenuActive'     => 'cetak-laporan', // harus selalu ada, buat indikator sidebar menu yg aktif
                'dataPenjualan'     => $this->trx_m->get_all("trx.id, trx.trans_number, trx.deliv_fullname, trx.deliv_address, trx.deliv_phone, trx.price_total, trx.created_at, trx.due_at, s.store_name, e.username"),
                'daterangepicker'   => 1
            ];
            // pprintd($data);
            $this->load->view('template_dashboard/template_wrapper', $data);
        }
        else
        {
            $post = $this->input->post();

            $exp = explode(' - ', $post['tanggal']);

            $tanggal['awal']  = date("Y-m-d H:i:s", strtotime($exp[0]));
            $tanggal['akhir'] = date("Y-m-d H:i:s", strtotime($exp[1]) + ((60 * 60 * 24) - 1)); // ditambah 1 hari dikurangi 1 detik, agar hasilnya jam 23:59:59

            $tanggal = json_encode($tanggal);

            redirect(base_url("generate-report/pdf/export?mode=all&menu=laporan_penjualan&date_range={$tanggal}"));

            // $this->trx_m->get_all_sell("trx.id, trx.trans_number, trx.deliv_fullname, trx.deliv_address, trx.deliv_phone, trx.price_total, trx.created_at, trx.due_at, s.store_name, e.username", 'DESC', 'trx.id', '');

            pprintd($tanggal);
            echo'asdasdads';    
        }
    }
}
