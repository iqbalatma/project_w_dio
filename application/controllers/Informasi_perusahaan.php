<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Informasi_perusahaan extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    $this->load->model('Meta_model', 'meta_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "informasi-perusahaan";
    $this->controller = "informasi-perusahaan";
  }

  public function index()
  {
    $data = [
      'title'           => 'Informasi Perusahaan',
      'content'         => 'informasi-perusahaan/v_informasi_perusahaan.php',
      'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
      'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
      'meta'            => $this->meta_m->get_meta_by_id($this->session->store_id),
    ];
    $this->load->view('template_dashboard/template_wrapper', $data);
  }

  public function edit()
  {
    // set form rules
    $this->form_validation->set_rules('edit-nama-perusahaan', 'nama perusahaan',     'required|trim|min_length[3]|max_length[100]');
    $this->form_validation->set_rules('edit-alamat-perusahaan', 'alamat perusahaan', 'required|trim|min_length[5]|max_length[250]');
    $this->form_validation->set_rules('edit-kontak-1', 'kontak 1',	                 'required|trim|is_numeric|min_length[10]|max_length[14]');
    $this->form_validation->set_rules('edit-kontak-2', 'kontak 2',	                 'required|trim|is_numeric|min_length[10]|max_length[14]');
    $this->form_validation->set_rules('edit-email', 'e-mail',	                       'required|trim|min_length[3]|max_length[50]|valid_email');
    $this->form_validation->set_rules('edit-website', 'website',                     'required|trim|min_length[3]|max_length[50]');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Ubah Informasi Perusahaan',
        'content'         => 'informasi-perusahaan/v_informasi_perusahaan_edit.php',
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => $this->controller, // harus selalu ada, buat indikator sidebar menu yg aktif
        'meta'            => $this->meta_m->get_meta_by_id($this->session->store_id),
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post               = $this->input->post();
      $post['username']   = $this->session->username;

      // pprintd($post);

      // cek apakah image kosong / tidak
      if ( isset($_FILES["edit-logo"]["name"])) $post['edit-logo'] = $this->_uploadLogo();
      else $post['edit-logo'] = 'logo.png';
      
      $query = $this->meta_m->set_update_meta_by_id($this->session->store_id, $post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Pembaruan sukses!");
        $this->session->set_flashdata('text', 'Data perusahan telah berhasil diperbarui!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment() ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Pembaruan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data perusahaan.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment() ));
      } // end if($query): success or failed
    } // end form_validation->run()
  }

  // private method untuk upload gambar logo ke folder img
  // dengan nama logo.png apapun ekstensi awalnya dan return nama filenya
  private function _uploadLogo()
  {
    $config['upload_path']      = './assets/img/';
    $config['allowed_types']    = 'jpg|png';
    $config['file_name']        = 'logo.png';
    $config['overwrite']			  = true;
    $config['max_size']         = 1024 * 5; // 5MB
    // $config['max_width']        = 1024;
    // $config['max_height']       = 768;

    $this->upload->initialize($config);

    if ($this->upload->do_upload('edit-logo')) {
      return $this->upload->data("file_name");
    } else {
      return "logo.png";
    }
  }






}
