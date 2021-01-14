<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    must_login();
    // hanya untuk pemilik dan gudang
    role_validation($this->session->role_id, ['1', '2']);
    // load model
    $this->load->model('Kas_model', 'kas_m');
    $this->load->model('Product_mutation_model', 'pm_m');
    $this->load->model('Inventory_material_model', 'im_m');
    $this->load->model('Transaction_model', 'trx_m');
    $this->load->model('Customer_model', 'cust_m');
    $this->load->model('Invoice_model', 'invoice_m');
    $this->load->model('Kasir_model');
    // initialize for menuActive and submenuActive
    $this->modules    = "dashboard";
    $this->controller = "dashboard";
  }

  public function index()
  {
    // ambil 10 invoice, kemudian bagi jadi 2 array (isi 5). 5/card di dashboard
    $lastInvoices   = $this->trx_m->get_some_last_invoice();
    if ($lastInvoices !== FALSE) {
      $lastInvoices1  = array_slice($lastInvoices, 0, 5);
      $lastInvoices2  = array_slice($lastInvoices, 5, 5);
    } else {
      $lastInvoices1  = FALSE;
      $lastInvoices2  = FALSE;
    }




    $date = new DateTime();
    $tanggal_hari_ini = $date->getTimestamp() + (86400 * 100);
    $tanggal_pertama = 1606656147;
    // $tanggal_pertama = "1607898800";
    $x = 0;
    $nilai_final_array = array();
    $total_pemasukan_array = array();
    $total_modal_array = array();
    $tanggal_array = array();
    $hutang_array = array();
    $total_hutang = 0;
    $total_pemasukan = 0;
    $total_modal = 0;
    $tidak_digunakan = array();
    // $data_invoice = $this->kas_model->get_invoice_perhari("2020-12-14");
    $data_invoice = $this->kas_m->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));
    // $data_invoice = $this->kas_m->get_invoice_perhari($tanggal_pertama);

    // echo "<pre>";
    // var_dump($data_invoice);
    // echo "</pre>";
    // echo     date("Y-m-d", $tanggal_pertama);

    // echo date("Y-m-d", $tanggal_hari_ini);

    $total_modal_final = 0;
    $total_pemasukan_final = 0;
    $total_hutang_final = 0;
    if (count($data_invoice) > 1) {
      foreach ($data_invoice as $row) {
        // $total_hutang = $this->invoice_m->get_total_debt2();
        if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
          $data_row = $this->invoice_m->get_hutang($row['transaction_id']);



          // echo "<pre>";
          // var_dump($data_row);
          // echo "<pre>";
          // echo $data_row->left_to_paid;

          if ($data_row->left_to_paid > 0) {
            $total_hutang += $data_row->left_to_paid;
            // echo "<br>";
            echo "COK1";
            array_push($tidak_digunakan, $row['transaction_id']);
            // echo $data_row->left_to_paid;
            // echo "<br>";
            // echo $row['transaction_id'];
          }
        };


        $invoice_item = $this->kas_m->get_data_terjual($row['id']);
        foreach ($invoice_item as $row2) {
          $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
          $total_modal += $data_produk[0]['price_base'] * $row2['quantity'];
          $total_pemasukan += $row2['item_price'];
        }
        $total_modal_final += $total_modal;
        $total_pemasukan_final += $total_pemasukan;
        // $total_hutang_final = $total_hutang;
        // $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
        $nilai_final_final = $total_pemasukan_final - $total_modal_final;
        $total_pemasukan = 0;
        $total_modal = 0;
      }
    }

    if ($total_modal_final !== 0) {
      array_push($hutang_array, $total_hutang);
      array_push($nilai_final_array, $nilai_final_final);
      array_push($tanggal_array, $tanggal_pertama);
      array_push($total_modal_array, $total_modal_final);
      array_push($total_pemasukan_array, $total_pemasukan_final);
    }









    $total_modal_final = 0;
    $total_pemasukan_final = 0;
    $total_hutang_final = 0;
    $nilai_final_final = 0;
    $total_hutang = 0;
    $total_modal = 0;
    while ($tanggal_pertama < $tanggal_hari_ini) {
      $tanggal_pertama = $tanggal_pertama + (86400 * 1);
      $data_invoice = $this->kas_m->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));



      if (count($data_invoice) > 1) {



        foreach ($data_invoice as $row) {
          // INI KETIKA INVOICE LEBIH DARI 1 lakukan perulangan

          // echo $row['transaction_id'];

          if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
            $data_row = $this->invoice_m->get_hutang($row['transaction_id']);

            if ($data_row->left_to_paid > 0) {

              // echo $row['transaction_id'];
              $total_hutang += $data_row->left_to_paid;
              array_push($tidak_digunakan, $row['transaction_id']);
            }
          };
          // // var_dump($tidak_digunakan);
          // echo "<br>";

          // echo array_search(20, $tidak_digunakan);






          // $total_hutang = $this->invoice_m->get_total_debt2();


          $invoice_item = $this->kas_m->get_data_terjual($row['id']);

          // echo "<pre>";
          // var_dump($invoice_item);
          // echo "<pre>";
          foreach ($invoice_item as $row2) {
            $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
            $total_modal += $data_produk[0]['price_base'] * $row2['quantity'];
            $total_pemasukan += $row2['item_price'];
            // echo "haha";
            // echo "<br>";
            // echo $row2['item_price'];
          }
          // total pemasukan dan modal dalam 1 invoice sudah dijumlahkan
          // $total_pemasukan adalah total pemasukan per 1 invoice


          $total_modal_final += $total_modal;
          $total_pemasukan_final += $total_pemasukan;
          // $total_hutang_final += $total_hutang;
          // $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
          $nilai_final_final = $total_pemasukan  - $total_modal_final;
          $total_pemasukan = 0;
          $total_modal = 0;
        }

        if ($total_modal_final !== 0) {
          array_push($hutang_array, $total_hutang);
          array_push($nilai_final_array,  $total_pemasukan_final - $total_modal_final);
          array_push($tanggal_array, $tanggal_pertama);
          array_push($total_modal_array, $total_modal_final);
          array_push($total_pemasukan_array, $total_pemasukan_final);
        }
      } elseif (count($data_invoice) == 1) {
        foreach ($data_invoice as $row) {

          if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
            $data_row = $this->invoice_m->get_hutang($row['transaction_id']);



            // echo "<pre>";
            // var_dump($data_row);
            // echo "<pre>";
            // echo $data_row->left_to_paid;

            if ($data_row->left_to_paid > 0) {
              $total_hutang += $data_row->left_to_paid;
              array_push($tidak_digunakan, $row['transaction_id']);
              echo "COK2";
              echo "<br>";
              // array_push($tidak_digunakan, $row['transaction_id']);
              // echo $data_row->left_to_paid;
              // echo "<br>";
              // echo $row['transaction_id'];
            }
          };

          $invoice_item = $this->kas_m->get_data_terjual($row['id']);
          foreach ($invoice_item as $row2) {
            $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
            $total_modal += $data_produk[0]['price_base'] * $row2['quantity'];
            $total_pemasukan += $row2['item_price'];
          }
          // $total_modal_final += $total_modal;
          $total_modal_final += $total_modal;
          $total_pemasukan_final += $total_pemasukan;
          // $total_hutang_final += $total_hutang;
          // $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
          $nilai_final_final = $total_pemasukan - $total_modal_final;

          $total_pemasukan = 0;
          $total_modal = 0;
        }
        if ($total_modal_final !== 0) {
          array_push($hutang_array, $total_hutang);
          array_push($nilai_final_array, $total_pemasukan_final - $total_modal_final);
          array_push($tanggal_array, $tanggal_pertama);
          array_push($total_modal_array, $total_modal_final);
          array_push($total_pemasukan_array, $total_pemasukan_final);
        }
      }


      $total_modal_final = 0;
      $total_pemasukan_final = 0;
      $total_hutang_final = 0;
      $nilai_final_final = 0;
      $total_hutang = 0;
      $total_modal = 0;
    }




    $data = [
      'title'                 => 'Dashboard',
      'content'               => 'v_dashboard.php',
      'menuActive'            => 'dashboard',
      'submenuActive'         => 'dashboard',
      // hanya untuk demo dashboard (harusnya diapus kl gapake chart)
      'chartjs'               => 1,
      // 'sparkline'             => 1,
      // 'chartcircle'           => 1,
      // row 1 di dashboard
      'totalCust'             => $this->cust_m->get_total(),
      'totalTrxPerMonth'      => $this->trx_m->get_month_total()->total,
      'totalProductPerMonth'  => $this->pm_m->get_month_total()->total,
      'totalUnpaidPerMonth'   => $this->invoice_m->get_month_total()->total,
      // row 2 di dashboard
      'criticalMaterial'      => $this->im_m->get_critical_material(),
      'mostBuy'               => $this->pm_m->get_most_buy_product(),
      'thirdCard'            => [$this->trx_m->get_total_sales(), $this->invoice_m->get_total_debt(), $this->kas_m->get_total_spending()],
      // row 3 di dashboard
      'lastInvoices1'         => $lastInvoices1,
      'lastInvoices2'         => $lastInvoices2,

      'total_modal' => $total_modal_array,
      'total_pemasukan' => $total_pemasukan_array,
      'nilai_final' => $nilai_final_array,
      'tanggal_hari_ini' => $tanggal_array,
      'hutang_array' => $hutang_array,
    ];

    $this->load->view('template_dashboard/template_wrapper', $data);
  }
}
