<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_hutang_piutang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Kasir_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Hutang Piutang',
            'content'           => 'data-keuangan/v_hutang_piutang.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-hutang-piutang', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'data_hutang_piutang' => $this->Kasir_model->get_hutang(),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function bayar_hutang()
    {
        $this->form_validation->set_rules(
            'pembayaran',
            'Pembayaran',
            'trim|required|max_length[20]|numeric',
            array(
                'required' => '%s tidak boleh kosong',
                'max_length'     => '%s maksimal 11 karakter',
                'is_unique' => '%s kode bahan sudah terdaftar',
                'numeric'         => 'Form %s hanya terdiri dari angka',
            )
        );


        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('message_gagal', validation_errors());
            redirect(base_url('data-keuangan/data-hutang-piutang'));
        } else {
            $createdAt = unix_to_human(now(), true, 'europe');
            $passing_data = $this->input->post('id');
            $passing_data = explode(" ", $passing_data);
            $id_invoice = $passing_data[0];
            $paid_amount = $this->input->post('pembayaran');


            $transaction_id = $passing_data[1];
            $invoice_number = $passing_data[2];
            $invoice_number = explode("/", $invoice_number);
            $customer_type = $invoice_number[1];

            $left_to_paid = $passing_data[3];

            var_dump($passing_data);

            $data_invoice = [
                'id_invoice' => $id_invoice,
                'paid_amount' => $paid_amount,
                'status' => '1'
            ];



            $edit_invoice = $this->Kasir_model->edit_invoice($data_invoice);




            $invoice_id = $this->Kasir_model->get_row_terbaru();
            $invoice_id = $invoice_id['id']; //id_transaksi
            $tanggal = unix_to_human(now(), true, 'europe');
            $tanggal = explode(" ", $tanggal);
            $tanggal = $tanggal[0];
            $is_there_number_invoice = $this->Kasir_model->cek_number_invoice($tanggal);
            $is_there_number_invoice2 = $this->Kasir_model->cek_invoice_terakhir($tanggal);
            $tanggal = explode("-", $tanggal);
            // INVOICE NUMBER PERBULAN
            if ($is_there_number_invoice) { //saat nomor pada hari pertama tidak ada
                $invoice1 =  "1/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
                $x = "c";
            } elseif ($is_there_number_invoice2) { //invoice pada hari itu ada

                // var_dump($is_there_number_invoice2);
                $invoice_number =  $is_there_number_invoice2['invoice_number'];
                // $invoice_sebelumnya = $is_there_number_invoice2['invoice_number'];


                $invoice_number = explode("/", $invoice_number);
                $invoice_sebelumnya = $invoice_number[0];
                $nomor_invoice_sekarang = $invoice_sebelumnya + 1;
                $invoice1 = "$nomor_invoice_sekarang/" . $customer_type .  "/" . $tanggal[1] . "/" . $tanggal[0];
                $x = "s";
            }

            // echo $left_to_paid;
            // echo $paid_amount;


            $left_to_paid_final = $left_to_paid - $paid_amount;

            // echo $left_to_paid_final;
            $data_invoice = [
                'id' => '',
                'invoice_number' => $invoice1,
                'paid_amount' => $paid_amount,
                'left_to_paid' => $left_to_paid_final,
                // 'paid_at' => '',
                'transaction_id' => $transaction_id, //invoice id adalah data row terbaru yang masuk dalam database atau data yang sedang diolah sekarang

                'created_at' => $createdAt,
                'is_deleted' => 0,
                'status' => '0',

            ];



            $insert2 = $this->Kasir_model->insert_invoice($data_invoice);

            $kembalian = $paid_amount - $left_to_paid;


            if ($kembalian > 0) {
                $kembalian = $kembalian;
            } else {
                $kembalian = 0;
            }

            echo $kembalian;

            if ($insert2 == 1 && $edit_invoice == 1) {
                $this->session->set_flashdata('message_berhasil', 'Pembayaran Berhasil. Kembalian Rp ' . $kembalian);
                redirect(base_url('data-keuangan/data-hutang-piutang'));
            } else {
                $this->session->set_flashdata('message_gagal', 'Pembayaran Gagal');
                redirect(base_url('data-keuangan/data-hutang-piutang'));
            }
        }
    }
}
