<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_invoice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        // load model
        $this->load->model('Invoice_model', 'invoice_m');
        $this->load->model('Transaction_model', 'trx_m');
        // initialize for menuActive and submenuActive
        $this->modules    = "data-penjualan";
        $this->controller = "data-invoice";
    }

    public function index()
    {
        // jika pemilik maka tampilkan semua, tidak harus sesuai store_id
        if (role_access($this->session->role_id, ['1']))
        {
            $invoices = $this->invoice_m->get_all_first_inv_per_trx('i.id, t.trans_number, i.invoice_number, t.deliv_fullname, t.deliv_address, t.price_total, i.paid_amount, i.left_to_paid, i.created_at, i.payment_img');
        }
        else {
            $invoices = $this->invoice_m->get_all_first_inv_per_trx('i.id, t.trans_number, i.invoice_number, t.deliv_fullname, t.deliv_address, t.price_total, i.created_at, i.payment_img', $this->session->store_id);
        }

        $data = [
            'title'           => 'Tampil Data Invoice',
            'content'         => 'data-penjualan/v_data_invoice.php',
            'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
            'datatables'      => 1,
            'invoices'        => $invoices,
        ];

        // pprintd($data);
        // pprintd(role_access($this->session->role_id, ['1']));
        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
