<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Data_master_pelanggan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        must_login();
        // load model
        $this->load->model('Customer_model', 'customer_m');
        // initialize for menuActive and submenuActive
        $this->modules    = "data-pelanggan";
        $this->controller = "data-master-pelanggan";
    }

    public function index()
    {
        $data = [
          'title'           => 'Data master pelanggan',
          'content'         => 'data-pelanggan/v_data_master_pelanggan.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'datatables'      => 1,
          'customers'       => $this->customer_m->get_all(),
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);
    }

    public function tambah()
    {
      // set form rules
      $this->form_validation->set_rules('add-fullname', 'nama pelanggan',			'required|trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('add-tipe', 'tipe pelanggan',			    'required');
      $this->form_validation->set_rules('add-address', 'alamat lengkap',      'required|trim|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('add-phone', 'no telepon', 						'required|trim|is_numeric|min_length[10]|max_length[14]');
      // $this->form_validation->set_rules('add-customprice', 'harga kustom',    'trim|is_numeric');
      $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Tambah pelanggan baru',
          'content'         => 'data-pelanggan/v_data_master_pelanggan_tambah.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post  = $this->input->post();
        $lastId = $this->customer_m->set_new_customer($post);

        if ($lastId) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Penambahan sukses!");
          $this->session->set_flashdata('text', 'Data pelanggan telah berhasil ditambah!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules)."/edit-harga/{$lastId}" ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Penambahan gagal!");
          $this->session->set_flashdata('text', 'Mohon cek kembali data pelanggan.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules) ));
        } // end if($query): success or failed
      } // end form_validation->run()
    }

    public function edit($id = NULL)
    {
      if ($id === NULL)
      {
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      }
      // set form rules
      $this->form_validation->set_rules('edit-fullname', 'nama pelanggan',		'required|trim|min_length[3]|max_length[100]');
      $this->form_validation->set_rules('edit-tipe', 'tipe pelanggan',			  'required');
      $this->form_validation->set_rules('edit-address', 'alamat lengkap',     'required|trim|min_length[5]|max_length[250]');
      $this->form_validation->set_rules('edit-phone', 'no telepon', 					'required|trim|is_numeric|min_length[10]|max_length[14]');
      $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // query data dari database
        $result = $this->customer_m->get_by_id($id);
        // validasi jika data tidak ada (return FALSE) maka redirect keluar
        ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Ubah data pelanggan',
          'content'         => 'data-pelanggan/v_data_master_pelanggan_edit.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'customer'        => $result,
        ];
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post  = $this->input->post();
        $query = $this->customer_m->set_update_by_id($id, $post);

        if ($query) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Pembaruan sukses!");
          $this->session->set_flashdata('text', 'Data pelanggan telah berhasil diperbarui!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Pembaruan gagal!");
          $this->session->set_flashdata('text', 'Mohon cek kembali data pelanggan.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
        } // end if($query): success or failed
      } // end form_validation->run()
    }

    public function hapus()
    {
      $id  = $this->input->post('id');
      if ($id === NULL)
      {
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      }
      // update data to db
      // echo '<pre>'; print_r($id); die;
      $query = $this->customer_m->set_delete_by_id($id);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penghapusan sukses!");
        $this->session->set_flashdata('text', 'Data pelanggan telah berhasil dihapus!');
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

    // ============================================== HAPUS =======================================
  public function hapus_harga()
  {
    $id  = $this->input->post('id');
    if ($id === NULL)
    {
      redirect(base_url( getBeforeLastSegment($this->modules) ));
    }
    // update data to db
    // echo '<pre>'; print_r($id); die;
    $query = $this->customer_m->set_delete_custom_price_by_id($id);

    if ($query) {
      // flashdata untuk sweetalert
      $this->session->set_flashdata('success_message', 1);
      $this->session->set_flashdata('title', "Penghapusan sukses!");
      $this->session->set_flashdata('text', 'Data harga kustom telah berhasil dihapus!');
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

    public function edit_harga($id=NULL)
    {
      if ($id === NULL)
      {
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      }
      // set form rules
      $this->form_validation->set_rules('polo', 'polo',			  'required');

      // run the form validation
      if ($this->form_validation->run() == FALSE) {
        // query data dari database
        $result = $this->customer_m->get_by_id($id);
        // validasi jika data tidak ada (return FALSE) maka redirect keluar
        ($result !== FALSE) ?: redirect(base_url( getBeforeLastSegment($this->modules, 2) )) ;

        // set data untuk digunakan pada view
        $data = [
          'title'           => 'Ubah data pelanggan',
          'content'         => 'data-pelanggan/v_data_master_pelanggan_edit_harga.php',
          'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
          'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
          'customer'        => $result,
          'custom_price'    => $this->customer_m->get_customer_price_by_id($id, 'cp.id, cp.customer_id, cp.price, cp.product_code, p.full_name'),
        ];
        // pprintd($data['custom_price']);
        $this->load->view('template_dashboard/template_wrapper', $data);

      }else {
        // insert data to db
        $post   = $this->input->post();
        $query  = $this->customer_m->set_new_customer_price_by_id($id, $post);
        // pprintd($query);

        if ($query) {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('success_message', 1);
          $this->session->set_flashdata('title', "Data harga sukses!");
          $this->session->set_flashdata('text', 'Harga kustom telah diset!');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));

        }else {
          // flashdata untuk sweetalert
          $this->session->set_flashdata('failed_message', 1);
          $this->session->set_flashdata('title', "Gagal! Kode produk salah.");
          $this->session->set_flashdata('text', 'Jika masih berlanjut hubungi administrator segera.');
          // kembali ke laman sebelumnya sesuai hirarki controller
          redirect(base_url( getBeforeLastSegment($this->modules, 2) ));
        } // end if($query): success or failed
      } // end form_validation->run()
    }
    
}
