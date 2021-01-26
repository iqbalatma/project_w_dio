<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_transaksi_produk extends CI_Controller
{

    public function __construct()
    {
      parent::__construct();
      must_login();
      // load model
      $this->load->model('Product_mutation_model', 'pm_m');
      $this->load->model('Store_model', 's_m');
      // initialize for menuActive and submenuActive
      $this->modules    = "data-produksi";
      $this->controller = "data-transaksi-produk";
    }

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
          // $productInventory = $this->pi_m->get_all("pi.id, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by");
          $productMutation = $this->pm_m->get_all("pm.id, p.product_code, p.full_name, s.store_name, pm.mutation_code, pm.quantity, pm.mutation_type, pm.created_at, pm.created_by");
        }
        else {
          // cek data store pada db
          $storeId  = $this->s_m->get_by_id($uniqid, 'id')->id;
          // untuk semua role dan hanya toko yg sesuai dgn id

          // jika akun yg login mengakses toko selain punya dia dan hanya untuk kasir, maka redirect
          if ( ($sess['store_id'] != $storeId) && ($sess['role_id'] == '3') ) redirect( current_url()."?uniqid={$sess['store_id']}" );

          // jika storeid diisi dengan id yg sesuai dengan id di db, maka tampil data per id tersebut
          if ($storeId != FALSE) {
            // $productInventory = $this->pi_m->get_all_by_store_id($storeId, "pi.id, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by");
            $productMutation = $this->pm_m->get_all_by_store_id($storeId, "pm.id, p.product_code, p.full_name, s.store_name, pm.mutation_code, pm.quantity, pm.mutation_type, pm.created_at, pm.created_by", 'pm.id', 'DESC');
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

      $data = [
          'title'             => 'Data mutasi transaksi produk',
          'content'           => 'data-produksi/v_data_transaksi_produk.php',
          'menuActive'        => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'     => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'datatables'        => 1,
          'productMutation'   => $productMutation,
          'uniqid'            => $uniqid,
      ];
      // pprintd($data['productInventory']);
      $this->load->view('template_dashboard/template_wrapper', $data);
    }

    // public function tambah()
    // {
    //   // set form rules
    //   $this->form_validation->set_rules('add-kodeproduk', 'kode produk',    'required|trim|min_length[5]|max_length[100]');
    //   $this->form_validation->set_rules('add-fullname', 'nama pelanggan',	  'required|trim|min_length[3]|max_length[100]');
    //   $this->form_validation->set_rules('add-unit', 'unit', 						    'required');
    //   $this->form_validation->set_rules('add-volume', 'volume', 						'required');
    //   $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    //   // run the form validation
    //   if ($this->form_validation->run() == FALSE) {
    //     // set data untuk digunakan pada view
    //     $data = [
    //       'title'           => 'Tambah produk baru',
    //       'content'         => 'data-produksi/v_data_master_produk_tambah.php',
    //       'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
    //       'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    //     ];
    //     $this->load->view('template_dashboard/template_wrapper', $data);

    //   }else {
    //     // insert data to db
    //     $post  = $this->input->post();
    //     $query = $this->pm_m->set_new_product($post);

    //     if ($query) {
    //       // flashdata untuk sweetalert
    //       $this->session->set_flashdata('success_message', 1);
    //       $this->session->set_flashdata('title', "Penambahan sukses!");
    //       $this->session->set_flashdata('text', 'Data produk telah berhasil ditambah!');
    //       // kembali ke laman sebelumnya sesuai hirarki controller
    //       redirect(base_url( getBeforeLastSegment($this->modules) ));

    //     }else {
    //       // flashdata untuk sweetalert
    //       $this->session->set_flashdata('failed_message', 1);
    //       $this->session->set_flashdata('title', "Penambahan gagal!");
    //       $this->session->set_flashdata('text', 'Mohon cek kembali data produk.');
    //       // kembali ke laman sebelumnya sesuai hirarki controller
    //       redirect(base_url( getBeforeLastSegment($this->modules) ));
    //     } // end if($query): success or failed
    //   } // end form_validation->run()
    // }

    // public function edit($id=NULL)
    // {
    //   if ($id === NULL)
    //   {
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));
    //   }
    //   // set form rules
    //   $this->form_validation->set_rules('edit-tipeupdate', 'jenis update stok',         'required');
    //   $this->form_validation->set_rules('edit-updatestok', 'jumlah update stok',        'required|trim|is_numeric|min_length[1]|max_length[10]');
    //   $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    //   // run the form validation
    //   if ($this->form_validation->run() == FALSE) {
    //     // query data dari database
    //     $result = $this->pm_m->get_by_id($id);
    //     // validasi jika data tidak ada (return FALSE) maka redirect keluar
    //     ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

    //     // set data untuk digunakan pada view
    //     $data = [
    //       'title'           => 'Ubah data inventory produk',
    //       'content'         => 'data-produksi/v_data_inventory_produk_edit.php',
    //       'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
    //       'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    //       'productInventory'=> $this->pm_m->get_by_id($id, "pi.id, p.image, p.product_code, p.full_name, pi.quantity, s.store_name, pi.updated_at, pi.updated_by"),
    //     ];
    //     $this->load->view('template_dashboard/template_wrapper', $data);

    //   }else {
    //     // insert data to db
    //     $post  = $this->input->post();
    //     // pprintd($post);
    //     $query = $this->pm_m->set_update_by_id($id, $post);

    //     if ($query) {
    //       // flashdata untuk sweetalert
    //       $this->session->set_flashdata('success_message', 1);
    //       $this->session->set_flashdata('title', "Pembaruan sukses!");
    //       $this->session->set_flashdata('text', 'Data stok inventory produk telah berhasil diperbarui!');
    //       // kembali ke laman sebelumnya sesuai hirarki controller
    //       redirect(base_url( getBeforeLastSegment($this->modules, 2) ));

    //     }else {
    //       // flashdata untuk sweetalert
    //       $this->session->set_flashdata('failed_message', 1);
    //       $this->session->set_flashdata('title', "Pembaruan gagal!");
    //       $this->session->set_flashdata('text', 'Mohon cek kembali data stok inventory produk.');
    //       // kembali ke laman sebelumnya sesuai hirarki controller
    //       redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
    //     } // end if($query): success or failed
    //   } // end form_validation->run()
    // }

    // public function hapus()
    // {
    //   $id  = $this->input->post('id');
    //   if ($id === NULL)
    //   {
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));
    //   }
    //   // update data to db
    //   // echo '<pre>'; print_r($id); die;
    //   $query = $this->pm_m->set_delete_by_id($id);

    //   if ($query) {
    //     // flashdata untuk sweetalert
    //     $this->session->set_flashdata('success_message', 1);
    //     $this->session->set_flashdata('title', "Penghapusan sukses!");
    //     $this->session->set_flashdata('text', 'Data produk telah berhasil dihapus!');
    //     // kembali ke laman sebelumnya sesuai hirarki controller
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));

    //   }else {
    //     // flashdata untuk sweetalert
    //     $this->session->set_flashdata('failed_message', 1);
    //     $this->session->set_flashdata('title', "Penghapusan gagal!");
    //     $this->session->set_flashdata('text', 'Mohon hubungi administrator jika masih berlanjut.');
    //     // kembali ke laman sebelumnya sesuai hirarki controller
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));
    //   } // end if($query): success or failed
    // }

    // // ============================== DETAL =========================
    // public function detail($id = NULL)
    // {
    //   if ($id === NULL)
    //   {
    //     redirect(base_url( getBeforeLastSegment($this->modules) ));
    //   }
    //   // set data untuk digunakan pada view
    //   $data = [
    //     'title'             => 'Detail produk',
    //     'content'           => 'data-produksi/v_data_master_produk_detail.php',
    //     'menuActive'        => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
    //     'submenuActive'     => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
    //     'product'           => $this->pm_m->get_by_id($id),
    //     'composition'       => $this->pm_m->get_all_composition_by_id($id, 'material.*'),
    //   ];
    //   $this->load->view('template_dashboard/template_wrapper', $data);
    // } // end method
    
}
