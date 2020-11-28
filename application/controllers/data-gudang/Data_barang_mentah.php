<?php

defined('BASEPATH') or exit('No direct script access allowed');




class Data_barang_mentah extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Material_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Barang Mentah',
            'content'           => 'v_barang_mentah.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-mentah', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_kimia' => $this->Material_model->getAll(),
            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function v_insert()
    {
        $data = [
            'title'             => 'Tambah Barang Kimia',
            'content'           => 'v_tambah_barang_kimia.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-kimia', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_kimia' => $this->Material_model->getAll()
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function v_update($id)
    {
        $data = [
            'title'             => 'Ubah Barang Kimia',
            'content'           => 'v_ubah_barang_kimia.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-kimia', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_barang_kimia' => $this->Material_model->getAll(),
            'data_form' => $this->Material_model->getById($id),

        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function insert()
    {
        $this->form_validation->set_rules(
            'material',
            'Kode Bahan',
            'trim|required|max_length[11]|is_unique[material.material_code]',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 11 karakter',
                'is_unique' => '%s kode bahan sudah terdaftar'
            )
        );

        $this->form_validation->set_rules(
            'fullname',
            'Nama Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 100 karakter',
            )
        );

        $this->form_validation->set_rules(
            'volumeinput',
            'Volume',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 11 karakter',
                'numeric'         => '%s hanya terdiri dari angka',
            )
        );

        $this->form_validation->set_rules(
            'pricebase',
            'Harga',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 15 karakter',
                'numeric'         => '%s hanya terdiri dari angka',
            )
        );






        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {

            echo "validasi berhasil";
            $material = $this->input->post('material');
            $fullname = $this->input->post('fullname');
            $unit = $this->input->post('unitbahan');
            $volume = $this->input->post('volumeinput');
            $pricebase = $this->input->post('pricebase');


            // proses upload image
            $config['upload_path']          = './assets/img/material';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100000;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            // upload gambar ke server
            $x = $this->upload->do_upload('imageinput');

            // // cek apakah ada gambar yang di upload
            $image_cek = $this->upload->data('file_name');
            echo $image_cek;
            var_dump($x);
            if ($image_cek == '') {
                $data = [
                    'id' => '',
                    'material_code' => $material,
                    'full_name' => $fullname,
                    'unit' => $unit,
                    'volume' => $volume,
                    'price_base' => $pricebase,
                    'is_deleted' => 0
                ];
                // var_dump($data);
            } else {
                $data = [
                    'id' => '',
                    'material_code' => $material,
                    'full_name' => $fullname,
                    'unit' => $unit,
                    'volume' => $volume,
                    'price_base' => $pricebase,
                    'is_deleted' => 0,
                    'image' => $image_cek
                ];
                // var_dump($data);
            }


            $insert = $this->Material_model->insert($data);

            if ($insert == 1) {
                echo "input berhasil";
                $this->session->set_flashdata('message_berhasil', 'Berhasil menambah data');
                redirect(base_url('data-gudang/Data_barang_mentah'));
            } else {
                echo "input gagal";
                $this->session->set_flashdata('message_gagal', 'Gagal menambah data');
                redirect(base_url('data-gudang/Data_barang_mentah'));
            }
        }
    }

    public function update()
    {
        $this->form_validation->set_rules(
            'material',
            'Kode Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 100 karakter',
            )
        );
        $this->form_validation->set_rules(
            'fullname',
            'Nama Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 100 karakter',
            )
        );

        $this->form_validation->set_rules(
            'volumeinput',
            'Stok',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => 'Stok Bahan tidak boleh kosong',
                'max_length'     => 'Stok Bahan maksimal 15 karakter',
                'numeric'         => 'Stok Bahan hanya terdiri dari angka',
            )
        );
        $this->form_validation->set_rules(
            'pricebase',
            'Harga',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => 'Harga Bahan tidak boleh kosong',
                'max_length'     => 'Harga Bahan maksimal 15 karakter',
                'numeric'         => 'Harga Bahan hanya terdiri dari angka',
            )
        );




        $config['upload_path']          = './assets/img/material';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100000;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        // upload gambar ke server
        $this->upload->do_upload('imageinput');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
            // echo "gagal";
            // echo validation_errors();
            // jika syarat pada form sudah terpenuhi (tombol register sudah ditekan)
        } else {


            $material_code = $this->input->post('material');
            $full_name = $this->input->post('fullname');
            $unit = $this->input->post('unitbahan');
            $volume = $this->input->post('volumeinput');
            $price_base = $this->input->post('pricebase');
            $image_cek = $this->upload->data('file_name');
            $id = $this->input->post('id');

            if ($image_cek == '') {
                $data = [
                    'id' => $id,
                    'material_code' => $material_code,
                    'full_name' => $full_name,
                    'unit' => $unit,
                    'volume' => $volume,
                    'price_base' => $price_base,
                    'is_deleted' => 0
                ];
            } else {
                $data = [
                    'id' => $id,
                    'material_code' => $material_code,
                    'full_name' => $full_name,
                    'unit' => $unit,
                    'volume' => $volume,
                    'price_base' => $price_base,
                    'is_deleted' => 0,
                    'image' => $image_cek
                ];
            }






            $insert = $this->Material_model->update($data);

            if ($insert == 1) {
                // $this->session->set_flashdata('success_message', 1);
                // $this->session->set_flashdata('title', 'Registration complete !');
                // $this->session->set_flashdata('text', 'Please activate your account via email');
                // redirect(base_url('login'));
                $this->session->set_flashdata('message_berhasil', 'Berhasil Mengubah data');
                redirect(base_url('data-gudang/Data_barang_mentah'));
            } else {
                // $this->session->set_flashdata('failed_message', 1);
                // $this->session->set_flashdata('title', 'Registration failed !');
                // $this->session->set_flashdata('text', 'Please check again your information');
                // redirect(base_url('register'));
                $this->session->set_flashdata('message_gagal', 'Gagal Mengubah data');
                redirect(base_url('data-gudang/Data_barang_mentah'));
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $delete = $this->Material_model->delete($id);

        if ($delete == 1) {
            // $this->session->set_flashdata('success_message', 1);
            // $this->session->set_flashdata('title', 'Registration complete !');
            // $this->session->set_flashdata('text', 'Please activate your account via email');
            // redirect(base_url('login'));
            $this->session->set_flashdata('message_berhasil', 'Berhasil Menghapus data');
            redirect(base_url('data-gudang/Data_barang_mentah'));
        } else {
            // $this->session->set_flashdata('failed_message', 1);
            // $this->session->set_flashdata('title', 'Registration failed !');
            // $this->session->set_flashdata('text', 'Please check again your information');
            // redirect(base_url('register'));
            $this->session->set_flashdata('message_gagal', 'Gagal Menghapus data');
            redirect(base_url('data-gudang/Data_barang_mentah'));
        }
    }
}
