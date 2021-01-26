<?php


defined('BASEPATH') or exit('No direct script access allowed');




class Data_transaksi_barang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        // hanya untuk pemilik dan gudang
        role_validation($this->session->role_id, ['1', '2']);
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Product_model");
        $this->load->model("Customer_model");
        $this->load->model("Kasir_model");
        $this->load->model("Inventory_material_model");
        $this->load->model("Material_model");
        $this->load->model("Store_model");
        $this->load->model("Customer_model");
        $this->load->model("Kasir_model");
        $this->load->model("Product_model");
        $this->load->model("Product_mutation_model");
    }

    public function index()
    {
        $data = [
            'title'             => 'Data Transaksi Barang',
            'content'           => 'data-gudang/v_transaksi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_transaksi_barang' => $this->Product_mutation_model->get_transaksi_barang(),

            'datatables' => 1
        ];

        if (role_access($this->session->role_id, ['1'])) {
            $data['data_transaksi_barang'] = $this->Material_model->get_transaksi_barang();
        }

        $this->load->view('template_dashboard/template_wrapper', $data);
    }
    public function mutasi_by_store_id($store_id = 1)
    {
        $data = [
            'title'             => 'Data Transaksi Barang',
            'content'           => 'data-gudang/v_transaksi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_transaksi_barang' => $this->Product_mutation_model->get_transaksi_barang_by_store_id($store_id),

            'datatables' => 1
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }












    public function v_mutasi_ke_cabang()
    {
        $data = [
            'title'             => 'Mutasi Barang',
            'content'           => 'data-gudang/v_mutasi_barang.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer'     => $this->Customer_model->get_toko_cabang(),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            // 'data_product'      => $this->Product_model->get_all2(),
            'select2'        => 1,

            // 'data_customer'     => $this->Customer_model->get_all_by_store_id_sort_by_name("*", $this->session->store_id),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            'data_product'      => $this->Product_model->get_all_inventory('p.id, p.product_code, p.full_name, p.unit, p.volume, p.selling_price, p.reseller_price, pi.quantity, pi.critical_point', $this->session->store_id),
            'select2'           => 1,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function konfirmasi_kasir__()
    {
        // start_time(microtime(TRUE), 'data-gudang/data_transaksi_barang');
        $post = $this->input->post();

        // cek apakah tombol cekout ditekan tanpa memilih satupun produk
        if (!isset($post['product'])) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelanjaan kosong!");
            $this->session->set_flashdata('text', 'Mohon cek kembali sesi belanja anda.');
            redirect(base_url("data-gudang/Data_transaksi_barang/v_mutasi_ke_cabang"));
        }
        // pprintd($post);

        // sort array quantity produk dari kecil ke terbesar ambil indek pertama dan terakhir, kemudian cek
        // jika
        $__qty   = $post['quantity'];
        // sort($__qty);
        // $isZero    = $__qty[0];
        // $notZero = end($__qty);
        $isZero = array_search(0, $__qty);
        // cek apakah array pertama yg udh disort bernilai 0, jika iya keluar karena ada produk yg qty == 0
        if ($isZero !== FALSE) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Cek kuantitas produk!");
            $this->session->set_flashdata('text', 'Kuantitas produk belum dipilih.');
            redirect(base_url("data-gudang/Data_transaksi_barang/v_mutasi_ke_cabang"));
        }
        // pprintd($post);

        $checkbox_value     = $this->input->post('product');
        $customer_id        = $this->input->post('nama_pelanggan');
        $address            = $this->input->post('alamat_pelanggan');
        $quantity           = $this->input->post('quantity');


        // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
        // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
        // contoh  ==>  id=1 OR id=9 OR id=13
        $productQuery = '';
        foreach ($checkbox_value as $row) {
            // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
            if ($productQuery !== '') $productQuery .= " OR ";
            $productQuery .= "id={$row}";
        }
        // pprintd($productQuery);

        // get data dari db yg dibutuhkan, dari tabel customer dan produk yg relevan dengan environment ketika cekout
        $data_customer      = $this->Customer_model->get_by_id($customer_id, 'id, full_name, address, phone, cust_type');
        $data_product       = $this->Product_model->get_by_where($productQuery, 'id, product_code, full_name, image, price_base');

        // build array yg isinya hanya kode product untuk keperluan where clause di db ketika get harga custom
        foreach ($data_product as $row) {
            $__productCode[] = $row['product_code'];
        }
        // // get harga custom berdasarkan customer id dan seluruh product id yg dicekout
        // $data_custom_price  = $this->Customer_model->get_customer_price_by_cust_and_product_id($customer_id, $__productCode, 'c.id AS cust_id, p.id AS product_id, p.product_code, cp.price AS custom_price');
        // // looping untuk menjadikan product_id sebagai KEY, dan custom_price sebagai VALUE.
        // // agar logic yang digunakan di foreach untuk set kasir_price tetap seragam.
        // if ($data_custom_price) {
        //     foreach ($data_custom_price as $row) {
        //         $customer_harga[$row['product_id']] = $row['custom_price'];
        //     }
        // }
        // pprintd($data_custom_price);


        // inisiasi $container untuk menyimpan hasil iterasi di bawah
        $container      = [];
        // MULAI : KEY:product_id dan VALUE:harga per item tergantung masing2 hirarkis
        // set $data_product['kasir_price'] untuk digunakan sebagai harga total per item di step2 selanjutnya
        foreach ($data_product as $row) {
            // HIRARKI-nya yaitu:
            // 1. harga custom per transaksi
            // 2. harga custom per customer
            // 3. harga normal jual produk
            // if ($custom_harga[$row['id']]) {
            //     $row['kasir_price'] = $custom_harga[$row['id']];
            // } elseif (isset($customer_harga[$row['id']])) {
            //     $row['kasir_price'] = $customer_harga[$row['id']];
            // } else {
            //     $row['kasir_price'] = $row['selling_price'];
            // }
            $row['kasir_price'] = $row['price_base'];
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk quantity ketika cekout
        $container = [];
        foreach ($data_product as $row) {
            // jika ada harga custom = set custom_price, dan jika tidak ada set selling_price
            if ($quantity[$row['id']]) {
                $row['kasir_qty'] = $quantity[$row['id']];
            } else {
                $row['kasir_qty'] = 0;
            }
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk total harga per item
        $container = [];
        foreach ($data_product as $row) {
            $row['kasir_total_per_item'] = $row['kasir_price'] * $row['kasir_qty'];
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;


        $data = [
            'title'             => 'Kasir',
            'content'           => 'data-gudang/v_konfirmasi.php',
            'menuActive'        => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'kasir', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer'     => $data_customer,
            'data_product'      => $data_product,
            'checkbox_value'    => $checkbox_value,
            // 'customer_id' => $customer_id,
            'address'           => $address,
            // 'quantity'          => $quantity,
            // 'custom_harga'      => $custom_harga,
            'datatables'        => 1
        ];

        // pprint($data);

        $sessionTest['data_customer']   = (array)$data['data_customer'];
        $sessionTest['data_product']    = $data['data_product'];
        $sessionTest['deliv_address']   = $data['address'];
        $sessionTest['store_id']        = $_SESSION['store_id'];
        $sessionTest['employee_id']     = $_SESSION['id'];
        $sessionTest['username']        = $_SESSION['username'];
        $this->session->set_flashdata('dari_konfirmasi_kasir', $sessionTest);

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function konfirmasi_kasir()
    {
        start_time(microtime(TRUE), 'kasir');
        $post = $this->input->post();

        // cek apakah tombol cekout ditekan tanpa memilih satupun produk
        if (!isset($post['product'])) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelanjaan kosong!");
            $this->session->set_flashdata('text', 'Mohon cek kembali sesi belanja anda.');
            redirect(base_url("data-gudang/data-transaksi-barang/v_mutasi_ke_cabang"));
        }
        // pprintd($post);

        // sort array quantity produk dari kecil ke terbesar ambil indek pertama dan terakhir, kemudian cek
        // jika
        $__qty   = $post['quantity'];
        // sort($__qty);
        // $isZero    = $__qty[0];
        // $notZero = end($__qty);
        $isZero = array_search(0, $__qty);
        // cek apakah array pertama yg udh disort bernilai 0, jika iya keluar karena ada produk yg qty == 0
        if ($isZero !== FALSE) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Cek kuantitas produk!");
            $this->session->set_flashdata('text', 'Kuantitas produk belum dipilih.');
            redirect(base_url(getBeforeLastSegment($this->modules)));
        }
        // pprintd($post);

        $checkbox_value     = $this->input->post('product');
        $customer_id        = $this->input->post('nama_pelanggan');
        $address            = $this->input->post('alamat_pelanggan');
        $phone              = $this->input->post('phone');
        $quantity           = $this->input->post('quantity');
        $custom_harga       = $this->input->post('custom_harga');

        // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
        // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
        // contoh  ==>  id=1 OR id=9 OR id=13
        $productQuery = '';
        foreach ($checkbox_value as $row) {
            // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
            if ($productQuery !== '') $productQuery .= " OR ";
            $productQuery .= "id={$row}";
        }
        // pprintd($productQuery);

        // get data dari db yg dibutuhkan, dari tabel customer dan produk yg relevan dengan environment ketika cekout
        // $data_customer      = $this->Customer_model->get_by_id($customer_id, 'id, full_name, address, phone, cust_type');
        $data_customer      = $this->Customer_model->get_by_name($customer_id, 'id, full_name, address, phone, cust_type');

        $data_product       = $this->Product_model->get_by_where($productQuery, 'id, product_code, full_name, image, selling_price');

        // build array yg isinya hanya kode product untuk keperluan where clause di db ketika get harga custom
        foreach ($data_product as $row) {
            $__productCode[] = $row['product_code'];
        }
        // get harga custom berdasarkan customer id dan seluruh product id yg dicekout
        $data_custom_price  = $this->Customer_model->get_customer_price_by_cust_and_product_id($customer_id, $__productCode, 'c.id AS cust_id, p.id AS product_id, p.product_code, cp.price AS custom_price');
        // looping untuk menjadikan product_id sebagai KEY, dan custom_price sebagai VALUE.
        // agar logic yang digunakan di foreach untuk set kasir_price tetap seragam.
        if ($data_custom_price) {
            foreach ($data_custom_price as $row) {
                $customer_harga[$row['product_id']] = $row['custom_price'];
            }
        }
        // pprintd($data_custom_price);


        // inisiasi $container untuk menyimpan hasil iterasi di bawah
        $container      = [];
        // MULAI : KEY:product_id dan VALUE:harga per item tergantung masing2 hirarkis
        // set $data_product['kasir_price'] untuk digunakan sebagai harga total per item di step2 selanjutnya
        foreach ($data_product as $row) {
            // HIRARKI-nya yaitu:
            // 1. harga custom per transaksi
            // 2. harga custom per customer
            // 3. harga normal jual produk
            if ($custom_harga[$row['id']]) {
                $row['kasir_price'] = $custom_harga[$row['id']];
            } elseif (isset($customer_harga[$row['id']])) {
                $row['kasir_price'] = $customer_harga[$row['id']];
            } else {
                $row['kasir_price'] = $row['selling_price'];
            }
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk quantity ketika cekout
        $container = [];
        foreach ($data_product as $row) {
            // jika ada harga custom = set custom_price, dan jika tidak ada set selling_price
            if ($quantity[$row['id']]) {
                $row['kasir_qty'] = $quantity[$row['id']];
            } else {
                $row['kasir_qty'] = 0;
            }
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;

        // MULAI : reset kembali $container agar kosong untuk digunakan
        // proses di bawah sama seperti di atas, bedanya ini untuk total harga per item
        $container = [];
        foreach ($data_product as $row) {
            $row['kasir_total_per_item'] = $row['kasir_price'] * $row['kasir_qty'];
            // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
            $container[] = $row;
        }
        // SELESAI : kembalikan dari $container ke variabel awal
        $data_product = $container;


        $data = [
            'title'             => 'Kasir',
            'content'           => 'data-gudang/v_konfirmasi.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'data_customer'     => $data_customer,
            'data_product'      => $data_product,
            'checkbox_value'    => $checkbox_value,
            // 'customer_id' => $customer_id,
            'address'           => $address,
            'phone'             => $phone,
            // 'quantity'          => $quantity,
            // 'custom_harga'      => $custom_harga,
            'datatables'        => 1
        ];

        // pprintd($data);

        $sessionTest['data_customer']   = (array)$data['data_customer'];
        $sessionTest['data_product']    = $data['data_product'];
        $sessionTest['deliv_address']   = $data['address'];
        $sessionTest['phone_custom']    = $data['phone'];
        $sessionTest['store_id']        = $this->session->store_id;
        $sessionTest['employee_id']     = $this->session->id;
        $sessionTest['username']        = $this->session->username;
        $this->session->set_flashdata('dari_konfirmasi_kasir', $sessionTest);

        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function insert_dio()
    {
        if (!isset($this->session->dari_konfirmasi_kasir)) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelanjaan kosong!");
            $this->session->set_flashdata('text', 'Mohon cek kembali sesi belanja anda.');
            redirect(base_url(getBeforeLastSegment($this->modules)));
        }

        $this->session->keep_flashdata('dari_konfirmasi_kasir');
        $cekoutData = $this->session->dari_konfirmasi_kasir;

        $post                       = $this->input->post();
        // hapus titik, kemudian hapus koma, kemudian cast/ubah jadi (int)
        $post['paid_amount']        = (int)str_replace(',', '', str_replace('.', '', $post['paid_amount']));

        $cekoutData['paid_amount']  = $post['paid_amount'];
        $cekoutData['total_harga']  = $post['total_harga'];
        $cekoutData['nama_toko']    = $post['nama_pelanggan'];

        // pprintd($cekoutData);

        // seluruh proses checkout di satu baris ini, termasuk interaksi dengan 7 tabel di database
        // return array yg (hanya) berisi invoice id, nomor invoice terbaru, dan due_at
        $query = $this->Kasir_model->set_new_checkout_mutation($cekoutData);

        $query['paid_amount'] = $cekoutData['paid_amount'];
        $query['total_harga'] = $cekoutData['total_harga'];

        if ($post['paid_amount'] > $post['total_harga']) {
            $query['kembalian'] = ($post['paid_amount'] - $post['total_harga']);
            $query['sisa_bayar'] = 0;
        } else {
            $query['kembalian'] = 0;
            $query['sisa_bayar'] = ($post['total_harga'] - $post['paid_amount']);
        }

        $this->session->set_flashdata('dari_insert_dio', $query);

        if ($query !== FALSE) {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('success_message', 1);
            $this->session->set_flashdata('title', "Pembelian sukses!");
            $this->session->set_flashdata('text', 'Invoice juga udah siap!');
            redirect(base_url('data-gudang/Data_transaksi_barang/kembalian/' . $query['invoice_id'] . "/" . $query['kembalian']));
        } else {
            // flashdata untuk sweetalert
            $this->session->set_flashdata('failed_message', 1);
            $this->session->set_flashdata('title', "Pembelian gagal!");
            $this->session->set_flashdata('text', 'Mohon hubungi administrator segera. kode: (C/K/ID)');
            redirect(current_url('v_mutasi_ke_cabang'));
        } // end if($query): success or failed
    }



    public function get_ajax()
    {
        $this->Kasir_mode->get_ajax();
    }



    public function kembalian($id_invoice, $kembalian)
    {
        $this->session->keep_flashdata('dari_insert_dio');

        $data = [
            'title'             => 'Gudang',
            'content'           => 'data-gudang/v_kembalian.php',
            'menuActive'        => 'data-gudang', // harus selalu ada, buat indikator sidebar menu yg aktif
            'submenuActive'     => 'data-transaksi-barang', // harus selalu ada, buat indikator sidebar menu yg aktif
            // 'data_customer' => $this->Customer_model->get_all(),
            // 'data_product' => $this->Product_model->get_by_store_id($_SESSION['store_id']),
            // 'data_product' => $this->Product_model->get_all2(),
            'datatables' => 1,
            'id_invoice' => $id_invoice,
            'kembalian'  => $kembalian,
            'namaToko'   => $nama_toko,

            // dio
            'cekout' => $this->session->dari_insert_dio,
        ];

        $this->load->view('template_dashboard/template_wrapper', $data);
        end_time('kasir');
    }
}
