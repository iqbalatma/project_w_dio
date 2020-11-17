<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_barang_masuk extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['is_logged'] !== 'TRUE') {
            redirect('Auth');
        }
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Barang Masuk',
            'content'           => 'v_barang_masuk.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_masuk' => $this->Inventory_material_model->getAll(),
            'data_barang_kimia' => $this->Material_model->getAll(),
            'data_store' => $this->Store_model->getAll(),
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function insert()
    {

        $this->form_validation->set_rules(
            'quantity',
            'Jumlah',
            'trim|required|max_length[11]|numeric|greater_than[0]',
            array(
                'required' => 'Jumlah Bahan tidak boleh kosong',
                'max_length'     => 'Jumlah Bahan maksimal 11 karakter',
                'numeric'         => 'Jumlah hanya terdiri dari angka',
                'greater_than' => 'Jumlah tidak boleh 0'
            )
        );

        $this->form_validation->set_rules(
            'updated_by',
            'Dimasukkan oleh',
            'trim|required|max_length[100]',
            array(
                'required' => 'Data tidak boleh kosong',
                'max_length'     => 'Data maksimal 15 karakter',
            )
        );



        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {

            $material_code = $this->input->post('material_code');
            $store_id = $this->input->post('store');
            $quantity = $this->input->post('quantity');
            $updated_by = $this->input->post('updated_by');


            $data = [
                'id' => '',
                'material_code' => $material_code,
                'store_id' => $store_id,
                'quantity' => $quantity,
                'updated_by' => $updated_by,
                'is_deleted' => 0
            ];

            $insert = $this->Inventory_material_model->insert($data);


            if ($insert == 1) {
                $this->session->set_flashdata('message_berhasil', 'Berhasil menambah data');
                redirect(base_url('data-gudang/Data_barang_masuk'));
                // echo 'berhasil';
            } else {
                $this->session->set_flashdata('message_gagal', 'Gagal menambah data');
                redirect(base_url('data-gudang/Data_barang_masuk'));
                // echo 'gagal';
            }
        }
    }
}
