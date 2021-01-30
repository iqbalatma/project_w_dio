<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master_produk extends CI_Controller
{

  public function __construct()
  {
      parent::__construct();
      must_login();
      // load model
      $this->load->model('Product_model', 'product_m');
      $this->load->model('Material_model', 'material_m');
      // initialize for menuActive and submenuActive
      $this->modules    = "data-produksi";
      $this->controller = "data-master-produk";
  }


  // ============================================== INDEX =======================================
  public function index()
  {
    $data = [
      'title'           => 'Data master produk',
      'content'         => 'data-produksi/v_data_master_produk.php',
      'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      'datatables'      => 1,
      'products'        => $this->product_m->get_all(),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }


  // ============================================== TAMBAH =======================================
  public function tambah()
  {
    // hanya untuk pemilik dan gudang
    role_validation($this->session->role_id, ['1']);
    
    // set form rules
    $this->form_validation->set_rules('add-kodeproduk', 'kode produk',    'required|alpha_dash|trim|min_length[5]|max_length[100]|is_unique[product.product_code]');
    $this->form_validation->set_rules('add-fullname', 'nama pelanggan',	  'required|trim|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('add-unit', 'unit', 						    'required');
    $this->form_validation->set_rules('add-volume', 'volume', 						'required');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Tambah produk baru',
        'content'         => 'data-produksi/v_data_master_produk_tambah.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post  = $this->input->post();
      $query = $this->product_m->set_new_product($post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penambahan sukses!");
        $this->session->set_flashdata('text', 'Data produk telah berhasil ditambah!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Penambahan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data produk.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      } // end if($query): success or failed
    } // end form_validation->run()
  }


  // ============================================== EDIT =======================================
  public function edit($id=NULL)
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);
    
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // set form rules
    $this->form_validation->set_rules('edit-fullname', 'nama pelanggan',	        'required|trim|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('edit-unit', 'unit', 						            'required');
    $this->form_validation->set_rules('edit-volume', 'volume', 						        'required');
    $this->form_validation->set_rules('edit-sellingprice', 'harga normal',        'required|trim|is_numeric');
    $this->form_validation->set_rules('edit-resellerprice', 'harga reseller',     'required|trim|is_numeric');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // query data dari database
      $result = $this->product_m->get_by_id($id);
      // validasi jika data tidak ada (return FALSE) maka redirect keluar
      ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Ubah data produk',
        'content'         => 'data-produksi/v_data_master_produk_edit.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'product'         => $result,
      ];
      // pprintd($data['product']);
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post  = $this->input->post();
      
      // cek apakah image kosong / tidak
      if ($_FILES["edit-foto"]["error"] === 0) $post['edit-foto'] = $this->__uploadfoto($post['edit-kodeproduk']);
      else $post['edit-foto'] = 0;
      // pprintd($_FILES["edit-foto"]["error"]);
      
      $query = $this->product_m->set_update_by_id($id, $post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Pembaruan sukses!");
        $this->session->set_flashdata('text', 'Data produk telah berhasil diperbarui!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2)."/detail/{$id}" ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Pembaruan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data produk.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2)."/detail/{$id}" ));
      } // end if($query): success or failed
    } // end form_validation->run()
  }


  // ============================================== EDIT KOMPOSISI ==============================
  public function edit_komposisi($id=NULL)
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);
    
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // set form rules
    $this->form_validation->set_rules('polo', 'polo',			  'required');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // query data dari database
      $result = $this->product_m->get_by_id($id);
      // validasi jika data tidak ada (return FALSE) maka redirect keluar
      ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Ubah data komposisi produk',
        'content'         => 'data-produksi/v_data_master_produk_edit_komposisi.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'product'         => $result,
        'composition'     => $this->product_m->get_all_composition_by_id($id, 'pc.id AS pc_id, p.product_code, m.material_code, m.full_name, pc.volume'),
        'materials'       => $this->material_m->get_all('material_code, full_name'),
        'select2'         => 1, // load library select2
      ];
      // pprintd($data);
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post   = $this->input->post();
      $query  = $this->product_m->set_new_composition_by_id($id, $post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Data komposisi sukses!");
        $this->session->set_flashdata('text', 'Komposisi produk telah diset!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2)."/detail/{$id}" ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Gagal! Kode bahan baku salah.");
        $this->session->set_flashdata('text', 'Jika masih berlanjut hubungi administrator segera.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules, 2)."/detail/{$id}" ));
      } // end if($query): success or failed
    } // end form_validation->run()
  }


  // ============================================== HAPUS =======================================
  public function hapus()
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);
    
    $id  = $this->input->post('id');
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // update data to db
    // echo '<pre>'; print_r($id); die;
    $query = $this->product_m->set_delete_by_id($id);

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


  // ============================================== HAPUS KOMPOSISI ================================
  public function hapus_komposisi()
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);

    $productId = $this->input->post('page_id');
    $id  = $this->input->post('id');
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // delete (real) composition row for this product, and update HPP
    $query = $this->product_m->set_delete_composition_by_id($id, $productId);

    if ($query) {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('success_message', 1);
      $this->session->set_flashdata('title', "Penghapusan sukses!");
      $this->session->set_flashdata('text', 'Data komposisi produk telah berhasil dihapus!');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules)."/edit-komposisi/{$productId}" ));

    }else {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('failed_message', 1);
      $this->session->set_flashdata('title', "Penghapusan gagal!");
      $this->session->set_flashdata('text', 'Mohon hubungi administrator jika masih berlanjut.');
      // kembali ke laman sebelumnya sesuai hirarki controller
      redirect(base_url( getBeforeLastSegment($this->modules, 2)."/edit-komposisi/{$productId}" ));
    } // end if($query): success or failed
  }


  // ============================================== DETAIL ======================================
  public function detail($id = NULL)
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);
    
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
      'product'           => $this->product_m->get_by_id($id),
      'composition'       => $this->product_m->get_all_composition_by_id($id, 'm.full_name, m.material_code, m.price_base, pc.volume'),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  } // end method


  // ============================================== UPDATE HPP =======================================
  public function update_hpp()
  {
    // hanya untuk pemilik
    role_validation($this->session->role_id, ['1']);

    $allComposition = $this->product_m->get_all_composition('p.id AS prod_id, p.product_code AS prod_code, p.price_base AS prod_hpp, pc.volume AS comp_volume, m.id AS mat_id, m.material_code AS mat_code, m.price_base AS mat_hpp');

    if ($allComposition != null)
    {
      /**
       * looping untuk sigma per produk dari mat_hpp * comp_volume
       * 
       * Cek dulu prod_id, jika sama maka itung, jika beda maka assign prod_id baru
       */
      $currentProdId = 0;
      $newProdHpp = 0;
      $container  = [];
      $updatedAt  = unix_to_human(now(), true, 'europe');
      foreach ($allComposition as $row) {
        // assign prod_id dari indeks selanjutnya, bila yg skrg sudah beda dgn yg sebelumnya
        if ($row['prod_id'] != $currentProdId) {
          $currentProdId = $row['prod_id'];
          $newProdHpp = 0;
        }

        // jumlahkan terus menerus harga bahan baku sehingga di akhir loop mendapatkan hpp produk
        $newProdHpp = $newProdHpp + ($row['comp_volume'] * $row['mat_hpp']);

        // assign ke array baru untuk ditampung
        $container[$row['prod_id']]['id'] = $row['prod_id'];
        $container[$row['prod_id']]['price_base'] = $newProdHpp;
        $container[$row['prod_id']]['updated_at'] = $updatedAt;
      }
      // pindahkan dari $container ke $data
      $data = $container;
      // pprintd($data);

      // insert ke db
      $update = $this->product_m->set_update_all_hpp($data);

      // set sweet alert and redirect
      if ($update == 1) {
        set_swal(['success', 'Update HPP Berhasil!', 'Seluruh HPP produk telah diperbarui.']);
        redirect(base_url("data-produksi/data-master-produk"));
      } else {
        set_swal(['failed', 'Update HPP Gagal!', 'Mohon cek kembali. Bila masih berlanjut hubungi developer segera.']);
        redirect(base_url("data-produksi/data-master-produk"));
      }
    } 
    else 
    {
      set_swal(['failed', 'Terjadi Kesalahan!', 'Mohon ulangi kembali atau refresh halaman. Bila masih berlanjut hubungi developer segera.']);
      redirect(base_url());
    }

  }
  
  



  // ============================================== UPLOAD FOTO =======================================
  // private method untuk upload gambar logo ke folder img
  // dengan nama logo.png apapun ekstensi awalnya dan return nama filenya
  private function __uploadfoto($opt=NULL)
  {
    $config['upload_path']      = './assets/img/product';
    $config['allowed_types']    = 'jpg|jpeg|png';
    $config['file_name']        = ($opt===NULL) ? 'default.png' : $opt;
    $config['overwrite']			  = true;
    $config['max_size']         = 1024 * 5; // 5MB
    // $config['max_width']        = 1024;
    // $config['max_height']       = 768;

    $this->upload->initialize($config);
    // pprintd($this->upload->data("file_name"));

    if ($this->upload->do_upload('edit-foto')) {
      return $this->upload->data("file_name");
    } else {
      return "default.png";
    }
  }
    
}
