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
        $data = [
          'title'           => 'Tampil Data Invoice',
          'content'         => 'data-penjualan/v_data_invoice.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'datatables'      => 1,
          'invoices'        => $this->invoice_m->get_all_with_trx('i.id, i.invoice_number, t.deliv_address, t.price_total, i.paid_amount, i.left_to_paid, i.created_at'),
        ];

        // pprintd($data);
        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    
}
