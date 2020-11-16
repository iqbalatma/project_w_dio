<?php

defined('BASEPATH') or exit('No direct script access allowed');




class BarangKimia extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION['is_logged'] !== 'TRUE') {
            redirect('Auth');
        }
        $this->load->model("Material_model");
    }

    public function index()
    {
        $data = [
            'title'     => 'Data Barang Kimia',
            'content'   => 'v_barang_kimia.php',
            'data_barang_kimia' => $this->Material_model->getAll()
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }



    public function insert()
    {

        $this->form_validation->set_rules(
            'material_code',
            'Kode Bahan',
            'trim|required|max_length[100]|is_unique[material.material_code]',
            array(
                'required' => 'Kode Bahan tidak boleh kosong',
                'max_length'     => 'Kode Bahan maksimal 100 karakter',
                'is_unique'     => 'Kode Bahan sudah terdaftar.',
            )
        );
        $this->form_validation->set_rules(
            'full_name',
            'Nama Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => 'Nama Bahan tidak boleh kosong',
                'max_length'     => 'Nama Bahan maksimal 100 karakter',
            )
        );

        $this->form_validation->set_rules(
            'volume',
            'Stok',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => 'Stok Bahan tidak boleh kosong',
                'max_length'     => 'Stok Bahan maksimal 15 karakter',
                'numeric'         => 'Stok Bahan hanya terdiri dari angka',
            )
        );
        $this->form_validation->set_rules(
            'price_base',
            'Harga',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => 'Harga Bahan tidak boleh kosong',
                'max_length'     => 'Harga Bahan maksimal 15 karakter',
                'numeric'         => 'Harga Bahan hanya terdiri dari angka',
            )
        );








        if ($this->form_validation->run() == FALSE) {
            $this->index();
            // jika syarat pada form sudah terpenuhi (tombol register sudah ditekan)
        } else {
            $material_code = $this->input->post('material_code');
            $full_name = $this->input->post('full_name');
            $unit = $this->input->post('unit');
            $volume = $this->input->post('volume');
            $price_base = $this->input->post('price_base');
            $image = $this->input->post('image');


            $config['upload_path']          = './assets/img/material';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100000;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            // upload gambar ke server
            $this->upload->do_upload('image');


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





            $insert = $this->Material_model->insert($data);
            if ($insert == 1) {
                // $this->session->set_flashdata('success_message', 1);
                // $this->session->set_flashdata('title', 'Registration complete !');
                // $this->session->set_flashdata('text', 'Please activate your account via email');
                // redirect(base_url('login'));
                $this->session->set_flashdata('message_berhasil', 'Berhasil menambah data');
                redirect(base_url('DataGudang/BarangKimia'));
            } else {
                // $this->session->set_flashdata('failed_message', 1);
                // $this->session->set_flashdata('title', 'Registration failed !');
                // $this->session->set_flashdata('text', 'Please check again your information');
                // redirect(base_url('register'));
                $this->session->set_flashdata('message_gagal', 'Gagal menambah data');
                redirect(base_url('DataGudang/BarangKimia'));
            }
        }
    }

    public function update()
    {
        $this->form_validation->set_rules(
            'material_code',
            'Kode Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => 'Kode Bahan tidak boleh kosong',
                'max_length'     => 'Kode Bahan maksimal 100 karakter',
            )
        );
        $this->form_validation->set_rules(
            'full_name',
            'Nama Bahan',
            'trim|required|max_length[100]',
            array(
                'required' => 'Nama Bahan tidak boleh kosong',
                'max_length'     => 'Nama Bahan maksimal 100 karakter',
            )
        );

        $this->form_validation->set_rules(
            'volume',
            'Stok',
            'trim|required|max_length[11]|numeric',
            array(
                'required' => 'Stok Bahan tidak boleh kosong',
                'max_length'     => 'Stok Bahan maksimal 15 karakter',
                'numeric'         => 'Stok Bahan hanya terdiri dari angka',
            )
        );
        $this->form_validation->set_rules(
            'price_base',
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
        $this->upload->do_upload('image');

        if ($this->form_validation->run() == FALSE) {
            $this->index();
            // jika syarat pada form sudah terpenuhi (tombol register sudah ditekan)
        } else {


            $material_code = $this->input->post('material_code');
            $full_name = $this->input->post('full_name');
            $unit = $this->input->post('unit');
            $volume = $this->input->post('volume');
            $price_base = $this->input->post('price_base');
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
                $image = $this->upload->data('file_name');
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
                redirect(base_url('DataGudang/BarangKimia'));
            } else {
                // $this->session->set_flashdata('failed_message', 1);
                // $this->session->set_flashdata('title', 'Registration failed !');
                // $this->session->set_flashdata('text', 'Please check again your information');
                // redirect(base_url('register'));
                $this->session->set_flashdata('message_gagal', 'Gagal Mengubah data');
                redirect(base_url('DataGudang/BarangKimia'));
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
            redirect(base_url('DataGudang/BarangKimia'));
        } else {
            // $this->session->set_flashdata('failed_message', 1);
            // $this->session->set_flashdata('title', 'Registration failed !');
            // $this->session->set_flashdata('text', 'Please check again your information');
            // redirect(base_url('register'));
            $this->session->set_flashdata('message_gagal', 'Gagal Menghapus data');
            redirect(base_url('DataGudang/BarangKimia'));
        }
    }

    public function do_upload()
    {
        $config['upload_path']          = './assets/img/material';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100000;
        $this->upload->initialize($config);
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')) {
            $error = array('error' => $this->upload->display_errors());

            // $this->load->view('upload_form', $error);
            var_dump($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            echo 1;
            // $this->load->view('upload_success', $data);
        }
        var_dump($this->upload->data('file_name'));
    }
}
