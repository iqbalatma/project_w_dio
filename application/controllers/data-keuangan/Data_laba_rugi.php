<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_laba_rugi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();

        // hanya untuk pemilik
        role_validation($this->session->role_id, ['1']);

        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Kas_model");
        $this->load->model("Invoice_model");
        $this->load->model("Kasir_model");
    }

    public function perhari()
    {    
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
        // $data_invoice = $this->Kas_model->get_invoice_perhari("2020-12-14");
        $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));
        // $data_invoice = $this->Kas_model->get_invoice_perhari($tanggal_pertama);

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
                // $total_hutang = $this->Invoice_model->get_total_debt2();
                if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
                    $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);
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

                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
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
            $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));

            if (count($data_invoice) > 1) {

                foreach ($data_invoice as $row) {
                    // INI KETIKA INVOICE LEBIH DARI 1 lakukan perulangan
                    // echo $row['transaction_id'];
                    if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
                        $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);

                        if ($data_row->left_to_paid > 0) {

                            // echo $row['transaction_id'];
                            $total_hutang += $data_row->left_to_paid;
                            array_push($tidak_digunakan, $row['transaction_id']);
                        }
                    };
                    // // var_dump($tidak_digunakan);
                    // echo "<br>";

                    // echo array_search(20, $tidak_digunakan);

                    // $total_hutang = $this->Invoice_model->get_total_debt2();

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);

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
                        $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);

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

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
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
        // echo $total_hutang;

        // var_dump($hutang_array);

        $matrix = [];
        $data = [
            'title'             => 'Data Laba Rugi - Per Hari',
            'content'           => 'data-keuangan/v_laba_rugi_perhari.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal'       => $total_modal_array,
            // 'total_pemasukan' => $total_pemasukan_array,
            'total_pemasukan'   => $total_pemasukan_array,
            'nilai_final'       => $nilai_final_array,
            'tanggal_hari_ini'  => $tanggal_array,
            'hutang_array'      => $hutang_array,
            'datatables'        => 1
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function perminggu()
    {
        $now        = now();
        $lastWeek   = $now - 518400;

        $createdAt  = unix_to_human($now, true, 'europe');

        $data['last_week']  = mdate("%Y-%m-%d", $lastWeek);
        $data['today']      = mdate("%Y-%m-%d", $now);

        // $kasPerWeek = $this->Kas_model->get_where("date > '{$data['last_week']}' AND date < '{$data['today']}'", "SUM(debet) AS tot_debet, SUM(kredit) AS tot_kredit");
        $kasPerWeek = $this->Kas_model->get_all("id, date, SUM(debet) AS tot_debet, SUM(kredit) AS tot_kredit, DATE_FORMAT(date, '%b-%Y') AS per_month_year, WEEK(date) - WEEK(DATE_FORMAT(date, '%Y-%m-01')) + 1 AS per_week, CONCAT(WEEK(date), '||' ,YEAR(date)) AS week_per_year", 'DESC', 'date', 20000, 'week_per_year');

        // pprintd($kasPerWeek);

        $i = 0;
        $container = [];
        foreach ($kasPerWeek as $row) {
            // jika dapat laba
            if ($row['tot_debet'] > $row['tot_kredit'])
            {
                $row['status'] = 'laba';
                $row['finalAmount']    = $row['tot_debet'] - $row['tot_kredit'];
            }
            // jika rugi
            else
            {
                $row['status'] = 'rugi';
                $row['finalAmount']    = '-' . ($row['tot_kredit'] - $row['tot_debet']);
            }
            $container[] = $row;
        }
        $kasPerWeek = $container;
        
        // pprintd($container);

        $data = [
            'title'             => 'Data Laba Rugi - Per Minggu',
            'content'           => 'data-keuangan/v_laba_rugi_perminggu.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'kasPerWeek'        => $kasPerWeek,
            'datatables'        => 1
        ];

        // pprintd($data);

        $this->load->view('template_dashboard/template_wrapper', $data);


        // pprintd($data);
    }


    public function perminggu2()
    {
        $date = new DateTime();
        $tanggal_hari_ini   = $date->getTimestamp();
        $tanggal_pertama    = $date->getTimestamp() - (386400 * 10);
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
        // $data_invoice = $this->Kas_model->get_invoice_perhari("2020-12-14");
        $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));
        // $data_invoice = $this->Kas_model->get_invoice_perhari($tanggal_pertama);

        // echo "<pre>";
        // var_dump($data_invoice);
        // echo "</pre>";
        $total_modal_final = 0;
        $total_pemasukan_final = 0;
        $total_hutang_final = 0;
        if (count($data_invoice) > 1) {
            foreach ($data_invoice as $row) {
                if ($row['left_to_paid'] > 0) {
                    $total_hutang += $row['left_to_paid'];
                }

                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);

                foreach ($invoice_item as $row2) {
                    $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
                    $total_modal += $data_produk[0]['price_base'];
                    $total_pemasukan += $row2['item_price'];
                }
                $total_modal_final += $total_modal;
                $total_pemasukan_final += $total_pemasukan;
                $total_hutang_final += $total_hutang;
                $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
                $nilai_final_final = $total_pemasukan_final - $total_modal_final;


                // if ($total_modal !== 0) {
                //     array_push($hutang_array, $total_hutang);
                //     array_push($nilai_final_array, $nilai_final);
                //     array_push($tanggal_array, $tanggal_pertama);
                //     array_push($total_modal_array, $total_modal);
                //     array_push($total_pemasukan_array, $total_pemasukan);
                // }

            }
        } else {
            foreach ($data_invoice as $row) {
                if ($row['left_to_paid'] > 0) {
                    $total_hutang += $row['left_to_paid'];
                }

                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                foreach ($invoice_item as $row2) {
                    $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
                    $total_modal += $data_produk[0]['price_base'];
                    $total_pemasukan += $row2['item_price'];
                }
                $total_modal_final += $total_modal;
                $total_pemasukan_final += $total_pemasukan;
                $total_hutang_final += $total_hutang;
                $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
                $nilai_final_final = $total_pemasukan_final - $total_modal_final;

                // if ($total_modal !== 0) {
                //     array_push($hutang_array, $total_hutang);
                //     array_push($nilai_final_array, $nilai_final);
                //     array_push($tanggal_array, $tanggal_pertama);
                //     array_push($total_modal_array, $total_modal);
                //     array_push($total_pemasukan_array, $total_pemasukan);
                // }
            }
        }

        if ($total_modal_final !== 0) {
            array_push($hutang_array, $total_hutang_final);
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
            $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));
            if (count($data_invoice) > 1) {
                foreach ($data_invoice as $row) {
                    if ($row['left_to_paid'] > 0) {
                        $total_hutang += $row['left_to_paid'];
                    }

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);

                    foreach ($invoice_item as $row2) {
                        $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
                        $total_modal += $data_produk[0]['price_base'];
                        $total_pemasukan += $row2['item_price'];
                    }
                    $total_modal_final += $total_modal;
                    $total_pemasukan_final += $total_pemasukan;
                    $total_hutang_final += $total_hutang;
                    $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
                    $nilai_final_final = $total_pemasukan_final - $total_modal_final;
                }
                if ($total_modal_final !== 0) {
                    array_push($hutang_array, $total_hutang_final);
                    array_push($nilai_final_array, $nilai_final_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal_final);
                    array_push($total_pemasukan_array, $total_pemasukan_final);
                }
            } elseif (count($data_invoice) == 1) {
                foreach ($data_invoice as $row) {
                    if ($row['left_to_paid'] > 0) {
                        $total_hutang += $row['left_to_paid'];
                    }

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                    foreach ($invoice_item as $row2) {
                        $data_produk = $this->Kasir_model->get_code_product($row2['product_id']);
                        $total_modal += $data_produk[0]['price_base'];
                        $total_pemasukan += $row2['item_price'];
                    }
                    $total_modal_final += $total_modal;
                    $total_pemasukan_final += $total_pemasukan;
                    $total_hutang_final += $total_hutang;
                    $total_pemasukan_final = $total_pemasukan_final - $total_hutang_final;
                    $nilai_final_final = $total_pemasukan_final - $total_modal_final;
                }
                if ($total_modal_final !== 0) {
                    array_push($hutang_array, $total_hutang_final);
                    array_push($nilai_final_array, $nilai_final_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal_final);
                    array_push($total_pemasukan_array, $total_pemasukan_final);
                }
            }
        }


        $matrix = [];
        $data = [
            'title'             => 'Data Laba Rugi - Per Minggu',
            'content'           => 'data-keuangan/v_laba_rugi_perminggu.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal'       => $total_modal_array,
            'total_pemasukan'   => $total_pemasukan_array,
            'nilai_final'       => $nilai_final_array,
            'tanggal_hari_ini'  => $tanggal_array,
            'hutang_array'      => $hutang_array,
            'datatables'        => 1
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function perbulan()
    {
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
        // $data_invoice = $this->Kas_model->get_invoice_perhari("2020-12-14");
        $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));
        // $data_invoice = $this->Kas_model->get_invoice_perhari($tanggal_pertama);

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
                // $total_hutang = $this->Invoice_model->get_total_debt2();
                if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
                    $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);

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

                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
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
            $data_invoice = $this->Kas_model->get_invoice_perhari(date("Y-m-d", $tanggal_pertama));

            if (count($data_invoice) > 1) {

                foreach ($data_invoice as $row) {
                    // INI KETIKA INVOICE LEBIH DARI 1 lakukan perulangan
                    // echo $row['transaction_id'];
                    if (array_search($row['transaction_id'], $tidak_digunakan) === false) {
                        $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);

                        if ($data_row->left_to_paid > 0) {

                            // echo $row['transaction_id'];
                            $total_hutang += $data_row->left_to_paid;
                            array_push($tidak_digunakan, $row['transaction_id']);
                        }
                    };

                    // // var_dump($tidak_digunakan);
                    // echo "<br>";
                    // echo array_search(20, $tidak_digunakan);
                    // $total_hutang = $this->Invoice_model->get_total_debt2();

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);

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
                        $data_row = $this->Invoice_model->get_hutang($row['transaction_id']);

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

                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
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

        $matrix = [];
        $data = [
            'title'             => 'Data Laba Rugi - Per Bulan',
            'content'           => 'data-keuangan/v_laba_rugi_perbulan.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal'       => $total_modal_array,
            'total_pemasukan'   => $total_pemasukan_array,
            'nilai_final'       => $nilai_final_array,
            'tanggal_hari_ini'  => $tanggal_array,
            'hutang_array'      => $hutang_array,
            'datatables'        => 1
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    // public function index()
        // {
        //     $data = [
        //         'title'             => 'Data Laba Rugi',
        //         'content'           => 'data-keuangan/v_laba_rugi.php',
        //         'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
        //         'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
        //         // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
        //         // 'total_modal' => $total_modal_array,
        //         // // 'total_pemasukan' => $total_pemasukan_array,
        //         // 'total_pemasukan' => $total_pemasukan_array,
        //         // 'nilai_final' => $nilai_final_array,
        //         // 'tanggal_hari_ini' => $tanggal_array,
        //         // 'hutang_array' => $hutang_array,
        //         'datatables' => 1
        //     ];

        //     $this->load->view('template_dashboard/template_wrapper', $data);
    // }
}
