<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_laba_rugi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Kas_model");
        $this->load->model("Kasir_model");
    }

    public function index()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $total_pemasukan = 0;
        $total_modal = 0;
        // $data_invoice = $this->Kas_model->get_invoice_perhari("2020-12-17");
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
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal);
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
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
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal);
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
            }
        }

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
                    $total_pemasukan = $total_pemasukan - $total_hutang;
                    $nilai_final = $total_pemasukan - $total_modal;
                    if ($total_modal !== 0) {
                        array_push($hutang_array, $total_hutang);
                        array_push($nilai_final_array, $nilai_final);
                        array_push($tanggal_array, $tanggal_pertama);
                        array_push($total_modal_array, $total_modal);
                        array_push($total_pemasukan_array, $total_pemasukan);
                    }
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
                    $total_pemasukan = $total_pemasukan - $total_hutang;
                    $nilai_final = $total_pemasukan - $total_modal;
                    if ($total_modal !== 0) {
                        array_push($hutang_array, $total_hutang);
                        array_push($nilai_final_array, $nilai_final);
                        array_push($tanggal_array, $tanggal_pertama);
                        array_push($total_modal_array, $total_modal);
                        array_push($total_pemasukan_array, $total_pemasukan);
                    }
                }
            }
        }


        $matrix = [];
        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
    }



    public function index22()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 0);
        $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
        $id_invoice = array();
        $total_pemasukan = 0;
        $total_modal = 0;
        foreach ($data_invoice as $row) {
            array_push($id_invoice, $row['id']);

            if ($row['left_to_paid'] > 0) {
                $total_hutang += $row['left_to_paid'];
            }


            $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
            $i = 0;
            foreach ($invoice_item as $row2) {

                // var_dump($invoice_item);
                // echo $invoice_item[$i]['item_price'];
                // echo $invoice_item[$i]['product_id'];

                $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                // echo $data_produk[0]['price_base'];

                // echo "<br>";
                $total_modal += $data_produk[0]['price_base'];

                $total_pemasukan += $invoice_item[$i]['item_price'];
                $i++;
            }
        };
        $total_pemasukan = $total_pemasukan - $total_hutang;
        $nilai_final = $total_pemasukan - $total_modal;
        if ($total_modal !== 0) {
            array_push($hutang_array, $total_hutang);
            array_push($nilai_final_array, $nilai_final);
            array_push($tanggal_array, date("Y-M-d", $tanggal_hari_ini));
            array_push($total_modal_array, $total_modal);
            array_push($total_pemasukan_array, $total_pemasukan);
        }







        while ($tanggal_hari_ini > $tanggal_pertama) {
            $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 1);
            $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));



            if (count($data_invoice) > 1) {
                $v = 0;
                $id_invoice = array();
                $total_pemasukan = 0;
                $total_modal = 0;
                $total_hutang = 0;
                // echo "<pre>";
                // var_dump($data_invoice);
                // echo "</pre>";


                foreach ($data_invoice as $row) {

                    // array_push($id_invoice, $row['id']);

                    if ($row['left_to_paid'] > 0) {
                        $total_hutang += $row['left_to_paid'];
                    }
                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                    $i = 0;
                    foreach ($invoice_item as $row2) {

                        // var_dump($invoice_item);
                        // echo $invoice_item[$i]['item_price'];
                        // echo $invoice_item[$i]['product_id'];

                        $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                        // echo $data_produk[0]['price_base'];

                        // echo "<br>";
                        $total_modal += $data_produk[0]['price_base'];
                        $total_pemasukan += $invoice_item[$i]['item_price'];
                        $i++;
                    }
                    $v++;
                };
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($total_modal_array, $total_modal);
                    array_push($tanggal_array, date("Y-M-d", $tanggal_hari_ini));
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
            } else {
                $id_invoice = array();
                $total_pemasukan = 0;
                $total_modal = 0;
                $total_hutang = 0;
                foreach ($data_invoice as $row) {
                    array_push($id_invoice, $row['id']);
                    if ($row['left_to_paid'] > 0) {
                        $total_hutang += $row['left_to_paid'];
                    }
                    $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                    $i = 0;
                    foreach ($invoice_item as $row2) {

                        // var_dump($invoice_item);
                        // echo $invoice_item[$i]['item_price'];
                        // echo $invoice_item[$i]['product_id'];

                        $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                        // echo $data_produk[0]['price_base'];

                        // echo "<br>";
                        $total_modal += $data_produk[0]['price_base'];
                        $total_pemasukan += $invoice_item[$i]['item_price'];
                        $i++;
                    }
                };
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($total_modal_array, $total_modal);
                    array_push($tanggal_array, date("Y-M-d", $tanggal_hari_ini));
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
            }



            // echo $x . '-';
            // echo date("Y-m-d", $tanggal_hari_ini) . "-";
            // echo $nilai_final = $total_pemasukan - $total_modal;
            // echo "<br>";
            // echo $total_pemasukan;
            // echo "<br>";

            $x++;
            // echo "<pre>";
            // var_dump($data_invoice);
            // echo "</pre>";
        }

        // $data_invoice = $this->Kas_model->get_invoice_perminggu("2020-12-11");

        echo "<pre>";
        var_dump($total_modal_array);
        echo "</pre>";


        // echo "MARGIN PENJUALAN ADALAH {$total_pemasukan} - {$total_modal} = {$nilai_final}";

        // id_invoice berisi id dari invoice hanya saja belum dipisahkan berdasarkan tanggalnya


        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];

        // $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function perminggu()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (86400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 0);
        $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
        $id_invoice = array();
        $total_pemasukan = 0;
        $total_modal = 0;
        foreach ($data_invoice as $row) {
            array_push($id_invoice, $row['id']);

            if ($row['left_to_paid'] > 0) {
                $total_hutang += $row['left_to_paid'];
            }


            $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
            $i = 0;
            foreach ($invoice_item as $row2) {

                // var_dump($invoice_item);
                // echo $invoice_item[$i]['item_price'];
                // echo $invoice_item[$i]['product_id'];

                $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                // echo $data_produk[0]['price_base'];

                // echo "<br>";
                $total_modal += $data_produk[0]['price_base'];

                $total_pemasukan += $invoice_item[$i]['item_price'];
                $i++;
            }
        };
        $nilai_final = $total_pemasukan - $total_modal;
        if ($total_modal !== 0) {
            array_push($hutang_array, $total_hutang);
            array_push($nilai_final_array, $nilai_final);
            array_push($tanggal_array, $tanggal_hari_ini);
            array_push($total_modal_array, $total_modal);
            array_push($total_pemasukan_array, $total_pemasukan);
        }




        while ($tanggal_hari_ini > $tanggal_pertama) {
            $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 1);
            $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
            $id_invoice = array();
            $total_pemasukan = 0;
            $total_modal = 0;
            $total_hutang = 0;
            foreach ($data_invoice as $row) {
                array_push($id_invoice, $row['id']);
                if ($row['left_to_paid'] > 0) {
                    $total_hutang += $row['left_to_paid'];
                }
                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                $i = 0;
                foreach ($invoice_item as $row2) {

                    // var_dump($invoice_item);
                    // echo $invoice_item[$i]['item_price'];
                    // echo $invoice_item[$i]['product_id'];

                    $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                    // echo $data_produk[0]['price_base'];

                    // echo "<br>";
                    $total_modal += $data_produk[0]['price_base'];
                    $total_pemasukan += $invoice_item[$i]['item_price'];
                    $i++;
                }
            };
            $nilai_final = $total_pemasukan - $total_modal;
            if ($total_modal !== 0) {
                array_push($hutang_array, $total_hutang);
                array_push($nilai_final_array, $nilai_final);
                array_push($total_modal_array, $total_modal);
                // array_push($tanggal_array, date("Y-m-d", $tanggal_hari_ini));
                array_push($tanggal_array,  $tanggal_hari_ini);
                array_push($total_pemasukan_array, $total_pemasukan);
            }


            // echo $x . '-';
            // echo date("Y-m-d", $tanggal_hari_ini) . "-";
            // echo $nilai_final = $total_pemasukan - $total_modal;
            // echo "<br>";
            // echo $total_pemasukan;
            // echo "<br>";

            $x++;
        }

        $matrix = [
            'hutang' => $hutang_array,
            'nilai_final' => $nilai_final_array,
            'total_modal' => $total_modal_array,
            'tanggal' => $tanggal_array,
            'total_pemasukan' => $total_modal_array
        ];
        // echo "<pre>";
        // print_r($matrix);
        // echo "</pre>";



        // echo "MARGIN PENJUALAN ADALAH {$total_pemasukan} - {$total_modal} = {$nilai_final}";

        // id_invoice berisi id dari invoice hanya saja belum dipisahkan berdasarkan tanggalnya


        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];

        // echo date("Y-m-d", $date->getTimestamp() - (86400 * 3));
        // echo date_timestamp_get("2020-12-14");
        // var_dump($data_invoice);
        // echo $total_hutang;
        $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function perbulan_tester()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 0);
        $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
        $id_invoice = array();
        $total_pemasukan = 0;
        $total_modal = 0;
        foreach ($data_invoice as $row) {
            array_push($id_invoice, $row['id']);

            if ($row['left_to_paid'] > 0) {
                $total_hutang += $row['left_to_paid'];
            }


            $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
            $i = 0;
            foreach ($invoice_item as $row2) {

                // var_dump($invoice_item);
                // echo $invoice_item[$i]['item_price'];
                // echo $invoice_item[$i]['product_id'];

                $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                // echo $data_produk[0]['price_base'];

                // echo "<br>";
                $total_modal += $data_produk[0]['price_base'];

                $total_pemasukan += $invoice_item[$i]['item_price'];
                $i++;
            }
        };
        $nilai_final = $total_pemasukan - $total_modal;
        if ($total_modal !== 0) {
            array_push($hutang_array, $total_hutang);
            array_push($nilai_final_array, $nilai_final);
            array_push($tanggal_array, $tanggal_hari_ini);
            array_push($total_modal_array, $total_modal);
            array_push($total_pemasukan_array, $total_pemasukan);
        }




        while ($tanggal_hari_ini > $tanggal_pertama) {
            $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 1);
            $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
            $id_invoice = array();
            $total_pemasukan = 0;
            $total_modal = 0;
            $total_hutang = 0;
            foreach ($data_invoice as $row) {
                array_push($id_invoice, $row['id']);
                if ($row['left_to_paid'] > 0) {
                    $total_hutang += $row['left_to_paid'];
                }
                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                $i = 0;
                foreach ($invoice_item as $row2) {

                    // var_dump($invoice_item);
                    // echo $invoice_item[$i]['item_price'];
                    // echo $invoice_item[$i]['product_id'];

                    $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                    // echo $data_produk[0]['price_base'];

                    // echo "<br>";
                    $total_modal += $data_produk[0]['price_base'];
                    $total_pemasukan += $invoice_item[$i]['item_price'];
                    $i++;
                }
            };
            $nilai_final = $total_pemasukan - $total_modal;
            if ($total_modal !== 0) {
                array_push($hutang_array, $total_hutang);
                array_push($nilai_final_array, $nilai_final);
                array_push($total_modal_array, $total_modal);
                array_push($tanggal_array, $tanggal_hari_ini);
                array_push($total_pemasukan_array, $total_pemasukan);
            }
            $x++;
        }
        // echo "<pre>";
        // var_dump($tanggal_array);
        // echo "</pre>";



        $counter_bulanan = 0;

        $z = $tanggal_array[count($tanggal_array) - 1];
        $y = $tanggal_array[0];
        echo $z + 86400 * 30;
        echo "<br>";
        echo $y;
        while ($counter_bulanan < 2) {


            $f = 0;
            $total_hutang_perbulan = 0;
            $total_nilai_final = 0;
            while ($f < count($total_modal_array)) {
                $matrix[$f] = [
                    'hutang' => $hutang_array[$f],
                    'nilai_final' => $nilai_final_array[$f],
                    'total_modal' => $total_modal_array[$f],
                    'tanggal' => $tanggal_array[$f],
                    'total_pemasukan' => $total_modal_array[$f]
                ];
                $o = date("Y-m", $matrix[$f]['tanggal']);
                $p = date("Y-m", $z);



                if ($o === $p) {
                    // echo $matrix[$f]['nilai_final'];
                    // echo date("d", $matrix[$f]['tanggal']);
                    $total_hutang_perbulan += $matrix[$f]['hutang'];
                    $total_nilai_final += $matrix[$f]['nilai_final'];
                    $total_pemasukan += $matrix[$f]['total_pemasukan'];
                    // echo $total_bulanan;
                    // echo "<br>";
                }
                $f++;
            }

            $data_final_bulanan[$counter_bulanan] = [
                "total_hutang_perbulan" => $total_hutang_perbulan,
                "total_nilai_final" => $total_nilai_final,
                "total_pemasukan" => $total_pemasukan,
            ];
            $z = $z + (86400 * 30);
            $counter_bulanan++;
        }


        echo "<pre>";
        var_dump($data_final_bulanan);
        echo "</pre>";

        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];


        // $this->load->view('template_dashboard/template_wrapper', $data);
    }


    public function perbulan_tester2()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 0);
        $data_invoice = $this->Kas_model->get_invoice_perbulan();
        $id_invoice = array();
        $total_pemasukan = 0;
        $total_modal = 0;
        foreach ($data_invoice as $row) {
            array_push($id_invoice, $row['id']);

            if ($row['left_to_paid'] > 0) {
                $total_hutang += $row['left_to_paid'];
            }


            $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
            $i = 0;
            foreach ($invoice_item as $row2) {

                // var_dump($invoice_item);
                // echo $invoice_item[$i]['item_price'];
                // echo $invoice_item[$i]['product_id'];

                $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                // echo $data_produk[0]['price_base'];

                // echo "<br>";
                $total_modal += $data_produk[0]['price_base'];

                $total_pemasukan += $invoice_item[$i]['item_price'];
                $i++;
            }
        };
        $nilai_final = $total_pemasukan - $total_modal;
        if ($total_modal !== 0) {
            array_push($hutang_array, $total_hutang);
            array_push($nilai_final_array, $nilai_final);
            array_push($tanggal_array, $tanggal_hari_ini);
            array_push($total_modal_array, $total_modal);
            array_push($total_pemasukan_array, $total_pemasukan);
        }




        while ($tanggal_hari_ini > $tanggal_pertama) {
            $tanggal_hari_ini = $tanggal_hari_ini - (86400 * 1);
            $data_invoice = $this->Kas_model->get_invoice_perminggu(date("Y-m-d", $tanggal_hari_ini));
            $id_invoice = array();
            $total_pemasukan = 0;
            $total_modal = 0;
            $total_hutang = 0;
            foreach ($data_invoice as $row) {
                array_push($id_invoice, $row['id']);
                if ($row['left_to_paid'] > 0) {
                    $total_hutang += $row['left_to_paid'];
                }
                $invoice_item = $this->Kas_model->get_data_terjual($row['id']);
                $i = 0;
                foreach ($invoice_item as $row2) {

                    // var_dump($invoice_item);
                    // echo $invoice_item[$i]['item_price'];
                    // echo $invoice_item[$i]['product_id'];

                    $data_produk = $this->Kasir_model->get_code_product($invoice_item[$i]['product_id']);
                    // echo $data_produk[0]['price_base'];

                    // echo "<br>";
                    $total_modal += $data_produk[0]['price_base'];
                    $total_pemasukan += $invoice_item[$i]['item_price'];
                    $i++;
                }
            };
            $nilai_final = $total_pemasukan - $total_modal;
            if ($total_modal !== 0) {
                array_push($hutang_array, $total_hutang);
                array_push($nilai_final_array, $nilai_final);
                array_push($total_modal_array, $total_modal);
                array_push($tanggal_array, $tanggal_hari_ini);
                array_push($total_pemasukan_array, $total_pemasukan);
            }

            // echo "<pre>";
            // var_dump($tanggal_array);
            // echo "</pre>";


            // echo $x . '-';
            // echo date("Y-m-d", $tanggal_hari_ini) . "-";
            // echo $nilai_final = $total_pemasukan - $total_modal;
            // echo "<br>";
            // echo $total_pemasukan;
            // echo "<br>";

            $x++;
        }





        // echo "MARGIN PENJUALAN ADALAH {$total_pemasukan} - {$total_modal} = {$nilai_final}";

        // id_invoice berisi id dari invoice hanya saja belum dipisahkan berdasarkan tanggalnya


        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi_perbulan.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];


        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function perbulan()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
        $x = 0;
        $nilai_final_array = array();
        $total_pemasukan_array = array();
        $total_modal_array = array();
        $tanggal_array = array();
        $hutang_array = array();
        $total_hutang = 0;
        $total_pemasukan = 0;
        $total_modal = 0;
        // $data_invoice = $this->Kas_model->get_invoice_perhari("2020-12-17");
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
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal);
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
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
                $total_pemasukan = $total_pemasukan - $total_hutang;
                $nilai_final = $total_pemasukan - $total_modal;
                if ($total_modal !== 0) {
                    array_push($hutang_array, $total_hutang);
                    array_push($nilai_final_array, $nilai_final);
                    array_push($tanggal_array, $tanggal_pertama);
                    array_push($total_modal_array, $total_modal);
                    array_push($total_pemasukan_array, $total_pemasukan);
                }
            }
        }

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
                    $total_pemasukan = $total_pemasukan - $total_hutang;
                    $nilai_final = $total_pemasukan - $total_modal;
                    if ($total_modal !== 0) {
                        array_push($hutang_array, $total_hutang);
                        array_push($nilai_final_array, $nilai_final);
                        array_push($tanggal_array, $tanggal_pertama);
                        array_push($total_modal_array, $total_modal);
                        array_push($total_pemasukan_array, $total_pemasukan);
                    }
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
                    $total_pemasukan = $total_pemasukan - $total_hutang;
                    $nilai_final = $total_pemasukan - $total_modal;
                    if ($total_modal !== 0) {
                        array_push($hutang_array, $total_hutang);
                        array_push($nilai_final_array, $nilai_final);
                        array_push($tanggal_array, $tanggal_pertama);
                        array_push($total_modal_array, $total_modal);
                        array_push($total_pemasukan_array, $total_pemasukan);
                    }
                }
            }
        }


        $matrix = [];
        $data = [
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi_perbulan.php',
            'menuActive'        => 'data-keuangan', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-laba-rugi', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_barang_kritis' => $this->Inventory_material_model->getKritis(),
            'total_modal' => $total_modal_array,
            'total_pemasukan' => $total_pemasukan_array,
            'nilai_final' => $nilai_final_array,
            'tanggal_hari_ini' => $tanggal_array,
            'hutang_array' => $hutang_array,
            'datatables' => 1
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
    }
}
