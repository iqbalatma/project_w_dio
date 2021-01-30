<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_inventory_produk extends CI_Controller
{

  public function __construct()
  {
      parent::__construct();
      must_login();
      // load model
      $this->load->model('Product_model', 'p_m');
      $this->load->model('Inventory_product_model', 'pi_m');
      $this->load->model('Store_model', 's_m');
      $this->load->model('Inventory_material_model', 'im_m');
      $this->load->model('Customer_model', 'c_m');
      // initialize for menuActive and submenuActive
      $this->modules    = "data-produksi";
      $this->controller = "data-inventory-produk";
  }


  // ============================================== INDEX =======================================
  public function index()
  {
    // =========== NOTE:
    // 0=kaisar ; 1=pemilik ; 2=gudang ; 3=kasir ;
    // 1=Gudang pusat ; 1=Tok.Cab.Cicalengka ; 2=Tok.Cab.Ujung berung ;
    
    // inisiasi data dari session
    $sess     = $this->session->userdata();
    // inisiasi data dari get
    $uniqid   = url_title($this->input->get('uniqid'));
    
    // cek dulu parameter get dari uniqid kosong apa engga
    if ( !empty($uniqid)) {
      // jika storeid diisi dengan all, maka tampil semua data
      if ($uniqid == 'all') {
        // hanya untuk pemilik dan gudang
        role_validation($sess['role_id'], ['0', '1', '2']);
        $productInventory = $this->pi_m->get_all("pi.id, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by", 'pi.quantity');
      }
      else {
        // cek data store pada db
        $storeId  = $this->s_m->get_by_id($uniqid, 'id')->id;
        // untuk semua role dan hanya toko yg sesuai dgn id

        // jika akun yg login mengakses toko selain punya dia dan hanya untuk kasir, maka redirect
        if ( ($sess['store_id'] != $storeId) && ($sess['role_id'] == '3') ) redirect( current_url()."?uniqid={$sess['store_id']}" );

        // jika storeid diisi dengan id yg sesuai dengan id di db, maka tampil data per id tersebut
        if ($storeId != FALSE) {
          $productInventory = $this->pi_m->get_all_by_store_id($storeId, "pi.id, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by", 'pi.quantity');
        } 
        // jika isinya gajelas ya arahin ke default
        else {
          redirect( current_url()."?uniqid={$sess['store_id']}" );
        }
      }
    }
    // jika uniqid gaada ya arahin ke default
    else {
      redirect( current_url()."?uniqid={$sess['store_id']}" );
    }

    // pprintd($uniqid);

    $data = [
      'title'             => 'Data inventory produk',
      'content'           => 'data-produksi/v_data_inventory_produk.php',
      'menuActive'        => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'     => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      'datatables'        => 1,
      'productInventory'  => $productInventory,
      'uniqid'            => $uniqid,
    ];
    // pprintd($data['productInventory']);
    $this->load->view('template_dashboard/template_wrapper', $data);
  }


  // ============================================== TAMBAH =======================================
  public function tambah()
  {
    // hanya untuk pemilik dan gudang
    role_validation($this->session->role_id, ['1', '2']);
    
    // set form rules
    $this->form_validation->set_rules('add-store', 'toko cabang',       'required');
    $this->form_validation->set_rules('add-product', 'produk',	        'required');
    // $this->form_validation->set_rules('add-status', 'status',	          'required');
    $this->form_validation->set_rules('add-qty', 'qty', 						    'required|trim|min_length[1]');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Tambah stok produk',
        'content'         => 'data-produksi/v_data_inventory_produk_tambah.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        // 'stores'          => $this->s_m->getAll(), // dipake nanti kalo udah lebih dari 1 jumlah tokonya ya bos
        'products'        => $this->p_m->get_all(),
        'products_comp'   => $this->p_m->get_all_with_composition(),
      ];
      // $x = unique_multidim_array($data['products'], 'prod_id');

      // pprint($x);
      // echo '<hr>';
      // pprintd($data);
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      $this->tambah__proses($this->input->post());
      // die;
      // // // insert data to db
      // // $post  = $this->input->post();
      // // pprintd($post);
      // $query = 1;

      // if ($query) {
      //   // flashdata untuk sweetalert (biar ringkes dibikin helper aja, strukturnya sama kek yg ada di projek ini)
      //   set_swal(['success', 'Penambahan sukses!', 'Data stok produk telah berhasil ditambah!']);
      //   // kembali ke laman sebelumnya sesuai hirarki controller
      //   redirect(base_url( getBeforeLastSegment($this->modules).'?uniqid=1' ));

      // }else {
      //   // flashdata untuk sweetalert (biar ringkes dibikin helper aja, strukturnya sama kek yg ada di projek ini)
      //   set_swal(['failed', 'Penambahan gagal!', 'Mohon cek kembali data stok produk.']);
      //   // kembali ke laman sebelumnya sesuai hirarki controller
      //   redirect(base_url( getBeforeLastSegment($this->modules).'?uniqid=1' ));
      // } // end if($query): success or failed
    } // end form_validation->run()
  }

  private function tambah__proses($post)
  {
    // pprintd($post);
    $isQtyMinus       = FALSE;
    $materialQtyMinus = NULL;

    // $store      = explode('||', $post['add-store']);
    // pasti selalu dari gudang dan idnya 1 serta namanya "Gudang Pusat"
    // kalo gudangnya nambah lebih bagus pake store yg di atas karena dinamis
    $store[0]   = 1;
    $store[1]   = 'Gudang Pusat';

    $product    = explode('||', $post['add-product']);
    $qty        = $post['add-qty'];

    $post = [];
    $post['product_id']   = $product[0];
    // $post['product_name'] = $product[1];
    $post['add-qty']      = $qty;
    $productComposition   = $this->p_m->get_by_id_with_compostition($post['product_id']);
    // pprintd($productComposition);

    // MULAI : reset kembali $container agar kosong untuk digunakan
    // proses di bawah sama seperti di atas, bedanya ini untuk quantity ketika cekout
    $container = [];
    foreach ($productComposition as $row) {
      $row['new_comp_qty_needed_single'] = $row['comp_qty_needed_single'] * $post['add-qty'];
      // himpun kembali dalam array dengan bentuk yg sama seperti $data_product
      $container[] = $row;
    }
    // SELESAI : kembalikan dari $container ke variabel awal
    $productComposition = $container;

    // set variabel untuk nanti menjadi where query, supaya get hanya produk2 yg dicekout
    // kemudian looping setiap data dan bangun querynya dengan operator OR, agar semua ter-get
    // contoh  ==>  id=1 OR id=9 OR id=13
    $query = '';
    foreach ($productComposition as $row) {
        // hanya tambah OR setelah iterasi pertama, dan hasil query tidak akan ada OR di blkg
        if ($query !== '') $query .= " OR ";
        $query .= "material_id={$row['mat_id']}";
    }
    // pprintd($query);

    $matInv = $this->im_m->get_by_where($query, 'id, material_id AS mat_id, quantity');

    //  array (
    //     [prod_id] =>   (id produk)
    //     [product_code] => PR001  (kode produk)

    //     [prod_fullname] => Kopi Nikma  (nama produk)
    //     [mat_id] => 1  (id material)

    //     [mat_code] => BM001  (kode material)
    //     [mat_fullname] => Biji kopi robusta  (nama material)

    //     [mat_unit] => gra  (unit material)
    //     [comp_id] =>   (id komposisi)

    //     [comp_qty_needed_single] => 100      (bahan baku yg dibutuhkan untuk nyetok 1 produk)
    //     [new_comp_qty_needed_single] => 1200     (bahan baku yg dibutuh untuk nyetok sesuai yg diinput di form)

    //     [inv_qty] => 155     (bahan baku sisa yg ada di inventory)
    //     [qty_final] => 155     (qty_sisa - qty_inputan = qty_final)
    // )

    $container = [];
    $containerUnderZero = [];
    foreach ($productComposition as $singlePC) {
      
      foreach ($matInv as $singleInv) {
        if ($singlePC['mat_id'] == $singleInv['mat_id']){
          $singlePC['inv_qty']    = $singleInv['quantity'];
          $singlePC['qty_final']  = $singlePC['inv_qty'] - $singlePC['new_comp_qty_needed_single'];
          $loop[]                 = $singlePC;

          if ($singlePC['qty_final'] < 0) {
            $isQtyMinus = TRUE;
            $underZero[] = $singlePC;
            $containerUnderZero = $underZero;
          }

          $container = $loop;
        }
      }

    }
    $productComposition = $container;
    $arrUnderZero       = $containerUnderZero;


    $dataset['data_product_comp'] = $productComposition;
    $dataset['data_product_comp'] = $productComposition;

    $dataset['employee_id']       = $this->session->id;
    $dataset['username']          = $this->session->username;

    $dataset['store_id']     = $store[0]; // pasti dari gudang dan idnya 1
    $dataset['store_name']   = $store[1];
    $dataset['add-qty']      = $post['add-qty'];

    // set harga untuk toko cabang dari harga reseller produk
    $dataset['data_product']   = $this->p_m->get_by_id($post['product_id']);

    // $store_name = $store[1];
    // $cust_name  = $this->c_m->get_toko_cabang('*', TRUE);

    // // cocokan store_name dengan cust_name['full_name] buat nyari store mana yg dipilih
    // foreach ($cust_name as $row) {
    //   if ($row['full_name'] == $store_name){
    //     $dataset['data_cust'] = $row;
    //   }
    // }

    // pprintd($dataset);


    $query = FALSE;
    if ($isQtyMinus) {
      $data = [
        'title'             => 'Konfirmasi stok konfirmasi',
        'content'           => 'data-produksi/v_data_inventory_produk_tambah_konfirmasi.php',
        'menuActive'        => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'     => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'materialUnderZero' => $arrUnderZero,
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);
      // echo'qwe';
    } else {
      $query = $this->pi_m->set_new_qty($dataset);
      // echo'123';
      // pprintd($query);

      if ($query) {
        // flashdata untuk sweetalert (biar ringkes dibikin helper aja, strukturnya sama kek yg ada di projek ini)
        set_swal(['success', 'Penambahan sukses!', 'Data stok produk telah berhasil ditambah!']);
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules).'?uniqid=1' ));
  
      }else {
        // flashdata untuk sweetalert (biar ringkes dibikin helper aja, strukturnya sama kek yg ada di projek ini)
        set_swal(['failed', 'Penambahan gagal!', 'Mohon cek kembali data stok produk.']);
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules).'?uniqid=1' ));
      } // end if($query): success or failed
    }



    // pprintd($productComposition);
    // die;


    // // set form rules
    // $this->form_validation->set_rules('add-store', 'kode produk',         'required');
    // $this->form_validation->set_rules('add-product', 'nama pelanggan',	  'required');
    // $this->form_validation->set_rules('add-qty', 'qty', 						      'required|trim|min_length[1]');
    // $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // // run the form validation
    // if ($this->form_validation->run() == FALSE) {
    //   // set data untuk digunakan pada view
    //   $data = [
    //     'title'           => 'Konfirmasi tambah stok',
    //     'content'         => 'data-produksi/v_data_inventory_produk_tambah_konfirmasi.php',
    //     'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
    //     'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    //     'stores'          => $this->s_m->getAll(),
    //     'products'        => $this->p_m->get_all(),
    //     'products_comp'   => $this->p_m->get_all_with_composition(),
    //   ];
    //   $this->load->view('template_dashboard/template_wrapper', $data);

    // }else {
    //   $this->tambah__proses($this->input->post());
    //   die;
    //   // insert data to db
    //   $post  = $this->input->post();
    //   pprintd($post);
    //   $query = $this->pi_m->set_new_product_inventory($post);

    //   if ($query) {
    //     // flashdata untuk sweetalert
    //     $this->session->set_flashdata('success_message', 1);
    //     $this->session->set_flashdata('title', "Penambahan sukses!");
    //     $this->session->set_flashdata('text', 'Data produk telah berhasil ditambah!');
    //     // kembali ke laman sebelumnya sesuai hirarki controller
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));

    //   }else {
    //     // flashdata untuk sweetalert
    //     $this->session->set_flashdata('failed_message', 1);
    //     $this->session->set_flashdata('title', "Penambahan gagal!");
    //     $this->session->set_flashdata('text', 'Mohon cek kembali data produk.');
    //     // kembali ke laman sebelumnya sesuai hirarki controller
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));
    //   } // end if($query): success or failed
    // } // end form_validation->run()

  }




  // semua di bawah gajadi pake, mangga kl nnti butuh mah



  // ============================================== EDIT =======================================
  private function edit($id=NULL)
  {
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // set form rules
    $this->form_validation->set_rules('edit-tipeupdate', 'jenis update stok',         'required');
    $this->form_validation->set_rules('edit-updatestok', 'jumlah update stok',        'required|trim|is_numeric|min_length[1]|max_length[10]');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // query data dari database
      $result = $this->pi_m->get_by_id($id);
      // validasi jika data tidak ada (return FALSE) maka redirect keluar
      ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Ubah data inventory produk',
        'content'         => 'data-produksi/v_data_inventory_produk_edit.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'productInventory'=> $this->pi_m->get_by_id($id, "pi.id, p.image, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by"),
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post  = $this->input->post();
      // pprintd($post);
      $query = $this->pi_m->set_update_by_id($id, $post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Pembaruan sukses!");
        $this->session->set_flashdata('text', 'Data stok inventory produk telah berhasil diperbarui!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2) ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Pembaruan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data stok inventory produk.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
      } // end if($query): success or failed
    } // end form_validation->run()
  }


  // ============================================== HAPUS =======================================
  private function hapus()
  {
    $id  = $this->input->post('id');
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // update data to db
    // echo '<pre>'; print_r($id); die;
    $query = $this->pi_m->set_delete_by_id($id);

    if ($query) {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('success_message', 1);
      $this->session->set_flashdata('title', "Penghapusan sukses!");
      $this->session->set_flashdata('text', 'Data produk telah berhasil dihapus!');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules) ));

    }else {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('failed_message', 1);
      $this->session->set_flashdata('title', "Penghapusan gagal!");
      $this->session->set_flashdata('text', 'Mohon hubungi administrator jika masih berlanjut.');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    } // end if($query): success or failed
  }


  // ============================================== DETAIL =======================================
  private function detail($id = NULL)
  {
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // set data untuk digunakan pada view
    $data = [
      'title'             => 'Detail produk',
      'content'           => 'data-produksi/v_data_master_produk_detail.php',
      'menuActive'        => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'     => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      'product'           => $this->pi_m->get_by_id($id),
      'composition'       => $this->pi_m->get_all_composition_by_id($id, 'material.*'),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  } // end method
    
}
