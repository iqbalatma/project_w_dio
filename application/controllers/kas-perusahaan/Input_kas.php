<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Input_kas extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    must_login();
    // load model
    $this->load->model('Kas_model', 'kas_m');
    // initialize for menuActive and submenuActive
    $this->modules    = "kas-perusahaan";
    $this->controller = "input-kas";
  }

  public function index()
  {
    // naik se-level
    redirect( getBeforeLastSegment().'/data-master' );
  }

  public function pengeluaran()
  {
    // set form rules
    $this->form_validation->set_rules('add-perihal', 'perihal',	        'required|trim|min_length[3]|max_length[200]');
    $this->form_validation->set_rules('add-nominal', 'nominal', 				'required|trim|is_numeric|min_length[1]');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Input Pengeluaran Kas Perusahaan',
        'content'         => "{$this->modules}/v_{$this->controller}_pengeluaran.php",
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => 'input-pengeluaran', // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post = $this->input->post();
      $post += [
        "add-type"  => "kredit",
        "created_by" => $this->session->username,
      ];
      $query = $this->kas_m->set_new_kas($post);
      // pprintd($post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penambahan sukses!");
        $this->session->set_flashdata('text', 'Data kas telah berhasil ditambah!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Penambahan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data kas.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      } // end if($query): success or failed
    } // end form_validation->run()

  }

  public function pemasukan()
  {
    // set form rules
    $this->form_validation->set_rules('add-perihal', 'perihal',	        'required|trim|min_length[3]|max_length[200]');
    $this->form_validation->set_rules('add-nominal', 'nominal', 				'required|trim|is_numeric|min_length[1]');
    $this->form_validation->set_error_delimiters('<small class="form-text text-danger text-nowrap"><em>', '</em></small>');

    // run the form validation
    if ($this->form_validation->run() == FALSE) {
      // set data untuk digunakan pada view
      $data = [
        'title'           => 'Input Pemasukan Kas Perusahaan',
        'content'         => "{$this->modules}/v_{$this->controller}_pemasukan.php",
        'menuActive'      => $this->modules, // harus selalu ada, buat indikator sidebar menu yg aktif
        'submenuActive'   => 'input-pemasukan', // harus selalu ada, buat indikator sidebar menu yg aktif
      ];
      $this->load->view('template_dashboard/template_wrapper', $data);

    }else {
      // insert data to db
      $post = $this->input->post();
      $post += [
        "add-type"  => "debet",
        "created_by" => $this->session->username,
      ];
      $query = $this->kas_m->set_new_kas($post);
      // pprintd($post);

      if ($query) {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('success_message', 1);
        $this->session->set_flashdata('title', "Penambahan sukses!");
        $this->session->set_flashdata('text', 'Data kas telah berhasil ditambah!');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));

      }else {
        // flashdata untuk sweetalert
        $this->session->set_flashdata('failed_message', 1);
        $this->session->set_flashdata('title', "Penambahan gagal!");
        $this->session->set_flashdata('text', 'Mohon cek kembali data kas.');
        // kembali ke laman sebelumnya sesuai hirarki controller
        redirect(base_url( getBeforeLastSegment($this->modules) ));
      } // end if($query): success or failed
    } // end form_validation->run()

  }


  
}
