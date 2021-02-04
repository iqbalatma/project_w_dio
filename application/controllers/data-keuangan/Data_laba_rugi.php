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
        $this->load->model("Transaction_model");
    }

    public function index()
    {
        redirect(current_url() . '/perhari');
    }

    public function perhari()
    {
        $labarugi = $this->getLabaRugi('perhari');

        $data = [
            'title'          => 'Data Laba Rugi - Per Hari',
            'content'        => 'data-keuangan/v_laba_rugi_perhari.php',
            'menuActive'     => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'  => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            'labarugi'       => $labarugi,
            'datatables'     => 1
        ];
        // pprintd($data);

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function perminggu()
    {
        $labarugi = $this->getLabaRugi('perminggu');

        $data = [
            'title'          => 'Data Laba Rugi - Per Minggu',
            'content'        => 'data-keuangan/v_laba_rugi_perminggu.php',
            'menuActive'     => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'  => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            'labarugi'       => $labarugi,
            'datatables'     => 1
        ];
        // pprintd($data);

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function perbulan()
    {
        $labarugi = $this->getLabaRugi('perbulan');

        $data = [
            'title'          => 'Data Laba Rugi - Per Bulan',
            'content'        => 'data-keuangan/v_laba_rugi_perbulan.php',
            'menuActive'     => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'  => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            'labarugi'       => $labarugi,
            'datatables'     => 1
        ];
        // pprintd($data);

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    private function getLabaRugi($param = null)
    {
        if ($param == null) return FALSE;

        if ($param == 'perhari') $master = $this->Transaction_model->get_laba_rugi('perhari');
        elseif ($param == 'perminggu') $master = $this->Transaction_model->get_laba_rugi('perminggu');
        elseif ($param == 'perbulan') $master = $this->Transaction_model->get_laba_rugi('perbulan');

        // pprintd($master);

        $i = 0;
        $k = 0;
        $container = [];
        $temp = [];
        foreach ($master as $row)
        {
            // inisiasi untuk looping pertama
            if ($i == 0) 
            {
                // bikin variabel untuk ngecek proses looping di iterasi pertama
                $loopChecker = $row['unique_value'];
                // set total di awal = 0
                $temp[$k]['modal'] = 0;
                $temp[$k]['penjualan'] = 0;
                $temp[$k]['pengeluaran'] = 0;
                $temp[$k]['total'] = 0;
            }

            // cek key 'unique_value' dengan $loopChecker yg sudah dibuat di pertama kali atau ketika keynya udah beda
            // isi dari key adalah format { tahun||bulan||minggu ke-n dalam tiap bulannya }
            if ($row['unique_value'] != $loopChecker) 
            {
                // bikin variabel untuk ngecek proses looping ketika key yg dicek udah beda
                $loopChecker = $row['unique_value'];
                // assign $k yg baru sesuai dengan $i pada looping sekarang
                $k = $i;
                // reset value total = 0
                $temp[$k]['modal'] = 0;
                $temp[$k]['penjualan'] = 0;
                $temp[$k]['pengeluaran'] = 0;
                $temp[$k]['total'] = 0;
            }

            // +++++++
            if ($param == 'perhari') 
            {
                $temp[$k]['day_per_month_year'] = $row['day_per_month_year'];
            }
            elseif ($param == 'perminggu') 
            {
                $temp[$k]['week_per_month'] = $row['week_per_month'];
                $temp[$k]['month_per_year'] = $row['month_per_year'];
            }
            elseif ($param == 'perbulan') 
            {
                $temp[$k]['month_per_year'] = $row['month_per_year'];
            }

            // jika penjualan maka ditambahkan
            // jika pengeluaran maka dikurangkan
            if ($row['col_type'] == 'penjualan')
            {
                // assign modal per minggu
                $temp[$k]['modal']      = $temp[$k]['modal'] + $row['modal'];
                // assign penjualan per minggu
                $temp[$k]['penjualan']  = $temp[$k]['penjualan'] + $row['money'];
                // assign penjualan - modal
                $temp[$k]['total']      = $temp[$k]['total'] + ($temp[$k]['penjualan'] - $temp[$k]['modal']);
            } 
            else 
            {
                // assign pengeluaran per minggu
                $temp[$k]['pengeluaran'] = $temp[$k]['pengeluaran'] + $row['money'];
                // assign penjualan(sudah dikurang hpp) - pengeluaran per minggu
                $temp[$k]['total']       = $temp[$k]['total'] - $row['money'];
            }
            
            $i++;
            // pindahin ke $container, agar $temp tetap unique di setiap looping
            $container = $temp;
        }
        // pindahin ke $master, agar $container bisa dipakai di tempat lain
        $master = $container;

        return $master;
    }










    private function _________________perhari()
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

    private function _________________perminggu2()
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

    private function _________________perbulan()
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
}
