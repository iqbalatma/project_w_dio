<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_inventory_barang_mentah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Kasir_model");
        $this->load->model("Product_mutation_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Barang Mentah',
            'content'           => 'data-gudang/v_inventory_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-inventory-barang-mentah', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_masuk' => $this->Inventory_material_model->getAll(),
            'data_barang_kimia' => $this->Material_model->getAll(),
            'data_store' => $this->Store_model->getAll(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function v_insert()
    {
        $data = [
            'title'             => 'Data Barang Masuk',
            'content'           => 'data-gudang/v_tambah_barang_masuk.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-masuk', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_masuk' => $this->Inventory_material_model->getAll(),
            'data_barang_kimia' => $this->Material_model->getAll(),
            'data_store' => $this->Store_model->getAll(),

            'datatables' => 1
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

        // $this->form_validation->set_rules(
        //     'updated_by',
        //     'Dimasukkan oleh',
        //     'trim|required|max_length[100]',
        //     array(
        //         'required' => 'Data tidak boleh kosong',
        //         'max_length'     => 'Data maksimal 15 karakter',
        //     )
        // );



        if ($this->form_validation->run() == FALSE) {

            $this->session->set_flashdata('message_gagal', validation_errors());
            redirect(base_url('data-gudang/Data_inventory_barang_mentah'));
        } else {

            $material_id = $this->input->post('material_id');
            $store_id = 1;
            $quantity = $this->input->post('quantity');
            $updated_by = $_SESSION['username'];
            $date = new DateTime(null, new DateTimeZone('Asia/Jakarta'));
            $data = [
                'id' => '',
                'material_id' => $material_id,
                'created_by' => $updated_by,
                'store_id' => $store_id,
                'quantity' => $quantity,
                'updated_at' => $date->format('Y-m-d H:i:s'),
                'updated_by' => $updated_by,
                'is_deleted' => 0
            ];

            $insert = $this->Inventory_material_model->insert($data);
            // $update = $this->Inventory_material_model->update($data);


            // prep untuk generate mutation code
            $now = now();
            $arr = [
                'item_type' => 'material', // PRO=Product ; MAT=Material ;
                'mutation_type' => 'masuk', // KEL=Keluar ; MSK=Masuk ;
            ];
            $materialMutationCode = $this->Product_mutation_model->generate_new_mutation_code($now, $arr);

            $data = [
                'id' => '',
                'material_id' => $material_id,
                'store_id' => $store_id,
                'mutation_code' => $materialMutationCode,
                'quantity' => $quantity,
                'mutation_type' => 'masuk',
                'created_by' => $_SESSION['username'],
                'is_deleted' => 0
            ];

            $this->Kasir_model->insert_material_mutation($data);


            if ($insert == 1) {
                $this->session->set_flashdata('message_berhasil', 'Berhasil menambah data');
                redirect(base_url('data-gudang/Data_inventory_barang_mentah'));
                // echo 'berhasil';
            } else {
                $this->session->set_flashdata('message_gagal', 'Gagal menambah data');
                redirect(base_url('data-gudang/Data_inventory_barang_mentah'));
                // echo 'gagal';
            }
        }
    }
}
