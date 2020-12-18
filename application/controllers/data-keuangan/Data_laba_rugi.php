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


    public function perminggu()
    {
        $date = new DateTime();
        $tanggal_hari_ini = $date->getTimestamp();
        $tanggal_pertama = $date->getTimestamp() - (386400 * 10);
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
            'title'             => 'Data Laba Rugi',
            'content'           => 'data-keuangan/v_laba_rugi_perminggu.php',
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
