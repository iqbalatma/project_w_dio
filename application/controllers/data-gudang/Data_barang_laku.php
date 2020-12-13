<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_barang_laku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Product_mutation_model");
    }

    public function index()
    {


        $data = [
            'title'             => 'Data Barang',
            'content'           => 'data-gudang/v_barang_laku.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-barang-laku', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_laku' => $this->Product_mutation_model->product_paling_laku(),
            'data_barang_laku' => $this->get_paling_laku(),
            'datatables' => 1
        ];






        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function get_paling_laku()
    {
        $id_product = $this->Product_mutation_model->mendapatkan_id_produk();
        $jumalah_id_produk = count($id_product);
        $i = 0;

        $array_data_kuantitas = array();

        while ($i < $jumalah_id_produk) {
            $id = $id_product[$i]['id'];
            $jumlah_kuantitas = $this->Product_mutation_model->jumlah_kuantitas_produk_keluar($id);
            $id_kuantitas = $jumlah_kuantitas[0]['product_id'];
            $jumlah_kuantitas = $jumlah_kuantitas[0]['total'];


            $array_data_kuantitas[$id_kuantitas] = $jumlah_kuantitas;


            $i = $i + 1;
        }

        arsort($array_data_kuantitas);


        $sort_id = array();
        foreach ($array_data_kuantitas as $key => $item) {
            array_push($sort_id, $key);
        }



        $j = 0;
        $array_final = array();
        if (count($sort_id) > 5) {
            while ($j < 5) {
                $data_final = $this->Product_mutation_model->jumlah_kuantitas_produk_keluar($sort_id[$j]);

                array_push($array_final, $data_final);
                $j++;
            }
        } else {
            while ($j < count($sort_id)) {
                $data_final = $this->Product_mutation_model->jumlah_kuantitas_produk_keluar($sort_id[$j]);

                array_push($array_final, $data_final);
                $j++;
            }
        }

        return $array_final;
    }
}
