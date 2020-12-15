<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    $this->load->model('Kas_model', 'kas_m');
    $this->load->model('Product_mutation_model', 'pm_m');
    $this->load->model('Inventory_material_model', 'im_m');
    $this->load->model('Transaction_model', 'trx_m');
    $this->load->model('Customer_model', 'cust_m');
    $this->load->model('Invoice_model', 'invoice_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "dashboard";
    $this->controller = "dashboard";
  }
  public function index()
  {
    // benchmark time start
    start_time(microtime(TRUE), 'dashboard');

    // ambil 10 invoice, kemudian bagi jadi 2 array (isi 5). 5/card di dashboard
    $lastInvoices   = $this->trx_m->get_some_last_invoice();
    if ($lastInvoices !== FALSE)
    {
      $lastInvoices1  = array_slice($lastInvoices, 0, 5);
      $lastInvoices2  = array_slice($lastInvoices, 5, 5);
    } else {
      $lastInvoices1  = FALSE;
      $lastInvoices2  = FALSE;
    }

    $data = [
      'title'                 => 'Dashboard',
      'content'               => 'v_dashboard.php',
      'menuActive'            => 'dashboard',
      'submenuActive'         => 'dashboard',
      // hanya untuk demo dashboard (harusnya diapus kl gapake chart)
      'chartjs'               => 1,
      'sparkline'             => 1,
      'chartcircle'           => 1,
      // row 1 di dashboard
      'totalCust'             => $this->cust_m->get_total(),
      'totalTrxPerMonth'      => $this->trx_m->get_month_total()->total,
      'totalProductPerMonth'  => $this->pm_m->get_month_total()->total,
      'totalUnpaidPerMonth'   => $this->invoice_m->get_month_total()->total,
      // row 2 di dashboard
      'criticalMaterial'      => $this->im_m->get_critical_material(),
      'mostBuy'               => $this->pm_m->get_most_buy_product(),
      'leastBuy'              => $this->pm_m->get_least_buy_product(),
      // row 3 di dashboard
      'lastInvoices1'         => $lastInvoices1,
      'lastInvoices2'         => $lastInvoices2,
    ];
    
    $this->load->view('template_dashboard/template_wrapper', $data);

    // benchmark time end
    end_time('dashboard');
  }
}
